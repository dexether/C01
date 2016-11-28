<?php

define('root', $_SERVER['DOCUMENT_ROOT']);
require root.'/classes/pdo/Database.class.php';
class Mlm extends Database
{
    public function get_account()
    {
        $query = QB::table('client_accounts')->select(['client_aecode.name', 'client_accounts.accountname'])
    ->join('client_aecode', 'client_accounts.aecodeid', '=', 'client_aecode.aecodeid')
    ->where('client_aecode.status', '=', true)
    ->orderBy('client_aecode.name', 'ASC');

        return $query->get();
    }
    public function register_account($target_array)
    {
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
          'userid' => $target_array['userid'],
          'name' => $target_array['email'],
          'groupid' => 1,
        ];
        $insertId = QB::table('client_aecode')->insert($target_array);
        return $insertId;
    }
}
