<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");

global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

if (isset($user)) {
	$user;
}
$user = $_SESSION['user'];
//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
	$postmode = $_GET['postmode'];
}

$date = @$_POST['tglnya'];
$pecah = explode(' - ', $date);
$filter_date = " AND LEFT(mlm_transaction.date_transaction, 10) BETWEEN '".$pecah[0]."' AND '".$pecah[1]."'";
$status = @$_POST['status'];
if ($status == '') {
	$filter_status = "";
}else{
	$filter_status = " AND mlm_transaction.status = '$status'";
}

$query = "SELECT 
mlm_transaction.`date_transaction`,
mlm_transaction.`account_from`,
mlm_transaction.`amount`,
mlm_transaction.`id`,
mlm_transaction.`status`,
client_aecode_bank.`aeaccountnumber`,
client_aecode_bank.`aeaccountname`,
client_aecode_bank.`banktype`,
client_aecode_bank.`tipe_akun`,
mlm_ewallet.`balance` 
FROM
mlm_transaction,
client_accounts,
client_aecode,
client_aecode_bank,
mlm_ewallet 
WHERE mlm_transaction.`account_from` = client_accounts.`accountname` 
AND client_accounts.`aecodeid` = client_aecode.`aecodeid` 
AND client_aecode_bank.`aecode` = client_aecode.`aecode`
AND mlm_transaction.`account_from` = mlm_ewallet.`account`
$filter_status
$filter_date
AND mlm_transaction.`type_transaction` IN ('withdrawal') 
ORDER BY mlm_transaction.`date_transaction` DESC ";
$result = $DB->execresultset($query);

print json_encode($result);
// var_dump($result);


function TradeLogUnderConstruct_Secure($msg) {
	$fp = fopen("trader.log", "a");
	$logdate = date("Y-m-d H:i:s => ");
	$msg = preg_replace("/\s+/", " ", $msg);
	fwrite($fp, $logdate . $msg . "\n");
	fclose($fp);
	return;
}


?>