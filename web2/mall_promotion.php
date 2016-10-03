<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;
// Scurity
$security = new \security\CSRF;
$token = $security->set(3, 3600);
$template->assign("token", $token);
$query  = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years  = date('Y', time());
foreach ($result as $rows) {
    $companys         = $rows;
    $companys['year'] = $years;
}
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

$_SESSION['page'] = 'mall_promotion';

/*====================================
=            Start Coding            =
====================================*/

$query = "SELECT id, promo_name, promo_value, promo_alias FROM master_promo";
$result = $DB->execresultset($query);
$template->assign('promolist', $result);

$query = "SELECT id, prod_alias FROM master_product ORDER BY prod_alias";
$result = $DB->execresultset($query);
$template->assign('productlist', $result);
$query = "SELECT
  prod_alias,
  master_product_promo.`datefrom`,
  master_product_promo.`dateto` ,
  master_promo.`promo_alias`
FROM
  master_product,
  master_product_promo,
  master_promo
WHERE master_product.`id` = master_product_promo.`id_product`
  AND master_promo.`id` = master_product_promo.`id_promo`
ORDER BY prod_alias";
$result = $DB->execresultset($query);
$template->assign('listofpromoproduct', $result);

$template->display("mall_promotion.htm");

function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>
