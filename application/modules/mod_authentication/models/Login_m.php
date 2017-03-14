<?php

class Login_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function check_login($target_array)
    {
      $this->db->select('username, password');
      $this->db->from('user');
      $this->db->where('username', $target_array['username']);
      $this->db->where('password', md5($target_array['password']));
      $get = $this->db->get()->result();
      return (count($get) > 0 ) ? true : false;

    }
    public function check_login_phone($target_array)
    {
      $this->db->select('username, password, telephone_mobile');
      $this->db->from('user');
      $this->db->join('client_aecode', 'user.userid = client_aecode.userid');
      $this->db->where('telephone_mobile', $target_array['username']);
      $this->db->where('password', md5($target_array['password']));
      $get = $this->db->get()->result();
      return (count($get) > 0 ) ? true : false;

    }
    public function get_user_data($username)
    {
      $this->db->select('username, client_aecode.name, client_aecode.aecodeid, client_aecode.email');
      $this->db->from('user');
      $this->db->join('client_aecode', 'user.username = client_aecode.aecode');
      $this->db->where('username', $username);
      $get = $this->db->get()->result_array();
      return $get;
    }
    public function get_user_data_by_phone($phone)
    {
      $this->db->select('user.userid, username, client_aecode.name, client_aecode.aecodeid, client_aecode.email');
      $this->db->from('user');
      $this->db->join('client_aecode', 'user.userid = client_aecode.userid');
      $this->db->where('telephone_mobile', $phone);
      $get = $this->db->get()->result_array();
      return $get;
    }
    public function get_user_data_email($email)
    {
      $this->db->select('username, client_aecode.name, client_aecode.aecodeid, client_aecode.email, user.key');
      $this->db->from('user');
      $this->db->join('client_aecode', 'user.userid = client_aecode.userid');
      $this->db->where('client_aecode.email', $email);
      $get = $this->db->get()->result();
      return $get;
    }
    public function check_active($email)
    {
      $this->db->select('status');
      $this->db->from('client_aecode');
      $this->db->where('email' , $email);
      $this->db->where('status' , true);
      $get = $this->db->get()->result();
      $cek = false;
      foreach($get as $rows):
        $cek = true;
      endforeach;
      return $cek;
    }
    public function check_active_phone($phone)
    {
      $this->db->select('status');
      $this->db->from('client_aecode');
      $this->db->where('telephone_mobile' , $phone);
      $this->db->where('status' , true);
      $get = $this->db->get()->result();
      $cek = false;
      foreach($get as $rows):
        $cek = true;
      endforeach;
      return $cek;
    }
    public function get_old_password($key)
    {
      $this->db->select('key , password , username')
      ->from('user')
      ->where('key' , $key);
      $get = $this->db->get()->result();
      $hasil = false;
      foreach ($get as $key => $value) {
        $hasil = $value;
      }
      return $hasil;
    }
}
