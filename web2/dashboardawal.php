<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
//tradelog("DashBoard-5");
global $user;
global $template;
global $key;
global $mysql;
$theFetchAccount = new theOtherFetchAccounts2();

//$theFetchAccount->tradelog("DashBoardAwal-9:".$account);
$lines = "a=1";
if ($mysql[crypt_key] != '') {
    $crypt_key = $mysql[crypt_key];
}
if ($user->groupid=='9') {
    $branches = $theFetchAccount->fetchBrancheGroups();
    $accounts = $theFetchAccount->fetchAccounts("", $user->groupid=='9', $user->companygroup);
} elseif ($user->ismanager || $user->groupid == 8) {
    $manager = new Manager($user->getUserid());
    $manager->fetchBrancheGroups($DB_odbc);
    $branches = $manager->getBrancheGroups();
    $accounts = $manager->getAccounts();
} elseif ($user->groupid == 1) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 2) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 3) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
} elseif ($user->groupid == 4) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
} elseif ($user->groupid == 5) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 11) {
    $username = $user->getUsername();
    $accounts = $theFetchAccount->fetchAccounts($username, '0', $user->companygroup);
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

//$theFetchAccount->tradelog("DashBoard-60:".$_GET[key]);
//$theFetchAccount->tradelog("DashBoard-67-Count:".count($_GET[key]));
$key = $_SESSION[key];
$tools = new CTools();
$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
//$theFetchAccount->tradelog("DashBoard-73-Crypt:".$crypt_key);
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
$variabel = explode("&", $data[0]); //a=1&account=802222&postmode=deposit&tradedby=ALBERTOSCARINA
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$account = $accountvariabel[1];
//$theFetchAccount->tradelog("DashBoard-60-Account:".$account);
//$theFetchAccount->tradelog("DashBoardAwal-73:".$account);

if ($account != 'dummy') {
    $sudahadaaccount = "yes";
}
$template->assign("sudahadaaccount", $sudahadaaccount);

$_SESSION[page] = 'dashboardawal';

for ($icount = 0; $icount < count($accounts); $icount++) {
    $accountkey = "a=1&account=" . $accounts[$icount];
    //$accountkey = $accountkey . "&page=dashboardawal2";
    $linezip = gzcompress($accountkey);
    $key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
    //$theFetchAccount->tradeLog("DashBoardAwalt-87-accountkey:" . $accountkey);
    $accountskey[$accounts[$icount]][key] = $key;
}
$total = count($accountskey);
$template->assign("total", $total);
$template->assign("accountskey", $accountskey);

global $DB_odbc;
if ($user->groupid == '3') {
    $query = "SELECT client_aecode.suspend,status,afiliasi  
        from client_aecode 
        where 
        client_aecode.aecode = '$user->username'";
    //$theFetchAccount->tradeLog("DashboardAwal-87=".$user->groupid.";".$query);
    $result = $DB_odbc->query($query);
    while ($row = $DB_odbc->fetch_array($result)) {
        //$this->tradeLog("DashBoardAwalt-189=".$row[account]);
        //$theFetchAccount->tradeLog("DashboardAwal-91=".$row[status]);
        $clientaecode = $row;
    }
    $template->assign("clientaecode", $clientaecode);

    $query = "SELECT mlm.*,client_aecode_bank.status as statusbank     
        FROM client_aecode,client_accounts,mlm,client_aecode_bank   
        WHERE 
        client_aecode.aecode = '$user->username' 
        AND client_aecode.`aecodeid` = client_accounts.`aecodeid` 
        AND client_aecode_bank.`aecode` = client_aecode.aecode 
        AND client_accounts.`accountname` = mlm.`ACCNO` 
        ORDER BY DATETIME ASC;";
    //$theFetchAccount->tradeLog("DashboardAwal-117=".$query);
    $result = $DB_odbc->query($query);
    $ceksemuaccounts = array();
    $cekstatusaccount = array();
    $cekstatusmoney = array();
    while ($row = $DB_odbc->fetch_array($result)) {
        $row[abu] = "ya";
        if ($row[companyconfirm] > 0 ) {
            $row[abu] = "tidak";
        }
        $cekstatusaccount[$row[ACCNO]] = $row[abu];
        $cekstatusmoney[$row[ACCNO]] = $row;
        $ceksemuaccounts[] = $row;
    }
    //$theFetchAccount->tradeLog("DashboardAwal-108=".count($ceksemuaccounts));

    for ($icount = 0; $icount < count($ceksemuaccounts); $icount++) {
        $ceksemuaccount = $ceksemuaccounts[$icount];
        $checkanak = "tidak";
        if ($ceksemuaccount[companyconfirm] == '2' ) {
            //$theFetchAccount->tradeLog("Dashboardawal-137-Check Anak:".$ceksemuaccount[ACCNO]);
            $checkanak = "iya";
        }
        $group_play = $ceksemuaccount[group_play];
        if ($group_play == '1T') {
            $ceksemuaccounts[$icount][Uang] = 'SGD 1.000 ( One Thousand Singapore Dollar )';
            $ceksemuaccounts[$icount][UangTax] = 'SGD 1.060 ( One Thousand and Sixty Singapore Dollar )';
            $ceksemuaccounts[$icount][UangNOComma] = '1000';
            $ceksemuaccounts[$icount][UangNOCommaTax] = '1060';
            $ceksemuaccounts[$icount][Product] = "SGD 1K ";
            $companyshare = 'A1THOUSAND';
            $ceksemuaccounts[$icount][UangCompany] = 'SGD 1.060 ( One Thousand Singapore Dollar )';
            $ceksemuaccounts[$icount][UangCompanyTax] = 'SGD 1.060 ( One Thousand and Sixty Singapore Dollar )';
            $cekstatusmoney[$ceksemuaccount[ACCNO]][Uang] = "SGD 1K ";
            $cekstatusmoney[$ceksemuaccount[ACCNO]][UangNOComma] = 1000;
            $cekstatusmoney[$ceksemuaccount[ACCNO]][UangNOCommaTax] = 1060;
        }
        if ($group_play == '3T') {
            $ceksemuaccounts[$icount][Uang] = 'SGD 3.000 ( Three Thousand Singapore Dollar )';
            $ceksemuaccounts[$icount][UangTax] = 'SGD 3.160 ( Three Thousand One Hundred and Sixty Singapore Dollar )';
            $ceksemuaccounts[$icount][UangNOComma] = '3000';
            $ceksemuaccounts[$icount][UangNOCommaTax] = '3160';
            $ceksemuaccounts[$icount][Product] = "SGD 3K ";
            $companyshare = 'A3THOUSAND';
            $ceksemuaccounts[$icount][UangCompany] = 'SGD 3.000 ( Three Thousand Singapore Dollar )';
            $ceksemuaccounts[$icount][UangCompanyTax] = 'SGD 3.160 ( Three Thousand One Hundred and Sixty Singapore Dollar )';
            $cekstatusmoney[$ceksemuaccount[ACCNO]][Uang] = "SGD 3K ";
            $cekstatusmoney[$ceksemuaccount[ACCNO]][UangNOComma] = 3000;
            $cekstatusmoney[$ceksemuaccount[ACCNO]][UangNOCommaTax] = 3160;
        }
        if ($group_play == '5T') {
            $ceksemuaccounts[$icount][Uang] = 'SGD 5.000 ( Five Thousand Singapore Dollar )';
            $ceksemuaccounts[$icount][UangTax] = 'SGD 5.270 ( Five Thousand Two Hundred and Seventy Singapore Dollar )';
            $ceksemuaccounts[$icount][UangNOComma] = '5000';
            $ceksemuaccounts[$icount][UangNOCommaTax] = '5270';
            $ceksemuaccounts[$icount][Product] = "SGD 5K ";
            $companyshare = 'A5THOUSAND';
            $ceksemuaccounts[$icount][UangCompany] = 'SGD 5.000 ( Five Thousand Singapore Dollar )';
            $ceksemuaccounts[$icount][UangCompanyTax] = 'SGD 5.270 ( Five Thousand Two Hundred and Seventy Singapore Dollar )';
            $cekstatusmoney[$ceksemuaccount[ACCNO]][Uang] = "SGD 5K";
            $cekstatusmoney[$ceksemuaccount[ACCNO]][UangNOComma] = 5000;
            $cekstatusmoney[$ceksemuaccount[ACCNO]][UangNOCommaTax] = 5270;
        }
        if ($group_play == '10T') {
            $ceksemuaccounts[$icount][Uang] = 'SGD 10.000 ( Ten Thousand Singapore Dollar )';
            $ceksemuaccounts[$icount][UangTax] = 'SGD 10.530 ( Ten Thousand Five Hundred and Thirty Singapore Dollar )';
            $ceksemuaccounts[$icount][UangNOComma] = '10530';
            $ceksemuaccounts[$icount][UangNOCommaTax] = '10530';
            $ceksemuaccounts[$icount][Product] = "SGD 10K ";
            $companyshare = 'A10THOUSAND';
            $ceksemuaccounts[$icount][UangCompany] = 'SGD 10.000 ( Ten Thousand Five Hundred and Thirty Singapore Dollar )';
            $ceksemuaccounts[$icount][UangCompanyTax] = 'SGD 10.530 ( Ten Thousand Five Hundred and Thirty Singapore Dollar )';
            $cekstatusmoney[$ceksemuaccount[ACCNO]][Uang] = "SGD 10K";
            $cekstatusmoney[$ceksemuaccount[ACCNO]][UangNOComma] = 10000;
            $cekstatusmoney[$ceksemuaccount[ACCNO]][UangNOCommaTax] = 10530;
        }


        $hasGroup['1T'][uang] = 'SGD 1.000 ( One Thousand Singapore Dollar )';
        $hasGroup['3T'][uang] = 'SGD 3.000 ( Three Thousand Singapore Dollar )';
        $hasGroup['5T'][uang] = 'SGD 5.000 ( Five Thousand Singapore Dollar )';
        $hasGroup['10T'][uang] = 'SGD 10.000 ( Ten Thousand Singapore Dollar )';


        $upline1 = $ceksemuaccount[Upline];
        $query = "SELECT client_aecode.name,client_aecode.nametengah,client_aecode.nameakhir,
            client_aecode.telephone_home,client_aecode.telephone_mobile,client_aecode.email,
            client_aecode_bank.status  as statusbank ,
            mlm.* 
            FROM mlm,client_accounts,client_aecode,client_aecode_bank 
            WHERE mlm.ACCNO='$upline1' 
            AND mlm.ACCNO = client_accounts.`accountname` 
            AND client_accounts.`aecodeid` = client_aecode.`aecodeid` 
            AND client_aecode.`aecode` = client_aecode_bank.`aecode` ";
        //$theFetchAccount->tradeLog("Dashboardawal-127-Query:".$query);
        $result = $DB_odbc->query($query);
        $upline1data = array();
        while ($row = $DB_odbc->fetch_array($result)) {
            $upline1data = $row;
        }
        $ceksemuaccounts[$icount][upline1data] = $upline1data;

        $upline2 = $upline1data[Upline];
        $query = "SELECT client_aecode.name,client_aecode.nametengah,client_aecode.nameakhir,
            client_aecode.telephone_home,client_aecode.telephone_mobile,client_aecode.email,
            client_aecode_bank.*,client_aecode_bank.status as statusbank  
            FROM mlm,client_accounts,client_aecode,client_aecode_bank 
            WHERE mlm.ACCNO='$upline2' 
            AND mlm.ACCNO = client_accounts.`accountname` 
            AND client_accounts.`aecodeid` = client_aecode.`aecodeid` 
            AND client_aecode.`aecode` = client_aecode_bank.`aecode` ";
        //$theFetchAccount->tradeLog("Dashboardawal-138-Query:".$query);
        $result = $DB_odbc->query($query);
        $upline2bank = array();
        while ($row = $DB_odbc->fetch_array($result)) {
            //$theFetchAccount->tradeLog("DashboardAwal-91=".$row[banktype]);
            $upline2bank[] = $row;
            $upline2data = $row;
        }
        $ceksemuaccounts[$icount][upline2bank] = $upline2bank;
        $ceksemuaccounts[$icount][upline2data] = $upline2data;

        //Company Share
        $query = "SELECT client_aecode.name,client_aecode.nametengah,client_aecode.nameakhir,
            client_aecode.address,
            client_aecode.telephone_home,client_aecode.telephone_mobile,client_aecode.email,
            client_aecode_bank.* ,client_aecode_bank.status as statusbank 
            FROM mlm,client_accounts,client_aecode,client_aecode_bank 
            WHERE mlm.ACCNO='$companyshare' 
            AND mlm.ACCNO = client_accounts.`accountname` 
            AND client_accounts.`aecodeid` = client_aecode.`aecodeid` 
            AND client_aecode.`aecode` = client_aecode_bank.`aecode` ";
        //$theFetchAccount->tradeLog("Dashboardawal-217-Query:".$query);
        $result = $DB_odbc->query($query);
        $companybank = array();
        while ($row = $DB_odbc->fetch_array($result)) {
            //$theFetchAccount->tradeLog("DashboardAwal-91=".$row[banktype]);
            $companybank[] = $row;
            $companydata = $row;
        }
        $ceksemuaccounts[$icount][companybank] = $companybank;
        $ceksemuaccounts[$icount][companydata] = $companydata;

        if ($checkanak == 'iya') {
            $ceksemuaccounts[$icount][adaanak] = 'lanjut';
            $jumlahanak = 3;
            for ($icountanak = 0; $icountanak < $jumlahanak; $icountanak++) {
                $row[ACCNO] = "BELUMADA";
                $row[UangNOComma] = $ceksemuaccounts[$icount][UangNOComma];
                $ceksemuaccounts[$icount][anak][$icountanak] = $row;
            }
            $query = "SELECT * FROM mlm WHERE Upline ='$ceksemuaccount[ACCNO]'";
            //$theFetchAccount->tradeLog("Dashboardawal-193-Query:" . $query);
            $result = $DB_odbc->query($query);
            $anak = 0;
            while ($row = $DB_odbc->fetch_array($result)) {
                $ceksemuaccounts[$icount][anak][$anak] = $row;
                //$theFetchAccount->tradeLog("Dashboardawal-193-Anak ke :" . $icount . " = " . $ceksemuaccounts[$icount][anak][$anak]);
                $anak++;
            }
            $checkanakcucus = $ceksemuaccounts[$icount][anak];
            foreach ($checkanakcucus as $noanak => $dataanak) {
                //$theFetchAccount->tradeLog("Dashboardawal-213-Anak ke :" . $noanak . ";AccNo:" . $dataanak[ACCNO]);
                if ($dataanak[ACCNO] != 'BELUMADA') {
                    $query = "SELECT mlm.*,client_aecode.`aecode`  
                        FROM mlm,client_accounts,client_aecode 
                        WHERE mlm.`ACCNO` = client_accounts.`accountname` 
                        AND client_aecode.`aecodeid` = client_accounts.`aecodeid` 
                        AND mlm.Upline = '$dataanak[ACCNO]'             
                        AND client_accounts.status ='normal';";
                    //$theFetchAccount->tradeLog("Dashboardawal-226-Query :" . $query);
                    $result2 = $DB_odbc->query($query);
                    while ($row2 = $DB_odbc->fetch_array($result2)) {
                        $row2[uang] = $hasGroup[$row2[group_play]][uang];
                        $ceksemuaccounts[$icount][anak][$noanak][cucu][] = $row2;
                    }
                    //foreach ($ceksemuaccounts[$icount][anak][$anak][cucu] as $nocucu => $datacucu) {
                    //    $theFetchAccount->tradeLog("Dashboardawal-234-NoCucu :" . $nocucu.";".$datacucu[ACCNO]);
                    //}
                }
            }
        }
    }

    $template->assign("cekstatusmoney", $cekstatusmoney);
    $template->assign("ceksemuaccounts", $ceksemuaccounts);
    
    
    if(count($ceksemuaccounts)=='0'){
        //$theFetchAccount->tradeLog("Dashboardawal-260-Afiliasi:".$clientaecode[afiliasi]);  
        if($clientaecode[afiliasi]=='' || strpos($clientaecode[afiliasi],'@') == false ){
            $afiliasi = 'info@si.co.id';
        }else{
            $afiliasi = $clientaecode[afiliasi];
        }
    }
    $template->assign("afiliasi", $afiliasi);
    $template->assign("user", $user);
    $template->display("dashboardawal.htm");
}


if ($user->groupid == '9') {
    $query = "SELECT  group_play FROM mlm WHERE ACCNO='$account'";
    $result = $DB_odbc->query($query);
    while ($row = $DB_odbc->fetch_array($result)) {
        $group_play = $row[group_play];
    }
    $template->assign("group_play", $group_play);

    $query = "SELECT mlm.*,client_accounts.suspend AS accountsuspend   
        FROM client_aecode,client_accounts,mlm  
        WHERE 
        client_aecode.`aecodeid` = client_accounts.`aecodeid` 
        AND client_accounts.`accountname` = mlm.`ACCNO` 
        AND companyconfirm = '1' 
        and updateby not in ('company') 
        AND group_play = '$group_play' 
        ORDER BY DATETIME ASC;";
    //$theFetchAccount->tradeLog("DashboardAwal-206=".$query);
    $result = $DB_odbc->query($query);
    $ceksemuaccounts = array();
    while ($row = $DB_odbc->fetch_array($result)) {
        $ceksemuaccounts[] = $row;
    }

    $query = "SELECT mlm.*,client_accounts.suspend AS accountsuspend   
        FROM client_aecode,client_accounts,mlm  
        WHERE 
        client_aecode.`aecodeid` = client_accounts.`aecodeid` 
        AND client_accounts.`accountname` = mlm.`ACCNO` 
        AND companyconfirm = '2' 
        ORDER BY DATETIME ASC;";
    //$theFetchAccount->tradeLog("DashboardAwal-248=".$query);
    $result = $DB_odbc->query($query);
    while ($row = $DB_odbc->fetch_array($result)) {
        $ceksemuaccounts[] = $row;
    }

    for ($icount = 0; $icount < count($ceksemuaccounts); $icount++) {
        $ceksemuaccount = $ceksemuaccounts[$icount];
        $group_play = $ceksemuaccount[group_play];
        if ($group_play == '1T') {
            $ceksemuaccounts[$icount][Uang] = 'SGD 1.000 ( One Thousand Singapore Dollar )';
            $companyshare = 'A1THOUSAND';
            $ceksemuaccounts[$icount][UangCompany] = 'SGD 1.000 ( One Thousand Singapore Dollar )';
        }
        if ($group_play == '3T') {
            $ceksemuaccounts[$icount][Uang] = 'SGD 3.000 ( Three Thousand Singapore Dollar )';
            $companyshare = 'A3THOUSAND';
            $ceksemuaccounts[$icount][UangCompany] = 'SGD 3.000 ( Three Thousand Singapore Dollar )';
        }
        if ($group_play == '5T') {
            $ceksemuaccounts[$icount][Uang] = 'SGD 5.000 ( Five Thousand Singapore Dollar )';
            $companyshare = 'A5THOUSAND';
            $ceksemuaccounts[$icount][UangCompany] = 'SGD 5.000 ( Five Thousand Singapore Dollar )';
        }
        if ($group_play == '10T') {
            $ceksemuaccounts[$icount][Uang] = 'SGD 10.000 ( Ten Thousand Singapore Dollar )';
            $companyshare = 'A10THOUSAND';
            $ceksemuaccounts[$icount][UangCompany] = 'SGD 10.000 ( Ten Thousand Singapore Dollar )';
        }
    }
    $template->assign("ceksemuaccounts", $ceksemuaccounts);

    $query = "
        SELECT client_aecode.aecode,mlm.* FROM mlm,client_aecode,client_accounts 
        WHERE 
        mlm.companyconfirm='0' 
        AND client_accounts.aecodeid = client_aecode.aecodeid  
        AND client_accounts.accountname = mlm.ACCNO 
        ORDER BY DATETIME desc ";
    $result = $DB_odbc->query($query);
    $cekaccountsbarus = array();
    while ($row = $DB_odbc->fetch_array($result)) {
        $cekaccountsbarus[] = $row;
    }
    $template->assign("cekaccountsbarus", $cekaccountsbarus);

    $template->display("dashboardawal_admin.htm");
}

class theOtherFetchAccounts2 {

    function tradeLog($msg) {
        $fp = fopen("trader.log", "a");
        $logdate = date("Y-m-d H:i:s => ");
        $msg = preg_replace("/\s+/", " ", $msg);
        fwrite($fp, $logdate . $msg . "\n");
        fclose($fp);
        return;
    }

    function fetchAccounts($username, $isadmin = 0, $cabang_admin) {
        global $DB_odbc;
        global $user;

        if ($isadmin) {
            if ($cabang_admin == 'semua') {
                $query = "SELECT trim(accountname) AS account FROM client_accounts where accountname !='' ORDER BY accountname asc";
            } else {
                $query = "SELECT TRIM(client_accounts.accountname) AS account 
                    FROM client_accounts,client_aecode,client_group,client_branch  
                    WHERE client_accounts.accountname !='' 
                    AND client_accounts.aecodeid = client_aecode.`aecodeid` 
                    AND client_aecode.groupid = client_group.`groupid` 
                    AND client_group.branchid = client_branch.branchid 
                    AND client_branch.branch = '$cabang_admin' 
                    ORDER BY client_accounts.accountname ASC";
                //tradelog("SelectAccount-83=".$query);
            }
            //tradelog("DashBoardAwal-132=".$query);
        } else {
            if ($user->groupid == '3') {
                $query = "select accountreal from user where username = '" . $username . "' ";
                //tradelog("SelectAccount-89=".$query);
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
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE " . $user->tradingtype . "='$username' ORDER BY AccNo asc";
            }
            if ($user->groupid == '2') {
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE AccNo='$username' ORDER BY AccNo asc";
            }
            if ($user->groupid == '3') {
                $query = "SELECT TRIM(client_accounts.accountname) AS account 
                FROM client_accounts,client_aecode  
                WHERE client_accounts.accountname !='' 
                AND client_accounts.aecodeid = client_aecode.aecodeid 
                AND client_aecode.aecode = '" . $username . "' 
                ORDER BY client_accounts.accountid desc";
            }
            if ($user->groupid == '4' || $user->groupid == '5') {
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile.AeCode='$user->userfield_aecode' ORDER BY AccNo asc";
            }
            if ($user->tradingtype == 'Group') {
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile." . $user->tradingtype . "='$user->userfield_group' ORDER BY AccNo asc";
            }
        }
        //$this->tradeLog("DashBoardAwalt-439=".$user->groupid.";".$query);
        $result = $DB_odbc->query($query);
        while ($row = $DB_odbc->fetch_array($result)) {
            //$this->tradeLog("DashBoardAwalt-189=".$row[account]);
            $accounts[] = $row[account];
        }

        if ($accounts[0] == '') {
            $accounts[0] = 'dummy';
        }
        //tradeLog("DashBoardAwalt-100-Account[0]=".$accounts[0]);
        return $accounts;
    }

    function fetchBrancheGroups() {
        global $DB_odbc;

        $query = "SELECT trim(Branch) AS branchid, trim(AccNo) AS account FROM bafile ORDER BY AccNo";

        $result = $DB_odbc->query($query);
        while ($row = $DB_odbc->fetch_array($result)) {
            $branches[$row[branchid]][] = $row[account];
        }
        return $branches;
    }

}

?>