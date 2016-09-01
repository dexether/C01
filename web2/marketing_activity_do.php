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

$account = "";
if (isset($_GET['account'])) {
	$account = $_GET['account'];
}
$template->assign("account", $account);
 // var_dump($account);

$prodate = "";
if (isset($_GET['prodate'])) {
	$prodate = $_GET['prodate'];
}
$template->assign("prodate", $prodate);
// var_dump($prodate);
$pecah[1]='';
$pecah[2]='';
$pecah = explode("-",$prodate);
$hasil1 = $pecah[1];
$hasil2 = $pecah[2];
$hasil = $hasil1.$hasil2;
   // var_dump($hasil);
$waktucheck1 = date('md');
$mines = "3";
$checkok = $waktucheck1 - $mines;
  // var_dump($checkok);	

$proname = '';
if (isset($_GET['proname'])) {
	$proname = $_GET['proname'];
}
$template->assign("proname", $proname);
// var_dump ($proname);

$prores = "";
 if(isset($_GET['prores'])) {
        $prores = $_GET['prores'];
    }
$template->assign("prores", $prores);	
// var_dump ($prores);

$promail = "";
 if(isset($_GET['promail'])) {
        $promail = $_GET['promail'];
    }
$template->assign("promail", $promail);	
// var_dump ($promail);

$protel="";
if(isset($_GET['protel'])){
    $protel = $_GET['protel'];
}
$template->assign("protel", $protel);
// var_dump ($protel);

$prosum="";
if(isset($_GET['prosum'])){
    $prosum = $_GET['prosum'];
}
$template->assign("prosum", $prosum);
// var_dump ($prosum);

$status="";
if(isset($_GET['status'])){
    $status = $_GET['status'];
}
$template->assign("status", $status);
// var_dump ($status);



$query = "SELECT 
		  marketing.`group_city`
		FROM
		  marketing,
		  client_accounts
		WHERE client_accounts.`email`=marketing.`email`
		AND client_accounts.`accountname`= '$account'";
     $rows = $DB->execresultset($query);
	$view="";
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
			WHERE branch_manager.`group_branch` = '$view' ";
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

if ($account == ""){
	echo 1;
}else if ($prodate == ""){
	echo 2;
}else if ($proname == ""){
	echo 3;
}else if ($prores == ""){
	echo 4;
}else if ($promail == ""){
	echo 5;
}else if ($protel == ""){
	echo 6;
}else if ($prosum == ""){
	echo 7;
}else if ($hasil>=$checkok) {

	// ke email
	$timenya = date('Y-m-d H:i', strtotime('-1 hour'));
	$subject = " Add New Marketing Activity";
	$body = "Time: " . $timenya . "<br> <br>";
	$body = $body . "Dear Admin <br>";
	$body = $body . " <br>";
	$body = $body . "Account $account create marketing activitas <br>";
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
	
/* foradmin	
	$query = "insert into email set
	timeupdate = NOW(),
	email_to = 'admin@gmail.com',
	email_subject = '$subject',
	email_body = '$body',
	timesend = '1970-01-31 00:00:00'    
	";
	$DB->execonly($query);
			 var_dump($query);*/
	
	$query = "insert into mar_ac set
			datetime = NOW(),
			account = '$account',
			branch = '$view',
			pros_date = '$prodate',
			pros_name = '$proname',
			pros_address = '$prores',
			pros_email = '$promail',
			pros_telp = '$protel',
			pros_Summary = '$prosum',
			status = '$status'";
			
			$DB->execonly($query);
			// var_dump($query);	
	
	echo 0;
}else {
	echo 2;
}
 

/*=====  End of Coding  ======*/
$template->display("marketing_activity.htm");

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