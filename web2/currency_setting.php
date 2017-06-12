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
$_SESSION['page'] = "currency_setting";
$sql = "SELECT * FROM currency";
$result = $DB->execresultset($sql);
$template->assign('currencies', $result);

$template->display("currency_setting.html");
