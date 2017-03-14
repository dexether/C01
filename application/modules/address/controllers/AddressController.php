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
  public function getUserDefaultAddress($aecodeid)
  {
    $data = Address::where('aecodeid' , $aecodeid)->first();
    if($data != null)
    {
      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }else{
    $data = [];
    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }
  }
}
?>
