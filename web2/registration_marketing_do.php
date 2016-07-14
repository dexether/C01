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

$email = '';
if (isset($_GET['email'])) {
	$email = $_GET['email'];
}
$template->assign("email", $email);

$nama = '';
if (isset($_GET['nama'])) {
	$nama = $_GET['nama'];
}
$template->assign("nama", $nama);

$upline = '';
if (isset($_GET['upline'])) {
	$upline = $_GET['upline'];
}
$template->assign("upline", $upline);

$city = '';
if (isset($_GET['city'])) {
	$city = $_GET['city'];
}
$template->assign("city", $city);

$telephone_mobile = '';
if (isset($_GET['telephone_mobile'])) {
	$telephone_mobile = $_GET['telephone_mobile'];
}
$template->assign("telephone_mobile", $telephone_mobile);

// var_dump($email);
// var_dump($nama);
 // var_dump($upline);
 // var_dump($city);
// var_dump($telephone_mobile);

$query = "SELECT 
		  branch_manager.`email` 
		FROM
		  branch_manager 
		WHERE branch_manager.`branch` = '$city'";
   
     $rows = $DB->execresultset($query);
	$bm="";
	 foreach ($rows as $row) {
         $bm = $row['email'];
    }
    $template->assign("bm", $bm);
	// var_dump($bm);
	
$query = "SELECT 
		  secretaris.`email` 
		FROM
		  secretaris 
		WHERE secretaris.`branch` ='$city' ";
   
     $rows = $DB->execresultset($query);
	$secretaris="";
	 foreach ($rows as $row) {
         $secretaris = $row['email'];
    }
    $template->assign("secretaris", $secretaris);
	// var_dump($secretaris);	

if ($upline == ""){
	echo 1;
}else if ($city == ""){
	echo 2;
}else if ($telephone_mobile == ""){
	echo 3;
}

else {

		// ke email
	$timenya = date('Y-m-d H:i', strtotime('-1 hour'));
	$subject = $nama . "Registration Marketing";
	$body = "Time: " . $timenya . "<br> <br>";
	$body = $body . "Dear Admin <br>";
	$body = $body . " <br>";
	$body = $body . "Please make a Marketing Account for $nama<br>";
	$body = $body . " <br>";
	$body = $body . "Thank you," . "<br>";
	$body = $body . "<br><strong>Cabinet Management System</strong>" . "<br>";
	$body = $body . " HotLine : +62-21-2954-3737<br>";
	$body = $body . " Fax : +62-21-2954-3777 <br>";
	$body = $body . " Email : admin@si.co.id <br>";
	$body = $body . " http://cabinet.si.co.id <br>";
// forsecretaris
	$query = "insert into email set
	timeupdate = NOW(),
	email_to = '$secretaris',
	email_subject = '$subject',
	email_body = '$body',
	timesend = '1970-01-31 00:00:00'    
	";
	$DB->execonly($query);
	
// for_bm	
	$query = "insert into email set
	timeupdate = NOW(),
	email_to = '$bm',
	email_subject = '$subject',
	email_body = '$body',
	timesend = '1970-01-31 00:00:00'    
	";
	$DB->execonly($query);
	
// Admin Super	
	$query = "insert into email set
	timeupdate = NOW(),
	email_to = 'admin@gmail.com',
	email_subject = '$subject',
	email_body = '$body',
	timesend = '1970-01-31 00:00:00'    
	";
	$DB->execonly($query);
			// var_dump($query);
	
			// ke tabel schedule
	$query = "INSERT INTO marketing SET   
					DATETIME = NOW(),
					email = '$email',
					NAME = '$nama',
					upline = '$upline',
					city = '$city',
					telp = '$telephone_mobile'";
	$DB->execonly($query);
	// var_dump($query);
	
	echo 0;
}



/*=====  End of Coding  ======*/

$template->display("registration_marketing.htm");

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