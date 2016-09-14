<?php

//include("html_encoder_1.9.php");
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

include_once("includes/wr_tools.php");
$lines = "a=1";

$var_to_pass = null;


switch ($user->groupid) {
    case "1":
        $username = $user->username;
        $account = $username;
        $accounts[] = $username;
        break;

    case "2":
        $username = $user->username;
        $account = $username;
        $accounts[] = $username;
        break;

    case "3": //AECode Select
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;
    case "4": //AECode View
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;
    case "5": //AECode Show All
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;
    case "6":
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;

    case "7":
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;

    case "8":
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;

    case "9":
        $account = $_GET[account];
        $query = "SELECT acc_kota.login 
            FROM acc_kota," . $mysql[meta] . ".mt4_users 
            WHERE acc_kota.login <>'' 
            and " . $mysql[meta] . ".mt4_users.LOGIN = acc_kota.login 
            ORDER BY acc_kota.login ASC";
        $result = $DB_odbc->query($query);
        while ($row = $DB_odbc->fetch_array($result)) {
            $accounts[] = trim($row[AccNo]);
        }
        break;

    case "10":
        break;
    case "11": //Group Code
        $query = "SELECT AccNo FROM bafile WHERE bafile." . $user->tradingtype . " = '$user->userfield_group'";
        //tradelog($query);
        $result = $DB_odbc->query($query);
        while ($row = $DB_odbc->fetch_array($result)) {
            $accounts[] = trim($row[AccNo]);
        }
        break;
    case "12":
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;
        break;
}
//tradelog("daily_statement-73=".$accounts[0]);
$template->assign("accounts", $accounts);
$template->assign("user", $user);

$query = "select rolldate from daily_header group by rolldate desc order by rolldate desc";
$result = mysql_query($query) OR DIE(mysql_error());
$permission = "fail";
while ($row = mysql_fetch_array($result)) {
    if ($datesearch == '') {
        $datesearch = $row[rolldate];
    }
    $dateall[] = $row[rolldate];
}
//tradelog("daily_statement-110:".$_POST[dateselect]);
if ($_POST[dateselect] != '') {
    $datesearch = anti_injection($_POST[dateselect]);
}
$template->assign("dateall", $dateall);

$datesearch = $_GET[datesearch2];

if (empty($datesearch)) {
    $today_value = date("l");
    if ($today_value == 'Monday') {
        $today = getdate(mktime(0, 0, 0, date("m"), date("d") - 3, date("Y")));
    } else {
        $today = getdate(mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
    }
    $year = $today['year'];
    $month = $today['mon'];
    If (strlen($month) == 1) {
        $month = "0" . $month;
    }
    $day = $today['mday'];
    If (strlen($day) == 1) {
        $day = "0" . $day;
    }
    //$datesearch = $year . "-" . $month . "-" . $day;
    $datesearch = $dateall[0];
    //tradelog("daily_statement.php-107=".$datesearch);
}
$template->assign("datesearch", $datesearch);

$printing = $_GET[printing];
if ($printing != 'yes') {
    $printing = "no";
}
$template->assign("printing", $printing);

/* * ***************************************************************************
 * SELECT ACCOUNT                                                             *
 * *************************************************************************** */
if ($mysql[crypt_key] != '') {
    $crypt_key = $mysql[crypt_key];
}
$tools = new CTools();

if (!empty($_GET[account])) {
    $account = $_GET[account];
} else {
    $key = $_GET[key];
    $data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
    $data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
    $variabel = explode("&", $data[0]); //a=1&account=802222&
    $accountlink = $variabel[1]; //account=1234567
    $accountvariabel = explode("=", $accountlink);
    $account = $accountvariabel[1];
    $template->assign("key", $key);
}


$query = "select acc_kota.kota as thekota from acc_kota 
    where acc_kota.kota <>'' group by acc_kota.kota order by acc_kota.kota asc";
//tradeLog("Meta_NTR_Kota_Group-162:".$query);
$result = mysql_query($query) OR DIE(mysql_error());
while ($row = mysql_fetch_array($result)) {
    $kotas[] = $row[thekota];
    //tradeLog("Meta_NTR_Kota_Group-9:".$row[kota]);
}
mysql_free_result($result);
$template->assign("kotas", $kotas);

$query = "SELECT LEFT(TIME,10) AS rolldatefrom FROM " . $mysql[meta] . ".mt4_daily GROUP BY TIME 
    ORDER BY TIME asc;";
$result = mysql_query($query) OR DIE(mysql_error());
while ($row = mysql_fetch_array($result)) {
    $rolldatefrom[] = $row[rolldatefrom];
    $checktodayrollover = $row[rolldatefrom];
}
mysql_free_result($result);
$template->assign("rolldatefrom", $rolldatefrom);



$query = "SELECT LEFT(TIME,10) AS rolldateto FROM " . $mysql[meta] . ".mt4_daily GROUP BY TIME 
    ORDER BY TIME desc;";
$result = mysql_query($query) OR DIE(mysql_error());
while ($row = mysql_fetch_array($result)) {
    $rolldateto[] = $row[rolldateto];
    
}
mysql_free_result($result);
$template->assign("rolldateto", $rolldateto);

$query = "SELECT LEFT(TIME,10) AS rolldatefrom 
        FROM " . $mysql[meta] . ".mt4_daily 
        WHERE LEFT(TIME,10) < '$checktodayrollover'  
        GROUP BY LEFT(TIME,10)  
        ORDER BY LEFT(TIME,10) DESC LIMIT 0,1";
//tradeLog("Meta_ntr_kota_group-197;Query:" . $query);
$result = mysql_query($query) OR DIE(mysql_error());
while ($row = mysql_fetch_array($result)) {
    $rolldatefromselect = $row[rolldatefrom];
}
//tradeLog("Meta_ntr_kota_group-201;Rolldatefromselect:" . $rolldatefromselect);
mysql_free_result($result);
$template->assign("rolldatefromselect", $rolldatefromselect);


$template->display("meta_ntr_kota_rate.htm");

function fetchAccounts($username, $isadmin = 0) {
    global $DB_odbc;
    global $user;

    if ($isadmin) {
        $query = "SELECT trim(accountname) AS account FROM client_accounts where accountname !='' ORDER BY accountname asc";
    } else {
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
                AND client_aecode.aecode = (
                    SELECT userfield.fieldvalue FROM userfield,USER 
                    WHERE user.userid = userfield.`userid` 
                    AND user.`username` = '" . $username . "' 
                    AND fieldname = 'aecode' 
                ) 
                ORDER BY client_accounts.accountname ASC";
        }
        if ($user->groupid == '4' || $user->groupid == '5') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile.AeCode='$user->userfield_aecode' ORDER BY AccNo";
        }
        if ($user->groupid == '6') {
            $query = "
                SELECT TRIM(bafile.AccNo) AS account 
                FROM bafile,client_branch 
                WHERE bafile.AccNo !='' 
                AND bafile.`Branch` = client_branch.`branch` 
                AND client_branch.branch = ( 
                        SELECT userfield.fieldvalue 
                        FROM userfield,USER WHERE user.userid = userfield.`userid` 
                        AND user.`username` = '" . $username . "' 
                        AND fieldname = 'branch' 
                ) 
                GROUP BY TRIM(bafile.AccNo) 
                ORDER BY bafile.AccNo ASC
                ";
        }
        if ($user->groupid == '12') {
            $query = "
                SELECT TRIM(bafile.AccNo) AS account 
                FROM bafile,client_group 
                WHERE bafile.AccNo !='' 
                AND bafile.group = client_group.`group`  
                AND client_group.group = ( 
                        SELECT userfield.fieldvalue 
                        FROM userfield,USER WHERE user.userid = userfield.`userid` 
                        AND user.`username` = '" . $username . "' 
                        AND fieldname = 'group' 
                ) 
                GROUP BY TRIM(bafile.AccNo) 
                ORDER BY bafile.AccNo ASC
                ";
        }
    }
    //tradelog("tempstatement-257=".$query);
    $result = $DB_odbc->query($query);
    while ($row = $DB_odbc->fetch_array($result)) {
        $accounts[] = $row[account];
    }
    if ($accounts[0] == '') {
        $accounts[0] = 'dummy';
    }
    return $accounts;
}

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>