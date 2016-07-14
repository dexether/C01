<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;


//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
	$postmode = $_GET['postmode'];
}


/*====================================
=            Start Coding            =
====================================*/

if ($postmode=="yes") {
	$query = "SELECT * FROM usercompany";
	$result = $DB->execresultset($query);
	foreach($result as $rows){
		$companys = $rows;
	}
	$query = "SELECT 
	client_accounts.`accountname`,
	client_aecode.`aecodeid`,
	client_aecode.`name`,
	client_aecode.`email`,
	mlm.`datetime`,
	mlm.`companyconfirm`
	FROM
	client_accounts,
	client_aecode,
	mlm 
	WHERE client_accounts.`accountname` = mlm.`ACCNO` 
	AND client_aecode.`aecodeid` = client_accounts.`aecodeid`
	AND mlm.`companyconfirm` = '0'
	AND client_accounts.`suspend` = '0' 
	AND client_accounts.`accountname` NOT LIKE '9999%'
	AND client_accounts.`accountname` <> 'COMPANY'
	AND mlm.`datetime` <= DATE_SUB(NOW(), INTERVAL 5 DAY)";
	$result = $DB->execresultset($query);
	foreach($result as $rows){
		$account = $rows['accountname'];
		$name = $rows['name'];
		$email = $rows['email'];
		/*$delete = "DELETE FROM client_accounts WHERE accountname = '$account'";
		$DB->execonly($delete);
		$delete = "DELETE FROM mlm WHERE ACCNO = '$account'";
		$DB->execonly($delete);
		$delete = "DELETE FROM mlm_bonus_logs WHERE account = '$account'";
		$DB->execonly($delete);
		$delete = "DELETE FROM mlm_ewallet WHERE account = '$account'";
		$DB->execonly($delete);
		$delete = "DELETE FROM mlm_goldsaving WHERE account = '$account'";
		$DB->execonly($delete);
		$delete = "DELETE FROM mlm_payment WHERE account = '$account'";
		$DB->execonly($delete);
		$delete = "DELETE FROM mlm_wcb WHERE account = '$account'";
		$DB->execonly($delete);
		$delete = "DELETE FROM mlm_wcd WHERE account = '$account'";
		$DB->execonly($delete);*/
		$query = "UPDATE client_accounts SET suspend = '1' WHERE accountname = '$accountname'";
		$DB->execonly($query);

		// Send Email

		$subject = "Account closing information";
		$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
		$body = $body . "Dear ".$name.",<br>";
		$body = $body . " <br>";
		$body = $body . "We inform you that your account number ".$account." we have disable, because you have not made any payments as of 5 days after you register your account. <br>";
		$body = $body . "thanks you have participated in our program<br>";
		$body = $body . " <br>";
		$body = $body . " <br>";
		$body = $body . "Thank you,<br>";
		$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
		$body = $body . $companys['long_address'];
		$body = $body . " Email : ".$companys['email']." <br>";
		$body = $body . " ".$companys['companyurl']." <br>";
		sendEmail($email, $subject, $body, 'ar_admin_checkaccount');
	}
}

/*=====  End of Start Coding  ======*/



function TradeLogUnderConstruct_Secure($msg) {
	$fp = fopen("trader.log", "a");
	$logdate = date("Y-m-d H:i:s => ");
	$msg = preg_replace("/\s+/", " ", $msg);
	fwrite($fp, $logdate . $msg . "\n");
	fclose($fp);
	return;
}
function sendEmail($to, $subject, $body, $module) {
	global $DB;
	$timeupdate = date('Y-m-d H:i:s', strtotime('-1 hour'));
	$query = "insert into email set
	timeupdate = '$timeupdate',
	email_to = '$to',
	email_subject = '$subject',
	email_body = '$body',
	timesend = '1970-01-31 00:00:00',
	module = '$module'    
	";
	$DB->execonly($query);
}

?>