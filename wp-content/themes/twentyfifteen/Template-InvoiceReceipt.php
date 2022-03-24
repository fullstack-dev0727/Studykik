<?php
/*
 * Template Name: INVOICE RECEIPTS
 */
?>
<?php
if (is_user_logged_in()) {
    $user_ID = get_current_user_id();
} else {
    wp_redirect(site_url().'/login/', 301);
    exit;
}
?>
<?php get_header('dashboard'); ?>
<div id="banner_login">
    <div class="container">
        <div class="row">
            <div class="dashboard_banner">
                <header id="top">
                    <h1><a href="/">Kitchy Food</a><img src="<?php bloginfo('template_url'); ?>/images-dashboard/logout_logo.png" alt=""></h1>
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li ><a style="margin-top: 12px; color:#00afef;" href="<?php echo site_url();?>/dashboard/">Home</a></li>
                                    <li><a href="<?php echo site_url();?>/refer-listing/">REFER <br>
                                            A LISTING</a></li>
                                    <li  style="border:none;"><a class="midsection" href="<?php echo site_url();?>/clinical-study-information-dashboard/">LIST A <br>
                                            NEW STUDY</a></li>
                                    <li><a style="margin: 12px 0 0 66px;font-size:0px;" href="">.</a></li>
                                    <li><a href="<?php echo site_url();?>/your-profile/?idp=Profile">MY <br/>ACCCOUNT</a></li>
                <li><a style="margin-top: 12px;" href="<?php echo site_url();?>/proposal/">PROPOSAL</a></li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.container-fluid -->
                    </nav>

                    <div class="project_manager">
                        <h5>Stud<small>y</small><cite>KIK</cite> Project Manager: <span><?php echo get_user_meta($user_ID, 'project_manager', true); ?></span> - <span><?php echo get_user_meta($user_ID, 'phone_number', true); ?></span></h5>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer('dashboard'); ?>