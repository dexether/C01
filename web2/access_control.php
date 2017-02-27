<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once "$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php";
require_once dirname(__FILE__) . '../../classes/apexregent/apexregent.class.php';
$apex = New Apexregent();
$security = new \security\CSRF;
$token = $security->set(4, 3600);
$template->assign('token' , $token);
$var_to_pass = null;
$_SESSION['page'] = "access_control";
$users_list = $apex->get_all_user();
$group = $apex->get_all_access();
$template->assign('groups', $group);
$template->assign_by_ref('apex', $apex);
$template->assign('users_list' , $users_list);
$template->display('access_control.htm');
?>
