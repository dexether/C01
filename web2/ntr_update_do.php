<?php

// For Connection
include_once ("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

// Get Param

$update = "no";
if (isset($_GET['update'])) {
    $update = $_GET['update'];
}
// tradeLogNtr('ntr_update_do:line-14');
$metas = "no";
if (isset($_GET['metas'])) {
    $metas = $_GET['metas'];
}

if ($update == 'yes')
{
      # code...

    // Ambil Data Dimana NTR BLUM Terisi
    $array_all = array();
    $get_data = "SELECT LOGIN, PROFIT, DEPOSIT, PROFIT_CLOSED, TIME, LEFT(TIME, 10) AS TIME2 FROM $metas.mt4_daily WHERE STAT_NTR = '0' ORDER BY LOGIN ASC LIMIT 0,500";
    // tradeLogNtr('ntr_update_do:line-27');
    $get_data_array = $DB->execresultset($get_data);
    foreach ($get_data_array as $row)
    {
      // tradeLogNtr('ntr_update_do:line-31');
      $array_all[] = $row;
    }
if (count($array_all) > 0)
 {
    $array_prev = array();
    foreach ($array_all as $row)
    {
      $LOGIN = $row ['LOGIN'];
      $DEPOSIT = $row ['DEPOSIT'];
      $PROFIT = $row ['PROFIT'];
      $PROFIT_CLOSED = $row ['PROFIT_CLOSED'];
      $NOW_TIMES = $row ['TIME2'];
      $PREV_TIME = '0000-00-00';
      $PREV_PROFIT = 0;

      
      $get_prev = "SELECT * FROM $metas.mt4_daily WHERE LOGIN = '$LOGIN' AND LEFT(TIME, 10) < '$NOW_TIMES' ORDER BY TIME DESC LIMIT 0,1";
      // tradeLogNtr('ntr_update_do:line-46');
      $get_prev_array = $DB->execresultset($get_prev);
       foreach ($get_prev_array as $key)
       {
         $array_prev[] = $key;
         $PREV_TIME = $key['TIME'];
         $PREV_PROFIT = $key['PROFIT'];
       }

          $updates[] = array(
            'LOGIN' => $LOGIN,
            'TIME' => $NOW_TIMES,
            'PREV_TIME' => $PREV_TIME,
            'PROFIT' => $PROFIT,
            'PREV_PROFIT' => $PREV_PROFIT,
            'DEPOSIT' => $DEPOSIT,
            'PROFIT_CLOSED' => $PROFIT_CLOSED,
            'NTR' => $DEPOSIT + $PROFIT_CLOSED + $PROFIT - $PREV_PROFIT

            );
        

     }
   }else{
    echo "2"; // Jika NTR Sudah Terupdate
   }
     foreach ($updates as $u) {
        $q = "UPDATE ".$metas.".mt4_daily SET NTR = '" . $u['NTR'] . "', PREV_PROFIT = '" . $u['PREV_PROFIT'] . "', STAT_NTR = '1' WHERE LOGIN = '".$u['LOGIN']."' AND LEFT(TIME, 10) = '".$u['TIME']."' ";
        // tradeLogNtr('ntr_update_do:line-73');
        $state = $DB->execonly($q);


        // echo "UPDATE ".$metas.".mt4_daily SET NTR = '" . $u ['NTR'] . "', PREV_PROFIT = '" . $u ['PREV_PROFIT'] . "', STAT_NTR = '1' WHERE LOGIN = '".$u['LOGIN']."' AND LEFT(TIME, 10) = '".$u['TIME']."'"."<br>";
     }

   

}
if ($state >= 1) {
  echo "0"; // Berhasil
}

/*function tradeLogNtr($msg)
{
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}*/

 ?>