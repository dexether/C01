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

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}
//TradeLogUnderConstruct_Secure("Postmode :".$postmode);

$name = '';
if (isset($_POST['name'])){
	$name = $_POST['name'];
}

$accno = '';
if (isset($_POST['accno'])){
	$accno = $_POST['accno'];
}
//TradeLogUnderConstruct_Secure("accno :".$accno);
$_SESSION['page'] = 'ar_account_remove';
/*====================================
=            Start Coding            =
====================================*/
if(empty($postmode)){
$query="SELECT name FROM client_aecode";
$result = $DB->execresultset($query);
$template->assign("names",$result);
$template->display("ar_account_remove.htm");
}

if($postmode == 'getaccno'){
	//TradeLogUnderConstruct_Secure("Client :".$name);
	$query="SELECT accountname FROM client_aecode,client_accounts WHERE client_aecode.aecodeid = client_accounts.aecodeid AND client_aecode.name = '$name' ORDER BY accountname asc";
	//TradeLogUnderConstruct_Secure("Query :".$query);
	$result = $DB->execresultset($query);
	$accno= array();
	foreach($result as $row){
		$accno[]=$row['accountname'];
	}
	echo json_encode($accno);
}

if($postmode == "getupline"){
	$query="SELECT client_aecode.name as names, client_accounts.accountname as accnos FROM client_accounts,client_aecode,mlm WHERE client_accounts.aecodeid = client_aecode.aecodeid AND client_accounts.accountname = mlm.accno AND mlm.accno = (SELECT upline FROM mlm WHERE accno = '$accno')";
	$result = $DB->execresultset($query);
	//TradeLogUnderConstruct_Secure("Query :".$query);
	$upline=array();
	foreach($result as $row){
		$upline[]=$row;
	}
	$json = json_encode($upline);
	//TradeLogUnderConstruct_Secure("Upline :".$json);
	echo json_encode($upline);
}


/*=====  End of Start Coding  ======*/




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