<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
include_once("includes/wr_tools.php");
include("$_SERVER[DOCUMENT_ROOT]/_settings/config.php");
session_start();
$var_to_pass = null;
//tradelog("Pecah_Lot_-10");
check_permission(array(1, 3, 6, 7, 9));
global $tools;
global $mysql;
global $user;
global $template;
global $DB;

$lines = "a=1";
if ($mysql[crypt_key] != '') {
    $crypt_key = $mysql[crypt_key];
}
$tools = new CTools();
$theFetchAccount = new theOtherFetchAccounts();

$key = $_SESSION[key];
if ($key != '') {
    //tradelog("Pecah_Lot_-18-KEY:" . $key);
    $data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
    $data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
    //tradelog("Pecah_Lot_-122-data:" . $data[0]);
    $variabel = explode("&", $data[0]); //a=1&account=1234567
    $accountlink = $variabel[1]; //account=1234567
    $variabel = explode("=", $accountlink);
    $account = $variabel[1];
    //tradelog("Pecah_Lot_-35-account:" . $account);
}

if ($account == '') {
    display_error("Error No.39.Time is up<br>Please login again.");
}

if ($user->groupid=='9') {
    $branches = $theFetchAccount->fetchBrancheGroups();
    $accounts = $theFetchAccount->fetchAccounts("", $user->groupid=='9', $user->companygroup);
} elseif ($user->ismanager || $user->groupid == 8) {
    $manager = new Manager($user->getUserid());
    $manager->fetchBrancheGroups($DB_odbc);
    $branches = $manager->getBrancheGroups();
    $accounts = $manager->getAccounts();
} elseif ($user->groupid == 1) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 2) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 3) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
} elseif ($user->groupid == 4) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
} elseif ($user->groupid == 5) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 11) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 12) {
    $manager = new Manager($user->userid);
    $manager->fetchBrancheGroups($DB_odbc);
    $manager_accounts = $manager->getAccounts();
    for ($i = 0; $i < count($manager_accounts); $i++) {
        $accounts[$manager_accounts[$i]] = $manager_accounts[$i];
        if (empty($account_init)) {
            $account_init = $manager_accounts[0];
        }
    }
}


if ($account[0] == '') {
    display_error("Error No.86. Sorry, your time is finish<br>Please login again.");
} else {
    if (!empty($account) && $account != "all") {
        if (!in_array($account, $accounts)) {
            display_error("Error No.90. Sorry, Your Account is not there yet / Your time is finish.<br>Please login again.");
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
//tradeLog("Pecah_Lot_138-key:" . $key);


$template->display("fileupload_foto.htm");

function tradelogDash_CompanyConfirm2($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

//End
?>
