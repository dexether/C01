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

$accountcheck = myfilter($accounts, $account);
if ($accountcheck[0] == '') {
    display_error("107.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
} else {
    if (!empty($account) && $account != "all") {
        if (!in_array($account, $accounts)) {
            //TradeLogUnderConstruct_Secure("Profile-111");
            display_error("111.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
        }
    }
    //TradeLogUnderConstruct_Secure("Profile-115");
    $template->assign("accounts", $accounts);
    if (!empty($account)) {
        $template->assign("tradedby", $user->username);
        $template->assign("account", $account);
        $template->assign("error", "");
    }
}
$template->assign("account", $account);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'car_vdata_editdo';
/*==============================
=        Start Coding          =
==============================*/
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
 
$nama="";
if(isset($_POST['namenya'])){
    $nama = $_POST['namenya'];
}
// var_dump ($nama);

$email="";
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
// var_dump ($email); 

$tlp_home="";
if(isset($_POST['Home'])){
    $tlp_home = $_POST['Home'];
}
// var_dump ($tlp_home); 

$tlp_mobile="";
if(isset($_POST['Mobile'])){
    $tlp_mobile = $_POST['Mobile'];
}
// var_dump ($tlp_mobile); 

$npwp="";
if(isset($_POST['npwp'])){
    $npwp = $_POST['npwp'];
}
// var_dump ($npwp); 

$salary="";
if(isset($_POST['salary'])){
    $salary = $_POST['salary'];
}
// var_dump ($salary); 

$gender="";
if(isset($_POST['gender'])){
    $gender = $_POST['gender'];
}
// var_dump ($gender); 

$martial="";
if(isset($_POST['martial'])){
    $martial = $_POST['martial'];
}
// var_dump ($martial); 

$ptkp="";
if(isset($_POST['ptkp'])){
    $ptkp = $_POST['ptkp'];
}
// var_dump ($ptkp); 

$st_npwp="";
if(isset($_POST['st_npwp'])){
    $st_npwp = $_POST['st_npwp'];
}
// var_dump ($st_npwp); 

$st_salary="";
if(isset($_POST['st_salary'])){
    $st_salary = $_POST['st_salary'];
}
// var_dump ($st_salary);  

if($nama == ""){
	echo 1;
} else if($st_salary == ""){
	echo 2;
} else {
$query = "UPDATE 
  client_aecode 
SET
  NAME = '$nama',
  gender = '$gender', 
  martial = '$martial', 
  ptkp = '$ptkp', 
  st_npwp = '$st_npwp', 
  npwp = '$npwp', 
  st_salary = '$st_salary', 
  salary_on = '$salary', 
  telephone_home = '$tlp_home',
  telephone_mobile = '$tlp_mobile'
WHERE client_aecode.aecode = '$email' ";
			
			$DB->execonly($query);
			 // var_dump($query);
			echo 0;
}
			


/*=====  End of Coding  ======*/



$template->display("car_vdata_edit.htm");

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