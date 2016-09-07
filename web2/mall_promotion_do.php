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

$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$query  = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years  = date('Y', time());
foreach ($result as $rows) {
    $companys         = $rows;
    $companys['year'] = $years;
}
$error    = "success";
$subject  = "General Error ";
$msg      = "";

$token = anti_injection($_POST['token']);
$periode = anti_injection($_POST['periode']);
$productlist = anti_injection($_POST['productlist']);
$promolist = anti_injection($_POST['promolist']);
/*====================================
=            Start Coding            =
====================================*/

// Cek Dlu apakah udah ada promosi
$query = "SELECT id FROM master_product_promo WHERE id_product = '$productlist' AND id_promo = '$promolist' AND datefrom <= NOW() AND dateto >= NOW()";
$result = $DB->execresultset($query);
if(count($result) > 0):
  $error = "error";
  $subject = "Maaf, request anda tidak dapat diproses";
  $msg     = "Produk ini masih ada promo yang aktif, silahkan edit promo anda";
endif;

// print_r($query);

if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
            $date = priodeToDate($periode);

            $query = "INSERT INTO master_product_promo SET id_product = '$productlist', id_promo = '$promolist', datefrom = '$date[datefrom]', dateto = '$date[dateto]', cmd = '0'";
            $doit = $DB->execonly($query);
            if ($doit) {
              # code...
              $error = "success";
              $subject = "Suksess";
              $msg     = "Produk anda sudah ditambahkan ke daftar promo";
            }else{
              $error = "error";
              $subject = "Maaf, request anda tidak dapat diproses";
              $msg     = "Gagal mengambil data keserver, coba lagi nanti";
            }

        } else {
            // echo 'Ga Valid.'; // invalid
            $error   = "error";
            $subject = "Oops, Something has happened";
            $msg     = "Try refresing the web page";
        }

    }
}
$response['status'] = $error;
$response['subject'] = $subject;
$response['msg'] = $msg;
// header("Content-Type: application/json;charset=utf-8");
echo json_encode($response, JSON_PRETTY_PRINT);
function priodeToDate($date){
  $pecah = explode(' - ', $date);
  if($date != NULL && count($pecah) > 0):
    $pecah = explode(' - ', $date);
    return array('datefrom' => $pecah[0], 'dateto' => $pecah[1]);
  else:
    return false;
  endif;

}
?>
