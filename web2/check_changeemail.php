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
$output = "true";
$emailold = $_POST["emailold"];
$emailnew = $_POST["emailnew"];
tradeLog("Check_ChangeEmail-15:Email Old:" . $emailold . "; Email New:" . $emailnew);
if ($emailold != $emailnew) {
    $query = "SELECT * FROM user WHERE username = '$emailnew'";
    //tradeLog("Check_Open_Account-17:" . $query);
    $result = $DB->query($query);
    while ($row = $DB->fetch_array($result)) {
        $output = "false";
    }

    $query2 = "SELECT * FROM client_aecode WHERE aecode = '$emailnew'";
    //tradeLog("Check_Open_Account-24:" . $query);
    $result2 = $DB->query($query2);
    while ($row = $DB->fetch_array($result2)) {
        $output = "false";
    }
    tradeLog("Check_ChangeEmail-30:OutPut:" . $output);
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