<?php
$skip_authentication = 1;
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;

//tradeLogMQL5("MQL5.php-Line-9");

$_SESSION['page'] = 'mql5_146316';
//tradeLogMQL5("MQL5-12-Session Page:" . $_SESSION['page']);
$template->display("mql5_146316.htm");

function tradeLogMQL5($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>