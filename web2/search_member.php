<?php
TradeLogSearch('search member dipanggil');
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

$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}
    $_SESSION['page'] = 'search_member';
	
	TradeLogSearch('postmode : '.$postmode);
	if($postmode == 'search'){
		$name = '';
		if (isset($_POST['name'])) {
			$name = $_POST['name'];
		}

		$email = '';
		if (isset($_POST['email'])) {
			$email = $_POST['email'];
		}

		$accno = '';
		if (isset($_POST['accno'])) {
			$accno = $_POST['accno'];
		}
		
		$filter = '';
		if(!empty($name)){
			$filter = $filter . " AND client_aecode.name LIKE '%$name%'";
		}
		
		if(!empty($email)){
			$filter = $filter . " AND client_aecode.aecode LIKE '%$email%'";
		}
		
		if(!empty($accno)){
			$filter = $filter . " AND client_accounts.accountname LIKE '%$accno%'";
		}
		TradeLogSearch('filter : '.$filter);
		$query = "SELECT accountname FROM client_accounts,client_aecode WHERE client_aecode.aecodeid = client_accounts.aecodeid AND client_aecode.aecode = '$user->username'";
		TradeLogSearch('query-53 : '.$query);
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
			$useraccno = $row[accountname];
		}
		
		if($user->groupid == '9'){
			$query = "SELECT 
			client_aecode.aecode,
			client_aecode.name as name,
			client_aecode.telephone_home as phone,
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
			". $filter;
		}else{
			$query = "SELECT 
			client_aecode.aecode,
			client_aecode.name as name,
			client_aecode.telephone_home as phone,
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
			AND mlm.Upline = '$useraccno'
			". $filter;
		}
		TradeLogSearch('query-79 : '.$query);
		$member = array();
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
			$member[] = $row;
		}
		
		echo json_encode($member);
		
	}else{
		$template->display("search_member.htm");
	}
    

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

    function TradeLogSearch($msg) {
        $fp = fopen("trader2.log", "a");
        $logdate = date("Y-m-d H:i:s => ");
        $msg = preg_replace("/\s+/", " ", $msg);
        fwrite($fp, $logdate . $msg . "\n");
        fclose($fp);
        return;
    }

    ?>