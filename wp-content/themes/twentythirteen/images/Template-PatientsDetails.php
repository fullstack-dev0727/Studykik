<?php
/*
 * Template Name: Patients Details
 */
?>
<?php
if (is_user_logged_in()){
$user_ID = get_current_user_ID();
} else {
wp_redirect('http://studykik.com/login/', 301);
exit;
}
?>
<?php
// ************************************print csvfile************************
if (isset($_REQUEST['get_csv_file'])) {
    if (PHP_SAPI == 'cli')
        die('This example should only be run from a Web Browser');
    /** Include PHPExcel */
    require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
// Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
// Set document properties
    $objPHPExcel->getProperties()->setCreator("StudyKIK Team")
            ->setLastModifiedBy("StudyKIK Team")
            ->setTitle("Download Patient Report")
            ->setSubject("Download Patient Report")
            ->setDescription("Download Patient Report")
            ->setKeywords("Download Patient Report")
            ->setCategory("Download Patient Report");
// Add some data
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A6', 'Patient Status')
            ->setCellValue('B6', 'Name')
            ->setCellValue('C6', 'Email Address')
            ->setCellValue('D6', 'Mobile Number')
            ->setCellValue('E6', 'Sign Up Date')
            ->setCellValue('F6', '     Notes    ');
// Miscellaneous glyphs, UTF-8
    $aaa = $_REQUEST['pid'];
    $post_title = get_the_title($aaa);
    $file = 'StudyKIK_Patient_Report.csv';
    $query2 = ("SELECT * FROM 0gf1ba_subscriber_list where post_id=$aaa");
    $get_results = $wpdb->get_results($query2);
    $total_count = count($get_results);
    $i = 6;
    foreach ($get_results as $values) {
        $i++;
        $aaa_ID = $values->id;
        $query_notes = $wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID' ORDER BY id DESC", OBJECT);
        if ($values->row_num == 1) {
            $csv_output = "New Patients";
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $csv_output);
        }
        if ($values->row_num == 2) {
            $csv_output = "Call Attempted";
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $csv_output);
        }
        if ($values->row_num == 3) {
            $csv_output = "Not Qualified / Not Interested";
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $csv_output);
        }
        if ($values->row_num == 4) {
            $csv_output = "Scheduled";
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $csv_output);
        }
        if ($values->row_num == 5) {
            $csv_output = "Consented";
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $csv_output);
        }
        if ($values->row_num == 6) {
            $csv_output = "Randomized";
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $csv_output);
        }
        if ($values->row_num == 7) {
            $csv_output = "Action Needed";
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $csv_output);
        }
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $values->name)
                ->setCellValue('C' . $i, $values->email)
                ->setCellValue('D' . $i, format_telephone($values->phone))
                ->setCellValue('E' . $i, $values->date);
        $objPHPExcel->getActiveSheet()->getStyle('A6')->getAlignment()->applyFromArray(
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
        $objPHPExcel->getActiveSheet()->getStyle('B6')->getAlignment()->applyFromArray(
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
        $objPHPExcel->getActiveSheet()->getStyle('C6')->getAlignment()->applyFromArray(
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
        $objPHPExcel->getActiveSheet()->getStyle('D6')->getAlignment()->applyFromArray(
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
        $objPHPExcel->getActiveSheet()->getStyle('E6')->getAlignment()->applyFromArray(
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
        if ($query_notes) {
            $j = 'E';
            foreach ($query_notes as $results_notes) {
                $j++;
                $date_here = str_replace("?", "", $results_notes->notes_date);
                $fianl_notes = date('m-d-Y h:i:s', strtotime($date_here));
                $notes_ = $fianl_notes . "\n" . $results_notes->notes;

                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($j . $i, $notes_);
                $objPHPExcel->getActiveSheet()->getStyle($j . $i)->getAlignment()->applyFromArray(
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
    $objPHPExcel->getActiveSheet()->getStyle('A6:Z6')->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
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
	$objPHPExcel->getActiveSheet()->mergeCells('A1:B4');
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo');
    $objDrawing->setDescription('Logo');
    $logo = dirname(__FILE__) . '/images/Studykik-logo-slider.png';
    $objDrawing->setPath($logo);
    $objDrawing->setCoordinates('A1');
    $objDrawing->setHeight(100);
    $objDrawing->setWidth(200);
    $objDrawing->setOffsetY(0);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
// Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Download Patient Report');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $file = 'StudyKIK_Patient_Report.xls';
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
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
    exit;
}
/* ==================== END ================================ */
?>
<?php get_header('dashboard'); ?>
<!-- Pure Chat Snippet -->
<script type='text/javascript'>
    (function () {
        var done = false;
        var script = document.createElement('script');
        script.async = true;
        script.type = 'text/javascript';
        script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript';
        document.getElementsByTagName('HEAD').item(0).appendChild(script);
        script.onreadystatechange = script.onload = function (e) {
            if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
                var w = new PCWidget({c: 'bab234e1-3a99-448d-b117-2bb29457f303', f: true});
                done = true;
            }
        };
    })();
</script>
<script type="application/javascript">
    jQuery(document).ready(function( $ ) {
    jQuery(".clear_all").hide();
    jQuery(".loading_imag").hide();
    /*jQuery( ".search_for_patient" ).keyup(function() {
    var dInput = this.value;
    var pidsds = jQuery('#pidsds').val();
    jQuery(".clear_all").show();
    jQuery(".loading_imag").show();
    jQuery('.dhe-example-section-content').hide();
    jQuery.ajax({
    type: "GET",
    url: "<?php bloginfo('url'); ?>/search-patients/",
    data: "search123=" + dInput + "&pidsds="+pidsds,
    success: function (data) {
    jQuery(".loading_imag").hide();
    jQuery('.dhe-example-section-content').html(data);
    jQuery('.dhe-example-section-content').show();
    }
    });
    });*/
    jQuery( ".clear_all" ).click(function() {
    window.location.href = window.location.href;
    });
    });
</script>
<script>
    jQuery(document).ready(function () {
//Remove the notes functionalit from the popup
        jQuery(".removeNote").click(function () {
            var noteId = $(this).attr('id');
            var noteParentId = 'parent' + $(this).attr('id');
            console.log("To remove Note !");
            parent = $("#" + noteParentId);
            jQuery.ajax({
                type: "GET",
                url: "<?php bloginfo('url'); ?>/jquery-notes/",
                data: "notes_id=" + noteId + "&action=remove_note",
                success: function (data) {
                    console.log("Data: " + data);
                    if (jQuery.trim(data) == "TRUE") {
                        // parent.slideUp(300,function() {
                        $("#parent" + noteId).remove();
                        //});
                    }
                }
            });
            return false;
        });
        jQuery(".add_button").click(function () {
            jQuery(this).closest('form').addClass("selected_form");
            jQuery('.selected_form .notes_text').css('border-color', 'rgb(169, 169, 169)');
            //var notes_text = jQuery('.selected_form .notes_text').val();
            //var add_p_id = jQuery('.selected_form .add_p_id').val();
            var notes_text = jQuery(this).siblings('.notes_text').val();
            var add_p_id = jQuery(this).siblings('.add_p_id').val();
            var d = new Date();
            var dateTime = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate() + ', ' + d.toLocaleTimeString();
            if (notes_text.length > 0) {
                jQuery.ajax({
                    type: "GET",
                    url: "<?php bloginfo('url'); ?>/jquery-notes/",
                    data: "notes_text=" + encodeURIComponent(notes_text) + "&action=new_note&add_p_id=" + add_p_id + "&datetime=" + dateTime,
                    success: function (data) {
                        jQuery('#embed' + add_p_id + ' .notes_right').html(data);
                        jQuery(".notes_text").val('');
                    }
                });
            }
        });
        jQuery(".closepop").click(function () {
            var notes_refresh = 'notes_refresh';
            var notes_id = jQuery(this).attr('id');
            jQuery.ajax({
                type: "GET",
                url: "<?php bloginfo('url'); ?>/jquery-notes/",
                data: "notes_refresh1=" + notes_id,
                success: function (data) {
                    jQuery('.aaaa' + notes_id).attr({"data-tooltip": data});
                }
            });

        });
    });
</script>
<script type="application/javascript">
    jQuery( document ).ready(function() {
    var aaa= jQuery( ".dhe-example-section-content" ).outerHeight();
    jQuery('.sortable-list').css({ 'min-height': aaa });
    jQuery(window).scroll(function() {
    var scroll = jQuery(window).scrollTop();
    if (scroll >= 420) {
    jQuery(".aaaaaaaaaaa").addClass("navbar-fixed-top");
    $( "body" ).addClass( "scroll_added" );
    $("#search_btn_form").css({
    'position' : 'fixed',
    'z-index' : '99',
    'top' : '50px',
    'right' : '53px'
    });
    } else {
    jQuery(".aaaaaaaaaaa").removeClass("navbar-fixed-top");
    $( "body" ).removeClass( "scroll_added" );
    $("#search_btn_form").css({
    'position' : 'relative',
    'z-index' : '99',
    'top' : '0px',
    'right' : '0px'
    });
    }
    });
    jQuery(window).live('resize', function(){
    var win = jQuery(this);
    if (win.width() < 600) {jQuery(".aaaaaaaaaaa").addClass("navbar-fixed-top");}
    });
    });
</script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/dragdrop/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/dragdrop/devheart-examples.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/patient-table-responsive.css" media="screen" />
<div id="banner_login">
    <div class="container">
        <div class="row">
            <div class="dashboard_banner">
                <header id="top">
                    <h1><a href="index.html">Kitchy Food</a><img src="<?php bloginfo('template_url'); ?>/images-dashboard/logout_logo.png" alt=""></h1>
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li ><a style="margin-top:12px;" href="http://studykik.com/dashboard/">Home</a></li>
                                    <li><a href="http://studykik.com/refer-listing/">REFER <br>
                                            A LISTING</a></li>
                                    <li  style="border:none;"><a   class="midsection" href="http://studykik.com/clinical-study-information-dashboard/">LIST A <br>
                                            NEW STUDY</a></li>
                                    <li><a style="margin: 12px 0 0 66px;font-size:0px;" href="">.</a></li>
                                    <li><a style="margin-top: 12px" href="/rewards/">REWARDS</a></li>
                                    <li><a href="http://studykik.com/your-profile/?idp=Profile">MY ACCCOUNT <br>
                                            INFORMATION</a></li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                            <div class="project_manager">
                                <h5>Stud<small>y</small><cite>KIK</cite> Project Manager: <span><?php echo get_the_author_meta('project_manager', $user_ID); ?></span> - <span><?php echo get_the_author_meta('phone_number', $user_ID); ?></span></h5>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
            </div>
        </div>
<?php
$pid = $_REQUEST['pid'];
global $wpdb;
?>
        <div class="row">
            <section class="container_current">
                <div class="col-xs-4 search_right_patient">
                    <div class="form-search form-inline" id="search_btn_form">
                        <input type="text" placeholder="Search For a Patient" class="search_for_patient" onkeyup="findPatientDetail(this.value);" id="search_btn">
                        <a href="javascript:void(0);" class="clear_all">Clear Search</a>
                        <input type="hidden" value="<?php echo $pid; ?>" id="pidsds" />
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="clinical_trial">
                        <h2><a class="back_button" href="/dashboard/"><<-- Return to Current Studies</a>
                                    <?php
                                    $post_pid = get_post($pid);
                                    echo $post_pid->post_title;
                                    ?>
                            <a class="add_button" href="javascript:void(0);" onclick="document.getElementById('embed').style.display = 'block';
                                    document.getElementById('fade').style.display = 'block'">Add Patient</a></h2>
                        <div style="float: right; width: 590px;"><p style="color: #f68d20;font: 18px helveticaregular ! important;margin: 3px 15px 0px 0px; float:left;">Total Study Views: <span style="color:#00aff0;"><?php echo get_post_meta($pid, 'views', true); ?></span><br/>
                                Total Patient Referrals: <span style="color:#00aff0;"><?php $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid'");
                                    echo $wpdb->num_rows;
                                    ?></span>
                            </p> <form action="" method="post">
                                <input style="border: medium none; float: right;" type="submit" class="add_button" value="Download Patient Report" name="get_csv_file" />
                            </form></div>
                    </div>
                </div>
                <div id="center-wrapper">
                    <h1 id="updated" style="display: block; font-size: 20px; text-align: center; margin: 0px; padding: 0px; color: rgb(159, 207, 103);"></h1>
                    <div class="dhe-example-section" id="ex-2-3">
                        <div class="loading_imag" style="text-align:center;"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/ajax-loader.gif" /></div>
                        <?php
                        $query = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' ORDER BY order_id ASC", OBJECT);
                        $r1=0;
                        $r2=0;
                        $r3=0;
                        $r4=0;
                        $r5=0;
                        $r6=0;
                        $r7=0;
                        $all_queries=array();
                        $all_notes=array();
                        $all_ids=array();
                        $all_modified_qry=array();
                        foreach($query as $i => $qry){
                            $qid=$qry->id;
                            $all_ids[$i]=$qry->id;
                            $all_modified_qry[$qid]['subscriber']=$qry;
                        }
                        //echo "<pre>";
                        $str_all_ids=implode(",",$all_ids);

                        $notes_query = $wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id IN ( $str_all_ids )", OBJECT);
                        //print_r($notes_query);
                        foreach($notes_query as $ik => $note){
                            $note_id=$note->note_id;
                            $all_modified_qry[$note_id]['all_notes'][$ik]=$note;
                        }

                        foreach($all_modified_qry as $i => $qry){
                            $n_row=$qry['subscriber']->row_num;
                            if($n_row==1){
                                $r1+=1;
                                $all_queries[1][$i]=$qry['subscriber'];
                                $all_notes[1][$i]=$qry['all_notes'];
                            }
                            if($n_row==2){
                                $r2+=1;
                                $all_queries[2][$i]=$qry['subscriber'];
                                $all_notes[2][$i]=$qry['all_notes'];
                            }
                            if($n_row==3){
                                $r3+=1;
                                $all_queries[3][$i]=$qry['subscriber'];
                                $all_notes[3][$i]=$qry['all_notes'];
                            }
                            if($n_row==4){
                                $r4+=1;
                                $all_queries[4][$i]=$qry['subscriber'];
                                $all_notes[4][$i]=$qry['all_notes'];
                            }
                            if($n_row==5){
                                $r5+=1;
                                $all_queries[5][$i]=$qry['subscriber'];
                                $all_notes[5][$i]=$qry['all_notes'];
                            }
                            if($n_row==6){
                                $r6+=1;
                                $all_queries[6][$i]=$qry['subscriber'];
                                $all_notes[6][$i]=$qry['all_notes'];
                            }
                            if($n_row==7){
                                $r7+=1;
                                $all_queries[7][$i]=$qry['subscriber'];
                                $all_notes[7][$i]=$qry['all_notes'];
                            }
                        }
                         //print_r($all_queries);
                         //print_r($all_notes);
                        $query=$all_queries[1];
                        $query2=$all_queries[2];
                        $query3=$all_queries[3];
                        $query4=$all_queries[4];
                        $query5=$all_queries[5];
                        $query6=$all_queries[6];
                        $query7=$all_queries[7];

                        ?>
                        <div class="dhe-example-section-content">
                            <table class="table table-bordered aaaaaaaaaaa">
                                <thead>
                                    <tr bgcolor="#959ca1">
                                        <th><button class="contact" type="button">
                                                <p><span id="newPatients"><?php echo $r1; ?></span> New Patients</p>
                                            </button>
                                            <i class="fa fa-caret-right arrow" ><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                        <th><button class="contact" type="button">
                                                <p><span id="callAttempted"><?php echo $r2; ?></span> Call Attempted</p>
                                            </button>
                                            <i class="fa fa-caret-right arrow" ><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                        <th class="pad_class"><button class="contact" type="button">
                                                <p><span id="notQualified"><?php echo $r3; ?></span>  Not Qualified /<br  />
                                                    Not Interested</p>
                                            </button>
                                            <i class="fa fa-caret-right arrow" ><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                        <th><button class="contact" type="button">
                                                <p><span id="actionNeeded"><?php echo $r7; ?></span> Action Needed</p>
                                            </button>
                                            <i class="fa fa-caret-right arrow" ><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                        <th><button class="contact" type="button">
                                                <p><span id="scheduled"><?php echo $r4; ?></span> Scheduled</p>
                                            </button>
                                            <i class="fa fa-caret-right arrow" ><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                        <th><button class="contact" type="button">
                                                <p><span id="consented"><?php echo $r5; ?></span> Consented</p>
                                            </button>
                                            <i class="fa fa-caret-right arrow" style="line-height: 0; content: none;"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                        <th><button class="contact" type="button">
                                                <p><span id="randomized"><?php echo $r6; ?></span> Randomized</p>
                                            </button>
                                            <i class="fa fa-caret-right arrow" style="line-height: 0; content: none;"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- BEGIN: XHTML for example 2.3 -->
                                  <?php ?>
                            <div id="example-2-3">
                                <div class="column left first">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr bgcolor="#959ca1">
                                                <th><button class="contact" type="button">
                                                        <p>New Patients</p>
                                                    </button>
                                                    <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <ul spanid="newPatients" id="newPatients" class="sortable-list">
                                        <?php
                                        $redirect_num = get_post_meta($pid, 'redirect_number', true);
                                        if ($query) {
                                            foreach ($query as $results) {
                                                $aaa_ID = $results->id;
                                                $item = explode(" ", $results->date);
                                                $item2 = explode(" ", $results->last_modify);
                                                if ($item[0] != "") {
                                                    $sign_dt = date("m-d-Y", strtotime($item[0]));
                                                } else {
                                                    $sign_dt = $item[0];
                                                }
                                                if ($item2[0] != "") {
                                                    $act_dt = date("m-d-Y", strtotime($item2[0]));
                                                } else {
                                                    $act_dt = $item2[0];
                                                }
                                                echo '<li class="sortable-item" id="' . $results->id . '">';
                                                echo '<strong>' . $results->name;
                                                echo '</strong><br />';
                                                echo '<span>' . $results->email;
                                                echo '</span><br />';
                                                echo '<span>' . format_telephone($results->phone);
                                                echo '</span><br />';
                                                echo '<span>Signed Up: ' . $sign_dt;
                                                echo '</span><br />';
                                                echo '<span>Action Taken: ' . $act_dt;
                                                echo '</span><br />';
                                                ?>
                                           <?php if ($redirect_num != '' && $results->is_front == 1) { ?>
                                               <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="margin-left: 45px;" class="replacenotes aaaa<?php echo $results->id; ?>" id="add_not"><img  src="<?php bloginfo('template_url'); ?>/images-dashboard/que.png" /></a>
                                                <?php } ?>
                                                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
                                                <a data-tooltip="<?php echo isset($query_notes[0]->notes) ? $query_notes[0]->notes : 'Add notes'; ?>" data-tooltip-position="top" onclick="document.getElementById('embed<?php echo $results->id; ?>').style.display = 'block';
                                                        document.getElementById('fade').style.display = 'block'" href="javascript:void(0);" style="float:right;" class="replacenotes aaaa<?php echo $results->id; ?>" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
                                                </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </ul>
                                </div>
                                <div class="column left">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr bgcolor="#959ca1">
                                                <th><button class="contact" type="button">
                                                        <p>Call Attempted</p>
                                                    </button>
                                                    <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <ul spanid="callAttempted" class="sortable-list">
                                        <?php
                                        if ($query2) {
                                            foreach ($query2 as $results2) {
                                                $aaa_ID2 = $results2->id;
                                                $item2 = explode(" ", $results2->date);
                                                $item22 = explode(" ", $results2->last_modify);
                                                if ($item2[0] != "") {
                                                    $sign_dt = date("m-d-Y", strtotime($item2[0]));
                                                } else {
                                                    $sign_dt = $item2[0];
                                                }
                                                if ($item22[0] != "") {
                                                    $act_dt = date("m-d-Y", strtotime($item22[0]));
                                                } else {
                                                    $act_dt = $item22[0];
                                                }
                                                echo '<li class="sortable-item" id="' . $results2->id . '">';
                                                echo '<strong>' . $results2->name;
                                                echo '</strong><br />';
                                                echo '<span>' . $results2->email;
                                                echo '</span><br />';
                                                echo '<span>' . format_telephone($results2->phone);
                                                echo '</span><br />';
                                                echo '<span>Signed Up: ' . $sign_dt;
                                                echo '</span><br />';
                                                echo '<span>Action Taken: ' . $act_dt;
                                                echo '</span><br />';
                                                ?>
                                                <?php if ($redirect_num != '' && $results->is_front == 1) { ?>
                                                  <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results2->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="margin-left: 45px;" class="replacenotes aaaa<?php echo $results2->id; ?>" id="add_not"><img  src="<?php bloginfo('template_url'); ?>/images-dashboard/que.png" /></a>
                                                <?php } ?>
                                                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results2->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a> <a data-tooltip="<?php echo isset($query_notes2[0]->notes) ? $query_notes2[0]->notes : 'Add notes'; ?>" data-tooltip-position="top"  onclick="document.getElementById('embed<?php echo $results2->id; ?>').style.display = 'block';
                                                        document.getElementById('fade').style.display = 'block'" href="javascript:void(0);" style="float:right;" id="add_not" class="replacenotes aaaa<?php echo $results2->id; ?>" ><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
                                                </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                    </ul>
                                </div>
                                <div class="column left">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr bgcolor="#959ca1">
                                                <th><button class="contact" type="button">
                                                        <p>Not Qualified/<br  />
                                                            Not Interested</p>
                                                    </button>
                                                    <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <ul spanid="notQualified" class="sortable-list">
                                        <?php
                                        if ($query3) {
                                            foreach ($query3 as $results3) {
                                                $aaa_ID3 = $results3->id;
                                                $item3 = explode(" ", $results3->date);
                                                $item23 = explode(" ", $results3->last_modify);
                                                if ($item3[0] != "") {
                                                    $sign_dt = date("m-d-Y", strtotime($item3[0]));
                                                } else {
                                                    $sign_dt = $item3[0];
                                                }
                                                if ($item23[0] != "") {
                                                    $act_dt = date("m-d-Y", strtotime($item23[0]));
                                                } else {
                                                    $act_dt = $item23[0];
                                                }
                                                echo '<li class="sortable-item" id="' . $results3->id . '">';
                                                echo '<strong>' . $results3->name;
                                                echo '</strong><br />';
                                                echo '<span>' . $results3->email;
                                                echo '</span><br />';
                                                echo '<span>' . format_telephone($results3->phone);
                                                echo '</span><br />';
                                                echo '<span>Signed Up: ' . $sign_dt;
                                                echo '</span><br />';
                                                echo '<span>Action Taken: ' . $act_dt;
                                                echo '</span><br />';
                                                ?>
                                                <?php if ($redirect_num != '' && $results3->is_front == 1) { ?>
                                                    <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results3->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="margin-left: 45px;" class="replacenotes aaaa<?php echo $results3->id; ?>" id="add_not"><img  src="<?php bloginfo('template_url'); ?>/images-dashboard/que.png" /></a>
                                                <?php } ?>
                                                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results3->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a> <a data-tooltip="<?php echo isset($query_notes3[0]->notes) ? $query_notes3[0]->notes : 'Add notes'; ?>" data-tooltip-position="top" onclick="document.getElementById('embed<?php echo $results3->id; ?>').style.display = 'block';
                                                        document.getElementById('fade').style.display = 'block'" href="javascript:void(0);" style="float:right;" id="add_not" class="replacenotes aaaa<?php echo $results3->id; ?>" ><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
                                                </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                    </ul>
                                </div>
                                <div class="column left">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr bgcolor="#959ca1">
                                                <th><button class="contact" type="button">
                                                        <p> Action Needed</p>
                                                    </button>
                                                    <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <ul spanid="actionNeeded" class="sortable-list">
                                        <?php
                                        if ($query7) {
                                            foreach ($query7 as $results7) {
                                                $aaa_ID7 = $results7->id;
                                                $item7 = explode(" ", $results7->date);
                                                $item27 = explode(" ", $results7->last_modify);
                                                if ($item7[0] != "") {
                                                    $sign_dt = date("m-d-Y", strtotime($item7[0]));
                                                } else {
                                                    $sign_dt = $item7[0];
                                                }
                                                if ($item27[0] != "") {
                                                    $act_dt = date("m-d-Y", strtotime($item27[0]));
                                                } else {
                                                    $act_dt = $item27[0];
                                                }
                                                echo '<li class="sortable-item" id="' . $results7->id . '">';
                                                echo '<strong>' . $results7->name;
                                                echo '</strong><br />';
                                                echo '<span>' . $results7->email;
                                                echo '</span><br />';
                                                echo '<span>' . format_telephone($results7->phone);
                                                echo '</span><br />';
                                                echo '<span>Signed Up: ' . $sign_dt;
                                                echo '</span><br />';
                                                echo '<span>Action Taken: ' . $act_dt;
                                                echo '</span><br />';
                                                ?>
                                                <?php if ($redirect_num != '' && $results7->is_front == 1) { ?>
                                                    <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results7->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="margin-left: 45px;" class="replacenotes aaaa<?php echo $results7->id; ?>" id="add_not"><img  src="<?php bloginfo('template_url'); ?>/images-dashboard/que.png" /></a>
                                                  <?php } ?>
                                                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results7->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
                                                <a data-tooltip="<?php echo isset($query_notes7[0]->notes) ? $query_notes7[0]->notes : 'Add notes'; ?>" data-tooltip-position="top" onclick="document.getElementById('embed<?php echo $results7->id; ?>').style.display = 'block';
                                                        document.getElementById('fade').style.display = 'block'" href="javascript:void(0);" style="float:right;" id="add_not" class="replacenotes aaaa<?php echo $results7->id; ?>" ><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
                                                </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                    </ul>
                                </div>
                                <div class="column left">
                                    <table class="table table-bordered">
                                        <thead>
                                        <th><button class="contact" type="button">
                                                <p>Scheduled</p>
                                            </button>
                                            <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <ul spanid="scheduled" class="sortable-list">
                                        <?php
                                        if ($query4) {
                                            foreach ($query4 as $results4) {
                                                $aaa_ID4 = $results4->id;
                                                $item4 = explode(" ", $results4->date);
                                                $item24 = explode(" ", $results4->last_modify);
                                                if ($item4[0] != "") {
                                                    $sign_dt = date("m-d-Y", strtotime($item4[0]));
                                                } else {
                                                    $sign_dt = $item4[0];
                                                }
                                                if ($item24[0] != "") {
                                                    $act_dt = date("m-d-Y", strtotime($item24[0]));
                                                } else {
                                                    $act_dt = $item24[0];
                                                }
                                                echo '<li class="sortable-item" id="' . $results4->id . '">';
                                                echo '<strong>' . $results4->name;
                                                echo '</strong><br />';
                                                echo '<span>' . $results4->email;
                                                echo '</span><br />';
                                                echo '<span>' . format_telephone($results4->phone);
                                                echo '</span><br />';
                                                echo '<span>Signed Up: ' . $sign_dt;
                                                echo '</span><br />';
                                                echo '<span>Action Taken: ' . $act_dt;
                                                echo '</span><br />';
                                                ?>
                                                    <?php if ($redirect_num != '' && $results4->is_front == 1) { ?>
                                                   <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results4->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="margin-left: 45px;" class="replacenotes aaaa<?php echo $results4->id; ?>" id="add_not"><img  src="<?php bloginfo('template_url'); ?>/images-dashboard/que.png" /></a>
                                                    <?php } ?>
                                                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results4->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
                                                <a data-tooltip="<?php echo isset($query_notes4[0]->notes) ? $query_notes4[0]->notes : 'Add notes'; ?>" data-tooltip-position="top" onclick="document.getElementById('embed<?php echo $results4->id; ?>').style.display = 'block';
                                                        document.getElementById('fade').style.display = 'block'" href="javascript:void(0);" style="float:right;" id="add_not" class="replacenotes aaaa<?php echo $results4->id; ?>" ><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
                                                <li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                    </ul>
                                </div>
                                <div class="column left">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr bgcolor="#959ca1">
                                                <th><button class="contact" type="button">
                                                        <p>Consented</p>
                                                    </button>
                                                    <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <ul spanid="consented" class="sortable-list">
                                        <?php
                                        if ($query5) {
                                            foreach ($query5 as $results5) {
                                                $aaa_ID5 = $results5->id;
                                                $item5 = explode(" ", $results5->date);
                                                $item25 = explode(" ", $results5->last_modify);
                                                if ($item5[0] != "") {
                                                    $sign_dt = date("m-d-Y", strtotime($item5[0]));
                                                } else {
                                                    $sign_dt = $item5[0];
                                                }
                                                if ($item25[0] != "") {
                                                    $act_dt = date("m-d-Y", strtotime($item25[0]));
                                                } else {
                                                    $act_dt = $item25[0];
                                                }
                                                echo '<li class="sortable-item" id="' . $results5->id . '">';
                                                echo '<strong>' . $results5->name;
                                                echo '</strong><br />';
                                                echo '<span>' . $results5->email;
                                                echo '</span><br />';
                                                echo '<span>' . format_telephone($results5->phone);
                                                echo '</span><br />';
                                                echo '<span>Signed Up: ' . $sign_dt;
                                                echo '</span><br />';
                                                echo '<span>Action Taken: ' . $act_dt;
                                                echo '</span><br />';
                                                ?>
                                           <?php if ($redirect_num != '' && $results5->is_front == 1) { ?>
                                                    <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results5->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="margin-left: 45px;" class="replacenotes aaaa<?php echo $results5->id; ?>" id="add_not"><img  src="<?php bloginfo('template_url'); ?>/images-dashboard/que.png" /></a>
                                                   <?php } ?>
                                                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results5->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
                                                <a data-tooltip="<?php echo isset($query_notes5[0]->notes) ? $query_notes5[0]->notes : 'Add notes'; ?>" data-tooltip-position="top" onclick="document.getElementById('embed<?php echo $results5->id; ?>').style.display = 'block';
                                                        document.getElementById('fade').style.display = 'block'" href="javascript:void(0);" style="float:right;" id="add_not" class="replacenotes aaaa<?php echo $results5->id; ?>" ><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
                                                </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                    </ul>
                                </div>
                                <div class="column left">
                                    <table class="table table-bordered">
                                        <thead>

                                        <th><button class="contact" type="button">
                                                <p>Randomized</p>
                                            </button>
                                            <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <ul spanid="randomized" class="sortable-list">
                                        <?php
                                        if ($query6) {
                                            foreach ($query6 as $results6) {
                                                $aaa_ID6 = $results6->id;
                                                $item6 = explode(" ", $results6->date);
                                                $item26 = explode(" ", $results6->last_modify);
                                                if ($item6[0] != "") {
                                                    $sign_dt = date("m-d-Y", strtotime($item6[0]));
                                                } else {
                                                    $sign_dt = $item6[0];
                                                }
                                                if ($item26[0] != "") {
                                                    $act_dt = date("m-d-Y", strtotime($item26[0]));
                                                } else {
                                                    $act_dt = $item26[0];
                                                }
                                                echo '<li class="sortable-item" id="' . $results6->id . '">';
                                                echo '<strong>' . $results6->name;
                                                echo '</strong><br />';
                                                echo '<span>' . $results6->email;
                                                echo '</span><br />';
                                                echo '<span>' . format_telephone($results6->phone);
                                                echo '</span><br />';
                                                echo '<span>Signed Up: ' . $sign_dt;
                                                echo '</span><br />';
                                                echo '<span>Action Taken: ' . $act_dt;
                                                echo '</span><br />';
                                                ?>
                                          <?php if ($redirect_num != '' && $results6->is_front == 1) { ?>
                                          <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results6->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="margin-left: 45px;" class="replacenotes aaaa<?php echo $results6->id; ?>" id="add_not"><img  src="<?php bloginfo('template_url'); ?>/images-dashboard/que.png" /></a>
                                           <?php } ?>
                                                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results6->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a> <a data-tooltip="<?php echo isset($query_notes6[0]->notes) ? $query_notes6[0]->notes : 'Add notes'; ?>" data-tooltip-position="top" onclick="document.getElementById('embed<?php echo $results6->id; ?>').style.display = 'block';
                                                        document.getElementById('fade').style.display = 'block'" href="javascript:void(0);" style="float:right;" id="add_not" class="replacenotes aaaa<?php echo $results6->id; ?>" ><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
                                            </li>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearer">&nbsp;</div>
                    <!-- Notes HTML  -->
                          <?php
                      //   New Patients  li Notes
                            if ($query) {
                                 foreach ($query as $ki =>$results){
                                     if(!empty($all_notes[1][$ki])){
                                        $query_notes =$all_notes[1][$ki];
                                       }
                                     else{
                                     $query_notes =array();
                                     }
                                    $item = explode(" ", $results->date);
                                    $item2 = explode(" ", $results->last_modify);
                                    if ($item[0] != "") {
                                        $sign_dt = date("m-d-Y", strtotime($item[0]));
                                    } else {
                                        $sign_dt = $item[0];
                                    }
                                    if ($item2[0] != "") {
                                        $act_dt = date("m-d-Y", strtotime($item2[0]));
                                    } else {
                                        $act_dt = $item2[0];
                                    }
                                    ?>
                                    <div id="embed<?php echo $results->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                        <div class="col-xs-12 col-md-6 notes_left">
                                            <div class="row">
                                                <h2>NOTES</h2>
                                            </div>
                                            <div class="scrollNotes"><?php echo 'Name: ' . $results->name; ?></div>
                                            <div class="scrollNotes"><?php echo 'Email: ' . $results->email; ?></div>
                                            <div class="scrollNotes"><?php echo 'Phone: ' . format_telephone($results->phone); ?></div>
                                            <div class="scrollNotes"><?php echo 'Signed Up: ' . $sign_dt; ?></div>
                                            <div class="scrollNotes"><?php echo 'Action Taken: ' . $act_dt; ?></div>
                                            <form action="" method="post">
                                                <input type="hidden" value="<?php echo $results->id; ?>" class="add_p_id" name="add_p_id" />
                                                <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                                                <br />
                                                <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                                            </form>
                                        </div>
                                        <div class="col-xs-12 col-md-6 notes_right">
                                            <div class="row">
                                                <h2>UPDATES</h2>
                                            </div>
                                                <?php
                                                $aaa_ID = $results->id;
                                                //$query_notes = $wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID' ORDER BY id DESC", OBJECT);
                                                if (count($query_notes) > 3) {
                                                    ?>
                                                <div id="scrollNotes">Scroll down to view all notes</div>
                                                        <?php }
                                                    ?>
                                            <div data-offset="0" data-target="#myNavbar"  data-spy="scroll" class="scroll-area">
                                                <?php
                                                if ($query_notes) {
                                                    foreach ($query_notes as $results_notes) {
                                                        ?>
                                                        <dl class="clinical_trial" id="parent<?php echo $results_notes->id; ?>">
                                                            <a href="javascript:void(0);" id="<?php echo $results_notes->id; ?>" noteid="<?php echo $results_notes->note_id; ?>"  style="float:right; margin:0 10px;" class="removeNote"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/delete.png" /></a>
                                                            <dt style=" color:#00afef;"><?php $date_here = str_replace("?", "", $results_notes->notes_date);
                                        echo date('m-d-Y h:i:s', strtotime($date_here)); ?> </dt>
                                                            <dd>
                                                                <p><?php echo $results_notes->notes; ?></p>
                                                            </dd>
                                                        </dl>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <a class="closepop" id="<?php echo $results->id; ?>" href="javascript:void(0);" onclick="document.getElementById('embed<?php echo $results->id; ?>').style.display = 'none';
                                                document.getElementById('fade').style.display = 'none';">Close</a>
                                    </div>
                                    <?php if ($redirect_num != '' && $results->is_front == 1) { ?>
                                        <div id="patient<?php echo $results->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                            <div class="col-xs-12  notes_right">
                                                <div class="row">
                                                    <h2 style="text-decoration: none">Phone Screening</h2>
                                                </div>
                                                        <?php if ($results->no_of_question == 0) { ?>
                                                    <div style="padding:20px;padding-left:5px;font-size:20px;font-weight:bold;"> No Questions was available.</div>
                                                        <?php
                                                        } else {
                                                            $num_qust = $results->no_of_question;
                                                            ?>
                                                    <div style="font-size: 12px;margin-top: 0px;margin-bottom: 5px;">
                                                        <div class="scrollNotes" style="margin-top: -10px;margin-bottom:5px;">
                                                            <?php
                                                            if ($results->is_callfire_qualified == 1) {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Qualified</span> for this Study.</h3>';
                                                            } else {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Not Qualified</span> for this Study.</h3>';
                                                            }
                                                            ?>
                                                        </div>
                                                <div style="height: 375px; overflow-y: auto;">
                                                <?php for ($k = 1; $k <= $num_qust; $k++) { ?>
                                                    <?php if ($k == 1) {
                                                        ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_1; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_1 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_1 == 2) {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                 } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 2) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_2; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_2 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_2 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 3) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_3; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_3 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_3 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 4) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_4; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_4 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_4 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 5) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_5; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_5 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_5 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 6) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_6; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_6 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_6 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 7) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_7; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_7 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_7 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                    <?php }
                                            ?>
                                                    <?php if ($k == 8) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_8; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_8 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_8 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 9) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_9; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_9 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_9 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 10) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_10; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_10 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_10 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                               <?php }
                                            ?>
                                                <?php if ($k == 11) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_11; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_11 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_11 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 12) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_12; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_12 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_12 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 13) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_13; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_13 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_13 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 14) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_14; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_14 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_14 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 15) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_15; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_15 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results->answer_15 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                              } else {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 16) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_16; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_16 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_16 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 17) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_17; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_17 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results->answer_17 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                               <?php }
                                             ?>
                                                <?php if ($k == 18) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_18; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_18 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_18 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                               <?php }
                                              ?>
                                               <?php if ($k == 19) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_19; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_19 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_19 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 20) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_20; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_20 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_20 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                             } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                              <?php }
                                            ?>
                                                <?php if ($k == 21) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_21; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_21 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_21 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                           } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 22) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_22; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_22 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_22 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 23) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_23; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_23 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                           } else if ($results->answer_23 == 2) {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                          } else {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 24) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_24; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_24 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_24 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 25) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_25; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_25 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_25 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 26) {
                                                ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_26; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_26 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_26 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 27) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_27; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_27 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_27 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 28) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_28; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_28 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_28 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 29) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_29; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_29 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_29 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 30) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_30; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_30 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_30 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php } ?>
                                                        </div>
                                                        <?php } ?>
                                                </div>
                                                <a class="closepop" id="pat<?php echo $results->id; ?>" href="javascript:void(0);" onclick="document.getElementById('patient<?php echo $results->id; ?>').style.display = 'none';
                                                        document.getElementById('fade').style.display = 'none';">Close</a>
                                            </div>

                                        </div>
                                              <?php }?>
                                        <?php } } ?>

                                                                  <?php
                      //   New Patients  li Notes
                            if ($query2) {
                                foreach ($query2 as $ki =>$results2) {
                                      if(!empty($all_notes[2][$ki])){
                                        $query_notes =$all_notes[2][$ki];
                                       }
                                     else{
                                     $query_notes =array();
                                     }
                                    $item = explode(" ", $results2->date);
                                    $item2 = explode(" ", $results2->last_modify);
                                    if ($item[0] != "") {
                                        $sign_dt = date("m-d-Y", strtotime($item[0]));
                                    } else {
                                        $sign_dt = $item[0];
                                    }
                                    if ($item2[0] != "") {
                                        $act_dt = date("m-d-Y", strtotime($item2[0]));
                                    } else {
                                        $act_dt = $item2[0];
                                    }
                                    ?>
                                    <div id="embed<?php echo $results2->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                        <div class="col-xs-12 col-md-6 notes_left">
                                            <div class="row">
                                                <h2>NOTES</h2>
                                            </div>
                                            <div class="scrollNotes"><?php echo 'Name: ' . $results2->name; ?></div>
                                            <div class="scrollNotes"><?php echo 'Email: ' . $results2->email; ?></div>
                                            <div class="scrollNotes"><?php echo 'Phone: ' . format_telephone($results2->phone); ?></div>
                                            <div class="scrollNotes"><?php echo 'Signed Up: ' . $sign_dt; ?></div>
                                            <div class="scrollNotes"><?php echo 'Action Taken: ' . $act_dt; ?></div>
                                            <form action="" method="post">
                                                <input type="hidden" value="<?php echo $results2->id; ?>" class="add_p_id" name="add_p_id" />
                                                <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                                                <br />
                                                <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                                            </form>
                                        </div>
                                        <div class="col-xs-12 col-md-6 notes_right">
                                            <div class="row">
                                                <h2>UPDATES</h2>
                                            </div>
                                                <?php
                                                $aaa_ID2 = $results2->id;
                                                $query_notes2 = $wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID2' ORDER BY id DESC", OBJECT);
                                                if (count($query_notes2) > 3) {
                                                    ?>
                                                <div id="scrollNotes">Scroll down to view all notes</div>
                                                        <?php }
                                                    ?>
                                            <div data-offset="0" data-target="#myNavbar"  data-spy="scroll" class="scroll-area">
                                                <?php
                                                if ($query_notes2) {
                                                    foreach ($query_notes2 as $results_notes2) {
                                                        ?>
                                                        <dl class="clinical_trial" id="parent<?php echo $results_notes2->id; ?>">
                                                            <a href="javascript:void(0);" id="<?php echo $results_notes2->id; ?>" noteid="<?php echo $results_notes2->note_id; ?>"  style="float:right; margin:0 10px;" class="removeNote"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/delete.png" /></a>
                                                            <dt style=" color:#00afef;"><?php $date_here = str_replace("?", "", $results_notes2->notes_date);
                                                              echo date('m-d-Y h:i:s', strtotime($date_here)); ?> </dt>
                                                            <dd>
                                                                <p><?php echo $results_notes2->notes; ?></p>
                                                            </dd>
                                                        </dl>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <a class="closepop" id="<?php echo $results2->id; ?>" href="javascript:void(0);" onclick="document.getElementById('embed<?php echo $results2->id; ?>').style.display = 'none';
                                                document.getElementById('fade').style.display = 'none';">Close</a>
                                    </div>
                                    <?php if ($redirect_num != '' && $results2->is_front == 1) { ?>
                                        <div id="patient<?php echo $results2->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                            <div class="col-xs-12  notes_right">
                                                <div class="row">
                                                    <h2 style="text-decoration: none">Phone Screening</h2>
                                                </div>
                                                        <?php if ($results2->no_of_question == 0) { ?>
                                                    <div style="padding:20px;padding-left:5px;font-size:20px;font-weight:bold;"> No Questions was available.</div>
                                                        <?php
                                                        } else {
                                                            $num_qust = $results2->no_of_question;
                                                            ?>
                                                    <div style="font-size: 12px;margin-top: 0px;margin-bottom: 5px;">
                                                        <div class="scrollNotes" style="margin-top: -10px;margin-bottom:5px;">
                                                            <?php
                                                            if ($results2->is_callfire_qualified == 1) {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Qualified</span> for this Study.</h3>';
                                                            } else {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Not Qualified</span> for this Study.</h3>';
                                                            }
                                                            ?>
                                                        </div>
                                                <div style="height: 375px; overflow-y: auto;">
                                                <?php for ($k = 1; $k <= $num_qust; $k++) { ?>
                                                    <?php if ($k == 1) {
                                                        ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_1; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_1 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results2->answer_1 == 2) {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                 } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 2) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_2; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_2 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_2 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 3) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_3; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_3 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_3 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 4) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_4; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_4 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_4 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 5) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_5; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_5 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_5 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 6) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_6; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_6 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_6 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 7) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_7; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_7 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_7 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                    <?php }
                                            ?>
                                                    <?php if ($k == 8) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_8; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_8 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_8 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 9) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_9; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_9 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_9 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 10) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_10; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_10 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_10 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                               <?php }
                                            ?>
                                                <?php if ($k == 11) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_11; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_11 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_11 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 12) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_12; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_12 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_12 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 13) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_13; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_13 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_13 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 14) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_14; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_14 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_14 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 15) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_15; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_15 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results2->answer_15 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                              } else {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 16) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_16; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_16 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_16 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 17) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_17; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_17 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results2->answer_17 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                               <?php }
                                             ?>
                                                <?php if ($k == 18) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_18; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_18 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_18 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                               <?php }
                                              ?>
                                               <?php if ($k == 19) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_19; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_19 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_19 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 20) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_20; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_20 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_20 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                             } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                              <?php }
                                            ?>
                                                <?php if ($k == 21) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_21; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_21 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_21 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                           } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 22) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_22; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_22 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_22 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 23) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_23; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_23 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                           } else if ($results2->answer_23 == 2) {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                          } else {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 24) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_24; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_24 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_24 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 25) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_25; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_25 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_25 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 26) {
                                                ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_26; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_26 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results2->answer_26 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 27) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_27; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_27 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results2->answer_27 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 28) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_28; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_28 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results2->answer_28 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 29) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_29; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_29 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results2->answer_29 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 30) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results2->question_30; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results2->answer_30 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results2->answer_30 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php } ?>
                                                        </div>
                                                        <?php } ?>
                                                </div>
                                                <a class="closepop" id="pat<?php echo $results2->id; ?>" href="javascript:void(0);" onclick="document.getElementById('patient<?php echo $results2->id; ?>').style.display = 'none';
                                                        document.getElementById('fade').style.display = 'none';">Close</a>
                                            </div>

                                        </div>
                                              <?php }?>
                                        <?php } } ?>
                                                   <?php
                      //   New Patients  li Notes
                            if ($query3) {
                                foreach ($query3 as $ki =>$results3) {
                                       if(!empty($all_notes[3][$ki])){
                                        $query_notes =$all_notes[3][$ki];
                                       }
                                     else{
                                     $query_notes =array();
                                     }
                                    $item = explode(" ", $results3->date);
                                    $item2 = explode(" ", $results3->last_modify);
                                    if ($item[0] != "") {
                                        $sign_dt = date("m-d-Y", strtotime($item[0]));
                                    } else {
                                        $sign_dt = $item[0];
                                    }
                                    if ($item2[0] != "") {
                                        $act_dt = date("m-d-Y", strtotime($item2[0]));
                                    } else {
                                        $act_dt = $item2[0];
                                    }
                                    ?>
                                    <div id="embed<?php echo $results3->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                        <div class="col-xs-12 col-md-6 notes_left">
                                            <div class="row">
                                                <h2>NOTES</h2>
                                            </div>
                                            <div class="scrollNotes"><?php echo 'Name: ' . $results3->name; ?></div>
                                            <div class="scrollNotes"><?php echo 'Email: ' . $results3->email; ?></div>
                                            <div class="scrollNotes"><?php echo 'Phone: ' . format_telephone($results3->phone); ?></div>
                                            <div class="scrollNotes"><?php echo 'Signed Up: ' . $sign_dt; ?></div>
                                            <div class="scrollNotes"><?php echo 'Action Taken: ' . $act_dt; ?></div>
                                            <form action="" method="post">
                                                <input type="hidden" value="<?php echo $results3->id; ?>" class="add_p_id" name="add_p_id" />
                                                <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                                                <br />
                                                <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                                            </form>
                                        </div>
                                        <div class="col-xs-12 col-md-6 notes_right">
                                            <div class="row">
                                                <h2>UPDATES</h2>
                                            </div>
                                                <?php
                                                $aaa_ID3 = $results3->id;
                                                $query_notes3 = $wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID3' ORDER BY id DESC", OBJECT);
                                                if (count($query_notes3) > 3) {
                                                    ?>
                                                <div id="scrollNotes">Scroll down to view all notes</div>
                                                        <?php }
                                                    ?>
                                            <div data-offset="0" data-target="#myNavbar"  data-spy="scroll" class="scroll-area">
                                                <?php
                                                if ($query_notes3) {
                                                    foreach ($query_notes3 as $results_notes3) {
                                                        ?>
                                                        <dl class="clinical_trial" id="parent<?php echo $results_notes3->id; ?>">
                                                            <a href="javascript:void(0);" id="<?php echo $results_notes3->id; ?>" noteid="<?php echo $results_notes3->note_id; ?>"  style="float:right; margin:0 10px;" class="removeNote"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/delete.png" /></a>
                                                            <dt style=" color:#00afef;"><?php $date_here = str_replace("?", "", $results_notes3->notes_date);
                                                              echo date('m-d-Y h:i:s', strtotime($date_here)); ?> </dt>
                                                            <dd>
                                                                <p><?php echo $results_notes3->notes; ?></p>
                                                            </dd>
                                                        </dl>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <a class="closepop" id="<?php echo $results3->id; ?>" href="javascript:void(0);" onclick="document.getElementById('embed<?php echo $results3->id; ?>').style.display = 'none';
                                                document.getElementById('fade').style.display = 'none';">Close</a>
                                    </div>
                                    <?php if ($redirect_num != '' && $results3->is_front == 1) { ?>
                                        <div id="patient<?php echo $results3->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                            <div class="col-xs-12  notes_right">
                                                <div class="row">
                                                    <h2 style="text-decoration: none">Phone Screening</h2>
                                                </div>
                                                        <?php if ($results3->no_of_question == 0) { ?>
                                                    <div style="padding:20px;padding-left:5px;font-size:20px;font-weight:bold;"> No Questions was available.</div>
                                                        <?php
                                                        } else {
                                                            $num_qust = $results3->no_of_question;
                                                            ?>
                                                    <div style="font-size: 12px;margin-top: 0px;margin-bottom: 5px;">
                                                        <div class="scrollNotes" style="margin-top: -10px;margin-bottom:5px;">
                                                            <?php
                                                            if ($results3->is_callfire_qualified == 1) {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Qualified</span> for this Study.</h3>';
                                                            } else {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Not Qualified</span> for this Study.</h3>';
                                                            }
                                                            ?>
                                                        </div>
                                                <div style="height: 375px; overflow-y: auto;">
                                                <?php for ($k = 1; $k <= $num_qust; $k++) { ?>
                                                    <?php if ($k == 1) {
                                                        ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_1; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_1 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results3->answer_1 == 2) {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                 } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 2) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_2; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_2 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_2 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 3) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_3; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_3 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_3 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 4) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_4; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_4 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_4 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 5) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_5; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_5 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_5 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 6) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_6; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_6 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_6 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 7) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_7; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_7 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_7 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                    <?php }
                                            ?>
                                                    <?php if ($k == 8) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_8; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_8 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_8 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 9) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_9; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_9 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_9 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 10) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_10; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_10 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_10 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                               <?php }
                                            ?>
                                                <?php if ($k == 11) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_11; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_11 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_11 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 12) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_12; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_12 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_12 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 13) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_13; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_13 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_13 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 14) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_14; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_14 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_14 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 15) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_15; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_15 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results3->answer_15 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                              } else {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 16) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_16; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_16 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_16 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 17) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_17; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_17 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results3->answer_17 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                               <?php }
                                             ?>
                                                <?php if ($k == 18) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_18; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_18 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_18 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                               <?php }
                                              ?>
                                               <?php if ($k == 19) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_19; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_19 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_19 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 20) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_20; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_20 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_20 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                             } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                              <?php }
                                            ?>
                                                <?php if ($k == 21) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_21; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_21 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_21 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                           } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 22) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_22; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_22 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_22 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 23) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_23; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_23 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                           } else if ($results3->answer_23 == 2) {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                          } else {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 24) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_24; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_24 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_24 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 25) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_25; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_25 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_25 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 26) {
                                                ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_26; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_26 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results3->answer_26 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 27) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_27; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_27 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results3->answer_27 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 28) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_28; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_28 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results3->answer_28 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 29) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_29; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_29 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results3->answer_29 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 30) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results3->question_30; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results3->answer_30 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results3->answer_30 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php } ?>
                                                        </div>
                                                        <?php } ?>
                                                </div>
                                                <a class="closepop" id="pat<?php echo $results3->id; ?>" href="javascript:void(0);" onclick="document.getElementById('patient<?php echo $results3->id; ?>').style.display = 'none';
                                                        document.getElementById('fade').style.display = 'none';">Close</a>
                                            </div>

                                        </div>
                                              <?php }?>
                                        <?php } } ?>


                                              <?php
                      //   New Patients  li Notes
                            if ($query7) {
                                      foreach ($query7 as $ki =>$results7) {
                                       if(!empty($all_notes[7][$ki])){
                                        $query_notes =$all_notes[7][$ki];
                                       }
                                     else{
                                     $query_notes =array();
                                     }
                                    $item = explode(" ", $results7->date);
                                    $item2 = explode(" ", $results7->last_modify);
                                    if ($item[0] != "") {
                                        $sign_dt = date("m-d-Y", strtotime($item[0]));
                                    } else {
                                        $sign_dt = $item[0];
                                    }
                                    if ($item2[0] != "") {
                                        $act_dt = date("m-d-Y", strtotime($item2[0]));
                                    } else {
                                        $act_dt = $item2[0];
                                    }
                                    ?>
                                    <div id="embed<?php echo $results7->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                        <div class="col-xs-12 col-md-6 notes_left">
                                            <div class="row">
                                                <h2>NOTES</h2>
                                            </div>
                                            <div class="scrollNotes"><?php echo 'Name: ' . $results7->name; ?></div>
                                            <div class="scrollNotes"><?php echo 'Email: ' . $results7->email; ?></div>
                                            <div class="scrollNotes"><?php echo 'Phone: ' . format_telephone($results7->phone); ?></div>
                                            <div class="scrollNotes"><?php echo 'Signed Up: ' . $sign_dt; ?></div>
                                            <div class="scrollNotes"><?php echo 'Action Taken: ' . $act_dt; ?></div>
                                            <form action="" method="post">
                                                <input type="hidden" value="<?php echo $results7->id; ?>" class="add_p_id" name="add_p_id" />
                                                <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                                                <br />
                                                <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                                            </form>
                                        </div>
                                        <div class="col-xs-12 col-md-6 notes_right">
                                            <div class="row">
                                                <h2>UPDATES</h2>
                                            </div>
                                                <?php
                                                $aaa_ID7 = $results7->id;
                                                $query_notes7 = $wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID7' ORDER BY id DESC", OBJECT);
                                                if (count($query_notes7) > 3) {
                                                    ?>
                                                <div id="scrollNotes">Scroll down to view all notes</div>
                                                        <?php }
                                                    ?>
                                            <div data-offset="0" data-target="#myNavbar"  data-spy="scroll" class="scroll-area">
                                                <?php
                                                if ($query_notes7) {
                                                    foreach ($query_notes7 as $results_notes7) {
                                                        ?>
                                                        <dl class="clinical_trial" id="parent<?php echo $results_notes7->id; ?>">
                                                            <a href="javascript:void(0);" id="<?php echo $results_notes7->id; ?>" noteid="<?php echo $results_notes7->note_id; ?>"  style="float:right; margin:0 10px;" class="removeNote"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/delete.png" /></a>
                                                            <dt style=" color:#00afef;"><?php $date_here = str_replace("?", "", $results_notes7->notes_date);
                                                              echo date('m-d-Y h:i:s', strtotime($date_here)); ?> </dt>
                                                            <dd>
                                                                <p><?php echo $results_notes7->notes; ?></p>
                                                            </dd>
                                                        </dl>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <a class="closepop" id="<?php echo $results7->id; ?>" href="javascript:void(0);" onclick="document.getElementById('embed<?php echo $results7->id; ?>').style.display = 'none';
                                                document.getElementById('fade').style.display = 'none';">Close</a>
                                    </div>
                                    <?php if ($redirect_num != '' && $results7->is_front == 1) { ?>
                                        <div id="patient<?php echo $results7->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                            <div class="col-xs-12  notes_right">
                                                <div class="row">
                                                    <h2 style="text-decoration: none">Phone Screening</h2>
                                                </div>
                                                        <?php if ($results7->no_of_question == 0) { ?>
                                                    <div style="padding:20px;padding-left:5px;font-size:20px;font-weight:bold;"> No Questions was available.</div>
                                                        <?php
                                                        } else {
                                                            $num_qust = $results7->no_of_question;
                                                            ?>
                                                    <div style="font-size: 12px;margin-top: 0px;margin-bottom: 5px;">
                                                        <div class="scrollNotes" style="margin-top: -10px;margin-bottom:5px;">
                                                            <?php
                                                            if ($results7->is_callfire_qualified == 1) {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Qualified</span> for this Study.</h3>';
                                                            } else {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Not Qualified</span> for this Study.</h3>';
                                                            }
                                                            ?>
                                                        </div>
                                                <div style="height: 375px; overflow-y: auto;">
                                                <?php for ($k = 1; $k <= $num_qust; $k++) { ?>
                                                    <?php if ($k == 1) {
                                                        ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_1; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_1 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results7->answer_1 == 2) {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                 } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 2) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_2; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_2 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_2 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 3) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_3; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_3 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_3 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 4) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_4; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_4 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_4 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 5) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_5; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_5 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_5 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 6) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_6; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_6 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_6 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 7) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_7; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_7 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_7 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                    <?php }
                                            ?>
                                                    <?php if ($k == 8) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_8; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_8 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_8 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 9) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_9; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_9 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_9 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 10) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_10; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_10 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_10 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                               <?php }
                                            ?>
                                                <?php if ($k == 11) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_11; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_11 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_11 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 12) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_12; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_12 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_12 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 13) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_13; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_13 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_13 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 14) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_14; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_14 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_14 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 15) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_15; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_15 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results7->answer_15 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                              } else {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 16) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_16; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_16 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_16 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 17) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_17; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_17 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results7->answer_17 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                               <?php }
                                             ?>
                                                <?php if ($k == 18) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_18; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_18 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_18 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                               <?php }
                                              ?>
                                               <?php if ($k == 19) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_19; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_19 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_19 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 20) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_20; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_20 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_20 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                             } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                              <?php }
                                            ?>
                                                <?php if ($k == 21) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_21; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_21 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_21 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                           } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 22) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_22; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_22 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_22 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 23) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_23; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_23 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                           } else if ($results7->answer_23 == 2) {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                          } else {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 24) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_24; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_24 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_24 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 25) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_25; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_25 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_25 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 26) {
                                                ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_26; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_26 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results7->answer_26 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 27) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_27; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_27 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results7->answer_27 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 28) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_28; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_28 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results7->answer_28 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 29) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_29; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_29 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results7->answer_29 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 30) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results7->question_30; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results7->answer_30 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results7->answer_30 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php } ?>
                                                        </div>
                                                        <?php } ?>
                                                </div>
                                                <a class="closepop" id="pat<?php echo $results7->id; ?>" href="javascript:void(0);" onclick="document.getElementById('patient<?php echo $results7->id; ?>').style.display = 'none';
                                                        document.getElementById('fade').style.display = 'none';">Close</a>
                                            </div>

                                        </div>
                                              <?php }?>
                                        <?php } } ?>
                                             <?php
                      //   New Patients  li Notes
                            if ($query4) {
                                      foreach ($query4 as $ki =>$results4) {
                                       if(!empty($all_notes[4][$ki])){
                                        $query_notes =$all_notes[4][$ki];
                                       }
                                     else{
                                     $query_notes =array();
                                     }
                                    $item = explode(" ", $results4->date);
                                    $item2 = explode(" ", $results4->last_modify);
                                    if ($item[0] != "") {
                                        $sign_dt = date("m-d-Y", strtotime($item[0]));
                                    } else {
                                        $sign_dt = $item[0];
                                    }
                                    if ($item2[0] != "") {
                                        $act_dt = date("m-d-Y", strtotime($item2[0]));
                                    } else {
                                        $act_dt = $item2[0];
                                    }
                                    ?>
                                    <div id="embed<?php echo $results4->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                        <div class="col-xs-12 col-md-6 notes_left">
                                            <div class="row">
                                                <h2>NOTES</h2>
                                            </div>
                                            <div class="scrollNotes"><?php echo 'Name: ' . $results4->name; ?></div>
                                            <div class="scrollNotes"><?php echo 'Email: ' . $results4->email; ?></div>
                                            <div class="scrollNotes"><?php echo 'Phone: ' . format_telephone($results4->phone); ?></div>
                                            <div class="scrollNotes"><?php echo 'Signed Up: ' . $sign_dt; ?></div>
                                            <div class="scrollNotes"><?php echo 'Action Taken: ' . $act_dt; ?></div>
                                            <form action="" method="post">
                                                <input type="hidden" value="<?php echo $results4->id; ?>" class="add_p_id" name="add_p_id" />
                                                <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                                                <br />
                                                <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                                            </form>
                                        </div>
                                        <div class="col-xs-12 col-md-6 notes_right">
                                            <div class="row">
                                                <h2>UPDATES</h2>
                                            </div>
                                                <?php
                                                $aaa_ID4 = $results4->id;
                                                $query_notes4 = $wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID4' ORDER BY id DESC", OBJECT);
                                                if (count($query_notes4) > 3) {
                                                    ?>
                                                <div id="scrollNotes">Scroll down to view all notes</div>
                                                        <?php }
                                                    ?>
                                            <div data-offset="0" data-target="#myNavbar"  data-spy="scroll" class="scroll-area">
                                                <?php
                                                if ($query_notes4) {
                                                    foreach ($query_notes4 as $results_notes4) {
                                                        ?>
                                                        <dl class="clinical_trial" id="parent<?php echo $results_notes4->id; ?>">
                                                            <a href="javascript:void(0);" id="<?php echo $results_notes4->id; ?>" noteid="<?php echo $results_notes4->note_id; ?>"  style="float:right; margin:0 10px;" class="removeNote"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/delete.png" /></a>
                                                            <dt style=" color:#00afef;"><?php $date_here = str_replace("?", "", $results_notes4->notes_date);
                                                              echo date('m-d-Y h:i:s', strtotime($date_here)); ?> </dt>
                                                            <dd>
                                                                <p><?php echo $results_notes4->notes; ?></p>
                                                            </dd>
                                                        </dl>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <a class="closepop" id="<?php echo $results4->id; ?>" href="javascript:void(0);" onclick="document.getElementById('embed<?php echo $results4->id; ?>').style.display = 'none';
                                                document.getElementById('fade').style.display = 'none';">Close</a>
                                    </div>
                                    <?php if ($redirect_num != '' && $results4->is_front == 1) { ?>
                                        <div id="patient<?php echo $results4->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                            <div class="col-xs-12  notes_right">
                                                <div class="row">
                                                    <h2 style="text-decoration: none">Phone Screening</h2>
                                                </div>
                                                        <?php if ($results4->no_of_question == 0) { ?>
                                                    <div style="padding:20px;padding-left:5px;font-size:20px;font-weight:bold;"> No Questions was available.</div>
                                                        <?php
                                                        } else {
                                                            $num_qust = $results4->no_of_question;
                                                            ?>
                                                    <div style="font-size: 12px;margin-top: 0px;margin-bottom: 5px;">
                                                        <div class="scrollNotes" style="margin-top: -10px;margin-bottom:5px;">
                                                            <?php
                                                            if ($results4->is_callfire_qualified == 1) {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Qualified</span> for this Study.</h3>';
                                                            } else {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Not Qualified</span> for this Study.</h3>';
                                                            }
                                                            ?>
                                                        </div>
                                                <div style="height: 375px; overflow-y: auto;">
                                                <?php for ($k = 1; $k <= $num_qust; $k++) { ?>
                                                    <?php if ($k == 1) {
                                                        ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_1; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_1 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results4->answer_1 == 2) {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                 } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 2) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_2; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_2 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_2 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 3) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_3; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_3 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_3 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 4) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_4; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_4 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_4 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 5) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_5; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_5 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_5 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 6) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_6; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_6 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_6 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 7) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_7; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_7 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_7 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                    <?php }
                                            ?>
                                                    <?php if ($k == 8) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_8; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_8 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_8 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 9) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_9; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_9 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_9 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 10) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_10; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_10 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_10 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                               <?php }
                                            ?>
                                                <?php if ($k == 11) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_11; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_11 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_11 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 12) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_12; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_12 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_12 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 13) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_13; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_13 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_13 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 14) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_14; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_14 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_14 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 15) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_15; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_15 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results4->answer_15 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                              } else {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 16) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_16; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_16 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_16 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 17) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_17; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_17 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results4->answer_17 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                               <?php }
                                             ?>
                                                <?php if ($k == 18) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_18; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_18 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_18 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                               <?php }
                                              ?>
                                               <?php if ($k == 19) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_19; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_19 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_19 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 20) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_20; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_20 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_20 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                             } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                              <?php }
                                            ?>
                                                <?php if ($k == 21) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_21; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_21 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_21 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                           } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 22) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_22; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_22 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_22 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 23) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_23; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_23 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                           } else if ($results4->answer_23 == 2) {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                          } else {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 24) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_24; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_24 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_24 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 25) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_25; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_25 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_25 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 26) {
                                                ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_26; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_26 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results4->answer_26 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 27) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_27; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_27 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results4->answer_27 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 28) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_28; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_28 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results4->answer_28 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 29) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_29; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_29 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results4->answer_29 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 30) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results4->question_30; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results4->answer_30 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results4->answer_30 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php } ?>
                                                        </div>
                                                        <?php } ?>
                                                </div>
                                                <a class="closepop" id="pat<?php echo $results4->id; ?>" href="javascript:void(0);" onclick="document.getElementById('patient<?php echo $results4->id; ?>').style.display = 'none';
                                                        document.getElementById('fade').style.display = 'none';">Close</a>
                                            </div>

                                        </div>
                                              <?php }?>
                                        <?php } } ?>
<?php
                      //   New Patients  li Notes
                            if ($query5) {
                                     foreach ($query5 as $ki =>$results5) {
                                       if(!empty($all_notes[5][$ki])){
                                        $query_notes =$all_notes[5][$ki];
                                       }
                                     else{
                                     $query_notes =array();
                                     }
                                    $item = explode(" ", $results5->date);
                                    $item2 = explode(" ", $results5->last_modify);
                                    if ($item[0] != "") {
                                        $sign_dt = date("m-d-Y", strtotime($item[0]));
                                    } else {
                                        $sign_dt = $item[0];
                                    }
                                    if ($item2[0] != "") {
                                        $act_dt = date("m-d-Y", strtotime($item2[0]));
                                    } else {
                                        $act_dt = $item2[0];
                                    }
                                    ?>
                                    <div id="embed<?php echo $results5->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                        <div class="col-xs-12 col-md-6 notes_left">
                                            <div class="row">
                                                <h2>NOTES</h2>
                                            </div>
                                            <div class="scrollNotes"><?php echo 'Name: ' . $results5->name; ?></div>
                                            <div class="scrollNotes"><?php echo 'Email: ' . $results5->email; ?></div>
                                            <div class="scrollNotes"><?php echo 'Phone: ' . format_telephone($results->phone); ?></div>
                                            <div class="scrollNotes"><?php echo 'Signed Up: ' . $sign_dt; ?></div>
                                            <div class="scrollNotes"><?php echo 'Action Taken: ' . $act_dt; ?></div>
                                            <form action="" method="post">
                                                <input type="hidden" value="<?php echo $results5->id; ?>" class="add_p_id" name="add_p_id" />
                                                <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                                                <br />
                                                <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                                            </form>
                                        </div>
                                        <div class="col-xs-12 col-md-6 notes_right">
                                            <div class="row">
                                                <h2>UPDATES</h2>
                                            </div>
                                                <?php
                                                $aaa_ID5 = $results5->id;
                                                $query_notes5 = $wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID5' ORDER BY id DESC", OBJECT);
                                                if (count($query_notes5) > 3) {
                                                    ?>
                                                <div id="scrollNotes">Scroll down to view all notes</div>
                                                        <?php }
                                                    ?>
                                            <div data-offset="0" data-target="#myNavbar"  data-spy="scroll" class="scroll-area">
                                                <?php
                                                if ($query_notes5) {
                                                    foreach ($query_notes5 as $results_notes5) {
                                                        ?>
                                                        <dl class="clinical_trial" id="parent<?php echo $results_notes5->id; ?>">
                                                            <a href="javascript:void(0);" id="<?php echo $results_notes5->id; ?>" noteid="<?php echo $results_notes5->note_id; ?>"  style="float:right; margin:0 10px;" class="removeNote"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/delete.png" /></a>
                                                            <dt style=" color:#00afef;"><?php $date_here = str_replace("?", "", $results_notes5->notes_date);
                                        echo date('m-d-Y h:i:s', strtotime($date_here)); ?> </dt>
                                                            <dd>
                                                                <p><?php echo $results_notes5->notes; ?></p>
                                                            </dd>
                                                        </dl>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <a class="closepop" id="<?php echo $results5->id; ?>" href="javascript:void(0);" onclick="document.getElementById('embed<?php echo $results5->id; ?>').style.display = 'none';
                                                document.getElementById('fade').style.display = 'none';">Close</a>
                                    </div>
                                    <?php if ($redirect_num != '' && $results5->is_front == 1) { ?>
                                        <div id="patient<?php echo $results5->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                            <div class="col-xs-12  notes_right">
                                                <div class="row">
                                                    <h2 style="text-decoration: none">Phone Screening</h2>
                                                </div>
                                                        <?php if ($results->no_of_question == 0) { ?>
                                                    <div style="padding:20px;padding-left:5px;font-size:20px;font-weight:bold;"> No Questions was available.</div>
                                                        <?php
                                                        } else {
                                                            $num_qust = $results5->no_of_question;
                                                            ?>
                                                    <div style="font-size: 12px;margin-top: 0px;margin-bottom: 5px;">
                                                        <div class="scrollNotes" style="margin-top: -10px;margin-bottom:5px;">
                                                            <?php
                                                            if ($results->is_callfire_qualified == 1) {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Qualified</span> for this Study.</h3>';
                                                            } else {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Not Qualified</span> for this Study.</h3>';
                                                            }
                                                            ?>
                                                        </div>
                                                <div style="height: 375px; overflow-y: auto;">
                                                <?php for ($k = 1; $k <= $num_qust; $k++) { ?>
                                                    <?php if ($k == 1) {
                                                        ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_1; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_1 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_1 == 2) {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                 } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 2) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_2; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_2 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_2 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 3) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_3; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_3 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_3 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 4) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_4; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_4 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_4 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 5) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_5; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_5 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_5 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 6) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_6; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_6 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_6 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 7) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_7; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_7 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_7 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                    <?php }
                                            ?>
                                                    <?php if ($k == 8) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_8; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_8 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_8 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 9) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_9; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_9 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_9 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 10) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_10; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_10 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_10 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                               <?php }
                                            ?>
                                                <?php if ($k == 11) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_11; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_11 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_11 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 12) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_12; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_12 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_12 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 13) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_13; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_13 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_13 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 14) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_14; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_14 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_14 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 15) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_15; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_15 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results->answer_15 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                              } else {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 16) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_16; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_16 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_16 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 17) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_17; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_17 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results->answer_17 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                               <?php }
                                             ?>
                                                <?php if ($k == 18) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_18; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_18 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_18 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                               <?php }
                                              ?>
                                               <?php if ($k == 19) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_19; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_19 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_19 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 20) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_20; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_20 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_20 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                             } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                              <?php }
                                            ?>
                                                <?php if ($k == 21) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_21; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_21 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_21 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                           } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 22) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_22; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_22 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_22 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 23) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_23; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_23 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                           } else if ($results->answer_23 == 2) {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                          } else {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 24) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_24; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_24 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_24 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 25) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_25; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_25 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_25 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 26) {
                                                ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_26; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_26 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_26 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 27) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_27; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_27 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_27 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 28) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_28; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_28 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_28 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 29) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_29; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_29 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_29 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 30) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results5->question_30; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_30 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_30 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php } ?>
                                                        </div>
                                                        <?php } ?>
                                                </div>
                                                <a class="closepop" id="pat<?php echo $results5->id; ?>" href="javascript:void(0);" onclick="document.getElementById('patient<?php echo $results5->id; ?>').style.display = 'none';
                                                        document.getElementById('fade').style.display = 'none';">Close</a>
                                            </div>

                                        </div>
                                              <?php }?>
                                        <?php } } ?>

                            <!--------------------------------------------->

<?php
                      //   New Patients  li Notes
                            if ($query6) {
                                     foreach ($query6 as $ki =>$results6) {
                                       if(!empty($all_notes[6][$ki])){
                                        $query_notes =$all_notes[6][$ki];
                                       }
                                     else{
                                     $query_notes =array();
                                     }
                                    $item = explode(" ", $results6->date);
                                    $item2 = explode(" ", $results6->last_modify);
                                    if ($item[0] != "") {
                                        $sign_dt = date("m-d-Y", strtotime($item[0]));
                                    } else {
                                        $sign_dt = $item[0];
                                    }
                                    if ($item2[0] != "") {
                                        $act_dt = date("m-d-Y", strtotime($item2[0]));
                                    } else {
                                        $act_dt = $item2[0];
                                    }
                                    ?>
                                    <div id="embed<?php echo $results6->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                        <div class="col-xs-12 col-md-6 notes_left">
                                            <div class="row">
                                                <h2>NOTES</h2>
                                            </div>
                                            <div class="scrollNotes"><?php echo 'Name: ' . $results6->name; ?></div>
                                            <div class="scrollNotes"><?php echo 'Email: ' . $results6->email; ?></div>
                                            <div class="scrollNotes"><?php echo 'Phone: ' . format_telephone($results->phone); ?></div>
                                            <div class="scrollNotes"><?php echo 'Signed Up: ' . $sign_dt; ?></div>
                                            <div class="scrollNotes"><?php echo 'Action Taken: ' . $act_dt; ?></div>
                                            <form action="" method="post">
                                                <input type="hidden" value="<?php echo $results6->id; ?>" class="add_p_id" name="add_p_id" />
                                                <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                                                <br />
                                                <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                                            </form>
                                        </div>
                                        <div class="col-xs-12 col-md-6 notes_right">
                                            <div class="row">
                                                <h2>UPDATES</h2>
                                            </div>
                                                <?php
                                                $aaa_ID6 = $results6->id;
                                                $query_notes6 = $wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID6' ORDER BY id DESC", OBJECT);
                                                if (count($query_notes6) > 3) {
                                                    ?>
                                                <div id="scrollNotes">Scroll down to view all notes</div>
                                                        <?php }
                                                    ?>
                                            <div data-offset="0" data-target="#myNavbar"  data-spy="scroll" class="scroll-area">
                                                <?php
                                                if ($query_notes6) {
                                                    foreach ($query_notes6 as $results_notes6) {
                                                        ?>
                                                        <dl class="clinical_trial" id="parent<?php echo $results_notes6->id; ?>">
                                                            <a href="javascript:void(0);" id="<?php echo $results_notes6->id; ?>" noteid="<?php echo $results_notes6->note_id; ?>"  style="float:right; margin:0 10px;" class="removeNote"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/delete.png" /></a>
                                                            <dt style=" color:#00afef;"><?php $date_here = str_replace("?", "", $results_notes6->notes_date);
                                        echo date('m-d-Y h:i:s', strtotime($date_here)); ?> </dt>
                                                            <dd>
                                                                <p><?php echo $results_notes6->notes; ?></p>
                                                            </dd>
                                                        </dl>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <a class="closepop" id="<?php echo $results6->id; ?>" href="javascript:void(0);" onclick="document.getElementById('embed<?php echo $results6->id; ?>').style.display = 'none';
                                                document.getElementById('fade').style.display = 'none';">Close</a>
                                    </div>
                                    <?php if ($redirect_num != '' && $results6->is_front == 1) { ?>
                                        <div id="patient<?php echo $results6->id; ?>" class="white_content" style="cursor: auto; display: none;">
                                            <div class="col-xs-12  notes_right">
                                                <div class="row">
                                                    <h2 style="text-decoration: none">Phone Screening</h2>
                                                </div>
                                                        <?php if ($results->no_of_question == 0) { ?>
                                                    <div style="padding:20px;padding-left:5px;font-size:20px;font-weight:bold;"> No Questions was available.</div>
                                                        <?php
                                                        } else {
                                                            $num_qust = $results6->no_of_question;
                                                            ?>
                                                    <div style="font-size: 12px;margin-top: 0px;margin-bottom: 5px;">
                                                        <div class="scrollNotes" style="margin-top: -10px;margin-bottom:5px;">
                                                            <?php
                                                            if ($results->is_callfire_qualified == 1) {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Qualified</span> for this Study.</h3>';
                                                            } else {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Not Qualified</span> for this Study.</h3>';
                                                            }
                                                            ?>
                                                        </div>
                                                <div style="height: 375px; overflow-y: auto;">
                                                <?php for ($k = 1; $k <= $num_qust; $k++) { ?>
                                                    <?php if ($k == 1) {
                                                        ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_1; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_1 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_1 == 2) {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                 } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 2) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_2; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_2 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_2 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 3) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_3; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_3 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_3 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 4) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_4; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_4 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_4 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 5) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_5; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_5 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_5 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 6) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_6; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_6 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_6 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 7) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_7; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_7 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_7 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                    <?php }
                                            ?>
                                                    <?php if ($k == 8) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_8; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_8 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_8 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 9) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_9; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_9 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_9 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 10) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_10; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_10 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_10 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                               <?php }
                                            ?>
                                                <?php if ($k == 11) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_11; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_11 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_11 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 12) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_12; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_12 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_12 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 13) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_13; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_13 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_13 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 14) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_14; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_14 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_14 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 15) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_15; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_15 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results->answer_15 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                              } else {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 16) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_16; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_16 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_16 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 17) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_17; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_17 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results->answer_17 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                               <?php }
                                             ?>
                                                <?php if ($k == 18) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_18; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_18 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_18 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                               <?php }
                                              ?>
                                               <?php if ($k == 19) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_19; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_19 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_19 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 20) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_20; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_20 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_20 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                             } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                              <?php }
                                            ?>
                                                <?php if ($k == 21) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_21; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_21 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_21 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                           } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 22) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_22; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_22 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_22 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 23) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_23; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_23 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                           } else if ($results->answer_23 == 2) {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                          } else {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 24) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_24; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_24 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_24 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 25) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_25; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_25 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_25 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 26) {
                                                ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_26; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_26 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_26 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 27) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_27; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_27 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_27 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 28) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_28; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_28 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_28 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 29) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_29; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_29 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_29 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 30) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results6->question_30; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_30 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_30 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php } ?>
                                                        </div>
                                                        <?php } ?>
                                                </div>
                                                <a class="closepop" id="pat<?php echo $results6->id; ?>" href="javascript:void(0);" onclick="document.getElementById('patient<?php echo $results6->id; ?>').style.display = 'none';
                                                        document.getElementById('fade').style.display = 'none';">Close</a>
                                            </div>

                                        </div>
                                              <?php }?>
                                        <?php } } ?>

                            <!-- End Of Notes HTML -->

                            <!-- END: XHTML for example 2.3 -->

                        </div>
                    </div>
                    <!-- Example JavaScript files -->
                    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/dragdrop/jquery-1.4.2.min.js"></script>
                    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/dragdrop/jquery-ui-1.8.custom.min.js"></script>
                    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/dragdrop/jquery.cookie.js"></script>
                    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/dragdrop/jquery.ui.touch-punch.min.js"></script>
                    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/dragdrop/patientdetails.js"></script>
                    <!-- Example jQuery code (JavaScript)  -->
                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            var aaa = jQuery(".dhe-example-section-content").outerHeight();
                                            jQuery('.sortable-list').css({'min-height': aaa});
                                            // Get items
                                            function getItems(exampleNr)
                                            {
                                                var columns = [];
                                                $(exampleNr + ' ul.sortable-list').each(function () {
                                                    columns.push($(this).sortable('toArray').filter(function (e) {
                                                        return e
                                                    }).join(','));
                                                });
                                                return columns.join('|');
                                            }
                                            // Example 2.3: Save items automaticly

                                            $('#example-2-3 .sortable-list').sortable({
                                                helper: 'clone',
                                                connectWith: '#example-2-3 .sortable-list',
                                                update: function (e,ui) {

                                                    //setInterval(function(){jQuery(".white_content").css('display','none');jQuery("#fade").css('display','none'); },1);
                                                    if (this === ui.item.parent()[0]) {
                                                        jQuery.ajax({
                                                            type: "GET",
                                                            cache:false,
                                                            url: "<?php bloginfo('url'); ?>/find-listing-using-jquery/",
                                                            data: "data_sending=" + getItems('#example-2-3') + "&pid=" +<?php echo $pid; ?>,
                                                            success: function (data) {
                                                                //Update the Table Count
                                                                updateTableCount();
                                                            }
                                                        });
                                                    }

                                                    //Update the Table Count
                                                  //  e.stopImmediatePropagation();

                                                    //updateTableCount();
                                                }
                                                 //return false;
                                            });
                                            $(".navbar-toggle").click(function () {// alert('vbbvbv');
                                                $("#bs-example-navbar-collapse-1").toggle("slow", function () {
                                                    // Animation complete.
                                                });
                                            });
                                        });
                                        function updateTableCount() {
                                            var ulArray = $("ul.sortable-list");
                                            for (var i = ulArray.length - 1; i >= 0; i--) {
                                                var ul = ulArray[i];
                                                var ulId = ul.getAttribute("spanid");
                                                debugger;
                                                //Removing the Empty li from ul
                                                for (var j = ul.children.length - 1; j >= 0; j--) {
                                                    if (ul.children[j].innerHTML.trim() == "") {
                                                        ul.children[j].remove();
                                                    }
                                                }
                                                var length = ul.children.length;
                                                var span = document.getElementById(ulId);
                                                span.innerHTML = length;
                                            }
                                        }

                    </script>
            </section>
        </div>
    </div>
    <div id="embed" class="white_content2" style="display: none;">
        <form action="" method="post">
            <input type="hidden" value="<?php echo $pid; ?>" name="add_p_id" />
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Name :</h4>
            <input  style="width: 100%;" type="text" value="" required name="add_name" />
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Email :</h4>
            <input  style="width: 100%;" type="text" value="" required name="add_email" />
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Phone Number :</h4>
            <input style="width: 100%;" type="text" value="" required name="add_phone" />
            <br />
            <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Add Patient" name="add_patient_db" />
        </form>
        <a class="closepop" href="javascript:void(0);" onclick="document.getElementById('embed').style.display = 'none';
                document.getElementById('fade').style.display = 'none'">Close</a> </div>
</div>
<div id="fade" class="black_overlay"></div>
<?php
if ($_REQUEST['add_patient_db']) {
    $add_p_id = $_REQUEST['add_p_id'];
    $add_name = $_REQUEST['add_name'];
    $add_email = $_REQUEST['add_email'];
    $add_phone = $_REQUEST['add_phone'];
    if ($add_p_id != "" || $add_name != "" || $add_email != "") {
        global $wpdb;
        $date_sub = date('Y-m-d H:i:s', strtotime('-5 hours'));
        $query = mysql_query("INSERT INTO `0gf1ba_subscriber_list`(`id`, `name`, `email`, `phone`, `post_id`, `date`, `row_num`, `order_id`) VALUES (NULL,'$add_name','$add_email','$add_phone','$add_p_id','$date_sub','1','0')");
        if ($query) {
            ?>
            <script>
                window.location.href = window.location.href;
            </script>
        <?php }
    }
} ?>
<?php
if ($_REQUEST['delete']) {
    $delete = $_REQUEST['delete'];
    global $wpdb;
    $query_delete = $wpdb->query($wpdb->prepare("DELETE FROM 0gf1ba_subscriber_list WHERE id=$delete"));
    if ($query_delete) {
        ?>
        <script>
            window.location.href = window.location.href;
        </script>
    <?php }
} ?>
<?php get_footer('dashboard'); ?>
<?php
function format_telephone($phone_number) {
    $phone_number = preg_replace('/[^0-9]+/', '', $phone_number); //Strip all non number characters
    return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone_number); //Re Format it
}
?>
<style>
    .fa-caret-right:before {
        content: "";
    }

    .fa {
        line-height: 0;
    }
</style>
