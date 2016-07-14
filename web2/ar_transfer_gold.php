<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
global $user;
global $DB;
$err = 'success';
$postmode = "no";
$msg = "Default message";
$subject = "Default subject";
if (isset($_POST['postmode'])) {
    $postmode = $_POST['postmode'];
}
$amount = 0;
if (isset($_POST['amount'])) {
    $amount = $_POST['amount'];
}
$from = 0;
if (isset($_POST['from'])) {
    $from = $_POST['from'];
}
$to = 0;
if (isset($_POST['to'])) {
    $to = $_POST['to'];
}
$wallet = 0;
if (isset($_POST['wallet'])) {
    $wallet = $_POST['wallet'];
    if ($wallet=="Gold Saving") {
        $tb = "mlm_goldsaving";
    }else{
        $tb = "mlm_ewallet";
    }
}
// Transfer Validation
// header('Content-Type: application/json');
$quey = "SELECT balance FROM mlm_goldsaving WHERE account = '$from'";
$result = $DB->execresultset($quey);
foreach($result as $rows) {
    $balance1 = $rows['balance'];
}

$quey = "SELECT balance FROM $tb WHERE account = '$to'";
$result = $DB->execresultset($quey);
foreach($result as $rows) {
    $balance2 = $rows['balance'];
}
if ($balance1 < $amount) {
    $msg = "Sorry, your balance is not enought";
    $err = 'error';
    $subject = 'Error while transfer';
}
if ($from == $to && $wallet == 'Gold Saving') {
    TradeLogUnderConstruct_Secure('ar_transfer-58 : ' . $from . " " . $to . " " . $wallet);
    $msg = "Sorry, transfers on the same account are not allowed";
    $err = 'error';
    $subject = 'Error while transfer';
}

if ($err == 'success') {
    if ($postmode=="yes") {
        // TradeLogUnderConstruct_Secure('ar_transfer-58 : ' . $postmode);
        $query = "INSERT INTO mlm_transaction
        SET type_transaction = 'transfer-gold',
        date_transaction = NOW(),
        account_from = '$from',
        amount = '$amount',
        account_destination = '$to',
        method_transaction = '$wallet',
        comment = 'transfer from Gold Saving to $wallet account',
        status = '0'";
        $doit = $DB->execonly($query);
        if ($doit) {
            $err = "success";
            $msg = "your request has been sent, we will process your request as quickly as possible";
            $subject = "Success !";
            // TradeLogUnderConstruct_Secure('ar_transfer-71 : ' . $err);
        }else{
            $err = "error";
            $msg = "please call the application publisher";
            $subject = "Oops, something went wrong";
            // TradeLogUnderConstruct_Secure('ar_transfer-71 : ' . $err);
        }
    }
}
header('Content-Type: application/json');
$response = array('status' => $err, 'msg' => $msg, 'subject' => $subject);

echo json_encode($response);

function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader2.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>