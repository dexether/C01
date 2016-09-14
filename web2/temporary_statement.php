<?php
/*
For Production reason Error reporting will disable
*/
error_reporting(0);

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
$var_to_pass = null;
global $user;
global $template;
//tradeLogConstruct("UnderConstruct.php-Line-9");
/*=============================================
=            Start Of Coding                 =
=============================================*/
$account = null;
if (isset($_GET['account'])) {
	$account = $_GET['account'];
}
$mt4dt = null;
if (isset($_GET['mt4dt'])) {
	$mt4dt = $_GET['mt4dt'];
}
$excell = "no";
if (isset($_GET['excell'])) {
	$excell = $_GET['excell'];
}
$query = "SELECT TIME FROM " . $mt4dt . ".mt4_daily ORDER BY TIME DESC LIMIT 0,1";
$result = $DB->execresultset($query);
$timeakhir = "1970-01-30 23:59:59";
foreach ($result as $row) {
	$timeakhir = $row['TIME'];
}
$query = "SELECT logo FROM mt_database WHERE mt4dt = '".$mt4dt."'";
$result = $DB->execresultset($query);
foreach ($result as $row) {
	$logo = $row['logo'];
}

$statements[$account] = fetchStatement($account, $mt4dt, $timeakhir);
/*echo "<pre>";
	print_r($statements);
	echo "</pre>";*/
/* Start IF */
	if($excell =="yes") {
	// ToExcel('Reporting.xls');
		$objPHPExcel = new PHPExcel();
		/* For Stye */
		$styleArray2 = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN        
					),
				),
			);
		foreach($statements as $statement) {

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('PHPExcel logo');
			$objDrawing->setDescription('PHPExcel logo');
			$objDrawing->setPath($logo);
			$objDrawing->setHeight(60);
			$objDrawing->setCoordinates('B1');
			$objDrawing->setOffsetX(10);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A4', 'Previous Balance')
			->setCellValue('A5', 'Margin In')
			->setCellValue('A6', 'Margin Out')
			->setCellValue('A7', 'Profit / Loss')
			->setCellValue('B4', number_format($statement['status']['PREVBALANCE'], $statement['status']['user_decimal']))
			->setCellValue('B5', number_format($statement['status']['MARGININ'] , $statement['status']['user_decimal']))
			->setCellValue('B6', number_format($statement['status']['MARGINOUT'], $statement['status']['user_decimal']))
			->setCellValue('B7', number_format($statement['status']['PL'], $statement['status']['user_decimal']))
			->setCellValue('C4', 'Floating P/L,Interest,Commission,Adjustment')
			->setCellValue('C5', 'Equity')
			->setCellValue('C6', 'Margin Required')
			->setCellValue('C7', 'Free Margin')
			->setCellValue('C8', 'Equity Ratio')
			->setCellValue('D4', number_format($statement['status']['floatingsemua'], $statement['status']['user_decimal']))
			->setCellValue('D5', number_format($statement['status']['EQUITY'], $statement['status']['user_decimal']))
			->setCellValue('D6', number_format($statement['status']['MARGIN'] , $statement['status']['user_decimal']))
			->setCellValue('D7', number_format($statement['status']['MARGIN_FREE'], $statement['status']['user_decimal']))
			->setCellValue('D8', $statement['status']['eqratio']);

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(21);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(42);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
			$objPHPExcel->getActiveSheet()->getStyle('A4:D8')->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle('D4:D8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle('B4:B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(1)
			->setCellValue('A5', 'SETTLED POSITION')
			->setCellValue('A6', 'Meta Traderid')
			->setCellValue('B6', 'Item')
			->setCellValue('C6', 'Units')
			->setCellValue('D6', 'Open')
			->setCellValue('E6', 'BUY')
			->setCellValue('F6', 'SELL')
			->setCellValue('G6', 'LIQ. DATE')
			->setCellValue('H6', 'LIQ. PRICE')
			->setCellValue('I6', 'COMM')
			->setCellValue('J6', 'PL');
			$objPHPExcel->getActiveSheet()->getStyle('A6:J6')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A6:J6')->applyFromArray($styleArray2);
			if(count($statement['settled']) > 0 ) {
				$i_row = 7;
				foreach($statement['settled'] as $settledposition) {

					$objPHPExcel->getActiveSheet()->getStyle('A'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('F'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('F'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('G'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('G'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('H'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('H'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('I'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('I'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('J'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('J'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

					$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$i_row, $settledposition['SYMBOL']);
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$i_row, number_format($settledposition['Unit'] , 2));
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$i_row, $settledposition['OPEN_TIME']);
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'.$i_row, $settledposition['BuyPrice']);
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'.$i_row, $settledposition['SellPrice']);
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$i_row, $settledposition['CLOSE_TIME']);
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$i_row, $settledposition['CLOSE_PRICE']);
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H'.$i_row, number_format($settledposition['COMMISSION'], 2));
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I'.$i_row, number_format($settledposition['PROFIT'], 2));
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J'.$i_row, $settledposition['TICKET']);

				}
			}else{
				$objPHPExcel->getActiveSheet()->mergeCells('A7:J7');
				$objPHPExcel->getActiveSheet()->setCellValue('A7', 'NO DATA ');
				$objPHPExcel->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('A7')->getFont()->setItalic(true);
				$objPHPExcel->getActiveSheet()->getStyle('A7:J7')->applyFromArray($styleArray2);
			}
			$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setName('Arial');
			$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setSize(15);
			$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A6:J6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(18);
			$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A5:J5');
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(2)
			->setCellValue('A5', 'OPEN POSITION')
			->setCellValue('A6', 'META ID')
			->setCellValue('B6', 'ITEMS')
			->setCellValue('C6', 'UNITS')
			->setCellValue('D6', 'DATE')
			->setCellValue('E6', 'BOUGHT')
			->setCellValue('F6', 'SOLD')
			->setCellValue('G6', 'CLOSING')
			->setCellValue('H6', 'FLOATING PL');
			$objPHPExcel->getActiveSheet()->getStyle('A6:H6')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A6:H6')->applyFromArray($styleArray2);
			$i_row = 7;
			if(count($statement['open']) > 0) {
				foreach($statement['open'] as $openposition) {
					if($openposition['CMD']=="0") {
						$conditional = $openposition['OPEN_PRICE'];
						$conditional2 = "-";
					}elseif($openposition['CMD']=="1"){
						$conditional = "-";
						$conditional2 = $openposition['OPEN_PRICE'];
					}
					$objPHPExcel->getActiveSheet()->getStyle('A'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('F'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('F'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('G'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('G'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('H'.$i_row.'')->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->getStyle('H'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);


					$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A'.$i_row, $openposition['TICKET']);
					$objPHPExcel->setActiveSheetIndex(2)->setCellValue('B'.$i_row, $openposition['SYMBOL']);
					$objPHPExcel->setActiveSheetIndex(2)->setCellValue('C'.$i_row, number_format($openposition['Unit'],2));
					$objPHPExcel->setActiveSheetIndex(2)->setCellValue('D'.$i_row, $openposition['OPEN_TIME']);
					$objPHPExcel->setActiveSheetIndex(2)->setCellValue('E'.$i_row, $conditional);
					$objPHPExcel->setActiveSheetIndex(2)->setCellValue('F'.$i_row, $conditional2);
					$objPHPExcel->setActiveSheetIndex(2)->setCellValue('G'.$i_row, $openposition['CLOSE_PRICE']);
					$objPHPExcel->setActiveSheetIndex(2)->setCellValue('H'.$i_row, number_format($openposition['PL'] , $statement['status']['user_decimal']));
					$i_row++;
				}
			}else{
				$objPHPExcel->getActiveSheet()->mergeCells('A7:H7');
				$objPHPExcel->getActiveSheet()->setCellValue('A7', 'NO DATA ');
				$objPHPExcel->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('A7')->getFont()->setItalic(true);
				$objPHPExcel->getActiveSheet()->getStyle('A7:H7')->applyFromArray($styleArray2);
			}
			$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setName('Arial');
			$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setSize(15);
			$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(18);
			$objPHPExcel->setActiveSheetIndex(2)->mergeCells('A5:H5');
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('PHPExcel logo');
			$objDrawing->setDescription('PHPExcel logo');
			$objDrawing->setPath($logo);
			$objDrawing->setHeight(60);
			$objDrawing->setCoordinates('E1');
			$objDrawing->setOffsetX(0);
			$objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex(1));
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('PHPExcel logo');
			$objDrawing->setDescription('PHPExcel logo');
			$objDrawing->setPath($logo);
			$objDrawing->setHeight(60);
			$objDrawing->setCoordinates('D1');
			$objDrawing->setOffsetX(0);
			$objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex(2));
			$objPHPExcel->setActiveSheetIndex(0)->setTitle('TEMPORARY');
			$objPHPExcel->setActiveSheetIndex(1)->setTitle('SETTLED POSITION');
			$objPHPExcel->setActiveSheetIndex(2)->setTitle('OPEN POSITION');
			$fileName = $account."_temporary_".date('Ymd_His').".xls";
			$objPHPExcel->setActiveSheetIndex(0);
				// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$fileName.'"');
			header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;

	}
}else{
	$template->assign("logo", $logo);
	$template->assign("statements", $statements);
	$template->display("temporary_statement.htm");
}

/* End Of If */

/*===== 		 End Of Coding       ======*/
/*----------  Start Of Function  ----------*/
function fetchStatement($account, $mysql_meta, $timeakhir) {
	global $DB;
	$statement = array();
// Get reminding Account Status Details
	$query = "SELECT " . $mysql_meta . ".mt4_users.*
	FROM " . $mysql_meta . ".mt4_users
	WHERE login ='$account' ";
//tradeLog("227;query:".$query);
	$result = $DB->execresultset($query);
	foreach($result as $row) {
		$status = $row;
		$status['user_decimal'] = '2';
	}
	$query = "SELECT mt4_trades.*
	FROM " . $mysql_meta . ".mt4_trades
	WHERE login ='$account'
	AND CMD IN ('0','1') and CLOSE_TIME ='1970-01-01 00:00:00'
	order by  mt4_trades.TICKET desc
	";
//tradelog("tempstatement-181=" . $query);
	$result = $DB->execresultset($query);
	foreach($result as $row) {
		$row['ACCNO'] = $row['LOGIN'];
//tradelog("Temp_Statement-185-ACCNO:" . $row[ACCNO]);
		$positions[] = $row;
	}
	$query = "SELECT mt4_trades.*
	FROM " . $mysql_meta . ".mt4_trades
	WHERE login ='$account'
	AND CMD IN ('0','1') and CLOSE_TIME > '$timeakhir'
	order by  mt4_trades.TICKET desc
	";
//tradelog("tempstatement-211=" . $query);
	$result = $DB->execresultset($query);
	foreach($result as $row) {
		$row['ACCNO'] = $row['LOGIN'];
//tradelog("Temp_Statement-185-ACCNO:" . $row[ACCNO]);
		$positions[] = $row;
	}
	if (count($positions) > 0) {
//$positions = array_reverse($positions);
		$status['PL'] = 0;
		$statement['settled'] = array();
		foreach ($positions AS $row) {
			while (list($key, $val) = each($row)) {
				$row[$key] = trim($val);
			}
			$counter_decimal = $row['DIGITS'] + 1;
			$row['Commission'] = number_format($row['COMMISSION'], 2, ".", "");
			$row['FLCOMM'] = number_format($row['COMMISSION'], 2, ".", "");
			$row['PL'] = number_format($row['PROFIT'], 2, ".", "");
//tradeLog("B_Open_position_report2-345=" . $row[TICKET]);
			$row['Unit'] = $row['VOLUME'] / 100;
			$TotalFloating = 0;
			if ($row['CMD'] == '0') {
				$row['BuyPrice'] = number_format($row['OPEN_PRICE'], $counter_decimal, ".", "");
				$row['BuyDisplayDate'] = substr($row['OPEN_TIME'], 6, 2) . "/" . substr($row['OPEN_TIME'], 4, 2) . "/" . substr($row['OPEN_TIME'], 0, 4);
				$row['CurrentPrice'] = $row['CLOSE_PRICE'];
				$row['Floating'] = $row['PROFIT'];
				$TotalFloating += $row['Floating'] + $row['FLCOMM'];
			} else {
				$row['SellPrice'] = number_format($row['OPEN_PRICE'], $counter_decimal, ".", "");
				$row['SellDisplayDate'] = substr($row['OPEN_TIME'], 6, 2) . "/" . substr($row['OPEN_TIME'], 4, 2) . "/" . substr($row['OPEN_TIME'], 0, 4);
				$row['CurrentPrice'] = $row['CLOSE_PRICE'];
				$row['Floating'] = $row['PROFIT'];
				$TotalFloating += $row['Floating'] + $row['FLCOMM'];
			}
			if ($row['CLOSE_TIME'] == '1970-01-01 00:00:00') {
				$statement['open'][] = $row;
			} else {
				$status['PL'] = $status['PL'] + $row['PROFIT'];
				$statement['settled'][] = $row;
			}
		}
	}

	$query = "SELECT mt4_trades.*
	FROM " . $mysql_meta . ".mt4_trades
	WHERE login ='$account'
	AND CMD IN ('6','7')
	and OPEN_TIME > '$timeakhir'
	order by mt4_trades.TICKET desc
	";
//tradelog("tempstatement-246=" . $query);
	$result = $DB->execresultset($query);
	$status['MARGININ'] = 0;
	$status['MARGINOUT'] = 0;
	foreach($result as $row) {
//tradelog("tempstatement-249=" . $row[CMD]);
		if ($row['CMD'] == '6') {
			$status['MARGININ'] = $status['MARGININ'] + $row['PROFIT'];
		}
		if ($row[CMD] == '7') {
			$status['MARGINOUT'] = $status['MARGINOUT'] + $row['PROFIT'];
		}
//tradelog("tempstatement-249=MarginIn:" . $status[MARGININ]);
	}
	$status['floatingsemua'] = $status['EQUITY'] - $status['PREVBALANCE'] - $status['MARGININ'] - $status['MARGINOUT'] - $status['PL'];
	if ($status['MARGIN'] == '0' || $status['MARGIN'] == '') {
		$status['eqratio'] = "~%";
	} else {
		$status['eqratio'] = number_format($status['EQUITY'] * 100 / $status['MARGIN'], 2, ".", "") . "%";
	}
	$statement['status'] = $status;
	return $statement;
}

?>