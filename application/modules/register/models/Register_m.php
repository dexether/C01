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
  public function save_data_user($target_array)
  {
    $data = [
      'username' => $target_array['email'],
      'groupid' => 1,
      'password' => md5($target_array['password']),
      'key' => $target_array['key']
    ];
    $this->db->insert('user', $data);

    $insert_id = $this->db->insert_id();
    $data = [
      'userid' => $insert_id,
      'aecode' => $target_array['email'],
      'email' => $target_array['email'],
      'name' => $target_array['name']
    ];
    if (valid_email($target_array['email'])) {

    }else{
      $data['email'] = NULL;
      $data['telephone_mobile'] = $target_array['email'];
    }
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
