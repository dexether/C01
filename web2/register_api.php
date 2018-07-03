<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

// Scurity
//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$memberid_crypt = @$_GET['data'];
$alldata  = base64_decode($memberid_crypt);
$alldata = unserialize($alldata);
//TradeLogUnderConstruct_Secure("Profile-175-Get_Data:" . json_encode($alldata));
$username = $alldata['email'];
$nama = $alldata['name'];
$phonenumber = $alldata['phone'];
$email = $alldata['email'];
if(empty($alldata['old_id'])){
	$oldid = 0;
}else{
	$oldid = $alldata['old_id'];
}
$userpass = MD5($alldata['password']);


if (empty($alldata)) {
}else{
	$query = "INSERT INTO user
	SET username = '$username',
	password = '$userpass',
	old_id = '$oldid',
	groupid = '3',
	languageid = '1',
	viewtype='stg9_summary',
	companygroup = 'cabinet',
	lockingid = '1',
	directdone = 'yes',
	login_end = DATE_ADD(NOW(),INTERVAL +3600 DAY),
	countertype = 'Currency'";
	$DB->execonly($query);
	
	$query = "insert into client_aecode
	set groupid = '1',
	aecode = '$username',
	old_id = '$oldid',
	name = '$nama',
	telephone_mobile = '$phonenumber',
	sendmethod = 'Email',
	email = '$email',
	lastlogin = NOW(),
	nationality = 'ID',
	address = '',
	no_identitas = '',
	suspend = '0',
	status = '1',
	description = 'register from API',
	last_updated = NOW()";
	$DB->execonly($query);

	$query = "INSERT INTO client_aecode_bank
	SET aecode = '$username',
	old_id = '$oldid',
	banktype = '',
	aeaccountname = '$nama',
	aeaccountnumber = '',
	status = '0',
	last_updated = NOW()";
	$DB->execonly($query);
	
	$last = 0;
	$update_tradeby  = $username;
	$rolldate        = date('Y-m-d', time());
	$accountnamebaru = check_account($update_tradeby, $last);
	$query           = "SELECT client_branch.branch,client_group.group AS thegroup,
	client_aecode.old_id,client_aecode.aecodeid,client_aecode.name,client_aecode.nametengah,client_aecode.nameakhir,
	client_aecode.email,client_aecode.description
	FROM client_branch,client_group,client_aecode
	WHERE client_branch.branchid = client_group.branchid
	AND client_group.groupid = client_aecode.groupid
	and client_aecode.aecode = '$username'";
	$rows = $DB->execresultset($query);
	foreach ($rows as $row) {
		$usernya = $row;
	}
	$old_id = $usernya['old_id'];
	$query = "INSERT INTO client_accounts SET " .
			"aecodeid = '" . $usernya['aecodeid'] . "', " .
			"accountname = '" . $accountnamebaru . "', " .
			"name = '" . $accountnamebaru . "', " .
			"old_id = '$old_id', " .
			"address = '', " .
			"telephone_home = '', " .
			"telephone_office = '', " .
			"telephone_mobile = '', " .
			"suspend = '1', " .
			"email = '', " .
			"daycall = '0', " .
			"nightcall = '0', " .
			"`float_rate` = '0', " .
			"telephone_fax = '', " .
			"last_updated = NOW(), " .
			"status = 'normal', " .
			"rolldate='" . $rolldate . "', " .
			"sendmethod = 'Email'";
			$DB->execonly($query);
					
	$query  = "SELECT value FROM config WHERE name = 'pt'";
	$result = $DB->execresultset($query);
	foreach ($result as $row) {
		$tipe = $row['value'];
	}
					
	$query = "insert into mlm set
			mt4dt = 'nometa',
			old_id='$old_id',
			ACCNO='$accountnamebaru',
			Upline = 'COMPANY',
			datetime = NOW(),
			companyconfirm = '2',
			payment = '0',
			group_play = '$tipe',
			updateby = '$username'";
	$DB->execonly($query);

}
/*====================================
=            Start Coding            =
====================================*/

/*=====  End of Start Coding  ======*/

  function check_account($update_tradeby, $last)
{
    global $DB;
    //$waktucheck1 = date('ymdH'); //2014 Aug 21 21:03:55
    $waktucheck1 = date('ymdH', strtotime('-1 hour'));
    $query       = "select * from mlm where ACCNO  like ('$waktucheck1%') order by length(ACCNO) desc, ACCNO desc limit 0,1";
    //TradeLogUnderConstruct_Secure("MM_New_Level-378:".$query);
    $lastACCNO = 0;
    $rows      = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO = $row['ACCNO'];
    }
    $val1 = strlen($lastACCNO); //150403110000001
    $val2 = substr($lastACCNO, 8, $val1);
    //TradeLogUnderConstruct_Secure("MM_New_Level-386-Val1;".$val1.";Val2::".$val2);
    $val3 = intval($val2);
    //TradeLogUnderConstruct_Secure("MM_New_Level-239-Va32::".$val3);
    if ($last == '0') {
        $last = $val2 + 1;
    } else {
        $last = $last + 1;
    }

    //TradeLogUnderConstruct_Secure("MM_New_Level-241-Last:".$last);

    $account_name_check = $waktucheck1 . $last;
    TradeLogUnderConstruct_Secure("MM_New_Level-397:".$account_name_check);//MM_New_Level-246:A000001

    $query = "select * from mlm where ACCNO  = '$account_name_check'";
    //TradeLogUnderConstruct_Secure("MM_New_Level-399-Query:".$query);//Query
    $is_accountname_already_taken = "no";
    $rows                         = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO                    = $row['ACCNO'];
        $is_accountname_already_taken = "yes";
    }

    $query = "select * from client_accounts where accountname='$account_name_check'";
    //TradeLogUnderConstruct_Secure("mm_new_level-301-query:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO                    = $row['accountname'];
        $is_accountname_already_taken = "yes";
    }

    if ($is_accountname_already_taken == "yes") {
        $accountname = check_account($update_tradeby, $last);
    } else {
        $accountname = $account_name_check;
    }
    return $accountname;
}

function TradeLogUnderConstruct_Secure($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
