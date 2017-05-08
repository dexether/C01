<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
include_once("../includes/wr_tools.php");
require_once('invoice.php');
global $DB;
$type = @$_GET['type'];
$transaction_id = @$_GET['transaction_id'];
$tax = config('AR_WITHDRAWAL_TAX');
$sql = $DB->execresultset("SELECT * FROM usercompany");
$company = [];
foreach($sql as $row)
{
  $company = $row;
}



ob_clean();
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addLogo('../images/logo/trado.png');
switch ($type) {
  case 'withdrawal':
  $sql = "SELECT
        mlm_transaction.id as transaction_id,
        mlm_transaction.date_transaction as wd_date,
        mlm_transaction.amount as wd_amount,
        client_aecode.`name`,
        client_aecode.`address`,
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
      $result = $DB->execresultset($sql);
      if(!$result)
        response([
          "status" => false,
        ]);
      // var_dump($result);
      // die();
      $data = $result[0];
      $wd_amount = $data['wd_amount'];
      $tax_amount = $tax / 100 * $wd_amount;
      $after_tax = $wd_amount - $tax_amount;
      $cur_rate = $data['rate'];
      $cur_type = $data['symbol'] . " " . number_format($cur_rate, 2);
      $final_amount = $after_tax * $cur_rate;
      $pdf->addSociete($data['name'], str_replace(',' ,"\n", $data['address']));
      $pdf->invoiceType('Payment Terms');
      $pdf->invoiceNumber($data['transaction_id']);
      $pdf->temporaire( "Confidential" );
      $pdf->addDate( $data['wd_date']);
      $pdf->addSingature();
      $pdf->addClientAdresse(
        "Trado Market International PLT.\n".
        "Suite 8-1 & 8-2 Level 8, Menara CIMB,\n".
        "No 1 Jalan Sentral 1,\n".
        "Kuala Lumpur Sentral,\n".
        "54070 Kula Lumpur,\n".
        "Malaysia,\n".
        "Office: +603 2298 8466,\n".
        "Fax: +603 2298 8201,\n".
        "Email: admin@tradomarket.com,\n".
        "Website: www.tradomarket.com,\n"
      );

      $pdf->addJobs(strtoupper('WITHDRAWAL REQUEST TO ' . $data["banktype"] . ' ACCOUNT NO: ' . $data["bank_account_number"] . ''), 'Apex System WD');
      $pdf->addProduct("Withdrawal Fund on  USD $ ".number_format($wd_amount, 2)." \nAdministration/Withdrawal fee ".$tax."%  (- USD ".$tax_amount.")\n USD $".$after_tax." at conversion rate of ".$cur_type." on ".$data['updated_at'] ."\nApex ACCO : " . $data['accountname'], $data['symbol'] . " " . number_format($final_amount, 2) , $data['symbol'] . " " . number_format($final_amount, 2));
      $path = "../images/invoice/". $data['accountname'] . '.pdf';
      $pdf->Output($path, 'F');
      $response['status'] = true;
      $response['result']['file_path'] = realpath($path);
    break;
}
response($response);
?>
