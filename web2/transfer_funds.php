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

$user = $_SESSION['user'];
$template->assign("user", $user);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'transfer_funds';

$query = "SELECT 
client_accounts.`accountname`,
mlm_ewallet.`balance` 
FROM
client_aecode,
client_accounts,
mlm_ewallet 
WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid` 
AND mlm_ewallet.balance > 0 
AND client_accounts.`suspend` = '0'
AND mlm_ewallet.`account` = client_accounts.`accountname`
AND client_aecode.`aecode` = '$user->username' ";
$account1 = $DB->execresultset($query);
$allaccounts = array();
foreach($account1 as $key => $rows) {
    $allaccounts[$key] = $rows;
    $allaccounts[$key]['wallet'] = "E - Wallet";
}
$template->assign("allaccounts", $allaccounts);


$query = "SELECT 
client_accounts.`accountname` 
FROM
client_aecode,
client_accounts,
mlm_goldsaving 
WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid` 
AND client_accounts.`suspend` = '0'
AND mlm_goldsaving.`account` = client_accounts.`accountname` 
AND client_aecode.`aecode` = '$user->username'";
$account1 = $DB->execresultset($query);
$toaccounts = array();
foreach($account1 as $key => $rows) {
    $toaccounts[$key] = $rows;
    $toaccounts[$key]['wallet'] = "Gold Saving";
}
$all = array_merge($allaccounts, $toaccounts);
$template->assign("alls", $all);

$query = "SELECT 
mlm_transaction.`account_destination`,
mlm_transaction.`account_from`,
mlm_transaction.`amount`,
mlm_transaction.`date_transaction`,
mlm_transaction.`method_transaction`,
mlm_transaction.`status`
FROM
mlm_transaction,
client_accounts,
client_aecode 
WHERE mlm_transaction.`account_from` = client_accounts.`accountname`
AND client_accounts.`aecodeid` = client_aecode.`aecodeid`
AND client_aecode.`aecode` = '$user->username'
AND mlm_transaction.`type_transaction` = 'transfer'";
$result = $DB->execresultset($query);
$template->assign("request", $result);
$template->display("transfer_funds.htm");

function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>