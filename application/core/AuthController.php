<?php

class AuthController extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->module('template');
        if(!$this->session->userdata('login')){
          redirect('/auth/?redirect=' . urlencode(current_url()));
        }
    }
}
