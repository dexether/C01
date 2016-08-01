
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('message_lang', 'indonesia');
        $this->load->model('Shop_model', 'basicmodel');
        $this->load->helper('form');
        $this->load->helper('url');
        // $this->load->library('session');
        $this->load->library('nativesession');
        $this->load->library('format');
        // if (!$this->nativesession->getObject('username')) {
        //     # code...
        //     redirect(base_url() . "web2/index.php?redirect=" . current_url());

        // }

    }

    public function index()
    {
        // var_dump($this->config);
        print_r('logon');
    }
    public function getEmailInvoice($invoice){
        $tgl  = date('Y-m-d H:i:s', time());
        $join = array(
            array('table' => 'client_aecode', 'on' => 'master_cart.aecodeid = client_aecode.aecodeid', 'type' => 'left'),
            array('table' => 'master_product', 'on' => 'master_cart.id_prod = master_product.id', 'type' => 'left'),
            array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product AND master_product_promo.datefrom <= "'.$this->db->escape($tgl).'" AND master_product_promo.dateto >= "'.$this->db->escape($tgl).'"', 'type' => 'left'),
            array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
        );
        $where = array(
            array('col' => 'master_cart.cmd', 'val' => '7'),
            array('col' => 'master_cart.invoice', 'val' => $invoice)
            );
        $data = $this->basicmodel->getDataPromo('name,master_cart.id,prod_alias,prod_price,prod_images,qty,promo_name,promo_value', 'master_cart', $join, $where);        
        $datas_barang = array();

        foreach ($data as $key => $value) {
            # code...
            $datas_barang[$key]                = $value;
            $datas_barang[$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);
            @$total = $total + $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);
        }
        $datas_barang['name'] = $value['name'];

        $datas_barang['total'] = $total;
        if (empty($datas_barang)) {
            # code...
            show_404();
        }
        $this->load->view('api/invoce_email', array('data' => $datas_barang));
    }
}

/* End of file Buy_sell.php */
/* Location: ./application/controllers/Buy_sell.php */
