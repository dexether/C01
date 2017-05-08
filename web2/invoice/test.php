<?php
var_dump(realpath('..\images\invoice\160906133.pdf'));
die();
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
$url = "web2/invoice/?type=withdrawal&transaction_id=131";
$response = json_decode(file_get_contents($actual_link.$url));
// file_get_contents('/web2/invoice/?type=withdrawal&transaction_id=131');
?>
