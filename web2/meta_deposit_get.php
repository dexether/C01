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

$token = $security->set(3, 3600);
$template->assign("token", $token);
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

// Brokers
$postmode = anti_injection($_GET['postmode']);
switch ($postmode) {
  case 'broker':
    # code...
    $brokers = anti_injection($_GET['brokers']);
    $sql = "SELECT
              client_accounts.`accountname`,
              client_aecode.`name`
            FROM
              mlm2
              LEFT JOIN client_accounts
                ON client_accounts.`accountname` = mlm2.`ACCNO`
              LEFT JOIN client_aecode USING (aecodeid)
            WHERE mlm2.`mt4dt` = '$brokers'
            GROUP BY mlm2.`ACCNO`";
    $datas = $DB->execresultset($sql);
    // $rows = ['' => '--'];
    foreach ($datas as $key => $row) {
      # code...
      $rows[$row['accountname']] = $row['accountname'] . ' - ' . $row['name'];
    }
    $output = $rows;
    break;
  case 'login':
      $cabinetid = anti_injection($_GET['cabinetid']);
      $sql = "SELECT * FROM mlm2 WHERE mlm2.`ACCNO` = '$cabinetid'";
      $datas = $DB->execresultset($sql);
      foreach ($datas as $key => $row) {
        $rows[$row['mt4login']] = $row['mt4login'];
      }
      $output = $rows;
      break;
  default:

    break;
}
header('Content-Type: application/json');
echo json_encode($output, JSON_PRETTY_PRINT);
// {
//   "" : "--",
//   "series-1" : "1 series",
//   "series-3" : "3 series",
//   "series-5" : "5 series",
//   "series-6" : "6 series",
//   "series-7" : "7 series",
//   "selected" : "series-6"
// }

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


?>
