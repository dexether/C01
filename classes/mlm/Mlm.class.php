<?php

define('root', $_SERVER['DOCUMENT_ROOT']);
require_once root.'/classes/pdo/Database.class.php';
class Mlm extends Database
{
    public $error_msg;
    public $family_tree;
    public function __construct()
    {
      parent::__construct();
    }
    public function get_my_account($email)
    {
      $query = QB::table('client_aecode')->select(['client_aecode.aecodeid', 'accountname'])
      ->join('client_accounts' , 'client_aecode.aecodeid', '=', 'client_accounts.aecodeid')
      ->where('client_aecode.email' , '=' , $email);
      return $query->get();
    }
    public function get_account()
    {
        $query = QB::table('client_accounts')->select(['client_aecode.name', 'client_accounts.accountname'])
    ->join('client_aecode', 'client_accounts.aecodeid', '=', 'client_aecode.aecodeid')
    ->where('client_aecode.status', '=', true)
    ->orderBy('client_aecode.name', 'ASC');

        return $query->get();
    }
    public function register_accounts($target_array)
    {
        if($this->check_duplicated($target_array['email'])):
          $this->$error_msg = "Email sudah tersedia";
          return false;
        endif;
        $user = [
          'username' => $target_array['email'],
          'password' => md5(1234),
          'lockingid' => 1,
          'groupid' => 3,
          'login_end' => '2999-12-31 00:00:01',
        ];
        $insertId = QB::table('user')->insert($user);
        $target_array['userid'] = $insertId;
        $client_aecode = [
          'aecode' => $target_array['email'],
          'name' => $target_array['email'],
          'email' => $target_array['email'],
          'groupid' => 1,
        ];
        $insertId = QB::table('client_aecode')->insert($client_aecode);
        return $insertId;
    }
    public function check_duplicate_mt4login($mt4login)
    {
        $row = QB::table('mlm2')->select(['client_aecode.name', 'client_aecode.email', 'client_accounts.accountname', 'mlm2.mt4login'])
        ->join('client_accounts', 'mlm2.ACCNO', '=', 'client_accounts.accountname')
        ->join('client_aecode', 'client_accounts.aecodeid', '=', 'client_aecode.aecodeid')
        ->where('mt4login', $mt4login);
        if ($row->count() > 1):
          return true; else:
          return false;
        endif;
    }
    public function check_duplicated($email)
    {
      $data = QB::table('client_aecode')->select('email')
      ->where('email', '=' , $email)
      ->first();
      if(count($data) > 0):
        return true;
      else:
        return false;
      endif;
    }
    public function create_account($last)
    {
      $waktucheck1 = date('ymdH', strtotime('-1 hour'));
      $query = QB::table('mlm')->select('*')
      ->where('ACCNO' , '=' , $waktucheck1)
      ->orderBy('ACCNO' , 'DESC')
      ->limit(1);
      $get = $query->get();
      $lastACCNO = 0;
      foreach($get as $rows):
        $lastACCNO = $rows->ACCNO;
      endforeach;
      $val1 = strlen($lastACCNO);
      $val2 = substr($lastACCNO, 8, $val1);
      $val3 = intval($val2);
      if ($last == '0') {
          $last = $val2 + 1;
      } else {
          $last = $last + 1;
      }
      $account_name_check = $waktucheck1 . $last;
      $query = "select * from mlm where ACCNO  = '$account_name_check'";
      $query = QB::table('mlm')->select('*')
      ->where('ACCNO' , '=' , $account_name_check)
      ->get();
      $is_accountname_already_taken = "no";
      foreach ($query as $key => $value) {
        $lastACCNO                    = $value->ACCNO;
        $is_accountname_already_taken = "yes";
      }
      if ($is_accountname_already_taken == "yes") {
          $accountname = $this->create_account($last);
      } else {
          $accountname = $account_name_check;
      }
      return $accountname;
    }
    public function create_account_register($aecodeid, $accountname, $upline, $mt4login, $mt4dt)
    {
      // require dirname(__FILE__) . '/../metatrader/sync.class.php';
      // $sync = new Sync();

      // Insert client_accounts
      $data = [
        'aecodeid' => $aecodeid,
        'accountname' => $accountname,
        'name' => $accountname,
        'address' => '',
        'telephone_home' => '',
        'telephone_office' => '',
        'telephone_mobile' => '',
        'suspend' => false,
        'last_updated' => date('Y-m-d H:i:s'),
        'status' => 'normal',
        'sendmethod' => 'Email'
      ];
      $query = QB::table('client_accounts')->insert($data);

      // Check Upline Plan
      $upline_plan = QB::table('mlm')->select('group_play')
      ->where('ACCNO', '=' , $upline)
      ->first()->group_play;

      // Insert dta mlm
      $data = [
        'mt4dt' => 'nometa',
        'ACCNO' => $accountname,
        'Upline' => $upline,
        'datetime' => date('Y-m-d H:i:s'),
        'companyconfirm' => 2,
        'payment' => 0,
        'group_play' => $upline_plan
      ];
      $query = QB::table('mlm')->insert($data);

      // Check Duplicated
      $check_duplicate = $this->check_duplicate_mt4login($mt4login);
      if($check_duplicate):
        $this->error_msg = "MT4 LOGIN for ". $mt4login . " Has registered Process Sync Aborted";
        return false;
      endif;

      // Insert data mlm2
      $data = [
        'ACCNO' => $accountname,
        'mt4dt' => $mt4dt,
        'mt4login' => $mt4login,
        'datetime' => date('Y-m-d H:i:s'),
        'suspend' => 0,
      ];
      QB::table('mlm2')->insert($data);
      return true;

    }
    public function register_cabinet_id($aecodeid, $mt4login, $mt4dt, $upline)
    {

      $accountname = $this->create_account(0);
      $create_account_register = $this->create_account_register($aecodeid, $accountname, $upline, $mt4login , $mt4dt);
      return $create_account_register;
    }
    public function get_user_data($email)
    {
      $query = QB::table('client_aecode')->select(['aecode' ,'aecodeid' ,'name' ,'email'])
      ->where('email' , $email);
      return $query->first();
    }
    public function google_family_tree($username , $isadmin)
    {
      if ($isadmin == false) {
        $data = $this->family_tree($username);
      }else{
        $data = $this->family_tree_all();
      }
      foreach ($data as $key => $value) {
        if ($value->suspend == true) {
          $gabungan[] = [
            [
              "v" => $value->ACCNO,
              "f" => "<div id=".$value->ACCNO." style='color : red; width: 100%;'>".$value->ACCNO."<br/><strong>".$value->name."</strong><p>SUSPENDED ACCOUNT</p></div>"
            ],
            $value->Upline , ""
          ];
        }else{
          $gabungan[] = [
            [
              "v" => $value->ACCNO,
              "f" =>  $value->ACCNO . "<div id=".$value->ACCNO."><strong>".$value->name."</strong></div>"
            ],
            $value->Upline , ""
          ];
        }
      }
      return $gabungan;
    }
    public function family_tree_all()
    {
      $this->family_tree = [];
      $data = $this->db->table('mlm')->select(['ACCNO', 'Upline' , 'client_aecode.name' , 'client_accounts.suspend' , 'client_aecode.foto'])
      ->join('client_accounts', 'mlm.ACCNO', '=' , 'client_accounts.accountname')
      ->join('client_aecode', 'client_accounts.aecodeid' , '=' , 'client_aecode.aecodeid')
      ->get();
      return $data;
    }
    public function family_tree($username)
    {
      $this->family_tree = [];
      $data = $this->db->table('mlm')->select(['ACCNO', 'Upline' , 'client_aecode.name' , 'client_accounts.suspend' , 'client_aecode.foto'])
      ->join('client_accounts', 'mlm.ACCNO', '=' , 'client_accounts.accountname')
      ->join('client_aecode', 'client_accounts.aecodeid' , '=' , 'client_aecode.aecodeid')
      ->where('client_aecode.aecode' , '=' , $username)
      ->get();
      array_push($this->family_tree, $data);
      foreach ($data as $key => $account) {
        $this->family_tree_loop($account->ACCNO);
      }
      foreach($this->family_tree as $key => $tree)
      {
        foreach ($tree as $key2 => $list) {
          $hasil[] = $list;
        }
      }
      return $hasil;
    }
    public function family_tree_loop($upline)
    {
      $data = $this->db->table('mlm')->select(['ACCNO', 'Upline' , 'client_aecode.name' , 'client_accounts.suspend' , 'client_aecode.foto'])
      ->join('client_accounts', 'mlm.ACCNO', '=' , 'client_accounts.accountname')
      ->join('client_aecode', 'client_accounts.aecodeid' , '=' , 'client_aecode.aecodeid')
      ->where('mlm.Upline' , '=' , $upline)
      ->where('client_accounts.suspend' , '=' , FALSE)
      ->get();
      if (count($data) > 0) {
        array_push($this->family_tree, $data);
      }
      foreach ($data as $key => $account) {
        $this->family_tree_loop($account->ACCNO);
      }
    }
}
