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

$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}

$key = '';
if (isset($_SESSION['key'])) {
    $key = $_SESSION['key'];
}

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}
$accnoselect = "";
if (isset($_POST['accnoselect'])) {
    $accnoselect = $_POST['accnoselect'];
}
$shownya = "";
if (isset($_POST['shownya'])) {
    $shownya = $_POST['shownya'];
}
// $_SESSION['page'] = 'ar_payment';
$query = "SELECT
  mlm_payment.*,
  mlm.`group_play`
FROM
  mlm_payment,
  mlm
WHERE mlm_payment.`Account` = mlm.`ACCNO`
AND mlm_payment.`aecode` = '$user->username'
AND mlm_payment.IDPay = '$accnoselect'";
$result = $DB->execresultset($query);
foreach ($result as $rows) {
    $ceksemuaccounts[] = $rows;
    $account2 = $rows['Account'];
}

 for ($icount = 0; $icount < count($ceksemuaccounts); $icount++) {
        $ceksemuaccount = $ceksemuaccounts[$icount];
        /*$checkanak = "tidak";
        if ($ceksemuaccount[companyconfirm] == '2') {
            //$theFetchAccount->tradeLog("Dashboardawal-137-Check Anak:".$ceksemuaccount[ACCNO]);
            $checkanak = "iya";o
        }*/
        $group_play = $ceksemuaccount['group_play'];
        if ($group_play == 'Silver50') {
            $ceksemuaccounts[$icount]['Uang'] = 'USD 50.00 ( Fifty US Dollar )';
            $ceksemuaccounts[$icount]['UangTax'] = 'USD 50.00 ( Fifty US Dollar )';
            $ceksemuaccounts[$icount]['UangNOComma'] = '50';
            $ceksemuaccounts[$icount]['UangNOCommaTax'] = '50';
            $ceksemuaccounts[$icount]['Product'] = "SILVER 50 ";

        }
        if ($group_play == 'ClubSilver100') {
           $ceksemuaccounts[$icount]['Uang'] = 'USD 100.00 ( Hundred US Dollar )';
            $ceksemuaccounts[$icount]['UangTax'] = 'USD 100.00 ( Hundred US Dollar )';
            $ceksemuaccounts[$icount]['UangNOComma'] = '100';
            $ceksemuaccounts[$icount]['UangNOCommaTax'] = '100';
            $ceksemuaccounts[$icount]['Product'] = "CLUB SILVER 100 ";
        }
        if ($group_play == 'ClubSilver250') {
            $ceksemuaccounts[$icount]['Uang'] = 'USD 250.00 ( Two Hundred and Fifty US Dollar )';
            $ceksemuaccounts[$icount]['UangTax'] = 'USD 250.00 ( Two Hundred and Fifty US Dollar )';
            $ceksemuaccounts[$icount]['UangNOComma'] = '250';
            $ceksemuaccounts[$icount]['UangNOCommaTax'] = '250';
            $ceksemuaccounts[$icount]['Product'] = "CLUB SILVER 250 ";
        }
        if ($group_play == 'ClubSilver500') {
           $ceksemuaccounts[$icount]['Uang'] = 'USD 500.00 ( five hundred US Dollar )';
            $ceksemuaccounts[$icount]['UangTax'] = 'USD 500.00 ( five hundred US Dollar )';
            $ceksemuaccounts[$icount]['UangNOComma'] = '500';
            $ceksemuaccounts[$icount]['UangNOCommaTax'] = '500';
            $ceksemuaccounts[$icount]['Product'] = "CLUB SILVER 500 ";
        }
        if ($group_play == 'ExeSilverClub1000') {
            $ceksemuaccounts[$icount]['Uang'] = 'USD 1,000.00 ( One Thousand US Dollar )';
            $ceksemuaccounts[$icount]['UangTax'] = 'USD 1,000.00 ( One Thousand US Dollar )';
            $ceksemuaccounts[$icount]['UangNOComma'] = '1000';
            $ceksemuaccounts[$icount]['UangNOCommaTax'] = '1000';
            $ceksemuaccounts[$icount]['Product'] = "EXECUTIVE SILVER CLUB 1000";
        }
        if ($group_play == 'ExeSilverClub2500') {
            $ceksemuaccounts[$icount]['Uang'] = 'USD 2,500.00 ( two thousand five hundred US Dollar )';
            $ceksemuaccounts[$icount]['UangTax'] = 'USD 2,500.00 ( two thousand five hundred US Dollar )';
            $ceksemuaccounts[$icount]['UangNOComma'] = '2500';
            $ceksemuaccounts[$icount]['UangNOCommaTax'] = '2500';
            $ceksemuaccounts[$icount]['Product'] = "EXECUTIVE SILVER CLUB 2500";
        }
        if ($group_play == 'VipGoldClub5000') {
            $ceksemuaccounts[$icount]['Uang'] = 'USD 5,000.00 ( five thousand  US Dollar )';
            $ceksemuaccounts[$icount]['UangTax'] = 'USD 5,000.00 ( five thousand  US Dollar )';
            $ceksemuaccounts[$icount]['UangNOComma'] = '5000';
            $ceksemuaccounts[$icount]['UangNOCommaTax'] = '5000';
            $ceksemuaccounts[$icount]['Product'] = "VIP GOLD CLUB 5000 ";
        }
        if ($group_play == 'VvipGoldClub10000') {
            $ceksemuaccounts[$icount]['Uang'] = 'USD 10,000.00 ( Ten Thousand US Dollar )';
            $ceksemuaccounts[$icount]['UangTax'] = 'USD 10,000.00 ( Ten Thousand US Dollar )';
            $ceksemuaccounts[$icount]['UangNOComma'] = '10000';
            $ceksemuaccounts[$icount]['UangNOCommaTax'] = '10000';
            $ceksemuaccounts[$icount]['Product'] = "VVIP GOLD CLUB 10000 ";
        }






    }

// var_dump($ceksemuaccounts);
/*=======================================
=            Start Of Coding            =
=======================================*/


/*=====  End of Start Of Coding  ======*/

if ($shownya == 'paypal') {
  $template->assign("ceksemuaccounts", $ceksemuaccounts);
  $template->display("ar_payment_paypal.htm");
}elseif($shownya == 'cash'){

  $template->assign("account2", $account2);
  $template->assign("IDPay", $accnoselect);
  $template->display("ar_payment_cash.htm");

}elseif($shownya == 'transfer'){

  $template->assign("account2", $account2);
  $template->assign("IDPay", $accnoselect);
  $template->assign("uang", $ceksemuaccounts[0]['UangNOComma'] . '00');
  $template->display("ar_payment_tf.htm");
}


?>
