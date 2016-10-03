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
$accnonya="";
if(isset($_GET['accno'])){
    $accnonya = $_GET['accno'];
}
$template->assign("accnonya", $accnonya);
// var_dump ($accnonya);

$comisinya="";
if(isset($_GET['comisi'])){
    $comisinya = $_GET['comisi'];
}
$template->assign("comisinya", $comisinya);
 // var_dump ($comisinya);


if ($comisinya == ""){
	echo 1;
}else{
	
	$adaticket = array();
	$query	  = "SELECT 
				  mlm.`comisi` 
				FROM
				  mlm 
				WHERE mlm.`ACCNO` ='$accnonya' ";
	$rows = $DB->execresultset($query);
	foreach ($rows as $row) {
	$adaticket = $row['comisi'];
}
$template->assign("adaticket", $adaticket);
	 // var_dump($adaticket);
	 if($adaticket == 0){
		 $query = "UPDATE mlm SET comisi = '$comisinya' WHERE mlm.`ACCNO` = '$accnonya' ";
			$DB->execonly($query);
			 // var_dump($query);
		 echo 0;
	}else{
		
		echo 2;
			 
	}		
}








 
/*=====  End of Coding  ======*/
$template->display("car_treview_detail.htm");

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