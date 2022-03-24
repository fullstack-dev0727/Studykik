<?php
/*
 * Template Name: Reward Point
 */
//die;
$wpdb->query($wpdb->prepare("INSERT INTO `cron_testing`(`id`, `name`) VALUES (NULL,'rewards cron working from live server')",array()));
$datetime = new DateTime();
$datetime->modify('-1 day');
$dt=$datetime->format('Ymd');
$datetime = new DateTime();
$todt=$datetime->format('Ymd');
$queryArgs = array(
    'post_type'=>  'post',
    'posts_per_page' => -1,
    'post_status' => array('publish', 'draft', 'pending','private'),
    'meta_query'=> array(
	    array(
		    'key'=> 'study_end_date',
		    'value' => $dt,
		    'compare' 	=> '='
	    )
    )
);
$results=query_posts($queryArgs);
while (have_posts()) : the_post();
    $idd=$post->ID;
    $last_update=$post->cron_point_date;
    if($last_update != $todt){
	$exposure_level = get_post_meta($post->ID, 'exposure_level',true);
	if($exposure_level=='Platinum' || $exposure_level=='Gold' || $exposure_level=='Diamond'){
	    $rto=0;
	    $campaign = get_post_meta( $add_p_id, 'renewed', true );
	    if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
		$sub_results=$wpdb->get_results( "SELECT id,row_num FROM 0gf1ba_subscriber_list WHERE post_id = '$idd' AND is_deleted != 1");
	    }
	    else{
		$sub_results=$wpdb->get_results( "SELECT id,row_num FROM 0gf1ba_subscriber_list WHERE post_id = '$idd' and campaign = '$Campaign' AND is_deleted != 1");
	    }
	    $rto = $wpdb->num_rows;
	    if($rto >0){
		$req_reco=(($rto*90)/100);
		$moved=0;
		if(!empty($sub_results)){
		    foreach($sub_results as $res ) {
			$num = $res->row_num;
			if($num==1){
			}
			else {
			    $moved=$moved+1;
			}
		    }
		}
		if($moved >= $req_reco){
		    $pts=0;
		    if($exposure_level=='Platinum'){
			$pts=150;
		    }
		    if($exposure_level=='Gold'){
			$pts=50;
		    }
		    if($exposure_level=='Diamond'){
			$pts=300;
		    }
		    $author_id=$post->post_author;
		    $rewards_datetime = date('Y-m-d H:i:s',strtotime('-4 hours'));
		    $result1=mysql_query("SELECT `balance` FROM `0gf1ba_rewards_details` WHERE user_id='$author_id' and is_last=1  ORDER BY `id` DESC LIMIT 1");
		    $balance = 0;
		    while($row = mysql_fetch_assoc($result1)) {
			$balance=$row["balance"];
		    }
		    if($balance == 0){
		       $new_balance=$pts;
		    }
		    else{
		       $new_balance=$pts+$balance;
		    }
		    $boost_type2='Fill out enrollment data ('.$exposure_level.')';
            $is_rewards_allowed = get_user_meta($author_id, 'rewards_allowed', true);
            if ((bool) $is_rewards_allowed){
                mysql_query("UPDATE 0gf1ba_rewards_details SET is_last=0 WHERE user_id='$author_id'");
                $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_rewards_details`(`id`, `user_id`, `activity_of_points`,`rewards_date_time`,`credit`,`debit`,`balance`,`is_last`) VALUES (NULL,'$author_id','$boost_type2','$rewards_datetime','$pts',0,'$new_balance',1)",array()));
                update_user_meta($author_id, 'rewards', $new_balance);
            }
            $table = "0gf1ba_posts";
		    $data_array = array('cron_point_date' => $todt);
		    $where = array('ID' => $idd);
		    $wpdb->update( $table, $data_array, $where);
		}
	    }
	}
    }
endwhile;
?>