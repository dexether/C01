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
// var_dump ($Cancel);

$cari1="";
if(isset($_GET['ACCNO'])){
    $cari1 = $_GET['ACCNO'];
}
$template->assign("cari1", $cari1);
// var_dump ($cari1);

 if(isset($_GET['accno'])){
     $cari = $_GET['accno'];
 }else{
	 $cari = $cari1;
 }

$query = "UPDATE SCHEDULE 
			SET
			  STATUS = '$status'
			WHERE schedule_id = '$cari => schedule_id'";
                //tradelog("BackProcess-85-Success:" . $query);
                $DB->execonly($query);
				  // var_dump($query);



/*=====  End of Coding  ======*/
$template->display("confirm_schedule.htm");

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