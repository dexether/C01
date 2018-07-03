<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;
$security = new \security\CSRF;
$token = $security->set(3, 3600);
$template->assign('token', $token);
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

$_SESSION['page'] = 'comm_setting_request';


/* get client data */
$query = "SELECT client_accounts.accountname FROM client_accounts,client_aecode WHERE client_accounts.aecodeid = client_aecode.aecodeid AND client_aecode.aecode = '$user->username'";
$row = $DB->execresultset($query);
foreach ($row as $key => $value) {
    # code...
    $upline = $value['accountname'];
}

$query = "SELECT mlm.*,client_aecode.name FROM mlm,client_accounts,client_aecode WHERE mlm.ACCNO = client_accounts.accountname AND client_accounts.aecodeid = client_aecode.aecodeid";
$data = $DB->execresultset($query);
foreach ($data as $key => $value) {
    # code...
    $data_array[] = $value;
}
$template->assign('downline', @$data_array);
$template->display("comm_setting_request.htm");

function checkupline($accno) {
	global $DB;
    $data  = array();
	
	$query = "SELECT upline FROM mlm WHERE accno = '$accno'";
    $result = $DB->execresultset($query);
    // var_dump($query);
    // tradeLogs($query);
    foreach ($result as $row) {
		$upline = $row['upline'];
	}
	
	$query = "SELECT client_aecode.name FROM client_aecode,client_accounts WHERE client_aecode.aecodeid = client_accounts.aecodeid AND client_accounts.accountname = '$upline'";
	$result = $DB->execresultset($query);
    foreach ($result as $row) {
		$uplinename = $row['name'];
	}
	
	$data['upline'] = $upline;
	$data['uplinename'] = $name;
	
	return $data;
}

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