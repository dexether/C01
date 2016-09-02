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

//tradeLogLogIP("LogIp1.php-Line-19");
$_SESSION['page'] = 'maxwell_real_logs';

$query = "SELECT * FROM logserver ORDER BY TIMESTAMP DESC;";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $logservers[] = $row;
}
$template->assign("logservers", $logservers);

$query = "SELECT table_name FROM information_schema.tables WHERE table_schema='maxwell_real_logs';";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    //tradeLogLogIP("LogIP1-32:" . $row['table_name']);
    $logmetas[] = $row;
}
$thecount = count($logmetas);
for ($icount = 0; $icount < $thecount; $icount++) {
    if (!isset($logmetas[$icount])) {
        $logmeta = null;
    } else {
        $logmeta = $logmetas[$icount];
    }
    $rolldate_1 = $logmeta['table_name']; //logs_2016_1_3
    //tradeLogLogIP("LogIP1:" . $rolldate_1);
    $rolldate_2 = explode("_", $rolldate_1);
    $rolldate_3_yyyy = $rolldate_2['1'];
    $rolldate_3_m = $rolldate_2['2'];
    //tradeLogLogIP("LogIP1-rolldate_3_m:" . $rolldate_3_m);
    $rolldate_3_d = $rolldate_2['3'];
    //tradeLogLogIP("LogIP1-rolldate_3_d:" . $rolldate_3_d);
    $rolldate = $rolldate_3_yyyy . "_" . $rolldate_3_m . "_" . $rolldate_3_d;
    //tradeLogLogIP("LogIP1-rolldate-51:" . $rolldate);
    $rolldate_akhir[] = $rolldate;
    $datesearch1 = $rolldate;
    $datesearch2 = $rolldate;
}

if (isset($_GET['date1'])) {
    $datesearch1 = $_GET['date1'];
}
$template->assign("datesearch1", $datesearch1);
if (isset($_GET['date2'])) {
    $datesearch2 = $_GET['date2'];
}
$template->assign("datesearch2", $datesearch2);
//tradeLogLogIP("LogIP1-Date1:" . $datesearch1.";Date2:".$datesearch2);

$template->assign("rolldate_akhir", $rolldate_akhir);

$rolldate_awal = $rolldate_akhir;
$template->assign("rolldate_awal", $rolldate_awal);

$time1 = "00:00:00";
$time1selected = $time1;
if (isset($_GET['time1'])) {
    $time1 = $_GET['time1'];
}
$template->assign("time1selected", $time1);

$time2 = "23:59:59";
$time2selected = $time2;
if (isset($_GET['time2'])) {
    $time2 = $_GET['time2'];
}
$template->assign("time2selected", $time2);

$maxrow = "100";
$maxrowselected = $maxrow;
if (isset($_GET['maxrow'])) {
    $maxrow = $_GET['maxrow'];
}
$template->assign("maxrowselected", $maxrow);

$filter_query = "and 1=1";
$filter = "";
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}
//tradeLogLogIP("LogIP1-91-Filter:" . $filter);
if ($filter != '1=1') {
    $filter_query = "and msg like ('%$filter%') ";
}
$filterselected = $filter;
$template->assign("filterselected", $filterselected);

$query = "SELECT * FROM mt_filter ORDER BY description ASC ";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $filters[] = $row;
}
$template->assign("filters", $filters);

$query = "SELECT table_name FROM information_schema.tables 
    WHERE table_schema='maxwell_real_logs' and table_name between ('logs_$datesearch1') and ('logs_$datesearch2') ";
//tradeLogLogIP("LogIP1-88:" . $query);
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    //tradeLogLogIP("LogIP1-32:" . $row['table_name']);
    $rolldata_1 = $row['table_name']; //logs_2016_1_3
    $rolldata_2 = explode("_", $rolldata_1);
    $rolldata_3_yyyy = $rolldata_2['1'];
    $rolldata_3_m = $rolldata_2['2'];
    $rolldata_3_d = $rolldata_2['3'];
    $rolldata = $rolldata_3_yyyy . "_" . $rolldata_3_m . "_" . $rolldata_3_d;
    //tradeLogLogIP("LogIP1-98-Roldate:" . $rolldata);
    $rolldatas[] = $rolldata;
}
$datasmetas = array();
if (count($rolldatas) > 0) {
    for ($icount = 0; $icount < count($rolldatas); $icount++) {
        if (!isset($rolldatas[$icount])) {
            $datameta_rollover = null;
        } else {
            $datameta_rollover = $rolldatas[$icount];
        }
        //tradeLogLogIP("LogIP1-93-datameta_rollover:" . $datameta_rollover);
        $query = "SELECT id,code,ip,msg,ctm,unused1,unused2 FROM maxwell_real_logs.logs_$datameta_rollover 
        WHERE ctm BETWEEN ('$time1') AND ('$time2')  
        $filter_query   
        ORDER BY id DESC limit 0,$maxrow";
        //tradeLogLogIP("LogIP1-111-Query:" . $query);
        $rows = $DB->execresultset($query);
        foreach ($rows as $row) {
            //tradeLogLogIP("LogIP1-100-datameta_rollover" . $row['id']);
            $row['date'] = $datameta_rollover;
            $datasmetas[] = $row;
        }//foreach ($rows as $row) {
    }
}//if(count($rolldatas)>0){

$template->assign("datasmetas", $datasmetas);

$template->display("logip1.htm");

function check_digit($last, $jumlah_digit) {
    $last_6digit = $last;
    If (strlen($last_6digit) != $jumlah_digit) {
        $count_last = $jumlah_digit - strlen($last_6digit);
        for ($i = 0; $i < $count_last; $i++) {
            $last_6digit = "0" . $last_6digit;
        }
    }
    return $last_6digit;
}

function tradeLogLogIP($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>