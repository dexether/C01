<?php
session_start();
$skip_authentication = 1;
include "../includes/functions.php";
include_once "includes/wr_tools.php";
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
   $crypt_key = $mysql['crypt_key'];
}

$response    = array();
$email = anti_injection(@$_POST['email']);
$query = "SELECT aecode FROM client_aecode WHERE client_aecode.aecode = '$email'";
$query = $DB->execresultset($query);
$output = true;
foreach ($query as $key => $value) {
  # code...
  $output = false;
}
// print_r($query);
// $output = "false";
$response['valid'] = $output;
echo json_encode($response);
