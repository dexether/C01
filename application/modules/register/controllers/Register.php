<?php

class Register extends MY_Controller
{
    protected $registerType;
    public function __construct()
    {
        parent::__construct();
        $this->load->config('google');
        $this->load->library('form_validation');
        $this->load->model('register_m');
        $this->load->helper('email');
        $this->load->helper('string');
    }
    public function index()
    {
        $this->templates->get_register_templates();
    }
    public function save_data()
    {
        // var_dump($_POST);
        // die();
        $this->load->module('google');
        $target_array['name'] = $this->input->post('name');
        $target_array['email'] = $this->input->post('email');
        $target_array['referal'] = $this->input->post('referal');
        $target_array['password'] = $this->input->post('password');
        $target_array['ConfirmPassword'] = $this->input->post('ConfirmPassword');
        $target_array['referal'] = $this->input->post('referal');
        // $g_recaptcha_response = $this->input->post('g-recaptcha-response');
        if (valid_email($target_array['email'])) {
          $this->registerType = "email";
        }else{
          $this->registerType = "phone";
        }
        $this->form_validation->set_rules('name', 'Nama', 'required|min_length[5]|max_length[50]',
          [
            'min_length' => 'Minimal Nama 5 Huruf',
            'max_length' => 'Maksimal Jumlah nama adalah 50',
          ]
        );
        $this->form_validation->set_rules('email', 'Email', 'required|trim|callback_check_email');
        $this->form_validation->set_rules('referal', 'Email Referal', 'trim|valid_email|callback_check_referal',
          [
            'valid_email' => 'Email yang anda masukkan Tidak Valid',
          ]
        );
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('ConfirmPassword', 'Konfirmasi Password', 'required|matches[password]',
          [
            'matches' => 'Konfirmasi Kata sandi tidak cocok',
          ]
        );
        // $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required|callback_check_captcha');
        if($this->form_validation->run($this) == false):
          $this->templates->get_register_templates();
        else:
          $target_array['key'] = $this->create_key($target_array['email']);
          $this->register_m->save_data_user($target_array);
          // Register to MLM
          modules::run('mlm/create_mlm', $target_array['referal'] , $target_array['email']);
          // referal
          // Send Email if they using email or send sms if they using sms
          if ($this->registerType == "email") {
            if($this->send_email($target_array['email'])):
              $this->session->set_flashdata('status', 'Harap cek email anda, kami telah megirim pesan ke email anda untuk Konfirmasi Akun anda.');
              redirect('/auth');
            endif;
          }else{
            $random_string = random_string('numeric' , 6);
            // Save To database
            $this->db->where('username' , $target_array['email']);
            $this->db->update('user' , ['sms_code' => $random_string]);
            $welcome_msg = "Hallo ," . $target_array['name'] . " Harap masukan kode berikut Untuk aktivasi pakebonus.com : " . $random_string;
            $this->gammu->send_message($welcome_msg, $target_array['email'] , $random_string);
            $this->session->set_flashdata('status', 'Kami telah mengirimkan Kode aktivasi Ke Nomor handphone anda, periksa Nomor handphone anda dan masukan Kode Unik dibawah ini');
            redirect('auth/confirmation/sms');
          }


        endif;
    }
    public function check_captcha($str)
    {
        $data = $this->google->validate_recaptcha($str);
        if($data->success):
          return true;
        else:
          $this->form_validation->set_message('check_captcha', '{field} tidak valid, silahkan ulangi');
          return false;
        endif;

    }
    public function check_email($email)
    {

      if(valid_email($email)):
        if($this->register_m->check_email($email)):
          return true;
        else:
          $this->form_validation->set_message('check_email', 'Email '. $email . ' sudah terdaftar, silahkan Gunakan email lain');
          return false;
        endif;
      else:
        if (is_numeric($email)) {
          return true;
        }else{
          $this->form_validation->set_message('check_email', 'Masukan email / Nomor telpon dengan benar');
          return false;
        }
      endif;

    }
    private function create_key($email)
    {
      $this->load->library('encrypt');
      $time = date("H:i:s", strtotime( '+3 hours' ) );
      $patern = $email . '||' . $time;
      return base64_encode($this->encrypt->encode($patern));
    }
    private function decode_key($key)
    {
      $this->load->library('encrypt');
      $no_encryp = $this->encrypt->decode($key);

    }
    public function activation()
    {
      $key = $this->input->get('key');
      $query = $this->db->select('key')
      ->from('user')
      ->where('key' , $key)
      ->get()
      ->result();
      if(count($query) > 0):
        $this->set_active($key);
        $this->session->set_flashdata('status', 'Akun anda telah aktif, Silahkan login');
        redirect('auth');
      else:
        $this->session->set_flashdata('status', 'Gagal aktikasi akun anda, klik disini untuk Kirim ulang kode Aktivasi');
        redirect('auth');
      endif;

    }
    public function set_active($key)
    {
      // get username
      $this->db->select('username')->from('user')->where('key' , $key);
      $get = $this->db->get()->result();
      foreach($get as $rows):
        $hasil = $rows;
      endforeach;
      if(!count($hasil) > 0):
        return false;
      endif;
      $this->db->where('aecode' , $hasil->username);
      $this->db->update('client_aecode', ['status' => true]);
      return true;
    }
    public function send_email($email)
    {
      $this->load->module('mailer');
      $data = $this->register_m->get_data_email($email);
      $link = base_url('user/activation/?key='. $data->key);
      // var_dump($data);
      $subject = 'Tinggal selangkah Lagi, Aktifkan Akun Anda !';
      $body = $this->load->view('email_v', ['data' => $data, 'link' => $link], true);
      return $this->mailer->send($email, $subject, $body);
    }
    public function confirmation_resend()
    {
      $this->templates->get_confirmation_resend_templates();
    }
    public function confirmation_resend_send()
    {
        $email = $this->input->post('email');
        $this->form_validation->set_rules('email' , 'E-mail' , 'required|trim|callback_check_email_confirmation',
          ['required' => 'Alamat email diperlukan, silahkan masukkan email anda']
        );
        if($this->form_validation->run($this) == false):
          $this->templates->get_confirmation_resend_templates();
        else:
          // var_dump($email);
          $this->send_email($email);
          $this->session->set_flashdata('status' , 'Email Konfirmasi telah dikirim ke '. $email . '. silahkan cek Inbox / spam di email anda');
          redirect('auth');
        endif;
    }
    public function check_email_confirmation($email)
    {
      if($this->register_m->check_email($email)):
        $this->form_validation->set_message('check_email_confirmation', 'Email '. $email . ' Tidak ada dalam sistem kami, silahkan <a href="' . base_url('signup') .'">Daftar</a>');
        return false;
      else:
        $this->db->select('status')->from('client_aecode');
        $this->db->where('email' , $email);
        $this->db->where('status' , true);
        $get = $this->db->get()->result();
        if(count($get) > 0):
          $this->form_validation->set_message('check_email_confirmation', 'Alamat email '.$email.' sudah aktif, silahkan <a href="'.base_url('auth').'"> Login</a>') ;
          return false;
        endif;
        return true;
      endif;
    }
    public function check_referal($email)
    {
      if ($email == NULL || $email == "") {
        return true;
      }
      $data = $this->register_m->check_referal($email);
      if(count($data) > 0):
        return true;
      else:
        $this->form_validation->set_message('check_referal', 'Referal email yang anda masukkan tidak Valid, atau Akun referal dalam keadaan tidak aktif. Silahkan cek kembali');
        return false;
      endif;
    }
    private function get_mlm_from_email($email)
    {
      $email = 'agustia.tarikh150@gmail.com';
      $this->db->select('client_accounts.accountname')->from('client_accounts')
      ->join('client_aecode', 'client_aecode.aecodeid = client_accounts.aecodeid')
      ->where('email' , $email);
      $get = $this->db->get()->row();
      return $get->accountname;
    }
    public function sms_confirmation()
    {
      $this->templates->get_sms_activation_templates();
    }
    public function sms_confirmation_post()
    {
      $this->form_validation->set_rules('sms_code' , 'Kode Verifikasi' , 'numeric|required|callback_check_sms_verify' ,
        [
          'numeric' => "Harap masukan {field} dengan benar",
          'required' => "{field} dibutuhkan"
        ]
      );
      if($this->form_validation->run($this) == false){
        $this->sms_confirmation();
      }else{
        $sms_code = $this->input->post('sms_code');
        $this->db->select('aecodeid')->from('client_aecode')
        ->join('user' , 'user.userid = client_aecode.userid')
        ->where('user.sms_code', $sms_code);
        $aecodeid = $this->db->get()->row()->aecodeid;
        $this->db->where('aecodeid' , $aecodeid);
        $this->db->update('client_aecode', ['status' => true]);
        $this->session->set_flashdata('status', 'Berhasil mengaktifkan akun anda, Silahkan Log-in');
        redirect('auth');
      }
    }
    public function check_sms_verify($sms_code)
    {
      $data = $this->db->get_where('user', ['sms_code' => $sms_code]);
      if (count($data->result()) > 0) {
        return true;
      }else{
        $this->form_validation->set_message('check_sms_verify', 'Gagal melakukan Verifikasi, Kode yang anda masukan tidak valid');
        return false;
      }
    }
}
