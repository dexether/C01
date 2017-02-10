<?php
class Floor_m extends CI_Model {
  public function get_category_details($category_name)
  {
    $result = $this->db->get_where('master_cat' , [
      'cat_name' => $category_name
    ]);
    return $result->row();
  }
  public function get_new_product_by_category($category_name)
  {
    $this->db->select('cat_name, cat_alias, master_product.id , prod_star, prod_name, prod_alias, prod_price, prod_images, prod_price')
    ->from('master_product')
    ->join('master_cat' , 'master_product.id_cat = master_cat.id')
    ->where('master_cat.cat_name' , $category_name)
    ->order_by('master_product.timestamp' , 'DESC')
    ->limit(6);
    $data = $this->db->get()->result();
    return $data;
  }
}
