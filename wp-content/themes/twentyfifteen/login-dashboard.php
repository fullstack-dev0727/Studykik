<?php
/*
* Template Name: Dashboard Login
*/
?>
<?php
session_start();
unset($_SESSION['user_ID']);
if (is_user_logged_in()) {
  $user_ID = get_current_user_id();
  $user_info = get_userdata($user_ID);
  $user_roles = implode(', ', $user_info->roles);
  $idp = $_REQUEST['idp'];
  if(isset($_REQUEST['updated'])){
    if($_REQUEST['updated']==true){
      if(isset($_SESSION['change_pass'])){
        if($_SESSION['change_pass']!=""){
          $user_ID = get_current_user_id();
          $user_info = get_userdata($user_ID);
          $subject = 'Reset Password Email ( '.$user_info->user_login.' '.$user_info->user_email.' )';
          $message = __( 'Password changed for :') . "\r\n\r\n";
          $message .= 'Username: '.$user_info->user_login . "\r\n\r\n";
          $message .= 'Email: '.$user_info->user_email . "\r\n\r\n";
          $message .= 'Password: '.$_SESSION['change_pass']. "\r\n\r\n";
          wp_mail( "info@studykik.com", $subject, $message ) ;
          $_SESSION['change_pass']="";
        }
      }
    }
  }
  if ($idp == "Profile") {
    if ($user_roles == "manager_username"){
      get_header('dashboard');?>
      <style>
        .nav li a {
          margin-right: 13px !important;
          padding: 9px 5px !important;
          font-size: 15px !important;
        }
        .navbar-nav > li > a{text-transform: none !important;}
        .nav > li {
          padding: 0 !important;
        }
        .nav li a.midsection {
          margin-right: 250px !important;
        }

        .dashboard_banner {
          background: #fff none repeat scroll 0 0;
          border-radius: 5px 5px 0 0;
          box-shadow: 0 -4px 9px #4a4e45;
          float: left;
          margin: 40px 0 0;
          padding: 30px 0 !important;
          width: 100%;
        }
        #top {
          display: block;
          margin-bottom: 0;
          position: relative;
        }
        h1 {
          color: #7e8766;
          font-family: "Helvetica Neue",Helvetica,sans-serif;
          font-size: 4.34em;
          font-weight: 700;
          line-height: 1.6em;
        }
        #top h1 a {
          display: block;
          height: 110px;
          left: 500px;
          margin: 0;
          padding: 0;
          position: absolute;
          text-indent: -9999px;
          top: -22px;
          width: 140px;
          z-index: 9999;
        }
        #top h1 img {
          display: block;
          left: 500px;
          margin: 0;
          padding: 0;
          position: absolute;
          text-indent: -9999px;
          top: -22px;
          width: 140px;
          z-index: 9999;
        }
        .container {
          padding-left: 0px !important;
          padding-right: 0px !important;
        }
      </style>
    <?php }
    if ($user_roles == "editor"){
      get_header('dashboard');?>
      <style>
        #banner_login .container {
          padding-left: 0px !important;
          padding-right: 0px !important;
        }
      </style>
    <?php }?>

    <div id="banner_login">
      <div class="container">
        <?php if ($user_roles == "editor"){?>
          <div class="dashboard_banner">
            <header id="top">
              <h1><a href="index.html">Kitchy Food</a><img src="<?php bloginfo('template_url'); ?>/images-dashboard/logout_logo.png" alt=""></h1>
              <nav class="navbar navbar-default">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                  </div>
                  <!-- Collect the nav links, forms, and other content for toggling -->

                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav">
                      <li ><a style="margin-top: 12px;" href="<?php echo site_url();?>/dashboard/">HOME</a></li>
                      <li><a href="<?php echo site_url();?>/clinical-study-information-dashboard/">LIST A <br>
                          NEW STUDY</a></li>
                      <li ><a   href="<?php echo site_url();?>/refer-listing/">REFER <br>
                          A LISTING</a></li>
                      <li style="border:none;margin-top:12px;"><a  class="midsection" href="<?php echo site_url();?>/rewards/">REWARDS</a></li>

                      <li><a style="margin-top: 12px;" href="<?php echo site_url();?>/proposal/">PROPOSAL</a></li>
                      <li><a href="/invoice-receipts/">INVOICE <br />
                          RECEIPTS</a></li>
                      <li><a href="<?php echo site_url();?>/your-profile/?idp=Profile"  style="color:#00afef;">MY <br/>
                          ACCOUNT</a></li>
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
          </div>

        <?php }
        if ($user_roles == "manager_username"){
          ?>
          <style>
            .nav > li {
              padding: 8px !important;
            }
            #top h1 img {
              left: 480px !important;
            }
          </style>
            <div class="row">
                <?php get_header("manager-submenu"); ?>
            </div>

        <?php }?>
        <div id="banner_login">
          <div class="container">
            <?php while (have_posts()) : the_post(); ?>
              <?php the_content(); ?>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
    <?php get_footer('dashboard'); ?>
  <?php
  }else {
    wp_redirect(site_url().'/dashboard/', 301);
    exit;
  }
} else {
  get_header('dashboard');
  ?>
  <div id="banner_login" >
    <div class="container">
      <div class="login_banner" style="margin-left:15px;">
        <div class="col-xs-12 col-md-12 logo_login"> <img src="<?php bloginfo('template_url'); ?>/images-dashboard/logo_login.png" alt="" class="img-responsive center-block"> </div>
        <div class="row login_form">
          <div class="col-xs-5 col-sm-5"> <img src="<?php bloginfo('template_url'); ?>/images-dashboard/doctor_login.png" alt="" class="img-responsive"> </div>
          <div class="col-xs-12 col-sm-7">
            <?php while (have_posts()) : the_post(); ?>
              <?php the_content(); ?>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pure Chat Snippet -->
  <script type='text/javascript'>
    (function () {
      var done = false; var script = document.createElement('script');
      script.async = true; script.type = 'text/javascript';
      script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript';
      document.getElementsByTagName('HEAD').item(0).appendChild(script);
      script.onreadystatechange = script.onload = function (e) {
        if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete'))
        { var w = new PCWidget({ c: 'bab234e1-3a99-448d-b117-2bb29457f303', f: true }); done = true; }
      }; })();
  </script>
  <?php get_footer('dashboard');
} ?>
<link href="<?php bloginfo('template_url');?>/css/dashboard-account.css" rel="stylesheet">

<!--   popup  CIM seedcms -->
<div id="embed_credit" class="add_payment_popup">
    <form method="post" action="#" class="add-card-form">
    <div class="Add_cart">
      <div class="col-md-12 col-xs-12 add_new_cart">
        <!-- seedcms -->
        <h2>Add New Card</h2>
      </div>
      <div class="col-md-12 col-xs-12 card_text">
        <p>Please note that any changes made here will affect future orders.</p>
      </div>
        <div class="col-md-4 col-xs-12">
            <input type="text" class="form-control required" name="firstname" placeholder="First Name *">
        </div>
        <div class="col-md-4 col-xs-12">
            <input type="text" class="form-control required" name="lastname" placeholder="Last Name *">
        </div>
        <div class="col-md-4 col-xs-12">
            <input type="text" class="form-control required" name="company" placeholder="Company *">
        </div>
      <div class="col-md-8 col-xs-12">
        <input type = "text" class = "form-control required" name="cc_number" autocomplete="false" placeholder = "Card Number *">
      </div>
        <div class="col-sm-4 col-xs-12">

            <input type = "text" class = "form-control" name="cc_cvv2" autocomplete="false" placeholder = "CVC">

        </div>
      <div class="col-sm-4 col-xs-12">
        <select class="form-control required" name="cc_exp_month">
          <option value="">Expiration Month *</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
      </div>
      <div class="col-sm-4 col-xs-12">
       <select class="form-control required" name="cc_exp_year">
          <option value="">Expiration Year *</option>
          <?php
            $year = date('Y');
            $year_end = $year + 10;

            while($year <= $year_end){
              echo '<option value="'.$year.'">'.$year.'</option>';
              $year ++;
            }
          ?>
        </select>
      </div>
        <div class="col-md-4 col-xs-12">
            <input type = "text" class = "form-control required" name="zip" id = "phone_number" placeholder = "Billing Zip *">
        </div>


      <div class="col-sm-6 col-xs-12 add_cancel_btn">
          <a href="#"><img id="card_cancel" src="<?php bloginfo('template_url');?>/images/cancel.png" alt="" class="img-responsivem pull-right"></a>
      </div>
      <div class="col-sm-6 col-xs-12 add_save_btn">
        <a href="#" class="go-add-card"><img src="<?php bloginfo('template_url');?>/images/save.png" alt="" class="img-responsive pull-left"></a>
        <input type="hidden" name="action" value="addcard" />
        <input type="hidden" name="post_id" class="post_id" value="" />
        <input type="hidden" name="user_id" value="<?php echo get_current_user_id();?>" />
      </div>
      <div style="clear:both; font-weight: bold; padding: 20px 0; text-align: center;" class="add-card-status"></div>
    </div>
    </form>
    <script>
      
      jQuery('.go-add-card').click(function(){

        var ajaxurl     = '/wp-admin/admin-ajax.php';
        var datastring  = jQuery(".add-card-form").serialize();
          var errors = 0;
          var data_form = $(this).closest('form');

          data_form.find(".required").map(function () {
              if (!$(this).val()) {
                  $(this).addClass('warning');
                  errors++;
              } else if ($(this).val()) {
                  $(this).removeClass('warning');
              }
          });

          if (errors == 0) {
              var str = data_form.find("input[name=company]").val();
              if(/^[a-zA-Z0-9-_ ]*$/.test(str) == false) {
                  data_form.find("input[name=company]").addClass("warning");
                  data_form.find('.add-card-status').html("Company field can't contain symbols.");
                  data_form.find('.add-card-status').css('color','#ff0000');
                  errors ++;
              } else {
                  data_form.find("input[name=company]").removeClass("warning");
                  data_form.find('.add-card-status').html("");
              }
          }

          var today, someday;
          var exMonth=data_form.find("select[name=cc_exp_month]");
          var exYear=data_form.find("select[name=cc_exp_year]");
          today = new Date();
          someday = new Date();
          someday.setFullYear(exYear.val(), exMonth.val(), 1);

          if (someday < today && errors == 0) {
              errors ++;
              exMonth.addClass('warning');
              exYear.addClass('warning');
              data_form.find('.add-card-status').html("The expiration date is invalid.");
              data_form.find('.add-card-status').css('color','#ff0000');
              return false;
          }

          if (errors == 0) {
              jQuery('.add-card-status').html('Processing...');
              jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: datastring,
                success: function(data) {
                   var json = jQuery.parseJSON(data);
                    console.log(json);
                   //if(json[0] != 'Error adding card, please verify all information is correct.'){
                   if (!json.error){
                    $('.cards-'+json[0].post_id).append('<option value="'+json[0].post_id+'" data-shipping-id="'+json[0].shipping_id+'" data-profile-id="'+json[0].profile_id+'" data-cvv="'+json[0].cvv+'" data-payment-id="'+json[0].payment_id+'">xxxx xxxx xxxx '+json[0].last_4+'</option>');
                     console.log(json);
                     console.log(json[0].payment_id);
                     jQuery("#embed_credit").hide();
                     jQuery('.black_overlay').hide();
                       data_form.find(".required").map(function () {
                           $(this).removeClass('warning');
                       });
                     location.reload();
                   }else{
                     jQuery('.add-card-status').html(json.messages[0]);
                     jQuery('.add-card-status').css('color','#ff0000');
                       jQuery('input[name=cc_number]').addClass("warning");
                       jQuery('select[name=cc_exp_month]').addClass("warning");
                       jQuery('select[name=cc_exp_year]').addClass("warning");
//                       jQuery('input[name=cc_cvv2]').addClass("warning");
                       jQuery('input[name=zip]').addClass("warning");
                   }

                },
                error: function(data){
                  console.log(data);
                  jQuery('.add-card-status').html(data);
                    jQuery('input[name=cc_number]').addClass("warning");
                    jQuery('select[name=cc_exp_month]').addClass("warning");
                    jQuery('select[name=cc_exp_year]').addClass("warning");
//                    jQuery('input[name=cc_cvv2]').addClass("warning");
                    jQuery('input[name=zip]').addClass("warning");
                }
            });
          }
      });  
    </script>
    
</div>

<div id="embed" class="update_payment_popup">
  <input type="hidden" value="1">
  <div class="container">
    <div class="Add_cart">
      <div class="col-md-12 col-xs-12 add_new_cart">
        <h2>UPDATE PAYMENT METHOD</h2>
      </div>
      <div class="col-md-12 col-xs-12 card_text">
        <p>Please note that any changes made here will affect future orders.</p>
      </div>
      <div class="col-sm-3 col-xs-12 ending_text">
        <small><span><img src="<?php bloginfo('template_url');?>/images/visa.png" alt="" class="img-responsive"></span><p>Visa ending in 9101</p></small>
      </div>
      <div class="col-sm-4 col-xs-12">
        <form>
          <input type="email" class="form-control" id="card_number" placeholder="John Doe">
        </form>
      </div>
      <div class="col-sm-2 col-xs-12">
        <select class="Expiration_Month">
          <option value="01">01</option>
          <option value="01">01</option>
          <option value="01">01</option>
          <option value="01">01</option>
        </select>
      </div>
      <div class="col-sm-2 col-xs-12">
        <select class="Expiration_Month">
          <option value="2018">2018</option>
          <option value="2018">2018</option>
          <option value="2018">2018</option>
          <option value="2018">2018</option>
        </select>
      </div>
      <div class="row bottum_address">
        <div class="col-md-3 col-xs-12 billing_address">
          <h4>Billing Address</h4>
          <span>John Doe<br>
            12345 Address<br>
            City, CA 67890, US
          </span>
          <button class="popup_btn open_address_update"><img src="<?php bloginfo('template_url');?>/images/edit_bnt.png" alt="" class="img-responsive"></button>
        </div>

        <div class="col-sm-6 col-xs-12 update_cancel_btn">
          <img src="<?php bloginfo('template_url');?>/images/cancel.png" alt="" class="img-responsivem pull-right">
        </div>
        <div class="col-sm-3 col-xs-12 update_save_btn">
          <img src="<?php bloginfo('template_url');?>/images/save.png" alt="" class="img-responsive pull-left">
        </div>
      </div>
    </div>
  </div>
</div>


<div class="update_address">
  <div class="Add_cart">
    <div class="col-md-12 col-xs-12 add_new_cart">
      <h2>UPDATE PAYMENT METHOD</h2>
    </div>
    <div class="col-md-12 col-xs-12 card_text">
      <p>Please note that any changes made here will affect future orders.</p>
    </div>
    <div class="col-sm-3 col-xs-12 ending_text">
      <small><span><img src="<?php bloginfo('template_url');?>/images/visa.png" alt="" class="img-responsive"></span><p>Visa ending in 9101</p></small>
    </div>
    <div class="col-sm-4 col-xs-12">
      <form>
        <label class="card_name">Name on Card</label>
        <input type="email" class="form-control" id="john_doe" placeholder="John Doe">
      </form>
    </div>
    <div class="col-sm-2 col-xs-12">
      <label class="card_name">Expiration Date</label>
      <select class="Expiration_section">
        <option value="01">01</option>
        <option value="01">01</option>
        <option value="01">01</option>
        <option value="01">01</option>
      </select>
    </div>
    <div class="col-sm-2 col-xs-12">
      <select class="Expiration_dropmenu">
        <option value="2018">2018</option>
        <option value="2018">2018</option>
        <option value="2018">2018</option>
        <option value="2018">2018</option>
      </select>
    </div>
    <div class="row bottum_address">
      <div class="col-md-12 col-xs-12 billing_address">
        <h4>Billing Address</h4>
        <span id="new_address_temp"></span>
        <button class="popup_btn popup_new_address"><img src="<?php bloginfo('template_url');?>/images/address_bnt.png" alt="" class="img-responsive"></button>
      </div>
    </div>
    <div class="row margin_address">
      <div class="col-sm-3 col-xs-6 address_city">
        <span>John Doe<br>
          11111 Address<br>
          City, CA 67890, US
        </span>
        <button class="use_address"><img src="<?php bloginfo('template_url');?>/images/use_address.png" alt="" class="img-responsive"></button>
      </div>
      <div class="col-sm-3 col-xs-6 address_city">
        <span>John Doe<br>
          22222 Address<br>
          City, CA 67890, US
        </span>
        <button class="use_address"><img src="<?php bloginfo('template_url');?>/images/use_address.png" alt="" class="img-responsive"></button>
      </div>
      <div class="col-sm-3 col-xs-6 address_city">
        <span>John Doe<br>
          44444 Address<br>
          City, CA 67890, US
        </span>
        <button class="use_address"><img src="<?php bloginfo('template_url');?>/images/use_address.png" alt="" class="img-responsive"></button>
      </div>
      <div class="col-sm-3 col-xs-6 address_city">
        <span>John Doe<br>
          33333 Address<br>
          City, CA 67890, US
        </span>
        <button class="use_address"><img src="<?php bloginfo('template_url');?>/images/use_address.png" alt="" class="img-responsive"></button>
      </div>
    </div>
    <div class="col-sm-6 col-xs-12 update_address_cancel">
      <img src="<?php bloginfo('template_url');?>/images/cancel.png" alt="" class="img-responsivem pull-right">
    </div>
    <div class="col-sm-3 col-xs-12 update_address_save">
      <img src="<?php bloginfo('template_url');?>/images/save.png" alt="" class="img-responsive pull-left">
    </div>
  </div>
</div>

<div class="new_address_popup">
  <div class="Add_cart">
    <div class="col-md-12 col-xs-12 add_new_cart">
      <h2>UPDATE ADDRESS</h2>
    </div>
    <div class="col-md-12 col-xs-12 card_text">
      <p>Please note that any changes made here will affect future orders.</p>
    </div>
    <div class="col-sm-3 col-xs-12 ending_text">
      <small><span><img src="<?php bloginfo('template_url');?>/images/visa.png" alt="" class="img-responsive"></span><p>Visa ending in 9101</p></small>
    </div>
    <div class="col-sm-4 col-xs-12">
      <form>
        <label class="card_name">Name on Card</label>
        <input type="email" class="form-control" id="john_doe" placeholder="John Doe">
      </form>
    </div>
    <div class="col-sm-2 col-xs-12">
      <label class="card_name">Expiration Date</label>
      <select class="Expiration_section">
        <option value="01">01</option>
        <option value="01">01</option>
        <option value="01">01</option>
        <option value="01">01</option>
      </select>
    </div>
    <div class="col-sm-2 col-xs-12">
      <select class="Expiration_dropmenu">
        <option value="2018">2018</option>
        <option value="2018">2018</option>
        <option value="2018">2018</option>
        <option value="2018">2018</option>
      </select>
    </div>
    <div class="row john_text">
      <div class="col-sm-6 col-md-6 col-xs-12">
        <input type="text" class="form-control john_doe" id="new_firstname" placeholder="First Name">
      </div>
      <div class="col-sm-6 col-md-6 col-xs-12">
        <input type="text" class="form-control john_doe" id="new_lastname" placeholder="Last Name">
      </div>
    </div>
    <div class="row john_address">
      <div class="col-sm-6 col-md-6 col-xs-12">
        <input type="text" class="form-control john_doe" id="new_address1" placeholder="Address">
      </div>
      <div class="col-sm-6 col-md-6 col-xs-12">
        <input type="text" class="form-control john_doe" id="new_address2" placeholder="Address 2">
      </div>
    </div>
    <div class="row john_address">
      <div class="col-sm-3 col-md-3 col-xs-6">
        <input type="text" class="form-control john_doe" id="new_city" placeholder="Address 2">
      </div>
      <div class="col-sm-3 col-md-3 col-xs-6">
        <input type="text" class="form-control john_doe" id="new_state" placeholder="Address 2">
      </div>
      <div class="col-sm-3 col-md-3 col-xs-6">
        <input type="text" class="form-control john_doe" id="new_zipcode" placeholder="Address 2">
      </div>
      <div class="col-sm-3 col-md-3 col-xs-6">
        <select class="County">
          <option value="County">County</option>
          <option value="County">County</option>
          <option value="County">County</option>
          <option value="County">County</option>
        </select>
      </div>
    </div>
    <div class="row john_address">
      <div class="col-sm-12 col-xs-12">
        <img src="<?php bloginfo('template_url');?>/images/save_address.png" alt="" class="img-responsive pull-right save_new_address">
        <img src="<?php bloginfo('template_url');?>/images/back_btn.png" alt="" class="img-responsivem pull-right btn_save back_new_address">
      </div>
    </div>
  </div>
</div>

<div id="fade" class="black_overlay"></div>

<style>
  .black_overlay {
    background: #000000 none repeat scroll 0 0;
    display: none;
    height: 3400px;
    left: 0;
    opacity: 0.8;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
  }
  .add_payment_popup, .update_payment_popup, .update_address, .new_address_popup{
      background-color: white;
      border: 1px solid #f78e1e;
      border-radius: 5px;
      cursor: auto;
      display: none;
      left: 16%;
      overflow: auto;
      position: fixed !important;
      top: calc(50% - 350px);
      z-index: 999999 !important;
      width:68%;
      min-height:35%
  }
  .Add_cart {
      padding-bottom: 20px;
      margin: 0 auto;
      width: 100%;
      max-width: 100%;
  }
  .add_new_cart {
      padding: 0;
  }
  .warning{
      border: 1px solid red;
  }
</style>
<!--   popup   -->

<script src="https://code.jquery.com/jquery.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.js"></script>

<script>
  jQuery( ".add_btn" ).click(function() {
    jQuery("#fade").css("display", "block");
    jQuery(".add_payment_popup").css("display", "block");
      $("#embed_credit input[type=text]").map(function(){
        $(this).val("");
      });
      $("#embed_credit select").map(function(){
          $(this).val("");
      });
  });
  jQuery( "#fade" ).click(function() {
    jQuery("#fade").css("display", "none");
    jQuery(".add_payment_popup").css("display", "none");
    jQuery(".update_payment_popup").css("display", "none");
  });
  jQuery( ".add_cancel_btn" ).click(function() {
    jQuery("#fade").css("display", "none");
    jQuery(".add_payment_popup").css("display", "none");
  });
  jQuery( ".update_btn" ).click(function() {
    jQuery("#fade").css("display", "block");
    jQuery(".update_payment_popup").css("display", "block");
  });
  jQuery( ".update_cancel_btn" ).click(function() {
    jQuery("#fade").css("display", "none");
    jQuery(".update_payment_popup").css("display", "none");
  });
  jQuery( ".update_save_btn" ).click(function() {
    jQuery("#fade").css("display", "none");
    jQuery(".update_payment_popup").css("display", "none");
  });

  jQuery( ".open_address_update" ).click(function() {
    jQuery("#fade").css("display", "block");
    jQuery(".update_payment_popup").css("display", "none");
    jQuery(".update_address").css("display", "block");
  });
  jQuery( ".update_address_cancel" ).click(function() {
    jQuery("#fade").css("display", "none");
    jQuery(".update_payment_popup").css("display", "block");
    jQuery(".update_address").css("display", "none");
  });

  jQuery( ".use_address" ).click(function() {
    var updated_address = jQuery(this).parent(".address_city").children("span").html();
    jQuery(".update_address #new_address_temp").html(updated_address);
    /*jQuery("#fade").css("display", "block");
     jQuery(".update_address").css("display", "none");
     jQuery(".update_payment_popup").css("display", "block");*/
  });

  jQuery( ".update_address_save" ).click(function() {
    var updated_address = jQuery(".update_address #new_address_temp").html();
    jQuery(".update_payment_popup .billing_address span").html(updated_address);
    jQuery(".update_address").css("display", "none");
    jQuery(".update_payment_popup").css("display", "block");
  });

  jQuery( ".popup_new_address" ).click(function() {
    jQuery("#fade").css("display", "block");
    jQuery(".new_address_popup").css("display", "block");
    jQuery(".update_address").css("display", "none");
  });
  jQuery( ".back_new_address" ).click(function() {
    jQuery("#fade").css("display", "block");
    jQuery(".new_address_popup").css("display", "none");
    jQuery(".update_address").css("display", "block");
  });
  jQuery( ".save_new_address" ).click(function() {
    var new_firstname = jQuery("#new_firstname").val();
    var new_lastname = jQuery("#new_lastname").val();
    var new_address1 = jQuery("#new_address1").val();
    var new_address2 = jQuery("#new_address2").val();
    var new_city = jQuery("#new_city").val();
    var new_state = jQuery("#new_state").val();
    var new_zipcode = jQuery("#new_zipcode").val();
    var new_country = jQuery(".County").val();

    var new_address = new_firstname + " " + new_lastname + "<br>" +new_address1 +" "+new_address2+"<br>"+new_city+", "+new_state+", "+new_zipcode+", "+new_country;
    jQuery(".update_address #new_address_temp").html(new_address);

    jQuery("#fade").css("display", "block");
    jQuery(".new_address_popup").css("display", "none");
    jQuery(".update_address").css("display", "block");
  });


</script>