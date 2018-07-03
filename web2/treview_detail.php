<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
$template->assign("user", $user);
$security = new \security\CSRF;
$token = $security->set(3, 3600);
$template->assign('token', $token);

if (isset($_GET['accno'])) {
    $accnoselect = $_GET['accno'];
} else {
    if (isset($_SESSION['accnoselect'])) {
        $accnoselect = $_SESSION['accnoselect'];
    }
}

//TradeLogTreView("accnoselect :" . $accnoselect);
$pecah = explode(' - ', $accnoselect);
$accnoselect = $pecah[0];
//TradeLogTreView("accnoselect :" . $accnoselect);

$query = "SELECT 
client_aecode.aecode,
client_aecode.name as name,
client_aecode.telephone_mobile as phone,
client_accounts.`accountname`,
role.id,
role.name as role,
user.created_at
FROM
client_aecode,
client_accounts,
mlm,
user,
role
WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`  
AND client_accounts.`accountname` = mlm.`ACCNO`
AND client_aecode.aecode = user.username
AND user.groupid = role.id
AND mlm.ACCNO = '" . $accnoselect . "'";
//TradeLogTreView("TreViewDetail-82:" . $query);
$dataACCNO = array();
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    //TradeLogTreView("TreView-83:".$row['ACCNO']);
    $dataACCNO = $row;
}

    $template->assign("dataACCNO", $dataACCNO);

	$query = "SELECT * FROM role";
	$rows = $DB->execresultset($query);
	$rolelist = array();
	foreach ($rows as $row) {
		$rolelist[] = $row;
	}
	//TradeLogTreView("rolelist :".json_encode($rolelist));
	$template->assign("rolelist", $rolelist);
    $_SESSION['page'] = 'treview_detail';
    $_SESSION['accnoselect'] = $accnoselect;

    $template->display("treview_detail.htm");

    function myfilter($input_var_outer, $param) {
        global $var_to_pass;
        $var_to_pass = $param;

        function mycallback($input_var_inner) {
            global $var_to_pass;
            return ($input_var_inner == $var_to_pass) ? true : false;
        }

        $return_arr = array_filter($input_var_outer, 'mycallback');
        $return_arr = array_merge(array(), $return_arr);
        return $return_arr;
    }

    function TradeLogTreView($msg) {
        $fp = fopen("trader2.log", "a");
        $logdate = date("Y-m-d H:i:s => ");
        $msg = preg_replace("/\s+/", " ", $msg);
        fwrite($fp, $logdate . $msg . "\n");
        fclose($fp);
        return;
    }

    ?>
