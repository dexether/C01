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
if (isset($user)) {
   $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
   $postmode = $_GET['postmode'];
}
$token = "";
if (isset($_POST['token'])) {
   $token = $_POST['token'];
}
$method = "";
if (isset($_POST['method'])) {
   $method = $_POST['method'];
}
$account = "";
if (isset($_POST['account'])) {
   $account = $_POST['account'];
}
$bankaccount = "";
if (isset($_POST['bankaccount'])) {
   $bankaccount = $_POST['bankaccount'];
}
$amount = "";
if (isset($_POST['amount'])) {
   $amount = $_POST['amount'];
}

$currency_id = @$_POST['currency_id'];
/**
 * Error msg
 * 0 - success
 * 1 - error
 */
$errno   = 0;
$error   = "error";
$subject = "Oops, Something was happened";
$msg     = "contact software publisher";

$query  = "SELECT balance FROM mlm_ewallet WHERE account = '$account'";
$result = $DB->execresultset($query);
foreach ($result as $key => $rows) {
   $balance = $rows['balance'];
}

if ($balance < $amount || $amount <= 26.25) {
   $errno   = 1;
   $error   = "error";
   $subject = "Sorry, Request failed";
   $msg     = "your balance for ACCNO $account is Not enought Minimal USD 26.25";
}

/*==============================
=            coding            =
==============================*/
if ($errno == 0) {
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($security->get($token)) {
         $security->delete($token);
         
         // Cutting wallet
         $output = cutwallet($account, 'mlm_ewallet', $amount);
         if ($output) {
            $query = "INSERT INTO mlm_transaction SET currency_id ='$currency_id', type_transaction = 'withdrawal', date_transaction = NOW(), account_from = '$account' , account_destination = '0', method_transaction = 'withdrawal', amount = '$amount', comment = 'withdrawal request from $account of USD $amount', status = '0'";
            $DB->execonly($query);

            $query  = "SELECT * FROM usercompany";
            $result = $DB->execresultset($query);
            foreach ($result as $rows) {
               $companys = $rows;
            }

			$query = "SELECT value FROM app_config WHERE `key` = 'AR_WITHDRAWAL_TAX'";
			$result = $DB->execresultset($query);
			$tax = '';
			foreach($result as $row){
				$tax = $row['value'];
			}
			$after_tax = $amount - ($amount * $tax / 100);
			logstrade("After tax :".$after_tax);

            $to      = $companys['finance_email'];
            $subject = "A Withdrawal request from $account";
            $body    = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
            $body    = $body . "Dear " . $companys['companyname'] . ",<br>";
            $body    = $body . " <br>";
            $body    = $body . "Withdrawal requests from user $account of USD $amount (After Tax USD $after_tax), check the " . $companys['programname'] . " to confirm after transfer<br>";
            $body    = $body . " <br>";
            $body    = $body . "You may login to your program account via our website at " . $companys['companyurl'] . " <br>";
            $body    = $body . " <br>";
            $body    = $body . " <br>";
            $body    = $body . "Thank you,<br>";
            $body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
            $body    = $body . $companys['long_address'];
            $body    = $body . " Email : " . $companys['email'] . " <br>";
            $body    = $body . " " . $companys['companyurl'] . " <br>";
            sendEmail($to, $subject, $body, 'Withdrawal_do');
            // ------------------------------------
            $userdata = getIdentitas($account);
            $to       = $userdata['email'];
            $subject  = "A Withdrawal request from $account";
            $body     = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
            $body     = $body . "Dear " . $userdata['name'] . ",<br>";
            $body     = $body . " <br>";
            $body     = $body . "Withdrawal requests from user $account of USD $amount (After Tax USD $after_tax) , we have send to Finance Department. We will inform you as soon as possible for the progress<br>";
            $body     = $body . " <br>";
            $body     = $body . "You may login to your program account via our website at " . $companys['companyurl'] . " <br>";
            $body     = $body . " <br>";
            $body     = $body . " <br>";
            $body     = $body . "Thank you,<br>";
            $body     = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
            $body     = $body . $companys['long_address'];
            $body     = $body . " Email : " . $companys['email'] . " <br>";
            $body     = $body . " " . $companys['companyurl'] . " <br>";
            sendEmail($to, $subject, $body, 'Withdrawal_do');
            $error   = "success";
            $subject = "Succes";
            $msg     = "Your request has been send to Admin";
         } else {
            $error   = "error";
            $subject = "Oops, We found an error";
            $msg     = "Error while processing your request, contact Admin";
         }

      } else {
         // echo 'Ga Valid.'; // invalid
         $error   = "error";
         $subject = "Oops, Something was happened";
         $msg     = "Try refresing the web page";
      }

   }
}
$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
// header("Content-Type: application/json;charset=utf-8");
echo json_encode($response);

/*=====  End of coding  ======*/

function myfilter($input_var_outer, $param)
{
   global $var_to_pass;
   $var_to_pass = $param;

   function mycallback($input_var_inner)
   {
      global $var_to_pass;
      return ($input_var_inner == $var_to_pass) ? true : false;
   }

   $return_arr = array_filter($input_var_outer, 'mycallback');
   $return_arr = array_merge(array(), $return_arr);
   return $return_arr;
}

function logstrade($msg)
{
   $fp      = fopen("trader.log", "a");
   $logdate = date("Y-m-d H:i:s => ");
   $msg     = preg_replace("/\s+/", " ", $msg);
   fwrite($fp, $logdate . $msg . "\n");
   fclose($fp);
   return;
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

function cutwallet($account, $type, $amount)
{
   global $DB;
   $query  = "SELECT * FROM " . $type . " WHERE account = '$account'";
   $result = $DB->execresultset($query);
   foreach ($result as $key => $value) {
      $wallet = $value;
   }
   $balance_wallet = $wallet['balance'];
   $lastupdate     = $wallet['lastupdate'];
   $newbalance     = $balance_wallet - $amount;
   $query          = "UPDATE " . $type . " SET balance = '$newbalance', balance_prev = '$balance_wallet', lastupdate = NOW(), lastupdate_prev = '$lastupdate' WHERE account = '$account'";
   // logstrade($query);
   // logstrade($query);
   $do             = $DB->execonly($query);
   if ($do) {
      $output = true;
   } else {
      $output = false;
   }
   return $output;
}
