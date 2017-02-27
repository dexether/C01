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

if (isset($user)) {
	$user;
}


//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
	$postmode = $_GET['postmode'];
}
$debug = "no";
/*==============================
=            Coding            =
==============================*/
$date = date('Ym', time());
$date2 = date('Y-m', time());
$postmode = "no";
if (isset($_POST['postmode'])) {
	$postmode = $_POST['postmode'];
}
if (isset($_GET['postmode'])) {
	$postmode = $_GET['postmode'];
}
/*$query = "SELECT
mlm.`ACCNO`,
mlm_payment.`Status`,
mlm_bonus_settings.`description`,
mlm_bonus_settings.`lv`,
mlm_bonus_settings.`amount`
FROM
mlm,
mlm_payment,
mlm_bonus_settings
WHERE mlm.`ACCNO` = mlm_payment.`Account`
-- AND mlm.`ACCNO` = '160411102'
AND mlm_payment.`PayFor` = 'PV:$date'
AND mlm_payment.`Status` = '2'
AND mlm.`group_play` = mlm_bonus_settings.`group_play`";*/
if($postmode == "doit"){
	storeToCronLogs('multi');
	$query = "SELECT
	mlm.`ACCNO`,
	mlm_payment.`Status`,
	mlm_bonus_settings.`description`,
	mlm_bonus_settings.`lv`,
	mlm_bonus_settings.`amount` ,
	client_aecode.`email`,
	client_aecode.`name`
	FROM
	mlm,
	client_aecode,
	mlm_payment,
	mlm_bonus_settings
	WHERE mlm.`ACCNO` = mlm_payment.`Account`
	AND mlm_payment.`aecode` = client_aecode.`aecode`
	AND mlm.`ACCNO` NOT IN (SELECT mlm_bonus_logs.`account` FROM mlm_bonus_logs WHERE mlm_bonus_logs.`bonus_type` = 'multi' AND LEFT(date_receipt, 7) = '$date2' )
	AND mlm_payment.`Status` = '2'
	AND mlm.`group_play` = mlm_bonus_settings.`group_play` ";
	$result = $DB->execresultset($query);
	/*var_dump($result);
	echo "-------------------------------------------------------------------";*/
	$total_lv0 = 0;
	$total_lv3_has = 0;
	$total_lv4_has = 0;
	$total_lv5_has = 0;
	$total_lv6_has = 0;
	$total = 0;
	foreach($result as $rows) {
		$account_lv1 = $rows['ACCNO'];
		$account_lv1_email = $rows['email'];
		$account_lv1_name = $rows['name'];
		$lv = $rows['lv'];
		$query = "SELECT
		mlm.`ACCNO`,
		mlm_bonus_settings.`amount`
		FROM
		mlm,
		mlm_payment,
		mlm_bonus_settings
		WHERE mlm.`Upline` = '$account_lv1'
		AND mlm_payment.`Account` = mlm.`ACCNO`
		AND mlm.`group_play` = mlm_bonus_settings.`group_play`
		AND mlm_payment.`PayFor` = 'PV:$date'
		AND mlm_payment.`Status` = '2'  ";
		$total_lv1 = 0;
		$total_lv5_has = 0;
		$result2 = $DB->execresultset($query);
		/*var_dump($result2);
		echo "-------------------------------------------------------------------";*/
		$total_lv2_has = 0;
		$total_lv3_has = 0;
		$total_lv4_has = 0;
		foreach($result2 as $rows2){
			$account_lv2 = $rows2['ACCNO'];
			$total_lv1 = $total_lv1 + $rows2['amount'];
			$query = "SELECT
			mlm.`ACCNO`,
			mlm_bonus_settings.`amount`
			FROM
			mlm,
			mlm_payment,
			mlm_bonus_settings
			WHERE mlm.`Upline` = '$account_lv2'
			AND mlm_payment.`Account` = mlm.`ACCNO`
			AND mlm.`group_play` = mlm_bonus_settings.`group_play`
			AND mlm_payment.`PayFor` = 'PV:$date'
			AND mlm_payment.`Status` = '2'  ";
			$total_lv2 = 0;
			$result3 = $DB->execresultset($query);
			/*var_dump($result3);
			echo "------------------------------------------------------------------";*/

			foreach($result3 as $rows3) {
				$total_lv2 = $total_lv2 + $rows3['amount'];
				$account_lv3 = $rows3['ACCNO'];
				$query = "SELECT
				mlm.`ACCNO`,
				mlm_bonus_settings.`amount`
				FROM
				mlm,
				mlm_payment,
				mlm_bonus_settings
				WHERE mlm.`Upline` = '$account_lv3'
				AND mlm_payment.`Account` = mlm.`ACCNO`
				AND mlm.`group_play` = mlm_bonus_settings.`group_play`
				AND mlm_payment.`PayFor` = 'PV:$date'
				AND mlm_payment.`Status` = '2'  ";
				$result4 = $DB->execresultset($query);
				$total_lv3  = 0;
				foreach($result4 as $rows4) {
					// TradeLogs("ad_admin_multi-108 : ".$total_lv3_has);
					$total_lv3 = $total_lv3 + $rows4['amount'];
					// var_dump($total_lv3);
					$account_lv4 = $rows4['ACCNO'];
					$query = "SELECT
					mlm.`ACCNO`,
					mlm_bonus_settings.`amount`
					FROM
					mlm,
					mlm_payment,
					mlm_bonus_settings
					WHERE mlm.`Upline` = '$account_lv4'
					AND mlm_payment.`Account` = mlm.`ACCNO`
					AND mlm.`group_play` = mlm_bonus_settings.`group_play`
					AND mlm_payment.`PayFor` = 'PV:$date'
					AND mlm_payment.`Status` = '2'  ";
					$result5 = $DB->execresultset($query);
					$total_lv4 = 0;
					// $total_lv4_has = 0;
					foreach($result5 as $rows5) {
						$total_lv4 = $total_lv4 + $rows5['amount'];
						// var_dump($total_lv4);
						$account_lv5 = $rows5['ACCNO'];
						$query = "SELECT
						mlm.`ACCNO`,
						mlm_bonus_settings.`amount`
						FROM
						mlm,
						mlm_payment,
						mlm_bonus_settings
						WHERE mlm.`Upline` = '$account_lv5'
						AND mlm_payment.`Account` = mlm.`ACCNO`
						AND mlm.`group_play` = mlm_bonus_settings.`group_play`
						AND mlm_payment.`PayFor` = 'PV:$date'
						AND mlm_payment.`Status` = '2'  ";
						$result6 = $DB->execresultset($query);
						$total_lv5 = 0;
						$total_lv5_has = 0;
						foreach($result6 as $rows6) {
							$total_lv5 = $total_lv5 + $rows6['amount'];
							// echo $total_lv5;
							$account_lv6 = $rows6['ACCNO'];
							$query = "SELECT
							mlm.`ACCNO`,
							mlm_bonus_settings.`amount`
							FROM
							mlm,
							mlm_payment,
							mlm_bonus_settings
							WHERE mlm.`Upline` = '$account_lv6'
							AND mlm_payment.`Account` = mlm.`ACCNO`
							AND mlm.`group_play` = mlm_bonus_settings.`group_play`
							AND mlm_payment.`PayFor` = 'PV:$date'
							AND mlm_payment.`Status` = '2'  ";
							$result7 = $DB->execresultset($query);
							$total_lv6 = 0;
							$total_lv6_has = 0;
							foreach($result7 as $rows7) {
								$total_lv6 = $total_lv6 + $rows7['amount'];
								$account_lv7 = $rows7['ACCNO'];
							}
							$total_lv6_has = $total_lv6_has + $total_lv6;
						}
						$total_lv5_has = $total_lv5_has + $total_lv5;
					}
					// var_dump($total_lv4_has);
					$total_lv4_has = $total_lv4_has + $total_lv4;

				}


				$total_lv3_has = $total_lv3_has + $total_lv3;
			}

			// echo "<br>BONUS FOR LV 1 FOR - ".$account_lv1 . " IS " . $total_lv2;
			$total_lv2_has = $total_lv2_has + $total_lv2;
		}

		switch ($lv) {
			case '1':
			$total = $total_lv1 * 0.03;
			break;
			case '2':
			$total = ($total_lv1 + $total_lv2_has) * 0.03;
			break;
			case '3':
			$total = ($total_lv1 + $total_lv2_has + $total_lv3_has) * 0.03;
			break;
			case '4':
			$total = ($total_lv1 + $total_lv2_has + $total_lv3_has + $total_lv4_has) * 0.03;
			break;
			case '5':
			$total = ($total_lv1 + $total_lv2_has + $total_lv3_has + $total_lv4_has + $total_lv5_has) * 0.03;
			break;
			case '6':
			$total = ($total_lv1 + $total_lv2_has + $total_lv3_has + $total_lv4_has + $total_lv5_has + $total_lv6_has) * 0.03;
			//TradeLogs("ad_admin_multi-175 : ".$total_lv1 . " " . $total_lv2_has. " ".$total_lv3_has. " ".$total_lv4_has);
			break;

			default:
			$total = 0;
			break;
		}
		if ($total >= 1.00) {
			$fee = 50.00;
		}elseif($total >= 50000.00){
			$fee = 330.00;
		}elseif ($total >= 250000.00) {
			$fee = 530.00;
		}elseif($total >= 500000.00){
			$fee = 1330.00;
		}elseif($total >= 1000000.00){
			$fee = 2330.00;
		}else{
			$fee = 0;
		}
		// Store To wallet
		if ($total != 0) {
			$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
			storeToWallet($account_lv1, $total);
			bonusLogs($account_lv1, 'multi', $total, 'This bonus split 70% Into E-Wallet and 30% into Gold Saving account');
			$subject = "Congratulations, you have got a bonus";
			$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
			$body = $body . "Dear ".$account_lv1_name.",<br>";
			$body = $body . " <br>";
			$body = $body . "Congratulations, you have earned <b>MULTI LINE ROI CLUB BONUS (M.C.B)</b> bonus of USD ".number_format($total, 2)." <br>";
			$body = $body . "This bonus will be split into two type Account (70% goes to E-Wallet / 30% goes to Gold Saving Account).<br>";
			if($fee != 0) {
				$body = $body . "and you will be charged an additional fee of USD ".$fee." <i>has been added to your addiction</i><br>";
			}
			$body = $body . " <br>";
			$body = $body . "You may login to your APR program account via our website at http://www.apexregent.com <br>";
			$body = $body . " <br>";
			$body = $body . " <br>";
			$body = $body . "Thank you," . "<br>";
			$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
			$body = $body . $companys['long_address'];
			$body = $body . " Email : ".$companys['email']." <br>";
			$body = $body . " ".$companys['companyurl']." <br>";
			sendEmail($account_lv1_email, $subject, $body, 'ar_admin_multi');

			if ($fee != 0) {
				$que = "INSERT INTO mlm_payment SET aecode = '$account_lv1_email', Account = '$account_lv1', PayType = 'Multi FEE', Status = '0', PayFor = 'FEE:$date' ";
				$DB->execonly($que);
			}
			// $total = $total_lv2_has + $total_lv1;
			// Udah Didapet Total Untuk setiap accountnnya
			// Tinggal dimasukkan ke E-Wallet

			if($debug == "yes") {
				echo "<br>BONUS FOR LV 1 FOR - ".$account_lv1 . " IS " . $total . " LEVEL ".$lv." FEE ".$fee;
				echo "<br>lv1 ".$total_lv1 . " lv2 : ".$total_lv2_has." lv3 : ".$total_lv3_has." lv4 : " . $total_lv4_has . " lv5 : ".$total_lv5_has." lv6 : ".$total_lv6_has;
				echo "<br>----------------------------------------------------------------------------------------------------";
			}
		}
	}
}
/*=====  End of Coding  ======*/


function checkchild($account){
	global $DB;
	$date = date('Ym', time());
	$query = "SELECT
	mlm.`ACCNO`,
	mlm_bonus_settings.`amount`
	FROM
	mlm,
	mlm_payment,
	mlm_bonus_settings
	WHERE mlm.`Upline` = '$account'
	AND mlm_payment.`Account` = mlm.`ACCNO`
	AND mlm.`group_play` = mlm_bonus_settings.`group_play`
	AND mlm_payment.`PayFor` = 'PV:$date'
	AND mlm_payment.`Status` = '2'  ";
	$result = $DB->execresultset($query);
	$hasil = array();
	foreach($result as $rows) {
		$hasil[] = $rows;
	}
	return $hasil;
}

function TradeLogs($msg) {
	$fp = fopen("trader2.log", "a");
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
