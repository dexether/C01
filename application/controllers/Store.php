<?php
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

    }
    public function index()
    {

        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/mainbody', array(), true),
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
        echo $this->lang->line("msg_first_name");
        echo base_url();
    }
    public function cat($type = null)
    {

        // $this->shop_model->test();
        $result = $this->basicmodel->getData('master_cat', 'cat_name, cat_desc, cat_alias', array('cat_name' => $type));
        if (count($result) <= '0') {
            show_404();
        }
        $data['title'] = array();
        foreach ($result as $key => $value) {
            $data['title'] = $value;
        }
        // var_dump($data);
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/cat', array('data' => $data), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function product($type = null)
    {

       /* // $this->shop_model->test();
        $result = $this->basicmodel->getData('master_cat', 'cat_name, cat_desc, cat_alias', array('cat_name' => $type));
        if (count($result) <= '0') {
            show_404();
        }
        $data['title'] = array();
        foreach ($result as $key => $value) {
            $data['title'] = $value;
        }
        // var_dump($data);*/
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/cat', array('data' => $data), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
}
