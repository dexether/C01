<?php
session_start();
$skip_authentication = 1;
include("../includes/functions.php");
include_once("includes/wr_tools.php");
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}
$var_to_pass = null;
$branch = anti_injection(@$_GET['cabang']);


$tools = new CTools();
$branchkey = "a=1&branch=" . $branch;
//tradeLog("openaccount-14-BranchKey=".$branchkey);
$linezip = gzcompress($branchkey);
$key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
//$template->assign("key", $key);
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
	$companys['year'] = $years;
}
$template->assign("companys", $companys);

// Check agent
// MTYwNzEyMTQx
$agent = false;
if (isset($_GET['agent'])) {
	# code...
	$agent = anti_injection(base64_decode($_GET['agent']));
	$query = $DB->execresultset("SELECT client_accounts.accountname, client_aecode.email FROM client_accounts, client_aecode WHERE client_accounts.aecodeid = client_aecode.aecodeid AND client_accounts.accountname = '$agent'");
	$agent = false;
	foreach ($query as $key => $value) {
		# code...
		$agent['email'] = $value['email'];
		$agent['accno'] = base64_encode($value['accountname']);
		$agent['theurl'] = urlencode($companys['companyurl']."web2/referal.php?memberkey=".base64_encode($value['accountname']));

	}
}
$template->assign('agent', $agent);
$template->display("openaccount.htm");
function tradeLog($msg)
{
    $fp = fopen("trader.log","a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/"," ",$msg);
    fwrite($fp,$logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>