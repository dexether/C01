<?php

class Mod_ecommerce_cart extends Auth_area
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Shop_model', 'basicmodel');
    $this->load->library('nativesession');
    $this->load->library('format');
    $this->load->helper('form');
    $this->load->library('encrypt');
    $this->load->library('rajaongkir');
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
  public function item_checkout()
  {
      $this->load->module('mod_ecommerce_invoice');
      $get_aecodeid = $this->basicmodel->getData('client_aecode', 'aecodeid', $where = array('aecode' => $this->nativesession->getObject('username')));
      foreach ($get_aecodeid as $key => $value) {
          # code...
          $aecodeid = $value['aecodeid'];
      }
      if (empty($get_aecodeid)) {
          # code...
          show_404();
      }
      $invoice = $this->mod_ecommerce_invoice->generate_invoice('AGFX');
      $array   = array(
          'cmd'     => '7',
          'invoice' => $invoice,
      );

      $this->db->set($array);
      $this->db->where('aecodeid', $aecodeid);
      $this->db->where('cmd', '6');
      $sql = $this->db->update('master_cart'); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
      if ($sql) {
          # code...
          redirect('cart/' . $invoice . '/checkout', 'refresh');
      } else {
          show_404();
      }
      // var_dump($invoice);
  }
  public function item_add($name = "", $qty = 1)
  {
      $get = $this->basicmodel->getData('master_product', 'id', $where = array('prod_name' => $name));
      foreach ($get as $key => $value) {
          # code...
          $id = $value['id'];
      }
      if (count($get) <= '0') {
          # code...
          show_404();
      } else {
          // var_dump($id);
          // var_dump();
          $get_aecodeid = $this->basicmodel->getData('client_aecode', 'aecodeid', $where = array('aecode' => $this->nativesession->getObject('username')));
          foreach ($get_aecodeid as $key => $value) {
              # code...
              $aecodeid = $value['aecodeid'];
          }
          if (!empty($get_aecodeid)) {
              # code...
              $cek = $this->basicmodel->getData('master_cart', 'id', $where = array('aecodeid' => $aecodeid, 'id_prod' => $id, 'cmd' => 6));
              if (!empty($cek)) {
                  # code...
                  redirect(base_url('cart'), 'refresh');
              } else {

                  $data = array(
                      "aecodeid" => $aecodeid,
                      "id_prod"  => $id,
                      "qty"      => $qty,
                  );
                  $insert = $this->basicmodel->insertData('master_cart', $data);
                  if ($insert) {
                      # code...
                      redirect(base_url('cart'), 'refresh');
                  } else {
                      show_404();
                  }
              }
          } else {
              show_404();
          }
          // var_dump($this->nativesession->getObject('username'/))
          // $insert = $this->basicmodel->insertData('master_cart');
          // print_r($name);
      }

  }
  public function item_delete($id)
  {
      $do = $this->basicmodel->deleteData('master_cart', array('id' => $id));
      if ($do) {
          # code...
          redirect('cart');
      } else {
          show_404();
      }
  }
  public function item_checkout_confirmation($invoice)
  {
      $cek = $this->basicmodel->getData('master_invoice', 'id', array('invoice' => $invoice));
      if (empty($cek)) {
          # code...
          // show_404();
      }
      $data = $this->basicmodel->getData('client_aecode', 'aecode, name, email, nationality, address', array('aecode' => $this->nativesession->getObject('username')));
      foreach ($data as $key => $value) {
          # code...
          $datas = $value;
      }

      $tgl  = date('Y-m-d H:i:s', time());
      $join = array(
          array('table' => 'client_aecode', 'on' => 'master_cart.aecodeid = client_aecode.aecodeid', 'type' => 'left'),
          array('table' => 'master_product', 'on' => 'master_cart.id_prod = master_product.id', 'type' => 'left'),
          array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),
          array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
      );
      $where = array(
          array('col' => 'master_cart.cmd', 'val' => '7'),
          array('col' => 'master_cart.invoice', 'val' => $invoice),
          // array('col' => 'master_product_promo.datefrom <=', 'val' => $tgl),
          // array('col' => 'master_product_promo.dateto >=', 'val' => $tgl)
      );
      $data = $this->basicmodel->getDataPromo('master_cart.id,prod_alias,prod_price,prod_images,qty,promo_name,promo_value, prod_weight , by_email', 'master_cart', $join, $where);
      // $datas = array();
      $datas_barang = array();
      foreach ($data as $key => $value) {
          # code...
          $datas_barang[$key]                = $value;
          $datas_barang[$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);

      }
      $provinces = json_decode($this->rajaongkir->province());
      $provinces = $provinces->rajaongkir->results;
      if (empty($datas_barang)) {
          # code...
          show_404();
      }

      $part = array(
          "header" => $this->load->view('mall/mainheader', array(), true),
          "body"   => $this->load->view('mall/checkout', array('invoice' => $invoice, 'user' => $datas, 'list' => $datas_barang , 'provinces' => $provinces), true),
          "slider" => "",
      );
      $this->load->view('mall/index', $part);
  }
  public function item_checkout_process()
  {

      /* Send Information Email To Client*/
      $subject = $this->lang->line('invoice_title');
      $invoice = $this->input->post('invoice');
      $unix_price = $this->input->post('total_val') + $this->input->post('ongkir') + rand(500, 999);
      $data_inv = array(
          "unix_price" => $unix_price,
          "city_id" => $this->input->post('kota'),
          "ongkir" => $this->input->post('ongkir'),
          "type" => $this->input->post('type')

      );
      $this->basicmodel->updateData('master_invoice', $data_inv, 'invoice', $invoice);
      $body    = file_get_contents(base_url('email/invoice/' . $invoice));
      $tgl     = date('Y-m-d H:i:s', time());
      $sql     = $this->basicmodel->insertData('email', array('timeupdate' => $tgl, 'email_to' => $this->nativesession->getObject('username'), 'email_subject' => $subject, 'email_body' => $body, 'module' => 'itemCheckoutPay'));

      // Kirim Email Ke Penjual
      $payload = "SELECT master_invoice.invoice, client_aecode.aecodeid, master_product.`aecodeid`, client_aecode.`name`, email FROM master_invoice, master_cart, master_product, client_aecode WHERE master_invoice.`invoice` = master_cart.`invoice` AND master_invoice.`invoice` = '$invoice' AND master_cart.`id_prod` = master_product.`id`AND master_product.`aecodeid` = client_aecode.`aecodeid` GROUP BY client_aecode.`aecodeid`";
      $execute = $this->db->query($payload)->result();
      $this->load->model('penjual');
      foreach ($execute as $key => $value) {
        $subject = "Selamat, Barang anda ada yang pesan !";
        ob_start();
        $datapenjual = $this->penjual->ambildatapenjualdariinvoice($value->aecodeid, $value->invoice);
        $datapembeli = $this->penjual->ambildatapembelidariinvoice($value->invoice);
        $dataadmin = $this->penjual->ambiladminmall();
        $this->load->view('api/emailkepenjual', array('datapenjual' => $datapenjual, 'datapembeli' => $datapembeli, 'dataadmin' => $dataadmin));
        $html = ob_get_contents();
        ob_end_clean();
        $sql     = $this->basicmodel->insertData('email', array('email_cc' => implode(';', $dataadmin), 'timeupdate' => $tgl, 'email_to' => $value->email, 'email_subject' => $subject, 'email_body' => $html, 'module' => 'emailkepenjual'));
      }
      if ($sql) {
          # code...
          $array = array(
              'cmd' => '8'
          );


          $this->db->set($array);
          $this->db->where('invoice', $invoice);
          $sql = $this->db->update('master_cart');
          if ($sql) {
              # code...
              redirect('checkout/' . $invoice . '/success', 'refresh');
          }
      } else {
          show_404();
      }

  }
  public function item_checkout_success($invoice)
  {
      $data = $this->basicmodel->getData('client_aecode', 'telephone_mobile,aecode, name, email, nationality, address', array('aecode' => $this->nativesession->getObject('username')));
      foreach ($data as $key => $value) {
          # code...
          $datausers = $value;
      }
      $tgl  = date('Y-m-d H:i:s', time());
      $join = array(
          array('table' => 'client_aecode', 'on' => 'master_cart.aecodeid = client_aecode.aecodeid', 'type' => 'left'),
          array('table' => 'master_product', 'on' => 'master_cart.id_prod = master_product.id', 'type' => 'left'),
          array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),
          array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
          array('table' => 'master_invoice', 'on' => 'master_cart.invoice = master_invoice.invoice', 'type' => 'left'),
      );
      $where = array(
          array('col' => 'master_cart.cmd', 'val' => '8'),
          array('col' => 'master_cart.invoice', 'val' => $invoice),
          // array('col' => 'master_product_promo.datefrom <=', 'val' => $tgl),
          // array('col' => 'master_product_promo.dateto >=', 'val' => $tgl)
      );
      $data = $this->basicmodel->getDataPromo('city_id, ongkir, unix_price, master_cart.id,prod_alias,prod_price,prod_images,qty,promo_name,promo_value', 'master_cart', $join, $where);
      // $datas = array();
      $datas_barang = array();
      foreach ($data as $key => $value) {
          # code...
          $datas_barang[$key]                = $value;
          $datas_barang[$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);

      }
      if (empty($datas_barang)) {
          # code...
          show_404();
      }
      $part = array(
          "header" => $this->load->view('mall/mainheader', array(), true),
          "body"   => $this->load->view('mall/checkoutsuccess', array('user' => $datausers, 'list' => $datas_barang), true),
          "slider" => "",
      );
      $this->load->view('mall/index', $part);
  }
}
