<?php
class Mod_ecommerce_product extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Shop_model', 'basicmodel');
    $this->load->library('nativesession');
    $this->load->library('format');
    $this->load->helper('form');
    $this->load->library('encrypt');

    $this->load->model('mod_ecommerce_product_model', 'mymodel');
  }
  public function index()
  {
    echo "Mod Product";
  }
  public function show_product($cat = null, $type = null)
  {
      $tgl = date('Y-m-d H:i:s', time());
      $on  = array(
          array('table' => 'master_cat', 'on' => 'master_product.id_cat = master_cat.id', 'type' => 'left'),
          // array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product', 'type' => 'left'),
          array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),
          array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
      );
      $where = array(
          array('col' => 'master_product.prod_name', 'val' => $type),
      );
      $datas = $this->basicmodel->getDataPromo('master_product.id, prod_desc, prod_desc_long, prod_star,prod_images, prod_name, prod_alias, prod_price, cat_name, promo_name, promo_value', 'master_product', $on, $where);

      foreach ($datas as $key => $value) {
          # code...
          $datas2[$key]                = $value;
          $datas2[$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);
      }

      // Get product images

      $image_data = $this->mymodel->get_images($type);
      if (count($datas2) <= '0') {
          $this->output->set_status_header('404');
          show_404();
      }
      $data['title'] = array();
      foreach ($datas2 as $key => $value) {
          $data['title'] = $value;
      }

      // Get user reviews
      $data_reviews = $this->basicmodel->getReviews($type, 'rating_star, foto, name, rating_subject, rating_comm, master_product_rating.timestamp');

      $data_count = $this->basicmodel->getReviesAll($type);
      // echo $this->db->last_query();
      $data_reviews = array(
        'reviews' => $data_reviews,
        'count' => $data_count
      );
      // Set session current url
      $this->nativesession->set('previous_url', current_url());
      $get_aecodeid = $this->basicmodel->getData('client_aecode', 'aecodeid', $where = array('aecode' => $this->nativesession->getObject('username')));
      $aecodeid = null;
      foreach ($get_aecodeid as $key => $value) {
          # code...
          @$aecodeid = $value['aecodeid'];
      }
      // Check users if already reviewed
      $data_check = $this->basicmodel->checkStatusOfbuy($type, $aecodeid);
      // echo "<pre>";
      // print_r($data_reviews);
      // echo "</pre>";
      // var_dump($data_check);
      // echo $this->db->last_query();
      $part = array(
          "header" => $this->load->view('mall/mainheader', array(), true),
          "body"   => $this->load->view('mall/product', array('check' => $data_check, 'data' => $data, 'images' => $image_data, 'reviews' => $data_reviews), true),
          "slider" => "",
      );
      $this->load->view('mall/index', $part);
  }
}
 ?>
