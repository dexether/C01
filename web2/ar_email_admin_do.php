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

$_SESSION['page'] = 'ar_email_admin_do';
/*==============================
=        Start Coding          =
==============================*/
 // echo "<pre>";
 // print_r($_POST);
 // echo "</pre>";

$emailnya = "";
if (isset($_POST['example'])) {
	$emailnya = $_POST['example'];
}
$template->assign("emailnya", $emailnya);
// var_dump($emailnya);

$emailupnya = "";
if (isset($_POST['subject'])) {
	$emailupnya = $_POST['subject'];
}
$template->assign("emailupnya", $emailupnya);
// var_dump($emailupnya);

$branchnya = "";
if (isset($_POST['small'])) {
	$branchnya = $_POST['small'];
}
$template->assign("branchnya", $branchnya);
// var_dump($branchnya);


$subjectnya='';
$subjectnya=implode($emailupnya);
$bodybya='';
$bodybya=implode($branchnya);
// var_dump($subjectnya);

$jumlah_dipilih = count($emailnya);
// var_dump($jumlah_dipilih);

$query = "SELECT 
			  * 
			FROM
			  usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
    $companys = $rows;
    $companys['year'] = $years;
}

// ke email
	$timenya = date('Y-m-d H:i', strtotime('-1 hour'));
	$subject = " $subjectnya";
	$body = "Time: " . $timenya . "<br> <br>";
	$body = $body . "Dear Client <br>";
	$body = $body . " <br>";
	$body = $body . "$bodybya<br>";
	$body = $body . " <br>";
	$body = $body . "Thank you," . "<br>";
    $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
 // $body = $body . " HotLine : +62-21-2954-3737<br>";
 // $body = $body . " Fax : +62-21-2954-3777 <br>";
    $body = $body . " Email : ".$companys['email']." <br>";
    $body = $body . " ".$companys['companyurl']." <br>";

if ($emailnya == ''){
	echo 1;
}else if ($subjectnya == ''){
	echo 2;
}else if ($bodybya == ''){
	echo 3;
}else {
	
for($x=0;$x<$jumlah_dipilih;$x++){


// forsecretaris
	$query = "insert into email set
	timeupdate = NOW(),
	email_to = '$emailnya[$x]',
	email_subject = '$subject',
	email_body = '$body',
	timesend = '1970-01-31 00:00:00'    
	";
	$DB->execonly($query);
}	
echo 0;
	}


/*=====  End of Coding  ======*/
// $template->display("car_up_com.htm");

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