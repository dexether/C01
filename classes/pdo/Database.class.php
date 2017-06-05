<?php
// define('root', $_SERVER['DOCUMENT_ROOT']);
require_once root.'/application/vendor/autoload.php';

class Database
{
    public $error_msg;
    public $db;
    public function __construct()
    {
        require root.'/_settings/config.php';
        $config = array(
                'driver' => 'mysql', // Db driver
                'host' => $mysql['host'],
                'database' => $mysql['database'],
                'username' => $mysql['user'],
                'password' => $mysql['password'],
                'charset' => 'utf8', // Optional
                'collation' => 'utf8_unicode_ci', // Optional
                'prefix' => '', // Table prefix, optional
                'options' => array( // PDO constructor options, optional
                    PDO::ATTR_TIMEOUT => 5,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ),
            );
        new \Pixie\Connection('mysql', $config, 'QB');
        $connection = new \Pixie\Connection('mysql', $config);
        $this->db =  new \Pixie\QueryBuilder\QueryBuilderHandler($connection);
    }
    public function error()
    {
      return $this->error_msg;
    }

}
