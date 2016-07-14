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

$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}
$token = "";
if (isset($_POST['token'])) {
    $token = $_POST['token'];
}
$account = "";
if (isset($_POST['account'])) {
    $account = $_POST['account'];
}
$id = "";
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
    $companys = $rows;
    $companys['year'] = $years;
}
// print_r($_POST);
$error = "success";
$subject = "Oops, Something has happened";
$msg = "contact software publisher";

/*====================================
=            Start Coding            =
====================================*/
if($error != 'error') {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($security->get($token)) {
          $security->delete($token);
          $query = "SELECT 
          mlm_arisan_account.`accountname`,
          mlm_arisan_account.`arisan_account`,
          mlm_arisan_block.`block`,
          mlm_arisan_block.`board`,
          client_aecode.`name`,
          client_aecode.`email`,
          client_accounts.`accountname`,
          mlm_arisan_block.`amount`,
          mlm_arisan.`id_block` 
          FROM
          mlm_arisan_account,
          mlm_arisan,
          mlm_arisan_block,
          client_accounts,
          client_aecode 
          WHERE mlm_arisan.`arisan_account` = mlm_arisan_account.`arisan_account` 
          AND mlm_arisan.`id_block` = mlm_arisan_block.`id` 
          AND client_accounts.`aecodeid` = client_aecode.`aecodeid` 
          AND mlm_arisan_account.`accountname` = client_accounts.`accountname`
          AND  mlm_arisan_block.id = '$id'
          ORDER BY mlm_arisan.datetime DESC 
          LIMIT 0, 1 ";
          
          $result = $DB->execresultset($query);


          $error = "success";
          $subject = "The winner has found ";
          $msg = "The winner is ".$result[0]['name']." on ".$result[0]['accountname'].", Pool Pier Number ".$result[0]['arisan_account']." , the detail has been emailed";

          switch ($result[0]['board']) {
            case 'BOARD 1':
                    // Change the status
            $query = "SELECT id, block, board FROM mlm_arisan_block WHERE block = '".$result[0]['block']."' AND board LIKE '%2'";
            $hasil = $DB->execresultset($query);
            foreach($hasil as $has){
                $final = $has;
            }

            $query = "UPDATE mlm_arisan SET datewin = NOW(), id_block = '$final[id]' WHERE arisan_account = '".$result[0]['arisan_account']."'";
            $DB->execonly($query);
            createFreeAccount($result[0]['accountname'], '1');
            break;
            case 'BOARD 2':
            $query = "SELECT id, block, board FROM mlm_arisan_block WHERE block = '".$result[0]['block']."' AND board LIKE '%3'";
            $hasil = $DB->execresultset($query);
            foreach($hasil as $has){
                $final = $has;
            }
            createFreeAccount($result[0]['accountname'], '3');
            $query = "UPDATE mlm_arisan SET datewin = NOW(), id_block = '$final[id]' WHERE arisan_account = '".$result[0]['arisan_account']."'";
            $DB->execonly($query);
            break;
            case 'BOARD 3':
            $query = "UPDATE mlm_arisan SET datewin = NOW() WHERE arisan_account = '".$result[0]['arisan_account']."'";
            $DB->execonly($query);

            $query = "UPDATE mlm_arisan_account SET finished = '1' WHERE arisan_account = '".$result[0]['arisan_account']."'";
            $DB->execonly($query);
            createFreeAccount($result[0]['accountname'], '5');
            break;

            default:
                    # code...
            break;
        }




            // createFreeAccount($account, $berapa)

            // Send Email
        $to = $result[0]['email'];
        $subject = "Congratulations, you are the Winner";
        $body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
        $body = $body . "Dear ".$result[0]['name'].",<br>";
        $body = $body . " <br>";
        $body = $body . "Congratulations, you have earned <b>WEALTH POOL PIER BONUS</b> bonus of USD ".number_format($result[0]['amount'], 2)." <br>";
        $body = $body . "This bonus will direct pay from ".$companys['companyname']." and will not change your E-Wallet and gold savings<br>";
        $body = $body . "And your account will participate automaticaly to NEXT Board, here the details<br>";
    
        $body = $body . "<br>";
        $body = $body . "<div align=justify>";
        $body = $body . "<table width=100% border=0 cellpadding=3 cellspacing=0>";
        $body = $body . "<tbody><tr>";
        $body = $body . "<td width=24% align=left valign=top><strong>Name:</strong></td>";
        $body = $body . "<td width=76% align=left valign=top><div align=justify>Membuat Program Perhitungan Gaji</div></td>";
        $body = $body . "</tr><tr>";
        $body = $body . "<td align=left valign=top><strong>E-Mail:</strong></td>";
        $body = $body . "<td align=left valign=top><div align=justify>e85111</div></td>";
        $body = $body . "</tr><tr>";
        $body = $body . "<td align=left valign=top><strong>Apex Account / Pool Pier Account:</strong></td>";
        $body = $body . "<td align=left valign=top><div align=justify>Open to Suggestions</div></td></tr><tr>";
        $body = $body . "<td align=left valign=top><strong>Block Level:</strong></td>";
        $body = $body . "<td align=left valign=top><div align=justify>5 hari</div></td></tr>";
        $body = $body . "if there any question about time payment, please contact us at ".$companys['admin_email']." and send this email too for requitment<br>";


        $body = $body . "</tbody></table></div>";

        $body = $body . "You may login to your APR program account via our website at ".$companys['companyurl']." <br>";
        $body = $body . " <br>";
        $body = $body . " <br>";
        $body = $body . "Thank you,<br>";
        $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
        $body = $body . $companys['long_address'];

        $body = $body . " Email : ".$companys['email']." <br>";
        $body = $body . " ".$companys['companyurl']." <br>";
        sendEmail($to, $subject, $body, 'ar_admin_rqb');
    } else {
          // echo 'Ga Valid.'; // invalid
      $error = "error";
      $subject = "Oops, Something has happened";
      $msg = "Try refresing the web page";
  }

}
}
$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
// header("Content-Type: application/json;charset=utf-8");
echo json_encode($response);
/*=====  End of Start Coding  ======*/
function tradeLog($msg) {
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
function getIdentitas($account) {
    global $DB;
    $query = "SELECT 
    client_accounts.`accountname`,
    client_aecode.`email`,
    client_aecode.`name` 
    FROM
    client_accounts,
    client_aecode 
    WHERE client_accounts.`accountname` = '$account'
    AND client_aecode.`aecodeid` = client_accounts.`aecodeid`";
    $result = $DB->execresultset($query);
    foreach($result as $rows) {
        $datas = $rows;
    }
    return $datas;
}
function createFreeAccount($account, $berapa){
    global $DB;
    global $companys;

    $minggu = 1;
    for ($i=0; $i < $berapa; $i++) { 
        $timedaftar = date('Y-m-d H:i:s', strtotime('+'.$minggu.' week'));
        $query = "SELECT COUNT(mlm_arisan.`id`) AS number FROM mlm_arisan";
        $result = $DB->execresultset($query);
        $urutan = $result[0]['number'] + 1;
        $arisan_account = $account . "-". $urutan;
        $query = "INSERT INTO mlm_arisan_account SET accountname = '$account', arisan_account = '$arisan_account' , date_create = NOW(), date_modify = NOW(), payment = '0', status = 'free', finished = '0'";
        $DB->execonly($query);

        $query = "SELECT 
        mlm.`ACCNO`,
        mlm.group_play,
        mlm_arisan_block.`id`
        FROM
        mlm,
        mlm_arisan_block 
        WHERE mlm.`group_play` = mlm_arisan_block.`group_play` 
        AND mlm.`ACCNO` = '$account' 
        AND mlm_arisan_block.`board` LIKE '%1'";
        $result = $DB->execresultset($query);
        foreach($result as $row){
            $id_block = $row['id'];
        }
        $query = "INSERT INTO mlm_arisan SET id_block = '$id_block', arisan_account = '$arisan_account', datetime = '$timedaftar'";
            // var_dump($query);
        $DB->execonly($query);

        $iden = getIdentitas($account);
        $subject = "Weatlh Pool Pier FREE Account created";
        $body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
        $body = $body . "Dear ".$iden['name'].",<br>";
        $body = $body . " <br>";
        $body = $body . "Thank you for participation at WEALTH POOL PIER BONUS, we will give you a FREE account so that you can participate again, your arrisan account is (".$arisan_account."), next you should not pay to company and Confirm it<br>";
        $body = $body . "Thanks for your participation <br>";
        $body = $body . "You may login to your APR program account via our website at ".$companys['companyurl']." <br>";
        $body = $body . " <br>";
        $body = $body . " <br>";
        $body = $body . "Thank you," . "<br>";
        $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
        $body = $body . $companys['long_address'];
        $body = $body . " Email : ".$companys['email']." <br>";
        $body = $body . " ".$companys['companyurl']." <br>";
        sendEmail($iden['email'], $subject, $body, 'ar_admin_arisan_do');
        $minggu++;
    }
}
?>