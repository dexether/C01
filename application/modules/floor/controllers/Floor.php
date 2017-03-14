<?php
/**
 * @author Tarikh Agustia
 */
class Floor extends MY_Controller {
    public function __construct()
    {
      $this->load->model('floor/floor_m');
    }
    public function get_product($category_name)
    {
      // $data['category_details'] = $this->floor_m->get_category_details($category_name);
      $product_category = $this->floor_m->get_new_product_by_category($category_name);
      return $product_category;
    }
}
