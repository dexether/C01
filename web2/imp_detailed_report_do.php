<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
include_once "includes/wr_tools.php";
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

if (isset($user)) {
   $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
   $postmode = $_GET['postmode'];
}
$anonydata = array();
$bulan         = @$_POST['bulan'];
$tahun         = @$_POST['tahun'];
$agen          = @$_POST['keanggotaan'];
$rolldate      = @$_POST['rolldate'];
$account       = @$_POST['account'];
$periode_start = date('Y-m-01 23:00:01', strtotime($tahun . "-" . $bulan));
$periode_start = date('Y-m-d', (strtotime('-1 day', strtotime($periode_start))));
$periode_end   = date('Y-m-t 23:00:00', strtotime($tahun . "-" . $bulan));
if ($postmode == "show") {
   $date = $tahun . '-' . $bulan;
   // print_r($_POST);
   if (empty($agen)) {
      $filter_agen = "";
   } else {
      if ($agen == 'true') {
         $filter_agen = "AND client_accounts.`typeaccount` = 'agent'";
      } else {
         $filter_agen = "AND client_accounts.`typeaccount` != 'agent'";
      }
   }
   if (isset($tahun)) {
      $filter_date = " AND LEFT(mlm_comm.rolldate, 7) = '$date'";
   }
   $query = "SELECT
  mlm_comm.`ACCNO`,
  mlm_comm.`lot`,
  mlm_comm.`amount`,
  client_aecode.`name`,
  mlm_comm.`from`,
  (SELECT
    client_aecode.`name`
  FROM
    client_accounts,
    client_aecode
  WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
    AND client_accounts.`accountname` = mlm_comm.`from`) AS nama2,
  client_accounts.`typeaccount`
FROM
  mlm_comm,
  client_accounts,
  client_aecode
WHERE 1=1
$filter_agen
$filter_date
AND mlm_comm.`ACCNO` = client_accounts.`accountname`
  AND client_accounts.`aecodeid` = client_aecode.`aecodeid`
  AND mlm_comm.type = 'royal'";
   // print_r($query);
   tradelogs("query-47 :".$query);
   $result = $DB->execresultset($query);

   // Cek databases
   $query = "SELECT
  mt4dt,
  alias
FROM
  mt_database
WHERE mt_database.`alias` LIKE '%royal%'
  AND enabled = 'yes' ";
  tradelogs("query-76 :".$query);
   $hasil = $DB->execresultset($query);
   foreach ($hasil as $key => $value) {
      $meta  = $value['mt4dt'];
      // $query = "SELECT
      //           " . $meta . ".`mt4_trades`.`LOGIN`,
      //           " . $meta . ".`mt4_users`.`NAME`,
      //           (SUM(VOLUME) / 100) AS lots
      //         FROM
      //           " . $meta . ".`mt4_trades`,
      //            " . $meta . ".`mt4_users`
      //         WHERE " . $meta . ".`mt4_trades`.`LOGIN` = " . $meta . ".`mt4_users`.`LOGIN`
      //         AND CMD IN ('1', '0')
      //         AND " . $meta . ".`mt4_trades`.`LOGIN` NOT IN
      //           (SELECT
      //             mt4login
      //           FROM
      //             mlm2)
      //           AND " . $meta . ".`mt4_trades`.`CLOSE_TIME` BETWEEN '$periode_start'
      //           AND '$periode_end'
      //         GROUP BY " . $meta . ".`mt4_trades`.`LOGIN`";
              $query = "SELECT
                        " . $meta . ".`mt4_users`.`LOGIN`,
                        " . $meta . ".`mt4_users`.`NAME`
                      FROM
                        " . $meta . ".`mt4_users`
                      WHERE " . $meta . ".`mt4_users`.`LOGIN` NOT IN
                        (SELECT
                          mt4login
                        FROM
                          mlm2)
                      GROUP BY " . $meta . ".`mt4_users`.`LOGIN`";
					  tradelogs("query-104 :".$query);
      $result3   = $DB->execresultset($query);
      // $anonydata = array();

      foreach ($result3 as $key => $row) {
            $lot_amount = 500000;

         //Checkin for lots
         $query_lot = "SELECT
                   " . $meta . ".`mt4_trades`.`LOGIN`,
                   " . $meta . ".`mt4_users`.`NAME`,
                   (SUM(VOLUME) / 100) AS lots
                 FROM
                   " . $meta . ".`mt4_trades`,
                    " . $meta . ".`mt4_users`
                 WHERE " . $meta . ".`mt4_trades`.`LOGIN` = " . $meta . ".`mt4_users`.`LOGIN`
                 AND CMD IN ('1', '0')
                 AND " . $meta . ".`mt4_trades`.`LOGIN` = '$row[LOGIN]'
                   AND " . $meta . ".`mt4_trades`.`CLOSE_TIME` BETWEEN '$periode_start'
                   AND '$periode_end'
                 GROUP BY " . $meta . ".`mt4_trades`.`LOGIN`";
		 tradelogs("query-123 :".$query_lot);
         $result_lot = $DB->execresultset($query_lot);
         $lot_value = 0;
         foreach ($result_lot as $lot_key => $lot_val) {
           $lot_value = $lot_val['lots'];
         }
         $anonydata[$value['mt4dt']][$key]               = $row;
         $anonydata[$value['mt4dt']][$key]['aliases']    = $value['alias'];
         $anonydata[$value['mt4dt']][$key]['lots']       = $lot_value;
         $anonydata[$value['mt4dt']][$key]['lot_amount'] = $lot_amount;
         $anonydata[$value['mt4dt']][$key]['periode']    = date_format(date_create($periode_start), 'd, M') . " s/d " . date_format(date_create($periode_end), 'd, M') . " " . $tahun;
         // TradeLogUnderConstruct_Secure($value['mt4dt']. " : " . $key);
      }
   }

   $query = "SELECT
  mlm_comm.`ACCNO`,
  client_aecode.`name`,
  client_accounts.`typeaccount`,
  SUM(amount) AS subtotal
FROM
  mlm_comm,
  client_accounts,
  client_aecode
WHERE 1=1
$filter_agen
$filter_date
AND mlm_comm.`ACCNO` = client_accounts.`accountname`
  AND client_accounts.`aecodeid` = client_aecode.`aecodeid`
  AND mlm_comm.type = 'royal'
GROUP BY mlm_comm.`ACCNO` ";
tradelogs("query-151 :".$query);
   $result2                = $DB->execresultset($query);
   $response['detailed']   = $result;
   $response['quick']      = $result2;
   $response['anonymouse'] = $anonydata;

   echo json_encode($response);
} elseif ($postmode == "client") {
   if (empty($account)) {
      $filter_account = "";
   } else {
      $filter_account = "AND mlm_comm.ACCNO = '$account'";
   }

   $query = "SELECT
  mlm_comm.`ACCNO`,
  mlm_comm.`lot`,
  mlm_comm.`amount`,
  mlm_comm.`level`,
  client_aecode.`name`,
  mlm_comm.`from`,
  (SELECT
    client_aecode.`name`
  FROM
    client_accounts,
    client_aecode
  WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
    AND client_accounts.`accountname` = mlm_comm.`from`) AS nama2,
  client_accounts.`typeaccount`
FROM
  mlm_comm,
  client_accounts,
  client_aecode
WHERE 1=1
$filter_account
AND mlm_comm.`ACCNO` = client_accounts.`accountname`
AND client_aecode.aecode = '$user->username'
AND mlm_comm.`rolldate` = '$rolldate'
  AND client_accounts.`aecodeid` = client_aecode.`aecodeid` ";
   // print_r($query);
   $result = $DB->execresultset($query);

   $query = "SELECT
  mlm_comm.`ACCNO`,
  (mlm.`Upline`) AS typenya,
  client_aecode.`name`,
  (SUM(mlm_comm.`amount`)) AS subtotal,
  mt_database.`alias`
FROM
  mlm_comm,
  mlm,
  client_accounts,
  client_aecode,
  mt_database
WHERE 1 = 1
  $filter_account
  AND client_aecode.`aecode` = '$user->username'
  AND mlm_comm.`rolldate` = '$rolldate'
  AND mlm_comm.`ACCNO` = mlm.`ACCNO`
  AND mlm.`ACCNO` = client_accounts.`accountname`
  AND client_accounts.`aecodeid` = client_aecode.`aecodeid`
  AND mlm.`mt4dt` = mt_database.`mt4dt`
  GROUP BY mlm_comm.`ACCNO`";
   $result2              = $DB->execresultset($query);
   $response['detailed'] = $result;
   $response['quick']    = $result2;
   echo json_encode($response);
}

function myfilter($input_var_outer, $param)
{
   global $var_to_pass;
   $var_to_pass = $param;

   function mycallback($input_var_inner)
   {
      global $var_to_pass;
      return ($input_var_inner == $var_to_pass) ? true : false;
   }

   $return_arr = array_filter($input_var_outer, 'mycallback');
   $return_arr = array_merge(array(), $return_arr);
   return $return_arr;
}

function TradeLogs($msg)
{
   $fp      = fopen("trader.log", "a");
   $logdate = date("Y-m-d H:i:s => ");
   $msg     = preg_replace("/\s+/", " ", $msg);
   fwrite($fp, $logdate . $msg . "\n");
   fclose($fp);
   return;
}
