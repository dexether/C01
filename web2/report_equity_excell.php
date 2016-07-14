<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);


define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// require_once("$_SERVER[DOCUMENT_ROOT]/Classes/PHPExcel.php");
// Variabel Declaration

$from = null;
if (isset($_POST['from'])) {
    $from = $_POST['from'];
}

$to = null;
if (isset($_POST['to'])) {
    $to = $_POST['to'];
}

$rates = array();
if (isset($_POST['rates'])) {
    $rates = $_POST['rates'];
}

$kot = array();
if (isset($_POST['kot'])) {
    $kot = $_POST['kot'];
}


$accno = array();
if (isset($_POST['acc'])) {
    $accno = $_POST['acc'];
}
$meta = array();
if (isset($_POST['meta'])) {
    $meta = $_POST['meta'];
}

// Create new PHPExcel object

$objPHPExcel = new PHPExcel();

// Set document properties

$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("PHPExcel Test Document")
        ->setSubject("PHPExcel Test Document")
        ->setDescription("Test document for PHPExcel, generated using PHP classes.")
        ->setKeywords("office PHPExcel php")
        ->setCategory("Test result file");



// For Style
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1'); // Merge cell
$styleArray = array(
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => 'FF0000'),
        'size' => 13,
        'name' => 'Verdana'
        ));



$objPHPExcel->setActiveSheetIndex(0)
        ->getStyle("A3:ZZ3")
        ->applyFromArray(array("font" => array("bold" => true)));

$objPHPExcel->setActiveSheetIndex(0)
        ->getDefaultColumnDimension()
        ->setWidth('12');

$objPHPExcel->setActiveSheetIndex(0)->getStyle("A3:Z3")->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)->getRowDimension('3')->setRowHeight(-1);
// $objPHPExcel->setActiveSheetIndex(0)->getRowDimension('3')->setRowWitdh(-1);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->applyFromArray($styleArray);

$query_accnya = null;
for ($i_acc = 0; $i_acc < count($accno); $i_acc++) {
    $query_accnya = $query_accnya . ",'" . $accno[$i_acc] . "'";
}
$query_acc = " and  mt4_weekly.LOGIN in (''" . $query_accnya . ")";

$query = "SELECT mt4_weekly.LOGIN, NTR, LEFT(mt4_weekly.TIME, 10) AS TIME2
        FROM " . $meta . ".mt4_weekly, acc_kota 
        WHERE 
        mt4_weekly.LOGIN = acc_kota.login
 $query_acc
  AND  LEFT(mt4_weekly.TIME, 10) BETWEEN ('$from') AND ('$to');
        ORDER BY mt4_weekly.TIME ASC";
$do = $DB->execresultset($query);
$l = array();
foreach ($do as $row) {
    $semuadatas[] = $row['TIME2'];
    $l[] = $row['LOGIN'];
}
$filter_l = array_unique($l);
$filter_log = array();
$semuadatas = array();
foreach ($filter_l as $fl) {
    $filter_log[] = $fl;
}
$filter_date = array_unique($semuadatas);
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(0, 1, 'SPECIAL ACCOUNTS')
        ->setCellValueByColumnAndRow(0, 3, 'DATE');
$i_date = 4;
for ($a = 0; $a < count($filter_date); $a++) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0, $i_date, $filter_date[$a]);
    $i_date++;
}
$i_acc = 1;
for ($b = 0; $b < count($filter_log); $b++) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i_acc, 3, $filter_log[$b]);
    $i_acc++;
}
/* $objPHPExcel->setActiveSheetIndex(0)
  ->setCellValueByColumnAndRow(1 ,3, 'ACCC 1000')
  ->setCellValueByColumnAndRow(2 ,3, 'ACCC 2000')
  ->setCellValueByColumnAndRow(3 ,3, 'ACCC 3000')
  ->setCellValueByColumnAndRow(4 ,3, 'ACCC 4000')
  ->setCellValueByColumnAndRow(5 ,3, 'ACCC 5000'); */

$i_col = 4;
for ($i = 0; $i < count($filter_date); $i++) {
    $i_row = 1;
    foreach ($filter_log as $acc_row) {
        $q = "SELECT LOGIN, NTR, TIME FROM " . $meta . ".`mt4_weekly` WHERE LEFT(TIME, 10) = '$filter_date[$i]' AND LOGIN = '$acc_row'";
        $hasil = $DB->execresultset($q);
        $NTR = 0;
        foreach ($hasil as $r) {

            $NTR = $r['NTR'];
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i_row ,4, $NTR);
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i_row, $i_col, $NTR);
        $i_row++;
    }
    $i_col++;
}




// Rename worksheet

$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file

$fileName = "ReportNTR-" . $user->username . "-" . date('His');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// $objWriter->save('Form-','tmp');
$objWriter->save(str_replace(__FILE__, 'tmp/' . $fileName . '.xlsx', __FILE__));

echo "tmp/" . $fileName;
?>