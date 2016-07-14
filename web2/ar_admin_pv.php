<?php
/**
 *
 * Function : move all account to mlm_payment for Mainteance PV
 *
 */



$skip_authentication = 1;
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;

//tradeLogConstruct("UnderConstruct.php-Line-9");
/*
$_SESSION['page'] = 'underconstruct';
$template->display("underconstruct.htm");*/

$postmode = "no";
if (isset($_POST['postmode'])) {
	$postmode = $_POST['postmode'];
}
if (isset($_GET['postmode'])) {
	$postmode = $_GET['postmode'];
}
if ($postmode == "doit") {
	storeToCronLogs('pv');
	$query = "SELECT 
	client_accounts.`accountname`,
	client_aecode.`aecode` 
	FROM
	client_accounts,
	client_aecode 
	WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
	AND client_accounts.`suspend` = '0'
	AND client_accounts.`accountname` NOT LIKE '9999%'
	AND client_accounts.`accountname` <> 'COMPANY' ";
	$result = $DB->execresultset($query);
	$date = date('Ym', time());
	foreach ($result as $rows) {
	// Check Apakah Proses ini sudah dijalankan sebelumnya ?
	// dan apakah tagihan ini sudah terdaftar apa belum
		$query = "SELECT IDPay FROM mlm_payment WHERE Account = '$rows[accountname]' AND PayFor = 'PV:".$date."' LIMIT 0,1";
		$result1 = $DB->execresultset($query);
		if(count($result1) == 0){
			$query = "INSERT INTO mlm_payment SET aecode = '$rows[aecode]', TxnDate = '".date('Y-m-d', time())."', Account = '$rows[accountname]', Amount = '10', PayType = 'Monthly PV', Status = '0', PayFor = 'PV:".$date."' ";
			$DB->execonly($query);
		}
	// var_dump(count($result1));

	}
}
function tradeLogConstruct($msg) {
	$fp = fopen("trader.log", "a");
	$logdate = date("Y-m-d H:i:s => ");
	$msg = preg_replace("/\s+/", " ", $msg);
	fwrite($fp, $logdate . $msg . "\n");
	fclose($fp);
	return;
}
function storeToCronLogs($module) {
	global $DB;
	$query = "UPDATE mlm_cron SET last_run = NOW() WHERE module = '$module'";
	$DB->execonly($query);
}

?>