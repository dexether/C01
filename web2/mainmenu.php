<?php


$skip_authentication = '0';
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
include_once("includes/wr_tools.php");
global $user;
global $template;
global $DB;
$template->clear_all_cache();
include("$_SERVER[DOCUMENT_ROOT]/_settings/config.php");
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
    $companys = $rows;
    $companys['year'] = $years;
}
$template->assign("companys", $companys);
function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

//tradeLog("MainMenu-26-Username:".$user->username);
if (!isset($user)) {
    display_logout("MainMenu No.28. Please login again.", "Re-Login", "index.php");
}
$theFetchAccount = new theOtherFetchAccounts();
$cabang_admin = 'semua';
$accounts = $theFetchAccount->fetchAccountslangsung($user, $mysql['meta'], $cabang_admin);

$tools = new CTools();
if (isset($key)) {
    $key = '';
}

if (isset($_SESSION['key'])) {
    $key = $_SESSION['key'];
}

if (!isset($_GET['key'])) {
    if (isset($_SESSION['key'])) {
        $key = $_SESSION['key'];
    }

    if (!isset($key)) {
        $account = $accounts[0];
    }
} else {
    $key = $_GET['key'];
}
if (isset($key)) {
    //tradelog("mainmenu-55:".$key);
    $tools = new CTools();
    $data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
    $data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
    $variabel = explode("&", $data[0]); //a=1&account=802222&postmode=deposit&tradedby=ALBERTOSCARINA    
    $accountlink = $variabel[1]; //account=1234567
    $accountvariabel = explode("=", $accountlink);
    //tradelog("MainMenu-62-Accountvariabel:".$accountvariabel);
    $account = $accountvariabel[1];
    //tradelog("MainMenu-64-Account:".$account);
    if ($account == 'dummy') {
        $result = count($accounts);
        $result = $result - 1;
        $account = $accounts[$result];
    }
} else {
    $result = count($accounts);
    $result = $result - 1;
    $account = $accounts[$result];
    //tradelog("mainmenu-73-Account:".$account);
    $lines = $lines . "&account=" . $account;
    $linezip = gzcompress($lines);
    $key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
    //tradelog("mainmenu-78-linezip:".$linezip.";crypt_key:".$crypt_key);
    $_SESSION['key'] = $key;
    //tradelog("mainmenu-80-key:".$key);
}

if ($account == '') {
    $account = $accounts[0];
}
if ($account == '') {
    display_error("MainMenu No.82.Time is up<br>Please login again.");
}
//tradelog("mainmenu-84-Account:".$accounts[0]);
if ($accounts[0] == '') {
    display_error("86.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
} else {
    //tradelog("mainmenu-88-Account:".$accounts[0]);
    if (!empty($account) && $account != "all") {
        if (!in_array($account, $accounts)) {
            //tradelog("SelectAccount-91-Account:".$account);
            if ($_SESSION['page'] == 'underconstruction') {
                //tradelog("SelectAccount-93");
            } else {
                //tradelog("SelectAccount-95");
                display_error("Error No.96. Sorry, Your Account is not there yet / Your time is finish.<br>Please login again.");
            }
        }
    }
    if (!empty($account)) {
        $template->assign("tradedby", $user->username);
        $template->assign("account", $account);
        $template->assign("error", "");
    }
    $lines = $lines . "&account=" . $account;
}
//tradelog("mainmenu-107-Account:".$account);
//tradelog("mainmenu.php-110:".$account.";".$user->companygroup);
if (!isset($_SESSION['page'])) {
    $_SESSION['page'] = '';
}
//tradelog("mainmenu-117-Session:" . $_SESSION['page']);

// Logic
if (empty($_SESSION['page'])) {
$thepage = $companys['dashboard_page'];    
}else{
    $thepage = $_SESSION['page'].".php";
}

$database_ips = array();
$query = "SELECT * FROM mt_log WHERE enabled='yes' ORDER BY alias ASC";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $database_ips[] = $row;
}

$thecount = count($database_ips);
for ($icount = 0; $icount < $thecount; $icount++) {
    if (!isset($database_ips[$icount])) {
        $database_ip = null;
    } else {
        $database_ip = $database_ips[$icount];
    }
    //tradelog("mainmenu-162-Thepage:" . $database_ip['alias']);
    if ($_SESSION['page'] == $database_ip['mt4dt']) {
        $_SESSION['page'] = '';
        $thepage = $database_ip['namafile'];
    }
}
if ($user->groupid == '9' || $user->username == 'info01@si.co.id') {
    $template->assign("database_ips", $database_ips);
    //tradelog("mainmenu-167");
    if ($_SESSION['page'] == 'report_turnover_running') {
        $_SESSION['page'] = '';
        $thepage = "report_turnover_running.php";
    }
    if ($_SESSION['page'] == 'report_equity') {
        $_SESSION['page'] = '';
        $thepage = "report_equity.php";
    }
    if ($_SESSION['page'] == 'logip') {
        $_SESSION['page'] = '';
        $thepage = "logip.php";
    }
    if ($_SESSION['page'] == 'checklicense') {
        $_SESSION['page'] = '';
        $thepage = "checklicense.php";
    }
    if ($_SESSION['page'] == 'mql5_146316') {
        //tradelog("mainmenu.php-168");
        $thepage = "mql5_146316.php";
    }
    if ($_SESSION['page'] == 'acckota') {
        //tradelog("mainmenu.php-168");
        $thepage = "acckota.php";
    }
    if ($_SESSION['page'] == 'mlm_registration') {
        $_SESSION['page'] = '';
        $thepage = "mlm_registration.php";
    }
}


//tradelog("mainmenu-246-Session Page:" . $_SESSION['page'] . ";" . $thepage);
$template->assign("pagenya", $thepage);


$check = $template->clear_compiled_tpl("mainmenu.php");
//tradelog("mainmenu-186-Session Check:" . $check);

$template->display("mainmenu.htm");
?>