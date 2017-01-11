<?php
require_once dirname(__FILE__) . '../../classes/metatrader/ManagerApi.class.php';
$manager = new ManagerApi('180.210.201.221:443', '7' , 'aqua123');
var_dump($manager->deposit('275297', 10000.00 , 'Deposit Awal'));
echo $manager->display_error();
// echo $manager->login();
