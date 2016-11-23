<?php

class Mod_ecommerce_invoice extends Auth_area
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('format');
        $this->load->library('nativesession');
    }
    public function generate_invoice($company)
    {
        $date = date('Ymdhis', time());
        $this->db->select('id');
        $this->db->from('master_cart');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->result();
        foreach ($query as $key => $value) {
            # code...
            $last_id = $value->id;
            $new_id  = $last_id + 1;
        }
        $invoice = $company . $date . $new_id;
        $cek     = $this->db->get_where('master_invoice', array('invoice' => $invoice));
        if ($cek->num_rows() > 0) {
            # code...
            $this->generateInvoice($company);
        } else {
            $this->db->insert('master_invoice', array('invoice' => $invoice, 'cmd' => '9'));
            return $invoice;
        }
    }
    public function get_email_invoice($invoice){
        $this->db->select('client_aecode.name, master_invoice.unix_price');
        $this->db->from('master_invoice');
        $this->db->join('master_cart', 'master_invoice.invoice = master_cart.invoice');
        $this->db->join('client_aecode', 'master_cart.aecodeid = client_aecode.aecodeid');
        $this->db->where('master_invoice.invoice', $invoice);
        $get = $this->db->get()->result();
        foreach($get as $key => $rows):
          $get_data = $rows;
        endforeach;
        $this->load->view('api/invoce_email', array('data' => $get_data));
    }
}
