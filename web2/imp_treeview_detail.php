<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
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

$_SESSION['page'] = 'imp_treeview_detail';

/*====================================
=            Start Coding            =
====================================*/
$cabinetid = @$_GET['accno'];
$pecah = explode(' - ', $cabinetid);
$cabinetid = $pecah[0];
$query = "SELECT 
  aecode 
FROM
  client_accounts,
  client_aecode 
WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
AND client_accounts.accountname = '$cabinetid'";
$result = $DB->execresultset($query);
// var_dump($query);
$aecode = "";
foreach ($result as $key => $value) {
    $aecode = $value['aecode'];
}
$datalogin = array();
if ($aecode == $user->username || $user->groupid == '9') {
    $query = "SELECT mt4dt, mt4login FROM mlm2 WHERE ACCNO = '$cabinetid'";
    $datalogin = $DB->execresultset($query);
}
// var_dump($datalogin);

/*=====  End of Start Coding  ======*/

$template->assign('datalogin', $datalogin);
$template->display("imp_treeview_detail.htm");

function myfilter($input_var_outer, $param) {
    global $var_to_pass;
    $var_to_pass = $param;

    function mycallback($input_var_inner) {
        global $var_to_pass;
        return ($input_var_inner == $var_to_pass) ? true : false;
    }

    $return_arr = array_filter($input_var_outer, 'mycallback');
    $return_arr = array_merge(array(), $return_arr);
    return $return_arr;
}

function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>