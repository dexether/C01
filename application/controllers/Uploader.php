<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uploader extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('format');
        $this->load->library('slim');
        $this->load->library('nativesession');
        $this->load->model('shop_model', 'basicmodel');
        if (!$this->nativesession->getObject('username')) {
            # code...
            redirect(base_url() . "web2/index.php?redirect=" . current_url());

        }

    }
    public function index()
    {

    }
    public function secureImagesUpload(){
        // print_r($_FILES);
        // print_r($_POST);
        $config['upload_path']          = 'assets/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']        = true;

      //  $config['max_size']             = 100;
      //  $config['max_width']            = 1024;
      //  $config['max_height']           = 768;

       $this->load->library('upload', $config);

       if ( ! $this->upload->do_upload('file'))
       {
               $error = array('error' => $this->upload->display_errors());
               print_r($error);
              //  $this->load->view('upload_form', $error);
       }
       else
       {
               $data = array('upload_data' => $this->upload->data());
               print_r($data);

              //  $this->load->view('upload_success', $data);
       }
    }
    public function secureSaveUploadedImages()
    {

        $images = Slim::getImages();
        // var_dump($_POST);
        if ($images == false) {

            // inject your own auto crop or fallback script here

            show_404();

        } else {
            $sql = $this->basicmodel->getData('client_aecode', 'aecodeid', array('aecode' => $this->nativesession->getObject('username')));
            foreach ($sql as $key => $value) {
                $aecodeid = $value['aecodeid'];
            }

            foreach ($images as $image) {

                $file = Slim::saveFile($image['output']['data'], $image['input']['name']);
            }
            $prod_name      = $this->format->seoUrl($this->input->post('prod_alias'));
            $prod_alias     = $this->input->post('prod_alias');
            $cat            = $this->input->post('cat');
            $prod_price     = $this->input->post('prod_price');
            $int            = filter_var($prod_price, FILTER_SANITIZE_NUMBER_INT);
            $prod_price     = $int;
            $prod_desc      = $this->input->post('prod_desc');
            $prod_desc_long = $this->input->post('prod_desc_long');
            $comm           = $this->input->post('comm');
            $prod_images    = $file['path'];
            $insert         = array(

                'id_cat'         => $cat,
                'aecodeid'       => $aecodeid,
                'prod_alias'     => $prod_alias,
                'prod_name'      => $prod_name,
                'prod_desc'      => $prod_desc,
                'prod_desc_long' => $prod_desc_long,
                'prod_star'      => 0,
                'is_active'      => false,
                'prod_price'     => $prod_price,
                'prod_seen'      => 0,
                'prod_images'    => $prod_images,
                'comm'           => $comm,

            );
            $sql = $this->basicmodel->insertData('master_product', $insert);
            if ($sql) {
                redirect('product/success/'.$prod_name,'refresh');
            } else {
                show_404();
            }
            // echo '<img src="' . base_url() . $file['path'] . '" alt=""/>';
        }
    }
    public function successCreatePage($productname)
    {
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/successcreateproduct', array(), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
}

/* End of file Uploader.php */
/* Location: ./application/controllers/Uploader.php */
