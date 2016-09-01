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

$_SESSION['page'] = 'car_uplinechange';
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
 
/*  Cari Downline */
$usernya = $user->groupid;
$condiional = "";
if ($usernya==9) {
    $condiional = "AND mlm.Upline = 'COMPANY' AND mlm.ACCNO <> 'COMPANY'";
    $condiional_header = "''";
    $condiional_footer = "";
}else{
    $condiional = "AND client_aecode.aecode = '" . $user->username . "'";
    $condiional_header = "''";
    $condiional_footer = "";
}

$query = "SELECT client_aecode.name, client_aecode.email, client_accounts.`accountname`,mlm.*   
        FROM client_aecode,client_accounts,mlm  
        WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
        AND client_accounts.`suspend` = '0' 
        AND client_accounts.`accountname` = mlm.`ACCNO`
		AND mlm.`group_play`='Car'
          $condiional";
$datatress = array();
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $datatress[$row['ACCNO']] = $row;
}
// var_dump($datatress);
$longtree = $condiional_header;
if (count($datatress) > 0) {
    foreach ($datatress AS $ACCNO1 => $datatres) {
        $longtree = $longtree .",'".$ACCNO1."'";
        $longtree = updatechild($longtree, $ACCNO1);
        $longtree = $longtree . "";
    }
}
$longtree = $longtree . $condiional_footer;
$template->assign("longtree", $longtree);
 // var_dump($longtree);
/* End Cari Downline */	
$ceks = array();
$query	  = "SELECT
			client_accounts.`email`,
			client_accounts.`accountname`,
			client_aecode.`name` 
			FROM
			client_accounts,
			client_aecode 
			WHERE accountname IN ($longtree)
			AND client_accounts.`email` = client_aecode.`aecode`
			ORDER BY name ASC";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
		$ceks[]= $row;;
}
$template->assign("ceks", $ceks);
// var_dump($ceks);

$namenya = array();
$query	  = "SELECT
			client_accounts.`email`,
			client_accounts.`accountname`,
			client_aecode.`name` 
			FROM
			client_accounts,
			client_aecode 
			WHERE accountname IN ($longtree)
			AND client_accounts.`email` = client_aecode.`aecode`
			ORDER BY name ASC";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
		$namenya[]= $row;;
}
$template->assign("namenya", $namenya);
// var_dump($namenya);

$semail = "";
if (isset($_GET['showemail'])) {
    $semail = $_GET['showemail'];
}
$template->assign("semail", $semail);
// var_dump($semail);

$shownya = "";
if (isset($_GET['shownya'])) {
    $shownya = $_GET['shownya'];
}
$template->assign("shownya", $shownya);
// var_dump($shownya);

		$tampil = "" ;
		$tampil1 = "" ;
		$tampil2 = "" ;
		$query	  = "SELECT 
				  mlm.`ACCNO`,
				  mlm.`Upline`,
				  client_aecode.`name` 
				FROM
				  mlm,
				  client_aecode,
				  client_accounts 
				WHERE mlm.`ACCNO` = '$semail' 
				  AND mlm.`Upline` = client_accounts.`accountname` 
				  AND client_accounts.`email` = client_aecode.`aecode` ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$tampil = $row['ACCNO'];	
		$tampil1 = $row['Upline'];	
		$tampil2 = $row['name'];	
		}
		$template->assign("tampil", $tampil);
		$template->assign("tampil1", $tampil1);
		$template->assign("tampil2", $tampil2);
		
		
		  // var_dump($tampil);
		 

/*=====  End of Coding  ======*/
$template->display("car_uplinechange.htm");


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