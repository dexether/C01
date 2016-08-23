<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Libs_model extends CI_Model
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->lang->load('message_lang', 'indonesia');
    }

}

/* End of file Libs_model.php */
/* Location: ./application/models/Libs_model.php */
