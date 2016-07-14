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
$template->assign("token", $token);
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'ar_arisan';

/*====================================
=            Start Coding            =
====================================*/

// $query = "SELECT 
//   client_accounts.`accountname`
// FROM
//   client_aecode,
//   client_accounts 
// WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid` 
// AND client_aecode.`aecode` = '$user->username'";

$tgl = date('Ym', time());
$pv  = "PV:".$tgl;
$query = "SELECT 
  client_accounts.`accountname`
FROM
  client_aecode,
  client_accounts,
  mlm
WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid` 
AND client_accounts.`accountname` = mlm.`ACCNO`
AND client_aecode.`aecode` = '$user->username'
AND mlm.`companyconfirm` = '2'";
// var_dump($query);
$result = $DB->execresultset($query);

$cekaccount = count($result);
$accountlist = array();
foreach($result as $row){
	$query = "SELECT 
			  COUNT(mlm_arisan_account.`arisan_account` ) AS jml
			FROM
			  mlm_arisan_account 
			WHERE mlm_arisan_account.`accountname` = '".$row['accountname']."' 
			  AND mlm_arisan_account.`finished` = '0' ";
	$hasil = $DB->execresultset($query);
	$hitung = $hasil[0]['jml'];
	$accountlist = array();
	if ($hitung == '0') {
		$accountlist[] = $row['accountname'];
	}
}
if ($cekaccount < 1) {
	$msg = "Mmm .. It seems you do not have an Apex account , please Create one";
	$status = "hidden";
}elseif ($cekaccount > 0 && empty($accountlist)) {
	$msg = "All Accounts has been Participate, thank you ";
	$status = "hidden";
}elseif ($cekaccount > 0 && !empty($accountlist)) {
	$msg = "Mm .. You have an accounts not yet Participate ";
	$status = "";
}
$template->assign("status",$status);
$template->assign("msg",$msg);
$template->assign("accountlist",$accountlist);
// var_dump($accountlist);
/*=====  End of Start Coding  ======*/
$query = "SELECT
  client_accounts.`accountname`,
  mlm_arisan_account.`arisan_account`,
  mlm_arisan.`datetime`,
  mlm_arisan.`id_block`,
  mlm_arisan_block.`block`,
  mlm_arisan_block.`board`
FROM
  client_accounts,
  client_aecode,
  mlm_arisan_account,
  mlm_arisan_block,
  mlm_arisan
  WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
  AND client_accounts.`accountname` = mlm_arisan_account.`accountname`
  AND mlm_arisan_account.`arisan_account` = mlm_arisan.`arisan_account`
  AND mlm_arisan.`id_block` = mlm_arisan_block.`id`
  AND mlm_arisan_account.finished = '0'
  AND client_aecode.`aecode` = '$user->username'";
$result = $DB->execresultset($query);
// echo "<pre>";
// print_r($query);
// echo "</pre>";
// var_dump($query);
$i = 0;
$tampil = array();
foreach($result as $row){
    $block_Id = $row['id_block'];
    $apex_account = $row['accountname'];
    $arisan_account = $row['arisan_account'];
    $datetime = $row['datetime'];
    $tempat = $row['block'] ." " . $row['board'];
    $query = "SELECT `id`,
       (SELECT COUNT(*) FROM `mlm_arisan` WHERE id_block = '$block_Id' AND mlm_arisan.`datetime` <= '$datetime') AS `position`,
       (SELECT COUNT(*) FROM `mlm_arisan` WHERE id_block = '$block_Id') AS `banyak`
FROM `mlm_arisan`
WHERE mlm_arisan.`arisan_account` = '$arisan_account'";
    $hasil = $DB->execresultset($query);
    foreach($hasil as $rows){
        $position = $rows['position'];
        $banyak = $rows['banyak'];
    }
    $tampil[$i]['apex_account'] = $apex_account;
    $tampil[$i]['arisan_account'] = $arisan_account;
    $tampil[$i]['position'] = $position;
    $tampil[$i]['banyak'] = $banyak;
    $tampil[$i]['tempat'] = $tempat;    
    $i++;
}

$template->assign("tampil", $tampil);
$template->display("ar_arisan.htm");

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