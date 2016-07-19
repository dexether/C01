<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
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

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

// var_dump($user);
$columns = array( 
// datatable column index  => database column name
	0 =>'timesend', 
	1 =>'email_subject',
	2 =>'email_body'
);

// getting total number records without any search
$sql = "SELECT timesend, email_subject, email_body FROM email WHERE email_to ='$user->username'";
$rows = $DB->execresultset($sql);
    foreach ($rows as $row) {
        $totalData[] = $row;
    }
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
// var_dump($totalFiltered);

$sql = "SELECT timesend, email_subject, email_body FROM email WHERE 1=1 AND email.email_to ='$user->username'";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( timesend LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR email_subject LIKE '".$requestData['search']['value']."%' ";

	$sql.=" OR email_body LIKE '".$requestData['search']['value']."%' )";
}

$rows = $DB->execresultset($sql);
foreach ($rows as $row) {
        $totalFiltered[] = $row;
    }
// var_dump($totalFiltered);
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start'].",".$requestData['length']."   ";
$query = $DB->execresultset($sql);
// var_dump($sql);
$data = array();
foreach ( $query as $row ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["timesend"];
	$nestedData[] = $row["email_subject"];
	$nestedData[] = substr($row["email_body"], 0, 20);
	
	$data[] = $nestedData;
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
