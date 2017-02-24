<?php
class CheckoutController extends AuthController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('rajaongkir');
  }
  public function index()
  {
    $provinces = json_decode($this->rajaongkir->province());
    $data['provinces'] = $provinces;
    $data['page'] = "category-page";
    $data['content'] = "checkout/checkout_v";
    $this->template->get_main($data);
  }
  public function postAddress($aecodeid)
  {
    $address = new Address;
    $address->aecodeid = $aecodeid;
    $address->province_id = $this->input->post('province_id');
    $address->city_id = $this->input->post('city_id');
    $address->address = $this->input->post('address');
    $address->receiver_name = $this->input->post('receiver_name');
    $address->telphone_number = $this->input->post('telphone_number');
    $address->save();
    $this->session->set_flashdata('success' , 'Berhasil menambahkan Alamat !');
    redirect('/checkout');
  }
}
