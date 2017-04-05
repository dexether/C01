<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
require_once dirname(__FILE__) . '../../classes/apexregent/apexregent.class.php';
$apex = New Apexregent();
$goldsaving_status = $apex->goldsaving_status();
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;
error_reporting(E_ALL);
if(date('d') != 5):
	die('CANNOT RUN THIS BONUS ON THIS DAY');
endif;

if (isset($user)) {
	$user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
	$postmode = $_GET['postmode'];
}

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
/*=============================================
=            Section comment block            =
=============================================*/
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
if ($postmode == "doit") {
	storeToCronLogs('rqb');
	$query = "SELECT
	client_accounts.`accountname`
	FROM
	client_accounts,
	client_aecode
	WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
	AND client_accounts.`suspend` = '0'
	AND client_accounts.accountname != 'COMPANY'
	";
	$result = $DB->execresultset($query);
	foreach($result as $rows) {
		$accounts = $rows['accountname'];
		$hasil = $apex->family_tree($accounts)->countRQB($accounts);
		if($hasil):
			$tglbln = date('Y-m', time());
			if ($goldsaving_status == true) {
				$iden = getIdentitas($accounts);
				storeToWallet($accounts, $hasil);
				bonusLogs($accounts, 'rqb', $hasil, 'This bonus will be split into two type Account (70% goes to E-Wallet / 30% goes to Gold Saving Account) ');
				$to = $iden['email'];
				$subject = "Congratulations, you have got a bonus";
				$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
				$body = $body . "Dear ".$iden['name'].",<br>";
				$body = $body . " <br>";
				$body = $body . "Congratulations, you have earned <b>RANK QUALIFICATION BONUS (R.Q.B)</b> bonus of USD ".number_format($hasil, 2)." <br>";
				$body = $body . "This bonus will be split into two type Account (70% goes to E-Wallet / 30% goes to Gold Saving Account) <br>";
				$body = $body . " <br>";
				$body = $body . "You may login to your APR program account via our website at ".$companys['companyurl']." <br>";
				$body = $body . " <br>";
				$body = $body . " <br>";
				$body = $body . "Thank you,<br>";
				$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
				$body = $body . $companys['long_address'];
				$body = $body . " Email : ".$companys['email']." <br>";
				$body = $body . " ".$companys['companyurl']." <br>";
				sendEmail($to, $subject, $body, 'ar_admin_rqb');
			}else{
				$iden = getIdentitas($accounts);
				storeToWallet($accounts, $hasil);
				bonusLogs($accounts, 'rqb', $hasil, 'You got <b>RANK QUALIFICATION BONUS (R.Q.B)</b> Amounted USD ' . number_format($hasil , 2));
				$to = $iden['email'];
				$subject = "Congratulations, you have got a bonus";
				$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
				$body = $body . "Dear ".$iden['name'].",<br>";
				$body = $body . " <br>";
				$body = $body . "Congratulations, you have earned <b>RANK QUALIFICATION BONUS (R.Q.B)</b> bonus of USD ".number_format($hasil, 2)." <br>";
				$body = $body . " <br>";
				$body = $body . "You may login to your APR program account via our website at ".$companys['companyurl']." <br>";
				$body = $body . " <br>";
				$body = $body . " <br>";
				$body = $body . "Thank you,<br>";
				$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
				$body = $body . $companys['long_address'];
				$body = $body . " Email : ".$companys['email']." <br>";
				$body = $body . " ".$companys['companyurl']." <br>";
				sendEmail($to, $subject, $body, 'ar_admin_rqb');
			}
		endif;
	}
}
/*=====  End of Section comment block  ======*/


function myfilter($input_var_outer, $param) {
	global $var_to_pass;
	$var_to_pass = $param;

	function mycallback($input_var_inner) {
		global $var_to_pass;
		return ($input_var_inner == $var_to_pass) ? true : false;
	}

	$return_arr = array_filter($input_var_outer, 'mycallback');
	$return_arr = array_merge(array(), $return_arr);
	return $return_arr;
}

function TradeLogUnderConstruct_Secure($msg) {
	$fp = fopen("trader.log", "a");
	$logdate = date("Y-m-d H:i:s => ");
	$msg = preg_replace("/\s+/", " ", $msg);
	fwrite($fp, $logdate . $msg . "\n");
	fclose($fp);
	return;
}

function bonusLogs($account, $type, $amount, $comment) {
	global $DB;
	$query = "INSERT INTO mlm_bonus_logs SET account = '$account', bonus_type = '$type', amount = '$amount', comment = '$comment', date_receipt = NOW()";
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

function hitungrqb($account) {
		$layak = "no";
		global $DB;
		$hasil = hitungSalesGroup($account);
		var_dump($hasil);
		die();
		$hitung = count($result);
		if ($hitung >= 3) {
			$gv_upline = $result[0]['amount'];
			$layak = "yes";
			$gvl_down = 0;
			foreach($result as $key => $rows) {
				$max_gv[$rows['ACCNO']] = $rows['amount'];
				$gvl_down = $gvl_down + $rows['amount'];
				$total_gv = @$total_gv + $rows['amount'];
			}
			// var_dump($gvl_down);
			$maxs = array_keys($max_gv, max($max_gv));
			$maxs_final = $maxs[0];
			$gvl['account'] = $maxs_final;
			$gvl['gvl'] = $gv_upline + $gvl_down;
			$query = "SELECT
            *,
			(amount * (ql/100)) AS total
			FROM
			mlm_rqb_settings
			WHERE mlm_rqb_settings.`amount` < '$total_gv'
			ORDER BY mlm_rqb_settings.`amount` DESC
			LIMIT 0, 1 ";
			$result = $DB->execresultset($query);
			foreach($result as $rows) {
				$gvl['topay'] = $rows;
			}
			if (count($result) == 0) {
				$gvl['topay']['amount'] = 1000.0000;
				$gvl['topay']['ql'] = 3;
				$gvl['topay']['total'] = $gvl['topay']['amount'] * (3/100);
			}
		}
	// }
	$gvl['layak'] = $layak;
	return $gvl;
}
$arrayOfAccount = [];
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
  //   // tradeLogConstruct("ar_admin_wcd- 94 : ". $query);
	// $DB->execonly($query);

	return 0;
}
function storeToCronLogs($module) {
	global $DB;
	$query = "UPDATE mlm_cron SET last_run = NOW() WHERE module = '$module'";
	$DB->execonly($query);
}
/*
$data = array_reduce($data, function ($a, $b) {
    return @$a['Total'] > $b['Total'] ? $a : $b;
});

print_r($data);*/

?>
