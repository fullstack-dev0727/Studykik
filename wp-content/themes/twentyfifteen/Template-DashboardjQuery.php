    <?php

/*
Template Name: Jquery Dashboard
*/
?>
<?php

global $post, $wpdb;
$get_key = $_REQUEST['sticky'];
$data_sending = $_REQUEST['data_sending'];
$patid = $_REQUEST['id'];
$patpostid=  $_REQUEST['pid'];
$patquantity= $_REQUEST['quantity'];
$cam_val= $_REQUEST['cam_val'];
$schid= $_REQUEST['schid'];
$schtime= $_REQUEST['schtime'];
$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);
$user_roles = implode(', ', $user_info->roles);
$sel_val = "all";
if (isset($_REQUEST['sel_val'])) {
    $sel_val = $_REQUEST['sel_val'];
}

if($schid!='' && $schtime!='')
{
	$date_modify = date('Y-m-d H:i:s',strtotime('-4 hours'));
	$dt_modify = date('m-d-Y',strtotime('-4 hours'));
	$wpdb->query($wpdb->prepare("UPDATE 0gf1ba_subscriber_list SET schedule_time='$schtime',last_modify='$date_modify' WHERE id=$schid"));
	if($schtime !=""){
	    $tm=date("m-d-Y, h:i A", strtotime($schtime));
	}
	else{
	    $tm="";
	}
	$sub_results=$wpdb->get_results( "SELECT name FROM 0gf1ba_subscriber_list where id = $schid");
	$nm="";
	if(!empty($sub_results)){
		foreach($sub_results as $res ) {
			$nm=$res->name;
		}
	}
	$dt1=date("m-d-Y", strtotime($schtime));
	$tm1=date("h:i A", strtotime($schtime));
	echo $tm."@@@@".ucwords($nm)." is scheduled for ".$dt1." at ".$tm1."@@@@".$dt_modify;
}
else if($patid!='' && $patpostid!='' && $patquantity!='')
{
	$date_modify = date('Y-m-d H:i:s',strtotime('-4 hours'));
	$dt_modify = date('m-d-Y',strtotime('-4 hours'));
	if($patquantity =='nwPatients')
		  {
     $row_num=1;
	 }
	if($patquantity =='caPatients')
			  {
     $row_num=2;
	}
	if($patquantity =='nqPatients')
			  {
     $row_num=3;
	}
	if($patquantity =='anPatients')
			  {
     $row_num=7;
		     }
	if($patquantity =='shPatients')
	{
     $row_num=4;
		  }
	if($patquantity =='cnPatients')
		  {
     $row_num=5;
	}
	if($patquantity =='raPatients')
			  {
     $row_num=6;
			  }
    $prev_results=$wpdb->get_results( "SELECT row_num, post_id FROM 0gf1ba_subscriber_list where id = $patid");
	$wpdb->query($wpdb->prepare("UPDATE 0gf1ba_subscriber_list SET row_num=$row_num ,last_modify='$date_modify' WHERE id=$patid",array()));
    $wpdb->query($wpdb->prepare("INSERT INTO 0gf1ba_update_patient_row_log (user_id, from_num, to_num, patient_id, study_id) VALUES (%d, %d, %d, %d, %d)",$user_ID,$prev_results[0]->row_num,$row_num,$patid, $prev_results[0]->post_id));
	if($cam_val=='all'){
		$sub_results=$wpdb->get_results( "SELECT id,row_num FROM 0gf1ba_subscriber_list WHERE post_id = $patpostid AND is_deleted != 1");
	}
	else{
		$sub_results=$wpdb->get_results( "SELECT id,row_num FROM 0gf1ba_subscriber_list WHERE post_id = $patpostid and campaign ='$cam_val' AND is_deleted != 1");
	}
    add_to_update_log($patpostid);
    $num_1=0;
    $num_2=0;
    $num_3=0;
    $num_4=0;
    $num_5=0;
    $num_6=0;
    $num_7=0;
    $num_8=0;
    if(!empty($sub_results)){
	 //print_r($sub_results);
     foreach($sub_results as $res ) {
      $num = $res->row_num;

	   if($num==1){
       $num_1=$num_1+1;
}
      else if($num==2){
       $num_2=$num_2+1;
}
      else if($num==3){
       $num_3=$num_3+1;
}
      else if($num==4){
       $num_4=$num_4+1;
}
      else if($num==5){
       $num_5=$num_5+1;
}
      else if($num==6){
       $num_6=$num_6+1;
}
      else if($num==7){
       $num_7=$num_7+1;
}

}
	 echo $str=$num_1."@@".$num_2."@@".$num_3."@@".$num_7."@@".$num_4."@@".$num_5."@@".$num_6."@@"."Action Taken: ".$dt_modify;
}




}else
{
    $args = array();
if($get_key == "")
{?>

<div class="scroll-area" data-spy="scroll" data-target="#myNavbar" data-offset="0">
  <?php
query_posts('author='.$user_ID.'&posts_per_page=500&post_status=publish');
$i = 0;
while ( have_posts() ) : the_post(); $i++;?>
  <dl class="clinical_trial">
    <dt style=" <?php if($i == 1){echo 'color:#00afef;';} if($i == 2){echo 'color:#f78e1e;';} if($i == 3){echo 'color:#9fcf67;';} ?>">
       <?php if ( get_post_status ($post->ID) == 'pending' ||  get_post_status ($post->ID) == 'draft') {?>

                <?php
$categories = get_the_category($post->ID);
$separator = ' ';
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= $category->cat_name.$separator;
	}
echo trim($output, $separator);
}
?>
  - <?php echo get_post_meta($post->ID, '_wppl_city',true ); ?>,  <?php echo get_post_meta($post->ID, '_wppl_state',true ); ?>

              <?php }else{?>

				 <?php
$categories = get_the_category($post->ID);
$separator = ' ';
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= $category->cat_name.$separator;
	}
echo trim($output, $separator);
}
?>
  - <?php echo get_post_meta($post->ID, '_wppl_city',true ); ?>,  <?php echo get_post_meta($post->ID, '_wppl_state',true ); ?>

			  <?php }?>
    </dt>
    <dd>
      <?php the_excerpt();?>
    </dd>
    <a  style=" <?php if($i == 1){echo 'background:#00afef;';} if($i == 2){echo 'background:#f78e1e;';} if($i == 3){echo 'background:#9fcf67;';} ?>" class="patient" href="/patients-details/?pid=<?php echo $post->ID;?>">View Patients ></a>
  </dl>
  <?php if($i == 3){$i = 0;}?>
  <?php endwhile; wp_reset_query(); ?>
</div>
<?php }else{ ?>
<div class="scroll-area" data-spy="scroll" data-target="#myNavbar" data-offset="0">
<?php
if ($user_roles=='editor') {
    global $wp_query;

    $args1 = array(
        'post_status' => array('publish', 'draft', 'pending'),
        'post__not_in' => array(108),
        'posts_per_page' => 500,
        'author' => $user_ID,
        's' => $get_key
    );

//            $_qry_arr[] = array('key' => 'sponsor_name', 'value' => $get_key, 'compare' => "LIKE");
    query_posts( $args1);
//            print_r($_query_base_args);
    $_tmp_results1 = $wp_query->posts;

    $args2 = array(
        'post_status' => array('publish', 'draft', 'pending'),
        'post__not_in' => array(108),
        'posts_per_page' => 500,
        'author' => $user_ID,
        'meta_query' => array(
            'relation' => 'OR',
            array('key' => 'sponsor_name', 'value' => $get_key, 'compare' => "LIKE"),
            array('key' => 'custom_title_(for_thank_you_page)', 'value' => $get_key, 'compare' => "LIKE"),
            array('key' => '_wppl_city', 'value' => $get_key, 'compare' => "LIKE"),
            array('key' => '_wppl_state_long', 'value' => $get_key, 'compare' => "LIKE"),
            array('key' => '_wppl_state', 'value' => $get_key, 'compare' => "LIKE")
        )
    );


    query_posts( $args2);

    $_tmp_results2 = $wp_query->posts;
//                                                print_r($_tmp_results2);
    // run through $_tmp_results2 to exclude posts from $_tmp_results1
    foreach($_tmp_results2 as $_tmp_results2_key => $_tmp_results2_value){
        foreach($_tmp_results1 as $_tmp_results1_value){
            if($_tmp_results2_value->ID == $_tmp_results1_value->ID){
                unset($_tmp_results2[$_tmp_results2_key]);
                break;
            }
        }
    }

    $_tmp_results1 = array_merge($_tmp_results1, $_tmp_results2);

    // add studies, where user is specified in one of UsernameX fields
    $_qry_arr = array('relation' => 'OR');
    for($i=1;$i<6;$i++){
        $_qry_arr[] = array('key' => 'author_' . $i, 'value' => $user_ID);
    }

    $args3 = array(
        'post_status' => array('publish', 'draft', 'pending'),
        'post__not_in' => array(108),
        'posts_per_page' => 500,
        's' => $get_key,
        'meta_query' => $_qry_arr
    );

    query_posts( $args3 );

    $_tmp_results2 = $wp_query->posts;
//                                                print_r($_tmp_results2);
    // run through $_tmp_results2 to exclude posts from $_tmp_results1
    foreach($_tmp_results2 as $_tmp_results2_key => $_tmp_results2_value){
        foreach($_tmp_results1 as $_tmp_results1_value){
            if($_tmp_results2_value->ID == $_tmp_results1_value->ID){
                unset($_tmp_results2[$_tmp_results2_key]);
                break;
            }
        }
    }

    $_tmp_results1 = array_merge($_tmp_results1, $_tmp_results2);

//            print_r($_qry_arr);

    $args4 = array(
        'post_status' => array('publish', 'draft', 'pending'),
        'post__not_in' => array(108),
        'posts_per_page' => 500,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'relation' => 'OR',
                array('key' => 'sponsor_name', 'value' => $get_key, 'compare' => "LIKE"),
                array('key' => 'custom_title_(for_thank_you_page)', 'value' => $get_key, 'compare' => "LIKE"),
                array('key' => '_wppl_city', 'value' => $get_key, 'compare' => "LIKE"),
                array('key' => '_wppl_state_long', 'value' => $get_key, 'compare' => "LIKE"),
                array('key' => '_wppl_state', 'value' => $get_key, 'compare' => "LIKE")
            ),
            $_qry_arr
        )
    );
    query_posts( $args4 );
    $_tmp_results2 = $wp_query->posts;
//                                                print_r($_tmp_results2);
    // run through $_tmp_results2 to exclude posts from $_tmp_results1
    foreach($_tmp_results2 as $_tmp_results2_key => $_tmp_results2_value){
        foreach($_tmp_results1 as $_tmp_results1_value){
            if($_tmp_results2_value->ID == $_tmp_results1_value->ID){
                unset($_tmp_results2[$_tmp_results2_key]);
                break;
            }
        }
    }


    $wp_query->posts = array_merge($_tmp_results1, $_tmp_results2);
    $wp_query->post_count = count($wp_query->posts);
} else {
    if($sel_val=='all'){
        $args1 = array(
            'post_status' => array('publish', 'draft', 'pending'),
            'posts_per_page' => 500,
            'post__not_in' => array(108),
            's' => $get_key,
            'meta_query' => array(
                array(
                    'key' => 'manager_username',
                    'value' => $user_ID,
                    'type' => 'NUMERIC',
                    'compare' => '=',
                )
            )
        );

        $args2 = array(
            'post_status' => array('publish', 'draft', 'pending'),
            'posts_per_page' => 500,
            'post__not_in' => array(108),
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'manager_username',
                    'value' => $user_ID,
                    'type' => 'NUMERIC',
                    'compare' => '=',
                ),
                array(
                    'relation' => 'OR',
                    array('key' => 'sponsor_name', 'value' => $get_key, 'compare' => "LIKE"),
                    array('key' => 'custom_title_(for_thank_you_page)', 'value' => $get_key, 'compare' => "LIKE"),
                    array('key' => '_wppl_city', 'value' => $get_key, 'compare' => "LIKE"),
                    array('key' => '_wppl_state_long', 'value' => $get_key, 'compare' => "LIKE"),
                    array('key' => '_wppl_state', 'value' => $get_key, 'compare' => "LIKE")
                )
            )
        );

        merge_query_posts($args1, $args2);

    } else {
        $args1 = array(
            'post_status' => array('publish', 'draft', 'pending'),
            'posts_per_page' => 500,
            'post__not_in' => array(108),
            'author' => $sel_val,
            's' => $get_key,
            'meta_query' => array(
                array(
                    'key' => 'manager_username',
                    'value' => $user_ID,
                    'type' => 'NUMERIC',
                    'compare' => '=',
                )
            )
        );

        $args2 = array(
            'post_status' => array('publish', 'draft', 'pending'),
            'posts_per_page' => 500,
            'post__not_in' => array(108),
            'author' => $sel_val,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'manager_username',
                    'value' => $user_ID,
                    'type' => 'NUMERIC',
                    'compare' => '=',
                ),
                array(
                    'relation' => 'OR',
                    array('key' => 'sponsor_name', 'value' => $get_key, 'compare' => "LIKE"),
                    array('key' => 'custom_title_(for_thank_you_page)', 'value' => $get_key, 'compare' => "LIKE"),
                    array('key' => '_wppl_city', 'value' => $get_key, 'compare' => "LIKE"),
                    array('key' => '_wppl_state_long', 'value' => $get_key, 'compare' => "LIKE"),
                    array('key' => '_wppl_state', 'value' => $get_key, 'compare' => "LIKE")
                )
            )
        );

        merge_query_posts($args1, $args2);

    }
}

$i = 0;
if ( have_posts() ) {
while (have_posts() ) : the_post(); $i++;?>
<dl class="clinical_trial">
  <dt style=" <?php if($i == 1){echo 'color:#00afef;';} if($i == 2){echo 'color:#f78e1e;';} if($i == 3){echo 'color:#9fcf67;';} ?>">
   <?php if ( get_post_status ($post->ID) == 'pending' ||  get_post_status ($post->ID) == 'draft') {?>

                <?php
$categories = get_the_category($post->ID);
$separator = ' ';
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= $category->cat_name.$separator;
	}
echo trim($output, $separator);
}
?>
  - <?php echo get_post_meta($post->ID, '_wppl_city',true ); ?>,  <?php echo get_post_meta($post->ID, '_wppl_state',true ); ?>

              <?php }else{?>

				 <?php
$categories = get_the_category($post->ID);
$separator = ' ';
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= $category->cat_name.$separator;
	}
echo trim($output, $separator);
}
?>
  - <?php echo get_post_meta($post->ID, '_wppl_city',true ); ?>,  <?php echo get_post_meta($post->ID, '_wppl_state',true ); ?>

			  <?php }?>
    <p style="width:33%;text-align:left;float:right;margin-right:10px;margin-top:5px;"><?php echo 'Study End Date: '; ?>
        <?php
        $e_dt = get_field('study_end_date', $post->ID);
        if ($e_dt) {
            $dtend = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post->ID));
            echo $study_endt = $dtend->format('m/d/y');
        }
        ?>
    </p>
    <p style="width:100%;"><b style=" <?php if ($i == 1) { echo 'color:#00afef;'; } if ($i == 2) { echo 'color:#f78e1e;';
        } if ($i == 3) {  echo 'color:#9fcf67;'; } ?>">Sponsor:</b> <?php echo get_field('sponsor_name', $post->ID);?></p>
  </dt>
  <dd>
    <?php the_excerpt();?>
  </dd>
  <a  style=" <?php if($i == 1){echo 'background:#00afef;';} if($i == 2){echo 'background:#f78e1e;';} if($i == 3){echo 'background:#9fcf67;';} ?>" class="patient" href="/patients-details/?pid=<?php echo $post->ID;?>">View Patients ></a>
    <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
        echo 'background:#00afef;';
    } if ($i == 2) {
        echo 'background:#f78e1e;';
    } if ($i == 3) {
        echo 'background:#9fcf67;';
    } ?>" class="patient" onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'block';
        document.getElementById('fade').style.display = 'block'" href="javascript:void(0);">Renew Study ></a>

    <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
        echo 'background:#00afef;';
    } if ($i == 2) {
        echo 'background:#f78e1e;';
    } if ($i == 3) {
        echo 'background:#9fcf67;';
    } ?>" class="patient" onclick="document.getElementById('embed2<?php echo $post->ID; ?>').style.display = 'block';
        document.getElementById('fade').style.display = 'block'" href="javascript:void(0);">Upgrade Study ></a>

</dl>
<?php if($i == 3){$i = 0;}?>
<?php endwhile; wp_reset_query(); }else{?>
<dl class="clinical_trial">
<dt style=" <?php if($i == 1){echo 'color:#00afef;';} if($i == 2){echo 'color:#f78e1e;';} if($i == 3){echo 'color:#9fcf67;';} ?>"> No Listings Found with this Name. </dt>
<?php } ?>
</div>
<?php } }?>

