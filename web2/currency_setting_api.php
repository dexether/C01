<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
$id = @$_POST['id'];
$rate = @$_POST['rate'];
$sql = "UPDATE currency SET rate = '$rate' WHERE id = '$id'";
try {
  $exec = $DB->execonly($sql);
  response([
    "status" => true,
    "message" => "Success UPDATE currency"
  ]);
} catch (\Exception $e) {
  response([
    "status" => false,
    "message" => "Failed UPDATE currency " . $e->getMessage()
  ]);
}
