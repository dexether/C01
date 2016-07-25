<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require_once "$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php";
include_once "includes/wr_tools.php";
global $user;
global $template;
global $mysql;
global $DB;

$user     = @$_SESSION['user'];
$security = new \security\CSRF;
$error    = "success";
$subject  = "Oops, Something has happened";
$msg      = "Try refresing the web page";
$progress = 0;
$postmode = @$_GET['postmode'];
$token    = @$_POST['token'];
$email    = @$_POST['email'];
$subject  = @$_POST['subject'];
$body     = @$_POST['body'];

/*=============================================
=            Section comment block            =
=============================================*/
// tradeLogs($_SERVER['REQUEST_METHOD']);
if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
            $token = $security->set(3, 3600);
            /* Start Of Postmode */
            print_r($_POST);

        } else {
            $error    = "danger";
            $subject  = "Error";
            $msg      = "CREATE_TREE : your session has been expire, Try refresing the web page";
            $progress = 0;
        }

    }
}

// echo json_encode($response, JSON_PRETTY_PRINT);

/*=====  End of Section comment block  ======*/

function tradeLogs($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
