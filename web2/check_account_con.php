<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
global $DB;
/* This is just a dummy file for generating example JSON. */

// header("Access-Control-Allow-Origin: *");
$query = "SELECT 
  mlm.`mt4dt`,
  mlm.`ACCNO`, 
  mt_database.`alias` 
FROM
  mlm 
  LEFT JOIN mt_database 
    ON mlm.`mt4dt` = mt_database.`mt4dt` 
WHERE ACCNO = '$_POST[account]'";
$result = $DB->execresultset($query);
foreach ($result as $row) {
    if ($row['mt4dt'] == 'nometa') {
        $response['valid'] = true;
        $response['available'] = true;
        $response['msg'] = 'This Account Has no connect to other Thirty Parties';
    }else{
        $response['valid'] = true;
        $response['available'] = false;
        $response['msg'] = 'This Account has been set for '.  $row['alias'];
    }

}
echo json_encode($response);
?>



<?php
function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
?>