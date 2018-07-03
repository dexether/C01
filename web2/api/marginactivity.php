<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
// var_dump($_SESSION['user']);
$mysqli = new mysqli('localhost','root','','cabinet_mahadana2');
$con_sk = new mysqli('localhost','root','','sk107_mahadana');

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

$myArray = array();
if ($result = $con_sk->query("SELECT `withdrawal`.`id`,`withdrawal`.`account_id`, `withdrawal`.`ticket`,`withdrawal`.`created_at`,`withdrawal`.`status`,`withdrawal`.`amount`,`withdrawal`.updated_at FROM `withdrawal` WHERE `account_id` IN (".implode(",",$amtlogina).") UNION SELECT	`deposit`.`id`,`deposit`.`account_id`,`deposit`.`ticket`,`deposit`.`created_at`,`deposit`.`status`,`deposit`.`amount`,`deposit`.updated_at FROM	`deposit` WHERE	`account_id` IN (".implode(",",$amtlogina).") ORDER BY `created_at` DESC LIMIT 20")) {
    while($row = $result->fetch_array(MYSQL_ASSOC)) {
    	$memberid ='';
    	$nama = '';
    		$quser = $mysqli->query("SELECT mlm2.ACCNO, client_aecode.`name` FROM mlm2 INNER JOIN client_accounts ON mlm2.ACCNO = client_accounts.accountname INNER JOIN client_aecode ON client_aecode.aecodeid = client_accounts.aecodeid WHERE mlm2.mt4login =".$row['account_id']);
					while($user = $quser->fetch_array(MYSQL_ASSOC)){
							$memberid =$user['ACCNO'];
    						$nama = $user['name'];
					}
					$jenis = $row['ticket'];
            $myArray[] = array($row['ticket'],($row['updated_at']==null)?$row['created_at']:$row['updated_at'],$memberid,$nama,($row['status']==null)?'Proses':$row['status'],($jenis[0]=='D')?'Deposit':'Withdrawal',number_format($row['amount']));
    }
    
    $object = new stdClass();
    $object->data = $myArray;
    echo json_encode($object);
}

?>
