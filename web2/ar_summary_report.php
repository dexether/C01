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

$_SESSION['page'] = 'ar_summary_report';

/*====================================
=            Start Coding            =
====================================*/
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
AND client_aecode.aecode = '$user->username'";
//TradeLogTreView("TreViewDetail-82:" . $query);
$dataACCNO = array();
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    //TradeLogTreView("TreView-83:".$row['ACCNO']);
    $dataACCNO[] = $row;
}
// var_dump($row);
/*=====  End of Start Coding  ======*/

$bonuslogs = array();
    $template->assign("bonuslogs", $bonuslogs);

    $query = "SELECT module, full FROM mlm_cron WHERE module <> 'pv'";
    $result = $DB->execresultset($query);
    
    $template->assign('allbonus', $result);

$template->assign("dataACCNO", $dataACCNO);
$template->display("ar_summary_report.htm");

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