<?php
// For Connection
include_once ("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

$weekly = "SELECT * FROM ccf_source.mt4_daily WHERE LEFT(TIME, 10) BETWEEN '2016-02-10' AND '2016-02-16'";
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


	$insert = "INSERT INTO ccf_source.mt4_weekly (LOGIN,TIME,GROUP,BANK,BALANCE_PREV, BALANCE, DEPOSIT, CREDIT, PROFIT_CLOSED, PROFIT, EQUITY, MARGIN, MARGIN_FREE, MODIFY_TIME, PREV_PROFIT, NTR, STAT_NTR)
	VALUES ('$LOGIN','$TIME','$GROUP','$BANK','$BALANCE_PREV', '$BALANCE', '$DEPOSIT', '$CREDIT', '$PROFIT_CLOSED', '$PROFIT', '$EQUITY', '$MARGIN', '$MARGIN_FREE', '$MODIFY_TIME', '$PREV_PROFIT', '$NTR', '$STAT_NTR') ";
	$do = $DB->execonly($insert);
}

if ($do > 0) {
	echo "Success";
}else{
	echo "Gagal";
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