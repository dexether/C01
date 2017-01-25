<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;
global $DB;
require_once dirname(__FILE__) . '../../classes/apexregent/apexregent.class.php';
$apex = New Apexregent();
$goldsaving_status = $apex->goldsaving_status();
//tradeLogConstruct("UnderConstruct.php-Line-9");
/*
$_SESSION['page'] = 'underconstruct';
$template->display("underconstruct.htm");*/
$postmode = "";
if (isset($_POST['postmode'])) {
	$postmode = $_POST['postmode'];
}
if (isset($_GET['postmode'])) {
	$postmode = $_GET['postmode'];
}
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
if($postmode == "doit") {
	storeToCronLogs('wcb');
	$query = "SELECT
	mlm_wcb.`account`,
	mlm_wcb.`id`,
	mlm_wcb.`registered`,
	mlm_bonus_settings.`wcb`
	FROM
	mlm_wcb,
	mlm,
	client_accounts,
	mlm_bonus_settings,
	mlm_payment
	WHERE mlm_wcb.`payment` = 0
	AND mlm.ACCNO = client_accounts.accountname
	AND mlm_wcb.`account` = mlm.`ACCNO`
	AND client_accounts.suspend = false
	AND mlm.`group_play` = mlm_bonus_settings.`group_play`
	AND mlm.`ACCNO` = mlm_payment.`Account`
	AND mlm_payment.`Status` = '2'
	AND LENGTH(TRIM(BOTH ';' FROM registered)) - LENGTH(
		REPLACE(
			TRIM(BOTH ';' FROM registered),
			';',
			''
			)
	) + 1 = 4";
	$result = $DB->execresultset($query);


	// Check IF PV
	// foreach($result as $a){
	// 	$downline1 = explode(';', $a['registered']);
	// 	foreach($)
	// }

	foreach ($result as $key => $rows) {
		$aidi = $rows['id'];
		$downline1 = explode(';', $rows['registered']);
		$reg = $rows['registered'];
		$account = $rows['account'];
		$wcb = $rows['wcb'];
		$pecah = str_replace(';', ',', $reg);

			$query = "SELECT
			mlm.`ACCNO`,
			mlm_bonus_settings.`description`,
			mlm_bonus_settings.`amount`,
			SUM(mlm_bonus_settings.`amount`) AS total
			FROM
			mlm,
			mlm_bonus_settings
			WHERE mlm.`ACCNO` IN ($pecah)
			AND mlm.`group_play` = mlm_bonus_settings.`group_play`";
			$result_total = $DB->execresultset($query);

			$total_bonus = (double) $result_total[0]['total'] * ($wcb / 100);
			/*var_dump($total_bonus);
			var_dump($result_total[0]['total']);*/
			// Store to wallets
			if ($goldsaving_status == true) {
				storeToWallet($account, $total_bonus);
				// Store To Logs
				bonusLogs($account, 'wcb', $total_bonus, 'This bonus split 70% Into E-Wallet and 30% into Gold Saving account');
				// Get Indentitas
				$iden = getIdentitas($account);
				// Send Email
				$subject = "Congratulations, you have got a bonus";
				$to = $iden['email'];
				$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
				$body = $body . "Dear ".$iden['name'].",<br>";
				$body = $body . " <br>";
				$body = $body . "Congratulations, you have earned <b>WEALTH CLUB BONUS (W.C.B)</b> bonus of USD ".number_format($total_bonus, 2)." <br>";
				$body = $body . "This bonus will be split into two type Account (70% goes to E-Wallet / 30% goes to Gold Saving Account) <br>";
				$body = $body . " <br>";
				$body = $body . "You may login to your APR program account via our website at http://www.apexregent.com <br>";
				$body = $body . " <br>";
				$body = $body . " <br>";
				$body = $body . "Thank you," . "<br>";
				$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
				$body = $body . $companys['long_address'];
				$body = $body . " Email : ".$companys['email']." <br>";
				$body = $body . " ".$companys['companyurl']." <br>";

				sendEmail($to, $subject, $body , 'ar_admin_wcb');
				// Update status
				$query = "UPDATE mlm_wcb SET payment = '2', amount = '$total_bonus', PayDate = NOW() WHERE id = '$aidi'";
				$DB->execonly($query);
			}else{
				storeToWallet($account, $total_bonus);
				// Store To Logs
				bonusLogs($account, 'wcb', $total_bonus, '<b>WEALTH CLUB BONUS (W.C.B)</b> bonus of USD '.number_format($total_bonus, 2));
				// Get Indentitas
				$iden = getIdentitas($account);
				// Send Email
				$subject = "Congratulations, you have got a bonus";
				$to = $iden['email'];
				$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
				$body = $body . "Dear ".$iden['name'].",<br>";
				$body = $body . " <br>";
				$body = $body . "Congratulations, you have earned <b>WEALTH CLUB BONUS (W.C.B)</b> bonus of USD ".number_format($total_bonus, 2)." <br>";
				$body = $body . " <br>";
				$body = $body . "You may login to your APR program account via our website at http://www.apexregent.com <br>";
				$body = $body . " <br>";
				$body = $body . " <br>";
				$body = $body . "Thank you," . "<br>";
				$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
				$body = $body . $companys['long_address'];
				$body = $body . " Email : ".$companys['email']." <br>";
				$body = $body . " ".$companys['companyurl']." <br>";
				sendEmail($to, $subject, $body , 'ar_admin_wcb');
				// Update status
				$query = "UPDATE mlm_wcb SET payment = '2', amount = '$total_bonus', PayDate = NOW() WHERE id = '$aidi'";
				$DB->execonly($query);
			}

	}
}

function cekwcb($upline, $account) {
	global $DB;
	$query = "SELECT
	mlm_wcb.`registered`
	FROM
	mlm_wcb
	WHERE mlm_wcb.`account` = '$upline'
	AND mlm_wcb.`payment` = 0
	AND LENGTH(TRIM(BOTH ';' FROM regis
		tered)) - LENGTH(
REPLACE(
	TRIM(BOTH ';' FROM registered),
	';',
	''
	)
) + 1 < 4";
$result = $DB->execresultset($query);
if (count($result) >= 1) {
	$delimiter = $result[0]['registered'];
	$pecah = explode(";", $delimiter);
	array_push($pecah, $account);
	$hasil = implode(';', $pecah);
	$query = "UPDATE mlm_wcb SET registered = '$hasil' WHERE account = '$upline' ";
	$DB->execonly($query);
}else{
	$query = "INSERT INTO mlm_wcb SET account = '$upline', registered = '0;$account', payment = '0'";
	$DB->execonly($query);
}
}

function bonusLogs($account, $type, $amount, $comment) {
	global $DB;
	$query = "INSERT INTO mlm_bonus_logs SET account = '$account', bonus_type = '$type', amount = '$amount', comment = '$comment', date_receipt = NOW()";
	$DB->execonly($query);
}

function getBalance($account) {
	global $DB;
	$query = "SELECT balance, lastupdate FROM mlm_ewallet WHERE account = '$account' ";
	$result = $DB->execresultset($query);
	$balance_wallet = $result[0]['balance'];
	$time_prev_wallet = $result[0]['lastupdate'];

			// Insert Ke GoldSaving
	$query = "SELECT balance, lastupdate FROM mlm_goldsaving WHERE account = '$account' ";
	$result = $DB->execresultset($query);
	$balance_gold = $result[0]['balance'];
	$time_prev_gold = $result[0]['lastupdate'];

	$array = array(
		"ewallet" => array('balance' => $balance_wallet,'time' => $time_prev_wallet),
		"goldsaving" => array('balance' => $balance_gold,'time' => $time_prev_gold)
		);
	return $array;
}

function storeToWallet($account, $amount) {
	global $DB;
	$wallet = $amount;
	$GoldSaving = $amount * 0.3;
	$balancealls = getBalance($account);
	$wallet_final = $balancealls['ewallet']['balance'] + $wallet;
	$GoldSaving_final = $balancealls['goldsaving']['balance'] + $GoldSaving;
	// tradeLogConstruct("ar_admin_wcd- 94 : ". $wallet_final . " " . $GoldSaving_final);
	$balance_prev_wallet = $balancealls['ewallet']['balance'];
	$prev_time_wallet = $balancealls['ewallet']['time'];

	$balance_prev_gold = $balancealls['goldsaving']['balance'];
	$prev_time_gold = $balancealls['goldsaving']['time'];
	// Store to wallet
	$query = "UPDATE mlm_ewallet SET balance = '$wallet_final', balance_prev = '$balance_prev_wallet', lastupdate = NOW(), lastupdate_prev = '$prev_time_wallet' WHERE account = '$account' ";
	// tradeLogConstruct("ar_admin_wcd- 94 : ". $query);
	$DB->execonly($query);

	// $query = "UPDATE mlm_goldsaving SET balance = '$GoldSaving_final', balance_prev = '$balance_prev_gold', lastupdate = NOW(), lastupdate_prev = '$prev_time_gold' WHERE account = '$account' ";
	// // tradeLogConstruct("ar_admin_wcd- 94 : ". $query);
	// $DB->execonly($query);

	return 0;
}

function tradeLogConstruct($msg) {
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
function storeToCronLogs($module) {
	global $DB;
	$query = "UPDATE mlm_cron SET last_run = NOW() WHERE module = '$module'";
	$DB->execonly($query);
}

function getIdentitas($account) {
	global $DB;
	$query = "SELECT
	client_accounts.`accountname`,
	client_aecode.`email`,
	client_aecode.`name`
	FROM
	client_accounts,
	client_aecode
	WHERE client_accounts.`accountname` = '$account'
	AND client_aecode.`aecodeid` = client_accounts.`aecodeid`";
	$result = $DB->execresultset($query);
	foreach($result as $rows) {
		$datas = $rows;
	}
	return $datas;
}
?>
