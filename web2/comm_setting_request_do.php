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
$token            = @($_POST['token']);
$len			  = @($_POST['len']);
$cabinetid		  = @($_POST['cabinetid']);
$rebate           = @($_POST['rebate']);

for($i=0;$i<$len;$i++){
	${"upline_no".$i} = @($_POST['upline_no'.$i]);
	${"upline_name".$i} = @($_POST['upline_name'.$i]);
	${"upline_comm".$i} = @($_POST['upline_comm'.$i]);
}

/*====================================
=            Start Coding            =
====================================*/
if ($error != 'error') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($security->get($token)) {
            $security->delete($token);
			$query = "SELECT * FROM commission_setting WHERE fromno = '$cabinetid'";
			$rows = $DB->execresultset($query);
			$checkdata = array();
			foreach ($rows as $row) {
				$checkdata[] = $row;
			}
			if(count($checkdata) > 0) {
				$query = "DELETE FROM commission_setting WHERE fromno ='$cabinetid'";
				$DB->execonly($query);
			}
			$query = "SELECT client_accounts.accountname,client_aecode.name FROM client_aecode,client_accounts WHERE client_accounts.aecodeid = client_aecode.aecodeid AND client_aecode.aecode = '$user->username'";
			tradeLogs("query requestby :".$query);
			$result = $DB->execresultset($query);
			foreach($result as $row){
				$requestbyno = $row['accountname'];
				$requestbyname = $row['name'];
			}
			
			$query = "SELECT client_aecode.name FROM client_aecode,client_accounts WHERE client_accounts.aecodeid = client_aecode.aecodeid AND client_accounts.accountname = '$cabinetid'";
			tradeLogs("query accountname :".$query);
			$result = $DB->execresultset($query);
			foreach($result as $row){
				$accountname = $row['name'];
			}
			$query = "INSERT INTO commission_setting (accountno, accountname, account_comm, fromname, fromno, requestbyname, requestbyno, status) VALUES ('$cabinetid', '$accountname', '$rebate', '$accountname', '$cabinetid', '$requestbyname', '$requestbyno', 'approved')";
			tradeLogs("query rebate :".$query);
			$DB->execonly($query);
			for($i=0;$i<$len;$i++){
				if(!empty(${"upline_comm".$i})){
				$query = "INSERT INTO commission_setting (accountno, accountname, account_comm, fromname, fromno, requestbyname, requestbyno, status) VALUES ('".${"upline_no".$i}."', '".${"upline_name".$i}."', '".${"upline_comm".$i}."', '$accountname', '$cabinetid', '$requestbyname', '$requestbyno', 'approved')";
				tradeLogs("query loop :".$query);
				$DB->execonly($query);
				}
			}
            
             $error   = "success";
             $subject = "Insert commission setting data success";
            $msg     = "Please wait for page to refresh";
	
        } else {
            // echo 'Ga Valid.'; // invalid
            $error   = "error";
            $subject = "Oops, Something has happened";
            $msg     = "Try refresing the web page";
        }
    }
}
$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
echo json_encode($response);

function tradeLogs($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
?>