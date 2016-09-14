<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;

//tradeLogConstruct("UnderConstruct.php-Line-9");

$_SESSION['page'] = 'ar_admin_cron';
/*==============================
=            Coding            =
==============================*/

$query = "SELECT 
  mlm_cron.`module`,
  mlm_cron.`last_run`,
  mlm_cron.`file`,
  mlm_cron.`full`,
  mlm_cron.`comment`
FROM
  mlm_cron
ORDER BY last_run DESC";
$result = $DB->execresultset($query);
$template->assign("datas", $result);
/*=====  End of Coding  ======*/

$template->display("ar_admin_cron.htm");

function tradeLogConstruct($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>