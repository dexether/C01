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
$upline = "";
if (isset($_GET['accountupline'])) {
	$upline = $_GET['accountupline'];
}
$template->assign("upline", $upline);
// var_dump($upline);

$mail = "";
if (isset($_GET['email'])) {
	$mail = $_GET['email'];
}
$template->assign("mail", $mail);
// var_dump($mail);

$query = "SELECT 
		  client_aecode.`name` 
		FROM
		  client_aecode 
		WHERE client_aecode.`aecode` = '$mail' ";
   
     $rows = $DB->execresultset($query);
	$marketing="";
	 foreach ($rows as $row) {
         $marketing = $row['name'];
    }
    $template->assign("marketing", $marketing);
	// var_dump($marketing);

$cari = "";
if(isset($_GET['accno'])){
    $cari = $_GET['accno'];
}
$template->assign("cari", $cari);

$cari1="";
if(isset($_GET['ACCNO'])){
    $cari1 = $_GET['ACCNO'];
}
$template->assign("cari1", $cari1);

if(isset($_GET['accno'])){
    $cari = $_GET['accno'];
}else{
	$cari = $cari1;
}
// var_dump ($cari);
 
// dapet meta and hour
$meta1 = "";
 if(isset($_GET['meta'])) {
        $meta1 = $_GET['meta'];
    }
$template->assign("meta1", $meta1);	
// var_dump ($meta1);

$offer = "";
 if(isset($_GET['offer'])) {
        $offer = $_GET['offer'];
    }
$template->assign("offer", $offer);	
// var_dump ($offer);

// $tgl = '';
// if (isset($_GET['tgl'])) {
	// $tgl = $_GET['tgl'];
// }
// $Away = "";
// if (isset($_GET['Away'])) {
	// $Away = $_GET['Away'];
// }
// $template->assign("Away", $Away);
// $datetime = $tgl." ".$Away;
//cari branchmanager
$query = "SELECT 
  mlm.`branch` 
FROM
  mlm 
WHERE mlm.`ACCNO` = '$upline' ";
   
     $rows = $DB->execresultset($query);
	$bm="";
	 foreach ($rows as $row) {
         $bm = $row['branch'];
    }
    $template->assign("bm", $bm);
	// var_dump($bm);

$mailup="";
$query = "SELECT 
		  branch_manager.`email` 
		FROM
		  branch_manager 
		WHERE branch_manager.`branch` = '$bm'";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
$mailup = $row['email'];
}
$template->assign("mailup", $mailup);
// var_dump($mailup);

$Approv = "";
 if(isset($_GET['Approv'])) {
        $Approv = $_GET['Approv'];
    }
$template->assign("Approv", $Approv);	
// var_dump ($Approv);

$Cancel = "";
 if(isset($_GET['Cancel'])) {
        $Approv = $_GET['Cancel'];
    }
$template->assign("Cancel", $Cancel);	
// var_dump ($Cancel);

$status = "$Approv $Cancel";
$template->assign("status", $status);	
// var_dump ($status);

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

if ($meta1 == ""){
	echo 1;
}//else if ($offer == ""){
	// echo 2;
// }
	else {

			// ke email
			$ma = $mail;
			$timenya = date('Y-m-d H:i', strtotime('-1 hour'));
			$subject = "Confirmation Add New SCHEDULE";
			$body = "Time: " . $timenya . "<br> <br>";
			$body = $body . "Dear $marketing<br>";
			$body = $body . "$status your schedule <br>";
			$body = $body . "$meta1 your car <br>";
			$body = $body . "$offer Car Available<br>";
			// $body = $body . "Please confirm approve or cancel for SCHEDULE<br>";
			$body = $body . " <br>";
			$body = $body . "Thank you," . "<br>";
			$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
            // $body = $body . " HotLine : +62-21-2954-3737<br>";
            // $body = $body . " Fax : +62-21-2954-3777 <br>";
            $body = $body . " Email : ".$companys['email']." <br>";
            $body = $body . " ".$companys['companyurl']." <br>";

			$query = "insert into email set
			timeupdate = NOW(),
			email_to = '$mail',
			email_subject = '$subject',
			email_body = '$body',
			timesend = '1970-01-31 00:00:00'";
			
			$DB->execonly($query);
			
			$query = "insert into email set
			timeupdate = NOW(),
			email_to = '$mailup',
			email_subject = '$subject',
			email_body = '$body',
			timesend = '1970-01-31 00:00:00'";
			
			$DB->execonly($query);
			
					
			$query = "UPDATE SCHEDULE 
			SET
			car_id = '$meta1',  
			offer = '$offer',
			status = '$status'
			WHERE schedule_id='$cari=>schedule_id'";
                //tradelog("BackProcess-85-Success:" . $query);
                $DB->execonly($query);
				 // var_dump($query);
				 
			 // var_dump($query);
			 
			 echo 0;
}

/*=====  End of Coding  ======*/
$template->display("admin_car_schedule_bm.htm");

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