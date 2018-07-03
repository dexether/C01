<?php
//tradeLog("check afiliasi");
session_start();
$skip_authentication = 1;
include("../includes/functions.php");
include_once("includes/wr_tools.php");
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}
$var_to_pass = null;
$output = "false";
if ($_POST["cabinetid"]) {

    $cabinetid = $_POST["cabinetid"];
	$query2 = "SELECT * FROM client_accounts, client_aecode WHERE client_accounts.accountname = '$cabinetid' and client_aecode.status='1' and client_accounts.aecodeid = client_aecode.aecodeid";
	//tradeLog("Afiliasi : accno");
	//tradeLog("Check_Afiliasi_Account-24:" . $query);
	$result2 = $DB->execresultset($query2);
	if(!empty($result2)){
		$output = "true";
	}
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