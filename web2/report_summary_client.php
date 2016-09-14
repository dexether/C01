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


//tradeLogReport_Summary_Client("Report_Summary_Clinet.php-Line-9");
$_SESSION['page'] = 'report_summary_client';

$mt4dtselect = "";
if (isset($_GET['mt4dt'])) {
    //tradeLogReport_Summary_Client("Report_Summary_Clinet.php-Line-24");
    $mt4dtselect = $_GET['mt4dt'];
}
$template->assign("mt4dtselect", $mt4dtselect);
if ($mt4dtselect != '') {
    $accounts = $theFetchAccount->fetchAccountslangsung($user, $mt4dtselect, $cabang_admin);
}//if($mt4dtselect!=''){


$accountstatusselect = 'active';
if (isset($_GET['accountstatus'])) {

    $accountstatusselect = $_GET['accountstatus'];
}
$template->assign("accountstatusselect", $accountstatusselect);
//tradeLogReport_Summary_Client("Report_Summary_Clinet.php-Line-33:" . $accountstatusselect);


$statements2 = array();
//tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-41:" . $mt4dtselect);
if ($mt4dtselect != '') {
    $adadata = "ya";
    //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-51");

    $query = "SELECT mt4_daily.TIME FROM " . $mt4dtselect . ".mt4_daily ORDER BY mt4_daily.TIME DESC LIMIT 0,1 ";
    //tradeLogAcc_Kota("AccKota.php-Line-39:" . $query);
    $rows = $DB->execresultset($query);
    $timeakhir = '';
    foreach ($rows as $row) {
        $timeakhir = $row['TIME'];
    }

    $query = "SELECT mt4_users.* FROM " . $mt4dtselect . ".mt4_users ORDER BY login ASC limit 0,1 ";
    if ($accountstatusselect == 'activeaccountposition') {
        $query = "SELECT mt4_users.* FROM " . $mt4dtselect . ".mt4_users  where mt4_users.MARGIN > 0 ORDER BY login ASC  ";
    }//activeaccountposition
    if ($accountstatusselect == 'activeaccountnoposition') {
        $query = "SELECT mt4_users.* FROM " . $mt4dtselect . ".mt4_users 
            where mt4_users.MARGIN = '0' and mt4_users.MARGIN_FREE > 0 ORDER BY login ASC; ";
    }//activeaccountposition
    if ($accountstatusselect == 'closeaccount') {
        $query = "SELECT mt4_users.* FROM " . $mt4dtselect . ".mt4_users 
            where mt4_users.MARGIN = '0' and mt4_users.MARGIN_FREE = 0 ORDER BY login ASC; ";
    }//activeaccountposition
    //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-73:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $row['MARGINREG'] = $row['MARGIN'];
        $statements2[$row['LOGIN']] = $row;
    }
    $total;
    global $total;

    $total['PREVBALANCE'] = 0;
    $total['MARGININ'] = 0;
    $total['MARGINOUT'] = 0;
    $total['CREDITIN'] = 0;
    $total['CREDITOUT'] = 0;
    $total['PL'] = 0;
    $total['floatingsemua'] = 0;
    $total['EQUITY'] = 0;
    $total['MARGINREG'] = 0;
    $total['MARGIN_FREE'] = 0;
    $total['MARGINMONTHLY'] = 0;
    $total['OPENLOT'] = 0;
    $total['SETTLEDLOT'] = 0;
    $total['TURNOVERLOT'] = 0;
    $subtotal;
    global $subtotal;

    $turnover;
    global $turnover;

    $margin;
    global $margin;

    $opennya;
    global $opennya;

    foreach ($statements2 AS $mt_login => $trade) {
        $statements2[$mt_login] = fetchStatement($mt_login, $trade, $mt4dtselect, $timeakhir);
        $total['PREVBALANCE'] = $total['PREVBALANCE'] + $statements2[$mt_login]['status']['PREVBALANCE'];
        $total['MARGININ'] = $total['MARGININ'] + $statements2[$mt_login]['status']['MARGININ'];
        $total['MARGINOUT'] = $total['MARGINOUT'] + $statements2[$mt_login]['status']['MARGINOUT'];
        $total['CREDITIN'] = $total['CREDITIN'] + $statements2[$mt_login]['status']['CREDITIN'];
        $total['CREDITOUT'] = $total['CREDITOUT'] + $statements2[$mt_login]['status']['CREDITOUT'];
        $total['PL'] = $total['PL'] + $statements2[$mt_login]['status']['PL'];
        $total['floatingsemua'] = $total['floatingsemua'] + $statements2[$mt_login]['status']['floatingsemua'];
        $total['EQUITY'] = $total['EQUITY'] + $statements2[$mt_login]['status']['EQUITY'];
        $total['MARGINREG'] = $total['MARGINREG'] + $statements2[$mt_login]['status']['MARGIN'];
        //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-113-Margin:" . $statements2[$mt_login]['status']['MARGIN']);
        $total['MARGIN_FREE'] = $total['MARGIN_FREE'] + $statements2[$mt_login]['status']['MARGIN_FREE'];
        $total['MARGINMONTHLY'] = $total['MARGINMONTHLY'] + $statements2[$mt_login]['monthly']['status']['MARGIN'];
    }//foreach ($statements AS $mt_login => $trade) {
    $template->assign("statements", $statements2);
    $total['BUYOPEN'] = 0;
    $total['SELLOPEN'] = 0;
    $total['DAILYSETTLED'] = 0;
    $total['MONTHLYSETTLED'] = 0;
    if (!isset($themonth)) {
        $themonth = 0;
    }
    $total['themonth'] = $themonth;
//$statements3[] = array();
    foreach ($statements2 AS $mt_login => $tradess) {
        //tradeLogReport_Summary_Client("Report_Summary-53-Login:" . $mt_login);
        $checkTrade = '';
        if (isset($tradess['trade'])) {
            $checkTrade = $tradess['trade'];
        }
        if (!empty($checkTrade)) {
            for ($icount = 0; $icount < count($checkTrade); $icount++) {
                $trade = $checkTrade[$icount];
                //tradeLogReport_Summary_Client("Report_Summary-58-TICKET:" . $trade['TICKET']);
                $trade3['TICKET'] = '0';
                if (isset($trade['TICKET'])) {
                    $trade3['TICKET'] = $trade['TICKET'];
                }
                $trade3['MARGIN'] = '0';
                if (isset($tradess['status']['MARGIN'])) {
                    $trade3['MARGIN'] = $tradess['status']['MARGIN'];
                }
                $trade3['MARGINMONTHLY'] = '0';
                if (isset($tradess['monthly']['status']['MARGIN'])) {
                    $trade3['MARGINMONTHLY'] = $tradess['monthly']['status']['MARGIN'];
                }
                $trade3['SYMBOL'] = '';
                if (isset($trade['SYMBOL'])) {
                    $trade3['SYMBOL'] = $trade['SYMBOL'];
                }
                $trade3['BUYOPEN'] = '';
                $trade3['SELLOPEN'] = '';
                if ($trade['jenis'] == 'open' && $trade['CMD'] == '0') {
                    $trade3['BUYOPEN'] = $trade['VOLUME'] / 100;
                    $total['BUYOPEN'] = $total['BUYOPEN'] + $trade['VOLUME'] / 100;
                } else if ($trade['jenis'] == 'open' && $trade['CMD'] == '1') {
                    $trade3['SELLOPEN'] = $trade['VOLUME'] / 100;
                    //tradeLogReport_Summary_Client("Report_Summary-88-TICKET:" . $trade['TICKET']);
                    $total['SELLOPEN'] = $total['SELLOPEN'] + $trade['VOLUME'] / 100;
                }
                $trade3['DailySettled'] = '';
                if ($trade['jenis'] == 'settled') {
                    $trade3['DailySettled'] = $trade['VOLUME'] / 100;
                    $total['DAILYSETTLED'] = $total['DAILYSETTLED'] + $trade['VOLUME'] / 100;
                }
                $trade3['MonthlySettled'] = '';
                if (isset($tradess['monthly']['trade']['VOLUMESETTLED'])) {
                    $trade3['MonthlySettled'] = $tradess['monthly']['trade']['VOLUMESETTLED'] / 100;
                    $total['MONTHLYSETTLED'] = $total['MONTHLYSETTLED'] + $tradess['monthly']['trade']['VOLUMESETTLED'] / 100;
                }
                $statements3[$mt_login][] = $trade3;
            }//for ($icount = 0; $icount < count($trades); $icount++) {
        }//if(!empty($trades['trade'])){
        else {
            //tradeLogReport_Summary_Client("Report_Summary-65-Login:" . $mt_login);
            $trade3['TICKET'] = '0';
            $trade3['MARGIN'] = '0';
            if (isset($tradess['status']['MARGIN'])) {
                $trade3['MARGIN'] = $tradess['status']['MARGIN'];
            }
            $trade3['MARGINMONTHLY'] = '0';
            if (isset($tradess['monthly']['status']['MARGIN'])) {
                $trade3['MARGINMONTHLY'] = $tradess['monthly']['status']['MARGIN'];
            }
            $trade3['SYMBOL'] = '';
            $trade3['BUYOPEN'] = '';
            $trade3['SELLOPEN'] = '';
            $trade3['DailySettled'] = '';
            $trade3['MonthlySettled'] = '';
            $statements3[$mt_login][] = $trade3;
        }
    }//foreach ($statements2 AS $mt_login => $trades) {


    $template->assign("statements3", $statements3);
    $template->assign("turnover", $turnover);
    $template->assign("total", $total);
    $template->assign("margins", $margin);
    $template->assign("opennya", $opennya);
    $template->assign("subtotal", $subtotal);
} else {
    //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-202");
    $adadata = "tidak";
}//if($mt4dtselect!=''){
$template->assign("adadata", $adadata);
//tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-206");

$query = "SELECT mt_database.alias,acc_kota.mt4dt 
    FROM acc_kota,mt_database 
    WHERE acc_kota.mt4dt = mt_database.mt4dt 
    GROUP BY acc_kota.mt4dt ORDER BY acc_kota.mt4dt ASC";
//tradeLogReport_Summary_Client("AccKota-212:" . $query);
$rows = $DB->execresultset($query);
//tradeLogReport_Summary_Client("AccKota-213");
$statements_filter = array();
foreach ($rows as $row) {
    //tradeLogReport_Summary_Client("AccKota-96:" . $row['alias'] . ";" . $row['mt4dt']);
    $statements_filter[] = $row;
}
$template->assign("statements_filter", $statements_filter);
//tradeLogReport_Summary_Client("AccKota-220");


$template->display("report_summary_client.htm");

function tradeLogReport_Summary_Client($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

function fetchStatement($account, $status, $mysql_meta, $timeakhir) {
    global $DB;
    global $turnover;
    global $total;
    global $opennya;
    $statement = array();
    $status['user_decimal'] = '2';
    $status['MARGIN'] = 0;
    $status['MARGININ'] = 0;
    $status['MARGINOUT'] = 0;
    $status['CREDITIN'] = 0;
    $status['CREDITOUT'] = 0;
    $status['PL'] = 0;
    $positions = array();

    $query = "SELECT mt4_trades.* 
        FROM " . $mysql_meta . ".mt4_trades 
        WHERE login ='$account' 
        AND CMD IN ('0','1') and CLOSE_TIME ='1970-01-01 00:00:00' 
        order by  mt4_trades.TICKET desc      
            ";
    //tradeLogReport_Summary_Client("Temp_Statement-265-ACCNO:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $row['ACCNO'] = $row['LOGIN'];
        $positions[] = $row;
    }


    $query = "SELECT mt4_trades.* 
        FROM " . $mysql_meta . ".mt4_trades 
        WHERE login ='$account' 
        AND CMD IN ('0','1') and CLOSE_TIME > '$timeakhir' 
        order by  mt4_trades.TICKET desc      
            ";
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $row['ACCNO'] = $row['LOGIN'];
        //tradeLogReport_Summary_Client("Temp_Statement-185-ACCNO:" . $row['ACCNO']);
        $positions[] = $row;
    }


    if (count($positions) > 0) {
        foreach ($positions AS $row) {
            while (list($key, $val) = each($row)) {
                $row[$key] = trim($val);
            }
            $counter_decimal = $row['DIGITS'] + 1;
            $row['Commission'] = number_format($row['COMMISSION'], 2, ".", "");
            $row['FLCOMM'] = number_format($row['COMMISSION'], 2, ".", "");
            $row['PL'] = number_format($row['PROFIT'], 2, ".", "");
            //tradeLogReport_Summary_Client("B_Open_position_report2-345=" . $row['TICKET']);
            $row['Unit'] = $row['VOLUME'] / 100;
            if ($row['CMD'] == '0') {
                $row['BuyPrice'] = number_format($row['OPEN_PRICE'], $counter_decimal, ".", "");
                $row['BuyDisplayDate'] = substr($row['OPEN_TIME'], 6, 2) . "/" . substr($row['OPEN_TIME'], 4, 2) . "/" . substr($row['OPEN_TIME'], 0, 4);
                $row['CurrentPrice'] = $row['CLOSE_PRICE'];
                $row['Floating'] = $row['PROFIT'];
                //$TotalFloating += $row['Floating'] + $row['FLCOMM'];
            } else {
                $row['SellPrice'] = number_format($row['OPEN_PRICE'], $counter_decimal, ".", "");
                $row['SellDisplayDate'] = substr($row['OPEN_TIME'], 6, 2) . "/" . substr($row['OPEN_TIME'], 4, 2) . "/" . substr($row['OPEN_TIME'], 0, 4);
                $row['CurrentPrice'] = $row['CLOSE_PRICE'];
                $row['Floating'] = $row['PROFIT'];
                //$TotalFloating += $row['Floating'] + $row['FLCOMM'];
            }

            if ($row['CLOSE_TIME'] == '1970-01-01 00:00:00') {
                $row['jenis'] = 'open';
                $statement['trade'][] = $row;
                $rolldate = substr($row['OPEN_TIME'], 0, 10);
                if (isset($row['SYMBOL'])) {
                    $thesymbol = $row['SYMBOL'];
                    if (!isset($turnover[$thesymbol])) {
                        $turnover[$thesymbol] = array();
                    }
                    if (!isset($turnover[$thesymbol][$rolldate])) {
                        $turnover[$thesymbol][$rolldate] = array();
                    }
                    if (!isset($turnover[$thesymbol][$rolldate]['opennya'])) {
                        $turnover[$thesymbol][$rolldate]['opennya'] = 0;
                    }
                    $turnover[$thesymbol][$rolldate]['opennya'] = $turnover[$thesymbol][$rolldate]['opennya'] + $row['Unit'];
                    $dataopen = array();
                    if ($row['CMD'] == '0') {
                        $dataopen['UNIT'] = $row['Unit'];
                        $dataopen['SELLPRICE'] = '';
                        $dataopen['BUYPRICE'] = $row['OPEN_PRICE'];
                        $dataopen['BUYDATE'] = $row['OPEN_TIME'];
                        $dataopen['SELLDATE'] = '';
                        $dataopen['CURRENT'] = $row['CLOSE_PRICE'];
                        $floatingopensemua = $row['PROFIT'] + $row['SWAPS'] + $row['COMMISSION'];
                        $dataopen['FLOATING'] = $floatingopensemua;
                    } else if ($row['CMD'] == '1') {
                        $dataopen['UNIT'] = $row['Unit'];
                        $dataopen['SELLPRICE'] = $row['OPEN_PRICE'];
                        $dataopen['BUYPRICE'] = '';
                        $dataopen['BUYDATE'] = '';
                        $dataopen['SELLDATE'] = $row['OPEN_TIME'];
                        $dataopen['CURRENT'] = $row['CLOSE_PRICE'];
                        $floatingopensemua = $row['PROFIT'] + $row['SWAPS'] + $row['COMMISSION'];
                        $dataopen['FLOATING'] = $floatingopensemua;
                    }
                    $opennya[$row['LOGIN']][$thesymbol][] = $dataopen;
                }
            } else {
                $status['PL'] = $status['PL'] + $row['PROFIT'];
                $row['jenis'] = 'settled';
                $statement['trade'][] = $row;
                $rolldate = substr($row['CLOSE_TIME'], 0, 10);
                if (isset($row['SYMBOL'])) {
                    $thesymbol = $row['SYMBOL'];
                    if (!isset($turnover[$thesymbol][$rolldate]['settled'])) {
                        $turnover[$thesymbol][$rolldate]['settled'] = 0;
                    }
                    $turnover[$thesymbol][$rolldate]['settled'] = $turnover[$thesymbol][$rolldate]['settled'] + $row['Unit'];
                }
            }//if ($row['CLOSE_TIME'] == '1970-01-01 00:00:00') { 
            if (!isset($turnover[$thesymbol][$rolldate]['turnover2'])) {
                $turnover[$thesymbol][$rolldate]['turnover2'] = 0;
            }
            $turnover[$thesymbol][$rolldate]['turnover2'] = $turnover[$thesymbol][$rolldate]['turnover2'] + $row['Unit'];
            if (!isset($turnover[$thesymbol][$rolldate]['opennya'])) {
                $turnover[$thesymbol][$rolldate]['opennya'] = 0;
            }
            if (!isset($turnover[$thesymbol][$rolldate]['settled'])) {
                $turnover[$thesymbol][$rolldate]['settled'] = 0;
            }
            if (!isset($turnover[$thesymbol][$rolldate]['turnover2'])) {
                $turnover[$thesymbol][$rolldate]['turnover2'] = 0;
            }
        }
    }
    unset($row);
    $query = "SELECT mt4_trades.*  
        FROM " . $mysql_meta . ".mt4_trades 
        WHERE login ='$account' 
        AND CMD IN ('6','7') 
        and OPEN_TIME > '$timeakhir' 
        order by mt4_trades.TICKET desc      
            ";
    //tradeLogReport_Summary_Client("tempstatement-318=" . $query);    
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        //tradeLogReport_Summary_Client("tempstatement-249=" . $row[CMD]);      
        if ($row['CMD'] == '6') {
            if ($row['PROFIT'] > 0) {
                $status['MARGININ'] = $status['MARGININ'] + $row['PROFIT'];
            } else {
                $status['MARGINOUT'] = $status['MARGINOUT'] + $row['PROFIT'];
            }
        }
        if ($row['CMD'] == '7') {
            if ($row['PROFIT'] > 0) {
                $status['CREDITIN'] = $status['CREDITIN'] + $row['PROFIT'];
            } else {
                $status['CREDITOUT'] = $status['CREDITOUT'] + $row['PROFIT'];
            }
        }
        $status['MARGIN'] = $status['MARGININ'] + $status['MARGINOUT'];
        //tradeLogReport_Summary_Client("tempstatement-249=MarginIn:" . $status[MARGININ]);
    }


    //tradeLogReport_Summary_Client("Temp_Statement-271-Equity:" . $status[EQUITY] . ";PrevBalance:" . $status[PREVBALANCE] . ";PL:" . $status[PL].";MarginIn:".$status[MARGININ].";MarginOut:".$status[MARGINOUT]);
    $status['floatingsemua'] = $status['EQUITY'] - $status['PREVBALANCE'] - $status['MARGININ'] - $status['MARGINOUT'] - $status['PL'];

    if ($status['MARGIN'] == '0' || $status['MARGIN'] == '') {
        $status['eqratio'] = "~%";
    } else {
        $status['eqratio'] = number_format($status['EQUITY'] * 100 / $status['MARGIN'], 2, ".", "") . "%";
    }
    $statement['status'] = $status;
    $monthly = fetchStatementMonthly($account, $status, $mysql_meta, $timeakhir);
    //tradeLogReport_Summary_Client("Temp_Statement-163-Margin-Monthly:" . $monthly[status][MARGIN]);
    $statement['monthly'] = $monthly;
    return $statement;
}

function fetchStatementMonthly($account, $status, $mysql_meta, $timeakhir) {
    global $DB;
    global $total;
    global $themonth;
    global $subtotal;
    global $margin;

    $statement = array();
    $status['MARGIN'] = 0;
    $status['MARGININ'] = 0;
    $status['MARGINOUT'] = 0;
    $status['CREDITIN'] = 0;
    $status['CREDITOUT'] = 0;
    $status['PL'] = 0;
    $themonth = substr($timeakhir, 0, 7);
    //tradeLogReport_Summary_Client("Temp_Statement-172-Month:" . $themonth);
    $positions = array();

    $query = "SELECT mt4_trades.* 
        FROM " . $mysql_meta . ".mt4_trades 
        WHERE login ='$account' 
        AND CMD IN ('0','1') and CLOSE_TIME ='1970-01-01 00:00:00' 
        order by  mt4_trades.TICKET desc      
            ";
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $row['ACCNO'] = $row['LOGIN'];
        $positions[] = $row;
    }


    $query = "SELECT mt4_trades.* 
        FROM " . $mysql_meta . ".mt4_trades 
        WHERE login ='$account' 
        AND CMD IN ('0','1') and CLOSE_TIME > '$timeakhir' 
        order by  mt4_trades.TICKET desc      
            ";
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $row['ACCNO'] = $row['LOGIN'];
        //tradeLogReport_Summary_Client("Temp_Statement-185-ACCNO:" . $row['ACCNO']);
        $positions[] = $row;
    }


    if (count($positions) > 0) {
        foreach ($positions AS $row) {
            while (list($key, $val) = each($row)) {
                $row[$key] = trim($val);
            }
            $counter_decimal = $row['DIGITS'] + 1;
            $row['Commission'] = number_format($row['COMMISSION'], 2, ".", "");
            $row['FLCOMM'] = number_format($row['COMMISSION'], 2, ".", "");
            $row['PL'] = number_format($row['PROFIT'], 2, ".", "");
            //tradeLogReport_Summary_Client("B_Open_position_report2-345=" . $row['TICKET']);

            $row['Unit'] = $row['VOLUME'] / 100;
            if ($row['CMD'] == '0') {
                $row['BuyPrice'] = number_format($row['OPEN_PRICE'], $counter_decimal, ".", "");
                $row['BuyDisplayDate'] = substr($row['OPEN_TIME'], 6, 2) . "/" . substr($row['OPEN_TIME'], 4, 2) . "/" . substr($row['OPEN_TIME'], 0, 4);
                $row['CurrentPrice'] = $row['CLOSE_PRICE'];
                $row['Floating'] = $row['PROFIT'];
                //$TotalFloating += $row['Floating'] + $row['FLCOMM'];
            } else {
                $row['SellPrice'] = number_format($row['OPEN_PRICE'], $counter_decimal, ".", "");
                $row['SellDisplayDate'] = substr($row['OPEN_TIME'], 6, 2) . "/" . substr($row['OPEN_TIME'], 4, 2) . "/" . substr($row['OPEN_TIME'], 0, 4);
                $row['CurrentPrice'] = $row['CLOSE_PRICE'];
                $row['Floating'] = $row['PROFIT'];
                //$TotalFloating += $row['Floating'] + $row['FLCOMM'];
            }
            //tradeLogReport_Summary_Client("tempstatement-310=" . $row[VOLUME]);
            if (!isset($subtotal[$row['SYMBOL']])) {
                $subtotal[$row['SYMBOL']] = array();
            }
            if (!isset($subtotal[$row['SYMBOL']]['OPENLOT'])) {
                $subtotal[$row['SYMBOL']]['OPENLOT'] = 0;
            }
            if (!isset($subtotal[$row['SYMBOL']]['SETTLEDLOT'])) {
                $subtotal[$row['SYMBOL']]['SETTLEDLOT'] = 0;
            }
            if ($row['CLOSE_TIME'] == '1970-01-01 00:00:00') {
                $row['jenis'] = 'open';
                //$statement['trade'][] = $row;
                if (isset($row['SYMBOL'])) {
                    $thesymbol = $row['SYMBOL'];
                    $total['OPENLOT'] = $total['OPENLOT'] + $row['Unit'];
                    $subtotal[$row['SYMBOL']]['OPENLOT'] = $subtotal[$row['SYMBOL']]['OPENLOT'] + $row['Unit'];
                }
            } else {
                $status['PL'] = $status['PL'] + $row['PROFIT'];
                $row['jenis'] = 'settled';
                $statement['trade']['VOLUMESETTLED'] = 0;
                $statement['trade']['VOLUMESETTLED'] = $statement['trade']['VOLUMESETTLED'] + $row['VOLUME'];
                if (isset($row['SYMBOL'])) {
                    $thesymbol = $row['SYMBOL'];
                    $total['SETTLEDLOT'] = $total['SETTLEDLOT'] + $row['Unit'];
                    $subtotal[$row['SYMBOL']]['SETTLEDLOT'] = $subtotal[$row['SYMBOL']]['SETTLEDLOT'] + $row['Unit'];
                }
            }
            if (!isset($total['TURNOVERLOT'])) {
                $total['TURNOVERLOT'] = 0;
            }
            //tradeLogReport_Summary_Client("B_Open_position_report2-252=" . $total['TURNOVERLOT'] . ";" . $row['Unit']);
            $total['TURNOVERLOT'] = $total['TURNOVERLOT'] + $row['Unit'];
            if (!isset($subtotal[$row['SYMBOL']]['TURNOVERLOT'])) {
                $subtotal[$row['SYMBOL']]['TURNOVERLOT'] = 0;
            }
            $subtotal[$row['SYMBOL']]['TURNOVERLOT'] = $subtotal[$row['SYMBOL']]['TURNOVERLOT'] + $row['Unit'];
        }
    }
    unset($row);


    $query = "SELECT mt4_trades.*  
        FROM " . $mysql_meta . ".mt4_trades 
        WHERE login ='$account' 
        AND CMD IN ('6','7') 
        and LEFT(OPEN_TIME,7) >= '$themonth' 
        order by mt4_trades.TICKET desc      
            ";
    //tradeLogReport_Summary_Client("tempstatement-476=" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        //tradeLogReport_Summary_Client("tempstatement-249=" . $row[CMD]);
        $tanggal = substr($row['OPEN_TIME'], 0, 10);
        if (isset($margin[$tanggal])) {
            $margin[$tanggal];
        }
        if (isset($margin[$tanggal][$account])) {
            $margin[$tanggal][$account];
        }
        $margin[$tanggal][$account]['MARGININ'] = 0;
        $margin[$tanggal][$account]['MARGINOUT'] = 0;
        $margin[$tanggal][$account]['CREDITIN'] = 0;
        $margin[$tanggal][$account]['CREDITOUT'] = 0;
        if ($row['CMD'] == '6') {
            if ($row['PROFIT'] > 0) {
                $status['MARGININ'] = $status['MARGININ'] + $row['PROFIT'];
                $margin[$tanggal][$row['LOGIN']]['MARGININ'] = $margin[$tanggal][$row['LOGIN']]['MARGININ'] + $row['PROFIT'];
            } else {
                $status['MARGINOUT'] = $status['MARGINOUT'] + $row['PROFIT'];
                $margin[$tanggal][$row['LOGIN']]['MARGINOUT'] = $margin[$tanggal][$row['LOGIN']]['MARGINOUT'] + $row['PROFIT'];
            }
        }
        if ($row['CMD'] == '7') {
            if ($row['PROFIT'] > 0) {
                $status['CREDITIN'] = $status['CREDITIN'] + $row['PROFIT'];
                $margin[$tanggal][$row['LOGIN']]['CREDITIN'] = $margin[$tanggal][$row['LOGIN']]['CREDITIN'] + $row['PROFIT'];
            } else {
                $status['CREDITOUT'] = $status['CREDITOUT'] + $row['PROFIT'];
                $margin[$tanggal][$row['LOGIN']]['CREDITOUT'] = $margin[$tanggal][$row['LOGIN']]['CREDITOUT'] + $row['PROFIT'];
            }
        }
        $status['MARGIN'] = $status['MARGININ'] + $status['MARGINOUT'];
        //tradeLogReport_Summary_Client("Report_Summary-510-Login:" . $row['LOGIN'] . ";MarginOut:" . $margin[$tanggal][$row['LOGIN']]['MARGINOUT'].";Profit:".$row['PROFIT']);
    }

    $statement['status'] = $status;

    return $statement;
}

?>