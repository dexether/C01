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
$error = "success";
$errno = 0;
$subject = "Success !";
$msg = "Your request has been complete";
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);
$state = false;
if (isset($_POST['state'])) {
  $state = $_POST['state'];
  if ($state == "true") {
    $state = 1;
  }else{
    $state = 0;
  }
}
$account = "";
if (isset($_POST['account'])) {
  $account = $_POST['account'];
}
$postmode = "no";
if (isset($_GET['postmode'])) {
  $postmode = $_GET['postmode'];
}
/*====================================
=            Start Coding            =
====================================*/

if ($postmode == "yes") {
  $query = "UPDATE client_accounts SET suspend = '$state' WHERE accountname = '$account'";
  $DB->execonly($query);

}

/*=====  End of Start Coding  ======*/

$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
// header("Content-Type: application/json;charset=utf-8");
echo json_encode($response);

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