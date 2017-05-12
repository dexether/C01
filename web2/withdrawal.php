<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
$security = new \security\CSRF;
$token = $security->set(4, 3600);
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

include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
$theFetchAccount = new theOtherFetchAccounts();
$cabang_admin = 'semua';
$accounts = $theFetchAccount->fetchAccountslangsung($user,$mysql['meta'],$cabang_admin);

$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}

$key = '';
if (isset($_SESSION['key'])) {
    $key = $_SESSION['key'];
}

$tools = new CTools();
$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
$variabel = explode("&", $data[0]); //a=1&account=802222&postmode=deposit&tradedby=ALBERTOSCARINA
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$account = $accountvariabel[1];
$lines = $lines . "&account=" . $account;
$linezip = gzcompress($lines);
$key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
$_SESSION['key'] = $key;

$accountcheck = myfilter($accounts, $account);
if ($accountcheck[0] == '') {
    display_error("107.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
} else {
    if (!empty($account) && $account != "all") {
        if (!in_array($account, $accounts)) {
            //TradeLogUnderConstruct_Secure("Profile-111");
            display_error("111.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
        }
    }
    //TradeLogUnderConstruct_Secure("Profile-115");
    $template->assign("accounts", $accounts);
    if (!empty($account)) {
        $template->assign("tradedby", $user->username);
        $template->assign("account", $account);
        $template->assign("error", "");
    }
}
$template->assign("account", $account);
$template->assign("token", $token);
//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'withdrawal';

/*==============================
=            Coding            =
==============================*/

$query = "SELECT
client_accounts.`accountname`,
mlm_ewallet.`balance`
FROM
client_accounts,
client_aecode,
mlm_ewallet
WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
AND client_accounts.`suspend` = '0'
AND client_aecode.`aecode` = '$user->username'
AND mlm_ewallet.`account` = client_accounts.`accountname`";
$result = $DB->execresultset($query);
$template->assign("accounts", $result);


$query = "SELECT
client_aecode_bank.`aeaccountname`,
client_aecode_bank.`tipe_akun`,
client_aecode_bank.`aeaccountnumber`,
client_aecode_bank.`status`
FROM
client_aecode,
client_aecode_bank
WHERE client_aecode.`aecode` = '$user->username'
AND client_aecode.`aecode` = client_aecode_bank.`aecode` ";
$result = $DB->execresultset($query);
$template->assign("bankaccounts", $result);
//TradeLogUnderConstruct_Secure("Query Bank Accounts :". $query);


$query = "SELECT
mlm_transaction.`date_transaction`,
client_accounts.`accountname`,
mlm_transaction.`type_transaction`,
mlm_transaction.`amount`,
mlm_transaction.`status`
FROM
mlm_transaction,
client_accounts,
client_aecode
WHERE mlm_transaction.`type_transaction` = 'withdrawal'

AND mlm_transaction.`account_from` = client_accounts.`accountname`
AND client_accounts.`aecodeid` = client_aecode.`aecodeid`
AND client_aecode.`aecode` = '$user->username'";

$result = $DB->execresultset($query);
$template->assign("witdrawlstat", $result);

$query = "SELECT value FROM app_config WHERE `key` = 'AR_WITHDRAWAL_TAX'";
$result = $DB->execresultset($query);
$tax = '';
foreach($result as $row){
	$tax = $row['value'];
}
$template->assign("tax", $tax);


$sql = "SELECT
  currency.id
FROM
  client_aecode_bank
  JOIN currency
    ON currency.`country_code` = client_aecode_bank.`tipe_akun`
   WHERE client_aecode_bank.`aecode` = '$user->username'";
$result = $DB->execresultset($sql);
$currency_id = false;
foreach($result as $key => $row):
  $currency_id = $row['id'];
endforeach;
$template->assign('currency', $currency_id);

/*=====  End of Coding  ======*/


$template->display("withdrawal.htm");

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


?>
