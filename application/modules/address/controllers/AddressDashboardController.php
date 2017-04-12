<?php
class AddressDashboardController extends AuthController
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
    $data['du_menu'] = 'du_config';
    $data['contentDashboard'] = 'address/AddressDashboardSettings';
    $this->template->get_user_dashboard($data);
  }
}
?>
