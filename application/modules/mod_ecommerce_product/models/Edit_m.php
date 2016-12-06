<?php
class Edit_m extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function get_detail($product_id)
  {
    $this->db->select('aecodeid, comm, master_product.id, prod_price, id_cat, prod_name, prod_alias, prod_desc, prod_desc_long, prod_images, comm, cat_alias, prod_weight, by_email');
    $this->db->from('master_product');
    $this->db->join('master_cat', 'master_product.id_cat = master_cat.id');
    $this->db->where('prod_name', $product_id);
    $query = $this->db->get();
    return $query;
  }
}

 ?>
