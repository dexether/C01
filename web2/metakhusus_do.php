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

$_SESSION['page'] = 'metakhusus_do';
/*==============================
=        Start Coding          =
==============================*/
$accno = "";
if (isset($_GET['accabi'])) {
	$accno = $_GET['accabi'];
}
$template->assign("accno", $accno);
// var_dump($accno);

$emailupnya = "";
if (isset($_GET['accmeta'])) {
	$emailupnya = $_GET['accmeta'];
}
$template->assign("emailupnya", $emailupnya);
// var_dump($emailupnya);

$groupbranch = "";
if (isset($_GET['groupbranch'])) {
	$groupbranch = $_GET['groupbranch'];
}
$template->assign("groupbranch", $groupbranch);
// var_dump($groupbranch);

$branchnya = "";
if (isset($_GET['branch'])) {
	$branchnya = $_GET['branch'];
}
$template->assign("branchnya", $branchnya);
// var_dump($branchnya);

$metanya = "";
if (isset($_GET['metanya'])) {
	$metanya = $_GET['metanya'];
}
$template->assign("metanya", $metanya);
// var_dump($metanya);

$comisinya1 = "";
if (isset($_GET['com1'])) {
	$comisinya1 = $_GET['com1'];
}
$template->assign("comisinya1", $comisinya1);
// var_dump($comisinya1);

$comisinya2 = "";
if (isset($_GET['com2'])) {
	$comisinya2 = $_GET['com2'];
}
$template->assign("comisinya2", $comisinya2);
// var_dump($comisinya2);

$batas = "";
if (isset($_GET['over'])) {
	$batas = $_GET['over'];
}
$template->assign("batas", $batas);
// var_dump($batas);

$batas2 = "";
if (isset($_GET['over2'])) {
	$batas2 = $_GET['over2'];
}
$template->assign("batas2", $batas2);
// var_dump($batas2);

if ($comisinya1 == ""){
	echo 1;
} else if ($comisinya2 == ""){
	echo 2;
}else if ($batas > $batas2){
	echo 3;
} else {

	$update_tradeby = $user->getUsername();
	if ($emailupnya == 'admin@gmail.com') {
                $bm = 'COMPANY';
            } else {
               $query = "SELECT 
						  mlm.group_play,
						  mlm.ACCNO,
						  client_accounts.* 
						FROM
						  client_aecode,
						  client_accounts,
						  mlm 
						WHERE client_aecode.aecodeid = client_accounts.`aecodeid` 
						  AND mlm.ACCNO = client_accounts.accountname 
						  AND client_aecode.email = '$emailupnya' 
						ORDER BY mlm.datetime ASC ";
					   
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
                and client_aecode.aecode = '$emailupnya'
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
                    "email = '" . $emailupnya . "', " .
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
                    mt4dt = 'agrodana_source',
                    ACCNO='$accountnamebaru',
                    Upline = '$bm',
					group_branch = '$groupbranch',
					branch = '$branchnya',
                    datetime = NOW(),
                    companyconfirm = '0',
                    payment = '0',
                    group_play = '$metanya',
                    updateby = '$user->username',     
                    mt4login = '$metanya',
					 comisi = '$comisinya1'";
            //tradeLogMMNewLevel("tradeLogMMNewLevel-800:" . $query);
            $DB->execonly($query);
			
			$query = "UPDATE 
			  mlm 
			SET
			  comisi = '$comisinya2',
			  over = '$batas2' 
			WHERE ACCNO = '$accno' ";
			
			$DB->execonly($query);
			// var_dump($query);
echo 0;
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