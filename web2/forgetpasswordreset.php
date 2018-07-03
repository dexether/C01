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
$template->assign("key", $key);
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
$template->assign("companys", $companys);
$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
//tradelog("forgetpasswordreset-82-data:" . $data[0]);
$variabel = explode("&", $data[0]); //a=1&account=" . $accountname . "&postmode=resetpasswordnya
//tradelog("forgetpasswordreset-84-variable:" . $variabel);
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$accountname = $accountvariabel[1];

$accountlink = $variabel[2]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$resetpasswordnya = $accountvariabel[1];

//tradelog("forgetpasswordreset-33-resetpasswordnya:" . $resetpasswordnya . ";accountname=" . $accountname);
if ($accountname == '') {
    display_error("37.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
}
$template->assign("accountname", $accountname);
if ($_POST) {
    $newpassword1 = anti_injection($_POST['password']);
    $encryptedpassword = MD5($newpassword1);
    $newpassword2 = anti_injection($_POST['confirmPassword']);
    if ($newpassword1 == $newpassword2 && strlen($newpassword1) >= 3) {
        $query = "update user set
        password = '$encryptedpassword' 
        where username = '$accountname' ";
        tradelog("forgetpasswordreset-48-query:" . $query);
         $DB->execonly($query);
        echo 0;
    } else {
        echo 1;
    }

    //header("Location:forgetpassword2.php");
}
$template->display("forgetpasswordreset.htm");

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>