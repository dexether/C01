<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
$template->assign("user", $user);

if (isset($_GET['accno'])) {
    $accnoselect = $_GET['accno'];
} else {
    if (isset($_SESSION['accnoselect'])) {
        $accnoselect = $_SESSION['accnoselect'];
    }
}
$pecah = explode(' - ', $accnoselect);
$accnoselect = $pecah[0];
//TradeLogTreView("TreViewDetail-71:" . $accnoselect);

// TradeLogTreView("Profile-56-account:" . $account);



//TradeLogTreView("Profile-66-Get_PostMode:" . $_GET[postmode]);



$query = "SELECT 
client_aecode.email,
client_aecode.name,
client_accounts.`accountname`,
mlm_bonus_settings.`description`,
mlm.* 
FROM
client_aecode,
client_accounts,
mlm,
mlm_bonus_settings 
WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid` 
AND mlm.`group_play` = mlm_bonus_settings.`group_play` 
AND client_accounts.`accountname` = mlm.`ACCNO` 
AND mlm.ACCNO = '" . $accnoselect . "'";
//TradeLogTreView("TreViewDetail-82:" . $query);
$dataACCNO = array();
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
    //TradeLogTreView("TreView-83:".$row['ACCNO']);
    $dataACCNO = $row;
}
if ($dataACCNO['mt4dt'] != '') {
    $dataACCNO['mt4dtalias']  = 'Un_set MT4 Database';
    $query = "SELECT alias,mt4dt,enabled 
    FROM mt_database 
    where mt4dt = '" . $dataACCNO['mt4dt'] . "'
    ORDER BY mt4dt ASC;";
    //TradeLogTreView("TreViewDetail-98:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $dataACCNO['mt4dtalias'] = $row['alias'];
    }
}//if ($dataACCNO['mt4dt'] != '') {
    $dateall = array();
    if ($dataACCNO['mt4dt']=="nometa") {

    }else{
        $query = "SELECT * FROM mlm, mt_database WHERE mlm.ACCNO  = '".$accnoselect."' AND mlm.mt4dt = mt_database.mt4dt";
        $result = $DB->execresultset($query);
        if (count($result) > 0) {
            $query = "SELECT LEFT(TIME,10) AS rolldate FROM " . $dataACCNO['mt4dt'] . ".mt4_daily GROUP BY LEFT(TIME,10) ORDER BY TIME DESC";
            $result = $DB->execresultset($query);
            $dateall = array();
            foreach($result as $rows) {
            $dateall[] = $rows['rolldate']; 
            }
        }else{
            
        }

    }

    $query = "SELECT 
mlm_bonus_logs.`account`,
mlm_bonus_logs.`amount`,
mlm_bonus_logs.`comment`,
mlm_bonus_logs.`date_receipt`,
mlm_cron.`full`
FROM
  mlm_bonus_logs,
  mlm_cron 
WHERE mlm_bonus_logs.`bonus_type` = mlm_cron.`module` AND mlm_bonus_logs.`account` = '$accnoselect'";
    $result = $DB->execresultset($query);
    $template->assign("bonuslogs", $result);
    $template->assign("dateall", $dateall);

    $template->assign("dataACCNO", $dataACCNO);

    $_SESSION['page'] = 'treview_detail';
    $_SESSION['accnoselect'] = $accnoselect;


    $query = "SELECT module, full FROM mlm_cron WHERE module <> 'pv'";
    $result = $DB->execresultset($query);
    
    $template->assign('allbonus', $result);
    $template->display("treview_detail.htm");

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

    function TradeLogTreView($msg) {
        $fp = fopen("trader2.log", "a");
        $logdate = date("Y-m-d H:i:s => ");
        $msg = preg_replace("/\s+/", " ", $msg);
        fwrite($fp, $logdate . $msg . "\n");
        fclose($fp);
        return;
    }

    ?>