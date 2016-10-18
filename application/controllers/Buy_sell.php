
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buy_sell extends CI_Controller
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

    public function index()
    {
        // var_dump($this->config);
        print_r('logon');
    }
    public function addProductToChart($name = "", $qty = 1)
    {
        $get = $this->basicmodel->getData('master_product', 'id', $where = array('prod_name' => $name));
        foreach ($get as $key => $value) {
            # code...
            $id = $value['id'];
        }
        if (count($get) <= '0') {
            # code...
            show_404();
        } else {
            // var_dump($id);
            // var_dump();
            $get_aecodeid = $this->basicmodel->getData('client_aecode', 'aecodeid', $where = array('aecode' => $this->nativesession->getObject('username')));
            foreach ($get_aecodeid as $key => $value) {
                # code...
                $aecodeid = $value['aecodeid'];
            }
            if (!empty($get_aecodeid)) {
                # code...
                $cek = $this->basicmodel->getData('master_cart', 'id', $where = array('aecodeid' => $aecodeid, 'id_prod' => $id, 'cmd' => 6));
                if (!empty($cek)) {
                    # code...
                    redirect(base_url('cart'), 'refresh');
                } else {

                    $data = array(
                        "aecodeid" => $aecodeid,
                        "id_prod"  => $id,
                        "qty"      => $qty,
                    );
                    $insert = $this->basicmodel->insertData('master_cart', $data);
                    if ($insert) {
                        # code...
                        redirect(base_url('cart'), 'refresh');
                    } else {
                        show_404();
                    }
                }
            } else {
                show_404();
            }
            // var_dump($this->nativesession->getObject('username'/))
            // $insert = $this->basicmodel->insertData('master_cart');
            // print_r($name);
        }

    }
    public function showMyCart()
    {
        $get_aecodeid = $this->basicmodel->getData('client_aecode', 'aecodeid', $where = array('aecode' => $this->nativesession->getObject('username')));
        foreach ($get_aecodeid as $key => $value) {
            # code...
            $aecodeid = $value['aecodeid'];
        }
        if (empty($get_aecodeid)) {
            # code...
            show_404();
        }
        $tgl  = date('Y-m-d H:i:s', time());
        $join = array(
            array('table' => 'client_aecode', 'on' => 'master_cart.aecodeid = client_aecode.aecodeid', 'type' => 'left'),
            array('table' => 'master_product', 'on' => 'master_cart.id_prod = master_product.id', 'type' => 'left'),
            array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),
            array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
        );
        $where = array(
            array('col' => 'client_aecode.aecodeid', 'val' => $aecodeid),
            array('col' => 'master_cart.cmd', 'val' => '6'),
            // array('col' => 'master_product_promo.datefrom <=', 'val' => $tgl),
            // array('col' => 'master_product_promo.dateto >=', 'val' => $tgl)
        );
        $data = $this->basicmodel->getDataPromo('master_cart.id,prod_alias,prod_price,prod_images,qty,promo_name,promo_value', 'master_cart', $join, $where);

        $datas = array();
        // var_dump($data);
        foreach ($data as $key => $value) {
            # code...
            $datas[$key]                = $value;
            $datas[$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);

        }
        $template = "cart";
        if (empty($datas)) {
            # code...
            $template = "cart_empty";
        }
        // var_dump($datas);
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/' . $template, array('list' => $datas), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function deleteProductFromcart($id)
    {
        $do = $this->basicmodel->deleteData('master_cart', array('id' => $id));
        if ($do) {
            # code...
            redirect('cart', 'refresh');
        } else {
            // show_404();
        }
    }
    public function itemCheckout()
    {
        $get_aecodeid = $this->basicmodel->getData('client_aecode', 'aecodeid', $where = array('aecode' => $this->nativesession->getObject('username')));
        foreach ($get_aecodeid as $key => $value) {
            # code...
            $aecodeid = $value['aecodeid'];
        }
        if (empty($get_aecodeid)) {
            # code...
            show_404();
        }
        $invoice = $this->generateInvoice('AGFX');
        $array   = array(
            'cmd'     => '7',
            'invoice' => $invoice,
        );

        $this->db->set($array);
        $this->db->where('aecodeid', $aecodeid);
        $this->db->where('cmd', '6');
        $sql = $this->db->update('master_cart'); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
        if ($sql) {
            # code...
            redirect('cart/' . $invoice . '/checkout', 'refresh');
        } else {
            show_404();
        }
        // var_dump($invoice);
    }

    private function generateInvoice($company)
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
    public function userCheckOut($invoice)
    {
        $cek = $this->basicmodel->getData('master_invoice', 'id', array('invoice' => $invoice));
        if (empty($cek)) {
            # code...
            // show_404();
        }
        $data = $this->basicmodel->getData('client_aecode', 'aecode, name, email, nationality, address', array('aecode' => $this->nativesession->getObject('username')));
        foreach ($data as $key => $value) {
            # code...
            $datas = $value;
        }

        $tgl  = date('Y-m-d H:i:s', time());
        $join = array(
            array('table' => 'client_aecode', 'on' => 'master_cart.aecodeid = client_aecode.aecodeid', 'type' => 'left'),
            array('table' => 'master_product', 'on' => 'master_cart.id_prod = master_product.id', 'type' => 'left'),
            array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),
            array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
        );
        $where = array(
            array('col' => 'master_cart.cmd', 'val' => '7'),
            array('col' => 'master_cart.invoice', 'val' => $invoice),
            // array('col' => 'master_product_promo.datefrom <=', 'val' => $tgl),
            // array('col' => 'master_product_promo.dateto >=', 'val' => $tgl)
        );
        $data = $this->basicmodel->getDataPromo('master_cart.id,prod_alias,prod_price,prod_images,qty,promo_name,promo_value', 'master_cart', $join, $where);
        // $datas = array();
        $datas_barang = array();
        foreach ($data as $key => $value) {
            # code...
            $datas_barang[$key]                = $value;
            $datas_barang[$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);

        }
        if (empty($datas_barang)) {
            # code...
            show_404();
        }

        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/checkout', array('user' => $datas, 'list' => $datas_barang), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function itemCheckoutPay()
    {

        /* Send Information Email To Client*/
        $subject = $this->lang->line('invoice_title');
        $invoice = $this->input->post('invoice');
        $unix_price = $this->input->post('total_val') + rand(500, 999);
        $data_inv = array(
            "unix_price" => $unix_price,
        );
        $this->basicmodel->updateData('master_invoice', $data_inv, 'invoice', $invoice);
        $body    = file_get_contents(base_url('email/invoice/' . $invoice));
        $tgl     = date('Y-m-d H:i:s', time());
        $sql     = $this->basicmodel->insertData('email', array('timeupdate' => $tgl, 'email_to' => $this->nativesession->getObject('username'), 'email_subject' => $subject, 'email_body' => $body, 'module' => 'itemCheckoutPay'));
        if ($sql) {
            # code...
            $array = array(
                'cmd' => '8',
            );


            $this->db->set($array);
            $this->db->where('invoice', $invoice);
            $sql = $this->db->update('master_cart');
            if ($sql) {
                # code...
                redirect('checkout/' . $invoice . '/success', 'refresh');
            }
        } else {
            show_404();
        }

    }
    public function itemCheckoutSuccess($invoice)
    {
        $data = $this->basicmodel->getData('client_aecode', 'telephone_mobile,aecode, name, email, nationality, address', array('aecode' => $this->nativesession->getObject('username')));
        foreach ($data as $key => $value) {
            # code...
            $datausers = $value;
        }
        $tgl  = date('Y-m-d H:i:s', time());
        $join = array(
            array('table' => 'client_aecode', 'on' => 'master_cart.aecodeid = client_aecode.aecodeid', 'type' => 'left'),
            array('table' => 'master_product', 'on' => 'master_cart.id_prod = master_product.id', 'type' => 'left'),
            array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),
            array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
            array('table' => 'master_invoice', 'on' => 'master_cart.invoice = master_invoice.invoice', 'type' => 'left'),
        );
        $where = array(
            array('col' => 'master_cart.cmd', 'val' => '8'),
            array('col' => 'master_cart.invoice', 'val' => $invoice),
            // array('col' => 'master_product_promo.datefrom <=', 'val' => $tgl),
            // array('col' => 'master_product_promo.dateto >=', 'val' => $tgl)
        );
        $data = $this->basicmodel->getDataPromo('unix_price, master_cart.id,prod_alias,prod_price,prod_images,qty,promo_name,promo_value', 'master_cart', $join, $where);
        // $datas = array();
        var_dump($data);
        $datas_barang = array();
        foreach ($data as $key => $value) {
            # code...
            $datas_barang[$key]                = $value;
            $datas_barang[$key]['final_price'] = $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);

        }
        if (empty($datas_barang)) {
            # code...
            show_404();
        }
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/checkoutsuccess', array('user' => $datausers, 'list' => $datas_barang), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
    public function sell()
    {
        /* Check if data is complete */
        $data      = $this->basicmodel->getData('client_aecode', 'telephone_mobile,aecode, name, email, nationality, address', array('aecode' => $this->nativesession->getObject('username')));
        $datausers = array();
        foreach ($data as $key => $value) {
            # code...
            $datausers = $value;
        }
        $sql  = $this->basicmodel->getData('master_cat', 'id, cat_name, cat_alias', array());
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/sell', array('list_cat' => $sql, 'userdata' => $datausers), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }
	public function myproduct($cat_name = null){
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
		if($cat_name == null){
			$sql  = $this->basicmodel->getDataBySeller($datausers['aecodeid']);
		}else{
			$sql = $this->basicmodel->myProductDataByCat($cat_name, $datausers['aecodeid']);
		}
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/myProduct', array('list_prod' => $sql, 'userdata' => $datausers, 'list_cat' => $cats), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
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
    public function userPaymentTransaction()
    {
        $get_aecodeid = $this->basicmodel->getData('client_aecode', 'aecodeid', $where = array('aecode' => $this->nativesession->getObject('username')));
        foreach ($get_aecodeid as $key => $value) {
            # code...
            @$aecodeid = $value['aecodeid'];
        }

        /* check banking function */
        $cek = $this->basicmodel->getData('client_aecode_bank', 'aeaccountnumber, banktype, status', array('aecode' => $this->nativesession->getObject('username')));
        foreach ($cek as $key => $value) {
            # code...
            @$bank_data = $value;
        }

        /* Jika bank data kosong set Sesion page ke profile */
        ($bank_data['banktype'] == '' || $bank_data['status'] == '1') ? $this->nativesession->set('page', 'profile') : "";
        $res = $this->basicmodel->transcationGet($aecodeid);

        $total = 0;
        $data  = array();
        // var_dump($res);
        foreach ($res as $key => $value) {
            $data[$value['invoice']][] = $value;
            // var_dump($data);
            // $total = $total + $this->basicmodel->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);

        }
        // var_dump($data);
        $datas = array();
        foreach ($data as $key => $value) {
            $total = 0;
            foreach ($value as $key1 => $value1) {
                # code...
                $datas[$value1['invoice']] = $value1;
                $total                     = $total + $this->basicmodel->cekPromo($value1['promo_name'], $value1['promo_value'], $value1['prod_price']);

            }
            $datas[$value1['invoice']]['total'] = $total;
        }
        // $data[$value['invoice']]['total'] = $total;

        (!empty($datas)) ? $page = 'userPayment' : $page = 'userPaymentEmpty';
        // var_dump($data);
        $part = array(
            "header" => $this->load->view('mall/mainheader', array(), true),
            "body"   => $this->load->view('mall/' . $page, array('data' => $datas, 'bank_data' => $bank_data), true),
            "slider" => "",
        );
        $this->load->view('mall/index', $part);
    }

    public function getTransactionData()
    {
        $result = $this->basicmodel->getDataTranscation('client_aecode_bank', 'aecode, banktype, bank_name, aeaccountnumber', array('client_aecode_bank.aecode' => $this->nativesession->getObject('username')));
        foreach ($result as $key => $value) {
            # code...
            $response = $value;
        }
        // var_dump($response);
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))
            ->_display();
        // var_dump($result);
        exit;
    }
    public function confirmPayment()
    {
        $this->load->library('slim');

        /* DO any things */

        $images = Slim::getImages();
        // var_dump($_POST);
        if ($images == false) {

            // inject your own auto crop or fallback script here

            show_404();

        } else {

            /* Do it */
            foreach ($images as $image) {

                $file = Slim::saveFile($image['output']['data'], $image['input']['name'], $this->config->item('transfer_secure_upload_dir'));
            }

            $invoice = $this->input->post('inv');
            $data    = array(
                "cmd"         => 10,
                "timeupdate"  => date('Y:m:d H:i:s', time()),
                "upload_file" => $file['path'],
                "date_pay" => $this->input->post('tgl_pay')
            );
            $do = $this->basicmodel->updateData('master_invoice', $data, 'invoice', $invoice);

            $subject = "Terimakasih sudah melakukan konfirmasi";
            $invoice = $this->input->post('invoice');
            $body    = file_get_contents(base_url('api/confirmationSendEmail'));
            $tgl     = date('Y-m-d H:i:s', time());
            $sql     = $this->basicmodel->insertData('email', array('timeupdate' => $tgl, 'email_to' => $this->nativesession->getObject('username'), 'email_subject' => $subject, 'email_body' => $body, 'module' => 'itemCheckoutPay'));

            $subject_toadmin = "Ada transaksi baru dari ".$this->nativesession->getObject('username');
            $body = "Hallo Admin<br/>";
            $body .= "<br/>";
            $body .= "Nampaknya, user ".$this->nativesession->getObject('username')." telah melakukan Konfirmasi transasksi dengan nomor invoice ".$invoice.", silahkan cek laporan transasksi,<br/>";
            $body .= "<br/>";
            $to = $this->config->item('admin_email');
            $cc = $this->config->item('finance_email');
            // insertData
            $this->basicmodel->insertData('email', array('timeupdate' => $tgl, 'email_to' => $to, 'email_cc' => $cc, 'email_subject' => $subject_toadmin, 'email_body' => $body, 'module' => 'itemCheckoutPay'));

            $do = $this->basicmodel->updateData('master_invoice', $data, 'invoice', $invoice);
            redirect('payment/transactions', 'refresh');

            // -----------------------

        }

    }
    public function readImages()
    {
        $this->load->library('encryption');
        $plain_text = 'D:/web-dir/git/upload/transaction/57b6af9d99cbc_IMG-20160309-WA0006.jpg';
         $ciphertext = $this->encryption->encrypt($plain_text);
        $crypt  = "a6e03f22e408cf820de3cf9629afd789a996530ad0b6b769f8e4daa6a96c965deab6b40053a52053fb3c3204c2a75b88b441900ec1d615abaaf367c00dad1154kMi+usML1ti+yc3yH/UBb03LT9yLPGEMLc0+EfSUldTA9p1GmnfBl6JBX26faW2mLZZwP9SfzWSMWVGsgSIU3zS92np7CwIqEn+zxzUsy17M4dt9UelOigflJZwPjS+f";
        echo $this->encryption->decrypt($crypt);
    }
    public function barangSudahDiterima(){
        $encrypten_invoice = $this->input->post('invoice');
        $data  = array(
          'cmd' => '14'
        );
        $do = $this->basicmodel->updateData('master_invoice', $data, 'invoice' , $encrypten_invoice);
        // var_dump($do);
        if($do):
          $response['msg'] = "Terimakasih telah berbelanja di AgendaFX";
        else:
          $response['msg'] = "Konfirmasi anda belum dapat kami proses";
        endif;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))
            ->_display();
            exit;
    }
    public function setReviewsByUser(){
      $get_aecodeid = $this->basicmodel->getData('client_aecode', 'aecodeid', $where = array('aecode' => $this->nativesession->getObject('username')));
      foreach ($get_aecodeid as $key => $value) {
          # code...
          @$aecodeid = $value['aecodeid'];
      }
      $data = array(
        'prod_id' => $this->encrypt->decode($this->input->post('productIdentification')),
        'aecodeid' => $aecodeid,
        'rating_star' => $this->input->post('star'),
        'rating_subject' => $this->input->post('subject'),
        'rating_comm' => $this->input->post('komentar'),
      );
      $do = $this->basicmodel->insertData('master_product_rating', $data);
      if($do):
        redirect($this->nativesession->get('previous_url'),'refresh');
      else:
        show_404();
      endif;
    }
}

/* End of file Buy_sell.php */
/* Location: ./application/controllers/Buy_sell.php */
