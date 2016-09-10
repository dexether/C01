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
$error = "success";
$errno = 0;
$subject = "Success !";
$msg = "Your request has been complete";

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

$accno = '';
if (isset($_POST['accno'])){
	$accno = $_POST['accno'];
}
//TradeLogUnderConstruct_Secure("accno :".$accno);
$upline = '';
if (isset($_POST['upline'])){
	$upline = $_POST['upline'];
}
//TradeLogUnderConstruct_Secure("upline :".$upline);
//TradeLogUnderConstruct_Secure("accno :".$accno);
$_SESSION['page'] = 'ar_account_remove';
/*====================================
=            Start Coding            =
====================================*/

if($postmode == 'remove'){
	//TradeLogUnderConstruct_Secure("Client :".$name);
	$query="SELECT accno FROM mlm WHERE upline = $accno";
	//TradeLogUnderConstruct_Secure("Query :".$query);
	$result = $DB->execresultset($query);
	$anak = '';
	foreach($result as $row){
		if (empty($anak)){
			$anak = "'".$row['accno']."'";
		}else{
			$anak = $anak.",'".$row['accno']."'";
		}
	}
	
	$query="UPDATE mlm SET upline = $upline WHERE accno IN ($anak)";
	//TradeLogUnderConstruct_Secure("Query".$query);
	$result = $DB->execonly($query);
	
	$query="DELETE FROM mlm WHERE accno = '$accno'";
	$result = $DB->execonly($query);
	
	$query="DELETE FROM client_accounts WHERE accountname = '$accno'";
	$result = $DB->execonly($query);
	
	$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
// header("Content-Type: application/json;charset=utf-8");
	echo json_encode($response);
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