<!-- 

Script Untuk Store Data Into array
 -->

<?php
$i=1;
$store_array= array();
while($i<=5)
  {
  echo $i . "<br>";
  array_push($store_array,$i);
  $i++;
  }
 print_r($store_array);
?>

