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

if (isset($user)) {
    $user;
}
$security = new \security\CSRF;
$token = $security->set(3, 3600);
$template->assign('token', $token);
$user = $_SESSION['user'];
$template->assign("user", $user);
$_SESSION['page'] = 'comm_setting';
/*==============================
=            Coding            =
==============================*/
		
		$query = "SELECT * FROM commission_setting WHERE status = 'waiting'";
		$result = $DB->execresultset($query);
		$requests = array();
		foreach ($result as $rows) {
            $requests[] = $rows;
        }
		
		$template->assign("requests",$requests);
		$template->display("comm_setting.htm");

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

function tradeLogs($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
