<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

/**
 *
 * ini progra
 * 
 */



$name;
if (isset($_GET['name'])) {
    $name = $_GET['name'];
}
$email;
if (isset($_GET['email'])) {
    $email = $_GET['email'];
}
$companyname;
if (isset($_GET['companyname'])) {
    $companyname = $_GET['companyname'];
}
$accno;
if (isset($_GET['accno'])) {
    $accno = $_GET['accno'];
}
$bmnya;
if (isset($_GET['bmnya'])) {
    $bmnya = $_GET['bmnya'];
}
$subject;
if (isset($_GET['subject'])) {
    $subject = $_GET['subject'];
}
$department;
if (isset($_GET['department'])) {
    $department = $_GET['department'];
}
$date;
if (isset($_GET['date'])) {
    $date = $_GET['date'];
}
$time;
if (isset($_GET['time'])) {
    $time = $_GET['time'];
}
$detail;
if (isset($_GET['detail'])) {
    $detail = $_GET['detail'];
}
$module;
if (isset($_GET['module'])) {
    $module = $_GET['module'];
}
$product;
if (isset($_GET['product'])) {
    $product = $_GET['product'];
}

$afiliasi;
if (isset($_GET['afiliasi'])) {
    $afiliasi = $_GET['afiliasi'];
}

$types;
if (isset($_GET['types'])) {
    $types = $_GET['types'];
}
$datetime = date('Y-m-d H:i:s');


if($module=="mlm") {

    
    $query ="insert into email set
    timeupdate = '".date('Y-m-d h:i:s')."',
    email_to = 'fyunus70@gmail.com',
    email_subject = '".$subject."',
    email_body = '<p><br>
  Dear  Admin Cabinet Agrodana,<br> <br>
  ".$name." submitting a problem about the MLM program , and details about our problems :</p>
<table width=615>
  <tr>
    <td width=129>Name</td>
    <td width=10>:</td>
    <td width=460>".$name."</td>
  </tr>
  <tr>
    <td>Email</td>
    <td>:</td>
    <td>".$email."</td>
  </tr>
  <tr>
    <td>Accoun Nomor</td>
    <td>:</td>
    <td>".$accno."</td>
  </tr>
  <tr>
    <td>Subject</td>
    <td>:</td>
    <td>".$subject."</td>
  </tr>
  <tr>
    <td>Issue type</td>
    <td>:</td>
    <td>".$types."</td>
  </tr>
  <tr>
    <td>Investigation date</td>
    <td>:</td>
    <td>".$datetime."</td>
  </tr>
  <tr>
    <td>Detail of issue</td>
    <td>:</td>
    <td align=justify>".$detail."</td> 
  </tr>
</table>
<p><span align=justify> </span>Please reply ".$types." as soon as possible.<br> 
  <br>Thank you,<br><br>
  <strong>Cabinet Management System</strong><br> HotLine : +62-21-2954-3737<br> Fax : +62-21-2954-3777 <br> Email : admin@si.co.id <br> http://cabinet.si.co.id <br>
</p>
',
    module = '".$module."'
    
    ";
    $do = $DB->execonly($query);
	
	$query ="insert into email set
    timeupdate = '".date('Y-m-d h:i:s')."',
    email_to = '".$bmnya."',
    email_subject = '".$subject."',
    email_body = '<p><br>
  Dear  Admin Cabinet Agrodana,<br> <br>
  ".$name." submitting a problem about the MLM program , and details about our problems :</p>
<table width=615>
  <tr>
    <td width=129>Name</td>
    <td width=10>:</td>
    <td width=460>".$name."</td>
  </tr>
  <tr>
    <td>Email</td>
    <td>:</td>
    <td>".$email."</td>
  </tr>
  <tr>
    <td>Accoun Nomor</td>
    <td>:</td>
    <td>".$accno."</td>
  </tr>
  <tr>
    <td>Subject</td>
    <td>:</td>
    <td>".$subject."</td>
  </tr>
  <tr>
    <td>Issue type</td>
    <td>:</td>
    <td>".$types."</td>
  </tr>
  <tr>
    <td>Investigation date</td>
    <td>:</td>
    <td>".$datetime."</td>
  </tr>
  <tr>
    <td>Detail of issue</td>
    <td>:</td>
    <td align=justify>".$detail."</td> 
  </tr>
</table>
<p><span align=justify> </span>Please reply ".$types." as soon as possible.<br> 
  <br>Thank you,<br><br>
  <strong>Cabinet Management System</strong><br> HotLine : +62-21-2954-3737<br> Fax : +62-21-2954-3777 <br> Email : admin@si.co.id <br> http://cabinet.si.co.id <br>
</p>
',
    module = '".$module."'
    
    ";
    $do = $DB->execonly($query);
	
    echo 0;
}


//tradeLogReportTurnOverRunning("Report TurnOver Running2-65:".$query);

/*
function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}*/


?>