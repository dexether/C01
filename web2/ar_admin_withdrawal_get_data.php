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
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

$transaction_id = @$_GET['transaction_id'];

$sql = "SELECT
  mlm_transaction.id as transaction_id,
  client_aecode.`name`,
  client_accounts.`accountname`,
  client_aecode_bank.`aeaccountname` as bank_account_name,
  client_aecode_bank.`aeaccountnumber` as bank_account_number,
  client_aecode_bank.`banktype`,
  client_aecode_bank.`aeaccountname`,
  currency.*,
  mlm_ewallet.balance
FROM
  mlm_transaction
  JOIN client_accounts
    ON client_accounts.`accountname` = mlm_transaction.`account_from`
  JOIN client_aecode
    ON client_aecode.`aecodeid` = client_accounts.`aecodeid`
  JOIN client_aecode_bank
    ON client_aecode_bank.`aecode` = client_aecode.`aecode`
  JOIN currency
    ON mlm_transaction.`currency_id` = currency.`id`
  JOIN mlm_ewallet
    ON mlm_ewallet.account = client_accounts.accountname
WHERE mlm_transaction.id = '$transaction_id'";
try {
  $result = $DB->execresultset($sql);
  $response['status'] = true;
  $response['result']['data'] = ($result) ? $result[0] : [];
} catch (Exception $e) {
  $response['status'] = false;
  $response['result']['message'] = $g->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
