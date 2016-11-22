<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Startup extends CI_Model
{
    public function test()
    {
        return 'test';
    }
    public function get_all()
    {
    	$this->db->from('app_config');
    	$this->db->order_by('key', 'asc');
    	return $this->db->get();
    }
}

/* End of file m_appconfig.php */
/* Location: ./application/models/m_appconfig.php */
