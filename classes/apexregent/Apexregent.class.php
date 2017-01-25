<?php

define('root', $_SERVER['DOCUMENT_ROOT']);
require_once root.'/classes/pdo/Database.class.php';
class Apexregent extends Database
{
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
}
