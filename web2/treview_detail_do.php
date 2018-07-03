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
tradeLogTreeviewDetailDo("dipanggil");
$error            = "success";
$subject          = "General Error ";
$msg              = "";
$token            = @($_POST['token']);
tradeLogTreeviewDetailDo("token :".$token);
$users            = @($_POST['users']);
$name            = @($_POST['name']);
$email            = @($_POST['email']);
$oldemail            = @($_POST['oldemail']);
$account            = @($_POST['account']);
$role            = @($_POST['role']);

/*====================================
=            Start Coding            =
====================================*/
if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
			
			if($role == '2' || $role == '4' || $role == '5' || $role == '6'){
				$query = "UPDATE client_accounts SET typeaccount = 'agent' WHERE accountname = '$account'";
				$result = $DB->execonly($query);
			}else{
				$query = "UPDATE client_accounts SET typeaccount = 'reguler' WHERE accountname = '$account'";
				$result = $DB->execonly($query);
			}
			
			$query = "UPDATE user SET username = '$email', groupid = '$role' WHERE username ='$oldemail'";
			$result = $DB->execonly($query);
			
			$query = "UPDATE client_aecode SET aecode = '$email', email = '$email', name = '$name' WHERE aecode ='$oldemail'";
			$result = $DB->execonly($query);
			
			$error   = "success";
            $subject = "Success save data";
            $msg     = "Try refresing the web page";

        } else {
            // echo 'Ga Valid.'; // invalid
            $error   = "error";
            $subject = "Oops, Something has happened";
            $msg     = "Try refresing the web page";
        }
    }
}

$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
// header("Content-Type: application/json;charset=utf-8");
echo json_encode($response);
/*=====  End of Start Coding  ======*/

/*=====  End of Start Coding  ======*/

/* * ***************************************************************************
 * FETCH ALL ACCOUNTS ASSOCIATED WITH USERNAME                                *
 * *************************************************************************** */

function tradeLogTreeviewDetailDo($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
