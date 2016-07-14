<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;

//tradeLogConstruct("UnderConstruct.php-Line-9");

/*=======================================
=            Start of coding            =
=======================================*/

$IDPay = "";
if (isset($_POST['IDPay'])) {
	$IDPay = $_POST['IDPay'];
}
$status = "";
if (isset($_POST['status'])) {
  $status = $_POST['status'];
}
$postmode = "no";
if (isset($_POST['postmode'])) {
  $postmode = $_POST['postmode'];
}
if($postmode != 'yes') {
  $query = "SELECT 
  mlm_payment.IDPay,
  mlm_payment.aecode,
  mlm_payment.Account,
  mlm_payment.PayType,
  mlm_payment.TxnDate,
  mlm_payment.TxnTime,
  mlm_payment.PayDoc,
  mlm_payment.Amount,
  client_aecode.name
  FROM
  client_aecode,
  mlm_payment
  WHERE
  mlm_payment.aecode = client_aecode.aecode
  AND IDPay = '".$IDPay."'";
  $dataconfirms2 = "";
  $result = $DB->execresultset($query);
  foreach($result as $row) {
   $dataconfirms2 = $row;
 }

 $template->assign("dataconfirms2", $dataconfirms2);
 /*=====  End of Start of coding  ======*/

 $template->display("ar_admin_payment_modal.htm");
}else{
  /* POSTMODE */
  $query = "UPDATE mlm_payment SET status = '$status', date_confirm = NOW() WHERE IDPay = '$IDPay' ";
  $DB->execonly($query);
    /*<tr>
      <th>Account</th>
      <th>Payment Type</th>
      <th>Payment Method</th>
      <th>Date Of Payment</th>
      <th>Payment Status</th>
      <th>Payment Action</th>
    </tr>*/
  }
  function tradeLogConstruct($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
  }


  ?>