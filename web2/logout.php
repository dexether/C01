<?php
ob_start();
session_start();
if($urlproject!=''){
    $_SESSION['urlproject'] = $urlproject;
}
//tradeLog("logout.php-6:".$urlproject);
//include("../includes/functions.php");
//tradeLog("logout.php-3");
include_once("includes/wr_tools.php");
global $user;
global $template;

$lines = "a=1";
if ($mysql[crypt_key] != '') {
    $crypt_key = $mysql[crypt_key];
}
$var_to_pass = null;
$key = $_SESSION[key];
$tools = new CTools();
$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
$variabel = explode("&", $data[0]); //a=1&account=802222&
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$account = $accountvariabel[1];

$logout = "index.php";
$company = substr($user->username, 0, 4);//askap Z010
//tradeLog("logout.php-6:".$company);
$_SESSION[key] = ""; 
$_SESSION[recheck] = ""; //untuk isntantnew recheck harga statusnya
$_SESSION[recheck2] = ""; //untuk isntantliquidate recheck harga statusnya 
session_unset();
session_destroy();
$account = '';
header("Location: {$logout}");
exit;

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>
