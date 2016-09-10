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

$_SESSION['page'] = 'tabel_openadmin';
/*==============================
=        Start Coding          =
==============================*/
$commissiondate = "";
if (isset($_GET['commissiondate'])) {
	$commissiondate = $_GET['commissiondate'];
}
$template->assign("commissiondate", $commissiondate);
// var_dump($commissiondate);

$commissionhour = "";
if (isset($_GET['commissionhour'])) {
	$commissionhour = $_GET['commissionhour'];
}
$template->assign("commissionhour", $commissionhour);
// var_dump($commissionhour);

$todate = "";
if (isset($_GET['todate'])) {
	$todate = $_GET['todate'];
}
$template->assign("todate", $todate);
// var_dump($todate);

$tohour = "";
if (isset($_GET['tohour'])) {
	$tohour = $_GET['tohour'];
}
$template->assign("tohour", $tohour);
// var_dump($tohour);

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
          $condiional
        ";
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
// echo "<pre>";
// print_r($longtree);
// echo "</pre>";

/* End Cari Downline */	

$query = "SELECT 
		  client_accounts.`email`
		FROM
		  client_accounts,
		  mlm,
		  marketing 
		WHERE mlm.`ACCNO` = client_accounts.`accountname` 
		AND client_accounts.`email`= marketing.`email`
		AND marketing.`group_city` IN ('SBYA','SBYB','SBYC','SBYD','SBYE','SBYF','SBYG','SBYH','BDGC','BDGE','JKTI','MLGA')
		AND client_accounts.`accountname` IN ($longtree)";
   
     $rows = $DB->execresultset($query);
		$view= array();
	 foreach ($rows as $row) {
         $view[] = $row['email'];
    }
    $template->assign("view", $view);
	 // var_dump($view);
$accountnya=implode("','",$view);
$template->assign("accountnya", $accountnya);
// var_dump($accountnya);
// echo "<pre>";
// print_r($accountnya);
// echo "</pre>";

/* Cari Downline Yang Ada Order*/
$query = "SELECT mt_database.`mt4dt` FROM mt_database";
   
     $rows = $DB->execresultset($query);
		$mt4dt= array();
	 foreach ($rows as $row) {
         $mt4dt = $row['mt4dt'];
    }
	 // var_dump($mt4dt);
$multiarray = array();
$query	  = "SELECT 
  mlm.`ACCNO`,
  mlm.`group_branch`,
  mlm.`comisi`,
  (SELECT 
  SUM(VOLUME)/100 
FROM
  " . $mt4dt . ".mt4_trades 
WHERE " . $mt4dt . ".mt4_trades.`CMD` IN ('0','1')
  AND " . $mt4dt . ".mt4_trades.`LOGIN` =  mlm.`group_play` 
  AND OPEN_TIME BETWEEN '$commissiondate $commissionhour' 
  AND '$todate $tohour'
  AND " . $mt4dt . ".mt4_trades.`SYMBOL`<> 'ADJ_RO'
AND " . $mt4dt . ".mt4_trades.`SYMBOL`<> 'ADJ_FEE') AS lot_meta
FROM
  mlm,
  client_accounts 
WHERE mlm.`ACCNO` = client_accounts.`accountname` 
  AND mlm.`group_play`<>'Car'
  AND client_accounts.`email` IN ('$accountnya')";
  
$rows = $DB->execresultset($query);
$i = 0;
// print_r ($query);
foreach ($rows as $row) {
		
		$multiarray[$row['group_branch']][$i] = $row;
		$multiarray[$row['group_branch']][$i]['totalcom']= $row['lot_meta']*$row['comisi'] ;
		
		$i++;		
}

$i2 = 0;
$sumlot1 = 0;
$sumcom1 = 0;
$datas = array();
foreach ($multiarray as $key => $test1){
	$datas[$i2]['group_branch'] = $key;
	$jmllot = 0;
	$jmlcom = 0;
	foreach ($test1 as $tes2){
		
	$jmllot = $jmllot + $tes2['lot_meta'];
	$jmlcom = $jmlcom + $tes2['totalcom'];
	}
	
	$datas[$i2]['lots'] = $jmllot;
	$datas[$i2]['coms'] = $jmlcom;
	$sumlot1 = $sumlot1 + $datas[$i2]['lots'];
	$sumcom1 = $sumcom1 + $datas[$i2]['coms'];
	$i2++;
}



$template->assign("datas", $datas);
$template->assign("sumlot1", $sumlot1);
$template->assign("sumcom1", $sumcom1);


// var_dump($multiarray);
// var_dump($datas);
// var_dump($sumlot1);
// var_dump($sumcom1);


/*=====  End of Coding  ======*/
$template->display("tabel_openadmin.htm");

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