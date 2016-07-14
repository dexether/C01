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
//TradeLog_MLMRegistration("MLM_Registration-33");

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


//tradeLogMMNewLevel("mm_new_level-67");

$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'mlm_registration';


if ($_GET['postmode']) {
    $postmode = $_GET['postmode'];

    if ($postmode == "createnewlevel2") {
        //tradeLogMMNewLevel("mm_new_level-80");
        $update_tradeby = $user->getUsername();
        $rupiah = anti_injection($_GET['rupiah']);
        $email = anti_injection($_GET['email']);
        $telephone_mobile = anti_injection($_GET['hp']);
        //tradeLogMMNewLevel("mm_new_level-85-Pelaku:" . $update_tradeby . ";Upline:" . $email . ";Hp:" . $telephone_mobile . ";Rupiah:" . $rupiah);
        //UpdateBy:albertoscarina@gmail.com;Rupiah:1000;Email:admin@globalgains.co
        $query = "SELECT * FROM client_aecode WHERE email = '$email' and status='1'";
        //tradeLogMMNewLevel("mm_new_level-89:" . $query);
        $adaae = 'noae';
        $rows = $DB->execresultset($query);
        foreach ($rows as $row) {
            $adaae = 'adaae';
            $aecodeid = $row['aecodeid'];
        }
        //tradeLogMMNewLevel("mm_new_level-97-adaae:" . $adaae);
        $group_play = $rupiah;
        if ($adaae != 'adaae' && $email != 'admin@si.co.id') {
            echo 3;
        } else {
            if ($email == 'admin@si.co.id') {
                $upline = 'COMPANY';
            } else {
                $upline = create_or_use_upline($group_play, $email, $user->username);
            }
            //tradeLogMMNewLevel("mm_new_level-105:" . $upline);


            $last = 0;
            $accountnamebaru = check_account($update_tradeby, $last);
            $rolldate = date('Y-m-t');


            $query = "SELECT client_branch.branch,client_group.group AS thegroup,
                client_aecode.aecodeid,client_aecode.name,client_aecode.nametengah,client_aecode.nameakhir,
                client_aecode.email,client_aecode.description    
                FROM client_branch,client_group,client_aecode   
                WHERE client_branch.branchid = client_group.branchid 
                AND client_group.groupid = client_aecode.groupid 
                and client_aecode.aecode = '$user->username'
                ";
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
            //tradeLogMMNewLevel("tradeLogMMNewLevel-800:" . $query);
            $DB->execonly($query);

            $query = "insert into mlm set
                    mt4dt = 'nometa',
                    ACCNO='$accountnamebaru',
                    Upline = '$upline',
                    datetime = NOW(),
                    companyconfirm = '0',
                    payment = '0',
                    group_play = '$rupiah',
                    updateby = '$user->username'     
                        ";
            //tradeLogMMNewLevel("tradeLogMMNewLevel-800:" . $query);
            $DB->execonly($query);

            $timenya = date('Y-m-d H:i', strtotime('-1 hour'));
            $subject = "New Account $accountnamebaru has been created";
            $body = "Time: " . $timenya . "<br> <br>";
            $body = $body . "Dear  $usernya[name] $usernya[nametengah] $usernya[nameakhir],<br>";
            $body = $body . " <br>";
            $body = $body . "Your New Account has been created <br>";
            $body = $body . " <br>";
            $body = $body . "Thank you," . "<br>";
            $body = $body . "<br><strong>Cabinet Management System</strong>" . "<br>";
            $body = $body . " HotLine : +62-21-2954-3737<br>";
            $body = $body . " Fax : +62-21-2954-3777 <br>";
            $body = $body . " Email : admin@si.co.id <br>";
            $body = $body . " http://cabinet.si.co.id <br>";

            $query = "insert into email set
                    timeupdate = '$timenya',
                    email_to = '$usernya[email]',
                    email_subject = '$subject',
                    email_body = '$body',
                    timesend = '1970-01-31 00:00:00'    
                    ";
            $DB->execonly($query);

            echo 0;
        }//else of if ($adaae != 'adaae') {
        exit;
    }//if ($postmode == "createnewlevel") {
}//if ($_GET[postmode]) {


/* * ***************************************************************************
 * FETCH ALL ACCOUNTS ASSOCIATED WITH USERNAME                                *
 * *************************************************************************** */

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

function tradeLogMMNewLevel($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

function check_account($update_tradeby, $last) {
    global $DB;
    //$waktucheck1 = date('ymdH'); //2014 Aug 21 21:03:55
    $waktucheck1 = date('ymdH', strtotime('-1 hour'));
    $query = "select * from mlm where ACCNO  like ('$waktucheck1%') order by ACCNO desc limit 0,1";
    //tradeLogMMNewLevel("MM_New_Level-378:".$query);
    $lastACCNO = 0;
    $rows = $DB->execresultset($query);
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
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO = $row['ACCNO'];
        $is_accountname_already_taken = "yes";
    }

    $query = "select * from client_accounts where accountname='$account_name_check'";
    //tradeLogMMNewLevel("mm_new_level-301-query:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO = $row['ACCNO'];
        $is_accountname_already_taken = "yes";
    }

    if ($is_accountname_already_taken == "yes") {
        $accountname = check_account($update_tradeby, $last);
    } else {
        $accountname = $account_name_check;
    }
    return $accountname;
}

function ae_gen_password($syllables = 3, $use_prefix = false) {

    // Define function unless it is already exists
    if (!function_exists('ae_arr')) {

        // This function returns random array element
        function ae_arr(&$arr) {
            return $arr[rand(0, sizeof($arr) - 1)];
        }

    }

    // 20 prefixes
    $prefix = array('aero', 'anti', 'auto', 'bi', 'bio',
        'cine', 'deca', 'demo', 'dyna', 'eco',
        'ergo', 'geo', 'gyno', 'hypo', 'kilo',
        'mega', 'tera', 'mini', 'nano', 'duo');

    // 10 random suffixes
    $suffix = array('dom', 'ity', 'ment', 'sion', 'ness',
        'ence', 'er', 'ist', 'tion', 'or');

    // 8 vowel sounds 
    $vowels = array('a', 'o', 'e', 'i', 'y', 'u', 'ou', 'oo');

    // 20 random consonants 
    $consonants = array('w', 'r', 't', 'p', 's', 'd', 'f', 'g', 'h', 'j',
        'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm', 'qu');

    $password = $use_prefix ? ae_arr($prefix) : '';
    $password_suffix = ae_arr($suffix);

    for ($i = 0; $i < $syllables; $i++) {
        // selecting random consonant
        $doubles = array('n', 'm', 't', 's');
        $c = ae_arr($consonants);
        if (in_array($c, $doubles) && ($i != 0)) { // maybe double it
            if (rand(0, 2) == 1) // 33% probability
                $c .= $c;
        }
        $password .= $c;
        //
        // selecting random vowel
        $password .= ae_arr($vowels);

        if ($i == $syllables - 1) // if suffix begin with vovel
            if (in_array($password_suffix[0], $vowels)) // add one more consonant 
                $password .= ae_arr($consonants);
    }

    // selecting random suffix
    $password .= $password_suffix;

    return $password;
}

function create_or_use_upline($group_play, $email, $tradeby) {
    global $DB;
    $update_tradeby = $tradeby;
    $rolldate = date('Y-m-t');
    //tradeLogMMNewLevel("mm_Registration2-332:".$rolldate);

    $query = "SELECT value FROM broker_settings WHERE settings IN ('mailfrom','mailhost','mailpassword','mailto','mailport') order by urutan asc";
    $mailbrokersettings = array();
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $mailbrokersettings[] = $row['value'];
    }

    $query = "SELECT companyurl FROM usercompany;";
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $urlcompany = $row['companyurl'];
    }
    $tools = new CTools();

    //Start apakah company
    //tradeLogMMNewLevel("mm_new_level.php-348-StartCheck Email:" . $email);
    if ($email == 'admin@si.co.id') {
        $upline = 'COMPANY';
        return $upline;
    } else {//if ($email == 'admin@globalgains.co') {
        //Start check Upline
        $query = "SELECT mlm.group_play,mlm.ACCNO,client_accounts.*  
                FROM client_aecode,client_accounts,mlm  
                WHERE 
                client_aecode.aecodeid = client_accounts.`aecodeid` 
                AND mlm.ACCNO = client_accounts.accountname  
                AND mlm.group_play = '$group_play' 
                AND client_aecode.email = '$email' order by mlm.datetime asc";
        //tradeLogMMNewLevel("mm_new_level.php-361:" . $query); //$email = cucudua@si.co.id
        $checkuplines = array();
        $rows = $DB->execresultset($query);
        foreach ($rows as $row) {
            $checkuplines[] = $row;
        }

        $upline = "upline_new";
        $upline_accno = '';
        if (count($checkuplines) > 0) {
            for ($icount = 0; $icount < count($checkuplines); $icount++) {// si upline punya beberapa ACCNO dan akan di check anaknya berapa
                $checkupline = $checkuplines[$icount];
                $upline_accno = $checkupline['ACCNO']; //150926112 milik cucudua@si.co.id

                $query = "SELECT mlm.ACCNO,mlm.datetime,client_aecode.email   
                    FROM MLM,client_accounts,client_aecode   
                    WHERE MLM.Upline = '$upline_accno' 
                    and MLM.ACCNO = client_accounts.accountname 
                    and client_accounts.aecodeid = client_aecode.aecodeid 
                    ORDER BY DATETIME DESC";
                //tradeLogMMNewLevel("mm_new_level.php-380-ACCNO:" . $upline_accno . ";Query:" . $query);
                $hitung = 2;
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    $hitung = $hitung - 1; //minus 150926121 dan minus 150926122
                }
                if ($hitung > 0) { // artinya ACCNO si upline masih ada yang koson
                    $upline = $upline_accno;
                    //tradeLogMMNewLevel("mm_new_level.php-554-Upline:" . $upline_accno . ";masih ada yang kosong, yaitu ACCNO:" . $upline);
                    return $upline;
                } else {
                    //tradeLogMMNewLevel("mm_new_level.php-391-Email:" . $email . " ACCNo nya sudah penuh");
                }
            }//if (count($checkuplines) > 0) {   
        }//for ($icount = 0; $icount < count($checkuplines); $icount++) {
        //tradeLogMMNewLevel("mm_new_level.php-396-Kalau baca ini, artinya masih belum dapat Uplinenya");


        if ($upline == "upline_new") {
            
            if ($upline_accno != '') {
                //Upline need to have a new Account            
                //cari tahu apa email kakeknya
                //$upline_accno == 150926112
                $query = "SELECT mlm.Upline    
                    FROM MLM    
                    WHERE MLM.ACCNO = '$upline_accno' ";
                //tradeLogMMNewLevel("mm_new_level.php-552-Query:" . $query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    $upline2_accno = $row['Upline']; //ACCNO 150926111
                }

                $query = "select client_aecode.email from client_aecode,client_accounts 
                    where client_accounts.aecodeid = client_aecode.aecodeid 
                    and client_accounts.accountname = '$upline2_accno'";
                //tradeLogMMNewLevel("mm_new_level.php-417-;Query:" . $query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    $kakek_email = $row['email']; //cucusatu@si.co.id
                }
                //tradeLogMMNewLevel("mm_new_level.php-585-;Start Cari Kakek_email:" . $kakek_email.";Group_Play:".$group_play);
                //end cari tahu apa email kakeknya
                $kakeknya = create_or_use_upline($group_play, $kakek_email, $tradeby);
                //tradeLogMMNewLevel("mm_new_level.php-588-Kakeknya:".$kakeknya);
            }//if ($upline_accno != '') {
            else {
                $query = "SELECT client_aecode.afiliasi FROM client_aecode WHERE client_aecode.`aecode` = '$email'";
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    $kakeknya = $row['afiliasi']; //ACCNO 150926111
                }
                $kakek_email = $kakeknya;
                //tradeLogMMNewLevel("mm_new_level.php-578-Kakek_email:" . $kakek_email . ";Email Upline:" . $email);
                if ($kakek_email == 'admin@si.co.id' || $kakek_email == '') {
                    //tradeLogMMNewLevel("mm_new_level.php-580-Jalur Company");
                    $kakeknya = create_or_use_upline_khusus($group_play);
                } else {
                    //tradeLogMMNewLevel("mm_new_level.php-583-Jalur Kakek");
                    $kakeknya = create_or_use_upline($group_play, $kakek_email, $tradeby);
                }
                //tradeLogMMNewLevel("mm_new_level.php-586-Kakeknya:" . $kakeknya);
            }

            //tradeLogMMNewLevel("mm_new_level.php-445-Kakeknya:" . $kakeknya);
            
            $last = 0;
            $jumlah_digit = 6; //maksimum 6
            //tradeLogMMNewLevel("mm_new_level-593:");
            $accountname = check_account($update_tradeby, $last);
            //tradeLogMMNewLevel("mm_new_level-595-AccountName:" . $accountname);

            $query = "SELECT client_branch.branch,client_group.group AS thegroup,client_aecode.email,
                    client_aecode.aecodeid,client_aecode.name,client_aecode.nametengah,client_aecode.nameakhir  
                    FROM client_branch,client_group,client_aecode   
                    WHERE client_branch.branchid = client_group.branchid 
                    AND client_group.groupid = client_aecode.groupid 
                    and client_aecode.email = '$email'
                    ";
            //tradeLogMMNewLevel("MM_New_Level-461-Query:" . $query);
            $rows = $DB->execresultset($query);
            foreach ($rows as $row) {
                $uplinenya = $row;
            }

            $query = "INSERT INTO client_accounts SET " .
                    "aecodeid = '" . $uplinenya['aecodeid'] . "', " .
                    "accountname = '" . $accountname . "', " .
                    "name = '" . $accountname . "', " .
                    "address = '', " .
                    "telephone_home = '', " .
                    "telephone_office = '', " .
                    "telephone_mobile = '', " .
                    "suspend = '0', " .
                    "email = '$email', " .
                    "daycall = '0', " .
                    "nightcall = '0', " .
                    "`float_rate` = '0', " .
                    "telephone_fax = '', " .
                    "last_updated = NOW(), " .
                    "status = 'normal', " .
                    "rolldate='" . $rolldate . "', " .
                    "sendmethod = 'Email'";
            //tradeLogMMNewLevel("mm_new_level-484:" . $query);
            $DB->execonly($query);

            $query = "insert into mlm set
                    ACCNO='$accountname',
                    mt4dt = 'nometa',
                    Upline = '$kakeknya',
                    datetime = NOW(),
                    companyconfirm = '0',
                    payment = '0',
                    group_play = '$group_play',
                    updateby = '$tradeby'     
                        ";
            //tradeLogMMNewLevel("mm_new_level-496-query:" . $query);
            $DB->execonly($query);

            $timenya = date('Y-m-d H:i', strtotime('-1 hour'));
            $subject = "New Account $accountname has been created";
            $body = "Time: " . $timenya . "<br> <br>";
            $body = $body . "Dear  $uplinenya[name] $uplinenya[nametengah] $uplinenya[nameakhir],<br>";
            $body = $body . " <br>";
            $body = $body . "Please be informed that your downline just created and as your Binary system already completed. <br>";
            $body = $body . "We created a new link for your new downline <br>";
            $body = $body . " <br>";
            $body = $body . "Thank you," . "<br>";
            $body = $body . "<br><strong>Cabinet Management System</strong>" . "<br>";
            $body = $body . " HotLine : +62-21-2954-3737<br>";
            $body = $body . " Fax : +62-21-2954-3777 <br>";
            $body = $body . " Email : admin@si.co.id <br>";
            $body = $body . " http://cabinet.si.co.id <br>";

            $query = "insert into email set
                    timeupdate = '$timenya',
                    email_to = '$uplinenya[email]',
                    email_subject = '$subject',
                    email_body = '$body',
                    timesend = '1970-01-31 00:00:00'    
                    ";
            //tradeLogMMNewLevel("mm_new_level-522-query:" . $query);
            $DB->execonly($query);

            $upline = $accountname;
            return $upline;
        }// if ($upline == "upline_new") {
        //tradeLogMMNewLevel("mm_new_level.php-645-Upline Looping:" . $upline);
    }//end apakah company if ($email == 'admin@globalgains.co') {


    return $upline;
}

function create_or_use_upline_khusus($group_play) {
    if ($group_play == 'no_plan') {
        $upline = 'COMPANY';
        $kakeknya = $upline;
    }
    return $upline;
}

//function create_or_use_upline($group_play,$email){
?>