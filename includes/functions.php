<?php

date_default_timezone_set("Asia/Bangkok");
include_once("$_SERVER[DOCUMENT_ROOT]/_settings/config.php");
include("$_SERVER[DOCUMENT_ROOT]/classes/DB.class.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/User.class.php");
include("$_SERVER[DOCUMENT_ROOT]/classes/Themes.class.php");
require("$_SERVER[DOCUMENT_ROOT]/smarty/SmartyBC.class.php");

$DB = new DB();
$config = getConfig();

$template = new SmartyBC;
$template->debugging = false;
$template->caching = true;
$template->cache_lifetime = 120;
$template->clear_all_cache();
//$template->php_handling = Smarty::PHP_PASSTHRU;
$template->assign("config", $config);

// Start session
if (!isset($_SESSION)) {
    session_start();
}


global $skip_authentication;
if ($skip_authentication != 1) { // Require login
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if (!$user->checkPassword()) {
            header("Location: /login.php"); // Password does not match DB password / Password could have changed.
        } else {

        }
    } else {
        echo "<SCRIPT language='Javascript1.2'>\n";
        //echo "if (confirm('Ref.11. Your Session expired.Please Click Logout or Refresh?')) { top.location.reload(true); }\n";
        echo "window.location=logout.php";
        echo "</SCRIPT>";
        //header("Location: /index.html"); // User is not logged in (Session variable "user" is not set)
    }
    //tradeLog2("Function-42:".$user->groupid);
} else {
    //tradeLog2("Function-43:".$user->groupid);
}

function error_message($msg, $url = '') {
    if (empty($url))
        echo"<SCRIPT>alert(\"$msg\");history.go(-1) </script>";
    else
        echo"<SCRIPT>alert(\"$msg\");self.location.href='$url'</script>";
}

/* * ***************************************************************************
 * FUNCTIONS                                                                  *
 * *************************************************************************** */

function display_message($message, $title, $url) {
    global $template;
    if (!isset($problem)) {
        $problem = '';
    }
    $template->assign("problem", $problem);
    $template->assign("message", $message);
    $template->assign("title", $title);
    $template->assign("url", $url);
    $template->display("messagebox.htm");
    exit;
}

function display_error($message, $title = "Error", $url = "") {
    //tradeLog2("Function-70:" . $title . ";" . $message);
    global $template;
    $template->assign("error", 1);
    display_message($message, $title, $url);
    //header('Location:error.php?title='.$title.'&message='.$message);
}

function display_logout($message, $title = "Error", $url = "") {
    global $template;
    $template->assign("error", 1);
    //display_message($message, $title, $url);
    header('Location:error.php?title=' . $title . '&message=' . $message);
}

function check_permission($groupid) {
    if (is_array($groupid)) {
        if (!in_array($_SESSION[user]->groupid, $groupid)) {
            echo "Session Expired, please login again\n<br>";
            echo "<a href=index.html>Click Here to go to the main Page</a>";
            exit;
        }
    } else {
        if ($_SESSION[user]->groupid != $groupid) {
            echo "Permission denied. You do not have the rights to access this page.";
            exit;
        }
    }
}

function getConfig() {
    global $DB;
    $query = "SELECT * FROM config";
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $config[$row["name"]] = $row["value"];
        //tradeLog2("Function-83:".$row["value"]);
    }
    return $config;
}

function set_log_file($userid, $log_window, $log_procees, $log_transact_id, $log_desc) {
    $log_desc2 = str_replace("'", "%270", $log_desc);
    $from_ip = "Remote Address=" . $_SERVER[REMOTE_ADDR] . " and Browser=" . $_SERVER[HTTP_USER_AGENT] . " and on web=" . $_SERVER[HTTP_REFERER];
    $query = "INSERT INTO logfile
              SET
              username = '$userid',window = '$log_window',process = '$log_procees',transaction_id = '$log_transact_id',transaction_desc = '$log_desc2',date = NOW(),from_ip='$from_ip';";
    //tradelog("tradelog fuction " . $query);
    $DB->query($query);
    return 1;
}

function set_log_file_new($userid, $log_window, $log_procees, $log_transact_id, $thequery, $account, $keterangan) {
    $thequery = str_replace("'", "%270", $thequery);
    $from_ip = "Remote Address=" . $_SERVER[REMOTE_ADDR] . " and Browser=" . $_SERVER[HTTP_USER_AGENT] . " and on web=" . $_SERVER[HTTP_REFERER];
    $query = "INSERT INTO logfile
              SET
              username = '$userid',account='$account',window = '$log_window',process = '$log_procees',transaction_id = '$log_transact_id',thequery='$thequery',transaction_desc = '$keterangan',date = NOW(),from_ip='$from_ip';";
    $DB->query($query);
    return 1;
}

function set_log_meta($account, $keterangan) {
    $keterangan = str_replace("'", "\'", $keterangan);
    $query = "INSERT INTO logclient
              SET
              TIMESTAMP = NOW(),ACCNO='$account',COMMENT = '$keterangan'";
    $DB->execonly($query);
    return 1;
}

function set_log_server($account, $keterangan) {
    global $DB;
    $keterangan = str_replace("'", "\'", $keterangan);
    $from_ip = "\n" . "Remote Address=" . $_SERVER['REMOTE_ADDR'] . "\n" . "Browser=" . $_SERVER['HTTP_USER_AGENT'] . "\n" . " On web=" . $_SERVER['HTTP_REFERER'];
    $keterangan = $keterangan . $from_ip;
    $query = "INSERT INTO logserver
              SET
              TIMESTAMP = NOW(),ACCNO='$account',COMMENT = '$keterangan'";
    $DB->execonly($query);
    return 1;
}

function tradeLog2($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

function anti_injection($sql) {
    $sql = preg_replace(my_Sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)\'/"), "", $sql);
    $sql = trim($sql);
    $sql = strip_tags($sql);
    $sql = addslashes($sql);
    return $sql;
}

function my_Sql_regcase($str) {

    $res = "";

    $chars = str_split($str);
    foreach ($chars as $char) {
        if (preg_match("/[A-Za-z]/", $char))
            $res .= "[" . mb_strtoupper($char, 'UTF-8') . mb_strtolower($char, 'UTF-8') . "]";
        else
            $res .= $char;
    }

    return $res;
}

?>
