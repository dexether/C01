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
$cabinetid  = @($_POST['cabinetid']);
$new_upline = @($_POST['new_upline']);
if (!isset($_POST['cabinetid'])) {
   $error   = "error";
   $subject = "Oops, Something has happened";
   $msg     = "Check the Cabinet ID";
}

/*====================================
=            Start Coding            =
====================================*/
if ($error != 'error') {
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($security->get($token)) {
         $security->delete($token);

         $query = "UPDATE mlm SET Upline = '$new_upline' WHERE ACCNO = '$cabinetid'";
         $do    = $DB->execonly($query);
         if ($do) {
            $account = $cabinetid;
            $iden    = getIdentitas($account);
            $to      = $iden['email'];
            $subject = "Administrator change your Upline";
            $body    = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
            $body    = $body . "Dear " . $iden['name'] . ",<br>";
            $body    = $body . " <br>";
            $body    = $body . "Your Upline has been change on Cabinet ID " . $account . " by Administrator<br>";
            $body    = $body . "if you feel this is a mistake, please contact us at " . $companys['admin_email'] . "<br>";
            $body    = $body . " <br>";
            $body    = $body . "You may login to your our program via our website at " . $companys['companyurl'] . " <br>";
            $body    = $body . " <br>";
            $body    = $body . " <br>";
            $body    = $body . "Thank you,<br>";
            $body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
            $body    = $body . $companys['long_address'];
            $body    = $body . " Email : " . $companys['email'] . " <br>";
            $body    = $body . " " . $companys['companyurl'] . " <br>";
            sendEmail($to, $subject, $body, 'imp_connect_do');
            $error   = "success";
            $subject = "Successfuly";
            $msg     = "the upline has been changed";
         } else {
            $error   = "error";
            $subject = "Oops, Something went wrong";
            $msg     = "Call the administrator";
         }

         clientlogs('The ' . $user->username . ' has been change the upline of ' . $account . ' to ' . $new_upline . ', and Successfuly ', 'UPDATE');

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
function getIdentitas($account)
{
   global $DB;
   $query = "SELECT
  client_accounts.`accountname`,
  client_aecode.`email`,
  client_aecode.`name`
  FROM
  client_accounts,
  client_aecode
  WHERE client_accounts.`accountname` = '$account'
  AND client_aecode.`aecodeid` = client_accounts.`aecodeid`";
   $result = $DB->execresultset($query);
   foreach ($result as $rows) {
      $datas = $rows;
   }
   return $datas;
}
function sendEmail($to, $subject, $body, $module)
{
   global $DB;
   $timeupdate = date('Y-m-d H:i:s', strtotime('-1 hour'));
   $query      = "insert into email set
  timeupdate = '$timeupdate',
  email_to = '$to',
  email_subject = '$subject',
  email_body = '$body',
  timesend = '1970-01-31 00:00:00',
  module = '$module'
  ";
   $DB->execonly($query);
}

//function create_or_use_upline($group_play,$email){
