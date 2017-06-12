<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
include_once("includes/wr_tools.php");
global $user;
global $template;
global $mysql;
global $DB;
$security = new \security\CSRF;
$token = $security->set(3, 3600);
$template->assign('token', $token);


if($user->groupid == "9")
{
    $filter_admin = "";

}else{
    $filter_admin = "AND client_aecode.aecode = '$user->username'";
}
$query = "SELECT
client_aecode.email,
client_aecode.name,
client_accounts.`accountname`,
mlm_bonus_settings.`description`,
mlm.*
FROM
client_aecode,
client_accounts,
mlm,
mlm_bonus_settings
WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
AND mlm.`group_play` = mlm_bonus_settings.`group_play`
AND client_accounts.`accountname` = mlm.`ACCNO`
$filter_admin
";
//TradeLogTreView("TreViewDetail-82:" . $query);
$dataACCNO = array();
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    //TradeLogTreView("TreView-83:".$row['ACCNO']);
    $dataACCNO[] = $row;
}
$_SESSION['page'] = 'ar_wallet_statement';
$template->assign('accounts', $dataACCNO);
$template->display("ar_wallet_statement.html");
