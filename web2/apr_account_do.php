<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;
$security = new \security\CSRF;


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
$token = "";
if (isset($_POST['token'])) {
    $token = $_POST['token'];
}

$error = "error";
$subject = "Oops, Something has happened";
$msg = "contact software publisher";

/*====================================
=            Start Coding            =
====================================*/

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($security->get($token)) {
      $security->delete($token);
      // echo 'Valid Bro.'; // valid
      $descriptions = array();
      $query = "SELECT description FROM client_aecode WHERE description LIKE ('%APR%') ORDER BY description ASC";
      $result = $DB->execresultset($query);
      foreach ($result as $rows) {
          $descriptions[] = $rows;
      }
      // for ($icount = 0; $icount < count($descriptions); $icount++) {
      foreach($descriptions as $rows) {
        $description = $rows['description'];

        // TradeLogUnderConstruct_Secure("APR_account-45 : ". $description);
        $GSPnya = explode(":", $description);
            //tradeLogGPS_Account("GPS_Account-153:".$description.";".$GSPnya[1]);
        $description2 = strtoupper($GSPnya[1]);

        $level01_3 = substr($description2, 0, 3);
            //tradeLogGPS_Account("GPS_Account-157:".$level01_3.";Awalnya : ".$description);
        checkusername($level01_3);

        $level02_1 = $level01_3 . substr($description2, 3, 1);
            //tradeLogGPS_Account("GPS_Account-192:" . $level02_1);
        checkusername($level02_1);

        $level04_number = $level02_1 . "-" . substr($description2, 5, 1);
            //tradeLogGPS_Account("GPS_Account-165:" . $level04_number);
        checkusername($level04_number);

        $level05_AZ = $level04_number . substr($description2, 6, 1);
            //tradeLogGPS_Account("GPS_Account-169:" . $level05_AZ);
        checkusername($level05_AZ);

        $level06_Strip2a = explode("-", $description2);
        $level06_Strip2b = $level02_1."-".$level06_Strip2a[1];
            //tradeLogGPS_Account("GPS_Account-174:" . $level06_Strip2b);
        checkusername($level06_Strip2b);

            $level07_0_9999 = $level06_Strip2b."-".$level06_Strip2a[2]; //1005
            //tradeLogGPS_Account("GPS_Account-178:" . $level07_0_9999);
            checkusername($level07_0_9999);
        }
        $error = "success";
        $subject = "Succes";
        $msg = "Username has been updated";
    } else {
      // echo 'Ga Valid.'; // invalid
      $error = "error";
      $subject = "Oops, Something has happened";
      $msg = "Try refresing the web page";
  }

}
$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
// header("Content-Type: application/json;charset=utf-8");
echo json_encode($response);
/*=====  End of Start Coding  ======*/


function checkusername($usernamecheck) {
    global $DB;
    $check_level = "belumada";
    $query = "select * from user where username = '$usernamecheck'";
    $result = $DB->execresultset($query);
    if (count($result) > 0) {
        $check_level = 'ada';
    }
    //tradeLogGPS_Account("GPS_Account-160:" . $query);
    if ($check_level == 'belumada') {
        $query = "INSERT INTO user SET user.countertype = 'NONE',
        user.username = '$usernamecheck',
        user.password = '81dc9bdb52d04dc20036dbd8313ed055',
        user.groupid = '15',
        user.lastseen = '0',
        user.lastlogin = '0',
        user.lastactivity = '0',
        user.languageid = '1',
        user.intset = 'COMMON',
        user.themesid = 'classicmonochromatic',
        user.companygroup = 'semua',
        user.viewtype ='apexregent',
        user.directdone = 'yes',
        user.validation = 'no',
        user.disclosure = 'yes',
        user.fromip = '',
        user.frommachine = '',
        user.login_created = NOW(),
        user.login_end = '2099-12-31 23:59:59'";
        // tradeLogGPS_Account("GPS_Account-268:" . $query);
        $DB->execonly($query);
    }//if($check_level01_3=='ada'){
    }
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

    function TradeLogUnderConstruct_Secure($msg) {
        $fp = fopen("trader.log", "a");
        $logdate = date("Y-m-d H:i:s => ");
        $msg = preg_replace("/\s+/", " ", $msg);
        fwrite($fp, $logdate . $msg . "\n");
        fclose($fp);
        return;
    }


    ?>