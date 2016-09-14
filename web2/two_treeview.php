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



//TradeLogTreView("Profile-66-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'two_treeview';

/* Conditional Acoount */
$usernya = $user->groupid;
$condiional = "";
if ($usernya==9) {
    $condiional = "AND mlm.Upline = 'COMPANY' AND mlm.ACCNO <> 'COMPANY'";
    $condiional_header = "<ul><li>COMPANY<ul>";
    $condiional_footer = "</ul></li></ul>";
}else{
    $condiional = "AND client_aecode.aecode = '" . $user->username . "'";
    $condiional_header = "<ul>";
    $condiional_footer = "</ul>";
}

$query = "SELECT client_aecode.name, client_aecode.email, client_accounts.`accountname`,mlm.*
        FROM client_aecode,client_accounts,mlm
        WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
        AND client_accounts.`suspend` = '0'
        AND client_accounts.`accountname` = mlm.`ACCNO`
        AND mlm.group_play = 'twofrx'
          $condiional
        ";



$datatress = array();
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    //TradeLogTreView("TreView-83:".$row['ACCNO']);
    $datatress[$row['ACCNO']] = $row;
}
$longtree = $condiional_header;
if (count($datatress) > 0) {
    foreach ($datatress AS $ACCNO1 => $datatres) {
        //TradeLogTreView("TreView-87:" . $ACCNO1);
        $longtree = $longtree . "<li>" . $ACCNO1  . " - ". $datatres['name'];
        $longtree = updatechild($longtree, $ACCNO1);
        $longtree = $longtree . "</li>";
    }
    //foreach ($datatress AS $ACCNO => $datatres) {
}//if(count($datatress)>0){
$longtree = $longtree . $condiional_footer;
//TradeLogTreView("longtree-97:".$longtree);
$template->assign("longtree", $longtree);

$template->display("imp_treeview.htm");

function updatechild($longtree, $ACCNO2) {
    $longtree = $longtree . "<ul>";
    global $DB;
    $datatress = array();
    $query = "SELECT client_aecode.name, client_aecode.email, client_accounts.`accountname`,mlm.*
    FROM client_aecode,client_accounts,mlm
    WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
    AND client_accounts.`suspend` = '0'
    AND client_accounts.`accountname` = mlm.`ACCNO`
    AND mlm.Upline = '$ACCNO2'
    AND mlm.group_play = 'twofrx'

    ";

    //TradeLogTreView("TreView-111:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        //TradeLogTreView("TreView-104:".$row['ACCNO']);
        $datatress[$row['ACCNO']] = $row;
    }
    if (count($datatress) > 0) {
        foreach ($datatress AS $ACCNO1 => $datatres) {
            //TradeLogTreView("TreView-112:" . $ACCNO1);
            $longtree = $longtree . "<li>" . $ACCNO1 . " - ". $datatres['name'];
            $longtree = updatechild($longtree, $ACCNO1);
            $longtree = $longtree . "</li>";
        }//foreach ($datatress AS $ACCNO => $datatres) {
    }//if(count($datatress)>0){
    $longtree = $longtree . "</ul>";
    //TradeLogTreView("TreView-126:" . $longtree);
    return $longtree;
}

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

function TradeLogTreView($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>
