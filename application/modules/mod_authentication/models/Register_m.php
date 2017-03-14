<?php
class Register_m extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('email');
  }
  public function check_email($email)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('username', $email);
    $this->db->limit(1);
    $get = $this->db->get()->result();
    if(count($get) > 0):
      return false;
    else:
      return true;
    endif;
  }
  public function save_data_user()
  {
    $full_name = $this->input->post('full_name');
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $data = [
      'username' => $email,
      'groupid' => 3,
      'login_end' => date('Y-m-d H:i:s'),
      'password' => md5($password)
    ];
    $this->db->insert('user', $data);

    $insert_id = $this->db->insert_id();
    $data = [
      'aecode' => $email,
      'email' => $email,
      'name' => $full_name
    ];
    $this->db->insert('client_aecode', $data);
    return true;
  }
  public function get_data_email($email)
  {
    $this->db->select('name, email, key');
    $this->db->from('user');
    $this->db->join('client_aecode', 'user.userid = client_aecode.userid');
    $this->db->where('email', $email);
    $get = $this->db->get()->result();
    foreach($get as $rows):
      return $rows;
    endforeach;

  }
  public function check_referal($email)
  {
    $this->db->select('email, client_accounts.accountname')
    ->from('client_accounts')
    ->join('client_aecode', 'client_accounts.aecodeid = client_aecode.aecodeid')
    ->where('client_aecode.email' , $email)
    ->where('client_aecode.status', true);
    $get = $this->db->get()->result();
    return $get;
  }
}
 ?>
