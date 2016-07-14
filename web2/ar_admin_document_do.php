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
$errno    = 0;
$subject  = "Success !";
$msg      = "Your request has been complete";
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}
$group_play = array();
if (isset($_POST['group_play'])) {
    $group_play = $_POST['group_play'];
}

$wcd = array();
if (isset($_POST['wcd'])) {
    $wcd = $_POST['wcd'];
}
$token = array();
if (isset($_POST['token'])) {
    $token = $_POST['token'];
}
$aecode = array();
if (isset($_POST['aecode'])) {
    $aecode = $_POST['aecode'];
}
foreach ($wcd as $rows) {
    $pecah  = explode('%', $rows);
    $wcds[] = $pecah[0];
}

/*====================================
=            Start Coding            =
====================================*/
if ($postmode == 'document') {
    if ($errno == 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($security->get($token)) {
                $security->delete($token);
                // Insert
                $query = "UPDATE client_aecode_bank SET status = '2' WHERE aecode = '$aecode'";
                $DB->execonly($query);
                $error   = "success";
                $subject = "Succes";
                $msg     = "Your request Success";
            } else {
                // echo 'Ga Valid.'; // invalid
                $error   = "error";
                $subject = "Oops, Something was happened";
                $msg     = "Try refresing the web page";
            }

        }
    }
} else if ($postmode == 'general') {
  if ($errno == 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($security->get($token)) {
                $security->delete($token);
                // Insert
                $query = "UPDATE client_document SET is_active = TRUE WHERE id = '$_POST[id]'";
                $DB->execonly($query);
                $error   = "success";
                $subject = "Succes";
                $msg     = "Your request Success";
            } else {
                // echo 'Ga Valid.'; // invalid
                $error   = "error";
                $subject = "Oops, Something was happened";
                $msg     = "Try refresing the web page";
            }

        }
    }
}else if ($postmode == 'delete') {
  if ($errno == 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($security->get($token)) {
                $security->delete($token);
                // Insert
                
                $query = "SELECT source FROM client_document WHERE id = '$_POST[id]'";
                $result = $DB->execresultset($query);
                unlink($result[0]['source']);
                $query = "DELETE FROM client_document WHERE id = '$_POST[id]'";

                $DB->execonly($query);
                $error   = "success";
                $subject = "Succes";
                $msg     = "Your request Success";
            } else {
                // echo 'Ga Valid.'; // invalid
                $error   = "error";
                $subject = "Oops, Something was happened";
                $msg     = "Try refresing the web page";
            }

        }
    }
}

/*=====  End of Start Coding  ======*/

$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
// header("Content-Type: application/json;charset=utf-8");
echo json_encode($response);

function myfilter($input_var_outer, $param)
{
    global $var_to_pass;
    $var_to_pass = $param;

    function mycallback($input_var_inner)
    {
        global $var_to_pass;
        return ($input_var_inner == $var_to_pass) ? true : false;
    }

    $return_arr = array_filter($input_var_outer, 'mycallback');
    $return_arr = array_merge(array(), $return_arr);
    return $return_arr;
}

function TradeLogUnderConstruct_Secure($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
