<?php

session_start();
$skip_authentication = 1;
include("../includes/functions.php");
include_once("includes/wr_tools.php");
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}
$var_to_pass = null;
$output = "true";
if ($_POST["email"]) {

    $username = $_POST["email"];
    $query = "SELECT * FROM user WHERE username = '$username'";
    //tradeLog("Check_Open_Account-17:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $output = "false";
    }

    $query = "SELECT * FROM client_aecode WHERE aecode = '$username'";
    //tradeLog("Check_Open_Account-24:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $output = "false";
    }



    //tradeLog("Check_Open_Account-32:" . $output);
}
//$output = true;
echo $output;

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>