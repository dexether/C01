<?php

class View_product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_ecommerce_product_model', 'mymodel');
    }
    public function show_product($product_category = null, $product_name = null)
    {
      /* get product details */
      $product_details = $this->mymodel->get_product_details($product_name);
      /* get new product by category */
      $product_list = $this->mymodel->get_product_list($product_category, $product_name);
      /* Meta Tags */
      $data['meta']['title'] = $product_details->prod_alias;
      $data['meta']['desc'] = $this->format->clean_html($product_details->prod_desc);
      $data['product_list'] = $product_list;
      $data['product'] = $product_details;
      $data['page'] = 'category-page';
      $data['content'] = 'mod_ecommerce_product/product_detail_v';
      $this->breadcrumb->clear();
      $this->breadcrumb->add_crumb('Home', '/');
      $this->breadcrumb->add_crumb('Category', '/c');
      $this->breadcrumb->add_crumb($product_details->cat_alias, '/c/'. $product_details->cat_name);
      $this->breadcrumb->add_crumb($product_details->prod_alias);
      $this->breadcrumb->change_link('<span class="navigation-pipe">&nbsp;</span>'); // you can change what joins the crumbs
      $data['breadcrumb'] = $this->breadcrumb->output();
      $this->template->get_main($data);
    }
}
