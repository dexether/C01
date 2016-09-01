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
$casnya = "";
if(isset($_GET['casnya'])){
    $casnya = $_GET['casnya'];
}
$template->assign("casnya", $casnya);
// var_dump ($casnya);

$accnobm = "";
if(isset($_GET['accbm'])){
    $accnobm = $_GET['accbm'];
}
$template->assign("accnobm", $accnobm);
// var_dump ($accnobm);

$comisibm="";
if(isset($_GET['combm'])){
    $comisibm = $_GET['combm'];
}
$template->assign("comisibm", $comisibm);
// var_dump ($comisibm);


$overnyabm = '';
if (isset($_GET['overbm'])) {
	$overnyabm = $_GET['overbm'];
}
$template->assign("overnyabm", $overnyabm);
// var_dump($overnyabm);

$accnomm = "";
if(isset($_GET['accmm'])){
    $accnomm = $_GET['accmm'];
}
$template->assign("accnomm", $accnomm);
// var_dump ($accnomm);

$comisimm="";
if(isset($_GET['commm'])){
    $comisimm = $_GET['commm'];
}
$template->assign("comisimm", $comisimm);
// var_dump ($comisimm);


$overnyamm = '';
if (isset($_GET['overmm'])) {
	$overnyamm = $_GET['overmm'];
}
$template->assign("overnyamm", $overnyamm);
// var_dump($overnyamm);

$accnospv = "";
if(isset($_GET['accspv'])){
    $accnospv = $_GET['accspv'];
}
$template->assign("accnospv", $accnospv);
// var_dump ($accnospv);

$comisispv="";
if(isset($_GET['comspv'])){
    $comisispv = $_GET['comspv'];
}
$template->assign("comisispv", $comisispv);
// var_dump ($comisispv);


$overnyaspv = '';
if (isset($_GET['overspv'])) {
	$overnyaspv = $_GET['overspv'];
}
$template->assign("overnyaspv", $overnyaspv);
// var_dump($overnyaspv);

$accnoae = "";
if(isset($_GET['accae'])){
    $accnoae = $_GET['accae'];
}
$template->assign("accnoae", $accnoae);
// var_dump ($accnoae);

$comisiae="";
if(isset($_GET['comae'])){
    $comisiae = $_GET['comae'];
}
$template->assign("comisiae", $comisiae);
// var_dump ($comisiae);


$overnyaae = '';
if (isset($_GET['overae'])) {
	$overnyaae = $_GET['overae'];
}
$template->assign("overnyaae", $overnyaae);
// var_dump($overnyaae);
  
$accnoaed = "";
if(isset($_GET['accaed'])){
    $accnoaed = $_GET['accaed'];
}
$template->assign("accnoaed", $accnoaed);
// var_dump ($accnoaed);

$comisiaed="";
if(isset($_GET['comaed'])){
    $comisiaed = $_GET['comaed'];
}
$template->assign("comisiaed", $comisiaed);
// var_dump ($comisiaed);


$overnyaaed = '';
if (isset($_GET['overaed'])) {
	$overnyaaed = $_GET['overaed'];
}
$template->assign("overnyaaed", $overnyaaed);
// var_dump($overnyaaed);

$accnoaedf = "";
if(isset($_GET['accaedf'])){
    $accnoaedf = $_GET['accaedf'];
}
$template->assign("accnoaedf", $accnoaedf);
// var_dump ($accnoaedf);

$comisiaedf="";
if(isset($_GET['comaedf'])){
    $comisiaedf = $_GET['comaedf'];
}
$template->assign("comisiaedf", $comisiaedf);
// var_dump ($comisiaedf);


$overnyaaedf = '';
if (isset($_GET['overaedf'])) {
	$overnyaaedf = $_GET['overaedf'];
}
$template->assign("overnyaaedf", $overnyaaedf);
// var_dump($overnyaaedf);
  
if ($accnoaedf != ""){
	if ($overnyabm > $casnya){
		echo 9;
	}else if ($comisibm == ""){
		echo 1;
	}else if ($comisimm == "") {
		echo 2;
	}else if($comisispv == ""){
		echo 3;
	}else if($comisiae == ""){
		echo 4;
	}else if($comisiaed == ""){
		echo 5;
	}else if($comisiaedf == ""){
		echo 6;
	} else {
	
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisibm',
			  over = '$overnyabm' 
			WHERE ACCNO = '$accnobm'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisimm',
			  over = '$overnyamm' 
			WHERE ACCNO = '$accnomm'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisispv',
			  over = '$overnyaspv' 
			WHERE ACCNO = '$accnospv'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisiae',
			  over = '$overnyaae' 
			WHERE ACCNO = '$accnoae'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisiaed',
			  over = '$overnyaaed' 
			WHERE ACCNO = '$accnoaed'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisiaedf',
			  over = '$overnyaaedf' 
			WHERE ACCNO = '$accnoaedf'";
			$DB->execonly($query);
			// var_dump($query);
	echo 0;	
	}
}else if ($accnoaed != ""){
	if ($overnyabm > $casnya){
		echo 9;
	}else if ($comisibm == ""){
		echo 1;
	}else if ($comisimm == "") {
		echo 2;
	}else if($comisispv == ""){
		echo 3;
	}else if($comisiae == ""){
		echo 4;
	}else if($comisiaed == ""){
		echo 5;
	} else {
	
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisibm',
			  over = '$overnyabm' 
			WHERE ACCNO = '$accnobm'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisimm',
			  over = '$overnyamm' 
			WHERE ACCNO = '$accnomm'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisispv',
			  over = '$overnyaspv' 
			WHERE ACCNO = '$accnospv'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisiae',
			  over = '$overnyaae' 
			WHERE ACCNO = '$accnoae'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisiaed',
			  over = '$overnyaaed' 
			WHERE ACCNO = '$accnoaed'";
			$DB->execonly($query);
			// var_dump($query);
	echo 0;	
	}
}else if ($accnoae != ""){
	if ($overnyabm > $casnya){
		echo 9;
	}else if ($comisibm == ""){
		echo 1;
	}else if ($comisimm == "") {
		echo 2;
	}else if($comisispv == ""){
		echo 3;
	}else if($comisiae == ""){
		echo 4;
	} else {
	
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisibm',
			  over = '$overnyabm' 
			WHERE ACCNO = '$accnobm'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisimm',
			  over = '$overnyamm' 
			WHERE ACCNO = '$accnomm'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisispv',
			  over = '$overnyaspv' 
			WHERE ACCNO = '$accnospv'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisiae',
			  over = '$overnyaae' 
			WHERE ACCNO = '$accnoae'";
			$DB->execonly($query);
			// var_dump($query);
	echo 0;	
	}
}else if ($accnospv != "") {
	if ($overnyabm > $casnya){
		echo 9;
	}else if ($comisibm == ""){
		echo 1;
	}else if ($comisimm == "") {
		echo 2;
	}else if($comisispv == ""){
		echo 3;
	}else {
	
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisibm',
			  over = '$overnyabm' 
			WHERE ACCNO = '$accnobm'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisimm',
			  over = '$overnyamm' 
			WHERE ACCNO = '$accnomm'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisispv',
			  over = '$overnyaspv' 
			WHERE ACCNO = '$accnospv'";
			$DB->execonly($query);
			// var_dump($query);
			
	echo 0;	
	}
}else if($accnomm != ""){
	if ($overnyabm > $casnya){
		echo 9;
	}else if ($comisibm == ""){
		echo 1;
	}else if ($comisimm == "") {
		echo 2;
	}else {
	
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisibm',
			  over = '$overnyabm' 
			WHERE ACCNO = '$accnobm'";
			$DB->execonly($query);
			// var_dump($query);
			
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisimm',
			  over = '$overnyamm' 
			WHERE ACCNO = '$accnomm'";
			$DB->execonly($query);
			// var_dump($query);
	echo 0;	
	}
}else if($accnobm != ""){
	if ($overnyabm > $casnya){
		echo 9;
	}else if ($comisibm == ""){
		echo 1;
	}else {
	
	$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisibm',
			  over = '$overnyabm' 
			WHERE ACCNO = '$accnobm'";
			$DB->execonly($query);
			// var_dump($query);
	echo 0;	
	}
}
 
/*=====  End of Coding  ======*/
$template->display("car_set_com.htm");

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