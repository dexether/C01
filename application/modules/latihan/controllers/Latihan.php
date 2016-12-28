<?php

class Latihan extends MY_Controller
{
    private function _init()
    {
        $this->output->set_template('default');
        $this->load->js('assets/themes/default/js/jquery-1.9.1.min.js');
        $this->load->js('assets/themes/default/hero_files/bootstrap-transition.js');
        $this->load->js('assets/themes/default/hero_files/bootstrap-collapse.js');
    }

    public function index()
    {
        $this->load->view('ci_simplicity/welcome');
    }
}
