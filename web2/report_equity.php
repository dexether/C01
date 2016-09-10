<?php


include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;

if (isset($user)) {
    $user;
}
    $user = $_SESSION['user'];
    include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
    $theFetchAccount = new theOtherFetchAccounts();
    $cabang_admin = 'semua';

    $_SESSION['page'] = 'report_equity';
    // Query for Kotas
    $qkotas = "SELECT acc_kota.branch AS thekota FROM acc_kota WHERE acc_kota.branch <> '' GROUP BY acc_kota.branch ORDER BY acc_kota.branch ASC";
    $kota = $DB->execresultset($qkotas);
    foreach($kota as $rows)
    {
        $kotas[] = $rows['thekota'];
    }



// For mt4dt
$meta = "SELECT mt_database.alias,mt_database.mt4dt 
    FROM mt_database WHERE enabled ='yes'
    ORDER BY mt_database.mt4dt ASC";
$meta_query = $DB->execresultset($meta);
/*foreach($meta_query as $rmeta){
    $meta_array[] = $rmeta['TIME2'];
}*/
$template->assign("meta_array", $meta_query);

$kota_selected = array();
$template->assign("kotas", $kotas);
$template->assign("kota_selected", $kota_selected);

$array_rate = array();
$template->assign("array_rate", $array_rate);

$stat = "0";
$template->assign("stat", $stat);


$array_acc = array();
$template->assign("array_acc", $array_acc);

$rate_selected = array();
$template->assign("rate_selected", $rate_selected);
$meta = "";
$template->assign("meta_selected", $meta);

// This for show Rate
$key = null;
$query_kotanya = null;
$kotas_array = array();


if(isset($_POST['key'])){
    $key = $_POST['key'];
}
 if(isset($_POST['kotas'])) {
        $kotas_array = $_POST['kotas'];
    }
 if(isset($_POST['meta'])) {
        $meta = $_POST['meta'];
    }    
if ($key == "first") {
   
    for ($i_kota = 0; $i_kota < count($kotas_array); $i_kota++) {
    $query_kotanya = $query_kotanya.",'" . $kotas_array[$i_kota] . "'";
    }
    $query_kotanya = " and acc_kota.branch in (''" . $query_kotanya . ")";
    $query_rate = "SELECT acc_kota.rate 
        FROM acc_kota WHERE 1 = 1 
        $query_kotanya  
    GROUP BY acc_kota.rate 
        ORDER BY acc_kota.rate ASC";
        var_dump($query_rate);
    $array_rate = array();
    $query_rate_array = $DB->execresultset($query_rate);
    foreach ($query_rate_array as $row_rate) {
        $array_rate[] = $row_rate['rate'];
    }
    $kota_selected = "kota";
    $template->assign("array_rate", $array_rate); 
    $template->assign("kota_selected", $kotas_array);
    $template->assign("meta_selected", $meta);
    $stat = "second";
    $template->assign("stat", $stat);

}
if ($key == "second") {
    $thegroups_array = null;
    if(isset($_POST['rates'])) {
        $thegroups_array = $_POST['rates'];
    }
    $kot = null;
    if(isset($_POST['kot'])) {
        $kot = $_POST['kot'];
    }

    if(isset($_POST['meta'])) {
        $meta = $_POST['meta'];
    } 
    $kot_arrnya = null;
    for ($i_kot = 0; $i_kot < count($kot); $i_kot++) {
        $kot_arrnya = $kot_arrnya . ",'" . $kot[$i_kot] . "'";
    }
    $kot_arr = " acc_kota.branch in (''" . $kot_arrnya . ")";
    

    $query_groupnya = null;
    for ($i_group = 0; $i_group < count($thegroups_array); $i_group++) {
        $query_groupnya = $query_groupnya . ",'" . $thegroups_array[$i_group] . "'";
    }
    $query_group = " acc_kota.rate in (''" . $query_groupnya . ")";
    
    $q2 = "SELECT acc_kota.* 
            FROM ".$meta.".mt4_weekly,acc_kota
            WHERE 1=1 AND mt4_weekly.LOGIN = acc_kota.login AND $query_group AND $kot_arr GROUP BY mt4_weekly.LOGIN
            ORDER BY acc_kota.login ASC
            ";
    $h2 = $DB->execresultset($q2);
    foreach ($h2 as $row2) {
        $array_acc[] = $row2['login'];
    }
   $template->assign("kota_selected", $kot);
   $template->assign("array_rate", $thegroups_array); 
   $template->assign("rate_selected", $thegroups_array);
   $template->assign("meta_selected", $meta);
   $stat = "third";
   $template->assign("stat", $stat);   
    
$template->assign("array_acc", $array_acc);
// For tanggal
$tgl = "SELECT DISTINCT LEFT(TIME,10) AS TIME2 FROM ".$meta.".mt4_weekly ORDER BY TIME DESC";
$tgl_data = $DB->execresultset($tgl);
foreach($tgl_data as $row){
    $tgl_data_array[] = $row['TIME2'];
}
$template->assign("time", $tgl_data_array);
}
$template->display("report_equity.htm");
var_dump($_POST);



?>