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

$_SESSION['page'] = 'tabel_dc';
/*==============================
=        Start Coding          =
==============================*/
$meta = "";
if (isset($_POST['example'])) {
	$meta = $_POST['example'];
}
// var_dump($meta);
$metanya=implode("','",$meta);
// var_dump($metanya);

$commissiondate = "";
if (isset($_POST['commissiondate'])) {
	$commissiondate = $_POST['commissiondate'];
}
$commissiondatenya=implode("",$commissiondate);
// var_dump($commissiondatenya);
// var_dump($commissiondate);

$commissionhour = "";
if (isset($_POST['commissionhour'])) {
	$commissionhour = $_POST['commissionhour'];
}
$commissionhournya=implode("",$commissionhour);
// var_dump($commissionhournya);
// var_dump($commissionhour);

$todate = "";
if (isset($_POST['todate'])) {
	$todate = $_POST['todate'];
}
$todatenya=implode("','",$todate);
// var_dump($todatenya);
// var_dump($todate);

$tohour = "";
if (isset($_POST['tohour'])) {
	$tohour = $_POST['tohour'];
}
$tohournya=implode("','",$tohour);
// var_dump($tohournya);
// var_dump($tohour);

/* Cari Downline Yang Ada Order*/
$query = "SELECT mt_database.`mt4dt` FROM mt_database";
   
     $rows = $DB->execresultset($query);
		$mt4dt= array();
	 foreach ($rows as $row) {
         $mt4dt = $row['mt4dt'];
    }
	// var_dump($mt4dt);
$cekdowns = array();
$query	  = "SELECT 
  metode_comisi.`diva`,
  metode_comisi.`divb`,
  metode_comisi.`divc`,
  metode_comisi.`divd`,
  metode_comisi.`divide`,
  mlm.`group_branch`,
  (SELECT 
  SUM(VOLUME)/100
FROM
  " . $mt4dt . ".mt4_trades 
WHERE " . $mt4dt . ".mt4_trades.`COMMISSION` <> '0' 
  AND " . $mt4dt . ".mt4_trades.`LOGIN` =  mlm.`group_play` 
  AND CLOSE_TIME BETWEEN '$commissiondatenya $commissionhournya' 
  AND '$todatenya $tohournya'
  AND " . $mt4dt . ".mt4_trades.`SYMBOL`<> 'ADJ_RO'
AND " . $mt4dt . ".mt4_trades.`SYMBOL`<> 'ADJ_FEE') AS lot_meta
FROM
  mlm,
  cas_comisi,
  metode_comisi 
WHERE mlm.`group_play` = cas_comisi.`log_meta` 
AND metode_comisi.`group_branch`=mlm.`group_branch` 
  AND mlm.`group_play`<>'Car'
  AND mlm.`ACCNO` IN ('$metanya')
  ORDER BY group_play ASC ";

$rows = $DB->execresultset($query);
$i = 0;
// print_r ($query);
foreach ($rows as $row) {
		
		$cekdowns[$row['group_branch']][$i] = $row;
		$i++;
}
$i2 = 0;
$sumlot1 = 0;
$sumcom1 = 0;
$sumdc1 = 0;
$datas = array();
foreach ($cekdowns as $key => $test1){
	$datas[$i2]['group_branch'] = $key;
	$jmllot = 0;
	$jmldc = 0;
	foreach ($test1 as $tes2){
	
	$jmllot = $jmllot + $tes2['lot_meta'];
	$jmldc = $jmldc + $tes2['lot_meta']*$tes2['divide'];
	
	}
	
	$datas[$i2]['lots'] = $jmllot;
	$datas[$i2]['dc'] = $jmldc;
	$datas[$i2]['diva'] = $jmldc*$tes2['diva']/$tes2['divide'];
	$datas[$i2]['divb'] = $jmldc*$tes2['divb']/$tes2['divide'];
	$datas[$i2]['divc'] = $jmldc*$tes2['divc']/$tes2['divide'];
	$datas[$i2]['divd'] = $jmldc*$tes2['divd']/$tes2['divide'];
	$sumlot1 = $sumlot1 + $datas[$i2]['lots'];
	$sumdc1 = $sumdc1 + $datas[$i2]['dc'];
	$i2++;
}



$template->assign("datas", $datas);
$template->assign("sumlot1", $sumlot1);
$template->assign("sumcom1", $sumcom1);
$template->assign("sumdc1", $sumdc1);


// var_dump($cekdowns);
// var_dump($datas);
// var_dump($sumlot1);
// var_dump($sumcom1);
/* End Cari Downline Yang Ada Order */

/*=====  End of Coding  ======*/
$template->display("tabel_dc.htm");

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