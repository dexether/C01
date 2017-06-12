<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require_once "$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php";
include_once "includes/wr_tools.php";
require_once dirname(__FILE__) . '../../classes/apexregent/apexregent.class.php';
$apex = New Apexregent();
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;
$security = new \security\CSRF;
if (isset($user)) {
   $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);
$token = @$_POST['token'];
$menus = @$_POST['menus'];
$userid = @$_POST['users'];
$access = @$_POST['access'];
/*==============================
=            coding            =
==============================*/
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($security->get($token)) {
         $security->delete($token);
         $apex->grant_menu($menus, $userid, $access);
         $response['status'] = "success";
         $response['msg'] = "Success Grant Access For this user, <strong>" . count($menus) . " Access</strong> was added";
      } else {
        $response['status'] = "error";
        $response['msg'] = "Token mismatch, Please refresh the browser and try Again";
      }

   }else{
     $response['status'] = "error";
     $response['msg'] = "Token mismatch, Please refresh the browser and try Again";
   }
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
