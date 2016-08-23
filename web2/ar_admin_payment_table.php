<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;
$query = "";
//tradeLogConstruct("UnderConstruct.php-Line-9");
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);
if (isset($_SESSION['q'])) {
	$query = $_SESSION['q'];
}else{
	$_SESSION['q'] = "";
}
$date = "";
$filter_date = "";
if (isset($_POST['date'])) {
	$date = $_POST['date'];
	$bagi = explode(" - ", $date);
	$date1 = $bagi[0];
	$date2 = $bagi[1];
	$filter_date = "AND TxnDate BETWEEN ('".$date1."') AND ('".$date2."')";
}

$type = "";
$filter_type = "";
if (isset($_POST['type'])) {
	$type = $_POST['type'];
	if($type != ""){
		$filter_type = "AND PayMethod = '".$type."'";
	}else{
		$filter_type = "";
	}
}
$IDPay = "";
if (isset($_POST['IDPay'])) {
	$IDPay = $_POST['IDPay'];

}
$amountnya = "";
if (isset($_POST['amount'])) {
	$amountnya = $_POST['amount'];
	$amountnya = str_replace( ',', '', $amountnya );
}
$status = "";
if (isset($_POST['status'])) {
	$status = $_POST['status'];

	if($status != ""){
		$filter_status = "AND Status = '".$status."'";;
	}else{
		$filter_status = "";
	}
}
$postmode = "no";
if (isset($_POST['postmode'])) {
	$postmode = $_POST['postmode'];
}
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
if($postmode == 'yes') {
	// Money Come To Walet and GOLD SAVING
	$query = "UPDATE mlm_payment SET status = '$status', Amount = '$amountnya', date_confirm = NOW() WHERE IDPay = '$IDPay' ";
	$DB->execonly($query);
	if($status == '2') {
		$query = "SELECT aecode, Account, PayType, Amount FROM mlm_payment WHERE IDPay = '$IDPay'";
		$result = $DB->execresultset($query);
		foreach($result as $row) {
			$amount = $row['Amount'];
			$accnya = $row['Account'];
			$type = $row['PayType'];
		}
		
		if ($type == 'Club Package') {

			$query = "INSERT INTO apex_balance SET apex_balance.from = '$accnya', apex_balance.amount = '$amount', datetime = NOW(), fromuser = '$user->username'";
			$DB->execonly($query);


			/**
			 * Untuk Bonus WRB
			 * Jadi dapetin bonus dari peresentasenya langsung masuk ke Ewallet dan gold saving account
			 */
			
			$query = "SELECT 
			ACCNO,  
			mlm_bonus_settings.`description`,
			client_aecode.`name`,
			client_aecode.`email`,
			mlm_bonus_settings.`wrb` 
			FROM
			mlm,
			client_aecode,
			client_accounts,
			mlm_bonus_settings 
			WHERE ACCNO = 
			(SELECT 
			upline 
			FROM
			mlm 
			WHERE ACCNO = '$accnya') 
			AND mlm.`group_play` = mlm_bonus_settings.`group_play` 
			AND mlm.`ACCNO` = client_accounts.`accountname` 
			AND client_accounts.`aecodeid` = client_aecode.`aecodeid`";
			$result_upline = $DB->execresultset($query); 
			// tradeLogConstruct("ar_admin_payment_table - 124 : ". $query);
			foreach($result_upline as $r) {
				$account_upline = $r['ACCNO'];
				$desc_upline = $r['description'];
				$name_upline = $r['name'];
				$email_upline = $r['email'];
				$wrb_upline = $r['wrb'];
			}


			/**
			 *
			 * ini untuk bonus wr
			 *
			 */
			
			cekwcb($account_upline, $accnya);

			// Change Company Confirm
			$query = "UPDATE mlm SET companyconfirm = '2', payment= '2' WHERE ACCNO = '$accnya'";
			$DB->execonly($query);

			$subject = "Company get income from account ".$accnya;
			$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
			$body = $body . "Dear ".$companys['companyname'].",<br>";
			$body = $body . " <br>";
			$body = $body . "Company get income from account : ".$accnya." For Club Package of USD ".number_format($amount,2)."<br>";
			$body = $body . " <br>";
			$body = $body . "You may login to your APR program account via our website at http://www.apexregent.com <br>";
			$body = $body . " <br>";
			$body = $body . " <br>";
			$body = $body . "Thank you," . "<br>";
			$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
			$body = $body . $companys['long_address'];
			$body = $body . " Email : ".$companys['email']." <br>";
			$body = $body . " ".$companys['companyurl']." <br>";
			sendEmail($companys['admin_email'], $subject, $body, 'ar_admin_payment_table');




			// Upline bonus
			$tglskrng = date('Y-m-d');
			$new_tgl = date('Y-m-d', strtotime("+1 week", strtotime($tglskrng)));
			$query = "UPDATE mlm_wcd SET next_pay = '$new_tgl', status = '1' WHERE account = '$accnya'";
			$DB->execonly($query);
			$bonuswrb = storeToWalletWrb($account_upline, $amount, $wrb_upline);
			bonusLogs($account_upline, $accnya, 'wrb', $bonuswrb, 'you got WEALTH REFERRAL BONUS from '.$accnya.'This bonus will be split into two type Account (6% goes to E-Wallet / 1% goes to Gold Saving Account)');
			$subject = "Congratulations, you have got a bonus";
			$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
			$body = $body . "Dear ".$name_upline.",<br>";
			$body = $body . " <br>";
			$body = $body . "Congratulations, you have earned <b>WEALTH REFERRAL BONUS (W.R.B)</b> bonus of USD ".number_format($bonuswrb, 2)." from your Downline : ".$accnya." <br>";
			$body = $body . "This bonus will be split into two type Account (6% goes to E-Wallet / 1% goes to Gold Saving Account) <br>";
			$body = $body . " <br>";
			$body = $body . "You may login to your APR program account via our website at http://www.apexregent.com <br>";
			$body = $body . " <br>";
			$body = $body . " <br>";
			$body = $body . "Thank you," . "<br>";
			$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
			$body = $body . $companys['long_address'];
			$body = $body . " Email : ".$companys['email']." <br>";
			$body = $body . " ".$companys['companyurl']." <br>";
			sendEmail($email_upline, $subject, $body, 'ar_admin_payment_table');

		}
		if ($type == 'Wealth Pool') {
			$query = "INSERT INTO apex_balance SET apex_balance.from = '$accnya', apex_balance.amount = '$amount', datetime = NOW(), fromuser = '$user->username'";
			$DB->execonly($query);
			$subject = "Company get income from account ".$accnya;
			$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
			$body = $body . "Dear ".$companys['companyname'].",<br>";
			$body = $body . " <br>";
			$body = $body . "Company get income from account : ".$accnya." For WEALTH POOL PIER of USD ".number_format($amount,2)."<br>";
			$body = $body . " <br>";
			$body = $body . "You may login to your APR program account via our website at http://www.apexregent.com <br>";
			$body = $body . " <br>";
			$body = $body . " <br>";
			$body = $body . "Thank you," . "<br>";
			$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
			$body = $body . $companys['long_address'];
			$body = $body . " Email : ".$companys['email']." <br>";
			$body = $body . " ".$companys['companyurl']." <br>";
			sendEmail($companys['admin_email'], $subject, $body, 'ar_admin_payment_table');

			$query = "SELECT PayFor FROM mlm_payment WHERE IDPay = '$IDPay'";
			$result = $DB->execresultset($query);
			// var_dump($result);
			$arisanaccount = explode( ":", $result[0]['PayFor']);
			// var_dump($arisanaccount);
			$arisan_account = $arisanaccount[1];
			$query = "UPDATE mlm_arisan_account SET payment = '2' WHERE arisan_account = '$arisan_account'";
			$DB->execonly($query);
			$query = "SELECT 
			  mlm.`ACCNO`,
			  mlm.group_play,
			  mlm_arisan_block.`id`
			FROM
			  mlm,
			  mlm_arisan_block 
			WHERE mlm.`group_play` = mlm_arisan_block.`group_play` 
			  AND mlm.`ACCNO` = '$accnya' 
			  AND mlm_arisan_block.`board` LIKE '%1'";
			$result = $DB->execresultset($query);
			foreach($result as $row){
				$id_block = $row['id'];
			}
			$query = "INSERT INTO mlm_arisan SET id_block = '$id_block', arisan_account = '$arisan_account'";
			// var_dump($query);
			$DB->execonly($query);

		}
		$query = "SELECT 
		client_aecode.`email`,
		client_aecode.name
		FROM
		client_accounts,
		client_aecode 
		WHERE client_accounts.`accountname` = '$accnya' 
		AND client_accounts.`aecodeid` = client_aecode.`aecodeid`";
		$result = $DB->execresultset($query);

		foreach ($result as $rows) {
			$usernya = $rows;
		}
	 	// Send Email
		$timenya = date('Y-m-d H:i', strtotime('-1 hour'));
		$subject = "Your payment has been confirmed";
		$body = "Time: " . $timenya . "<br> <br>";
		$body = $body . "Dear  $usernya[name],<br>";
		$body = $body . " <br>";
		$body = $body . "We have confirmed your payment for Account $accnya ($type) <br>";
		$body = $body . " <br>";
		$body = $body . "Thank you," . "<br>";
		$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
			$body = $body . $companys['long_address'];
			$body = $body . " Email : ".$companys['email']." <br>";
			$body = $body . " ".$companys['companyurl']." <br>";
			

		$query = "insert into email set
		timeupdate = '$timenya',
		email_to = '$usernya[email]',
		email_subject = '$subject',
		email_body = '$body',
		timesend = '1970-01-31 00:00:00',
		module = 'ar_admin_payment_table'
		";
		$DB->execonly($query);
	}
	
}
$query = $_SESSION['q'];
if ($postmode == 'querys') {
	$query = "SELECT * FROM mlm_payment WHERE 1=1 $filter_date $filter_type $filter_status";
	$_SESSION['q'] = $query;	
}

$template->assign("q", $query);
$datapayments3 = $DB->execresultset($query);
$template->assign("datapayments3", $datapayments3);
$template->display("ar_admin_payment_table.htm");
function tradeLogConstruct($msg) {
	$fp = fopen("trader.log", "a");
	$logdate = date("Y-m-d H:i:s => ");
	$msg = preg_replace("/\s+/", " ", $msg);
	fwrite($fp, $logdate . $msg . "\n");
	fclose($fp);
	return;
}
function bonusLogs($account, $from = 0, $type, $amount, $comment) {
	global $DB;
	$query = "INSERT INTO mlm_bonus_logs SET account = '$account', mlm_bonus_logs.from = '$from', bonus_type = '$type', amount = '$amount', comment = '$comment', date_receipt = NOW()";
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
function storeToWalletWrb($account, $amount, $wrb) {
	// tradeLogConstruct("ar_admin_payment_table- 218 : ". $account . " " . $amount . " " . $wrb);
	global $DB;
	$pecah = explode('-', $wrb);
	$wallet_wrb = @($pecah[0] / 100);
	$gold_wrb = @($pecah[1] / 100);
	$wallet = $amount * $wallet_wrb;
	$GoldSaving = $amount * $gold_wrb;
	$bonus = $pecah[0] + $pecah[1];
	$bonus_all = $amount * ($bonus / 100);
	// tradeLogConstruct("ar_admin_payment_table- 226 : ". $wallet_wrb . " " . $gold_wrb);

	$balancealls = getBalance($account);

	// tradeLogConstruct("ar_admin_payment_table- 230 : ". print_r($balancealls));
	
	$wallet_final = $balancealls['ewallet']['balance'] + $wallet;
	$GoldSaving_final = $balancealls['goldsaving']['balance'] + $GoldSaving;
	
	// tradeLogConstruct("ar_admin_payment_table- 235 : ". $wallet_final . " " . $GoldSaving_final);

	$balance_prev_wallet = $balancealls['ewallet']['balance'];
	$prev_time_wallet = $balancealls['ewallet']['time'];

	// tradeLogConstruct("ar_admin_payment_table- 240 : ". $balance_prev_wallet . " " . $prev_time_wallet);

	$balance_prev_gold = $balancealls['goldsaving']['balance'];
	$prev_time_gold = $balancealls['goldsaving']['time'];
	// Store to wallet
	$query = "UPDATE mlm_ewallet SET balance = '$wallet_final', balance_prev = '$balance_prev_wallet', lastupdate = NOW(), lastupdate_prev = '$prev_time_wallet' WHERE account = '$account' ";
	$DB->execonly($query);

	$query = "UPDATE mlm_goldsaving SET balance = '$GoldSaving_final', balance_prev = '$balance_prev_gold', lastupdate = NOW(), lastupdate_prev = '$prev_time_gold' WHERE account = '$account' ";
	// tradeLogConstruct("ar_admin_payment_table- 94 : ". $wallet_final . " " . $GoldSaving_final);
	$DB->execonly($query);

	return $bonus_all;
	// tradeLogConstruct("ar_admin_payment_table- 273 : ". $bonus_all);
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
function cekwcb($upline, $account) {
	global $DB;
	$query = "SELECT 
	mlm_wcb.`registered` 
	FROM
	mlm_wcb 
	WHERE mlm_wcb.`account` = '$upline' 
	AND mlm_wcb.`payment` = 0 
	AND LENGTH(TRIM(BOTH ';' FROM registered)) - LENGTH(
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
?>
