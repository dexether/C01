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

include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
$theFetchAccount = new theOtherFetchAccounts();
$cabang_admin = 'semua';
$accounts = $theFetchAccount->fetchAccountslangsung($user,$mysql['meta'],$cabang_admin);

$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}

$key = '';
if (isset($_SESSION['key'])) {
    $key = $_SESSION['key'];
}

$tools = new CTools();
$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
$variabel = explode("&", $data[0]); //a=1&account=802222&postmode=deposit&tradedby=ALBERTOSCARINA
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$account = $accountvariabel[1];
$lines = $lines . "&account=" . $account;
$linezip = gzcompress($lines);
$key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
$_SESSION['key'] = $key;

/*==============================
=        Start Coding          =
==============================*/
$mailnya = "";
if (isset($_GET['usermail'])) {
    $mailnya = $_GET['usermail'];
}
// var_dump($mailnya);
$usernya = "";
if (isset($_GET['namanya'])) {
    $usernya = $_GET['namanya'];
}
// var_dump($usernya);
$pass1 = "";
if (isset($_GET['Password1'])) {
    $pass1 = $_GET['Password1'];
}
// var_dump($pass1);
$hitpass1= strlen($pass1);
	// var_dump($hitpass1);
$pass2 = "";
if (isset($_GET['Password2'])) {
    $pass2 = $_GET['Password2'];
}
// var_dump($pass2);

$query = "SELECT 
			  * 
			FROM
			  usercompany 
			WHERE usercompany.`Id` = '3' ";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
    $companys = $rows;
    $companys['year'] = $years;
}

if ($mailnya == ""){
	echo 4;
}else if ($pass1 == ""){
	echo 1;
}else if ($pass2 == ""){
	echo 1;
}else if ($hitpass1 <= 3){
	echo 3;
}else if ($pass1 == $pass2) {
	
	$password = md5($pass2);
	// ke email
			// $ma = $mail;
			$timenya = date('Y-m-d H:i', strtotime('-1 hour'));
			$subject = "Admin Reset Password";
			$body = "Time: " . $timenya . "<br> <br>";
			$body = $body . "Dear $usernya<br>";
			$body = $body . "Your password has been changed <br>";
			$body = $body . "Now your password is $pass1<br>";
			$body = $body . " <br>";
			$body = $body . "Thank you," . "<br>";
			$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
            // $body = $body . " HotLine : +62-21-2954-3737<br>";
            // $body = $body . " Fax : +62-21-2954-3777 <br>";
            $body = $body . " Email : ".$companys['email']." <br>";
            $body = $body . " ".$companys['companyurl']." <br>";
			
			$query = "insert into email set
			timeupdate = NOW(),
			email_to = '$mailnya',
			email_subject = '$subject',
			email_body = '$body',
			timesend = '1970-01-31 00:00:00'";
			
			$DB->execonly($query);
			// var_dump($query);
					
			$query = "UPDATE user SET password = '" . $password . "' 
                        WHERE username = '" . $mailnya . "'";
                
                $DB->execonly($query);
				 // var_dump($query);
				 
			 
			 
			 echo 0;
}
	else {
		echo 2;	
} 
/*=====  End of Coding  ======*/
$template->display("car_admin_changepassword.htm");

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

?>