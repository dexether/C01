<?php

class Mod_ecommerce_product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_images($type)
    {
        $this->db->select('image_location');
        $this->db->from('master_product');
        $this->db->join('master_product_images', 'master_product.id = master_product_images.id_prod');
        $this->db->where('master_product.prod_name', $type);
        $query = $this->db->get();
        $image_data = array();
        foreach ($query->result() as $key => $value) {
          $image_data[] = $value;
        }
        return $image_data;
    }
}
