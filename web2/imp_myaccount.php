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
$query  = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years  = date('Y', time());
foreach ($result as $rows) {
    $companys         = $rows;
    $companys['year'] = $years;
}
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

$_SESSION['page'] = 'imp_myaccount';

/*====================================
=            Start Coding            =
====================================*/

$query = "SELECT
client_aecode.`name`,
client_aecode.`email`,
client_accounts.`accountname`,
client_accounts.`suspend`,
mlm.`group_play`,
mlm.`companyconfirm`
FROM
client_accounts,
client_aecode,
mlm
WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
AND client_accounts.`accountname` = mlm.`ACCNO`
AND client_aecode.`aecode` = '$user->username'";
TradeLogUnderConstruct_Secure("query-36 :".$query);
$result = $DB->execresultset($query);
$i = 0;
$alldatas = array();
foreach($result as $row){
	$alldatas[$i] = $row;
	$alldatas[$i]['acccrypt'] = base64_encode($row['accountname']);
    $alldatas[$i]['url'] = $companys['appurl'].'web2/referal.php?memberkey='.base64_encode($row['accountname']);
    $i++;
}
$newdatas = array();
foreach ($alldatas as $key => $value) {
	# code...
	$query = "SELECT ACCNO, mt4login, mt_database.`alias` FROM mlm2, mt_database WHERE mlm2.`mt4dt` = mt_database.`mt4dt` AND  mlm2.`ACCNO` = '$value[accountname]'";
	TradeLogUnderConstruct_Secure("query-66 :".$query);
	$result = $DB->execresultset($query);
	$newdatas[$key] = $value;
	$mt4login_data = array();
	foreach ($result as $key2 => $value2) {
		# code...
		$mt4login_data[] = $value2;
	}
	$newdatas[$key]['mt4dt_login'] = $mt4login_data;
}
// var_dump($newdatas);
$template->assign("alldatas", $newdatas);
/*=====  End of Start Coding  ======*/


$template->display("imp_myaccount.htm");

function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>
