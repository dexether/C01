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
$accounts = $theFetchAccount->fetchAccountslangsung($user,$mysql['meta'],$cabang_admin);
$account = $accounts[0];

if (isset($_GET['account'])) {
    $account = anti_injection($_GET['account']);
}
if (isset($_POST['account'])) {
    $account = anti_injection($_POST['account']);
}

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
$accountcheck = myfilter($accounts, $account);
if ($accountcheck[0] == '') {
    display_error("41.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
} else {
    $mainmenu = "mainmenu.php?account=" . $account;
    $template->assign("mainmenu", $mainmenu);

    if (!empty($account) && $account != "all") {
        if (!in_array($account, $accounts)) {
            display_error("48.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.");
        }
    }
    $template->assign("accounts", $accounts);
    if (!empty($account)) {
        $template->assign("tradedby", $user->username);
        $template->assign("account", $account);
        $template->assign("error", "");
    }
}
$_SESSION['page'] = 'user';

if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
    if ($postmode == "changepassword") {
        $TradedChange = '';
        if (isset($_GET['tradedby'])) {
            $TradedChange = anti_injection($_GET['tradedby']);
        }
        $AccountChange = '';
        if (isset($_GET['account'])) {
            $AccountChange = anti_injection($_GET['account']);
        }
        $oldpassword1 = '';
        if (isset($_POST['oldpassword'])) {
            //tradeLogUser("User.php-73:" . $_POST['oldpassword']);
            $oldpassword1 = anti_injection($_POST['oldpassword']);
        }
        $password1 = '';
        if (isset($_POST['password1'])) {
            $password1 = anti_injection($_POST['password1']);
        }
        $password2 = '';
        if (isset($_POST['password2'])) {
            $password2 = anti_injection($_POST['password2']);
        }

        //tradeLogUser("User.php-147:Tradedby:" . $TradedChange . ";AccountChange:" . $AccountChange . ";OldPassword1:" . $oldpassword1 . ";pswd1:" . $password1 . ";pswd2:" . $password2);
        $oldpassword2 = md5($oldpassword1);
        if ($password1 == $password2) {
            //tradeLogUser("betul");
            if ($password1 == '') {
                $template->assign("error", "Password can not be empty");
				//tradeLogUser("salah");
            } else {                
				tradeLogUser("else");
                $password = md5($password1);
                //tradeLogUser("User.php-154:".$password);
                $query = "SELECT * FROM user 
                    WHERE 
                    username = '" . $user->username . "' 
                    AND password='" . $oldpassword2 . "'";
               // tradeLogUser("User-159-query:".$query);
                $rows = $DB->execresultset($query);
                $adadata = 'no';
                foreach ($rows as $row) {
                    $adadata = "yes";
                }
				//tradeLogUser($adadata);

                if ($adadata == 'yes') {
                    $query = "UPDATE user SET password = '" . $password . "' 
                        WHERE username = '" . $user->username . "' and password='" . $oldpassword2 . "'";
                    //tradeLogUser("User-168:" . $query);
                    $DB->execonly($query);

                    $_SESSION['user']->password = $password;
                    //tradeLogUser("User-172-Success:".$password);
                    $_SESSION['ordermessage'] = "Password has been update successfully. Please click home to return";
                    $_SESSION['orderkey'] = $key;
                    //tradeLogUser("175-User-Success");
                    $error            = "success";
					$subject          = "Success changing password";
					$msg              = "Your password has been updated.";
                    $_SESSION['page'] = 'home_03';
					//tradeLogUser("berhasil");
                } else {
                    $error            = "error";
					$subject          = "Failed changing password";
					$msg              = "Something went wrong";
					//tradeLogUser("gagal");
                }
            }
        } else {
            $error            = "error";
			$subject          = "Error";
			$msg              = "Password confirmation not match";
			//tradeLogUser("ngga sama");
        }
		$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
		echo json_encode($response);
    }
}else{
	$template->assign("action", "user.php?postmode=changepassword&tradedby=" . $user->username);
	$template->display("user.htm");
}


/* * ***************************************************************************
 * FETCH ALL ACCOUNTS ASSOCIATED WITH USERNAME                                *
 * *************************************************************************** */

function fetchAccounts($username, $isadmin = 0) {
    global $DB;
    global $user;

    if ($isadmin) {
        $query = "SELECT trim(accountname) AS account FROM client_accounts where accountname !='' ORDER BY accountname asc";
    } else {
        if ($user->groupid == '3') {
            $query = "select accountreal from user where username = '" . $username . "' ";
            $rows = $DB->execresultset($query);
            $accounts_panjang = "";
            foreach ($rows as $row) {
                $accounts_panjang = $row[accountreal];
            }
            if ($accounts_panjang != '') {
                $accounts = explode(",", $accounts_panjang);
            }
        }
        if ($user->tradingtype == 'AccNo') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE " . $user->tradingtype . "='$username' ORDER BY AccNo";
        }
        if ($user->groupid == '2') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE AccNo='$username' ORDER BY AccNo";
        }
        if ($user->groupid == '3') {
            $query = "SELECT TRIM(client_accounts.accountname) AS account 
                FROM client_accounts,client_aecode  
                WHERE client_accounts.accountname !='' 
                AND client_accounts.aecodeid = client_aecode.aecodeid 
                AND client_aecode.aecode = '" . $username . "' 
                ORDER BY client_accounts.accountname ASC";
        }
        if ($user->groupid == '4' || $user->groupid == '5') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile.AeCode='$user->userfield_aecode' ORDER BY AccNo";
        }
        if ($user->tradingtype == 'Group') {
            $query = "SELECT trim(AccNo) AS account FROM bafile WHERE bafile." . $user->tradingtype . "='$user->userfield_group' ORDER BY AccNo";
        }
    }
    //tradeLogProfile("tempstatement-257=".$query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $accounts[] = $row['account'];
    }

    if ($accounts[0] == '') {
        $accounts[0] = 'dummy';
    }
    return $accounts;
}

/* * ***************************************************************************
 * FETCH ALL BRANCHES/ACCOUNTS (ADMINISTRATOR/SUPERVISOR)                     *
 * *************************************************************************** */

function fetchBrancheGroups() {
    global $DB;
    $query = "SELECT trim(Branch) AS branchid, trim(AccNo) AS account FROM bafile ORDER BY AccNo";
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $branches[$row['branchid']][] = $row['account'];
    }
    return $branches;
}

function tradeLogUser($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>