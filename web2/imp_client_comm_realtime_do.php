<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require_once "$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php";
include_once "includes/wr_tools.php";
global $user;
global $template;
global $mysql;
global $DB;

$user     = @$_SESSION['user'];
$security = new \security\CSRF;
$error    = "success";
$subject  = "Oops, Something has happened";
$msg      = "Try refresing the web page";
$progress = 0;
$postmode = @$_GET['postmode'];
$token    = @$_POST['token'];
$periode  = @$_POST['tglnya'];
$account  = @$_POST['account'];
// $account = '160712148';
/*=============================================
=            Section comment block            =
=============================================*/
// tradeLogs($_SERVER['REQUEST_METHOD']);
if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
            $token = $security->set(3, 3600);
            /* Start Of Postmode */
            if ($postmode == 'tmp') {
                /* Cek it first */
                $query  = "SELECT id FROM mlm_realtime_ref WHERE aecode = '$user->username'";
                $result = $DB->execresultset($query);
                // tradeLogs($query);
                if (count($result) > 0) {
                    $delete = "DELETE FROM mlm_realtime_ref WHERE aecode = '$user->username'";
                    $DB->execonly($delete);
                }
                $unix = createUnix($user->username);
                /* Find Upline */
                $query  = "SELECT Upline FROM mlm WHERE ACCNO = '$account'";
                $result = $DB->execresultset($query);
                foreach ($result as $key => $value) {
                    $Upline = $value['Upline'];
                }
                $insert = "INSERT INTO mlm_realtime SET ACCNO = '$account', Upline = '$Upline', datetime  = NOW(), updateby = 'test', rolldate = '0000-00-00', unix = '$unix', is_compress = FALSE";
                $DB->execonly($insert);
                // For Get downline data
                $do = getDataTree($account, $unix);
                /* If success */
                $error    = "success";
                $subject  = "Success";
                $msg      = "Success Page";
                $progress = 0;
            } elseif ($postmode == 'tree') {
                $unix         = @$_POST['unix'];
                $periode_date = @$_POST['periode_date'];
                // $periode_date = '2016-06-01 - 2016-06-31';
                $query  = "SELECT * FROM mlm_realtime WHERE unix = '$unix' AND is_compress = FALSE";
                $result = $DB->execresultset($query);
                foreach ($result as $key => $value) {
                    compression($value['ACCNO'], $value['ACCNO'], $periode_date);
                }

                $error    = "success";
                $subject  = "Success";
                $msg      = "Success Page Tree";
                $progress = 0;
                $periode  = $periode_date;

            } elseif ($postmode == 'comm') {
                $unix         = @$_POST['unix'];
                $periode_date = @$_POST['periode_date'];
                $periode      = $periode_date;
                $account      = @$_POST['account'];
                hitungkomisi($account, $periode_date, $periode);
            } elseif ($postmode == 'get_data') {
              $unix         = @$_POST['unix'];
                $periode_date = @$_POST['periode_date'];
                $periode      = $periode_date;
                $account      = @$_POST['account'];
              $query = "SELECT
              mlm_realtime_comm.`ACCNO`,
              mlm_realtime_comm.`lot`,
              mlm_realtime_comm.`amount`,
              mlm_realtime_comm.`level`,
              client_aecode.`name`,
              mlm_realtime_comm.`from`,
              (SELECT
                client_aecode.`name`
              FROM
                client_accounts,
                client_aecode
              WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
                AND client_accounts.`accountname` =  mlm_realtime_comm.`from`) AS nama2,
              client_accounts.`typeaccount`
            FROM
              mlm_realtime_comm,
              client_accounts,
              client_aecode
            WHERE 1=1
            AND mlm_realtime_comm.unix = '$unix'
            AND mlm_realtime_comm.`ACCNO` = client_accounts.`accountname`
              AND client_accounts.`aecodeid` = client_aecode.`aecodeid`";
              $result = $DB->execresultset($query);

              $query = "SELECT 
              mlm_realtime_comm.`ACCNO`,
              client_aecode.`name`,
              client_accounts.`typeaccount`,
              SUM(amount) AS subtotal 
            FROM
              mlm_realtime_comm,
              client_accounts,
              client_aecode 
            WHERE 1 = 1
            AND mlm_realtime_comm.unix = '$unix'
              AND mlm_realtime_comm.`ACCNO` = client_accounts.`accountname` 
              AND client_accounts.`aecodeid` = client_aecode.`aecodeid` 
            GROUP BY mlm_realtime_comm.`ACCNO`";
            $result2 = $DB->execresultset($query);
              $response['quick'] = $result2;
              $response['detailed']   = $result;

            }
            /* End Of Postmode */
            /* $error    = "success";
        $subject  = "Success";
        $msg      = "Success Page";
        $progress = 0;*/
        $error    = "success";
                $subject  = "Success";
                $msg      = "Success Page Tree";
                $progress = 0;
                // $periode  = $periode_date;
        } else {
            $error    = "danger";
            $subject  = "Error";
            $msg      = "CREATE_TREE : your session has been expire, Try refresing the web page";
            $progress = 0;
        }

    }
}

$response['status']       = $error;
$response['title']        = $subject;
$response['msg']          = $msg;
$response['progress']     = $progress;
$response['unix']         = $unix;
$response['account']      = $account;
$response['periode_date'] = $periode;
$token                    = $security->set(3, 3600);
$response['token']        = $token;

echo json_encode($response, JSON_PRETTY_PRINT);

/*=====  End of Section comment block  ======*/

function getDataTree($account, $unix)
{
    global $DB;
    global $user;
    $query  = "SELECT ACCNO, Upline FROM mlm WHERE Upline = '$account'";
    $result = $DB->execresultset($query);
    $data   = array();
    foreach ($result as $key => $value) {
        $insert = "INSERT INTO mlm_realtime SET ACCNO = '$value[ACCNO]', Upline = '$value[Upline]', datetime  = NOW(), updateby = '$user->username', rolldate = '0000-00-00', unix = '$unix', is_compress = FALSE";
        $DB->execonly($insert);
        $data[$key] = $value;
    }
    if (count($data) > 0) {
        foreach ($data as $key => $value) {
            getDataTree($value['ACCNO'], $unix);
        }

    } else {

    }

}
function compression($account, $base_account, $periode_date)
{
    // tradeLogs($periode_date);
    global $DB;
    global $unix;
    $query  = "SELECT Upline, client_accounts.`typeaccount` FROM mlm, client_accounts WHERE mlm.`ACCNO` = client_accounts.`accountname` AND ACCNO = '$account'";
    $result = $DB->execresultset($query);
    foreach ($result as $key => $value) {
        $Upline = $value['Upline'];
        $type   = $value['typeaccount'];
    }
    // echo "ACCNOC : " . $Upline . " BASE :" . $type . "<br/>";
    // echo $account . " " . $Upline . "<br>";
    $downline = 0;
    $lots     = 0;
    //if ($type != 'agent') { //Ini untuk Agent
    if ($type != 'agent') {
        $downline = hitungdownline($Upline);
        $lots     = checktrade($Upline, $periode_date);

        if ($downline > 1 && $lots >= 1) {
            // echo "This Account $base_account to downline = $downline " . $lots . "<br/> ";
            $query  = "SELECT ACCNO FROM mlm_realtime WHERE is_compress = TRUE AND ACCNO = '$base_account' AND unix = '$unix'";
            $result = $DB->execresultset($query);
            if (count($result) > 0) {
                # code...
            } else {
                $insert = "INSERT INTO mlm_realtime SET ACCNO = '$base_account', Upline = '$Upline', datetime = NOW(), is_compress = TRUE, unix = '$unix'";
                $DB->execonly($insert);
            }
        } else {
            compression($Upline, $base_account, $periode_date);
        }
    } else {
        // echo "ELSE : This Account $base_account to Upline = $account<br/>";
        $query  = "SELECT ACCNO FROM mlm_realtime WHERE is_compress = TRUE AND ACCNO = '$base_account' AND unix = '$unix'";
        $result = $DB->execresultset($query);
        if (count($result) > 0) {
            # code...
        } else {
            if ($account == $base_account) {

                $insert = "INSERT INTO mlm_realtime SET ACCNO = '$base_account', Upline = '$Upline', datetime = NOW(), is_compress = TRUE, unix = '$unix'";
                $DB->execonly($insert);
            } else {
                $insert = "INSERT INTO mlm_realtime SET ACCNO = '$base_account', Upline = '$account', datetime = NOW(), is_compress = TRUE, unix = '$unix'";
                $DB->execonly($insert);
            }

        }

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
    global $DB;
    $q      = "SELECT mlm2.`mt4dt`, mlm2.`mt4login` FROM mlm, mlm2 WHERE mlm.`ACCNO` = mlm2.`ACCNO` AND mlm.ACCNO = '$account'";
    $result = $DB->execresultset($q);
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
        $result = $DB->execresultset($query);
        // var_dump($query);
        $hasil = 0;
        foreach ($result as $row) {
            $hasil = $row['lot'];
        }
        $subtotal = $subtotal + $hasil;
    }
    // tradeLogs('ACCNO :' .  $account . ' SUBTOAL :'.$subtotal);
    return $subtotal;
}
function hitungdownline($account)
{
    global $DB;
    $query = "SELECT
      COUNT(ACCNO) as jumlah
    FROM
      mlm
    WHERE mlm.`Upline` = '$account' ";
    $result = $DB->execresultset($query);
    return $result[0]['jumlah'];
}

function TradeLogUnderConstruct_Secure($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
function hitungkomisi($account, $periode_date, $periode)
{
    global $DB;
    $level = 1;
    // Check If he's an agent
    $query = "SELECT typeaccount FROM client_accounts WHERE accountname = '$account'";
    $cek   = $DB->execresultset($query);
    foreach ($cek as $key => $value) {
        $typeaccount = $value['typeaccount'];
    }
    $query = "SELECT
  mlm_realtime.`ACCNO`,
  mlm_realtime.`Upline`,
  mlm2.`mt4dt`,
  mlm2.`mt4login`,
  mlm.`Upline` AS uplineasli,
  client_accounts.`typeaccount`,
  mlm_realtime.`is_compress`
FROM
  mlm_realtime
  LEFT JOIN mlm2
    ON mlm_realtime.`ACCNO` = mlm2.`ACCNO`
  LEFT JOIN mlm
    ON mlm_realtime.`ACCNO` = mlm.`ACCNO`
  LEFT JOIN client_accounts
    ON mlm_realtime.`ACCNO` = client_accounts.`accountname`
WHERE mlm_realtime.`is_compress` = TRUE
AND mlm_realtime.ACCNO = '" . $account . "'";
    // tradeLogs($query);
    $result = $DB->execresultset($query);
    $data   = array();
    foreach ($result as $row) {
        $accno       = $row['ACCNO'];
        $source      = $row['mt4dt'];
        $login       = $row['mt4login'];
        $parent      = $row['ACCNO'];
        $uplineasli  = $row['uplineasli'];
        $typeaccount = $row['typeaccount'];

        $data[] = $row;
    }

    $cektrade      = checktrade($accno, $periode);
    $subcomm       = 0;
    $sublot        = 0;
    $checkdownline = hitungdownline($account);
    // tradeLogs($checkdownline);
    /*tradeLogs('upline ' . $uplineasli);
    tradeLogs('' . $uplineasli);*/
    if ($typeaccount != 'agent') {
        if ($cektrade >= 1 && $checkdownline >= 2) {
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
                $query      = "SELECT amount FROM imp_manage_schema WHERE mt4dt = '$source' AND bonus_for = 'nasabah' AND level = '1'";
                $comm_array = $DB->execresultset($query);
                $commision  = 0;

                foreach ($comm_array as $key => $value) {
                    $commision = $value['amount'] * $ceklot;
                }
                $sublot  = $sublot + $ceklot;
                $subcomm = $subcomm + $commision;
            }
            // echo $insert = "INSERT INTO mlm_comm SET ACCNO = '$account', from = '$account', level = '1', amount = '$commision'" . "<br>";

            $insert = "INSERT INTO mlm_realtime_comm SET ACCNO = '$account', mlm_realtime_comm.from = '$account', level = '1', amount = '$subcomm', lot = '$sublot', rolldate = '$periode_date'";
            $DB->execonly($insert);
            // tradeLogs('HITUNG KOMISI : NASABAH '.$account);
            // tradeLogs('----------------------------------------------');
            hitungchild($account, $parent, 2, false, $periode, $periode_date);
        }
    } else {
        // $query      = "SELECT amount FROM imp_manage_schema WHERE mt4dt = '$source' AND bonus_for = 'ae' AND level = '1'";
        // $comm_array = $DB->execresultset($query);
        // $commision  = 0;
        // foreach ($comm_array as $key => $value) {
        //    $commision = $value['amount'] * $cektrade;
        // }

        // // echo $insert = "INSERT INTO mlm_comm SET ACCNO = '$account', from = '$account', level = '1', amount = '$commision'" . "<br>";
        // $insert = "INSERT INTO mlm_comm SET ACCNO = '$account', mlm_comm.from = '$account', level = '1', amount = '$commision', lot = '$cektrade', rolldate = '$periode_date'";
        // // tradeLogs($insert);
        // $DB->execonly($insert);
        // tradeLogs('HITUNG KOMISI : AGENT '.$account);
        //      tradeLogs('----------------------------------------------');
        hitungchild($account, $parent, 1, true, $periode, $periode_date);

    }

}

function hitungchild($account, $parent, $level, $is_agent, $periode, $periode_date)
{

    // tradeLogs('ACCNO' . $account . 'LEVEL ' . $level);
    // tradeLogs($level);
    global $DB;
    global $unix;
    $data  = array();
    $query = "SELECT
  mlm_realtime.`ACCNO`,
  mlm_realtime.`Upline`,
  mlm.`group_play`
   FROM
  mlm_realtime,
  mlm
  WHERE mlm_realtime.`ACCNO` = mlm.`ACCNO`
  AND mlm_realtime.is_compress = TRUE
  AND mlm_realtime.`Upline` = '$account'";
    $result = $DB->execresultset($query);
    // var_dump($query);
    // tradeLogs($query);
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
            // tradeLogs('ACCNO '.$accno . " AGENT");
            $sublot  = 0;
            $subcomm = 0;
            foreach ($datas as $key => $val) {
                $ceklot     = checkTradeDetalis($val['mt4dt'], $val['mt4login']);
                $query      = "SELECT amount FROM imp_manage_schema WHERE mt4dt = '" . $val['mt4dt'] . "' AND bonus_for = 'ae' AND level = '$level'";
                $comm_array = $DB->execresultset($query);
                foreach ($comm_array as $key => $value) {
                    $commision2 = $value['amount'] * $ceklot;
                }
                $sublot  = $sublot + $ceklot;
                $subcomm = $subcomm + $commision2;
            }
            $commision = $subcomm;
            $cektrade  = $sublot;
        } else {
            // tradeLogs('ACCNO '.$accno . " NASABAG");
            $sublot  = 0;
            $subcomm = 0;
            foreach ($datas as $key => $val) {
                $ceklot     = checkTradeDetalis($val['mt4dt'], $val['mt4login']);
                $query      = "SELECT amount FROM imp_manage_schema WHERE mt4dt = '" . $val['mt4dt'] . "' AND bonus_for = 'nasabah' AND level = '$level'";
                $comm_array = $DB->execresultset($query);
                foreach ($comm_array as $key => $value) {
                    $commision2 = $value['amount'] * $ceklot;
                }
                $sublot  = $sublot + $ceklot;
                $subcomm = $subcomm + $commision2;
            }
            $commision = $subcomm;
            $cektrade  = $sublot;
        }
        // tradeLogs('COMMISION '.$accno." ".$subcomm);

        $data[$row['ACCNO']] = $row;
        if ($is_agent) {
            if (!($level > 7) && $commision != 0) {
                // echo $insert = "INSERT INTO mlm_comm SET ACCNO = '$parent', from = '$accno', level = '$level', amount = '$commision'" . "<br/>";
                $insert = "INSERT INTO mlm_realtime_comm SET ACCNO = '$parent', mlm_realtime_comm.from = '$accno', level = '$level', amount = '$commision', lot = '$cektrade', unix = '$unix'";
                $DB->execonly($insert);
            }
        } else {
            if (!($level > 9) && $commision != 0) {
                // echo $insert = "INSERT INTO mlm_comm SET ACCNO = '$parent', from = '$accno', level = '$level', amount = '$commision'" . "<br/>";
                $insert = "INSERT INTO mlm_realtime_comm SET ACCNO = '$parent', mlm_realtime_comm.from = '$accno', level = '$level', amount = '$commision', lot = '$cektrade', unix = '$unix'";
                $DB->execonly($insert);
            }
        }

    }
    $level++;
    // tradeLogs($level3+$level);
    @$level2 = $level2 + $level;
    if (count($data) > 0) {
        $lv = 0;
        foreach ($data as $key => $value) {

            hitungchild($key, $parent, $level, $is_agent, $periode, $periode_date);
            $level2++;
        }

    } else {
        $level - $level2;
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
    $result = $DB->execresultset($query);
    // var_dump($query);
    $hasil = 0;
    foreach ($result as $row) {
        $hasil = $row['lot'];
    }
    return $hasil;
}
function createUnix($email)
{
    global $DB;
    $pecah  = strtoupper(substr($email, 0, 2));
    $hasil  = $pecah . rand(10, 1000);
    $query  = "SELECT * FROM mlm_realtime_ref WHERE unix = '$hasil'";
    $result = $DB->execresultset($query);
    if (count($result) > 0) {
        $hasil = createUnix($email);
    } else {
        $insert = "INSERT INTO mlm_realtime_ref SET aecode = '$email', unix = '$hasil'";
        $DB->execonly($insert);
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
