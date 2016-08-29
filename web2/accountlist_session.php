<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

//session_start();


include_once("includes/wr_tools.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
global $user;
global $template;

$_SESSION[page]='dashboard';

echo 0;
//exit;

function tradeLog_AccountList($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>