<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
include_once "includes/wr_tools.php";
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

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

$_SESSION['page'] = 'imp_openlive';

// var_dump($user);
/*====================================
=            Start Coding            =
====================================*/

// Get Member
$query = "SELECT
  client_accounts.`accountname`,
  client_aecode.`name`,
  mlm.`group_play`,
  mlm_bonus_settings.`description`
FROM
  mlm,
  client_accounts,
  client_aecode,
  mlm_bonus_settings
WHERE mlm.`ACCNO` = client_accounts.`accountname`
  AND client_accounts.`aecodeid` = client_aecode.`aecodeid`
  AND mlm.`group_play` = mlm_bonus_settings.`group_play`
  AND client_aecode.`aecode` = '$user->username' ";
$result = $DB->execresultset($query);
$template->assign('allaccount', $result);

/*=====  End of Start Coding  ======*/

$template->display("imp_openlive.htm");

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
