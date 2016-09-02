<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
global $user;
global $template;

if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
if (strtoupper($user->username) == 'THEPROGRAMMER' || strtoupper($user->username) == 'SUPPORT') {
    //TradeLogCheckLicense("CheckLicense-Lanjut-13");
    $lanjut = "iya";
    $accountnya = $user->username;
    set_log_server($accountnya, "This user try to Update License");
    $_SESSION['page'] = 'checklicense';
} else {
    $lanjut = "tidak";
    $accountnya = $user->username;
    $_SESSION['messagebox'] = "CheckLicense-20.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.";
    $_SESSION['alamat'] = "index.php";
    $keterangan = "CheckLicense-23.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.";
    set_log_server($accountnya, $keterangan);
    display_error($keterangan, "No Access");
}
$template->assign("lanjut", $lanjut);
$template->display("checklicense.htm");

function TradeLogCheckLicense($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>