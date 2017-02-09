<?php

class MY_Controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->module('template');
        $this->load->library('breadcrumb');
        date_default_timezone_set('Asia/Jakarta');
    }
}
