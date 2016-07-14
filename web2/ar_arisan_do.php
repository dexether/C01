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
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}
$token = "";
if (isset($_POST['token'])) {
    $token = $_POST['token'];
}
$account = "";
if (isset($_POST['account'])) {
    $account = $_POST['account'];
}
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
    $companys = $rows;
    $companys['year'] = $years;
}
// print_r($_POST);
$error = "success";
$subject = "Oops, Something was happened";
$msg = "contact software publisher";

if (empty($account)) {
    $error = "error";
    $subject = "Empty Account";
    $msg = "Sorry, the account was incorret";

}

/*====================================
=            Start Coding            =
====================================*/
if($error != 'error') {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($security->get($token)) {
          $security->delete($token);
            $query = "SELECT COUNT(mlm_arisan.`id`) AS number FROM mlm_arisan";
            $result = $DB->execresultset($query);
            $urutan = $result[0]['number'] + 1;
            $arisan_account = $account . "-". $urutan;
            $query = "INSERT INTO mlm_arisan_account SET accountname = '$account', arisan_account = '$arisan_account' , date_create = NOW(), date_modify = NOW(), payment = '0', status = 'real', finished = '0'";
            $DB->execonly($query);

            $query = "INSERT INTO mlm_payment SET aecode = '$user->username', Account = '$account', PayType = 'Wealth Pool', Status = '0', PayFor = 'arisan:".$arisan_account."'";
            $DB->execonly($query);

            $iden = getIdentitas($account);
            $subject = "Weatlh Pool Pier Account created";
            $body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
            $body = $body . "Dear ".$iden['name'].",<br>";
            $body = $body . " <br>";
            $body = $body . "We have accept your account request for Weatlh Pool Pier (".$arisan_account."), next you should pay to company and Confirm your payment at ".$companys['programname']."<br>";
            $body = $body . "Thanks for your participation <br>";
            $body = $body . "You may login to your APR program account via our website at ".$companys['companyurl']." <br>";
            $body = $body . " <br>";
            $body = $body . " <br>";
            $body = $body . "Thank you," . "<br>";
            $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
            $body = $body . $companys['long_address'];
            $body = $body . " Email : ".$companys['email']." <br>";
            $body = $body . " ".$companys['companyurl']." <br>";
            sendEmail($iden['email'], $subject, $body, 'ar_admin_payment_table');


            $error = "success";
            $subject = "Your Account for this plan has been create ";
            $msg = "congratulation, you account is ".$arisan_account." you will redirect to payment confirmation page";
        } else {
          // echo 'Ga Valid.'; // invalid
          $error = "error";
          $subject = "Oops, Something has happened";
          $msg = "Try refresing the web page";
      }

    }
}
$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
// header("Content-Type: application/json;charset=utf-8");
echo json_encode($response);
/*=====  End of Start Coding  ======*/
function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
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
?>