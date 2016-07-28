<?php

session_start();
$skip_authentication = 1;
include("../includes/functions.php");
$redirect = @$_POST['redirect'];
$session = '';
if (isset($_SESSION['login_depan'])) {
    $session = $_SESSION['login_depan'];
}
if ($session != 'daridepan') {
    session_unset();
} else {
    $_POST['login_user'] = $_SESSION['login_user'];
    $_POST['login_password'] = $_SESSION['login_password'];
}
$_SESSION['login_depan'] = '';
$_SESSION['page'] = '';
$urlnya = "stg9";

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

$isMobile = false;
$isBot = false;
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
$ac = strtolower($_SERVER['HTTP_ACCEPT']);
$ip = $_SERVER['REMOTE_ADDR'];

if ($_POST) {
    $login_user = anti_injection($_POST['login_user']);
    $login_password = anti_injection($_POST['login_password']);
    
    if (empty($login_user) && empty($login_password)) {
        set_log_server($login_user, "Incorrect Login<br>;" . $login_user . ";" . $login_password);
        $keterangan = "<b>59. You have entered a wrong account or password combination.</b><br><br>Please ensure that your details are correct and try again.<br>Failed attempts are logged for security purposes.<br>If you forget Password <a href='forgetpassword.php'>click here.</a>";
        display_error($keterangan, "Incorrect Login");
    }

    $user = new User();
    $user->setUsername($login_user);
    if (!$user->fetch()) {
        set_log_server($login_user, "Incorrect Login<br>;" . $login_user);
        $keterangan = "<b>50. You have entered a wrong account or password combination.</b><br>Please ensure that your details are correct and try again.<br>Failed attempts are logged for security purposes.<br>If you forget Password <a href='forgetpassword.php'>click here.</a> ";
        display_error($keterangan, "Incorrect Login");
    }
    $encryptedpassword = md5($login_password);
    //tradeLog("Login.php-54;Encrypted:" . $login_password."-->".$encryptedpassword);
    if (!$user->checkPassword($encryptedpassword)) {
        set_log_server($login_user, "Incorrect Password<br>;" . $login_user);
        $keterangan = "<b>57. You have entered a wrong account or password combination.</b><br>Please ensure that your details are correct and try again.<br>Failed attempts are logged for security purposes.<br>If you forget Password <a href='forgetpassword.php'>click here.</a> ";
        display_error($keterangan, "Incorrect Login");
    }
    if ($user->isExpired()) {
        set_log_server($login_user, "Incorrect Login<br>;" . $login_user);
        $keterangan = "<b>62. The system detects that your account has been expired.</b><br>Please created a new Account.<br><br>Otherwise, you may email to our administrator to extend.";
        display_error($keterangan, "Expired");
    }

    $_SESSION['user'] = $user;
    $rememberme = 'no';
    if (!empty($_POST['remember'])) {
        $rememberme = anti_injection($_POST['remember']);
    }
    if ($rememberme == 'yes') {
        $time = time();
        setcookie('myusername', $login_user, $time + 60 * 60 * 24 * 100, "/");        // Sets the cookie username
        setcookie('mypassword', $login_password, $time + 60 * 60 * 24 * 100, "/");    // Sets the cookie password
        setcookie('myremember', 'yes', $time + 60 * 60 * 24 * 100, "/");    // Sets the cookie remember
        //tradelog("login.php-82-cookies");
    } else {
        $time = time();
        setcookie('myusername', '', $time + 60 * 60 * 24 * 100, "/");        // Sets the cookie username
        setcookie('mypassword', '', $time + 60 * 60 * 24 * 100, "/");    // Sets the cookie password
        setcookie('myremember', 'no', $time + 60 * 60 * 24 * 100, "/");    // Sets the cookie remember
    }

    //tradelog("login.php-147:".$_POST[loginke]);
    if ($_POST['loginke']) {
        $_SESSION['loginke'] = anti_injection($_POST['loginke']);
    }if ($_SESSION['loginke']) {
        //
    } else {
        $_SESSION['loginke'] = 'prod';
    }
    //tradelog("login.php-151:".$_SESSION[loginke].";".$_POST[loginke]);
    $user->updateLastLogin();

    $query = "SELECT value FROM config WHERE name='company_name' ";
    global $DB;
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $company_name = $row['value'];
    }


    //tradeLog("login.php-104-Groupid:".$user->groupid);
    if ($user->groupid == 1) { //Client & AE
        header("Location: mainmenu.php?account=" . $user->username);
    }
    if ($user->groupid == 3 || $user->groupid == 9 || $user->groupid == 15) { //Client & AE
        //display_error("<b>Underconstruction</b>");
        if ($redirect == '') {
            header("Location: mainmenu.php");    
        }else{
            header("Location: ".$redirect);    
        }
        
    } else {
        display_error("<b>Sorry This username can not login here</b><br>Please ask admin");
        header("Location: login.php");
    }
    $DB->close();
} else {
    $_SESSION['messagebox'] = "116.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.";
    $_SESSION['alamat'] = "index.php";
    //header("Location: messagebox.php");
    display_error("119.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
    exit;
}
if ($urlnya == "stg9") {
    $template->display("home.htm");
}
?>