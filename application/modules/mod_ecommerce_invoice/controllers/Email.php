<?php

class Email extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_email_invoice($invoice)
    {
        // $this->db->select('client_aecode.name, master_invoice.unix_price');
        // $this->db->from('master_invoice');
        // $this->db->join('master_cart', 'master_invoice.invoice = master_cart.invoice');
        // $this->db->join('client_aecode', 'master_cart.aecodeid = client_aecode.aecodeid');
        // $this->db->where('master_invoice.invoice', $invoice);
        // $get = $this->db->get()->result();
        // foreach ($get as $key => $rows):
        //     $get_data = $rows;
        // endforeach;
        $orders = Order::where('order_number' , $invoice)->first();
        
        return $this->load->view('api/invoce_email', array('data' => $orders), true);
    }
    public function get_email_invoice2($invoice)
    {
        $this->db->select('client_aecode.name, master_invoice.unix_price');
        $this->db->from('master_invoice');
        $this->db->join('master_cart', 'master_invoice.invoice = master_cart.invoice');
        $this->db->join('client_aecode', 'master_cart.aecodeid = client_aecode.aecodeid');
        $this->db->where('master_invoice.invoice', $invoice);
        $get = $this->db->get()->result();
        foreach ($get as $key => $rows):
        $get_data = $rows;
        endforeach;
        return $this->load->view('api/invoce_email', array('data' => $get_data), true);
    }
}
