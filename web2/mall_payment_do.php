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
$user     = $_SESSION['user'];
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
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
$error            = "success";
$subject          = "General Error ";
$msg              = "";
$postmode = @$_GET['postmode'];
$cmd = @$_POST['cmd'];
$token = @$_POST['token'];
$tglnya = @$_POST['tglnya'];
$response_data = "";
if($tglnya != ''):
  $finaltgl = explode(" - ", $tglnya);
  $from = $finaltgl[0]." 00:00:00";
  $to = $finaltgl[1]." 00:00:00";
endif;

/*====================================
=            Start Coding            =
====================================*/
if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
            $query = "SELECT app_config.key, app_config.`value` FROM app_config WHERE app_config.`key` = 'base_url'";
            $result = $DB->execresultset($query);
            foreach ($result as $key => $value) {
              $base_url = $value['value'];
            }
            if($postmode == "get"){


            $query = "SELECT
                invoice,
                timeupdate,
                unix_price,
                cmd_alias,
                master_invoice.upload_file,
                master_invoice.cmd
              FROM
                master_invoice
                LEFT JOIN master_cmd
                  ON master_invoice.`cmd` = master_cmd.`cmd`
              WHERE master_invoice.cmd = '$cmd'
                AND timeupdate BETWEEN '$from'
                AND '$to' ";
            $result = $DB->execresultset($query);
            $payment_data = array();
            foreach ($result as $key => $value) {
              # code...
              $payment_data[] = $value;
            }
            // print_r($query);
            if(!empty($payment_data)):
              foreach ($payment_data as $key => $value) {

                if($value['unix_price'] == '0'):
                  $value['unix_price'] = "See Invoice";
                endif;

                if($value['cmd'] == '10'):
                  $link = "<a href='".$base_url."/api/images?callback=".base64_encode($value['upload_file'])."' target='_blank'>See atatchment</a> ";
                  $actions = '
                  <li><a href="#" onclick="mall_payment_JS.admin_confirm(\''.$value['invoice'].'\', token.value);">Approve Payment</a></li>
                  <li><a href="#" onclick="mall_payment_JS.admin_reject(\''.$value['invoice'].'\', token.value);">Reject Payment</a></li>

                  <li class="divider"></li>
                  <li><a href="#">Pending</a></li>
                  ';

                elseif($value['cmd'] == '11'):
                  $link = "";
                  $actions = '

                  <li><a href="#" onclick="mall_payment_JS.admin_send(\''.$value['invoice'].'\', token.value);">Send Product</a></li>

                  <li class="divider"></li>
                  <li><a href="#">Pending</a></li>
                  ';
                else:
                  $link = "";
                  $actions = '
                  <li><a href="#" onclick="mall_payment_JS.admin_reject(\''.$value['invoice'].'\', token.value);">Reject Payment</a></li>

                  <li class="divider"></li>
                  <li><a href="#">Pending</a></li>
                  ';
                endif;
                $response_data =  @$response_data.'
                <tr>
                  <td>
                  <a href="#">'.$value['invoice'].'</a>
                  <p>
                  <small><strong>TIME : </strong>'.$value['timeupdate'].' '.$link.' </small>
                  </p>
                  </td>
                  <td>
                  '.
                  $value['unix_price']
                  .'
                  </td>
                  <td>
                  '.$value['cmd_alias'].'
                  </td>
                  <td>
                  <div class="input-group">
                      <div class="input-group-btn">
                          <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="true">Action <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                              '.$actions.'
                          </ul>
                      </div>

                  </div>
                  </td>
                </tr>
                ';
              }
            else:
              $response_data = "<tr><td colspan=3>No Data</td></tr>";
            endif;
            $response_data = $response_data;
            $error   = "success";
            $subject = "Success";
            $msg     = "Success";
          }elseif($postmode == "approve"){
              $invoice = @$_POST['invoice'];
              $response_data = "";
              $error   = "success";
              $subject = "Success Approved";
              $msg     = "Email Approved was send";
              $update = "UPDATE master_invoice SET cmd = '11', timeupdate = NOW()  WHERE invoice = '$invoice'";
              // tradeLogs($update);
              $DB->execonly($update);

              // Send Email
              $query = "SELECT
                client_aecode.`name`,
                client_aecode.`email`
              FROM
                master_invoice,
                master_cart,
                client_aecode
              WHERE master_invoice.`invoice` = master_cart.`invoice`
              AND master_cart.`aecodeid` = client_aecode.`aecodeid`
              AND master_invoice.`invoice` = '$invoice'";
              $result = $DB->execresultset($query);
              foreach ($result as $key => $value) {
                # code...
                $data = $value;
              }
              $body = file_get_contents($base_url.'/api/sendEmailAfterApprove/'.$invoice);
              sendEmail($data['email'], "Pembayaran anda telah kami konfirmasi", $body, "mall_payment_do.php");
            }elseif($postmode == "reject"){
                $invoice = @$_POST['invoice'];
                $response_data = "";
                $error   = "success";
                $subject = "Success Reject";
                $msg     = "Email Rejection was send";
                $update = "UPDATE master_invoice SET cmd = '9', timeupdate = NOW() WHERE invoice = '$invoice'";
                // tradeLogs($update);
                $DB->execonly($update);

                // Send Email
                $query = "SELECT
                  client_aecode.`name`,
                  client_aecode.`email`
                FROM
                  master_invoice,
                  master_cart,
                  client_aecode
                WHERE master_invoice.`invoice` = master_cart.`invoice`
                AND master_cart.`aecodeid` = client_aecode.`aecodeid`
                AND master_invoice.`invoice` = '$invoice'";
                $result = $DB->execresultset($query);
                foreach ($result as $key => $value) {
                  # code...
                  $data = $value;
                }
                $body = file_get_contents($base_url.'/api/sendEmailAfterReject/'.$invoice);
                sendEmail($data['email'], "Pembayaran anda tidak dapat kami konfirmasi", $body, "mall_payment_do.php");
              }elseif($postmode == "send"){
                $invoice = @$_POST['invoice'];
                $resi = @$_POST['resi'];
                $resi = strtoupper($resi);
                $response_data = "";
                $error   = "success";
                $subject = "Success";
                $msg     = "Change status to Sending success";
                $update = "UPDATE master_invoice SET cmd = '13', timeupdate = NOW(), resi = '$resi' WHERE invoice = '$invoice'";
                // tradeLogs($update);
                $DB->execonly($update);

                // Send Email
                $query = "SELECT
                  client_aecode.`name`,
                  client_aecode.`email`
                FROM
                  master_invoice,
                  master_cart,
                  client_aecode
                WHERE master_invoice.`invoice` = master_cart.`invoice`
                AND master_cart.`aecodeid` = client_aecode.`aecodeid`
                AND master_invoice.`invoice` = '$invoice'";
                $result = $DB->execresultset($query);
                foreach ($result as $key => $value) {
                  # code...
                  $data = $value;
                }
                $body = file_get_contents($base_url.'/api/sendemailafterSend/'.$resi);
                sendEmail($data['email'], "Transaksi anda telah selesai", $body, "mall_payment_do.php");
              }
        } else {
            // echo 'Ga Valid.'; // invalid
            $error   = "error";
            $subject = "Oops, Something has happened";
            $msg     = "Try refresing the web page";
        }

    }
}
$response['token'] = $security->set(3, 3600);;
$response['status'] = $error;
$response['$subject'] = $subject;
$response['msg'] = $msg;
$response['data_html'] = $response_data;

echo json_encode($response, JSON_UNESCAPED_SLASHES);
function tradeLogs($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
function sendEmail($to, $subject, $body, $module) {
  global $DB;
  $timeupdate = date('Y-m-d H:i:s', strtotime('-1 hour'));
  $query = "insert into email set
  timeupdate = '$timeupdate',
  email_to = '$to',
  email_subject = '$subject',
  email_body = '$body',
  timesend = '1970-01-31 00:00:00',
  module = '$module'
  ";
  $DB->execonly($query);
}
//function create_or_use_upline($group_play,$email){
