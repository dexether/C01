<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

$accountname = '';
if (isset($_POST['account2'])) {
    $accountname = $_POST['account2'];
}
$IDPay = '';
if (isset($_POST['IDPay'])) {
    $IDPay = $_POST['IDPay'];
}
$account2 = '';
if (isset($_POST['account2'])) {
    $account2 = $_POST['account2'];
}
$date = '';
if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $pecah = explode(" ", $date);
    $date = $pecah[0];
    $time = $pecah[1];
}
$paymenttype = '';
if (isset($_POST['paymenttype'])) {
    $paymenttype = $_POST['paymenttype'];
}
$paymentmethod = '';
if (isset($_POST['paymentmethod'])) {
    $paymentmethod = $_POST['paymentmethod'];
}
$amount = '';
if (isset($_POST['amount'])) {
    $amount = $_POST['amount'];
    $amount = clean($amount);
}
$account = '';
if (isset($_POST['account'])) {
    $account = $_POST['account'];
}
$agent = '';
if (isset($_POST['agent'])) {
    $agent = $_POST['agent'];
}
/*====================================
=            Start Coding            =
====================================*/
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
    $companys = $rows;
    $companys['year'] = $years;
}
$file = array();
$targetPath = "";
if (isset($_FILES)) {
    $file = $_FILES['file'];
}


if(!empty($file)) {
    if(is_uploaded_file($file['tmp_name'])) {
        $file['name'] = $accountname."_".$paymentmethod."_".$date.".jpg";
        $sourcePath = $file['tmp_name'];
        $targetPath = "images/data/payment/".$file['name'];
        if(move_uploaded_file($sourcePath,$targetPath)) {
        }
    }
}

/*$query = "
INSERT INTO mlm_payment SET
aecode = '".$user->username."',
MerchantID = '',
Account = '".$accountname."',
Amount = '".$amount."',
TxnDate = '".$date."',
TxnTime = '".$time."',
PayType = '".$paymenttype."',
PayMethod = '".$paymentmethod."',
Status = '1',
keterangan = 'agen:".$agent."',
PayDoc = '".$targetPath."'

";*/

$query = "
UPDATE mlm_payment SET
aecode = '".$user->username."',
MerchantID = '',
Account = '".$account2."',
Amount = '".$amount."',
TxnDate = '".$date."',
TxnTime = '".$time."',
PayType = '".$paymenttype."',
PayMethod = '".$paymentmethod."',
Status = '1',
keterangan = 'agen:".$agent."',
PayDoc = '".$targetPath."'
WHERE IDPay = '".$IDPay."'
";
$DB->execonly($query);
if ($query) {


    $query = "SELECT 
    NAME,
    email 
    FROM
    client_aecode 
    WHERE client_aecode.aecode = '".$user->username."'";
    $result = $DB->execresultset($query);
    foreach($result as $rows){
        $name = $rows['NAME'];
        $email = $rows['email'];
    }
    

    $body = "Dear ".$name.",<br>";
    $body = $body . " <br>";
    $body = $body . "Thank you for submitting payment documents, we will confirm your payment within 1 x 24 hours, if you have any questions please contact us at <strong>finance@apexregent.com</strong> <br>";
    $body = $body . " <br>";
    $body = $body . "Thank you," . "<br>";
    $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
            $body = $body . $companys['long_address'];
            $body = $body . " Email : ".$companys['email']." <br>";
            $body = $body . " ".$companys['companyurl']." <br>";

    $query = "UPDATE mlm SET payment = '1' WHERE ACCNO = ".$accountname."";
    $DB->execonly($query);

    $query = "INSERT INTO email SET
    timeupdate = NOW(),
    email_to = '$email',
    email_subject = 'Payment Confirmation',
    email_body = '$body',
    module = 'ar_payment'
    ";
    $DB->execonly($query);
    echo "0";
}

/*=====  End of Start Coding  ======*/


// var_dump(clean($amount));

/*----------  Function  ----------*/
function clean($string) {
    $pecah = explode('.', $string);
    $string = $pecah[0];
    $string = str_replace('.', '', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

?>