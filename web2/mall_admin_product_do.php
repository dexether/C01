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
$product_id = @$_POST['product_id'];
$category_id = @$_POST['category_id'];
$product_alias = @$_POST['product_alias'];
if(!empty($product_alias)):
  $product_alias = " AND master_product.prod_alias LIKE '%$product_alias%' ";
else:
  $product_alias - '';
endif;
/*====================================
=            Start Coding            =
====================================*/
if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
            if($postmode == 'get'):
                $sql = "SELECT client_aecode.address, client_aecode.telephone_mobile, cat_name, master_product.`id`, prod_name, prod_alias, cat_alias, client_aecode.`name` , email FROM master_product, master_cat, client_aecode WHERE master_product.`id_cat` = master_cat.`id` AND master_product.`aecodeid` = client_aecode.`aecodeid` $product_alias AND master_cat.id  = '$category_id'";
                $query = $DB->execresultset($sql);                
                ob_start();
                foreach($query as $rows):
                ?>
                <tr>
                  <td><a href="http://agendafx.com/c/<?php echo $rows['cat_name'] ?>/<?php echo $rows['prod_name'] ?>" target="_blank"><?php echo $rows['prod_alias'] ?></a></td>
                  <td><?php echo $rows['cat_alias'] ?></td>
                  <td>
                    <?php echo $rows['name'] ?>
                  </td>
                  <td>
                    <?php echo $rows['email'] ?>
                  </td>
                  <td>
                    <?php echo $rows['telephone_mobile'] ?>
                  </td>
                  <td>
                    <?php echo $rows['address'] ?>
                  </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="#" onclick="mall_admin_product_JS.delete(<?php echo $rows['id'] ?>);">hapus</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php
                endforeach;
                $response_data = ob_get_contents();
                ob_end_clean();
            elseif($postmode == 'delete'):
              $query = "DELETE FROM master_product WHERE master_product.id  = '$product_id'";
              $execute = $DB->execonly($query);
            endif;

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
