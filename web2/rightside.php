<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
//tradelog("DashBoard-5");
global $user;
global $template;

$template->assign("user", $user);

$template->assign("actionemail", "email_admin.php?postmode=emailtoadmin&tradedby=" . $user->username);


$template->display("rightside.htm");

/* * ***************************************************************************
 * FETCH ALL ACCOUNTS ASSOCIATED WITH USERNAME                                *
 * *************************************************************************** */


?>