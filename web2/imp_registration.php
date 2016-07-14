<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

// Scurity
$security = new \security\CSRF;
$token = $security->set(3, 3600);
$template->assign("token", $token);
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);


$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}

$key = '';
if (isset($_SESSION['key'])) {
    $key = $_SESSION['key'];
}
//TradeLog_MLMRegistration("MLM_Registration-33");

$tools = new CTools();
$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
$variabel = explode("&", $data[0]); //a=1&account=802222&postmode=deposit&tradedby=ALBERTOSCARINA
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$account = $accountvariabel[1];
$lines = $lines . "&account=" . $account;
$linezip = gzcompress($lines);
$key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
$_SESSION['key'] = $key;


$_SESSION['page'] = 'imp_registration';

/*==============================
=        Start Coding          =
==============================*/

if ($user->groupid == '3') {
    $query = "SELECT client_aecode.*   
        from client_aecode 
        where 
        client_aecode.aecode = '$user->username'";
    //TradeLog_MLMRegistration("MLM_Registration-84=" . $user->groupid . ";" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $clientaecode = $row;
    }
    $template->assign("clientaecode", $clientaecode);

    $query = "SELECT 
    mlm_bonus_settings.`group_play`,
    mlm_bonus_settings.`description`
    FROM
    mlm_bonus_settings 
    WHERE mlm_bonus_settings.`active` = TRUE";
    $result = $DB->execresultset($query);
    $template->assign("group_play", $result);

}

/*=====  End of Coding  ======*/


$template->display("imp_registration.htm");

function tradeLogArRegistration($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>