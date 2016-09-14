<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('message_lang', 'indonesia');
        $this->load->model('Shop_model', 'basicmodel');
        // $this->load->library('session');
        $this->load->library('nativesession');
        

        // $this->load->helper('error');

    }
    public function logout()
    {
    	$this->nativesession->logout();
    	redirect(base_url());
    }

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
