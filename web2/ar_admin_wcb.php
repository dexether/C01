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
if(date('d') != 5):
	die('CANNOT RUN THIS BONUS ON THIS DAY');
endif;
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
						  accountname
						FROM
						  client_accounts
						WHERE client_accounts.`suspend` = '0'";
	$hasil = $DB->execresultset($query);
	foreach ($hasil as $key => $value) {
		$query = "SELECT * FROM mlm WHERE mlm.`Upline` = '$value[accountname]' AND
		mlm.companyconfirm = '2' AND
							  (SELECT
							    client_accounts.`suspend`
							  FROM
							    client_accounts
							  WHERE accountname = mlm.`ACCNO`) = '0'
							  AND mlm.`ACCNO` NOT IN
							  (SELECT
							    mlm_wcb.`account_downline`
							  FROM
							    mlm_wcb)";
		$resultDownline = $DB->execresultset($query);
		foreach ($resultDownline as $keyDownline => $valueDownlien) {
			$query = "INSERT INTO mlm_wcb SET account = '$valueDownlien[Upline]', account_downline = '$valueDownlien[ACCNO]', is_pay = FALSE, created_at = NOW()";
			$DB->execonly($query);
		}
	}

	$query = "SELECT
	  mlm_wcb.*,
	  mlm.`group_play`,
		mlm_bonus_settings.amount,
		mlm_bonus_settings.wcb
	FROM
	  mlm_wcb
	  LEFT JOIN mlm ON mlm.`ACCNO` = mlm_wcb.`account_downline`
		LEFT JOIN mlm_bonus_settings ON mlm_bonus_settings.group_play = mlm.group_play
	WHERE mlm_wcb.`is_pay` = FALSE";
	$hasil = $DB->execresultset($query);
	foreach ($hasil as $key => $value) {
		$results[$value['account']][$value['group_play']][] = $value;
	}

	foreach ($results as $key2 => $row) {
		foreach ($row as $key3 => $row3) {
			if(count($row3) >= 3)
				runWCB($row3);
		}
	}
}

function runWCB($row){
	global $DB;
	$totalwcb = 0;
	for ($i=0; $i < 3; $i++) {
		$data = $row[$i];
		$account = $data['account'];
		$balance = getBalance($data['account']);
		var_dump($data);
		$totalwcb = $totalwcb + $data['amount'];
		$pengali = $data['wcb'];

		$queryUpdate = "UPDATE mlm_wcb SET is_pay = TRUE, pay_at = NOW() WHERE id = '$data[id]'";
		$DB->execonly($queryUpdate);
	}
	$bonusWCB = $totalwcb * $pengali / 100;
	storeToWallet($account, $bonusWCB);
	bonusLogs($account, 'wcb', $bonusWCB, 'WEALTH CLUB BONUS (W.C.B) bonus of USD '.number_format($bonusWCB, 2));
	WCBEmailSend($account, $bonusWCB);
}
function WCBEmailSend($account, $total_bonus){
	global $DB;
	$query = "SELECT * FROM usercompany LIMIT 1";
	$hasil = $DB->execresultset($query);
	foreach ($hasil as $key => $value) {
		$companys = $value;
	}
	$iden = getIdentitas($account);
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

	return true;
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
