<?php
/*
For Production reason Error reporting will disable
 */
// error_reporting(0);


include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
$var_to_pass = null;
global $user;
global $template;
//tradeLogConstruct("UnderConstruct.php-Line-9");
/*=============================================
=            Start Of Coding                 =
=============================================*/

$bulan         = @$_POST['bulan'];
$tahun         = @$_POST['tahun'];
$agen          = @$_POST['keanggotaan'];
$rolldate      = @$_POST['rolldate'];
$account       = @$_POST['account'];
$periode_start = date('Y-m-01 22:30:01', strtotime($tahun . "-" . $bulan));
$periode_start = date('Y-m-d', (strtotime('-1 day', strtotime($periode_start))));
$periode_end   = date('Y-m-t 22:30:0', strtotime($tahun . "-" . $bulan));
$filter_date   = "";
$date          = $tahun . '-' . $bulan;
// tradeLogComm($bulan . " " . $tahun . " " . $agen . " ");
// print_r($_POST);
if (empty($agen)) {
   $filter_agen = "";
} else {
   if ($agen == 'true') {
      $filter_agen = "AND client_accounts.`typeaccount` = 'agent'";
   } else {
      $filter_agen = "AND client_accounts.`typeaccount` != 'agent'";
   }
}
if (isset($tahun)) {
   $filter_date = " AND LEFT(mlm_comm.rolldate, 7) = '$date'";
}
// ===========================================
$query = "SELECT
  mlm_comm.`ACCNO`,
  client_aecode.`name`,
  client_accounts.`typeaccount`,
  SUM(amount) AS subtotal
FROM
  mlm_comm,
  client_accounts,
  client_aecode
WHERE 1=1
$filter_agen
$filter_date
AND mlm_comm.`ACCNO` = client_accounts.`accountname`
  AND client_accounts.`aecodeid` = client_aecode.`aecodeid`
GROUP BY mlm_comm.`ACCNO` ";
$result = $DB->execresultset($query);
$quick  = $result;

$query = "SELECT
  mlm_comm.`ACCNO`,
  mlm_comm.`rolldate`,
  mlm_comm.`lot`,
  mlm_comm.`amount`,
  mlm_comm.`level`,
  client_aecode.`name`,
  mlm_comm.`from`,
  (SELECT
    client_aecode.`name`
  FROM
    client_accounts,
    client_aecode
  WHERE client_accounts.`aecodeid` = client_aecode.`aecodeid`
    AND client_accounts.`accountname` = mlm_comm.`from`) AS nama2,
  client_accounts.`typeaccount`
FROM
  mlm_comm,
  client_accounts,
  client_aecode
WHERE 1=1
$filter_agen
$filter_date
AND mlm_comm.`ACCNO` = client_accounts.`accountname`
  AND client_accounts.`aecodeid` = client_aecode.`aecodeid` ";
// print_r($query);
$result = $DB->execresultset($query);

$hasil    = array();
$detailed = array();
$detailed2 = array();
$_i = 0;
foreach ($result as $key => $value) {
   $rolldate       = $value['rolldate'];
   $from_date      = date('Y-m-d', strtotime($rolldate));
   $to_date        = date('Y-m-t', strtotime($rolldate));
   $detailed[$key] = $value;
   $query          = "SELECT mlm2.mt4dt, mt4login, alias FROM mlm2, mt_database WHERE mlm2.mt4dt = mt_database.mt4dt AND ACCNO = '$value[from]'";
   $hasil          = $DB->execresultset($query);
   $datalot        = array();
   foreach ($hasil as $key1 => $value1) {

      $from_date = date('Y-m-d', (strtotime('-1 day', strtotime($from_date))));
      $query     = "SELECT SUM(VOLUME)/100 as lot FROM " . $value1['mt4dt'] . ".mt4_trades WHERE LOGIN = '$value1[mt4login]' AND CMD IN ('1', '0') AND CLOSE_TIME BETWEEN '" . $from_date . " 22:30:01' AND '" . $to_date . " 22:30:0' GROUP BY LOGIN";
      $hasil1    = $DB->execresultset($query);
      $lots      = 0;
      foreach ($hasil1 as $key2 => $value2) {
         $lots = $value2['lot'];
      }
      
      $detailed2[$_i] = $value;
      $detailed2[$_i]['LOGIN'] = $value1['mt4login'];
      $detailed2[$_i]['LOTS']  = $lots;
      $detailed2[$_i]['mt4dt'] = $value1['mt4dt'];
      $detailed2[$_i]['alias'] = $value1['alias'];
      $_i++;
   }
   // $detailed[$key]['full'] = $datalot;

}

// var_dump($detailed2);
$objPHPExcel = new PHPExcel();

// Set document properties

/*=================================
=            Set Style            =
=================================*/

$middle = array(
   'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
   ),
   'font'      => array(
      'size' => 16,
   ),
);

$headering = array(
   'fill'      => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => '3B83F7'),
   ),
   'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
   ),
   'font'      => array(
      'size' => 13,
   ),
);

$leftwithborder = array(
   'borders' => array(
      'allborders' => array(
         'style' => PHPExcel_Style_Border::BORDER_THIN,
      ),
   ),
);

$BStyle = array(
   'borders' => array(
      'outline' => array(
         'style' => PHPExcel_Style_Border::BORDER_THICK,
      ),
   ),
);

$objPHPExcel->getActiveSheet()->getStyle('A2:D2')->applyFromArray($headering);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getColumnDimension()->setAutoSize(true);
/*=====  End of Set Style  ======*/
$objPHPExcel->getActiveSheet()->getStyle("A1")->applyFromArray($middle);
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Laporan Komisi Total / Member')
            ->setCellValue('A2', 'Member ID')
            ->setCellValue('B2', 'Nama')
            ->setCellValue('C2', 'Keanggotaan')
            ->setCellValue('D2', 'komisi');
$i_row = 3;
foreach ($quick as $key => $value) {

   $objPHPExcel->getActiveSheet()->getStyle('A' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('A' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle('B' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('B' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle('C' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('C' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle('D' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('D' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   if ($value['typeaccount'] == 'agent') {
      $print_type = 'Agen';
   } else {
      $print_type = 'Nasabah';
   }
   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i_row, $value['ACCNO']);
   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $i_row, $value['name']);
   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $i_row, $print_type);
   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $i_row, $value['subtotal']);
   $i_row++;
}

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Laporan Komisi Lengkap / Member id')
            ->setCellValue('A2', 'Member ID')
            ->setCellValue('B2', 'Nama')
            ->setCellValue('C2', 'Dari Member')
            ->setCellValue('D2', 'LOGIN')
            ->setCellValue('E2', 'Keanggotaan')
            ->setCellValue('F2', 'Level')
            ->setCellValue('G2', 'Lot')
            ->setCellValue('H2', 'Komisi');
$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');

$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($headering);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getColumnDimension()->setAutoSize(true);
/*=====  End of Set Style  ======*/
$objPHPExcel->getActiveSheet()->getStyle("A1")->applyFromArray($middle);

$i_row = 3;
// var_dump($detailed2);
foreach ($detailed2 as $key => $value) {
   $i_parent = $i_row;
   $objPHPExcel->getActiveSheet()->getStyle('A' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('A' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle('B' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('B' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle('C' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('C' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle('D' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('D' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle('E' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('E' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle('F' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('F' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
   $objPHPExcel->getActiveSheet()->getStyle('G' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('G' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
   $objPHPExcel->getActiveSheet()->getStyle('H' . $i_row . '')->applyFromArray($leftwithborder);
   $objPHPExcel->getActiveSheet()->getStyle('H' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
   if ($value['typeaccount'] == 'agent') {
      $print_type = 'Agen';
   } else {
      $print_type = 'Nasabah';
   }

   $typeaccount = $value['typeaccount'];
      // tradeLogComm($typeaccount);
      if ($typeaccount == 'regular') {
         $bonus_for = 'nasabah';
      } else {
         $bonus_for = 'ae';
      }
      $query = "SELECT amount FROM imp_manage_schema WHERE mt4dt = '$value1[mt4dt]' AND bonus_for = '$bonus_for' AND level = '$value[level]'";
      // tradeLogComm($query);
      $result2  = $DB->execresultset($query);
      $amounted = 0;
      foreach ($result2 as $key2 => $value2) {
         $amounted = $value2['amount'] * $value['LOTS'];
      }

      // var_dump($value);
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A' . $i_row, $value['ACCNO']);
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B' . $i_row, $value['name']);
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C' . $i_row, $value['nama2']);
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D' . $i_row, $value['LOGIN']);
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E' . $i_row, $print_type);
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F' . $i_row, $value['level']);
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G' . $i_row, number_format($value['LOTS'], 2));
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue('H' . $i_row, $amounted);
   $i_row++;
   // foreach ($value['full'] as $key1 => $value1) {
   //    $typeaccount = $value['typeaccount'];
   //    // tradeLogComm($typeaccount);
   //    if ($typeaccount == 'regular') {
   //       $bonus_for = 'nasabah';
   //    } else {
   //       $bonus_for = 'ae';
   //    }
   //    $query = "SELECT amount FROM imp_manage_schema WHERE mt4dt = '$value1[mt4dt]' AND bonus_for = '$bonus_for' AND level = '$value[level]'";
   //    // tradeLogComm($query);
   //    $result2  = $DB->execresultset($query);
   //    $amounted = 0;
   //    foreach ($result2 as $key2 => $value2) {
   //       $amounted = $value2['amount'] * $value1['LOTS'];
   //    }

   //    // $objPHPExcel->getActiveSheet()->getStyle('C' . $i_row . '')->applyFromArray($leftwithborder);
   //    // $objPHPExcel->getActiveSheet()->getStyle('C' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   //    // $objPHPExcel->getActiveSheet()->getStyle('G' . $i_row . '')->applyFromArray($leftwithborder);
   //    $objPHPExcel->getActiveSheet()->getStyle('G' . $i_row . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

   //    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A' . $i_row, "");
   //    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B' . $i_row, "");
   //    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C' . $i_row, $value1['LOGIN']);
   //    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D' . $i_row, "");
   //    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E' . $i_row, "");
   //    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F' . $i_row, number_format($value1['LOTS'], 2));
   //    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G' . $i_row, number_format($amounted, 2));
   //    $i_row++;
   // }
   // $objPHPExcel->getActiveSheet()->getStyle('A' . $i_parent . ':G' . ($i_row - 1) . '')->applyFromArray($BStyle);

}
$objPHPExcel->setActiveSheetIndex(0)->setTitle('Summary Report');
$objPHPExcel->setActiveSheetIndex(1)->setTitle('Detailed Report');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

$fileName = "temporary_" . date('Ymd_His') . ".xls";
// Redirect output to a clientâ€™s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

/* End Of If */

/*=====          End Of Coding       ======*/
/*----------  Start Of Function  ----------*/
function tradeLogComm($msg)
{
   $fp      = fopen("trader.log", "a");
   $logdate = date("Y-m-d H:i:s => ");
   $msg     = preg_replace("/\s+/", " ", $msg);
   fwrite($fp, $logdate . $msg . "\n");
   fclose($fp);
   return;
}
