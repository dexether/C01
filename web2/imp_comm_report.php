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

$security = new \security\CSRF;

$token = $security->set(3, 3600);
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

$_SESSION['page'] = 'imp_comm_report';

/*====================================
=            Start Coding            =
====================================*/

// Ambil Tanggal Bulan
for ($m=1; $m<=12; $m++)
{
  if (date('m') == '01') {
    $month = date('Y-m-01', mktime(0,0,0,$m, 1, date('Y') - 1)) . ' - ' . date('Y-m-t', mktime(0,0,0,$m, 1, date('Y') - 1));
    $month_name = date('F, Y', mktime(0,0,0,$m, 1, '2016'));

  }else{
    $month = date('Y-m-01', mktime(0,0,0,$m, 1, date('Y'))) . ' - ' . date('Y-m-t', mktime(0,0,0,$m, 1, date('Y')));
    $month_name = date('F , Y', mktime(0,0,0,$m, 1, date('Y')));

  }
  $tanggals[$m-1]['bulan_number'] = $month;
  $tanggals[$m-1]['bulan_name'] = $month_name;
}

// 2016-01-01 - 2016-01-31
$template->assign('tanggals', $tanggals);
/*=====  End of Start Coding  ======*/


$template->display("imp_comm_report.htm");

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
