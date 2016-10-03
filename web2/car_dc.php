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

$_SESSION['page'] = 'car_dc';
/*==============================
=        Start Coding          =
==============================*/

    $query = "SELECT client_aecode.*   
				from client_aecode 
				where 
				client_aecode.aecode = '$user->username'";
    $rows = $DB->execresultset($query);
	$clientaecode="";
    foreach ($rows as $row) {
        $clientaecode = $row;
    }
    $template->assign("clientaecode", $clientaecode);

$tampil1 = '' ;
$tampil0 = '' ;
$tampil2 = '' ;
	$tampil0 = "COMPANY" ;
	$tampil1 = 'Administrator' ;
	$tampil2 = 'Pusat' ;
		$template->assign("tampil1", $tampil1);
		$template->assign("tampil0", $tampil0);
		$template->assign("tampil2", $tampil2);
		
		  // var_dump($tampil2);
		  // var_dump($tampil0);
		  // var_dump($tampil1);
/*=====  acc mete  ======*/
$query = "SELECT 
		  branch_manager.`email` 
		FROM
		  branch_manager 
		WHERE branch_manager.`group_branch` <> 'JKTD'";
   
     $rows = $DB->execresultset($query);
		$view= array();
	 foreach ($rows as $row) {
         $view[] = $row['email'];
    }
    $template->assign("view", $view);
	  // var_dump($view);
$accountnya=implode("','",$view);
$template->assign("accountnya", $accountnya);

$query = "SELECT 
			  mlm.`ACCNO`, 
			  mlm.`group_play` 
			FROM
			  mlm,
			  client_accounts 
			WHERE mlm.`ACCNO` = client_accounts.`accountname`
			AND mlm.`group_play`<>'Car' 
			AND client_accounts.`email` IN ('$accountnya')
			ORDER BY group_play ASC";
   
     $rows = $DB->execresultset($query);
		$meta= "";
	 foreach ($rows as $row) {
         $meta[] = $row;
    }
    $template->assign("meta", $meta);
	 // var_dump($meta);
/*=====  End acc  ======*/	 		 
/*=====  End of Coding  ======*/
$template->display("car_dc.htm");

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