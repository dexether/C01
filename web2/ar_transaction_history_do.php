<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require_once "$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php";
include_once "includes/wr_tools.php";
$var_to_pass = null;
global $user;
global $template;
global $DB;
$security = new \security\CSRF;
$error    = "success";
$subject  = "Oops, Something has happened";
$msg      = "Try refresing the web page";
$progress = 0;
/*
if (isset($user)) {
$user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);
 */
$account = @$_POST['accounts'];

$token     = @$_POST['token'];
$type      = @$_POST['type'];
$tglnya    = @$_POST['tglnya'];
$date      = explode(' - ', $tglnya);
$date_from = $date[0];
$date_to   = $date[1];
if ($account === '0') {
    $filter_account = "";
} else {
    $filter_account = " AND account_from = '".$account."'";
}
if ($type === '0') {
    $filter_type = "";
} else {
    $filter_type = " AND type_transaction LIKE '%$type%'";
}
/*==============================
=            Coding            =
==============================*/
// print_r($account);
if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
            /* Query */
            // $query = "SELECT * FROM mlm_transaction WHERE 1=1 $filter_account $filter_type AND date_transaction BETWEEN '$date_from' AND '$date_to'";
            $result = array();
            $query = "SELECT * FROM mlm_transaction WHERE 1=1 $filter_account $filter_type";
            $result = $DB->execresultset($query);

            // print_r($query);
            $token = $security->set(3, 3600);
        } else {

        }

    }
}

// $response['status']   = $error;
// $response['title']    = $subject;
$response['msg']      = $query;
$response['result'] = $result;
$token                = $security->set(3, 3600);
$response['token']    = $token;

echo json_encode($response);

function tradeLogs($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
