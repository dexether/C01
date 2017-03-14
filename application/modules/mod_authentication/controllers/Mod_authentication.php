<?php

class Mod_authentication extends MY_Controller
{
    public $error_msg;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('login_m');
        $this->load->helper('email');
        $this->load->module('google');
    }
    public function index()
    {
        $data['page'] = 'category-page';
        $data['content'] = 'mod_authentication/login_v';
        $this->template->get_main($data);
    }
    public function login()
    {
        $redirect = $this->input->post('redirect');
        $this->form_validation->set_rules('login_user', 'Password', 'required');
        $this->form_validation->set_rules('login_password', 'Password', 'required|callback_check_login');
        if ($this->form_validation->run($this) == false) {
            $this->index();
        } else {
          
            redirect(($redirect != NULL) ? $redirect : "/");

        }
    }

    public function check_login()
    {
        $data['username'] = $this->input->post('login_user');
        $data['password'] = $this->input->post('login_password');
        $check = $this->login_m->check_login($data);
        if ($check == true):
          if($this->login_m->check_active($data['username']) == false):
            $this->form_validation->set_message('check_login', 'Maaf, akun anda belum aktif, silahkan Klik tautan yang kami kirim atau <a href="'.base_url('auth/confirmation/resend').'">Kirim ulang link Aktivasi</a>');
            return false;
          endif;
          $user_data = $this->get_user_data($data['username']);
          $this->set_user_data($user_data);
          return true;
        else:
          $this->form_validation->set_message('check_login', 'Kombinasi Username dan Password anda tidak cocok, silahkan Coba lagi');
          return false;
        endif;
    }
    private function get_user_data($username)
    {
        foreach ($this->login_m->get_user_data($username) as $rows):
        $user_data = $rows;
        endforeach;

        return $user_data;
    }
    private function get_user_data_by_phone($username)
    {
        foreach ($this->login_m->get_user_data_by_phone($username) as $rows):
        $user_data = $rows;
        endforeach;
        return $user_data;
    }
    private function set_user_data($target_array)
    {
        $this->session->set_userdata(array('login' => true));
        $this->session->set_userdata($target_array);
    }
    public function forget_password_send()
    {
        $email = $this->input->post('email');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_check_email',
        ['valid_email' => 'masukkan email yang valid', 'required' => 'Kolom email harus diisi']
      );
        if ($this->form_validation->run($this) == false):
        $this->templates->get_login_templates(); else:

        $data = $this->login_m->get_user_data_email($email);
        foreach ($data as $rows):
          $data = $rows;
        endforeach;
        // SET Sessions
        $this->session->set_userdata('forget_password', $data->key);
        $body = $this->load->view('forget_password_mail_v', ['data' => $data], true);
        modules::run('mailer/send', $data->email, 'Permohonan perubahan kata sandi '.$this->config->item('app_name'), $body);
        $this->session->set_flashdata('status', 'Email Konfirmasi perubahan kata sandi anda telah kami kirim. Silahkan cek Kotak masuk / spam pada email anda');
        redirect('auth');
        endif;
    }
    public function forget_password()
    {
        $this->templates->get_foget_password_templates();
    }
    public function forget_password_do()
    {
        $key = $this->input->post('key');
        $password = md5($this->input->post('password'));
        $this->form_validation->set_rules('key', 'Key', 'required|trim|callback_check_key');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('confirmationpassword', 'Konfirmasi Password', 'required|trim|matches[password]');
        if ($this->form_validation->run($this) == false):
        $this->templates->get_login_templates(); else:
        // do reset
        // get old password
        $old_password = $this->login_m->get_old_password($key);
        $data = [
          'password' => $password,
          'passwordold' => $old_password->password,
        ];
        $this->db->where('user.key', $key);
        $this->db->update('user', $data);
        // Success
        modules::run('log/create', $old_password->username, 'User '.$old_password->username.' reset his password to '.$this->input->post('password'), true);
        $this->session->unset_tempdata('forget_password');
        $this->session->set_flashdata('status', 'Atur ulang kata sandi anda berhasil, silahkan login');
        redirect('auth');
        endif;
    }
    public function check_key($key)
    {
        $this->db->select('key')
      ->from('user')
      ->where('key', $key);
        $get = $this->db->get()->result();
        if (count($get) > 0 && $key == $this->session->userdata('forget_password')):
        return true; else:
        $this->form_validation->set_message('check_key', 'Kesalahaan saat melalukan validasi, silahkan Kirim ulang permohonan perubahaan kata sandi anda. Terimakasih');

        return false;
        endif;
    }
    private function create_key($email)
    {
      $this->load->library('encrypt');
      $time = date("H:i:s", strtotime( '+3 hours' ) );
      $patern = $email . '||' . $time;
      $key = base64_encode($this->encrypt->encode($patern));
      $this->session->set_userdata('key' , $key);
      return $key;
    }
    public function check_email($email)
    {
        $this->db->select('email')
        ->from('client_aecode')
        ->where('email', $email);
        $get = $this->db->get()->result();
        if (count($get) > 0):
        return true; else:
        $this->form_validation->set_message('check_email', 'Email yang anda masukkan tidak terdaftar pada system kami');
        return false;
        endif;
    }
    public function activation_resend()
    {
        $data['page'] = 'category-page';
        $data['content'] = 'mod_authentication/activation_resend_v';
        $this->template->get_main($data);
    }
    public function activation_resend_post()
    {
      $email = $this->input->post('email');

      $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required|callback_check_captcha');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|callback_check_email');
      if($this->form_validation->run($this) == false){
        $this->activation_resend();
      }else{
        $full_name = $this->db->get_where('client_aecode', ['email' => $email])->row();

        $dataEmail = [
          'name' => $full_name->name,
          'key' => $this->create_key($email)
        ];
        $link = base_url('auth/activation/?key='. $dataEmail['key']);
        $body = $this->load->view('email_welcome_v' , ['data' => (object) $dataEmail, 'link' => $link] , true);
        modules::run('mailer/send', $email , "Tinggal selangkah lagi Untuk bergabung di AgendaFX" , $body);

        $this->session->set_flashdata('success' , 'Silahkan cek email anda kami telah mengirimkan Link aktivasi');
        redirect('auth');
      }

    }
    public function activation_user()
    {
      $this->load->library('encrypt');
      $key = $this->input->get('key');
      if($key == $this->session->userdata('key'))
      {
        // Valid Key
        $step1 = $this->encrypt->decode(base64_decode($key));
        $step2 = explode('||' , $step1)[0];
        $this->db->where('client_aecode.email' , $step2);
        $this->db->update('client_aecode' , ['status' => true]);
        $this->session->set_flashdata('success' , 'Anda telah berhasil mengaktifkan Akun anda, Silahkan Log-in');
        $this->session->unset_userdata('key');
        redirect('/auth');
      }else{
        $this->session->set_flashdata('error' , 'Maaf, halaman yang anda kunjungi sudah Kadaluarsa');
        $this->session->unset_userdata('key');
        redirect('/auth');
      }
    }
    public function check_email_signup($email)
    {
        $this->db->select('email')
        ->from('client_aecode')
        ->where('email', $email);
        $get = $this->db->get()->result();
        if (count($get) > 0):
          $this->form_validation->set_message('check_email_signup', 'Email yang anda gunakan Sudah terdaftar');
          return false;
        else:
          return true;
        endif;
    }
    public function signup()
    {
      $full_name = $this->input->post('full_name');
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $confirm_password = $this->input->post('confirm_password');
      $this->form_validation->set_rules('full_name', 'Nama', 'required|min_length[5]|max_length[50]',
        [
          'min_length' => 'Minimal Nama 5 Huruf',
          'max_length' => 'Maksimal Jumlah nama adalah 50',
        ]
      );
      $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required|callback_check_captcha');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|callback_check_email_signup');
      $this->form_validation->set_rules('password', 'Password', 'required');
      $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]',
        [
          'matches' => 'Konfirmasi Kata sandi tidak cocok',
        ]
      );
      if($this->form_validation->run($this) == false)
      {
        $this->session->set_flashdata('error' , 'Data yang anda masukan belum Valid, silahkan cek kembali');
        $this->index();
      }else{
        $this->load->model('register_m');
        // Save Client aecode and username
        $this->register_m->save_data_user();

        // send email activation
        $dataEmail = [
          'name' => $full_name,
          'key' => $this->create_key($email)
        ];
        $link = base_url('auth/activation/?key='. $dataEmail['key']);
        $body = $this->load->view('email_welcome_v' , ['data' => (object) $dataEmail, 'link' => $link] , true);
        modules::run('mailer/send', $email , "Tinggal selangkah lagi Untuk bergabung di AgendaFX" , $body);
        // Sync With Metatrader Email

        // Create Account

        $this->session->set_flashdata('success' , 'Terimakasih telah mendaftar di AgendaFX, selanjutnya harap Cek Email anda Kami telah mengirimkan email aktivasi');
        redirect('auth');
      }
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
    public function logout()
    {
        modules::run('log/create', $this->session->userdata('username'), 'username '.$this->session->userdata('username').' end his session', true);
        $this->session->sess_destroy();
        redirect('/');
    }
}
