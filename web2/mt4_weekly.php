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

$_SESSION['page'] = 'mt4_weekly';

$query = "SELECT mt_database.alias,mt_database.mt4dt 
    FROM mt_database WHERE enabled ='yes'
    ORDER BY mt_database.mt4dt ASC";
//tradeLogReport_Summary_Client("AccKota-277:" . $query);
$rows = $DB->execresultset($query);
//tradeLogReport_Summary_Client("AccKota-213");
$statements_filter = array();
foreach ($rows as $row) {
    //tradeLogReport_Summary_Client("AccKota-96:" . $row['alias'] . ";" . $row['mt4dt']);
    $statements_filter[] = $row;
}
$datenow = date('Y-m-d');
$template->assign("statements_filter", $statements_filter);
$template->assign("datenow", $datenow);
//tradeLogReport_Summary_Client("AccKota-220");

$template->display("mt4_weekly.htm");



?>