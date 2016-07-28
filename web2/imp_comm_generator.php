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
if (isset($_POST['replace'])) {
    # code...
    $replace = $_POST['replace'];
}
/*==============================
=            Coding            =
==============================*/

if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
            // print_r('Succes');
            if ($postmode == 'mlm_temp') {
                // Check it first
                $query  = "SELECT ACCNO, datetime FROM mlm_temp WHERE rolldate = '$periode_date' LIMIT 0 ,1";
                $result = $DB->execresultset($query);
                // print_r($query);
                if (count($result) > 0 && $replace == 'off') {
                    $error    = "warning";
                    $subject  = "Warning !";
                    $msg      = "CREATE_TREE : Warning, this process has been run before for date $periode_date on " . $result[0]['datetime'] . " , and not be replaced";
                    $progress = 50;
                } elseif ($replace == 'on' || count($result) <= 0) {
                    $delete = "DELETE FROM mlm_temp WHERE rolldate = '$periode_date'";
                    $DB->execonly($delete);

                    $delete = "DELETE FROM mlm_comm WHERE rolldate = '$periode_date'";
                    $DB->execonly($delete);

                    $query = "SELECT
                    mlm.ACCNO,
                    upline
                  FROM
                    mlm,
                    client_accounts
                  WHERE mlm.`ACCNO` = client_accounts.`accountname`
                    AND client_accounts.`suspend` = '0'
                    AND ACCNO != 'COMPANY'
                    AND mlm.`group_play` LIKE '%askap%'";
                    $result = $DB->execresultset($query);
                    foreach ($result as $key => $value) {
                        compression($value['ACCNO'], $value['ACCNO'], $periode_date);

                    }

                    // buildTree($result, $parentId = 'COMPANY', $periode_date);
                    $error    = "success";
                    $subject  = "Success !";
                    $msg      = "CREATE_TREE : The new tree with compression has been created for $periode_date";
                    $progress = 50;
                }
            } else if ($postmode == 'hitung') {
                // tradeLogs($postmode. "HITUNG");
                // Check it first
                $query  = "SELECT ACCNO FROM mlm_comm WHERE rolldate = '$periode_date' LIMIT 0,1";
                $result = $DB->execresultset($query);
                if (!count($result) > 0) {
                    $query = "SELECT
                    mlm_temp.`ACCNO`,
                    client_accounts.`typeaccount`,
                    mlm2.`mt4login`
                    FROM
                      mlm_temp
                      LEFT JOIN mlm2
                        ON mlm_temp.`ACCNO` = mlm2.`ACCNO`
                      LEFT JOIN client_accounts ON mlm_temp.`ACCNO` = client_accounts.`accountname`
                      AND mlm_temp.`rolldate` = '$periode_date'
                      GROUP BY mlm_temp.`ACCNO`
                    ORDER BY mlm_temp.`ACCNO`";
                    // tradeLogs($query);
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
                } else {
                    $error    = "warning";
                    $subject  = "Warning !";
                    $msg      = "FINISHED : The report on $periode_date has been created, you can see in the commison report on Admin menu";
                    $progress = 100;
                }
            } else if ($postmode == 'wallet') {
              $query = "SELECT id FROM mlm_ewallet_moving WHERE ref_number = 'askap_commision:".$periode_date."'";
              $result = $DB->execresultset($query);
              if (count($result) > 0) {
                # code...
                $error    = "warning";
                $subject  = "Warning !";
                $msg      = "FINISHED : Wallet has been transfered before for this priode";
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

$response['status']   = $error;
$response['title']    = $subject;
$response['msg']      = $msg;
$response['progress'] = $progress;
$token                = $security->set(3, 3600);
$response['token']    = $token;

echo json_encode($response);
function compression($account, $base_account, $periode_date)
{
    // echo "ACCNOC : " . $account . " BASE :" . $base_account . "<br/>";

    global $DB;
    $query = "SELECT Upline, client_accounts.`typeaccount` FROM mlm, client_accounts WHERE mlm.`ACCNO` = client_accounts.`accountname` AND ACCNO = '$account'";
    // tradeLogs($query);
    $result = $DB->execresultset($query);
    foreach ($result as $key => $value) {
        $Upline         = $value['Upline'];
        $type           = $value['typeaccount'];
        $typeofaccounts = $value['typeaccount'];
    }
    // echo $account . " " . $Upline . "<br>";
    $downline = 0;
    $lots     = 0;
    if ($typeofaccounts != 'agent' && $Upline != 'COMPANY') {
        //Ini untuk Agent
        // if ($Upline != 'COMPANY') {
        $downline = hitungdownline($Upline);
        $lots     = checktrade($Upline, $periode_date);
        if ($downline > 1 && $lots >= 1) {
            // echo "This Account $base_account to Upline = $Upline<br/>";
            $query  = "SELECT ACCNO FROM mlm_temp WHERE ACCNO = '$base_account' AND rolldate = '$periode_date'";
            $result = $DB->execresultset($query);
            if (count($result) > 0) {
                # code...
            } else {
                $insert = "INSERT INTO mlm_temp SET ACCNO = '$base_account', Upline = '$Upline', datetime = NOW(), methode = 'compress', rolldate = '$periode_date'";
                $DB->execonly($insert);
            }
        } else {
            compression($Upline, $base_account, $periode_date);
        }
    } else {
        // echo "ELSE : This Account $base_account to Upline = $account<br/>";
        $query  = "SELECT ACCNO FROM mlm_temp WHERE ACCNO = '$base_account' AND rolldate = '$periode_date'";
        $result = $DB->execresultset($query);
        if (count($result) > 0) {
            # code...
        } else {
            if ($account == $base_account) {
                $insert = "INSERT INTO mlm_temp SET ACCNO = '$base_account', Upline = '$Upline', datetime = NOW(), methode = 'compress', rolldate = '$periode_date'";
                $DB->execonly($insert);
            } else {
                $insert = "INSERT INTO mlm_temp SET ACCNO = '$base_account', Upline = '$account', datetime = NOW(), methode = 'compress', rolldate = '$periode_date'";
                $DB->execonly($insert);
            }

        }

    }

}
function buildTree(array &$elements, $parentId, $periode_date)
{
    global $DB;
    $branch = array();
    foreach ($elements as $element) {
        if ($element['upline'] == $parentId) {
            /*$query = "INSERT INTO mlm_temp SET ACCNO = '$element[ACCNO]', datetime = NOW(), methode = 'general', Upline = '$element[upline]', rolldate = '".date('Y-m-d')."'";
            $DB->execonly($query);*/
            $children = buildTree($elements, $element['ACCNO'], $periode_date);
            // print_r($children);

            $element['downline'] = count($children);
            if ($children) {
                if ($element['downline'] <= 1) {
                    $element['harus'] = 'COMPRESS';
                    $query            = "SELECT ACCNO FROM mlm WHERE Upline = '$element[ACCNO]'";
                    $result           = $DB->execresultset($query);
                    foreach ($result as $row) {
                        $element['DATA'] = $row['ACCNO'] . " TO " . $element['upline'];
                    }
                    $insert = "INSERT INTO mlm_temp SET ACCNO = '$element[ACCNO]', Upline = '$element[upline]',  methode = 'general', rolldate = '$periode_date'";
                    $DB->execonly($insert);

                    $query = "SELECT ACCNO, id FROM mlm_temp WHERE ACCNO = '$row[ACCNO]' AND rolldate = '$periode_date'";
                    $res   = $DB->execresultset($query);
                    if (count($res) > 0) {
                        $update = "DELETE FROM mlm_temp WHERE id = '" . $res[0]['id'] . "'";
                        $DB->execonly($update);
                        $insert = "INSERT INTO mlm_temp SET ACCNO = '$row[ACCNO]', Upline = '$element[upline]',  methode = 'compress', rolldate = '$periode_date'";
                        $DB->execonly($insert);
                    } else {
                        $insert = "INSERT INTO mlm_temp SET ACCNO = '$row[ACCNO]', Upline = '$element[upline]',  methode = 'compress', rolldate = '$periode_date'";
                        $DB->execonly($insert);
                    }

                } else {
                    $query = "SELECT ACCNO FROM mlm_temp WHERE ACCNO = '$element[ACCNO]' AND rolldate = '$periode_date'";
                    $res   = $DB->execresultset($query);
                    if (count($res) > 0) {

                    } else {
                        $element['harus'] = 'GAUSAH';
                        $insert           = "INSERT INTO mlm_temp SET ACCNO = '$element[ACCNO]', Upline = '$element[upline]',  methode = 'general', rolldate = '$periode_date'";
                        $DB->execonly($insert);
                    }

                }
                $element['children'] = $children;
            } else {
                $query = "SELECT ACCNO FROM mlm_temp WHERE ACCNO = '$element[ACCNO]' AND rolldate = '$periode_date'";
                $res2  = $DB->execresultset($query);
                // tradeLogs(count($res2) . " ACCNO ". $element['ACCNO']);
                if (count($res2) > 0) {

                } else {
                    $insert = "INSERT INTO mlm_temp SET ACCNO = '$element[ACCNO]', Upline = '$element[upline]',  methode = 'general2', rolldate = '$periode_date'";
                    $DB->execonly($insert);
                }
            }
            $branch[$element['ACCNO']] = $element;
            unset($elements[$element['ACCNO']]);
        }
    }
    return $branch;
}
function buildTreeORIGINAL(array &$elements, $parentId, $periode_date)
{
    global $DB;
    $branch = array();

    foreach ($elements as $element) {
        if ($element['upline'] == $parentId) {
            // $query = "INSERT INTO mlm_temp SET ACCNO = '$element[ACCNO]', Upline = '$element[upline]'";
            // $DB->execonly($query);
            $children = buildTree($elements, $element['ACCNO'], $periode_date);
            // print_r($children);

            $element['downline'] = count($children);
            // print_r($children > 0 && $children <= 2)."<br/>";
            if ($children) {
                if ($element['downline'] === 1) {
                    $element['harus'] = 'COMPRESS';
                    $query            = "SELECT Upline FROM mlm WHERE ACCNO = '$element[upline]'";
                    $result           = $DB->execresultset($query);
                    foreach ($result as $row) {
                        $element['uplines'] = $row['Upline'];
                    }
                    $insert = "INSERT INTO mlm_temp SET ACCNO = '$element[ACCNO]', Upline = '$element[uplines]', datetime = NOW(), methode = 'compress', rolldate = '$periode_date'";
                    $DB->execonly($insert);
                } else {
                    $element['harus'] = 'GAUSAH';
                    $insert           = "INSERT INTO mlm_temp SET ACCNO = '$element[ACCNO]', Upline = '$element[upline]', datetime = NOW(), methode = 'general', rolldate = '$periode_date'";
                    $DB->execonly($insert);

                }
                $element['children'] = $children;
            } else {
                $insert = "INSERT INTO mlm_temp SET ACCNO = '$element[ACCNO]', Upline = '$element[upline]', datetime = NOW(), methode = 'general', rolldate = '$periode_date'";
                $DB->execonly($insert);
            }
            $branch[$element['ACCNO']] = $element;
            unset($elements[$element['ACCNO']]);
        }
    }
    return $branch;
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
  mlm_temp.`ACCNO`,
  mlm_temp.`Upline`,
  mlm2.`mt4dt`,
  mlm2.`mt4login`,
  mlm.`Upline` AS uplineasli,
  client_accounts.`typeaccount`
FROM
  mlm_temp
  LEFT JOIN mlm2
    ON mlm_temp.`ACCNO` = mlm2.`ACCNO`
  LEFT JOIN mlm
    ON mlm_temp.`ACCNO` = mlm.`ACCNO`
  LEFT JOIN client_accounts
    ON mlm_temp.`ACCNO` = client_accounts.`accountname`
WHERE mlm_temp.`rolldate` = '" . $periode_date . "'
AND mlm_temp.ACCNO = '" . $account . "'";
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

            $insert = "INSERT INTO mlm_comm SET ACCNO = '$account', mlm_comm.from = '$account', level = '1', amount = '$subcomm', lot = '$sublot', rolldate = '$periode_date'";
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
    $data  = array();
    $query = "SELECT
  mlm_temp.`ACCNO`,
  mlm_temp.`Upline`,
  mlm.`group_play`
FROM
  mlm_temp,
  mlm
  WHERE mlm_temp.`ACCNO` = mlm.`ACCNO`
  AND rolldate = '$periode_date'
  AND mlm_temp.`Upline` = '$account'";
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
                $insert = "INSERT INTO mlm_comm SET ACCNO = '$parent', mlm_comm.from = '$accno', level = '$level', amount = '$commision', lot = '$cektrade', rolldate = '$periode_date'";
                $DB->execonly($insert);
            }
        } else {
            if (!($level > 9) && $commision != 0) {
                // echo $insert = "INSERT INTO mlm_comm SET ACCNO = '$parent', from = '$accno', level = '$level', amount = '$commision'" . "<br/>";
                $insert = "INSERT INTO mlm_comm SET ACCNO = '$parent', mlm_comm.from = '$accno', level = '$level', amount = '$commision', lot = '$cektrade', rolldate = '$periode_date'";
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
    $result = $DB->execresultset($query);
    return $result[0]['jumlah'];
}
function ewallets($account, $amount, $desc){
  global $DB;
  global $periode_date;
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
    tradeLogs('ACCNO '.$account . ' AMOUNT '.$amount . ' OLD AMOUNT '.$amount_old);
    $final = $amount + $amount_old;
    $update = "UPDATE mlm_ewallet SET balance = '$final' WHERE account = '$account'";
    $DB->execonly($update);

    $insert = "INSERT INTO mlm_ewallet_moving SET id_ewallet = '$id_wallet', amount = '$amount', cmd = '3', reason = '$desc', ref_number = 'askap_commision:".$periode_date."'";
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