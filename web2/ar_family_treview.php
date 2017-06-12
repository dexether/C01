<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

$var_to_pass = null;
$_SESSION['page'] = "ar_family_treview";
require_once dirname(__FILE__) . '../../classes/mlm/Mlm.class.php';
$mlm = New Mlm();
if ($user->groupid == 9) {
$gabungan = $mlm->google_family_tree($user->username, true);
}else{
$gabungan = $mlm->google_family_tree($user->username, false);
}
$json = json_encode($gabungan, JSON_PRETTY_PRINT);
$template->assign('json' , $json);

$template->display('ar_family_treview.htm');
?>
