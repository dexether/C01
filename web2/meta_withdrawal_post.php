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

$broker = anti_injection($_POST['brokers']);
$cabinetid = anti_injection($_POST['cabinetid']);
$login = anti_injection($_POST['login']);
$amount = $_POST['amount'];
$sql = "SELECT * FROM mt_manager WHERE mt_manager.`mt4dt` = '$broker'";
$data = $DB->execresultset($sql);
if (count($data) == 0) {
  header('Content-Type: application/json');
  echo json_encode(['status' => false , 'msg' => "This Broker not have registered manager on system, Please add some one"], JSON_PRETTY_PRINT);
  exit();
}
foreach ($data as $key => $value) {
  $setting = $value;
}
require_once dirname(__FILE__) . '../../classes/metatrader/ManagerApi.class.php';
$manager = new ManagerApi($setting['ip'] , $setting['username'] , $setting['password']);
$deposit = $manager->withdrawal($login, $amount , 'Withdawal From Cabinet');
if($deposit == false):
  header('Content-Type: application/json');
  echo json_encode(['status' => false , 'msg' => $manager->display_error()], JSON_PRETTY_PRINT);
else:
// print_r($deposit->ticket);
  header('Content-Type: application/json');
  echo json_encode(['status' => true , 'msg' => 'Withdrawal Success amounted ' . number_format($amount ,2) . ' Your Ticket : '.$deposit->ticket], JSON_PRETTY_PRINT);
endif;


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
