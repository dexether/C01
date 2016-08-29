<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");

session_start();
global $user;
global $template;
global $mysql;
global $DB;
$lines = "a=1";
if ($mysql[crypt_key] != '') {
    $crypt_key = $mysql[crypt_key];
}
//tradeLogEmail_Admin("Email_Admin-17-Crypt_key:" . $crypt_key);
$var_to_pass = null;

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

if ($user->groupid=='9') {
    $branches = fetchBrancheGroups();
    $accounts = fetchAccounts("", $user->groupid=='9');
} elseif ($user->ismanager || $user->groupid == 8) {
    $manager = new Manager($user->getUserid());
    $manager->fetchBrancheGroups($DB_odbc);
    $branches = $manager->getBrancheGroups();
    $accounts = $manager->getAccounts();
} elseif ($user->groupid == 1) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 2) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 3) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 4) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 5) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username);
    $account = $accounts[0]; // Make account default
} elseif ($user->groupid == 11) {
    $username = $user->getUsername();
    $accounts = fetchAccounts($username);
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


if ($_GET[postmode]) {
    $postmode = anti_injection($_GET[postmode]);
    $emailfrom = anti_injection($_GET[tradedby]);
    if ($postmode == "emailtoadmin") {
        $email_subject = anti_injection($_POST[email_subject]);
        $email_message = anti_injection($_POST[email_message]);
        //tradeLogEmail_Admin("Email_Admin-101-EmailSubject:" . $email_subject . ";Email Message:" . $email_message);

        $timeupdate = date('Y-m-d H:i', strtotime('-1 hour'));
        $subject = "Email from client $emailfrom ";
        $body = "Time: " . $timeupdate . "<br> <br>";
        $body = $body . "Dear Admin : <br>";
        $body = $body . " <br>";
        $body = $body . "Client $emailfrom sent message with Subject : <mark>$email_subject </mark>";
        $body = $body . " <br>";
        $body = $body . "with message :<br><mark>$email_message</mark><br>";
        $body = $body . "Please reply to  $emailfrom <br>";
        $body = $body . " <br>";
        $body = $body . " <br>";
        $body = $body . "Thank you," . "<br>";
        $body = $body . "<br><strong>Global Gains Ltd</strong>" . "<br>";
        $body = $body . " 2nd Floor, Unit 5 <br>";
        $body = $body . " Olivier Maradan Building <br>";
        $body = $body . " Olivier Maradan Street <br>";
        $body = $body . " Victoria, Mahe, <br>";
        $body = $body . " Republic Of Seychelles <br>";
        $body = $body . " HotLine : +65-6850-7888 <br>";
        $body = $body . " Fax : +65-6850-7889 <br>";
        $body = $body . " Email : info@si.co.id <br>";
        $body = $body . " http://www.si.co.id <br>";

        $email_to = $ACCbayar[email];

        $query = "insert into email set
            timeupdate = '$timeupdate',
            email_to = 'info@si.co.id',
            email_subject = '$subject',
            email_body = '$body',
            timesend = '1970-01-31 00:00:00'    
            ";
        //tradeLogEmail_Admin("Email_Admin-109:".$query);
        $DB->query($query);
        echo 0;
    }
}

/* * ***************************************************************************
 * FETCH ALL ACCOUNTS ASSOCIATED WITH USERNAME                                *
 * *************************************************************************** */

function fetchAccounts($username, $isadmin = 0) {
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
    //tradeLogEmail_Admin("tempstatement-257=".$query);
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

function fetchBrancheGroups() {
    global $DB_odbc;

    $query = "SELECT trim(Branch) AS branchid, trim(AccNo) AS account FROM bafile ORDER BY AccNo";

    $result = $DB_odbc->query($query);
    while ($row = $DB_odbc->fetch_array($result)) {
        $branches[$row[branchid]][] = $row[account];
    }
    return $branches;
}

function tradeLogEmail_Admin($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>