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
$log = "";
if(isset($_GET['accno'])){
    $log = $_GET['accno'];
}
$template->assign("log", $log);
// var_dump ($log);

$comisi="";
if(isset($_GET['ACCNO'])){
    $comisi = $_GET['ACCNO'];
}
$template->assign("comisi", $comisi);
// var_dump ($comisi);

$idnya="";
if(isset($_GET['idnya'])){
    $idnya = $_GET['idnya'];
}
$template->assign("idnya", $idnya);
// var_dump ($idnya);

$add = "";
if (isset($_GET['addcar'])) {
	$add = $_GET['addcar'];
}
$template->assign("add", $add);
// var_dump($add);

$edit = "";
if (isset($_GET['editcar'])) {
	$edit = $_GET['editcar'];
}
$template->assign("edit", $edit);
// var_dump($edit);

$delet = "";
 if(isset($_GET['deletcar'])) {
        $delet = $_GET['deletcar'];
    }
$template->assign("delet", $delet);	
// var_dump ($delet);

if ($add=="add") {
	
	$query = "INSERT INTO cas_comisi SET log_meta = '$log',
				cas_comisi = '$comisi' ";
			
			$DB->execonly($query);
			// var_dump($query);
			echo 0;
}else if($edit=="edit"){
	
	$query = "UPDATE 
			  cas_comisi 
			SET
			  log_meta = '$log',
			  cas_comisi = '$comisi'   
			WHERE id = '$idnya' ";
			
			$DB->execonly($query);
			// var_dump($query);
	echo 0;
}else if($delet=="delete"){
	
	$query = "DELETE FROM cas_comisi WHERE id = '$idnya'";
			
			$DB->execonly($query);
			// var_dump($query);
	echo 0;
}else{
	echo 1;
}








 
/*=====  End of Coding  ======*/
$template->display("car_cas_com.htm");

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