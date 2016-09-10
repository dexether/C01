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
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
if ($_POST["afiliasi"]) {

    $username = $_POST["afiliasi"];
    if ($username == $companys['email']) {
        $output = "true";
    }
    $query = "SELECT * FROM user WHERE username = '$username'";
    //tradeLog("Check_Afiliasi_Account-17:" . $query);
    $result = $DB->query($query);
    while ($row = $DB->fetch_array($result)) {
        $output = "true";
    }

    $query2 = "SELECT * FROM client_aecode WHERE aecode = '$username'";
    //tradeLog("Check_Afiliasi_Account-24:" . $query);
    $result2 = $DB->query($query2);
    while ($row = $DB->fetch_array($result2)) {
        $output = "true";
    }



    //tradeLog("Check_Afiliasi_Account-32:" . $output);
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