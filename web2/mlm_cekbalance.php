<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

$postmode = "no";
if (isset($_POST['postmode'])) {
    $postmode = $_POST['postmode'];
}
$account = 0;
if (isset($_POST['account'])) {
    $account = $_POST['account'];
}
/* Conditional */
$to = 0;
if (isset($_POST['to'])) {
    $to = $_POST['to'];
    $pecah = explode(';', $to);
    $to = $pecah[0];
    if ($pecah[1]=="Gold Saving") {
        $tb = "mlm_goldsaving";
    }elseif($pecah[1]=="E - Wallet"){
        $tb = "mlm_ewallet";
    }
}

if ($postmode == "yes") {
    $query = "SELECT balance FROM mlm_ewallet WHERE account = '$account'";
    $result = $DB->execresultset($query);
    $hasil = 0;
    foreach ($result as $rows) {
        $hasil = $rows['balance'];
    }
}
if ($postmode == "yes2") {
    $query = "SELECT balance FROM $tb WHERE account = '$to'";
    $result = $DB->execresultset($query);
    $hasil = 0;
    foreach ($result as $rows) {
        $hasil = $rows['balance'];
    }
}
if ($postmode == "yes3") {
    $query = "SELECT balance FROM mlm_goldsaving WHERE account = '$account'";
    $result = $DB->execresultset($query);
    $hasil = 0;
    foreach ($result as $rows) {
        $hasil = $rows['balance'];
    }
}
echo number_format($hasil, 2);
function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>