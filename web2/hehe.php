<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/mail/PHPMailerAutoload.php");


/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);


define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// require_once("$_SERVER[DOCUMENT_ROOT]/Classes/PHPExcel.php");


// Variabel Declaration

// Create new PHPExcel object
$mail = new PHPMailer();
$objPHPExcel = new PHPExcel();

// Set document properties

$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                             ->setLastModifiedBy("Maarten Balliauw")
                             ->setTitle("PHPExcel Test Document")
                             ->setSubject("PHPExcel Test Document")
                             ->setDescription("Test document for PHPExcel, generated using PHP classes.")
                             ->setKeywords("office PHPExcel php")
                             ->setCategory("Test result file");

// FOr Style
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:H1'); // Merge cell
$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FF0000'),
        'size'  => 13,
        'name'  => 'Verdana'
    )

    );
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A1:H1")
     ->getAlignment()
     ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)->getStyle("A3:H3")
     ->getAlignment()
     ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->applyFromArray($styleArray);
$objPHPExcel->setActiveSheetIndex(0)
        ->getDefaultColumnDimension()
        ->setWidth('15');


$styleArray2 = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN        
        ),
    ),
);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:H3')->applyFromArray($styleArray2);
$objPHPExcel->setActiveSheetIndex(0)
    ->getStyle("A3:H3")
    
    ->applyFromArray(array("font" => array( "bold" => true)));


$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0 ,1, "Report Equity Turnover Running")
                                    ->setCellValueByColumnAndRow(0 ,3, "Broker")
                                    ->setCellValueByColumnAndRow(1 ,3, "Rate")
                                    ->setCellValueByColumnAndRow(2 ,3, "Type")
                                    ->setCellValueByColumnAndRow(3 ,3, "Account")
                                    ->setCellValueByColumnAndRow(4 ,3, "Default Margin")
                                    ->setCellValueByColumnAndRow(5 ,3, "Free Margin")
                                    ->setCellValueByColumnAndRow(6 ,3, "Default TurnOver")
                                    ->setCellValueByColumnAndRow(7 ,3, "Turnover");



/**
 * This For Query
 */
  function fetchStatement2($login, $turnover2, $report_turnover_equity) {
            global $DB;
            $turnover2['ikuttampil1'] = "tidak";
            $turnover2['ikuttampil2'] = "tidak";
            $query = "SELECT mt4_users.MARGIN_FREE FROM " . $turnover2['mt4dt'] . ".mt4_users 
                WHERE login = '$login';";
            //tradeLogReport_Summary_Client("Report_TurnOver_Running-124:" . $query);
            $rows = $DB->execresultset($query);
            foreach ($rows as $row) {
                //tradeLogReport_Summary_Client("Report_TurnOver_Running-81");
                $turnover2['MARGIN_FREE'] = $row['MARGIN_FREE'];
                $default_rate = $report_turnover_equity['forexfixmargin'];
                $default_turnover = $report_turnover_equity['forexfixturnover'];
                if ($turnover2['rate'] == '1') {
                    $default_rate = $report_turnover_equity['indexfixmargin'];
                    $default_turnover = $report_turnover_equity['indexfixturnover'];
                }
                if ($turnover2['rate'] == '0') {
                    $default_rate = $report_turnover_equity['floatingmargin'];
                    $default_turnover = $report_turnover_equity['floatingturnover'];
                }
                if ($turnover2['regular'] == 'mini') {
                    $default_turnover = $default_turnover / 10;
                    $default_rate = $default_rate / 10;
                }
                $turnover2['DEFAULTRATE'] = $default_rate;
                $turnover2['DEFAULTTURNOVER'] = $default_turnover;
                if ($row['MARGIN_FREE'] > $default_rate) {
                    $turnover2['ikuttampil1'] = 'ya';
                }
            }//foreach ($rows as $row) {

            if ($turnover2['ikuttampil1'] == 'ya') {
                $turnover2['rangeturnover'] = 0;
                $rangeto = $report_turnover_equity['rangeto'];
                $rangefrom = $report_turnover_equity['rangefrom'];
                $range2 = "('$rangeto')";
                $range1 = "('$rangefrom')";
                $query = "SELECT * FROM " . $turnover2['mt4dt'] . ".mt4_trades WHERE 
                cmd IN ('0','1') 
                AND CLOSE_TIME > '1970-01-01 00:00:00' 
                AND CLOSE_TIME between $range1 and $range2
                AND login = '$login'";
                //tradeLogReport_Summary_Client("Report_TurnOver_Running-121-Query:" . $query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    $turnover2['rangeturnover'] = $turnover2['rangeturnover'] + $row['VOLUME'] / 100;
                    //tradeLogReport_Summary_Client("Report_TurnOver_Running-125-Query:" . $query . ";turnover2['rangeturnover']:" . $turnover2['rangeturnover']);
                    if ($turnover2['rangeturnover'] >= $default_turnover) {
                        $turnover2['ikuttampil2'] = 'ya';
                    }
                }
            }
            return $turnover2;
        }
$q_u = "SELECT username, email FROM report_turnover_equity WHERE subscribe = 'yes'";
$r_u = $DB->execresultset($q_u);

foreach ($r_u as $k_u) {
    $listuser[] = $k_u;
}

print_r($listuser);

foreach ($listuser as $lu) {
    $usernya = $lu['username'];
    $emailnya = $lu['email'];

    $query = "SELECT forexfixmargin,forexfixturnover,indexfixmargin,indexfixturnover,
            floatingmargin,floatingturnover,rangefrom,rangeto  
            FROM report_turnover_equity where username = '$usernya'";
        //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-44:" . $query);
        $rows = $DB->execresultset($query);
        $report_turnover_equity;
        foreach ($rows as $row) {
            $report_turnover_equity = $row;
        }
        $rangefromselect = $report_turnover_equity['rangefrom'];
        $rangetoselect = $report_turnover_equity['rangeto'];
        //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-50:" . $rangefromselect);
        if ($rangefromselect == '') {
            $query = "insert into report_turnover_equity set
                username = '$usernya',
                forexfixmargin = '1000',
                forexfixturnover='3',
                indexfixmargin='5000000',
                indexfixturnover='3',
                floatingmargin='800',
                floatingturnover='3',
                rangefrom = NOW(),
                rangeto = NOW()
                    ";
            $DB->execonly($query);
            $query = "SELECT forexfixmargin,forexfixturnover,indexfixmargin,indexfixturnover,
            floatingmargin,floatingturnover,rangefrom,rangeto  
            FROM report_turnover_equity where username = '$usernya'";
            //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-67:" . $query);
            $rows = $DB->execresultset($query);
            foreach ($rows as $row) {
                $report_turnover_equity = $row;
            }
            $rangefromselect = $report_turnover_equity['rangefrom'];
            $rangetoselect = $report_turnover_equity['rangeto'];
        }

        $query = "SELECT forexfixmargin,forexfixturnover,indexfixmargin,indexfixturnover,
            floatingmargin,floatingturnover,rangefrom,rangeto  
            FROM report_turnover_equity where username = '$usernya'";
            $rows = $DB->execresultset($query);
            foreach ($rows as $row) {
                $report_turnover_equity = $row;
            }



        $query = "SELECT mt_database.alias,acc_kota.mt4dt,acc_kota.login,acc_kota.kliringlogin,acc_kota.rate,
        acc_kota.branch,acc_kota.group,acc_kota.aecode,acc_kota.`comment`,
        acc_kota.regular 
        FROM acc_kota,mt_database
        WHERE mt_database.mt4dt = acc_kota.`mt4dt` 
        ORDER BY mt_database.alias ASC ";
        //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-86:".$query);
        $rows = $DB->execresultset($query);
        foreach ($rows as $row) {
            $turnovers[$row['alias']][$row['login']] = $row;
        }
        $turnovers2 = array();
        foreach ($turnovers AS $alias => $turnover1) {
            //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-49:".$alias);
            foreach ($turnover1 AS $login => $turnover2) {
                //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line53:".$turnover2['mt4dt'].";".$login);
                $checkresult = fetchStatement2($login, $turnover2, $report_turnover_equity);
                //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-54-CheckResult:".$checkresult['ikuttampil']);
                if ($checkresult['ikuttampil2'] == 'ya') {
                    $turnovers2[$alias][$login] = $checkresult;
                }
                //tradeLogReport_Summary_Client("Report_Summary_Client.php-Line-57:" . $turnovers2[$alias][$login]['ikuttampil']);
            }
        }

                
               

        foreach($turnovers2 as $alias => $turnover1) {
            $i_col = 4;
            foreach($turnover1 as $login => $turnover2) {
                $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$i_col.'')->applyFromArray($styleArray2);
                $objPHPExcel->setActiveSheetIndex(0)->getStyle('B'.$i_col.'')->applyFromArray($styleArray2);
                $objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.$i_col.'')->applyFromArray($styleArray2);
                $objPHPExcel->setActiveSheetIndex(0)->getStyle('D'.$i_col.'')->applyFromArray($styleArray2);
                $objPHPExcel->setActiveSheetIndex(0)->getStyle('E'.$i_col.'')->applyFromArray($styleArray2);
                $objPHPExcel->setActiveSheetIndex(0)->getStyle('F'.$i_col.'')->applyFromArray($styleArray2);
                $objPHPExcel->setActiveSheetIndex(0)->getStyle('G'.$i_col.'')->applyFromArray($styleArray2);
                $objPHPExcel->setActiveSheetIndex(0)->getStyle('H'.$i_col.'')->applyFromArray($styleArray2);

               


                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0 ,$i_col, $alias);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1 ,$i_col, $turnover2['rate']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2 ,$i_col, $turnover2['regular']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(3 ,$i_col, $login);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(4 ,$i_col, $turnover2['DEFAULTRATE']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(5 ,$i_col, $turnover2['MARGIN_FREE']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(6 ,$i_col, $turnover2['DEFAULTTURNOVER']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(7 ,$i_col, $turnover2['rangeturnover']);
                $i_col++;
            }
        }


      
        // Rename worksheet

        $objPHPExcel->getActiveSheet()->setTitle('Report Turnover Equity');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        /*// Save Excel 2007 file
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0*/
        $fileName = "ReportEquity-".$usernya."-".date('Ymd');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        // $objWriter->save('Form-','tmp');
        $objWriter->save(str_replace(__FILE__,'tmp/'.$fileName.'.xlsx',__FILE__));
        $fileName2 = "tmp/".$fileName.".xlsx";
        // echo $fileName2;


        /**
         * File for sending email
         * verion : 1.0
         * By Tarikh
         */
}
       
?>