<?php
$meta_nofollow = '';
if (strpos(site_url(),'testing') || strpos(site_url(),'staging')){
    $meta_nofollow = '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
}
ob_start();
/**
 * The Header template for our theme
 *
 *
 * Displays all of the <head> section and everything up till <div id="main">
 * * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
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
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="google-site-verification" content="yIfUOkemMitc9cl3dd4gGOx3pH_AFIN0RcvsrMZevg0" />
        <?php echo $meta_nofollow; ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
        <!--[if lt IE 9]>
        <script src="<?php //echo get_template_directory_uri(); ?>/js/html5.js"></script>
        <![endif]-->
        <link href="<?php echo get_template_directory_uri();?>/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri();?>/css/style.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri();?>/css/slider.css" rel="stylesheet">
      <link href="<?php echo get_template_directory_uri(); ?>/fonts/font2/font.css" type="text/css" rel="stylesheet">

<!--            <script type="text/javascript">if (typeof hmtracker == 'undefined') {var hmt_script = document.createElement('script');hmt_purl = encodeURIComponent(location.href).replace('.', '~');hmt_script.type = "text/javascript";hmt_script.src = "//studykik.com/heatmap/?hmtrackerjs=StudyKIK~Heatmap&uid=926e1d1ad41f0516599d652538fa85e8fea9d04c&purl="+hmt_purl;document.getElementsByTagName('head')[0].appendChild(hmt_script);}</script>-->
        <script src="<?php echo get_template_directory_uri();?>/js/jquery-1.10.1.min.js"></script>
        <script type="application/javascript">
            $(document).ready(function(){
                $('#gmw-address').focus(function() {
                    if (this.value === 'Zip Code') {
                        $(this).css('color', '#000000').val('');
                    }
                });
                $('#gmw-address').blur(function() {
                    if (this.value === '') {
                        $(this).css('color', 'red').val('Zip Code');
                    }
                });
            });</script>
        <?php if (is_front_page()) { ?>
            <script>
                function showHide()
                {
                    $(".gmw-submit").css('background', '#F78F1E');
                    $(".gmw-submit").css('color', '#fff');
                    $(".gmw-submit").css('font-size', '50px');
                    $(".gmw-submit").val('Searching.....');
                    $(".loading_image").show();
                    setTimeout(function () {
                        $(".gmw-submit").css('background', 'url(https://studykik.com/wp-content/themes/twentythirteen/images/btn.jpg)no-repeat scroll 0 0 / 100% 100% rgba(0, 0, 0, 0)');
                        $(".gmw-submit").css('font-size', '0px');
                        $(".gmw-submit").val('Find Studies!');
                        $(".loading_image").hide();
                    }, 3000);
                }
            </script>
        <?php } else { ?>
            <script>
                function showHide()
                {
                    $(".gmw-submit").val('Searching.....');
                    $(".loading_image").show();
                    setTimeout(function () {
                        $(".gmw-submit").val('Find Studies!');
                        $(".loading_image").hide();
                    }, 3000);
                }
            </script>
        <?php } ?>
        <script src="<?php echo get_template_directory_uri(); ?>/js/placeholder.js"></script>
        <?php
        global $post;
        $get_post_ID = $post->ID;
        echo get_post_meta($post->ID, 'add_header_code_here', true);
        ?>
        <?php if (is_page(6)) { ?>
            <!-- Google Code for StudyKIK Conversion Page -->
            <script type="text/javascript">
                 /* <![CDATA[ */
                 var google_conversion_id = 979334053;
                 var google_conversion_language = "en";
                 var google_conversion_format = "3";
                 var google_conversion_color = "ffffff";
                 var google_conversion_label = "dwNTCMebj1kQpef90gM";
                 var google_remarketing_only = false;
                 /* ]]> */
            </script>
            <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
            </script>
            <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/979334053/?label=dwNTCMebj1kQpef90gM&amp;guid=ON&amp;script=0"/>
        </div>
        </noscript>
    <?php } ?>
    <!-- Pure Chat Snippet -->
    <script type='text/javascript'>
        (function () {
            var done = false;
            var script = document.createElement('script');
            script.async = true;
            script.type = 'text/javascript';
            script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript';
            document.getElementsByTagName('HEAD').item(0).appendChild(script);
            script.onreadystatechange = script.onload = function (e) {
                if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
                    var w = new PCWidget({c: 'bab234e1-3a99-448d-b117-2bb29457f303', f: true});
                    done = true;
                }
            };
        })();
    </script>
    <?php
    
    global $__this_is_single_php;
    global $__this_is_single_php_post_id;
    
    
     if (is_page(5289)) { ?>
        <!-- Facebook Conversion Code for Tracking for StudyKIK -->
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '914628025278184');
fbq('track', 'Lead');</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=914628025278184&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
    <?php }elseif(isset($__this_is_single_php)&&$__this_is_single_php){ ?>
    <?php //var_dump($__this_is_single_php_post_id); 
    if($__this_is_single_php_post_id==63882){ 
    ?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '1521955054762774');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1521955054762774&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->    
    <?php }else{ ?>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '914628025278184');
    fbq('track', "PageView");</script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=914628025278184&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    <?php }} ?>
    <?php wp_head(); ?>
<!--<script type="text/javascript">if (typeof hmtracker == 'undefined') {var hmt_script = document.createElement('script'),hmt_purl = encodeURIComponent(location.href).replace('.', '~');hmt_script.type = "text/javascript";hmt_script.src = "//studykik.com/heatmap/?hmtrackerjs=StudyKIK~Heatmap&uid=926e1d1ad41f0516599d652538fa85e8fea9d04c&purl="+hmt_purl;document.getElementsByTagName('head')[0].appendChild(hmt_script);}</script>-->


</head>
<body <?php body_class(); ?>>
    <div role="navigation" class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header padtop">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php bloginfo('url'); ?>" class="navbar-brand"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" height="27px" width="185px"></a>
            </div>
            <div class="navbar-collapse collapse">
                <?php
                /* Primary navigation */
                wp_nav_menu(array(
                    'menu' => 'Header Menu',
                    'items_wrap' => '<ul class="nav navbar-nav padtop">%3$s</ul>')
                );
                ?>
                <div class="nav navbar-nav navbar-right the-right-link">
                    <?php
                    if ( is_user_logged_in() ) {?>
                        <a href="<?php echo wp_logout_url(); ?>" title="Logout">Logout</a>
                    <?php } else {?>
                        <a href="<?php echo site_url();?>/login/" title="Login">Login</a>
                    <?php } ?>
                </div>
                <ul class="head-social nav navbar-nav navbar-right">
                    <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?=www.studykik.com&u=<?php echo site_url();?>"><img src="<?php echo get_template_directory_uri(); ?>/images/hfb.png" alt="" height="32" width="32"></a></li>
                    <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo site_url();?>/&title=Find%20Clinical%20Trials%20Near%20You&summary=&source="><img src="<?php echo get_template_directory_uri(); ?>/images/hlk.png" alt="" height="32" width="32"></a></li>
                    <li><a target="_blank" href="https://plus.google.com/share?url=[<?php echo site_url();?>]"><img src="<?php echo get_template_directory_uri(); ?>/images/hgp.png" alt="" height="32" width="32"></a></li>
                    <li> <a target="_blank" href="https://twitter.com/home?status=[Find Clinical Trials Near You]+[<?php echo site_url();?>]"><img src="<?php echo get_template_directory_uri(); ?>/images/htt.png" alt="" height="32" width="32"></a></li>
                    <li><a target="_blank" href="https://instagram.com/studykik/#"><img src="<?php echo get_template_directory_uri(); ?>/images/hin.png" alt="" height="32" width="32"></a></li>
                    <li><a target="_blank" href="https://pinterest.com/pin/create/bookmarklet/?media=<?php echo site_url();?>/wp-content/themes/twentythirteen/images/logo.png&url=<?php echo site_url();?>&is_video=false&description=Find Clinical Trials Near You"><img src="<?php echo get_template_directory_uri(); ?>/images/hpt.png" alt="" height="32" width="32"></a></li>
                </ul>

            </div><!--/.nav-collapse -->
  </div>
</div>
