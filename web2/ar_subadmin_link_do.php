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
$errno    = 0;
$subject  = "Success !";
$msg      = "Your request has been complete";
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
$token = array();
if (isset($_POST['token'])) {
    $token = $_POST['token'];
}
$aecode = array();
if (isset($_POST['aecode'])) {
    $aecode = $_POST['aecode'];
}
$name = array();
if (isset($_POST['name'])) {
    $name = $_POST['name'];
}

$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
/*====================================
=            Start Coding            =
====================================*/
if ($postmode == 'document') {
    if ($errno == 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($security->get($token)) {
                $security->delete($token);
                // Insert
                $query = "UPDATE client_aecode SET STATUS = '1' WHERE client_aecode.`aecode`= '$aecode'";
                $DB->execonly($query);
                $error   = "success";
                $subject = "Succes";
                $msg     = "Your request Success";
				
				// Send Email
				$subject = "Congratulations, the user account is already in activation";
				$to = $aecode;
				$body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
				$body = $body . "Dear ".$name.",<br>";
				$body = $body . " <br>";
				// $body = $body . "Congratulations, you have earned <b>WEALTH CLUB BONUS (W.C.B)</b> bonus of USD ".number_format($total_bonus, 2)." <br>";
				// $body = $body . "This bonus will be split into two type Account (70% goes to E-Wallet / 30% goes to Gold Saving Account) <br>";
				// $body = $body . " <br>";
				$body = $body . "Congratulations, the user account already in the activation, you already can use your user account<br>";
				$body = $body . " <br>";
				$body = $body . " <br>";
				$body = $body . "Thank you," . "<br>";
				$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
				$body = $body . $companys['long_address'];
				$body = $body . " Email : ".$companys['email']." <br>";
				$body = $body . " ".$companys['companyurl']." <br>";

				sendEmail($to, $subject, $body , 'ar_subadmin_link');
            } else {
                // echo 'Ga Valid.'; // invalid
                $error   = "error";
                $subject = "Oops, Something was happened";
                $msg     = "Try refresing the web page";
            }

        }
    }
}

/*=====  End of Start Coding  ======*/

$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
// header("Content-Type: application/json;charset=utf-8");
echo json_encode($response);

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

function myfilter($input_var_outer, $param){
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

function TradeLogUnderConstruct_Secure($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
