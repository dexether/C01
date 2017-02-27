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
}
