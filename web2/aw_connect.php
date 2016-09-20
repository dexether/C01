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
$template->assign('token', $token);
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

$_SESSION['page'] = 'aw_connect';

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
// var_dump($result);
$query = "SELECT
  alias,
  mt4dt,
  mt_database.type
FROM
  mt_database
WHERE mt_database.`enabled` = 'yes'";
$result2 = $DB->execresultset($query);
$result3['alldata'] = $result2;
// $result3['typenya'] = $result2;
foreach($result2 as $row){
    $meta[] = $row['type'];
}
$result3['typenya'] = array_unique($meta);
$template->assign("party", $result3);



/*=====  End of Start Coding  ======*/


$template->display("aw_connect.htm");

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
