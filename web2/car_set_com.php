<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
$theFetchAccount = new theOtherFetchAccounts();
$cabang_admin = 'semua';
$accounts = $theFetchAccount->fetchAccountslangsung($user,$mysql['meta'],$cabang_admin);

$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}

$key = '';
if (isset($_SESSION['key'])) {
    $key = $_SESSION['key'];
}

$tools = new CTools();
$data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
$data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
$variabel = explode("&", $data[0]); //a=1&account=802222&postmode=deposit&tradedby=ALBERTOSCARINA
$accountlink = $variabel[1]; //account=1234567
$accountvariabel = explode("=", $accountlink);
$account = $accountvariabel[1];
$lines = $lines . "&account=" . $account;
$linezip = gzcompress($lines);
$key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
$_SESSION['key'] = $key;

$accountcheck = myfilter($accounts, $account);
if ($accountcheck[0] == '') {
    display_error("107.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
} else {
    if (!empty($account) && $account != "all") {
        if (!in_array($account, $accounts)) {
            //TradeLogUnderConstruct_Secure("Profile-111");
            display_error("111.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
        }
    }
    //TradeLogUnderConstruct_Secure("Profile-115");
    $template->assign("accounts", $accounts);
    if (!empty($account)) {
        $template->assign("tradedby", $user->username);
        $template->assign("account", $account);
        $template->assign("error", "");
    }
}
$template->assign("account", $account);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'car_set_com';
/*==============================
=        Start Coding          =
==============================*/

    $query = "SELECT client_aecode.*   
				from client_aecode 
				where 
				client_aecode.aecode = '$user->username'";
    $rows = $DB->execresultset($query);
	$clientaecode="";
    foreach ($rows as $row) {
        $clientaecode = $row;
    }
    $template->assign("clientaecode", $clientaecode);

	$query = "SELECT client_accounts.`accountname`
				FROM
				  client_accounts
				WHERE client_accounts.`email` = '$user->username' ";
    $rows = $DB->execresultset($query);
	$account="";
	 foreach ($rows as $row) {
         $account = $row['accountname'];
    }
    $template->assign("account", $account);
	 // var_dump($account);
/*=====  acc mete  ======*/
$usernya = $user->groupid;
$condiional = "";
if ( $usernya==9 ){

$query = "SELECT 
		  branch_manager.`email` 
		FROM
		  branch_manager 
		WHERE branch_manager.`group_branch` <> 'JKTD'";
   
     $rows = $DB->execresultset($query);
		$view= array();
	 foreach ($rows as $row) {
         $view[] = $row['email'];
    }
    $template->assign("view", $view);
	 // var_dump($view);
$accountnya=implode("','",$view);
$template->assign("accountnya", $accountnya);

$query = "SELECT 
			  mlm.`ACCNO`,
			  mlm.`group_play` 
			FROM
			  mlm,
			  client_accounts 
			WHERE mlm.`ACCNO` = client_accounts.`accountname`
			AND mlm.`group_play`<>'Car' 
			AND client_accounts.`email` IN ('$accountnya')
			ORDER BY group_play ASC";
   
     $rows = $DB->execresultset($query);
		$view= "";
	 foreach ($rows as $row) {
         $view[] = $row;
    }
    $template->assign("view", $view);
	 // var_dump($view);
	
}else {
	
	$query = "SELECT 
			  mlm.`ACCNO`,
			  mlm.`group_play` 
			FROM
			  mlm,
			  client_accounts 
			WHERE mlm.`ACCNO` = client_accounts.`accountname`
			AND mlm.`group_play`<>'Car' 
			AND client_accounts.`email` = '$user->username'
			ORDER BY group_play ASC";
   
     $rows = $DB->execresultset($query);
		$view= "";
	 foreach ($rows as $row) {
         $view[] = $row;
    }
    $template->assign("view", $view);
	 // var_dump($view);
	
}
/*=====  End acc  ======*/	 
    

$shownya = "";
if (isset($_POST['shownya'])) {
    $shownya = $_POST['shownya'];
}
$template->assign("shownya", $shownya);
// var_dump($shownya);

		$cas ='';
		$query	  = "SELECT 
					cas_comisi.`cas_comisi`
					FROM
					  cas_comisi 
					WHERE cas_comisi.`log_meta`='$shownya' ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$cas = $row ['cas_comisi'];
		}
		$template->assign("cas", $cas);
		  // var_dump($cas);

if ( $usernya==9 ){
		$emailbm ='';
		$query	  = "SELECT 
					  client_accounts.`email` 
					FROM
					  mlm,
					  client_accounts 
					WHERE mlm.`ACCNO` = client_accounts.`accountname` 
					  AND mlm.`Upline`='COMPANY'
					  AND mlm.`group_play`='$shownya'";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$emailbm = $row ['email'];
		}
		$template->assign("emailbm", $emailbm);
		  // var_dump($emailbm);
	$bm ='';
		$bm0 ='';
		$bm1 ='';
		$bm2 ='';
		$query	  = "SELECT 
				  client_aecode.`name`,
				  mlm.`comisi`,
				  mlm.`over`,
				  mlm.`ACCNO` 
				FROM
				  mlm,
				  client_accounts,
				  client_aecode 
				WHERE mlm.`ACCNO` = client_accounts.`accountname` 
				  AND client_accounts.`email` = client_aecode.`aecode`
				  AND client_aecode.`aecode` = '$emailbm'  
				  AND mlm.`group_play`='$shownya' ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$bm = $row ['name'];
		$bm0 = $row['comisi'];
		$bm1 = $row['ACCNO'];
		$bm2 = $row['over'];
		}
		$template->assign("bm", $bm);
		$template->assign("bm0", $bm0);
		$template->assign("bm1", $bm1);
		$template->assign("bm2", $bm2);
		  // var_dump($bm);
	
} else {
	
	$bm ='';
		$bm0 ='';
		$bm1 ='';
		$bm2 ='';
		$query	  = "SELECT 
				  client_aecode.`name`,
				  mlm.`comisi`,
				  mlm.`over`,
				  mlm.`ACCNO` 
				FROM
				  mlm,
				  client_accounts,
				  client_aecode 
				WHERE mlm.`ACCNO` = client_accounts.`accountname` 
				  AND client_accounts.`email` = client_aecode.`aecode`
				  AND client_aecode.`aecode` = '$user->username'  
				  AND mlm.`group_play`='$shownya' ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$bm = $row ['name'];
		$bm0 = $row['comisi'];
		$bm1 = $row['ACCNO'];
		$bm2 = $row['over'];
		}
		$template->assign("bm", $bm);
		$template->assign("bm0", $bm0);
		$template->assign("bm1", $bm1);
		$template->assign("bm2", $bm2);
		  // var_dump($bm);
	
} 
		
		  
		$mm ='';
		$mm0 ='';
		$mm1 ='';
		$query	  = "SELECT 
				  client_aecode.`name`,
				  mlm.`comisi`,
				  mlm.`ACCNO` 
				FROM
				  mlm,
				  client_accounts,
				  client_aecode 
				WHERE mlm.`ACCNO` = client_accounts.`accountname` 
				  AND client_accounts.`email` = client_aecode.`aecode`
				  AND mlm.`Upline` = '$bm1'   
				  AND mlm.`group_play`='$shownya' ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$mm = $row ['name'];
		$mm0 = $row['comisi'];
		$mm1 = $row['ACCNO'];
		}
		$template->assign("mm", $mm);
		$template->assign("mm0", $mm0);
		$template->assign("mm1", $mm1);
		  // var_dump($mm);
		
		$spv ='';
		$spv0 ='';
		$spv1 ='';
		$query	  = "SELECT 
				  client_aecode.`name`,
				  mlm.`comisi`,
				  mlm.`ACCNO` 
				FROM
				  mlm,
				  client_accounts,
				  client_aecode 
				WHERE mlm.`ACCNO` = client_accounts.`accountname` 
				  AND client_accounts.`email` = client_aecode.`aecode`
				  AND mlm.`Upline` = '$mm1'  
				  AND mlm.`group_play`='$shownya' ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$spv = $row ['name'];
		$spv0 = $row['comisi'];
		$spv1 = $row['ACCNO'];
		}
		$template->assign("spv", $spv);
		$template->assign("spv0", $spv0);
		$template->assign("spv1", $spv1);
		  // var_dump($spv);
		  
		$ae ='';
		$ae0 ='';
		$ae1 ='';
		$query	  = "SELECT 
				  client_aecode.`name`,
				  mlm.`comisi`,
				  mlm.`ACCNO` 
				FROM
				  mlm,
				  client_accounts,
				  client_aecode 
				WHERE mlm.`ACCNO` = client_accounts.`accountname` 
				  AND client_accounts.`email` = client_aecode.`aecode`
				  AND mlm.`Upline` = '$spv1'  
				  AND mlm.`group_play`='$shownya' ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$ae = $row ['name'];
		$ae0 = $row['comisi'];
		$ae1 = $row['ACCNO'];
		}
		$template->assign("ae", $ae);
		$template->assign("ae0", $ae0);
		$template->assign("ae1", $ae1);
		  // var_dump($ae);
		  
		$aed ='';
		$aed0 ='';
		$aed1 ='';
		$query	  = "SELECT 
				  client_aecode.`name`,
				  mlm.`comisi`,
				  mlm.`ACCNO` 
				FROM
				  mlm,
				  client_accounts,
				  client_aecode 
				WHERE mlm.`ACCNO` = client_accounts.`accountname` 
				  AND client_accounts.`email` = client_aecode.`aecode`
				  AND mlm.`Upline` = '$ae1'  
				  AND mlm.`group_play`='$shownya' ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$aed = $row ['name'];
		$aed0 = $row['comisi'];
		$aed1 = $row['ACCNO'];
		}
		$template->assign("aed", $aed);
		$template->assign("aed0", $aed0);
		$template->assign("aed1", $aed1);
		  // var_dump($aed);
		  
		$aedf ='';
		$aedf0 ='';
		$aedf1 ='';
		$query	  = "SELECT 
				  client_aecode.`name`,
				  mlm.`comisi`,
				  mlm.`ACCNO` 
				FROM
				  mlm,
				  client_accounts,
				  client_aecode 
				WHERE mlm.`ACCNO` = client_accounts.`accountname` 
				  AND client_accounts.`email` = client_aecode.`aecode`
				  AND mlm.`Upline` = '$aed1'  
				  AND mlm.`group_play`='$shownya' ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$aedf = $row ['name'];
		$aedf0 = $row['comisi'];
		$aedf1 = $row['ACCNO'];
		}
		$template->assign("aedf", $aedf);
		$template->assign("aedf0", $aedf0);
		$template->assign("aedf1", $aedf1);
		  // var_dump($aed);
/*=====  End of Coding  ======*/
$template->display("car_set_com.htm");

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

?>