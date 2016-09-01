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

$_SESSION['page'] = 'admin_car_schedule_bm';
/*==============================
=        Start Coding          =
==============================*/


    $query = "SELECT 
			  branch_manager.*,
			  client_aecode.* 
			FROM
			  client_aecode,
			  branch_manager,
			  mlm 
			WHERE client_aecode.aecode = '$user->username' 
			  AND mlm.`ACCNO` = branch_manager.`account` 
			  AND client_aecode.`aecode` = mlm.`updateby`";
    //TradeLog_MLMRegistration("MLM_Registration-84=" . $user->groupid . ";" . $query);
    $rows = $DB->execresultset($query);
	$clientaecode = "";
    foreach ($rows as $row) {
        $clientaecode[] = $row;
    }
    $template->assign("clientaecode", $clientaecode);



/*=====  End of Coding  ======*/
$query = "SELECT 
			  branch_manager.`branch` 
			FROM
			  branch_manager 
			WHERE branch_manager.`email`='$user->username' ";
   
     $rows = $DB->execresultset($query);
	$bm="";
	 foreach ($rows as $row) {
         $bm = $row['branch'];
    }
    $template->assign("bm", $bm);
	// var_dump($secretaris);

if ($user->groupid == '9'){
	$ceks = array();
	$query	  = "SELECT 
				SCHEDULE.* 
				FROM
				  SCHEDULE,
				  mlm 
				WHERE schedule.`nameaccount` = mlm.`ACCNO` 
				  AND schedule.car_id = 'no car' ";
	$rows = $DB->execresultset($query);
	foreach ($rows as $row) {
	$ceks[] = $row;
	}
	$template->assign("ceks", $ceks);
	// var_dump($ceks);
}else {
	 $ceks = array();
	$query	  = "SELECT 
				  SCHEDULE.* 
				FROM
				  SCHEDULE,
				  mlm 
				WHERE schedule.`nameaccount` = mlm.`ACCNO`
				AND schedule.car_id = 'no car' 
				AND mlm.branch = '$bm'";
	$rows = $DB->execresultset($query);
	foreach ($rows as $row) {
	$ceks[] = $row;
	}
	$template->assign("ceks", $ceks);
	// var_dump($ceks);
}	

// car
$meta = "SELECT 
  car.car_id,
  car.name_car 
FROM
  car 
WHERE enabled = 'yes'
AND branch IN ('$bm','OK')   
ORDER BY car.car_id ASC ";
$meta_query = $DB->execresultset($meta);
$template->assign("meta_array", $meta_query);

$cari = "";
if(isset($_GET['accno'])){
    $cari = $_GET['accno'];
}
$template->assign("cari", $cari);
 // var_dump ($cari);
$cari1="";
if(isset($_GET['ACCNO'])){
    $cari1 = $_GET['ACCNO'];
}
$tampil="";
if(isset($_GET['tampil'])){
    $tampil = $_GET['tampil'];
}
if(isset($_GET['accno'])){
    $cari = $_GET['accno'];
}else{
	$cari = $cari1;
}

$statements ="";
$statements1="";
$statements2="";
$statements3="";
$statements4="";
$statements5="";
$statements6=""; 
$statements7=""; 
$statements8=""; 
$statements9=""; 

$query	  = "SELECT 
			  * 
			FROM
			  SCHEDULE 
			WHERE schedule_id = '$cari' ";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
$statements = $row['datetime'];
$statements1 = $row['schedule_id'];
$statements2 = $row['car_id'];
$statements3 = $row['team_id'];
$statements4 = $row['nameaccount'];
$statements5 = $row['email'];
$statements6 = $row['destination'];
$statements7 = $row['meet_with'];
$statements8 = $row['date_meeting'];
$statements9 = $row['time_meeting'];



}
$template->assign("statements", $statements);
$template->assign("statements1", $statements1);
$template->assign("statements2", $statements2);
$template->assign("statements3", $statements3);
$template->assign("statements4", $statements4);
$template->assign("statements5", $statements5);
$template->assign("statements6", $statements6);
$template->assign("statements7", $statements7);
$template->assign("statements8", $statements8);
$template->assign("statements9", $statements9);


if($tampil == "no"){
	
	$query	  = "SELECT 
			  * 
			FROM
			  SCHEDULE 
			WHERE schedule_id = '$cari' ";
$rows = $DB->execresultset($query);
if(count($rows) > 0){
	$template->display("admin_car_schedule_bm.htm");
	}else{
	echo "0";
	}
}
	else{
		$template->display("admin_car_schedule_bm.htm");
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