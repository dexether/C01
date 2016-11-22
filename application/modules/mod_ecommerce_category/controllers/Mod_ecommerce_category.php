<?php
class Mod_ecommerce_category extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Shop_model', 'basicmodel');
    $this->load->library('nativesession');
    $this->load->library('format');
    $this->load->helper('form');
    $this->load->library('encrypt');

    $this->load->model('mod_ecommerce_category_model', 'mymodel');
  }
  public function index()
  {
    echo "Mod Product";
  }
  public function show_product($type = null)
  {
    $tgl = date('Y-m-d H:i:s', time());
    $on  = array(
        array('table' => 'master_cat', 'on' => 'master_product.id_cat = master_cat.id', 'type' => 'left'),
        // array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product', 'type' => 'left'),
        array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),
        array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
    );
    $where = array(
        array('col' => 'master_cat.cat_name', 'val' => $type),
        array('col' => 'master_product.is_active', 'val' => true)
    );
    $datas = $this->basicmodel->getDataPromo('prod_star, prod_images, prod_name, prod_alias, prod_price, cat_name, promo_name, promo_value', 'master_product', $on, $where);
    $datas2 = array();
    foreach ($datas as $key => $value) {
        # code...
        $datas2[$key]                = $value;
        $datas2[$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);
    }

    $result = $this->basicmodel->getData('master_cat', 'cat_name, cat_desc, cat_alias', array('cat_name' => $type));

    if (count($result) <= '0') {
        // show_404();
    }
    $data['title'] = array();
    foreach ($result as $key => $value) {
        $data['title'] = $value;
    }
    // $article = $this->basicmodel->getData();
    // var_dump($datas2);
    $part = array(
        "header" => $this->load->view('mall/mainheader', array(), true),
        "body"   => $this->load->view('mall/cat', array('data' => $data, 'list' => $datas2), true),
        "slider" => "",
    );
    $this->load->view('mall/index', $part);
  }
}
 ?>
