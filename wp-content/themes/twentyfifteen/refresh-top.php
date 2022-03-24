<?php
/*
* Template Name: TOP DASHBOARD REFRESH
*/
?>
<?php
$time_start = microtime(true);
session_start();
$cat_options=$_SESSION["cat_options"];
$search_for_patient = $_SESSION["search_for_patient"];
$search_for_study = $_SESSION["studysearch"];
$r_color=$_SESSION['color'];
$r_tier=$_SESSION['tier'];
$r_level=$_SESSION['level'];
$r_catname=$_SESSION['catname'];
$r_catname=stripslashes($r_catname);
$r_subscriberid = $_SESSION['ssponsorname'];
$active_inactive = $_SESSION['active_inactive'];
$check_vip=$_SESSION['check_vip'];
$color_sorting_ids=array();
$ord_hm=-1;
$color_sorting_ids=array();
if(isset($_SESSION["color_sorting_ids"])){
  $color_sorting_ids=$_SESSION["color_sorting_ids"];
}
$current_listing= $_SESSION["current_listing"];
$post_type= $_SESSION["post_type"];
$running_user_ID=get_current_user_id();
if(isset($_SESSION["user_ID"])){
  if($_SESSION["user_ID"] == ""){
    $user_ID = get_current_user_id();
  }
  else{
    $user_ID = $_SESSION["user_ID"];
  }
}
else{
  $user_ID = get_current_user_id();
}
if(isset($_SESSION["orderby"]) && !empty($_SESSION["orderby"]) || !empty($_SESSION["search_query"])){
  if($_SESSION["s"]=='d')
    $sort_hm='DESC';
  else
    $sort_hm='ASC';
  $search_for_patient = $_SESSION["search_for_patient"];
  $ord_hm =$_SESSION["orderby"];
}
$total_today=0;
$total_yesterday=0;
$running_total=0;
$total_red_clr=0;
$total_yellow_clr=0;
$total_green_clr=0;
$total_purple_clr=0;
$date = date('Y-m-d',strtotime('-4 hours'));
//$date ='2015-04-21';
$date_Y = date('Y-m-d',strtotime("-28 hours"));
//$date_Y ='2015-04-22';

$td_pst_ids=array();


if($active_inactive !="" || $r_subscriberid != "" || $r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || $check_vip == "vip"){
 //print_r("p1");
  //die("refresh1");
  $search_criteris_ids = $_SESSION["search_criteris_ids"] ;
  foreach($search_criteris_ids as $t_post){
    $td_pst_ids[]=$t_post;
  }
  $im_td_pst_ids=implode(",",$td_pst_ids);
  $query = $wpdb->get_results("SELECT campaign,post_id FROM 0gf1ba_subscriber_list WHERE post_id IN (".$im_td_pst_ids.") AND is_deleted != 1 and date LIKE '%$date%'");
  if($wpdb->num_rows){
    foreach($query as $t_pst){
      $Campaign = get_post_meta($t_pst->post_id, 'renewed',true );
      if($Campaign==$t_pst->campaign){
        $total_today=$total_today+1;
      }
    }
  }
}

$yt_pst_ids=array();
if($active_inactive !="" || $r_subscriberid != "" || $r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || $check_vip == "vip"){
  //print_r("p2"); 
  $search_criteris_ids = $_SESSION["search_criteris_ids"] ;
  foreach($search_criteris_ids as $t_post){
    $yt_pst_ids[]=$t_post;
  }
  $im_yt_pst_ids=implode(",",$yt_pst_ids);
  //$query = $wpdb->get_results("SELECT campaign,post_id FROM 0gf1ba_subscriber_list WHERE post_id IN (".$im_yt_pst_ids.") and date LIKE '%$date_Y%'");
  $query = $wpdb->get_results("SELECT s.campaign, s.post_id, pm.meta_value FROM 0gf1ba_subscriber_list as s JOIN 0gf1ba_postmeta as pm ON pm.post_id = s.post_id AND pm.meta_key = 'study_no' WHERE s.is_deleted != 1 AND STR_TO_DATE( date, '%Y-%m-%d' ) BETWEEN '$date_Y' AND '$date_Y' AND pm.meta_value != '' ");
  if($wpdb->num_rows){
    foreach($query as $t_pst){
      $Campaign = get_post_meta($t_pst->post_id, 'renewed',true );
      if($Campaign==$t_pst->campaign){
        $total_yesterday=$total_yesterday+1;
      }
    }
  }
}


$running_posts_arr=array();
$running_posts = $wpdb->get_results("SELECT 0gf1ba_posts.ID FROM 0gf1ba_posts INNER JOIN 0gf1ba_postmeta ON ( 0gf1ba_posts.ID = 0gf1ba_postmeta.post_id ) WHERE 1=1 AND ( ( 0gf1ba_postmeta.meta_key = 'project_manager_1' AND CAST(0gf1ba_postmeta.meta_value AS CHAR) = '$running_user_ID' ) OR ( 0gf1ba_postmeta.meta_key = 'project_manager_2' AND CAST(0gf1ba_postmeta.meta_value AS CHAR) = '$running_user_ID' ) OR ( 0gf1ba_postmeta.meta_key = 'project_manager_3' AND CAST(0gf1ba_postmeta.meta_value AS CHAR) = '$running_user_ID' ) ) AND 0gf1ba_posts.post_type = 'post' AND ((0gf1ba_posts.post_status IN ('publish','private'))) GROUP BY 0gf1ba_posts.ID");
if($wpdb->num_rows){
  //print_r("p2-2");
  //$time_start = microtime(true);
  foreach($running_posts as $r_post){
    if($r_post->ID !=""){
      $running_posts_arr[]=$r_post->ID;
    }
  }
  $running_post_ids=implode(",",$running_posts_arr);
  $num_running=$wpdb->get_results("SELECT COUNT('id') as num_running FROM 0gf1ba_subscriber_list WHERE post_id IN (".$running_post_ids.") AND is_deleted != 1");
  foreach($num_running as $run_num){
    $running_total=$run_num->num_running;
  }
}
$top_labels=array();
$top_labels['today_count']=$total_today;
$top_labels['yesterday_count']=$total_yesterday;
$top_labels['running_count']=$running_total;

$total_red_clr = $_SESSION['red_num'] != '' ? $_SESSION['red_num'] : 0;
$total_purple_clr = $_SESSION['purple_num'] != '' ? $_SESSION['purple_num'] : 0;
$total_green_clr = $_SESSION['green_num'] != '' ? $_SESSION['green_num'] : 0;
$total_yellow_clr = $_SESSION['yellow_num'] != '' ? $_SESSION['yellow_num'] : 0;

$cnt_tier_1=$_SESSION['tr1_num'] != '' ? $_SESSION['tr1_num'] : 0;
$cnt_tier_2=$_SESSION['tr2_num'] != '' ? $_SESSION['tr2_num'] : 0;
$cnt_tier_3=$_SESSION['tr3_num'] != '' ? $_SESSION['tr3_num'] : 0;
$cnt_tier_4=$_SESSION['tr4_num'] != '' ? $_SESSION['tr4_num'] : 0;

$active_no = $_SESSION['active_no'];
$inactive_no = $_SESSION['inactive_no'];

$total_tier=$cnt_tier_1+$cnt_tier_2+$cnt_tier_3+$cnt_tier_4;
$total_color=$total_red_clr+$total_purple_clr+$total_green_clr+$total_yellow_clr;
$top_labels['color_total']=$total_color;

$total_color = ( $total_color == 0 ) ? 99999999999 : $total_color;
$total_tier = ( $total_tier == 0 ) ? 99999999999 : $total_tier;
$top_labels['red_count']=$total_red_clr ." | ".round(($total_red_clr*100/$total_color),2)."%";
$top_labels['yellow_count']=$total_yellow_clr." | ".round(($total_yellow_clr*100/$total_color),2)."%";
$top_labels['green_count']=$total_green_clr." | ".round(($total_green_clr*100/$total_color),2)."%";
$top_labels['purple_count']=$total_purple_clr." | ".round(($total_purple_clr*100/$total_color),2)."%";
$top_labels['red_num']=$total_red_clr;
$top_labels['yellow_num']=$total_yellow_clr;
$top_labels['green_num']=$total_green_clr;
$top_labels['purple_num']=$total_purple_clr;

$top_labels['tr1_count']=$cnt_tier_1 ." | ".round(($cnt_tier_1*100/$total_tier),2)."%";
$top_labels['tr2_count']=$cnt_tier_2." | ".round(($cnt_tier_2*100/$total_tier),2)."%";
$top_labels['tr3_count']=$cnt_tier_3." | ".round(($cnt_tier_3*100/$total_tier),2)."%";
$top_labels['tr4_count']=$cnt_tier_4." | ".round(($cnt_tier_4*100/$total_tier),2)."%";
$top_labels['tr1_num']=$cnt_tier_1;
$top_labels['tr2_num']=$cnt_tier_2;
$top_labels['tr3_num']=$cnt_tier_3;
$top_labels['tr4_num']=$cnt_tier_4;
$top_labels['active_no']=$active_no;
$top_labels['inactive_no']=$inactive_no;
$_SESSION["top_lebels"]=$top_labels;
if($cat_options==1){
  $options_str='<option value="">Select Category</option>';
  if(!empty($cat_names_arr)){
    sort($cat_names_arr);
    foreach($cat_names_arr as $cat){
      $options_str.='<option value="'.$cat.'">'.$cat.'</option>';
    }
  }
  $_SESSION["cat_options"]=0;
  $_SESSION["option_details"]=$options_str;
}
else{
  $options_str="no";
}
$top_labels['options_str']=$options_str;
//print_r(number_format(microtime(true) - $time_start, 10));
echo json_encode($top_labels);
?>