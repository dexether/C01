<?php

session_start();
$skip_authentication = 1;
include("../includes/functions.php");
include_once("includes/wr_tools.php");
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}
$response  = array();
$var_to_pass = null;
$output = "true";
if ($_POST["nationality"]) {

    $nationality = $_POST["nationality"];
    if($nationality=='SG' || $nationality=='US'){
        $output = "false";
        
    }

    //tradeLog("Check_Nationality_17:" . $nationality);
}
// $output = "false";
$response['valid'] = $output;
echo json_encode($response);

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>