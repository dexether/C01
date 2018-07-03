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
//Dashboard1("Dashboard1-22:".$accounts[0]);

$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}

//Dashboard1("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'home_06';

$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
foreach($result as $rows){
    $companys = $rows;
}
$template->assign("companys", $companys);
// Status
$query = "SELECT status FROM client_aecode WHERE aecode = '$user->username'";
$result = $DB->execresultset($query);
$status = '1';
foreach ($result as $key => $value) {
    $status = $value['status'];
}
$template->assign('status', $status);


// Withdrawal
$query = "SELECT
SUM(mlm_ewallet.`balance`) AS total
FROM
client_accounts,
client_aecode,
mlm_ewallet
WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
AND mlm_ewallet.`account` = client_accounts.`accountname`
AND client_aecode.`aecode` = '$user->username'";
$result = $DB->execresultset($query);
foreach($result as $rows){
    if ($rows['total'] == NULL) {
        $rows['total'] = 0;
        $wallettotal = $rows;
    }else{
        $wallettotal = $rows;
    }

}
$template->assign("ewallet", $wallettotal);

// Gold Saving
$query = "SELECT
SUM(mlm_goldsaving.`balance`) AS total
FROM
client_accounts,
client_aecode,
mlm_goldsaving
WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
AND mlm_goldsaving.`account` = client_accounts.`accountname`
AND client_aecode.`aecode` = '$user->username'";
$result = $DB->execresultset($query);
foreach($result as $rows){
    if ($rows['total'] == NULL) {
        $rows['total'] = 0;
        $goldsaving = $rows;
    }else{
        $goldsaving = $rows;
    }

}
$template->assign("goldsaving", $goldsaving);

$query = "SELECT
SUM(mlm_bonus_logs.`amount`) AS bonus
FROM
client_accounts,
client_aecode,
mlm_bonus_logs
WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
AND mlm_bonus_logs.`account` = client_accounts.`accountname`
AND client_aecode.aecode = '$user->username'
";
$result = $DB->execresultset($query);
foreach($result as $rows){
    if ($rows['bonus'] == NULL) {
        $rows['bonus'] = 0;
        $bonus = $rows;
    }else{
        $bonus = $rows;
    }
}
$template->assign("bonus", $bonus);

// Account
$query = "SELECT
COUNT(client_accounts.`accountid`) AS account
FROM
client_accounts,
client_aecode
WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
AND client_aecode.`aecode` = '$user->username'";
$result = $DB->execresultset($query);
foreach($result as $rows){
    if ($rows['account'] == NULL) {
        $rows['account'] = 0;
        $jmlaccount = $rows;
    }else{
        $jmlaccount = $rows;
    }


}
$template->assign("account", $jmlaccount);

// Downline
/*$query = "SELECT
COUNT(mlm.`ACCNO`) AS downline
FROM
mlm
WHERE mlm.`Upline` IN
(SELECT
    client_accounts.`accountname`
    FROM
    client_accounts,
    client_aecode
    WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
    AND client_aecode.`aecode` = '$user->username')
    AND mlm.`ACCNO` <> 'COMPANY'
    AND mlm.`ACCNO` NOT LIKE '9999%'";
    $result = $DB->execresultset($query);
    foreach($result as $rows){
        if ($rows['downline'] == NULL) {
            $rows['downline'] = 0;
            $downline = $rows;
        }else{
            $downline = $rows;
        }
    }

    $template->assign("downline", $downline);*/

	//TODO List
    $query = "SELECT todo_list.`finished`, todo.`type`,todo.`link`,todo.`description`
	FROM
	todo JOIN todo_list ON todo.`id` = todo_list.`id_todo` JOIN client_aecode ON client_aecode.`aecodeid` = todo_list.`aecodeid`
	WHERE client_aecode.`aecode` = '$user->username'";
    $result = $DB->execresultset($query);
    $template->assign('todo', $result);


    // // Feed
    // $rss = new DOMDocument();
    // $rss->load('http://rss.detik.com/index.php/finance');
    // $feed = array();
    // foreach ($rss->getElementsByTagName('item') as $node) {
    //     $item = array (
    //         'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
    //         'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
    //         'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
    //         'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
    //         );
    //     array_push($feed, $item);
    // }
    // var_dump($feed);

    
    $template->display("home_06/home_06.htm");

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

    function Dashboard1($msg) {
        $fp = fopen("trader.log", "a");
        $logdate = date("Y-m-d H:i:s => ");
        $msg = preg_replace("/\s+/", " ", $msg);
        fwrite($fp, $logdate . $msg . "\n");
        fclose($fp);
        return;
    }

    ?>
