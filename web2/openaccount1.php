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
$branch = anti_injection($_GET['cabang']);


$tools = new CTools();
$branchkey = "a=1&branch=" . $branch;
//tradeLog("openaccount-14-BranchKey=".$branchkey);
$linezip = gzcompress($branchkey);
$key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
//$template->assign("key", $key);

$template->display("openaccount1.htm");
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