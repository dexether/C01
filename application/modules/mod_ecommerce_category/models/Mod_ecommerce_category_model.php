<?php

class Mod_ecommerce_category_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_category_details($category_name)
    {
      $query = $this->db->get_where('master_cat' , [
        'cat_name' => $category_name
      ]);
      return $query->row();
    }
    public function get_product_list($category_name , $limit = 10, $offset = 0)
    {
      $this->db->select('prod_name, master_product.id, prod_price , prod_desc , prod_images ,cat_name , prod_alias')->from('master_product')
      ->join('master_cat', 'master_product.id_cat = master_cat.id')
      ->where('master_cat.cat_name' , $category_name);
      $this->db->limit($limit);
      $this->db->offset($offset);
      $data = $this->db->get();

      return $data;
    }
}
