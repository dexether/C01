<?php

define('root', $_SERVER['DOCUMENT_ROOT']);
require root.'/classes/pdo/Database.class.php';
class Sync extends Database
{
    public $status;
    public $email;
    public function get()
    {
        $row = QB::table('my_table')->find(3);
    }
    public function check_duplicate($mt4login)
    {
        $row = QB::table('mlm2')->select(['client_aecode.name', 'client_aecode.email', 'client_accounts.accountname', 'mlm2.mt4login'])
        ->join('client_accounts', 'mlm2.ACCNO', '=', 'client_accounts.accountname')
        ->join('client_aecode', 'client_accounts.aecodeid', '=', 'client_aecode.aecodeid')
        ->where('mt4login', $mt4login);
        if ($row->count() > 0):
          return true;
        else:
          return false;
        endif;
    }
    public function check_email_meta($login, $mt4dt)
    {
        $query = QB::table($mt4dt.'.mt4_users')->select(['LOGIN', 'NAME', 'EMAIL'])
      ->where('LOGIN', '=', $login)
      ->first();
        return $query;
    }
    public function check_if_registered($login, $mt4dt)
    {
        $data_email = $this->check_email_meta($login, $mt4dt);
      // check if this email is registered
      $query = QB::table('user')->select(['username', 'aecode', 'email'])
      ->join('client_aecode', 'user.username', '=', 'client_aecode.aecode')
      ->where('client_aecode.email', '=', $data_email->EMAIL);
        // var_dump($query->getQuery()->getRawSql());
        if ($query->count() > 0):
        return true; else:
        return false;
        endif;
    }
    public function get_sync($login)
    {
        $query = QB::table('mlm2')->select(['client_accounts.accountname', 'mlm2.mt4login', 'client_aecode.email'])
      ->join('client_accounts', 'mlm2.ACCNO', '=', 'client_accounts.accountname')
      ->join('client_aecode', 'client_accounts.aecodeid', '=', 'client_aecode.aecodeid')
      ->where('mt4login', '=', $login);
        if ($query->count() > 0):
        return true; else:
        return false;
        endif;
    }
    public function get_response($login, $mt4dt)
    {
        // Check if email is registered kalo udah terdaftar lanjut
      $data = $this->check_if_registered($login, $mt4dt);

        if (!$data):
        $this->status = 0;
        $this->email = $this->check_email_meta($login, $mt4dt)->EMAIL;
        // print($this->check_email_meta($login, $mt4dt));
        return false;
        // exit();
        endif;
      // Check if LOGIN registeed
      $already_registered = $this->get_sync($login);
      // var_dump($already_registered);
        if (!$already_registered):
        $this->status = 1;
        $this->email = $this->check_email_meta($login, $mt4dt)->EMAIL;

        return false;
        // exit();
        endif;

        if($data == true && $already_registered == true):
          $this->status = 2;
          $this->email = $this->check_email_meta($login, $mt4dt)->EMAIL;
        endif;

        // return 2;
    }
}
