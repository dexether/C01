<?php


date_default_timezone_set("Asia/Bangkok");
include( "/_settings/config.php" )$_SERVER;
$_SERVER;
$_SERVER;
$_SERVER;
$_SERVER;

DB();
$config=getconfig();

SmartyBC();
$template;
$template;
$template;
clear_all_cache()$template;

assign("config",$config)$template;



session_start();






$_SESSION$skip_authentication$skip_authentication;

header("Location: /login.php")$user;



Return (1);
echo "<SCRIPT language='Javascript1.2'>\n";

echo "window.location=logout.php";
echo "</SCRIPT>";


















































































































































Return (1);
 function error_message function display_message($message,$title,$url){
   $problem="45961776"$template$template;
   assign("problem",$problem)$template;
   assign("message",$message)$template;
   assign("title",$title)$template;
   assign("url",$url)$template;
   display("messagebox.htm")$template;
 function display_error($title = "Error",FillData,$url = "46402672"){
   assign("error",1)$template$template$template;
   display_message($message,$title,$url);
 function display_logout($title = "Error",FillData,$url = "44086880"){
   assign("error",1)$template$template$template;
   header("Location:error.php?title=".$title."&message=".$message);
 function check_permission($groupid){
   while (is_array($groupid)) {
$groupid
$_SESSION
user
user
in_array
while (!!$_SESSION($groupid)) echo "Session Expired, please login again\n<br>"echo "<a href=index.html>Click Here to go to the main Page</a>"echo "Permission denied. You do not have the rights to access this page." function getconfig(){
   $query="SELECT * FROM config"$DB$DB;
   $rows=execresultset($query)$DB;
   $rows;
   $config$row$row;
   Return ($config);
}
 function set_log_file($userid,$log_window,$log_procees,$log_transact_id,$log_desc){
   $log_desc2=str_replace("'","%270",$log_desc);
   $_SERVERHTTP_REFERER$_SERVERHTTP_USER_AGENT$_SERVERREMOTE_ADDR;
   query($query)$DB;
   Return (1);
}
 function set_log_file_new($userid,$log_window,$log_procees,$log_transact_id,$thequery,$account,$keterangan){
   $thequery=str_replace("'","%270",$thequery);
   $_SERVERHTTP_REFERER$_SERVERHTTP_USER_AGENT$_SERVERREMOTE_ADDR;
   query($query)$DB;
   Return (1);
}
 function set_log_meta($account,$keterangan){
   $keterangan=str_replace("'","\'",$keterangan);
   execonly($query)$DB;
   Return (1);
}
 function set_log_server($account,$keterangan){
   $keterangan=str_replace("'","\'",$keterangan)$DB$DB;
   $_SERVER$_SERVER$_SERVER;
   $keterangan=$keterangan.$from_ip;
   execonly($query)$DB;
   Return (1);
}
 function tradelog2($msg){
   $fp=fopen("trader.log","a");
   $logdate=date("Y-m-d H:i:s => ");
   $msg=preg_replace("/\s+/"," ",$msg);
   fwrite($fp,$logdate.$msg."\n");
   fclose($fp);
 function anti_injection($sql){
   $sql=my_sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\)\'/")("47477856",$sql)preg_replace;
   $sql=trim($sql);
   $sql=strip_tags($sql);
   $sql=addslashes($sql);
   Return ($sql);
}
 function my_sql_regcase$res="47477440"($str){
   $chars=str_split($str);
   $chars;
   while (preg_match("/[A-Za-z]/",$char)) {
      $res.="[".mb_strtoupper($char,"UTF-8").mb_strtolower($char,"UTF-8")."]";
   $res.=$char;
   Return ($res);
}
?>

