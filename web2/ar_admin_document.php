<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require_once "$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php";
include_once "includes/wr_tools.php";
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;
$security = new \security\CSRF;
$token    = $security->set(6, 3600);
$template->assign("token", $token);
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'ar_admin_document';

/*====================================
=            Start Coding            =
====================================*/

$query = "SELECT
  client_aecode.`name`,
  client_aecode.`email`,
  client_aecode_bank.`banktype` ,
  client_aecode_bank.`aecode`,
  client_aecode_bank.`aeaccountnumber`,
  client_aecode_bank.`aeaccountname`,
  client_aecode_bank.`tipe_akun`
FROM
  client_aecode_bank,
  client_aecode
WHERE client_aecode_bank.`aecode` = client_aecode.`aecode` AND client_aecode_bank.`status` = 1";
$result   = $DB->execresultset($query);
$alldatas = array();
foreach ($result as $key => $rows) {
    $alldatas[$key]          = $rows;
    $alldatas[$key]['token'] = $token;
}
$template->assign("datas", $alldatas);
/*=====  End of Start Coding  ======*/

// Buat dokumen
$query = "SELECT
  client_document.`id`,
  client_document.`type`,
  client_aecode.`name`,
  client_document.`comment`,
  client_document.`datetime`,
  client_document.`is_active`,
  client_document.`source`
FROM
  client_document,
  client_aecode
  WHERE client_document.`aecodeid` = client_aecode.`aecodeid`";
$result = $DB->execresultset($query);
foreach ($result as $key => $rows) {
    $alldocs[$key]          = $rows;
    $alldocs[$key]['token'] = $token;
}
$template->assign("docs", $alldocs);

$template->display("ar_admin_document.htm");

function myfilter($input_var_outer, $param)
{
    global $var_to_pass;
    $var_to_pass = $param;

    function mycallback($input_var_inner)
    {
        global $var_to_pass;
        return ($input_var_inner == $var_to_pass) ? true : false;
    }

    $return_arr = array_filter($input_var_outer, 'mycallback');
    $return_arr = array_merge(array(), $return_arr);
    return $return_arr;
}

function TradeLogUnderConstruct_Secure($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
