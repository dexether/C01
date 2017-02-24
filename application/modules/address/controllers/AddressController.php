<?php
class AddressController extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
  }
  public function apiGetAddress($aecodeid)
  {
    $datasource = Address::where('aecodeid', $aecodeid)->get();
    header('Content-Type: application/json');
    echo json_encode($datasource , JSON_PRETTY_PRINT);
  }
}
?>
