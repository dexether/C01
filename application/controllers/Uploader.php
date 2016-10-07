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
    public function uploadMultipleImages()
    {
        $this->load->library('encrypt');
        $this->load->helper('string');
        $this->load->library('upload');
        $this->upload->initialize(array(
            "upload_path"   => $this->config->item('product_uploads'),
            "allowed_types" => "jpg|png",
            "encrypt_name" => true
        ));

        //Perform upload.
        $this->upload->do_multi_upload("file");
        // Get POST var
        $product_id = $this->encrypt->decode($this->input->post('product_encrypt'));
        foreach ($this->upload->get_multi_upload_data() as $key => $value) {
            // print_r('Uploading '.$value['file_name']);
            $location = reduce_double_slashes($this->config->item('product_uploads').$value['file_name']);
            $data = array(
              "is_images" => true,
              "image_location" => $location,
              "image_type" => "secondary",
              "unix" => $_SERVER['REMOTE_ADDR']
            );
            $do = $this->basicmodel->insertData('master_product_images', $data);
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
                $file = Slim::saveFile($image['output']['data'], $this->format->url_dash($image['input']['name']));
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
                // $data = array(
                //   'id_prod' => 0
                // );
                // $updatePictures = $this->basicmodel->updateData('master_product_images', $data, $where, $where_value);
                $remote_address = $_SERVER['REMOTE_ADDR'];
                $update = $this->db->query('UPDATE master_product_images SET id_Prod = "'.$this->db->insert_id().'" WHERE unix = "'.$remote_address.'" AND id_prod IS NULL');
                // redirect('product/step/2/'.$prod_name, 'refresh');
                redirect('product/success/'.$prod_name);

            } else {
                show_404();
            }
                // echo '<img src="' . base_url() . $file['path'] . '" alt=""/>';
        }
    }
    public function createProductStepTwo($productname)
    {
        $this->load->library('encrypt');
        $query = $this->basicmodel->getData('master_product', 'id', array('prod_name' => $productname));
        foreach ($query as $key => $value) {
          # code...
            $productid = $value['id'];
        }
        $part = array(
        "header" => $this->load->view('mall/mainheader', array(), true),
        "body"   => $this->load->view('mall/createProductStepTwo.php', array('productid' => $productid, 'productname' => $productname), true),
        "slider" => "",
        );
        $this->load->view('mall/index', $part);
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
    public function editStatement()
    {
        $config['upload_path']          = $this->config->item('product_uploads');
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 1024;
        $config['encrypt_name']         = true;


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
        }
        else
        {
                $datas = array('upload_data' => $this->upload->data());
                foreach($datas as $value):
                  $location = $this->config->item('product_uploads').$value['file_name'];
                  $data = array(
                    "is_images" => true,
                    "image_location" => $location,
                    "image_type" => "secondary",
                    "unix" => $_SERVER['REMOTE_ADDR']
                  );
                  $do = $this->basicmodel->insertData('master_product_images', $data);
                endforeach;

        }
    }
}

/* End of file Uploader.php */
/* Location: ./application/controllers/Uploader.php */
