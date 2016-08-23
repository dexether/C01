<?php
// http://cabinet.dev/web2/backprocess.php?getsend=yes&debugging=5

include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/mail/PHPMailerAutoload.php";

$waktucheck1 = date('y-m-d', strtotime('-1 hour'));
$waktucheck2 = date('H:i:s', strtotime('-1 hour'));
$thetime = "Date :" . $waktucheck1 . " Time : " . $waktucheck2;
echo $thetime;
//tradeLog("Send_email:" . $thetime);

echo "<br>";
$debugging = $_GET['debugging'];
if ($_GET['getsend'] == 'yes') {
    if ($debugging > 2) {
        echo "Check Email<br>";
    }
    $query = "SELECT * FROM email WHERE timesend = '1970-01-31 00:00:00' ORDER BY timeupdate ASC LIMIT 0,1";
    if ($debugging > 3) {
        echo $query;
    }
    echo "<br>";
    $result = $DB->execresultset($query);
    $emails = array();
    foreach($result as $row) {
        $emails[] = $row;
    }
    /*while ($row = $DB->fetch_array($result)) {
        $emails[] = $row;
    }*/
    if (count($emails) > 0) {
        $query = "SELECT value FROM broker_settings WHERE settings IN ('mailfrom','mailhost','mailpassword','mailto','mailport') order by urutan asc";
        $result = $DB->execresultset($query);
        $mailbrokersettings = array();
        foreach($result as $row){
             $mailbrokersettings[] = $row['value'];
        }

        $mail_from = $mailbrokersettings[0]; //tradeLog("Forget Password-29-MailFrom:" . $mail_from);
        $host = $mailbrokersettings[1]; //tradeLog("Forget Password-30-Mail Host:" . $host);
        $password = $mailbrokersettings[2]; //tradeLog("Forget Password-31-Password:" . $password);
        $mail_tocc = $mailbrokersettings[3];
        $mail_port = $mailbrokersettings[4]; //tradeForgetPassword-109Log("Forget Password-33-Mail Port:" . $mail_port);

        $query = "SELECT * FROM usercompany";
        $result = $DB->execresultset($query);
        foreach($result as $row){
            $urlcompany = $row['companyurl'];
            $programname = $row['programname'];
        }

        for ($icount = 0; $icount < count($emails); $icount++) {
            $email = $emails[$icount];
            
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "tls";  // sets the prefix to the servier
            $mail->Host = $host;
            $mail->Port = $mail_port;
            $mail->IsHTML(true);
            $mail->SMTPDebug = 2;                     // enables SMTP debug information (for testing)
            // 1 = errors and messages
            // 2 = messages only
            $mail->Debugoutput = 'html';
            $mail->Username = $mail_from;
            $mail->Password = $password;
            $mail->SetFrom($mail_from, $programname);
            $mail->AddReplyTo($mail_from, $mail_from);
            $variabel = explode(";", $mail_tocc); //a=1&account=1234567
            for ($i_counter = 0; $i_counter < count($variabel); $i_counter++) {
                $thereceiver = $variabel[$i_counter];
                // logss("backprocess: 74" . $thereceiver);
                $mail->AddBCC($thereceiver, $thereceiver);
                // logss("backprocess: 76" . $thereceiver);
            }
            $mail->AddAddress($email['email_to'], $email['email_to']);
            $mail->Subject = $email['email_subject'];
            $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

            $thebody = $email['email_body'];
            $msgbody = preg_replace("/\'/", "\\'", $thebody);
            //tradelog("BackProcess-78-MessageBody:".$msgbody);
            //$mail->Body = $msgbody;
            $mail->MsgHTML($msgbody);
            //tradelog("BackProcess-77");
            if ($mail->Send()) {
                $timesendupdate = date('Y-m-d H:i', strtotime('-1 hour'));
                $query = "update email set timesend='$timesendupdate' 
                where email_to='$email[email_to]' 
                and email_subject='$email[email_subject]' 
                and email_body='$msgbody'     
                    ";
                //tradelog("BackProcess-85-Success:" . $query);
                $DB->execonly($query);
            } else {
                $themessage = "Something went wrong:" . $mail->ErrorInfo . ";TimeUpdate:" . $timesendupdate . ";To:" . $email['email_to'] . ";Subject:" . $email['email_subject'] . ";Body:" . $email['email_body'];
               
                    echo "Line-95b:Problem" . $themessage . "<br>";
                
            }
            //if ($mail->Send()) {
        }
        //for ($icount = 0; $icount < count($emails); $icount++) {
    }//if(count($emails)>0){


    if ($debugging > 2) {
        echo "Check Email Done<br>";
    }
}
function logss($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
?>
