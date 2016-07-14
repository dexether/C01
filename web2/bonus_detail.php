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

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}
$bonus = "";
if (isset($_POST['bonus'])) {
    $bonus = $_POST['bonus'];
    if ($bonus == '') {
        $bonus2 = '';
    }else{
        $bonus2 = 'AND bonus_type = "'.$bonus.'"';
    }
}
$wawal = "";
$wahir = "";
$tglnya = "";
if (isset($_POST['tglnya'])) {
    $tglnya = $_POST['tglnya'];
    $pecah = explode(' - ', $tglnya);
    $wawal = $pecah[0];
    $wahir = $pecah[1];
}
$account = "";
if (isset($_POST['account'])) {
    $account = $_POST['account'];
}



/*====================================
=            Start Coding            =
====================================*/

switch ($postmode) {
    case 'table':

    $query = "SELECT 
    mlm_bonus_logs.*,
    mlm_cron.full 
    FROM
    mlm_bonus_logs,
    mlm_cron 
    WHERE mlm_bonus_logs.bonus_type = mlm_cron.module 
    AND account = '$account'
    $bonus2 
    AND date_receipt BETWEEN '$wawal' 
    AND '$wahir' ";
    // print_r($query);
    $result = $DB->execresultset($query);
    $template->assign("allrows", $result);
    $template->display("bonus_detail.htm");
    break;
    case 'excell':
        // echo "excell";
    /** Error reporting */
    error_reporting(E_ALL);

    ini_set('display_errors', true);
    ini_set('display_startup_errors', true);


    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

    /** Include PHPExcel */
    require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


    // require_once("$_SERVER[DOCUMENT_ROOT]/Classes/PHPExcel.php");


    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
    // For Style
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:E1'); // Merge cell
    $styleArray = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FF0000'),
            'size'  => 13,
            'name'  => 'Verdana'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            )

    );
    $styleArray2 = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN        
                ),
            ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            )
        );

    $objPHPExcel->getActiveSheet()->getStyle('C1')->getNumberFormat()->setFormatCode("#.##0,00");


    $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->applyFromArray($styleArray)
                                                        ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    // $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    // Set document properties

    $objPHPExcel->getProperties()->setCreator("Robot Reporting System")
                                 ->setCategory("Report");

    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0 ,1, "Bonus Acquired Report")
                                        ->setCellValueByColumnAndRow(0 ,3, "No")
                                        ->setCellValueByColumnAndRow(1 ,3, "Date Receipt")
                                        ->setCellValueByColumnAndRow(2 ,3, "Type")
                                        ->setCellValueByColumnAndRow(3 ,3, "Ammount")
                                        ->setCellValueByColumnAndRow(4 ,3, "Comment");
   

    $query = "SELECT 
    mlm_bonus_logs.*,
    mlm_cron.full 
    FROM
    mlm_bonus_logs,
    mlm_cron 
    WHERE mlm_bonus_logs.bonus_type = mlm_cron.module 
    AND account = '$account'
    $bonus2 
    AND date_receipt BETWEEN '$wawal' 
    AND '$wahir' ";
    // print_r($query);
    $result = $DB->execresultset($query);
    foreach($result as $row) {
        $i_row = 4;
        $no = 1;

        $objPHPExcel->getActiveSheet()->getStyle('A'.$i_row.'')->applyFromArray($styleArray2);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$i_row.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$i_row.'')->applyFromArray($styleArray2);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$i_row.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$i_row.'')->applyFromArray($styleArray2);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$i_row.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$i_row.'')->applyFromArray($styleArray2);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$i_row.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$i_row.'')->getNumberFormat()->setFormatCode("#,##0.00");
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$i_row.'')->applyFromArray($styleArray2);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$i_row.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                                                                               ->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth('40');

        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0 ,$i_row, $no);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1 ,$i_row, $row['date_receipt']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2 ,$i_row, $row['full']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(3 ,$i_row, $row['amount']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(4 ,$i_row, $row['comment']);
        $i_row++;
        $no++;
    }
    $filename = $account."-".date('Y-m-d', time());
    $objPHPExcel->getActiveSheet()->setTitle('Simple');
    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;

    break;
    
    default:
        # code...
    break;
}


/*=====  End of Start Coding  ======*/




function myfilter($input_var_outer, $param) {
    global $var_to_pass;
    $var_to_pass = $param;

    function mycallback($input_var_inner) {
        global $var_to_pass;
        return ($input_var_inner == $var_to_pass) ? true : false;
    }

    $return_arr = array_filter($input_var_outer, 'mycallback');
    $return_arr = array_merge(array(), $return_arr);
    return $return_arr;
}

function TradeLogUnderConstruct_Secure($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>