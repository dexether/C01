<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require_once "$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php";
include_once "includes/wr_tools.php";
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;
global $tipe;
$security = new \security\CSRF;
$error    = "success";
$subject  = "Oops, Something has happened";
$msg      = "Try refresing the web page";
$progress = 0;
/*
if (isset($user)) {
$user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);
 */
$postmode     = @($_GET['postmode']);
$token        = @$_POST['token'];
$periode      = @$_POST['periode'];
$periode_date = substr($periode, 0, 10);
$replace      = "off";
tradeLogs("postmode :".$postmode);
if (isset($_POST['replace'])) {
    # code...
    $replace = $_POST['replace'];
}
$query  = "SELECT value FROM config WHERE name = 'pt'";
$result = $DB->execresultset($query);
foreach ($result as $row) {
 $tipe = $row['value'];
}
/*==============================
=            Coding            =
==============================*/

if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
            // print_r('Succes');
		if ($postmode == 'hitung') {
                tradeLogs($postmode. "HITUNG");
                // Check it first
                $query  = "SELECT ACCNO FROM mlm_comm WHERE rolldate = '$periode_date' AND type = '$tipe' LIMIT 0,1 ";
				tradeLogs("query-53 :".$query);
                $result = $DB->execresultset($query);
                if (!count($result) > 0 && $replace == 'off') {
                    $query = "SELECT
                    mlm.`ACCNO`,
                    client_accounts.`typeaccount`,
                    mlm2.`mt4login`
                    FROM
                      mlm
                      LEFT JOIN mlm2
                        ON mlm.`ACCNO` = mlm2.`ACCNO`
                      LEFT JOIN client_accounts ON mlm.`ACCNO` = client_accounts.`accountname`
                      WHERE mlm.`group_play` = '$tipe'
                      GROUP BY mlm.`ACCNO`
                    ORDER BY mlm.`ACCNO`
                    AND mlm.`group_play` = '$tipe'
					AND mlm2.`mt4login` <> NULL";
					tradeLogs("query-56 :".$query);
                    $result = $DB->execresultset($query);
                    foreach ($result as $rows) {
                        $acccount = $rows['ACCNO'];
                        hitungkomisi($acccount, $periode_date, $periode);
                    }
                    if (count($result) > 0) {
                        $error    = "success";
                        $subject  = "Success !";
                        $msg      = "FINISHED : The report on $periode_date has been created, you can see in the commison report on Admin menu";
                        $progress = 100;
                    }
                } elseif ($replace == 'on' || count($result) <= 0) {
                    $delete = "DELETE FROM mlm_comm WHERE rolldate = '$periode_date' AND type = '$tipe'";
                    $DB->execonly($delete); 
					$query = "SELECT
                    mlm.`ACCNO`,
                    client_accounts.`typeaccount`,
                    mlm2.`mt4login`
                    FROM
                      mlm
                      LEFT JOIN mlm2
                        ON mlm.`ACCNO` = mlm2.`ACCNO`
                      LEFT JOIN client_accounts ON mlm.`ACCNO` = client_accounts.`accountname`
                      WHERE mlm.`group_play` = '$tipe'
                      GROUP BY mlm.`ACCNO`
                    ORDER BY mlm.`ACCNO`
					AND mlm2.`mt4login` IS NOT NULL
                    AND mlm.`group_play` = '$tipe'";
					tradeLogs("query-84 :".$query);
                    $result = $DB->execresultset($query);
                    foreach ($result as $rows) {
                        $acccount = $rows['ACCNO'];
                        hitungkomisi($acccount, $periode_date, $periode);
                    }
					tradeLogs("lanjut");
					tradeLogs(count($result));
                    if (count($result) > 0) {
                        $error    = "success";
                        $subject  = "Success !";
                        $msg      = "FINISHED : The report on $periode_date has been created, you can see in the commison report on Admin menu";
                        $progress = 100;
                    }
				} else {
                    $error    = "warning";
                    $subject  = "Warning !";
                    $msg      = "FINISHED : The report on $periode_date has been created, you can see in the commison report on Admin menu";
                    $progress = 100;
                }
            } else if ($postmode == 'wallet') {
				tradeLogs("wallet");
              $query = "SELECT id FROM mlm_ewallet_moving WHERE ref_number = '".$tipe."_commision:".$periode_date."'";
              $result = $DB->execresultset($query);
              if (count($result) > 0) {
                # code...
                $error    = "warning";
                $subject  = "Warning !";
                $msg      = "FINISHED : Wallet has been transfered before for this periode";
                $progress = 100;
              }else{
                $query = "SELECT id, ACCNO, SUM(amount) as amounts FROM mlm_comm WHERE rolldate = '$periode_date' GROUP BY ACCNO";
                $result = $DB->execresultset($query);
                foreach ($result as $key => $value) {
                  # code...
                  $do = ewallets($value['ACCNO'], $value['amounts'], 'Commison on '.$periode_date.' Amounted of Rp. '. number_format($value['amounts']));

                }
                $error    = "success";
                $subject  = "Success !";
                $msg      = "FINISHED : Wallet has been transfered";
                $progress = 100;
              }
            }
        } else {
            $error    = "danger";
            $subject  = "Error";
            $msg      = "CREATE_TREE : your session has been expire, Try refresing the web page";
            $progress = 0;
        }

    }
}
tradeLogs($error);
$response['status']   = $error;
$response['title']    = $subject;
$response['msg']      = $msg;
$response['progress'] = $progress;
$token                = $security->set(3, 3600);
$response['token']    = $token;

tradeLogs(json_encode($response));
echo json_encode($response);

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

function hitungkomisi($account, $periode_date, $periode)
{
    global $DB;
	global $tipe;
    $level = 1;
    // Check If he's an agent
    $query = "SELECT typeaccount FROM client_accounts WHERE accountname = '$account'";
    $cek   = $DB->execresultset($query);
    foreach ($cek as $key => $value) {
        $typeaccount = $value['typeaccount'];
    }
    $query = "SELECT
		  mlm.`ACCNO`,
		  mlm.`Upline`,
		  mlm2.`mt4dt`,
		  mlm2.`mt4login`,
		  client_accounts.`typeaccount`
		FROM
		  mlm
		  LEFT JOIN mlm2
			ON mlm.`ACCNO` = mlm2.`ACCNO`
		  LEFT JOIN client_accounts
			ON mlm.`ACCNO` = client_accounts.`accountname`
		WHERE mlm.ACCNO = '" . $account . "'
		AND mlm2.`mt4login` IS NOT NULL
		AND mlm.group_play = '$tipe'";
	tradeLogs("query-184 :".$query);
    $result = $DB->execresultset($query);
    $data   = array();
    foreach ($result as $row) {
        $accno       = $row['ACCNO'];
        $source      = $row['mt4dt'];
        $login       = $row['mt4login'];
        $parent      = $row['ACCNO'];
        $typeaccount = $row['typeaccount'];

        $data[] = $row;
    }

    $subcomm       = 0;
    $sublot        = 0;
    // tradeLogs($checkdownline);
    /*tradeLogs('upline ' . $uplineasli);
    tradeLogs('' . $uplineasli);*/
	tradeLogs('typeaccount :'.$typeaccount);
    if ($typeaccount != 'agent') {
            // tradeLogs('ACCNO ' . $account);
            $subcomm = 0;
            $sublot  = 0;
            // print_r($data);
            foreach ($data as $key => $value) {
                // tradeLogs('ACCNO '.$accno . ' LOGIN ' .$login. ' LOT : '.$ceklot);
                $accno      = $row['ACCNO'];
                $source     = $value['mt4dt'];
                $login      = $value['mt4login'];
                $parent     = $row['ACCNO'];
                $ceklot     = checkTradeDetalis($source, $login);
                $query      = "SELECT * FROM commission_setting WHERE fromno = '$account' AND status = 'approved'";
				tradeLogs("query-192 :".$query);
                $comm_array = $DB->execresultset($query);
				tradeLogs("comm_array :".json_encode($comm_array));
                $comm  = 0;
				$accno = '';

                foreach ($comm_array as $key => $value) {
                    $comm = $value['account_comm'] * $ceklot;
					$accno = $value['accountno'];
					$insert = "INSERT INTO mlm_comm SET type = '$tipe', ACCNO = '$accno', mlm_comm.from = '$account', amount = '$comm', lot = '$ceklot', rolldate = '$periode_date'";
					tradeLogs('query loop : '.$insert);
					$DB->execonly($insert);
                }
				tradeLogs("selesai foreach hitung");
            }
            tradeLogs('HITUNG KOMISI : NASABAH '.$account);
            tradeLogs('----------------------------------------------');
    }

}


function checktrade($account, $rangetanggal)
{
    // $rangetanggal = "2016-05-01 - 2016-05-31";
    /**

    TODO:
    - Bentuk tanggal nya : 2016-01-01 - 2016-01-30
    - Second todo item

     */
    global $periode;
    global $DB;
    $rangetanggal = $periode;
    $q            = "SELECT mlm2.`mt4dt`, mlm2.`mt4login` FROM mlm, mlm2 WHERE mlm.`ACCNO` = mlm2.`ACCNO` AND mlm.ACCNO = '$account'";
    $result       = $DB->execresultset($q);
    // $login_array = null;
    // for ($i_acc = 0; $i_acc < count($pecah); $i_acc++) {
    //     $acc_arrnya = $acc_arrnya . ",'" . $pecah[$i_acc] . "'";
    // }
    // $acc_arr = "AND M_LOGIN in (''" . $acc_arrnya . ")";

    $pecah    = explode(' - ', $rangetanggal);
    $datefrom = $pecah[0];
    $dateto   = $pecah[1];
    $subtotal = 0;

    $datefrom = date('Y-m-d', (strtotime('-1 day', strtotime($datefrom))));

// SELECT
    //   SUM(volume/100)
    // FROM
    //   askap_source_mini.`mt4_trades`
    // WHERE lOGIN = '88000237'
    //   AND CLOSE_TIME BETWEEN '2016-04-30 22:30:01'
    //   AND '2016-05-31 22:30:00'
    //   AND CMD IN ('1', '0') ;

    foreach ($result as $key => $value) {
        $query = "SELECT
            (SUM(VOLUME) / 100) as lot
            FROM
            $value[mt4dt].`mt4_trades`
            WHERE mt4_trades.`LOGIN` = '$value[mt4login]'
            AND CMD IN ('1', '0')
            and CLOSE_TIME BETWEEN '" . $datefrom . " 22:30:01'
            and '" . $dateto . " 22:30:00'";
        tradeLogs("query-609 :".$query);
		$result = $DB->execresultset($query);
        // var_dump($query);
		
        $hasil = 0;
        foreach ($result as $row) {
            $hasil = $row['lot'];
        }
        $subtotal = $subtotal + $hasil;
    }
     tradeLogs('ACCNO :' .  $account . ' SUBTOTAL :'.$subtotal);
    return $subtotal;
}

function hitungchild($account, $parent, $level, $is_agent, $periode, $periode_date)
{

    // tradeLogs('ACCNO' . $account . 'LEVEL ' . $level);
    // tradeLogs($level);
    global $DB;
	global $tipe;
    $data  = array();
    $query = "SELECT
	  mlm.`ACCNO`,
	  mlm.`Upline`,
	  mlm.`group_play`
	FROM
	  mlm
	  WHERE mlm.`Upline` = '$account'
	  AND mlm.`group_play` = '$tipe'";
    tradeLogs("query-296 :".$query);
	$result = $DB->execresultset($query);
    // var_dump($query);
    
    foreach ($result as $row) {
        $sublot  = 0;
        $subcomm = 0;
        $accno   = $row['ACCNO'];
        // $cektrade = checktrade($login, $periode);
        // tradeLogs($accno);

        $query = "SELECT mt4dt, mt4login FROM mlm2 WHERE ACCNO = '$accno'";

        $hasil = $DB->execresultset($query);
        $datas = array();
        foreach ($hasil as $has) {
            // tradeLogs("ACCNO ".$accno . " HASIL : ".$has['mt4login']);
            $datas[] = $has;
        }
        $commision = 0;
        if ($is_agent) {
            // Cari Amount

            // tradeLogs('AGENT '. $accno);
            $sublot  = 0;
            $subcomm = 0;
			$subcomm = 0;
            $sublot  = 0;
            // print_r($data);
            foreach ($data as $key => $value) {
                // tradeLogs('ACCNO '.$accno . ' LOGIN ' .$login. ' LOT : '.$ceklot);
                $accno      = $row['ACCNO'];
                $source     = $value['mt4dt'];
                $login      = $value['mt4login'];
                $parent     = $row['ACCNO'];
                $ceklot     = checkTradeDetalis($source, $login);
                $query      = "SELECT * FROM commission_setting WHERE accountno = '$account' AND status = 'approved'";
				tradeLogs("quert-192 :".$query);
                $comm_array = $DB->execresultset($query);
				tradeLogs("comm_array :".json_encode($comm_array));
                $comm  = 0;
				$accno = '';

                foreach ($comm_array as $key => $value) {
                    $comm = $value['account_comm'] * $ceklot;
					$accno = $value['accountno'];
                }
				tradeLogs('comm :'.$comm);
				tradeLogs('accno :'.$accno);
				tradeLogs('insert comm');
				$insert = "INSERT INTO mlm_comm SET type = '$tipe', ACCNO = '$accno', mlm_comm.from = '$account', amount = '$comm', lot = '$ceklot', rolldate = '$periode_date'";
				tradeLogs('query-354 : '.$insert);
				$DB->execonly($insert);
            }
        }
        // tradeLogs('COMMISION '.$accno." ".$subcomm);

    }

}

function checkTradeDetalis($source, $login)
{

    global $periode;
    global $DB;
    $rangetanggal = $periode;

    $pecah    = explode(' - ', $rangetanggal);
    $datefrom = $pecah[0];
    $dateto   = $pecah[1];
    $subtotal = 0;
    $datefrom = date('Y-m-d', (strtotime('-1 day', strtotime($datefrom))));
    $query    = "SELECT
            (SUM(VOLUME) / 100) as lot
            FROM
            " . $source . ".`mt4_trades`
            WHERE mt4_trades.`LOGIN` = '" . $login . "'
            AND CMD IN ('1', '0')
            and CLOSE_TIME BETWEEN '" . $datefrom . " 22:30:01'
            and '" . $dateto . " 22:30:00'";
			tradeLogs("query-284 :".$query);
    $result = $DB->execresultset($query);
    // var_dump($query);
    $hasil = 0;
    foreach ($result as $row) {
        $hasil = $row['lot'];
    }
    return $hasil;
}

function tradeLogs($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
function hitungdownline($account)
{
    global $DB;
    $query = "SELECT
  COUNT(ACCNO) as jumlah
FROM
  mlm
WHERE mlm.`Upline` = '$account' ";
	tradeLogs("hitungdownline query :".$query);
    $result = $DB->execresultset($query);
    return $result[0]['jumlah'];
}
function ewallets($account, $amount, $desc){
  global $DB;
  global $periode_date;
  global $tipe;
  $query = "SELECT id FROM mlm_ewallet WHERE mlm_ewallet.`account` = '$account'";
  $result = $DB->execresultset($query);
  $id_wallet = 0;
  if (count($result) <= 0) {
    # code...
    createWalltes($account, 'mlm_ewallet');
  }
  foreach ($result as $key => $value) {
    # code...
    $id_wallet = $value['id'];
  }
  $output = FALSE;
  if ($id_wallet != '0') {
    # code...
    $query = "SELECT balance as amounts FROM mlm_ewallet WHERE account = '$account'";
    $result = $DB->execresultset($query);
    $amount_old = 0;
    foreach ($result as $key => $value) {
      # code...
      $amount_old = $value['amounts'];
    }
    //tradeLogs('ACCNO '.$account . ' AMOUNT '.$amount . ' OLD AMOUNT '.$amount_old);
    $final = $amount + $amount_old;
    $update = "UPDATE mlm_ewallet SET balance = '$final' WHERE account = '$account'";
    $DB->execonly($update);

    $insert = "INSERT INTO mlm_ewallet_moving SET id_ewallet = '$id_wallet', amount = '$amount', cmd = '3', reason = '$desc', ref_number = '".$tipe."commision:".$periode_date."'";
    $DB->execonly($insert);
    $output = TRUE;
  }else{
    ewallets($account, $amount, $desc);
  }
  return $output;
}
function createWalltes($account, $type){
  global $DB;
  $query = "INSERT INTO ".$type." SET account = '$account'";
  $do = $DB->execonly($query);
  $output = FALSE;
  if ($do) {
    # code...
    $output = TRUE;
  }
  return $output;
}
