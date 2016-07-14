<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

// Scurity
$security = new \security\CSRF;
$token = $security->set(3, 3600);
$template->assign("token", $token);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}
$query  = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years  = date('Y', time());
foreach ($result as $rows) {
    $companys         = $rows;
    $companys['year'] = $years;
}
$template->assign("companys", $companys);
$user = array();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
$template->assign("user", $user);
// var_dump(count($user));
$memberid_crypt = @$_GET['memberkey'];
$memberid_hash  = base64_decode($memberid_crypt);
// echo $memberid_hash;
$alldata['userdata']['username'] = "";
$alldata['userdata'] = userdatas($memberid_hash);
if (empty($alldata['userdata'])) {
}
$id            = 160421101;
$accountnumber = base64_encode($id);
$query = "SELECT mlm_bonus_settings.`group_play`, mlm_bonus_settings.`description` FROM mlm_bonus_settings WHERE group_play <> 'no_plan' AND mlm_bonus_settings.`active` = TRUE";
$result = $DB->execresultset($query);
$alldata['group_play'] = $result;
/*====================================
=            Start Coding            =
====================================*/

/*=====  End of Start Coding  ======*/
// var_dump($alldata);
$template->assign('alldata', $alldata);
$template->display("referal.htm");

function userdatas($account)
{
    global $DB;
    $data = array('username'=> "","name" => "", "downline" => "", "foto" => "");
    $query = "SELECT
  client_aecode.`name` as username,
  client_aecode.`foto`,
  client_accounts.`name`,
  (SELECT COUNT(ACCNO) FROM mlm WHERE upline = '$account') AS downline
FROM
  client_accounts,
  client_aecode
WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
AND client_accounts.`accountname` = '$account'";
 $result = $DB->execresultset($query);
 foreach ($result as $key => $value) {
     $data = $value;
 }
 return $data;
}

function TradeLogUnderConstruct_Secure($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
