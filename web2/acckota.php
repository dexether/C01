<?php

ini_set('memory_limit', '-1');
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;

if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
if ($user->groupid != '9') {
    display_error("15.You do not have permission to access this page.<br>If you feel this is an error, please contact the Programmer.");
}
include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
$theFetchAccount = new theOtherFetchAccounts();
$cabang_admin = 'semua';
$accounts = $theFetchAccount->fetchAccountslangsung($user, $mysql['meta'], $cabang_admin);

//tradeLogAcc_Kota("AccKota.php-Line-9");
$_SESSION['page'] = 'acckota';

$updatetable = "no";
if (isset($_GET['updatetable'])) {
    $updatetable = $_GET['updatetable'];
}
if ($updatetable == 'yes') {
    $mysqldatabases = array();
    $query = "SELECT alias,mt4dt,enabled FROM mt_database where enabled='yes' ORDER BY alias ASC";
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $mysqldatabases[] = $row;
    }

    for ($icount = 0; $icount < count($mysqldatabases); $icount++) {
        $mt4dt = $mysqldatabases[$icount]['mt4dt'];
        $mt4alias = $mysqldatabases[$icount]['alias'];
        //tradeLogAcc_Kota("AccKota-34:" . $mt4alias . ";" . $mt4dt);

        $query = "SELECT mt4_daily.TIME FROM " . $mt4dt . ".mt4_daily ORDER BY mt4_daily.TIME DESC LIMIT 0,1 ";
//tradeLogAcc_Kota("AccKota.php-Line-39:".$query);
        $rows = $DB->execresultset($query);
        $timeakhir = '';
        foreach ($rows as $row) {
            $timeakhir = $row['TIME'];
        }

        $query = "SELECT mt4_users.* FROM " . $mt4dt . ".mt4_users ORDER BY login ASC; ";
//tradeLogAcc_Kota("AccKota.php-Line-47:".$query);
        $rows = $DB->execresultset($query);
        foreach ($rows as $row) {
            $thelogin = $row['LOGIN'];
            $row['mt4dt'] = $mt4dt;
            $row['mt4alias'] = $mt4alias;
            $row['kliringlogin'] = anti_injection($row['NAME']);
            $row['branch'] = 'kota';
            $row['thegroup'] = anti_injection($row['GROUP']);
            $row['aecode'] = '1';
            $row['comment'] = 'No Comment';
            $checkkliring = strtolower($row['kliringlogin']);
            $row['rate'] = 'none';
            if (strpos($checkkliring, 'floating') !== false) {
                $row['rate'] = '0';
            }
            if (strpos($checkkliring, '6000') !== false) {
                $row['rate'] = '6000';
            }
            if (strpos($checkkliring, '10000') !== false) {
                $row['rate'] = '10000';
            }
            if (strpos($checkkliring, '12000') !== false) {
                $row['rate'] = '12000';
            }            
            if (strpos($checkkliring, 'rp') !== false) {
                $row['rate'] = '1';
            }
            //tradeLogAcc_Kota("AccKota-80-Login:" . $thelogin.";Rate:".$row['rate']);
            $ambil_huruf_kedua = substr($row['thegroup'],1,1);
            //tradeLogAcc_Kota("AccKota-78-HurufKedua:" . $row['thegroup'].";".$ambil_huruf_kedua);
            $ambil_huruf_kedua = strtolower($ambil_huruf_kedua);
            $row['type'] = 'regular';
            if($ambil_huruf_kedua=='m'){
                $row['type'] = 'mini';
            }            
            $statements2[$mt4alias][$thelogin] = $row;
        }
    }//for ($icount = 0; $icount < count($mysqldatabases); $icount++) {


    foreach ($statements2 AS $mysql_meta1 => $mysql_meta2) {
        foreach ($mysql_meta2 AS $mt_login => $statement2) {
            $query = "SELECT * FROM acc_kota WHERE mt4dt='" . $statement2['mt4dt'] . "' AND login = '$mt_login';";
            //tradeLogAcc_Kota("AccKota-67:" . $query);
            $rows = $DB->execresultset($query);
            $adadata = "tidak";
            foreach ($rows as $row) {
                $adadata = "ada data";
            }//foreach ($rows as $row) {
            if ($adadata == 'tidak') {
                $query = "insert into acc_kota set login = '$mt_login',kliringlogin='" . $statement2['kliringlogin'] . "',
                mt4dt='" . $statement2['mt4dt'] . "',branch='" . $statement2['branch'] . "',
                acc_kota.group='" . $statement2['thegroup'] . "',aecode='" . $statement2['aecode'] . "',
                comment='" . $statement2['comment'] . "',rate='" . $statement2['rate'] . "',regular='" . $statement2['type'] . "'";
                //tradeLogAcc_Kota("AccKota-101:" . $query);
                $DB->execonly($query);
            }
        }//foreach ($mysql_meta2 AS $mt_login => $statement2) {
    }//foreach ($statements2 AS $mysql_meta1 => $mysql_meta2) {
    echo 0;
}//if($updatetable=='yes'){
else {
    $query = "SELECT mt_database.alias,acc_kota.mt4dt 
    FROM acc_kota,mt_database 
    WHERE acc_kota.mt4dt = mt_database.mt4dt 
    GROUP BY acc_kota.mt4dt ORDER BY acc_kota.mt4dt ASC";
    //tradeLogAcc_Kota("AccKota-96:" . $query);
    $rows = $DB->execresultset($query);
    $statements_filter = array();
    foreach ($rows as $row) {
        //tradeLogAcc_Kota("AccKota-96:" . $row['alias'] . ";" . $row['mt4dt']);
        $statements_filter[] = $row;
    }
    $template->assign("statements_filter", $statements_filter);

    $mt4dt = "";
    if (isset($_GET['mt4dt'])) {
        $mt4dt = $_GET['mt4dt'];
    }
    $template->assign("mt4dtselect", $mt4dt);

    $query = "SELECT acc_kota.*,mt_database.alias FROM acc_kota,mt_database 
    where acc_kota.mt4dt = mt_database.mt4dt 
    and acc_kota.mt4dt = '$mt4dt' 
    order by acc_kota.mt4dt asc, acc_kota.login asc";
    //tradeLogAcc_Kota("AccKota-113:".$query);
    $rows = $DB->execresultset($query);
    $statements3 = array();
    foreach ($rows as $row) {
        $statements3[$row['alias']][$row['login']] = $row;
    }

    $template->assign("statements3", $statements3);
}////if($updatetable=='yes'){


$template->display("acckota.htm");

function tradeLogAcc_Kota($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>