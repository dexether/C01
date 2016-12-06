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
$subject  = "General Error ";
$msg      = "";
$postmode = '';
if (isset($_GET['postmode'])) {
   $postmode = $_GET['postmode'];
}


$query  = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years  = date('Y', time());
foreach ($result as $rows) {
    $companys         = $rows;
    $companys['year'] = $years;
}
$error    = "success";
$subject  = "General Error ";
$msg      = "";
$link     = $companys['appurl'] . "/web2/mainmenu.php";
$token    = @($_POST['token']);
$accnomlm = @($_POST['new_upline']);
tradeLogMMNewLevel("tradeLogMMNewLevel-35-accnomlm:" . $accnomlm);
$plan     = @($_POST['plan']);
tradeLogMMNewLevel("tradeLogMMNewLevel-37-plan:" . $plan);
$users     = @($_POST['users']);
tradeLogMMNewLevel("tradeLogMMNewLevel-39-users:" . $users);
if ($accnomlm == 'company' || $accnomlm == 'COMPANY') {
    $accnomlm = @(strtoupper($_POST['accnomlm']));
}
$plan             = @($_POST['plan']);
if (empty($accnomlm)) {
    $error   = "error";
    $subject = "Sorry, We found an error";
    $msg     = "01. The upline's code can't be empty";
}
/*====================================
=            Start Coding            =
====================================*/
if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
            $condition_plan = "";
            if ($plan == '0') {
                $condition_plan = "";
            } else {
                $condition_plan = " AND mlm.group_play = '$plan'";
            }
            $condition = "";
            if (isEmail($accnomlm)) {
                $condition = " AND client_aecode.`aecode` = '$accnomlm'";
            } else {
                $condition = " AND client_accounts.accountname = '$accnomlm'";
            }
            $query = "SELECT
           client_accounts.`accountname`,
           client_aecode.email,
           client_aecode.name,
           client_aecode.aecodeid,
           client_aecode.status,
           mlm.group_play
           FROM
           client_aecode,
           client_accounts,
           mlm
           WHERE 1=1
           $condition
           $condition_plan
           AND client_aecode.`aecodeid` = client_accounts.`aecodeid`
           AND client_accounts.accountname = mlm.ACCNO
           AND client_aecode.status = '1'
           AND client_accounts.suspend = '0'
           ORDER BY client_accounts.`accountname` DESC
           LIMIT 0, 1 ";
            tradeLogMMNewLevel("tradeLogMMNewLevel-88-query :".$query);
            $adaae      = 'noae';
            $rows       = $DB->execresultset($query);
            $lastaccout = 0;
            $upline_plan = "no_plan";
            foreach ($rows as $row) {
                $adaae      = 'adaae';
                $aecodeid   = $row['aecodeid'];
                $lastaccout = $row['accountname'];
                if ($plan == '0') {
                    $upline_plan = $row['group_play'];
                } else {
                    $upline_plan = $plan;
                }

            }
            if ($adaae != 'adaae' && $accnomlm != 'COMPANY') {
				tradeLogMMNewLevel("adaae != 'adaae' && accnomlm != 'COMPANY'");
                $error   = "error";
                $subject = "Sorry, We found an error";
                $msg     = "02. The upline's code or email you entered is wrong or maybe your upline dont have registered Cabinet ID with plan you have entetered. Easy stop is input the detalis correctly and select 'Follow your upline plan', Please check the upline's Email";
                $link    = $companys['appurl'] . "/web2/mainmenu.php";
            } else {
				tradeLogMMNewLevel("else");
                $last            = 0;
				$userr = '';
				$query = "SELECT aecode FROM client_aecode WHERE aecodeid = '$users'";
				$result = $DB->execresultset($query);
				foreach($result as $row){
					$userr = $row['aecode'];
				}
                $update_tradeby  = $userr;
                $rolldate        = date('Y-m-d', time());
                $accountnamebaru = check_account($update_tradeby, $last);
                $query           = "SELECT client_branch.branch,client_group.group AS thegroup,
                client_aecode.aecodeid,client_aecode.name,client_aecode.nametengah,client_aecode.nameakhir,
                client_aecode.email,client_aecode.description
                FROM client_branch,client_group,client_aecode
                WHERE client_branch.branchid = client_group.branchid
                AND client_group.groupid = client_aecode.groupid
                and client_aecode.aecode = '$userr'
                ";
                tradeLogMMNewLevel("tradeLogMMNewLevel-126-Query:" . $query);
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
                tradeLogMMNewLevel("tradeLogMMNewLevel-149:" . $query);
                $DB->execonly($query);
                // Select Account that upline mine
                if ($accnomlm == 'COMPANY') {
                    $lastaccout = 'COMPANY';
                }
                // $plan
                if($lastaccout == 'company' || $lastaccout == 'COMPANY' && $plan != '0'):
                  $upline_plan = $plan;
                endif;

                $query = "insert into mlm set
                 mt4dt = 'nometa',
                 ACCNO='$accountnamebaru',
                 Upline = '$lastaccout',
                 datetime = NOW(),
                 companyconfirm = '2',
                 payment = '0',
                 group_play = '$upline_plan',
                 updateby = '$user->username'
                 ";
                $DB->execonly($query);
                //  tambahan jika askap maka auto Sync
                $auto_registered = false;
                if($upline_plan == "askap"):
                  $query = "SELECT alias, mt4dt FROM mt_database WHERE mt_database.`alias` LIKE '%askap%' AND mt_database.`enabled` = 'yes'";
                  $hasil = $DB->execresultset($query);
                  foreach ($hasil as $key => $value) {
                    $query = "SELECT LOGIN, EMAIL FROM ".$value['mt4dt'].".`mt4_users` WHERE ".$value['mt4dt'].".`mt4_users`.`EMAIL` = '".$user->username."'";
                    $hasil_mt = $DB->execresultset($query);
                    foreach ($hasil_mt as $key_mt => $value_mt) {
                      # code...
                      $cekdullu = checkLoginMetaIfRegistered($value_mt['LOGIN'], $value['mt4dt']);
                      if($cekdullu):
                      else:
                        $insert = "INSERT INTO mlm2 SET ACCNO = '$accountnamebaru', mt4dt = '$value[mt4dt]', mt4login = '$value_mt[LOGIN]', suspend = '0'";
                        $DB->execonly($insert);
                        $auto_registered = true;
                        $registered_login[] = $value_mt['LOGIN'];
                      endif;
                    }


                  }
                endif;
                //tradeLogMMNewLevel("tradeLogMMNewLevel-800:" . $query);
                $error            = "success";
                $subject          = "Your Account " . $accountnamebaru . " for this plan has been created ";
                if($auto_registered):
                  $subject    = $subject. "and your LOGIN number on ".$value_mt['LOGIN']."  has been sync automatically to this account";
                endif;
                $msg              = "You need Admin confrimation to confirm your account, We will confirm your account as soon as possible";
                $link             = $companys['appurl'] . "/web2/mainmenu.php";
                $_SESSION['page'] = 'imp_treeview';
            }

        } else {
            // echo 'Ga Valid.'; // invalid
            $error   = "error";
            $subject = "Oops, Something has happened";
            $msg     = "Try refresing the web page";
        }

    }
}
$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg, 'link' => $link);
// header("Content-Type: application/json;charset=utf-8");
echo json_encode($response);
/*=====  End of Start Coding  ======*/

/*=====  End of Start Coding  ======*/

/* * ***************************************************************************
 * FETCH ALL ACCOUNTS ASSOCIATED WITH USERNAME                                *
 * *************************************************************************** */

function tradeLogMMNewLevel($msg)
{
   $fp      = fopen("trader.log", "a");
   $logdate = date("Y-m-d H:i:s => ");
   $msg     = preg_replace("/\s+/", " ", $msg);
   fwrite($fp, $logdate . $msg . "\n");
   fclose($fp);
   return;
}

function clientlogs($details, $logtype)
{
   global $DB;
   global $user;
   $rolldate = date('Y-m-d', time());
   $datetime = date('Y-m-d H:i:s', time());
   $query    = "INSERT INTO client_logs SET username = '$user->username', logdate = '$datetime', rolldate = '$rolldate', logtype = '$logtype', details = '$details'";
   $DB->execonly($query);
}
function getIdentitas($account)
{
   global $DB;
   $query = "SELECT
  client_accounts.`accountname`,
  client_aecode.`email`,
  client_aecode.`name`
  FROM
  client_accounts,
  client_aecode
  WHERE client_accounts.`accountname` = '$account'
  AND client_aecode.`aecodeid` = client_accounts.`aecodeid`";
   $result = $DB->execresultset($query);
   foreach ($result as $rows) {
      $datas = $rows;
   }
   return $datas;
}
function sendEmail($to, $subject, $body, $module)
{
   global $DB;
   $timeupdate = date('Y-m-d H:i:s', strtotime('-1 hour'));
   $query      = "insert into email set
  timeupdate = '$timeupdate',
  email_to = '$to',
  email_subject = '$subject',
  email_body = '$body',
  timesend = '1970-01-31 00:00:00',
  module = '$module'
  ";
   $DB->execonly($query);
}

function create_or_use_upline($group_play, $email, $tradeby)
{
    global $DB;
    $update_tradeby = $tradeby;
    $rolldate       = date('Y-m-t');
    //tradeLogMMNewLevel("mm_Registration2-332:".$rolldate);

    $query              = "SELECT value FROM broker_settings WHERE settings IN ('mailfrom','mailhost','mailpassword','mailto','mailport') order by urutan asc";
    $mailbrokersettings = array();
    $rows               = $DB->execresultset($query);
    foreach ($rows as $row) {
        $mailbrokersettings[] = $row['value'];
    }

    $query = "SELECT companyurl FROM usercompany;";
    $rows  = $DB->execresultset($query);
    foreach ($rows as $row) {
        $urlcompany = $row['companyurl'];
    }
    $tools = new CTools();

    //Start apakah company
    //tradeLogMMNewLevel("mm_new_level.php-348-StartCheck Email:" . $email);
    if ($email == $companys['email']) {
        $upline = 'COMPANY';
        return $upline;
    } else {
//if ($email == 'admin@globalgains.co') {
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
        $rows         = $DB->execresultset($query);
        foreach ($rows as $row) {
            $checkuplines[] = $row;
        }

        $upline       = "upline_new";
        $upline_accno = '';
        if (count($checkuplines) > 0) {
            for ($icount = 0; $icount < count($checkuplines); $icount++) {
// si upline punya beberapa ACCNO dan akan di check anaknya berapa
                $checkupline  = $checkuplines[$icount];
                $upline_accno = $checkupline['ACCNO']; //150926112 milik cucudua@si.co.id

                $query = "SELECT mlm.ACCNO,mlm.datetime,client_aecode.email
            FROM MLM,client_accounts,client_aecode
            WHERE MLM.Upline = '$upline_accno'
            and MLM.ACCNO = client_accounts.accountname
            and client_accounts.aecodeid = client_aecode.aecodeid
            ORDER BY DATETIME DESC";
                //tradeLogMMNewLevel("mm_new_level.php-380-ACCNO:" . $upline_accno . ";Query:" . $query);
                $hitung = 2;
                $rows   = $DB->execresultset($query);
                foreach ($rows as $row) {
                    $hitung = $hitung - 1; //minus 150926121 dan minus 150926122
                }
                if ($hitung > 0) {
                    // artinya ACCNO si upline masih ada yang koson
                    $upline = $upline_accno;
                    //tradeLogMMNewLevel("mm_new_level.php-554-Upline:" . $upline_accno . ";masih ada yang kosong, yaitu ACCNO:" . $upline);
                    return $upline;
                } else {
                    //tradeLogMMNewLevel("mm_new_level.php-391-Email:" . $email . " ACCNo nya sudah penuh");
                }
            } //if (count($checkuplines) > 0) {
        } //for ($icount = 0; $icount < count($checkuplines); $icount++) {
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
            } //if ($upline_accno != '') {
            else {
                $query = "SELECT client_aecode.afiliasi FROM client_aecode WHERE client_aecode.`aecode` = '$email'";
                $rows  = $DB->execresultset($query);
                foreach ($rows as $row) {
                    $kakeknya = $row['afiliasi']; //ACCNO 150926111
                }
                $kakek_email = $kakeknya;
                //tradeLogMMNewLevel("mm_new_level.php-578-Kakek_email:" . $kakek_email . ";Email Upline:" . $email);
                if ($kakek_email == $companys['email'] || $kakek_email == '') {
                    //tradeLogMMNewLevel("mm_new_level.php-580-Jalur Company");
                    $kakeknya = create_or_use_upline_khusus($group_play);
                } else {
                    //tradeLogMMNewLevel("mm_new_level.php-583-Jalur Kakek");
                    $kakeknya = create_or_use_upline($group_play, $kakek_email, $tradeby);
                }
                //tradeLogMMNewLevel("mm_new_level.php-586-Kakeknya:" . $kakeknya);
            }

            //tradeLogMMNewLevel("mm_new_level.php-445-Kakeknya:" . $kakeknya);

            $last         = 0;
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
            $body    = "Time: " . $timenya . "<br> <br>";
            $body    = $body . "Dear  $uplinenya[name] $uplinenya[nametengah] $uplinenya[nameakhir],<br>";
            $body    = $body . " <br>";
            $body    = $body . "Please be informed that your downline just created and as your Binary system already completed. <br>";
            $body    = $body . "We created a new link for your new downline <br>";
            $body    = $body . " <br>";
            $body    = $body . "Thank you," . "<br>";
            $body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
            $body    = $body . $companys['long_address'];
            $body    = $body . " Email : " . $companys['email'] . " <br>";
            $body    = $body . " " . $companys['companyurl'] . " <br>";

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
        } // if ($upline == "upline_new") {
        //tradeLogMMNewLevel("mm_new_level.php-645-Upline Looping:" . $upline);
    } //end apakah company if ($email == 'admin@globalgains.co') {

    return $upline;
}

function create_or_use_upline_khusus($group_play)
{
    if ($group_play == 'no_plan') {
        $upline   = 'COMPANY';
        $kakeknya = $upline;
    }
    return $upline;
}

function isEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $output = true;
    } else {
        $output = false;
    }
    return $output;

}
function checkLoginMetaIfRegistered($login, $mt4dt)
{
    global $DB;
    global $user;
      $query = "SELECT * FROM mlm2 WHERE mt4login = '$login' AND mt4dt = '$mt4dt'";
    $result = $DB->execresultset($query);
    if(count($result) > 0):
      return true;
    else:
      return false;
    endif;

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
//function create_or_use_upline($group_play,$email){
