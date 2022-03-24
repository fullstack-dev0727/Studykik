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
* Template Name: Current Patient Stats Dashboard
*/
?>
<?php

// ************************************print csvfile************************ //
if(isset($_REQUEST['get_csv_file'])){
    $max_count = 0;
    $post_status = array('publish','private');

    if ($_REQUEST['list'] == 'active') {
        $post_status = 'publish';
    } else if ($_REQUEST['list'] == 'inactive') {
        $post_status = 'private';
    }
  //echo "GD: ",  extension_loaded('gd') ? 'OK' : 'MISSING', '<br>';
  if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');
  /** Include PHPExcel */
  require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
  // Create new PHPExcel object
  $objPHPExcel = new PHPExcel();
  // Set document properties
  $objPHPExcel->getProperties()->setCreator("StudyKIK Team")
    ->setLastModifiedBy("StudyKIK Team")
    ->setTitle("Download Patient Stats Report")
    ->setSubject("Download Patient Stats Report")
    ->setDescription("Download Patient Stats Report")
    ->setKeywords("Download Patient Stats Report")
    ->setCategory("Download Patient Stats Report");
  // Add some data
  $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A6', ' SITE NAME ')
    ->setCellValue('B6', ' PI Name ')
    ->setCellValue('C6', ' REFERRALS ')
    ->setCellValue('D6', ' CONTACTED ')
    ->setCellValue('E6', ' % ')
    ->setCellValue('F6', ' NOT CONTACTED ')
    ->setCellValue('G6', ' % ')
    ->setCellValue('H6', ' SCHEDULED ')
    ->setCellValue('I6', ' % ')
    ->setCellValue('J6', ' CONSENTED ')
    ->setCellValue('K6', ' % ')
    ->setCellValue('L6', ' RANDOMIZED ')
    ->setCellValue('M6', ' % ')
    ->setCellValue('N6', ' DNQ ')
    ->setCellValue('O6', ' % ');
  $objPHPExcel->getActiveSheet()->getStyle('A6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );
  $objPHPExcel->getActiveSheet()->getStyle('B6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );
  $objPHPExcel->getActiveSheet()->getStyle('C6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );
  $objPHPExcel->getActiveSheet()->getStyle('D6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('E6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('F6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('G6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('H6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('I6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('J6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('K6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('L6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('M6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('N6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('O6')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );
  // Miscellaneous glyphs, UTF-8
  $file = 'StudyKIK_Patient_Report.csv';
  //$query2 = ("SELECT * FROM 0gf1ba_subscriber_list where post_id=$aaa");
  //$get_results = $wpdb->get_results($query2);
  //$total_count = count($get_results);
  $i = 7;
  $featured = new WP_Query( array(
    'post_type' => 'post',
    'post_status' => $post_status,
    'posts_per_page'  => -1,
    'ignore_sticky_posts' => 1,
    'fields'=>'id=>parent',
    'meta_query' => array(
      'relation' => 'OR',
      array(
        'key' => 'user_id_add_user_id_to_assign_this_post_to_stats',
        'value' => $user_ID,
        'compare' => '=',
      ),
      array(
        'key' => 'subscriber',
        'value' => $user_ID,
        'compare' => '='
      ),
    )
  ) );
  $pst_ids=array();
  $post_allids=array();
  while ( $featured->have_posts() ) : $featured->the_post();
    $post_id=$post->ID;
    $pst_ids[]=$post_id;
    $post_allids[$post_id]['referal']=0;
    $post_allids[$post_id]['patient_referal']=0;
    $post_allids[$post_id]['not_qualified']=0;
    $post_allids[$post_id]['scheduled']=0;
    $post_allids[$post_id]['consented']=0;
    $post_allids[$post_id]['randomized']=0;
    $site_name=get_post_meta( $post->ID, 'name_of_site', true );
    $post_allids[$post_id]['sitename']=$site_name;

    $all_results=$wpdb->get_results("SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post_id' and row_num = '3'");
    $notes_ids=array();
    $k=1;
    foreach($all_results as $subs){
        $notes_ids[$k]=$subs->id;
        $k++;
    }
    $note_arr = array();
    if(!empty($notes_ids)){
      $im_notes_ids=implode(",",$notes_ids);
      $query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id IN (".$im_notes_ids.") order by note_id ASC, id DESC", OBJECT );

      if($wpdb->num_rows){
          $nonotes=0;
          $pre_note_id=0;
          $cnt=1;
          $message = "";
          foreach($query_notes as $kn => $results_notes){
              $nkn=$kn+1;
              if(isset($query_notes[$nkn])){
                  $nid=$query_notes[$nkn]->note_id;
              }
              else{
                  $nid=0;
              }
              if($pre_note_id != $results_notes->note_id){
                  if ($message != "")
                      $note_arr[] = $message;
                  $message = 'Patient # '.$cnt.' ('.$site_name.")\n";
                  $cnt=$cnt+1;
              }
              $pre_note_id=$results_notes->note_id;
              $message .= date('m-d-Y, h:i:s A',strtotime(str_replace("?","",$results_notes->notes_date))) . "\n";
              $message .= $results_notes->notes."\n";
          }
          if ($message != "")
              $note_arr[] = $message;
      }
    }
    $post_allids[$post_id]['notes']=$note_arr;
    if ($max_count < count($note_arr)) {
        $max_count = count($note_arr);
    }

  endwhile; wp_reset_query();
  if(empty($pst_ids)){
    $pst_ids[]=-1;
  }
  $all_ids=implode(",",$pst_ids);
  $subscriber_total = $wpdb->get_results("SELECT id,row_num,post_id FROM 0gf1ba_subscriber_list WHERE post_id IN ( $all_ids) AND is_deleted != 1", OBJECT);
  if($subscriber_total){
    $referal_totals_1=0;
    $Patient_Referrals_1=0;
    $Scheduled_1=0;
    $Consented_1=0;
    $Randomized_1=0;
    $Not_Qualified_1=0;
    $referal_totals_1=$wpdb->num_rows;
    foreach($subscriber_total as $subscriber){
      $post_id = $subscriber->post_id;
      $row_num = $subscriber->row_num;
      $post_allids[$post_id]['referal']+= 1;
      if($row_num==1){
        $post_allids[$post_id]['patient_referal'] += 1;
        $Patient_Referrals_1+=1;
      }
      if($row_num==3){
        $post_allids[$post_id]['not_qualified'] += 1;
        $Not_Qualified_1+=1;
      }
      if($row_num==4){
        $post_allids[$post_id]['scheduled'] += 1;
        $Scheduled_1+=1;
      }
      if($row_num==5){
        $post_allids[$post_id]['consented'] += 1;
        $Consented_1+=1;
      }
      if($row_num==6){
        $post_allids[$post_id]['randomized'] += 1;
        $Randomized_1+=1;
      }
      $contacted_1 = $referal_totals_1-$Patient_Referrals_1;
    }

  }
  $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A7', '')
    ->setCellValue('B7', '')
    ->setCellValue('C7', $referal_totals_1)
    ->setCellValue('D7', $contacted_1)
    ->setCellValue('E7', number_format($contacted_1/$referal_totals_1*100,2).'%')
    ->setCellValue('F7', $Patient_Referrals_1)
    ->setCellValue('G7', number_format($Patient_Referrals_1/$referal_totals_1*100,2).'%')
    ->setCellValue('H7', $Scheduled_1)
    ->setCellValue('I7', number_format($Scheduled_1/$contacted_1*100,2).'%')
    ->setCellValue('J7', $Consented_1)
    ->setCellValue('K7', number_format($Consented_1/$contacted_1*100,2))
    ->setCellValue('L7', $Randomized_1)
    ->setCellValue('M7', number_format($Randomized_1/$contacted_1*100,2).'%')
    ->setCellValue('N7', $Not_Qualified_1)
    ->setCellValue('O7', number_format($Not_Qualified_1/$contacted_1*100,2).'%');
  $objPHPExcel->getActiveSheet()->getStyle('A7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );
  $objPHPExcel->getActiveSheet()->getStyle('B7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );
  $objPHPExcel->getActiveSheet()->getStyle('C7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );
  $objPHPExcel->getActiveSheet()->getStyle('D7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );
  $objPHPExcel->getActiveSheet()->getStyle('E7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );
  $objPHPExcel->getActiveSheet()->getStyle('F7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('G7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );
  $objPHPExcel->getActiveSheet()->getStyle('H7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('I7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('J7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('K7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('L7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('M7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('N7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );

  $objPHPExcel->getActiveSheet()->getStyle('O7')->getAlignment()->applyFromArray(
    array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'   => 0,
      'wrap'       => true
    )
  );
  $len=0;
    $x = 'O';
  foreach($post_allids as $pst => $pstdata){
    $i++;
    $referal_totals_2=$pstdata['referal'];
    $Patient_Referrals_2=$pstdata['patient_referal'];
    $Scheduled_2=$pstdata['scheduled'];
    $Consented_2=$pstdata['consented'];
    $Randomized_2=$pstdata['randomized'];
    $Not_Qualified_2=$pstdata['not_qualified'];
    $PI_text = get_post_meta( $pst, 'primary_investigator', true );
    $post_link=post_permalink($pst);
    $site_name=$pstdata['sitename'];
    $contacted_2 = $referal_totals_2-$Patient_Referrals_2;
    $ln=strlen($site_name);
    if($ln > $len){
      $len=$ln;
    }
    $objPHPExcel->setActiveSheetIndex(0)
      ->setCellValue('A'.$i, $site_name)
      ->setCellValue('B'.$i, $PI_text)
      ->setCellValue('C'.$i, $referal_totals_2)
      ->setCellValue('D'.$i, $contacted_2)
      ->setCellValue('E'.$i, number_format($contacted_2/$referal_totals_2*100,2).'%')
      ->setCellValue('F'.$i, $Patient_Referrals_2)
      ->setCellValue('G'.$i, number_format($Patient_Referrals_2/$referal_totals_2*100,2).'%')
      ->setCellValue('H'.$i, $Scheduled_2)
      ->setCellValue('I'.$i, number_format($Scheduled_2/$contacted_2*100,2).'%')
      ->setCellValue('J'.$i, $Consented_2)
      ->setCellValue('K'.$i, number_format($Consented_2/$contacted_2*100,2))
      ->setCellValue('L'.$i, $Randomized_2)
      ->setCellValue('M'.$i, number_format($Randomized_2/$contacted_2*100,2).'%')
      ->setCellValue('N'.$i, $Not_Qualified_2)
      ->setCellValue('O'.$i, number_format($Not_Qualified_2/$contacted_2*100,2).'%');
    $x = 'O';
    foreach($pstdata['notes'] as $note) {
        $x ++;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($x.$i, $note);

        $objPHPExcel->getActiveSheet()->getStyle($x.$i)->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation'   => 0,
                'wrap'       => true
            )
        );
    }
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );
    $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );
    $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );
    $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );
    $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );
    $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );

    $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );

    $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );

    $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );

    $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );

    $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );

    $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );

    $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );

    $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );

    $objPHPExcel->getActiveSheet()->getStyle('O'.$i)->getAlignment()->applyFromArray(
      array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'       => true
      )
    );
  }
  $styleArray = array(
    'font'  => array(
      'bold'  => true,
      'color' => array('rgb' => '000000'),
      'size'  => 12,
    ));
  $objPHPExcel->getActiveSheet()->mergeCells('A1:A4');
  $objPHPExcel->getActiveSheet()->getStyle('A6:O6')->applyFromArray($styleArray);
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

  $x = 'O';
  for ($i = 0; $i < $max_count; $i ++) {
    $x ++;
    $objPHPExcel->getActiveSheet()->getColumnDimension($x)->setAutoSize(true);
  }
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
  $objPHPExcel->getActiveSheet()->setTitle('Download Patient Stats Report');
  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);
  $file = 'StudyKIK_Patient_Stats_Report.xlsx';
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
  /*var_dump("aaaaa");*/ exit;
  exit;
}
/*==================== END ================================*/

?>
<?php get_header('dashboard');?>
 
<style>
.col-xs-12.col-sm-4.col-md-4{min-height: 480px;}
dl{
  margin-bottom:2px !important;
}
</style>
<link href="<?php bloginfo('template_url');?>/css/patientStats.css" rel="stylesheet">
<div id="banner_login">
  <div class="container">
    <div class="row">
      <div class="dashboard_banner">
        <header id="top">
          <h1><img src="<?php bloginfo('template_url');?>/images-dashboard/logout_logo.png" alt=""></h1>
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav sponsor" style="margin:0 10%;width:80%">
                <li style="border-right:none;margin-left:13%"><a href="<?php bloginfo('url');?>/study-patient-stats-dashboard/" style="margin-top: 12px; color:#00afef;">HOME </a></li>

                 <li style="margin-left:53%;padding-right:0px;">
                  <a target="_blank" href="<?php bloginfo('url');?>/clinical-trial-patient-recruitment-patient-enrollment/" >LIST <br>ANOTHER STUDY</a>
                </li>
              </ul>
              </div>
              <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
          </nav>
          <div class="project_manager">
            <h5>Stud<small>y</small><cite>KIK</cite> Project Manager: <span><?php echo get_user_meta($user_ID, 'project_manager', true); ?></span> - <span><?php echo get_user_meta($user_ID, 'phone_number', true); ?></span></h5>
          </div>
        </header>
      </div>
    </div>
    <div class="row">
      <section class="container_current">
                            <?php
                                                        $publishcn=0;
                                                        $private_cn=0;
                                                        $total_cn=0;

                                                        $post_status = array('publish','private');

                                                        if ($_REQUEST['list'] == 'active') {
                                                          $post_status = 'publish';
                                                        } else if ($_REQUEST['list'] == 'inactive') {
                                                          $post_status = 'private';
                                                        }
                                                $featured = new WP_Query( array(
                                                        'post_type' => 'post',
                                                        'post_status' => $post_status,
                                                        'posts_per_page'  => -1,
                                                        'ignore_sticky_posts' => 1,
                                                        'fields'=>'id=>parent',
                                                        'meta_query' => array(
                                                                'relation' => 'OR',
                                                                array(
                                                                        'key' => 'user_id_add_user_id_to_assign_this_post_to_stats',
                                                                        'value' => $user_ID,
                                                                        'compare' => '=',
                                                                ),
                                                                array(
                                                                        'key' => 'subscriber',
                                                                        'value' => $user_ID,
                                                                        'compare' => '='
                                                                ),
                                                        )
                )   );
                $pst_ids=array();
                $post_allids=array();
                while ( $featured->have_posts() ) : $featured->the_post();
                  $post_id=$post->ID;
                  $pst_ids[]=$post_id;
                  $post_allids[$post_id]['referal']=0;
                  $post_allids[$post_id]['patient_referal']=0;
                  $post_allids[$post_id]['not_qualified']=0;
                  $post_allids[$post_id]['scheduled']=0;
                  $post_allids[$post_id]['consented']=0;
                  $post_allids[$post_id]['randomized']=0;
                  $site_name=get_post_meta( $post->ID, 'name_of_site', true );
                  $post_allids[$post_id]['sitename']=$site_name;
                                                                          $sts=get_post_status($post_id);
                                                                            if($sts=='publish'){
                                                                    $publishcn=$publishcn+1;
                                                                }
                                                                if($sts=='private'){
                                                                    $private_cn=$private_cn+1;
                                                                }
                                                                $total_cn=$total_cn+1;
                endwhile; wp_reset_query();
                if(empty($pst_ids)){
                  $pst_ids[]=-1;
                }
                $tl_pst=count($pst_ids);
                $all_ids=implode(",",$pst_ids);
                ?>
                <?php
                $subscriber_total = $wpdb->get_results("SELECT id,row_num,post_id FROM 0gf1ba_subscriber_list WHERE post_id IN ( $all_ids) AND is_deleted != 1", OBJECT);
                if($subscriber_total){
                  $referal_totals_1=0;
                  $Patient_Referrals_1=0;
                  $Scheduled_1=0;
                  $Consented_1=0;
                  $Randomized_1=0;
                  $Not_Qualified_1=0;
                  $referal_totals_1=$wpdb->num_rows;
                  $i = 0;
                  $no_notes="";
                  $nt_contacted=array();
                  $nt_contacted_subs=array();
                  foreach($subscriber_total as $subscriber){
                    $aaa_ID = $subscriber->id;
                    $post_id = $subscriber->post_id;
                    $row_num = $subscriber->row_num;
                    $post_allids[$post_id]['referal']+= 1;
                    if($row_num==1){
                      $post_allids[$post_id]['patient_referal'] += 1;
                      $Patient_Referrals_1+=1;
                    }
                    if($row_num==3){
                      $post_allids[$post_id]['not_qualified'] += 1;
                      $Not_Qualified_1+=1;
                      $nt_contacted[$aaa_ID]=$post_allids[$post_id]['sitename'];
                      $nt_contacted_subs[]=$aaa_ID;
                    }
                    if($row_num==4){
                      $post_allids[$post_id]['scheduled'] += 1;
                      $Scheduled_1+=1;
                    }
                    if($row_num==5){
                      $post_allids[$post_id]['consented'] += 1;
                      $Consented_1+=1;
                    }
                    if($row_num==6){
                      $post_allids[$post_id]['randomized'] += 1;
                      $Randomized_1+=1;
                    }
                  }
                }
                $_SESSION['subs_site_name']=$nt_contacted;
                $_SESSION['subs_not_contacted']=$nt_contacted_subs;
                ?>
        <div class="patient_stats">
                <div>   
            <!--<iframe style="margin-left:285px ;   padding-top: 25px;" width="560" height="315" src="https://www.youtube.com/embed/F1B4yQJv5bg" frameborder="0" allowfullscreen></iframe>-->
          <div style="float: left; width: 85%;">
            <select name="active_inactive" class="select_color" id="active_inactive">
              <option value="" <?php if (!isset($_REQUEST['list'])) { ?> selected="selected" <?php } ?>>Active/Inactive</option>
              <option value="active" <?php if ($_REQUEST['list'] == 'active') { ?> selected="selected" <?php } ?>>Active</option>
              <option value="inactive" <?php if ($_REQUEST['list'] == 'inactive') { ?> selected="selected" <?php } ?>>Inactive</option>
            </select>
            <p id="slt_study"><?php echo get_the_author_meta('number_of_sites', $user_ID);?></p>
            <div class="heading">CURRENT STUDY PATIENT STATS</div>
          </div>
          <div style="width: 15%; text-align: right; float: left; margin-top: 13px;">
            <span style="color: rgb(246, 141, 32); font: 18px helveticaregular ! important;">
                            Active Sites:
                            <span style="color:#00aff0;">&nbsp;<?php echo $publishcn;?></span>
                        </span>
            <span style="color: rgb(246, 141, 32); font: 18px helveticaregular ! important;">
                            Inactive Sites:
                            <span style="color:#00aff0;">&nbsp<?php echo $private_cn;?></span>
                        </span>
                        <span style="font: 18px helveticaregular ! important; color: rgb(246, 141, 32);">
                            Total Sites:
              <span style="color:#00aff0;">&nbsp<?php echo $total_cn;?></span>
                        </span>
                    </div>
        </div>
        

            <table class="table table-hover" border="1" bordercolor="#dddddd">
              <thead>
              <tr class="DNQ">
                <td class="DNQ">REFERRALS</td>
                <td class="DNQ">CONTACTED</td>
                <td class="DNQ">NOT CONTACTED</td>
                <td class="DNQ">SCHEDULED </td>
                <td class="DNQ">CONSENTED</td>
                <td class="DNQ">RANDOMIZED</td>
                <td class="DNQ">DNQ</td>
              </tr>
              <tr>

                <td class="contancted" rowspan="2"><?php echo $referal_totals_1; ?></td>
                <td class="contancted">
                  <?php echo $contacted_1 = $referal_totals_1-$Patient_Referrals_1; ?> <br/>
                  <span style="color: #959ca1;font: 16px helveticaregular;">(<?php echo number_format($contacted_1/$referal_totals_1*100,2);?>%)</span>
                </td>
                <td class="contancted">
                    <?php echo $Patient_Referrals_1; ?> <br/>
                    <span style="color: #959ca1;font: 16px helveticaregular;">(<?php echo number_format($Patient_Referrals_1/$referal_totals_1*100,2);?>%)</span>
                </td>
                <td class="contancted">
                  <?php echo $Scheduled_1; ?> <br/>
                  <span style="color: #959ca1;font: 16px helveticaregular;">(<?php echo number_format($Scheduled_1/$contacted_1*100,2);?>%)</span>
                </td>
                <td class="contancted">
                  <?php echo $Consented_1; ?> <br/>
                  <span style="color: #959ca1;font: 16px helveticaregular;">(<?php echo number_format($Consented_1/$contacted_1*100,2);?>%)</span>
                </td>
                <td class="contancted">
                  <?php echo $Randomized_1; ?> <br/>
                  <span style="color: #959ca1;font: 16px helveticaregular;">(<?php echo number_format($Randomized_1/$contacted_1*100,2);?>%)</span>
                </td>
                <td class="contancted">
                  <?php echo $Not_Qualified_1; ?> <br/>
                  <span style="color: #959ca1;font: 16px helveticaregular;">(<?php echo number_format($Not_Qualified_1/$contacted_1*100,2);?>%)</span>
                </td>
              </tr>
            </thead>
          </table>
          <div class="row">
            <div class="col-md-10">
              <div class="row">&nbsp;</div><div class="row">&nbsp;</div>
              <div class="Individual">
                <span>INDIVIDUAL SITE TOTALS</span>
              </div>
              <div class="row" style="float: left; width: 100%; margin-top: 36px; margin-bottom: 26px;">
  <a href="javascript:void(0);" onclick="document.getElementById('embed13').style.display='block';document.getElementById('fade').style.display='block'" class="questionchange_view"><img src="<?php echo get_template_directory_uri(); ?>/images/watch-tutorial-button.png"></a>
</div>
            </div>
            
            <div class="col-md-2">
              <a class="change_view" href="<?php bloginfo('url');?>/current-study-patient-stats-change-view/"><img src="<?php bloginfo('template_url');?>/images-dashboard/change_view.png" alt=""></a>
              <div class="row" style="float: left; width: 100%; margin: 8px 0px;">
                <a class="change_view" onclick="document.getElementById('embed4').style.display='block';document.getElementById('fade').style.display='block'"  href="javascript:void(0);"><img src="<?php bloginfo('template_url');?>/images-dashboard/view_all.png" alt=""></a>
              </div>
              <div class="row" style="float: left; width: 100%; margin:3px 0 8px;">
                <a class="change_view" href="<?php echo get_permalink( 16673 );?>?get_csv_file=csv&list=<?=$_REQUEST['list']?>"><img src="<?php bloginfo('template_url');?>/images-dashboard/downlode_report.png" alt=""></a>
              </div>
            </div>
          </div>

          <?php
          foreach($post_allids as $pst => $pstdata){
            $referal_totals_2=$pstdata['referal'];
            $Patient_Referrals_2=$pstdata['patient_referal'];
            $Scheduled_2=$pstdata['scheduled'];
            $Consented_2=$pstdata['consented'];
            $Randomized_2=$pstdata['randomized'];
            $Not_Qualified_2=$pstdata['not_qualified'];
            $PI_text = get_post_meta( $pst, 'primary_investigator', true );
            $post_link=post_permalink($pst);
            $site_name=$pstdata['sitename'];
            ?>
            
            
            
            <div class="col-xs-12 col-sm-4 col-md-4">
              <div class="EXCELL">
                <h3 class="research"><a target="_blank" style="color:#fff;" href="<?php echo $post_link; ?>"><?php echo $site_name; ?> <?php if($PI_text){ echo" - ".$PI_text; } ?> <?php if ( get_post_status ($pst ) == 'private' ) {
                  echo '(Inactive)';
                  }
                  ?></a>
                </h3>
                <div class="research_form">
                  <h4 class="referrals_left">Referrals</h4>
                  <h5 class="referrals_right"><?php echo $referal_totals_2; ?></h5>
                </div>
                <div class="research_form">
                  <h4 class="referrals_left">Contacted</h4>
                  <h5 class="referrals_right"><?php echo $contacted_2 = $referal_totals_2-$Patient_Referrals_2; ?> <span style="color:#9fcf67">|</span> <?php echo number_format($contacted_2/$referal_totals_2*100,2);?>%</h5>
                </div>
                <div class="research_form">
                  <h4 class="referrals_left">Not Contacted</h4>
                  <h5 class="referrals_right">
                    <?php if($Patient_Referrals_2){echo $Patient_Referrals_2;}else{echo '0';} ?>
                    <span style="color:#9fcf67">|</span> <?php echo number_format($Patient_Referrals_2/$referal_totals_2*100,2);?>%
                  </h5>
                </div>
                <div class="research_form">
                  <h4 class="referrals_left">Scheduled</h4>
                  <h5 class="referrals_right">
                    <?php if($Scheduled_2){echo $Scheduled_2;}else{echo '0';} ?>
                    <span style="color:#9fcf67">|</span> <?php echo number_format($Scheduled_2/$contacted_2*100,2);?>%
                  </h5>
                </div>
                <div class="research_form">
                  <h4 class="referrals_left">Consented</h4>
                  <h5 class="referrals_right">
                    <?php if($Consented_2){echo $Consented_2;}else{echo '0';} ?>
                    <span style="color:#9fcf67">|</span> <?php echo number_format($Consented_2/$contacted_2*100,2);?>%
                  </h5>
                </div>
                <div class="research_form">
                  <h4 class="referrals_left">Randomized</h4>
                  <h5 class="referrals_right">
                    <?php if($Randomized_2){echo $Randomized_2;}else{echo '0';} ?>
                    <?php if($contacted_2 > 0) { ?>
                    <span style="color:#9fcf67">|</span> <?php echo number_format($Randomized_2/$contacted_2*100,2);?>%
                    <?php } ?>
                  </h5>
                </div>
                <div class="research_form">
                  <h4 class="referrals_left">DNQ
                    <button pst_id="<?php echo $pst; ?>" style="padding:0px; float:right; width:auto;" class="patient_btn patdnq"><img src="<?php bloginfo('template_url');?>/images-dashboard/view_btn.png"></button>
                  </h4>
                  <h5 class="referrals_right">
                    <?php if($Not_Qualified_2){echo $Not_Qualified_2;}else{echo '0';} ?>
                    <span style="color:#9fcf67">|</span> <?php echo number_format($Not_Qualified_2/$contacted_2*100,2);?>%
                  </h5>
                </div>
              </div>
            </div>
          <?php }
          ?>
        </div>
      </section>
    </div>
  </div>
</div>
<div id="embed13" class="white_content asd" style="cursor: auto; display: none;width:65% !important;left:17.5% !important;top:11.5% !important;;" >
    <div class="col-xs-12 col-md-12 notes_left">
        <div class="row">
          <h2>MyStudyKIK Portal</h2>
        </div>
        <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area" id="nts_div_video" style="text-align:center;height:425px!important;margin-bottom:15px;">
    
         <iframe style="padding-top: 25px;" width="800" height="415" src="https://www.youtube.com/embed/F1B4yQJv5bg" frameborder="0" allowfullscreen></iframe>
           
        </div>
    </div>
    <a class="closepopvideo" href="javascript:void(0);">Close</a>
</div>

<div id="embed3" class="white_content asd" style="cursor: auto; display: none;">
    <div class="col-xs-12 col-md-12 notes_left">
        <div class="row">
          <h2>NOTES</h2>
        </div>
        <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area" id="nts_div">
            <dl class="clinical_trial" id="dnq_nts">
            </dl>
        </div>
    </div>
    <a class="closepop" href="javascript:void(0);" onclick="document.getElementById('embed3').style.display='none';document.getElementById('fade').style.display='none';">Close</a>
</div>
<div id="embed4" class="white_content asd" style="cursor: auto; display: none;">
    <div class="col-xs-12 col-md-12 notes_left">
        <div class="row">
          <h2>NOTES</h2>
        </div>
        <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area" id="em4_div">
        </div>
    </div>
    <a class="closepop" href="javascript:void(0);" onclick="document.getElementById('embed4').style.display='none';document.getElementById('fade').style.display='none';">Close</a>
</div>
<div class="black_overlay" id="fade" style="display: none;"></div>
<?php $_SESSION['all_dnq_count']=1;?>
<script>
  jQuery(".patdnq").live('click',function(){
  jQuery("#fade").show();
  post_id=jQuery(this).attr('pst_id');
  jQuery("#nts_div").html('<dl class="clinical_trial"><dt style=" color:red; margin-top:10px;">Please wait, notes are loading...</dt></dl>');
  jQuery("#embed3").show();
  jQuery.ajax({
    async: true,
    url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
    type:'POST',
    data: "action=dashboard_dnq&post_id="+ post_id + '&loop_file=dashboard_notes',
    success: function(html){
      jQuery("#nts_div").html(html);
    }
  });



});
</script>

<script>
  jQuery(".patall").live('click',function(){
  jQuery("#fade").show();
  post_id=jQuery(this).attr('pst_id');
  jQuery("#nts_div").html('<dl class="clinical_trial"><dt style=" color:red; margin-top:10px;">Please wait, notes are loading...</dt></dl>');
  jQuery("#embed3").show();
  jQuery.ajax({
    async: true,
    url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
    type:'POST',
    data: "action=dashboard_dnq&post_id="+ post_id + '&loop_file=dashboard_notes&stats=all',
    success: function(html){
      jQuery("#nts_div").html(html);
    }
  });
});
jQuery(".closepopvideo").live('click',function(){
  jQuery("#fade").hide();
  jQuery("#embed13").hide();
  jQuery("#nts_div_video").html('<iframe style="padding-top: 25px;" width="800" height="415" src="https://www.youtube.com/embed/F1B4yQJv5bg" frameborder="0" allowfullscreen></iframe>');
});

  
</script>
<script>
  jQuery(window).load(function(){
    jQuery("#active_inactive").change(function(e) {
      if (jQuery(this).val() != "") {
        window.location.href = window.location.protocol + '//' + window.location.host + window.location.pathname + "?list=" + jQuery(this).val();
      } else {
        window.location.href = window.location.protocol + '//' + window.location.host + window.location.pathname;
      }
    });


    posts_arr = new Array();
    var inx=1;
    jQuery(".patdnq").each(function() {
      po_id=jQuery(this).attr('pst_id');
      posts_arr[inx]=po_id;
      inx=inx+1;
    });
    succ_arr = new Array();
    var loading  = false;
    var count = 1;
    var max_count = inx-1 ;
    var is_content=0;
    var ki=1;
    setInterval(function(){
      if(loading == false && count <= max_count){
        loading=true;
        post_id=posts_arr[count];
        jQuery.ajax({
          async: true,
          url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
          type:'POST',
          data: "action=dashboard_dnq&post_id="+ post_id + '&loop_file=dashboard_notes&user_id=<?php echo $user_ID;?>',
          success: function(html){
            html=jQuery.trim(html);
            if(html !=""){
              is_content=1;
              if(count==1){
                html=html+'<p id="tg1"></p>';
                jQuery("#em4_div").html(html);
              }
              else{
                var lki=ki-1;
                html=html+'<p id="tg'+ki+'"></p>';
                jQuery("#tg"+lki).html(html);
              }
              ki=ki+1;
            }
            if(count==max_count){
              if(is_content==0){
                jQuery("#em4_div").append('<dl class="clinical_trial"><dt style=" color:#00afef; margin-top:10px;">No Notes Yet!</dt></dl>');
              }
            }
            count=count+1;
            loading=false;
          }
        });
      }
    },500);
  });
  
  
  
jQuery( document ).ready(function() {
 
var userAgent = navigator.userAgent.toLowerCase(); 
     if (userAgent .indexOf('safari')!=-1){ 
        jQuery(".notes_left .row > h2").css('border-top-left-radius','10px');
    jQuery(".notes_left .row > h2").css('border-top-Right-radius','10px');
 
       
       }
     });
  
  
</script>
<style>
.black_overlay{height:100000px !important;}
</style>
<style>
.black_overlay{height:100000px !important;}
#slt_study {
    border: medium none;
    border-radius: 4px;
    color: #00afef;
    font: 30px helvetica_neueheavycond;
    margin-bottom: 0;
    margin-left: 34%;
    margin-top: 10px;
    padding: 0 28px;
    text-align: center;
    width: 50%;
}
.heading {
    margin-left: 19% !important;
    padding-bottom: 7px;
    padding-top: 0 !important;
    width: 80% !important;
}
.questionchange_view {
    color: red;
    margin-bottom: 5px;
    margin-left: 28px;
}
</style>
<?php
get_footer('dashboard');?>