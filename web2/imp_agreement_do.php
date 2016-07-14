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

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

// $_SESSION['page'] = 'imp_agreement';

/*====================================
=            Start Coding            =
====================================*/

// print_r($_POST);
$query = "INSERT INTO imp_req SET accountname = '".@$_POST['accountname']."'";
$insert = $DB->execonly($query);
if ($insert) {
    $error = "success";
}else{
    $error = "error";
}

$response['error'] =  $error;

echo json_encode($response);
$iden = getIdentitas($data['account']);
                
                $to = $iden['email'];
                $subject = "Congratulations, you have got a bonus";
                $body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
                $body = $body . "Dear ".$iden['name'].",<br>";
                $body = $body . " <br>";
                $body = $body . "Congratulations, you have earned <b>RANK QUALIFICATION BONUS (R.Q.B)</b> bonus of USD ".number_format($data['topay']['total'], 2)." <br>";
                $body = $body . "This bonus will be split into two type Account (70% goes to E-Wallet / 30% goes to Gold Saving Account) <br>";
                $body = $body . " <br>";
                $body = $body . "You may login to your APR program account via our website at ".$companys['companyurl']." <br>";
                $body = $body . " <br>";
                $body = $body . " <br>";
                $body = $body . "Thank you,<br>";
                $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
                $body = $body . $companys['long_address'];
                $body = $body . " Email : ".$companys['email']." <br>";
                $body = $body . " ".$companys['companyurl']." <br>";
                sendEmail($to, $subject, $body, 'ar_admin_rqb');

/*=====  End of Start Coding  ======*/


// $template->display("imp_agreement.htm");

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
function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
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