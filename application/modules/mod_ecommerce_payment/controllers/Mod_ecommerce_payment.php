<?php

class Mod_ecommerce_payment extends Auth_area
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Shop_model', 'basicmodel');
        // $this->load->helper('form');
        // $this->load->helper('url');
        // date_default_timezone_set('Asia/Jakarta');
        // // $this->load->library('nativesession');
        // $this->load->library('format');
    }
    public function secureGetImage()
    {
    //     $location = $this->input->get('callback');
    //   // $file = file_get_contents('/home/theprogrammer/Pictures/a.jpg');
    //   // header('Content-type: image/jpeg');
    //   // echo $file;
    //   // exit;

    //     $file = base64_decode($location);
    //     echo $file;
    //     ob_end_clean();
    //     $imgData = getimagesize($file);
    //     header('Content-type: image/jpeg');
    //     readfile($file);
    }
    public function userPaymentTransaction()
    {
        $get_aecodeid = $this->basicmodel->getData('client_aecode', 'aecodeid', $where = array('aecode' => $this->nativesession->getObject('username')));
        foreach ($get_aecodeid as $key => $value) {
            // code...
            @$aecodeid = $value['aecodeid'];
        }

        /* check banking function */
        $cek = $this->basicmodel->getData('client_aecode_bank', 'aeaccountnumber, banktype, status', array('aecode' => $this->nativesession->getObject('username')));
        foreach ($cek as $key => $value) {
            // code...
            @$bank_data = $value;
        }

        /* Jika bank data kosong set Sesion page ke profile */
        ($bank_data['banktype'] == '' || $bank_data['status'] == '1') ? $this->nativesession->set('page', 'profile') : '';
        $res = $this->basicmodel->transcationGet($aecodeid);

        $total = 0;
        $data = array();
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
                // code...
                $datas[$value1['invoice']] = $value1;
                $total = $total + $this->basicmodel->cekPromo($value1['promo_name'], $value1['promo_value'], $value1['prod_price']);
            }
            $datas[$value1['invoice']]['total'] = $total;
        }
        // $data[$value['invoice']]['total'] = $total;
        $this->db->select('master_invoice.invoice, master_cmd.cmd, master_invoice.timestamp, client_aecode.aecodeid, unix_price, ongkir, cmd_alias');
        $this->db->from('master_invoice');
        $this->db->join('master_cmd', 'master_invoice.cmd = master_cmd.cmd');
        $this->db->join('master_cart', 'master_invoice.invoice = master_cart.invoice');
        $this->db->join('client_aecode', 'client_aecode.aecodeid = master_cart.aecodeid');
        $this->db->group_by('master_invoice.invoice');
        $this->db->where('client_aecode.aecodeid', $aecodeid);
        $this->db->order_by('master_invoice.timestamp', 'DESC');
        $get = $this->db->get();
        $datas = $get->result_array();
        // foreach ($get->result_array() as $key => $value) {
        //   # code...
        //   $datas[$value['invoice']] = $value;
        // }
        // var_dump($data_invoices);
        // var_dump($datas);
        (!empty($datas)) ? $page = 'userPayment' : $page = 'userPaymentEmpty';
        // var_dump($data);
        $part = array(
            'header' => $this->load->view('mall/mainheader', array(), true),
            'body' => $this->load->view('mall/'.$page, array('data' => $datas, 'bank_data' => $bank_data), true),
            'slider' => '',
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
}
