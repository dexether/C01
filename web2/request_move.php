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

$query  = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years  = date('Y', time());
foreach ($result as $rows) {
    $companys         = $rows;
    $companys['year'] = $years;
}

include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
$theFetchAccount = new theOtherFetchAccounts();
$cabang_admin = 'semua';
$accounts = $theFetchAccount->fetchAccountslangsung($user, $mysql['meta'], $cabang_admin);

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


$email = $user->username;


$_SESSION['page'] = 'request_move';
$postmode = '';
if(isset($_GET['postmode'])){
	$postmode = anti_injection($_GET['postmode']);
}

if($postmode != 'doRequest'){
	$query = "SELECT request_move.* FROM request_move,client_aecode WHERE request_move.aecode = '$email' AND request_move.requestby = client_aecode.aecodeid";
	TradeLogTreView($query);
	$result = $DB->execresultset($query);
	$requests = array();
	foreach($result as $row){
		$requests = $row;
	}
	$template->assign("requests", $result);
	$template->display("request_move.htm");
}



if($postmode == 'doRequest'){
	$cabinetid = $_POST['cabinetid'];
	$uplineid = $_POST['uplineid'];
	
	$query = "SELECT client_aecode.name FROM client_accounts,client_aecode WHERE client_accounts.accountname = '$cabinetid' AND client_accounts.aecodeid = client_aecode.aecodeid";
	$result = $DB->execresultset($query);
	foreach($result as $row){
		$name = $row['name'];
	}
	
	$query = "SELECT client_aecode.name, client_accounts.accountname FROM client_aecode,client_accounts WHERE client_code.aecode = '$email' AND client_aecode.aecodeid = client_accounts.aecodeid";
	$result = $DB->execresultset($query);
	foreach($result as $row){
		$requestbyname = $row['name'];
		$requestbyno = $row['aecodeid'];
	}
	
	$query = "INSERT INTO request_move (name,cabinetid,newupline,requestby,requestbyname,requestbyno) VALUES('$name','$cabinetid','$uplineid','$requestby','$requestbyname','$requestbyno')";
	if($result = $DB->execonly($query)){
		$error            = "success";
		$subject          = "Permohonan ganti upline berhasil";
        $msg              = "Admin akan memverifikasi permohonan anda";
        $link             = $companys['appurl'] . "/web2/mainmenu.php";
        $_SESSION['page'] = 'request_move';
		clientlogs('The ' . $user->username . ' has requested change the upline of ' . $account . ' to ' . $new_upline . ', and Successfuly ', 'UPDATE');
	}else{
		$error   = "error";
        $subject = "Oops, Something has happened";
        $msg     = "Try refresing the web page";
	}
	$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg, 'link' => $link);
	// header("Content-Type: application/json;charset=utf-8");
	echo json_encode($response);
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

function clientlogs($details, $logtype)
{
   global $DB;
   global $user;
   $rolldate = date('Y-m-d', time());
   $datetime = date('Y-m-d H:i:s', time());
   $query    = "INSERT INTO client_logs SET username = '$user->username', logdate = '$datetime', rolldate = '$rolldate', logtype = '$logtype', details = '$details'";
   $DB->execonly($query);
}

function TradeLogTreView($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>

