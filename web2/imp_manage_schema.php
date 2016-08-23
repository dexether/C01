<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
$var_to_pass = null;
global $product;
global $template;
global $themonth;
global $mysql;
global $DB;

/*==============================
=            coding            =
==============================*/
$_SESSION['page'] = "imp_manage_schema";
// var_dump($datasemua);
/*=====  End of coding  ======*/
$query = "SELECT 
  mt_database.mt4dt,
  alias 
FROM
  mt_database,
  imp_manage_schema 
WHERE mt_database.`mt4dt` = imp_manage_schema.`mt4dt` 
  AND mt_database.enabled = 'yes' 
  GROUP BY mt_database.mt4dt";
$result = $DB->execresultset($query);
$template->assign('mtlist', $result);

$template->display("imp_manage_schema.htm");
function tradeLogProfile($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
