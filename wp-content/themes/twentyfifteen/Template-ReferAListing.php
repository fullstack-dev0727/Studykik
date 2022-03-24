<?php
/*
 * Template Name: Refer a Listing
 */
?>
<?php
if (is_user_logged_in()) {
  $user_ID = get_current_user_id();
  $user_info = get_userdata($user_ID);
  $user_roles = implode(', ', $user_info->roles);
} else {
  wp_redirect(site_url().'/login/', 301);
  exit;
}
?>
<?php //get_header('dashboard'); ?>
<?php if ($user_roles == "manager_username"){

  get_header('responsive');?>
  <link href="<?php bloginfo('template_url');?>/css/dashboard.css" rel="stylesheet">
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
  </style>
  <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
  <!--    <link href="<?php echo get_template_directory_uri(); ?>/css/slider.css" rel="stylesheet">-->

  <!--<link href="<?php bloginfo('template_url');?>/css/dashboard_media.css" rel="stylesheet">-->
<?php }?>
<?php if ($user_roles == "editor"){
  get_header('dashboard');?>
<?php }?>

  <style>
    textarea.form-control{ height: 102px;}
    /*    .container_current_refer {
        background: #f5f5f5 none repeat scroll 0 0;
        box-shadow: 0 0 5px #000000;
        float: left;
        padding: 10px;
        width: 100%;
    }*/

    /***** andon *****/

    .required.warning {
      border: 1px solid red;
    }

    .inner-form textarea {
      color: #F78F1E;
      font-weight: bold !important;
    }

    .white_content {
      background-color: white;
      border-radius: 10px;
      cursor: auto;
      display: none;
      left: 23% !important;
      overflow: auto;
      position: fixed !important;
      top: 25% !important;
      width: 55% !important;
      z-index: 99999 !important;
      border: 1px solid #f78e1e;
    }

    h2.heading {
      background: #f78e1e none repeat scroll 0 0;
      color: #fff;
      font-family: alternate;
      font-size: 44px;
      margin: 0;
      padding: 5px;
      text-align: center;
      text-decoration: none;
    }
    .black_overlay {
      background: #000000 none repeat scroll 0 0;
      display: block;
      height: 3400px;
      left: 0;
      opacity: 0.8;
      position: absolute;
      top: 0;
      width: 100%;
      z-index: 1001;
    }
    .close_button{
      background: #00afef none repeat scroll 0 0;
      border: medium none;
      color: #fff;
      display: block;
      font-family: alternate;
      font-size: 33px;
      margin: auto auto 20px;
      padding: 0 26px;
      text-align: center;
    }
  </style>
  <div id="banner_login">
  <div class="container">
  <?php if ($user_roles == "editor"){?>
  <div class="row">
    <?php get_header("client-submenu")?>
  </div>
  <?php }?>
  <?php if ($user_roles == "manager_username"){?>
    <div class="row">
      <?php get_header("manager-submenu")?>
    </div>
  <?php }?>
  <div class="row">
  <section class="container_current">
  <div class="col-xs-12 col-md-12" style="margin-top:22px;">
    <img src="<?php bloginfo('template_url'); ?>/images-dashboard/refer_logo.png" alt="" class="img-responsive center-block">
  </div>
  <div class="col-xs-12 col-md-12">
    <div class="form_heading">
      <h6 style="line-height: 28px;">Refer a new site or Sponsor/CRO project manager by entering their contact info below!<br/> When they list a Platinum Study you receive<span style="color:orange;"> 100 rewards KIKs</span> or a multi-site (10+) central<br/> recruitment you receive <span style="color:orange;">300 rewards KIKs!</span>
    </div>
  </div>

  <form action="" method="post" class="inner-form" id="contactform">
    <h2 style="color:#00afef;float: left;font-size: 20px; margin-left: 16px; width: 100%;">SEND TO:</h2>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <input type="text" class="required" name="contactname" placeholder="Contact Name" id="inputEmail" class="form-control">
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <input type="text" class="required" name="company" placeholder="Company" id="inputEmail" class="form-control">
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <input type="email" class="required" name="emailid" placeholder="Email" id="inputEmail" class="form-control">
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="form-group">
        <input type="text" class="required" name="phonenumber" placeholder="Phone Number" id="inputEmail" class="form-control">
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <textarea placeholder="Message" name="message" class="required" id="comment" rows="5" class="form-control"></textarea>
    </div>
    <div class="col-xs-6 col-sm-6 ">
      <div class="form-group">
        <input type="text" class="required" name="sent_from" placeholder="SENT FROM:" id="inputEmail" class="form-control asasas"><br/>
        <input type="submit" value="Send Referral" name="send_info" class="show_hide_input send_referal" />
      </div>
    </div>
  </form>

  <script src="<?php bloginfo('template_url');?>/combobox/jquery-1.10.2.js"></script>
  <script src="<?php bloginfo('template_url');?>/combobox/jquery-ui.js"></script>
  <script>
    /***** andon *****/
    $(document).ready(function () {
      $('#contactform').submit(function () {
        var errors = 0;
        $("#contactform .required").map(function () {
          if (!$(this).val()) {
            $(this).addClass('warning');
            errors++;
          } else if ($(this).val()) {
            $(this).removeClass('warning');
          }
        });
        if (errors > 0) { //alert()
          //$('#errorwarn').text("All fields are required");
          return false;
        }
        // do the ajax..
      });
    });
  </script>

  <?php
  if ($_REQUEST['send_info']) {
    global $current_user;
    get_currentuserinfo();
    $name = $_REQUEST['contactname'];
    $company = $_REQUEST['company'];
    $emailid = $_REQUEST['emailid'];
    $sent_from = $_REQUEST['sent_from'];
    $phonenumber = $_REQUEST['phonenumber'];
    $message = $_REQUEST['message'];
    $subject = "Referral Request from " . $sent_from;
    $message = "<body>
<table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>
  <tr>
    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>StudyKIK Referral Message</strong></td>
  </tr>
  <tr>
    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Name:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $name . "</td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Email Address:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $emailid . "</td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Phone Number:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $phonenumber . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Company:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $company . "</td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Message:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $message . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Referral Name:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$sent_from . "</td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Referral Email Address :</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $current_user->user_email . "</td>
  </tr>
  <tr>
    <td height='5' colspan='3' align='right' valign='middle'></td>
  </tr>
  <tr>
    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
  </tr>
</table>
</body>";
    $headers[] = 'To: <info@studykik.com>';
    $headers[] = 'From: ' . $sent_from . ' <info@studykik.com>';
    $headers[] = 'MIME-Version: 1.0' . "\n";
    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $SendEmail = wp_mail("info@studykik.com", $subject, $message, $headers);

    $subject_to_user = $sent_from." Wants You to Try StudyKIK!";
    $message_to_user = '<table width="945" border="0" align="center">
  <tbody>
    <tr>
      <td><table width="945" cellspacing="0" cellpadding="4" border="0" align="center">
        <tbody>
          <tr>
            <td valign="top" style="display:block;text-align:center;padding:44px 0"><img src="http://studykik.com/wp-content/themes/twentyfifteen/images/logo_refemail.png" alt="" width="298" height="43" class="CToWUd"></td>
          </tr>
        </tbody>
      </table>
      <table width="945" cellspacing="0" cellpadding="4" border="0" align="center">
        <tbody>
          <tr>
            <td><div style="float:left;background:url(http://studykik.com/wp-content/themes/twentyfifteen/images/refree_name2.png) no-repeat;width:100%;min-height:640px">
			<div style="margin:57px 0 0 0px;color:#9fce67;font-family:Arial,Helvetica,sans-serif;font-size:20px;text-align:center"><b>Hello '.$name.'!</b>
			</div> 
                <div style="margin:56px 0 0 220px">
                  <p style="color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:18px;margin:0;line-height:26px">'.$sent_from.' has had great results using StudyKIK for<br><span style="color:#fff;">patient recruitment and would like you to give us a try!</span></p>
                </div>
                <div style="margin:46px 0 0 220px">
                  <p style="color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:18px;margin:0;line-height:26px">By clicking on the button below and listing a study with us at<br>
                    the Platinum level or higher, you will receive 75 KIKs which can<br>
                    immediately be claimed through our My StudyKIK portal for a<br>
                    $25<span style="margin:0 4px"><img src="http://studykik.com/wp-content/themes/twentyfifteen/images/center_logo.png" alt="" width="28" height="29" class="CToWUd"></span>Starbucks gift card!
                </p></div>
				<div style="text-align:center;margin:45px 0 0 0px"><a href="http://studykik.com/clinical-trial-patient-recruitment-patient-enrollment/" target="_blank"><img src="http://studykik.com/wp-content/themes/twentyfifteen/images/logoemailonclick2.png" alt="" width="200" height="63" class="CToWUd"></a></div>
				
                <div style="margin:35px 0 0 220px">
                  <p style="color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:18px;margin:0;line-height:26px">If you have any questions, please call <a href="tel:%28877%29%20627-2509" value="+18776272509" target="_blank">(877) 627-2509</a>. We<br>
                    look forward to working with you!</p>
                </div>
                <div style="margin:35px 0 0 220px">
                  <p style="color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:18px;margin:0;line-height:26px">The StudyKIK Team</p>
                </div>
              </div></td>
          </tr>
          <tr> </tr>
        </tbody>
      </table>
      <table width="945" cellspacing="0" cellpadding="4" border="0" align="center">
        <tbody>
          <tr>
            <td valign="top"><img src="http://studykik.com/wp-content/themes/twentyfifteen/images/bottum_studykik.png" alt="" width="100%" class="CToWUd a6T" tabindex="0"><div class="a6S" dir="ltr" style="opacity: 0.01; left: 896px; top: 1276px;"><div id=":1a1" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V" data-tooltip="Download"><div class="aSK J-J5-Ji aYr"></div></div></div></td>
          </tr>
        </tbody>
      </table>
    </td></tr>
  </tbody>
</table>';
    $headers2[] = 'MIME-Version: 1.0' . "\n";
    $headers2[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    wp_mail($emailid, $subject_to_user, $message_to_user, $headers2);

    if ($SendEmail) {?>
      <div id="embed" class="white_content" style="display:block;">
        <h2 class="heading">Thank you!</h2>
        <p id="msg_box" style="color: #000; padding: 15px; font-size: 16px; text-align: center;">
          Thank you for referring StudyKIK! If the site you referred lists study at the Platinum level or higher, you will have KIKs automatically added to your account!
        </p>
        <input onclick="document.getElementById('embed').style.display='none';document.getElementById('fade').style.display='none'" class="close_button" type="button" value="CLOSE"/>
      </div>
      <div id="fade" class="black_overlay" style="display:block;"></div>
    <?php } else {
      echo '<p style="text-align: center; color: red; font-size: 20px;">ERROR</p>';
    }
  }
  ?>
  </section>
  </div>
  </div>
  </div>
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
    })
      ();
  </script>
<?php get_footer('dashboard'); ?>