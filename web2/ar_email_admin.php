<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require_once "$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php";
include_once "includes/wr_tools.php";
global $user;
global $template;
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

$_SESSION['page'] = 'ar_email_admin';
/*==============================
=        Start Coding          =
==============================*/

// var_dump($longtree);
/* End Cari Downline */

$query = "SELECT email FROM client_aecode";
   
     $rows = $DB->execresultset($query);
		$view= "";
	 foreach ($rows as $row) {
         $view[] = $row;
    }
$template->assign("view", $view);
// var_dump($view);

/*=====  End of Coding  ======*/
$template->display("ar_email_admin.htm");


function updatechild($longtree, $ACCNO2) {
    $longtree = $longtree . "";
    global $DB;
    $datatress = array();
    $query = "SELECT client_aecode.name, client_aecode.email, client_accounts.`accountname`,mlm.*   
    FROM client_aecode,client_accounts,mlm  
    WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid` 
    AND client_accounts.`suspend` = '0'
    AND client_accounts.`accountname` = mlm.`ACCNO` 
    AND mlm.Upline = '$ACCNO2' ";

    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $datatress[$row['ACCNO']] = $row;
    }
	// var_dump($datatress);
    if (count($datatress) > 0) {
        foreach ($datatress AS $ACCNO1 => $datatres) {
            $longtree = $longtree . ",'" . $ACCNO1."'";
            $longtree = updatechild($longtree, $ACCNO1);
            $longtree = $longtree . "";
        }
    }
    $longtree = $longtree . "";
	// var_dump($longtree);
    return $longtree;
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

?>