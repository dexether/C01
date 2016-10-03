<?php

//http://www.mathsisfun.com/numbers/hexadecimal-color-names.html untuk color
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");

session_start();

global $user;
global $mysql;
global $tools;
global $template;
global $DB;
$lines = "a=1";

if ($mysql[crypt_key] != '') {
    $crypt_key = $mysql[crypt_key];
}
//tradeLogDashBoard("DashBoard-14:" . $crypt_key);

if ($user->groupid=='9') {
    $branches = fetchBrancheGroups();
    $accounts = fetchAccounts("", $user->groupid=='9', $user->companygroup);
} elseif ($user->ismanager || $user->groupid == 8) {
    $manager = new Manager($user->getUserid());
    $manager->fetchBrancheGroups($DB_odbc);
    $branches = $manager->getBrancheGroups();
    $accounts = $manager->getAccounts();
} elseif ($user->groupid == 1) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username, '0', $user->companygroup);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 2) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username, '0', $user->companygroup);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 3) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username, '0', $user->companygroup);
} elseif ($user->groupid == 4) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username, '0', $user->companygroup);
} elseif ($user->groupid == 5) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username, '0', $user->companygroup);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 11) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username, '0', $user->companygroup);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 12) {
    $manager = new Manager($user->userid);
    $manager->fetchBrancheGroups($DB_odbc);
    $manager_accounts = $manager->getAccounts();
    for ($i = 0; $i < count($manager_accounts); $i++) {
        $accounts[$manager_accounts[$i]] = $manager_accounts[$i];
        if (empty($account_init)) {
            $account_init = $manager_accounts[0];
        }
    }
}

if (!$_GET[key]) {
    $key = $_SESSION['key'];
    if (count($key) < 1) {
        display_error("77. You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
    }
} else {
    $key = $_GET[key];
}

$_SESSION[page] = 'dashboard';
//tradeLogDashBoard("DashBoard-131:" . $key);
$tools = new CTools();
$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
//tradeLogDashBoard("DashBoard-118-data:" . $data[0]);
$variabel = explode("&", $data[0]); //a=1&account=1234567
$accountlink = $variabel[1]; //account=1234567
$variabel = explode("=", $accountlink);
$account = $variabel[1];
//tradeLogDashBoard("DashBoard-78:" . $account);
if ($account == 'dummy') {
    $account = $accounts[0];
}
if ($account == '') {
    $account = $accounts[0];
}

if ($account[0] == '') {
    display_error("85.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
} else {
    if (!empty($account) && $account != "all") {
        if (!in_array($account, $accounts)) {
            display_error("89.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
        }
    }
    for ($icount = 0; $icount < count($accounts); $icount++) {
        $accountkey = "a=1&account=" . $accounts[$icount];
        $accountkey = $accountkey . "&page=dashboardawal2";
        //tradeLogDashBoard("DashBoard-139:".$accountkey);
        $linezip = gzcompress($accountkey);
        $key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
        //tradeLogDashBoard("mainmenu-142-key:" . $key);
        $accountskey[$accounts[$icount]][key] = $key;
    }
    $template->assign("accounts", $accountskey);

    if (!empty($account)) {
        $template->assign("tradedby", $user->username);
        $template->assign("account", $account);
        $template->assign("error", "");
    }
}
$template->assign("key", $key);

//tradeLogDashBoard("deposit-79-Account:" . $account);
$cekstatusmoney = '';
$dataACCNO[accountname] = $account;
$dataACCNO[colorstatus] = 'statusred';
$query = "SELECT mlm.*   
        FROM mlm   
        WHERE 
        mlm.ACCNO = '$account' ";
$result = $DB->query($query);
while ($row = $DB->fetch_array($result)) {
    $group_play = $row[group_play];
    if ($group_play == '1T') {
        $cekstatusmoney = "SGD 1.000";
    }
    if ($group_play == '3T') {
        $cekstatusmoney = "SGD 3.000";
    }
    if ($group_play == '5T') {
        $cekstatusmoney = "SGD 5.000";
    }
    if ($group_play == '10T') {
        $cekstatusmoney = "SGD 10.000";
    }
}
$template->assign("cekstatusmoney", $cekstatusmoney);

$query = "SELECT mlm.Upline,
        mlm.companyconfirm,mlm.payment, 
        client_accounts.*,client_aecode.name as aename,
        client_aecode.nametengah,client_aecode.nameakhir,
        client_aecode.status as aestatus,client_aecode.suspend as aesuspend  
        FROM mlm,client_accounts,client_aecode   
        where 
        mlm.ACCNO='$account' 
        and mlm.ACCNO = client_accounts.accountname 
        and client_aecode.aecodeid = client_accounts.aecodeid ";
//tradeLogDashBoard("DashBoard-151-Query:" . $query);
$result = $DB->query($query);
while ($row = $DB->fetch_array($result)) {
    $row[colorstatus] = 'statusgrey';
    if ($row[companyconfirm] == '2' || $row[companyconfirm] == '3' || $row[companyconfirm] == '4') {
        $row[colorstatus] = 'statusgreen';
    }
    if ($row[status] != 'normal') {
        $row[colorstatus] = 'statusred';
    }
    if ($row[aestatus] != '1') {
        $row[colorstatus] = 'statusred';
    }
    if ($row[aesuspend] != '0') {
        $row[colorstatus] = 'statusred';
    }
    if ($row[companyconfirm] == '5') {
        $row[colorstatus] = 'statusred';
    }
    $dataACCNO = $row;
}
//tradeLogDashBoard("DashBoard-124-Query:" . $dataACCNO[approve1].";".$query);
$template->assign("dataACCNO", $dataACCNO);


$jumlahanak = 2;
for ($icountanak = 0; $icountanak < $jumlahanak; $icountanak++) {
    $row[ACCNO] = "";
    $row[aename] = '&nbsp;';
    $row[colorstatus] = 'statusgrey';
    $anaks[$icountanak] = $row;
}

$query = "SELECT mlm.Upline,mlm.ACCNO,
        mlm.companyconfirm,mlm.payment, 
        client_accounts.*,client_aecode.name as aename,
        client_aecode.nametengah,client_aecode.nameakhir,
        client_aecode.status as aestatus,client_aecode.suspend as aesuspend  
        FROM mlm,client_accounts,client_aecode   
        where 
        mlm.Upline='$account' and mlm.ACCNO<>'$account' 
        and mlm.ACCNO = client_accounts.accountname 
        and client_aecode.aecodeid = client_accounts.aecodeid  
        order by mlm.datetime asc limit 0,2";
//tradeLogDashBoard("Dashboardawal-192-Query:" . $query);//dapatin Level 1
$result = $DB->query($query);
$anak = 0;
while ($row = $DB->fetch_array($result)) {
    $row[colorstatus] = 'statusgrey';
    if ($row[companyconfirm] == '2' || $row[companyconfirm] == '3' || $row[companyconfirm] == '4') {
        $row[colorstatus] = 'statusgreen';
    }
    if ($row[status] != 'normal') {
        $row[colorstatus] = 'statusred';
    }
    if ($row[aestatus] != '1') {
        $row[colorstatus] = 'statusred';
    }
    if ($row[aesuspend] != '0') {
        $row[colorstatus] = 'statusred';
    }
    if ($row[companyconfirm] == '5') {
        $row[colorstatus] = 'statusred';
    }
    $anaks[$anak] = $row;
    //tradeLogDashBoard("Dashboardawal-205-Anak ke :" . $row[ACCNO] . " = " . $row[colorstatus]);
    $anak++;
}
$template->assign("anaks", $anaks);


$cucus = array();
$cucu = 4;
for ($icountcucu = 0; $icountcucu < $cucu; $icountcucu++) {
    $row[ACCNO] = "";
    $row[aename] = '&nbsp;';
    $row[colorstatus] = 'statusgrey';
    $cucudirect[$icountcucu] = $row;
}

$cucunomor = 0;
$kenaikan = 2;
for ($icountanak = 0; $icountanak < count($anaks); $icountanak++) {
    $anak = $anaks[$icountanak];
    $anakACCNO = $anak[ACCNO];
    $cucucheckincrease = $cucunomor;
    $query = "SELECT mlm.Upline,mlm.ACCNO,
        mlm.companyconfirm,mlm.payment, 
        client_accounts.*,client_aecode.name as aename,
        client_aecode.nametengah,client_aecode.nameakhir,
        client_aecode.status as aestatus,client_aecode.suspend as aesuspend  
        FROM mlm,client_accounts,client_aecode   
        where 
        mlm.Upline='$anakACCNO' and mlm.ACCNO<>'$anakACCNO' 
        and mlm.ACCNO = client_accounts.accountname 
        and client_aecode.aecodeid = client_accounts.aecodeid  
        order by mlm.datetime asc limit 0,$kenaikan";
    //tradeLogDashBoard("Dashboardawal-241-Query:" . $query);
    $result = $DB->query($query);
    while ($row = $DB->fetch_array($result)) {
        $row[colorstatus] = 'statusgrey';
        if ($row[companyconfirm] == '2' || $row[companyconfirm] == '3' || $row[companyconfirm] == '4') {
            $row[colorstatus] = 'statusgreen';
        }
        if ($row[status] != 'normal') {
            $row[colorstatus] = 'statusred';
        }
        if ($row[aestatus] != '1') {
            $row[colorstatus] = 'statusred';
        }
        if ($row[aesuspend] != '0') {
            $row[colorstatus] = 'statusred';
        }
        if ($row[companyconfirm] == '5') {
            $row[colorstatus] = 'statusred';
        }
        $cucudirect[$cucucheckincrease] = $row;
        $cucucheckincrease++;
        //tradeLogDashBoard("Dashboardawal-260-Cucu:".$cucunomor.";ACCNO:".$row[ACCNO]);
    }//while ($row = $DB->fetch_array($result)) {
    $cucunomor = $cucunomor + $kenaikan;
}
//tradeLogDashBoard("Dashboardawal-245-anakACCNO :" .$cucus['150407162']['0'][ACCNO]);
$template->assign("cucudirect", $cucudirect);


//Level 3 Start

$levelthrees = array();
$levelthree = 8;
for ($icountlevelthree = 0; $icountlevelthree < $levelthree; $icountlevelthree++) {
    $row[ACCNO] = "";
    $row[aename] = '&nbsp;';
    $row[colorstatus] = 'statusgrey';
    $levelthreedirect[$icountlevelthree] = $row;
}

$levelthreenomor = 0;
$kenaikan = 2;
for ($icountleveltwo = 0; $icountleveltwo < count($cucudirect); $icountleveltwo++) {
    $level2data = $cucudirect[$icountleveltwo];
    $level2dataACCNO = $level2data[ACCNO];
    $levelthreecheckincrease = $levelthreenomor;
    //tradeLogDashBoard("Dashboardawal-285-Count:" . $icountleveltwo.";".$level2dataACCNO);
    if ($level2dataACCNO != '') {
        $query = "SELECT mlm.Upline,mlm.ACCNO,
        mlm.companyconfirm,mlm.payment, 
        client_accounts.*,client_aecode.name as aename,
        client_aecode.nametengah,client_aecode.nameakhir,
        client_aecode.status as aestatus,client_aecode.suspend as aesuspend  
        FROM mlm,client_accounts,client_aecode   
        where 
        mlm.Upline='$level2dataACCNO' 
        and mlm.ACCNO = client_accounts.accountname 
        and client_aecode.aecodeid = client_accounts.aecodeid  
        order by mlm.datetime asc limit 0,$kenaikan";
        //tradeLogDashBoard("Dashboardawal-299-Query:" . $query);
        $result = $DB->query($query);
        while ($row = $DB->fetch_array($result)) {
            $row[colorstatus] = 'statusgrey';
            if ($row[companyconfirm] == '2' || $row[companyconfirm] == '3' || $row[companyconfirm] == '4') {
                $row[colorstatus] = 'statusgreen';
            }
            if ($row[status] != 'normal') {
                $row[colorstatus] = 'statusred';
            }
            if ($row[aestatus] != '1') {
                $row[colorstatus] = 'statusred';
            }
            if ($row[aesuspend] != '0') {
                $row[colorstatus] = 'statusred';
            }
            if ($row[companyconfirm] == '5') {
                $row[colorstatus] = 'statusred';
            }
            $levelthreedirect[$levelthreecheckincrease] = $row;
            //tradeLogDashBoard("Dashboardawal-314-LevelThree:".$levelthreecheckincrease.";ACCNO:".$row[ACCNO]);
            $levelthreecheckincrease++;
        }// while ($row = $DB->fetch_array($result)) {
    }//if($level2dataACCNO!=''){
    $levelthreenomor = $levelthreenomor + $kenaikan;
}
//tradeLogDashBoard("Dashboardawal-245-anakACCNO :" .$levelthrees['150407162']['0'][ACCNO]);
$template->assign("levelthreedirect", $levelthreedirect);
/*
  for ($icountlevelthree = 0; $icountlevelthree < count($levelthreedirect); $icountlevelthree++) {
  $levelthreetest = $levelthreedirect[$icountlevelthree];
  $ACCNOTEST = $levelthreetest[ACCNO];
  tradeLogDashBoard("Dashboardawal-327-ACCNOTest :" .$ACCNOTEST);
  }
 */
//Level 3 End
mysql_free_result($result);

function fetchAccounts($username, $isadmin = 0, $cabang_admin) {
    global $DB_odbc;
    global $user;

    if ($isadmin) {
        if ($cabang_admin == 'semua') {
            $query = "SELECT trim(accountname) AS account FROM client_accounts where accountname !='' ORDER BY accountname DESC";
        } else {
            $query = "SELECT TRIM(client_accounts.accountname) AS account 
                    FROM client_accounts,client_aecode,client_group,client_branch  
                    WHERE client_accounts.accountname !='' 
                    AND client_accounts.aecodeid = client_aecode.`aecodeid` 
                    AND client_aecode.groupid = client_group.`groupid` 
                    AND client_group.branchid = client_branch.branchid 
                    AND client_branch.branch = '$cabang_admin' 
                    ORDER BY client_accounts.accountname DESC";
            //tradeLogDashBoard("DashBoard-83=".$query);
        }
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
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE " . $user->tradingtype . "='$username' ORDER BY AccNo DESC";
        }
        if ($user->groupid == '2') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE AccNo='$username' ORDER BY AccNo DESC";
        }
        if ($user->groupid == '3') {
            $query = "SELECT TRIM(client_accounts.accountname) AS account 
                FROM client_accounts,client_aecode  
                WHERE client_accounts.accountname !='' 
                AND client_accounts.aecodeid = client_aecode.aecodeid 
                AND client_aecode.aecode = '" . $username . "' 
                ORDER BY client_accounts.accountname DESC";
        }
        if ($user->groupid == '4' || $user->groupid == '5') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile.AeCode='$user->userfield_aecode' ORDER BY AccNo DESC";
        }
        if ($user->tradingtype == 'Group') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile." . $user->tradingtype . "='$user->userfield_group' ORDER BY AccNo DESC";
        }
    }
    //tradeLogDashBoard("tempstatement-257=".$query);
    $result = $DB_odbc->query($query);
    while ($row = $DB_odbc->fetch_array($result)) {
        $accounts[] = $row[account];
    }
    if ($accounts[0] == '') {
        $accounts[0] = 'dummy';
    }
    return $accounts;
}

function fetchBrancheGroups() {
    global $DB_odbc;

    $query = "SELECT trim(Branch) AS branchid, trim(AccNo) AS account FROM bafile ORDER BY AccNo DESC";

    $result = $DB_odbc->query($query);
    while ($row = $DB_odbc->fetch_array($result)) {
        $branches[$row[branchid]][] = $row[account];
    }
    return $branches;
}

$thedisplay = "dashboard.htm";
$checkcompany = "notcompany";
if ($account == 'A1THOUSAND' || $account == 'A3THOUSAND' || $account == 'A5THOUSAND' || $account == 'A10THOUSAND') {
    //tradeLogDashBoard("Dashboardawal-409-anakACCNO :" .$account);
    $threes = getTree($account, "icon-folder-open", 0);
    $template->assign("threes", $threes);
    $checkcompany = "thisiscompany";
    $thedisplay = "dashboard_admin.htm";
}
$template->assign(checkcompany, $checkcompany);
$template->assign(user, $user);

$template->display($thedisplay);

function getTree($account, $classnya) {
    global $DB;
    //tradeLogDashBoard("Dashboardawal-418;Account :" . $account);
    $datanya = "<li>";
    $datanya = $datanya . "<span><i class='$classnya'></i> $account</span> ";
    $query = "SELECT mlm.Upline,
        mlm.companyconfirm,mlm.payment, 
        client_accounts.*,client_aecode.name as aename,client_aecode.email,
        client_aecode.nametengah,client_aecode.nameakhir,
        client_aecode.status as aestatus,client_aecode.suspend as aesuspend,
        client_aecode.afiliasi, client_aecode.description 
        FROM mlm,client_accounts,client_aecode   
        where 
        mlm.ACCNO='$account' 
        and mlm.ACCNO = client_accounts.accountname 
        and client_aecode.aecodeid = client_accounts.aecodeid ";

    $result = $DB->query($query);
    while ($row = $DB->fetch_array($result)) {
        if ($row[companyconfirm] == '0') {
            $companydesc = "Customer Need Do Payment";
        }
        if ($row[companyconfirm] == '1') {
            $companydesc = "Admin Need Approved";
        }
        if ($row[companyconfirm] == '2') {
            $companydesc = "Customer already registered";
        }
        if ($row[aesuspend] == '1') {
            $companydesc = "Customer has been suspended";
        }
        if($row[afiliasi]==null || $row[afiliasi]=='' || $row[afiliasi]=='none'){
            $row[afiliasi] = 'info@si.co.id';
        }
        $theacc = $row;
    }
    $datanya = $datanya . "<a href='#'  onclick=\"AccountList_JS.updatesession('$account');\">";
    $datanya = $datanya . "<span>$companydesc</span>&nbsp;<span>$theacc[aename]</span>&nbsp;<span><i class='$classnya'></i> $theacc[email]</span>";
    $datanya = $datanya . "&nbsp;<span>$theacc[description]</span>&nbsp;<span>$theacc[afiliasi]</span>";
    $datanya = $datanya . "</a>";

    $query = "SELECT mlm.* FROM mlm WHERE Upline ='$account' AND ACCNO<>'$account' ORDER BY DATETIME ASC;";
    //tradeLogDashBoard("Dashboardawal-413-Query :" .$query);
    $result = $DB->query($query);
    $levelnya = array();
    $adadownline = "tidak";
    while ($row = $DB->fetch_array($result)) {
        $adadownline = "ya";
        $levelnya[] = $row;
    }
    if ($adadownline == 'ya') {
        $datanya = $datanya . "<ul>";
    }
    if ($classnya == "icon-leaf") {
        $classnya = "icon-minus-sign";
    } else {
        $classnya = "icon-leaf";
    }
    for ($icount = 0; $icount < count($levelnya); $icount++) {
        $thedata = $levelnya[$icount];
        //tradeLogDashBoard("Dashboardawal-31-ThedataACCNO :" .$thedata[ACCNO]);
        $threes2 = getTree($thedata[ACCNO], $classnya);
        $datanya = $datanya . $threes2;
    }
    if ($adadownline == 'ya') {
        $datanya = $datanya . "</ul>";
    }
    $datanya = $datanya . "</li>";
    return $datanya;
}

function tradeLogDashBoard($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>