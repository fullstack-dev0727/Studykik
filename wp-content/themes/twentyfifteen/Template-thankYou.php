<?php

/**
Template Name: Thank you
 */



get_header(); ?>
<style>
/** thanku_you css start **/
.wrapper {
    display: block;
    margin: auto;
    text-align: center;
}
.banner {
	float:left;
	width:100%;
	position:relative;
	margin-top:15px;
	 margin-bottom: 35px;
}
.thanku_you{
	left: 35%;
    padding: 10px;
    position: absolute;
    top: 96px;
    width:50%;
    text-align: left;
}
.happen{
	float:left;
	width:100%;
}
.happen h2{
	 color: #ffffff;
    font: 26px/90px verdana,geneva !important;
    margin: 0;
    padding: 0 !important;
    text-transform: uppercase;
	background-color:none !important;
}
.happen h5{
	color: #fff;
    font-size: 20px;
    font-weight: normal;
    line-height: 28px;
    margin-bottom: 15px;
    margin-top: 0;
}
.back_btn{
	left: 528px;
    position: absolute;
    top: 670px;
}

</style>

<div id="inner-page">

<div class="wrapper">
			<?php /* The loop */ ?>

			<?php while ( have_posts() ) : the_post(); ?> 



						<?php the_content(); ?>
                        





			<?php endwhile; ?>



		</div><!-- #content -->

	</div><!-- #primary -->


    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-P8GVL2"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-P8GVL2');</script>
    <!-- End Google Tag Manager -->

<?php get_footer(); ?>