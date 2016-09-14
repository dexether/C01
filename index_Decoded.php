<?php

session_start();
$skip_authentication=1;


$ua=$_SERVER()strtolower;
$ac=$_SERVER()strtolower;
$_SERVER;
$_SERVER;
$httphost=strtolower($httphost);





$checkarisan=substr($httphost,3,10);
echo $checkarisan;
$_SESSION;


echo "<meta http-equiv = "refresh" content = "0;url=web2/index.php">\n";









Return (1);
 function tradelog($msg){
   $fp=fopen("trader.log","a");
   $logdate=date("Y-m-d H:i:s => ");
   $msg=preg_replace("/\s+/"," ",$msg);
   fwrite($fp,$logdate.$msg."\n");
   fclose($fp);
?>

