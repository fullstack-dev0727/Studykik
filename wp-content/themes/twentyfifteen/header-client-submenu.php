<!--<div class="row">-->
<?php
//print_r(get_page_link());
//print_r(site_url()."/rewards/");
//?>
  <div class="dashboard_banner">
    <header id="top">
    <h1>
<!--        <a href="/">Kitchy Food</a>-->
        <img src="<?php bloginfo('template_url'); ?>/images-dashboard/logout_logo.png" alt=""></h1>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class='<?= ( get_page_link() == site_url()."/dashboard/" ) ? "active" : ""?>'>
                <a style="margin-top: 12px;" href="<?php echo site_url();?>/dashboard/">HOME</a>
            </li>
            <li class='<?= ( get_page_link() == site_url()."/clinical-study-information-dashboard/" ) ? "active" : ""?>'>
                <a href="<?php echo site_url();?>/clinical-study-information-dashboard/">LIST A <br>
              NEW STUDY</a>
            </li>
            <li class='<?= ( get_page_link() == site_url()."/refer-listing/" ) ? "active" : ""?>'>
                <a   href="<?php echo site_url();?>/refer-listing/">REFER <br>A LISTING</a>
            </li>
            <li class='<?= ( get_page_link() == site_url()."/rewards/" ) ? "active" : ""?>' style="border:none; margin-top: 12px;">
                <a  class="midsection" href="<?php echo site_url();?>/rewards/">REWARDS</a>
            </li>

            <li class='<?= ( get_page_link() == site_url()."/proposal/" ) ? "active" : ""?>'>
                <a style="margin-top: 12px;" href="<?php echo site_url();?>/proposal/">PROPOSAL</a>
            </li>
            <li class='<?= ( get_page_link() == site_url()."/invoice-receipts/" ) ? "active" : ""?>'>
                <a href="/invoice-receipts/">INVOICE <br />RECEIPTS</a>
            </li>
            <li class='<?= ( get_page_link() == site_url()."/your-profile/" ) ? "active" : ""?>'>
                <a href="<?php echo site_url();?>/your-profile/?idp=Profile">MY <br/>ACCOUNT</a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    </header>
      <div class="project_manager">
          <h5>Stud<small>y</small><cite>KIK</cite> Site / Sales Manager: <span><?php echo get_user_meta($user_ID, 'project_manager', true); ?></span> - <span><?php echo get_user_meta($user_ID, 'phone_number', true); ?></span></h5>
          <h5>Stud<small>y</small><cite>KIK</cite> Study Support: <span><?php echo get_user_meta($user_ID, 'account_executive', true); ?></span> - <span><?php echo get_user_meta($user_ID, 'account_executive_phone_number', true); ?></span></h5>
      </div>
    <?php
        $user_ID = get_current_user_id();
        $credits = get_user_meta($user_ID, 'callfire_credits', true);
        $result = $wpdb->get_results("
            SELECT posts.ID, meta.meta_value
            FROM 0gf1ba_posts AS posts JOIN 0gf1ba_postmeta AS meta ON posts.ID = meta.post_id
            WHERE (meta.meta_key = 'purchased_number' OR meta.meta_key = 'text_message_purchased_number')
            AND meta.meta_value != ''
            AND posts.post_author = ".$user_ID."
            LIMIT 1;
        ");
        $class_name = false;
        $purchased_number = (count($result) !== 0);

        switch(true){
            case $credits > 99 && $credits < 1000:
                $class_name = 'fix-textsize';
                break;
            case ($credits < 0):
                $class_name = 'fix-textsize';
                break;
            case $credits >= 1000 && $credits < 10000:
                $class_name = 'fix-textsize-16';
                break;
            case $credits >= 10000 && $credits < 100000:
                $class_name = 'fix-textsize-12';
                break;
            case $credits >= 100000:
                $class_name = 'fix-textsize-10';
                break;
        }

        if(get_page_link() == site_url()."/dashboard/" && ($purchased_number || $credits > 0)){
    ?>
    <div class="cf-credits">
        <div class="user_creditscount_view" href="javascript:void(0);">
            <img title="Account Credits" src="<?php echo get_template_directory_uri(); ?>/images/buttons_v2/Account-Credits-Button.png">
            <span class="credits-count<?php if($class_name){ echo ' '.$class_name; } ?>"><?php echo $credits; ?></span>
        </div>
        <a title="Add Credits" style="" class="buycredits_view buycredits" href="javascript:void(0);">
            <img src="<?php echo get_template_directory_uri(); ?>/images/buttons_v2/buy-credits-button.png">
        </a>
    </div>
    <?php
        }
    ?>
</div>
<!--</div>-->