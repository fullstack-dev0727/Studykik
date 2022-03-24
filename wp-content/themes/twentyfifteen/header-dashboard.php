<?php
ob_start();
/*
* HEADER TEMPLATE FOR DASHBOARD
*/
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
	<!--[if lt IE 9]>
	<script src="<?php //echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/slider.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/fonts/font2/font.css" type="text/css" rel="stylesheet">
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<link href="<?php bloginfo('template_url');?>/css/dashboard.css" rel="stylesheet">
<link href="<?php bloginfo('template_url');?>/css/dashboard_media.css" rel="stylesheet">
<?php wp_head();?>
<!--<script type="text/javascript">if (typeof hmtracker == 'undefined') {var hmt_script = document.createElement('script'),hmt_purl = encodeURIComponent(location.href).replace('.', '~');hmt_script.type = "text/javascript";hmt_script.src = "//studykik.com/heatmap/?hmtrackerjs=StudyKIK~Heatmap&uid=926e1d1ad41f0516599d652538fa85e8fea9d04c&purl="+hmt_purl;document.getElementsByTagName('head')[0].appendChild(hmt_script);}</script>-->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '914628025278184']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=914628025278184&amp;ev=PixelInitialized" /></noscript>
</head>
<body <?php body_class(); ?>>
<div role="navigation" class="navbar navbar-default navbar-static-top">
  <div class="container">
  <div class="col-xs-12 col-sm-12">
    <div class="navbar-header padtop"> <a href="<?php echo site_url();?>" class="navbar-brand"><img src="<?php bloginfo('template_url');?>/images-dashboard/logo.png" alt=""></a> </div>
    <div class="top_right">
    <?php
	if ( is_user_logged_in() ) {?>
	<a href="<?php echo wp_logout_url(); ?>" title="Logout">Logout</a>
<?php } else {?>
	<a href="/login/" title="Login">Login</a>
<?php } ?>

    </div>
    </div>
    <!--/.nav-collapse -->
  </div>
</div>
