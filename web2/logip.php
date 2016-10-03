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

//tradeLogLogIP("Report_Summary_Clinet.php-Line-9");
$_SESSION['page'] = 'logip';

$query = "SELECT * FROM logserver ORDER BY TIMESTAMP DESC;";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $logservers[] = $row;
}
$template->assign("logservers", $logservers);

$template->display("logip.htm");

function tradeLogLogIP($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>