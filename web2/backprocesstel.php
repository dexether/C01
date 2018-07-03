<?php
// http://cabinet.dev/web2/backprocess.php?getsend=yes&debugging=5

include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/mail/PHPMailerAutoload.php";

$waktucheck1 = date('y-m-d', strtotime('-1 hour'));
$waktucheck2 = date('H:i:s', strtotime('-1 hour'));
$thetime = "Date :" . $waktucheck1 . " Time : " . $waktucheck2;
echo $thetime;
//tradeLog("Send_email:" . $thetime);

echo "<br>";
$debugging = $_GET['debugging'];
if ($_GET['getsend'] == 'yes') {
    if ($debugging > 2) {
        echo "Copy phone number<br>";
    }
    $query = "SELECT telephone_home,aecode FROM client_aecode WHERE datalength(telephone_mobile)=0";
    $result = $DB->execresultset($query);
    foreach($result as $row) {
        $phone = $row[telephone_home];
		$aecode = $row[aecode];
		$query = "UPDATE client_aecode SET telephone_mobile = '$phone' WHERE aecode = '$aecode'";
		$DB->execonly($query);	
    }
    if ($debugging > 2) {
        echo "Copy phone number<br>";
    }
}
function logss($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
?>
