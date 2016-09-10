<?php
$skip_authentication = 1;
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;

//tradeLogConstruct("UnderConstruct.php-Line-9");
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);
$_SESSION['page'] = 'ar_goldsaving_information';
/*==============================
=            Coding            =
==============================*/

$query = "SELECT 
client_aecode.`aecodeid`,
client_accounts.`accountname`,
mlm_bonus_settings.`description`,
mlm_goldsaving.`balance`
FROM
client_accounts,
client_aecode,
mlm,
mlm_bonus_settings,
mlm_goldsaving 
WHERE client_aecode.`aecode` = '$user->username' 
AND client_accounts.`suspend` = '0'
AND client_aecode.`aecodeid` = client_accounts.`aecodeid` 
AND client_accounts.`accountname` = mlm.`ACCNO` 
AND client_accounts.`accountname` = mlm_goldsaving.`account` 
AND mlm.`group_play` = mlm_bonus_settings.`group_play`";
$result = $DB->execresultset($query);
$template->assign("datas", $result);
/*=====  End of Coding  ======*/

$template->display("ar_goldsaving_information.htm");

function tradeLogConstruct($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>