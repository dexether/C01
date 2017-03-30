<?php

class AuthController extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->module('template');
        if(!$this->session->userdata('login')){
          $this->session->set_flashdata('error', 'Maaf, anda Harus masuk terlebih dahulu');
          redirect('/auth/?redirect=' . urlencode(current_url()));
        }
    }
}
