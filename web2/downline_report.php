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
$query  = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years  = date('Y', time());
foreach ($result as $rows) {
    $companys         = $rows;
    $companys['year'] = $years;
}
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);


//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$_SESSION['page'] = 'downline_report';

/*====================================
=            Start Coding            =
====================================*/

if ($postmode == 'generate') {
    $start = '';
    if (isset($_POST['start'])) {
        $start = $_POST['start'];
    }
    $end = '';
    if (isset($_POST['end'])) {
        $end = $_POST['end'];
    }
    
    $start = strtotime($start);
    $start = date('Y-m-d', $start);
    $end   = strtotime($end);
    $end   = date('Y-m-d', $end);
    TradeLogUnderConstruct_Secure('groupid : ' . $user->groupid);
    
    if ($user->groupid == 9) {
        $accno = 'COMPANY';
    } else {
        $query = "SELECT
        client_accounts.`accountname`
        FROM
        client_accounts,
        client_aecode,
        mlm
        WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
        AND client_accounts.`accountname` = mlm.`ACCNO`
        AND client_aecode.`aecode` = '$user->username'";
        TradeLogUnderConstruct_Secure('query-55 : ' . $query);
        $result = $DB->execresultset($query);
        $accno  = '';
        foreach ($result as $row) {
            $accno = $row['accountname'];
        }
    }
    
    $query = "SELECT
    mlm2.mt4login,
    mlm.ACCNO,
    mlm2.mt4dt,
    client_aecode.name
    FROM
    mlm, mlm2, client_accounts, client_aecode
    WHERE mlm.ACCNO = mlm2.ACCNO 
    AND mlm.ACCNO = client_accounts.accountname
    AND client_accounts.aecodeid = client_aecode.aecodeid
    AND mlm.Upline = '$accno'";
    TradeLogUnderConstruct_Secure('query-72 : ' . $query);
    $result    = $DB->execresultset($query);
    $downlines = array();
    foreach ($result as $key => $row) {
        $downlines[$key] = $row;
    }
    $newdatas = array();
    foreach ($downlines as $key => $value) {
        # code...
        $query = "SELECT
                (SUM(VOLUME) / 100) as lot
                FROM
                $value[mt4dt].`MT4_TRADES`
                WHERE MT4_TRADES.`LOGIN` = '$value[mt4login]'
                AND CMD IN ('1', '0')
                and CLOSE_TIME BETWEEN '" . $start . " 22:30:01'
                and '" . $end . " 22:30:00'";
        TradeLogUnderConstruct_Secure('query-92 : ' . $query);
        $result = $DB->execresultset($query);
        foreach ($result as $row) {
            if (empty($row['lot'])) {
                $downlines[$key]['lot'] = 0;
            } else {
                $downlines[$key]['lot'] = number_format($row['lot'], 1);
            }
        }
    }
    echo json_encode($downlines);
} else {
    $template->display("downline_report.htm");
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


?>