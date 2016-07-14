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

$_SESSION['page'] = 'ar_myaccount';

/*====================================
=            Start Coding            =
====================================*/

$query = "SELECT 
client_aecode.`name`,
client_aecode.`email`,
client_accounts.`accountname`,
client_accounts.`suspend`,
mlm_bonus_settings.`description`,
mlm.`group_play`,
mlm.`companyconfirm`
FROM
client_accounts,
client_aecode,
mlm,
mlm_bonus_settings 
WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid` 
AND client_accounts.`accountname` = mlm.`ACCNO` 
AND mlm.`group_play` = mlm_bonus_settings.`group_play`
AND client_aecode.`aecode` = '$user->username'";
$result = $DB->execresultset($query);
$i = 0;
foreach($result as $row){
	$alldatas[$i] = $row;
	$alldatas[$i]['acccrypt'] = base64_encode($row['accountname']);
}
$template->assign("alldatas", $alldatas);
/*=====  End of Start Coding  ======*/


$template->display("ar_myaccount.htm");

function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>
