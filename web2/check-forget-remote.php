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
if ($_POST["register_username"]) {

    $username = $_POST["register_username"];

    $query2 = "SELECT email FROM client_aecode WHERE aecode='$username' AND email <>''";
    tradeLog("Check-Foreget-Remote-18:".$query2);
    $result2 = $DB->query($query2);
    while ($row = $DB->fetch_array($result2)) {
        $output = "true";
    }
}

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