<?php session_start();
if (is_user_logged_in() ) {
  $user_ID = get_current_user_id();
}
else{
  wp_redirect( site_url().'/login/', 301 ); exit;
}
?>
<?php
/*
* Template Name: Patient List Export
*/
?>
<?php
set_time_limit(0);
global $wpdb;
// ************************************print csvfile************************ //

    require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
    PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
    if (!defined('PCLZIP_TEMPORARY_DIR')) {
        define( 'PCLZIP_TEMPORARY_DIR', '/tmp/' );
    }
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("StudyKIK Team")
        ->setLastModifiedBy("StudyKIK Team")
        ->setTitle("Download Patient Details")
        ->setSubject("Download Patient Details")
        ->setDescription("Download Patient Details")
        ->setKeywords("Download Patient Details")
        ->setCategory("Download Patient Details");
    // Add some data

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A6', 'Name')
        ->setCellValue('B6', 'Phone')
        ->setCellValue('C6', 'Email')
        ->setCellValue('D6', 'Date');

    $i=7;
$offset = 0;
$limit = 1000;
while(true) {
    $sql = "SELECT name, email, phone, date FROM 0gf1ba_subscriber_list order by id asc limit $limit offset $offset";
    $patients_arr = $wpdb->get_results($sql, ARRAY_A);
    if (count($patients_arr) == 0)
        break;
    $offset += $limit;
    foreach($patients_arr as $key => $patient){
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $i, $patient['name'])
            ->setCellValue('B' . $i, $patient['phone'])
            ->setCellValue('C' . $i, $patient['email'])
            ->setCellValue('D' . $i, $patient['date']);

        $objPHPExcel->getActiveSheet()->getStyle('A7')->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('B7')->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('C7')->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('D7')->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $i++;
    }
    $patients_arr = null;
    unset($patients_arr);
}


    $styleArray = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '000000'),
            'size' => 12
        ));
    $objPHPExcel->getActiveSheet()->getStyle('A6:D6')->applyFromArray($styleArray);
    //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

    $objPHPExcel->getActiveSheet()->mergeCells('A1:A4');
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo');
    $objDrawing->setDescription('Logo');
    $logo = dirname(__FILE__) . '/images/studylogo.png';
    $objDrawing->setPath($logo);
    $objDrawing->setCoordinates('A1');
    $objDrawing->setHeight(40);
    $objDrawing->setWidth(250);
    $flen=round($len*8.5);
    $off=($flen-250)/2;
    if($off>0){
        $objDrawing->setOffsetX($off);
    }
    $objDrawing->setOffsetY(15);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Download Patient');
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $file = 'patient-list.xls';
    // Redirect output to a client's web browser (Excel5)
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename='.$file);
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
if ($l = ini_get('max_execution_time'))
    set_time_limit($l);
else
    set_time_limit(30);
  exit;

/*==================== END ================================*/

?>