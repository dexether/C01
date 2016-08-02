<?php
// session_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Store extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('message_lang', 'indonesia');
        $this->load->model('Shop_model', 'basicmodel');
        date_default_timezone_set('Asia/Jakarta');
        // $this->load->library('session');
        $this->load->library('nativesession');
        $this->load->library('format');
        $this->users = $this->nativesession->get('user');

        // $this->load->helper('error');

    }
    public function index()
    {
        $tgl = date('Y-m-d H:i:s', time());

        $on = array(
            array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
            array('table' => 'master_product', 'on' => 'master_product_promo.id_product = master_product.id AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),
            array('table' => 'master_cat', 'on' => 'master_product.id_cat = master_cat.id', 'type' => 'left'),
        );
        $where = array();
        $datas = $this->basicmodel->getDataPromo('promo_alias, prod_images, prod_name, prod_alias, prod_price, cat_name, promo_name, promo_value', 'master_product_promo', $on, $where);

        foreach ($datas as $key => $value) {
            # code...
            $datas2[$key]                = $value;
            $datas2[$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);

        }
        // var_dump($datas);
        $homedata = $this->homeData();
        // var_dump($homedata);
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/mainbody', array('promo' => $datas2, 'brand' => $homedata), true),
            "slider" => $this->load->view('mall/slideshow', array(), true),
        );
        $this->load->view('mall/index', $part);
    }
    private function homeData()
    {
        $tgl = date('Y-m-d H:i:s', time());

        $on = array(
            array('table' => 'master_cat', 'on' => 'master_product.id_cat = master_cat.id', 'type' => 'left'),
            array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product', 'type' => 'left'),
            array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
            // array('table' => 'master_product', 'on' => 'master_product_promo.id_product = master_product.id AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),
            
        );
        $where = array();
        $datas = $this->basicmodel->getDataPromoOrder('promo_alias, prod_images, prod_name, prod_alias, prod_price, cat_name, promo_name, promo_value', 'master_product', $on, $where, 'master_product.timestamp', 'DESC');
        $datas2 = array();
        foreach ($datas as $key => $value) {
            # code...
            $datas2[$value['cat_name']][$key] =  $value;
            $datas2[$value['cat_name']][$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);

        }

        return $datas2;
    }
    public function basic()
    {
        redirect(base_url() . "web2", 'refresh');
    }
    public function bahasa()
    {
        show_404();
    }
    public function cat($type = null)
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
        );
        $datas = $this->basicmodel->getDataPromo('prod_images, prod_name, prod_alias, prod_price, cat_name, promo_name, promo_value', 'master_product', $on, $where);
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
        // var_dump($data);
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/cat', array('data' => $data, 'list' => $datas2), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function product($cat = null, $type = null)
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
        $datas = $this->basicmodel->getDataPromo('prod_desc, prod_desc_long, prod_star,prod_images, prod_name, prod_alias, prod_price, cat_name, promo_name, promo_value', 'master_product', $on, $where);

        foreach ($datas as $key => $value) {
            # code...
            $datas2[$key]                = $value;
            $datas2[$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);

        }

        // $this->shop_model->test();
        // var_dump($type);

        if (count($datas2) <= '0') {
            $this->output->set_status_header('404');
            show_404();
        }
        $data['title'] = array();
        foreach ($datas2 as $key => $value) {
            $data['title'] = $value;
        }
        // var_dump($data);
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/product', array('data' => $data), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function pageNotFound($cat = null, $type = null)
    {

        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/404', array(), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
}
