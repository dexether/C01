<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
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

include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
$theFetchAccount = new theOtherFetchAccounts();
$cabang_admin = 'semua';
$accounts = $theFetchAccount->fetchAccountslangsung($user, $mysql['meta'], $cabang_admin);

$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}

$key = '';
if (isset($_SESSION['key'])) {
    $key = $_SESSION['key'];
}

$tools = new CTools();
$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
$variabel = explode("&", $data[0]); //a=1&account=802222&postmode=deposit&tradedby=ALBERTOSCARINA
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$account = $accountvariabel[1];
$lines = $lines . "&account=" . $account;
$linezip = gzcompress($lines);
$key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
$_SESSION['key'] = $key;

$accountcheck = myfilter($accounts, $account);
if ($accountcheck[0] == '') {
    display_error("107.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
} else {
    if (!empty($account) && $account != "all") {
        if (!in_array($account, $accounts)) {
            //TradeLogAccountList("Profile-111");
            display_error("111.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
        }
    }
    //TradeLogAccountList("Profile-115");
    $template->assign("accounts", $accounts);
    if (!empty($account)) {
        $template->assign("tradedby", $user->username);
        $template->assign("account", $account);
        $template->assign("error", "");
    }
}
$template->assign("account", $account);

//TradeLogAccountList("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}
$broker = '';
if (isset($_GET['broker'])) {
    $broker = $_GET['broker'];
}
$query = "SELECT mt4dt FROM mt_database WHERE UCASE(alias) LIKE ('$broker%');";
$result = $DB->execresultset($query);
foreach ($result as $row) {
    $mt4dt = $row['mt4dt'];
}

$_SESSION['page'] = 'account_list';

/* =======================================
  =            Start Of Coding            =
  ======================================= */

$query = "SELECT * FROM
            client_aecode,
            client_accounts,
            mlm,
            mt_database
            WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid` 
            AND client_accounts.`accountname` = mlm.`ACCNO` 
            AND client_aecode.aecode = '" . $user->username . "' AND mlm.mt4dt = mt_database.`mt4dt` 
            and  UCASE(mt_database. alias) LIKE ('$broker%') 
            and UCASE(mt_database. alias) not LIKE ('%DEMO%') 
            ";
//TradeLogAccountList($query);
//var_dump($query);
$result = $DB->execresultset($query);
$dataarray = array();
foreach ($result as $row) {
    $dataaccount['mt4dt'] = $row['mt4dt'];
    $dataaccount['ACCNO'] = $row['ACCNO'];
    $dataaccount['mt4login'] = $row['mt4login'];
    $dataaccount['mt4alias'] = $row['alias'];
    $dataarray[] = $dataaccount;
}
$accountarray = array();
foreach ($dataarray as $row) {

    $query = "SELECT * FROM " . $row['mt4dt'] . ".mt4_users WHERE LOGIN = '" . $row['mt4login'] . "' ";
    $result = $DB->execresultset($query);
    $result[0]['mt4alias'] = $row['mt4alias'];
    $accountarray[$row['ACCNO']] = $result;
}

/* =====  End of Start Of Coding  ====== */

$template->assign("realaccount", $accountarray);


$query = "SELECT * FROM
            client_aecode,
            client_accounts,
            mlm,
            mt_database
            WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid` 
            AND client_accounts.`accountname` = mlm.`ACCNO` 
            AND client_aecode.aecode = '" . $user->username . "' AND mlm.mt4dt = mt_database.`mt4dt` 
            and  UCASE(mt_database. alias) LIKE ('$broker%') 
            and UCASE(mt_database. alias) LIKE ('%DEMO%') 
            ";

//TradeLogAccountList($query);
$result = $DB->execresultset($query);
$dataarray2 = array();
foreach ($result as $row) {
    $dataaccount2['mt4dt'] = $row['mt4dt'];
    $dataaccount2['ACCNO'] = $row['ACCNO'];
    $dataaccount2['mt4login'] = $row['mt4login'];
    $dataaccount2['mt4alias'] = $row['alias'];
    $dataarray2[] = $dataaccount2;
}
$accountarray2 = array();
foreach ($dataarray2 as $row) {
    $query = "SELECT * FROM " . $row['mt4dt'] . ".mt4_users WHERE LOGIN = '" . $row['mt4login'] . "' ";
    $result = $DB->execresultset($query);
    $result[0]['mt4alias'] = $row['mt4alias'];
    $accountarray2[$row['ACCNO']] = $result;
}

/* =====  End of Start Of Coding  ====== */

$template->assign("demoaccount", $accountarray2);





$template->display("account_list.htm");

function myfilter($input_var_outer, $param) {
    global $var_to_pass;
    $var_to_pass = $param;

    function mycallback($input_var_inner) {
        global $var_to_pass;
        return ($input_var_inner == $var_to_pass) ? true : false;
    }

    $return_arr = array_filter($input_var_outer, 'mycallback');
    $return_arr = array_merge(array(), $return_arr);
    return $return_arr;
}

function TradeLogAccountList($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>