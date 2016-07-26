<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
    public function test()
    {
        return "Haha";
    }
    public function getData($table, $col, $where = array(1 => 1))
    {
        $this->db->select($col);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }

}

/* End of file shop_model.php */
/* Location: ./application/models/shop_model.php */
