<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

/**
 *
 * ini progra
 * 
 */


$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
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


if ($module=="wallet") {
   
  $query ="insert into email set
    timeupdate = '".date('Y-m-d h:i:s')."',
    email_to = '".$email."',
    email_subject = '".$subject."',
    email_body = '<p><br>
  Dear  ".$name.",<br> <br>
  Thankyou for sending an issue about Wallet program, following details about your issue :</p>
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
    <td>Subject</td>
    <td>:</td>
    <td>".$subject."</td>
  </tr>
  <tr>
    <td>Sending this issue to</td>
    <td>:</td>
    <td>".$department."</td>
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
<p><span align=justify> </span>We will reply to your complaint as soon as possible.<br> 
  <br>Thank you,<br><br>
  <strong>".$companys['progamname']."</strong><br> ".$companys['long_address']." <br> Email : ".$companys['email']." <br> ".$companys['companyurl']." <br>
</p>
',
    module = '".$module."'
    
    ";
    $do = $DB->execonly($query);
    echo "0";


}elseif($module=="education") {

    
    $query ="insert into email set
    timeupdate = '".date('Y-m-d h:i:s')."',
    email_to = '".$email."',
    email_subject = '".$subject."',
    email_body = '<p><br>
  Dear  ".$name.",<br> <br>
  Thankyou for sending an issue about Education program, following details about your issue :</p>
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
    <td>Subject</td>
    <td>:</td>
    <td>".$subject."</td>
  </tr>
  <tr>
    <td>Product to report</td>
    <td>:</td>
    <td>".$product."</td>
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
<p><span align=justify> </span>We will reply to your complaint as soon as possible.<br> 
  <br>Thank you,<br><br>
  <strong>".$companys['progamname']."</strong><br> ".$companys['long_address']." <br> Email : ".$companys['email']." <br> ".$companys['companyurl']." <br>
</p>
',
    module = '".$module."'
    
    ";
    $do = $DB->execonly($query);
    echo "0";

}elseif($module=="mlm") {

    
    $query ="insert into email set
    timeupdate = '".date('Y-m-d h:i:s')."',
    email_to = '".$email."',
    email_subject = '".$subject."',
    email_body = '<p><br>
  Dear  ".$name.",<br> <br>
  Thankyou for sending an issue about Mlm program, following details about your issue :</p>
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
<p><span align=justify> </span>We will reply to your complaint as soon as possible.<br> 
  <br>Thank you,<br><br>
  <strong>".$companys['progamname']."</strong><br> ".$companys['long_address']." <br> Email : ".$companys['email']." <br> ".$companys['companyurl']." <br>
</p>
',
    module = '".$module."'
    
    ";
    $do = $DB->execonly($query);
    echo "0";


}elseif($module=="trado") {

     
    $query ="insert into email set
    timeupdate = '".date('Y-m-d h:i:s')."',
    email_to = '".$email."',
    email_subject = '".$subject."',
    email_body = '<p><br>
  Dear  ".$name.",<br> <br>
  Thankyou for sending an issue about Trado program, following details about your issue :</p>
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
    <td>Account </td>
    <td>:</td>
    <td>".$accno."</td>
  </tr>
  <tr>
    <td>Company Name</td>
    <td>:</td>
    <td>".$companyname."</td>
  </tr>
  <tr>
    <td>Subject</td>
    <td>:</td>
    <td>".$subject."</td>
  </tr>
  <tr>
    <td>Department type</td>
    <td>:</td>
    <td>".$department."</td>
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
<p><span align=justify> </span>We will reply to your complaint as soon as possible.<br> 
  <br>Thank you,<br><br>
  <strong>".$companys['progamname']."</strong><br> ".$companys['long_address']." <br> Email : ".$companys['email']." <br> ".$companys['companyurl']." <br>
</p>
',
    module = '".$module."'
    
    ";
    $do = $DB->execonly($query);
    if ($do > 0) {
        echo "0 - Trado Success";
    }else{
        echo "1 - Trado Success";
    }

}elseif($module=="apex") {

     
    $query ="insert into email set
    timeupdate = '".date('Y-m-d h:i:s')."',
    email_to = '".$_POST['email']."',
    email_subject = '".$_POST['subject']."',
    email_body = '<p><br>
  Dear  ".$_POST['name2'].",<br> <br>
  Thankyou for sending an issue about Apex program, following details about your issue :</p>
<table width=615>
  <tr>
    <td width=129>Name</td>
    <td width=10>:</td>
    <td width=460>".$_POST['name2']."</td>
  </tr>
  <tr>
    <td>Email</td>
    <td>:</td>
    <td>".$_POST['email']."</td>
  </tr>
  <tr>
    <td>Account </td>
    <td>:</td>
    <td>".$_POST['accno']."</td>
  </tr>
  <tr>
    <td>Subject</td>
    <td>:</td>
    <td>".$_POST['subject']."</td>
  </tr>
  <tr>
    <td>Department type</td>
    <td>:</td>
    <td>".$_POST['department']."</td>
  </tr>
  <tr>
    <td>Investigation date</td>
    <td>:</td>
    <td>".$datetime."</td>
  </tr>
  <tr>
    <td>Detail of issue</td>
    <td>:</td>
    <td align=justify>".$_POST['detail']."</td> 
  </tr>
</table>
<p><span align=justify> </span>We will reply to your complaint as soon as possible.<br> 
  <br>Thank you,<br><br>
  <strong>".$companys['programname']."</strong><br> ".$companys['long_address']." <br> Email : ".$companys['email']." <br> ".$companys['companyurl']." <br>
</p>
',
    module = '".$module."'
    
    ";
    $do = $DB->execonly($query);
    if ($do > 0) {
        echo "0 - Apex Success";
    }else{
        echo "1 - Apex Success";
    }

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