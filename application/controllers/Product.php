
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('message_lang', 'indonesia');
        $this->load->model('Shop_model', 'basicmodel');
        $this->load->helper('form');
        $this->load->helper('url');
        date_default_timezone_set('Asia/Jakarta');
        // $this->load->library('session');
        $this->load->library('nativesession');
        $this->load->library('format');
        $this->load->library('encrypt');
        if (!$this->nativesession->getObject('username')) {
            # code...
            redirect(base_url() . "web2/index.php?redirect=" . urlencode(current_url()));

        }

    }
    public function editProductByUsers($product_id = null)
    {
        $secreat_key = $this->encrypt->decode($this->input->get('$secreat_key'));
        $this->db->select('id_cat, prod_name, prod_alias, prod_desc, prod_desc_long, prod_images, comm, cat_alias');
        $this->db->from('master_product');
        $this->db->join('master_cat', 'master_product.id_cat = master_cat.id');
        $this->db->where('prod_name', 'cigarette-case-the-fed');
        $query = $this->db->get();
        foreach ($query->result() as $key => $value) {
          # code...
          $dataBarang = $value;
        }
        $sql  = $this->basicmodel->getData('master_cat', 'id, cat_name, cat_alias', array());
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/editProduct', array('dataBarang' => $dataBarang, 'list_cat' => $sql), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function getImagesDropZone()
    {
        $ds          = DIRECTORY_SEPARATOR;
        $result  = array();
        $storeFolder = 'assets/product';
        $files = scandir($storeFolder);                 //1
        if ( false!==$files ) {
        foreach ( $files as $file )
        {
            if ( '.'!=$file && '..'!=$file) {       //2
                $obj['name'] = $file;
                $obj['size'] = filesize($storeFolder.$ds.$file);
                $result[] = $obj;
            }
        }
        }

        header('Content-type: text/json');              //3
        header('Content-type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

}

/* End of file Buy_sell.php */
/* Location: ./application/controllers/Buy_sell.php */
