<?php


class Product_edit extends Auth_area
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
            // code...
          redirect(base_url().'web2/index.php?redirect='.urlencode(current_url()));
        }
    }
    public function editProductByUsers($product_id = null)
    {
        // If is mine
        $this->load->model('edit_m');
        $sql = $this->basicmodel->getData('client_aecode', 'aecodeid', array('aecode' => $this->nativesession->getObject('username')));
        foreach ($sql as $key => $value) {
            $aecodeid = $value['aecodeid'];
        }
        $secreat_key = $this->encrypt->decode($this->input->get('secreat_key'));
        $query = $this->edit_m->get_detail($product_id);
        if (empty($query)):
          show_404();
        endif;
        foreach ($query->result() as $key => $value) {
            // code...
          $dataBarang = $value;
        }
        if ($dataBarang->aecodeid != $aecodeid):
          show_404();
        endif;
        $sql = $this->basicmodel->getData('master_cat', 'id, cat_name, cat_alias', array());
        $part = array(
            'header' => $this->load->view('mall/mainheader', array(), true),
            'body' => $this->load->view('edit_v', array('dataBarang' => $dataBarang, 'list_cat' => $sql), true),
            'slider' => '',
        );
        $this->load->view('mall/index', $part);
    }
    public function getImagesDropZone($id)
    {
        $this->db->select('image_location, id');
        $this->db->from('master_product_images');
        $this->db->where('id_prod', $id);

        $hasil = $this->db->get()->result_array();
        foreach($hasil as $key => $rows):
          $data[$key] = $rows;
          $data[$key]['size'] = filesize($rows['image_location']);
        endforeach;
        // $ds          = DIRECTORY_SEPARATOR;
        // $result  = array();
        // $storeFolder = 'assets/img';
        // $files = scandir($storeFolder);                 //1
        // if ( false!==$files ) {
        // foreach ( $files as $file )
        // {
        //     if ( '.'!=$file && '..'!=$file) {       //2
        //         $obj['name'] = $file;
        //         $obj['size'] = filesize($storeFolder.$ds.$file);
        //         $result[] = $obj;
        //     }
        // }
        // }
        //
        header('Content-type: text/json');              //3
        header('Content-type: application/json');
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        // print_r($data);
    }
    public function removeFiles()
    {
      $image_location = $this->input->post('image_location');
      $delete = $this->db->delete('master_product_images', array('image_location' => $image_location));
      if($delete):
        $response['valid'] = true;
      else:
        $response['valid'] = false;
      endif;
      header('Content-type: text/json');              //3
      header('Content-type: application/json');
      echo json_encode($response);
    }
    public function editProductDo()
    {
      $this->load->library('slim');
      $images = Slim::getImages();
      // var_dump($_POST);
      if ($images == false) {
          // show_404();
          die('Not Images');
      } else {
          foreach ($images as $image) {
              $file = Slim::saveFile($image['output']['data'], $this->format->url_dash($image['input']['name']));
          }
          $prod_id        = $this->input->post('prod_id');
          $prod_alias     = $this->input->post('prod_alias');
          $cat            = $this->input->post('cat');
          $prod_price     = $this->input->post('prod_price');
          $int            = filter_var($prod_price, FILTER_SANITIZE_NUMBER_INT);
          $prod_price     = $int;
          $prod_desc      = $this->input->post('prod_desc');
          $prod_desc_long = $this->input->post('prod_desc_long');
          $comm           = $this->input->post('comm');
          $prod_weight    = filter_var($this->input->post('weight'), FILTER_SANITIZE_NUMBER_INT);
          $send_email     = ($this->input->post('send_method') == "on") ? true : false;
          $prod_images    = $file['path'];
          $data         = array(
            'id_cat'         => $cat,
            'prod_alias'     => $prod_alias,
            'prod_desc'      => $prod_desc,
            'prod_desc_long' => $prod_desc_long,
            'prod_price'     => $prod_price,
            'prod_images'    => $prod_images,
            'by_email'       => $send_email,
            'prod_weight'    => $prod_weight,
          );
          $sql = $this->db->update('master_product', $data, array('id' => $prod_id));
          if ($sql) {
              // $data = array(
              //   'id_prod' => 0
              // );
              // $updatePictures = $this->basicmodel->updateData('master_product_images', $data, $where, $where_value);
              $remote_address = $_SERVER['REMOTE_ADDR'];
              $update = $this->db->query('UPDATE master_product_images SET id_Prod = "'.$prod_id.'" WHERE unix = "'.$remote_address.'" AND id_prod IS NULL');
              // redirect('product/step/2/'.$prod_name, 'refresh');
              // redirect('product/success/'.$prod_name);
              $data = $this->db->query('SELECT cat_name, prod_name FROM master_product, master_cat WHERE master_product.`id_cat` = master_cat.`id` AND master_product.id = "'.$prod_id.'"')->result();
              foreach($data as $rows):
                $superdata = $rows;
              endforeach;
              redirect(base_url('c/' .$superdata->cat_name . "/" . $superdata->prod_name));
              // var_dump(base_url('c/' .$superdata->cat_name . "/" . $superdata->prod_name));

          } else {
              show_404();
              // die('');

          }
              // echo '<img src="' . base_url() . $file['path'] . '" alt=""/>';
      }
    }
    public function deleteProduct($prod_id = null){
  		$data      = $this->basicmodel->getData('client_aecode', 'aecodeid,telephone_mobile,aecode, name, email, nationality, address', array('aecode' => $this->nativesession->getObject('username')));
          $datausers = array();
          foreach ($data as $key => $value) {
              # code...
              $datausers = $value;
          }
  		$cat	= $this->basicmodel->getData('master_cat', 'cat_alias, cat_name');
  		$cats = array();
  		foreach ($cat as $key => $value) {
  			$cats[] = $value;

  		}
  		$sql = $this->basicmodel->deleteProduct($prod_id, $datausers['aecodeid']);
          $sql2  = $this->basicmodel->getDataBySeller($datausers['aecodeid']);

          $part = array(
              "header" => $this->load->view('mall/mainheader', array(), true),
              "body"   => $this->load->view('mall/myProduct', array('list_prod' => $sql2, 'userdata' => $datausers, 'list_cat' => $cats), true),
              "slider" => "",
          );
          $this->load->view('mall/index', $part);
  	}
}
