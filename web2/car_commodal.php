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

$_SESSION['page'] = 'car_commodal';
/*==============================
=        Start Coding          =
==============================*/
$lihat="";
if(isset($_GET['lihat'])){
    $lihat = $_GET['lihat'];
}
$template->assign("lihat", $lihat);
 // var_dump ($lihat);


$tampil ="";
$tampil0 ="";
$tampil1 ="";
$tampil2 ="";
$tampil3 ="";
$tampil4 ="";
$tampil5 ="";
$query	  = "SELECT 
			  comisi_ae1.* 
			FROM
			  comisi_ae1 
			WHERE comisi_ae1.`id` = '$lihat'";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$tampil = $row['id'];
		$tampil0 = $row['datetime'];
		$tampil1 = $row['accno'];
		$tampil2 = $row['from'];
		$tampil3 = $row['upline'];
		$tampil4 = $row['comisi'];
		$tampil5 = $row['lot'];
		}
		$template->assign("tampil", $tampil);
		$template->assign("tampil0", $tampil0);
		$template->assign("tampil1", $tampil1);
		$template->assign("tampil2", $tampil2);
		$template->assign("tampil3", $tampil3);
		$template->assign("tampil4", $tampil4);
		$template->assign("tampil5", $tampil5);
		 // var_dump($tampil);

/*=====  End of Coding  ======*/
$template->display("car_commodal.htm");

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