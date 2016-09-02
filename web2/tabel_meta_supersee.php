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

$_SESSION['page'] = 'tabel_meta_supersee';
/*==============================
=        Start Coding          =
==============================*/

$lihat = "";
if (isset($_GET['lihat'])) {
	$lihat = $_GET['lihat'];
}
$template->assign("lihat", $lihat);
// var_dump($lihat);

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
	  mlm.`comisi`,
	  mlm.`group_play`,
	  (SELECT 
	  SUM(VOLUME)
	FROM
	  " . $mt4dt . ".mt4_trades 
	WHERE " . $mt4dt . ".mt4_trades.`COMMISSION` <> '0' 
	  AND " . $mt4dt . ".mt4_trades.`LOGIN` =  mlm.`group_play` 
	  AND CLOSE_TIME BETWEEN '$commissiondate $commissionhour' 
	  AND '$todate $tohour'
	  AND " . $mt4dt . ".mt4_trades.`SYMBOL`<> 'ADJ_RO'
	AND " . $mt4dt . ".mt4_trades.`SYMBOL`<> 'ADJ_FEE') AS lot_meta
	FROM
	  mlm,
	  client_accounts,
	  client_aecode 
	WHERE mlm.`ACCNO` = client_accounts.`accountname` 
	  AND client_accounts.`email` = client_aecode.`aecode`
	  AND mlm.`group_play`<>'Car'
	  AND client_accounts.`email` = '$lihat'";
	$rows = $DB->execresultset($query);
	$i = 0;
	$sumlot = 0;
	$sumcom = 0;
	// print_r ($query);
	foreach ($rows as $row) {
			$cekdowns[]= $row;
			$cekdowns[$i]['lot_meta']= $row['lot_meta']/100;
			$cekdowns[$i]['totalcom']= $cekdowns[$i]['lot_meta']*$cekdowns[$i]['comisi'] ;
			
			$sumlot = $sumlot + $row['lot_meta']/100;
			$sumcom = $sumcom + $cekdowns[$i]['totalcom'];
			
			$i++;
			
	}



	$template->assign("cekdowns", $cekdowns);
	$template->assign("sumlot", $sumlot);
	$template->assign("sumcom", $sumcom);

	// var_dump($cekdowns);
	// var_dump($sumlot);
	// var_dump($sumcom);




/* End Cari Downline Yang Ada Order */	

/*$comdownline = array();
$query	  = "SELECT
 client_aecode.`name`,
  client_aecode.`aecode` ,
  (SELECT 
  SUM(VOLUME) / 100 AS lot
FROM
  mlm,
  client_accounts,
  agrodana_source.mt4_trades 
WHERE mlm.`ACCNO` = client_accounts.`accountname` 
  AND mlm.`group_play` <> 'Car' 
  AND mt4_trades.`COMMISSION` <> '0' 
  AND agrodana_source.mt4_trades.`LOGIN` = mlm.`group_play`
  AND client_accounts.`email`=client_aecode.`aecode` 
  AND CLOSE_TIME BETWEEN '$commissiondate $commissionhour' 
  AND '$todate $tohour')AS lot 
FROM
  client_aecode
WHERE client_aecode.`aecode` IN ('$downline')";
$rows = $DB->execresultset($query);
// print_r ($query);
foreach ($rows as $row) {
	
		$comdownline[]= $row;
		
}
$template->assign("comdownline", $comdownline);

var_dump($comdownline);


$query = "SELECT ACCNO, Upline FROM mlm WHERE mt4login != 0";
$hasil = $DB->execresultset($query);
var_dump($hasil);
foreach($hasil as $row){
	$test[] = cekUpline($row['ACCNO']);
}*/
/*=====  End of Coding  ======*/
$template->display("tabel_meta_supersee.htm");

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

/*function cekUpline($account){
	global $DB;
	$query = "SELECT ACCNO, Upline FROM mlm WHERE ACCNO = '$account'";
	$result = $DB->execresultset($query);
	$data = array();
	foreach($result as $row){
		$data[] = $row;
	}
	if(empty($data)){
		
	}else{
		cekUpline($row['Upline']);
		$datas[$account] = $row['Upline'];
	}
	
	return $datas;
}*/

?>