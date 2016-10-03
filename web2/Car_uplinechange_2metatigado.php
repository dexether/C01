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

$_SESSION['page'] = 'car_uplinechange_2metatigado';
/*==============================
=        Start Coding          =
==============================*/
$action = "";
if (isset($_GET['deal'])) {
	$action = $_GET['deal'];
}
$template->assign("action", $action);
// var_dump($action);

$accno = "";
if (isset($_GET['acc'])) {
	$accno = $_GET['acc'];
}
$template->assign("accno", $accno);
// var_dump($accno);

$accupnya = "";
if (isset($_GET['accold'])) {
	$accupnya = $_GET['accold'];
}
$template->assign("accupnya", $accupnya);
// var_dump($accupnya);

$changeup = "";
if (isset($_GET['accnew'])) {
	$changeup = $_GET['accnew'];
}
$template->assign("changeup", $changeup);
// var_dump($changeup);

$query = "SELECT 
		  client_aecode.`aecodeid`,
		  mlm.`branch`
		FROM
		  client_aecode,
		  client_accounts,
		  mlm 
		WHERE mlm.`ACCNO`= client_accounts.`accountname`
		AND client_accounts.`email`= client_aecode.`aecode`
		AND mlm.`group_play`= 'Car'
		AND client_aecode.`email` ='$changeup' ";
		$aecode = array();
		$aecode0 = array();
		$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    $aecode = $row['aecodeid'];
    $aecode0 = $row['branch'];
}
$template->assign("aecode", $aecode);
$template->assign("aecode0", $aecode0);
// var_dump($aecode);
// var_dump($aecode0);


if ($action=="Next") {
	
	if ($changeup=="") {
		echo 1;
		echo "Can not Meta Login has been Changed";
		echo "Input Text can not be empty";		
	}else if ($accupnya=="") {
		echo 1;
		echo "Can not Meta Login has been Changed";
		echo "Input Text can not be empty";		
	}else {
		$update_tradeby = $user->getUsername();
	if ($accupnya == 'admin@gmail.com') {
                $bm = 'COMPANY';
            } else {
               $query = "SELECT 
					  mlm.group_play,
					  mlm.ACCNO
					FROM
					  client_aecode,
					  client_accounts,
					  mlm 
					WHERE client_aecode.aecodeid = client_accounts.`aecodeid` 
					  AND mlm.ACCNO = client_accounts.accountname 
					  AND client_aecode.email = '$accupnya' 
					AND mlm.`group_play`='$accno'";
					   
						 $rows = $DB->execresultset($query);
						$bm="";
						 foreach ($rows as $row) {
							 $bm = $row['ACCNO'];
						}
						$template->assign("bm", $bm);
						// var_dump($bm);
            }
            //tradeLogMMNewLevel("mm_new_level-105:" . $upline);


            $last = 0;
            $accountnamebaru = check_account($update_tradeby, $last);
            $rolldate = date('Y-m-t');


            $query = "SELECT client_branch.branch,client_group.group AS thegroup,
                client_aecode.aecodeid,client_aecode.name,client_aecode.nametengah,client_aecode.nameakhir,
                client_aecode.email,client_aecode.description    
                FROM client_branch,client_group,client_aecode   
                WHERE client_branch.branchid = client_group.branchid 
                AND client_group.groupid = client_aecode.groupid 
                and client_aecode.aecode = '$changeup'
                ";
            //tradeLogMMNewLevel("MM_New_Level-131-Query:" . $query);
            $rows = $DB->execresultset($query);
            foreach ($rows as $row) {
                $usernya = $row;
            }
			
            $query = "INSERT INTO client_accounts SET " .
                    "aecodeid = '" . $usernya['aecodeid'] . "', " .
                    "accountname = '" . $accountnamebaru . "', " .
                    "name = '" . $accountnamebaru . "', " .
                    "address = '', " .
                    "telephone_home = '', " .
                    "telephone_office = '', " .
                    "telephone_mobile = '', " .
                    "suspend = '0', " .
                    "email = '" . $changeup . "', " .
                    "daycall = '0', " .
                    "nightcall = '0', " .
                    "`float_rate` = '0', " .
                    "telephone_fax = '', " .
                    "last_updated = NOW(), " .
                    "status = 'normal', " .
                    "rolldate='" . $rolldate . "', " .
                    "sendmethod = 'Email'";
            //tradeLogMMNewLevel("tradeLogMMNewLevel-800:" . $query);
            $DB->execonly($query);

            $query = "insert into mlm set
                    mt4dt = 'agr0_source',
                    ACCNO='$accountnamebaru',
                    Upline = '$bm',
					branch = '$aecode0',
                    datetime = NOW(),
                    companyconfirm = '0',
                    payment = '0',
                    group_play = '$accno',
                    updateby = '$user->username',     
                    mt4login = '$accno'";
            //tradeLogMMNewLevel("tradeLogMMNewLevel-800:" . $query);
            $DB->execonly($query);
echo 0 ;
echo "K_Success!! Add meta login";			
	}
	
}else if($action=="Edite"){
	if ($changeup=="") {
		echo 1;
		echo "Can not Meta Login has been Changed";
		echo "Input Text can not be empty";		
	}else {
		$query = "UPDATE 
			  client_accounts 
			SET
			  client_accounts.`aecodeid` = '$aecode',
			  client_accounts.`email` = '$changeup' 
			WHERE client_accounts.`accountname` = '$accno' ";
			
			$DB->execonly($query);
			// var_dump($query);
	echo 0;
	echo "K_Success!! Meta Login has been Changed";		
	}
	
}else if($action=="Delete"){
	
	$query = "DELETE 
				FROM
				  client_accounts 
				WHERE client_accounts.`accountname` = '$accno'";
			$DB->execonly($query);
			
	$query = "DELETE 
			  FROM
				mlm 
			  WHERE mlm.`ACCNO` = '$accno' ";
			$DB->execonly($query);
			// var_dump($query);
echo 0;	
echo "K_Success!! Delete Meta Login";		
}	


		
/*=====  End of Coding  ======*/
function check_account($update_tradeby, $last) {
    global $DB;
    //$waktucheck1 = date('ymdH'); //2014 Aug 21 21:03:55
    $waktucheck1 = date('ymdH', strtotime('-1 hour'));
    $query = "select * from mlm where ACCNO  like ('$waktucheck1%') order by ACCNO desc limit 0,1";
    //tradeLogMMNewLevel("MM_New_Level-378:".$query);
    $lastACCNO = 0;
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO = $row['ACCNO'];
    }
    $val1 = strlen($lastACCNO); //150403110000001
    $val2 = substr($lastACCNO, 8, $val1);
    //tradeLogMMNewLevel("MM_New_Level-386-Val1;".$val1.";Val2::".$val2);
    $val3 = intval($val2);
    //tradeLogMMNewLevel("MM_New_Level-239-Va32::".$val3);
    if ($last == '0') {
        $last = $val2 + 1;
    } else {
        $last = $last + 1;
    }

    //tradeLogMMNewLevel("MM_New_Level-241-Last:".$last);

    $account_name_check = $waktucheck1 . $last;
    //tradeLogMMNewLevel("MM_New_Level-397:".$account_name_check);//MM_New_Level-246:A000001
	// var_dump($account_name_check);
    $query = "select * from mlm where ACCNO  = '$account_name_check'";
    //tradeLogMMNewLevel("MM_New_Level-399-Query:".$query);//Query
    $is_accountname_already_taken = "no";
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO = $row['ACCNO'];
        $is_accountname_already_taken = "yes";
    }

    $query = "select * from client_accounts where accountname='$account_name_check'";
    //tradeLogMMNewLevel("mm_new_level-301-query:" . $query);
	// var_dump($query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO = $row['name'];
        $is_accountname_already_taken = "yes";
    }

    if ($is_accountname_already_taken == "yes") {
        $accountname = check_account($update_tradeby, $last);
    } else {
        $accountname = $account_name_check;
    }
    return $accountname;
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

?>