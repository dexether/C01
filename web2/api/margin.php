<?php
if (isset($_GET['login'])) {
$mysqli = new mysqli('localhost','root','','mahadana_source');
$myArray = array();
if ($result = $mysqli->query("SELECT MT4_TRADES.TICKET,MT4_TRADES.CLOSE_TIME,MT4_TRADES.COMMENT,MT4_TRADES.PROFIT FROM MT4_TRADES WHERE (MT4_TRADES.COMMENT LIKE '%dep%' OR MT4_TRADES.`COMMENT` LIKE '%with%') AND MT4_TRADES.LOGIN = ".$_GET['login']." AND MT4_TRADES.CMD = 6")) {
    while($row = $result->fetch_array(MYSQL_ASSOC)) {
            $myArray[] = array($row['TICKET'],$row['CLOSE_TIME'],$row['COMMENT'],$row['PROFIT']);
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
