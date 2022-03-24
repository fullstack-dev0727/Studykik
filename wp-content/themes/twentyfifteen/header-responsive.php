<?php
//ob_start();
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
        <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrapres.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri(); ?>/css/admin.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri(); ?>/css/media.css" type="text/css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri(); ?>/fonts/font2/font.css" type="text/css" rel="stylesheet">
<!--    <link href="--><?php //bloginfo('template_url');?><!--/css/dashboard.css" rel="stylesheet">-->
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
         <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '870162253106845');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=870162253106845&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<script>
fbq('track', 'Lead');
</script>

<?php wp_head();?>
    </head>
    <body <?php body_class(); ?>>
        <div role="navigation" class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header padtop"> <a href="<?php echo site_url();?>" class="navbar-brand"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt=""></a> </div>
                 <div class="top_right">
    <?php
	if ( is_user_logged_in() ) {?>
	<a href="<?php echo wp_logout_url(); ?>" title="Logout">Logout</a>
<?php } else {?>
	<a href="<?php echo site_url();?>/login/" title="Login">Login</a>
<?php } ?>

    </div>
                <!--/.nav-collapse -->
            </div>
        </div>