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

if (isset($_GET['floatingturnover'])) {
    $floatingturnover = $_GET['floatingturnover'];
}
//tradeLogReportTurnOverRunning("Report TurnOver Running2-21:".$floatingturnover);
if (isset($_GET['floatingmargin'])) {
    $floatingmargin = $_GET['floatingmargin'];
}

if (isset($_GET['indexfixturnover'])) {
    $indexfixturnover = $_GET['indexfixturnover'];
}

if (isset($_GET['indexfixmargin'])) {
    $indexfixmargin = $_GET['indexfixmargin'];
}

if (isset($_GET['forexfixturnover'])) {
    $forexfixturnover = $_GET['forexfixturnover'];
}

if (isset($_GET['forexfixmargin'])) {
    $forexfixmargin = $_GET['forexfixmargin'];
}

if (isset($_GET['rangefrom'])) {
    $rangefrom = $_GET['rangefrom'];
}
if (isset($_GET['rangeto'])) {
    $rangeto = $_GET['rangeto'];
}
if (isset($_GET['subscribe'])) {
    $subscribe = $_GET['subscribe'];
}
if (isset($_GET['email1'])) {
    $email1 = $_GET['email1'];
}


$query = "delete from report_turnover_equity where username = '$user->username' ";
//tradeLogReportTurnOverRunning("Report TurnOver Running2-24-Query:".$query);
$DB->execonly($query);

$query ="insert into report_turnover_equity set 
    username = '".$user->username."',
    forexfixmargin = '".$forexfixmargin."',
    forexfixturnover = '".$forexfixturnover."',
    indexfixmargin = '".$indexfixmargin."',
    indexfixturnover = '".$indexfixturnover."',
    floatingmargin = '".$floatingmargin."',
    floatingturnover = '".$floatingturnover."',
    rangefrom = '".$rangefrom."',
    rangeto = '".$rangeto."',
    email = '".$email1."',     
    subscribe = '".$subscribe."'
    ";
//tradeLogReportTurnOverRunning("Report TurnOver Running2-65:".$query);
$DB->execonly($query);

echo 0;


function tradeLogReportTurnOverRunning($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>