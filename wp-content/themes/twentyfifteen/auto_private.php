<?php
include "../../../wp-load.php";
date_default_timezone_set('America/Los_Angeles');
$current_time = localtime();
$current_date = date("Ymd");
$current_hour = $current_time[2];
$current_minute = $current_time[1];

$queryArgs = array(
  'numberposts'	=> -1,
  'post_status' => array('publish'),
  'post_type'		=> 'post',
  'meta_query'	=> array(
    'relation'		=> 'AND',
    array(
      'key'		=> 'end_date',
      'compare'	=> '<=',
      'value'		=> $current_date
    ),
    array(
      'key'		=> 'end_date',
      'compare'	=> '!=',
      'value'		=> "",
    )
  )
);

// query
$the_query = new WP_Query( $queryArgs );

?>
<?php
if( $the_query->have_posts() ):
  while ( $the_query->have_posts() ) : $the_query->the_post();
    $post_id = get_the_ID();
    $am_pm = get_post_custom_values('end_time_second', $post_id);
    $end_hour = get_post_custom_values('end_time_hour', $post_id);
    $end_hour = intval($end_hour[0]);
    $end_minute = get_post_custom_values('end_time_minute', $post_id);
    $end_minute = intval($end_minute[0]);

    $end_date = get_post_custom_values('end_date', $post_id);
    $prev_auto_privatized_date = get_post_meta($post_id, 'prev_auto_privatized_date');

    $date_obj = new DateTime($end_date[0].' '.$end_hour.':'.$end_minute.':00'.' '.$am_pm[0]);
    if($end_date[0] == $current_date){

      if($am_pm[0] == "PM" and $end_hour < 12){
        $end_hour = $end_hour+12;
      }else if($am_pm[0] == "AM" and $end_hour == 12){
        $end_hour = $end_hour - 12;
      }
      if(($end_hour < $current_hour) or ($end_hour == $current_hour and $end_minute <=$current_minute)){
        the_title();
        $my_post = array(
          'ID'           => $post_id,
          'post_status'   => 'private',
        );
        if (!$prev_auto_privatized_date || $prev_auto_privatized_date[0] != $date_obj->format('Y-m-d H:i:s')){
            wp_update_post( $my_post );
        }
        update_post_meta($post_id, 'prev_auto_privatized_date', $date_obj->format('Y-m-d H:i:s'));
      }
    }else{
      the_title();
      $my_post = array(
        'ID'           => $post_id,
        'post_status'   => 'private',
      );
      if (!$prev_auto_privatized_date || $prev_auto_privatized_date[0] != $date_obj->format('Y-m-d H:i:s')){
        wp_update_post( $my_post );
      }
      update_post_meta($post_id, 'prev_auto_privatized_date', $date_obj->format('Y-m-d H:i:s'));
    }
  endwhile;
endif;
wp_reset_query();
?>