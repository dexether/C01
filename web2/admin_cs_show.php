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

$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}

$key = '';
if (isset($_SESSION['key'])) {
    $key = $_SESSION['key'];
}

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

/*=======================================
=            Start Of Coding            =
=======================================*/
$accnoselect = "";
if (isset($_POST['accnoselect'])) {
    $accnoselect = $_POST['accnoselect'];
}
// var_dump($accnoselect);
$branch = "";
if (isset($_POST['branch'])) {
    $branch = $_POST['branch'];
}
// var_dump($branch);
$shownya = "";
if (isset($_POST['shownya'])) {
    $shownya = $_POST['shownya'];
}
// var_dump($shownya);
	$query = "SELECT 
			  $shownya .`account`,
			  $shownya .`branch` 
			FROM
			 $shownya 
			WHERE $shownya .`account` = '$accnoselect' 
			  AND $shownya .`branch` = '$branch' ";
    
    $rows = $DB->execresultset($query);
	// var_dump($query);
	// var_dump($rows);
	// var_dump(count($rows));
	
	if(count($rows) != 0 ){
		// echo "Datanya ada";
	
	$meta_query="";
	$template->assign("meta_array", $meta_query);
	$cari="";
	$template->assign("cari", $cari);
	$statements ="";
$statements1="";
$statements2="";
$statements3="";
$statements4="";
$statements5="";
$statements6=""; 
$statements7=""; 
$statements8=""; 
$statements9=""; 
	$template->assign("statements", $statements);
$template->assign("statements1", $statements1);
$template->assign("statements2", $statements2);
$template->assign("statements3", $statements3);
$template->assign("statements4", $statements4);
$template->assign("statements5", $statements5);
$template->assign("statements6", $statements6);
$template->assign("statements7", $statements7);
$template->assign("statements8", $statements8);
$template->assign("statements9", $statements9);
    $template->display("admin_cs_show.htm");
	
		
	}else{
		echo "Anda Bukan Manager Atau Secretaris";
	}
	
$ceks = array();
$query	  = "SELECT * FROM SCHEDULE WHERE schedule.car_id='no car' ORDER BY schedule_id ASC";
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
$ceks[] = $row;
}
$template->assign("ceks", $ceks);
// var_dump($ceks);
   

		
/*=====  End of Start Of Coding  ======*/

 



?>