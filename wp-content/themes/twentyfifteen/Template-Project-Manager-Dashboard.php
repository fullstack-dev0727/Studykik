<?php 
session_start();
error_reporting(1);
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (isset($_REQUEST['orderby']) && $_SESSION['search_query_submit'] == 1) {
	$search_query_submit = 1;
} else if (isset($_REQUEST['user'])) {
	$search_query_submit = 0;
	$_SESSION['search_query_submit'] = 0;
} else if (isset($_REQUEST["search_query"]) || isset($_REQUEST['search_study'])) {  //|| isset($_REQUEST['user'])
	$search_query_submit = 1;
	$_SESSION['search_query_submit'] = 1;
}
if ( is_user_logged_in() ) {
	$color_ID=$_REQUEST['color'];
	$level_ID=$_REQUEST['level'];
	$tier_ID=$_REQUEST['tier'];
	$user_ID_123 = get_current_user_id();
	$selected_user_id = $_REQUEST['user'];

    $user_info = get_userdata($user_ID_123);
    if (!$user_info->has_cap( 'administrator' ) && !$user_info->has_cap( 'author' )){
        wp_redirect( 'http://studykik.com/login/', 301 ); exit;
    }

	if($selected_user_id)
	{
	    $_SESSION["user_ID"] = $selected_user_id;
	}

	if($_SESSION["user_ID"] == "")
	{
	    $user_ID = get_current_user_id();
	}else{
	    $user_ID = $_SESSION["user_ID"];
	}
} else {

	wp_redirect( site_url().'/login/', 301 ); exit;
}

	if(isset($_POST['submit_generate'])){
	    $fromdate=$_POST['datepicker_from'];
	    $todate=$_POST['datepicker_to'];
		$parts = explode('/',$fromdate);
	    $parts1 = explode('/',$todate);
		$fromdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1] ;
		$todate = $parts1[2] . '-' . $parts1[0] . '-' . $parts1[1] ;
		$fromdatenew = $parts[0] . '/' . $parts[1] . '/' . $parts[2] ;
		$todatenew = $parts1[0] . '/' . $parts1[1] . '/' . $parts1[2] ;
		$msg="Date Range: ".$fromdatenew."-".$todatenew;
		$sql="SELECT row_num, post_id FROM 0gf1ba_subscriber_list WHERE is_deleted != 1 AND STR_TO_DATE( date, '%Y-%m-%d' ) BETWEEN '$fromdate' AND '$todate' ORDER BY `0gf1ba_subscriber_list`.`date` ASC";
		$result = mysql_query($sql);
		$post_allids=array();
		WHILE($rowss = mysql_fetch_assoc($result)){
			$post_id=$rowss['post_id'];
			$row_num=$rowss['row_num'];
			if(!isset($post_allids[$post_id]['new_patient'])){
				$post_allids[$post_id]['new_patient']=0;
			}
			if(!isset($post_allids[$post_id]['call_attempted'])){
				$post_allids[$post_id]['call_attempted']=0;
			}
			if(!isset($post_allids[$post_id]['not_qualified'])){
				$post_allids[$post_id]['not_qualified']=0;
			}
			if(!isset($post_allids[$post_id]['action_needed'])){
				$post_allids[$post_id]['action_needed']=0;
			}
			if(!isset($post_allids[$post_id]['scheduled'])){
				$post_allids[$post_id]['scheduled']=0;
			}
			if(!isset($post_allids[$post_id]['consented'])){
				$post_allids[$post_id]['consented']=0;
			}
			if(!isset($post_allids[$post_id]['randomized'])){
				$post_allids[$post_id]['randomized']=0;
			}
			if(!isset($post_allids[$post_id]['patient'])){
				$post_allids[$post_id]['patient']=0;
			}
			if($row_num==1){
				$post_allids[$post_id]['new_patient'] += 1;
			}
			if($row_num==2){
				$post_allids[$post_id]['call_attempted'] += 1;
			}
			if($row_num==3){
				$post_allids[$post_id]['not_qualified'] += 1;
			}
			if($row_num==7){
				$post_allids[$post_id]['action_needed'] += 1;
			}
			if($row_num==4){
				$post_allids[$post_id]['scheduled'] += 1;
			}
			if($row_num==5){
				$post_allids[$post_id]['consented'] += 1;
			}
			if($row_num==6){
				$post_allids[$post_id]['randomized'] += 1;
			}
			$post_allids[$post_id]['patient'] += 1;
		}

		/*echo "<pre>";
		WHILE($rowss = mysql_fetch_assoc($result)){
				print_r($rowss);
		}
		die*/;
		if (PHP_SAPI == 'cli')
        die('This example should only be run from a Web Browser');
		/** Include PHPExcel */
			require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
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
					->setCellValue('A6', $msg)
					->setCellValue('A7', 'Study#')
					->setCellValue('B7', 'Site Name')
					->setCellValue('C7', 'Sponsor')
					->setCellValue('D7', 'Protocol')
					->setCellValue('E7', 'Category')
					->setCellValue('F7', 'Location')
					->setCellValue('G7', 'Level')
					->setCellValue('H7', 'Patient')
					->setCellValue('I7', 'New Patient')
					->setCellValue('J7', 'Call Attempted')
					->setCellValue('K7', 'Not Qualified')
					->setCellValue('L7', 'Action Needed')
					->setCellValue('M7', 'Scheduled')
					->setCellValue('N7', 'Consented')
					->setCellValue('O7', 'Randomized');


				$i=7;
			foreach($post_allids as $pst => $ps_detail){
				//echo $rowss['post_id']."<br>";
				$rowss['post_id']=$pst;
				if($rowss['post_id'] !='0' && $rowss['post_id'] !="" && $rowss['post_id']!=FALSE){

				$study_nom = get_post_meta($rowss['post_id'], 'study_no', true );
				if($study_nom !=0 && $study_nom !='0' && $study_nom !="" && $study_nom !=FALSE){
					$i++;
				$site_nm = get_post_meta($rowss['post_id'], 'name_of_site', true );
				$ct_nm="";
				$category_detail=get_the_category($rowss['post_id']);
				foreach($category_detail as $cd){
					$ct_nm=$cd->cat_name;
				}
				$study_full_address= get_post_meta($rowss['post_id'], 'study_full_address', true );
				$labell= get_post_meta($rowss['post_id'], 'exposure_level',true );
				$proto = get_post_meta($rowss['post_id'], 'protocol_no', true );
				$sponsor = get_post_meta($rowss['post_id'], 'sponsor_name', true );
				$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A' . $i, $study_nom)
						->setCellValue('B' . $i, $site_nm)
						->setCellValue('C' . $i, $sponsor)
						->setCellValue('D' . $i, $proto)
						->setCellValue('E' . $i, $ct_nm)
						->setCellValue('F' . $i, $study_full_address)
						->setCellValue('G' . $i, $labell)
						->setCellValue('H' . $i, $ps_detail['patient'])
						->setCellValue('I' . $i, $ps_detail['new_patient'])
						->setCellValue('J' . $i, $ps_detail['call_attempted'])
						->setCellValue('K' . $i, $ps_detail['not_qualified'])
						->setCellValue('L' . $i, $ps_detail['action_needed'])
						->setCellValue('M' . $i, $ps_detail['scheduled'])
						->setCellValue('N' . $i, $ps_detail['consented'])
						->setCellValue('O' . $i, $ps_detail['randomized']);

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
				$objPHPExcel->getActiveSheet()->getStyle('E7')->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('F7')->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('G7')->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('H7')->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('I7')->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('I' . $i)->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('J7')->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('J' . $i)->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('K7')->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('K' . $i)->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('L7')->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('L' . $i)->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('M7')->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('M' . $i)->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('N7')->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('N' . $i)->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('O7')->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);
				$objPHPExcel->getActiveSheet()->getStyle('O' . $i)->getAlignment()->applyFromArray(
						array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'rotation' => 0,
							'wrap' => true
						)
				);

			}
			}
			}
			$styleArray = array(
				'font' => array(
					'bold' => true,
					'color' => array('rgb' => '000000'),
					'size' => 12
			));
			$objPHPExcel->getActiveSheet()->getStyle('A6:Z7')->applyFromArray($styleArray);
			//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setAutoSize(true);

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
			$objPHPExcel->getActiveSheet()->setTitle('Download Patient Details');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			$file = 'Study_Report.xlsx';
		// Redirect output to a client's web browser (Excel5)
		   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename='.$file);
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
	}


$search_for_patient="";
$r_color="";
$r_tier="";
$r_level="";
$is_srch=0;
?>
<?php
/*
* Template Name: PROJECT MANAGER DASHBOARD
*/
?>


<?php get_header('dashboard');?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<link href="<?php echo get_template_directory_uri(); ?>/fonts/font.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/css/pr_manager.css" rel="stylesheet">
<script src="<?php echo get_template_directory_uri(); ?>/js/chartjs/jquery.jqplot.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/chartjs/jqplot.pieRenderer.js"></script>
<link href="<?php echo get_template_directory_uri(); ?>/css/jquery.jqplot.css" rel="stylesheet">
<script type="application/javascript">
	jQuery(document).ready(function( $ ) {
		//alert(screen.width);
		var f_lft=jQuery(".div-table-content2").position().left;
		sf_lft=f_lft+140;
		tf_lft=sf_lft+150;
		jQuery('.div-table-content3 .table tr th:first-child').css('left',f_lft+'px');
		jQuery('.div-table-content2 .table tr td:first-child').css('left',f_lft+'px');
		jQuery('.div-table-content3 .table tr th:first-child').css('left',f_lft+'px');
		jQuery('.div-table-content2 .table tr td:first-child').css('left',f_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(3)').css('left',tf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(3)').css('left',tf_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(3)').css('left',tf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(3)').css('left',tf_lft+'px');
	});
</script>
<style>
	#wpcf7-f74-p6-o123 select,#wpcf7-f74-p6-o123 input[type="text"], #wpcf7-f74-p6-o123 input[type="email"], #wpcf7-f74-p6-o123 textarea{width:500px;}
    .inner-form{min-height: 490px !important;}
    .study label br{ display:none;}
    .study label,.inner-form p {width:100%; float:left;font: 18px Arial, Helvetica, sans-serif; font-weight:bold; }
    .study input[type="checkbox"]{box-shadow:none;height: 25px;}
    .fisrt_step{width:96%;}
    .required.warning {
        border: 1px solid red;
    }
    input[type="checkbox"] {
        transform: scale(1.5);
    }
    .white_content {
        background-color: white;
        border-radius: 10px;
        cursor: auto;
        display: none;
        left: 23% !important;
        overflow: auto;
        position: fixed !important;
        top: 25% !important;
        width: 55% !important;
        z-index: 99999 !important;
        border: 1px solid #f78e1e;
    }
    .black_overlay {
        background: #000000 none repeat scroll 0 0;
        display: none;
        height: 100000px;
        left: 0;
        opacity: 0.8;
        position: absolute;
        top: 0;
        width: 100%;
        z-index:99997;
    }
    h2.heading{
        background: #f78e1e none repeat scroll 0 0;
        color: #fff;
        font-family: alternate;
        font-size: 44px;
        margin: 0;
        padding: 5px;
        text-align: center;
        text-decoration: none;
    }

    .close_button{
        background: #00afef;
        border: medium none;
        color: #fff;
        font-family: alternate;
        font-size: 33px;
        padding: 0 26px;
    }
    .closepop {
        background: transparent url("<?php bloginfo('template_url'); ?>/images-dashboard/close2.png") no-repeat scroll 0 0;

    }

	.notes_left .row > h2 {
		background: #f78e1e none repeat scroll 0 0;
		color: #fff;
		font-family: alternate;
		font-size: 44px;
		margin: 0;
		padding: 5px;
		text-align: center;
		text-decoration: underline;
	}
	.scroll-area {
		height: 380px !important;
	}
.vip {
    display: table-cell;
    padding-left: 50px;
    
}
  .vip-check{
    border: medium none;
    border-radius: 6px;
    box-shadow: -1px 1px 8px #f5f5f5;
    background: #a9afb3;
    font: 18px "HelveticaNeueLTStd-MdCn";
    height: 35px;
    margin: 0 0 10px;
    padding: 0 0 0 12px;
    float:left;
    line-height: 35px;
    color: #ffffff;
    width: 190px;
  }
  .vip-check input{
    float: right;
    line-height: 35px;
    margin: 10px 12px;
  }

</style>

<?php
	global $wp;
	$current_url = home_url(add_query_arg(array(),$wp->request));

/* global variables */
	$active_no = 0;
    $inactive_no = 0;

    $cat_names_arr = array();
# addew newly on 02-12-2016
    $_SESSION["color"]=$_REQUEST['color'];
	$_SESSION["tier"]=$_REQUEST['tier'];
	$_SESSION["level"]=$_REQUEST['level'];
	$_SESSION["catname"]=$_REQUEST['catname'];
    $_SESSION["check_vip"]=isset($_REQUEST['check_vip'])?$_REQUEST['check_vip']:"no";
    $_SESSION["ssponsorname"]=$_REQUEST['ssponsorname'];
    // $_SESSION['active_no'] = '0';
    // $_SESSION['inactive_no'] = '0';
    if ($_REQUEST['active_inactive'])
		$_SESSION["active_inactive"]=$_REQUEST['active_inactive'];
# addew newly on 02-12-2016
	
/* end */

	$study = $_REQUEST['study'];
	$listing = $_REQUEST['listing'];
	$sort_hm="";
	//if (!empty($_REQUEST['search_query']) || !empty($_REQUEST['search_study'])) {
	if (!isset($_SESSION["post_type"]))
		$_SESSION["post_type"] = "publish";
	//}
	/*
	elseif($listing =="current"){
		$_SESSION["current_listing"] = "current";
		$_SESSION["post_type"] = "publish";
	}
	elseif($listing =="past"){
		$_SESSION["current_listing"] = "past";
		$_SESSION["post_type"] = "private";

	}*/
	show_admin_bar(false);
	//$current_listing= $_SESSION["current_listing"];
	$post_type= $_SESSION["post_type"];
?>
<?php
	$color_sorting_ids=array();
	$ord_hm=-1;
	// $_REQUEST['search_query'] = 'Search';

	//print_r($_REQUEST['search_query']);
	//die("search_query");
    $search_for_patient = preg_replace('/[^-a-zA-Z0-9_]/', '', $_REQUEST['search_for_patient']);
    $search_for_study = preg_replace('/[^-a-zA-Z0-9_]/', '', $_REQUEST['search_for_study']);
	if(empty($_REQUEST['orderby']) || empty($_REQUEST['search_query']) || empty($_REQUEST['search_study'])  || empty($search_for_patient)  || empty($_REQUEST['s'])){
		//die("break1");
		/*$_SESSION["orderby"] = 'green';
		$sort_hm='ASC';*/
		$_SESSION["search_query"] = '';
		$_SESSION["search_study"] = '';
		if(!isset($_REQUEST['orderby'])){
			if(isset($_SESSION["search_query"])){
				$_SESSION["search_for_patient"] = '';
				
				$_SESSION["color"]=$_REQUEST['color'];
				$_SESSION["tier"]=$_REQUEST['tier'];
				$_SESSION["level"]=$_REQUEST['level'];
				$_SESSION["catname"]=$_REQUEST['catname'];
        		$_SESSION["check_vip"]=isset($_REQUEST['check_vip'])?$_REQUEST['check_vip']:"no";
        
			}
			if(isset($_SESSION["search_study"])){
				$_SESSION["search_study"] = $_REQUEST['search_study'];
				$_SESSION["studysearch"]=$search_for_study;
			}
			//$_SESSION["color"]="green";
		}
	}
	if(empty($_REQUEST['orderby']) && empty($_REQUEST['search_study'])){
		$_REQUEST['search_query'] = 1;
	}
	if(isset($_REQUEST['orderby']) && !empty($_REQUEST['orderby']) || !empty($_REQUEST['search_query']) || !empty($_REQUEST['search_study'])){
		//	die("break2");
		$_SESSION["orderby"] = $_REQUEST['orderby'];
		$_SESSION["s"] = $_REQUEST['s'];
		// print_r("orderby: ".$_REQUEST['orderby']);
		
		if(!isset($_REQUEST['orderby'])){
			// if(isset($_SESSION["search_query"])){
				// print_r("search_query: ".isset($_SESSION["search_query"]));
				$_SESSION["search_query"] = $_REQUEST['search_query'];
				$_SESSION["search_for_patient"] = $search_for_patient;
				$_SESSION["color"]=$_REQUEST['color'];
				$_SESSION["tier"]=$_REQUEST['tier'];
				$_SESSION["level"]=$_REQUEST['level'];
				$_SESSION["catname"]=$_REQUEST['catname'];
				$_SESSION["ssponsorname"]=$_REQUEST['ssponsorname'];
				# $_REQUEST['active_inactive'] = $post_type;
				if ($_REQUEST['active_inactive'] != "") {
					if ($_REQUEST['active_inactive'] == 'both') {
						$_SESSION["active_inactive"] = array('publish', 'private');
					}  else {
						$_SESSION["active_inactive"]=$_REQUEST['active_inactive'];
					}
				} else {
					$_SESSION["active_inactive"] = 'publish';
				}
				$post_type = $_SESSION['active_inactive'];
				$_SESSION["post_type"] = $post_type;
				$active_inactive = $post_type ;
				// print_r( $_SESSION['active_inactive']);
        		$_SESSION["check_vip"]=isset($_REQUEST['check_vip'])?$_REQUEST['check_vip']:"no";
			// }
			if(isset($_SESSION["search_study"])){
				$_SESSION["search_study"] = $_REQUEST['search_study'];
				$_SESSION["studysearch"]=$search_for_study;
			}
			$_SESSION["orderby"] = 'green';
		}
		if($_REQUEST['s']=='d')
		$sort_hm='DESC';
		else
		$sort_hm='ASC';

	//$sort_hm='DESC';

		$search_for_patient = $search_for_patient;
		$search_for_study = $search_for_study;
		$ord_hm =$_REQUEST['orderby'];


		if(!empty($_REQUEST['search_query']) || !empty($_REQUEST['search_study'])){
			//die("nosearch5");
			$r_color=$_REQUEST['color'];
			$r_tier=$_REQUEST['tier'];
			$r_level=$_REQUEST['level'];
			$r_catname=$_REQUEST['catname'];
			$r_catname=stripslashes($r_catname);
			$r_authorid = $_REQUEST['ssponsorname'];
			/*$active_inactive = $_REQUEST['active_inactive'];

			if ($active_inactive != "") {
				$post_type = $active_inactive;
				$_SESSION['post_type'] = $post_type;
			}*/
			if (!empty($_REQUEST['search_study'])) {
				$_REQUEST['search_query'] = '';
			}
			/*print_r($r_authorid);
			print_r("a<br/>");
			print_r($user_ID);
			die("b</br>");*/
			if(!empty($_REQUEST['search_query']) && ( $active_inactive != "" || $r_authorid != "" || $r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $r_catname != "" || isset($_REQUEST['check_vip']) ) ){
				$is_srch=1;
				if ($r_authorid != "") {
					$queryArgs = array(
						'post_status' => $post_type,
						'posts_per_page' => -1,
						'post__not_in' => array(108),
						'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
						'post_type'=>  'post',
						'fields'=>'id=>parent',
						'meta_query' => array( 
	                    	'relation' => 'AND',
		                    array('key' => 'subscriber', 'value' => $r_authorid, 'type'=>'NUMERIC', 'compare' => "="),
		                    array(
		                        'relation' => 'OR',
		                        array(
		                            'key' => 'project_manager_1',
		                            'value' => $user_ID,
		                            'compare' => '='
		                        ),
		                        array(
		                            'key' => 'project_manager_2',
		                            'value' => $user_ID,
		                            'compare' => '='
		                        ),
		                        array(
		                            'key' => 'project_manager_3',
		                            'value' => $user_ID,
		                            'compare' => '='
		                        )
		                    )
	                    )
					);
				} else {
					// die($user_ID);
					$queryArgs = array(
				      'post_status' => $post_type,
				      'posts_per_page' => -1,
				      'post__not_in' => array(108),
				      'post_type'=>  'post',
				      'fields'=>'id=>parent',
			            'meta_query' => array(
			                'relation' => 'OR',
			                array(
			                    'key' => 'project_manager_1',
			                    'value' => $user_ID,
			                    'compare' => '='
			                ),
			                array(
			                    'key' => 'project_manager_2',
			                    'value' => $user_ID,
			                    'compare' => '='
			                ),
			                array(
			                    'key' => 'project_manager_3',
			                    'value' => $user_ID,
			                    'compare' => '='
			                ),
			            )
				    );
				}

				$custom_posts= query_posts($queryArgs);
				$search_criteris_ids=array();
				$search_color_ids=array();
				$post_list_ids=array();
				$subs_by_ids=array();
				$row_num_ids=array();
				$date = date('Y-m-d',strtotime('-4 hours'));
				$date_Y = date('Y-m-d',strtotime('-28 hours'));
				// $m_before = memory_get_usage();
				// print_r("start");
				// print_r("<br />");
				// print_r(($m_before)/1024/1024);
				// print_r("<br />");
    
				while ( have_posts() ) : the_post();
					$post_list_ids[]=$post->ID;
				endwhile;
				if(!empty($post_list_ids)){
					$im_post_list_ids=implode(",",$post_list_ids);
					$icount = 0;
					while(1) {
						$query_subs = $wpdb->get_results("SELECT campaign,post_id,row_num,date FROM 0gf1ba_subscriber_list WHERE post_id IN (".$im_post_list_ids.") AND is_deleted != 1 LIMIT ".($icount*10000).",10000");
						$icount++;
						
						if($wpdb->num_rows){
							foreach($query_subs as $t_pst){
								$Campaign=$t_pst->campaign;
								if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
									$Campaign=1;
								}
								$subs_by_ids[$t_pst->post_id][$Campaign]+=1;
								$subs_by_ids[$t_pst->post_id]['row_num'][$t_pst->row_num]+=1;
								$dat = date('Y-m-d',strtotime($t_pst->date));
								if($dat==$date){
									$subs_by_ids[$t_pst->post_id]['today'][$Campaign]+=1;
								}
								if($dat==$date_Y){
									$subs_by_ids[$t_pst->post_id]['yesterday'][$Campaign]+=1;
								}
							}
						}
						if (count($query_subs) < 10000) {
							break;
						}
					}
				}
				while ( have_posts() ) : the_post(); $i++;
				$pm_id_1 =  get_post_meta($post->ID, 'project_manager_1',true );
				$pm_id_2 =  get_post_meta($post->ID, 'project_manager_2',true );
				$pm_id_3 =  get_post_meta($post->ID, 'project_manager_3',true );
				if( $pm_id_1 == $user_ID || $pm_id_2 == $user_ID || $pm_id_3 == $user_ID){
					
					$is_any=1;
					$e_dt=get_field('study_end_date');
					$date = DateTime::createFromFormat('Ymd', $e_dt);
					$category_detail=get_the_category($post->ID);
					foreach($category_detail as $cd){
						$ct_nm=$cd->cat_name;
						$category_id = get_cat_ID( $ct_nm );
					}

					$cat_names_arr[$ct_nm]=$ct_nm;

					$tier =  get_option('category_'.$category_id.'_tier');

					$custom_goal="";
					$exposure_level = get_post_meta($post->ID, 'exposure_level',true );
					$custom_goal = get_post_meta($post->ID, 'custom_goal',true );
					if($custom_goal==""){
						if($exposure_level == "Platinum")
								{
									$goal_total =  get_option('category_'.$category_id.'_platinum_goal');

						}elseif($exposure_level == "Gold")
								{
									$goal_total =   get_option('category_'.$category_id.'_gold_goal');

						}elseif($exposure_level == "Silver")
								{
									$goal_total =   get_option('category_'.$category_id.'_silver_goal');

						}elseif($exposure_level == "Bronze")
								{
									$goal_total =   get_option('category_'.$category_id.'_bronze_goal');

						}elseif($exposure_level == "Diamond")
								{
									$goal_total =   get_option('category_'.$category_id.'_diamond_goal');

						}
						elseif($exposure_level == "Ruby")
								{
									$goal_total =   get_option('category_'.$category_id.'_ruby_goal');

						}
								else{$goal_total ="";}
					}
					else{
						$goal_total=$custom_goal;
					}

					$Campaign = get_post_meta($post->ID, 'renewed',true );
					if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
						if(isset($subs_by_ids[$post->ID][1])){
							$toal_counted=$subs_by_ids[$post->ID][1];
						}
						else{
							$toal_counted =  0;
						}
					}
					else{
						if(isset($subs_by_ids[$post->ID][$Campaign])){
							$toal_counted=$subs_by_ids[$post->ID][$Campaign];
						}
						else{
							$toal_counted =  0;
						}
					}

					//die("nosaerch3");
					$final_goal =  $goal_total/$toal_counted;
					$post_created_time = human_time_diff( get_the_time('U'), current_time('timestamp') );
					$post_created_time_remove_hours  = str_replace("hours","",$post_created_time);
					$s_dt=get_field('study_start_date');
					if($e_dt && $s_dt){
						$date2 = DateTime::createFromFormat('Ymd',$e_dt);
						$end_date = $date2->format('Y-m-d');
						$datetime1 = date_create(date('Y-m-d'));
						$datetime2 = date_create($end_date);
						$interval = date_diff($datetime1, $datetime2);
						$total_number_of_days = str_replace("+","", $interval->format('%R%a'));
						$datetime3 = date_create(get_the_time('Y-m-d',$post->ID));
						$datetime4 = date_create($end_date);
						$interval2 = date_diff($datetime3, $datetime4);
						$total_number_of_days2 = str_replace("+","", $interval2->format('%R%a'));
						$date_st = DateTime::createFromFormat('Ymd', $s_dt);
						$start_date = $date_st->format('Y-m-d');
						$datetimestart = date_create($start_date);
						$intervalstart = date_diff($datetimestart, $datetime4);
						$total_number_of_days_start = str_replace("+","", $intervalstart->format('%R%a'));
						$daysof_total=$total_number_of_days_start;
						$days_left = $daysof_total-$total_number_of_days;
						$aa = $goal_total/$daysof_total*$days_left;
						if($aa==0){
							$final_result=0;
						}
						else{
							$final_result = number_format($toal_counted/$aa,2);
						}
					}
					else{
						$daysof_total=0;
						$total_number_of_days=0;
						$days_left=0;
						$final_result=0;
						$end_format="";
					}
					
					$days_for='Days: '.$daysof_total;
					$left_for='Days Left: '.$total_number_of_days;
					$study_name_title =  strtolower(get_post_meta($post->ID, 'custom_title_(for_thank_you_page)',true ));
					$passed_for='Start Date: '.$strtdate;
					$study_no = get_post_meta($post->ID, 'study_no', true );
					$study_name =  strtolower(get_post_meta($post->ID, 'name_of_site',true ));
					$full_address=strtolower(get_post_meta($post->ID, 'study_full_address',true ));
					$spons_name = strtolower(get_post_meta($post->ID, 'sponsor_name',true ));
          /***** andon *****/
          $protocol = strtolower(get_post_meta($post->ID, 'protocol_no',true ));

          $cro_name = strtolower(get_post_meta($post->ID, 'cro_name',true ));
          $author_id = get_post_field( 'post_author', $post->ID );
          $author_name = strtolower(get_the_author_meta( 'user_login' , $author_id ));
          if ( get_post_status ($post->ID)=='private' ) {
          	$post_status = 'inactive';
          } else {
          	$post_status = 'active';
          }


          $hon_social_media_mn_id = $pm_id_1;
            $hon_man_name="";
            if($hon_social_media_mn_id !=""){
                $hon_fnm=get_user_meta($hon_social_media_mn_id, 'first_name', true);
                $hon_lnm=get_user_meta($hon_social_media_mn_id, 'last_name', true);
                $hon_man_name=strtolower(ucwords($hon_fnm." ".$hon_lnm));
            }
            $hon_pr_manager_id = $pm_id_2;
            $hon_pr_man_name="";
            if($hon_pr_manager_id !=""){
                $hon_fnm_pr=get_user_meta($hon_pr_manager_id, 'first_name', true);
                $hon_lnm_pr=get_user_meta($hon_pr_manager_id, 'last_name', true);
                $hon_pr_man_name=strtolower(ucwords($hon_fnm_pr." ".$hon_lnm_pr));
            }

          /***** andon *****/

					$vipstd="";
					$vipp="";
					$vipstd = get_post_meta($post->ID, 'vip_study',true );
					if($vipstd !=""){
						$vipp='vip';
					}
					$expose=strtolower($exposure_level);
					if($r_catname==""){
						$srchcatname=$ct_nm;
					}
					else{
						$srchcatname=$r_catname;
					}
					$r_catname;

					if($srchcatname==$ct_nm){
            /***** andon *****/
            if(isset($_REQUEST['check_vip']) && $_REQUEST['check_vip']== "vip"){
              if($vipp == "vip"){
                if($search_for_patient != ""){
                  if((strpos(strtolower($protocol),strtolower(trim($search_for_patient))) !==FALSE) || (trim(strtolower($search_for_patient)) == "protocol" && $protocol != "") || trim(strtolower($search_for_patient))==$vipp || trim($search_for_patient)==$days_for || trim($search_for_patient)==$left_for || trim($search_for_patient)==$passed_for || trim($search_for_patient)==$end_format || (strpos(strtolower($study_name_title),strtolower(trim($search_for_patient))) !==FALSE) || trim($search_for_patient)==$study_no || (strpos(strtolower($study_name),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($full_address),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($expose),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($spons_name),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($cro_name),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($author_name),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($post_status),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower((string)$final_result),strtolower(trim($search_for_patient))) !==FALSE) || (strpos((string)$Campaign,strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($hon_man_name),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($hon_pr_man_name),strtolower(trim($search_for_patient))) !==FALSE)  || (strpos(" ".$study_no,strtolower(trim($search_for_patient))) !=FALSE) || (strpos(strtolower($srchcatname),strtolower(trim($search_for_patient))) !==FALSE)  ){

                    if($r_color != ""){

                      if($days_left<=2){
                        if($r_color=='purple'){
                        	counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                        }
                        $is_any=0;
                        
                        
                      } else {
                        if($final_result < .87){
                          if($r_color=='red'){
                          	counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                          }
                          $is_any=0;
                          
                        }
                        if($final_result > 1.2){
                          if($r_color=='yellow'){
                          	counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                          } 
                          $is_any=0;                         
                        }
                      }

                      if($is_any==1){
                        if($r_color=='green'){
                        	counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                        }
                        
                      }
                    } else {
                      counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                    }
                  }
                } else {
                	if($r_color != ""){

                      if($days_left<=2){
                        if($r_color=='purple'){
                        	counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                        }
                        $is_any=0;
                        
                        
                      } else {
                        if($final_result < .87){
                          if($r_color=='red'){
                          	counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                          }
                          $is_any=0;
                          
                        }
                        if($final_result > 1.2){
                          if($r_color=='yellow'){
                          	counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                          } 
                          $is_any=0;                         
                        }
                      }

                      if($is_any==1){
                        if($r_color=='green'){
                        	counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                        }
                        
                      }
                    } else {
                      counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                    }
                }

              }
              //print_r($total_red_clr);
              //die("nosearch1");
            }else{
              if($search_for_patient !=""){
              	//die("no-search2");
                //if(trim(strtolower($search_for_patient))==$vipp || trim($search_for_patient)==$days_for || trim($search_for_patient)==$left_for || trim($search_for_patient)==$passed_for || trim($search_for_patient)==$end_format || (strpos($study_name_title,strtolower(trim($search_for_patient))) !==FALSE) || trim($search_for_patient)==$study_no || (strpos($study_name,strtolower(trim($search_for_patient))) !==FALSE) || (strpos($full_address,strtolower(trim($search_for_patient))) !==FALSE) || (strpos($expose,strtolower(trim($search_for_patient))) !==FALSE) || (strpos($spons_name,strtolower(trim($search_for_patient))) !==FALSE)){
                if((strpos(strtolower($protocol),strtolower(trim($search_for_patient))) !==FALSE) || (trim(strtolower($search_for_patient)) == "protocol" && $protocol != "") || trim(strtolower($search_for_patient))==$vipp || trim($search_for_patient)==$days_for || trim($search_for_patient)==$left_for || trim($search_for_patient)==$passed_for || trim($search_for_patient)==$end_format || (strpos(strtolower($study_name_title),strtolower(trim($search_for_patient))) !==FALSE) || trim($search_for_patient)==$study_no || (strpos(strtolower($study_name),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($full_address),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($expose),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($spons_name),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($cro_name),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($author_name),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($post_status),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower((string)$final_result),strtolower(trim($search_for_patient))) !==FALSE) || (strpos((string)$Campaign,strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($hon_man_name),strtolower(trim($search_for_patient))) !==FALSE) || (strpos(strtolower($hon_pr_man_name),strtolower(trim($search_for_patient))) !==FALSE)  || (strpos(" ".$study_no,strtolower(trim($search_for_patient))) !=FALSE ) || (strpos(strtolower($srchcatname),strtolower(trim($search_for_patient))) !==FALSE)  ){
                # bprint_r($study_no.":".$search_for_patient.":".strpos((string)$study_no,strtolower(trim($search_for_patient)))."-");	
                  if($r_color !=""){
                    if($days_left<=2){
                      if($r_color=='purple'){
                      	/*
                      	counting_active_inactive($post_status);
                        $search_color_ids[$post->ID]['tier']=$tier;
                        $search_color_ids[$post->ID]['level']=$exposure_level;
                        $total_purple_clr=$total_purple_clr+1;
                        */
                        counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                      } 
                      $is_any=0;                     
                      
                    }
                    else{
                      if($final_result < .87){
                        if($r_color=='red'){
                        	/*
                        	counting_active_inactive($post_status);
                          $search_color_ids[$post->ID]['tier']=$tier;
                          $search_color_ids[$post->ID]['level']=$exposure_level;
                          $total_red_clr=$total_red_clr+1;
                          */
                          counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                        } 
                        $is_any=0;                       
                        
                      }
                      if($final_result > 1.2){
                        if($r_color=='yellow'){
                        	/*
                        	counting_active_inactive($post_status);
                          $search_color_ids[$post->ID]['tier']=$tier;
                          $search_color_ids[$post->ID]['level']=$exposure_level;
                          $total_yellow_clr=$total_yellow_clr+1;
                          */
                          counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                        }   
                        $is_any=0;                     
                        
                      }
                    }
                    if($is_any==1){
                      if($r_color=='green'){
                      	/*
                      	counting_active_inactive($post_status);
                        $search_color_ids[$post->ID]['tier']=$tier;
                        $search_color_ids[$post->ID]['level']=$exposure_level;
                        $total_green_clr=$total_green_clr+1;
                        */
                        counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                      }
                    }
                  }
                  else{
                  	/*
                    $search_color_ids[$post->ID]['tier']=$tier;
                    $search_color_ids[$post->ID]['level']=$exposure_level;
                    counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                    */
                    counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                  }
                }
              }else{
                if($r_color !=""){
                  if($days_left<=2){
                    if($r_color=='purple'){
                    	// counting_active_inactive($post_status);
                     //  	$search_color_ids[$post->ID]['tier']=$tier;
                     //  	$search_color_ids[$post->ID]['level']=$exposure_level;
                     //  	$total_purple_clr=$total_purple_clr+1;
                    	counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                    }
                    $is_any=0;
                  }
                  else{
                    if($final_result < .87){
                      if($r_color=='red'){
                      	counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                      	// counting_active_inactive($post_status);
                       //  $search_color_ids[$post->ID]['tier']=$tier;
                       //  $search_color_ids[$post->ID]['level']=$exposure_level;
                       //  $total_red_clr=$total_red_clr+1;
                      }
                      $is_any=0;
                    }
                    if($final_result > 1.2){
                      if($r_color=='yellow'){
                      	counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                      	// counting_active_inactive($post_status);
                       //  $search_color_ids[$post->ID]['tier']=$tier;
                       //  $search_color_ids[$post->ID]['level']=$exposure_level;
                       //  $total_yellow_clr=$total_yellow_clr+1;
                      }
                      $is_any=0;
                    }
                  }
                  if( $is_any==1 ){
                    if($r_color=='green'){
counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                    	/*counting_active_inactive($post_status);
                      	$search_color_ids[$post->ID]['tier']=$tier;
                      	$search_color_ids[$post->ID]['level']=$exposure_level;
                      	$total_green_clr=$total_green_clr+1;
                      	*/
                    }
                    
                  }
                }
                else{
	                // $search_color_ids[$post->ID]['tier']=$tier;
	                // $search_color_ids[$post->ID]['level']=$exposure_level;
	                counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level);
                }
              }
            }
					}
				}
				endwhile;
				$_SESSION['active_no'] = $active_no;
				$_SESSION['inactive_no'] = $inactive_no;
				$_SESSION['red_num'] = $total_red_clr;
				$_SESSION['yellow_num'] = $total_yellow_clr;
				$_SESSION['green_num'] = $total_green_clr;
				$_SESSION['purple_num'] = $total_purple_clr;
				$_SESSION['tr1_num'] = $cnt_tier_1;
				$_SESSION['tr2_num'] = $cnt_tier_2;
				$_SESSION['tr3_num'] = $cnt_tier_3;
				$_SESSION['tr4_num'] = $cnt_tier_4;

				/*
print_r("-red-".$total_red_clr);
print_r("-yellow-".$total_yellow_clr);
print_r("-g-".$total_green_clr);
print_r("-p-".$total_purple_clr);
print_r("-t1-".$cnt_tier_1);
print_r("-t2-".$cnt_tier_2);
print_r("-t3-".$cnt_tier_3);
print_r("-t4-".$cnt_tier_4);*/
//die("adf");
				if($r_tier!="" || $r_level !="" ){
					if($r_tier!="" && $r_level !="" ){
						foreach($search_color_ids as $kid => $clr){
							if($clr['tier']==$r_tier && $clr['level']==$r_level){
								$search_criteris_ids[]=$kid;
							}
						}
					} else {
						if($r_tier!=""){
							foreach($search_color_ids as $kid => $clr){
								if($clr['tier']==$r_tier){
									$search_criteris_ids[]=$kid;
								}
							}
						}	else {
							foreach($search_color_ids as $kid => $clr){

								if($clr['level']==$r_level){
									//print_r("asdf2");
									$search_criteris_ids[]=$kid;
								}
							}
						}
					}

				} else {
					foreach($search_color_ids as $kid => $clr){
						$search_criteris_ids[]=$kid;
					}
				}
				if(empty($search_criteris_ids)){
					$search_criteris_ids[]=-1;
				}

				$_SESSION["search_criteris_ids"] = $search_criteris_ids;

				$queryArgs = array(
				'post_status' => $post_type,
				'posts_per_page' =>25,
				'post__not_in' => array(108),
				'post__in' => $search_criteris_ids,
				'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
				'post_type'=>  'post',
				'fields'=>'id=>parent',
				'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'project_manager_1',
				'value' => $user_ID,
				'compare' => '='
				),
				array(
				'key' => 'project_manager_2',
				'value' => $user_ID,
				'compare' => '='
				),
				array(
				'key' => 'project_manager_3',
				'value' => $user_ID,
				'compare' => '='
				),
				)
				);
				$custom_posts= query_posts($queryArgs);


				$_SESSION["search_custom"] = 1;
			}
			else if($search_for_study !=""){
				$queryArgs = array(
				'posts_per_page' =>25,
				'post__not_in' => array(108),
				'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
				'post_type'=>  'post',
				'meta_key'			=> 'study_no',
				'orderby'			=> 'meta_value_num',
				'order'				=> 'DESC',
				'meta_query'	=> array(
					array(
						'key'	 	=> 'study_no',
						'value'	  	=> $search_for_study,
						'type'      =>  'NUMERIC',
						'compare' 	=> '=',
					)
				)
				);
				$custom_posts= query_posts($queryArgs);
				$src_post_status="";
				while ( have_posts() ) : the_post(); $i++;
					$search_criteris_ids[]=$post->ID;
					$src_post_status=$post->post_status;


/* custom code */
					$post_list_ids[] = $post->ID;
					if(!empty($post_list_ids)){
						$im_post_list_ids=implode(",",$post_list_ids);
						$icount = 0;
						while(1) {
							$query_subs = $wpdb->get_results("SELECT campaign,post_id,row_num,date FROM 0gf1ba_subscriber_list WHERE post_id IN (".$im_post_list_ids.") AND is_deleted != 1 LIMIT ".($icount*10000).",10000");
							$icount++;
							
							if($wpdb->num_rows){
								foreach($query_subs as $t_pst){
									$Campaign=$t_pst->campaign;
									if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
										$Campaign=1;
									}
									$subs_by_ids[$t_pst->post_id][$Campaign]+=1;
									$subs_by_ids[$t_pst->post_id]['row_num'][$t_pst->row_num]+=1;
									$dat = date('Y-m-d',strtotime($t_pst->date));
									if($dat==$date){
										$subs_by_ids[$t_pst->post_id]['today'][$Campaign]+=1;
									}
									if($dat==$date_Y){
										$subs_by_ids[$t_pst->post_id]['yesterday'][$Campaign]+=1;
									}
								}
							}
							if (count($query_subs) < 10000) {
								break;
							}
						}
					}
					$is_any=1;
					$e_dt=get_field('study_end_date');
					$date = DateTime::createFromFormat('Ymd', $e_dt);
					$category_detail=get_the_category($post->ID);
					foreach($category_detail as $cd){
						$ct_nm=$cd->cat_name;
						$category_id = get_cat_ID( $ct_nm );
					}

					$cat_names_arr[$ct_nm]=$ct_nm;

					$tier =  get_option('category_'.$category_id.'_tier');

					$custom_goal="";
					$exposure_level = get_post_meta($post->ID, 'exposure_level',true );
					$custom_goal = get_post_meta($post->ID, 'custom_goal',true );
					if($custom_goal==""){
						if($exposure_level == "Platinum")
								{
									$goal_total =  get_option('category_'.$category_id.'_platinum_goal');

						}elseif($exposure_level == "Gold")
								{
									$goal_total =   get_option('category_'.$category_id.'_gold_goal');

						}elseif($exposure_level == "Silver")
								{
									$goal_total =   get_option('category_'.$category_id.'_silver_goal');

						}elseif($exposure_level == "Bronze")
								{
									$goal_total =   get_option('category_'.$category_id.'_bronze_goal');

						}elseif($exposure_level == "Diamond")
								{
									$goal_total =   get_option('category_'.$category_id.'_diamond_goal');

						}
						elseif($exposure_level == "Ruby")
								{
									$goal_total =   get_option('category_'.$category_id.'_ruby_goal');

						}
								else{$goal_total ="";}
					}
					else{
						$goal_total=$custom_goal;
					}

					$Campaign = get_post_meta($post->ID, 'renewed',true );
					if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
						if(isset($subs_by_ids[$post->ID][1])){
							$toal_counted=$subs_by_ids[$post->ID][1];
						}
						else{
							$toal_counted =  0;
						}
					}
					else{
						if(isset($subs_by_ids[$post->ID][$Campaign])){
							$toal_counted=$subs_by_ids[$post->ID][$Campaign];
						}
						else{
							$toal_counted =  0;
						}
					}

					//die("nosaerch3");
					$final_goal =  $goal_total/$toal_counted;
					$post_created_time = human_time_diff( get_the_time('U'), current_time('timestamp') );
					$post_created_time_remove_hours  = str_replace("hours","",$post_created_time);
					$s_dt=get_field('study_start_date');
					if($e_dt && $s_dt){
						$date2 = DateTime::createFromFormat('Ymd',$e_dt);
						$end_date = $date2->format('Y-m-d');
						$datetime1 = date_create(date('Y-m-d'));
						$datetime2 = date_create($end_date);
						$interval = date_diff($datetime1, $datetime2);
						$total_number_of_days = str_replace("+","", $interval->format('%R%a'));
						$datetime3 = date_create(get_the_time('Y-m-d',$post->ID));
						$datetime4 = date_create($end_date);
						$interval2 = date_diff($datetime3, $datetime4);
						$total_number_of_days2 = str_replace("+","", $interval2->format('%R%a'));
						$date_st = DateTime::createFromFormat('Ymd', $s_dt);
						$start_date = $date_st->format('Y-m-d');
						$datetimestart = date_create($start_date);
						$intervalstart = date_diff($datetimestart, $datetime4);
						$total_number_of_days_start = str_replace("+","", $intervalstart->format('%R%a'));
						$daysof_total=$total_number_of_days_start;
						$days_left = $daysof_total-$total_number_of_days;
						$aa = $goal_total/$daysof_total*$days_left;
						if($aa==0){
							$final_result=0;
						}
						else{
							$final_result = number_format($toal_counted/$aa,2);
						}
					}
					else{
						$daysof_total=0;
						$total_number_of_days=0;
						$days_left=0;
						$final_result=0;
						$end_format="";
					}

					if ( get_post_status ($post->ID)=='private' ) {
			          	$post_status = 'inactive';
			          	$_SESSION['inactive_no'] = 1;
			          	$_SESSION['active_no'] = 0;
			          } else {
			          	$post_status = 'active';
			          	$_SESSION['inactive_no'] = 0;
			          	$_SESSION['active_no'] = 1;
			          }

					if($tier==1){
				      $_SESSION['tr1_num'] = 1;
				      $_SESSION['tr2_num'] = 0;
				      $_SESSION['tr3_num'] = 0;
				      $_SESSION['tr4_num'] = 0;
				    }
				    if($tier==2){
				      $_SESSION['tr1_num'] = 0;
				      $_SESSION['tr2_num'] = 1;
				      $_SESSION['tr3_num'] = 0;
				      $_SESSION['tr4_num'] = 0;
				    }
				    if($tier==3){
				      $_SESSION['tr1_num'] = 0;
				      $_SESSION['tr2_num'] = 0;
				      $_SESSION['tr3_num'] = 1;
				      $_SESSION['tr4_num'] = 0;
				    }
				    if($tier==4){
				      $_SESSION['tr1_num'] = 0;
				      $_SESSION['tr2_num'] = 0;
				      $_SESSION['tr3_num'] = 0;
				      $_SESSION['tr4_num'] = 1;
				    }
				    if($days_left<=2){
				    	$is_any=0;
				      	$_SESSION['purple_num'] = 1;
				      	$_SESSION['red_num'] = 0;
				      	$_SESSION['green_num'] = 0;
				      	$_SESSION['yellow_num'] = 0;
				    }
				    else{
				      if($final_result < .87){
				      	$is_any=0;
				        $_SESSION['purple_num'] = 0;
				      	$_SESSION['red_num'] = 1;
				      	$_SESSION['green_num'] = 0;
				      	$_SESSION['yellow_num'] = 0;
				      }
				      if($final_result > 1.2){
				      	$is_any=0;
				        $_SESSION['purple_num'] = 0;
				      	$_SESSION['red_num'] = 0;
				      	$_SESSION['green_num'] = 0;
				      	$_SESSION['yellow_num'] = 1;
				      }
				    }
				    if($is_any==1){
				      	$_SESSION['purple_num'] = 0;
				      	$_SESSION['red_num'] = 0;
				      	$_SESSION['green_num'] = 1;
				      	$_SESSION['yellow_num'] = 0;
				    }
				endwhile;

				if($src_post_status=='publish'){
					$_SESSION["post_type"] = "publish";
					$current_listing='current';
					$_SESSION["current_listing"]=$current_listing;
				}
				else if($src_post_status=='private'){
					$_SESSION["post_type"] = "private";
					$current_listing='past';
					$_SESSION["current_listing"]=$current_listing;
				}
				if(empty($search_criteris_ids)){
					$search_criteris_ids[]=-1;
				}
				$_SESSION["search_criteris_ids"] = -1;
			}
			else{
				/*$search_criteris_ids=array('-1');
				$_SESSION["search_criteris_ids"] = $search_criteris_ids;*/
			}
		}
		$search_for_patient = $_SESSION["search_for_patient"];
		$search_for_study = $_SESSION["studysearch"];
		$r_color=$_SESSION['color'];
		$r_tier=$_SESSION['tier'];
		$r_level=$_SESSION['level'];
		$search_criteris_ids = $_SESSION["search_criteris_ids"] ;
		$r_catname=$_SESSION['catname'];
		$search_id_details=array();
		if($r_subscriberid != "" || $r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
			$search_id_details=$search_criteris_ids;
		}
		$search_id_details=$search_criteris_ids;
		if($ord_hm=='site_name'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $search_id_details,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'meta_key'			=> 'name_of_site',
			'orderby'			=> 'meta_value',
			'order'				=> $sort_hm,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			//echo $GLOBALS['wp_query']->request;
		}
		else if($ord_hm=='sponsor'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $search_id_details,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'meta_key'			=> 'sponsor_name',
			'orderby'			=> 'meta_value',
			'order'				=> $sort_hm,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			//echo $GLOBALS['wp_query']->request;
		}
		else if($ord_hm=='Category'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post__in' => $search_id_details,
			'post_type'=>  'post',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$catgory_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$category_detail=get_the_category($post->ID);
				$draught_links="";
				foreach($category_detail as $cd){
					$draught_links =  $cd->cat_name;
				}
				$catgory_order[$post->ID]=$draught_links;
			endwhile;
			if($sort_hm=='ASC'){
				asort($catgory_order, SORT_STRING);
			}
			else if($sort_hm=='DESC'){
				arsort($catgory_order, SORT_STRING);
			}
			else{
				asort($catgory_order, SORT_STRING);
			}
			$catgory_order=array_keys($catgory_order);
			if($r_subscriberid != "" || $r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($catgory_order as $cod){
					if(in_array($cod, $search_criteris_ids)){
						$serch_sort[]=$cod;
					}
				}
				$catgory_order=$serch_sort;
			}
			$_SESSION["CATO_SORT_ARR"] = $catgory_order;
			$queryArgs = array(
				'post_status' => $post_type,
				'posts_per_page' =>25,
				'post__not_in' => array(108),
				'post__in' => $catgory_order,
				'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
				'post_type'=>  'post',
				'orderby'=> 'post__in',
				'fields'=>'id=>parent',
				'meta_query' => array(
				'relation' => 'OR',
				array(
				'key' => 'project_manager_1',
				'value' => $user_ID,
				'compare' => '='
				),
				array(
				'key' => 'project_manager_2',
				'value' => $user_ID,
				'compare' => '='
				),
				array(
				'key' => 'project_manager_3',
				'value' => $user_ID,
				'compare' => '='
				),
				)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='Location'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $search_id_details,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'meta_key'			=> 'study_full_address',
			'orderby'			=> 'meta_value',
			'order'				=> $sort_hm,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='Level'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $search_id_details,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'meta_key'			=> 'exposure_level',
			'orderby'			=> 'meta_value',
			'order'				=> $sort_hm,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='Today'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$today_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$Campaign = get_post_meta($post->ID, 'renewed',true );
				$date = date('Y-m-d',strtotime('-4 hours'));
				$query = $wpdb->get_results( "SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' AND is_deleted != 1 and date LIKE '%$date%' and campaign = '$Campaign'");
				$today = $wpdb->num_rows;
				$today_order[$post->ID]=$today;
			endwhile;
			if($sort_hm=='ASC'){
				asort($today_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($today_order, SORT_NUMERIC);
			}
			else{
				asort($today_order, SORT_NUMERIC);
			}
			$today_order=array_keys($today_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($today_order as $tod){
					if(in_array($tod, $search_criteris_ids)){
						$serch_sort[]=$tod;
					}
				}
				$today_order=$serch_sort;
			}
			$_SESSION["TODAY_SORT_ARR"] = $today_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $today_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='Yesterday'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$yesterday_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$Campaign = get_post_meta($post->ID, 'renewed',true );
				$date_Y = date('Y-m-d',strtotime('-28 hours'));
                $query = $wpdb->get_results("SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' AND is_deleted != 1  and date LIKE '%$date_Y%' and campaign = '$Campaign'");
				$yesterday =$wpdb->num_rows;
				$yesterday_order[$post->ID]=$yesterday;
			endwhile;
			if($sort_hm=='ASC'){
				asort($yesterday_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($yesterday_order, SORT_NUMERIC);
			}
			else{
				asort($yesterday_order, SORT_NUMERIC);
			}
			$yesterday_order=array_keys($yesterday_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($yesterday_order as $yod){
					if(in_array($yod, $search_criteris_ids)){
						$serch_sort[]=$yod;
					}
				}
				$yesterday_order=$serch_sort;
			}
			$_SESSION["YESTERDAY_SORT_ARR"] = $yesterday_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $yesterday_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='Total'){
		  $queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$total_count_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$Campaign = get_post_meta($post->ID, 'renewed',true );
				if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
					$query = $wpdb->get_results("SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' AND is_deleted != 1");
					$total_order =  $wpdb->num_rows;
				}
				else{
					$query = $wpdb->get_results( "SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and campaign = '$Campaign' AND is_deleted != 1");
					$total_order =  $wpdb->num_rows;
				}

				$total_count_order[$post->ID]=$total_order;
			endwhile;
			if($sort_hm=='ASC'){
				asort($total_count_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($total_count_order, SORT_NUMERIC);
			}
			else{
				asort($total_count_order, SORT_NUMERIC);
			}
			$total_count_order=array_keys($total_count_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($total_count_order as $tcod){
					if(in_array($tcod, $search_criteris_ids)){
						$serch_sort[]=$tcod;
					}
				}
				$total_count_order=$serch_sort;
			}
			$_SESSION["TOTAL_SORT_ARR"] = $total_count_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $total_count_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='Goal'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$goal_count_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$category_detail=get_the_category($post->ID);
				foreach($category_detail as $cd){
					$category_id = get_cat_ID( $cd->cat_name );
				}
				$custom_goal="";
                $exposure_level = get_post_meta($post->ID, 'exposure_level',true );
				$custom_goal = get_post_meta($post->ID, 'custom_goal',true );
				if($custom_goal==""){
					if($exposure_level == "Platinum")
							{
								$goal_total =  get_option('category_'.$category_id.'_platinum_goal');

					}elseif($exposure_level == "Gold")
							{
								$goal_total =   get_option('category_'.$category_id.'_gold_goal');

					}elseif($exposure_level == "Silver")
							{
								$goal_total =   get_option('category_'.$category_id.'_silver_goal');

					}elseif($exposure_level == "Bronze")
							{
								$goal_total =   get_option('category_'.$category_id.'_bronze_goal');

					}elseif($exposure_level == "Diamond")
							{
								$goal_total =   get_option('category_'.$category_id.'_diamond_goal');

					}
					elseif($exposure_level == "Ruby")
							{
								$goal_total =   get_option('category_'.$category_id.'_ruby_goal');

					}
							else{$goal_total ="";}
				}
				else{
					$goal_total=$custom_goal;
				}

				$goal_count_order[$post->ID]=$goal_total;
			endwhile;
			if($sort_hm=='ASC'){
				asort($goal_count_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($goal_count_order, SORT_NUMERIC);
			}
			else{
				asort($goal_count_order, SORT_NUMERIC);
			}
			$goal_count_order=array_keys($goal_count_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($goal_count_order as $gol){
					if(in_array($gol, $search_criteris_ids)){
						$serch_sort[]=$gol;
					}
				}
				$goal_count_order=$serch_sort;
			}
			$_SESSION["GOAL_SORT_ARR"] = $goal_count_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $goal_count_order,
			'fields'=>'id=>parent',
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='End'){
		    $queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$end_date_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$e_dt=get_field('study_end_date');
				if($e_dt){
					$un_end=strtotime($e_dt);
				}
				else{
					$un_end=-1;
				}
				$end_date_order[$post->ID]=$un_end;
			endwhile;
			if($sort_hm=='ASC'){
				asort($end_date_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($end_date_order, SORT_NUMERIC);
			}
			else{
				asort($end_date_order, SORT_NUMERIC);
			}
			$end_date_order=array_keys($end_date_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($end_date_order as $endt){
					if(in_array($endt, $search_criteris_ids)){
						$serch_sort[]=$endt;
					}
				}
				$end_date_order=$serch_sort;
			}
			$_SESSION["END_DT_SORT_ARR"] = $end_date_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $end_date_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='CA'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$call_attempt_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$sub_results=$wpdb->get_results( "SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' AND is_deleted != 1 and row_num = '2'");
				$total_call_attempt = $wpdb->num_rows;
				$call_attempt_order[$post->ID]=$total_call_attempt;
			endwhile;
			if($sort_hm=='ASC'){
				asort($call_attempt_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($call_attempt_order, SORT_NUMERIC);
			}
			else{
				asort($call_attempt_order, SORT_NUMERIC);
			}
			$call_attempt_order=array_keys($call_attempt_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($call_attempt_order as $catt){
					if(in_array($catt, $search_criteris_ids)){
						$serch_sort[]=$catt;
					}
				}
				$call_attempt_order=$serch_sort;
			}
			$_SESSION["CALL_ATTEMPT_SORT_ARR"] = $call_attempt_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $call_attempt_order,
			'fields'=>'id=>parent',
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='NQ'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$not_qualify_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$sub_results=$wpdb->get_results( "SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' AND is_deleted != 1 and row_num = '3'");
				$total_NQ = $wpdb->num_rows;
				$not_qualify_order[$post->ID]=$total_NQ;
			endwhile;
			if($sort_hm=='ASC'){
				asort($not_qualify_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($not_qualify_order, SORT_NUMERIC);
			}
			else{
				asort($not_qualify_order, SORT_NUMERIC);
			}
			$not_qualify_order=array_keys($not_qualify_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($not_qualify_order as $notq){
					if(in_array($notq, $search_criteris_ids)){
						$serch_sort[]=$notq;
					}
				}
				$not_qualify_order=$serch_sort;
			}
			$_SESSION["NOT_QUALIFY_SORT_ARR"] = $not_qualify_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $not_qualify_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='AN'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$action_needed_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$sub_results=$wpdb->get_results( "SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' AND is_deleted != 1 and row_num = '7'");
				$total_AN = $wpdb->num_rows;
				$action_needed_order[$post->ID]=$total_AN;
			endwhile;
			if($sort_hm=='ASC'){
				asort($action_needed_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($action_needed_order, SORT_NUMERIC);
			}
			else{
				asort($action_needed_order, SORT_NUMERIC);
			}
			$action_needed_order=array_keys($action_needed_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($action_needed_order as $actn){
					if(in_array($actn, $search_criteris_ids)){
						$serch_sort[]=$actn;
					}
				}
				$action_needed_order=$serch_sort;
			}
			$_SESSION["ACTION_NEEDED_SORT_ARR"] = $action_needed_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $action_needed_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='S'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$scheduled_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$sub_results=$wpdb->get_results( "SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' AND is_deleted != 1 and row_num = '4'");
				$total_SH = $wpdb->num_rows;
				$scheduled_order[$post->ID]=$total_SH;
			endwhile;
			if($sort_hm=='ASC'){
				asort($scheduled_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($scheduled_order, SORT_NUMERIC);
			}
			else{
				asort($scheduled_order, SORT_NUMERIC);
			}
			$scheduled_order=array_keys($scheduled_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($scheduled_order as $schd){
					if(in_array($schd, $search_criteris_ids)){
						$serch_sort[]=$schd;
					}
				}
				$scheduled_order=$serch_sort;
			}
			$_SESSION["SCHEDULED_SORT_ARR"] = $scheduled_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $scheduled_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='C'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$consented_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$sub_results=$wpdb->get_results( "SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' AND is_deleted != 1 and row_num = '5'");
				$total_CN = $wpdb->num_rows;
				$consented_order[$post->ID]=$total_CN;
			endwhile;
			if($sort_hm=='ASC'){
				asort($consented_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($consented_order, SORT_NUMERIC);
			}
			else{
				asort($consented_order, SORT_NUMERIC);
			}
			$consented_order=array_keys($consented_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($consented_order as $cnsd){
					if(in_array($cnsd, $search_criteris_ids)){
						$serch_sort[]=$cnsd;
					}
				}
				$consented_order=$serch_sort;
			}
			$_SESSION["CONSENTED_SORT_ARR"] = $consented_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $consented_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='R'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$randomized_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$sub_results=$wpdb->get_results( "SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' AND is_deleted != 1 and row_num = '6'");
				$total_RA = $wpdb->num_rows;
				$randomized_order[$post->ID]=$total_RA;
			endwhile;
			if($sort_hm=='ASC'){
				asort($randomized_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($randomized_order, SORT_NUMERIC);
			}
			else{
				asort($randomized_order, SORT_NUMERIC);
			}
			$randomized_order=array_keys($randomized_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($randomized_order as $rnd){
					if(in_array($rnd, $search_criteris_ids)){
						$serch_sort[]=$rnd;
					}
				}
				$randomized_order=$serch_sort;
			}
			$_SESSION["RANDOMIZED_SORT_ARR"] = $randomized_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $randomized_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='NP'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$new_patient_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$sub_results=$wpdb->get_results( "SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' AND is_deleted != 1 and row_num = '1'");
				$total_new_patient = $wpdb->num_rows;
				$new_patient_order[$post->ID]=$total_new_patient;
			endwhile;
			if($sort_hm=='ASC'){
				asort($new_patient_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($new_patient_order, SORT_NUMERIC);
			}
			else{
				asort($new_patient_order, SORT_NUMERIC);
			}
			$new_patient_order=array_keys($new_patient_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($new_patient_order as $newpat){
					if(in_array($newpat, $search_criteris_ids)){
						$serch_sort[]=$newpat;
					}
				}
				$new_patient_order=$serch_sort;
			}
			$_SESSION["NEW_PATIENT_SORT_ARR"] = $new_patient_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $new_patient_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='Views'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'fields'=>'id=>parent',
			'post__in' => $search_id_details,
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$views_count_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$Campaign = get_post_meta($post->ID, 'renewed',true );
				if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
					$total_views = get_post_meta($post->ID, 'views', true);
				}
				else{
					$total_views = get_post_meta($post->ID, 'views_'.$Campaign, true);
				}
				$views_count_order[$post->ID]=$total_views;
			endwhile;
			if($sort_hm=='ASC'){
				asort($views_count_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($views_count_order, SORT_NUMERIC);
			}
			else{
				asort($views_count_order, SORT_NUMERIC);
			}
			$views_count_order=array_keys($views_count_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($views_count_order as $viewc){
					if(in_array($viewc, $search_criteris_ids)){
						$serch_sort[]=$viewc;
					}
				}
				$views_count_order=$serch_sort;
			}
			$_SESSION["VIEWS_SORT_ARR"] = $views_count_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $views_count_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='Study_no'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'meta_key'			=> 'study_no',
			'orderby'			=> 'meta_value_num',
			'order'				=> $sort_hm,
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);

		}
		else if($ord_hm=='RunningTotal'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$running_count_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$sub_results=$wpdb->get_results( "SELECT id,row_num FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' AND is_deleted != 1");
				$total_running = $wpdb->num_rows;
				$running_count_order[$post->ID]=$total_running;
			endwhile;
			if($sort_hm=='ASC'){
				asort($running_count_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($running_count_order, SORT_NUMERIC);
			}
			else{
				asort($running_count_order, SORT_NUMERIC);
			}
			$running_count_order=array_keys($running_count_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($running_count_order as $rcont){
					if(in_array($rcont, $search_criteris_ids)){
						$serch_sort[]=$rcont;
					}
				}
				$running_count_order=$serch_sort;
			}
			$_SESSION["RUNNING_SORT_ARR"] = $running_count_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $running_count_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='RW'){
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>-1,
			'post__not_in' => array(108),
			'post_type'=>  'post',
			'post__in' => $search_id_details,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			$running_count_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$author_id = get_post_field( 'post_author', $post->ID );
				$current_points=get_user_meta($author_id, 'rewards', true);
				$reward_count_order[$post->ID]=$current_points;
			endwhile;
			if($sort_hm=='ASC'){
				asort($reward_count_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($reward_count_order, SORT_NUMERIC);
			}
			else{
				asort($reward_count_order, SORT_NUMERIC);
			}
			$reward_count_order=array_keys($reward_count_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($reward_count_order as $rcont){
					if(in_array($rcont, $search_criteris_ids)){
						$serch_sort[]=$rcont;
					}
				}
				$reward_count_order=$serch_sort;
			}
			$_SESSION["RUNNING_SORT_ARR"] = $reward_count_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $reward_count_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
		}
		else if($ord_hm=='DaysLeft'){
			$_SESSION["DAYSLEFT_SORT_ARR"] = $search_id_details;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'post__in' => $search_id_details,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'meta_key'			=> 'study_start_date',
			'orderby'			=> 'meta_value',
			'order'				=> $sort_hm,
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);
			/*
			$days_left_order=array();
			$i=0;
			while ( have_posts() ) : the_post(); $i++;
				$e_dt=get_field('study_end_date');
				if($e_dt){
					$date2 = DateTime::createFromFormat('Ymd', $e_dt);
					$end_date = $date2->format('Y-m-d');
					$datetime1 = date_create(date('Y-m-d'));
					$datetime2 = date_create($end_date);
					$interval = date_diff($datetime1, $datetime2);
					$total_number_of_days = str_replace("+","", $interval->format('%R%a'));
				}
				else{
					$total_number_of_days=0;
				}

				$days_left_order[$post->ID]=$total_number_of_days;
			endwhile;
			//echo "<pre>";
			//print_r($days_left_order);
			if($sort_hm=='ASC'){
				asort($days_left_order, SORT_NUMERIC);
			}
			else if($sort_hm=='DESC'){
				arsort($days_left_order, SORT_NUMERIC);
			}
			else{
				asort($days_left_order, SORT_NUMERIC);
			}
			$days_left_order=array_keys($days_left_order);
			//print_r($days_left_order);
			if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || isset($_REQUEST['check_vip'])){
				$serch_sort=array();
				foreach($days_left_order as $daylft){
					if(in_array($daylft, $search_criteris_ids)){
						$serch_sort[]=$daylft;
					}
				}
				$days_left_order=$serch_sort;
			}
			//print_r($days_left_order);
			$_SESSION["DAYSLEFT_SORT_ARR"] = $days_left_order;
			$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' => 30,
			'post__not_in' => array(108),
			'post__in' => $days_left_order,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'orderby'=> 'post__in',
			'fields'=>'id=>parent',
			'meta_query' => array(
			'relation' => 'OR',
			array(
			'key' => 'project_manager_1',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_2',
			'value' => $user_ID,
			'compare' => '='
			),
			array(
			'key' => 'project_manager_3',
			'value' => $user_ID,
			'compare' => '='
			),
			)
			);
			$custom_posts= query_posts($queryArgs);*/
		}
	}
    else{
    	//die("break3");
		$_SESSION["cat_options"]=1;
		$order_hm='';
		$queryArgs = array(
			'post_status' => $post_type,
			'posts_per_page' =>25,
			'post__not_in' => array(108),
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'post_type'=>  'post',
			'meta_key'			=> 'study_no',
			'orderby'			=> 'meta_value_num',
			'order'				=> 'DESC',
			'fields'=>'id=>parent',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'project_manager_1',
					'value' => $user_ID,
					'compare' => '='
				),
				 array(
					'key' => 'project_manager_2',
					'value' => $user_ID,
					'compare' => '='
				),
				 array(
					'key' => 'project_manager_3',
					'value' => $user_ID,
					'compare' => '='
				),
			)
		);
		$custom_posts= query_posts($queryArgs);
		//print_r($custom_posts);
	}
?>

<script type="application/javascript">


jQuery(document).ready(function( $ ) {

    jQuery(".div-table-content1").scroll(function(){
       jQuery(".div-table-content2").scrollLeft(jQuery(".div-table-content1").scrollLeft());
	    jQuery(".div-table-content3").scrollLeft(jQuery(".div-table-content1").scrollLeft());
    });
    jQuery(".div-table-content2").scroll(function(){
        jQuery(".div-table-content1").scrollLeft(jQuery(".div-table-content2").scrollLeft());
		jQuery(".div-table-content3").scrollLeft(jQuery(".div-table-content2").scrollLeft());
    });

jQuery(".processing").hide();
<?php
$paged = get_query_var( 'paged', 1 );

if(!empty($_REQUEST['listing']) && $paged == 0){?>
/*var len = "ggggggggggg";
jQuery(".processing").show();
jQuery.ajax({
        type: "GET",
        url: "<?php bloginfo('url');?>/project-manager-dashboard-jquery/",
        data: "search_query="+len,
        success: function (data) {
		jQuery(".processing").css("color", "green");
		jQuery('.processing').html(data);

       // jQuery('.site_top').show();
		}
 });*/
<?php } ?>
});
</script>
<script type="application/javascript">
jQuery( document ).ready(function() {
jQuery(window).scroll(function(){
    var scroll = jQuery(window).scrollTop();

    if (scroll >= 480) {
		jQuery('.div-table-content3 .table tr th:first-child').css('z-index','-1000');
		jQuery('.div-table-content3 .table tr th:nth-child(2)').css('z-index','-1000');
		jQuery('.div-table-content3 .table tr th:nth-child(3)').css('z-index','-1000');
		jQuery('.div-table-content3 .table tr th:first-child').css('margin-left','10%');
		jQuery('.div-table-content3 .table tr th:nth-child(2)').css('margin-left','10%');
		jQuery('.div-table-content3 .table tr th:nth-child(3)').css('margin-left','10%');
		jQuery('.div-table-content3 .table tr th:first-child').addClass('zcls');
		jQuery('.div-table-content3 .table tr th:nth-child(2)').addClass('zcls');
		jQuery('.div-table-content3 .table tr th:nth-child(3)').addClass('zcls');
        jQuery(".div-table-content3.top_row").addClass("navbar-fixed-top");

    }
	else {
		jQuery('.zcls').css('z-index','1');
		jQuery('.zcls').css('margin-left','0%');
        jQuery(".div-table-content3.top_row").removeClass("navbar-fixed-top");


    }
});

jQuery(window).on('resize', function(){
      var win = jQuery(this);
      if (win.width() < 600) {jQuery(".div-table-content3.top_row").addClass("navbar-fixed-top");}

});

jQuery(".users").change(function () {
        var user_id = this.value;
		var url      = window.location.href;
	  if(user_id == "" || user_id == ""){}else{
	  location.search = "user="+user_id;
	 }
    });

});
</script>
<?php
	/* $total_today="";
	$total_yesterday="";
	$running_total="";
	$sql = "SELECT * FROM 0gf1ba_study_count where user_id=".$user_ID;
	$result = $wpdb->get_results($sql);
	if(!empty($result)){
		foreach( $result as $results ) {
			$total_today = $results->today;
			$total_yesterday = $results->yesterday;
			$running_total = $results->total;
		}
	}
	else{
		$queri = mysql_query("INSERT INTO `0gf1ba_study_count`(`id`, `user_id`, `today`, `yesterday`, `total`) VALUES (NULL,'$user_ID',0,0,0)");
	} */
	if($ord_hm==-1 || $ord_hm==""  ){
		$_SESSION["top_lebels"]=array();
	}
	/*
	$top_labels=$_SESSION["top_lebels"];
	$total_red_clr=$top_labels['red_count'];
	$total_yellow_clr=$top_labels['yellow_count'];
	$total_green_clr=$top_labels['green_count'];
	$total_purple_clr=$top_labels['purple_count'];
	$tier_1_cnt=$top_labels['tr1_count'];
	$tier_2_cnt=$top_labels['tr2_count'];
	$tier_3_cnt=$top_labels['tr3_count'];
	$tier_4_cnt=$top_labels['tr4_count'];
	$total_today=$top_labels['today_count'];
	$total_yesterday=$top_labels['yesterday_count'];
	$running_total=$top_labels['running_count'];
	$study_total=$top_labels['color_total'];
	$red_num=$top_labels['red_num'];
	$yellow_num=$top_labels['yellow_num'];
	$green_num=$top_labels['green_num'];
	$purple_num=$top_labels['purple_num'];
	$tr1_num=$top_labels['tr1_num'];
	$tr2_num=$top_labels['tr2_num'];
	$tr3_num=$top_labels['tr3_num'];
	$tr4_num=$top_labels['tr4_num'];
	//http://www.jqplot.com/tests/pie-donut-charts.php
	*/
?>
<div id="banner_login">
<div class="container">
     <div class="row" style='font-family: "HelveticaNeueLTStd-MdCn";'>
    <div class="dashoard_container">
    <aside class="left_section">
	<select class="every_one users" name="users" style="margin: 0 0 0 15px !important;">
			<option <?php if($user_ID == '50'){echo 'selected="selected"';}?> value="50">Brian Kay</option>
			<option <?php if($user_ID == '49'){echo 'selected="selected"';}?> value="49">Sam Haiden</option>
			<option <?php if($user_ID == '48'){echo 'selected="selected"';}?> value="48">Justin Shields</option>
			<option <?php if($user_ID == '53'){echo 'selected="selected"';}?> value="53">Ryan Williams</option>
			<option <?php if($user_ID == '52'){echo 'selected="selected"';}?> value="52">Paul Eure</option>
			<option <?php if($user_ID == '51'){echo 'selected="selected"';}?> value="51">Abel Manansala</option>
			<option <?php if($user_ID == '502'){echo 'selected="selected"';}?> value="502">Zack Metcalf</option>
			<option <?php if($user_ID == '506'){echo 'selected="selected"';}?> value="506">Raj Kumar</option>
			<option <?php if($user_ID == '920'){echo 'selected="selected"';}?> value="920">Jalen Stone</option>
			<option <?php if($user_ID == '1694'){echo 'selected="selected"';}?> value="1694">Crystal Knell</option>
			<option <?php if($user_ID == '1061'){echo 'selected="selected"';}?> value="1061">Anissia Lawlor</option>
            <option <?php if($user_ID == '1268'){echo 'selected="selected"';}?> value="1268">Dan Diecidue</option>
            <option <?php if($user_ID == '1736'){echo 'selected="selected"';}?> value="1736">Jessica Figueroaz</option>
            <option <?php if($user_ID == '1735'){echo 'selected="selected"';}?> value="1735">Aubrey Vergara</option>
			<option <?php if($user_ID == '45'){echo 'selected="selected"';}?> value="45">Everyone</option>
	</select>
    </aside>
    <section class="dashboard_center">
    <a href="<?php echo $current_url; ?>"><img src="<?php bloginfo('template_url');?>/images-dashboard/logonew.png" alt="" class="img-responsive center-block"></a>
    <h1>PROJECT MANAGER DASHBOARD</h1>
    <div class="left_block">
    <div class="section_1">
    <p><span>TODAY:</span><b id="cn_today"><?php echo $total_today;?></b>

    </p>
    </div>
    <div class="section_1">
    <p><span>YESTERDAY:</span><b id="cn_yesterday"><?php echo $total_yesterday;?></b>

    </p>
    </div>
    <div class="section_1">
    <p><span>PATIENT TOTAL:</span><b id="cn_rtotal"><?php echo $running_total;?></b>
    </p>
    </div>
    <div class="section_1">
    <p><span>STUDY TOTAL:</span><b id="cn_clrtotal"><?php echo $study_total;?></b>
    </p>
    </div>
    </div>
    <div class="center_block">
    <div class="section_2">
    <!--<p><span style="color:#dd0000; font-size:14px;">RED:</span><b id="cn_red"><?php echo $total_red_clr;?></b></p>
    <p><span style="color:#f9ce15; font-size:14px;">YELLOW:</span><b id="cn_yellow"><?php echo $total_yellow_clr;?></b></p>
    <p><span style="color:#7dbc00; font-size:14px;">GREEN:</span><b id="cn_green"><?php echo $total_green_clr;?></b></p>
    <p><span style="color:#873fbd; font-size:14px;">PURPLE:</span><b id="cn_purple"><?php echo $total_purple_clr;?></b></p>-->

    <p><span style="color:#dd0000; font-size:14px;">RED:</span><b id="cn_red"></b></p>
    <p><span style="color:#f9ce15; font-size:14px;">YELLOW:</span><b id="cn_yellow"></b></p>
    <p><span style="color:#7dbc00; font-size:14px;">GREEN:</span><b id="cn_green"></b></p>
    <p><span style="color:#873fbd; font-size:14px;">PURPLE:</span><b id="cn_purple"></b></p>

    </div>
    <div id="pie1" style="height:150px;width:110px;float:right;"></div>
    </div>
    <div class="right_block">
    <div class="section_3">
    <p><span style="color:#5acbf6; font-size:14px;">Tier 1:</span><b id="cn_tr1"><?php echo $tier_1_cnt;?></b></p>
    <p><span style="color:#ffae55; font-size:14px;">Tier 2:</span><b id="cn_tr2"><?php echo $tier_2_cnt;?></b></p>
    <p><span style="color:#9fcf67; font-size:14px;">Tier 3:</span><b id="cn_tr3"><?php echo $tier_3_cnt;?></b></p>
    <p><span style="color:#a9afb3; font-size:14px;">Tier 4:</span><b id="cn_tr4"><?php echo $tier_4_cnt;?></b></p>
    </div>
    <div id="pie2" style="height:150px;width:110px;float:right;"></div>

    </div>
    </section>
    <form action="<?php echo site_url();?>/project-manager-dashboard/" method="post" id="all_search_frm">
    <aside id="right_section" class="nomarginright h_right_section">
    <select name="color" class="select_color">
		<option value="">Select Color</option>
		<option  value="red" <?php if ($_SESSION['color'] == 'red') echo 'selected'; ?>>Red</option>
		<option  value="yellow" <?php if ($_SESSION['color'] == 'yellow') echo 'selected'; ?>>Yellow</option>
		<option  value="green" <?php if ($_SESSION['color'] == 'green') echo 'selected'; ?>>Green</option>
		<option  value="purple" <?php if ($_SESSION['color'] == 'purple') echo 'selected'; ?>>Purple</option>
  	</select>
    <select name="ssponsorname" class="select_color nomarginright">
    	<option value="">Select Sponsor</option>
    <?php
    $editor_users = get_users( array('role'=>'Subscriber') );
    foreach ($editor_users as $user) {
    ?>
    	<option value="<?php echo $user->ID; ?>" <?php if ($_SESSION['ssponsorname'] == $user->ID) echo 'selected'; ?>><?php echo $user->user_login; ?></option>
    <?php	
    }
    ?>
    </select>

    
  <select name="tier" class="select_color ">
    <option value="">Select Tier</option>
		<option value="1" <?php if ($r_tier == 1) echo 'selected'; ?>>Tier 1</option>
		<option value="2" <?php if ($r_tier == 2) echo 'selected'; ?>>Tier 2</option>
		<option value="3" <?php if ($r_tier == 3) echo 'selected'; ?>>Tier 3</option>
		<option value="4" <?php if ($r_tier == 4) echo 'selected'; ?>>Tier 4</option>
  </select>
  <select name="active_inactive" class="select_color nomarginright">
    <option value="">Select Status </option>
		<option value="publish" <?php if ($_SESSION['active_inactive'] == 'publish') echo 'selected'; ?>>Active</option>
		<option value="private" <?php if ($_SESSION['active_inactive'] == 'private') echo 'selected'; ?>>Inactive</option>
		<option value="both" <?php if ($_SESSION['active_inactive'] != 'publish' && $_SESSION['active_inactive'] != 'private') echo 'selected'; ?>>Both</option>
  </select>
  <select name="level" class="select_color">
    <option value="">Select Level</option>
	    <option value="Ruby" <?php if ($_SESSION['level'] == 'Ruby') echo 'selected'; ?>>Ruby</option>
		<option value="Diamond" <?php if ($_SESSION['level'] == 'Diamond') echo 'selected'; ?>>Diamond</option>
		<option value="Platinum" <?php if ($_SESSION['level'] == 'Platinum') echo 'selected'; ?>>Platinum</option>
		<option value="Gold" <?php if ($_SESSION['level'] == 'Gold') echo 'selected'; ?>>Gold</option>
		<option value="Silver" <?php if ($_SESSION['level'] == 'Silver') echo 'selected'; ?>>Silver</option>
		<option value="Bronze" <?php if ($_SESSION['level'] == 'Bronze') echo 'selected'; ?>>Bronze</option>
  </select>
  <!--/***** andon *****/-->
  <p class="vip-check nomarginright">VIP <span style="background: #ffffff;"><input type="checkbox" name="check_vip" value="vip" <?php if ($_SESSION['check_vip'] !== 'no') echo 'checked'; ?>></span></p>
  <!--/***** andon *****/-->
  <?php $cat_options=$_SESSION["option_details"];
  if($cat_options==""){
	$cat_options='<option value="">Select Category</option>';
  }
  $args = array(
      'orderby' => 'name',
      'parent' => 6,
      'hide_empty' => 0,
      'order' => 'ASC'
  );
  $category_lists = get_categories($args);
  $category_name_lists = array();
  if(!empty($category_lists)){
  	foreach($category_lists as $cat) {
  		$category_name_lists[] = $cat->cat_name;
  	}
  	$category_name_lists = array_unique($category_name_lists);
    foreach($category_name_lists as $cat){
      $selected = ($cat == $_SESSION['catname'] ? 'selected' :'');
      $cat_options.="<option value=\"$cat\" $selected>$cat</option>";
    }
  }
  ?>
  <select name="catname" class="select_color" id="catgryname"><?php echo $cat_options;?> </select>
  
  	<div class="search_for_patient_wrapper">
	  	<input name="search_for_patient" type="text" placeholder="Search" class="search_all search_for_patient" value="<?php if (isset($_SESSION['search_for_patient'])) echo $search_for_patient; ?>">
		<input placeholder="" type="submit" id="search-multi" name="search_query" value="Search" />
	</div>
    </aside>
    </form>
    <div class="margin_listing" style="margin: 0 0 5px !important;">
    <!-- <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 padding_left" style="padding-left:15px;width:47%;">
    <h3 class="<?php if($current_listing == "current"){  echo 'current_listing';}else{echo 'deactive_current_listing';}?>"><a class="<?php if($current_listing == "current"){  echo 'whitea';}else{ echo 'bluea';}?>" href="<?php bloginfo('url');?>/project-manager-dashboard/?listing=current">CURRENT STUDIES</a></h3>
    <h4 class="<?php if($current_listing == "past"){  echo 'active_past_study';}else{echo 'past_study';}?>"><a class="<?php if($current_listing == "past"){ echo 'whitea';}else{echo "bluea";} ?>" href="<?php bloginfo('url');?>/project-manager-dashboard/?listing=past">PAST STUDIES</a></h4>

    </div> -->

      	<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->
		<form action="<?php echo site_url();?>/project-manager-dashboard/" method="post" id="study_search_frm">
			<input name="search_for_study" type="text" placeholder="Study Number" class="search_patient search_for_patient" id="stdsrh" value="<?php if (isset($search_for_study)) echo $search_for_study; ?>">
			<input placeholder="" type="submit" id="search-box" name="search_study" value="Search" />
	    </form>

      	<form method="post" action="">
      		<input type="text" id="datepicker1" class="search_patient" style="width:150px;" placeholder="Date From" name="datepicker_from">
          	<input type="text" id="datepicker" class="search_patient" style="width:150px;" placeholder="Date To" name="datepicker_to">
          	
  			<input placeholder="" type="submit" id="download_btn" name="submit_generate" value="Search" />
      	</form>

    </div>

    </div>
    </div>
<script class="code" type="text/javascript">
jQuery(document).ready(function(){

});
</script>
    <div class="row">
      <section class="container_current">
        <div class="site_top">


	 <?php

	$sorting = $_REQUEST['s'];
	$_SESSION["s"] = $_REQUEST['s'];
	if($sorting == 'd')
		$sorting_disp = 'a';
	else
        $sorting_disp = 'd';




	 ?>

     <div class="table-hover">
     <div class="div-table-content3 top_row">
    <table class="table table-condensed ">
        <thead>
           <tr>
           		<?php
					$i = 0;
					if($is_srch==0){
						$post_list_ids=array();
						$subs_by_ids=array();
						$row_num_ids=array();
						$date = date('Y-m-d',strtotime('-4 hours'));
						$date_Y = date('Y-m-d',strtotime('-28 hours'));
						while ( have_posts() ) : the_post();
							$post_list_ids[]=$post->ID;
						endwhile;
						if(!empty($post_list_ids)){
							$im_post_list_ids=implode(",",$post_list_ids);
							$query_subs = $wpdb->get_results("SELECT campaign,post_id,row_num,date FROM 0gf1ba_subscriber_list WHERE post_id IN (".$im_post_list_ids.") AND is_deleted != 1");
							if($wpdb->num_rows){
								foreach($query_subs as $t_pst){
									$Campaign=$t_pst->campaign;
									if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
										$Campaign=1;
									}
									$subs_by_ids[$t_pst->post_id][$Campaign]+=1;
									$subs_by_ids[$t_pst->post_id]['row_num'][$t_pst->row_num]+=1;
									$dat = date('Y-m-d',strtotime($t_pst->date));
									if($dat==$date){
										$subs_by_ids[$t_pst->post_id]['today'][$Campaign]+=1;
									}
									if($dat==$date_Y){
										$subs_by_ids[$t_pst->post_id]['yesterday'][$Campaign]+=1;
									}
								}

							}
						}
					}
					$sumyesterday=0;
					$sumtoal=0;
					$sumtoday=0;
					$sumnum1=0;
					$sumnum2=0;
					$sumnum3=0;
					$sumnum4=0;
					$sumnum5=0;
					$sumnum6=0;
					$sumnum7=0;
					$sumnum8=0;
					while ( have_posts() ) : the_post(); $i++;
						$Campaign = get_post_meta($post->ID, 'renewed',true );
						if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
							if(isset($subs_by_ids[$post->ID][1])){
								$toal_counted=$subs_by_ids[$post->ID][1];
							}
							else{
								$toal_counted =  0;
							}
						}
						else{
							if(isset($subs_by_ids[$post->ID][$Campaign])){
								$toal_counted=$subs_by_ids[$post->ID][$Campaign];
							}
							else{
								$toal_counted =  0;
							}
						}
						$sumtoal+=$toal_counted;


						if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
							$Cam=1;
						}
						else{
							$Cam=$Campaign;
						}
						if(isset($subs_by_ids[$post->ID]['today'][$Cam])){
							 $today = $subs_by_ids[$post->ID]['today'][$Cam];
						}
						else{
							 $today = 0;
						};
						$sumtoday+=$today;
						if(isset($subs_by_ids[$post->ID]['yesterday'][$Cam])){
							 $yesterday = $subs_by_ids[$post->ID]['yesterday'][$Cam];
						}
						else{
							 $yesterday = 0;
						}
						$sumyesterday+=$yesterday;
						$num_1=0;


						if(isset($subs_by_ids[$post->ID]['row_num'][1])){
							$num_1=$subs_by_ids[$post->ID]['row_num'][1];
							$sumnum1+=$num_1;
						}

						$num_2=0;
						if(isset($subs_by_ids[$post->ID]['row_num'][2])){
							$num_2=$subs_by_ids[$post->ID]['row_num'][2];
							$sumnum2+=$num_2;
						}
						$num_3=0;
										if(isset($subs_by_ids[$post->ID]['row_num'][3])){
							$num_3=$subs_by_ids[$post->ID]['row_num'][3];
							$sumnum3+=$num_3;
						}
						$num_4=0;
						if(isset($subs_by_ids[$post->ID]['row_num'][4])){
							$num_4=$subs_by_ids[$post->ID]['row_num'][4];
							$sumnum4+=$num_4;
						}
						$num_5=0;
						if(isset($subs_by_ids[$post->ID]['row_num'][5])){
							$num_5=$subs_by_ids[$post->ID]['row_num'][5];
							$sumnum5+=$num_5;
						}
						$num_6=0;
						if(isset($subs_by_ids[$post->ID]['row_num'][6])){
							$num_6=$subs_by_ids[$post->ID]['row_num'][6];
							$sumnum6+=$num_6;
						}
						$num_7=0;
						if(isset($subs_by_ids[$post->ID]['row_num'][7])){
							$num_7=$subs_by_ids[$post->ID]['row_num'][7];
							$sumnum7+=$num_7;
						}

						//14column
						$author_id = get_post_field( 'post_author', $post->ID );
						$current_points=0;

				        $current_points=get_user_meta($author_id, 'rewards', true);
				        $sumcurrent+=$current_points;

				        //12column
				        $sumclick;
				        if($Campaign == 1 || $Campaign == 0 || $Campaign == "")
						 {

							$sumclick+=get_post_meta($post->ID, 'views', true);
						 }else
						 {
							 $sumclick+=get_post_meta($post->ID, 'views_'.$Campaign, true);

						 }
					?>
					<?php endwhile;  ?>
				
               <th id="std_opt" class="location" style="padding-top:11.5px;">
		<a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=Study_no&s=<?php if($ord_hm == 'Study_no') {echo  $sorting_disp;}else{ echo 'a';} ?>">Study #</a> 
					<br/>
					<p class="active_acount" style="font-size:10px;"><!-- 
						Active: <?php echo $_SESSION['active_no']; ?> <br />
						Inactive: <?php echo $_SESSION['inactive_no']; ?> -->
					</p>
                  <?php if($ord_hm == 'Study_no'){?>
                  <a style="margin-left: 3px; width: 12px;" href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=Study_no&s=<?php if($ord_hm == 'Study_no') {echo $sorting_disp;}else{ echo 'd';} ?>"><img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" /> </a>
                  <?php }?>
                 

                  <!--<a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=red"><img src="<?php bloginfo('template_url');?>/images-dashboard/red.png" style="margin-left: 3px; width: 12px;"></a>
                   <a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=orange"><img src="<?php bloginfo('template_url');?>/images-dashboard/orange.png" style="margin-left: 3px; width: 12px;"></a>
                    <a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=green"><img src="<?php bloginfo('template_url');?>/images-dashboard/green.png" style="margin-left: 3px; width: 12px;"></a>
                    <a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=blue"><img src="<?php bloginfo('template_url');?>/images-dashboard/blue.png" style="margin-left: 3px; width: 12px;"></a>-->
                   </th>

                <th class="location scndclm">
					<a style="float:left;margin-left:25%;margin-right:-20%;margin-top:0.5px;" href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=site_name&s=<?php if($ord_hm == 'site_name') {echo  $sorting_disp;}else{ echo 'a';} ?>">Site Name<br/>
                  <?php if($ord_hm == 'site_name'){?>
                  <img style=" width: 12px; margin-top: -10px;position:absolute;margin-top:6px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />
                  <?php } ?>
                  </a>
		  <!-- <a style="margin-top:1px;position:absolute;margin-left:-12.5%;" href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=sponsor&s=<?php if($ord_hm == 'sponsor') {echo  $sorting_disp;}else{ echo 'a';} ?>">Name<br/>
                  <?php if($ord_hm == 'sponsor'){?>
                  <img style="margin-left: -91%; width: 12px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />
                  <?php } ?>
                  </a> -->
                  </th>
                <th class="location"><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=Category&s=<?php if($ord_hm == 'Category') {echo  $sorting_disp;}else{ echo 'a';} ?>">Category <br/>
                  <?php if($ord_hm == 'Category'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />
                  <?php } ?>
		   <!--<a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=t1">T1</a>
                   <a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=t2">T2</a>
                    <a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=t3">T3</a>
                    <a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=t4">T4</a>-->
                  </a></th>
                <th style="<?php if($ord_hm == 'Location'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=Location&s=<?php if($ord_hm == 'Location') {echo  $sorting_disp;}else{ echo 'a';} ?>">Location <br/>
                  <?php if($ord_hm == 'Location'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />
                  <?php } ?>

                  </a></th>
                <th  style="<?php if($ord_hm == 'Level'){ echo 'padding-bottom:0px'; }?>" class="location"  ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=Level&s=<?php if($ord_hm == 'Level') {echo $sorting_disp;}else{ echo 'a';} ?>">Level <br/>
                  <?php if($ord_hm == 'Level'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />
                  <?php } ?>
                  </a></th>
                <th  style="<?php if($ord_hm == 'Today'){ echo 'padding-bottom:0px'; }?>" class="location"><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=Today&s=<?php if($ord_hm == 'Today') {echo  $sorting_disp;}else{ echo 'd';} ?>">Today <br/>
                  </a>
                  <p class="location_today"><?php echo $sumtoday;?></p>
                  <?php if($ord_hm == 'Today'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />
                  <?php }?>
                  
                   


                  </th>
                <th  style="<?php if($ord_hm == 'Yesterday'){ echo 'padding-bottom:0px'; }?>" class="location"  ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=Yesterday&s=<?php if($ord_hm == 'Yesterday') {echo  $sorting_disp;}else{ echo 'd';} ?>">Yesterday <br/>
                </a>
                  <p class="location_yesterday"><?php echo $sumyesterday;?></p>
                  <?php if($ord_hm == 'Yesterday'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />
                  <?php }?>
                  
                   

				</th>
                <th  style="<?php if($ord_hm == 'Total'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=Total&s=<?php if($ord_hm == 'Total') {echo  $sorting_disp;}else{ echo 'd';} ?>">Total <br/>
                </a>
                  <p class="location_total"><?php echo $sumtoal;?></p>
                  <?php if($ord_hm == 'Total'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />

                  <?php }?>
                  
                  

                
                </th>
                <th  style="<?php if($ord_hm == 'Goal'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=Goal&s=<?php if($ord_hm == 'Goal') {echo  $sorting_disp;}else{ echo 'd';} ?>">Goal <br/>
                </a>
                  <?php if($ord_hm == 'Goal'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />

                  <?php }?>
                  </th>
                    <th  style="<?php if($ord_hm == 'DaysLeft'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=DaysLeft&s=<?php if($ord_hm == 'DaysLeft') {echo  $sorting_disp;}else{ echo 'd';} ?>">Days<br/>
                    </a>
                  <?php if($ord_hm == 'DaysLeft'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />

                  <?php }?>
                  </th>

                <th  style="<?php if($ord_hm == 'End'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=End&s=<?php if($ord_hm == 'End') {echo  $sorting_disp;}else{ echo 'd';} ?>">End Date <br/>
                </a>
                  <?php if($ord_hm == 'End'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />

                  <?php }?>
                  </th>


                   <th  style="<?php if($ord_hm == 'Views'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=Views&s=<?php if($ord_hm == 'Views') {echo  $sorting_disp;}else{ echo 'd';} ?>">Click Views<br/>
                   </a>
                  <p class="location_click"><?php echo $sumclick;?></p>
                  <?php if($ord_hm == 'Views'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />

                  <?php }?>
                  
                   

                  </th>

                  <th  style="<?php if($ord_hm == 'RunningTotal'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=RunningTotal&s=<?php if($ord_hm == 'RunningTotal') {echo  $sorting_disp;}else{ echo 'd';} ?>">Running Total<br/>
                  </a>
                  <p class="location_numtotal">
                  <?php 
                  	$sumnumtotal=$sumnum1+$sumnum2+$sumnum3+$sumnum4+$sumnum5+$sumnum6+$sumnum7;
                  	echo $sumnumtotal;
                  ?></p>
                  <?php if($ord_hm == 'RunningTotal'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />

                  <?php }?>

                  </th>
                  <th  style="<?php if($ord_hm == 'RW'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=RW&s=<?php if($ord_hm == 'RW') {echo  $sorting_disp;}else{ echo 'd';} ?>">Rewards<br/>
                  </a>
                  <p class="location_rewards"><?php echo $sumcurrent;?></p>
                  <?php if($ord_hm == 'RW'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />

                  <?php }?>

                  </th>

                   <th  style="<?php if($ord_hm == 'NP'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=NP&s=<?php if($ord_hm == 'NP') {echo  $sorting_disp;}else{ echo 'd';} ?>">New Patient<br/>
                   </a>
                  <p class="location_new_patient"><?php echo $sumnum1;?></p>
                  <?php if($ord_hm == 'NP'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />

                  <?php }?>
                  

                  </th>


                <th  style="<?php if($ord_hm == 'CA'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=CA&s=<?php if($ord_hm == 'CA') {echo  $sorting_disp;}else{ echo 'd';} ?>">Call Attempted<br/>
                </a>
                  <p class="location_call_attempted"><?php echo $sumnum2;?></p>
                  <?php if($ord_hm == 'CA'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />

                  <?php }?>
                  
                  

                  </th>
                <th  style="<?php if($ord_hm == 'NQ'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=NQ&s=<?php if($ord_hm == 'NQ') {echo  $sorting_disp;}else{ echo 'd';} ?>">Not Qualified<br/>
                </a>
                  <p class="location_notqualified"><?php echo $sumnum3;?></p>
                  <?php if($ord_hm == 'NQ'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />

                  <?php }?>
                  
                   

                  </th>
                <th  style="<?php if($ord_hm == 'AN'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=AN&s=<?php if($ord_hm == 'AN') {echo  $sorting_disp;}else{ echo 'd';} ?>">Action Needed<br/>
                </a>
                  <p class="location_action_needed"><?php echo $sumnum7;?></p>
                  <?php if($ord_hm == 'AN'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />

                  <?php }?>
                  
                   

                  </th>
                <th  style="<?php if($ord_hm == 'S'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=S&s=<?php if($ord_hm == 'S') {echo  $sorting_disp;}else{ echo 'd';} ?>">Scheduled<br/>
                </a>
                  <p class="location_scheduled"><?php echo $sumnum4;?></p>
                  <?php if($ord_hm == 'S'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />
                  <?php }?>
                  
                  

                  </th>
                <th  style="<?php if($ord_hm == 'C'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=C&s=<?php if($ord_hm == 'C') {echo  $sorting_disp;}else{ echo 'd';} ?>">Consented<br/>
                </a>
                  <p class="location_consented"><?php echo $sumnum5;?></p>
                  <?php if($ord_hm == 'C'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />
                  <?php }?>
                  
                  </th>
                <th  style="<?php if($ord_hm == 'R'){ echo 'padding-bottom:0px'; }?>" class="location" ><a href="<?php bloginfo('url');?>/project-manager-dashboard/?orderby=R&s=<?php if($ord_hm == 'R') {echo  $sorting_disp;}else{ echo 'd';} ?>">Randomized<br/>
                </a>
                  <p class="location_randomized"><?php echo $sumnum6;?></p>
                  <?php if($ord_hm == 'R'){?>
                  <img style="margin-left: 3px; width: 12px; margin-top: -10px;" src="<?php bloginfo('template_url');?>/images/<?php if($sorting_disp == "a"){ echo 'up.png';} if($sorting_disp == "d"){ echo 'down.png';}?>" />
                  <?php }?>
                  

                  </th><!-- 
                <th class="location" >Logged
                 

                </th>
				<th class="location" style="visibility:none;width:150px !important;">Extra</th>
				<th class="location" style="visibility:none;width:150px !important;">Extra-1</th>
				<th class="location" style="visibility:none;width:140px !important;">Extra-2</th> -->
              </tr>
        </thead>
    </table>
 </div>
 <div class="div-table-content2 top_row">
    <table class="table table-condensed table-hover">
        <tbody class="tbl-body">
              <?php    
              
if ($search_query_submit  == 1) {

					$i = 0;
					if($is_srch==0){
						$post_list_ids=array();
						$subs_by_ids=array();
						$row_num_ids=array();
						$date = date('Y-m-d',strtotime('-4 hours'));
						$date_Y = date('Y-m-d',strtotime('-28 hours'));
						while ( have_posts() ) : the_post();
							$post_list_ids[]=$post->ID;
						endwhile;
						if(!empty($post_list_ids)){
							$im_post_list_ids=implode(",",$post_list_ids);
							$query_subs = $wpdb->get_results("SELECT campaign,post_id,row_num,date FROM 0gf1ba_subscriber_list WHERE post_id IN (".$im_post_list_ids.") AND is_deleted != 1");
							if($wpdb->num_rows){
								foreach($query_subs as $t_pst){
									$Campaign=$t_pst->campaign;
									if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
										$Campaign=1;
									}
									$subs_by_ids[$t_pst->post_id][$Campaign]+=1;
									$subs_by_ids[$t_pst->post_id]['row_num'][$t_pst->row_num]+=1;
									$dat = date('Y-m-d',strtotime($t_pst->date));
									if($dat==$date){
										$subs_by_ids[$t_pst->post_id]['today'][$Campaign]+=1;
									}
									if($dat==$date_Y){
										$subs_by_ids[$t_pst->post_id]['yesterday'][$Campaign]+=1;
									}
								}

							}
						}
					}
					while ( have_posts() ) : the_post(); $i++; ?>
					<?php
					$pm_id_1 =  get_post_meta($post->ID, 'project_manager_1',true );
					 $pm_id_2 =  get_post_meta($post->ID, 'project_manager_2',true );
					 $pm_id_3 =  get_post_meta($post->ID, 'project_manager_3',true );
					 $facebook_url =  get_post_meta($post->ID, 'facebook_url',true );


					if( $pm_id_1 == $user_ID || $pm_id_2 == $user_ID || $pm_id_3 == $user_ID)
					{?>
					              <tr>
					                <?php

					$e_dt=get_field('study_end_date');
					$date = DateTime::createFromFormat('Ymd', $e_dt);

					$category_detail=get_the_category($post->ID);

					foreach($category_detail as $cd){
						$category_id = get_cat_ID( $cd->cat_name );
					}
							$custom_goal="";
					                $exposure_level = get_post_meta($post->ID, 'exposure_level',true );
							$custom_goal = get_post_meta($post->ID, 'custom_goal',true );
									if($custom_goal==""){
										if($exposure_level == "Platinum")
												{
													$goal_total =  get_option('category_'.$category_id.'_platinum_goal');

										}elseif($exposure_level == "Gold")
												{
													$goal_total =   get_option('category_'.$category_id.'_gold_goal');

										}elseif($exposure_level == "Silver")
												{
													$goal_total =   get_option('category_'.$category_id.'_silver_goal');

										}elseif($exposure_level == "Bronze")
												{
													$goal_total =   get_option('category_'.$category_id.'_bronze_goal');

										}elseif($exposure_level == "Diamond")
												{
													$goal_total =   get_option('category_'.$category_id.'_diamond_goal');

										}
										elseif($exposure_level == "Ruby")
												{
													$goal_total =   get_option('category_'.$category_id.'_ruby_goal');

										}
												else{$goal_total ="";}
									}
									else{
										$goal_total=$custom_goal;
									}

									$Campaign = get_post_meta($post->ID, 'renewed',true );
									if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
										if(isset($subs_by_ids[$post->ID][1])){
											$toal_counted=$subs_by_ids[$post->ID][1];
										}
										else{
											$toal_counted =  0;
										}
									}
									else{
										if(isset($subs_by_ids[$post->ID][$Campaign])){
											$toal_counted=$subs_by_ids[$post->ID][$Campaign];
										}
										else{
											$toal_counted =  0;
										}
									}
									$final_goal =  $goal_total/$toal_counted;
									$post_created_time = human_time_diff( get_the_time('U'), current_time('timestamp') );
									$post_created_time_remove_hours  = str_replace("hours","",$post_created_time);
									$s_dt=get_field('study_start_date');
									// print_r($s_dt);
									// print_r("<br/>");
									if($e_dt && $s_dt){
										$date2 = DateTime::createFromFormat('Ymd', $e_dt);
										$end_date = $date2->format('Y-m-d');
										$datetime1 = date_create(date('Y-m-d'));
										$datetime2 = date_create($end_date);
										$interval = date_diff($datetime1, $datetime2);
										$total_number_of_days = str_replace("+","", $interval->format('%R%a'));
										$datetime3 = date_create(get_the_time('Y-m-d',$post->ID));
										$datetime4 = date_create($end_date);
										$interval2 = date_diff($datetime3, $datetime4);
										$total_number_of_days2 = str_replace("+","", $interval2->format('%R%a'));
										$date_st = DateTime::createFromFormat('Ymd', $s_dt);
										$start_date = $date_st->format('Y-m-d');
										$fr_start_date = $date_st->format('Y-m-d');
										$datetimestart = date_create($start_date);
										$intervalstart = date_diff($datetimestart, $datetime4);
										$total_number_of_days_start = str_replace("+","", $intervalstart->format('%R%a'));
										$daysof_total=$total_number_of_days_start;
										$days_left = $daysof_total-$total_number_of_days;
										$aa = $goal_total/$daysof_total*$days_left;
										$final_result = number_format($toal_counted/$aa,2);
									}
									else{
										$daysof_total=0;
										$total_number_of_days=0;
										$days_left=0;
										$final_result=0;
										$fr_start_date ="n/a";
									}
									$post_link=post_permalink($post->ID);

					?>

					        <td  style="font-weight: bold;text-align: center; <?php if($days_left<=2){echo 'background:#873fbd;';}else{ if($final_result < .87){ echo 'background:#dd0000;';}?><?php if($final_result > 1.2){ echo 'background:#f9ce15;';}}?>">
					        	<?php
                                if ($facebook_url) {
                                    echo "<a href='".$facebook_url."' target='_blank' style='color: #fff;'>".$i."</a>";
                                } else {
                                    echo $i;
                                }
					echo "<br />";
					?>
					        	<a style="color: #fff;" href="<?php echo $post_link; ?>" target="_blank"><?php echo $study_no = get_post_meta($post->ID, 'study_no', true ); ?> </a><br /><span style="<?php if (($days_left>2) && ($final_result < .8)) { echo 'color: black;'; } else { echo 'color:#fff;'; } ?>"> (<?php echo $final_result;?>)</span><br />Campaign: <?php if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){ echo '1'; }else{ echo $Campaign; } ?>

					            <?php
					               if ( get_post_status ($post->ID)=='private' ) {
					                      echo "<br />";
					                      echo "Inactive";
					                } else {
					                	echo "<br />";
					                    echo "Active";
					                }

					                $social_media_mn_id = $pm_id_1;
					                $man_name="";
					                if($social_media_mn_id !=""){
					                    $fnm=get_user_meta($social_media_mn_id, 'first_name', true);
					                    $lnm=get_user_meta($social_media_mn_id, 'last_name', true);
					                    $man_name=ucwords($fnm." ".$lnm);
					                }

					                $pr_manager_id = $pm_id_2;
					                $pr_man_name="";
					                if($pr_manager_id !=""){
					                    $fnm_pr=get_user_meta($pr_manager_id, 'first_name', true);
					                    $lnm_pr=get_user_meta($pr_manager_id, 'last_name', true);
					                    $pr_man_name=ucwords($fnm_pr." ".$lnm_pr);
					                }
					                ?>

					                <?php
					                if($man_name !=""){
					                    echo "<br />";
					                    echo $man_name;
					                }
					                ?>

					                <?php
					                if($pr_man_name !=""){
					                    echo "<br />";
					                    echo $pr_man_name;
					                }
					            ?>
					        </td>
					        <td class="acne_cls"><a href="<?php echo $post_link; ?>" target="_blank"><?php echo $study_name =  get_post_meta($post->ID, 'name_of_site',true ); ?></a>
							<?php $sponsor_name = get_post_meta($post->ID, 'sponsor_name',true );
							if($sponsor_name){
								echo '<p style="color:#959ca1;margin-bottom:0;">Sponsor: '.$sponsor_name.'</p>';
							}
							?>
							<?php $protocol = get_post_meta($post->ID, 'protocol_no',true );
							if($protocol){
								echo '<p style="color:#959ca1; margin:0;">Protocol: '.$protocol.'</p>';
							}
							$cro_name = get_post_meta($post->ID, 'cro_name',true );
							if ($cro_name) {
								echo '<p style="color:#959ca1; margin:0;">CRO Name: '.$cro_name.'</p>';
							}
							
							?> 

							<?php 
					 			$author_id = get_post_field( 'post_author', $post->ID );
								if ($author_id) {
						 			echo '<p style="color:#959ca1; margin:0; word-wrap: break-word;">Username: ';
						 			the_author_meta( 'user_login' , $author_id );
						 			echo '</p>';

						 		}
						 		
							?>
							
							


							</td>
					        <td  class="acne_cls">
					        <?php
					            foreach($category_detail as $cd){
					            $draught_links =  $cd->cat_name. '<br />';

					            //$category_id = get_cat_ID( $cd->cat_name );

					            //echo join( ", ", $draught_links );
					            }
					        ?>
					        <a href="<?php echo $post_link; ?>" target="_blank"><?php echo $draught_links; ?></a>
					        <?php
					            $tier="";
					            $tier =  get_option('category_'.$category_id.'_tier');
					            if($tier!=""){
					                echo '<span>Tier <strong>'.$tier.'</strong></span>';
					            }

					            $vipst="";
					            $vipst = get_post_meta($post->ID, 'vip_study',true );
					            if($vipst!=""){
					                echo '<p><strong>VIP</strong></p>';
					            }
					        ?>
					        </td>
					                <td class="acne_cls"><?php echo get_post_meta($post->ID, 'study_full_address',true); ?></td>
					                <td class="acne_cls"><?php echo $exposure_level; ?></td>
					                <td class="acne_cls" id="to_td_<?php echo $post->ID;?>"><?php
									if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
										$Cam=1;
									}
									else{
										$Cam=$Campaign;
									}
									if(isset($subs_by_ids[$post->ID]['today'][$Cam])){
										echo $today = $subs_by_ids[$post->ID]['today'][$Cam];
									}
									else{
										echo $today = 0;
									}
									;?></td>
					                <td class="acne_cls" id="yes_td_<?php echo $post->ID;?>"><?php

									if(isset($subs_by_ids[$post->ID]['yesterday'][$Cam])){
										echo $yesterday = $subs_by_ids[$post->ID]['yesterday'][$Cam];
									}
									else{
										echo $yesterday = 0;
									}
									?></td>
					                <td class="acne_cls" id="total_td_<?php echo $post->ID;?>"><?php echo $toal_counted; ?></td>
					                <td class="acne_cls"><?php echo $goal_total;?></td>
					                <td class="acne_cls">
										<?php 
											if($fr_start_date !=""){
												echo 'Start Date: '.$fr_start_date; echo '<br/>';
											}
											echo 'Days: '.$daysof_total; echo '<br/>'; 
											echo 'Days Left: '.$total_number_of_days;  echo '<br/>';
										?>
									</td>
					                <td class="acne_cls"><?php
						  if($e_dt)
							{
								$date = DateTime::createFromFormat('Ymd', $e_dt);
								echo $date->format('m/d');
							}else{
							 echo '---';
							}
					?>
					                </td>
					                 <td class="acne_cls"><?php

									 if($Campaign == 1 || $Campaign == 0 || $Campaign == "")
									 {

										 echo get_post_meta($post->ID, 'views', true);
									 }else
									 {
										 echo get_post_meta($post->ID, 'views_'.$Campaign, true);

									 }?>
					                 </td>



					                  <td class="acne_cls"><?php
					                //$sub_results=$wpdb->get_results( "SELECT id,row_num FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID'");
									$num_1=0;
									if(isset($subs_by_ids[$post->ID]['row_num'][1])){
										$num_1=$subs_by_ids[$post->ID]['row_num'][1];
									}
									$num_2=0;
									if(isset($subs_by_ids[$post->ID]['row_num'][2])){
										$num_2=$subs_by_ids[$post->ID]['row_num'][2];
									}
									$num_3=0;
									if(isset($subs_by_ids[$post->ID]['row_num'][3])){
										$num_3=$subs_by_ids[$post->ID]['row_num'][3];
									}
									$num_4=0;
									if(isset($subs_by_ids[$post->ID]['row_num'][4])){
										$num_4=$subs_by_ids[$post->ID]['row_num'][4];
									}
									$num_5=0;
									if(isset($subs_by_ids[$post->ID]['row_num'][5])){
										$num_5=$subs_by_ids[$post->ID]['row_num'][5];
									}
									$num_6=0;
									if(isset($subs_by_ids[$post->ID]['row_num'][6])){
										$num_6=$subs_by_ids[$post->ID]['row_num'][6];
									}
									$num_7=0;
									if(isset($subs_by_ids[$post->ID]['row_num'][7])){
										$num_7=$subs_by_ids[$post->ID]['row_num'][7];
									}
									//if(!empty($sub_results)){
									//	foreach($sub_results as $res ) {
									//		$num = $res->row_num;
									//		if($num==1){
									//			$num_1=$num_1+1;
									//		}
									//		else if($num==2){
									//			$num_2=$num_2+1;
									//		}
									//		else if($num==3){
									//			$num_3=$num_3+1;
									//		}
									//		else if($num==4){
									//			$num_4=$num_4+1;
									//		}
									//		else if($num==5){
									//			$num_5=$num_5+1;
									//		}
									//		else if($num==6){
									//			$num_6=$num_6+1;
									//		}
									//		else if($num==7){
									//			$num_7=$num_7+1;
									//		}
									//	}
									//}
							        echo $rto = $num_1+$num_2+$num_3+$num_4+$num_5+$num_6+$num_7;?></td>
					                <td class="acne_cls">
										<?php $author_id = get_post_field( 'post_author', $post->ID );

										?>
					                    <a pst_id="<?php echo $author_id;?>" class="rew_link" href="javascript://void(0);"><?php
					                //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '3'");
							        echo $current_points=get_user_meta($author_id, 'rewards', true);?></a>
					                </td>
					                  <td class="acne_cls"><?php
					                //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '1'");
							        echo $num_1;?></td>
					                <td class="acne_cls"><?php
					                //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '2'");
							        echo $num_2;?></td>
					                <td class="acne_cls"><a pst_id="<?php echo $post->ID;?>" class="dnq_link" href="javascript://void(0);"><?php
					                //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '3'");
							        echo $num_3;?></a></td>
					                <td class="acne_cls"><a pst_id="<?php echo $post->ID;?>" class="action_link" href="javascript://void(0);"><?php
					                //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '3'");
							        echo $num_7;?></a></td>
					                <td class="acne_cls"><?php
					                //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '4'");
							        echo $num_4;?></td>
					                <td class="acne_cls"><?php
					                //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '5'");
							        echo $num_5;?></td>
					                <td class="acne_cls"><?php
					                //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '6'");
							        echo $num_6;?></td>
					                
					              </tr>

					              <?php }   ?>
					              <?php endwhile;  ?>

<?php } ?>
            </tbody>

          </table>
           <a  id="inifiniteLoader">Loading... <img src="<?php bloginfo('template_directory'); ?>/images/36.gif" /></a>
          <?php if(function_exists('wp_paginate')) {
    //wp_paginate();
}
wp_reset_query();
?>
</div>
<div class="div-table-content1 top_row">
    <table class="table table-condensed " >
        <thead>
         <tr>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                <th class="location"> </th>
                
            </tr>
          </thead>
    </table>
   </div>
        </div>
      </section>
    </div>
  </div>
</div>
<div id="embed3" class="white_content" style="cursor: auto; display: none;">
    <div class="col-xs-12 col-md-12 notes_left">
        <div class="row">
          <h2>NOTES</h2>
        </div>
        <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area" id="nts_div">
            <dl class="clinical_trial" id="dnq_nts">
                    <dt style=" color:#00afef;">
                            2015-7-16, 3:47:57 PM (
                                    Patient # 7																	)
                            (University of Cincinnati)
                    </dt>
                    <dd>
                            <p>Given info for Forensic and Behavioral Health in butler county, states she is bp but could not describe a manic episode.</p>
                    </dd>
            </dl>
        </div>
    </div>
    <a class="closepop" href="javascript:void(0);" onclick="document.getElementById('embed3').style.display='none';document.getElementById('fade').style.display='none';">Close</a>
</div>
<div id="embed4" class="white_content" style="cursor: auto; display: none;">
    <div class="col-xs-12 col-md-12 notes_left">
        <div class="row">
          <h2>REWARDS</h2>
        </div>
        <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area" id="rew_div">
            <dl class="clinical_trial" id="rew_nts">
                    <dt style=" color:#00afef;">
                            2015-7-16, 3:47:57 PM (
                                    Patient # 7																	)
                            (University of Cincinnati)
                    </dt>
                    <dd>
                            <p>Given info for Forensic and Behavioral Health in butler county, states she is bp but could not describe a manic episode.</p>
                    </dd>
            </dl>
        </div>
    </div>
    <a class="closepop" href="javascript:void(0);" onclick="document.getElementById('embed4').style.display='none';document.getElementById('fade').style.display='none';">Close</a>
</div>
<div class="black_overlay" id="fade" style="display: none;"></div>

<script>
//(function() { console.log(5); setTimeout(function(){console.log(6)}, 1000); setTimeout(function(){console.log(7)}, 0); console.log(8); })();
    var getBiggestCell = function(context){
        var cells = [];
        $.each(jQuery(context).find('td'), function(index, value){
            cells.push(value.clientHeight);
        });

        cells.sort(function(a,b){return a-b;});

        return cells.pop();
    };


	var resizeTable = function () {
		jQuery("#to_td_20996").height(85);
		jQuery(".div-table-content2 .table tr").each(function( index ){
	        var biggestHeight = getBiggestCell(this);
	        jQuery(this).css('height',biggestHeight+1+'px');
	        jQuery(this).find('td:first-child').css('height',biggestHeight+'px');
	        jQuery(this).find('td:nth-child(2)').css('height',biggestHeight+'px');
	        jQuery(this).find('td:nth-child(3)').css('height',biggestHeight+'px');
		});
		h_ht=jQuery(".div-table-content3 .table tr").height();
		h_ht=h_ht+1;
		jQuery(".div-table-content3 .table tr").find('th:first-child').css('height',h_ht+'px');
		jQuery(".div-table-content3 .table tr").find('th:nth-child(2)').css('height',h_ht+'px');
		jQuery(".div-table-content3 .table tr").find('th:nth-child(3)').css('height',h_ht+'px');
		var f_lft=jQuery(".div-table-content2").position().left;
		sf_lft=f_lft+140;
		tf_lft=sf_lft+150;
		jQuery('.div-table-content3 .table tr th:first-child').css('left',f_lft+'px');
		jQuery('.div-table-content2 .table tr td:first-child').css('left',f_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(3)').css('left',tf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(3)').css('left',tf_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(3)').css('left',tf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(3)').css('left',tf_lft+'px');
	};

	function refreshtop(){
		jQuery.ajax({
			async: true,
			timeout: 0,
			//url: "<?php bloginfo('wpurl') ?>/topdashboard",
			url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
			type:'POST',
			data: "action=dashboard_refresh_top",
			dataType: "json",
			success: function(html){
				var r_cnt=parseInt(html.red_num);
				var y_cnt=parseInt(html.yellow_num);
				var g_cnt=parseInt(html.green_num);
				var p_cnt=parseInt(html.purple_num);
				var t1_cnt=parseInt(html.tr1_num);
				var t2_cnt=parseInt(html.tr2_num);
				var t3_cnt=parseInt(html.tr3_num);
				var t4_cnt=parseInt(html.tr4_num);
				console.log(html);
				jQuery("#cn_today").html(html.today_count);
				jQuery("#cn_yesterday").html(html.yesterday_count);
				jQuery("#cn_rtotal").html(html.running_count);
				jQuery("#cn_red").html(html.red_count);
				jQuery("#cn_yellow").html(html.yellow_count);
				jQuery("#cn_green").html(html.green_count);
				jQuery("#cn_purple").html(html.purple_count);
				jQuery("#cn_clrtotal").html(html.color_total);
				jQuery("#cn_tr1").html(html.tr1_count);
				jQuery("#cn_tr2").html(html.tr2_count);
				jQuery("#cn_tr3").html(html.tr3_count);
				jQuery("#cn_tr4").html(html.tr4_count);
				jQuery(".active_acount").html("Active: "+ (html.active_no || 0) + "<br/>Inactive: "+(html.inactive_no||0));
				if(html.options_str !="no"){
					jQuery("#catgryname").html(html.options_str);
				}
				jQuery("#pie1").html("");
				var plot1 = jQuery.jqplot('pie1', [[['Red',r_cnt],['Yellow',y_cnt],['Green',g_cnt],['Purple',p_cnt]]], {
				gridPadding: {top:0, bottom:38, left:0, right:0},
				seriesDefaults:{
				shadow: false,
				    renderer:jQuery.jqplot.PieRenderer,
				    trendline:{ show:false },
				    rendererOptions: { padding:5, showDataLabels: false }
				},
				legend:{
				    show:false,
				    placement: 'outside',
				    rendererOptions: {
					numberRows: 1
				    },
				    location:'s',
				    marginTop: '10px'
				},
				grid: {
					drawBorder: false,
					drawGridlines: false,
					background: '#ffffff',
					shadow:false
				},
				seriesColors: [ "#dd0000", "#f9ce15", "#7dbc00", "#873fbd" ]
			    });
				jQuery("#pie2").html("");
				var plot1 = jQuery.jqplot('pie2', [[['T1',t1_cnt],['T2',t2_cnt],['T3',t3_cnt],['T4',t4_cnt]]], {
				gridPadding: {top:0, bottom:38, left:0, right:0},
				seriesDefaults:{
				shadow: false,
				    renderer:jQuery.jqplot.PieRenderer,
				    trendline:{ show:false },
				    rendererOptions: { padding:5, showDataLabels: false }
				},
				legend:{
				    show:false,
				    placement: 'outside',
				    rendererOptions: {
					numberRows: 1
				    },
				    location:'s',
				    marginTop: '10px'
				},
				grid: {
					drawBorder: false,
					drawGridlines: false,
					background: '#ffffff',
					shadow:false
				},
				seriesColors: [ "#5acbf6", "#ffae55", "#9fcf67", "#a9afb3" ]
			    });
			}
		});
	}
/* setting table stickheader height : (REQUIRED) */
	h_ht=jQuery(".div-table-content3 .table tr").height();
	h_ht=h_ht+1;
	jQuery(".div-table-content3 .table tr").find('th:first-child').css('height',h_ht+'px');
	jQuery(".div-table-content3 .table tr").find('th:nth-child(2)').css('height',h_ht+'px');
	jQuery(".div-table-content3 .table tr").find('th:nth-child(3)').css('height',h_ht+'px');
	resizeTable();
/* end */

	/*
	jQuery("#to_td_20996").height(85);
	jQuery(".div-table-content2 .table tr").each(function( index ){
        var biggestHeight = getBiggestCell(this);

		jQuery(this).css('height',biggestHeight+'px');
		jQuery(this).find('td:first-child').css('height',biggestHeight+'px');
		jQuery(this).find('td:nth-child(2)').css('height',biggestHeight+'px');
		jQuery(this).find('td:nth-child(3)').css('height',biggestHeight+'px');
	});
	var f_lft=jQuery(".div-table-content2").position().left;
	sf_lft=f_lft+140;
	tf_lft=sf_lft+150;
	jQuery('.div-table-content3 .table tr th:first-child').css('left',f_lft+'px');
	jQuery('.div-table-content2 .table tr td:first-child').css('left',f_lft+'px');
	jQuery('.div-table-content3 .table tr th:nth-child(2)').css('left',sf_lft+'px');
	jQuery('.div-table-content2 .table tr td:nth-child(2)').css('left',sf_lft+'px');
	jQuery('.div-table-content3 .table tr th:nth-child(2)').css('left',sf_lft+'px');
	jQuery('.div-table-content2 .table tr td:nth-child(2)').css('left',sf_lft+'px');
	jQuery('.div-table-content3 .table tr th:nth-child(3)').css('left',tf_lft+'px');
	jQuery('.div-table-content2 .table tr td:nth-child(3)').css('left',tf_lft+'px');
	jQuery('.div-table-content3 .table tr th:nth-child(3)').css('left',tf_lft+'px');
	jQuery('.div-table-content2 .table tr td:nth-child(3)').css('left',tf_lft+'px');
	
	
	//setInterval(function(){ refreshtop(); }, 150000);
*/
/*	
	setInterval(function(){
		jQuery("#to_td_20996").height(85);
		jQuery(".div-table-content2 .table tr").each(function( index ){
            var biggestHeight = getBiggestCell(this);
            jQuery(this).css('height',biggestHeight+1+'px');
            jQuery(this).find('td:first-child').css('height',biggestHeight+'px');
            jQuery(this).find('td:nth-child(2)').css('height',biggestHeight+'px');
            jQuery(this).find('td:nth-child(3)').css('height',biggestHeight+'px');
		});
		h_ht=jQuery(".div-table-content3 .table tr").height();
		h_ht=h_ht+1;
		jQuery(".div-table-content3 .table tr").find('th:first-child').css('height',h_ht+'px');
		jQuery(".div-table-content3 .table tr").find('th:nth-child(2)').css('height',h_ht+'px');
		jQuery(".div-table-content3 .table tr").find('th:nth-child(3)').css('height',h_ht+'px');
		var f_lft=jQuery(".div-table-content2").position().left;
		sf_lft=f_lft+140;
		tf_lft=sf_lft+150;
		jQuery('.div-table-content3 .table tr th:first-child').css('left',f_lft+'px');
		jQuery('.div-table-content2 .table tr td:first-child').css('left',f_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(2)').css('left',sf_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(3)').css('left',tf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(3)').css('left',tf_lft+'px');
		jQuery('.div-table-content3 .table tr th:nth-child(3)').css('left',tf_lft+'px');
		jQuery('.div-table-content2 .table tr td:nth-child(3)').css('left',tf_lft+'px');
	}, 500);
*/
</script>
<script type="application/javascript">
jQuery("#study_search_frm").on("submit",function(event){
	var srhval=jQuery("#stdsrh").val();
	if(srhval==""){
		return false;
	}
});
jQuery(document).on('click','.dnq_link',function(){
	jQuery("#fade").show();
	post_id=jQuery(this).attr('pst_id');
	jQuery.ajax({
		async: true,
		url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
		type:'POST',
		data: "action=dashboard_dnq&post_id="+ post_id + '&loop_file=dashboard_notes',
		success: function(html){
			jQuery("#nts_div").html(html);
			jQuery("#embed3").show();
		}
	});

});
jQuery(document).on('click','.action_link',function(){
	jQuery("#fade").show();
	post_id=jQuery(this).attr('pst_id');
	jQuery.ajax({
		async: true,
		url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
		type:'POST',
		data: "action=dashboard_dnq&post_id="+ post_id + '&loop_file=dashboard_notes&nt_type=7',
		success: function(html){
			jQuery("#nts_div").html(html);
			jQuery("#embed3").show();
		}
	});

});
jQuery(document).on('click','.rew_link',function(){






	jQuery("#fade").show();
	post_id=jQuery(this).attr('pst_id');
       	jQuery.ajax({
		async: true,
		url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
		type:'POST',
		data: "action=dashboard_rew&post_id="+ post_id + '&loop_file=dashboard_rewards',
		success: function(html){
			jQuery("#rew_div").html(html);
			jQuery("#embed4").show();
		}
	});

});
jQuery(document).on('click','#search-multi',function(){
	setInterval(function(){
		jQuery('a#inifiniteLoader').hide('10');
	},10);

});
jQuery(document).on('click','#search-box',function(){
	setInterval(function(){
		jQuery('a#inifiniteLoader').hide('10');
	},10);
});
window.onresize = resizeTable;

jQuery(window).load(function(){
	<?php //$cat_options=$_SESSION["option_details"]; ?>
	var search_query_submit = <?php echo ($search_query_submit != '' ? $search_query_submit: 0); ?>;
	var is_refresh=0;
	var refresh_loading=0;
	var max_count=10000;
	var count = 2;
	var loading  = false;
				if(refresh_loading == 0){
					refresh_loading = 1;
					jQuery.ajax({
						async: true,
						url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
						type:'POST',
						data: "action=dashboard_refresh_top",
						dataType: "json",
						success: function(html){
							is_refresh=1;
							console.log(html);
							var r_cnt=parseInt(html.red_num);
							var y_cnt=parseInt(html.yellow_num);
							var g_cnt=parseInt(html.green_num);
							var p_cnt=parseInt(html.purple_num);
							var t1_cnt=parseInt(html.tr1_num);
							var t2_cnt=parseInt(html.tr2_num);
							var t3_cnt=parseInt(html.tr3_num);
							var t4_cnt=parseInt(html.tr4_num);
							jQuery("#cn_today").html(html.today_count);
							jQuery("#cn_yesterday").html(html.yesterday_count);
							jQuery("#cn_rtotal").html(html.running_count);
							jQuery("#cn_red").html(html.red_count);
							jQuery("#cn_yellow").html(html.yellow_count);
							jQuery("#cn_green").html(html.green_count);
							jQuery("#cn_purple").html(html.purple_count);
							jQuery("#cn_clrtotal").html(html.color_total);
							jQuery("#cn_tr1").html(html.tr1_count);
							jQuery("#cn_tr2").html(html.tr2_count);
							jQuery("#cn_tr3").html(html.tr3_count);
							jQuery("#cn_tr4").html(html.tr4_count);
							jQuery(".active_acount").html("Active: "+ (html.active_no || 0 )+"<br/>Inactive: "+ ( html.inactive_no || 0));
							if(html.options_str !="no"){
								jQuery("#catgryname").html(html.options_str);
							}
							jQuery("#pie1").html("");
							var plot1 = jQuery.jqplot('pie1', [[['Red',r_cnt],['Yellow',y_cnt],['Green',g_cnt],['Purple',p_cnt]]], {
							gridPadding: {top:0, bottom:38, left:0, right:0},
							seriesDefaults:{
							shadow: false,
								renderer:jQuery.jqplot.PieRenderer,
								trendline:{ show:false },
								rendererOptions: { padding:5, showDataLabels: false }
							},
							legend:{
								show:false,
								placement: 'outside',
								rendererOptions: {
								numberRows: 1
								},
								location:'s',
								marginTop: '10px'
							},
							grid: {
								drawBorder: false,
								drawGridlines: false,
								background: '#ffffff',
								shadow:false
							},
							seriesColors: [ "#dd0000", "#f9ce15", "#7dbc00", "#873fbd" ]
							});
							jQuery("#pie2").html("");
							var plot1 = jQuery.jqplot('pie2', [[['T1',t1_cnt],['T2',t2_cnt],['T3',t3_cnt],['T4',t4_cnt]]], {
							gridPadding: {top:0, bottom:38, left:0, right:0},
							seriesDefaults:{
							shadow: false,
								renderer:jQuery.jqplot.PieRenderer,
								trendline:{ show:false },
								rendererOptions: { padding:5, showDataLabels: false }
							},
							legend:{
								show:false,
								placement: 'outside',
								rendererOptions: {
								numberRows: 1
								},
								location:'s',
								marginTop: '10px'
							},
							grid: {
								drawBorder: false,
								drawGridlines: false,
								background: '#ffffff',
								shadow:false
							},
							seriesColors: [ "#5acbf6", "#ffae55", "#9fcf67", "#a9afb3" ]
							});
						}
					});
				}


	function loadArticle() {
		if(loading == false && count < max_count ){
			loading=true;
			jQuery('a#inifiniteLoader').show('fast');
			jQuery.ajax({
				url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
				type:'POST',
				data: "action=infinite_scroll&page_no="+ count + '&loop_file=loop',
				success: function(html){
					html=jQuery.trim(html);
					
					if(html !=""){

						jQuery(".location_total").html(parseInt(jQuery(".location_total").html()) + ( isNaN(parseInt(jQuery(html).find("#sumtotal").val())) ? 0 : parseInt(jQuery(html).find("#sumtotal").val())));
						jQuery(".location_today").html(parseInt(jQuery(".location_today").html()) + ( isNaN(parseInt(jQuery(html).find("#sumtoday").val())) ? 0 : parseInt(jQuery(html).find("#sumtoday").val())));
						jQuery(".location_yesterday").html(parseInt(jQuery(".location_yesterday").html()) + ( isNaN(parseInt(jQuery(html).find("#sumyesterday").val())) ? 0 :parseInt(jQuery(html).find("#sumyesterday").val())) );
						_numtotal = parseInt(jQuery(html).find("#sumnum1").val())
						 + parseInt(jQuery(html).find("#sumnum2").val()) + parseInt(jQuery(html).find("#sumnum3").val())
						 + parseInt(jQuery(html).find("#sumnum4").val()) + parseInt(jQuery(html).find("#sumnum5").val()) 
						 + parseInt(jQuery(html).find("#sumnum6").val()) + parseInt(jQuery(html).find("#sumnum7").val());

						jQuery(".location_numtotal").html(parseInt(jQuery(".location_numtotal").html()) + ( isNaN(_numtotal) ? 0 : _numtotal));
						jQuery(".location_rewards").html(parseInt(jQuery(".location_rewards").html()) + ( isNaN(parseInt(jQuery(html).find("#sumcurrent").val())) ? 0 : parseInt(jQuery(html).find("#sumcurrent").val())) );
						jQuery(".location_new_patient").html(parseInt(jQuery(".location_new_patient").html()) + ( isNaN(parseInt(jQuery(html).find("#sumnum1").val())) ? 0 : parseInt(jQuery(html).find("#sumnum1").val())) );
						jQuery(".location_call_attempted").html(parseInt(jQuery(".location_call_attempted").html()) + ( isNaN(parseInt(jQuery(html).find("#sumnum2").val())) ? 0 : parseInt(jQuery(html).find("#sumnum2").val())) );
						jQuery(".location_notqualified").html(parseInt(jQuery(".location_notqualified").html()) + ( isNaN(parseInt(jQuery(html).find("#sumnum3").val())) ? 0 : parseInt(jQuery(html).find("#sumnum3").val())) );
						jQuery(".location_action_needed").html(parseInt(jQuery(".location_action_needed").html()) + ( isNaN(parseInt(jQuery(html).find("#sumnum7").val())) ? 0 : parseInt(jQuery(html).find("#sumnum7").val())) );
						jQuery(".location_scheduled").html(parseInt(jQuery(".location_scheduled").html()) + ( isNaN(parseInt(jQuery(html).find("#sumnum4").val())) ? 0 : parseInt(jQuery(html).find("#sumnum4").val())) );
						jQuery(".location_consented").html(parseInt(jQuery(".location_consented").html()) + ( isNaN(parseInt(jQuery(html).find("#sumnum5").val())) ? 0 : parseInt(jQuery(html).find("#sumnum5").val())) );
						jQuery(".location_randomized").html(parseInt(jQuery(".location_randomized").html()) + ( isNaN(parseInt(jQuery(html).find("#sumnum6").val())) ? 0 : parseInt(jQuery(html).find("#sumnum6").val())) );

						jQuery(".div-table-content2 table tbody").append(html);    // This will be the div where our content will be loaded
						resizeTable();
						
						count++;
						loading=false;
						jQuery('a#inifiniteLoader').hide('10');
					}
					else{
						jQuery('a#inifiniteLoader').hide('10');
						max_count=0;
					}
				}
			});
		}
	}
	
	jQuery(window).scroll(function(){
		console.log("search_query_submit:" + search_query_submit);
		if (search_query_submit == 1) {
			var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();
			var  scrolltrigger = 0.10;
			if ((wintop/(docheight-winheight)) > scrolltrigger){

			}
			if(jQuery(window).scrollTop() > jQuery(document).height() - jQuery(window).height()-3000){
				if (refresh_loading == 1 && loading == false && count < max_count ){
					loadArticle(count);
				}
			}
		}
	});
	
	
});

</script>
 <!---->
				<!--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->

				 <script>
				  $(function() {
				  $( "#datepicker" ).datepicker();
				  $( "#datepicker1" ).datepicker();
				  });
				  </script>

<?php wp_footer(); ?>

<?php 
function counting_active_inactive ($post_status) {
	global $active_no, $inactive_no, $tier, $cnt_tier_1, $cnt_tier_2, $cnt_tier_3, $cnt_tier_4;
	if ($post_status == 'active' ) {
		$active_no++;
	} else {
		$inactive_no++;
	}
	if($tier==1){
      $cnt_tier_1=$cnt_tier_1+1;
    }
    if($tier==2){
      $cnt_tier_2=$cnt_tier_2+1;
    }
    if($tier==3){
      $cnt_tier_3=$cnt_tier_3+1;
    }
    if($tier==4){
      $cnt_tier_4=$cnt_tier_4+1;
    }

}

function  counting_colors($days_left, $final_result) {
	global $total_purple_clr, $total_red_clr, $total_yellow_clr, $total_green_clr, $is_any, $post_status;
	if($days_left<=2){
		#counting_active_inactive($post_status);
      	$total_purple_clr=$total_purple_clr+1;
      	$is_any=0;
    }
    else{
      if($final_result < .87){
      	#counting_active_inactive($post_status);
        $total_red_clr=$total_red_clr+1;
        $is_any=0;
      }
      if($final_result > 1.2){
      	#counting_active_inactive($post_status);
        $total_yellow_clr=$total_yellow_clr+1;
        $is_any=0;
      }
    }
    if($is_any==1){
    	#counting_active_inactive($post_status);
      	$total_green_clr=$total_green_clr+1;
    }
}

function counting_colors_extra_options($days_left, $final_result, $tier, $exposure_level) {
	global $r_tier, $r_level, $post_status, $search_color_ids, $post;

	if($r_tier!="" || $r_level !="" ){

		if($r_tier!="" && $r_level !="" ){
			if($tier==$r_tier && $exposure_level==$r_level){
				$search_color_ids[$post->ID]['tier']=$tier;
	                $search_color_ids[$post->ID]['level']=$exposure_level;
				counting_colors($days_left, $final_result);
				counting_active_inactive($post_status);
			}
		} else {
			if($r_tier!=""){
				if($tier==$r_tier){
					$search_color_ids[$post->ID]['tier']=$tier;
	                $search_color_ids[$post->ID]['level']=$exposure_level;
					counting_colors($days_left, $final_result);
					counting_active_inactive($post_status);
				}
			}	else {
				if($exposure_level==$r_level){

					$search_color_ids[$post->ID]['tier']=$tier;
	                $search_color_ids[$post->ID]['level']=$exposure_level;
					counting_colors($days_left, $final_result);
					counting_active_inactive($post_status);
				}
			}
		}

	} else {
		$search_color_ids[$post->ID]['tier']=$tier;
	                $search_color_ids[$post->ID]['level']=$exposure_level;
		counting_colors($days_left, $final_result);
		counting_active_inactive($post_status);
	}
}

function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
    // $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 
?>