<?php

/*
Template Name: Jquery Past Studies
*/
?>
<?php
global $wpdb;
$get_key2 = $_REQUEST['sticky2'];
$sel_val = "all";
if (isset($_REQUEST['sel_val'])) {
    $sel_val = $_REQUEST['sel_val'];
}
$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);
$user_roles = implode(', ', $user_info->roles);
?>

<?php 
if($get_key2 == "")
{ ?>
<div class="scroll-area" data-spy="scroll" data-target="#myNavbar" data-offset="0">
            <?php
query_posts('author='.$user_ID.'&posts_per_page=500&post_status=private');
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
                <span style="float: right; margin-right: 13px; <?php if($i == 1){echo 'color:#00afef;';} if($i == 2){echo 'color:#f78e1e;';} if($i == 3){echo 'color:#9fcf67;';} ?>">Status : Draft</span>
            </dl>
            <?php if($i == 3){$i = 0;}?>
            <?php endwhile; wp_reset_query(); ?>
          </div>
<?php }else{?>

<div class="scroll-area" data-spy="scroll" data-target="#myNavbar" data-offset="0">
            <?php
        global $wp_query;
        if ($user_roles == 'editor') {

            $args1 = array(
                'post_status' => 'private',
                'posts_per_page' => 500,
                'author' => $user_ID,
                's' => $get_key2,
            );

            $args2 = array(
                'post_status' => 'private',
                'posts_per_page' => 500,
                'author' => $user_ID,
                'meta_query' => array(
                    'relation' => 'OR',
                    array('key' => 'sponsor_name', 'value' => $get_key2, 'compare' => "LIKE"),
                    array('key' => 'custom_title_(for_thank_you_page)', 'value' => $get_key2, 'compare' => "LIKE"),
                    array('key' => '_wppl_city', 'value' => $get_key2, 'compare' => "LIKE"),
                    array('key' => '_wppl_state_long', 'value' => $get_key2, 'compare' => "LIKE"),
                    array('key' => '_wppl_state', 'value' => $get_key2, 'compare' => "LIKE")
                )
            );

            merge_query_posts($args1, $args2);


//            query_posts( $queryArgs );
        } else {
            if($sel_val=='all'){
                $args1 = array(
                    'post_status' => 'private',
                    'posts_per_page' => 500,
                    'post__not_in' => array(108),
                    's' => $get_key2,
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
                    'post_status' => 'private',
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
                            array('key' => 'sponsor_name', 'value' => $get_key2, 'compare' => "LIKE"),
                            array('key' => 'custom_title_(for_thank_you_page)', 'value' => $get_key2, 'compare' => "LIKE"),
                            array('key' => '_wppl_city', 'value' => $get_key2, 'compare' => "LIKE"),
                            array('key' => '_wppl_state_long', 'value' => $get_key2, 'compare' => "LIKE"),
                            array('key' => '_wppl_state', 'value' => $get_key2, 'compare' => "LIKE")
                        )
                    )
                );

                merge_query_posts($args1, $args2);
            } else {
                $args1 = array(
                    'post_status' => 'private',
                    'posts_per_page' => 500,
                    'post__not_in' => array(108),
                    'author' => $sel_val,
                    's' => $get_key2,
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
                    'post_status' => 'private',
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
                            array('key' => 'sponsor_name', 'value' => $get_key2, 'compare' => "LIKE"),
                            array('key' => 'custom_title_(for_thank_you_page)', 'value' => $get_key2, 'compare' => "LIKE"),
                            array('key' => '_wppl_city', 'value' => $get_key2, 'compare' => "LIKE"),
                            array('key' => '_wppl_state_long', 'value' => $get_key2, 'compare' => "LIKE"),
                            array('key' => '_wppl_state', 'value' => $get_key2, 'compare' => "LIKE")
                        )
                    )
                );

                merge_query_posts($args1, $args2);
            }
        }


//	$args = array("s" => $get_key2,"author" => $user_ID, ' post_status' => array('publish','draft', 'pending'));

$i = 0;
if ( have_posts() ) {
while (have_posts() ) : the_post(); $i++;?>
    <dl class="clinical_trial">
        <dt style=" <?php if ($i == 1) {
            echo 'color:#00afef;';
        } if ($i == 2) {
            echo 'color:#f78e1e;';
        } if ($i == 3) {
            echo 'color:#9fcf67;';
        } ?>"> <a href="<?php the_permalink() ?>" style=" <?php if ($i == 1) {
                echo 'color:#00afef;';
            } if ($i == 2) {
                echo 'color:#f78e1e;';
            } if ($i == 3) {
                echo 'color:#9fcf67;';
            } ?>" target="_blank">
                <?php
                $wppl_city=get_post_meta($post->ID, '_wppl_city', true);
                $wppl_state=get_post_meta($post->ID, '_wppl_state', true);
                $cat_name=get_post_meta($post->ID, 'custom_title_(for_thank_you_page)', true);
                if (get_post_status($post->ID) == 'pending' || get_post_status($post->ID) == 'draft') { ?>
<?php
//                                                $categories = get_the_category($post->ID);
//                                                $separator = ' ';
//                                                $output = '';
//                                                if ($categories) {
//                                                    foreach ($categories as $category) {
//                                                        $output .= $category->cat_name . $separator;
//                                                    }
//                                                    echo trim($output, $separator);
//                                                }
                    echo $cat_name;
                    ?>
                    - <?php echo $wppl_city; ?>, <?php echo $wppl_state; ?>
                <?php } else { ?>
<?php
//                                                $categories = get_the_category($post->ID);
//                                                $separator = ' ';
//                                                $output = '';
//                                                if ($categories) {
//                                                    foreach ($categories as $category) {
//                                                        $output .= $category->cat_name . $separator;
//                                                    }
//                                                    echo trim($output, $separator);
//                                                }
                    echo $cat_name;
                    ?>
                    - <?php echo $wppl_city; ?>, <?php echo $wppl_state; ?>
                <?php } ?>
            </a>
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
            <?php
            the_excerpt(); ?>
        </dd>
        <a  style=" <?php if ($i == 1) {
            echo 'background:#00afef;';
        } if ($i == 2) {
            echo 'background:#f78e1e;';
        } if ($i == 3) {
            echo 'background:#9fcf67;';
        } ?>" class="patient" href="<?php echo site_url();?>/patients-details/?pid=<?php echo $post->ID; ?>">View Patients ></a>
        <?php
        $exposure_level = get_post_meta($post->ID, 'exposure_level', true);
        if ($exposure_level == "Platinum") {
            $goal_total = "Boost this study with an additional 10 posts for $559?";
            $boost_pack = 'Platinum';
        }
        if ($exposure_level == "Gold") {
            $goal_total = "Boost this study to Platinum with an additional 20 posts for $1000?";
            $boost_pack = 'Gold';
        }
        $study_publish_date = get_the_date('m/d/Y');
        if (get_field('study_end_date', $post->ID)) {
            $date2 = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post->ID));
            $study_end_date = $date2->format('Y-m-d');
        } else {
            $study_end_date = '2015-12-30';
        }
        $datetime1 = date_create($study_publish_date);
        $datetime2 = date_create($study_end_date);
        $interval = date_diff($datetime1, $datetime2);
        $total_number_of_days = str_replace("+", "", $interval->format('%R%a'));
        if ($total_number_of_days < 16) {
            $day_left = "Are you sure you want to renew this study for another 15 Day period?";
        }
        if ($total_number_of_days > 16) {
            $day_left = "Are you sure you want to renew this study for another 30 Day period?";
        }
        if (get_post_status($post->ID) == 'private') {
            ?>
            <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                echo 'background:#00afef;';
            } if ($i == 2) {
                echo 'background:#f78e1e;';
            } if ($i == 3) {
                echo 'background:#9fcf67;';
            } ?>" class="patient" onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'block';
                document.getElementById('fade').style.display = 'block'" href="javascript:void(0);" >Renew Study ></a>
        <?php } else { ?>
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
        <?php } ?>
    </dl>
            <?php if($i == 3){$i = 0;}?>
            <?php endwhile; wp_reset_query(); }else{?>
             <dl class="clinical_trial">
              <dt style=" <?php if($i == 1){echo 'color:#00afef;';} if($i == 2){echo 'color:#f78e1e;';} if($i == 3){echo 'color:#9fcf67;';} ?>">
                No Listings Found with this Name.
              </dt>
              </dl>
            <?php } ?>
          </div>
	
<?php }?>