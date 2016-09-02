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

$_SESSION['page'] = 'car_uplinechange_2do';
/*==============================
=        Start Coding          =
==============================*/
$accno = "";
if (isset($_GET['accabi'])) {
	$accno = $_GET['accabi'];
}
$template->assign("accno", $accno);
// var_dump($accno);

$accupnya = "";
if (isset($_GET['accmeta'])) {
	$accupnya = $_GET['accmeta'];
}
$template->assign("accupnya", $accupnya);
// var_dump($accupnya);

$changeup = "";
if (isset($_GET['metanya'])) {
	$changeup = $_GET['metanya'];
}
$template->assign("changeup", $changeup);
// var_dump($changeup);

		$tampil = "" ;
		$tampil1 = "" ;
		$tampil2 = "" ;
		$query	  = "SELECT 
					  mlm.`ACCNO`,
					  client_accounts.`email`,
					  client_aecode.`name` 
					FROM
					  mlm,
					  client_aecode,
					  client_accounts 
					WHERE mlm.`ACCNO` = '$accno' 
					  AND mlm.`ACCNO` = client_accounts.`accountname` 
					  AND client_accounts.`email` = client_aecode.`aecode` ";
		$rows = $DB->execresultset($query);
		foreach ($rows as $row) {
		$tampil = $row['ACCNO'];	
		$tampil1 = $row['email'];	
		$tampil2 = $row['name'];	
		}
$template->assign("tampil", $tampil);
$template->assign("tampil1", $tampil1);
$template->assign("tampil2", $tampil2);

$query = "SELECT 
			  * 
			FROM
			  usercompany 
			WHERE usercompany.`Id` = '3' ";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
    $companys = $rows;
    $companys['year'] = $years;
}

if ($accno == ""){
	echo 1;
} else if ($accupnya == ""){
	echo 2;
}else if ($changeup == ""){
	echo 3;
} else {
	
	$query = "UPDATE mlm SET Upline = '$changeup' WHERE ACCNO = '$accno'";
    $DB->execonly($query);
	
	
            $timenya = date('Y-m-d H:i', strtotime('-1 hour'));
            $subject = "Administrator change your Upline";
            $body = "Time: " . $timenya . "<br> <br>";
            $body = $body . "Dear  $tampil2,<br>";
            $body = $body . " <br>";
            $body = $body . "Your Upline has been change on Cabinet ID " . $changeup . " by Administrator<br>";
            $body = $body . " <br>";
            $body = $body . "Thank you," . "<br>";
            $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
            // $body = $body . " HotLine : +62-21-2954-3737<br>";
            // $body = $body . " Fax : +62-21-2954-3777 <br>";
            $body = $body . " Email : ".$companys['email']." <br>";
            $body = $body . " ".$companys['companyurl']." <br>";

            $query = "insert into email set
                    timeupdate = '$timenya',
                    email_to = '$tampil1',
                    email_subject = '$subject',
                    email_body = '$body',
                    timesend = '1970-01-31 00:00:00'    
                    ";
					$DB->execonly($query);
			
echo 0;
	}
		
/*=====  End of Coding  ======*/


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