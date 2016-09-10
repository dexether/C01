<?php


$query_kotanya = null;
$thegroups_array = null;
if(isset($_POST['rates'])) {
	$thegroups_array = $_POST['rates'];
}

$query_groupnya = null;
for ($i_group = 0; $i_group < count($thegroups_array); $i_group++) {
    $query_groupnya = $query_groupnya . ",'" . $thegroups_array[$i_group] . "'";
}
$query_group = " acc_kota.rate in (''" . $query_groupnya . ")";
$query_meta_group = " Login in (''" . $query_groupnya . ")";

$accounts = array();
$query = "SELECT acc_kota.* 
            FROM acc_kota
            WHERE 1=1 AND $query_group $query_meta_group
            ORDER BY acc_kota.login ASC
            ";
/*$array_rate = array();
$query_rate_array = $DB->execresultset($query_rate);
foreach ($query_rate_array as $row_rate) {
	$array_rate[] = $row_rate['rate'];
}*/
echo "<pre>";
print_r($query);
echo "<pre>";
?>