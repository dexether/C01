<?php

session_start();
$skip_authentication = 1;
include("../includes/functions.php");
session_unset();

include_once("includes/wr_tools.php");
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}
$var_to_pass = null;
$tools = new CTools();

if (!$_GET['key']) {
    display_error("17.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
}
$key = $_GET['key'];
//tradelog("OpenAccount3_Approval-20-Key:" . $key.";Crypt:".$crypt_key);
$template->assign("key", $key);

$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
//tradelog("OpenAccount3_Approval-23-data:" . $data);
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
//tradelog("OpenAccount3_Approval-26-data:" . $data[0]);
$variabel = explode("&", $data[0]); //a=1&account=" . $accountname . "&postmode=resetpasswordnya
//tradelog("OpenAccount3_Approval-84-variable:" . $variabel);
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$accountname = $accountvariabel[1];

$accountlink = $variabel[2]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$approveaccount = $accountvariabel[1];

$passwordlink = $variabel[3]; //account=1234567
$passwordvariabel = explode("=", $passwordlink);
$password = $passwordvariabel[1];

//tradelog("OpenAccount3_Approval-41-Approveaccount:" . $approveaccount . ";accountname=" .$accountname.";Password:".$password);
$email = $accountname;
if ($accountname == '') {
    display_error("37.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
}
$template->assign("accountname", $accountname);

$output = "false";
if ($approveaccount == 'approveuser') {
    $query = "update client_aecode set
        status = '1' 
        where aecode = '$email' ";
    //tradelog("OpenAccount3_Approval-51-query:" . $query);
    $DB->execonly($query);
    $output = "true";
}
$keterangan = '';
if ($password == 'resendemail') {
    $output = "false";
    $keterangan = "You Email has been validated, Please login into the system using your email and password";
}
//tradelog("OpenAccount3_Approval-58-Output:".$output);
$template->assign("keterangan", $keterangan);
$template->assign("output", $output);

if ($output == 'false') {
    //tradelog("OpenAccount3_Approval-62");
    $template->display("openaccount3_approval.htm");
} else {
    //tradelog("OpenAccount3_Approval-65");
    $_SESSION['login_depan'] = '';

    $login_user = $accountname;
    $login_password = $password;

    if (empty($login_user) && empty($login_password)) {
        display_error("<b>Prohibited-72:You have entered a wrong account or password combination.</b><br><br>Please ensure that your details are correct and try again.<br>Failed attempts are logged for security purposes.<br>If you forget Password <a href='forgetpassword.php'>click here.</a>", "Incorrect Login");
    }
    $user = new User();
    $user->setUsername($login_user);
    if (!$user->fetch()) {
        display_error("<b>Prohibited-77:You have entered a wrong account or password combination.</b><br><br>Please ensure that your details are correct and try again.<br>Failed attempts are logged for security purposes.<br>If you forget Password <a href='forgetpassword.php'>click here.</a>", "Incorrect Login");
    }
    $encryptedpassword = md5($login_password);
    //tradelog("OpenAccount3_Approval-71-Password:".$login_password.";Encrypted:".$encryptedpassword);
    if (!$user->checkPassword($encryptedpassword)) {
        display_error("<b>Prohibited-81:You have entered a wrong account or password combination.</b><br><br>Please ensure that your details are correct and try again.<br>Failed attempts are logged for security purposes.<br>If you forget Password <a href='forgetpassword.php'>click here.</a> ", "Incorrect Login");
    }
    if ($user->isExpired()) {
        display_error("<b>The system detects that your account has been expired.</b><br>Please created a new Account.<br><br>Otherwise, you may email to our administrator to extend.");
    }

    $_SESSION['user'] = $user;
    $rememberme = 'no';
    if (isset($_POST['remember'])) {
        $rememberme = anti_injection($_POST['remember']);
    }

    $time = time();
    if ($rememberme == 'yes') {
        setcookie('myusername', $login_user, $time + 60 * 60 * 24 * 100, "/");        // Sets the cookie username
        setcookie('mypassword', $login_password, $time + 60 * 60 * 24 * 100, "/");    // Sets the cookie password
        setcookie('myremember', 'yes', $time + 60 * 60 * 24 * 100, "/");    // Sets the cookie remember
    } else {
        setcookie('myusername', '', $time + 60 * 60 * 24 * 100, "/");        // Sets the cookie username
        setcookie('mypassword', '', $time + 60 * 60 * 24 * 100, "/");    // Sets the cookie password
        setcookie('myremember', 'no', $time + 60 * 60 * 24 * 100, "/");    // Sets the cookie remember
    }

    $loginke = '';
    if (isset($_POST['loginke'])) {
        if ($_POST['loginke']) {
            $_SESSION['loginke'] = anti_injection($_POST['loginke']);
        }
    }
    if (isset($_SESSION['loginke'])) {
        if ($_SESSION['loginke']) {
            //
        }
    } else {
        $_SESSION['loginke'] = 'prod';
    }

    $user->updateLastLogin();

    $query = "SELECT value FROM config WHERE name='company_name' ";
    $row = $DB->query_first($query);
    $company_name = $row[value];
    if ($user->groupid == 1) { //Client & AE
        header("Location: mainmenu.php?account=" . $user->username);
    }
    if ($user->groupid == 3 || $user->groupid == 9) { //Client & AE
        header("Location: mainmenu.php");
    } else {
        display_error("<b>Sorry This username can not login here</b><br>Please ask admin");
        header("Location: login.php");
    }
    $DB->close();
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