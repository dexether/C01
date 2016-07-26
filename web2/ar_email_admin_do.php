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
$emails   = @$_POST['emails'];
$subject_mail  = @$_POST['subject'];
// tradeLogs($subject_mail);
$body     = @$_POST['bodyisi'];
if ($subject = '' || count($emails) == '0') {
    $error   = "error";
    $subject = "Please Fillup the form below";
    $msg     = "Try refresing the web page";
}
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
            foreach ($emails as $key => $value) {
                # code...
                $query = "INSERT INTO email SET timesend = '1970-01-31 00:00:00', timeupdate = NOW(), email_to = '$value', email_subject = '$subject_mail ', email_body = '$body', module = 'ar_email_admin'";
                $DB->execonly($query);

            }
            $error    = "success";
            $subject  = "Success";
            $msg      = "Sending Email Success";
            $progress = 0;
        } else {
            $error    = "error";
            $subject  = "Error";
            $msg      = "your session has been expire, Try refresing the web page";
            $progress = 0;
        }

    }
}
$response['status'] = $error;
$response['title']  = $subject;
$response['msg']    = $msg;
echo json_encode($response, JSON_PRETTY_PRINT);

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
