<?php

class Mod_ecommerce_page extends MY_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->library('nativesession');
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
}
