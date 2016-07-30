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
  
        // var_dump($_SESSION);
        $tgl = date('Y-m-d H:i:s', time());
        $on    = array(
            array('table' => 'master_cat', 'on' => 'master_product.id_cat = master_cat.id', 'type' => 'left'),
            array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product', 'type' => 'left'),
            array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'));
        $where = array(
            array('col' => 'master_product_promo.cmd', 'val' => '0'),
            array('col' => 'master_promo.cmd', 'val' => '0'),
            array('col' => 'master_product_promo.datefrom <=', 'val' => $tgl),
            array('col' => 'master_product_promo.dateto >=', 'val' => $tgl));
        $datas = $this->basicmodel->getDataPromo('master_product.prod_price, master_product_promo.datefrom, master_product_promo.dateto, master_promo.promo_alias, master_product.prod_alias, prod_images, master_cat.cat_name, prod_name', 'master_product', $on, $where);
        
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/mainbody', array('promo' => $datas), true),
            "slider" => $this->load->view('mall/slideshow', array(), true),
        );
        $this->load->view('mall/index', $part);
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
        $dataByCat = $this->basicmodel->getDataByCat($type);
        // var_dump($dataByCat);
        // $this->shop_model->test();
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
            "body"   => $this->load->view('mall/cat', array('data' => $data, 'list' => $dataByCat), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function product($cat = null, $type = null)
    {

        // $this->shop_model->test();
        // var_dump($type);
        $result = $dataByCat = $this->basicmodel->getDataByProd($type);
        // var_dump($result);
        if (count($result) <= '0') {
            $this->output->set_status_header('404');
            show_404();
        }
        $data['title'] = array();
        foreach ($result as $key => $value) {
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
