<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
// var_dump($_SESSION['user']);
$mysqli = new mysqli('localhost','root','','cabinet_mahadana2');
$con_sk = new mysqli('localhost','root','','mahadana_source');

$qmtlogina = $mysqli->query("SELECT mlm2.mt4login,client_accounts.accountname FROM `user` INNER JOIN client_aecode ON `user`.username = client_aecode.aecode INNER JOIN client_accounts ON client_aecode.aecodeid = client_accounts.aecodeid INNER JOIN mlm2 ON client_accounts.accountname = mlm2.ACCNO WHERE `user`.userid =".$_SESSION['user']->userid);
$amtlogina = array();
while($mtlogina = $qmtlogina->fetch_array(MYSQL_ASSOC)){
		$amtlogina[] = $mtlogina['mt4login'];
		$accountname = $mtlogina['accountname'];
}

$qmtloginb = $mysqli->query("SELECT `mlm2`.`mt4login` FROM `client_aecode` INNER JOIN `client_accounts` ON `client_accounts`.`aecodeid` = `client_aecode`.`aecodeid` INNER JOIN `mlm` ON `mlm`.`ACCNO` = `client_accounts`.`accountname` INNER JOIN `mlm2` ON `mlm2`.`ACCNO` = `mlm`.`ACCNO` WHERE `mlm`.`Upline` =".$accountname);
while($mtloginb = $qmtloginb->fetch_array(MYSQL_ASSOC)){
		array_push($amtlogina,$mtloginb['mt4login']);
}
if (isset($_GET['start']) && isset($_GET['end'])) {
	$queryTransactionreport="SELECT `MT4_USERS`.`NAME`,`MT4_USERS`.`EMAIL`,`MT4_TRADES`.`LOGIN`,sum( MT4_TRADES.VOLUME ) AS total FROM	`MT4_TRADES` LEFT JOIN `MT4_USERS`ON `MT4_USERS`.`LOGIN` = `MT4_TRADES`.`LOGIN` WHERE `MT4_TRADES`.`LOGIN` IN (".implode(",",$amtlogina).") AND `MT4_TRADES`.`CMD` IN ( 0, 1 ) AND MT4_TRADES.CLOSE_TIME BETWEEN '".$_GET['start']."' AND '".$_GET['end']."' GROUP BY MT4_TRADES.LOGIN";
}else{
	$queryTransactionreport="SELECT `MT4_USERS`.`NAME`,`MT4_USERS`.`EMAIL`,`MT4_TRADES`.`LOGIN`,sum( MT4_TRADES.VOLUME ) AS total FROM	`MT4_TRADES` LEFT JOIN `MT4_USERS`ON `MT4_USERS`.`LOGIN` = `MT4_TRADES`.`LOGIN` WHERE `MT4_TRADES`.`LOGIN` IN (".implode(",",$amtlogina).") AND `MT4_TRADES`.`CMD` IN ( 0, 1 ) AND date( `MT4_TRADES`.`CLOSE_TIME` ) > '1970-01-01 00:00:00' GROUP BY MT4_TRADES.LOGIN";
}
// var_dump($con_sk->query($queryTransactionreport));
$myArray = array();
if ($result = $con_sk->query($queryTransactionreport)) {
    while($row = $result->fetch_array(MYSQL_ASSOC)) {
    	$memberid ='';
    	$nama = '';
    		$quser = $mysqli->query("SELECT mlm2.ACCNO, client_aecode.`name` FROM mlm2 INNER JOIN client_accounts ON mlm2.ACCNO = client_accounts.accountname INNER JOIN client_aecode ON client_aecode.aecodeid = client_accounts.aecodeid WHERE mlm2.mt4login =".$row['LOGIN']);
					while($user = $quser->fetch_array(MYSQL_ASSOC)){
							$memberid =$user['ACCNO'];
    						$nama = $user['name'];
					}
            $myArray[] = array($memberid,$nama,$row['LOGIN'],number_format($row['total']));
    }
    
    $object = new stdClass();
    $object->data = $myArray;
    echo json_encode($object);
}else{
	echo '{"data":[["-","-","-","-"]]}';
}

?>
