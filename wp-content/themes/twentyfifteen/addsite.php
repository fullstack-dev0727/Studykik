<?php
/*
 * Template Name: Add Site
 */
if ( !is_user_logged_in() ) {
    wp_redirect( site_url().'/login/', 301 ); exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Site -StudyKIK </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?php echo get_template_directory_uri(); ?>/css/addsite/bootstrap.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/css/addsite/admin.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/css/addsite/media.css" type="text/css" rel="stylesheet">
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
  <style>
    .warning{border: 1px solid red !important;}
    .nav > li {
      padding:6px !important;
    }
    #top h1 img {
      left: 480px !important;
    }
    .padtop, .navbar-nav.padtop {
      margin-top: 15px !important;
    }
    .top_right {
      margin-top: 40px !important;
    }
  </style>
</head>
<body>
<div role="navigation" class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header padtop"> <a href="<?php echo site_url();?>" class="navbar-brand"><img src="<?php bloginfo('template_url'); ?>/siteimg/logo.png" alt=""></a> </div>
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
<div id="banner_login">
<div class="container">

<div class="row">
  <?php get_header("manager-submenu"); ?>
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery('#site_email').blur(function(e) {
      var emailok = false;
      var site_email=jQuery('#site_email').val();
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(regex.test(site_email)){
        jQuery.ajax({
          url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
          type: 'POST',
          data: "action=dashboard_add_email&email="+site_email,
          beforeSend: function(){
            jQuery('#emailInfo').html("<span style='float:right;margin-right:59px;margin-top:-10px;'>Checking Email</span>"); //show checking or loading image
          },
          success: function(html){
            if(html != 0){
              emailok = false;
              if (jQuery('#site_email').val() !='' ){
                jQuery('#emailInfo').html("<span style='color:red;float:right;margin-right:59px;margin-top:-10px;'>Email Already Exist</span>");
                jQuery('#site_email').addClass('warning');
                jQuery('#site_email').val("");
              }
            }
            if(html == 0)
            {
              emailok = true;
              if (jQuery('#site_email').val() !='' ){
                jQuery('#emailInfo').html("<span style='color:green;margin-right:59px;float:right;margin-top:-10px;'>Email OK</span>");
                jQuery('#site_email').removeClass('warning');
              }
            }
          }
        })
      }
      else{
        jQuery('#emailInfo').html("<span style='color:red;float:right;margin-right:59px;margin-top:-10px;'>Invalid Email</span>");
        jQuery('#site_email').addClass('warning');
      }
    });

    jQuery('#site_uname').blur(function(e) {
      var username_check = false;
      var site_uname = jQuery('#site_uname').val();

      if(site_uname != ""){
        jQuery.ajax({
          url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
          type: 'POST',
          data: "action=check_username&username="+site_uname,
          beforeSend: function(){
            jQuery('#userinfo').html("<span style='float:right;margin-right:59px;margin-top:-10px;'>Checking Username</span>"); //show checking or loading image
          },
          success: function(html){
            if(html != 0){
              username_check = false;
              if (site_uname !='' ){
                jQuery('#userinfo').html("<span style='color:red;float:right;margin-right:59px;margin-top:-10px;'>Username Already Exist</span>");
                jQuery('#site_uname').addClass('warning');
              }
            }
            if(html == 0){
              username_check = true;
              if (site_uname !='' ){
                jQuery('#userinfo').html("<span style='color:green;margin-right:59px;float:right;margin-top:-10px;'>Username OK</span>");
                jQuery('#site_uname').removeClass('warning');
              }
            }
          }
        });
      } else {
        jQuery('#site_uname').addClass('warning');
        jQuery('#userinfo').html("");
      }

    });

    jQuery('#form_add').submit(function() {
      var errors = 0;
      var email_check = $('#emailInfo span').html();
      var user_check = $('#userinfo span').html();

      jQuery("#form_add .required").map(function(){
        if( !jQuery(this).val() ) {
          jQuery(this).addClass('warning');
          errors++;
        } else if (jQuery(this).val()) {
          jQuery(this).removeClass('warning');
        }
      });

      if(email_check != "Email OK"){
        errors++;
      }else if (user_check != "Username OK"){
        errors++;
      }
      if(errors > 0){
        return false;
      }

      if (jQuery('#site_password').val() == jQuery('#site_cpassword').val()) {
        if (jQuery('#site_password').val() !='' && jQuery('#site_cpassword').val() !=''){
          jQuery('#message').html("<span style='color:green;margin-left:408px; margin-top: -10px;'>Password Match</span>");
        }
        return true;
      } else {
        jQuery('#message').html("<span style='color:red;margin-left:353px; margin-top: -10px;'>Passwords do not match</span>");
        return false;
      }



    });

    jQuery('#site_cpassword').on('keyup', function () {
      if (jQuery('#site_password').val() == jQuery('#site_cpassword').val()) {
        jQuery('#message').html("<span style='color:green;margin-left:408px;'>Password Match</span>");
        return true;
      } else{
        jQuery('#message').html("<span style='color:red;margin-left:353px;'>Passwords do not match</span>");
        return false;
      }
    });

  });
</script>

<div class="row">
  <section class="container_current">
    <div class="full_section">
      <div class="col-lg-12 col-md-12 col-xs-12"> <img src="<?php bloginfo('template_url'); ?>/siteimg/center_logo.png" alt="" class="img-responsive center-block"> </div>
      <div class="row clearfix">
        <div class="col-md-6 col-md-offset-3 column">
          <?php
          if(isset($_POST['submit'])){

            $sitenameErr = $siteunameErr = $sitecpersonErr = $siteemailErr = $passwordErr = $cpasswordErr = $siteaddressErr ="";
            $sitename = $siteuname = $sitecperson = $siteemail = $password = $cpassword = $siteaddress = "";

            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
            if (empty($_POST["site_name"])) {
              $sitenameErr = "Site Name is required";
            } else {
              $sitename = test_input($_POST["site_name"]);
            }
            if (empty($_POST["site_uname"])) {
              $siteunameErr = "Username is required";
            } else {
              $siteuname = test_input($_POST["site_uname"]);
            }
            if (empty($_POST["site_cperson"])) {
              $sitecpersonErr= "Site contact person is required";
            } else {
              $sitecperson = test_input($_POST["site_cperson"]);
            }
            if (empty($_POST["site_email"])) {
              $siteemailErr= "Site email is required";
            } else {
              $siteemail = test_input($_POST["site_email"]);
            }
            if (empty($_POST["site_address"])) {
              $siteaddressErr= "Site address is required";
            } else {
              $siteaddress = test_input($_POST["site_address"]);
            }
            if (empty($_POST["site_password"])) {
              $passwordErr= "Password is required";
            } else {
              $password = test_input($_POST["site_password"]);
            }
            if (empty($_POST["site_cpassword"])) {
              $cpasswordErr= "Confirm Password is required";
            } else {
              $cpassword = test_input($_POST["site_cpassword"]);
            }

            $sitename=$_POST['site_name'];
            $siteuname=$_POST['site_uname'];
            $sitecperson=$_POST['site_cperson'];
            $siteemail=$_POST['site_email'];
            $password=$_POST['site_password'];
            $cpassword=$_POST['site_cpassword'];
            $siteaddress=$_POST['site_address'];
            $url=site_url().'/add-site/';

            $userdata = array(
              'user_login'  =>  $siteuname,
              'nickname'    =>  $sitecperson,
              'user_pass'   =>  $password,
              'user_email' =>   $siteemail,
              'role'       =>   'editor',
              'user_url'   =>    $url
            );
            $user_id = wp_insert_user( $userdata ) ;
            $meta_key='add_manager_id';
            $meta_value=get_current_user_id();
            add_user_meta( $user_id, $meta_key, $meta_value, $unique );
            $meta_key='manager';
            $prev_value='';
            update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );
            $meta_key='address';
            $meta_value=$siteaddress;
            update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );
            $meta_key='sitename';
            $meta_value=$sitename;
            update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );

          }
          ?>

          <form class="form_section" method="post" action="" id="form_add">
            <h6>ADD A SITE TO YOUR PORTAL</h6>
            <div class="inner-form">
              <div>
                <input type="text" class="form-control center-block site_form required" id="site_name" name="site_name" placeholder="Site Name"/>
              </div>
              <div>
                <input type="text" class="form-control center-block site_form required" id="site_uname" name="site_uname" placeholder="Username"/>
                <div id="userinfo"></div>
              </div>
              <div>
                <input type="text" class="form-control center-block site_form required" id="site_cperson" name="site_cperson" placeholder="Site Contact Person (Full Name)"/>
              </div>
              <div>
                <input type="email" class="form-control center-block site_form required" placeholder="Site Email" id="site_email" name="site_email" />
                <div id="emailInfo"></div>
              </div>
              <div>
                <input type="text" class="form-control center-block site_form required" id="site_address" name="site_address" placeholder="Site Address"/>
              </div>
              <div>
                <input type="text" class="form-control center-block site_form required" id="site_password" name="site_password" onclick="password1()" onblur="password2()" placeholder="Password"/>
              </div>
              <div>
                <input type="text" class="form-control center-block site_form required" id="site_cpassword" name="site_cpassword" onclick ="cpassword1()" onblur="cpassword2()" placeholder="Confirm Password"/>
                <div id='message' style="margin-top: -10px;"></div>
              </div>
              <button type="submit" class="submit_site" name="submit" id="submit"><img src="<?php bloginfo('template_url'); ?>/siteimg/submit_site.png" alt="" class="img-responsive center-block"></button>
            </div>
          </form>

        </div>
      </div>
      <div class="left_girl">
        <img src="<?php bloginfo('template_url'); ?>/siteimg/left_girl.png" alt="" class="img-responsive">
      </div>
    </div>
  </section>
</div>
</div>
</div>

<footer>
  <div class="container">
    <div class="col-xs-12 col-sm-12 clo-lg-6">
      <ul>
        <li><a href="<?php echo site_url();?>">HOME PAGE</a></li>
        <li><a href="<?php echo site_url();?>/contact/">CONTACT US</a></li>
        <li><a href="<?php echo site_url();?>/clinical-trial-patient-recruitment-patient-enrollment/">LIST YOUR TRIAL</a></li>
      </ul>
    </div>
  </div>
</footer>
<script src="https://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.labelify.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/addsite/bootstrap.js"></script>
</body>
</html>
<script type="text/javascript"> jQuery(document).ready(function(){


    jQuery(":input").labelify();

  }); </script>
<script>
  function password1()
  {
    var val_pass = jQuery('#site_password').val();
    jQuery('#site_password').attr('type', 'password');

  }

  function password2()
  {
    var val_pass = jQuery('#site_password').val();

    if(val_pass == '' || val_pass == 'Password' )
    {
      jQuery('#site_password').attr('type', 'text');
    }
    else{
      jQuery('#site_password').attr('type', 'password');
    }


  }

  function cpassword1(){
    var val_passc = jQuery('#site_cpassword').val();

    jQuery('#site_cpassword').attr('type','password');

  }


  function cpassword2(){
    var val_passc = jQuery('#site_cpassword').val();
    if(val_passc == '' || val_passc == 'Confirm Password' )
    {
      //jQuery('#site_password').prop('type','password');
      jQuery('#site_cpassword').attr('type', 'text');
    }
    else{
      jQuery('#site_cpassword').attr('type', 'password');
    }

  }
</script>

<style>
  /*#form_add{
    margin-bottom: 20px;
    border: 1px solid #f78f1e;
  }
  #form_add h2{
    background: #f78f1e;
    color: #fff;
    text-transform: uppercase;
    margin: 0px;
    padding: 5px;
  }
  .left_girl{
    left: 50px;
  }
  .inner-form{
    padding: 30px;
  }*/
  .inner-form input {
    font: 18px Arial, Helvetica, sans-serif;
    height: 46px;
    padding: 0 2%;
    background-color: #fff;
    border: 0 none;
    -moz-box-shadow: inset 3px 2px 5px b#c5c5c5;
    -webkit-box-shadow: inset 3px 2px 5pbbx #c5c5c5;
    box-shadow: inset 3px 2px 5px #c5c5c5;
    border-radius: 0px;
    color: #F78F1E;
    font-weight: bold;
  }

  .submit_site:focus, .submit_site::selection{
    border: none!important;
  }
  .submit_site{
    float: none;
  }
  #form_add label{
    color: #959CA1;
    font: 21px Arial, Helvetica, sans-serif;
    font-weight: bold;
  }
  #form_add input:focus{
    border: 0 none;
    -moz-box-shadow: inset 3px 2px 5px #c5c5c5;
    -webkit-box-shadow: inset 3px 2px 5px #c5c5c5;
    box-shadow: inset 3px 2px 5px #c5c5c5;
  }
  .inner-form div{
    margin: 0 auto;
  }
</style>