<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
/**
 * file 	: mt4_weekly_do.php
 * fungsi	: batch file untuk memindahkan data terbaru dari tabel mt4_daily ke mt4_weekly
 * 
 * 
 */
$minggulalu = mktime (0,0,0, date("m"), date("d")-7,date("Y"));
$dateto = date('Y-m-d' , mktime (0,0,0, date("m"), date("d")-1,date("Y")));
$lw = date('Y-m-d', $minggulalu);


$key = 0;
if (isset($_GET['key'])) {
    $key = $_GET['key'];
}
$metas = 0;
if (isset($_GET['metas'])) {
    $metas = $_GET['metas'];
}

$do = 0;

// Start Here
if ($key == "weekly")

{		
	$weekly = "SELECT *, LEFT(TIME, 10) AS TIME2 FROM ".$metas.".mt4_daily WHERE LEFT(TIME,10) >= '".$dateto."' AND STAT_NTR = '1'";
	$hasil = $DB->execresultset($weekly);

	foreach ($hasil as $row) {
		
		$LOGIN 	= $row['LOGIN'];
		$TIME 	= $row['TIME'];
		$TIME2 	= $row['TIME2'];
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

		
		// Cek apakah Data Sudah ada ? 
		$cek = "SELECT LOGIN FROM ".$metas.".mt4_weekly WHERE LOGIN ='$LOGIN' AND LEFT(TIME, 10) = '$TIME2' AND LOGIN ='$LOGIN'";
		$do_cek = $DB->execresultset($cek);
		$hitung = count($do_cek);
		
		if ($hitung > 0) {
			
		}else{
			$insert =  "INSERT INTO ".$metas.".mt4_weekly VALUES ('$LOGIN','$TIME','$GROUP','$BANK','$BALANCE_PREV', '$BALANCE', '$DEPOSIT', '$CREDIT', '$PROFIT_CLOSED', '$PROFIT', '$EQUITY', '$MARGIN', '$MARGIN_FREE', '$MODIFY_TIME', '$PREV_PROFIT', '$NTR', '$STAT_NTR') ";
			$do = $DB->execonly($insert);
		}
	}
	
	// For Conditional
	if ($do > 0) {
		echo date('H:i:s') , " add - new data has been added"."<br";
	}else{
		echo date('H:i:s') , " add - No changes"."<br";
	}

	// Deleting LastWeek Account
	$query_del = "SELECT LOGIN, LEFT(TIME, 10) AS TIME2 FROM ".$metas.".mt4_weekly WHERE LEFT(TIME,10) <= '$lw'";
	$do2 = $DB->execresultset($query_del);
	if (count($do2) > 0) {
		$del = "DELETE FROM ".$metas.".mt4_weekly WHERE LEFT(TIME,10) <= '$lw'";
		$DB->execonly($del);
		echo date('H:i:s') , "delete - data has been deleted from : ".$lw."<br";
	}else{
		echo date('H:i:s') , "Delete - no changes"."<br";
	}
	
}elseif ($key == "initial")
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