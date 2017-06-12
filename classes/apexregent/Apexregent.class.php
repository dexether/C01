<?php

define('root', $_SERVER['DOCUMENT_ROOT']);
require_once root.'/classes/pdo/Database.class.php';
class Apexregent extends Database
{
  public $keywords;
  public function __construct()
  {
    parent::__construct();
    $this->keywords= "";
  }
  public function get()
  {
    $row = QB::table('my_table')->find(3);
  }
  public function goldsaving_status()
  {
    $query = QB::table('app_config')->select(['key', 'value'])->where('key', '=', 'AR_GOLDSAVING_STATUS');
    $result = $query->first();
    if ($result->value == "disabled") {
      return false;
    }else{
      return true;
    }
  }
  public function bonus_setting()
  {
    $row = ['AR_WCD_DAY'];
    $query = QB::table('app_config')->select(['key', 'value'])
    ->whereIn('key', $row);
    $result = $query->get();
    foreach ($result as $key => $value) {
      $settings[$value->key] = $value->value;
    }
    return (object) $settings;
  }
  public function get_all_user()
  {
    $data = $this->db->table('user')->select(['userid' , 'username' , 'email' , 'client_aecode.aecode'])
    ->join('client_aecode' , 'client_aecode.aecode' , '=' , 'user.username')
    ->where('client_aecode.status' , '=' , true)
    ->orderBy('client_aecode.email' , 'ASC')
    ->get();
    return $data;
  }
  public function get_all_access()
  {
    $acced_group = [3,9];
    $data = $this->db->table('group')->select(['groupid' , 'description'])
    ->whereIn('groupid', $acced_group)
    ->get();
    return $data;
  }
  public function get_apex_menu($username = null)
  {
    $query = $this->db->table('menu')->where('enable', '=' , true)->get();
    foreach ($query as $key => $value) {
      $arrayCategory[$value->id] = [
        "id" => $value->id,
        "parent_id" => $value->parent_id,
        "name" => $value->title
      ];
    }
    return $this->createTreeView($username, $arrayCategory, 0);
  }
  function createTreeView($username, $array, $currentParent, $currLevel = 0, $prevLevel = -1, $node = "node-0-0", $key = 0) {
    foreach ($array as $categoryId => $category) {
      if ($currentParent == $category['parent_id']) {
        if ($currLevel > $prevLevel) echo " <ul> ";
        if ($currLevel == $prevLevel) echo " </li> ";
        // query
        // $check = $this->db->table('menu_access')
        // ->join('user' , 'user.userid', '=' , 'menu_access.userid')
        // ->where('user.username' , '=' , $username)
        // ->get();
        // var_dump($check);
        echo '<li> <input type="checkbox" name="menus[]"/ value="'.$category['id'].'"><label for="">'.$category['name'].'</label>';
        // var_dump($currLevel . " - " . $prevLevel);
        if ($currLevel > $prevLevel)
        {
          $prevLevel = $currLevel;
        }
        $key++;
        $currLevel++;
          $this->createTreeView($username, $array, $categoryId, $currLevel, $prevLevel , $node , $key);
          $key--;
        $currLevel--;
      }
    }
    if ($currLevel == $prevLevel) echo " </li>  </ul> ";
  }
  public function grant_menu($menus = [], $userid , $groupid = 3)
  {
    $this->db->table('menu_access')->where('userid' , '=' , $userid)
    ->delete();

    foreach ($menus as $key => $value) {
      $insert[] = [
        "menu_id" => $value,
        "userid" => $userid
      ];
    }
    $this->db->table('menu_access')->insert($insert);
    $data = [
      "groupid" => $groupid,
    ];
    $this->db->table('user')->where('userid', $userid)->update($data);
  }
  public function get_users($limit = 10, $offset, $keywords = "")
  {
    $this->keywords = $keywords;
    $data = $this->db->table('client_aecode')->select(['aecodeid', 'name' , 'email' , 'status', 'telephone_mobile'])
    ->where(function($q)
      {
          $q->orWhere('name', 'LIKE', '%'.$this->keywords.'%');
          $q->orWhere('email', 'LIKE', '%'.$this->keywords.'%');
          $q->orWhere('status', 'LIKE', '%'.$this->keywords.'%');
          $q->orWhere('telephone_mobile', 'LIKE', '%'.$this->keywords.'%');
      })
    ->offset($offset)
    ->limit($limit);
    return $data;
  }
  private function __getUserLevelBonus($account)
  {
    $query = $this->db->table('mlm')
    ->select(['mlm.ACCNO', 'lv'])
    ->join('mlm_bonus_settings' , 'mlm_bonus_settings.group_play', '=', 'mlm.group_play', 'LEFT')
    ->where('mlm.ACCNO' , '=', $account)->first();
    return $query;
  }
  public function family_tree($username)
  {
    $this->family_tree = [];
    $data = $this->db->table('mlm')->select(['ACCNO', 'Upline' , 'client_aecode.name' , 'client_accounts.suspend' , 'client_aecode.foto', 'mlm_bonus_settings.amount'])
    ->join('client_accounts', 'mlm.ACCNO', '=' , 'client_accounts.accountname')
    ->join('client_aecode', 'client_accounts.aecodeid' , '=' , 'client_aecode.aecodeid')
    ->join('mlm_bonus_settings', 'mlm_bonus_settings.group_play', '=' , 'mlm.group_play')
    ->where('mlm.ACCNO' , '=' , $username)
    ->get();
    array_push($this->family_tree, $data);
    $userlevel = ($this->__getUserLevelBonus($username)->lv == null) ? 0 : $this->__getUserLevelBonus($username)->lv;
    foreach ($data as $key => $account) {
      $this->family_tree_loop($account->ACCNO, $userlevel);
    }
    $hasil = [];
    foreach($this->family_tree as $key => $tree)
    {
      foreach ($tree as $key2 => $list) {
        $hasil[] = $list;
      }
    }
    $this->family_tree = $hasil;
    return $this;
  }
  public function family_tree_loop($upline, $userlevel = 1 , $level = 1)
  {
    $data = $this->db->table('mlm')->select(['ACCNO', 'Upline' , 'client_aecode.name' , 'client_accounts.suspend' , 'client_aecode.foto', 'mlm_bonus_settings.amount'])
    ->join('client_accounts', 'mlm.ACCNO', '=' , 'client_accounts.accountname')
    ->join('client_aecode', 'client_accounts.aecodeid' , '=' , 'client_aecode.aecodeid')
    ->join('mlm_bonus_settings', 'mlm_bonus_settings.group_play', '=' , 'mlm.group_play')
    ->where('mlm.Upline' , '=' , $upline)
    ->where('client_accounts.suspend' , '=' , FALSE)
    ->get();
    $res = [];
    foreach ($data as $key => $value) {
      $res[$key] = $value;
      $res[$key]->level = $level;
    }
    $data = $res;
    if (count($data) > 0) {
      if($userlevel >= $level):
        array_push($this->family_tree, $data);
        $level = $level + 1;
      endif;
    }
    if($userlevel >= $level):
      foreach ($data as $key => $account) {
        $this->family_tree_loop($account->ACCNO, $userlevel, $level);
      }
    endif;
  }
  public function countRQB($account)
  {
    $notPay = [];
    $mustPay = [];

    foreach($this->family_tree as $key => $row):

      $q = $this->db->table('mlm_rqb_payed')
      ->select('*')
      ->where('account' , '=' , $account)
      ->where('account_downline', '=', $row->ACCNO)
      ->where('is_pay', '=', true);
      if(!$q->get()):
        $mustPay[] = $row;
      else:
        $notPay[] = $row;
      endif;
    endforeach;
    return $this->__countGroupSales($mustPay, $account);
  }
  private function __countGroupSales($accounts, $account)
  {
    $total = 0;
    foreach ($accounts as $key => $value) {
      if($value->ACCNO != $account):
        $total = $total + $value->amount;
        $this->__RQBToDatabase($account, $value);
      endif;
    }
    if(count($accounts) == 1)
                return false;
    if(empty($accounts))
            return false;
    return $this->__getRQBAmount($total);
  }
  private function __getRQBAmount($total)
  {
    $query = $this->db->table('mlm_rqb_settings')
    ->where('amount', '<=', $total)
    ->orderBy('amount', 'DESC')
    ->limit(1)->first();
    if($query == null)
              return 1000 * 3 / 100;
    $amount = $query->amount;
    $ql = $query->ql;
    return $amount * $ql / 100;
  }
  private function __RQBToDatabase($account, $downline)
  {
    $data = [
      'account' => $account,
      'account_downline' => $downline->ACCNO,
      'level' => $downline->level,
      'is_pay' => true,
      'created_at' => date('Y-m-d H:i:s')
    ];
    $this->db->table('mlm_rqb_payed')->insert($data);
  }
}
