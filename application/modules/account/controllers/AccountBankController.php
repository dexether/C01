<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AccountBankController extends AuthController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('BankAccount');
    $this->load->library('form_validation');
    // $this->load->model('Bank');
  }
  public function index()
  {
    $data['BankAccounts'] = $bankAccounts = BankAccount::where('aecodeid' , $this->session->userdata('aecodeid'))->get();
    $data['du_menu'] = "du_config";
    $data['contentDashboard'] = "account/BankAccount_v";
    $this->template->get_user_dashboard($data);
  }
  public function createView()
  {
    $banks = Bank::all();
    $data['du_menu'] = "du_config";
    $data['contentDashboard'] = "account/BankAccountNew_v";
    $data['banks'] = $banks;
    $this->template->get_user_dashboard($data);
  }
  public function createPost()
  {

    $this->form_validation->set_rules('aeaccountname', 'Nama Rekening' , 'required|min_length[4]|max_length[100]')
    ->set_rules('aeaccountnumber', 'Nomor Rekening' , 'required|numeric')
    ->set_rules('password', 'Password' , 'required|callback_checkpassword');
    if($this->form_validation->run($this) == false)
    {
      $this->createView();
    }else{
      $bank_id = $this->input->post('bank_id');
      $aeaccountname = $this->input->post('aeaccountname');
      $aeaccountnumber = $this->input->post('aeaccountnumber');
      $action = BankAccount::create([
        'aecodeid' => $this->session->aecodeid,
        'aecode' => $this->session->email,
        'bank_id' => $bank_id,
        'aeaccountname' => $aeaccountname,
        'aeaccountnumber' => $aeaccountnumber
      ]);
      $this->session->set_flashdata('success', 'Rekening atas nama <strong>'.$action->aeaccountname.'</strong> Berhasil dibuat');
      return redirect('/account/bankaccount');
    }
  }
  public function checkpassword($password)
  {
    $username = $this->session->userdata('username');
    $this->load->model('mod_authentication/login_m');
    $data['username'] = $username;
    $data['password'] = $password;
    $check = $this->login_m->check_login($data);
    if (!$check) {
      $this->form_validation->set_message('checkpassword', 'Password yang anda masukan Salah !, Silahkan ulangi kembali');
    }
    return $check;
  }
}
?>
