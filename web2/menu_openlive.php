<?php
$skip_authentication = 1;
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;

//tradeLogConstruct("UnderConstruct.php-Line-9");

$_SESSION['page'] = 'menu_openlive';
$template->display("menu_openlive.htm");

function tradeLogConstruct($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>