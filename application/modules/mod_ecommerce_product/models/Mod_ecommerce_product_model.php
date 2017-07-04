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
    public function get_product_details($product_name)
    {
      $this->db->select('aecodeid, cat_name, cat_alias, master_product.id , prod_star, prod_desc_long, prod_name, prod_alias, prod_price, prod_desc, prod_images, prod_price')
      ->from('master_product')
      ->join('master_cat' , 'master_product.id_cat = master_cat.id')
      ->where('master_product.prod_name' , $product_name);
      $data = $this->db->get()->row();
      if (empty($data)) {
        return false;
      }else{
        return $data;
      }
    }
    public function get_product_list($category_name, $product_name)
    {
      $this->db->select('cat_name, cat_alias, master_product.id , prod_star, prod_name, prod_alias, prod_price, prod_images, prod_price')
      ->from('master_product')
      ->join('master_cat' , 'master_product.id_cat = master_cat.id')
      ->where('master_cat.cat_name' , $category_name)
      ->where('prod_name !=' , $product_name)
      ->order_by('master_product.timestamp' , 'DESC')
      ->limit(6);
      $data = $this->db->get()->result();
      return $data;
    }
}
