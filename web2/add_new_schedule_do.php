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

$upline = '';
if (isset($_GET['accountupline'])) {
	$upline = $_GET['accountupline'];
}
$template->assign("upline", $upline);
// var_dump($upline);

$nama = '';
if (isset($_GET['account'])) {
	$nama = $_GET['account'];
}
$template->assign("nama", $nama);

$email = '';
if (isset($_GET['email'])) {
	$email = $_GET['email'];
}
$Destination = '';
if (isset($_GET['Destination'])) {
	$Destination = $_GET['Destination'];
}
$Meet = '';
if (isset($_GET['Meet'])) {
	$Meet = $_GET['Meet'];
}
$tgl = '';
if (isset($_GET['tgl'])) {
	$tgl = $_GET['tgl'];
}
$pecah = explode("-",$tgl);
$hasil1 = $pecah[1];
$hasil2 = $pecah[2];
$hasil = $hasil1.$hasil2;
  // var_dump($hasil);
$waktucheck1 = date('md');
  // var_dump($waktucheck1);

 // var_dump($tgl);
$Away = '';
if (isset($_GET['Away'])) {
	$Away = $_GET['Away'];
}

// $datetime = $tgl." ".$Away;
// var_dump($datetime);
// var_dump ($nama, $Destination, $Meet, $Away);
$mailup="";
$query = "SELECT client_accounts.`email`FROM client_accounts WHERE client_accounts.`accountname`='$upline'";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
	$mailup = $row['email'];
}
$template->assign("mailup", $mailup);
// var_dump($mailup);

$query = "SELECT 
		  marketing.`group_city` 
		FROM
		  marketing 
		WHERE marketing.`email`='$email' ";
     $rows = $DB->execresultset($query);
	$view=array();
	 foreach ($rows as $row) {
         $view = $row['group_city'];
    }
    $template->assign("view", $view);
	// var_dump($view);
	
	//BM
	$query = "SELECT 
			  branch_manager.`email`
			FROM
			  branch_manager 
			WHERE branch_manager.`group_branch` ='$view' ";
     $rows = $DB->execresultset($query);
	$bm="";
	 foreach ($rows as $row) {
         $bm = $row['email'];
    }
    $template->assign("bm", $bm);
	 // var_dump($bm);
	
	//Secretaris
	$query = "SELECT 
			  secretaris.`email` 
			FROM
			  secretaris 
			WHERE secretaris.`group_branch` = '$view'";
     $rows = $DB->execresultset($query);
	$secretaris="";
	 foreach ($rows as $row) {
         $secretaris = $row['email'];
    }
    $template->assign("secretaris", $secretaris);
	// var_dump($secretaris);

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
	
if ($upline == ""){
	echo 1;
}else if ($nama == ""){
	echo 2;
}else if ($email == ""){
	echo 3;
}else if ($Destination == ""){
	echo 4;
}else if ($Meet == ""){
	echo 5;
}else if ($Away == ""){
	echo 6;
}else if ($hasil>=$waktucheck1){
	
		// ke email
	$timenya = date('Y-m-d H:i', strtotime('-1 hour'));
	$subject = $nama . " Add New SCHEDULE";
	$body = "Time: " . $timenya . "<br> <br>";
	$body = $body . "Dear Admin <br>";
	$body = $body . " <br>";
	$body = $body . "Please make a schedule to borrow a car for $nama<br>";
	$body = $body . " <br>";
	$body = $body . "Thank you," . "<br>";
	$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
 // $body = $body . " HotLine : +62-21-2954-3737<br>";
 // $body = $body . " Fax : +62-21-2954-3777 <br>";
    $body = $body . " Email : ".$companys['email']." <br>";
    $body = $body . " ".$companys['companyurl']." <br>";
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
	
/*forupline	
	$query = "insert into email set
	timeupdate = NOW(),
	email_to = '$mailup',
	email_subject = '$subject',
	email_body = '$body',
	timesend = '1970-01-31 00:00:00'    
	";
	$DB->execonly($query);
			 var_dump($query);*/
	
			// ke tabel schedule
	$query = "INSERT INTO SCHEDULE SET   
	DATETIME = NOW(),
	team_id = '$upline',
	nameaccount = '$nama',
	email = '$email',
	destination = '$Destination',
	meet_with = '$Meet',
	date_meeting = '$tgl',
	time_meeting = '$Away'";
	$DB->execonly($query);
	// var_dump($query);
	
	echo 0;
	
	
}else {

	echo 7;
}



/*=====  End of Coding  ======*/

$template->display("add_new_schedule.htm");

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