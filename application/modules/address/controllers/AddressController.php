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
  public function setPrimaryAddress()
  {
    
    Address::where('aecodeid', $this->input->post('aecodeid'))
    ->update([
      "is_primary" => false
    ]);

    $response['status'] = 200;
    $response['message'] = "Success Change Primary Address";
    $address_id = $this->input->post('address_id');
    try {
      $address = Address::find($address_id);
      $address->is_primary = true;
      $address->save();
    } catch (Exception $e) {
      $response['status'] = 500;
      $response['message'] = "Failed delete data : " . $e->getMessage();
    }
    return $this->output->set_output(json_encode($response, JSON_PRETTY_PRINT))
    ->set_content_type('application/json');
  }
}
?>
