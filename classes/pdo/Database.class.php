<?php
// define('root', $_SERVER['DOCUMENT_ROOT']);
require root.'/vendor/autoload.php';

class Database
{
    public $error_msg;
    public function __construct()
    {
        require root.'/_settings/config.php';
        $config = array(
                'driver' => 'mysql', // Db driver
                'host' => $mysql['host'],
                'database' => $mysql['database'],
                'username' => 'root',
                'password' => 'mugen1996',
                'charset' => 'utf8', // Optional
                'collation' => 'utf8_unicode_ci', // Optional
                'prefix' => '', // Table prefix, optional
                'options' => array( // PDO constructor options, optional
                    PDO::ATTR_TIMEOUT => 5,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ),
            );
        new \Pixie\Connection('mysql', $config, 'QB');
    }
    public function error()
    {
      return $this->error_msg;
    }

}
