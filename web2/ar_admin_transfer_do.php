<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
global $user;
global $DB;
$error = "success";
$title = "No Action needed";
$msg = "The action is default state";
$postmode = "no";
if (isset($_POST['postmode'])) {
    $postmode = $_POST['postmode'];
}
$id = 0;
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
    $companys = $rows;
    $companys['year'] = $years;
}

$query = "SELECT * FROM mlm_transaction WHERE id = '$id'";
$result = $DB->execresultset($query);
foreach($result as $rows){
    $acc_from = $rows['account_from'];
    $acc_desc = $rows['account_destination'];
    $amount = $rows['amount'];
    $methode = $rows['method_transaction'];
    $type = $rows['type_transaction'];
    if ($type == 'transfer') {
        $tb = "mlm_ewallet";
    }elseif ($type == 'transfer-gold') {
        $tb = "mlm_goldsaving";
    }
    if ($rows['method_transaction'] == "E - Wallet") {
        $tb2 = "mlm_ewallet";
    }elseif ($rows['method_transaction'] == "Gold Saving") {
        $tb2 = "mlm_goldsaving";
    }
}

$query = "SELECT balance, lastupdate_prev FROM $tb WHERE account = '$acc_from'";
    // echo $query . "<br>";
$result = $DB->execresultset($query);
foreach($result as $rows){
    $balance1 = $rows['balance'];
    $lastupdate_prev1 = $rows['lastupdate_prev'];
}

$query = "SELECT balance, lastupdate_prev FROM $tb2 WHERE account = '$acc_desc'";
    // echo $query . "<br>";
$result = $DB->execresultset($query);
foreach($result as $rows){
    $balance2 = $rows['balance'];
    $lastupdate_prev2 = $rows['lastupdate_prev'];
}

if ($balance1 <= $amount) {
    $msg = "This balance for this account is not enought, this request will rejected";
    $err = 'error';
    $title = 'Error while transfer';
    $query = "UPDATE mlm_transaction SET status = '1' WHERE id = '$id'";
    $DB->execonly($query);
}
if ($error = "success" && $postmode == "yes") {
    $balancefor2 = $balance2 + $amount;
    $balancefor1 = $balance1 - $amount;
    if ($methode == "E - Wallet") {
        $balancefor1 = $balancefor1 - 1.00;
        $query = "SELECT balance, lastupdate_prev FROM mlm_ewallet WHERE account = 'COMPANY'";
        $result = $DB->execresultset($query);
        $balanceforcompany = $result[0]['balance'] + 1.00;
        $query = "UPDATE mlm_ewallet SET balance = '$balanceforcompany', balance_prev = '".$result[0]['balance']."', lastupdate = NOW(), lastupdate_prev = '".$result[0]['lastupdate_prev']."' WHERE account = 'COMPANY'";
        $DB->execonly($query);
        // Send Email
        $to = $companys['admin_email'];
        $subject = "Notice of transfer fees";
        $body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
        $body = $body . "Dear COMPANY,<br>";
        $body = $body . " <br>";
        $body = $body . "Companies get income from Transfer fees of ".$companys['programname']." account. from account ".$acc_from." to account ".$acc_desc." amounting to USD ".$amount.", COMPANY only get USD 1.00 from this transaction<br>";
        $body = $body . " <br>";
        $body = $body . "and has been added to the wallet companies<br>";
        $body = $body . " <br>";
        $body = $body . " <br>";
        $body = $body . "Thank you,<br>";
        $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
        $body = $body . $companys['long_address'];
        $body = $body . " Email : ".$companys['email']." <br>";
        $body = $body . " ".$companys['companyurl']." <br>";
        sendEmail($to, $subject, $body, 'ar_admin_transfer_do');
    }
    $query = "UPDATE $tb2 SET balance = '$balancefor2', balance_prev = '$balance2', lastupdate = NOW(), lastupdate_prev = '$lastupdate_prev1' WHERE account = '$acc_desc'";
    $DB->execonly($query);
    $query = "UPDATE $tb SET balance = '$balancefor1', balance_prev = '$balance1', lastupdate = NOW(), lastupdate_prev = '$lastupdate_prev2' WHERE account = '$acc_from'";
    $DB->execonly($query);
    $query = "UPDATE mlm_transaction SET status = '2' WHERE id = '$id'";
    $DB->execonly($query);
    $error = "success";
    $title = "Success !";
    $msg = "This Transfer has been confirmed";

    $data1 = getIdentitas($acc_from);
    $data2 = getIdentitas($acc_desc);
    // Send To Akun yang transfer
    $to = $data1['email'];
    $subject = "Transfer Notification";
    $body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
    $body = $body . "Dear ".$data1['name'].",<br>";
    $body = $body . " <br>";
    $body = $body . "application for transfer from account ".$acc_from." to account ".$acc_desc." amounting to USD ".$amount.", <b>we have approved.</b><br>";
    $body = $body . " <br>";
    $body = $body . "You may login to your ".$companys['programname']." account via our website at ".$companys['companyurl']." <br>";
    $body = $body . " <br>";
    $body = $body . " <br>";
    $body = $body . "Thank you,<br>";
    $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
    $body = $body . $companys['long_address'];
    $body = $body . " Email : ".$companys['email']." <br>";
    $body = $body . " ".$companys['companyurl']." <br>";
    sendEmail($to, $subject, $body, 'ar_admin_transfer_do');

    // Send to akun yang di transfer

    $to = $data2['email'];
    $subject = "Transfer Notification";
    $body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
    $body = $body . "Dear ".$data2['name'].",<br>";
    $body = $body . " <br>";
    $body = $body . "you have received from ".$acc_from." transfer of USD ".$amount."<br>";
    $body = $body . " <br>";
    $body = $body . "You may login to your ".$companys['programname']." account via our website at ".$companys['companyurl']." <br>";
    $body = $body . " <br>";
    $body = $body . " <br>";
    $body = $body . "Thank you,<br>";
    $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
    $body = $body . $companys['long_address'];
    $body = $body . " Email : ".$companys['email']." <br>";
    $body = $body . " ".$companys['companyurl']." <br>";
    sendEmail($to, $subject, $body, 'ar_admin_transfer_do');

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

header('Content-Type: application/json');
$response = array('status' => $error, 'msg' => $msg, 'subject' => $title);

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