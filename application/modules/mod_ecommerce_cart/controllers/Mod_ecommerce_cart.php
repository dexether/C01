<?php

class Mod_ecommerce_cart extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Shop_model', 'basicmodel');
    $this->load->library('nativesession');
    $this->load->library('format');
    $this->load->helper('form');
    $this->load->library('encrypt');
  }
  public function show_cart()
  {
      $get_aecodeid = $this->basicmodel->getData('client_aecode', 'aecodeid', $where = array('aecode' => $this->nativesession->getObject('username')));
      foreach ($get_aecodeid as $key => $value) {
          # code...
          $aecodeid = $value['aecodeid'];
      }
      if (empty($get_aecodeid)) {
          # code...
          show_404();
      }
      $tgl  = date('Y-m-d H:i:s', time());
      $join = array(
          array('table' => 'client_aecode', 'on' => 'master_cart.aecodeid = client_aecode.aecodeid', 'type' => 'left'),
          array('table' => 'master_product', 'on' => 'master_cart.id_prod = master_product.id', 'type' => 'left'),
          array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),
          array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
      );
      $where = array(
          array('col' => 'client_aecode.aecodeid', 'val' => $aecodeid),
          array('col' => 'master_cart.cmd', 'val' => '6'),
          // array('col' => 'master_product_promo.datefrom <=', 'val' => $tgl),
          // array('col' => 'master_product_promo.dateto >=', 'val' => $tgl)
      );
      $data = $this->basicmodel->getDataPromo('master_cart.id,prod_alias,prod_price,prod_images,qty,promo_name,promo_value', 'master_cart', $join, $where);

      $datas = array();
      // var_dump($data);
      foreach ($data as $key => $value) {
          # code...
          $datas[$key]                = $value;
          $datas[$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);

      }
      $template = "cart";
      if (empty($datas)) {
          # code...
          $template = "cart_empty";
      }
      // var_dump($datas);
      $part = array(
          "header" => $this->load->view('mall/mainheader', array(), true),
          "body"   => $this->load->view('mall/' . $template, array('list' => $datas), true),
          "slider" => "",
      );
      $this->load->view('mall/index', $part);
  }
}
