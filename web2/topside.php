<?php

include_once("../includes/functions.php");
include_once("../classes/Manager.class.php");
include_once("includes/wr_tools.php");

global $user;
global $template;
global $mysql;
global $DB_odbc;
global $DB;
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}
//tradeLogProfile("Profile-17-Crypt_key:" . $crypt_key);
$var_to_pass = null;

$theFetchAccount = new theOtherFetchAccounts();
$cabang_admin = 'semua';
$accounts = $theFetchAccount->fetchAccountslangsung($user,$mysql['meta'],$cabang_admin);

/* * ***************************************************************************
 * DISPLAY ACCOUNT                                                            *
 * *************************************************************************** */
$key = $_SESSION['key'];

$tools = new CTools();
$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
//tradeLogProfile("Profile-82-Data:" . $data);
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
//tradeLogProfile("deposit-84-data:" . $data[0]);
$variabel = explode("&", $data[0]); //a=1&account=802222&postmode=deposit&tradedby=ALBERTOSCARINA
//tradeLogProfile("deposit-86-variable:" . $variabel);
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$account = $accountvariabel[1];


$httphost = $_SERVER['HTTP_HOST'];
$httphost = strtolower($httphost);
$ipnya_host = 'pgb';
$url_logo = "<img src='images/logo/sicoid/sicoid_logo.png' alt='Logo' height='5' width='5'>";
//tradelog("topside-20-Url_logo:".$url_logo);
$template->assign("url_logo", $url_logo);


$direpalce0 = $user->username;
$direpalce1 = str_replace("@", "_", $direpalce0);
$direpalce2 = str_replace(".", "__", $direpalce1);
$dir = "C:/Project/FileUpload/fileupload_foto/" . $direpalce2 . "/";
//tradeLogTop("TopSide-95-Dir:" . $dir);
$file_display = array('jpg', 'jpeg', 'png', 'gif');

function listFolderFiles2($dir2, $file_display) {
    global $user;
    //tradeLogProfile("Profile-142-Dir:" . $dir2);
    $urlnya2 = "none";
    if (is_dir($dir2)) {
        //tradeLogProfile("Profile-145");
        $ffs = scandir($dir2);
        //tradeLogProfile("Profile-147-Count:" . count($ffs));
        foreach ($ffs as $ff) {
            if ($ff != '.' && $ff != '..') {
                $haiya = explode('.', $ff);
                $file_type = strtolower(end($haiya));
                //echo '&nbsp;&nbsp;&nbsp; FileType :' . $file_type;
                if ($ff !== '.' && $ff !== '..' && in_array($file_type, $file_display) == true) {
                    $imgPath = $dir2 . "/" . $ff;
                    //tradeLogProfile("Profile-154:" . $imgPath);
                    $content = file_get_contents($imgPath);
                    $imgData = base64_encode($content);
                    $urlnya2 = "<img src='data:image/jpeg;base64, $imgData' alt='$user->username' align='middle' style='width:100%;height:100%;'  />";
                }
            }
        }//foreach ($ffs as $ff) { 
    }//if (is_dir($dir2)) {
    //tradeLogTop("TopSide-45-Urlnya:" . $urlnya2);
    return $urlnya2;
}

$query = "SELECT foto FROM client_aecode WHERE aecode = '$user->username'";
$result = $DB->execresultset($query);
$fotonya = '';
foreach($result as $row){
    $fotonya = $row['foto'];
}
$urlnya2 = listFolderFiles2($dir, $file_display);
$template->assign('fotonya', $fotonya);

$query = "SELECT company_logo, appurl FROM usercompany";
$result = $DB->execresultset($query);
foreach ($result as $key => $value) {
    # code...
    $data = $value;
}

$template->assign('logonya', $data['company_logo']);
$template->assign('url', $data['appurl']);
$template->display("topside.htm");

/* * ***************************************************************************
 * FETCH ALL ACCOUNTS ASSOCIATED WITH USERNAME                                *
 * *************************************************************************** */

function fetchAccounts2($username, $isadmin = 0) {
    global $DB_odbc;
    global $user;

    if ($isadmin) {
        $query = "SELECT trim(accountname) AS account FROM client_accounts where accountname !='' ORDER BY accountname asc";
    } else {
        if ($user->groupid == '3') {
            $query = "select accountreal from user where username = '" . $username . "' ";
            $result = $DB_odbc->query($query);
            $accounts_panjang = "";
            while ($row = $DB_odbc->fetch_array($result)) {
                $accounts_panjang = $row[accountreal];
            }
            if ($accounts_panjang != '') {
                $accounts = explode(",", $accounts_panjang);
            }
        }
        if ($user->tradingtype == 'AccNo') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE " . $user->tradingtype . "='$username' ORDER BY AccNo";
        }
        if ($user->groupid == '2') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE AccNo='$username' ORDER BY AccNo";
        }
        if ($user->groupid == '3') {
            $query = "SELECT TRIM(client_accounts.accountname) AS account 
                FROM client_accounts,client_aecode  
                WHERE client_accounts.accountname !='' 
                AND client_accounts.aecodeid = client_aecode.aecodeid 
                AND client_aecode.aecode = '" . $username . "' 
                ORDER BY client_accounts.accountname ASC";
        }
        if ($user->groupid == '4' || $user->groupid == '5') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile.AeCode='$user->userfield_aecode' ORDER BY AccNo";
        }
        if ($user->tradingtype == 'Group') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile." . $user->tradingtype . "='$user->userfield_group' ORDER BY AccNo";
        }
    }
    //tradeLogProfile("tempstatement-257=".$query);
    $result = $DB_odbc->query($query);
    while ($row = $DB_odbc->fetch_array($result)) {
        $accounts[] = $row[account];
    }
    if ($accounts[0] == '') {
        $accounts[0] = 'dummy';
    }
    return $accounts;
}

/* * ***************************************************************************
 * FETCH ALL BRANCHES/ACCOUNTS (ADMINISTRATOR/SUPERVISOR)                     *
 * *************************************************************************** */

function fetchBrancheGroups2() {
    global $DB_odbc;

    $query = "SELECT trim(Branch) AS branchid, trim(AccNo) AS account FROM bafile ORDER BY AccNo";

    $result = $DB_odbc->query($query);
    while ($row = $DB_odbc->fetch_array($result)) {
        $branches[$row[branchid]][] = $row[account];
    }
    return $branches;
}

function tradeLogTop($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>