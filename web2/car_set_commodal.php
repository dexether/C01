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

$_SESSION['page'] = 'car_set_com';
/*==============================
=        Start Coding          =
==============================*/
$shownya = "";
if (isset($_GET['lihat'])) {
    $shownya = $_GET['lihat'];
}
$template->assign("shownya", $shownya);
// var_dump($shownya);

$com = "";
if (isset($_GET['comisi'])) {
    $com = $_GET['comisi'];
}
$template->assign("com", $com);
// var_dump($com);

$tampil1 ="";
$tampil2 ="";
$tampil3 ="";

$query	  = "SELECT 
			  mlm.`ACCNO`,
			  client_accounts.`email`,
			  client_aecode.`name`
			FROM
			  mlm,
			  client_accounts,
			  client_aecode 
			WHERE mlm.`ACCNO` = client_accounts.`accountname` 
			  AND client_accounts.`email` = client_aecode.`aecode`
			  AND mlm.`ACCNO` = '$shownya'";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$tampil1 = $row['ACCNO'];
		$tampil2 = $row['email'];
		$tampil3 = $row['name'];
		
		}
		$template->assign("tampil1", $tampil1);
		$template->assign("tampil2", $tampil2);
		$template->assign("tampil3", $tampil3);
		
if($com == ""){
	echo 1;
} else {
	$query = "SELECT 
			  mlm.`comisi` 
			FROM
			  mlm 
			WHERE mlm.`ACCNO` = '$shownya' ";
                $rows = $DB->execresultset($query);
               $adadata = array();
				foreach ($rows as $row) {
		$adadata = $row['comisi'];
		
		}
		$template->assign("adadata", $adadata);
			   // var_dump($adadata);
	if ($adadata == "0"){
		$query = "UPDATE 
		  mlm 
		SET
		  comisi = '$com' 
		WHERE mlm.`ACCNO` = '$shownya'";
			$DB->execonly($query);
			 // var_dump($query);
		echo 0;
	}else {
			echo 2;
	}
}
			


/*=====  End of Coding  ======*/



$template->display("car_set_commodal.htm");

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