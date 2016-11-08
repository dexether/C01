<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
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
$security = new \security\CSRF;
$token = $security->set(3, 3600);
$template->assign('token', $token);
$user = $_SESSION['user'];
$template->assign("user", $user);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'imp_upline_change';

/*====================================
=            Start Coding            =
====================================*/


$query = "SELECT
  client_aecode.`name`,
  client_aecode.`aecodeid`,
  client_aecode.`email`
FROM
  client_aecode
WHERE client_aecode.`suspend` = '0' ORDER BY email ASC";
$result = $DB->execresultset($query);
$template->assign('accountlist', $result);

$query = "SELECT accountname, client_aecode.name, mlm.group_play, client_aecode.email FROM mlm, client_accounts, client_aecode WHERE client_accounts.accountname = mlm.accno AND client_accounts.aecodeid = client_aecode.aecodeid AND client_accounts.suspend = '0' ORDER BY NAME ASC";
$result = $DB->execresultset($query);
$template->assign('newupline', $result);
/*=====  End of Start Coding  ======*/


$template->display("imp_create_cabinetid.htm");

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
