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
$accounts = $theFetchAccount->fetchAccountslangsung($user, $mysql['meta'], $cabang_admin);

if (isset($_GET['datesearchfrom'])) {
    $datesearchfrom = $_GET['datesearchfrom'];
}
//tradeLogReportEquitySavedata("Report_Equity_Savedata-21:".$datesearchfrom);

if (isset($_GET['datesearchto'])) {
    $datesearchto = $_GET['datesearchto'];
}

if (isset($_GET['statements_filter'])) {
    $statements_filter = $_GET['statements_filter'];
}

$query = "delete from report_ntr_summary where username = '$user->username' ";
//tradeLogReportEquitySavedata("Report_Equity_Savedata-24-Query:".$query);
$DB->execonly($query);

$query ="insert into report_ntr_summary set 
    username = '".$user->username."',
    rangefrom = '".$datesearchfrom."',
    rangeto = '".$datesearchto."',
    statements_filter ='".$statements_filter."'   
    ";
//tradeLogReportEquitySavedata("Report_Equity_Savedata-41:".$query);
$DB->execonly($query);

echo 0;


function tradeLogReportEquitySavedata($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>