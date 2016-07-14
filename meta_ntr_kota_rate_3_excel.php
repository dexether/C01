<?php

//include("html_encoder_1.9.php");
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

// include_once("includes/wr_tools.php");
$lines = "a=1";

$var_to_pass = null;


if ($user->groupid == '9') {
    //tradeLog("Meta_Equity_Report_Excel_Excel-14");
}

require_once('../classes/OLEwriter.php');
require_once('../classes/BIFFwriter.php');
require_once('../classes/Worksheet.php');
require_once('../classes/Workbook.php');

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

$rolldatefrom = $_POST[rolldatefrom];
$rolldateto = $_POST[rolldateto];
$thekotas_array = $_POST[kotas_array];
$thegroups_array = $_POST[thegroups_array];
$account_array = $_POST[theaccounts];
$fromtime = $_POST[fromtime];
$totime = $_POST[totime];
$rolldatefrom2 = $rolldatefrom . " " . $fromtime;
$rolldateto2 = $rolldateto . " " . $totime;

$namaFile = "BackOffice_NTR" . "_" . $rolldateto . ".xls";

for ($i_account = 0; $i_account < count($account_array); $i_account++) {
    //tradeLog("Meta_Equity_Report_Excel_Excel-40;Account:" . $account_array[$i_account]);
    $query_account = $query_account . ",'" . $account_array[$i_account] . "'";
}
$query_account = " and acc_kota.Login in (''" . $query_account . ")";

if (empty($query_account)) {
    print"<center>Please Input the Accounts</center><br>";
} else {

    function HeaderingExcel($namaFile) {
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=$namaFile");
        header("Expires:0");
        header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
        header("Pragma: public");
    }

//http headers
    // HeaderingExcel($namaFile);
    // ;

//membuat workbook
    //For Color Look http://cpansearch.perl.org/src/JMCNAMARA/Spreadsheet-WriteExcel-2.37/docs/palette.html
    $workbook = new Workbook("-");

    $fjudul = & $workbook->add_format();
    $fjudul->set_align('left');
    $fjudul->set_align('vjustify');
    $fjudul->set_bold();
    $fjudul->set_size(16);
    $fjudul->set_color2('30');
    $fjudul->set_fg_color('white');
    $fjudul->set_pattern(1);
    $fjudul->set_border(1);
    $fjudul->set_border_color2('56'); //LLne hitam

    $fmenu = & $workbook->add_format();
    $fmenu->set_align('Center');
    $fmenu->set_color("white");
    $fmenu->set_fg_color2('30'); //blue
    $fmenu->set_pattern(1);
    $fmenu->set_border(1);
    $fmenu->set_border_color2('9'); //White

    $fdate = & $workbook->add_format();
    $fdate->set_align('left');
    $fdate->set_color2('37');
    $fdate->set_fg_color2('9'); //White
    $fdate->set_pattern(1);
    //$fdate->set_border(1);

    $ftextright1 = & $workbook->add_format();
    $ftextright1->set_align('right');
    $ftextright1->set_color("black");
    $ftextright1->set_fg_color2('44'); //blue
    $ftextright1->set_pattern(1);
    $ftextright1->set_border(1);
    $ftextright1->set_border_color2('9'); //white

    $ftextright2 = & $workbook->add_format();
    $ftextright2->set_align('right');
    $ftextright2->set_color("black");
    $ftextright2->set_fg_color2('27'); //blue
    $ftextright2->set_pattern(1);
    $ftextright2->set_border(1);
    $ftextright2->set_border_color2('9'); //white
    //
    $ftextright3 = & $workbook->add_format();
    $ftextright3->set_align('right');
    $ftextright3->set_color("black");
    $ftextright3->set_fg_color2('60'); //red
    $ftextright3->set_pattern(1);
    $ftextright3->set_border(1);
    $ftextright3->set_border_color2('9'); //white
    //$ftext->set_align('vjustify');
    //$ftextright->set_bold();

    $ftextleft = & $workbook->add_format();
    $ftextleft->set_align('left');
    $ftextleft->set_bold();

    $fANGKA1 = & $workbook->add_format();
    $fANGKA1->set_align('right');
    $fANGKA1->set_color("black");
    $fANGKA1->set_fg_color2('44'); //blue
    $fANGKA1->set_num_format('3');
    $fANGKA1->set_pattern(1);
    $fANGKA1->set_border(1);
    $fANGKA1->set_border_color2('9'); //white

    $fANGKA2 = & $workbook->add_format();
    $fANGKA2->set_align('right');
    $fANGKA2->set_color("black");
    $fANGKA2->set_fg_color2('27'); //blue
    $fANGKA2->set_num_format('3');
    $fANGKA2->set_pattern(1);
    $fANGKA2->set_border(1);
    $fANGKA2->set_border_color2('9'); //white
    //
    $fANGKA3 = & $workbook->add_format();
    $fANGKA3->set_align('right');
    $fANGKA3->set_color("white");
    $fANGKA3->set_fg_color2('60'); //red
    $fANGKA3->set_num_format('3');
    $fANGKA3->set_pattern(1);
    $fANGKA3->set_border(1);
    $fANGKA3->set_border_color2('9'); //white


    $worksheet1 = & $workbook->add_worksheet("NTR");
    //$worksheet1->set_column(row,column,lebar)
    $worksheet1->set_column(0, 0, 20);
    $worksheet1->set_column(0, 1, 20);
    $worksheet1->set_column(0, 2, 20);
    $worksheet1->set_column(0, 3, 20);
    $worksheet1->set_column(0, 4, 20);
    $worksheet1->set_column(0, 5, 20);
    $worksheet1->set_column(0, 6, 20);
    $worksheet1->set_column(0, 7, 20);
    $worksheet1->set_column(0, 8, 20);
    $worksheet1->set_column(0, 9, 20);
    $worksheet1->set_column(0, 10, 30);
    $worksheet1->set_column(0, 11, 30);
    $worksheet1->set_column(0, 12, 20);
    $worksheet1->set_column(0, 13, 20);
    $worksheet1->set_column(0, 14, 20);
    $worksheet1->set_column(0, 15, 20);
    $worksheet1->set_column(0, 16, 20);
    $worksheet1->set_column(0, 17, 20);
    $worksheet1->set_column(0, 18, 20);

    $worksheet1->set_row(0, 20);

    $i_row = 0;
    $i_column = 0;
    $worksheet1->set_row($i_row, 30);
    $worksheet1->write_string($i_row, 0, "NTR", $fjudul);
    $worksheet1->write_string($i_row, 1, "", $fjudul);
    $worksheet1->write_string($i_row, 2, "", $fjudul);
    $worksheet1->merge_cells($i_row, 0, $i_row, 9);
    $i_row++;
    $worksheet1->write_string($i_row, 0, "Rolldate : ", $fdate);
    $worksheet1->write_string($i_row, 1, $rolldateto, $fdate);
    $i_row++;
    /*
      $query = "SELECT LEFT(TIME,10) AS rolldatefrom
      FROM " . $mysql[meta] . ".mt4_daily
      WHERE LEFT(TIME,10) < '$rolldateto'
      GROUP BY LEFT(TIME,10)
      ORDER BY LEFT(TIME,10) DESC LIMIT 0,1";
      //tradeLog("Meta_Equity_Report_Excel_Excel-190;Query:" . $query);
      $result = mysql_query($query) OR DIE(mysql_error());
      while ($row = mysql_fetch_array($result)) {
      $rolldatefrom = $row[rolldatefrom];
      }
      mysql_free_result($result);
     */
    //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-196-Rolldatefrom:" . $rolldatefrom);
    for ($i_kota = 0; $i_kota < count($thekotas_array); $i_kota++) {
        $thekota = $thekotas_array[$i_kota];
        //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-200:" . $thekota);

        for ($i_group = 0; $i_group < count($thegroups_array); $i_group++) {
            $thegroup = $thegroups_array[$i_group];
            //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-204:" . $thegroup);

            $worksheet1->set_row($i_row, 30);
            $worksheet1->write_string($i_row, 0, "Kota : ", $fdate);
            $worksheet1->write_string($i_row, 1, $thekota, $fdate);
            $worksheet1->write_string($i_row, 3, "Rate : ", $fdate);
            $worksheet1->write_string($i_row, 4, $thegroup, $fdate);
            $i_row++;
            $worksheet1->write_string($i_row, 0, "No", $fmenu);
            $worksheet1->write_string($i_row, 1, "Account", $fmenu);
            $worksheet1->write_string($i_row, 2, "Equity Report", $fmenu);
            $worksheet1->write_string($i_row, 3, "", $fmenu);
            $worksheet1->merge_cells($i_row, 2, $i_row, 3);
            $worksheet1->write_string($i_row, 4, "Deposit", $fmenu);
            $worksheet1->write_string($i_row, 5, "Withdrawal", $fmenu);
            $worksheet1->write_string($i_row, 6, "Close Trade", $fmenu);
            $worksheet1->write_string($i_row, 7, "Adjustment", $fmenu);
            $worksheet1->write_string($i_row, 8, "", $fmenu);
            $worksheet1->merge_cells($i_row, 7, $i_row, 8);
            $worksheet1->write_string($i_row, 9, "NTR", $fmenu);
            $worksheet1->write_string($i_row, 10, "Start From", $fmenu);

            $i_row++;
            $worksheet1->write_string($i_row, 0, "", $fmenu);
            $worksheet1->write_string($i_row, 1, "", $fmenu);
            $worksheet1->write_string($i_row, 2, "New", $fmenu);
            $worksheet1->write_string($i_row, 3, "Previous", $fmenu);
            $worksheet1->write_string($i_row, 4, "", $fmenu);
            $worksheet1->write_string($i_row, 5, "", $fmenu);
            $worksheet1->write_string($i_row, 6, "Report Comm", $fmenu);
            $worksheet1->write_string($i_row, 7, "+", $fmenu);
            $worksheet1->write_string($i_row, 8, "-", $fmenu);
            $worksheet1->write_string($i_row, 9, "", $fmenu);
            $worksheet1->write_string($i_row, 10, "", $fmenu);
            $i_row++;

            $mt4_dailys_to = array();
            $query = "select * 
        from " . $mysql[meta] . ".mt4_daily,acc_kota 
        where 
        mt4_daily.LOGIN = acc_kota.login 
        and acc_kota.rate = '$thegroup' 
        and acc_kota.kota = '$thekota' 
        and LEFT(mt4_daily.TIME,10) = '$rolldateto' 
        $query_account 
        ORDER BY mt4_daily.TIME ASC;     
            ";
            //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-255:" . $query);
            $result = mysql_query($query) OR DIE(mysql_error());
            while ($row = mysql_fetch_array($result)) {
                $mt4_dailys_to[$row[LOGIN]] = $row;
            }
            mysql_free_result($result);

            $ftextright = $ftextright1;
            $fANGKA = $fANGKA1;
            $inomor = 1;
            foreach ($mt4_dailys_to AS $ACCNO => $mt4_daily_to) {
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-262:" . $ACCNO);
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-261:" . $inomor);
                $worksheet1->write_string($i_row, 0, $inomor, ftextright);

                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-264:" . $ACCNO);
                $worksheet1->write_string($i_row, 1, $ACCNO, ftextright);

                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-267:" . $mt4_daily_to[EQUITY]);
                $worksheet1->write_number($i_row, 2, $mt4_daily_to[EQUITY], fANGKA);


                $subEquity[$thegroup] = $subEquity[$thegroup] + $mt4_daily_to[EQUITY];
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-272:" . $subEquity[$thegroup]);
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-275-Equity:" . $mt4_dailys_from[EQUITY]);


                $query = "select LEFT(TIME,10) AS TheTIME,mt4_daily.* 
                from " . $mysql[meta] . ".mt4_daily where 
            LEFT(TIME,10) = '$rolldatefrom' 
            and login = '$ACCNO' 
            ORDER BY TIME ASC limit 0,1;     
            ";
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-283:" . $query);
                $result = mysql_query($query) OR DIE(mysql_error());
                unset($mt4_dailys_from);
                while ($row = mysql_fetch_array($result)) {
                    $mt4_dailys_from = $row;
                    //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-289-Equity:" . $mt4_dailys_from[EQUITY]);
                }
                mysql_free_result($result);

                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-294-Equity:" . $mt4_dailys_from[EQUITY]);

                $worksheet1->write_number($i_row, 3, $mt4_dailys_from[EQUITY], fANGKA);
                $subEquityPrev[$thegroup] = $subEquityPrev[$thegroup] + $mt4_dailys_from[EQUITY];

                $Adjust_in = 0;
                $Adjust_out = 0;
                $deposit = 0;
                $withdrawal = 0;

                $query = "SELECT * 
            FROM " . $mysql[meta] . ".mt4_trades 
            WHERE cmd in ('6','7') 
            AND LOGIN = '$ACCNO' 
            AND LEFT(OPEN_TIME,10) BETWEEN ('$rolldateto') AND ('$rolldateto')";
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-309-Query:" . $query);
                $result = mysql_query($query) OR DIE(mysql_error());
                $deposit = 0;
                $withdrawal = 0;
                while ($row = mysql_fetch_array($result)) {
                    if ($row[CMD] == '6') {
                        if ($row[PROFIT] > 0) {
                            $deposit = $deposit + $row[PROFIT];
                        } else {
                            $withdrawal = $withdrawal + $row[PROFIT];
                        }
                    }
                    if ($row[CMD] == '7') {
                        if ($row[PROFIT] > 0) {
                            $Adjust_out = $Adjust_out + $row[PROFIT] * -1;
                        } else {
                            $Adjust_in = $Adjust_in + $row[PROFIT];
                        }
                    }
                }
                mysql_free_result($result);
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-330-AdjustOut:" . $Adjust_out);

                $worksheet1->write_number($i_row, 4, $deposit, fANGKA);
                $worksheet1->write_number($i_row, 5, $withdrawal, fANGKA);
                $subDeposit[$thegroup] = $subDeposit[$thegroup] + $deposit;
                $subWithdrawal[$thegroup] = $subWithdrawal[$thegroup] + $withdrawal;

                $query = "SELECT * 
            FROM " . $mysql[meta] . ".mt4_trades 
            WHERE cmd IN ('0','1') 
            AND LOGIN = '$ACCNO' 
            AND LEFT(CLOSE_TIME,10) BETWEEN ('$rolldateto') AND ('$rolldateto') and CLOSE_TIME <= '$rolldateto2' ";
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-345:" . $query);
                $result = mysql_query($query) OR DIE(mysql_error());
                $commission = 0;
                $liquid = 0;
                $liquid_buy = array();
                while ($row = mysql_fetch_array($result)) {
                    //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-348:" . $row[TICKET]);
                    $commission = $commission + $row[COMMISSION];
                    $liquid = $liquid + $row[VOLUME] / 100;
                    if ($row[CMD] == '0') {
                        $liquid_buy[$row[SYMBOL]] = $liquid_buy[$row[SYMBOL]] + $row[VOLUME] / 100;
                        $subsymbol[$row[SYMBOL]][buy] = $subsymbol[$row[SYMBOL]][buy] + $row[VOLUME] / 100;
                        $subliquid_buy[$thegroup][$row[SYMBOL]] = $subliquid_buy[$thegroup][$row[SYMBOL]] + $row[VOLUME] / 100;
                    }
                    if ($row[CMD] == '1') {
                        $liquid_sell[$row[SYMBOL]] = $liquid_sell[$row[SYMBOL]] + $row[VOLUME] / 100;
                        $subsymbol[$row[SYMBOL]][sell] = $subsymbol[$row[SYMBOL]][sell] + $row[VOLUME] / 100;
                        $subliquid_sell[$thegroup][$row[SYMBOL]] = $subliquid_sell[$thegroup][$row[SYMBOL]] + $row[VOLUME] / 100;
                    }
                    /*
                      tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-319-Ticket:" . $row[TICKET]
                      . ";Liquid Symbol:" . $row[SYMBOL]
                      . ";" . $subliquid_buy[$thegroup][$row[SYMBOL]]
                      . ";" . $subliquid_sell[$thegroup][$row[SYMBOL]]);
                     */
                }
                mysql_free_result($result);

                $worksheet1->write_number($i_row, 6, $commission, fANGKA);
                $subCommission[$thegroup] = $subCommission[$thegroup] + $commission;
                $subliquid[$thegroup] = $subliquid[$thegroup] + $liquid;


                $worksheet1->write_number($i_row, 7, $Adjust_in, fANGKA);
                $worksheet1->write_number($i_row, 8, $Adjust_out, fANGKA);
                $Adjust_add = $Adjust_in + $Adjust_out;
                $subAdjustIN[$thegroup] = $subAdjustIN[$thegroup] + $Adjust_in;
                $subAdjustOUT[$thegroup] = $subAdjustOUT[$thegroup] + $Adjust_out;


                $NTREdit = ($mt4_daily_to[EQUITY]) - ($mt4_dailys_from[EQUITY] + $deposit + $withdrawal + $commission + $Adjust_add);
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-384-mt4_daily_to[EQUITY]:" . $mt4_daily_to[EQUITY]);
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-385-mt4_dailys_from[EQUITY]:" . $mt4_dailys_from[EQUITY]);
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-386-deposit:" . $deposit);
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-387-withdrawal:" . $withdrawal);
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-388-commission:" . $commission);
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-389-Adjust_add:" . $Adjust_add);
                $NTREdit = round($NTREdit, 2);    // 5.05
                $subNTREdit[$thegroup] = $subNTREdit[$thegroup] + $NTREdit;

                $worksheet1->write_number($i_row, 9, $NTREdit, fANGKA);
                $worksheet1->write_string($i_row, 10, $mt4_dailys_from[TheTIME], ftextright);

                $query = "SELECT * 
            FROM " . $mysql[meta] . ".mt4_trades 
            WHERE cmd IN ('0','1') 
            AND LOGIN = '$ACCNO' 
            AND LEFT(OPEN_TIME,10) BETWEEN ('$rolldateto') AND ('$rolldateto') 
            ";
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-401:" . $query);
                $result = mysql_query($query) OR DIE(mysql_error());
                $newposition = 0;
                while ($row = mysql_fetch_array($result)) {
                    $newposition = $newposition + $row[VOLUME] / 100;
                    if ($row[CMD] == '0') {
                        $new_buy[$row[SYMBOL]] = $new_buy[$row[SYMBOL]] + $row[VOLUME] / 100;
                        $subsymbol[$row[SYMBOL]][buy] = $subsymbol[$row[SYMBOL]][buy] + $row[VOLUME] / 100;
                        $subnew_buy[$thegroup][$row[SYMBOL]] = $subnew_buy[$thegroup][$row[SYMBOL]] + $row[VOLUME] / 100;
                    }
                    if ($row[CMD] == '1') {
                        $new_sell[$row[SYMBOL]] = $new_sell[$row[SYMBOL]] + $row[VOLUME] / 100;
                        $subsymbol[$row[SYMBOL]][sell] = $subsymbol[$row[SYMBOL]][sell] + $row[VOLUME] / 100;
                        $subnew_sell[$thegroup][$row[SYMBOL]] = $subnew_sell[$thegroup][$row[SYMBOL]] + $row[VOLUME] / 100;
                    }
                    /*
                      tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-366-Ticket:" . $row[TICKET]
                      . ";New Symbol:" . $row[SYMBOL]
                      . ";" . $subnew_buy[$thegroup][$row[SYMBOL]]
                      . ";" . $subnew_sell[$thegroup][$row[SYMBOL]]);
                     */
                }
                mysql_free_result($result);
                $subnew[$thegroup] = $subnew[$thegroup] + $newposition;

                if ($ftextright == $ftextright1) {
                    $ftextright = $ftextright2;
                    $fANGKA = $fANGKA2;
                } else {
                    $ftextright = $ftextright1;
                    $fANGKA = $fANGKA1;
                }

                $query = "SELECT mt4_users.NAME,mt4_users.REGDATE,mt4_trades.* 
                    FROM " . $mysql[meta] . ".mt4_trades," . $mysql[meta] . ".mt4_users 
                    WHERE 
                    mt4_trades.LOGIN = mt4_users.LOGIN 
                    and mt4_trades.cmd IN ('0','1') 
                    AND mt4_trades.LOGIN = '$ACCNO' 
                    AND
                    (
                          (
                          LEFT(mt4_trades.OPEN_TIME,10)  <= '$rolldateto' 
                          AND 
                          mt4_trades.CLOSE_TIME ='1970-01-01 00:00:00'
                          )
                          OR
                          (
                          mt4_trades.OPEN_TIME  <= '$rolldateto2' 
                          AND
                          mt4_trades.CLOSE_TIME>'$rolldateto2'
                          )
                   )"
                ;
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-457:" . $query);
                $result = mysql_query($query) OR DIE(mysql_error());
                $newposition = 0;
                //$open_ticket = array();
                while ($row = mysql_fetch_array($result)) {
                    $newposition = $newposition + $row[VOLUME] / 100;
                    if ($row[CMD] == '0') {
                        $open_lot[$row[SYMBOL]][buy] = $open_lot[$row[SYMBOL]][buy] + $row[VOLUME] / 100;
                        $open_price[$row[SYMBOL]][buy] = $open_price[$row[SYMBOL]][buy] + ($row[VOLUME] / 100) * $row[OPEN_PRICE];
                        $open_ticket[$row[SYMBOL]][$row[TICKET]] = $row;
                    }
                    if ($row[CMD] == '1') {
                        $open_lot[$row[SYMBOL]][sell] = $open_lot[$row[SYMBOL]][sell] + $row[VOLUME] / 100;
                        $open_price[$row[SYMBOL]][sell] = $open_price[$row[SYMBOL]][sell] + ($row[VOLUME] / 100) * $row[OPEN_PRICE];
                        $open_ticket[$row[SYMBOL]][$row[TICKET]] = $row;
                    }
                    //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-469-ACCNO" . $ACCNO . ";Ticket:" . $row[TICKET] . ";Symbol:" . $row[SYMBOL] . ";Sell:" . $open_lot[$row[SYMBOL]][sell] . ";Buy:" . $open_lot[$row[SYMBOL]][buy]);
                }

                $i_row++;
                $inomor++;
            }// End Per Account
            $worksheet1->write_string($i_row, 0, "", $ftextright3);
            $worksheet1->write_string($i_row, 1, "", $ftextright3);
            $worksheet1->write_number($i_row, 2, $subEquity[$thegroup], $fANGKA3);
            $worksheet1->write_number($i_row, 3, $subEquityPrev[$thegroup], $fANGKA3);
            $worksheet1->write_number($i_row, 4, $subDeposit[$thegroup], $fANGKA3);
            $worksheet1->write_number($i_row, 5, $subWithdrawal[$thegroup], $fANGKA3);
            $worksheet1->write_number($i_row, 6, $subCommission[$thegroup], $fANGKA3);
            $worksheet1->write_number($i_row, 7, $subAdjustIN[$thegroup], $fANGKA3);
            $worksheet1->write_number($i_row, 8, $subAdjustOUT[$thegroup], $fANGKA3);
            $worksheet1->write_number($i_row, 9, $subNTREdit[$thegroup], $fANGKA3);
            $worksheet1->write_string($i_row, 10, "", $ftextright3);
            $i_row++;
            $i_row++;
        }//end per Group
    }


    $worksheet1 = & $workbook->add_worksheet("Additional");
    //$worksheet1->set_column(row,column,lebar)
    $worksheet1->set_column(0, 0, 20);
    $worksheet1->set_column(0, 1, 20);
    $worksheet1->set_column(0, 2, 20);
    $worksheet1->set_column(0, 3, 20);
    $worksheet1->set_column(0, 4, 20);
    $worksheet1->set_column(0, 5, 20);
    $worksheet1->set_column(0, 6, 20);
    $worksheet1->set_column(0, 7, 20);
    $worksheet1->set_column(0, 8, 20);
    $worksheet1->set_column(0, 9, 20);
    $worksheet1->set_column(0, 10, 30);
    $worksheet1->set_column(0, 11, 30);
    $worksheet1->set_column(0, 12, 20);
    $worksheet1->set_column(0, 13, 20);
    $worksheet1->set_column(0, 14, 20);
    $worksheet1->set_column(0, 15, 20);
    $worksheet1->set_column(0, 16, 20);
    $worksheet1->set_column(0, 17, 20);
    $worksheet1->set_column(0, 18, 20);
    $worksheet1->set_row(0, 20);

    $i_row = 0;
    $i_column = 0;



    $ftextright = $ftextright1;
    $fANGKA = $fANGKA1;

    if (count($subsymbol) > 0) {
        foreach ($subsymbol AS $symbol => $data) {
            $i_row++;
            $worksheet1->write_string($i_row, 0, "Currency : ", $fmenu);
            $worksheet1->write_string($i_row, 1, "Rate : ", $fmenu);
            $worksheet1->write_string($i_row, 2, "Liquid Buy", $fmenu);
            $worksheet1->write_string($i_row, 3, "New Buy", $fmenu);
            $worksheet1->write_string($i_row, 4, "Liquid Sell", $fmenu);
            $worksheet1->write_string($i_row, 5, "New Sell", $fmenu);
            $i_row++;
            for ($i_group = 0; $i_group < count($thegroups_array); $i_group++) {
                $worksheet1->write_string($i_row, 0, $symbol, ftextright);
                $thegroup = $thegroups_array[$i_group];
                $worksheet1->write_string($i_row, 1, $thegroup, ftextright);

                $liquid_buy = $subliquid_buy[$thegroup][$symbol];
                $worksheet1->write_number($i_row, 2, $liquid_buy, fANGKA);
                $a_[$symbol][liquid_buy] = $a_[$symbol][liquid_buy] + $liquid_buy;

                $new_buy = $subnew_buy[$thegroup][$symbol];
                $worksheet1->write_number($i_row, 3, $new_buy, fANGKA);
                $a_[$symbol][new_buy] = $a_[$symbol][new_buy] + $new_buy;

                $liquid_sell = $subliquid_sell[$thegroup][$symbol];
                $worksheet1->write_number($i_row, 4, $liquid_sell, fANGKA);
                $a_[$symbol][liquid_sell] = $a_[$symbol][liquid_sell] + $liquid_sell;

                $new_sell = $subnew_sell[$thegroup][$symbol];
                $worksheet1->write_number($i_row, 5, $new_sell, fANGKA);
                $a_[$symbol][new_sell] = $a_[$symbol][new_sell] + $new_sell;

                $subsymbol[$symbol][newproduct] = $subsymbol[$symbol][newproduct] + $new_buy + $new_sell;
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-464-NewBuy:" . $new_buy.";NewSell:".$new_sell.";NewProduct:".$subsymbol[$symbol][newproduct]);

                $subsymbol[$symbol][liquidproduct] = $subsymbol[$symbol][liquidproduct] + $liquid_buy + $liquid_sell;
                if ($ftextright == $ftextright1) {
                    $ftextright = $ftextright2;
                    $fANGKA = $fANGKA2;
                } else {
                    $ftextright = $ftextright1;
                    $fANGKA = $fANGKA1;
                }
                $i_row++;
            }
            $worksheet1->write_string($i_row, 0, $symbol, $ftextright3);
            $thegroup = $thegroups_array[$i_group];
            $worksheet1->write_string($i_row, 1, '', $ftextright3);
            $worksheet1->write_number($i_row, 2, $a_[$symbol][liquid_buy], $fANGKA3);
            $worksheet1->write_number($i_row, 3, $a_[$symbol][new_buy], $fANGKA3);
            $worksheet1->write_number($i_row, 4, $a_[$symbol][liquid_sell], $fANGKA3);
            $worksheet1->write_number($i_row, 5, $a_[$symbol][new_sell], $fANGKA3);
            $i_row++;

            $worksheet1->write_string($i_row, 0, 'NET Volume', $ftextright3);
            $thegroup = $thegroups_array[$i_group];
            $net = $subsymbol[$symbol][buy] - $subsymbol[$symbol][sell];
            $worksheet1->write_number($i_row, 1, $net, $fANGKA3);
            $worksheet1->write_string($i_row, 2, 'Total Buy', $ftextright3);
            $worksheet1->write_number($i_row, 3, $subsymbol[$symbol][buy], $fANGKA3);
            $worksheet1->write_string($i_row, 4, 'Total Sell', $ftextright3);
            $worksheet1->write_number($i_row, 5, $subsymbol[$symbol][sell], $fANGKA3);
            $i_row++;


            $worksheet1->write_string($i_row, 0, $symbol, $ftextright3);
            $thegroup = $thegroups_array[$i_group];
            $worksheet1->write_string($i_row, 1, '', $ftextright3);
            $worksheet1->write_string($i_row, 2, 'Total New', $ftextright3);
            $worksheet1->write_number($i_row, 3, $subsymbol[$symbol][newproduct], $fANGKA3);
            $worksheet1->write_string($i_row, 4, 'Total Liquid', $ftextright3);
            $worksheet1->write_number($i_row, 5, $subsymbol[$symbol][liquidproduct], $fANGKA3);
            $i_row++;

            $i_row++;
        }
        //end if  Data
    } else {
        $i_row++;
        $worksheet1->write_string($i_row, 0, "Currency : ", $fmenu);
        $worksheet1->write_string($i_row, 1, "Rate : ", $fmenu);
        $worksheet1->write_string($i_row, 2, "Liquid Buy", $fmenu);
        $worksheet1->write_string($i_row, 3, "New Buy", $fmenu);
        $worksheet1->write_string($i_row, 4, "Liquid Sell", $fmenu);
        $worksheet1->write_string($i_row, 5, "New Sell", $fmenu);
        $i_row++;
        $worksheet1->write_string($i_row, 0, "No Transacion", ftextright);
        $worksheet1->write_string($i_row, 1, "No Transacion", ftextright);
        $worksheet1->write_string($i_row, 2, "No Transacion", ftextright);
        $worksheet1->write_string($i_row, 3, "No Transacion", ftextright);
        $worksheet1->write_string($i_row, 4, "No Transacion", ftextright);
        $worksheet1->write_string($i_row, 5, "No Transacion", ftextright);
        $i_row++;
    }//End if No Data


    $worksheet1 = & $workbook->add_worksheet("Open_Position" . $rolldateto);

    $worksheet1->set_column(0, 0, 20);
    $worksheet1->set_column(0, 1, 20);
    $worksheet1->set_column(0, 2, 20);
    $worksheet1->set_column(0, 3, 20);
    $worksheet1->set_column(0, 4, 20);
    $worksheet1->set_column(0, 5, 20);
    $worksheet1->set_column(0, 6, 20);
    $worksheet1->set_column(0, 7, 20);
    $worksheet1->set_column(0, 8, 20);
    $worksheet1->set_column(0, 9, 20);
    $worksheet1->set_column(0, 10, 30);
    $worksheet1->set_column(0, 11, 30);
    $worksheet1->set_column(0, 12, 20);
    $worksheet1->set_column(0, 13, 20);
    $worksheet1->set_column(0, 14, 20);
    $worksheet1->set_column(0, 15, 20);
    $worksheet1->set_column(0, 16, 20);
    $worksheet1->set_column(0, 17, 20);
    $worksheet1->set_column(0, 18, 20);
    $worksheet1->set_row(0, 20);

    $i_row = 0;
    $i_column = 0;

    $worksheet1->write_string($i_row, 0, "", $fmenu);
    $worksheet1->write_string($i_row, 1, "", $fmenu);
    $worksheet1->write_string($i_row, 2, "", $fmenu);
    $worksheet1->write_string($i_row, 3, "Currency", $fmenu);
    $worksheet1->write_string($i_row, 4, "", $fmenu);
    $worksheet1->write_string($i_row, 5, "Buy Lot", $fmenu);
    $worksheet1->write_string($i_row, 6, "Buy AVG Price", $fmenu);
    $worksheet1->write_string($i_row, 7, "Sell Lot", $fmenu);
    $worksheet1->write_string($i_row, 8, "Sell AVG Price", $fmenu);
    $worksheet1->write_string($i_row, 9, "Net Open", $fmenu);
    $i_row++;
    $ftextright = $ftextright1;
    $fANGKA = $fANGKA1;

    //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-636-Count Symbol:" . count($subsymbol));

    if (count($open_lot) > 0) {
        foreach ($open_lot AS $symbol => $data) {
            //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-619-:" . $symbol);
            $worksheet1->write_string($i_row, 3, $symbol, ftextright);

            $buy = 0;
            $buy = $open_lot[$symbol][buy];
            $worksheet1->write_number($i_row, 5, $buy, $fANGKA);

            $open_price_buy = 0;
            $open_price_buy = $open_price[$symbol][buy];
            if ($buy > 0) {
                $buyavg = $open_price_buy / $buy;
            } else {
                $buyavg = '';
            }
            $worksheet1->write_number($i_row, 6, $buyavg, $fANGKA);

            $sell = 0;
            $sell = $open_lot[$symbol][sell];
            $worksheet1->write_number($i_row, 7, $sell, $fANGKA);

            $open_price_sell = 0;
            $open_price_sell = $open_price[$symbol][sell];
            if ($sell > 0) {
                $sellavg = $open_price_sell / $sell;
            } else {
                $sellavg = '';
            }
            $worksheet1->write_number($i_row, 8, $sellavg, $fANGKA);

            $net = $buy - $sell;
            $worksheet1->write_number($i_row, 9, $net, $fANGKA);

            if ($ftextright == $ftextright1) {
                $ftextright = $ftextright2;
                $fANGKA = $fANGKA2;
            } else {
                $ftextright = $ftextright1;
                $fANGKA = $fANGKA1;
            }
            $i_row++;
        }
        $i_row++;
        $i_row++;
        $worksheet1->write_string($i_row, 0, "Name", $fmenu);
        $worksheet1->write_string($i_row, 1, "RegDate", $fmenu);
        $worksheet1->write_string($i_row, 2, "Login", $fmenu);
        $worksheet1->write_string($i_row, 3, "Currency", $fmenu);
        $worksheet1->write_string($i_row, 4, "Ticket", $fmenu);
        $worksheet1->write_string($i_row, 5, "Buy Lot", $fmenu);
        $worksheet1->write_string($i_row, 6, "", $fmenu);
        $worksheet1->write_string($i_row, 7, "Sell Lot", $fmenu);
        $worksheet1->write_string($i_row, 8, "", $fmenu);
        $worksheet1->write_string($i_row, 9, "OPEN Time", $fmenu);

        $i_row++;
        $ftextright = $ftextright1;
        $fANGKA = $fANGKA1;
        if (count($open_ticket) > 0) {
            foreach ($open_ticket AS $symbol => $ticket_array) {
                if (count($ticket_array) > 0) {
                    foreach ($ticket_array AS $ticket => $data) {
                        //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-697-Symbol:" . $symbol . ";Ticket:" . $ticket);
                        $worksheet1->write_string($i_row, 0, $data[NAME], ftextright);
                        $worksheet1->write_string($i_row, 1, $data[REGDATE], ftextright);
                        $worksheet1->write_string($i_row, 2, $data[LOGIN], ftextright);
                        $worksheet1->write_string($i_row, 3, $symbol, ftextright);
                        $worksheet1->write_string($i_row, 4, $ticket, ftextright);
                        $qty = $data[VOLUME] / 100;
                        if ($data[CMD] == '0') {
                            $worksheet1->write_number($i_row, 5, $qty, $fANGKA);
                        } else {
                            $worksheet1->write_number($i_row, 7, $qty, $fANGKA);
                        }
                        $worksheet1->write_string($i_row, 9, $data[OPEN_TIME], ftextright);
                        if ($ftextright == $ftextright1) {
                            $ftextright = $ftextright2;
                            $fANGKA = $fANGKA2;
                        } else {
                            $ftextright = $ftextright1;
                            $fANGKA = $fANGKA1;
                        }
                        $i_row++;
                    }
                }
            }
        }
    } else {
        $worksheet1->write_string($i_row, 0, "No Product Open", ftextright);
        $worksheet1->write_string($i_row, 1, "", ftextright);
        $worksheet1->write_string($i_row, 2, "", ftextright);
        $worksheet1->write_string($i_row, 3, "", ftextright);
        $worksheet1->write_string($i_row, 4, "", ftextright);
        $worksheet1->write_string($i_row, 5, "", ftextright);
        $worksheet1->write_string($i_row, 6, "", ftextright);
        $worksheet1->write_string($i_row, 7, "", ftextright);
        $worksheet1->write_string($i_row, 8, "", ftextright);
        $worksheet1->write_string($i_row, 9, "", ftextright);
    }

    $query = "SELECT LEFT(TIME,10) AS ROLLOVER FROM " . $mysql[meta] . ".mt4_daily 
        WHERE LEFT(TIME,10)  BETWEEN ('" . $rolldatefrom . "') AND ('" . $rolldateto . "') 
        and     LEFT(TIME,10) < '$rolldateto' 
        GROUP BY LEFT(TIME,10) 
        ORDER BY LEFT(TIME,10) DESC;";
    //tradelog("Meta_NTR_Kota-Rate_3-760-Query:" . $query);
    $result = mysql_query($query) OR DIE(mysql_error());
    $rollovers = array();
    while ($row = mysql_fetch_array($result)) {
        $rollovers[] = $row[ROLLOVER];
    }
    for ($icount = 0; $icount < count($rollovers); $icount++) {
        $rollover = $rollovers[$icount];
        //tradelog("Meta_NTR_Kota-Rate_3-767-Rollover:" . $rollover);
        $worksheet1 = & $workbook->add_worksheet("OP_" . $rollover);

        $worksheet1->set_column(0, 0, 20);
        $worksheet1->set_column(0, 1, 20);
        $worksheet1->set_column(0, 2, 20);
        $worksheet1->set_column(0, 3, 20);
        $worksheet1->set_column(0, 4, 20);
        $worksheet1->set_column(0, 5, 20);
        $worksheet1->set_column(0, 6, 20);
        $worksheet1->set_column(0, 7, 20);
        $worksheet1->set_column(0, 8, 20);
        $worksheet1->set_column(0, 9, 20);
        $worksheet1->set_column(0, 10, 30);
        $worksheet1->set_column(0, 11, 30);
        $worksheet1->set_column(0, 12, 20);
        $worksheet1->set_column(0, 13, 20);
        $worksheet1->set_column(0, 14, 20);
        $worksheet1->set_column(0, 15, 20);
        $worksheet1->set_column(0, 16, 20);
        $worksheet1->set_column(0, 17, 20);
        $worksheet1->set_column(0, 18, 20);
        $worksheet1->set_row(0, 20);

        $i_row = 0;
        $i_column = 0;

        $worksheet1->write_string($i_row, 0, "", $fmenu);
        $worksheet1->write_string($i_row, 1, "", $fmenu);
        $worksheet1->write_string($i_row, 2, "", $fmenu);
        $worksheet1->write_string($i_row, 3, "Currency", $fmenu);
        $worksheet1->write_string($i_row, 4, "", $fmenu);
        $worksheet1->write_string($i_row, 5, "Buy Lot", $fmenu);
        $worksheet1->write_string($i_row, 6, "Buy AVG Price", $fmenu);
        $worksheet1->write_string($i_row, 7, "Sell Lot", $fmenu);
        $worksheet1->write_string($i_row, 8, "Sell AVG Price", $fmenu);
        $worksheet1->write_string($i_row, 9, "Net Open", $fmenu);
        $i_row++;
        $ftextright = $ftextright1;
        $fANGKA = $fANGKA1;

        $rolldateto3 = $rollover . " " . $totime;
        $query = "SELECT mt4_users.NAME,mt4_users.REGDATE,mt4_trades.* 
                    FROM " . $mysql[database] . ".acc_kota," . $mysql[meta] . ".mt4_trades
                        ," . $mysql[meta] . ".mt4_users    
                    WHERE 
                    mt4_trades.LOGIN = mt4_users.LOGIN 
                    and acc_kota.Login = mt4_trades.LOGIN 
                    and mt4_trades.cmd IN ('0','1') 
                    AND
                    (
                          (
                          LEFT(mt4_trades.OPEN_TIME,10)  <= '$rollover' 
                          AND 
                          mt4_trades.CLOSE_TIME ='1970-01-01 00:00:00'
                          )
                          OR
                          (
                          mt4_trades.OPEN_TIME  <= '$rolldateto3' 
                          AND
                          mt4_trades.CLOSE_TIME>'$rolldateto3'
                          )
                   )
                   " . $query_account;
        //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-843-Query:" . $query);
        $result = mysql_query($query) OR DIE(mysql_error());
        $newposition = 0;
        $open_lot = array();
        $open_price = array();
        $open_ticket = array();
        while ($row = mysql_fetch_array($result)) {
            $newposition = $newposition + $row[VOLUME] / 100;
            if ($row[CMD] == '0') {
                $open_lot[$row[SYMBOL]][buy] = $open_lot[$row[SYMBOL]][buy] + $row[VOLUME] / 100;
                $open_price[$row[SYMBOL]][buy] = $open_price[$row[SYMBOL]][buy] + ($row[VOLUME] / 100) * $row[OPEN_PRICE];
                $open_ticket[$row[SYMBOL]][$row[TICKET]] = $row;
            }
            if ($row[CMD] == '1') {
                $open_lot[$row[SYMBOL]][sell] = $open_lot[$row[SYMBOL]][sell] + $row[VOLUME] / 100;
                $open_price[$row[SYMBOL]][sell] = $open_price[$row[SYMBOL]][sell] + ($row[VOLUME] / 100) * $row[OPEN_PRICE];
                $open_ticket[$row[SYMBOL]][$row[TICKET]] = $row;
            }
            //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-469-ACCNO" . $ACCNO . ";Ticket:" . $row[TICKET] . ";Symbol:" . $row[SYMBOL] . ";Sell:" . $open_lot[$row[SYMBOL]][sell] . ";Buy:" . $open_lot[$row[SYMBOL]][buy]);
        }
        //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-636-Count Symbol:" . count($subsymbol));
        if (count($open_lot) > 0) {
            foreach ($open_lot AS $symbol => $data) {
                //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-619-:" . $symbol);
                $worksheet1->write_string($i_row, 3, $symbol, ftextright);

                $buy = 0;
                $buy = $open_lot[$symbol][buy];
                $worksheet1->write_number($i_row, 5, $buy, $fANGKA);

                $open_price_buy = 0;
                $open_price_buy = $open_price[$symbol][buy];
                if ($buy > 0) {
                    $buyavg = $open_price_buy / $buy;
                } else {
                    $buyavg = '';
                }
                $worksheet1->write_number($i_row, 6, $buyavg, $fANGKA);

                $sell = 0;
                $sell = $open_lot[$symbol][sell];
                $worksheet1->write_number($i_row, 7, $sell, $fANGKA);

                $open_price_sell = 0;
                $open_price_sell = $open_price[$symbol][sell];
                if ($sell > 0) {
                    $sellavg = $open_price_sell / $sell;
                } else {
                    $sellavg = '';
                }
                $worksheet1->write_number($i_row, 8, $sellavg, $fANGKA);

                $net = $buy - $sell;
                $worksheet1->write_number($i_row, 9, $net, $fANGKA);

                if ($ftextright == $ftextright1) {
                    $ftextright = $ftextright2;
                    $fANGKA = $fANGKA2;
                } else {
                    $ftextright = $ftextright1;
                    $fANGKA = $fANGKA1;
                }
                $i_row++;
            }
            $i_row++;
            $i_row++;
            $worksheet1->write_string($i_row, 0, "Name", $fmenu);
            $worksheet1->write_string($i_row, 1, "RegDate", $fmenu);
            $worksheet1->write_string($i_row, 2, "Login", $fmenu);
            $worksheet1->write_string($i_row, 3, "Currency", $fmenu);
            $worksheet1->write_string($i_row, 4, "Ticket", $fmenu);
            $worksheet1->write_string($i_row, 5, "Buy Lot", $fmenu);
            $worksheet1->write_string($i_row, 6, "", $fmenu);
            $worksheet1->write_string($i_row, 7, "Sell Lot", $fmenu);
            $worksheet1->write_string($i_row, 8, "", $fmenu);
            $worksheet1->write_string($i_row, 9, "OPEN Time", $fmenu);

            $i_row++;
            $ftextright = $ftextright1;
            $fANGKA = $fANGKA1;
            if (count($open_ticket) > 0) {
                foreach ($open_ticket AS $symbol => $ticket_array) {
                    if (count($ticket_array) > 0) {
                        foreach ($ticket_array AS $ticket => $data) {
                            //tradeLog("Meta_NTR_KOTA_GROUP_3_Excell-697-Symbol:" . $symbol . ";Ticket:" . $ticket);
                            $worksheet1->write_string($i_row, 0, $data[NAME], ftextright);
                            $worksheet1->write_string($i_row, 1, $data[REGDATE], ftextright);
                            $worksheet1->write_string($i_row, 2, $data[LOGIN], ftextright);
                            $worksheet1->write_string($i_row, 3, $symbol, ftextright);
                            $worksheet1->write_string($i_row, 4, $ticket, ftextright);
                            $qty = $data[VOLUME] / 100;
                            if ($data[CMD] == '0') {
                                $worksheet1->write_number($i_row, 5, $qty, $fANGKA);
                            } else {
                                $worksheet1->write_number($i_row, 7, $qty, $fANGKA);
                            }
                            $worksheet1->write_string($i_row, 9, $data[OPEN_TIME], ftextright);
                            if ($ftextright == $ftextright1) {
                                $ftextright = $ftextright2;
                                $fANGKA = $fANGKA2;
                            } else {
                                $ftextright = $ftextright1;
                                $fANGKA = $fANGKA1;
                            }
                            $i_row++;
                        }
                    }
                }
            }
        } else {
            $worksheet1->write_string($i_row, 0, "No Product Open", ftextright);
            $worksheet1->write_string($i_row, 1, "", ftextright);
            $worksheet1->write_string($i_row, 2, "", ftextright);
            $worksheet1->write_string($i_row, 3, "", ftextright);
            $worksheet1->write_string($i_row, 4, "", ftextright);
            $worksheet1->write_string($i_row, 5, "", ftextright);
            $worksheet1->write_string($i_row, 6, "", ftextright);
            $worksheet1->write_string($i_row, 7, "", ftextright);
            $worksheet1->write_string($i_row, 8, "", ftextright);
            $worksheet1->write_string($i_row, 9, "", ftextright);
        }
    }
    $workbook->close();
}
?>
