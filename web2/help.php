<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;

if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
$theFetchAccount = new theOtherFetchAccounts();
$cabang_admin = 'semua';
$accounts = $theFetchAccount->fetchAccountslangsung($user,$mysql['meta'],$cabang_admin);
$account = $accounts[0];

if (isset($_GET['account'])) {
    $account = anti_injection($_GET['account']);
}
if (isset($_POST['account'])) {
    $account = anti_injection($_POST['account']);
}

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
$accountcheck = myfilter($accounts, $account);
if ($accountcheck[0] == '') {
    display_error("41.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
} else {
    $mainmenu = "mainmenu.php?account=" . $account;
    $template->assign("mainmenu", $mainmenu);

    if (!empty($account) && $account != "all") {
        if (!in_array($account, $accounts)) {
            display_error("48.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
        }
    }
    $template->assign("accounts", $accounts);
    if (!empty($account)) {
        $template->assign("tradedby", $user->username);
        $template->assign("account", $account);
        $template->assign("error", "");
    }
}
$_SESSION['page'] = 'help';
$emailnya = "email_admin.php?postmode=emailtoadmin&tradedby=" . $user->username;
$template->assign("actionemail", $emailnya);

//tradeLogHelp("Help-Session-122:" . $emailnya);

$template->display("help.htm");


function tradeLogHelp($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>