
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
        date_default_timezone_set('Asia/Jakarta');
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
        $this->db->select('client_aecode.name, master_invoice.unix_price');
        $this->db->from('master_invoice');
        $this->db->join('master_cart', 'master_invoice.invoice = master_cart.invoice');
        $this->db->join('client_aecode', 'master_cart.aecodeid = client_aecode.aecodeid');
        $this->db->where('master_invoice.invoice', $invoice);
        $get = $this->db->get()->result();
        foreach($get as $key => $rows):
          $get_data = $rows;
        endforeach;
        $this->load->view('api/invoce_email', array('data' => $get_data));
    }
    public function confirmationSendEmail(){

        $this->load->view('api/user_payment_confirmation');
    }
    public function sendEmailAfterApprove($invoice){

        $this->load->view('api/sendemailafterapprove', array("invoice" => $invoice));
    }
    public function sendEmailAfterReject($invoice){

        $this->load->view('api/sendemailafterreject', array("invoice" => $invoice));
    }
    public function sendEmailAfterSend($invoice){

        $this->load->view('api/sendemailafterSend', array("invoice" => $invoice));
    }
    public function secureGetImage(){
      $location = $this->input->get('callback');
      // $file = file_get_contents('/home/theprogrammer/Pictures/a.jpg');
      // header('Content-type: image/jpeg');
      // echo $file;
      // exit;
      $file = base64_decode($location);
      echo $file;
      ob_end_clean();
      $imgData = getimagesize($file);
      header('Content-type: image/jpeg');
      readfile($file);
    }
    // public function b(){
    //   $this->load->library('encrypt');
    //   $file = "/home/theprogrammer/Pictures/a.jpg";
    //   // echo $this->encrypt->encode($file);
    //   $var = "M8beqPo67FIDltz8iTrg22uyJKaf4wpILqq6R1STCpSqD3fqZ+izHPYL8KsTLrCV9nypZYvT9OwlFpnxA0l95rWmWYo/enJwqsGOndkXRIaCvi/Z/wv7CezVeuBazjxJ";
    //   echo $this->encrypt->decode($var);
    //
    // }

}

/* End of file Buy_sell.php */
/* Location: ./application/controllers/Buy_sell.php */
