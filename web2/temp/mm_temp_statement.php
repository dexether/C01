<?php

//include("html_encoder_1.9.php");
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

include_once("includes/wr_tools.php");
$lines = "a=1";

$var_to_pass = null;


switch ($user->groupid) {
    case "1":
        $username = $user->username;
        $account = $username;
        $accounts[] = $username;
        break;

    case "2":
        $username = $user->username;
        $account = $username;
        $accounts[] = $username;
        break;

    case "3": //AECode Select
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;
    case "4": //AECode View
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;
    case "5": //AECode Show All
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;
    case "6":
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;

    case "7":
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;

    case "8":
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;

    case "9":
        $account = $_GET[account];
        $query = "SELECT S_ACCNO AS AccNo FROM " . $mysql[meta] . ".copytrade 
            GROUP BY S_ACCNO ORDER BY S_ACCNO ASC";
        $result = $DB->query($query);
        while ($row = $DB->fetch_array($result)) {
            //tradelog("mm_temp_statement-65:");
            $accounts[] = trim($row[AccNo]);
        }

        break;

    case "10":
        break;
    case "11": //Group Code
        $query = "SELECT AccNo FROM bafile WHERE bafile." . $user->tradingtype . " = '$user->userfield_group'";
        //tradelog($query);
        $result = $DB->query($query);
        while ($row = $DB->fetch_array($result)) {
            $accounts[] = trim($row[AccNo]);
        }
        break;
    case "12":
        $username = $user->getUsername();
        $accounts = fetchAccounts($username);
        $account = $accounts[0]; // Make account default
        break;
    case "14":
        $username = $user->getUsername();
        $query = "SELECT USER.accountclientselect FROM USER WHERE username = '$username'";
        $result = $DB->query($query);
        while ($row = $DB->fetch_array($result)) {
            $accountpanjang = $row[accountclientselect];
            ////tradelog("mainmenu-67-accountpanjang:" . $accountpanjang);
            $accounts = explode(",", $accountpanjang); //a=1&account=802222&
            $account = $accounts[0]; // Make account default
        }
        break;
    case "15":
        $username = $user->getUsername();
        $query = "SELECT USER.mmselect FROM USER WHERE username = '$username'";
        //tradeLog("mm_temp_statement-89:" . $query);
        $result = $DB->query($query);
        while ($row = $DB->fetch_array($result)) {
            $accountpanjang = $row[mmselect];
            //tradelog("mainmenu-67-accountpanjang:" . $accountpanjang);
            $implode_username = explode(",", $accountpanjang); //a=1&account=802222&
        }
        //$implode_username[] = trim($row[username]);

        $where = " S_ACCNO in ('" . implode("','", $implode_username) . "')";
        //tradeLog("mm_temp_statement-99:" . $where);

        $query = "SELECT S_ACCNO AS AccNo FROM " . $mysql[meta] . ".copytrade 
            WHERE $where
            GROUP BY S_ACCNO ORDER BY S_ACCNO ASC";
        //tradeLog("mm_temp_statement-103:" . $query);
        $result = $DB->query($query);
        while ($row = $DB->fetch_array($result)) {
            $accountpanjang = $row[accountclientselect];
            //tradelog("mainmenu-93-accountpanjang:" . $row[AccNo]);
            $accounts[] = $row[AccNo];
        }
        break;
        break;
}
//tradelog("mm_temp_statement-125=".$user->groupid.";".$query.";".$accounts[0]);
$template->assign("accounts", $accounts);
$template->assign("user", $user);

$query = "SELECT copytrade.M_LOGIN FROM " . $mysql[meta] . ".copytrade GROUP BY M_LOGIN ORDER BY M_LOGIN ASC";
//tradelog("mainmenu-118-Query:" . $query);
$result = $DB->query($query);
while ($row = $DB->fetch_array($result)) {
    $loginpanjang[] = $row[M_LOGIN];
}

$where = " LOGIN in ('" . implode("','", $loginpanjang) . "')";


$datesearch = $_GET[datesearch2];
$hariini = date('l jS \of F Y h:i:s A');
//tradelog("mm_temp_statement-353:".$hariini);
$template->assign("hariini", $hariini);

$printing = $_GET[printing];
if ($printing != 'yes') {
    $printing = "no";
}
$template->assign("printing", $printing);

/* * ***************************************************************************
 * SELECT ACCOUNT                                                             *
 * *************************************************************************** */
if ($mysql[crypt_key] != '') {
    $crypt_key = $mysql[crypt_key];
}
$tools = new CTools();

if (!empty($_GET[account])) {
    $account = $_GET[account];
} else {
    $key = $_GET[key];
    //tradelog("temp_statement.php-115-key=".$key);
    $data = base64_decode(str_replace(array('123', ','), array('+', '/'), $key));
    $data = explode("\n", gzuncompress($tools->Crypt($data, $crypt_key)));
    $variabel = explode("&", $data[0]); //a=1&account=802222&
    $accountlink = $variabel[1]; //account=1234567
    $accountvariabel = explode("=", $accountlink);
    $account = $accountvariabel[1];
    //tradelog("temp_statement.php-121=".$account);
    $template->assign("key", $key);
}
$query = "SELECT LEFT(modify_time,10) AS datesearch 
    FROM " . $mysql[meta] . ".mt4_prices 
    GROUP BY modify_time ORDER BY modify_time DESC LIMIT 0,1";
$result = $DB->query($query);
while ($row = $DB->fetch_array($result)) {
    $datesearch = $row[datesearch];
}

if (!empty($account) && !empty($_GET[account])) {
    //tradelog("mt_daily_statement.php-130=".$account);
    if ($account == "all") {
        for ($i = 0; $i < count($accounts); $i++) {
            $datesearchtime = $datesearch . " 23:59:59";
            $query = "SELECT accno,cuttime,VALUE,stoptime FROM cutmargin WHERE accno='$accounts[$i]' order by cuttime desc limit 0,1";
            //tradeLog("174;query:" . $query);
            $result = $DB->query($query);
            while ($row = $DB->fetch_array($result)) {
                $margincut = $row[VALUE];
                $stoptime = $row[stoptime];
                $cuttime = $row[cuttime];
            }
            $statements[$accounts[$i]] = fetch_TempStatement($accounts[$i], $datesearch, $mysql[meta], $mysql[database], $stoptime);
        }
    } else {
        $datesearchtime = $datesearch . " 23:59:59";
        $query = "SELECT accno,cuttime,VALUE,stoptime FROM cutmargin WHERE accno='$account' order by cuttime desc limit 0,1";
        //tradeLog("185;query:" . $query);
        $result = $DB->query($query);
        while ($row = $DB->fetch_array($result)) {
            $margincut = $row[VALUE];
            $stoptime = $row[stoptime];
            $cuttime = $row[cuttime];
        }
        //tradeLog("MM_temp_Statement-191-Start Function");
        $statements[$account] = fetch_TempStatement($account, $datesearch, $mysql[meta], $mysql[database], $stoptime);
        //tradeLog("MM_temp_Statement-193-End Function");
    }// else from if ($account == "all") {

    $query = "select client_accounts.* from client_accounts where client_accounts.accountname = '$account'";
    //tradeLog("MM_temp_Statement-197=" . $query);
    $result = $DB->query($query);
    while ($row = $DB->fetch_array($result)) {
        $accountid = $row[accountid];
    }
    $statements[$account][status][BALANCE_PREV] = 0;
    $query = "select client_balance.* 
        from client_balance  
        where client_balance.accountid = '$accountid'   
        and client_balance.rolldate < '$datesearch' order by client_balance.rolldate desc limit 0,1";
    //tradeLog("MM_temp_Statement-221=" . $query);
    $result = $DB->query($query);
    while ($row = $DB->fetch_array($result)) {
        $statements[$account][status][BALANCE_PREV] = $row[balance] / 100;
    }
    $statements[$account][status][MARGININ] = 0;
    $statements[$account][status][MARGINOUT] = 0;
    $statements[$account][status][MARGIN] = 0;
    $statements[$account][status][adjustment] = 0;
    $statements[$account][status][EQUITY] = 0;
    $statements[$account][status][MARGIN_FREE] = 0;


    $query = "SELECT client_margin.* FROM client_margin,client_accounts
                WHERE client_accounts.accountname = '$account' 
                AND client_accounts.accountid = client_margin.accountid 
                AND client_margin.rolldate ='$datesearch'";
//tradeLog("MM_temp_Statement-241=" . $query);
    $result = $DB->query($query);
    while ($row = $DB->fetch_array($result)) {
        //tradeLog("MM_temp_Statement-236=" . $account . ";" . $statements[$account][status][MARGININ] . ";" . $row[amount] / 100);
        if ($row[margin_type] == 'MARGIN_IN') {
            $statements[$account][status][MARGININ] = $statements[$account][status][MARGININ] + $row[amount] / 100;
            //tradeLog("MM_temp_Statement-238=" . $row[margin_type] . ";" . $row[amount]);
        }
        if ($row[margin_type] == 'ADJUSTMENT_IN') {
            $statements[$account][status][adjustment] = $statements[$account][status][adjustment] + $row[amount] / 100;
            //tradeLog("MM_temp_Statement-238=" . $row[margin_type] . ";" . $row[amount]);
        }
        //tradeLog("MM_temp_Statement-240=" . $account . ";" . $statements[$account][status][MARGININ] . ";" . $row[amount] / 100);
        if ($row[margin_type] == 'MARGIN_OUT') {
            $statements[$account][status][MARGINOUT] = $statements[$account][status][MARGINOUT] - $row[amount] / 100;
            //tradeLog("MM_temp_Statement-242=" . $row[margin_type] . ";" . $row[amount]);
        }
        if ($row[margin_type] == 'ADJUSTMENT_OUT') {
            $statements[$account][status][adjustment] = $statements[$account][status][adjustment] - $row[amount] / 100;
            //tradeLog("MM_temp_Statement-242=" . $row[margin_type] . ";" . $row[amount]);
        }
        //tradeLog("MM_temp_Statement-244=" . $account . ";" . $statements[$account][status][MARGININ] . ";" . $row[amount] / 100);
    }
//tradeLog("MM_temp_Statement-246=" . $account . ";" . $statements[$account][status][MARGININ]);
//$statements[$account][status][floatingsemua] = $statements[$account][status][floatingsemua] - $statements[$account][floatingsemua];
    $statements[$account][status][EQUITY] = $statements[$account][status][EQUITY] - $statements[$account][EQUITY];

    //tradeLog("MM_temp_Statement-268=" . $statements[$account][status][BALANCE_PREV] . ";" . $statements[$account][status][MARGININ]);
    $statements[$account][status][EQUITY] = $statements[$account][status][BALANCE_PREV] + $statements[$account][status][MARGININ];
    //tradeLog("MM_temp_Statement-269=" . $statements[$account][status][EQUITY] . ";" . $statements[$account][status][MARGINOUT]);
    $statements[$account][status][EQUITY] = $statements[$account][status][EQUITY] + $statements[$account][status][MARGINOUT];
    //tradeLog("MM_temp_Statement-270=" . $statements[$account][status][EQUITY] . ";" . $statements[$account][status][PL]);
    $statements[$account][status][EQUITY] = $statements[$account][status][EQUITY] + $statements[$account][status][PL];

    //tradeLog("MM_temp_Statement-272=" . $statements[$account][status][EQUITY] . ";" . $statements[$account][status][interest]);
    $statements[$account][status][EQUITY] = $statements[$account][status][EQUITY] + $statements[$account][status][interest];
    //tradeLog("MM_temp_Statement-273=" . $statements[$account][status][EQUITY] . ";" . $statements[$account][status][commission]);
    $statements[$account][status][EQUITY] = $statements[$account][status][EQUITY] + $statements[$account][status][commission];
    //tradeLog("MM_temp_Statement-274=" . $statements[$account][status][EQUITY] . ";" . $statements[$account][status][adjustment]);
    $statements[$account][status][EQUITY] = $statements[$account][status][EQUITY] + $statements[$account][status][adjustment];
    //tradeLog("MM_temp_Statement-275=" . $statements[$account][status][EQUITY]);

    $statements[$account][status][MARGINCUT] = $margincut;
    $statements[$account][status][STOPTIME] = $stoptime;


    $query = "delete from client_balance where client_balance.accountid = '$accountid' and rolldate='$datesearch'";
    //tradeLog("MM_temp_Statement-265=" . $query);
    $result = $DB->query($query);
    $balance = $statements[$account][status][EQUITY] * 100;
    $query = "insert into client_balance set accountid = '$accountid', rolldate = '$datesearch',
        balance='$balance'";
    $result = $DB->query($query);

    //tradeLog("MM_temp_Statement-273=" . $account . ";" . $statements[$account][status][MARGIN_FREE]);
    $tot_margin = 0;
    if (count($marginreg) > 0) {
        foreach ($marginreg AS $symbol => $action) {
            $symbolbuy = $action[buy];
            $symbolsell = $action[sell];
            //tradeLog("MM_temp_Statement-300=" . $symbol . ";Buy:" . $symbolbuy . ";Sell:" . $symbolsell);
            if ($symbolsell <= $symbolbuy) {
                $qty_hedging = $symbolsell;
            } else if ($symbolbuy <= $symbolsell) {
                $qty_hedging = $symbolbuy;
            }
            $qty_normal = $symbolbuy - $symbolsell;
            if ($qty_normal < 0) {
                $qty_normal = $qty_normal * -1;
            }
            //tradeLog("MM_temp_Statement-310=" . $symbol . ";Buy:" . $symbolbuy . ";Sell:" . $symbolsell . ";Hedging:" . $qty_hedging . ";Open:" . $qty_normal);
            $query = "select * from counter_com where counter = '$symbol' order by rolldate desc limit 0,1 ";
            $result = $DB->query($query);
            while ($row = $DB->fetch_array($result)) {
                $hedge = $row[hedge];
                $marginnight = $row[marginnight];
            }
            $sub_margin_hedge = $hedge * $qty_hedging;
            $sub_margin_open = $marginnight * $qty_normal;
            //tradeLog("MM_temp_Statement-319=" . $symbol . ";Hedge:" . $qty_hedging . ";" . $hedge . ";Open:" . $qty_normal . ";" . $marginnight);
            $tot_margin = $tot_margin + $sub_margin_hedge + $sub_margin_open;
        }//foreach ($marginreg AS $symbol => $action) {
    }//if(count($marginreg)>0){

    $statements[$account][status][MARGIN] = $tot_margin;

    if ($statements[$account][status][MARGIN] == '0') {
        $statements[$account][status][eqratio] = "~%";
    } else {
        $statements[$account][status][eqratio] = number_format($statements[$account][status][EQUITY] * 100 / $statements[$account][status][MARGIN], 2, ".", "") . "%";
        //tradelog("mm_temp_statement-242-Equity:" . $status[EQUITY] . ";Margin:" . $status[MARGIN]);
    }

    $statements[$account][status][MARGIN_FREE] = $statements[$account][status][EQUITY] + $statements[$account][status][floatingPL] - $statements[$account][status][MARGIN];

    if ($margincut > $statements[$account][status][MARGIN_FREE] && $stoptime == '2099-12-31 00:00:00') {
        $lognow = date('Y-m-d H:i:s', strtotime('-1 hour'));
        //tradeLog("MM_temp_Statement-325-MarginCut:" . $margincut . ";MarginFree:" . $statements[$account][status][MARGIN_FREE].";StopTime:".$stoptime.";Now:".$lognow);

        $query = "update cutmargin set stoptime='$lognow' where cuttime='$cuttime' and accno='$account' ";
        //tradeLog("MM_temp_Statement-328-Query:" . $query);
        $result = $DB->query($query);


        if (count($thesymbols) > 0) {
            foreach ($thesymbols AS $symbol => $theval) {
                //tradeLog("MM_temp_Statement-332-Symbol:" . $symbol);
                $query = "delete from cutmargin_price where symbol='$symbol' and time = '$lognow'";
                $result = $DB->query($query);
                //tradeLog("MM_temp_Statement-335-Query:" . $query);
                $query = "SELECT * FROM " . $mysql[meta] . ".mt4_prices WHERE SYMBOL = '$symbol'";
                $result = $DB->query($query);
                while ($row = $DB->fetch_array($result)) {
                    $cutsymbol[$symbol][BID] = $row[BID];
                    $cutsymbol[$symbol][ASK] = $row[ASK];
                    //tradeLog("MM_temp_Statement-341-Symbol:" . $symbol.";BID:".$row[BID].";ASK:".$row[ASK]);
                }

                $query = "insert into cutmargin_price set 
                    SYMBOL = '$symbol',
                    TIME = '$lognow',
                    BID = '" . $cutsymbol[$symbol][BID] . "',
                    ASK='" . $cutsymbol[$symbol][ASK] . "'";
                $result = $DB->query($query);
                //tradeLog("MM_temp_Statement-349-Query:" . $query);
            }
        }
    }
}//if (!empty($account) && !empty($_GET[account])) {


if ($account == '') {
    display_error("321. You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
}
if ($account[0] == '') {
    display_error("324. You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
} else {
    if (!empty($account) && $account != "all") {
        if (!in_array($account, $accounts)) {
            if ($user->groupid == '9' || $user->groupid == '15') {
                
            } else {
                display_error("331. You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
            }
        }
    }
}


$template->assign("account", $account);
$template->assign("mm_accs", $mm_accs);

$accountkey = "a=1&account=" . $account;
$linezip = gzcompress($accountkey);
$key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));
$template->assign("key", $key);

$template->assign("statements", $statements);
$template->assign("statements_closing", $statements_closing);
//mysql_free_result($result);
$template->display("mm_temp_statement.htm");


/* * ***************************************************************************
 * FUNCTIONS                                                                   *
 * *************************************************************************** */

function fetch_TempStatement($s_accno, $datesearch, $mysql_meta, $mysql_database, $stoptime) {
    global $DB;
    global $marginreg;
    global $mm_accs;
    global $thesymbols;
    global $username;
    $statement = array();
    // Get reminding Account Status Details

    /*==============================
    =            Tarikh            =
    ==============================*/
    
    $tarikh = "SELECT 
    accountclientselect 
    FROM
    USER 
    WHERE username = '$username'";
    $result = $DB->query($tarikh);
    while ($row = $DB->fetch_array($result)) {
        $accountlist = $row[0];
    }
    $pecah = explode(',', $accountlists);
    $acc_arrnya = null;
    for ($i_acc = 0; $i_acc < count($pecah); $i_acc++) {
        $acc_arrnya = $acc_arrnya . ",'" . $pecah[$i_acc] . "'";
    }
    $acc_arr = "(''" . $acc_arrnya . ")";
    
    
    /*=====  End of Tarikh  ======*/
    

   
            
    $query = "SELECT M_LOGIN,M_SYMBOL,S_ACCNO,S_VOLUME,S_CMD,S_SYMBOL,liquidticket,
        opendate,active 
        FROM  " . $mysql_meta . ".copytrade 
        WHERE S_ACCNO='$s_accno' AND M_LOGIN in $acc_arr 
        AND active = 'yes' 
        ORDER BY M_LOGIN ASC,M_SYMBOL ASC 
        ";
    //tradeLog("341;query:" . $query);
    $result = $DB->query($query);
    while ($row = $DB->fetch_array($result)) {
        $mm_accs[$row[M_LOGIN]][copytrade][] = $row;
    }
    if (count($mm_accs) > 0) {
        foreach ($mm_accs AS $account => $mm_acc) {

            $query = "SELECT " . $mysql_meta . ".mt4_users.* 
            FROM " . $mysql_meta . ".mt4_users 
            WHERE login ='$account' ";
            //tradeLog("246;query:" . $query);
            $result = $DB->query($query);
            while ($row = $DB->fetch_array($result)) {
                $mm_accs[$account][status] = $row;
                $mm_accs[$account][status][user_decimal] = '2';
            }
            //tradelog("mm_temp_statement-211-Equity:" . $mm_accs[$account][status][EQUITY] . ";PrevBalance:" . $mm_accs[$account][status][PREVBALANCE] . ";PL:" . $mm_accs[$account][status][PL] . ";MarginIn:" . $mm_accs[$account][status][MARGININ] . ";MarginOut:" . $mm_accs[$account][status][MARGINOUT]);
            //apakah ada All
            $copytrades = $mm_acc[copytrade];
            $ada_all = 'tidak';
            $gabungan_product = "'";
            $copytrade_s_cmd = array();
            $copytrade_s_vol = array();
            for ($icount = 0; $icount < count($copytrades); $icount++) {
                //M_LOGIN,M_SYMBOL,S_ACCNO,S_VOLUME,S_CMD,S_SYMBOL,liquidticket,opendate,active
                $M_SYMBOL = $copytrades[$icount][M_SYMBOL];
                //tradelog("MM_tempstatement-261=" . $account.";Symbol:".$M_SYMBOL);
                if (strtoupper($M_SYMBOL) == 'ALL') {
                    $ada_all = 'ada';
                } else {//if(strtoupper($M_SYMBOL)=='ALL'){                
                    $gabungan_product = $gabungan_product . $M_SYMBOL . "','";
                }
                $copytrade_s_cmd[strtoupper($M_SYMBOL)] = strtoupper($copytrades[$icount][S_CMD]);
                $copytrade_s_vol[strtoupper($M_SYMBOL)] = strtoupper($copytrades[$icount][S_VOLUME]);
            }//for ($icount = 0; $icount < count($copytrades); $icount++) {
            $gabungan_product = $gabungan_product . "'";
            //tradelog("MM_tempstatement-224-GabunganProduct:" . $gabungan_product);
            if ($ada_all == 'ada') {
                $gabungan_product = " ";
            } else {
                $gabungan_product = " and SYMBOL in ($gabungan_product)";
            }
            //tradelog("MM_tempstatement-277-GabunganProduct:" . $account.";".$gabungan_product);
            //end apakah ada all

            if ($stoptime != '') {
                $query = "SELECT *,mt4_trades.VOLUME as VOLUME2 FROM " . $mysql_meta . ".mt4_trades 
                    WHERE cmd IN ('0','1') 
                    $gabungan_product    
                    and login = '" . $account . "'  
                    AND 
                    (
                        (
                            LEFT(CLOSE_TIME,10) > '" . $datesearch . "' 
                            AND LEFT(OPEN_TIME,10) <= '" . $datesearch . "' 
                            and OPEN_TIME<'$stoptime'     
                        )
                        OR 
                        (
                            CLOSE_TIME ='1970-01-01 00:00:00'
                            AND LEFT(OPEN_TIME,10) <= '" . $datesearch . "'  
                            and OPEN_TIME<'$stoptime'      
                        )
                        OR 
                        ( 
                                CLOSE_TIME >'$stoptime' 
                                AND LEFT(OPEN_TIME,10) <= '$datesearch' 
                                AND OPEN_TIME<='$stoptime' 
                        ) 
                    ) 
                    ORDER BY TICKET DESC;";
            } else {
                $query = "SELECT *,mt4_trades.VOLUME as VOLUME2 FROM " . $mysql_meta . ".mt4_trades 
                    WHERE cmd IN ('0','1') 
                    $gabungan_product    
                    and login = '" . $account . "'  
                        AND 
                    (
                        (LEFT(CLOSE_TIME,10) > '" . $datesearch . "' AND LEFT(OPEN_TIME,10) <= '" . $datesearch . "')
                        OR 
                        (
                        CLOSE_TIME ='1970-01-01 00:00:00'
                        AND LEFT(OPEN_TIME,10) <= '" . $datesearch . "'        
                        )
                    ) 
                    ORDER BY TICKET DESC;";
            }

            //tradelog("mm_temp_statement-444=" . $query);
            $result = $DB->query($query);
            while ($row = $DB->fetch_array($result)) {
                $symbols_array[] = $row[SYMBOL];
                $row[ACCNO] = $row[LOGIN];
                //tradelog("mm_temp_statement-185-ACCNO:" . $row[ACCNO]);
                //M_LOGIN,M_SYMBOL,S_ACCNO,S_VOLUME,S_CMD,S_SYMBOL,liquidticket,opendate,active
                if ($ada_all == 'ada') {
                    $s_cmd = $copytrade_s_cmd[ALL];
                    $s_vol = $copytrade_s_vol[ALL];
                } else {
                    $s_cmd = $copytrade_s_cmd[$row[SYMBOL]];
                    $s_vol = $copytrade_s_vol[$row[SYMBOL]];
                }
                //tradelog("mm_temp_statement-258-ACCNO:" . $row[ACCNO].";S_CMD:".$s_cmd.";S_VOL:".$s_vol);
                if ($s_cmd == 'REVERSE') {
                    if ($row[CMD] == '0') {
                        $row[CMD] = '1';
                        $row[BuyPrice] = '';
                        $row[SellPrice] = $row[OPEN_PRICE];
                    } else {
                        $row[CMD] = '0';
                        $row[BuyPrice] = $row[OPEN_PRICE];
                        $row[SellPrice] = '';
                    }
                    $row[PROFIT] = $row[PROFIT] * -1;
                }
                //tradelog("mm_temp_statement-270-Ticket:" . $row[TICKET].";Profit:".$row[PROFIT]);
                $row[VOLUME] = $row[VOLUME2];
                //tradelog("mm_temp_statement-473-Vol:" . $row[VOLUME] . ";Vol2:" . $row[VOLUME2] . ";" . $s_vol);
                $row[S_VOL] = $s_vol;
                $mm_accs[$account][positions][] = $row;
            }
            $row[VOLUME] = 0;
            $row[S_VOL] = 0;

            if ($stoptime != '') {
                $query = "SELECT left(mt4_trades.OPEN_TIME,10) as checkopen,left(mt4_trades.CLOSE_TIME,10) as checkclose,mt4_trades.* 
                            FROM " . $mysql_meta . ".mt4_trades 
                            WHERE login ='$account' 
                            $gabungan_product     
                            AND CMD IN ('0','1') 
                            AND LEFT(CLOSE_TIME,10) = '$datesearch'    
                            and CLOSE_TIME<='$stoptime'     
                            order by  mt4_trades.TICKET desc      
                            ";
            } else {
                $query = "SELECT left(mt4_trades.OPEN_TIME,10) as checkopen,left(mt4_trades.CLOSE_TIME,10) as checkclose,mt4_trades.* 
                            FROM " . $mysql_meta . ".mt4_trades 
                            WHERE login ='$account' 
                            $gabungan_product     
                            AND CMD IN ('0','1') 
                            AND LEFT(CLOSE_TIME,10) = '$datesearch'    
                            order by  mt4_trades.TICKET desc      
                            ";
            }

            //tradeLog("MM_temp_Statement-336=" . $query);
            $result = $DB->query($query);
            while ($row = $DB->fetch_array($result)) {
                $row[ACCNO] = $row[LOGIN];
                //tradelog("Temp_Statement-185-ACCNO:" . $row[ACCNO]);
                //M_LOGIN,M_SYMBOL,S_ACCNO,S_VOLUME,S_CMD,S_SYMBOL,liquidticket,opendate,active
                if ($ada_all == 'ada') {
                    $s_cmd = $copytrade_s_cmd[ALL];
                    $s_vol = $copytrade_s_vol[ALL];
                } else {
                    $s_cmd = $copytrade_s_cmd[$row[SYMBOL]];
                    $s_vol = $copytrade_s_vol[$row[SYMBOL]];
                }
                //tradelog("mm_temp_statement-296-ACCNO:" . $row[ACCNO].";S_CMD:".$s_cmd.";S_VOL:".$s_vol);
                if ($s_cmd == 'REVERSE') {
                    if ($row[CMD] == '0') {
                        $row[CMD] = '1';
                        $row[BuyPrice] = '';
                        $row[SellPrice] = $row[OPEN_PRICE];
                        //tradelog("mm_temp_statement-301-Ticket:" . $row[TICKET].";Profit:".$row[PROFIT]);
                    } else {
                        $row[CMD] = '0';
                        $row[BuyPrice] = $row[OPEN_PRICE];
                        $row[SellPrice] = '';

                        //tradelog("mm_temp_statement-304-Ticket:" . $row[TICKET].";Profit:".$row[PROFIT]);
                    }
                    $row[PROFIT] = $row[PROFIT] * -1 * $s_vol;
                } else {
                    if ($row[CMD] == '1') {
                        $row[BuyPrice] = '';
                        $row[SellPrice] = $row[OPEN_PRICE];
                    } else {
                        $row[CMD] = '0';
                        $row[BuyPrice] = $row[OPEN_PRICE];
                        $row[SellPrice] = '';
                    }
                    $row[PROFIT] = $row[PROFIT] * $s_vol;
                }
                //tradelog("mm_temp_statement-460-Ticket:" . $row[TICKET] . ";Profit:" . $row[PROFIT]);
                $row[S_VOL] = $s_vol;
                $row[Unit] = $row[VOLUME] / 100 * $s_vol;

                /*
                  //tradelog("mm_temp_statement-530-Vol:" . $row[Unit] . ";Vol2:" . $row[VOLUME] . ";" . $s_vol);
                  $query = "SELECT client_accounts.accountname,counter_account.*
                  FROM counter_account,client_accounts
                  WHERE counter_account.`accountid` = client_accounts.accountid
                  AND client_accounts.accountname = '$s_accno'
                  AND counter_account.rolldate <= '$datesearch'
                  AND counter_account.counter = '$row[SYMBOL]'
                  ORDER BY counter_account.rolldate DESC LIMIT 0,1";
                  //tradelog("mm_temp_statement-543-Query:" . $query);
                  $result2 = $DB->query($query);
                  while ($row2 = $DB->fetch_array($result2)) {
                  $row[COMMISSION] = $row2[close_comm] / 100;
                  $row[COMMISSION_OPEN] = $row2[open_comm] / 100;
                  if($row[checkopen]==$row[checkclose]){
                  $row[COMMISSION] = $row[COMMISSION] + $row[COMMISSION_OPEN];
                  }
                  }
                 */
                $row[COMMISSION] = $row[COMMISSION] * $s_vol;
                $row[COMMISSION] = 0;
                $komisi = $row[COMMISSION];
                //tradelog("mm_temp_statement-563-Komisi:" . $komisi . ";SubKomisi:" . $statement[status][commission] );
                $statement[status][commission] = $statement[status][commission] + $komisi;

                $row[SWAPS] = $row[SWAPS] * $s_vol;
                if ($s_cmd == 'REVERSE') {
                    $row[SWAPS] = $row[SWAPS] * -1;
                }
                $swaps = $row[SWAPS];
                $statement[status][interest] = $statement[status][interest] + $swaps;

                $mm_accs[$account][settled][] = $row;
                $statement[status][PL] = $statement[status][PL] + $row[PROFIT];



                $statement[status][commission] = $statement[status][commission] + $row[COMMISSION] * $row[Unit];

                $statement[settled][] = $row;
            }//end while
            //tradelog("mm_temp_statement-470-PL:" . $statement[status][PL]);

            $positions = $mm_accs[$account][positions];
            if (count($positions) > 0) {
                for ($i_symbol = 0; $i_symbol < count($symbols_array); $i_symbol++) {
                    $symbol = $symbols_array[$i_symbol];
                    $query_symbol = $query_symbol . ",'" . $symbol . "'";
                }


                $query = "SELECT * FROM counter_com 
                    WHERE counter in (''" . $query_symbol . ")";
                //tradelog("mt4_users_statement-450-query=" . $query);
                $result = $DB->query($query);
                while ($row = $DB->fetch_array($result)) {
                    $lotsize[$row[counter]] = $row[lotsize];
                    $calc_type[$row[counter]] = $row[calc_type];
                    $counternya[$row[counter]] = $row;
                }
                $query = "SELECT BID,ASK,SYMBOL FROM " . $mysql_meta . ".mt4_prices WHERE SYMBOL in (''" . $query_symbol . ")";
                //tradelog("mt4_users_statement-555-query=" . $query);
                $result = $DB->query($query);
                while ($row = $DB->fetch_array($result)) {
                    $tinggi[$row[SYMBOL]] = $row[BID];
                    $rendah[$row[SYMBOL]] = $row[ASK];
                }

                //$positions = array_reverse($positions);
                foreach ($positions AS $row) {
                    while (list($key, $val) = each($row)) {
                        $row[$key] = trim($val);
                    }
                    //tradeLog("MM_temp_Statement-571-Unit:" . $row[Unit] . ";" . $row[VOLUME] . ";S_Vol:" . $row[S_VOL]);

                    $counter_decimal = $row[DIGITS] + 1;
                    $open_time = substr($row[OPEN_TIME], 0, 10);
                    $row[Unit] = $row[VOLUME] / 100 * $row[S_VOL];

                    if ($open_time == $datesearch) {
                        //isi disini counter_account
                        $query = "SELECT client_accounts.accountname,counter_account.* 
                        FROM counter_account,client_accounts 
                        WHERE counter_account.`accountid` = client_accounts.accountid 
                        AND client_accounts.accountname = '$s_accno' 
                        AND counter_account.rolldate <= '$datesearch' 
                        AND counter_account.counter = '$row[SYMBOL]' 
                        ORDER BY counter_account.rolldate DESC LIMIT 0,1";
                        $result = $DB->query($query);
                        while ($row2 = $DB->fetch_array($result)) {
                            $row[COMMISSION] = $row2[open_comm] / 100;
                        }
                        $row[Commission] = number_format($row[COMMISSION] * $row[Unit], 2, ".", "");
                    } else {
                        $row[COMMISSION] = 0;
                        $row[Commission] = number_format($row[COMMISSION] * $row[Unit], 2, ".", "");
                    }

                    $row[FLCOMM] = number_format($row[COMMISSION], 2, ".", "");
                    $row[PL] = number_format($row[PROFIT] * $row[S_VOL], 2, ".", "");

                    //tradeLog("MM_temp_Statement-585-Unit:" . $row[Unit] . ";" . $row[VOLUME] . ";S_Vol:" . $row[S_VOL]);

                    if ($row[CMD] == '0') {
                        $row[CurrentPrice] = $rendah[$row[SYMBOL]];
                    } else {
                        $row[CurrentPrice] = $tinggi[$row[SYMBOL]];
                    }

                    //tradeLog("MM_temp_Statement-539=" . $row[TICKET] . ";Symbol:" . $row[SYMBOL] . ":" . $rendah[$row[SYMBOL]] . ";" . $tinggi[$row[SYMBOL]] . ";" . $row[CurrentPrice]);
                    $interval = date_diff($open_time, $datesearch);
                    //tradeLog("MM_temp_Statement-541=" . $row[TICKET] . ";Open:" . $open_time . ";Close:" . $datesearch . ";Interval:" . $interval.";CMD:".$row[CMD]);

                    if ($row[CMD] == '0') {
                        $row[Floating] = ($row[CurrentPrice] - $row[BuyPrice]) * $row[Unit] * $lotsize[$row[SYMBOL]];
                        //tradelog("mt4_users_statement-545-Lotsize:" . $lotsize[$row[SYMBOL]] . ";Calc Type:" . $calc_type[$row[SYMBOL]]);
                        $query = "SELECT client_accounts.accountname,counter_account.* 
                                    FROM counter_account,client_accounts 
                                    WHERE counter_account.`accountid` = client_accounts.accountid 
                                    AND client_accounts.accountname = '$s_accno' 
                                    AND counter_account.rolldate <= '$datesearch' 
                                    AND counter_account.counter = '$row[SYMBOL]' 
                                    ORDER BY counter_account.rolldate DESC LIMIT 0,1";
                        $result = $DB->query($query);
                        while ($row2 = $DB->fetch_array($result)) {
                            $counternya[$row2[counter]][interestbuy] = $row2[interestbuy];
                            $counternya[$row2[counter]][interestsell] = $row2[interestsell];
                            $counternya[$row2[counter]][storagebuy] = $row2[storagebuy];
                            $counternya[$row2[counter]][storagesell] = $row2[storagesell];
                            //tradelog("mt4_daily_statement-643-Int:" . $counternya[$row2[counter]][interestbuy] . ";query=" . $query);
                        }
                        if ($calc_type[$row[SYMBOL]] == "1") {  //usd_xxx.php
                            $open_price = 1;
                            if ($counternya[$row[SYMBOL]][interestbuy] <> 0) {
                                $interest = (($row[Unit] * $lotsize[$row[SYMBOL]] * $counternya[$row[SYMBOL]][interestbuy] / 100 * $row[BuyPrice] / 100) / $counternya[$row[SYMBOL]][interest_day_year] * $interval);
                                $interest = round($interest);
                            } else {
                                $interest = 0;
                            }
                            //tradelog("mt4_users_statement-600-Interest=" . $interest);
                        } else if ($calc_type[$row[SYMBOL]] == "2" || $calc_type[$row[SYMBOL]] == "5") {  //xxx_usd.php
                            $open_price = $row[CurrentPrice];
                            if ($counternya[$row[SYMBOL]][interestbuy] <> 0) {
                                $interest = (($row[Unit] * $lotsize[$row[SYMBOL]] * $counternya[$row[SYMBOL]][interestbuy] * $open_price / 100) / $counternya[$row[SYMBOL]][interest_day_year] * $interval);
                                $interest = round($interest);
                            } else {
                                $interest = 0;
                            }
                            //tradelog("mt4_users_statement-609-Interest=" . $interest . ";Open Price:" . $open_price . ";Unit:" . $row[Unit] . ";LotSize:" . $lotsize[$row[SYMBOL]] . ";IntBuy:" . $counternya[$row[SYMBOL]][interestbuy] . ";Days:" . $counternya[$row[SYMBOL]][interest_day_year] . ";Interval:" . $interval);
                        }
                        //tradelog("mt4_users_statement-611-Interest=" . $interest);

                        if (preg_match("/(^USD\/.+|^U(J|C)\d)/", $row[SYMBOL])) {
                            $row[Floating] = $row[Floating] / $row[CurrentPrice];
                            //tradelog("mt4_users_statement-352-CurrentPrice=" . $row[CurrentPrice]);
                        }
                        if (preg_match("/(^USD.+|^U(J|C)\d)/", $row[SYMBOL])) {
                            $row[Floating] = $row[Floating] / $row[CurrentPrice];
                            //tradelog("mt4_users_statement-352-CurrentPrice=" . $row[CurrentPrice]);
                        }
                        if (substr($row[SYMBOL], 0, 7) == "EUR/GBP") {
                            global $DB_quote;
                            $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'GBP A0-FX'";
                            $result = $DB_quote->query($query);
                            $row_quote = mysql_fetch_array($result);
                            $lastclosing = $row_quote[last];
                            unset($row_quote);
                            include("includes/globals.php");
                            $row[Floating] = $row[Floating] * $lastclosing;
                        }
                        if (substr($row[SYMBOL], 0, 7) == "EUR/CHF") {
                            global $DB_quote;
                            $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'CHF A0-FX'";
                            $result = $DB_quote->query($query);
                            $row_quote = mysql_fetch_array($result);
                            $lastclosing = $row_quote[last];
                            unset($row_quote);
                            include("includes/globals.php");
                            $row[Floating] = $row[Floating] / $lastclosing;
                        }
                        if (substr($row[SYMBOL], 0, 7) == "EUR/JPY" || substr($row[SYMBOL], 0, 7) == "EURJPY2") {
                            global $DB_quote;
                            $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
                            $result = $DB_quote->query($query);
                            $row_quote = mysql_fetch_array($result);
                            $lastclosing = $row_quote[last];
                            unset($row_quote);
                            include("includes/globals.php");
                            $row[Floating] = $row[Floating] / $lastclosing;
                        }
                        if (substr($row[SYMBOL], 0, 7) == "GBP/JPY") {
                            global $DB_quote;
                            $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
                            $result = $DB_quote->query($query);
                            $row_quote = mysql_fetch_array($result);
                            $lastclosing = $row_quote[last];
                            unset($row_quote);
                            include("includes/globals.php");
                            $row[Floating] = $row[Floating] / $lastclosing;
                        }
                    } else {
                        $row[Floating] = ($row[SellPrice] - $row[CurrentPrice]) * $row[Unit] * $lotsize[$row[SYMBOL]];
                        //tradelog("mt4_users_statement-397-Counter:".$row[SYMBOL].";CurrentPrice=" . $row[CurrentPrice]);
                        $query = "SELECT client_accounts.accountname,counter_account.* 
                                    FROM counter_account,client_accounts 
                                    WHERE counter_account.`accountid` = client_accounts.accountid 
                                    AND client_accounts.accountname = '$s_accno' 
                                    AND counter_account.rolldate <= '$datesearch' 
                                    AND counter_account.counter = '$row[SYMBOL]' 
                                    ORDER BY counter_account.rolldate DESC LIMIT 0,1";
                        $result = $DB->query($query);
                        while ($row2 = $DB->fetch_array($result)) {
                            $counternya[$row2[counter]][interestbuy] = $row2[interestbuy];
                            $counternya[$row2[counter]][interestsell] = $row2[interestsell];
                            $counternya[$row2[counter]][storagebuy] = $row2[storagebuy];
                            $counternya[$row2[counter]][storagesell] = $row2[storagesell];
                            //tradelog("mt4_daily_statement-643-Int:" . $counternya[$row2[counter]][interestbuy] . ";query=" . $query);
                        }
                        if ($calc_type[$row[SYMBOL]] == "1") {  //usd_xxx.php
                            $open_price = 1;
                            if ($counternya[$row[SYMBOL]][interestsell] <> 0) {
                                $interest = (($row[Unit] * $lotsize[$row[SYMBOL]] * $counternya[$row[SYMBOL]][interestsell] / 100 * $row[SellPrice] / 100) / $counternya[$row[SYMBOL]][interest_day_year] * $interval);
                                $interest = round($interest);
                            } else {
                                $interest = 0;
                            }
                        } else if ($calc_type[$row[SYMBOL]] == "2" || $calc_type[$row[SYMBOL]] == "5") {  //xxx_usd.php
                            $open_price = $row[CurrentPrice];
                            if ($counternya[$row[SYMBOL]][interestsell] <> 0) {
                                $interest = (($row[Unit] * $lotsize[$row[SYMBOL]] * $counternya[$row[SYMBOL]][interestsell] * $open_price / 100) / $counternya[$row[SYMBOL]][interest_day_year] * $interval);
                                $interest = round($interest);
                            } else {
                                $interest = 0;
                            }
                        }
                        //tradelog("mt4_users_statement-681-Counter:".$row[SYMBOL].";CurrentPrice=" . $row[CurrentPrice]);

                        if (preg_match("/(^USD\/.+|^U(J|C)\d)/", $row[SYMBOL])) {
                            $row[Floating] = $row[Floating] / $row[CurrentPrice];
                            //tradelog("mt4_users_statement-399-Floating:".$row[Floating].";CurrentPrice=" . $row[CurrentPrice]);
                        }
                        if (preg_match("/(^USD.+|^U(J|C)\d)/", $row[SYMBOL])) {
                            $row[Floating] = $row[Floating] / $row[CurrentPrice];
                            //tradelog("mt4_users_statement-404-Floating:".$row[Floating].";CurrentPrice=" . $row[CurrentPrice]);
                        }
                        if (substr($row[SYMBOL], 0, 7) == "EUR/GBP") {
                            global $DB_quote;
                            $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'GBP A0-FX'";
                            $result = $DB_quote->query($query);
                            $row_quote = mysql_fetch_array($result);
                            $lastclosing = $row_quote[last];
                            unset($row_quote);
                            include("includes/globals.php");
                            $row[Floating] = $row[Floating] * $lastclosing;
                        }
                        if (substr($row[SYMBOL], 0, 7) == "EUR/CHF") {
                            //tradeLog("MM_temp_Statement Sell New-".$row[SYMBOL]);
                            global $DB_quote;
                            $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'CHF A0-FX'";
                            $result = $DB_quote->query($query);
                            $row_quote = mysql_fetch_array($result);
                            $lastclosing = $row_quote[last];
                            unset($row_quote);
                            include("includes/globals.php");
                            $row[Floating] = $row[Floating] / $lastclosing;
                        }
                        if (substr($row[SYMBOL], 0, 7) == "EUR/JPY" || substr($row[SYMBOL], 0, 7) == "EURJPY2") {
                            global $DB_quote;
                            $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
                            $result = $DB_quote->query($query);
                            $row_quote = mysql_fetch_array($result);
                            $lastclosing = $row_quote[last];
                            unset($row_quote);
                            include("includes/globals.php");
                            $row[Floating] = $row[Floating] / $lastclosing;
                        }
                        if (substr($row[SYMBOL], 0, 7) == "GBP/JPY") {
                            //tradeLog("MM_temp_Statement Sell New-".$row[SYMBOL]);
                            global $DB_quote;
                            $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
                            $result = $DB_quote->query($query);
                            $row_quote = mysql_fetch_array($result);
                            $lastclosing = $row_quote[last];
                            unset($row_quote);
                            include("includes/globals.php");
                            $row[Floating] = $row[Floating] / $lastclosing;
                        }
                    }
                    $row[$interestbackoffice] = $interest;
                    //tradeLog("MM_temp_Statement-858=" . $row[TICKET] . ";SYMBOL:" . $row[SYMBOL]);
                    $thesymbols[$row[SYMBOL]] = open;
                    $statement[open][] = $row;

                    $statement[status][commission] = $statement[status][commission] + $row[Commission];
                    $statement[status][interest] = $statement[status][interest] + $interest;
                    $statement[status][floatingPL] = $statement[status][floatingPL] + $row[Floating] + $row[Commission] + $interest;
                    //tradeLog("MM_temp_Statement-691=" . $row[TICKET] . ";CMD:" . $row[CMD] . ";Floating:" . $row[Floating] . ";Interest:" . $interest);
                    if ($row[CMD] == '0') {
                        $marginreg[$row[SYMBOL]][buy] = $marginreg[$row[SYMBOL]][buy] + $row[Unit];
                    } else {
                        $marginreg[$row[SYMBOL]][sell] = $marginreg[$row[SYMBOL]][sell] + $row[Unit];
                    }
                }
            }//if (count($positions) > 0) {
            unset($row);
            //tradelog("mm_temp_statement-624-PL:" . $statement[status][PL]);

            $query = "SELECT mt4_trades.*  
        FROM " . $mysql_meta . ".mt4_trades 
        WHERE login ='$account' 
        AND CMD IN ('6','7') 
        AND LEFT(OPEN_TIME,10) = '$datesearch'
        order by mt4_trades.TICKET desc      
            ";
            //tradelog("MM_tempstatement-345=" . $query);
            $result = $DB->query($query);
            $status = $mm_accs[$account][status];
            //tradelog("MM_tempstatement-538=" . $status[BALANCE_PREV]);
            while ($row = $DB->fetch_array($result)) {
                //tradeLog("MM_temp_Statement-249=" . $row[CMD]);            
                if ($row[CMD] == '6') {
                    $status[MARGININ] = $status[MARGININ] + $row[PROFIT];
                }
                if ($row[CMD] == '7') {
                    $status[MARGINOUT] = $status[MARGINOUT] + $row[PROFIT];
                }
                //tradeLog("MM_temp_Statement-249=MarginIn:" . $status[MARGININ]);
            }
            //tradelog("mm_temp_statement-361-Equity:" . $status[EQUITY] . ";PrevBalance:" . $status[PREVBALANCE] . ";PL:" . $status[PL] . ";MarginIn:" . $status[MARGININ] . ";MarginOut:" . $status[MARGINOUT]);
            $status[floatingsemua] = $status[EQUITY] - $status[BALANCE_PREV] - $status[MARGININ] - $status[MARGINOUT] - $status[PL];
            //tradelog("mm_temp_statement-624-PL:" . $statement[status][PL]);


            $mm_accs[$account][statement][status] = $status;
            //$statement[status] = $status;
            //tradelog("mm_temp_statement-561-BALANCE_PREV:" .$status[BALANCE_PREV]);
            //tradelog("mm_temp_statement-666-Equity:" . $statement[status][floatingsemua][EQUITY] . ";PL:" . $statement[status][PL] . ";floatingsemua:" . $statement[status][floatingsemua][floatingsemua] . ";");
        }//foreach ($mm_accs AS $account => $mm_acc) {
    }//if (count($mm_accs) > 0) {

    return $statement;
}

function fetchAccounts($username, $isadmin = 0) {
    global $DB_odbc;
    global $user;

    if ($isadmin || $user->groupid == '15') {
        $query = "SELECT S_ACCNO AS account FROM " . $mysql[meta] . ".copytrade 
            GROUP BY S_ACCNO ORDER BY S_ACCNO ASC ";
        $result = $DB_odbc->query($query);
        while ($row = $DB_odbc->fetch_array($result)) {
            $accounts[] = $row[account];
        }
    } else {
        if ($user->groupid == '1') {
            $query = "SELECT trim(AccNo) AS account 
                FROM bafile," . $mysql[meta] . ".copytrade 
                WHERE " . $user->tradingtype . "='$username' 
                and copytrade.S_ACCNO = bafile.ACCNO     
                ORDER BY AccNo";
            $result = $DB_odbc->query($query);
            while ($row = $DB_odbc->fetch_array($result)) {
                $accounts[] = $row[account];
            }
        }
        if ($user->groupid == '2') {
            $query = "SELECT trim(AccNo) AS account 
                FROM bafile," . $mysql[meta] . ".copytrade  
                WHERE AccNo='$username' 
                and copytrade.S_ACCNO = bafile.ACCNO         
                ORDER BY AccNo";
            $result = $DB_odbc->query($query);
            while ($row = $DB_odbc->fetch_array($result)) {
                $accounts[] = $row[account];
            }
        }
        if ($user->groupid == '3') {
            $query = "SELECT TRIM(client_accounts.accountname) AS account 
                FROM client_accounts,client_aecode, " . $mysql[meta] . ".copytrade  
                WHERE client_accounts.accountname !='' 
                AND client_accounts.aecodeid = client_aecode.aecodeid 
                and copytrade.S_ACCNO = client_accounts.accountname 
                AND client_aecode.aecode = (
                    SELECT userfield.fieldvalue FROM userfield,USER 
                    WHERE user.userid = userfield.`userid` 
                    AND user.`username` = '" . $username . "' 
                    AND fieldname = 'aecode' 
                ) 
                ORDER BY client_accounts.accountname ASC";
            $result = $DB_odbc->query($query);
            while ($row = $DB_odbc->fetch_array($result)) {
                $accounts[] = $row[account];
            }
        }
        if ($user->groupid == '4' || $user->groupid == '5') {
            $query = "SELECT trim(AccNo) AS account 
                FROM bafile," . $mysql[meta] . ".copytrade   
                WHERE AeCode='$user->userfield_aecode' 
                and copytrade.S_ACCNO = bafile.AccNo  
                ORDER BY AccNo";
            $result = $DB_odbc->query($query);
            while ($row = $DB_odbc->fetch_array($result)) {
                $accounts[] = $row[account];
            }
        }
        if ($user->groupid == '6') {
            $query = "
                SELECT TRIM(bafile.AccNo) AS account 
                FROM bafile,client_branch," . $mysql[meta] . ".copytrade   
                WHERE bafile.AccNo !='' 
                and copytrade.S_ACCNO = bafile.AccNo  
                AND bafile.`Branch` = client_branch.`branch` 
                AND client_branch.branch = ( 
                        SELECT userfield.fieldvalue 
                        FROM userfield,USER WHERE user.userid = userfield.`userid` 
                        AND user.`username` = '" . $username . "' 
                        AND fieldname = 'branch' 
                ) 
                GROUP BY TRIM(bafile.AccNo) 
                ORDER BY bafile.AccNo ASC
                ";
            $result = $DB_odbc->query($query);
            while ($row = $DB_odbc->fetch_array($result)) {
                $accounts[] = $row[account];
            }
        }
        if ($user->groupid == '7' || $user->groupid == '8' || $user->groupid == '11') {
            $manager = new Manager($user->getUserid());
            $manager->fetchBrancheGroups($DB_odbc);
            $accounts = $manager->getAccounts();
        }
        if ($user->groupid == '12') {
            $query = "
                SELECT TRIM(bafile.AccNo) AS account 
                FROM bafile,client_group," . $mysql[meta] . ".copytrade 
                WHERE bafile.AccNo !='' 
                AND bafile.group = client_group.`group`  
                and copytrade.S_ACCNO = bafile.AccNo  
                AND client_group.group = ( 
                        SELECT userfield.fieldvalue 
                        FROM userfield,USER WHERE user.userid = userfield.`userid` 
                        AND user.`username` = '" . $username . "' 
                        AND fieldname = 'group' 
                ) 
                GROUP BY TRIM(bafile.AccNo) 
                ORDER BY bafile.AccNo ASC
                ";
            $result = $DB_odbc->query($query);
            while ($row = $DB_odbc->fetch_array($result)) {
                $accounts[] = $row[account];
            }
        }
    }
    if ($accounts[0] == '') {
        $accounts[0] = 'dummy';
    }
    return $accounts;
}

function date_diff($date1, $date2) {
    if ($date1 != $date2) {
        $now = strtotime(date($date2)); // or your date as well
        $otherdate = strtotime($date1);
        $datediff = $now - $otherdate;
        //tradeLog("Date_diff-850:" . $datediff);
        $harinya = floor($datediff / (60 * 60 * 24));
        //tradeLog("Date_diff-852:" . $harinya);
    }
    $harinya++;
    return $harinya;
}

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>