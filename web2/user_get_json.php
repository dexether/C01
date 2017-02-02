<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

require_once dirname(__FILE__) . '../../classes/apexregent/apexregent.class.php';
$apex = New Apexregent();
// print_r($_GET);
$lengt = @$_GET['length'];
$draw = @$_GET['draw'];
$keyword = $_GET['search']['value'];
$offset = @$_GET['start'];
// $posisi = ( $pg - 1 ) * $batas;
$array_user = [];
$list_users = $apex->get_users($lengt , $offset , $keyword);
$result['draw'] = $draw;
$result['recordsTotal'] = $list_users->count();
$result['recordsFiltered'] = $list_users->count();
foreach ($list_users->get() as $key => $value) {
  $target = (array) $value;
  $array_user[$key][0] = 1 + $offset;
  $array_user[$key][1] = $value->name;
  $array_user[$key][2] = $value->telephone_mobile;
  $array_user[$key][3] = $value->email;
  $array_user[$key][4] = $value->status;
  $array_user[$key][5] = $value->status;
  $offset++;
}
$result['data'] = $array_user;

header('Content-Type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT);
?>
