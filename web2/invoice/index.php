<?php
require_once('invoice.php');
$type = @$_GET['type'];
$type = @$_GET['type'];

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addLogo('../images/logo/trado.png');

switch ($type) {
  case 'withdrawal':
      $pdf->addSociete("MaSociete",
                       "MonAdresse\n" .
                       "75000 PARIS\n".
                       "R.C.S. PARIS B 000 000 007\n" .
                       "R.C.S. PARIS B 000 000 007\n" .
                       "Capital : 18000 " . EURO);
      $pdf->invoiceType('Payment Terms');
      $pdf->invoiceNumber('12345613456');
      $pdf->temporaire( "Confidential" );
      $pdf->addDate( "03/12/2003");
      $pdf->addSingature();
      $pdf->addClientAdresse("Ste\nM. XXXX\n3�me �tage\n33, rue d'ailleurs\n75000 PARIS");

      $pdf->addJobs('WITHDRAWAL REQUEST TO BANK ISLAM MALAYSIA ACCOUNT NO: 07052020396306', 'Apex System WD');
      $pdf->addProduct("Withdrawal Fund on 3/19/2017 USD$150.00", 617.58);
      $pdf->Output();
    break;
}
?>
