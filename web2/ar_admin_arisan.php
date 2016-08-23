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

$security = new \security\CSRF;

$token = $security->set(3, 3600);
$template->assign("token", $token);
$user = $_SESSION['user'];
$template->assign("user", $user);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'ar_admin_arisan';

/*====================================
=            Start Coding            =
====================================*/

$query = "SELECT 
  mlm_arisan_block.`block`,
  mlm_arisan_block.`board`,
  mlm_arisan.`id_block`,
  COUNT(mlm_arisan.`id`) AS jumlah
  
FROM
  mlm_arisan,
  mlm_arisan_account,
  mlm_arisan_block
WHERE mlm_arisan.`id_block` = mlm_arisan_block.`id` 
AND mlm_arisan.`arisan_account` = mlm_arisan_account.`arisan_account`
AND mlm_arisan_account.`finished` = 0
GROUP BY mlm_arisan.`id_block`
";
$result = $DB->execresultset($query);
$template->assign("alldatas", $result);

$query = "SELECT 
  client_aecode.`name`,
  client_accounts.`accountname`,
  mlm_arisan_account.`arisan_account`,
  mlm_arisan_block.`block`,
  mlm_arisan_block.`board`,
  mlm_arisan.`datetime`
FROM
  mlm_arisan,
  mlm_arisan_block,
  mlm_arisan_account,
  client_accounts,
  client_aecode 
WHERE mlm_arisan.`arisan_account` = mlm_arisan_account.`arisan_account` 
  AND mlm_arisan.`id_block` = mlm_arisan_block.`id` 
  AND mlm_arisan_account.`accountname` = client_accounts.`accountname` 
  AND client_accounts.`aecodeid` = client_aecode.`aecodeid` ";
$result2 = $DB->execresultset($query);
$template->assign('dataarsan',$result2);  

/*=====  End of Start Coding  ======*/


$template->display("ar_admin_arisan.htm");


function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>