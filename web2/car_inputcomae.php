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


/*==============================
=        Start Coding          =
==============================*/
$datenya = date("Y-m-d");
echo "Hari ini adalah " . date("l") . "<br>";
echo "Tanggal hari ini " . $datenya . "<br>";
date_default_timezone_set("Asia/Jakarta");
echo "Jam sekarang " . date("h:i:s a");
// var_dump($datenya);

$commeta = array();
$query	  = "SELECT 
			  * 
			FROM
			  agrodana_source.mt4_trades 
			WHERE LEFT(CLOSE_TIME,10)= '$datenya'
			AND mt4_trades.`COMMISSION` <> '0'";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
		$commeta[]= $row;
}
 // var_dump($commeta);
 

 


foreach ($commeta as $value) {
	$adaticket = array();
	$query	  = "SELECT 
				  comisi_ae.`TICKET` 
				FROM
				  comisi_ae WHERE comisi_ae.`TICKET`='$value[TICKET]'";
	$rows = $DB->execresultset($query);
	$adaticket=count($rows);
	if($adaticket > 0){
		
	}else{
		$query = "INSERT INTO comisi_ae SET TICKET = '$value[TICKET]',
				LOGIN = '$value[LOGIN]',
				VOLUME = '$value[VOLUME]',
				OPEN_TIME = '$value[OPEN_TIME]',
				CLOSE_TIME = '$value[CLOSE_TIME]',
				COMMISSION = '$value[COMMISSION]'";
	$DB->execonly($query);
	}
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
 <script>
     function refresh() {
         window.location.reload(true);
     }

    setTimeout(refresh, 5000);
// </SCRIPT>