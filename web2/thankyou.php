<?php
session_start();
$skip_authentication = 1;
include("../includes/functions.php");
include_once("includes/wr_tools.php");
global $DB;

$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
$template->assign("companys", $companys);

$query = "SELECT * FROM config";
$result = $DB->execresultset($query);
foreach($result as $rows) {
	$configs[$rows['name']] = $rows['value'];
}
$url = "http://".$configs['sk_url'];
$template->assign('url',$url);
$template->display("thankyou.htm");

?>