<?php
if (isset($_GET['login'])) {
$mysqli = new mysqli('localhost','root','','mahadana_source');
$myArray = array();
if ($result = $mysqli->query("select MT4_TRADES.TICKET,MT4_TRADES.OPEN_TIME,MT4_TRADES.CMD,MT4_TRADES.SYMBOL,MT4_TRADES.VOLUME,MT4_TRADES.OPEN_PRICE,MT4_TRADES.SL,MT4_TRADES.TP,MT4_TRADES.CLOSE_PRICE,MT4_TRADES.COMMISSION,MT4_TRADES.SWAPS,MT4_TRADES.PROFIT from MT4_TRADES where LOGIN = ".$_GET['login']." and CMD in (0, 1) and date(CLOSE_TIME) = '1970-01-01 00:00:00' ORDER BY MT4_TRADES.OPEN_TIME DESC")) {
    while($row = $result->fetch_array(MYSQL_ASSOC)) {
            $myArray[] = array($row['TICKET'],$row['OPEN_TIME'],($row['CMD']==0)?'Buy':'Sell',$row['SYMBOL'],$row['VOLUME'],$row['OPEN_PRICE'],$row['SL'],$row['TP'],$row['CLOSE_PRICE'],$row['COMMISSION'],$row['SWAPS'],$row['PROFIT']);
    }
    // var_dump($myArray);
    $object = new stdClass();
    $object->data = $myArray;
    echo json_encode($object);
}
$result->close();
$mysqli->close();
}else {
	echo "Parameter Required";
}
?>
