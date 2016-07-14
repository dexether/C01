<?php

class theOtherFetchAccounts {

    function tradeLogFetchAccount($msg) {
        $fp = fopen("trader.log", "a");
        $logdate = date("Y-m-d H:i:s => ");
        $msg = preg_replace("/\s+/", " ", $msg);
        fwrite($fp, $logdate . $msg . "\n");
        fclose($fp);
        return;
    }

    function fetchAccountslangsung($user, $mysql_meta, $cabang_admin) {
        global $DB;
        $username = $user->username;
        //$this->tradeLogFetchAccount("FetchAccount-17:" . $username);
        if ($user->groupid == '9') {
            if ($cabang_admin == 'semua') {
                $query = "SELECT mt4_users.`LOGIN` AS account FROM " . $mysql_meta . ".mt4_users ORDER BY LOGIN ASC;";
                //$this->tradeLogFetchAccount("AccountList-21=".$user->groupid.";".$query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    //$this->tradeLogFetchAccount("AccountList-24=".$row[account]);
                    $accounts[] = $row['account'];
                }
            } else {
                $query = "SELECT TRIM(client_accounts.accountname) AS account 
                    FROM client_accounts,client_aecode,client_group,client_branch  
                    WHERE client_accounts.accountname !='' 
                    AND client_accounts.aecodeid = client_aecode.`aecodeid` 
                    AND client_aecode.groupid = client_group.`groupid` 
                    AND client_group.branchid = client_branch.branchid 
                    AND client_branch.branch = '$cabang_admin' 
                    ORDER BY client_accounts.accountname desc";
                //$this->tradeLogFetchAccount("AccountList-36=".$user->groupid.";".$query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    //$this->tradeLogFetchAccount("AccountList-69=".$row[account]);
                    $accounts[] = $row['account'];
                }
            }//admin
        } else {            
            if ($user->tradingtype == 'AccNo') {
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE " . $user->tradingtype . "='$username' ORDER BY AccNo desc";
                //$this->tradeLogFetchAccount("AccountList-66=".$user->groupid.";".$query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    //$this->tradeLogFetchAccount("AccountList-69=".$row[account]);
                    $accounts[] = $row['account'];
                }
            }
            if ($user->groupid == '2') {
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE AccNo='$username' ORDER BY AccNo desc";
                //$this->tradeLogFetchAccount("AccountList-66=".$user->groupid.";".$query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    //$this->tradeLogFetchAccount("AccountList-69=".$row[account]);
                    $accounts[] = $row['account'];
                }
            }
            if ($user->groupid == '3') {
                $query = "SELECT TRIM(client_accounts.accountname) AS account 
                FROM client_accounts,client_aecode  
                WHERE client_accounts.accountname !='' 
                AND client_accounts.aecodeid = client_aecode.aecodeid 
                AND client_aecode.aecode = '" . $username . "' 
                ORDER BY client_accounts.accountid desc";
                $this->tradeLogFetchAccount("AccountList-66=".$user->groupid.";".$query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    //$this->tradeLogFetchAccount("AccountList-69=".$row[account]);
                    $accounts[] = $row['account'];
                }
            }
            if ($user->groupid == '4' || $user->groupid == '5') {
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile.AeCode='$user->userfield_aecode' ORDER BY AccNo desc";
                //$this->tradeLogFetchAccount("AccountList-66=".$user->groupid.";".$query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    //$this->tradeLogFetchAccount("AccountList-69=".$row[account]);
                    $accounts[] = $row['account'];
                }
            }
            if ($user->tradingtype == 'Group') {
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile." . $user->tradingtype . "='$user->userfield_group' ORDER BY AccNo desc";
                //$this->tradeLogFetchAccount("AccountList-66=".$user->groupid.";".$query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    //$this->tradeLogFetchAccount("AccountList-69=".$row[account]);
                    $accounts[] = $row['account'];
                }
            }
        }
        if (!isset($accounts)) {
            $accounts[0] = 'dummy';
        }
        if ($accounts[0] == '') {
            $accounts[0] = 'dummy';
        }
        //tradeLogFetchAccount("AccountList-100-Account[0]=".$accounts[0]);
        return $accounts;
    }

    function fetchAccounts_GaKepake($username, $isadmin = 0, $cabang_admin) {
        global $DB_odbc;
        global $user;

        if ($isadmin) {
            if ($cabang_admin == 'semua') {
                $query = "SELECT trim(accountname) AS account FROM client_accounts where accountname !='' ORDER BY accountname desc";
            } else {
                $query = "SELECT TRIM(client_accounts.accountname) AS account 
                    FROM client_accounts,client_aecode,client_group,client_branch  
                    WHERE client_accounts.accountname !='' 
                    AND client_accounts.aecodeid = client_aecode.`aecodeid` 
                    AND client_aecode.groupid = client_group.`groupid` 
                    AND client_group.branchid = client_branch.branchid 
                    AND client_branch.branch = '$cabang_admin' 
                    ORDER BY client_accounts.accountname desc";
                //tradeLogFetchAccount("SelectAccount-83=".$query);
            }
        } else {
            if ($user->groupid == '3') {
                $query = "select accountreal from user where username = '" . $username . "' ";
                //tradeLogFetchAccount("SelectAccount-89=".$query);
                $result = $DB_odbc->query($query);
                $accounts_panjang = "";
                while ($row = $DB_odbc->fetch_array($result)) {
                    $accounts_panjang = $row['accountreal'];
                }
                if ($accounts_panjang != '') {
                    $accounts = explode(",", $accounts_panjang);
                }
            }
            if ($user->tradingtype == 'AccNo') {
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE " . $user->tradingtype . "='$username' ORDER BY AccNo desc";
            }
            if ($user->groupid == '2') {
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE AccNo='$username' ORDER BY AccNo desc";
            }
            if ($user->groupid == '3') {
                $query = "SELECT TRIM(client_accounts.accountname) AS account 
                FROM client_accounts,client_aecode  
                WHERE client_accounts.accountname !='' 
                AND client_accounts.aecodeid = client_aecode.aecodeid 
                AND client_aecode.aecode = '" . $username . "' 
                ORDER BY client_accounts.accountid desc";
            }
            if ($user->groupid == '4' || $user->groupid == '5') {
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile.AeCode='$user->userfield_aecode' ORDER BY AccNo desc";
            }
            if ($user->tradingtype == 'Group') {
                $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile." . $user->tradingtype . "='$user->userfield_group' ORDER BY AccNo desc";
            }
        }
        //$this->tradeLogFetchAccount("AccountList-66=".$user->groupid.";".$query);
        $result = $DB_odbc->query($query);
        while ($row = $DB_odbc->fetch_array($result)) {
            //$this->tradeLogFetchAccount("AccountList-69=".$row[account]);
            $accounts[] = $row[account];
        }

        if ($accounts[0] == '') {
            $accounts[0] = 'dummy';
        }
        //tradeLogFetchAccount("AccountList-100-Account[0]=".$accounts[0]);
        return $accounts;
    }

    function fetchBrancheGroups() {
        global $DB_odbc;

        $query = "SELECT trim(Branch) AS branchid, trim(AccNo) AS account FROM bafile ORDER BY AccNo";

        $result = $DB_odbc->query($query);
        while ($row = $DB_odbc->fetch_array($result)) {
            $branches[$row[branchid]][] = $row[account];
        }
        return $branches;
    }

}

?>