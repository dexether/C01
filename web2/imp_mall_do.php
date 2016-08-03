<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require_once "$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php";
include_once "includes/wr_tools.php";
global $user;
global $template;
global $mysql;
global $DB;

$user     = @$_SESSION['user'];
$security = new \security\CSRF;
$error    = "success";
$subject  = "Oops, Something has happened";
$msg      = "Try refresing the web page";
$progress = 0;
$postmode = @$_GET['postmode'];
$token    = @$_POST['token'];
$id       = @$_POST['id'];
/*=============================================
=            Section comment block            =
=============================================*/
// tradeLogs($_SERVER['REQUEST_METHOD']);

$query  = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
foreach ($result as $key => $value) {
    # code...
    $companys = $value;
}

$query  = "SELECT value FROM app_config WHERE app_config.key = 'base_url'";
$result = $DB->execresultset($query);
foreach ($result as $key => $value) {
    $base_url = $value['value'];
}
if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
            $token = $security->set(3, 3600);
            /* Start Of Postmode */
            if ($postmode == 'agree') {
                # code...
                $update = "UPDATE master_product SET is_active = TRUE, master_product.timestamp = NOW() WHERE id = '$id'";
                $do     = $DB->execonly($update);
                if ($do) {

                    $error    = "success";
                    $subject  = "Success";
                    $msg      = "Approval Success";
                    $progress = 0;
                    # code...
                    $data = getDatas($id);
                    $to      = $data['email'];
                    $subject = "Produk anda telah dikonfimasi oleh admin";
                    $body    = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
                    $body    = $body . "Dear " . $data['name'] . ",<br>";
                    $body    = $body . " <br>";
                    $body    = $body . "Selamat Produk anda telah terkonfirmasi <br>";
                    $body    = $body . " <br>";
                    $body    = $body . "Anda bisa lihat produk anda di " . $companys['companyurl'] . " <br>";
                    $body    = $body . " <br>";
                    $body    = $body . " <br>";
                    $body    = $body . "Thank you,<br>";
                    $body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
                    $body    = $body . $companys['long_address'];
                    $body    = $body . " Email : " . $companys['email'] . " <br>";
                    $body    = $body . " " . $companys['companyurl'] . " <br>";
                    sendEmail($to, $subject, $body, 'imp_mall_do');
                    // ------------------------------------
                } else {
                    $error    = "error";
                    $subject  = "Error While update";
                    $msg      = "Error";
                    $progress = 0;
                }

            } else {
                
                $data = getDatas($id);
                $to      = $data['email'];
                $subject = "Produk anda telah ditolak oleh admin";
                $body    = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
                $body    = $body . "Dear " . $to . ",<br>";
                $body    = $body . " <br>";
                $body    = $body . "Maaf produk yang anda input tidak memenuhi kualifikasi, silahkan coba lagi nanti <br>";
                $body    = $body . " <br>";
                $body    = $body . " <br>";
                $body    = $body . "Thank you,<br>";
                $body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
                $body    = $body . $companys['long_address'];
                $body    = $body . " Email : " . $companys['email'] . " <br>";
                $body    = $body . " " . $companys['companyurl'] . " <br>";
                sendEmail($to, $subject, $body, 'imp_mall_do');
                $error   = "success";
                $subject = "Success";
                $msg     = "Reject Success";
                $update  = "DELETE FROM master_product WHERE id = '$id'";
                $do      = $DB->execonly($update);
            }

            $token = $security->set(3, 3600);
        } else {
            $error    = "error";
            $subject  = "Error";
            $msg      = "your session has been expire, Try refresing the web page";
            $progress = 0;
        }

    }
}
$response['status'] = $error;
$response['title']  = $subject;
$response['msg']    = $msg;
$response['token']  = $token;
echo json_encode($response, JSON_PRETTY_PRINT);

/*=====  End of Section comment block  ======*/

function tradeLogs($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
function sendEmail($to, $subject, $body, $module)
{
    global $DB;
    $timeupdate = date('Y-m-d H:i:s', strtotime('-1 hour'));
    $query      = "insert into email set
    timeupdate = '$timeupdate',
    email_to = '$to',
    email_subject = '$subject',
    email_body = '$body',
    timesend = '1970-01-31 00:00:00',
    module = '$module'
    ";
    $DB->execonly($query);
}
function getDatas($id){
    global $DB;
    $query = "SELECT email, name FROM client_aecode, master_product WHERE master_product.aecodeid = client_aecode.aecodeid AND master_product.id = '$id'";
    $result = $DB->execresultset($query);
    $data = array();
    foreach ($result as $key => $value) {
        # code...
        $data = $value;
    }
    return $data;
}