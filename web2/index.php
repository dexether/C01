<?php
session_start();
$skip_authentication = 1;
include("../includes/functions.php");
$theparent = '';
if(isset($_GET['page'])) {
    $theparent = $_GET['page'];
}
$redirect = htmlspecialchars_decode(@$_GET['redirect']);
$target = "_self";
if($theparent=='iframe'){
    $target = "_blank";
}
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
}
$template->assign('redirect', $redirect);
$template->assign("companys", $companys);
//tradeLog("Index.php-14");
$template->assign("target", $target);
//tradeLog("Index.php-16");
$template->display("index.htm");
function tradeLog($msg)
{
    $fp = fopen("trader.log","a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/"," ",$msg);
    fwrite($fp,$logdate . $msg . "\n");
    fclose($fp);
    return;
}
?>
 