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
}
