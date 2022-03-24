<?php
/*
 * Template Name: Patients Details
 */
?>
<?php
function check_user_privileges($_custom_field_arr = null){
    if (isset($_REQUEST['pid'])){
        $post_id = $_REQUEST['pid'];
        $author_id = get_post_field( 'post_author', $post_id );
        $allowed_user_ids[] = $author_id;
        $current_user_id = get_current_user_id();

        if ($author_id == $current_user_id ) {
            return true;
        }

        if ($_custom_field_arr == null) {
            $_custom_field_arr = get_post_custom($post_id);
        }

        for($i=1;$i<6;$i++){
            $key = 'author_' . $i;
            if(isset($_custom_field_arr[$key]) && isset($_custom_field_arr[$key][0]) && $_custom_field_arr[$key][0]){
                if ( $current_user_id == $_custom_field_arr[$key][0] ) {
                    return true;
                }
            }
        }

        if(isset($_custom_field_arr['manager_username']) && isset($_custom_field_arr['manager_username'][0]) && $_custom_field_arr['manager_username'][0]){
            if ($current_user_id == $_custom_field_arr['manager_username'][0]) {
                return true;
            }
        }

        return false;
    }else{
        return false;
    }
}

$callfir_credits = getCallfireCredits($pid);
$_custom_fields = get_post_custom($_REQUEST['pid']);

if (is_user_logged_in() && check_user_privileges($_custom_fields)) {
    $user_ID = get_current_user_ID();
} else {
    wp_redirect(site_url().'/clinical-trial-patient-recruitment-patient-enrollment/', 301);
    exit;
}


if(!isset($_custom_fields['allow_international_phone_numbers'])){
    // by default use USA number format
    $allow_international_phone_numbers = false;
}else{
    $allow_international_phone_numbers = isset($_custom_fields['allow_international_phone_numbers'][0]) ? ($_custom_fields['allow_international_phone_numbers'][0] != '') : true;
}

if(!isset($_custom_fields['allow_delete_patients'])){
    $allow_delete_users = false;
}else{
    $allow_delete_users = isset($_custom_fields['allow_delete_patients'][0]) ? ($_custom_fields['allow_delete_patients'][0] != '') : true;
}

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
    $study_nom = get_post_meta($aaa, 'study_no', true );
    $post_title = get_the_title($aaa);
    $file = 'StudyKIK_Patient_Report.csv';
    $query2 = ("SELECT * FROM 0gf1ba_subscriber_list where post_id=$aaa AND is_deleted != 1");
    $get_results = $wpdb->get_results($query2);
    $total_count = count($get_results);
    $i = 6;
    $len=0;
    foreach ($get_results as $values) {
        $i++;
        $aaa_ID = $values->id;
        $query_notes = $wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID' ORDER BY id DESC", OBJECT);
        if ($values->row_num == 1) {
            $csv_output = "New Patient";
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
        $ln=strlen($csv_output);
        if($ln > $len){
            $len=$ln;
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
      )
    );
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
    $objPHPExcel->getActiveSheet()->setTitle('Download Patient Report');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $file = $study_nom.'_StudyKIK_Patient_Report.xlsx';
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
/* ==================== END ================================ */
?>
<?php
$pid = $_REQUEST['pid'];
get_header('dashboard');
?>
<!-- Pure Chat Snippet -->
<script type='text/javascript'>
    var received_mess = [];
    function addReceivedMessage(mess_id){
        if (received_mess.indexOf(mess_id) == -1){
            received_mess.push(mess_id);
        }
    }

    var opened_msgs_id = 0;
    var unread_messages_init = JSON.parse('<?php echo wp_get_unread_messages($pid); ?>');
    var data_messages_init = unread_messages_init.messages;
    if (data_messages_init && data_messages_init.length > 0){
        for(var i=0; i<data_messages_init.length; i++){
            addReceivedMessage(data_messages_init[i].message_id);
        }
    }
    console.log(received_mess);

    var is_safari = false;
    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {is_safari = true;}

  /**
   * detect IE
   * returns version of IE or false, if browser is not Internet Explorer
   */
    function detectIE() {
        var ua = window.navigator.userAgent;

        var msie = ua.indexOf('MSIE ');
        if (msie > 0) {
          // IE 10 or older => return version number
            return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
        }

        var trident = ua.indexOf('Trident/');
        if (trident > 0) {
          // IE 11 => return version number
            var rv = ua.indexOf('rv:');
            return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
        }

        var edge = ua.indexOf('Edge/');
        if (edge > 0) {
          // Edge (IE 12+) => return version number
            return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
        }

      // other browser
        return false;
    }

    function pickclose(){
        jQuery(".xdsoft_datetimepicker").hide();
    }
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

        jQuery( ".clear_all" ).click(function() {
            window.location.href = window.location.href;
        });

    });
</script>

<script src="<?php echo get_template_directory_uri();?>/js/jquery.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/jquery.datetimepicker.full.js"></script>

<script type="application/javascript">
    jQuery( document ).ready(function() {
        var aaa= jQuery( ".dhe-example-section-content" ).outerHeight();
        jQuery('.sortable-list').css({ 'min-height': aaa });
        jQuery('.like-sortable-list').css({ 'min-height': aaa });
        jQuery(window).scroll(function() {
            var scroll = jQuery(window).scrollTop();
            if (scroll >= 650) {
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
    });
</script>

<style>
    .clinical_trial_connect {
        border-bottom: 1px solid #e7e7e7;
        color: #959ca1;
        float: left;
        font-size: 18px;
        padding-bottom: 8px;
        padding-left: 15px;
        width: 100%;
    }
    .clinical_trial_connect p {
        font-size:14px;
    }
    .scroll-area_connect {
        background: #ffffff none repeat scroll 0 0;
        border-radius: 0 4px;
        height: 100px;
        overflow: auto;
        position: relative;
    }
    .scroll-area_connect dl {
        margin-bottom: 2px;
        margin-top: 0;
    }

</style>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/dragdrop/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/dragdrop/devheart-examples.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/patient-table-responsive.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery.datetimepicker.css" media="screen" />
<div id="banner_login">
<div class="container">
<div class="row">
    <?php
    $user_ID = get_current_user_id();
    $user_info = get_userdata($user_ID);
    $user_roles = implode(', ', $user_info->roles);
    if ($user_roles == "manager_username") {
        get_header('manager-submenu');
    } else {
        get_header('client-submenu');
    }
    ?>
</div>
<?php
$return_url = "/patients-details/?pid=".$pid;
$time_zone = get_post_meta($pid, 'callfire_time_zone', true);
$suvoda_protocol_id = get_post_meta( $pid, 'suvoda_protocol_id', true );
global $wpdb;
?>
<div class="row">
<section class="container_current">
<div style="margin-top:15px; overflow: hidden;">
    <div id="jquery_jplayer_2"></div>
    <div class="col-xs-4 search_right_patient" style="width:290px; margin-right:2px;">
        <div class="form-search form-inline" id="search_btn_form">
            <input type="text" placeholder="Search For a Patient" class="search_for_patient" onkeyup="findPatientDetail(this.value);" id="search_btn" style="width:230px;">
            <input type="hidden" value="<?php echo $pid; ?>" id="pidsds" />
        </div>

    <div style="margin-top: 9px;padding-left: 8px;">
        <?php
        $sel_val='all';
	$sel_val_all_default=true;
        if(isset($_REQUEST['campaign'])){
          $sel_val=$_REQUEST['campaign'];
          $sel_val_all_default=false;
        }

        ?>
        <select class="users" name="users" style="margin-left:10px;width:229px;margin-top:5px;">
    	    <option <?php if($sel_val=='all' && $sel_val_all_default){echo 'selected="selected"';}?> value="">Select Campaign</option>
            <option <?php if($sel_val=='all' && !$sel_val_all_default){echo 'selected="selected"';}?> value="all">All</option>

          <?php $pid = $_REQUEST['pid'];
            $query = $wpdb->get_results("SELECT * FROM `0gf1ba_campaigns` WHERE post_id='$pid' order by start_date DESC", OBJECT);
            foreach($query as $i => $qry){
                $st_dt=$qry->start_date;
                $en_dt=$qry->end_date;
                $campn=$qry->campaign;
                if($st_dt !=NULL && $en_dt !=NULL){
                    $date = date('m/d/Y',strtotime($st_dt));
                    $date_en = date('m/d/Y',strtotime($en_dt));
                    $cam_dates['sdate']=$date;
                    $label=$date." - ".$date_en;
                  ?>

                    <option <?= ($campn == $sel_val) ? 'selected="selected"' : ''?> value="<?= $campn?>"><?= $label?></option>

                <?php }
            }
          ?>
        </select>
    </div>
    </div>
    <?php
    $red_num = get_post_meta($pid, 'redirect_number', true );
    $post_pid = get_post($pid);
    $subscriber_query = array();
    $tt_calls=0;
    $tt_cn = 0;
    $total_count_arr = array();
    $page_limit = 20;
    $r_array = array_fill(0, 8, 0);
    if($sel_val=='all') {
        $total_count_arr = $wpdb->get_results("SELECT row_num, count(*) as total_count FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 GROUP BY row_num");
        foreach($total_count_arr as $count_arr){
            if ($count_arr->row_num >= 1) {
                $r_array[$count_arr->row_num - 1] = $count_arr->total_count;
            }
        }
        for ($i = 1; $i <= 8; $i ++) {
            $subscriber_query[$i - 1] = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and row_num = $i AND is_deleted != 1 ORDER BY id DESC LIMIT $page_limit", OBJECT);
            $tt_cn += $r_array[$i - 1];
        }
        $tt_calls = $wpdb->get_var("SELECT count(*) FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and is_front = 1 and redirect_number != '' and broadcast_id != '' AND is_deleted != 1 ORDER BY id DESC", OBJECT);
    } else {
        $total_count_arr = $wpdb->get_results("SELECT row_num, count(*) as total_count FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and campaign ='$sel_val' AND is_deleted != 1 GROUP BY row_num");
        foreach($total_count_arr as $count_arr){
            if ($count_arr->row_num >= 1) {
                $r_array[$count_arr->row_num - 1] = $count_arr->total_count;
            }
        }
        for ($i = 1; $i <= 8; $i ++) {
            $subscriber_query[$i - 1] = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and campaign ='$sel_val' and row_num = $i AND is_deleted != 1 ORDER BY id DESC LIMIT $page_limit", OBJECT);
            $tt_cn += $r_array[$i - 1];
        }
        $tt_calls = $wpdb->get_var("SELECT count(*) FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and campaign ='$sel_val' and is_front == 1 and redirect_number != '' and broadcast_id != '' AND is_deleted != 1 ORDER BY id DESC", OBJECT);
    }
    $max_col_total = max($r_array);

    $is_read_arr=array();
    $query_calldata = $wpdb->get_results("SELECT patient_id FROM 0gf1ba_calldata WHERE is_read = '0' AND study_id = '$pid' GROUP BY patient_id", OBJECT);
    if (count($query_calldata)> 0){
        foreach($query_calldata as $qry){
            $patient_id = $qry->patient_id;
            $is_read_arr[$patient_id]=$patient_id;
        }
    }
    ?>

    <div class="study-legend" style="">
        <span style="font-size:24px;color:#9fcf67"><?php echo $post_pid->post_title;?></span>
<!--        <br>-->
			<span style="color: #f68d20;font: 18px helveticaregular !important;display:none;">Total Study Views:
			    <span style="color:#00aff0;">
				<?php
                echo gapp_get_post_pageviews($pid);
                /*
                if($sel_val=='all'){
                    $toal_viws=0;
                    $result = mysql_query("SELECT SUM(meta_value) AS total_views FROM 0gf1ba_postmeta where post_id='$pid' and meta_key LIKE 'views%'");
                    WHILE($rows = mysql_fetch_array($result)):
                        $toal_viws=$rows['total_views'];
                    endwhile;
                    echo $toal_viws;
                }
                else if($sel_val==1){
                    echo get_post_meta($pid, 'views', true);
                }
                else{
                    echo get_post_meta($pid, 'views_'.$sel_val, true);
                }
                */
                ?>
			    </span>
			</span>
        <br>
        <span style="color: #f68d20;font: 18px helveticaregular !important;">Total Patient Referrals: <span style="color:#00aff0;"><?php echo $tt_cn;?></span></span>
    </div>
</div>

<div class="col-xs-12">
    <?php
    $pr_num = null;
    $callfir_credits = 0;
    $class_name = false;
    if (isset($_REQUEST['pid'])) {
        $pr_num = get_post_meta($_REQUEST['pid'], 'purchased_number', true);
        $callfir_credits = getCallfireCredits($_REQUEST['pid']);

        switch(true){
            case $callfir_credits > 99 && $callfir_credits < 1000:
                $class_name = 'fix-textsize';
                break;
            case ($callfir_credits < 0):
                $class_name = 'fix-textsize';
                break;
            case $callfir_credits >= 1000 && $callfir_credits < 10000:
                $class_name = 'fix-textsize-16';
                break;
            case $callfir_credits >= 10000 && $callfir_credits < 100000:
                $class_name = 'fix-textsize-12';
                break;
            case $callfir_credits >= 100000:
                $class_name = 'fix-textsize-10';
                break;
        }
    }
    ?>
    <div class="ui-left-part">
        <?php
        if ($pr_num) {
            ?>
            <div class="creditscount_view" href="javascript:void(0);">
                <img title="Account Credits" src="<?php echo get_template_directory_uri(); ?>/images/buttons_v2/Account-Credits-Button.png">
                <span class="credits-count<?php if($class_name){ echo ' '.$class_name; } ?>"><?php echo $callfir_credits; ?></span>
            </div>
        <?php
        }
        ?>
        <?php
        $pr_num = get_post_meta($pid, 'purchased_number', true);
        if ($pr_num != "") {
            $query9 = mysql_query("SELECT id FROM 0gf1ba_calldata where to_number='$pr_num' order by from_number ASC, created DESC");

        }
        $tonum = 0;
        if ($query9) {
            while ($rows = mysql_fetch_array($query9)) {
                $tonum = 1;
                break;
            }
        }

        if ($pr_num != 0) {
            ?>
            <a title="Phone Records" style="" class="phonerecords_view callconnt" href="javascript:void(0);">
                <img src="<?php echo get_template_directory_uri(); ?>/images/buttons_v2/phone-records-button.png">
            </a>
        <?php
        }

        $pr_no = get_post_meta($pid, 'text_message_purchased_number', true);
        if ($pr_no != "") {
            ?>
            <a title="Text Blast" style="" class="textpatients_view textpatient" href="javascript:void(0);">
                <img src="<?php echo get_template_directory_uri(); ?>/images/buttons_v2/text-patients-button.png">
            </a>
        <?php
        }

        $pr_num = get_post_meta($pid, 'purchased_number', true);
        if ($pr_no != "" && $author_id == $current_user_id) {
            ?>
            <a title="Add Credits" style="" class="buycredits_view buycredits" href="javascript:void(0);">
                <img src="<?php echo get_template_directory_uri(); ?>/images/buttons_v2/buy-credits-button.png">
            </a>
        <?php
        }
        ?>
    </div>
    <div class="ui-right-part">
        <a title="Add Patient" style="" class="addpatient_view"
           href="javascript:void(0);"
           onclick="document.getElementById('embed').style.display = 'block';document.getElementById('fade').style.display = 'block'">

            <img src="<?php echo get_template_directory_uri(); ?>/images/buttons_v2/add-patient-button.png">
        </a>
        <a title="Edit Site Information" style="" class="editsiteinfo_view esite"
           href="javascript:void(0);"
           onclick="document.getElementById('esite').style.display = 'block';document.getElementById('fade').style.display = 'block'">

            <img src="<?php echo get_template_directory_uri(); ?>/images/buttons_v2/edit-site-info-button.png">
        </a>
        <form action="" method="post" class="downloadreport_container">
            <input title="Download Patient Report" type="submit" style="border: medium none; float: right;" class="downloadreport_view" value=""
                   name="get_csv_file">
        </form>
        <a title="Watch Tutorial" style="" class="questionchange_view"
           href="javascript:void(0);"
           onclick="document.getElementById('embed13').style.display='block';document.getElementById('fade').style.display='block'">

            <img src="<?php echo get_template_directory_uri(); ?>/images/watch-tutorial-button.png">
        </a>
    </div>
</div>
<div id="center-wrapper">
<h1 id="updated" style="display: block; font-size: 20px; text-align: center; margin: 0px; padding: 0px; color: rgb(159, 207, 103);"></h1>
<div class="dhe-example-section" id="ex-2-3" style="padding-top:15px;">

<div class="dhe-example-section-content">

<table class="table table-bordered aaaaaaaaaaa<?php if((bool) $suvoda_protocol_id){ echo ' suvoda-header'; }?>">
    <thead>
    <tr bgcolor="#959ca1">
        <th><button class="contact" type="button">
            <p><span id="newPatients"><?php echo $r_array[0]; ?></span> New Patient</p>
          </button>
          <i class="fa fa-caret-right arrow" ><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
        <th><button class="contact" type="button">
            <p><span id="callAttempted"><?php echo $r_array[1]; ?></span> Call Attempted</p>
          </button>
          <i class="fa fa-caret-right arrow" ><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
        <th class="pad_class"><button class="contact" type="button">
            <p><span id="notQualified"><?php echo $r_array[2]; ?></span>  Not Qualified /<br  />
              Not Interested</p>
          </button>
          <i class="fa fa-caret-right arrow" ><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
        <th><button class="contact" type="button">
            <p><span id="actionNeeded"><?php echo $r_array[6]; ?></span> Action Needed</p>
          </button>
          <i class="fa fa-caret-right arrow" ><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
        <th><button class="contact" type="button">
            <p><span id="scheduled"><?php echo $r_array[3]; ?></span> Scheduled</p>
          </button>
          <i class="fa fa-caret-right arrow" ><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
        <th><button class="contact" type="button">
            <p><span id="consented"><?php echo $r_array[4]; ?></span> Consented</p>
          </button>
          <i class="fa fa-caret-right arrow" style="line-height: 0; content: none;"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
        <?php if((bool) $suvoda_protocol_id){ ?>
        <th>
            <button class="contact" type="button">
                <p>
                    <span id="screen_failed"><?php echo $r_array[7]; ?></span> Screen Failed
                </p>
            </button>
            <i class="fa fa-caret-right arrow" style="line-height: 0; content: none;">
                <img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" />
            </i>
        </th>
        <?php }?>
        <th><button class="contact<?php if((bool) $suvoda_protocol_id){ echo ' suvoda-contact'; }?>" type="button">
            <p><span id="randomized"><?php echo $r_array[5]; ?></span> Randomized</p>
          </button>
          <i class="fa fa-caret-right arrow" style="line-height: 0; content: none;"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
    </tr>
  </thead>
</table>
<!-- BEGIN: XHTML for example 2.3 -->
<?php ?>

<div id="example-2-3"<?php if((bool) $suvoda_protocol_id){ echo ' class=\'with-suvoda-id\''; }?>>
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
  <ul id="nwPatients" spanid="newPatients" class="sortable-list withoutsch">

    <?php
    //$redirect_num = get_post_meta($pid, 'redirect_number', true);
    if ($subscriber_query[0]) {
      foreach ($subscriber_query[0] as $results) {
        if($time_zone !=""){
          ?>
          <script type="text/javascript">
            jQuery(function(){
              jQuery( "#patlii<?php echo $results->id;?>" ).datetimepicker({
                onSelectTime:function () {
                  var dt=jQuery( "#patlii<?php echo $results->id;?>" ).val();
                  update_schedule("<?php echo $results->id;?>", dt, 1);
                },
                format:'Y-m-d H:i',
                formatTime:'h:i A',
                step:10,
                monthStart:0,
                monthEnd: 11,
                minTime: "04:30 AM",
                maxTime: "09:10 PM"
              });
            });
          </script>
        <?php
        }
        $redirect_num=$results->redirect_number;
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
        if($results->schedule_time !=""){
          $tm=date("m-d-Y, h:i A", strtotime($results->schedule_time));
        }
        else{
          $tm="";
        }
        echo '<li class="sortable-item" id="' . $results->id . '">';
        echo '<strong id=name_'.$results->id.'>' . $results->name;
        echo '</strong><br />';
        echo '<span id=email_'.$results->id.'>' . $results->email;
        echo '</span><br />';
        echo '<span id=phone_'.$results->id.'>' . ( ($allow_international_phone_numbers) ? ($results->phone) : format_telephone($results->phone) ) ;
        echo '</span><br />';
        echo '<span>Signed Up: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $sign_dt;
        echo '</span><br />';
        echo '<span id=actaken_'.$results->id.'>Action Taken: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $act_dt;
        echo '</span><br />';
        if($time_zone !=""){
          echo '<span id="schspan_'.$results->id.'">Schedule Date:'  ;
          echo '</span><br />';
          echo '<span><a title="Edit Scheduled Date" id="linkidpg_'.$results->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results->id.'">'.$tm.'</a>';
          echo '</span><br />';
        }

        ?>
        <div style="width: 100%;"<?php if((bool) $suvoda_protocol_id){ echo ' class=\'suvoda-controls\''; }?>>
          <?php if ($allow_delete_users){ ?>
            <a title="Delete Patient" href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="margin-left: 13px; float: right;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
          <?php } ?>
          <a title="Edit/Notes" data-tooltip="<?php echo isset($query_notes[0]->notes) ? $query_notes[0]->notes : 'Add notes'; ?>" data-tooltip-position="top"  href="javascript:void(0);" style="margin-left: 13px; float: right;"  note_idd ="<?php echo $results->id; ?>" class="updatepopup_data" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
          <?php if ($redirect_num != '' && $results->is_front == 1 && $results->no_of_question !=0) { ?>
            <?php if ($results->is_callfire_qualified != 1 ){?>
              <a data-tooltip="Add notes" data-tooltip-position="top"   href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;"  callid ='<?php echo $results->id  ?>'class="callconnect" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Question.png" /></a>
            <?php
            }
            else{?>
              <a data-tooltip="Add notes" data-tooltip-position="top"   callid ='<?php echo $results->id  ?>'  class="callconnect" href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;cursor:pointer;" class="replacenotes aaaa<?php echo $results->id; ?>" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/QuestionGreen.png" /></a>
            <?php
            }
            ?>
          <?php
          }
          ?>
          <?php
          $pr_no = get_post_meta($pid, 'text_message_purchased_number', true);
          if($pr_no !=""){
            if (in_array($results->id,$is_read_arr)){ ?>
              <a title="Text Message" unq_at="<?php echo $results->id; ?>" id="msgs_<?php echo $results->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Message_new.png"></a>

            <?php
            }
            else{ ?>
              <a title="Text Message" unq_at="<?php echo $results->id; ?>" id="msgs_<?php echo $results->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/New_Message.png"></a>
            <?php }

          }
          ?>
          <input type="text" class="patlitext" id="patlii<?php echo $results->id;?>" style="width:1px;height:1px;margin-left:-10px;visibility:hidden">
        </div>
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
  <ul id="caPatients" spanid="callAttempted" class="sortable-list withoutsch">
    <?php
    if ($subscriber_query[1]) {
      foreach ($subscriber_query[1] as $results2) {
        if($time_zone !=""){
          ?>
          <script type="text/javascript">
            jQuery(function(){
              jQuery( "#patlii<?php echo $results2->id;?>" ).datetimepicker({
                onSelectTime:function () {
                  var dt=jQuery( "#patlii<?php echo $results2->id;?>" ).val();
                  update_schedule("<?php echo $results2->id;?>", dt,2);
                },
                format:'Y-m-d H:i',
                formatTime:'h:i A',
                step:10,
                monthStart:0,
                monthEnd: 11,
                minTime: "04:30 AM",
                maxTime: "09:10 PM"
              });
            });
          </script>
        <?php
        }
        $redirect_num=$results2->redirect_number;
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
        if($results2->schedule_time !=""){
          $tm=date("m-d-Y, h:i A", strtotime($results2->schedule_time));
        }
        else{
          $tm="";
        }
        echo '<li class="sortable-item" id="' . $results2->id . '">';
        echo '<strong id=name_'.$results2->id.'>' . $results2->name;
        echo '</strong><br />';
        echo '<span id=email_'.$results2->id.'>' . $results2->email;
        echo '</span><br />';
        echo '<span id=phone_'.$results2->id.'>' . ( ($allow_international_phone_numbers) ? ($results2->phone) : format_telephone($results2->phone) );
        echo '</span><br />';
        echo '<span>Signed Up: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $sign_dt;
        echo '</span><br />';
        echo '<span id=actaken_'.$results2->id.'>Action Taken: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $act_dt;
        echo '</span><br />';
        if($time_zone !=""){
          echo '<span id="schspan_'.$results2->id.'">Schedule Date:'  ;
          echo '</span><br />';
          echo '<span><a title="Edit Scheduled Date" id="linkidpg_'.$results2->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results2->id.'">'.$tm.'</a>';
          echo '</span><br />';
        }
        ?>
        <div style="width: 100%;"<?php if((bool) $suvoda_protocol_id){ echo ' class=\'suvoda-controls\''; }?>>
          <?php if ($allow_delete_users){ ?>
              <a title="Delete Patient" href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results2->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="margin-left: 13px; float: right;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
          <?php } ?>
          <a title="Edit/Notes" data-tooltip="<?php echo isset($query_notes[0]->notes) ? $query_notes[0]->notes : 'Add notes'; ?>" data-tooltip-position="top"  note_idd ="<?php echo $results2->id; ?>" class="updatepopup_data" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="replacenotes aaaa<?php echo $results2->id; ?>" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
          <?php if ($redirect_num != '' && $results2->is_front == 1 && $results2->no_of_question !=0) { ?>
            <?php if ($results2->is_callfire_qualified != 1 ){?>
              <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results2->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;" callid ='<?php echo $results2->id  ?>'  class="callconnect"  id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Question.png" /></a>
            <?php
            }
            else{?>
              <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results2->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="display:none; float: right;cursor:pointer; margin-left: 13px;"  callid ='<?php echo $results2->id  ?>'  class="callconnect"  id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/QuestionGreen.png" /></a>
            <?php
            }
            ?>
          <?php
          }
          ?>
          <?php
          $pr_no = get_post_meta($pid, 'text_message_purchased_number', true);
          if($pr_no !=""){
            if (in_array($results2->id,$is_read_arr)){ ?>
              <a title="Text Message" unq_at="<?php echo $results2->id; ?>" id="msgs_<?php echo $results2->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Message_new.png"></a>

            <?php
            }
            else{ ?>
              <a title="Text Message" unq_at="<?php echo $results2->id; ?>" id="msgs_<?php echo $results2->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/New_Message.png"></a>
            <?php }
          }
          ?>
          <input type="text" class="patlitext" id="patlii<?php echo $results2->id;?>" style="width:1px;height:1px;margin-left:-10px;visibility:hidden">
        </div>
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
  <ul id="nqPatients" spanid="notQualified" class="sortable-list withoutsch">
    <?php
    if ($subscriber_query[2]) {
      foreach ($subscriber_query[2] as $results3) {
        if($time_zone !=""){
          ?>
          <script type="text/javascript">
            jQuery(function(){
              jQuery( "#patlii<?php echo $results3->id;?>" ).datetimepicker({
                onSelectTime:function () {
                  var dt=jQuery( "#patlii<?php echo $results3->id;?>" ).val();
                  //alert(dt);
                  update_schedule("<?php echo $results3->id;?>", dt,3);
                },
                format:'Y-m-d H:i',
                formatTime:'h:i A',
                step:10,
                monthStart:0,
                monthEnd: 11,
                minTime: "04:30 AM",
                maxTime: "09:10 PM"
              });
            });
          </script>
        <?php
        }
        $redirect_num=$results3->redirect_number;
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
        if($results3->schedule_time !=""){
          $tm=date("m-d-Y, h:i A", strtotime($results3->schedule_time));
        }
        else{
          $tm="";
        }
        echo '<li class="sortable-item" id="' . $results3->id . '">';
        echo '<strong id=name_'.$results3->id.'>' . $results3->name;
        echo '</strong><br />';
        echo '<span id=email_'.$results3->id.'>' . $results3->email;
        echo '</span><br />';
        echo '<span id=phone_'.$results3->id.'>' . ( ($allow_international_phone_numbers) ? ($results3->phone) : format_telephone($results3->phone) );
        echo '</span><br />';
        echo '<span>Signed Up: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $sign_dt;
        echo '</span><br />';
        echo '<span id=actaken_'.$results3->id.'>Action Taken: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $act_dt;
        echo '</span><br />';
        if($time_zone !=""){
          echo '<span id="schspan_'.$results3->id.'">Schedule Date:'  ;
          echo '</span><br />';
          echo '<span><a title="Edit Scheduled Date" id="linkidpg_'.$results3->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results3->id.'">'.$tm.'</a>';
          echo '</span><br />';
        }
        ?>
        <div style="width: 100%;"<?php if((bool) $suvoda_protocol_id){ echo ' class=\'suvoda-controls\''; }?>>
          <?php if ($allow_delete_users){ ?>
            <a title="Delete Patient" href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results3->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="margin-left: 13px; float: right;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
          <?php } ?>
          <a title="Edit/Notes" data-tooltip="<?php echo isset($query_notes[0]->notes) ? $query_notes[0]->notes : 'Add notes'; ?>" data-tooltip-position="top" note_idd ="<?php echo $results3->id; ?>" class="updatepopup_data"  href="javascript:void(0);" style="margin-left: 13px; float: right;" class="replacenotes aaaa<?php echo $results3->id; ?>" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
          <?php if ($redirect_num != '' && $results3->is_front == 1 && $results3->no_of_question !=0) { ?>
            <?php if ($results3->is_callfire_qualified != 1 ){?>
              <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results3->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;"  callid ='<?php echo $results3->id  ?>'  class="callconnect"  id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Question.png" /></a>
            <?php
            }
            else{?>
              <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results3->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="display:none; float: right;cursor:pointer; margin-left: 13px;"  callid ='<?php echo $results3->id  ?>'  class="callconnect" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/QuestionGreen.png" /></a>
            <?php
            }
            ?>
          <?php
          }
          ?>
          <?php
          $pr_no = get_post_meta($pid, 'text_message_purchased_number', true);
          if($pr_no !=""){
            if (in_array($results3->id,$is_read_arr)){ ?>
              <a title="Text Message" unq_at="<?php echo $results3->id; ?>" id="msgs_<?php echo $results3->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Message_new.png"></a>

            <?php
            }
            else{ ?>
              <a title="Text Message" unq_at="<?php echo $results3->id; ?>" id="msgs_<?php echo $results3->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/New_Message.png"></a>
            <?php }
          }
          ?>
          <input type="text" class="patlitext" id="patlii<?php echo $results3->id;?>" style="width:1px;height:1px;margin-left:-10px;visibility:hidden">
        </div>
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
  <ul id="anPatients" spanid="actionNeeded" class="sortable-list withoutsch">
    <?php
    if ($subscriber_query[6]) {
      foreach ($subscriber_query[6] as $results7) {
        if($time_zone !=""){
          ?>
          <script type="text/javascript">
            jQuery(function(){
              jQuery( "#patlii<?php echo $results7->id;?>" ).datetimepicker({
                onSelectTime:function () {
                  var dt=jQuery( "#patlii<?php echo $results7->id;?>" ).val();
                  //alert(dt);
                  update_schedule("<?php echo $results7->id;?>", dt,7);
                },
                format:'Y-m-d H:i',
                formatTime:'h:i A',
                step:10,
                monthStart:0,
                monthEnd: 11,
                minTime: "04:30 AM",
                maxTime: "09:10 PM"
              });
            });
          </script>
        <?php
        }
        $redirect_num=$results7->redirect_number;
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
        if($results7->schedule_time !=""){
          $tm=date("m-d-Y, h:i A", strtotime($results7->schedule_time));
        }
        else{
          $tm="";
        }
        echo '<li class="sortable-item" id="' . $results7->id . '">';
        echo '<strong id=name_'.$results7->id.'>' . $results7->name;
        echo '</strong><br />';
        echo '<span id=email_'.$results7->id.'>' . $results7->email;
        echo '</span><br />';
        echo '<span id=phone_'.$results7->id.'>' . ( ($allow_international_phone_numbers) ? ($results7->phone) : format_telephone($results7->phone) );
        echo '</span><br />';
        echo '<span>Signed Up: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $sign_dt;
        echo '</span><br />';
        echo '<span id=actaken_'.$results7->id.'>Action Taken: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $act_dt;
        echo '</span><br />';
        if($time_zone !=""){
          echo '<span id="schspan_'.$results7->id.'">Schedule Date:'  ;
          echo '</span><br />';
          echo '<span><a title="Edit Scheduled Date" id="linkidpg_'.$results7->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results7->id.'">'.$tm.'</a>';
          echo '</span><br />';
        }
        ?>
        <div style="width: 100%;"<?php if((bool) $suvoda_protocol_id){ echo ' class=\'suvoda-controls\''; }?>>
          <?php if ($allow_delete_users){ ?>
            <a title="Delete Patient" href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results7->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="margin-left: 13px; float: right;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
          <?php } ?>
          <a title="Edit/Notes" data-tooltip="<?php echo isset($query_notes[0]->notes) ? $query_notes[0]->notes : 'Add notes'; ?>" data-tooltip-position="top"  note_idd ="<?php echo $results7->id; ?>" class="updatepopup_data" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="replacenotes aaaa<?php echo $results7->id; ?>" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
          <?php if ($redirect_num != '' && $results7->is_front == 1 && $results7->no_of_question !=0) { ?>
            <?php if ($results7->is_callfire_qualified != 1 ){?>
              <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results7->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;" callid ='<?php echo $results7->id  ?>'  class="callconnect" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Question.png" /></a>
            <?php
            }
            else{?>
              <a data-tooltip="Add notes" data-tooltip-position="top" onclick="document.getElementById('patient<?php echo $results7->id; ?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0);" style="display:none; float: right; cursor:pointer;margin-left: 13px;"  callid ='<?php echo $results7->id  ?>'  class="callconnect" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/QuestionGreen.png" /></a>
            <?php
            }
            ?>
          <?php
          }
          ?>
          <?php
          $pr_no = get_post_meta($pid, 'text_message_purchased_number', true);
          if($pr_no !=""){
            if (in_array($results7->id,$is_read_arr)){ ?>
              <a title="Text Message" unq_at="<?php echo $results7->id; ?>" id="msgs_<?php echo $results7->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Message_new.png"></a>

            <?php
            }
            else{ ?>
              <a title="Text Message" unq_at="<?php echo $results7->id; ?>" id="msgs_<?php echo $results7->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/New_Message.png"></a>
            <?php }
          }
          ?>
          <input type="text" class="patlitext" id="patlii<?php echo $results7->id;?>" style="width:1px;height:1px;margin-left:-10px;visibility:hidden">
        </div>
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
  <ul id="shPatients" spanid="scheduledd" class="sortable-list withoutsch">
    <?php
    if ($subscriber_query[3]) {
    foreach ($subscriber_query[3] as $results4) {
    if($time_zone !=""){
      ?>
      <script type="text/javascript">
        jQuery(function(){
          jQuery( "#patlii<?php echo $results4->id;?>" ).datetimepicker({
            onSelectTime:function () {
              var dt=jQuery( "#patlii<?php echo $results4->id;?>" ).val();
              //alert(dt);
              update_schedule("<?php echo $results4->id;?>", dt,4);
            },
            format:'Y-m-d H:i',
            formatTime:'h:i A',
            step:10,
            monthStart:0,
            monthEnd: 11,
            minTime: "04:30 AM",
            maxTime: "09:10 PM"
          });
        });
      </script>
    <?php
    }
    $redirect_num=$results4->redirect_number;
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
    if($results4->schedule_time !=""){
      $tm=date("m-d-Y, h:i A", strtotime($results4->schedule_time));
    }
    else{
      $tm="";
    }
    echo '<li class="sortable-item" id="' . $results4->id . '">';
    echo '<strong id=name_'.$results4->id.'>' . $results4->name;
    echo '</strong><br />';
    echo '<span id=email_'.$results4->id.'>' . $results4->email;
    echo '</span><br />';
    echo '<span id=phone_'.$results4->id.'>' . ( ($allow_international_phone_numbers) ? ($results4->phone) : format_telephone($results4->phone) );
    echo '</span><br />';
    echo '<span>Signed Up: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $sign_dt;
    echo '</span><br />';
    echo '<span id=actaken_'.$results4->id.'>Action Taken: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $act_dt;
    echo '</span><br />';
    if($time_zone !=""){
      if($results4->schedule_time !=""){
        echo '<span id="schspan_'.$results4->id.'">Schedule Date:'  ;
        echo '</span><br />';
        echo '<span><a title="Edit Scheduled Date" id="linkidpg_'.$results4->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results4->id.'">'.$tm.'</a>';
        echo '</span><br />';
      }
      else{
        echo '<span id="schspan_'.$results4->id.'"><a title="Schedule Patient" id="linkidpgsh_'.$results4->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results4->id.'">Schedule Date:</a> '  ;
        echo '</span><br />';
        echo '<span><a title="Edit Scheduled Date" id="linkidpg_'.$results4->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results4->id.'">'.$tm.'</a>';
        echo '</span><br />';
      }
      echo '</span><br />';
    }
    ?>
    <div style="width: 100%;"<?php if((bool) $suvoda_protocol_id){ echo ' class=\'suvoda-controls\''; }?>>
      <?php if ($allow_delete_users){ ?>
        <a title="Delete Patient" title="Delete Patient"  href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results4->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="margin-left: 13px; float: right;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
      <?php } ?>
      <a title="Edit/Notes" data-tooltip="<?php echo isset($query_notes[0]->notes) ? $query_notes[0]->notes : 'Add notes'; ?>" data-tooltip-position="top"  note_idd ="<?php echo $results4->id; ?>" class="updatepopup_data" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="replacenotes aaaa<?php echo $results4->id; ?>" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
      <?php if ($redirect_num != '' && $results4->is_front == 1 && $results4->no_of_question !=0) { ?>
        <?php if ($results4->is_callfire_qualified != 1 ){?>
          <a data-tooltip="Add notes" data-tooltip="Add notes" data-tooltip-position="top"   href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;"  callid ='<?php echo $results4->id  ?>'  class="callconnect" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Question.png" /></a>
        <?php
        }
        else{?>
          <a data-tooltip="Add notes" data-tooltip="Add notes" data-tooltip-position="top"   href="javascript:void(0);" style="display:none; float: right;cursor:pointer; margin-left: 13px;"  callid ='<?php echo $results4->id  ?>'  class="callconnect" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/QuestionGreen.png" /></a>
        <?php
        }
        ?>
      <?php
      }
      ?>
      <?php
      $pr_no = get_post_meta($pid, 'text_message_purchased_number', true);
      if($pr_no !=""){
        if (in_array($results4->id,$is_read_arr)){ ?>
          <a title="Text Message" unq_at="<?php echo $results4->id; ?>" id="msgs_<?php echo $results4->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Message_new.png"></a>

        <?php
        }
        else{ ?>
          <a title="Text Message" unq_at="<?php echo $results4->id; ?>" id="msgs_<?php echo $results4->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/New_Message.png"></a>
        <?php }
      }
      ?>
      <input type="text" class="patlitext" id="patlii<?php echo $results4->id;?>" style="width:1px;height:1px;margin-left:-10px;visibility:hidden">
    </div>
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
          <p>Consented</p>
        </button>
        <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
    </tr>
    </thead>
  </table>
  <ul id="cnPatients" spanid="consented" class="<?php if((bool) $suvoda_protocol_id){ echo 'like-sortable-list'; }else{ echo 'sortable-list'; };?> withoutsch">
    <?php
    if ($subscriber_query[4]) {
      foreach ($subscriber_query[4] as $results5) {
        if($time_zone !=""){
          ?>
          <script type="text/javascript">
            jQuery(function(){
              jQuery( "#patlii<?php echo $results5->id;?>" ).datetimepicker({
                onSelectTime:function () {
                  var dt=jQuery( "#patlii<?php echo $results5->id;?>" ).val();
                  //alert(dt);
                  update_schedule("<?php echo $results5->id;?>", dt,5);
                },
                format:'Y-m-d H:i',
                formatTime:'h:i A',
                step:10,
                monthStart:0,
                monthEnd: 11,
                minTime: "04:30 AM",
                maxTime: "09:10 PM"
              });
            });
          </script>
        <?php
        }
        $aaa_ID5 = $results5->id;
        $redirect_num=$results5->redirect_number;
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
        if($results5->schedule_time !=""){
          $tm=date("m-d-Y, h:i A", strtotime($results5->schedule_time));
        }
        else{
          $tm="";
        }
        echo '<li class="sortable-item" id="' . $results5->id . '">';
        echo '<strong id=name_'.$results5->id.'>' . $results5->name;
        echo '</strong><br />';
        echo '<span id=email_'.$results5->id.'>' . $results5->email;
        echo '</span><br />';
        echo '<span id=phone_'.$results5->id.'>' . ( ($allow_international_phone_numbers) ? ($results5->phone) : format_telephone($results5->phone) );
        echo '</span><br />';
        echo '<span>Signed Up: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $sign_dt;
        echo '</span><br />';
        echo '<span id=actaken_'.$results5->id.'>Action Taken: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $act_dt;
        echo '</span><br />';
        if($time_zone !=""){
          echo '<span id="schspan_'.$results->id.'">Schedule Date:'  ;
          echo '</span><br />';
          echo '<span><a title="Edit Scheduled Date" id="linkidpg_'.$results5->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results5->id.'">'.$tm.'</a>';
          echo '</span><br />';
        }
        ?>
        <div style="width: 100%;"<?php if((bool) $suvoda_protocol_id){ echo ' class=\'suvoda-controls\''; }?>>
          <?php if ($allow_delete_users){ ?>
             <a title="Delete Patient" href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results5->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="margin-left: 13px; float: right;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
          <?php } ?>
          <a title="Edit/Notes" data-tooltip="<?php echo isset($query_notes[0]->notes) ? $query_notes[0]->notes : 'Add notes'; ?>" data-tooltip-position="top"  note_idd ="<?php echo $results5->id; ?>" class="updatepopup_data"href="javascript:void(0);" style="margin-left: 13px; float: right;" class="replacenotes aaaa<?php echo $results5->id; ?>" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
          <?php if ($redirect_num != '' && $results5->is_front == 1 && $results5->no_of_question !=0) { ?>
            <?php if ($results5->is_callfire_qualified != 1 ){?>
              <a data-tooltip="Add notes" data-tooltip-position="top" callid ='<?php echo $results5->id  ?>'  class="callconnect" href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;"   id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Question.png" /></a>
            <?php
            }
            else{?>
              <a data-tooltip="Add notes" data-tooltip-position="top"   style="display:none; float: right; cursor:pointer; margin-left: 13px;"   callid ='<?php echo $results5->id  ?>'  class="callconnect" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/QuestionGreen.png" /></a>
            <?php
            }
            ?>
          <?php
          }
          ?>
          <?php
          $pr_no = get_post_meta($pid, 'text_message_purchased_number', true);
          if($pr_no !=""){
            if (in_array($results5->id,$is_read_arr)){ ?>
              <a title="Text Message" unq_at="<?php echo $results5->id; ?>" id="msgs_<?php echo $results5->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Message_new.png"></a>

            <?php
            }
            else{ ?>
              <a title="Text Message" unq_at="<?php echo $results5->id; ?>" id="msgs_<?php echo $results5->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/New_Message.png"></a>
            <?php }
          }
          ?>
          <input type="text" class="patlitext" id="patlii<?php echo $results5->id;?>" style="width:1px;height:1px;margin-left:-10px;visibility:hidden">
        </div>
        </li>
      <?php
      }
    }
    ?>
  </ul>
</div>
<?php if((bool) $suvoda_protocol_id){ ?>
<div class="column left">
    <table class="table table-bordered">
        <thead>
        <th><button class="contact" type="button">
                <p>screen_failed</p>
            </button>
            <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/arrow_img.png" /></i></th>
        </tr>
        </thead>
    </table>
    <ul id="" spanid="screen_failed" class="like-sortable-list">
        <?php
        if ($subscriber_query[7]) {
            foreach ($subscriber_query[7] as $results8) {
                if($time_zone !=""){
                    ?>
                    <script type="text/javascript">
                        jQuery(function(){
                            jQuery( "#patlii<?php echo $results8->id;?>" ).datetimepicker({
                                onSelectTime:function () {
                                    var dt=jQuery( "#patlii<?php echo $results8->id;?>" ).val();
                                    //alert(dt);
                                    update_schedule("<?php echo $results8->id;?>", dt,6);
                                },
                                format:'Y-m-d H:i',
                                formatTime:'h:i A',
                                step:10,
                                monthStart:0,
                                monthEnd: 11,
                                minTime: "04:30 AM",
                                maxTime: "09:10 PM"
                            });
                        });
                    </script>
                <?php
                }
                $redirect_num=$results8->redirect_number;
                $aaa_ID6 = $results8->id;
                $item6 = explode(" ", $results8->date);
                $item26 = explode(" ", $results8->last_modify);
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
                if($results8->schedule_time !=""){
                    $tm=date("m-d-Y, h:i A", strtotime($results8->schedule_time));
                }
                else{
                    $tm="";
                }
                echo '<li class="sortable-item disable" id="' . $results8->id . '">';
                echo '<strong id=name_'.$results8->id.'>' . $results8->name;
                echo '</strong><br />';
                echo '<span id=email_'.$results8->id.'>' . $results8->email;
                echo '</span><br />';
                echo '<span id=phone_'.$results8->id.'>' . ( ($allow_international_phone_numbers) ? ($results8->phone) : format_telephone($results8->phone) );
                echo '</span><br />';
                echo '<span>Signed Up: '. "<br />" . $sign_dt;
                echo '</span><br />';
                echo '<span id=actaken_'.$results8->id.'>Action Taken: '. "<br />" . $act_dt;
                echo '</span><br />';
                if($time_zone !=""){
                    echo '<span id="schspan_'.$results->id.'">Schedule Date:'  ;
                    echo '</span><br />';
                    echo '<span><a title="Edit Scheduled Date" id="linkidpg_'.$results8->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results8->id.'">'.$tm.'</a>';
                    echo '</span><br />';
                }
                ?>
                <div style="width: 100%;" class='suvoda-controls'>
                    <?php if ($allow_delete_users){ ?>
                        <a title="Delete Patient" href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results8->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="margin-left: 13px; float: right;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
                    <?php } ?>
                    <a title="Edit/Notes" data-tooltip="<?php echo isset($query_notes[0]->notes) ? $query_notes[0]->notes : 'Add notes'; ?>" data-tooltip-position="top"  note_idd ="<?php echo $results8->id; ?>" class="updatepopup_data"href="javascript:void(0);" style="margin-left: 13px; float: right;" class="replacenotes aaaa<?php echo $results8->id; ?>" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
                    <?php if ($redirect_num != '' && $results8->is_front == 1 && $results8->no_of_question !=0) { ?>
                        <?php if ($results8->is_callfire_qualified != 1 ){?>
                            <a data-tooltip="Add notes" data-tooltip-position="top"  callid ='<?php echo $results8->id  ?>'  class="callconnect" href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;" class="replacenotes aaaa<?php echo $results8->id; ?>" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Question.png" /></a>
                        <?php
                        }
                        else{?>
                            <a data-tooltip="Add notes" data-tooltip-position="top" callid ='<?php echo $results8->id  ?>'  class="callconnect" href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;cursor:pointer;" class="replacenotes aaaa<?php echo $results8->id; ?>" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/QuestionGreen.png" /></a>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                    <?php
                    $pr_no = get_post_meta($pid, 'text_message_purchased_number', true);
                    if($pr_no !=""){
                        if (in_array($results8->id,$is_read_arr)){ ?>
                            <a title="Text Message" unq_at="<?php echo $results8->id; ?>" id="msgs_<?php echo $results8->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Message_new.png"></a>

                        <?php
                        }
                        else{ ?>
                            <a title="Text Message" unq_at="<?php echo $results8->id; ?>" id="msgs_<?php echo $results8->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/New_Message.png"></a>
                        <?php }
                    }
                    ?>
                    <input type="text" class="patlitext" id="patlii<?php echo $results8->id;?>" style="width:1px;height:1px;margin-left:-10px;visibility:hidden">
                </div>
                </li>
            <?php
            }
        }
        ?>
    </ul>
</div>
<?php } ?>
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
  <ul id="raPatients" spanid="randomized" class="<?php if((bool) $suvoda_protocol_id){ echo 'like-sortable-list'; }else{ echo 'sortable-list'; };?> withoutsch">
    <?php
      if ($subscriber_query[5]) {
          foreach ($subscriber_query[5] as $results6) {
            if($time_zone !=""){
              ?>
              <script type="text/javascript">
                jQuery(function(){
                  jQuery( "#patlii<?php echo $results6->id;?>" ).datetimepicker({
                    onSelectTime:function () {
                      var dt=jQuery( "#patlii<?php echo $results6->id;?>" ).val();
                      //alert(dt);
                      update_schedule("<?php echo $results6->id;?>", dt,6);
                    },
                    format:'Y-m-d H:i',
                    formatTime:'h:i A',
                    step:10,
                    monthStart:0,
                    monthEnd: 11,
                    minTime: "04:30 AM",
                    maxTime: "09:10 PM"
                  });
                });
              </script>
            <?php
            }
            $redirect_num=$results6->redirect_number;
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
            if($results6->schedule_time !=""){
              $tm=date("m-d-Y, h:i A", strtotime($results6->schedule_time));
            }
            else{
              $tm="";
            }
            echo '<li class="sortable-item" id="' . $results6->id . '">';
            echo '<strong id=name_'.$results6->id.'>' . $results6->name;
            echo '</strong><br />';
            echo '<span id=email_'.$results6->id.'>' . $results6->email;
            echo '</span><br />';
            echo '<span id=phone_'.$results6->id.'>' . ( ($allow_international_phone_numbers) ? ($results6->phone) : format_telephone($results6->phone) );
            echo '</span><br />';
            echo '<span>Signed Up: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $sign_dt;
            echo '</span><br />';
            echo '<span id=actaken_'.$results6->id.'>Action Taken: ' . (((bool) $suvoda_protocol_id) ? '<br />' : '') . $act_dt;
            echo '</span><br />';
            if($time_zone !=""){
              echo '<span id="schspan_'.$results->id.'">Schedule Date:'  ;
              echo '</span><br />';
              echo '<span><a title="Edit Scheduled Date" id="linkidpg_'.$results6->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results6->id.'">'.$tm.'</a>';
              echo '</span><br />';
            }
            ?>
            <div style="width: 100%;"<?php if((bool) $suvoda_protocol_id){ echo ' class=\'suvoda-controls\''; }?>>
              <?php if ($allow_delete_users){ ?>
                <a title="Delete Patient" href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid; ?>&delete=<?php echo $results6->id; ?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="margin-left: 13px; float: right;" id="add_not"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" /></a>
              <?php } ?>
              <a title="Edit/Notes" data-tooltip="<?php echo isset($query_notes[0]->notes) ? $query_notes[0]->notes : 'Add notes'; ?>" data-tooltip-position="top"  note_idd ="<?php echo $results6->id; ?>" class="updatepopup_data"href="javascript:void(0);" style="margin-left: 13px; float: right;" class="replacenotes aaaa<?php echo $results6->id; ?>" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png" /></a>
              <?php if ($redirect_num != '' && $results6->is_front == 1 && $results6->no_of_question !=0) { ?>
                <?php if ($results6->is_callfire_qualified != 1 ){?>
                  <a data-tooltip="Add notes" data-tooltip-position="top"  callid ='<?php echo $results6->id  ?>'  class="callconnect" href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;" class="replacenotes aaaa<?php echo $results6->id; ?>" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Question.png" /></a>
                <?php
                }
                else{?>
                  <a data-tooltip="Add notes" data-tooltip-position="top" callid ='<?php echo $results6->id  ?>'  class="callconnect" href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;cursor:pointer;" class="replacenotes aaaa<?php echo $results6->id; ?>" id="add_not"><img  style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/QuestionGreen.png" /></a>
                <?php
                }
                ?>
              <?php
              }
              ?>
              <?php
              $pr_no = get_post_meta($pid, 'text_message_purchased_number', true);
              if($pr_no !=""){
                if (in_array($results6->id,$is_read_arr)){ ?>
                  <a title="Text Message" unq_at="<?php echo $results6->id; ?>" id="msgs_<?php echo $results6->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/Message_new.png"></a>

                <?php
                }
                else{ ?>
                  <a title="Text Message" unq_at="<?php echo $results6->id; ?>" id="msgs_<?php echo $results6->id; ?>" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/New_Message.png"></a>
                <?php }
              }
              ?>
              <input type="text" class="patlitext" id="patlii<?php echo $results6->id;?>" style="width:1px;height:1px;margin-left:-10px;visibility:hidden">
            </div>
            </li>
          <?php
          }
      }
    ?>
  </ul>
</div>
</div>

<div class="clearer">&nbsp;</div>
<div id = "loading_imag" class="loading_imag" style="text-align:center;"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/ajax-loader.gif" /></div>
<!-- Notes HTML  -->






<!-- Example JavaScript files -->
<!--<script type="text/javascript" src="<?php bloginfo('template_url');?>/dragdrop/jquery-1.4.2.min.js"></script>
      <script type="text/javascript" src="<?php bloginfo('template_url');?>/dragdrop/jquery-ui-1.8.custom.min.js"></script>
      <script type="text/javascript" src="<?php bloginfo('template_url');?>/dragdrop/jquery.cookie.js"></script>
      <script type="text/javascript" src="<?php bloginfo('template_url');?>/dragdrop/jquery.ui.touch-punch.min.js"></script>-->
<script type="text/javascript" src="<?php bloginfo('template_url');?>/dragdrop/patientdetails.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.infinitescroll.min.js"></script>
<!-- Example jQuery code (JavaScript)  -->

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<!---<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>-->
<script src="<?php bloginfo('template_url');?>/js/jquery-ui.min.js"></script>

</section>
</div>
</div>

<div id="embed" class="white_content2" style="display: none;">
  <form action="" method="post">
    <input type="hidden" value="<?php echo $pid; ?>" name="post_id" />
    <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Name :</h4>
    <input  style="width: 100%;" type="text" value="" required name="name" />
    <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Email :</h4>
    <input  style="width: 100%;" type="text" value="" required name="email" />
    <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Phone Number :</h4>
    <input style="width: 100%;" type="text" value="" required name="custom_Mobile_Phone_Number" />
    <br />
    <input style="float: left; margin: 10px 0px;" class="add_btn" type="submit" value="Add Patient" name="add_patient_db" />
  </form>
  <a class="closepop" href="javascript:void(0);" onclick="document.getElementById('embed').style.display = 'none';
                document.getElementById('fade').style.display = 'none'">Close</a> </div>


</div>
<div id="embedconnect" class="white_content" style="cursor: auto; display: none;">
    <div class="col-xs-12 col-md-12 notes_left">
        <div class="row">
          <h2>Phone Records</h2>
        </div>
        <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area_connect" id="nts_div">
        </div>
    </div>
  <a class="closepop" href="javascript:void(0);" onclick="document.getElementById('embedconnect').style.display='none';document.getElementById('fade').style.display='none';">Close</a>
</div>

<div id="textPatient" class="white_content msg_popupcls" style="cursor: auto; display: none;">
  <div class="col-xs-12 col-md-12 notes_left">
    <div class="row">
      <h2>Text Blast</h2>
    </div>
    <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area_connect msgsenpop" id="nts_diva">
      <!--<table border="1 px slid" style="width:100%">
      <tr><td>New Patient</td>
      <td>call Attempted</td>
      <td>not Qualified/Not interested</td>
      <td>and so on</td>

      </tr>
      </table> -->
    </div>
  </div>
  <a class="closepop" href="javascript:void(0);" onclick="document.getElementById('textPatient').style.display='none';document.getElementById('fade').style.display='none';">Close</a>
</div>

<div id="note_data" class="white_content" style="cursor: auto; display: none;">

</div>
<div id="callpop_data" class="white_content" style="cursor: auto; display: none;width:63% !important;">


</div>
<div id="update_sub_details" class="white_content2" style="display: none;">
</div>
</div>

<div id="sentmsggs" class="white_content msg_popupcls" style="cursor: auto; display: none;  width: 33% !important;left: 32.5% !important;   border-radius: 0;">
    <div class="col-xs-12 col-md-12 notes_left">
        <div class="row">
          <h2>Messages</h2>
        </div>
        <div data-offset="0" data-target="#myNavbar"  class="scroll-area_connect msgsenpop asd" id="nts_diva1">

        </div>
    </div>
    <a class="closepop" href="javascript:void(0);" onclick="document.getElementById('sentmsggs').style.display='none';document.getElementById('fade').style.display='none';">Close</a>
</div>

<?php get_template_part('buy_credits_tpl');?>

<div id="esite" class="white_content2" style="cursor: auto; display: none;width: 45% !important;top: 20% !important;left: 27.5% !important;">
    <div class="col-xs-12 col-md-12 notes_left">
        <div class="row" style="margin-left:0px !important;margin-right:0px !important">
          <h2>Edit Site</h2>
        </div>
        <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area_connect" id="esite_div" style="height: 325px; margin-top: 10px;">
        </div>
    </div>
    <a class="closepop" href="javascript:void(0);" onclick="document.getElementById('esite').style.display='none';document.getElementById('fade').style.display='none';">Close</a>
</div>


<div style="display: none;border: 1px solid #f78e1e;" class="white_content" id="embedcal">
    <h2 class="heading" id="labelsts">
        Thank you
    </h2>
    <p id="cal_popup" style="color: #000; padding: 15px; font-size: 16px; text-align: center;">

    </p>
    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">
        <input type="button" value="CLOSE" class="close_button" onclick="document.getElementById('embedcal').style.display = 'none';
                 document.getElementById('fade').style.display = 'none'" style="">
    </p>
</div>


<div style="display: none;border: 1px solid #f78e1e;" class="white_content" id="embedsite">
    <h2 class="heading">
        Thank You
    </h2>
    <p id="cal_popup" style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Site information has been updated successfully!</p>
    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">
        <input type="button" value="CLOSE" class="close_button" onclick="document.getElementById('embedsite').style.display = 'none';
             document.getElementById('fade').style.display = 'none'" style="">
    </p>
</div>
<div id="embed13" class="white_content" style="cursor: auto; display: none;width:65% !important;left:17.5% !important;top:11.5% !important;;" >
    <div class="col-xs-12 col-md-12 notes_left">
        <div class="row">
            <h2>MyStudyKIK Portal</h2>
        </div>
        <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area" id="nts_div_vdo" style="text-align:center;height:425px!important;margin-bottom:15px;">
            <iframe style="padding-top: 25px;" width="800" height="415" src="https://www.youtube.com/embed/oZwY-UcdS2Y" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <a class="closepopvideopat" href="javascript:void(0);">Close</a>
</div>

<script type="text/javascript">
    var page_num = 1;
    var total_page_num = <?= ceil(floatval($max_col_total) / floatval($page_limit))?>;
    var is_ajax_loading = false;
    $(window).scroll(function()
    {
        if($(window).scrollTop() >= ($(document).height() - $(window).height()-200))
        {
            if (page_num < total_page_num) {

                jQuery('div#loading_imag').show();
                remote_url = "<?= get_bloginfo("url")?>/wp-admin/admin-ajax.php?action=load_patient_details";
                if (!is_ajax_loading) {
                    page_num = page_num + 1;
                    is_ajax_loading = true;
                    $.ajax({
                        url: remote_url,
                        method: "get",
                        data: {
                            page_num: page_num,
                            page_limit: <?=$page_limit?>,
                            pid: <?=$_REQUEST['pid']?>,
                            sel_val: "<?=$sel_val?>",
                        },
                        success: function(html)
                        {
                            is_ajax_loading = false;
                            if(html)
                            {
                                var data = JSON.parse(html);
                                var col_data = data['data'];
                                var common_data = data['common_data'];

                                for(var element_id in col_data)
                                {
                                    var output = ""
                                    for(var i = 0; i < col_data[element_id].length; i ++) {
                                        var row_data = col_data[element_id][i];
                                        output = output +  '<li class="sortable-item" id="' + row_data['id'] + '">';
                                        output = output +  '<strong id=name_' + row_data['id'] + '>' +  row_data['name'];
                                        output = output +  '</strong><br />';
                                        output = output +  '<span id=email_' + row_data['id'] + '>' +  row_data['email'];
                                        output = output +  '</span><br />';
                                        output = output +  '<span id=phone_' + row_data['id'] + '>' +  row_data['phone'];
                                        output = output +  '</span><br />';
                                        output = output +  '<span>Signed Up: ' + row_data['sign_dt'];
                                        output = output +  '</span><br />';
                                        output = output +  '<span id=actaken_' + row_data['id'] + '>Action Taken: ' +  row_data['act_dt'];
                                        output = output +  '</span><br />';
                                        if(common_data['time_zone'] !=""){
                                            output = output +  '<span id="schspan_' + row_data['id'] + '">Schedule Date:'  ;
                                            output = output +  '</span><br />';
                                            output = output +  '<span><a title="Edit Scheduled Date" id="linkidpg_' + row_data['id'] + '" href="javascript://void(0);" class="link_schd" unq_lnk="' + row_data['id'] + '">' + row_data['tm'] + '</a>';
                                            output = output +  '</span><br />';
                                        }


                                        output = output +  '<div style="width: 100%;"' + (Boolean(common_data['suvoda_protocol_id']) ? ' class=\'suvoda-controls\'':'') + '>';
                                        if (common_data['allow_delete_users']) {
                                            output = output +  '<a href="' + common_data['site_url'] + '/patients-details/?pid=' + common_data['pid'] + '&delete=' +  row_data['id'] + '" onclick="return confirm(\'Are you sure you would like to delete contact?\')" style="margin-left: 13px; float: right;" id="add_not"><img src="' + common_data['template_url'] + '/images-dashboard/close2.png" /></a>';
                                        }
                                        output = output +  '<a data-tooltip="' +  common_data['add_note_tooltip'] + '" data-tooltip-position="top"  href="javascript:void(0);" style="margin-left: 13px; float: right;"  note_idd ="' + row_data['id'] + '" class="updatepopup_data" id="add_not"><img style="width: 22px;" src="' + common_data['template_url'] + '/images-dashboard/notes_icon.png" /></a>';
                                        if (row_data['redirect_num'] != '' && row_data['is_front'] == 1 && row_data['no_of_question'] !=0) {
                                            if (row_data['is_callfire_qualified'] != 1 ){
                                                output = output +   '<a data-tooltip="Add notes" data-tooltip-position="top"   href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;"  callid ="' + row_data['id'] + '"class="callconnect" id="add_not"><img  style="height:20px;width:20px;" src="' + common_data['template_url'] + '/images-dashboard/img/Question.png" /></a>';
                                            }
                                            else{
                                                output = output +  '<a data-tooltip="Add notes" data-tooltip-position="top"   callid ="' + row_data['id'] + '"  class="callconnect" href="javascript:void(0);" style="display:none; float: right; margin-left: 13px;cursor:pointer;" class="replacenotes aaaa' +  row_data['id'] + '" id="add_not"><img  style="height:20px;width:20px;" src="' +  common_data['template_url'] + '/images-dashboard/img/QuestionGreen.png" /></a>';
                                            }
                                        }

                                        if(common_data['pr_no'] !=""){
                                            if (row_data['in_is_read_arr']){
                                                output = output +  '<a unq_at="' + row_data['id'] + '" id="msgs_' + row_data['id'] + '" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="' + common_data['template_url'] + '/images-dashboard/img/Message_new.png"></a>';
                                            }
                                            else{
                                                output = output +  '<a unq_at="' + row_data['id'] + '" id="msgs_' + row_data['id'] + '" data-tooltip="Show Messages" data-tooltip-position="top" href="javascript:void(0);" style="margin-left: 13px; float: right;" class="sent_msg"><img style="height:20px;width:20px;" src="' + common_data['template_url'] + '/images-dashboard/img/New_Message.png"></a>';
                                            }

                                        }
                                        output = output +  '<input type="text" class="patlitext" id="patlii' + row_data['id'] + '" style="width:1px;height:1px;margin-left:-10px;visibility:hidden">';
                                        output = output +  '</div>';
                                        output = output +  '</li>';

                                    }

                                    var htmlObject = $(output);

                                    $("#"+element_id).append(htmlObject);

                                    var aaa= jQuery( ".dhe-example-section-content" ).outerHeight();
                                    jQuery('.sortable-list').css({ 'min-height': aaa });
                                    jQuery('.like-sortable-list').css({ 'min-height': aaa });

                                    $(".sortable-list").sortable( "refresh" );
                                    $(".sortable-list").sortable( "refreshPositions" );
                                }

                                jQuery('div#loading_imag').hide();
                            }else
                            {
                                jQuery('div#loading_imag').html('<center>No more posts to show.</center>');
                            }
                        }
                    });
                }

            }

        }
    });
</script>
<script>
  $(document).ready(function() {
      var $sortable1 = $(".sortable-list").sortable({ // begin sortable
      connectWith: ".sortable-list",
      items: ".sorting-initialize",
      receive: function(event, ui) { // begin receive
            var id = $(ui.item).attr('id');
            var quantity = this.id;
            if(quantity=="shPatients"){
              <?php
              if($time_zone !=""){ ?>
              //$("#patlii"+id).attr("type",'text');
              var anc='<a title="Schedule Patient" unq_lnk="'+id+'" class="link_schd" href="javascript://void(0);" id="linkidpgsh_'+id+'" >Schedule Date:</a>';
              $("#schspan_"+id).html(anc);
              var anced='<a title="Schedule Patient" unq_lnk="'+id+'" class="link_schd" href="javascript://void(0);" id="editsch_'+id+'" >Schedule Date:</a>';
              $("#editspns_"+id).html(anced);
              jQuery("#patlii"+id).datetimepicker({ minTime: "04:30 AM", maxTime: "09:10 PM" });
              $("#patlii"+id).datetimepicker("show");
              <?php } ?>
            }
        else{
          <?php
            if($time_zone !=""){ ?>
                $("#schspan_"+id).html('Schedule Date:');
                $("#editspns_"+id).html('Schedule Date:');
          <?php } ?>
        }


        $.ajax({ // begin ajax
            url: "<?php bloginfo('url'); ?>/find-listing-using-jquery/",
            type: "GET",
            data: {
                'id': id,
                'quantity': quantity,
                'pid':'<?php echo $pid;?>',
                'cam_val':'<?php echo $sel_val;?>'
            },
          success: function(html){
                if(html !=""){
                  var res = html.split("@@");
                  $("#newPatients").html(res[0]);
                  $("#callAttempted").html(res[1]);
                  $("#notQualified").html(res[2]);
                  $("#actionNeeded").html(res[3]);
                  $("#scheduled").html(res[4]);
                  $("#consented").html(res[5]);
                  //$("#screen_failed").html(res[8]);
                  $("#randomized").html(res[6]);
                  $("#peactaken_"+id).html(res[7]);
                  $("#actaken_"+id).html(res[7]);
                }
            }
        }); // end ajax
      } // end receive
    }); // end sortable
      $sortable1.on("mouseenter", ".sortable-item", function(){
          $(this).addClass("sorting-initialize");
          $sortable1.sortable('refresh');
      });
      Number.prototype.padLeft = function(base,chr){
          var  len = (String(base || 10).length - String(this).length)+1;
          return len > 0? new Array(len).join(chr || '0')+this : this;
      }

      if (detectIE() || is_safari){
          $("#jquery_jplayer_2").jPlayer( {
              ready: function() { // The $.jPlayer.event.ready event
                  $(this).jPlayer("setMedia", { // Set the media
                      mp3: "<?php bloginfo('wpurl') ?>/sounds/message_received.mp3"
                  });
              },
              swfPath: "<?php bloginfo('wpurl') ?>/sounds/jquery.jplayer.swf",
              supplied: "mp3"
          });
      }else{
          $("#jquery_jplayer_2").jPlayer( {
              ready: function() { // The $.jPlayer.event.ready event
                  $(this).jPlayer("setMedia", { // Set the media
                      oga: "<?php bloginfo('wpurl') ?>/sounds/message_received.ogg"
                  });
              },
              swfPath: "<?php bloginfo('wpurl') ?>/sounds/jquery.jplayer.swf",
              supplied: "oga"
          });
      }

      function playReceiveMessageSound(arr){
          for(var i=0; i<arr.length; i++){
              if (received_mess.indexOf(arr[i].message_id) == -1){
                  if ( $("#msgs_"+arr[i].sub_id).length) {
                      $("#jquery_jplayer_2").jPlayer("play");
                      break;
                  }
              }
          }
      }

      var d = new Date,
          dformat = [d.getFullYear(),
              (d.getMonth()+1).padLeft(),
              d.getDate().padLeft()].join('-') +' ' +
              [d.getHours().padLeft(),
              d.getMinutes().padLeft(),
              d.getSeconds().padLeft()].join(':');

      var ih = setInterval(function(){
          var post_id='<?php echo $pid;?>';
          var author_id='<?php echo get_post_field( 'post_author', $pid );?>';

          jQuery.ajax({
              async: true,
              url: "<?php bloginfo('wpurl') ?>/get_unread_messages.php?action=get_unread_messages&post_id="+post_id+"&author_id="+author_id+"&curl_url=<?php bloginfo('wpurl') ?>&timestamp="+Date.now(),
              type:'GET',
              success: function(response_data){
                  //response_data = response_data.substr(0, (response_data.length-1));
                  var data_parsed = JSON.parse(response_data);
                  var data = data_parsed.messages;
                  var questions_data = data_parsed.questions;
                  var callfir_credits = data_parsed.callfir_credits;
                  var i = 0;
                  if (data && data.length > 0){
                      playReceiveMessageSound(data);
                      for(i=0; i<data.length; i++){
                          if ($("#sentmsggs").css('display') == 'block' && opened_msgs_id == data[i].sub_id){
                              jQuery.ajax({
                                  async: true,
                                  url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                                  type:'POST',
                                  data: "action=set_message_as_read&id="+ data[i].message_id + '&post_id='+ post_id,
                                  success: function(html){
                                  }
                              });
                              $(".wapper").append('<dl class="lft_dll clinical_trial_msggggg">' +
                                  '<dt class="lft_msg_dt">' +
                                  '<div class="lft_mssg">' +
                                  data[i].message +
                                  '<br>' +
                                  '<span style="font-size:11px;">' +
                                  '<i>'+data[i].message_date+'</i>' +
                                  '</span>' +
                                  '</div>' +
                                  '</dt>' +
                                  '</dl>');
                              $(".wapper").animate({ scrollTop: $(document).height() * 500 }, "fast");
                          }else{
                              $("#msgs_"+data[i].sub_id+" img").attr('src', "<?php bloginfo('template_url'); ?>/images-dashboard/img/Message_new.png");
                              addReceivedMessage(data[i].message_id);
                          }
                      }
                  }
                  if (questions_data && questions_data.length > 0){
                      for(i=0; i<questions_data.length; i++){
                          $(".callconnect[callid="+questions_data[i].id+"] img").attr('src', "<?php bloginfo('template_url'); ?>/images-dashboard/img/QuestionGreen.png");
                      }
                  }

                  if (callfir_credits != null ){//point 1
                      var creditscount_view = $(".creditscount_view");

                      creditscount_view.find('.credits-count').html(callfir_credits);
                      if(callfir_credits < 100 && callfir_credits > 0){
                          creditscount_view.find('.credits-count').removeAttr('class').addClass('credits-count fix-textsize');
                      }else if(callfir_credits >= 1000 && callfir_credits < 10000){
                          creditscount_view.find('.credits-count').removeAttr('class').addClass('credits-count fix-textsize-16');
                      }else if(callfir_credits >= 10000 && callfir_credits < 100000){
                          creditscount_view.find('.credits-count').removeAttr('class').addClass('credits-count fix-textsize-12');
                      }else if(callfir_credits >= 100000){
                          creditscount_view.find('.credits-count').removeAttr('class').addClass('credits-count fix-textsize-10');
                      }else{
                          creditscount_view.find('.credits-count').removeAttr('class').addClass('credits-count fix-textsize');
                      }
                  }
              }
          });
      }, 30000);
  });

  $(".users").change(function () {

    var user_id = this.value;
    var url      = window.location.href;
    if(user_id == "" || user_id == ""){}else{
        location.search = "pid=<?php echo $pid;?>&campaign="+user_id;
    }
  });


</script>
<script>
    jQuery(document).on('click',".callconnt", function(){
        jQuery("#fade").show();
        post_id='<?php echo $pid;?>';
        jQuery("#nts_div").html('<dl class="clinical_trial"><dt style=" color:red; margin-top:10px;">Please wait, Phone records are loading...</dt></dl>');
        jQuery("#embedconnect").show();
        jQuery.ajax({
            async: true,
            url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
            type:'POST',
            data: "action=dashboard_call_conncet&post_id="+ post_id + '&loop_file=dashboard_callconnects',
            success: function(html){
                jQuery("#nts_div").html(html);
            }
        });
    });

  // Text patient

    jQuery(document).on('click',".textpatient",function(){
        jQuery("#fade").show();
        var post_id='<?php echo $pid;?>';
        jQuery("#nts_diva").html('<dl class="clinical_trial"><dt style=" color:red; margin-top:10px;">Text patient details are loading, Please Wait..</dt></dl>');
        jQuery("#textPatient").show();
        jQuery.ajax({
            async: true,
            url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
            type:'POST',
            data: "action=text_aptient&post_id="+ post_id + '&patient_file=text_patient',
            success: function(html){
                jQuery("#nts_diva").html(html);
            }
        });



    });

    jQuery(document).on('click',".buycredits",function(){
        jQuery("#fade").show();
        var post_id='<?php echo $pid;?>';
        jQuery("#buy_credits_title").html('Add Credits');
        jQuery("#buy_credits_post_id").val(post_id);
        $(".buy_credits_wrapper_container a").remove();
        $(".buy_credits_wrapper_container").append('<a class="closepop" id="buy_credits_close_top_bar" href="javascript:void(0);" onclick="document.getElementById(\'buyCredits\').style.display=\'none\';document.getElementById(\'fade\').style.display=\'none\';">Close</a>');
        jQuery("#buy_credits_close_bttn").hide();
        jQuery("#buy_credits_purchase_bttn").show();
        jQuery(".buy_credits_error_text").hide();
        jQuery(".buy_credits_main_content").show();
        $("#buy_credits_paymentmethod").val('');
        jQuery(".loop_credit").hide();
        jQuery(".buy_credits_form_area").css("height","280px");

        jQuery("#buyCredits").show();
    });

  /* phone ajax */

    jQuery(document).on('click',".sent_msg", function(event, ui){

        var id = jQuery(this).attr('unq_at');
        opened_msgs_id = id;

        jQuery("#fade").show();
        //var post_id='<?php echo $pid;?>';
        jQuery("#nts_diva1").html('<dl class="clinical_trial"><dt style=" color:red; margin-top:10px;">Please wait, Messages are loading.....</dt></dl>');
        jQuery("#sentmsggs").show();

        jQuery.ajax({
            async: true,
            url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
            type:'POST',
            data: "action=text_amsg&post_id="+ id + '&msg_file=mess_system',
            success: function(html){
                jQuery("#nts_diva1").html(html);
                var blog_url='<?php bloginfo('template_url'); ?>';
                var im='<img style="height:20px;width:20px;" src="'+blog_url+'/images-dashboard/img/New_Message.png">';
                jQuery("#msgs_"+id).html(im);
                /*if (received_mess.indexOf(id) != -1){
                 received_mess.splice(received_mess.indexOf(id), 1);
             }*/
            }
        });
    });

  /* call cnnect popup*/

    jQuery(document).on('click', ".callconnect", function(){

        var callid = jQuery(this).attr('callid');

        jQuery("#fade").show();
        jQuery("#callpop_data").html('<div class="col-xs-12  notes_right"><div class="row"><h2 style="text-decoration: underline">Call Connect</h2></div><h5><div style="font-size: 20px; text-align: center; color:#f78e1e;font-weight:bold;">Please wait call connect recods are loading..</div></h5></div>');
        jQuery("#callpop_data").show();
        var post_id='<?php echo $pid;?>';
        jQuery.ajax({
            async: true,
            url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
            type:'POST',
            data: "action=call_connect&post_id="+ callid + '&call_file=call_connectfile',
            success: function(html){
                jQuery("#callpop_data").html(html);
            }
        });
    });

  /*  update popup */


    jQuery(document).on('click', ".updatepopup_data" ,function(){
        var note_idd =  jQuery(this).attr('note_idd');
        var pid='<?php echo $pid;?>';
        jQuery("#note_data").html('<div class="col-xs-12  notes_right"><div class="row"><h2 style="text-decoration: underline">Notes & Updates</h2></div><h5><div style="font-size: 20px; text-align: center; color:#f78e1e;font-weight:bold;">Loading..</div></h5></div>');
        // var note_idd='<?php echo $pid;?>';
        jQuery("#fade").show();
        jQuery("#note_data").show();
        jQuery.ajax({
            async: true,
            url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
            type:'POST',
            data: "action=updatenote&post_id="+ note_idd +'&pid='+ pid + '&note_file=updatenote_data',
            success: function(html){
                jQuery("#note_data").html(html);
            }
        });
    });


    jQuery(document).on('click', ".esite", function(){

    //        var form=jQuery('#savepts');
        //jQuery("#fade").show();
        var post_id='<?php echo $pid;?>';
        //alert('#patem'+post_id);
        var id='<?php echo $user_ID = get_current_user_id(); ?>  '

        jQuery("#esite_div").html('<dl class="clinical_trial"><dt style=" color:red; margin-top:10px;">Please wait, Edit site information are loading...</dt></dl>');
        jQuery.ajax({
            async: true,
            url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
            type:'POST',
            data: "action=dashboard_edit_site&post_id="+post_id+"&id="+id,
            success: function(html){
                jQuery("#esite_div").html(html);
            }
        });
    });

    jQuery(document).on('click',"#edit_site",function(){
        var post_id='<?php echo $pid;?>';
        var id='<?php echo $user_ID = get_current_user_id(); ?>  '
        jQuery.ajax({
            async: true,
            url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
            type:'POST',
            //data: "action=dashboard_update_site&post_id="+post_id+"&id="+id,
            data: jQuery("#edt_form").serialize(),
            success: function(html){
                jQuery("#esite").hide();
                jQuery("#embedsite").show();
            }

        });
    });


</script>
<?php
//if(isset($_POST['edit_site'])){
//update_post_meta($pid, 'name_of_site', $_POST['site']);
//update_post_meta($pid, 'phone_number', $_POST['sitephone']);
//update_post_meta($pid, 'study_full_address', $_POST['siteaddress']);
//update_post_meta($pid, 'email_adress', $_POST['siteemail1']);
//update_post_meta($pid, 'email_adress_2', $_POST['siteemail2']);
//update_post_meta($pid, 'email_adress_3', $_POST['siteemail3']);
//update_post_meta($pid, 'email_adress_4', $_POST['siteemail4']);
//update_post_meta($pid, 'email_adress_5', $_POST['siteemail5']);
//update_post_meta($pid, 'email_adress_6', $_POST['siteemail6']);
//update_post_meta($pid, 'email_adress_7', $_POST['siteemail7']);
//}
?>
<script>
    jQuery(document).on('click',".savepat",function(){
        var unid=jQuery(this).attr('unq_id');
        var form=jQuery('#savepts');
        //jQuery("#fade").show();
        var post_id='<?php echo $pid;?>';
        //alert('#patem'+post_id);
        var id=unid;
        var name=jQuery('#patnm'+unid).val();
        var email=jQuery('#patem'+unid).val();
        var phone=jQuery('#patph'+unid).val();
        jQuery('#email_'+unid).html(email);
        jQuery('#name_'+unid).html(name);
        jQuery('#phone_'+unid).html(phone);
        jQuery('#peemail_'+unid).html("Email: "+email);
        jQuery('#pename_'+unid).html("Name: "+name);
        jQuery('#pephone_'+unid).html("Phone: "+phone);

        //jQuery("#nts_div").html('<dl class="clinical_trial"><dt style=" color:red; margin-top:10px;">Please wait, Phone records are loading...</dt></dl>');
        //jQuery("#embedconnect").show();
        jQuery.ajax({
          async: true,
          url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
          type:'POST',
          data: "action=dashboard_save_patient&post_id="+post_id+"&id="+id+"&name="+name+"&email="+email+"&phone="+phone,
          success: function(html){
            //jQuery("#nts_div").html(html);
            jQuery('#update_sub_details').hide();
            jQuery('#update_sub_details').html('');
            $("#peactaken_"+id).html("Action Taken: <?php echo date('m-d-Y',strtotime('-4 hours'));?>");
            $("#actaken_"+id).html("Action Taken: <?php echo date('m-d-Y',strtotime('-4 hours'));?>");
            var note_idd =  id;
            var pid='<?php echo $pid;?>';
            jQuery("#note_data").html('<div class="col-xs-12  notes_right"><div class="row"><h2 style="text-decoration: underline">Notes  & Updates</h2></div><h5><div style="font-size: 20px; text-align: center; color:#f78e1e;font-weight:bold;">Please wait information are loading..</div></h5></div>');
            // var note_idd='<?php echo $pid;?>';
            jQuery("#fade").show();
            jQuery("#note_data").show();
            jQuery.ajax({
              async: true,
              url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
              type:'POST',
              data: "action=updatenote&post_id="+ note_idd +'&pid='+ pid + '&note_file=updatenote_data',
              success: function(html){

                jQuery("#note_data").html(html);
              }
            });
          }
        });
    });

    jQuery(document).on('click',".link_schd",function(){

        var unid=jQuery(this).attr('unq_lnk');
        jQuery("#patlii"+unid).datetimepicker({ minTime: "04:30 AM", maxTime: "09:10 PM" });
        jQuery("#patlii"+unid).datetimepicker("show");
    });
    function update_schedule(idd, dtt,pt){
        var dt=dtt+":00";
        $.ajax({
          url: "<?php bloginfo('url'); ?>/find-listing-using-jquery/",
          type: "GET",
          data: {
            'schid': idd,
            'schtime': dt
          },
          success: function(html){
            var ht=html.split("@@@@");
            $("#linkid_"+idd).html(ht[0]);
            $("#rmv_sch"+idd).remove();
            var ln='<a class="removeschedule" style="margin-left:10px;margin-top:-2px;position:absolute;" id="rmv_sch'+idd+'" href="javascript:void(0);" unq_lnk="'+idd+'"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/delete.png"></a>';
            $("#linkid_"+idd).after(ln);
            $("#linkidpg_"+idd).html(ht[0]);
            $("#cal_popup").html(ht[1]+" and a Text Reminder will be sent the day before!");
            $("#peactaken_"+idd).html("Action Taken: "+ht[2]);
            $("#actaken_"+idd).html("Action Taken: "+ht[2]);
            $("#embedcal").show();
            $("#schspan_"+idd).html('Schedule Date:');
            $("#editspns_"+idd).html('Schedule Date:');
              if($('#' + idd).parent().attr('id') !== 'shPatients'){
                  $.ajax({ // begin ajax
                      url: "<?php bloginfo('url'); ?>/find-listing-using-jquery/",
                      type: "GET",
                      data: {
                          'id': idd,
                          'quantity': 'shPatients',
                          'pid':'<?php echo $pid;?>',
                          'cam_val':'<?php echo $sel_val;?>'
                      },
                      success: function(html){
                          if(html !=""){
                              var res = html.split("@@");
                              $("#newPatients").html(res[0]);
                              $("#callAttempted").html(res[1]);
                              $("#notQualified").html(res[2]);
                              $("#actionNeeded").html(res[3]);
                              $("#scheduled").html(res[4]);
                              $("#consented").html(res[5]);
                              $("#randomized").html(res[6]);
                              $("#peactaken_"+idd).html(res[7]);
                              $("#actaken_"+idd).html(res[7]);
                              $('#' + idd).prependTo('#shPatients');
                          }
                      }
                  }); // end ajax
              }
          }
        });
    }

    $(document).on('click','.removeschedule',function (){
        var unq_lnk = $(this).attr('unq_lnk');
        $.ajax({
          type: "GET",
          url: "<?php bloginfo('url'); ?>/jquery-notes/",
          data: "remove_schedule=" + unq_lnk,
          success: function (data) {
            $("#rmv_sch"+unq_lnk).remove();
            $("#linkid_"+unq_lnk).html("");
            $("#linkidpg_"+unq_lnk).html("");
            $("#peactaken_"+unq_lnk).html("Action Taken: <?php echo date('m-d-Y',strtotime('-4 hours'));?>");
            $("#actaken_"+unq_lnk).html("Action Taken: <?php echo date('m-d-Y',strtotime('-4 hours'));?>");
            var anc='<a title="Schedule Patient" unq_lnk="'+unq_lnk+'" class="link_schd" href="javascript://void(0);" id="linkidpgsh_'+unq_lnk+'" >Schedule Date:</a>';
            $("#schspan_"+unq_lnk).html(anc);
            var anc='<a title="Schedule Patient" unq_lnk="'+unq_lnk+'" class="link_schd" href="javascript://void(0);" id="editsch_'+unq_lnk+'" >Schedule Date:</a>';
            $("#editspns_"+unq_lnk).html(anc);
          }
        });
        return false;
    });

    $('#embed').on('submit', function(e) {
        st=false;
        var name=$("#embed input[name=name]").val();
        var post_id=$("#embed input[name=post_id]").val();
        var eml=$("#embed input[name=email]").val();
        var phone=$("#embed input[name=custom_Mobile_Phone_Number]").val();
        eml=$.trim(eml);
        phone=$.trim(phone);
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(regex.test(eml)){
            var regx = /^\d{10}$/;
            var form = this,
                $form = $(form);
            $("#embed input[name=add_patient_db]").prop('disabled', true);
            $.ajax({
                async: true,
                url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                type: 'POST',
                data: "action=add_patient_db"+"&post_id="+post_id+"&name="+name+"&email="+eml+"&phone="+phone+"&add_patient_db=1",
                success: function(data) {
                    var dt=$.trim(data);
                    if(dt!='no'){
                        if(dt=='noops'){
                            alert('Please enter a valid phone number');
                        }
                        else{
                            window.location = window.location
                        }
                    }
                    else{
                        alert('You have already used this Email to sign up for this study.');
                        $("#embed input[name=add_patient_db]").prop('disabled', false);
                    }
                }
            });
        }
        else{
            alert('Please enter a valid email address');
            return false;
        }
        is_form_submitted = true;
        return st;
    });
    jQuery(document).on('click','.updateopo',function (){
        var post_id=jQuery("#note_data .add_p_id").val();
        jQuery("#fade").show();
        jQuery("#note_data").hide();
        jQuery("#note_data").html('');
        jQuery("#update_sub_details").html('<dl class="clinical_trial" style="border-bottom:none !important;"><dt style=" color:red; margin-top:10px;">Please wait, Update Details are loading.....</dt></dl>');
        //var post_id='<?php echo $results->id; ?>';
        //alert(post_id);
        jQuery("#update_sub_details").show();
        jQuery.ajax({
          async: true,
          url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
          type:'POST',
          data: "action=update_study&post_id="+ post_id + '&update_study_file=update_study_popup',
          success: function(html){
            jQuery("#update_sub_details").html(html);
          }
        });
  });

    jQuery(document).on('click','#close_update_popup',function (){

        var note_idd =  jQuery(this).attr('note_idd');
        var pid='<?php echo $pid;?>';
        jQuery("#note_data").html('<div class="col-xs-12  notes_right"><div class="row"><h2 style="text-decoration: underline">Notes  & Updates</h2></div><h5><div style="font-size: 20px; text-align: center; color:#f78e1e;font-weight:bold;">Please wait information are loading..</div></h5></div>');
        // var note_idd='<?php echo $pid;?>';
        jQuery("#fade").show();
        jQuery("#note_data").show();
        jQuery.ajax({
          async: true,
          url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
          type:'POST',
          data: "action=updatenote&post_id="+ note_idd +'&pid='+ pid + '&note_file=updatenote_data',
          success: function(html){

            jQuery("#note_data").html(html);
          }
        });
    });
    $(document).on('click','.closepopvideopat',function (){
        $("#fade").hide();
        $("#embed13").hide();
        $("#nts_div_vdo").html('<iframe style="padding-top: 25px;" width="800" height="415" src="https://www.youtube.com/embed/oZwY-UcdS2Y" frameborder="0" allowfullscreen></iframe>');
    });

</script>


<div id="fade" class="black_overlay"></div>
<?php


if (isset($_REQUEST['delete'])) {
  $delete = $_REQUEST['delete'];

  $query_delete = deletePatientDashboard($delete);
  if ($query_delete) {
    echo '
      <script>
        window.location.href ="'.$return_url.'"
      </script>';
  }
}
?>
<?php get_footer('dashboard');  ?>
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
  .xdsoft_datetimepicker{
    left:24% !important;
    top:12% !important;
    position:fixed !important;
  }
  h2.heading {
    background: #f78e1e none repeat scroll 0 0;
    color: #fff;
    font-family: alternate;
    font-size: 44px;
    margin: 0;
    padding: 5px;
    text-align: center;
    text-decoration: none;
  }
  .close_button {
    background: #00afef none repeat scroll 0 0;
    border: medium none;
    color: #fff;
    font-family: alternate;
    font-size: 33px;
    padding: 0 26px;
  }
  .pad_class span {
    margin: 0 5px 5px 3px !important;
  }
  .contact span {
    padding: 8px 4px !important;
  }
  .msgsenpop{

    height: 500px !important;
  }
  .msg_popupcls
  {
    left: 7.5% !important;
    top: 7% !important;
    width: 85% !important;

  }
  
</style>
