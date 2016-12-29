<?php

class Template extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_main($data = null)
    {
      $this->output->set_meta('description', 'AgendaFX');
      $this->load->view('main_v', $data);
    }
}
