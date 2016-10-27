<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjual extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->lang->load('message_lang', 'indonesia');
    }
    public function ambildatapenjualdariinvoice($aecodeid, $invoice)
    {
      $this->db->select('master_cart.qty, client_aecode.name, master_product.prod_name, prod_alias, prod_price');
      $this->db->from('master_invoice');
      $this->db->join('master_cart', 'master_invoice.invoice = master_cart.invoice');
      $this->db->join('master_product', 'master_cart.id_prod = master_product.id');
      $this->db->join('client_aecode', 'master_product.aecodeid = client_aecode.aecodeid');
      $this->db->where('master_invoice.invoice', $invoice);
      $this->db->where('client_aecode.aecodeid', $aecodeid);
      $get = $this->db->get()->result();
      return $get;
    }
    public function ambildatapembelidariinvoice($invoice)
    {
      $this->db->select('name, email, telephone_mobile, address');
      $this->db->from('master_invoice');
      $this->db->join('master_cart', 'master_invoice.invoice = master_cart.invoice');
      $this->db->join('client_aecode', 'master_cart.aecodeid = client_aecode.aecodeid');
      $this->db->where('master_invoice.invoice', $invoice);
      $get = $this->db->get()->result();
      return $get;
    }
    public function ambiladminmall()
    {
      $this->db->select('special_access');
      $this->db->from('menu');
      $this->db->where('id', 111);
      $get = $this->db->get()->result();
      foreach ($get as $key => $value) {
        $dataadmin = $value->special_access;
      }
      $pecah = explode(',', $dataadmin);
      return $pecah;
    }
    public function ambil_alamat($aecodeid)
    {
      $this->db->select('*');
      $this->db->from('client_aecode_address');
      $this->db->where('aecodeid', $aecodeid);
      $get = $this->db->get();
      return $get;
    }
}

/* End of file shop_model.php */
/* Location: ./application/models/shop_model.php */
