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
$accounts = $theFetchAccount->fetchAccountslangsung($user, $mysql['meta'], $cabang_admin);

$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}

$key = '';
if (isset($_SESSION['key'])) {
    $key = $_SESSION['key'];
}
//TradeLog_MLMRegistration("MLM_Registration-33");

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

//TradeLog_MLMRegistration("MLM_Registration-47:".$account);



//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'car_mlm_registration_sec';

//TradeLog_MLMRegistration("MLM_Registration-75:");
$clientaecode['afiliasi'] = '';
if ($user->groupid == '3') {
    $query = "SELECT client_aecode.*   
        from client_aecode 
        where 
        client_aecode.aecode = '$user->username'";
    //TradeLog_MLMRegistration("MLM_Registration-84=" . $user->groupid . ";" . $query);
	$clientaecode = array();
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $clientaecode = $row;
    }
    $template->assign("clientaecode", $clientaecode);
}
// var_dump($clientaecode);
$afiliasi = '';
if ($clientaecode['afiliasi'] == '' || strpos($clientaecode['afiliasi'], '@') == false) {
    $afiliasi = 'admin@si.co.id';
} else {
    $afiliasi = $clientaecode['afiliasi'];
}

$template->assign("afiliasi", $afiliasi);

$query = "SELECT 
			  secretaris.`group_branch`
			FROM
			  secretaris 
			WHERE secretaris.`email` ='$user->username' ";
   
     $rows = $DB->execresultset($query);
	$secretaris=array();
	 foreach ($rows as $row) {
         $secretaris[] = $row['group_branch'];
    }
    $template->assign("secretaris", $secretaris);
	// var_dump($secretaris);
	
	$kalimat = implode("','",$secretaris);
	// var_dump ($kalimat);



if ($user->groupid == '9'){
	$ceks = array();
		$query	  = "SELECT 
					  * 
					FROM
					  marketing 
					WHERE marketing.`creat_account` = 'no' 
					ORDER BY DATETIME ASC ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$ceks[] = $row;
		}
		$template->assign("ceks", $ceks);
		// var_dump($ceks);
}  else {
	 $ceks = array();
		$query	  = "SELECT 
					  * 
					FROM
					  marketing 
					WHERE group_city IN ('$kalimat')
					  AND  marketing.`creat_account` = 'no'
					  ORDER BY DATETIME ASC ";
		$rows = $DB->execresultset($query);
		// var_dump($query);
		foreach ($rows as $row) {
		$ceks[] = $row;
		}
		$template->assign("ceks", $ceks);
		// var_dump($ceks);
}

$shownya = "";
if (isset($_POST['shownya'])) {
    $shownya = $_POST['shownya'];
}
$template->assign("shownya", $shownya);
// var_dump($shownya);

$tampil = '' ;
$tampil1 = '' ;
		$query	  = "SELECT 
					  * 
					FROM
					  marketing 
					WHERE marketing.`email` = '$shownya' ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$tampil = $row['upline'];
		$tampil1 = $row['group_city'];
		}
		$template->assign("tampil", $tampil);
		$template->assign("tampil1", $tampil1);
		 // var_dump($tampil);
		 // var_dump($tampil1);

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

function TradeLog_MLMRegistration($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}



?>