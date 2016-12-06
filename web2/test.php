<?php
require_once dirname(__FILE__) . '/../classes/mlm/Mlm.class.php';
$mlm = new Mlm();
var_dump($mlm->create_account(0));
