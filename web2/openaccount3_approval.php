<?php

session_start();
$skip_authentication = 1;
include("../includes/functions.php");
session_unset();

include_once("includes/wr_tools.php");
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}
$var_to_pass = null;
$tools = new CTools();

if (!$_GET['key']) {
    display_error("17.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
}
$key = $_GET['key'];
//tradelog("OpenAccount3_Approval-20-Key:" . $key.";Crypt:".$crypt_key);
$template->assign("key", $key);

$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
//tradelog("OpenAccount3_Approval-23-data:" . $data);
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
//tradelog("OpenAccount3_Approval-26-data:" . $data[0]);
$variabel = explode("&", $data[0]); //a=1&account=" . $accountname . "&postmode=resetpasswordnya
//tradelog("OpenAccount3_Approval-84-variable:" . $variabel);
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$accountname = $accountvariabel[1];

$accountlink = $variabel[2]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$approveaccount = $accountvariabel[1];

$passwordlink = $variabel[3]; //account=1234567
$passwordvariabel = explode("=", $passwordlink);
$password = $passwordvariabel[1];

//tradelog("OpenAccount3_Approval-41-Approveaccount:" . $approveaccount . ";accountname=" .$accountname.";Password:".$password);
$email = $accountname;

$query = "SELECT * FROM config";
$result = $DB->execresultset($query);
foreach($result as $rows) {
	$configs[$rows['name']] = $rows['value'];
}



if ($accountname == '') {
    display_error("37.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
}
$template->assign("accountname", $accountname);

$output = "false";
if ($approveaccount == 'approveuser') {
			
			if($configs['sync'] == 1){
				$apidata = array();				
				$apidata['email'] = $email;
				$data = base64_encode(serialize($apidata));
				$ch = curl_init();
				
				// set URL and other appropriate options
                                if($configs['sk_url'] == 'members.cfforex.com'){
                                  curl_setopt($ch, CURLOPT_URL, "https://".$configs['sk_url']."/api2/postactivation/".$data);
                                }else{
                                  curl_setopt($ch, CURLOPT_URL, "http://".$configs['sk_url']."/api2/postactivation/".$data);
                                }
				
				curl_setopt($ch, CURLOPT_HEADER, 0);

				// grab URL and pass it to the browser
				curl_exec($ch);

				// close cURL resource, and free up system resources
				curl_close($ch);
			}
    $query = "update client_aecode set
        status = '1' 
        where aecode = '$email' ";
    //tradelog("OpenAccount3_Approval-51-query:" . $query);
    $DB->execonly($query);
	$query = "SELECT accountname FROM client_aecode,client_accounts
        WHERE client_aecode.aecodeid = client_accounts.aecodeid AND aecode = '$email' ";
    //tradelog("OpenAccount3_Approval-51-query:" . $query);
    $rows = $DB->execresultset($query);
	foreach ($rows as $row) {
		$accountno = $row['accountname'];
		$query = "update client_accounts set
        suspend = '0' 
        where accountname = '$accountno' ";
		//tradelog("OpenAccount3_Approval-51-query:" . $query);
		$DB->execonly($query);
	}
	
    $output = "true";
}
$keterangan = '';
if ($password == 'resendemail') {
    $output = "false";
    $keterangan = "You Email has been validated, Please login into the system using your email and password";
}
//tradelog("OpenAccount3_Approval-58-Output:".$output);
$template->assign("keterangan", $keterangan);
$template->assign("output", $output);

if ($output == 'false') {
    //tradelog("OpenAccount3_Approval-62");
    $template->display("openaccount3_approval.htm");
} else {
  header("Location: http://".$configs['sk_url']); /* Redirect browser */
  exit();
}

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>
