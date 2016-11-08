<?php

define('root', $_SERVER['DOCUMENT_ROOT']);
// // Load composer
require root.'/vendor/autoload.php';
require root.'/_settings/config.php';
var_dump($mysql);
// Create a connection, once only.
$config = array(
            'driver' => 'mysql', // Db driver
            'host' => $mysql['host'],
            'database' => $mysql['database'],
            'username' => $mysql['username'],
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
