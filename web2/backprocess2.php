<?php
// http://cabinet.dev/web2/backprocess2.php?getsend=yes&debugging=5

include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/mail/PHPMailerAutoload.php";

// Time
$waktucheck1 = date('y-m-d', strtotime('-1 hour'));
$waktucheck2 = date('H:i:s', strtotime('-1 hour'));
$thetime = "Date :" . $waktucheck1 . " Time : " . $waktucheck2;
echo $thetime;

    $query = "SELECT * FROM email WHERE timesend = '1970-01-31 00:00:00' ORDER BY timeupdate ASC";
    if ($debugging > 6) {
        echo $query;
    }
    echo "<br>";
    $result = $DB->execresultset($query);
    $emails = array();
    foreach($result as $row) {
        $emails[] = $row;
    }

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

        $query = "SELECT companyurl FROM usercompany";
        $result = $DB->execresultset($query);
        foreach($result as $row){
            $urlcompany = $row['companyurl'];
        }
        tradeBack("Backproses :" . $urlcompany);
        for ($icount = 0; $icount < count($emails); $icount++) {
            $email = $emails[$icount];
            tradeBack("Backproses : LINE 47" . $email);
            //Create a new PHPMailer instance
            $mail = new PHPMailer;

            //Tell PHPMailer to use SMTP
            $mail->isSMTP();
            tradeBack("Backproses : LINE 53" . $email);

            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages


            //Ask for HTML-friendly debug output

            //Set the hostname of the mail server
            $mail->Host = $host;

            // use
            // $mail->Host = gethostbyname('smtp.gmail.com');
            // if your network does not support SMTP over IPv6

            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = $mail_port;

            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';

            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;

            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = $mail_from;

            //Password to use for SMTP authentication
            $mail->Password = $password;

            //Set who the message is to be sent from
            $mail->setFrom($mail_from, 'Tarikh');

            //Set an alternative reply-to address
            $mail->addReplyTo($mail_from, 'Tarikh');

            //Set who the message is to be sent to
            $mail->addAddress($email['email_to'], $email['email_to']);

            //Set the subject line
            $mail->Subject = $email['email_subject'];

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $mail->MsgHTML("HTML isinya");

            //Replace the plain text body with one created manually
            $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

            //Attach an image file
            // $mail->addAttachment('images/phpmailer_mini.png');
            tradeBack("Backproses : LINE 106" . $email);
            //send the message, check for errors
            if (!$mail->send()) {
                tradeBack("Backproses : LINE 107");
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message sent!";
            }
            // $mail->clearAddresses();
            // $mail->clearAttachments();
            // $mail->send();
        }

}
function tradeBack($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
?>