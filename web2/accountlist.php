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


$tools = new CTools();
$theFetchAccount->tradelog("AccountList-20-Count Accounts:" . count($accounts));
for ($icount = 0; $icount < count($accounts); $icount++) {
    $account_color = $accounts[$icount];
    $accountskey[$accounts[$icount]][color] = "icon-wrapper bg-grey-1";
    //$theFetchAccount->tradeLog("AccountList-72-Account:" . $account_color.";Companyconfirm:".$companyconfirm.";Color:".$accountskey[$account_color][color]);
    $accountkey = "a=1&account=" . $accounts[$icount];
    //$accountkey = $accountkey . "&page=dashboardawal2";
    $linezip = gzcompress($accountkey);
    $key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
    //$theFetchAccount->tradeLog("AccountList-70-accountkey:" . $accountkey);
    $accountskey[$accounts[$icount]][key] = $key;
}
$total = count($accountskey);
$template->assign("total", $total);
$template->assign("accountskey", $accountskey);

if (!$_GET[key]) {
    $theFetchAccount->tradeLog("AccountList-37-SessionKey:" . $_SESSION[key]);
    $key = $_SESSION[key]; //ini jangan dicomment , ini perlu untuk Beli ANTAM
    if (!$key) {
        $account = $accounts[0];
    }
} else {
    $key = $_GET[key];
}
$tools = new CTools();
$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
$variabel = explode("&", $data[0]); //a=1&account=802222&postmode=deposit&tradedby=ALBERTOSCARINA
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$account = $accountvariabel[1];
$theFetchAccount->tradeLog("AccountList-53-Account:" . $account);


if ($account == 'dummy') {
    $account = $accounts[0];
}

if ($account == '') {
    display_error("Error No.119. Sorry, Session Time Out. Please login again.");
}

if ($account[0] == '') {
    display_error("Error No.123. Sorry, Session Time Out. Please login again.");
} else {
    if (!empty($account) && $account != "all") {
        if (!in_array($account, $accounts)) {
            display_error("Error No.127. Sorry, we do not find the account. May be you login 2 session, Please log out both and reLogin one.");
        }
    }
    $template->assign("accounts", $accounts);

    if (!empty($account)) {
        $template->assign("tradedby", $user->username);
        $template->assign("account", $account);
        $template->assign("error", "");
    }
    $lines = $lines . "&account=" . $account;
}

$linezip = gzcompress($lines);
$key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));

$_SESSION['key'] = $key;
$_SESSION[key] = $key;

$template->display("accountlist.htm");
?>