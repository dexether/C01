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
if ($_POST["email"]) {

    $username = $_POST["email"];
    $query = "SELECT * FROM user WHERE username = '$username'";
    //tradeLog("Check-User-Remote-17:" . $query);
    $result = $DB->query($query);
    $output2 = 'false';
    while ($row = $DB->fetch_array($result)) {
        $output2 = "true";
    }

    if ($output2 == 'true') {
        $query2 = "SELECT * FROM client_aecode WHERE aecode = '$username' and status='1'";
        //tradeLog("Check-User-Remote-24:" . $query);
        $result2 = $DB->query($query2);
        while ($row = $DB->fetch_array($result2)) {
            $output = "true";
        }
    }
   //tradeLog("Check-User-Remote-32-Output:" . $output); 
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