<?php

require '../classes/metatrader/sync.class.php';
$sync = new Sync();
var_dump($sync->check_duplicate(88002850));
