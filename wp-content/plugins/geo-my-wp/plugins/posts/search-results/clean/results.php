<?php

/**

 * Clean - Results Page.

 * @version 1.0

 * @author Eyal Fitoussi

 */

?>

<!--  Main results wrapper - wraps the paginations, map and results -->

<div id="wppl-output-wrapper" class="wppl-output-wrapper wppl-output-wrapper">

	

	<!-- results count -->

	<div class="gmw-results-count">

		<h2><?php gmw_pt_within( $gmw,$sm=__('Showing','GMW'), $om=__('out of','GMW'), $rm=__('results','GMW') ,$wm=__('within','GMW'), $fm=__('from','GMW'), $nm=__('your location','GMW') ); ?></h2>

	</div>

	

<?php /*?>	<div class="gmw-pt-pagination-wrapper gmw-pt-top-pagination-wrapper">

		<!--  paginations -->

		<?php gmw_pt_per_page_dropdown($gmw, ''); ?><?php gmw_pt_paginations($gmw); ?>

	</div> 

	<?php */?>

	<!-- Map -->

	<?php gmw_pt_results_map($gmw); ?>

	

	<div class="clear"></div>

	

	<!--  Results wrapper -->

	<div id="wppl-results-wrapper-<?php echo $gmw['form_id']; ?>" class="wppl-results-wrapper">

	

		<!--  this is where wp_query loop begins -->

		
<?php if(is_home() || is_page(4) || is_category()){?>
        
<?php while ( $gmw_query->have_posts() ) : $gmw_query->the_post(); $postid = get_the_ID();

$post_categories = wp_get_post_categories( $postid );
$cats = array();
	
foreach($post_categories as $c){
	$cat = get_category( $c );
	$cats[] = $cat->name;
}
if (in_array("Blog", $cats)) {
    
}else{

?>
        <div class="col-sm-4 <?php if($pc == 3 || $pc == 6 || $pc == 9){ echo 'last';}?>" id="id-<?php echo $postid;?>">

          <div class="list-img"><a href="<?php echo the_permalink(); ?>">
          <?php
		  if ( has_post_thumbnail() ) {
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
				
				$url = $thumb['0'];
				?>
          <img src="<?php bloginfo('template_url'); ?>/thumb/timthumb.php?src=<?php echo $url; ?>&w=288" />
          
		  <?php
	     //the_post_thumbnail('thumbnail');
		 //echo get_the_post_thumbnail( $post_id, array( 288, 169) ); 
}
else {
	echo '<img src="http://studykik.com/wp-content/plugins/geo-my-wp/plugins/posts/search-results/clean/no_img.jpg" />';
}

?> </a> </div>

          <a href="<?php echo the_permalink(); ?>"><h1 class="<?php if($pc == 1){ echo 'blue';} if($pc == 2){ echo 'green';}if($pc == 3){ echo 'orange';}if($pc == 4){ echo 'blue';}if($pc == 5){ echo 'green';} if($pc == 6){ echo 'blue';} if($pc == 7){ echo 'green';} if($pc == 8){ echo 'orange';} if($pc == 9){ echo 'blue';}?>"><?php the_title(); ?></h1></a>
        <?php if($postid == 3064){?>
        <style>
		.trail-list #id-3064{
background-color: #f5f5f5 !important;
-moz-box-shadow: 3px 4px 5px #f5f5f5;
-webkit-box-shadow: 3px 4px 5px #f5f5f5;
box-shadow: 3px 4px 5px #f5f5f5;
}
		</style>
        <?php }else{ ?>

          <p><?php if(is_category()){ echo substr(get_the_excerpt(), 0,130).'....';
		   }else{ gmw_pt_excerpt($gmw, $post); } ?> </p>
          <?php } ?>
<?php if($pc == 9){ $pc = 0;}?>
        </div>
		  	<?php $pc++; ?>
            <?php }  endwhile; ?>
      <style>
#trail .trail-list h1
{
	min-height: 129px;
	max-height: 129px;
}
.list-img {
height: 169px;
overflow:hidden;
}
#trail .trail-list p {
min-height: 110px;
}
</style>
		<?php }else{?>
        <?php while ( $gmw_query->have_posts() ) : $gmw_query->the_post(); ?>

         <div class="col-sm-4">
          <div class="list-img"> <a href="<?php echo the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail(array(400,300));}else{ ?>
            <img src="<?php bloginfo('template_url');?>/images/noimg.png">
            <?php } ?>
            </a> </div>
          <a href="<?php echo the_permalink(); ?>">
          <h1 style="background:#f78f1e;line-height: 25px;min-height: 90px;max-height: 90px;">
            <?php the_title(); ?>
            <br />
            <?php echo get_post_meta($post->ID, '_wppl_city',true ); ?>,  <?php echo get_post_meta($post->ID, '_wppl_state',true ); ?>,  <?php echo get_post_meta($post->ID, '_wppl_zipcode',true ); ?>, <?php echo get_post_meta($post->ID, '_wppl_country',true ); ?>
          </h1>
           
          </a>
          
          <h1 class="<?php if($pc == 1){ echo 'blue';} if($pc == 2){ echo 'green';}?>"><a style="color:#fff; font-size:35px; text-decoration:none;" href="<?php echo the_permalink(); ?>">MORE INFORMATION</a> </h1>
          <?php 
if($pc == 2) {$pc =0;}
?>
        </div>
        <?php $pc++; ?>
        <?php endwhile; ?>
      
        <?php } ?>

		

		

		<!--  end of the loop -->

		

	</div> <!--  results wrapper -->    



		

</div> <!-- output wrapper -->