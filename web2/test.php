<?php
$email = "tarikh@si.co.id";
$pecah = strtoupper(substr($email, 0,2));
echo ($pecah.rand(10, 1000));
?>