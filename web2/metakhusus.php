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

$_SESSION['page'] = 'metakhusus';
/*==============================
=        Start Coding          =
==============================*/

$email1 = "";
if (isset($_GET['accabi'])) {
	$email1 = $_GET['accabi'];
}
$template->assign("email1", $email1);
// var_dump($email1);

$email2 = "";
if (isset($_GET['accmeta'])) {
	$email2 = $_GET['accmeta'];
}
$template->assign("email2", $email2);
// var_dump($email2);

$metanya = "";
if (isset($_GET['metanya'])) {
	$metanya = $_GET['metanya'];
}
$template->assign("metanya", $metanya);
// var_dump($metanya);

$query = "SELECT 
		  client_aecode.`name`,
		  mlm.`branch`, 
		  mlm.`group_branch` 
		FROM
		  client_aecode,
		  client_accounts,
		  mlm 
		WHERE mlm.`ACCNO` = client_accounts.`accountname` 
		AND client_accounts.`email`= client_aecode.`aecode`
		AND mlm.`group_play`='Car'
		AND client_accounts.`email` = '$email1' ";
$namenya1 = array();
$groupbranch1 = array();
$branch1 = array();
$rows = $DB->execresultset($query);

foreach ($rows as $row) {
    $namenya1 = $row['name'];
    $branch1 = $row['branch'];
    $groupbranch1 = $row['group_branch'];
	
}
$template->assign("namenya1", $namenya1);
$template->assign("branch1", $branch1);
$template->assign("groupbranch1", $groupbranch1);
// var_dump($namenya1);

$query = "SELECT 
	  client_aecode.`name`,
	  mlm.`branch`,
	  mlm.`group_branch`,
	  mlm.`ACCNO`,
	  mlm.`group_play`,
	  mlm.`comisi` 
	FROM
	  client_aecode,
	  client_accounts,
	  mlm 
	WHERE mlm.`ACCNO` = client_accounts.`accountname` 
	AND client_accounts.`email`= client_aecode.`aecode`
	AND mlm.`group_play`='$metanya'
  AND client_accounts.`email` = '$email2' ";
$namenya2 = array();
$accountnya = array();
$groupbranch2 = array();
$branch2 = array();
$comnya = array();
$rows = $DB->execresultset($query);

foreach ($rows as $row) {
    $namenya2 = $row['name'];
    $accountnya = $row['ACCNO'];
    $branch2 = $row['branch'];
	$groupbranch2 = $row['group_branch'];
    $comnya = $row['comisi'];
	
}
$template->assign("namenya2", $namenya2);
$template->assign("accountnya", $accountnya);
$template->assign("branch2", $branch2);
$template->assign("groupbranch2", $groupbranch2);
$template->assign("comnya", $comnya);
// var_dump($namenya2);

/*=====  End of Coding  ======*/
$template->display("metakhusus.htm");

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