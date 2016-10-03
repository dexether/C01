<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;
global $aecodeid;
$security = new \security\CSRF;
$token = $security->set(6, 3600);
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

$_SESSION['page'] = 'imp_mall';

/*====================================
=            Start Coding            =
====================================*/

$query = "SELECT value FROM app_config WHERE app_config.key = 'base_url'";
$result = $DB->execresultset($query);
foreach ($result as $key => $value) {
    $base_url = $value['value'];
}
$template->assign('base_url', $base_url);
$query = "SELECT
master_product.`id`,
  master_product.`prod_alias`,
  master_product.`prod_name`,
  master_product.`comm`,
  master_product.`prod_price`,
  master_cat.`cat_name`,
  client_aecode.`name`,
  master_cat.cat_alias
FROM
  master_product,
  master_cat,
  client_aecode
WHERE master_product.`id_cat` = master_cat.`id`
  AND master_product.`aecodeid` = client_aecode.`aecodeid`
  AND master_product.`is_active` = FALSE ";
$result = $DB->execresultset($query);
$template->assign('product_list', $result);

/*=====  End of Start Coding  ======*/


$template->display("imp_mall.htm");

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
