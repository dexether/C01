<?php
/*
For Production reason Error reporting will disable
 */
// http://cabinet.dev/web2/daily_statement.php?account=60000202&datesearch=2016-03-09&mt4dt=sibfx_source&excell=yes

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
$datesearch = null;
if (isset($_GET['datesearch'])) {
	$datesearch = $_GET['datesearch'];
}
$mt4dt = null;
if (isset($_GET['mt4dt'])) {
	$mt4dt = $_GET['mt4dt'];
}
$excell = "no";
if (isset($_GET['excell'])) {
    $excell = $_GET['excell'];
}
$query = "SELECT logo FROM mt_database WHERE mt4dt = '".$mt4dt."'";
$result = $DB->execresultset($query);
foreach ($result as $row) {
    $logo = $row['logo'];
}

$statements[$account] = fetch_DailyStatement($account, $datesearch, $mt4dt, $mysql['database']);
// echo "<pre>";
// print_r($statements);
// echo "</pre>";
// var_dump($statements);
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
        ->setCellValue('B4', number_format($statement['BALANCE_PREV'], 2))
        ->setCellValue('B5', number_format($statement['MarginIN'] , 2))
        ->setCellValue('B6', number_format($statement['MarginOUT'], 2))
        ->setCellValue('B7', number_format($statement['PL'], 2))
        ->setCellValue('C4', 'Floating P/L,Interest,Commission,Adjustment')
        ->setCellValue('C5', 'Equity')
        ->setCellValue('C6', 'Margin Required')
        ->setCellValue('C7', 'Free Margin')
        ->setCellValue('C8', 'Equity Ratio')
        ->setCellValue('D4', number_format($statement['floatingALL'], 2))
        ->setCellValue('D5', number_format($statement['EQUITY'], 2))
        ->setCellValue('D6', number_format($statement['MARGIN'] , 2))
        ->setCellValue('D7', number_format($statement['MARGIN_FREE'], 2))
        ->setCellValue('D8', $statement['eqratio']);

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
        ->setCellValue('A6', 'ITEM')
        ->setCellValue('B6', 'UNITS')
        ->setCellValue('C6', 'OPEN')
        ->setCellValue('D6', 'BUY')
        ->setCellValue('E6', 'SELL')
        ->setCellValue('F6', 'LIQ. DATE')
        ->setCellValue('G6', 'LIQ. PRICE')
        ->setCellValue('H6', 'COMM.')
        ->setCellValue('I6', 'PL')
        ->setCellValue('J6', 'META ID');
        $objPHPExcel->getActiveSheet()->getStyle('A6:J6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A6:J6')->applyFromArray($styleArray2);
        if(count($statement['settled']) >=1 ) {
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
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$i_row, number_format($settledposition['UNIT'] , 2 ));
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$i_row, $settledposition['OPEN_TIME']);
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'.$i_row, $settledposition['BuyPrice']);
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'.$i_row, $settledposition['SellPrice']);
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$i_row, $settledposition['CLOSE_TIME']);
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$i_row, $settledposition['CLOSE_PRICE']);
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('H'.$i_row, number_format($settledposition['COMMISSION'], 2));
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('I'.$i_row, number_format($settledposition['PROFIT'],2)) ;
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('J'.$i_row, $settledposition['TICKET']);
                $i_row++;

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
        ->setCellValue('A6', 'ITEM')
        ->setCellValue('B6', 'UNITS')
        ->setCellValue('C6', 'OPEN')
        ->setCellValue('D6', 'BUY')
        ->setCellValue('E6', 'SELL')
        ->setCellValue('F6', 'CLOSING')
        ->setCellValue('G6', 'TRADE P / L')
        ->setCellValue('H6', 'COMMISSION')
        ->setCellValue('I6', 'META ID');
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($styleArray2);
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
                $objPHPExcel->getActiveSheet()->getStyle('I'.$i_row.'')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('I'.$i_row.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);


                
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A'.$i_row, $openposition['SYMBOL']);
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue('B'.$i_row, number_format($openposition['Unit'],2));
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue('C'.$i_row, $openposition['OPEN_TIME']);
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue('D'.$i_row, $openposition['BuyPrice']);
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue('E'.$i_row, $openposition['SellPrice']);
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue('F'.$i_row, $openposition['CurrentPrice']);
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue('G'.$i_row, number_format($openposition['Floating'], 2));
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue('H'.$i_row, number_format($openposition['COMMISSION'], 2));
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue('I'.$i_row, $openposition['TICKET']);
                $i_row++;
            }
        }else{
            $objPHPExcel->getActiveSheet()->mergeCells('A7:I7');
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
        $objPHPExcel->setActiveSheetIndex(2)->mergeCells('A5:I5');
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
        $objDrawing->setOffsetX(50);
        $objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex(2));
        $objPHPExcel->setActiveSheetIndex(0)->setTitle('TEMPORARY');
        $objPHPExcel->setActiveSheetIndex(1)->setTitle('SETTLED POSITION');
        $objPHPExcel->setActiveSheetIndex(2)->setTitle('OPEN POSITION');
        $fileName = $account."_daily_".date('Ymd').".xls";
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
    // var_dump($logo);
    $template->assign("statements", $statements);
    $template->display("daily_statement.htm");
}
/*===== 		 End Of Coding       ======*/

function ToExcel($namaFile) {
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:attachment;filename=$namaFile");
    header("Expires:0");
    header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
    header("Pragma: public");
}

function fetch_DailyStatement($account, $datesearch, $mysql_meta, $mysql_database) {
    global $DB;
    $query = "SELECT LOGIN," . $mysql_meta . ".mt4_daily.* 
    FROM " . $mysql_meta . ".mt4_daily WHERE login = '$account' AND LEFT(TIME,10) = '$datesearch' ";
    //tradelog("mt4_daily_statement-207-" . $query);
    $result = $DB->execresultset($query);
    foreach($result as $row) {
        $row['PL'] = $row['PROFIT_CLOSED'];
        $statement = $row;
    }	

    $query = "SELECT kliringlogin,branch,acc_kota.group as thegroup,comment,rate FROM acc_kota where login='" . $account . "'";
    //tradelog("mt4_daily_statement-313-" . $query);
    $result = $DB->execresultset($query);
    foreach($result as $row) {
        $statement['kliringlogin'] = $row['kliringlogin'];
        $statement['branch'] = $row['branch'];
        $statement['thegroup'] = $row['thegroup'];
        $statement['comment'] = $row['comment'];
        $statement['rate'] = $row['rate'];
    }

    $query = "SELECT * FROM " . $mysql_meta . ".mt4_trades 
    WHERE login = '$account' AND cmd IN ('6') 
    AND LEFT(OPEN_TIME,10) = '$datesearch' ";
    //tradelog("mt4_daily_statement-228-" . $query);
    $result = $DB->execresultset($query);
    $statement['MarginOUT'] = 0;
    $statement['MarginIN'] = 0;
    foreach($result as $row) {
        if ($row['PROFIT'] < 0) {
            $statement['MarginOUT'] = $statement['MarginOUT'] + $row['PROFIT'];
        } else {
            $statement['MarginIN'] = $statement['MarginIN'] + $row['PROFIT'];
        }
    }

    $query = "SELECT * 
    FROM " . $mysql_meta . ".mt4_trades 
    WHERE login = '$account' AND cmd IN ('0','1') 
    AND LEFT(CLOSE_TIME,10) = '$datesearch' ";
    //tradelog("mt4_daily_statement-243-" . $query);
    $result = $DB->execresultset($query);
    foreach($result as $row) {
        //$statement[PL] = $statement[PL] + $row[PROFIT];
        $statement['COMM'] = $statement['COMM'] + $row['COMMISSION'];
        //tradelog("mt4_daily_statement-347-Commission:" . $row[COMMISSION]);
        $statement['SWAPS'] = $statement['SWAPS'] + $row['SWAPS'];

        //tradelog("mt4_daily_statement-348-SWAPS:" . $row[SWAPS]);
    }
    $statement['floatingALL'] = $statement['EQUITY'] - $statement['BALANCE_PREV'] - $statement['MarginIN'] - $statement['MarginOUT'] - $statement['PL'];

    $statement['eqStatus'] = "Normal";
    if ($statement['MARGIN'] == '0' || $statement['MARGIN'] == '') {
        $statement['eqratio'] = "~%";
    } else {
        $statement['eqratio'] = number_format($statement['EQUITY'] * 100 / $statement['MARGIN'], 2, ".", "") . "%";
    }

    $query = "SELECT * FROM " . $mysql_meta . ".mt4_trades 
    WHERE cmd IN ('0','1') and login = '" . $account . "'  
    AND LEFT(CLOSE_TIME,10) = '" . $datesearch . "'
    ORDER BY TICKET DESC";
    //tradelog("mt4_daily_statement-272-query:" . $query);
    $result = $DB->execresultset($query);
    
    foreach($result as $row) {
        $row['Unit'] = $row['VOLUME'] / 100;
        if ($row['CMD'] == '0') {
            $row['BuyPrice'] = $row['OPEN_PRICE'];
            $row['SellPrice'] = '';
        } else {
            $row['BuyPrice'] = '';
            $row['SellPrice'] = $row['OPEN_PRICE'];
        }
        $statement['settled'][] = $row;
    }

    $query = "SELECT * FROM " . $mysql_meta . ".mt4_trades 
    WHERE cmd IN ('0','1') and login = '" . $account . "'  
    AND 
    (
    (LEFT(CLOSE_TIME,10) > '" . $datesearch . "' AND LEFT(OPEN_TIME,10) <= '" . $datesearch . "')
    OR 
    (
    CLOSE_TIME ='1970-01-01 00:00:00'
    AND LEFT(OPEN_TIME,10) <= '" . $datesearch . "'        
    )
    ) 
    ORDER BY TICKET DESC";
    //tradelog("mt4_daily_statement-297-query:" . $query);
    $result = $DB->execresultset($query);
    foreach($result as $row) {
        $row['Unit'] = $row['VOLUME'] / 100;
        if ($row['CMD'] == '0') {
            $row['BuyPrice'] = $row['OPEN_PRICE'];
            $row['SellPrice'] = '';
        } else {
            $row['BuyPrice'] = '';
            $row['SellPrice'] = $row['OPEN_PRICE'];
        }
        $symbols_array[] = $row['SYMBOL'];
        $positions[] = $row;
    }
    // tradelog("mt4_daily_statement-128-query:" . count($positions));

    $query_symbol = null;
    for ($i_symbol = 0; $i_symbol < count($symbols_array); $i_symbol++) {
        $symbol = $symbols_array[$i_symbol];
        $query_symbol = $query_symbol . ",'" . $symbol . "'";
    }

    $query = "SELECT * FROM day_end_counter 
    WHERE rolldate<='$datesearch' and counter in (''" . $query_symbol . ")
    ORDER BY counter ASC,rolldate desc limit 0,1";
    //tradelog("mt4_daily_statement-314-query=" . $query);
    $result = $DB->execresultset($query);
    foreach($result as $row) {
        $rendah[$row['counter']] = $row['bid'];
        $tinggi[$row['counter']] = $row['ask'];
    }
    $query = "SELECT lotsize,counter FROM counter_com WHERE counter in (''" . $query_symbol . ")";
    $result = $DB->execresultset($query);
    foreach($result as $row) {
        $lotsize[$row['counter']] = $row['lotsize'];
    }

    if (count($positions) > 0) {
        $positions = array_reverse($positions);
        foreach ($positions AS $row) {
            while (list($key, $val) = each($row)) {
                $row[$key] = trim($val);
            }
            //tradelog("mt4_daily_statement-326-Symbol:" . $row[SYMBOL] . ";TICKET:" . $row[TICKET] . ";CMD:" . $row[CMD]);
            if ($row['CMD'] == '0') {
                $row['CurrentPrice'] = $rendah[$row['SYMBOL']];
                //tradelog("mt4_daily_statement-330-Price:" . $row[CLOSE_PRICE]);
            } else {
                $row['CurrentPrice'] = $tinggi[$row['SYMBOL']];
                //tradelog("mt4_daily_statement-333-Price:" . $row[CLOSE_PRICE]);
            }
            if ($row['CMD'] == '0') {
                $row['Floating'] = ($row['CurrentPrice'] - $row['BuyPrice']) * $row['Unit'] * $lotsize[$row['SYMBOL']];
                //tradelog("mt4_daily_statement-341-Lotsize:" . $lotsize[$row[SYMBOL]]);
                if (preg_match("/(^USD\/.+|^U(J|C)\d)/", $row['SYMBOL'])) {
                    $row['Floating'] = $row['Floating'] / $row['CurrentPrice'];
                    //tradelog("mt4_daily_statement-352-CurrentPrice=" . $row[CurrentPrice]);
                }
                if (preg_match("/(^USD.+|^U(J|C)\d)/", $row['SYMBOL'])) {
                    $row[Floating] = $row['Floating'] / $row['CurrentPrice'];
                    //tradelog("mt4_daily_statement-352-CurrentPrice=" . $row[CurrentPrice]);
                }
                if (substr($row['SYMBOL'], 0, 7) == "EUR/GBP") {
                    global $DB_quote;
                    $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'GBP A0-FX'";
                    $result = $DB_quote->query($query);
                    $row_quote = mysql_fetch_array($result);
                    $lastclosing = $row_quote['last'];
                    unset($row_quote);
                    include("includes/globals.php");
                    $row['Floating'] = $row['Floating'] * $lastclosing;
                }
                if (substr($row['SYMBOL'], 0, 7) == "EUR/CHF") {
                    global $DB_quote;
                    $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'CHF A0-FX'";
                    $result = $DB_quote->query($query);
                    $row_quote = mysql_fetch_array($result);
                    $lastclosing = $row_quote['last'];
                    unset($row_quote);
                    include("includes/globals.php");
                    $row['Floating'] = $row['Floating'] / $lastclosing;
                }
                if (substr($row['SYMBOL'], 0, 7) == "EUR/JPY" || substr($row['SYMBOL'], 0, 7) == "EURJPY2") {
                    global $DB_quote;
                    $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
                    $result = $DB_quote->query($query);
                    $row_quote = mysql_fetch_array($result);
                    $lastclosing = $row_quote['last'];
                    unset($row_quote);
                    include("includes/globals.php");
                    $row['Floating'] = $row['Floating'] / $lastclosing;
                }
                if (substr($row['SYMBOL'], 0, 7) == "GBP/JPY") {
                    global $DB_quote;
                    $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
                    $result = $DB_quote->query($query);
                    $row_quote = mysql_fetch_array($result);
                    $lastclosing = $row_quote['last'];
                    unset($row_quote);
                    include("includes/globals.php");
                    $row['Floating'] = $row['Floating'] / $lastclosing;
                }
            } else {
                $row['Floating'] = ($row['SellPrice'] - $row['CurrentPrice']) * $row['Unit'] * $lotsize[$row['SYMBOL']];
                //tradelog("mt4_daily_statement-397-Counter:".$row[SYMBOL].";CurrentPrice=" . $row[CurrentPrice]);
                if (preg_match("/(^USD\/.+|^U(J|C)\d)/", $row['SYMBOL'])) {
                    $row['Floating'] = $row['Floating'] / $row['CurrentPrice'];
                    //tradelog("mt4_daily_statement-399-Floating:".$row[Floating].";CurrentPrice=" . $row[CurrentPrice]);
                }
                if (preg_match("/(^USD.+|^U(J|C)\d)/", $row['SYMBOL'])) {
                    $row['Floating'] = $row['Floating'] / $row['CurrentPrice'];
                    //tradelog("mt4_daily_statement-404-Floating:".$row[Floating].";CurrentPrice=" . $row[CurrentPrice]);
                }
                if (substr($row['SYMBOL'], 0, 7) == "EUR/GBP") {
                    global $DB_quote;
                    $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'GBP A0-FX'";
                    $result = $DB_quote->query($query);
                    $row_quote = mysql_fetch_array($result);
                    $lastclosing = $row_quote['last'];
                    unset($row_quote);
                    include("includes/globals.php");
                    $row['Floating'] = $row['Floating'] * $lastclosing;
                }
                if (substr($row['SYMBOL'], 0, 7) == "EUR/CHF") {
                    //tradelog("tempstatement Sell New-".$row[SYMBOL]);
                    global $DB_quote;
                    $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'CHF A0-FX'";
                    $result = $DB_quote->query($query);
                    $row_quote = mysql_fetch_array($result);
                    $lastclosing = $row_quote['last'];
                    unset($row_quote);
                    include("includes/globals.php");
                    $row['Floating'] = $row['Floating'] / $lastclosing;
                }
                if (substr($row['SYMBOL'], 0, 7) == "EUR/JPY" || substr($row[SYMBOL], 0, 7) == "EURJPY2") {
                    global $DB_quote;
                    $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
                    $result = $DB_quote->query($query);
                    $row_quote = mysql_fetch_array($result);
                    $lastclosing = $row_quote['last'];
                    unset($row_quote);
                    include("includes/globals.php");
                    $row['Floating'] = $row['Floating'] / $lastclosing;
                }
                if (substr($row['SYMBOL'], 0, 7) == "GBP/JPY") {
                    //tradelog("tempstatement Sell New-".$row[SYMBOL]);
                    global $DB_quote;
                    $query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
                    $result = $DB_quote->query($query);
                    $row_quote = mysql_fetch_array($result);
                    $lastclosing = $row_quote[last];
                    unset($row_quote);
                    include("includes/globals.php");
                    $row['Floating'] = $row['Floating'] / $lastclosing;
                }
            }
            $statement['open'][] = $row;

        }
    }
    $usercompanyname = 'companyname';
    $statement['usercompanyname'] = $usercompanyname;

    return $statement;

}



?>