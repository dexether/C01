<?php

session_start();
$skip_authentication = 1;
include("../includes/functions.php");
include_once("includes/wr_tools.php");
$lines = "a=1";
if ($mysql[crypt_key] != '') {
    $crypt_key = $mysql[crypt_key];
}
$var_to_pass = null;
$output = "false";

$jumlahuang1 = anti_injection($_POST[amount]);
if ($jumlahuang1) {
    $jumlahuang2 = str_replace(".", "", $jumlahuang1);
    $jumlahuang3 = str_replace(",", "", $jumlahuang2);
    $amount = $jumlahuang3 ;
    //tradeLog("Check_money-19-Amount:".$amount);
    if ($amount < 0) {
        $output = "false";
        //tradeLog("Check_money-23-Amount < 0:" . $amount);
        echo $output;
    } else if ($amount == 0) {
        $output = "true";
        //tradeLog("Check_money-25-Amount=0:" . $amount);
        echo $output;
    } else {//if ($amount < 0) {
        //tradeLog("Check_money-29-Amount <0:" . $amount);
        $accno = $_POST["accno"];
        //tradeLog("Check_money-17-ACCNO:" . $accno . ";Amount:" . $amount);
        $query = "SELECT group_play FROM mlm WHERE accno = '$accno' AND companyconfirm = '3'";
        //tradeLog("Check_money-24:" . $query);
        $result = $DB->query($query);
        $group_play = '0';
        while ($row = $DB->fetch_array($result)) {
            $group_play = $row[group_play];
        }
        if ($group_play == '1T') {
            $max = 1000;
        }
        if ($group_play == '3T') {
            $max = 3000;
        }
        if ($group_play == '5T') {
            $max = 5000;
        }
        if ($group_play == '10T') {
            $max = 10000;
        }
        $max = $max * 5;
        if ($amount <= $max) {
            $output = "true";
        } else {
            $output = "false";
        }
        echo $output;
        //tradeLog("Check_money-58:" . $output.";Amount:".$amount);
    }//if ($amount < 0) {
} else {
    //$output = "false";
    //tradeLog("Check_money-62:" . $jumlahuang1);
    if($jumlahuang1=='0'){
        $output= "true";
    }
    echo $output;
}

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>