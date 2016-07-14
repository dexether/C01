<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
global $DB;
$var_to_pass = null;
//tradelog("DashBoard-5");
$template = new Smarty();

$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
$template->assign("companys", $companys);

$template->display("footerside.htm");

/* * ***************************************************************************
 * FETCH ALL ACCOUNTS ASSOCIATED WITH USERNAME                                *
 * *************************************************************************** */

?>