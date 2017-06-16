<?php

class Mod_ecommerce_page extends MY_Controller
{
    public function __construct()
    {
      parent::__construct();
      // $this->load->library('nativesession');
      $this->load->library('format');
    }
    public function about_us()
    {
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/about-us', array(), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function how_to_sell_product()
    {
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/howToSell', array(), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function how_to_buy_product()
    {
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/howToBuy', array(), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function terms()
    {
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/terms', array(), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function disclaimer()
    {

      $data['meta']['title'] = 'Disclaimer';
      // $data['product_list'] = $product_list;
      $data['page'] = 'category-page';
      $data['content'] = 'mod_ecommerce_page/disclaimer';
      // $this->breadcrumb->clear();
      // $this->breadcrumb->add_crumb('Home', '/');
      // $this->breadcrumb->add_crumb('Category', '/c');
      // $this->breadcrumb->add_crumb($product_details->cat_alias, '/c/'. $product_details->cat_name);
      // $this->breadcrumb->add_crumb($product_details->prod_alias);
      // $this->breadcrumb->change_link('<span class="navigation-pipe">&nbsp;</span>'); // you can change what joins the crumbs
      // $data['breadcrumb'] = $this->breadcrumb->output();
      $this->template->get_main($data);
    }
}
