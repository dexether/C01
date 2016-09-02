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

$_SESSION['page'] = 'car_cas_com';
/*==============================
=        Start Coding          =
==============================*/

if ($user->groupid == '3') {
    $query = "SELECT client_aecode.*   
        from client_aecode 
        where 
        client_aecode.aecode = '$user->username'";
    //TradeLog_MLMRegistration("MLM_Registration-84=" . $user->groupid . ";" . $query);
    $rows = $DB->execresultset($query);
	$clientaecode = "";
    foreach ($rows as $row) {
        $clientaecode = $row;
    }
    $template->assign("clientaecode", $clientaecode);

} else {
	 $query = "SELECT client_aecode.*   
        from client_aecode 
        where 
        client_aecode.aecode = '$user->username'";
    //TradeLog_MLMRegistration("MLM_Registration-84=" . $user->groupid . ";" . $query);
    $rows = $DB->execresultset($query);
		$clientaecode = "";
    foreach ($rows as $row) {
        $clientaecode = $row;
    }
    $template->assign("clientaecode", $clientaecode);
}


	$ceks = array();
$query	  = "SELECT 
				*
				FROM
				  cas_comisi ";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
$ceks[] = $row;
}
$template->assign("ceks", $ceks);
// var_dump($ceks);

$action = "";
if(isset($_GET['lihat'])){
    $action = $_GET['lihat'];
}
$template->assign("action", $action);
// var_dump ($action);


$statements=""; 
$statements0=""; 
$statements1=""; 

$query	  = "SELECT 
			  cas_comisi.`id`,
			  cas_comisi.`log_meta`,
			  cas_comisi.`cas_comisi`
			FROM
			  cas_comisi 
			WHERE cas_comisi.`id` = '$action' ";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
$statements = $row['log_meta'];
$statements0 = $row['cas_comisi'];
$statements1 = $row['id'];

}
$template->assign("statements", $statements);
$template->assign("statements0", $statements0);
$template->assign("statements1", $statements1);
// var_dump ($statements);
// var_dump ($statements0);
// var_dump ($statements1);


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

function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>