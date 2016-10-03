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

$_SESSION['page'] = 'car_uplinechange_2meta';
/*==============================
=        Start Coding          =
==============================*/
$accno = "";
if (isset($_GET['acc'])) {
	$accno = $_GET['acc'];
}
$template->assign("accno", $accno);
// var_dump($accno);

$accupnya = "";
if (isset($_GET['accold'])) {
	$accupnya = $_GET['accold'];
}
$template->assign("accupnya", $accupnya);
// var_dump($accupnya);

$changeup = "";
if (isset($_GET['accnew'])) {
	$changeup = $_GET['accnew'];
}
$template->assign("changeup", $changeup);
// var_dump($changeup);

/*  Cari Upline new */
    $condiional_header = "";
    $condiional_footer = "";

$query = "SELECT 
		  client_aecode.name,
		  client_aecode.email,
		  client_accounts.`accountname`,
		  mlm.`ACCNO`
		FROM
		  client_aecode,
		  client_accounts,
		  mlm 
		WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid` 
		  AND client_accounts.`accountname` = mlm.`ACCNO`
		  AND mlm.`ACCNO` = '$changeup' ";
$datatress = array();
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $datatress[$row['ACCNO']] = $row;
}
// var_dump($datatress);
$longtree = $condiional_header;
if (count($datatress) > 0) {
    foreach ($datatress AS $Upline => $datatres) {
        $longtree = $longtree .$Upline;
        $longtree = updatechild($longtree, $Upline);
        $longtree = $longtree ;
    }
}
$longtree = $longtree . $condiional_footer;
$template->assign("longtree", $longtree);
// var_dump($longtree);
/* End Cari Upline */

$query = "SELECT 
		  client_accounts.`email`,
		  client_aecode.`name` 
		FROM
		  client_accounts,
		  client_aecode 
		WHERE client_accounts.`email` = client_aecode.`aecode` 
		  AND client_accounts.`accountname` IN ('$longtree')";
		$uplinenew = array();
		$rows = $DB->execresultset($query);

foreach ($rows as $row) {
    $uplinenew[] = $row;
}
$template->assign("uplinenew", $uplinenew);
// var_dump($uplinenew);

/*  Cari Upline */
    $condiional_header1 = "";
    $condiional_footer1 = "";

$query = "SELECT 
		  client_aecode.name,
		  client_aecode.email,
		  client_accounts.`accountname`,
		  mlm.`ACCNO`
		FROM
		  client_aecode,
		  client_accounts,
		  mlm 
		WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid` 
		  AND client_accounts.`accountname` = mlm.`ACCNO`
		  AND mlm.`ACCNO` = '$accupnya' ";
$datatress1 = array();
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $datatress1[$row['ACCNO']] = $row;
}
// var_dump($datatress);
$longtree1 = $condiional_header1;
if (count($datatress1) > 0) {
    foreach ($datatress1 AS $Upline1 => $datatres1) {
        $longtree1 = $longtree1 .$Upline1;
        $longtree1 = updatechild($longtree1, $Upline1);
        $longtree1 = $longtree1 ;
    }
}
$longtree1 = $longtree1 . $condiional_footer1;
$template->assign("longtree1", $longtree1);
// var_dump($longtree1);
/* End Cari Upline */
$query = "SELECT 
		  client_accounts.`email`,
		  client_aecode.`name` 
		FROM
		  client_accounts,
		  client_aecode 
		WHERE client_accounts.`email` = client_aecode.`aecode` 
		  AND client_accounts.`accountname` IN ('$longtree1')";
		$uplineold = array();
		$rows = $DB->execresultset($query);

foreach ($rows as $row) {
    $uplineold[] = $row;
}
$template->assign("uplineold", $uplineold);
// var_dump($uplineold);

$query = "SELECT 
		  client_accounts.`email`
		FROM
		  client_accounts
		WHERE client_accounts.`accountname` = '$accno'";
		$mailmeta = array();
		$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $mailmeta = $row['email'];
}
$template->assign("mailmeta", $mailmeta);
// var_dump($mailmeta);

$query = "SELECT 
			  mlm.`group_play` 
			FROM
			  mlm,
			  client_accounts 
			WHERE mlm.`ACCNO` = client_accounts.`accountname`
			AND mlm.`group_play`<>'Car' 
			AND client_accounts.`email` = '$mailmeta'
			ORDER BY group_play ASC";
   
     $rows = $DB->execresultset($query);
		$view= "";
	 foreach ($rows as $row) {
         $view[] = $row;
    }
    $template->assign("view", $view);
	 // var_dump($view);
		
/*=====  End of Coding  ======*/
$template->display("car_uplinechange_2meta.htm");

function updatechild($longtree, $Upline2) {
	
    $longtree = $longtree . "";
	global $user;
    global $DB;
    $datatress = array();
    $query = "SELECT 
		  client_aecode.name,
		  client_aecode.email,
		  client_accounts.`accountname`,
		  mlm.`Upline`
		FROM
		  client_aecode,
		  client_accounts,
		  mlm 
		WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid` 
		  AND client_accounts.`accountname` = mlm.`ACCNO`
		  AND mlm.`Upline` <> 'COMPANY'
		  AND mlm.`ACCNO` = '$Upline2' ";

    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $datatress[$row['Upline']] = $row;
    }
	// var_dump($datatress);
	
	$query = "SELECT 
	mlm.`ACCNO`,
	mlm.`Upline`
	FROM
	mlm,
	client_accounts
	WHERE mlm.`ACCNO`=client_accounts.`accountname`
	AND mlm.`group_play`='Car'
	AND client_accounts.`email` ='$user->username' ";

	$rows = $DB->execresultset($query);
	$bm="";
	foreach ($rows as $row) {
		$bm = $row['Upline'];
	}
		// var_dump($bm);
	
    if (count($datatress) > 0) {
        foreach ($datatress AS $Upline1 => $datatres) {
			if ($bm != $Upline1){
				$longtree = $longtree . "','" . $Upline1;
				$longtree = updatechild($longtree, $Upline1);
				$longtree = $longtree;
				// var_dump($Upline1);
			}
            
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