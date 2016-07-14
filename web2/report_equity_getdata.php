<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
global $user;
global $template;
global $themonth;

//tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-41:" . $mt4dtselect);
$mysqldatabases = array();
$query = "SELECT alias,mt4dt,enabled FROM mt_database where enabled='yes' ORDER BY alias ASC";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $mysqldatabases[] = $row;
}

$datesearchfrom = "";
$datesearchto = "";
$mt4dt = $mysqldatabases[0]['mt4dt'];
$mt4alias = $mysqldatabases[0]['alias'];

$checktanggal = 'no';
if (isset($_GET['checktanggal'])) {
    $checktanggal = $_GET['checktanggal'];
}
if ($checktanggal == 'from') {
    $query = "SELECT LEFT(TIME,10) AS rolldate FROM " . $mt4dt . ".mt4_daily 
    GROUP BY LEFT(TIME,10) ORDER BY TIME asc limit 0,1";
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $datesearchfrom = $row['rolldate'];
    }
    //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-63-datesearchto:" . $datesearchto);
    echo $datesearchfrom;
    exit;
}

if ($checktanggal == 'to') {
    $query = "SELECT LEFT(TIME,10) AS rolldate FROM " . $mt4dt . ".mt4_daily 
    GROUP BY LEFT(TIME,10) ORDER BY TIME DESC limit 0,1";
    //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-58:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $datesearchto = $row['rolldate'];
    }
    //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-63-datesearchto:" . $datesearchto);
    echo $datesearchto;
    exit;
}


function tradeLogReport_Summary_Client($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>