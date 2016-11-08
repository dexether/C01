<?php

define('root', $_SERVER['DOCUMENT_ROOT']);
require root.'/classes/pdo/Database.class.php';
class Sync extends Database
{
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
        if($row->count() > 1):
          return true;
        else:
          return false;
        endif;
    }
}
