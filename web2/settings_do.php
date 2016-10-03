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
$security = new \security\CSRF;
$user     = $_SESSION['user'];
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$query  = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years  = date('Y', time());
foreach ($result as $rows) {
    $companys         = $rows;
    $companys['year'] = $years;
}
$error            = "success";
$subject          = "General Error ";
$msg              = "";
$token            = @($_POST['token']);
$email            = @($_POST['newEmail']);
$password = md5($_POST['yourPassword']);
$query    = "SELECT username FROM user WHERE username = '$user->username' AND password = '$password'";
$result   = $DB->execresultset($query);
if (count($result) > 0) {

} else {
    $error   = "error";
    $subject = "Oops, We found an error ";
    $msg     = "Password is Wrong";
}

/*====================================
=            Start Coding            =
====================================*/
if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
            $query = "UPDATE client_aecode SET aecode = '$email', email = '$email' WHERE aecode = '$user->username'";
            $DB->execonly($query);
            $query =  "UPDATE client_aecode_bank SET aecode = '$email' WHERE aecode = '$user->username'";
            $DB->execonly($query);
            $query =  "UPDATE user SET username = '$email' WHERE username = '$user->username'";
            $DB->execonly($query);
             $error   = "success";
             $subject = "The username, email has been change";
            $msg     = "Please Login again";

            $to = $email;
            $timenya = date('Y-m-d H:i:s');
            $subject = "Email changer success<br/>";
            $body = "Dear $email,<br/>";
            $body = $body . "<br/>";
            $body = $body . "<br/>";
            $body = $body . "Someone has change your email setting, to $email if you are not do this, please call administrator<br/>";
            $body = $body . "<br/>";
            $body = $body . "Thank you,<br/>";
            $query = "insert into email set
               timeupdate = '$timenya',
               email_to = '$to',
               email_subject = '$subject',
               email_body = '$body',
               timesend = '1970-01-31 00:00:00'
               ";
            $DB->execonly($query);

            session_destroy();
        } else {
            // echo 'Ga Valid.'; // invalid
            $error   = "error";
            $subject = "Oops, Something has happened";
            $msg     = "Try refresing the web page";
        }
    }
}

$response['status'] = $msg;
echo json_encode($response);

?>