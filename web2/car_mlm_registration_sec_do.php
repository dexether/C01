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
$marem = "";
if (isset($_GET['marem'])) {
	$marem = $_GET['marem'];
}
$template->assign("marem", $marem);
// var_dump($marem);

$mail = "";
if (isset($_GET['email'])) {
	$mail = $_GET['email'];
}
$template->assign("mail", $mail);
// var_dump($mail);

$branch = "";
if (isset($_GET['branch'])) {
	$branch = $_GET['branch'];
}
$template->assign("branch", $branch);
// var_dump($branch);

$Approv = "";
 if(isset($_GET['Approv'])) {
        $Approv = $_GET['Approv'];
    }
$template->assign("Approv", $Approv);	
// var_dump ($Approv);

$Cancel = "";
 if(isset($_GET['Cancel'])) {
        $Cancel = $_GET['Cancel'];
    }
$template->assign("Cancel", $Cancel);	
 // var_dump ($Cancel);

$status = "$Approv $Cancel";
$template->assign("status", $status);	
 // var_dump ($status);
 
$mailbm="";
$query = "SELECT 
		  branch_manager.`email` 
		FROM
		  branch_manager 
		WHERE branch_manager.`branch` ='$branch'";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
$mailbm = $row['email'];
}
$template->assign("mailbm", $mailbm);
 // var_dump($mailbm);
 
if ($mail == ""){
	echo 1;
}else if ($branch == ""){
	echo 2;
}
	else {

			// ke email
			$ma = $mail;
			$timenya = date('Y-m-d H:i', strtotime('-1 hour'));
			$subject = "This account to be created";
			$body = "Time: " . $timenya . "<br> <br>";
			$body = $body . "Dear Branch Manager<br>";
			$body = $body . "$marem is id for created account <br>";
			$body = $body . "Please confirm approve or cancel for created account<br>";
			$body = $body . " <br>";
			$body = $body . "Thank you," . "<br>";
			$body = $body . "<br><strong>Cabinet Management System</strong>" . "<br>";
			$body = $body . " HotLine : +62-21-2954-3737<br>";
			$body = $body . " Fax : +62-21-2954-3777 <br>";
			$body = $body . " Email : admin@si.co.id <br>";
			$body = $body . " http://cabinet.si.co.id <br>";
			
			$query = "insert into email set
			timeupdate = NOW(),
			email_to = '$mailbm',
			email_subject = '$subject',
			email_body = '$body',
			timesend = '1970-01-31 00:00:00'";
			
			$DB->execonly($query);
			// var_dump($query);
					
			$query = "UPDATE 
					  marketing 
					SET
					  upline = '$mail',
					  city = '$branch',
					  creat_account = '$status' 
					WHERE email = '$marem' ";
                //tradelog("BackProcess-85-Success:" . $query);
                $DB->execonly($query);
				 // var_dump($query);
				 
			 
			 
			 echo 0;
} 

/*=====  End of Coding  ======*/
$template->display("car_mlm_registration_sec.htm");

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