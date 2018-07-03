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
$error    = "success";
$subject  = "General Error ";
$msg      = "";
$postmode = '';
if (isset($_GET['postmode'])) {
   $postmode = $_GET['postmode'];
}
$user = $_SESSION['user'];
if (isset($user)) {
   $user = $_SESSION['user'];
}

$query  = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years  = date('Y', time());
foreach ($result as $rows) {
   $companys         = $rows;
   $companys['year'] = $years;
}
$token      = @($_POST['token']);
$commid  = @($_POST['commid']);
$requestbyname = @($_POST['requestbyname']);
$requestbyno = @($_POST['requestbyno']);
$accountname = @($_POST['accountname']);
$accountno = @($_POST['accountno']);

/*====================================
=            Start Coding            =
====================================*/
if ($error != 'error') {
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($security->get($token)) {
         $security->delete($token);
		if ($postmode == 'approve') {
			 $query = "UPDATE commission_setting SET status = 'approved' WHERE id = '$commid'";
			 $do    = $DB->execonly($query);
			 if ($do) {
				$error   = "success";
				$subject = "Successfuly";
				$msg     = "the commission setting has been approved";
			 } else {
				$error   = "error";
				$subject = "Oops, Something went wrong";
				$msg     = "Call the administrator";
			 }

			 clientlogs('The ' . $user->username . ' has approved commission setting of ' . $accountname . '-' .$accountno . ' requested by ' . $requestbyname . '-' . $requestbyno . ', and Successfuly ', 'UPDATE');
		}else if ($postmode == 'reject'){
			$query = "UPDATE commission_setting SET status = 'rejected' WHERE id = '$commid'";
			 $do    = $DB->execonly($query);
			 if ($do) {
				$error   = "success";
				$subject = "Successfuly";
				$msg     = "the commission setting has been rejected";
			 } else {
				$error   = "error";
				$subject = "Oops, Something went wrong";
				$msg     = "Call the administrator";
			 }

			 clientlogs('The ' . $user->username . ' has rejected commission setting of ' . $account . ' requested by ' . $requestby . ', and Successfuly ', 'UPDATE');
		}
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

function tradeLogMMNewLevel($msg)
{
   $fp      = fopen("trader.log", "a");
   $logdate = date("Y-m-d H:i:s => ");
   $msg     = preg_replace("/\s+/", " ", $msg);
   fwrite($fp, $logdate . $msg . "\n");
   fclose($fp);
   return;
}

function clientlogs($details, $logtype)
{
   global $DB;
   global $user;
   $rolldate = date('Y-m-d', time());
   $datetime = date('Y-m-d H:i:s', time());
   $query    = "INSERT INTO client_logs SET username = '$user->username', logdate = '$datetime', rolldate = '$rolldate', logtype = '$logtype', details = '$details'";
   $DB->execonly($query);
}

//function create_or_use_upline($group_play,$email){
