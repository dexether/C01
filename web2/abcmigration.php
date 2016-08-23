<?php
tradeLogs('START');
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
include_once "includes/wr_tools.php";
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;
/*
if (isset($user)) {
$user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);
 */
/*==============================
=            Coding            =
==============================*/

// $source = array('askap_source_mini', 'askap_source_reguler');

$query  = "SELECT * FROM abc_sys WHERE UPLINE IN (SELECT DISTINCT(mt4login) FROM mlm2) GROUP BY ACCOUNT ORDER BY EMAIL ASC";
// $query  = "SELECT * FROM abc_sys GROUP BY ACCOUNT";
$result = $DB->execresultset($query);

// var_dump($result);
foreach ($result as $key => $value) {

    $cekitfirst = checkmlm($value['EMAIL'], $value['UPLINE_EMAIL']);
    // var_dump($cekitfirst);
    if ($cekitfirst['valid'] == true) {
        // Sudah ada INSERT TO mlm2
        // $login           = explode('.', $value['ACCOUNT']);
        $LOGIN           = $value['ACCOUNT'];
        $accountnamebaru = $cekitfirst['accountname'];
        $query           = "SELECT LOGIN FROM askap_source_mini.`mt4_users` WHERE askap_source_mini.`mt4_users`.`LOGIN` = '$LOGIN'";
        $hasil           = $DB->execresultset($query);
        if (empty($hasil)) {
            $query  = "SELECT LOGIN FROM askap_source_reguler.`mt4_users` WHERE askap_source_reguler.`mt4_users`.`LOGIN` = '$LOGIN'";
            $hasil  = $DB->execresultset($query);
            $insert = "INSERT INTO mlm2 SET ACCNO = '$accountnamebaru', mt4dt = 'askap_source_reguler', mt4login = '$LOGIN'";
            $DB->execonly($insert);

            $delete = "DELETE FROM abc_sys WHERE ACCOUNT = '$LOGIN'";
            $DB->execonly($delete);
        } else {
            $insert = "INSERT INTO mlm2 SET ACCNO = '$accountnamebaru', mt4dt = 'askap_source_mini', mt4login = '$LOGIN'";
            $DB->execonly($insert);

            $delete = "DELETE FROM abc_sys WHERE ACCOUNT = '$LOGIN'";
            $DB->execonly($delete);
        }
        // Delete IF Success

    } else {
        $query = "SELECT
   client_accounts.`accountname`,
   client_aecode.email,
   client_aecode.name,
   client_aecode.aecodeid,
   client_aecode.status
   FROM
   client_aecode,
   client_accounts
   WHERE client_aecode.`aecode` = '$value[UPLINE_EMAIL]'
   AND client_aecode.`aecodeid` = client_accounts.`aecodeid`
   AND client_aecode.status = '1'
   AND client_accounts.suspend = '0'
   ORDER BY client_accounts.`accountname` DESC
   LIMIT 0, 1 ";
        $adaae      = 'noae';
        $rows       = $DB->execresultset($query);
        $lastaccout = 0;
        foreach ($rows as $row) {
            $adaae      = 'adaae';
            $aecodeid   = $row['aecodeid'];
            $lastaccout = $row['accountname'];
        }
        if ($adaae == 'adaae') {
            # code...

            $last            = 0;
            $update_tradeby  = 'abc_systems';
            $rolldate        = date('Y-m-d', time());
            $accountnamebaru = check_account($update_tradeby, $last);
            tradeLogs('ACCNO :' . $value['EMAIL'] . 'UPLINE ' . $value['UPLINE_EMAIL'] . 'MLM ' . $accountnamebaru);
            $query = "SELECT client_aecode.`aecodeid` FROM client_aecode WHERE client_aecode.`aecode` = '$value[EMAIL]'";
            //tradeLogMMNewLevel("MM_New_Level-131-Query:" . $query);
            $rows = $DB->execresultset($query);
            foreach ($rows as $row) {
                $usernya = $row;
            }
            $query = "INSERT INTO client_accounts SET " .
                "aecodeid = '" . $usernya['aecodeid'] . "', " .
                "accountname = '" . $accountnamebaru . "', " .
                "name = '" . $accountnamebaru . "', " .
                "address = '', " .
                "telephone_home = '', " .
                "telephone_office = '', " .
                "telephone_mobile = '', " .
                "suspend = '0', " .
                "email = '', " .
                "daycall = '0', " .
                "nightcall = '0', " .
                "`float_rate` = '0', " .
                "telephone_fax = '', " .
                "last_updated = NOW(), " .
                "status = 'normal', " .
                "rolldate='" . $rolldate . "', " .
                "sendmethod = 'Email'";
            // var_dump($query);
            $DB->execonly($query);
            // Select Account that upline mine
            $query = "insert into mlm set
 mt4dt = 'nometa',
 ACCNO='$accountnamebaru',
 Upline = '$lastaccout',
 datetime = NOW(),
 companyconfirm = '2',
 payment = '0',
 group_play = 'no_plan',
 updateby = '$update_tradeby'
 ";

            $DB->execonly($query);
// Cek mlm2 metalogin

            // $login = explode('.', $value['ACCOUNT']);
            $LOGIN = $value['ACCOUNT'];

            $query = "SELECT LOGIN FROM askap_source_mini.`mt4_users` WHERE askap_source_mini.`mt4_users`.`LOGIN` = '$LOGIN'";
            $hasil = $DB->execresultset($query);
            if (empty($hasil)) {
                $query  = "SELECT LOGIN FROM askap_source_reguler.`mt4_users` WHERE askap_source_reguler.`mt4_users`.`LOGIN` = '$LOGIN'";
                $hasil  = $DB->execresultset($query);
                $insert = "INSERT INTO mlm2 SET ACCNO = '$accountnamebaru', mt4dt = 'askap_source_reguler', mt4login = '$LOGIN'";
                $DB->execonly($insert);
                $delete = "DELETE FROM abc_sys WHERE ACCOUNT = '$LOGIN'";
                $DB->execonly($delete);
            } else {
                $insert = "INSERT INTO mlm2 SET ACCNO = '$accountnamebaru', mt4dt = 'askap_source_mini', mt4login = '$LOGIN'";
                $DB->execonly($insert);
                $delete = "DELETE FROM abc_sys WHERE ACCOUNT = '$LOGIN'";
                $DB->execonly($delete);
            }
        } else {

        }
    }
    // echo "<pre>";
    // print_r($insert);
    // echo "</pre>";

}

function check_account($update_tradeby, $last)
{
    global $DB;
    //$waktucheck1 = date('ymdH'); //2014 Aug 21 21:03:55
    $waktucheck1 = date('ymdH', strtotime('-1 hour'));
    $query       = "select * from mlm where ACCNO  like ('$waktucheck1%') order by ACCNO desc limit 0,1";
    //tradeLogMMNewLevel("MM_New_Level-378:".$query);
    $lastACCNO = 0;
    $rows      = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO = $row['ACCNO'];
    }
    $val1 = strlen($lastACCNO); //150403110000001
    $val2 = substr($lastACCNO, 8, $val1);
    //tradeLogMMNewLevel("MM_New_Level-386-Val1;".$val1.";Val2::".$val2);
    $val3 = intval($val2);
    //tradeLogMMNewLevel("MM_New_Level-239-Va32::".$val3);
    if ($last == '0') {
        $last = $val2 + 1;
    } else {
        $last = $last + 1;
    }

    //tradeLogMMNewLevel("MM_New_Level-241-Last:".$last);

    $account_name_check = $waktucheck1 . $last;
    //tradeLogMMNewLevel("MM_New_Level-397:".$account_name_check);//MM_New_Level-246:A000001

    $query = "select * from mlm where ACCNO  = '$account_name_check'";
    //tradeLogMMNewLevel("MM_New_Level-399-Query:".$query);//Query
    $is_accountname_already_taken = "no";
    $rows                         = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO                    = $row['ACCNO'];
        $is_accountname_already_taken = "yes";
    }

    $query = "select * from client_accounts where accountname='$account_name_check'";
    //tradeLogMMNewLevel("mm_new_level-301-query:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO                    = $row['accountname'];
        $is_accountname_already_taken = "yes";
    }

    if ($is_accountname_already_taken == "yes") {
        $accountname = check_account($update_tradeby, $last);
    } else {
        $accountname = $account_name_check;
    }
    return $accountname;
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
function checkmlm($aecode, $upline_aecode)
{
    global $DB;
    $output = array();
    $query  = "SELECT
  client_accounts.`accountname`
FROM
  client_accounts,
  client_aecode,
  mlm
WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
  AND client_accounts.`accountname` = mlm.`ACCNO`
  AND client_aecode.`aecode` = '$upline_aecode'";
    $result = $DB->execresultset($query);
    $upline = 0;
    foreach ($result as $key => $value) {
        $upline = $value['accountname'];
    }

    $query = "SELECT
  client_accounts.`accountname`
FROM
  client_accounts,
  client_aecode,
  mlm
WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
  AND client_accounts.`accountname` = mlm.`ACCNO`
  AND client_aecode.`aecode` = '$aecode'
  AND mlm.Upline  = '$upline'";
    $result          = $DB->execresultset($query);
    $output['valid'] = false;
    foreach ($result as $key => $value) {
        $output['valid']       = true;
        $output['accountname'] = $value['accountname'];
    }
    return $output;
}
