<?php
if (isset($_GET['login'])) {
$mysqli = new mysqli('localhost','root','','mahadana_source');

$qdeposit = $mysqli->query("select sum(PROFIT) as deposit from `MT4_TRADES` where `LOGIN` = ".$_GET['login']." and `CMD` = 6 and `COMMENT` LIKE '%dep%'");
$deposit = $qdeposit->fetch_row();

$qwithdrawal = $mysqli->query("select sum(PROFIT) as withdrawal from `MT4_TRADES` where `LOGIN` = ".$_GET['login']." and `CMD` = 6 and `COMMENT` LIKE '%with%'");
$withdrawal = $qwithdrawal->fetch_row();

$qcommission = $mysqli->query("select sum(COMMISSION) as commission from `MT4_TRADES` where `LOGIN` = ".$_GET['login']." and `CMD` in (0, 1) and date(`CLOSE_TIME`) > '1970-01-02'");
$commission = $qcommission->fetch_row();

$qadjustment = $mysqli->query("select sum(PROFIT) as adjustment from `MT4_TRADES` where `LOGIN` = ".$_GET['login']." and `CMD` = 6 and `COMMENT` LIKE '%adj%'");
$adjustment = $qadjustment->fetch_row();

$qother = $mysqli->query("select sum(PROFIT) as other from `MT4_TRADES` where `LOGIN` = ".$_GET['login']." and `CMD` = 6 and `COMMENT` NOT LIKE '%dep%' and `COMMENT` NOT LIKE '%with%' and `COMMENT` NOT LIKE '%adj%'");
$other = $qother->fetch_row();
$a = array('deposit'=>($deposit[0]==null)?0:round($deposit[0],3),'withdrawal'=>($withdrawal[0]==null)?0:round($withdrawal[0],3),'commission'=>($commission[0]==null)?0:round($commission[0],3),'adjustment'=>($adjustment[0]==null)?0:round($adjustment[0],3),'other'=>($other[0]==null)?0:round($other[0],3));
echo json_encode($a);
$mysqli->close();
}else {
	echo "Parameter Required";
}
?>
