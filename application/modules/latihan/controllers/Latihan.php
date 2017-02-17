<?php

class Latihan extends MY_Controller
{


    public function index()
    {
        $this->load->view('mod_authentication/email_welcome_v');
    }
}
