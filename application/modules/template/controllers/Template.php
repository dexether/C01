<?php

class Template extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_main($data = null)
    {
      $data['notpayed'] = Order::notPayed($this->session->userdata('aecodeid'))->get();
      $this->load->view('main_v', $data);
    }
    public function get_user_dashboard($data = null)
    {
        if(!isset($data['du_menu'])):
          $data['du_menu'] = "du_dashbard";
        endif;
        $data['du_menu'];
        $data['content'] = "template/dashboard_user_v";
        $data['page'] = "category-page";
        $this->get_main($data);
    }
}
