<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<div id="inner-page" style="padding:0px;">
</div>
<div id="cntt-form">
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h1 class="form-head">INSTANTLY SEARCH FOR A CLINICAL TRIAL: <br /> <span style="color:#f78f1e;margin-right: 16px;"><?php single_cat_title( '', true ); ?></span></h1>
                <div class="center-block-form">
                    <div class="center-form">
                   <form onsubmit="showHide();" method="post" action="#trial" name="wppl_form" class="standard-form gmw-form gmw-form-3 gmw-pt-form " id="gmw-form-3">

		<div class="gmw-address-field-wrapper">

			<!-- Address Field -->

            <input type="text" name="wppl_address[]" id="gmw-address" class="mandatory gmw-address gmw-full-address gmw-address-1 " onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="Zip Code" size="35">

		</div>
<div class="gmw-unit-distance-wrapper">

			<!--distance values -->

			<span class="drop-cus"><span class="select" id="selectwppl_distance">Distance </span><select id="gmw-distance-select-1" class="gmw-distance-select styled gmw-distance-select-1 " name="wppl_distance"><option value="5000">Distance </option><option value="10">10 Miles</option><option value="50">50 Miles</option><option value="100">100 Miles</option><option value="250">250 Miles</option></select>
			<!--distance units-->

			<input type="hidden" value="imperial" name="wppl_units">

		</span></div>

        <?php
$category = get_the_category();
$cat_id= $category[0]->cat_ID;
?>
		<input type="hidden" value="<?php echo $cat_id; ?>" name="tax_category" />





	<div class="gmw-submit-wrapper" id="gmw-submit-wrapper-3">

		<input type="hidden" value="3" name="wppl_form" class="gmw-form-id" id="gmw-form-id-3">

		<input type="hidden" value="1" name="paged" class="gmw-paged" id="gmw-paged-3">

		<input type="hidden" value="5" name="wppl_per_page" class="gmw-per-page" id="gmw-per-page-3">

		<input type="hidden" value="" class="prev-address" id="prev-address-3">

		<input type="hidden" value="26.7083504" name="wppl_lat" class="gmw-lat" id="gmw-lat-3">

		<input type="hidden" value="-80.1088881" name="wppl_long" class="gmw-long" id="gmw-long-3">

		<input type="hidden" value="pt" name="gmw_px" class="gmw-prefix" id="gmw-prefix-3">

		<input type="hidden" value="wppl_post" name="action" class="gmw-action" id="gmw-action-3">

		<input type="submit" value="Find Studies!" name="find_search" class="gmw-submit btn" id="gmw-submit-3"><div style="display:none" class="loading_image"><img src="<?php echo site_url();?>/wp-content/themes/twentyfifteen/images/ajax-loader.gif"></div>

	</div>


	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($_REQUEST['find_search'])) { ?>
<div id="trial">
    <div id="trail">
        <div class="container">
            <div class="row">
                <div class="trail-list">
                <?php echo do_shortcode('[gmw_results]'); ?>
                </div>
            </div>
        </div>
    </div> </div>
<?php }else{ ?>
<style>
.list-img {
    float: left;
    height: 170px;
    overflow: hidden;
    width: 100%;
}
</style>
    <div id="trail">
        <div class="container">
            <div class="row">
                <div class="trail-list">
                <?php $pc = 0;?>
                <?php while (have_posts() ) : the_post(); $pc++; ?>

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
	echo '<img src="'.site_url().'/wp-content/plugins/geo-my-wp/plugins/posts/search-results/clean/no_img.jpg" />';
}

?> </a> </div>

          <a href="<?php echo the_permalink(); ?>"><h1 class="<?php if($pc == 1){ echo 'blue';} if($pc == 2){ echo 'green';}if($pc == 3){ echo 'orange';}if($pc == 4){ echo 'blue';}if($pc == 5){ echo 'green';} if($pc == 6){ echo 'blue';} if($pc == 7){ echo 'green';} if($pc == 8){ echo 'orange';} if($pc == 9){ echo 'blue';}?>"><?php the_title(); ?></h1></a>
<p><?php //the_excerpt(); ?> <?php echo substr(get_the_excerpt(), 0,120).'....'; ?> </p>
<?php if($pc == 9){ $pc = 0;}?>
        </div>
        <?php //$pc++; ?>
        <?php endwhile; ?>

                </div>
            </div>
        </div>
    </div>
   <?php } ?>

 <style>
h1.form-head {
    font: 36px Arial,Helvetica,sans-serif;
}
#trail{min-height: 400px;}
.gmw-submit-wrapper {
   top: -10px;
}
 </style>
<?php get_footer(); ?>