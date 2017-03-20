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
$errno    = 0;
$error    = "success";
$subject  = "No Action needed";
$msg      = "The action is default state";
$postmode = "no";
if (isset($_POST['postmode'])) {
   $postmode = $_POST['postmode'];
}
$token = "";
if (isset($_POST['token'])) {
   $token = $_POST['token'];
}
$id = 0;
if (isset($_POST['id'])) {
   $id = $_POST['id'];
}

$query  = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years  = date('Y', time());
foreach ($result as $rows) {
   $companys         = $rows;
   $companys['year'] = $years;
}

$query  = "SELECT * FROM mlm_transaction WHERE id = '$id'";
$result = $DB->execresultset($query);
foreach ($result as $rows) {
   $acc_from = $rows['account_from'];
   $acc_desc = $rows['account_destination'];
   $amount   = $rows['amount'];
   $methode  = $rows['method_transaction'];
   $type     = $rows['type_transaction'];
}

/*  Cari Upline */

    $condiional_header = "";
    $condiional_footer = "";


$query = "SELECT
		  client_aecode.name,
		  client_aecode.email,
		  client_accounts.`accountname`,
		  mlm.`ACCNO`
		FROM
		  client_aecode,
		  client_accounts,
		  mlm
		WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
		  AND client_accounts.`accountname` = mlm.`ACCNO`
		  AND mlm.`ACCNO` = '$acc_from' ";
$datatress = array();
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $datatress[$row['ACCNO']] = $row;
}
// var_dump($query);
$longtree = $condiional_header;
if (count($datatress) > 0) {
    foreach ($datatress AS $Upline => $datatres) {
		$key = 0;
        $longtree = $longtree .$Upline;
        $longtree = updatechild($longtree, $Upline);		
        $longtree = $longtree ;
		$key = $key + 1;
    }
}
$longtree = $longtree . $condiional_footer;
$template->assign("longtree", $longtree);
// var_dump($longtree);
$data = (explode(",",$longtree));
$hitung=count($data);
if ($hitung <= 7 ){
	$i = $hitung - 1;
}else{
	$i = 6;
}
// var_dump($i);
// var_dump($data);
/* End Cari Upline */

$query = "SELECT value FROM app_config WHERE `key` = 'AR_WITHDRAWAL_TAX'";
			$result = $DB->execresultset($query);
			$tax = '';
			foreach($result as $row){
				$tax = $row['value'];
			}
			$after_tax = $amount - ($amount * $tax / 100);

if ($postmode == 'approve') {
   $query  = "SELECT balance, lastupdate_prev FROM mlm_ewallet WHERE account = '$acc_from'";
   $result = $DB->execresultset($query);
   foreach ($result as $rows) {
      $balance         = $rows['balance'];
      $lastupdate_prev = $rows['lastupdate_prev'];
   }
   $realbalance = $amount + $balance;
   if ($realbalance < $amount) {
      $errno   = 1;
      $error   = "error";
      $subject = "Error While Processing";
      $msg     = "Sorry, The balance for account $acc_from is not enought";
      $query   = "UPDATE mlm_transaction SET status = '3' WHERE id = '$id'";
      $DB->execonly($query);
      $datas   = getIdentitas($acc_from);
      $to      = $datas['email'];
      $subject = "Withdrawal request";
      $body    = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
      $body    = $body . "Dear " . $datas['name'] . ",<br>";
      $body    = $body . " <br>";
      $body    = $body . "Companies has reject your withdrawal request because your balance for account " . $acc_from . " is not enought<br>";
      $body    = $body . " <br>";
      $body    = $body . " <br>";
      $body    = $body . "Thank you,<br>";
      $body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
      $body    = $body . $companys['long_address'];
      $body    = $body . " Email : " . $companys['email'] . " <br>";
      $body    = $body . " " . $companys['companyurl'] . " <br>";
      sendEmail($to, $subject, $body, 'ar_admin_withdrawal');
   }
}

/*==============================
=            coding            =
==============================*/
if ($errno == 0) {
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($security->get($token)) {
         $security->delete($token);
         if ($postmode == 'approve') {
            // Insert
            $query = "UPDATE mlm_transaction SET status = '2' WHERE id = '$id'";
            $DB->execonly($query);

            $datas   = getIdentitas($acc_from);
            $to      = $datas['email'];
            $subject = "Withdrawal request";
            $body    = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
            $body    = $body . "Dear " . $datas['name'] . ",<br>";
            $body    = $body . " <br>";
            $body    = $body . "Companies has approved your withdrawal request for account " . $acc_from . " of USD " . number_format($amount, 2) ."(After Tax USD ".$after_tax.")<br>";
            $body    = $body . "Check your BANK account<br>";
            $body    = $body . " <br>";
            $body    = $body . "Thank you,<br>";
            $body    = $body . "Finance Department<br>";
            $body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
            $body    = $body . $companys['long_address'];
            $body    = $body . " Email : " . $companys['email'] . " <br>";
            $body    = $body . " " . $companys['companyurl'] . " <br>";
            sendEmail($to, $subject, $body, 'ar_admin_withdrawal');

            $error   = "success";
            $subject = "Succes";
            $msg     = "The request has been approved";
			
			For($a=1;$a<=$i;$a++){
			  $query = "SELECT 
						  mlm.*,
						  mlm_bonus_settings.`lv`,
						  client_accounts.`suspend`
						FROM
						  mlm,
						  mlm_bonus_settings,
						  client_accounts
						WHERE mlm.`group_play`=mlm_bonus_settings.`group_play`
						AND mlm.`ACCNO`=client_accounts.`accountname`
						AND mlm.`ACCNO`='$data[$a]'";
						$uplinenya = array();
						$result = $DB->execresultset($query);
						foreach ($result as $row) {
							$uplinenya = $row;
							$uplinenya['bw'] = $amount*3/100 ;
						}
						// var_dump($query);
						// var_dump($uplinenya['bw']);
				if ($uplinenya['suspend']=='0'){
					if ($uplinenya['lv'] >= $a ){
						$query = "SELECT * FROM mlm_ewallet WHERE mlm_ewallet.`account`='$data[$a]'";
						$dataewall = array();
						$result = $DB->execresultset($query);
						foreach ($result as $row) {
							$dataewall = $row;
							}
						// var_dump($dataewall);
						// var_dump($dataewall['balance']);

						$newbalace =$dataewall['balance']+$uplinenya['bw'];
						// var_dump($newbalace);
						
						$timeupdate = date('Y-m-d H:i:s', strtotime('-1 hour'));
						$query   = "UPDATE 
									  mlm_ewallet 
									SET
									  balance = '$newbalace', 
									  balance_prev = '$dataewall[balance]',
									  lastupdate = '$timeupdate',
									  lastupdate_prev = '$dataewall[lastupdate]'
									WHERE mlm_ewallet.`account`='$data[$a]'";
						$DB->execonly($query);
						// var_dump($query);

						$query = "SELECT 
						  client_aecode.`aecode`,
						  client_aecode.`name` 
						FROM
						  client_aecode,
						  client_accounts 
						WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
						  AND client_accounts.`accountname`='$data[$a]'";
						$name = '';
						$aecode = '';
						$result = $DB->execresultset($query);
						foreach ($result as $row) {
							$aecode = $row['aecode'];
							$name = $row['name'];
						}
						// var_dump($query);

						// Send Email
						$subject = "Congratulations, Your bonus increases ";
						$to = $aecode;
						$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
						$body = $body . "Dear ".$name.",<br>";
						$body = $body . " <br>";
						$body = $body . "Congratulations, Your bonus increases<br>";
						$body = $body . "Because your downline make withdrawals from their accounts<br>";
						// $body = $body . " <br>";
						// $body = $body . "Congratulations, Your bonus increases of bonus withdrawal<br>";
						$body = $body . " <br>";
						$body = $body . " <br>";
						$body = $body . "Thank you," . "<br>";
						$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
						$body = $body . $companys['long_address'];
						$body = $body . " Email : ".$companys['email']." <br>";
						$body = $body . " ".$companys['companyurl']." <br>";

						sendEmail($to, $subject, $body , 'ar_subadmin_link');
						bonusLogs($data[$a], 'wdd', $uplinenya['bw'], 'you got Withdrawal Commision (3%) bonus From '.$acc_from.' amounted '.$uplinenya['bw'].'');
					}
					
				}
						
				
			}
			
         } elseif ($postmode == 'pending') {
            $query = "UPDATE mlm_transaction SET status = '1' WHERE id = '$id'";
            $DB->execonly($query);

            $datas   = getIdentitas($acc_from);
            $to      = $datas['email'];
            $subject = "Withdrawal request";
            $body    = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
            $body    = $body . "Dear " . $datas['name'] . ",<br>";
            $body    = $body . " <br>";
            $body    = $body . "We have received your withdrawal request " . $acc_from . " of USD " . number_format($amount, 2) . "(After Tax USD ".$after_tax.")<br>";
            $body    = $body . "We hope you can wait at least 3 days of work and we will process your request, status of your withdrawal request we will change to <strong>PENDING</strong>,<br>";
            $body    = $body . " <br>";
            $body    = $body . "Thank you,<br>";
            $body    = $body . "Finance Department<br>";
            $body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
            $body    = $body . $companys['long_address'];
            $body    = $body . " Email : " . $companys['email'] . " <br>";
            $body    = $body . " " . $companys['companyurl'] . " <br>";
            sendEmail($to, $subject, $body, 'ar_admin_withdrawal');

            $error   = "success";
            $subject = "Succes";
            $msg     = "The request has been change to Pending";
         } elseif ($postmode == 'reject') {
            $query = "UPDATE mlm_transaction SET status = '3' WHERE id = '$id'";
            $DB->execonly($query);

            pluswallet($acc_from, 'mlm_ewallet', $amount);

            $datas   = getIdentitas($acc_from);
            $to      = $datas['email'];
            $subject = "Withdrawal request";
            $body    = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
            $body    = $body . "Dear " . $datas['name'] . ",<br>";
            $body    = $body . " <br>";
            $body    = $body . "We have received your withdrawal request " . $acc_from . " of USD " . number_format($amount, 2) . "<br>";
            $body    = $body . "We are apologize , your Withdrawal request at this time we can not be processed . and we will change the status of your request to <strong> REJECTION</strong>,<br>";
            $body    = $body . "If you fill this is an mistake, you can email us at ".$companys['finance_email']." <br>";
            $body    = $body . " <br>";
            $body    = $body . "Thank you,<br>";
            $body    = $body . "Finance Department<br>";
            $body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
            $body    = $body . $companys['long_address'];
            $body    = $body . " Email : " . $companys['email'] . " <br>";
            $body    = $body . " " . $companys['companyurl'] . " <br>";
            sendEmail($to, $subject, $body, 'ar_admin_withdrawal');

            $error   = "success";
            $subject = "Succes";
            $msg     = "The request has been change to REJECTION";
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
function updatechild($longtree, $Upline2) {

  $longtree = $longtree . "";
	global $user;
    global $DB;
    $datatress = array();
    $query = "SELECT
		  client_aecode.name,
		  client_aecode.email,
		  client_accounts.`accountname`,
		  mlm.`Upline`
		FROM
		  client_aecode,
		  client_accounts,
		  mlm
		WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
		  AND client_accounts.`accountname` = mlm.`ACCNO`
		  AND mlm.`Upline` <> 'COMPANY'
		  AND mlm.`ACCNO` = '$Upline2' ";

    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $datatress[$row['Upline']] = $row;
    }
	// var_dump($datatress);
	// $hitung=count($datatress);
	$query = "SELECT
	mlm.`ACCNO`,
	mlm.`Upline`
	FROM
	mlm,
	client_accounts
	WHERE mlm.`ACCNO`=client_accounts.`accountname`
	AND mlm.`group_play`='Car'
	AND client_accounts.`email` ='$user->username' ";

	$rows = $DB->execresultset($query);
	$bm="";
	foreach ($rows as $row) {
		$bm = $row['Upline'];
	}
		// var_dump($bm);

    if (count($datatress) > 0) {
		
        foreach ($datatress AS $Upline1 => $datatres) {
			if ($bm != $Upline1){
				$longtree = $longtree . "," . $Upline1;
				$longtree = updatechild($longtree, $Upline1);
				$longtree = $longtree;
				// $hitung=count($longtree);
				// var_dump($hitung);
			}

        }
    }
    $longtree = $longtree . "";
	 // var_dump($longtree);
    return $longtree;
}

function bonusLogs($account, $type, $amount, $comment) {
	global $DB;
	$query = "INSERT INTO mlm_bonus_logs SET account = '$account', bonus_type = '$type', amount = '$amount', comment = '$comment', date_receipt = NOW()";
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

function TradeLogUnderConstruct_Secure($msg)
{
   $fp      = fopen("trader2.log", "a");
   $logdate = date("Y-m-d H:i:s => ");
   $msg     = preg_replace("/\s+/", " ", $msg);
   fwrite($fp, $logdate . $msg . "\n");
   fclose($fp);
   return;
}
function pluswallet($account, $type, $amount)
{
   global $DB;
   $query  = "SELECT * FROM " . $type . " WHERE account = '$account'";
   $result = $DB->execresultset($query);
   foreach ($result as $key => $value) {
      $wallet = $value;
   }
   $balance_wallet = $wallet['balance'];
   $lastupdate     = $wallet['lastupdate'];
   $newbalance     = $balance_wallet + $amount;
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
?>