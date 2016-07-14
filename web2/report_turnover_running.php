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

//tradeLogReport_Summary_Client("Report_Summary_Clinet.php-Line-18:" . $_SESSION['page']);
$_SESSION['page'] = 'report_turnover_running';


$query = "SELECT mt_database.mt4dt,mt_database.alias FROM mt_database ORDER BY mt_database.alias ASC";
$alldatabases = array();
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $alldatabases[$row['alias']] = $row;
}

foreach ($alldatabases AS $alias => $databasesatu) {
    $query = "SELECT mt4_daily.TIME FROM " . $databasesatu['mt4dt'] . ".mt4_daily ORDER BY mt4_daily.TIME DESC LIMIT 0,1 ";

    //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-32:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $alldatabases[$alias]['TIME'] = $row['TIME'];
    }
}
$template->assign("alldatabases", $alldatabases);

$query = "SELECT forexfixmargin,forexfixturnover,indexfixmargin,indexfixturnover,
    floatingmargin,floatingturnover,rangefrom,rangeto,email,subscribe  
    FROM report_turnover_equity where username = '$user->username'";
//tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-44:" . $query);
$rows = $DB->execresultset($query);
$report_turnover_equity;
foreach ($rows as $row) {
    $report_turnover_equity = $row;
}
$email1 = $report_turnover_equity['email'];
$template->assign("email1", $email1);
$subscribe = $report_turnover_equity['subscribe'];
$template->assign("subscribe", $subscribe);
$rangefromselect = $report_turnover_equity['rangefrom'];
$rangetoselect = $report_turnover_equity['rangeto'];
//tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-50:" . $rangefromselect);
if ($rangefromselect == '') {
    $query = "insert into report_turnover_equity set
        username = '$user->username',
        forexfixmargin = '1000',
        forexfixturnover='3',
        indexfixmargin='5000000',
        indexfixturnover='3',
        floatingmargin='800',
        floatingturnover='3',
        rangefrom = NOW(),
        rangeto = NOW()
            ";
    $DB->execonly($query);
    $query = "SELECT forexfixmargin,forexfixturnover,indexfixmargin,indexfixturnover,
    floatingmargin,floatingturnover,rangefrom,rangeto  
    FROM report_turnover_equity where username = '$user->username'";
    //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-67:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $report_turnover_equity = $row;
    }
    $rangefromselect = $report_turnover_equity['rangefrom'];
    $rangetoselect = $report_turnover_equity['rangeto'];
}

if (isset($_GET['rangefrom'])) {
    $rangefromselect = $_GET['rangefrom'];
}
$template->assign("rangefromselect", $rangefromselect);

if (isset($_GET['subscribe'])) {
    $subscribe = $_GET['subscribe'];
}
$template->assign("subscribe", $subscribe);

if (isset($_GET['email1'])) {
    $email1 = $_GET['email1'];
}
$template->assign("email1", $email1);

if (isset($_GET['rangeto'])) {
    $rangetoselect = $_GET['rangeto'];
}
$template->assign("rangetoselect", $rangetoselect);

if (isset($_GET['forexfixturnover'])) {
    $report_turnover_equity['forexfixturnover'] = $_GET['forexfixturnover'];
}
$template->assign("forexfixturnoverselect", $report_turnover_equity['forexfixturnover']);

if (isset($_GET['forexfixmargin'])) {
    $report_turnover_equity['forexfixmargin'] = $_GET['forexfixmargin'];
}
$template->assign("forexfixmarginselect", $report_turnover_equity['forexfixmargin']);

if (isset($_GET['indexfixturnover'])) {
    $report_turnover_equity['indexfixturnover'] = $_GET['indexfixturnover'];
}
$template->assign("indexfixturnoverselect", $report_turnover_equity['indexfixturnover']);

if (isset($_GET['indexfixmargin'])) {
    $report_turnover_equity['indexfixmargin'] = $_GET['indexfixmargin'];
}
$template->assign("indexfixmarginselect", $report_turnover_equity['indexfixmargin']);
//tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-99:" . $report_turnover_equity['indexfixmargin']);

if (isset($_GET['floatingmargin'])) {
    $report_turnover_equity['floatingmargin'] = $_GET['floatingmargin'];
}
$template->assign("floatingmarginselect", $report_turnover_equity['floatingmargin']);

if (isset($_GET['floatingturnover'])) {
    $report_turnover_equity['floatingturnover'] = $_GET['floatingturnover'];
}
$template->assign("floatingturnoverselect", $report_turnover_equity['floatingturnover']);

$query = "SELECT mt_database.alias,acc_kota.mt4dt,acc_kota.login,acc_kota.kliringlogin,acc_kota.rate,
acc_kota.branch,acc_kota.group,acc_kota.aecode,acc_kota.`comment`,
acc_kota.regular 
FROM acc_kota,mt_database
WHERE mt_database.mt4dt = acc_kota.`mt4dt` 
ORDER BY mt_database.alias";
// var_dump($query);
//tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-86:".$query);
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $turnovers[$row['alias']][$row['login']] = $row;
}
// var_dump($turnovers);
$turnovers2 = array();
foreach ($turnovers AS $alias => $turnover1) {
    //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-49:".$alias);
    foreach ($turnover1 AS $login => $turnover2) {
        // var_dump($turnover2);
        // tradeLogReport_Summary_Client("Report_Summary_Client.php-Line53:".$turnover2['mt4dt'].";".$login);
        $checkresult = fetchStatement2($login, $turnover2, $report_turnover_equity);
        //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-54-CheckResult:".$checkresult['ikuttampil']);
        // var_dump($checkresult);
        if ($checkresult['ikuttampil2'] == 'ya') {
            $turnovers2[$alias][$login] = $checkresult;
        }
        //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-57:" . $turnovers2[$alias][$login]['ikuttampil']);
    }
}

$template->assign("turnovers", $turnovers2);

$template->display("report_turnover_running.htm");

function tradeLogReport_Summary_Client($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

function fetchStatement2($login, $turnover2, $report_turnover_equity) {
    global $DB;
    $turnover2['ikuttampil1'] = "tidak";
    $turnover2['ikuttampil2'] = "tidak";
    $query = "SELECT mt4_users.MARGIN_FREE, mt4_users.EQUITY, mt4_users.LOGIN FROM " . $turnover2['mt4dt'] . ".mt4_users 
        WHERE login = '$login'";
    //tradeLogReport_Summary_Client("Report_TurnOver_Running-124:" . $query);
    $rows = $DB->execresultset($query);
    $turnover2['RUMUSTURNOVER'] = 0;
    $turnover2['DEFAULTRATE'] = $report_turnover_equity['forexfixmargin'];
    $turnover2['EQUITY'] = 0;
    foreach ($rows as $row) {
        //tradeLogReport_Summary_Client("Report_TurnOver_Running-81");
        $turnover2['MARGIN_FREE'] = $row['MARGIN_FREE'];
        $default_rate = $report_turnover_equity['forexfixmargin'];
        $default_turnover = $report_turnover_equity['forexfixturnover'];
        if ($turnover2['rate'] == '1') {
            $default_rate = $report_turnover_equity['indexfixmargin'];
            $default_turnover = $report_turnover_equity['indexfixturnover'];
        }
        if ($turnover2['rate'] == '0') {
            $default_rate = $report_turnover_equity['floatingmargin'];
            $default_turnover = $report_turnover_equity['floatingturnover'];
        }
        if ($turnover2['regular'] == 'mini') {
            $default_turnover = $report_turnover_equity['forexfixturnover'];
            $default_rate = $report_turnover_equity['forexfixmargin'];
        }
        $turnover2['DEFAULTRATE'] = $default_rate;
        $turnover2['DEFAULTTURNOVER'] = $default_turnover;
        $turnover2['EQUITY'] = $row['EQUITY'];
        $turnover2['RUMUSTURNOVER'] = ($row['EQUITY'] / $default_rate ) * $default_turnover;
        // tradeLogReport_Summary_Client("EQ : ". $row['EQUITY'] . " RUMUS : ". $turnover2['RUMUSTURNOVER']);
    }//foreach ($rows as $row) {

        $turnover2['rangeturnover'] = 0;
        $ii = 0;
        $rangeto = $report_turnover_equity['rangeto'];
        $rangefrom = $report_turnover_equity['rangefrom'];
        $range2 = "('$rangeto')";
        $range1 = "('$rangefrom')";
        $query = "SELECT * FROM " . $turnover2['mt4dt'] . ".mt4_trades WHERE 
        cmd IN ('0','1') 
        AND CLOSE_TIME > '1970-01-01 00:00:00' 
        AND CLOSE_TIME between $range1 and $range2
        AND login = '$login'";
        // tradeLogReport_Summary_Client("Report_TurnOver_Running-214-Query:" . $query);
        $rows = $DB->execresultset($query);
        foreach ($rows as $row) {
            // $turnover2['rangeturnover'] = $turnover2['rangeturnover'] + $row['VOLUME'] / 100;
            $ii++;
        }
        $turnover2['rangeturnover'] = $ii;
        if ($turnover2['rangeturnover'] >= $turnover2['RUMUSTURNOVER'] && $turnover2['rangeturnover'] != '0') {
        	// tradeLogReport_Summary_Client("224 LOGIN : ".$login." range :" . $turnover2['rangeturnover'] . " > " . $turnover2['RUMUSTURNOVER']);
        	$turnover2['ikuttampil2'] = 'ya';
        }
    //tradeLogReport_Summary_Client("Report_TurnOver_Running-102:" . $turnover2['ikuttampil']);
    return $turnover2;
}

//function fetchStatement2($login, $turnover2, $report_turnover_equity) {
?>