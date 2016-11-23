<?php

class Auth_area extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('nativesession');
        if (!$this->nativesession->getObject('username')) {
            // code...
          redirect(base_url().'web2/index.php?redirect='.urlencode(current_url()));
        }
    }
}
