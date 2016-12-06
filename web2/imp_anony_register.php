<?php

include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require dirname(__FILE__).'/../classes/mlm/Mlm.class.php';
$mlm = new Mlm();
$postmode = $_GET['postmode'];
$response = [];
switch ($postmode) {
  case 'save_new':
    // code...
    $data['username'] = $_POST['email'];
    $data['email'] = $_POST['email'];
    $aecodeid = $mlm->register_accounts($data);
    if($mlm->register_cabinet_id($aecodeid, $_POST['login'], $_POST['mt4dt'], $_POST['upline'])):
      $response['status'] = true;
      $response['msg'] = 'Registrasi Berhasil, Silahkan refresh halaman';
    else:
      $response['status'] = false;
      $response['msg'] = $msg->error_msg;
    endif;

    break;
  case 'save_cabinet_id':
    // code...

    $userdata = $mlm->get_user_data($_POST['email']);
    if($mlm->register_cabinet_id($userdata->aecodeid, $_POST['login'], $_POST['mt4dt'], $_POST['upline'])):
      $response['status'] = true;
      $response['msg'] = 'Registrasi Berhasil, password default adalah 1234. Silahkan refresh halaman';
    else:
      $response['status'] = false;
      $response['msg'] = $msg->error_msg;
    endif;

    break;
  default:
    // code...
    break;
}
header('Content-Type: application/json');
echo json_encode(@$response, JSON_PRETTY_PRINT);
