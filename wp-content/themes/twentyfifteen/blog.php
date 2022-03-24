<?php 
/*
Template Name: Blog

*/


get_header(); ?>
<style>
.drop-cus select.styled {
    float: left;
    height: 50px;
    width: 100%;
	color:#88DD25;
}

.select {
  
    float: left;
    font: 26px/45px helvetica_neue_lt_com67MdCn;
    height: 61px;
    left: 0;
    margin-bottom: 15px;
    
}
.drop-cus {
    float: left;
    height: 76px;
    position: relative;
    width: 100%;
}
.mandatory.gmw-address.gmw-full-address.gmw-address-1 {
    background-color: #E8E8E8;
    border: 0 none;
    box-shadow: 3px 2px 5px #C5C5C5 inset;
    color: #88DD25;
    float: left;
    font: 26px/30px helvetica_neue_lt_com67MdCn;
    height: 50px;
    margin-bottom: 15px;
    padding: 0 3%;
    width: 100%;
	 height: 55px;
}
.blog-left .navigation {
    float: left;
    margin: 20px 0;
    text-align: center;
    width: 100%;
}
</style>
	<div id="inner-page">

	<div class="container">
    	<h1 class="archive-title">BLOG </h1>

    <div class="blog-left">
<?php global $post;
$args = array( 'posts_per_page' => 10, 'cat' => 96, 'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1));
$custom_posts= query_posts($args);?>
		<?php if ($custom_posts ) : ?>

			
			<?php while ( have_posts() ) : the_post();?> 
  
  <div class="blog-section">
			<h3 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		 </h3>
		
<div class="img">
<a href="<?php the_permalink(); ?>" rel="bookmark">
<?php 
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  the_post_thumbnail(array(200,200));
} 
?>
</a>
</div>	


	<div class="entry-summary">
		<?php the_excerpt(); ?>
		
	</div><!-- .entry-content -->
    
    </div>
			<?php endwhile; ?>

<?php if(function_exists('wp_paginate')) {
  wp_paginate();
}wp_reset_query();
?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
</div>

<div class="blog-right">
<?php get_sidebar(); ?>

</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>