<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
global $DB;
/* This is just a dummy file for generating example JSON. */

/* Emulate slow queries when asked. */
if (isset($_GET["sleep"])) {
   sleep(1);
}
$postmode = @$_GET['postmode'];
$users    = @$_GET['users'];
$memberid = @$_GET['memberid'];
$ib       = @$_GET['ib'];
header("Access-Control-Allow-Origin: *");

$response = array();
$party    = "";
if (isset($_GET['party'])) {
   $party = $_GET['party'];
}
if ($postmode == 'cekib') {
   $query  = "SELECT alias, mt4dt FROM mt_database WHERE enabled = 'yes' AND type = '$party'";
   $result = $DB->execresultset($query);
   if (empty($result)) {
      $response[""] = "-- Select IB --";
   } else {
      $response[0] = "-- Select IB --";
   }
   foreach ($result as $row) {
      $response[$row['mt4dt']] = $row['alias'];
   }

} else if ($postmode == 'cekid') {
   $query  = "SELECT client_accounts.`accountname` FROM client_accounts WHERE   client_accounts.`aecodeid` = '$users'";
   $result = $DB->execresultset($query);
   if (empty($result)) {
      $response[""] = "-- Select Cabinet ID --";
   } else {
      $response[0] = "-- Select Cabinet ID --";
   }
   foreach ($result as $row) {
      $response[$row['accountname']] = $row['accountname'];
   }

} else if ($postmode == 'meta') {
   if ($ib == '0') {
      $response["0"] = "-";
   } else {
      $response["0"] = "-";
      $query         = "SELECT LOGIN FROM " . $ib . ".mt4_users";
      $result        = $DB->execresultset($query);
      if (empty($result)) {
         $response[""] = "-- Select LOGIN --";
      } else {
         $response[""] = "-- Select LOGIN --";
      }
      foreach ($result as $row) {
         $response[$row['LOGIN']] = $row['LOGIN'];
      }

   }

} else if ($postmode == 'list') {
   $query    = "SELECT mlm2.id, mt_database.alias, mlm2.mt4login FROM mlm2, mt_database WHERE mlm2.mt4dt = mt_database.mt4dt AND ACCNO = '$memberid'";
   $result   = $DB->execresultset($query);
   $response = $result;
} else if ($postmode == 'checkaccounts') {
   $cabinetid = $_GET['cabinetid'];
   $query    = "SELECT 
  Upline,
  (SELECT 
    client_aecode.`name` 
  FROM
    client_accounts,
    client_aecode 
  WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid` 
    AND accountname = Upline) AS Namanya
FROM
  mlm,
  client_accounts,
  client_aecode 
WHERE mlm.ACCNO = client_accounts.accountname 
  AND client_accounts.aecodeid = client_aecode.aecodeid
  AND client_accounts.accountname = '$cabinetid'";
   $result   = $DB->execresultset($query);
   $response = $result;
   foreach ($result as $key => $value) {
      $response['upline'] = $value['Namanya']. " (" .$value['Upline'].")";
   }
}
// ksort($response);
print json_encode($response);
?>

<?php
function tradeLog($msg)
{
   $fp      = fopen("trader.log", "a");
   $logdate = date("Y-m-d H:i:s => ");
   $msg     = preg_replace("/\s+/", " ", $msg);
   fwrite($fp, $logdate . $msg . "\n");
   fclose($fp);
   return;
}
?>