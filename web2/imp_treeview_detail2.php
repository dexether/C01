<?php

include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
include_once "includes/wr_tools.php";
$var_to_pass = null;
global $user;
global $template;
$template->assign("user", $user);

$login = @$_GET['accno'];

$query  = "SELECT mt_database.alias, mlm2.* FROM mlm2, mt_database WHERE mlm2.mt4dt = mt_database.mt4dt AND mt4login = '$login' LIMIT 0,1";
$result = $DB->execresultset($query);
$datas  = array();
foreach ($result as $key => $value) {
   $datas = $value;
}
$query   = "SELECT LEFT(TIME,10) AS rolldate FROM " . $datas['mt4dt'] . ".mt4_daily GROUP BY LEFT(TIME,10) ORDER BY TIME DESC";
$result  = $DB->execresultset($query);
$dateall = array();
foreach ($result as $rows) {
   $dateall[] = $rows['rolldate'];
}
// var_dump($datas);
$template->assign('dateall', $dateall);
$template->assign('dataACCNO', $datas);

$template->display("imp_treeview_detail2.htm");

function myfilter($input_var_outer, $param)
{
   global $var_to_pass;
   $var_to_pass = $param;

   function mycallback($input_var_inner)
   {
      global $var_to_pass;
      return ($input_var_inner == $var_to_pass) ? true : false;
   }

   $return_arr = array_filter($input_var_outer, 'mycallback');
   $return_arr = array_merge(array(), $return_arr);
   return $return_arr;
}

function TradeLogTreView($msg)
{
   $fp      = fopen("trader2.log", "a");
   $logdate = date("Y-m-d H:i:s => ");
   $msg     = preg_replace("/\s+/", " ", $msg);
   fwrite($fp, $logdate . $msg . "\n");
   fclose($fp);
   return;
}
