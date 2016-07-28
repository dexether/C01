<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
$security = new \security\CSRF;
$token = $security->set(4, 3600);
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

if (isset($user)) {
	$user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);
$template->assign("token", $token);
//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
	$postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'ar_admin_withdrawal';

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
AND mlm_transaction.`type_transaction` IN ('withdrawal') 
ORDER BY mlm_transaction.`date_transaction` DESC ";
$result = $DB->execresultset($query);
$amount = '';
$template->assign("request", $result);
// var_dump($result);

$query = "SELECT value FROM app_config WHERE `key` = 'AR_WITHDRAWAL_TAX'";
$result = $DB->execresultset($query);
$tax = '';
foreach($result as $row){
	$tax = $row['value'];
}

$template->assign("tax",$tax);
$template->display("ar_admin_withdrawal.htm");


function TradeLogUnderConstruct_Secure($msg) {
	$fp = fopen("trader.log", "a");
	$logdate = date("Y-m-d H:i:s => ");
	$msg = preg_replace("/\s+/", " ", $msg);
	fwrite($fp, $logdate . $msg . "\n");
	fclose($fp);
	return;
}


?>