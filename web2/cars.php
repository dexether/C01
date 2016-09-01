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

$_SESSION['page'] = 'cars';
/*==============================
=        Start Coding          =
==============================*/

if ($user->groupid == '3') {
    $query = "SELECT client_aecode.*   
        from client_aecode 
        where 
        client_aecode.aecode = '$user->username'";
    //TradeLog_MLMRegistration("MLM_Registration-84=" . $user->groupid . ";" . $query);
    $rows = $DB->execresultset($query);
	$clientaecode = "";
    foreach ($rows as $row) {
        $clientaecode = $row;
    }
    $template->assign("clientaecode", $clientaecode);

} else {
	 $query = "SELECT client_aecode.*   
        from client_aecode 
        where 
        client_aecode.aecode = '$user->username'";
    //TradeLog_MLMRegistration("MLM_Registration-84=" . $user->groupid . ";" . $query);
    $rows = $DB->execresultset($query);
	$client = "";
    foreach ($rows as $row) {
        $client = $row;
    }
    $template->assign("client", $client);
}

$query	  = "SELECT 
			  branch_manager.`email`, 
			  branch_manager.`branch` 
			FROM
			  branch_manager WHERE branch_manager.`email`='$user->username'
			ORDER BY email ASC  ";
		$rows = $DB->execresultset($query);
		$special="";
		$specialbranch="";
		foreach ($rows as $row) {
		$special= $row['email'];
		$specialbranch= $row['branch'];
		}
		$template->assign("special", $special);
		$template->assign("specialbranch", $specialbranch);
		// var_dump($special);
		// var_dump($specialbranch);
		
		 
$query	  = "SELECT 
			  secretaris.`email`, 
			  secretaris.`branch` 
			FROM
			  secretaris WHERE secretaris.`email`='$user->username'
			ORDER BY email ASC  ";
		$rows = $DB->execresultset($query);
		$special1="";
		$specialbranch1="";
		foreach ($rows as $row) {
		$special1= $row['email'];
		$specialbranch1= $row['branch'];
		}
		$template->assign("special1", $special1);
		$template->assign("specialbranch1", $specialbranch1);
		// var_dump($special1);
		// var_dump($specialbranch1);
if ($user->groupid == '9'){
	$ceks = array();
$query	  = "SELECT 
  * 
FROM
  car 
WHERE car.enabled <> 'no'
ORDER BY car_id ASC ";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
$ceks[] = $row;
}
$template->assign("ceks", $ceks);
// var_dump($ceks);
}else {
	$ceks = array();
$query	  = "SELECT 
  * 
FROM
  car 
WHERE branch IN ('$specialbranch','$specialbranch1')
AND car.enabled <> 'no'
ORDER BY car_id ASC ";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
$ceks[] = $row;
}
$template->assign("ceks", $ceks);
// var_dump($ceks);
}


$action = "";
if(isset($_GET['lihat'])){
    $action = $_GET['lihat'];
}
$template->assign("action", $action);
// var_dump ($action);



$statements=""; 
$statements0=""; 
$statements1=""; 
$statements2=""; 
$statements3=""; 

$query	  = "SELECT 
  * 
FROM
  car 
WHERE car_id ='$action'";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
$statements = $row['desc_car'];
$statements0 = $row['name_car'];
$statements1 = $row['enabled'];
$statements2 = $row['car_id'];
$statements3 = $row['capacity'];
}
$template->assign("statements", $statements);
$template->assign("statements0", $statements0);
$template->assign("statements1", $statements1);
$template->assign("statements2", $statements2);
$template->assign("statements3", $statements3);
// var_dump ($statements);
// var_dump ($statements1);
// var_dump ($statements2);
// var_dump ($statements3);


/*=====  End of Coding  ======*/
$template->display("cars.htm");

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