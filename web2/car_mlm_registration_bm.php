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

$_SESSION['page'] = 'car_mlm_registration_bm';

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
			  branch_manager.`group_branch`
			FROM
			  branch_manager 
			WHERE branch_manager.`email` ='$user->username' ";
   
     $rows = $DB->execresultset($query);
	$bm=array();
	 foreach ($rows as $row) {
         $bm[] = $row['group_branch'];
    }
    $template->assign("bm", $bm);
	 // var_dump($bm);
	 $kalimat = implode("','",$bm);
	 // echo $kalimat;
	 

if ($user->groupid == '9'){
	$ceks = array();
		$query	  = "SELECT 
					  * 
					FROM
					  marketing 
					WHERE marketing.`creat_account` <> 'BM Approve' 
					ORDER BY email ASC ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$ceks[] = $row;
		}
		$template->assign("ceks", $ceks);
		// var_dump($ceks);
} else {
	 $ceks = array();
		$query	  = "SELECT 
					  * 
					FROM
					  marketing 
					WHERE group_city IN ('$kalimat') 
					  AND marketing.`creat_account` = 'Accept' 
					ORDER BY email ASC ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$ceks[] = $row;
		}
		$template->assign("ceks", $ceks);
		 // var_dump($query);
}

$shownya = "";
if (isset($_POST['shownya'])) {
    $shownya = $_POST['shownya'];
}
$template->assign("shownya", $shownya);
// var_dump($shownya);

$tampil = '' ;
$tampil0 = '' ;
$tampil1 = '' ;
$tampil2 = '' ;
		$query	  = "SELECT 
					  marketing.`email`,
					  marketing.`upline`,
					  marketing.`group_city`,
					  marketing.`city` 
					FROM
					  marketing 
					WHERE marketing.`email` ='$shownya' ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$tampil = $row['upline'];
		$tampil0 = $row['email'];
		$tampil1 = $row['group_city'];
		$tampil2 = $row['city'];
		}
		$template->assign("tampil", $tampil);
		$template->assign("tampil0", $tampil0);
		$template->assign("tampil1", $tampil1);
		$template->assign("tampil2", $tampil2);
		 // var_dump($tampil);
		 // var_dump($tampil0);
		 // var_dump($tampil1);
		 // var_dump($tampil2);


$template->display("car_mlm_registration_bm.htm");

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