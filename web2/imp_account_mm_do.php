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
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
  $companys = $rows;
  $companys['year'] = $years;
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

  // Conditional
  if ($state == 1) {
    // Suspend
    $subject = "Information for suspension Account";
    $themesege = "This account : ".$account." has suspended by Administrator, if this is a mistake, Contact us at ".$companys['admin_email']."";
  }else{
    // Not Susped
    $subject = "Your account is active, Welcome";
    $themesege = "This account : ".$account." has confirmed by Administrator, Welcome to ".$companys['companyname']."";
    $query = "UPDATE mlm SET companyconfirm = '2' WHERE ACCNO = '$account'";
    $DB->execonly($query);
  }

  // Send Email To Client
  $iden = getIdentitas($account);
  $to = $iden['email'];
  
  $body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
  $body = $body . "Dear ".$iden['name'].",<br>";
  $body = $body . " <br>";
  $body = $body . "".$themesege." <br>";
  $body = $body . " <br>";
  $body = $body . "You may login to your APR program account via our website at ".$companys['companyurl']." <br>";
  $body = $body . " <br>";
  $body = $body . " <br>";
  $body = $body . "Thank you,<br>";
  $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
  $body = $body . $companys['long_address'];
  $body = $body . " Email : ".$companys['email']." <br>";
  $body = $body . " ".$companys['companyurl']." <br>";
  sendEmail($to, $subject, $body, 'imp_account_mm_do');


}elseif ($postmode == 'reject') {
  $iden = getIdentitas($account);
  $to = $iden['email'];
  $subject = "Account Request on ".$companys['programname']."";
  $body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
  $body = $body . "Dear ".$iden['name'].",<br>";
  $body = $body . " <br>";
  $body = $body . "About your request of Account $account, the request has been rejected by Admin.<br>";
  $body = $body . "We apologize for your request that we can not fill. Thank you has participated<br>";
  $body = $body . " <br>";
  $body = $body . "You may login to your APR program account via our website at ".$companys['companyurl']." <br>";
  $body = $body . " <br>";
  $body = $body . " <br>";
  $body = $body . "Thank you,<br>";
  $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
  $body = $body . $companys['long_address'];
  $body = $body . " Email : ".$companys['email']." <br>";
  $body = $body . " ".$companys['companyurl']." <br>";
  sendEmail($to, $subject, $body, 'imp_account_mm_do');

  $delete = "DELETE FROM client_accounts WHERE accountname = '$account'";
  $DB->execonly($delete);
  $delete = "DELETE FROM mlm WHERE ACCNO = '$account'";
  $DB->execonly($delete);
  $delete = "DELETE FROM mlm_bonus_logs WHERE account = '$account'";
  $DB->execonly($delete);
  $delete = "DELETE FROM mlm_ewallet WHERE account = '$account'";
  $DB->execonly($delete);
  $delete = "DELETE FROM mlm_goldsaving WHERE account = '$account'";
  $DB->execonly($delete);
  $delete = "DELETE FROM mlm_payment WHERE account = '$account'";
  $DB->execonly($delete);
  $delete = "DELETE FROM mlm_wcb WHERE account = '$account'";
  $DB->execonly($delete);
  $delete = "DELETE FROM mlm_wcd WHERE account = '$account'";
  $DB->execonly($delete);
  
  $error = "success";
  $errno = 0;
  $subject = "Success !";
  $msg = "Your request has been complete";
  $response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
  // header("Content-Type: application/json;charset=utf-8");
  echo json_encode($response);

}

/*=====  End of Start Coding  ======*/



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
function getIdentitas($account) {
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
  foreach($result as $rows) {
    $datas = $rows;
  }
  return $datas;
}
function sendEmail($to, $subject, $body, $module) {
  global $DB;
  $timeupdate = date('Y-m-d H:i:s', strtotime('-1 hour'));
  $query = "insert into email set
  timeupdate = '$timeupdate',
  email_to = '$to',
  email_subject = '$subject',
  email_body = '$body',
  timesend = '1970-01-31 00:00:00',
  module = '$module'    
  ";
  $DB->execonly($query);
}
function tradeLogs($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>