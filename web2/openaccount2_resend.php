<?php

$skip_authentication = 1;
include("../includes/functions.php");
include_once("includes/wr_tools.php");
$lines = "a=1";
if ($mysql[crypt_key] != '') {
	$crypt_key = $mysql[crypt_key];
}
$var_to_pass = null;

$email = anti_injection($_GET["email"]);
//Send Email 
$query = "SELECT value FROM broker_settings WHERE settings IN ('mailfrom','mailhost','mailpassword','mailto','mailport') order by urutan asc";
$result = $DB->query($query);
$mailbrokersettings = array();
while ($row = $DB->fetch_array($result)) {
	$mailbrokersettings[] = $row[value];
}
$mail_from = $mailbrokersettings[0]; //tradeLog("Forget Password-29-MailFrom:" . $mail_from);
$host = $mailbrokersettings[1]; //tradeLog("Forget Password-30-Mail Host:" . $host);
$password = $mailbrokersettings[2]; //tradeLog("Forget Password-31-Password:" . $password);
$mail_tocc = $mailbrokersettings[3];
$mail_port = $mailbrokersettings[4]; //tradeForgetPassword-109Log("Forget Password-33-Mail Port:" . $mail_port);
//tradeLogMMNewLevel("mm_new_level-254");

$query = "SELECT * FROM usercompany;";
//tradelog("forgetpassword.php-39:".$query);
$result = $DB->query($query);
while ($row = $DB->fetch_array($result)) {
	$urlcompany = $row['appurl'];
	$companys = $row;
}
$userpass1 = "resendemail";
$tools = new CTools();
$accountkey = "a=1&email=" . $email . "&postmode=approveuser&password=$userpass1";
$linezip = gzcompress($accountkey);
//tradelog("forgetpassword.php-129:".$accountkey.";LineZip:".$linezip.";Crypt:".$crypt_key);
$key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));

$timenya = date('Y-m-d H:i', strtotime('-1 hour'));
$urlnya = $urlcompany . "/".$companys['version']."/openaccount3_approval.php?key=" . $key;
$subject = "Thank you for your registration in ".$companys['programname']." ";
//$body = "Time: " . date('Y-m-d H:i') . "<br>";
$body = "Dear Sir / Madam,<br>";
$body = $body . " <br>";
$body = $body . " <br>";
$body = $body . "We have received an application on our ".$companys['programname']." via this email: $email, in order to confirm your application, please click or copy the link <br>";
$body = $body . " <br>";
$body = $body . "<a href=$urlnya>$urlnya</a>";
$body = $body . " <br> <br>";
$body = $body . "Please ignore this email if you did not apply for it <br>";
$body = $body . " <br>";
$body = $body . " <br>";
$body = $body . "Thank you," . "<br>";
$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
$body = $body . $companys['long_address'];
$body = $body . " Email : ".$companys['email']." <br>";
$body = $body . " ".$companys['companyurl']." <br>";

$query = "insert into email set
timeupdate = '$timenya',
email_to = '$email',
email_subject = '$subject',
email_body = '$body',
timesend = '1970-01-31 00:00:00'    
";
//tradeLogCompanyConfirm_Admin3("Dash_CompanyConfirm_Admin3-247:".$query);
$DB->query($query);

$themessage = "Approval pengaktifan $email already sent to your Username: " . $email . " email";
//tradelog("mm_new_level-101-Bisa Email");
echo 0;

//tradeLogMMNewLevel("mm_new_level-265");
//echo 0;
//tradeLogMMNewLevel("mm_new_level-249");
//End Send Email


function tradeLog($msg) {
	$fp = fopen("trader.log", "a");
	$logdate = date("Y-m-d H:i:s => ");
	$msg = preg_replace("/\s+/", " ", $msg);
	fwrite($fp, $logdate . $msg . "\n");
	fclose($fp);
	return;
}

?>