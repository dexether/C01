<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require dirname(__FILE__) . '/../classes/metatrader/sync.class.php';
$sync = new Sync();
// $sync->get_response(@$_POST['login'], @$_POST['mt4dt']);
$sync->get_response(88003117, 'askap_source_mini');
switch ($sync->status) {
  case 0:
    // Email dari meta blum terdaftar
    $response['status'] = 0;
    $response['msg'] = 'Email belum terdaftar, silahkan daftar';
    $response['login'] = @$_POST['login'];
    $response['mt4dt'] = @$_POST['mt4dt'];
    $response['email'] = $sync->email;
    break;
  case 1:
    // Email dari sudah terdaftar, tapi LOGIN belum tersync
    $response['status'] = 1;
    $response['msg'] = 'Email sudah terdaftar, akan tetapi LOGIN ' . @$_POST['login'] . ' belum terintegrasi';
    $response['login'] = @$_POST['login'];
    $response['mt4dt'] = @$_POST['mt4dt'];
    $response['email'] = $sync->email;
    break;
  case 2:
    // Email dari sudah terdaftar, tapi LOGIN belum tersync
    $response['status'] = 2;
    $response['msg'] = 'Email dan LOGIN sudah terdaftar';
    $response['login'] = @$_POST['login'];
    $response['mt4dt'] = @$_POST['mt4dt'];
    break;
  default:
    # code...
    break;
}
header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);
