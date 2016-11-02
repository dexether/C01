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

$_SESSION['page'] = 'tree_account_mm';

/*====================================
=            Start Coding            =
====================================*/

$query = "SELECT
client_accounts.`accountname`,
client_accounts.`suspend`,
client_aecode.`name`,
client_aecode.`email`,
mlm.`companyconfirm`
FROM
mlm,
client_accounts,
client_aecode
WHERE mlm.ACCNO = client_accounts.accountname
AND client_accounts.`aecodeid` = client_aecode.`aecodeid`
AND client_accounts.suspend = TRUE
AND mlm.companyconfirm = '1'
AND mlm.group_play = 'asiawide'
";
$result = $DB->execresultset($query);
// var_dump($result);
$template->assign("allaccounts", $result);
/*=====  End of Start Coding  ======*/

$query = "SELECT typeaccount, ACCNO, upline FROM mlm, client_accounts WHERE mlm.ACCNO = client_accounts.accountname AND companyconfirm = '1' AND mlm.group_play = 'asiawide'";
$result2 = $DB->execresultset($query);
$template->assign("notactive", $result2);

$template->display("imp_account_mm.htm");

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
function getIdentitas($account) {
  global $DB;
  $query = "SELECT
  client_accounts.`accountname`,
  client_aecode.`email`,
  client_aecode.`name`
  FROM
  client_accounts,
  client_aecode
  WHERE client_accounts.`accountname` = '$account'
  AND client_aecode.`aecodeid` = client_accounts.`aecodeid`";
  $result = $DB->execresultset($query);
  foreach($result as $rows) {
    $datas = $rows;
  }
  return $datas;
}
function sendEmail($to, $subject, $body, $module) {
  global $DB;
  $timeupdate = date('Y-m-d H:i:s', strtotime('-1 hour'));
  $query = "insert into email set
  timeupdate = '$timeupdate',
  email_to = '$to',
  email_subject = '$subject',
  email_body = '$body',
  timesend = '1970-01-31 00:00:00',
  module = '$module'
  ";
  $DB->execonly($query);
}

?>
