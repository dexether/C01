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

$_SESSION['page'] = 'imp_client_comm_realtime';

/*====================================
=            Start Coding            =
====================================*/

$alldata = array();
$query   = "SELECT
  mlm_comm.`ACCNO`,
  mlm_comm.`rolldate`
FROM
  mlm_comm,
  client_accounts,
  client_aecode
  WHERE mlm_comm.`ACCNO` = client_accounts.`accountname`
  AND client_accounts.`aecodeid` = client_aecode.`aecodeid`
  AND client_aecode.`aecode` = '$user->username'";
$result = $DB->execresultset($query);
$rolldate = array();
$accountname = array();
foreach ($result as $key => $value) {
    $accountname[] = $value['ACCNO'];
    $rolldate[]    = $value['rolldate'];
}
$unique_date        = array_unique($rolldate);
$unique_accountname = array_unique($accountname);
sort($unique_date);
sort($unique_accountname);
$date = array();
foreach($unique_date as $key => $val){
    $date[$key]['title'] = date('M, Y', strtotime($val));
    $date[$key]['value'] = $val;
}

$alldata['listaccount'] = $unique_accountname;
$alldata['rolldate']    = $date;
$template->assign('alldata',$alldata);

/*=====  End of Start Coding  ======*/

$template->display("imp_client_comm_realtime.htm");

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
