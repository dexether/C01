<?php
// For Connection
include_once ("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
ini_set('memory_limit', '-1');
// SET Param
$datefrom = 0;
if (isset($_GET['datefrom'])) {
    $datefrom = $_GET['datefrom'];
}
$dateto = 0;
if (isset($_GET['dateto'])) {
    $dateto = $_GET['dateto'];
}
$key = 0;
if (isset($_GET['key'])) {
    $key = $_GET['key'];
}
$metas = 0;
if (isset($_GET['metas'])) {
    $metas = $_GET['metas'];
}


// start of first initial data
if ($key == "initial")

{		
	$weekly = "SELECT * FROM ".$metas.".mt4_daily WHERE LEFT(TIME, 10) BETWEEN '".$datefrom."' AND '".$dateto."' AND STAT_NTR = '1'";
	$hasil = $DB->execresultset($weekly);

	foreach ($hasil as $row) {
		
		$LOGIN 	= $row['LOGIN'];
		$TIME 	= $row['TIME'];
		$GROUP  = $row['GROUP'];
		$BANK = $row['BANK'];
		$BALANCE_PREV = $row['BALANCE_PREV'];
		$BALANCE = $row['BALANCE'];
		$DEPOSIT = $row['DEPOSIT'];
		$CREDIT = $row['CREDIT'];
		$PROFIT_CLOSED = $row['PROFIT_CLOSED'];
		$PROFIT = $row['PROFIT'];
		$EQUITY = $row['EQUITY'];
		$MARGIN = $row['MARGIN'];
		$MARGIN_FREE = $row['MARGIN_FREE'];
		$MODIFY_TIME = $row['MODIFY_TIME'];
		$PREV_PROFIT = $row['PREV_PROFIT'];
		$NTR = $row['NTR'];
		$STAT_NTR = $row['STAT_NTR'];


		$insert = "INSERT INTO ".$metas.".mt4_weekly VALUES ('$LOGIN','$TIME','$GROUP','$BANK','$BALANCE_PREV', '$BALANCE', '$DEPOSIT', '$CREDIT', '$PROFIT_CLOSED', '$PROFIT', '$EQUITY', '$MARGIN', '$MARGIN_FREE', '$MODIFY_TIME', '$PREV_PROFIT', '$NTR', '$STAT_NTR') ";
		$do = $DB->execonly($insert);
	}
	
	if ($do > 0) {
		echo "0";
	}else{
		echo "1";
	}
	
}elseif ($key == "weekly")
{
	echo "Weekly";	
}

/*function tradeLogNtr($msg)
{
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}*/

 ?>