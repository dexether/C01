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
        var_dump($this->form_validation->run($this));
        var_dump(validation_errors());
        if ($this->form_validation->run($this) == false) {
            $this->index();
        } else {
            // die('Register Compleate');
            // modules::run('log/create', $this->input->post('username'), 'Username '.$this->input->post('username').' login with password '.$this->input->post('password').' success', true);
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
    public function logout()
    {
        modules::run('log/create', $this->session->userdata('username'), 'username '.$this->session->userdata('username').' end his session', true);
        $this->session->sess_destroy();
        redirect('/');
    }
}
