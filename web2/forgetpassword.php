<?php

session_start();
$skip_authentication = 1;
include("../includes/functions.php");
session_unset();

global $template;

include_once("includes/wr_tools.php");
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}
$var_to_pass = null;
$tools = new CTools();
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
$template->assign("companys", $companys);
if ($_POST) {

    $accountname = anti_injection($_POST['register_username']);
    //tradeLog("Forget Password-16-AccountName" . $accountname);

    $query = "SELECT value FROM broker_settings WHERE settings IN ('mailfrom','mailhost','mailpassword','mailto','mailport') order by urutan asc";
    $mailbrokersettings = array();
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $mailbrokersettings[] = $row['value'];
    }
    $mail_from = $mailbrokersettings[0]; //tradeLog("Forget Password-29-MailFrom:" . $mail_from);
    $host = $mailbrokersettings[1]; //tradeLog("Forget Password-30-Mail Host:" . $host);
    $password = $mailbrokersettings[2]; //tradeLog("Forget Password-31-Password:" . $password);
    $mail_tocc = $mailbrokersettings[3];
    $mail_port = $mailbrokersettings[4]; //tradeForgetPassword-109Log("Forget Password-33-Mail Port:" . $mail_port);


    $query = "SELECT client_aecode.* FROM client_aecode WHERE aecode = '" . $accountname . "';";
    //tradelog("forgetpassword.php-36:".$query);
    $client_name = '';
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $client_name = $row['name'];
        $mail_to = $row['email'];
    }
    //tradeLog("Forget Password-32-Client Name:".$client_name.";Mail To:" . $mail_to);

    if ($client_name != '') {
        $query = "SELECT appurl FROM usercompany;";
        //tradelog("forgetpassword.php-47:".$query);
        $rows = $DB->execresultset($query);
        foreach ($rows as $row) {
            $urlcompany = $row['appurl'];
        }

        $tools = new CTools();
        $accountkey = "a=1&account=" . $accountname . "&postmode=resetpasswordnya";
        $linezip = gzcompress($accountkey);
        $key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));

        $timenya = date('Y-m-d H:i', strtotime('-1 hour'));
        $subject = "Reseting Password at ".$companys['programname']." ";
        $url = $urlcompany . "/".$companys['version']."/forgetpasswordreset.php?key=" . $key;
        $body = "Time: " . $timenya . "<br><br>";
        $body = $body . "Dear $client_name ,<br>";
        $body = $body . " <br>";
        $body = $body . "We have received request to reset your password for Email ID : $accountname <br>";
        $body = $body . " <br>";
        $body = $body . "Please click this link below to start reseting the password <br>";
        $body = $body . " <br>";
        $body = $body . "<a href=$url>$url</a>";
        $body = $body . " <br>";
        $body = $body . " <br>";
        $body = $body . "or if you do not ask for the request, Please ignore this email <br>";
        $body = $body . " <br>";
        $body = $body . "Thank you," . "<br>";
        $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
				$body = $body . $companys['long_address'];
				$body = $body . " Email : ".$companys['email']." <br>";
				$body = $body . " ".$companys['companyurl']." <br>";

        $query = "insert into email set
            timeupdate = '$timenya',
            email_to = '$accountname',
            email_subject = '$subject',
            email_body = '$body',
            timesend = '1970-01-31 00:00:00'    
            ";
        //tradeLog("ForgetPassword-85:".$query);
        $DB->execonly($query);
        $themessage = "Reset Password already sent to your account " . $accountname . " email";
        //tradelog("ForgetPassword-88-Bisa Email");
        echo 0;
    } else {
        //tradeLog("Forget Password-91-Account Tidak ada");
        $themessage = "User " . $accountname . " is not in the list yet";
        echo 1;
    }
}

$template->display("forgetpassword.htm");

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>