<?php
$skip_authentication = 1;
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;


//tradeLogConstruct("UnderConstruct.php-Line-9");

/*$_SESSION['page'] = 'underconstruct';
$template->display("underconstruct.htm");*/

$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
$postmode = "no";
if (isset($_POST['postmode'])) {
	$postmode = $_POST['postmode'];
}
if (isset($_GET['postmode'])) {
	$postmode = $_GET['postmode'];
}
if ($postmode == "export") {
	
	$query = "SELECT 
	client_accounts.`accountname`,
	LEFT(client_accounts.`last_updated`, 10) AS last_pay
	FROM
	client_accounts
	WHERE accountname <> 'COMPANY'
	AND client_accounts.`suspend` = '0'
	";
	$result = $DB->execresultset($query);
	foreach($result as $rows){
		$query = "SELECT id FROM mlm_wcd WHERE account = '$rows[accountname]' ";
		$result2 = $DB->execresultset($query);
		if (count($result2) == 0) {
			$new_tgl = date('Y-m-d', strtotime("+1 week", strtotime($rows['last_pay'])));
			$query = "INSERT INTO mlm_wcd SET account = '$rows[accountname]', last_pay ='$rows[last_pay]', next_pay = '$new_tgl'";
			$DB->execonly($query);
		}
	}

}elseif ($postmode == "doit") {
	storeToCronLogs('wcd');
	$query = "SELECT 
	mlm_wcd.`account`,
	mlm_wcd.`last_pay`,
	mlm_wcd.`next_pay`,
	mlm_wcd.`status`,
	mlm_bonus_settings.`group_play`,
	mlm_bonus_settings.`amount`,
	mlm_bonus_settings.`description`,
	mlm_bonus_settings.`wcd` 
	FROM
	client_aecode,
	client_accounts,
	mlm_wcd,
	mlm,
	mlm_bonus_settings 
	WHERE mlm_wcd.status = '1' 
	AND mlm_wcd.`account` = mlm.`ACCNO` 
	AND client_aecode.aecodeid = client_accounts.aecodeid
	AND client_accounts.`suspend` = '0'
	AND mlm_wcd.account = client_accounts.`accountname` 
	AND mlm.`group_play` = mlm_bonus_settings.`group_play` 
	AND mlm.`companyconfirm` = '2' 
	AND mlm_wcd.`next_pay` = DATE(NOW())";
	// tradeLogConstruct("ar_admin_wcd- 75 : ". $query);
	$result = $DB->execresultset($query);
	foreach($result as $rows) {
	/*	$balancealls = getBalance($rows['account']);
	$total = $balancealls['ewallet']['balance'] + $balancealls['goldsaving']['balance'];*/
	$total = $rows['amount'];
	$total_bagi = $total * ($rows['wcd'] / 100);
	$do = storeToWallet($rows['account'], $total_bagi);
	if($do == 0) {
		$new_tgl = date('Y-m-d', strtotime("+1 week", strtotime($rows['next_pay'])));
		$query = "UPDATE mlm_wcd SET next_pay = '$new_tgl', last_pay = '$rows[next_pay]' WHERE account = '$rows[account]' ";
		$DB->execonly($query);
		bonusLogs($rows['account'], 'wcd' , $total_bagi , 'This bonus split 70% Into E-Wallet and 30% into Gold Saving account');

			// Send email
		$query = "SELECT 
		client_aecode.`aecodeid`,
		client_accounts.`accountname`,
		client_aecode.`email`,
		client_aecode.`name`
		FROM
		client_accounts,
		client_aecode 
		WHERE client_accounts.`accountname` = '$rows[account]'
		AND client_accounts.`aecodeid` = client_aecode.`aecodeid`";
		$hasil = $DB->execresultset($query);
		$subject = "Congratulations, you have got a bonus";
		$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
		$body = $body . "Dear ".$hasil[0]['name'].",<br>";
		$body = $body . " <br>";
		$body = $body . "Congratulations, you have earned on Account ".$rows['account']." <b>WEALTH CLUB DIVIDEND (W.C.D)</b> bonus of USD ".number_format($total_bagi, 2)." <br>";
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

		sendEmail($hasil[0]['email'], $subject, $body , 'ar_admin_wcd');
	}	
}
}
/*

Tinggal Dibiki log untuk Bonus nya ya

 */

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
	$wallet = $amount * 0.7;
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

	$query = "UPDATE mlm_goldsaving SET balance = '$GoldSaving_final', balance_prev = '$balance_prev_gold', lastupdate = NOW(), lastupdate_prev = '$prev_time_gold' WHERE account = '$account' ";
	// tradeLogConstruct("ar_admin_wcd- 94 : ". $query);
	$DB->execonly($query);

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





?>