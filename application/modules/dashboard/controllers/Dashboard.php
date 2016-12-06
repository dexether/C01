<?php

class Dashboard extends MY_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->library('nativesession');
      $this->load->library('format');
      $this->load->model('penjual');
      $this->load->model('dashboard_m');
    }
    public function index()
    {
      $homedata = $this->dashboard_m->homeData();
      $datas2 = $this->dashboard_m->list_barang();
      $part = array(
          "header" => $this->load->view('mall/mainheader', array(), true),
          "body"   => $this->load->view('mall/mainbody', array('promo' => $datas2, 'brand' => $homedata), true),
          "slider" => $this->load->view('mall/slideshow', array(), true),
      );
      $this->load->view('mall/index', $part);
    }
}
