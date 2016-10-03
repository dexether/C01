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
$token   = @($_POST['token']);
$account = @($_POST['cabinetid']);
$party   = @($_POST['party']);
$ib      = @($_POST['ib']);
$number  = @($_POST['number']);
$id      = @($_POST['id']);

/*====================================
=            Start Coding            =
====================================*/
if ($error != 'error') {
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($security->get($token)) {
         $security->delete($token);
         if ($postmode == 'new') {
            $query = "INSERT INTO mlm2 SET ACCNO = '$account ', mt4dt = '$ib', mt4login = '$number'";
            $DB->execonly($query);
            clientlogs('The '.$user->username.' has Adding the Thirty parties For Cabinet ID $account to $ib with number $number. and successfuly', 'ADD');

            $query  = "SELECT alias FROM mt_database WHERE mt4dt = '$ib'";
            $result = $DB->execresultset($query);

            $iden    = getIdentitas($account);
            $to      = $iden['email'];
            $subject = "Your Cabinet ID Setting has been updated by Administrator";
            $body    = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
            $body    = $body . "Dear " . $iden['name'] . ",<br>";
            $body    = $body . " <br>";
            $body    = $body . "Your Cabinet ID $account have SET to $party on " . $result[0]['alias'] . " by Administrator<br>";
            $body    = $body . " <br>";
            $body    = $body . "You may login to your APR program account via our website at " . $companys['companyurl'] . " <br>";
            $body    = $body . " <br>";
            $body    = $body . " <br>";
            $body    = $body . "Thank you,<br>";
            $body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
            $body    = $body . $companys['long_address'];
            $body    = $body . " Email : " . $companys['email'] . " <br>";
            $body    = $body . " " . $companys['companyurl'] . " <br>";
            sendEmail($to, $subject, $body, 'imp_account_mm_do');

            $error   = "success";
            $subject = "Success";
            $msg     = "The Cabinet ID has ben Set to Meta LOGIN number $number";
         } elseif ($postmode == 'delete_do') {
            $query  = "SELECT ACCNO, mt4login FROM mlm2 WHERE id = '$id'";
            $result = $DB->execresultset($query);
            foreach ($result as $key => $value) {
               $memberdata = $value;
            }
            $query = "DELETE FROM mlm2 WHERE id = '$id'";
            $do    = $DB->execonly($query);
            if ($do) {
               clientlogs('The '.$user->username.' has Delete the Thirty parties For Cabinet ID $memberdata[ACCNO] to LOGIN $memberdata[mt4login]. and successfuly', 'DELETE');
               $iden    = getIdentitas($memberdata['ACCNO']);
               $to      = $iden['email'];
               $subject = "Your Cabinet ID Sync Setting has been updated by Administrator";
               $body    = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
               $body    = $body . "Dear " . $iden['name'] . ",<br>";
               $body    = $body . " <br>";
               $body    = $body . "Your Sync connection from Cabinet ID ".$iden['accountname']." to Meta LOGIN Number : ".$memberdata['mt4login']." has been deleted by Administrator<br>";
               $body    = $body . "If you feel this an error, or you have any question, plese contact us @ ".$companys['admin_email']."";
               $body    = $body . " <br>";
               $body    = $body . "You may login to your " . $companys['programname'] . " account via our website at " . $companys['companyurl'] . " <br>";
               $body    = $body . " <br>";
               $body    = $body . " <br>";
               $body    = $body . "Thank you,<br>";
               $body    = $body . "<br><strong>" . $companys['programname'] . "</strong>" . "<br>";
               $body    = $body . $companys['long_address'];
               $body    = $body . " Email : " . $companys['email'] . " <br>";
               $body    = $body . " " . $companys['companyurl'] . " <br>";
               sendEmail($to, $subject, $body, 'imp_account_mm_do');
               $error   = "success";
               $subject = "Delete data successfuly";
               $msg     = "Delete the Sync on member " . $memberdata['ACCNO'] . " link to " . $memberdata['mt4login'] . " has been successfuly";
            }
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
