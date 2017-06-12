<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
include_once("includes/wr_tools.php");
global $user;
global $template;
global $mysql;
global $DB;
$security = new \security\CSRF;
$token = $security->set(3, 3600);
$template->assign('token', $token);

$account = $_POST['account'];
$tglnya = $_POST['tglnya'];
// 2017-03-01 - 2017-03-30
$pecah = explode(' - ', $tglnya);
$dateBefore = $pecah[0];
$dateAfter = $pecah[1];
$query = "SELECT
  wallet_mulatition.id,
  wallet_mulatition.`created_at`,
  wallet_mulatition.`comment`,
  wallet_mulatition.`amount`,
  wallet_mulatition.`balance`,
  wallet_mulatition.`type`
FROM
  mlm_ewallet
  LEFT JOIN wallet_mulatition
    ON mlm_ewallet.`id` = wallet_mulatition.`ewallet_id`
WHERE mlm_ewallet.`account` = '$account'
AND DATE(wallet_mulatition.created_at) >= '$dateBefore' AND DATE(wallet_mulatition.created_at) <= '$dateAfter'
ORDER BY wallet_mulatition.created_at ASC";
$hasil = $DB->execresultset($query);
$debet = [];
$credit = [];
$hasil2 = [];
foreach ($hasil as $key => $row) {
  if($row['type'] == "CR"):
    $credit[] = $row;
  else:
    $debet[] = $row;
  endif;
  $hasil2[$key] = $row;
  $hasil2[$key]['balance'] = number_format($row['balance']);
}
$hasil = $hasil2;
$totalCredit = 0;
foreach ($credit as $key => $value) {
  $totalCredit = @$totalCredit + $value['amount'];
}
$totalDebit = 0;
foreach ($debet as $key => $value) {
  $totalDebit = @$totalDebit + $value['amount'];
}

$query = "SELECT
  client_aecode.`name`
FROM
  client_accounts
  LEFT JOIN client_aecode
    ON client_aecode.`aecodeid` = client_accounts.`aecodeid`
WHERE client_accounts.`accountname` = '$account'";

$forName = $DB->execresultset($query);
foreach ($forName as $key => $value) {
  $name = $value['name'];
}

$end = end($hasil);
$response['client_name'] = $name;
$response['total_credit'] = number_format(@$totalCredit);
$response['total_debit'] = number_format(@$totalDebit);
$response['first_balance'] = (!empty($hasil)) ? $hasil[0]['balance'] : 0;
$response['last_balance'] = (!empty($end)) ? $end['balance'] : 0;
$response['periode'] = $tglnya;
$response['result'] = $hasil;

echo json_encode($response, JSON_PRETTY_PRINT);
