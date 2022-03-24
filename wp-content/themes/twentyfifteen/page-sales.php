<?php

/**

 * Template Name: Sales

 */

get_header();

$ecommerce_enabled = get_option('ecommerce_enabled');

?>

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

<!-- End Pure Chat Snippet -->

<!--css added------------------ -->

<style>

/***** Andon *****/
#contactform{
  margin: 0 60px 0 0;
  padding: 0;
  position: absolute;
  width: 70%;
  left: 23%;
  top: 30%;
}
#contactform input{
  background: #e8e8e8 none repeat scroll 0 0;
  border: medium none;
  box-shadow: 3px 3px 5px #bbbbbb inset;
  height: 46px;
  margin-bottom: 12px;
  padding: 0 10px;
  width: 100%;
  color:#f78f1e;
  font-size: 20px;
}
#Indication_dropdown{
  border: medium none;
  box-shadow: 3px 3px 5px #bbbbbb inset;
  height: 46px;
  margin-bottom: 12px;
  padding: 0 10px;
  font-size: 20px;
  width: 679px;
  color: #88dd25;
  background:url(<?php bloginfo('template_url');?>/images/drop_down.png) no-repeat scroll right top #e8e8e8;
  -moz-appearance: none;
  -webkit-appearance: none;
  appearance: none;
}
.drop-cus{
  float: left;
  position: relative;
}
#contactform .btn_proposal{
  background: url(<?php bloginfo('template_url');?>/images/get_report_blue.png) no-repeat scroll 0 0 rgba(0, 0, 0, 0);
  font-size: 0;
  height: 53px;
  width: 242px;
  box-shadow: none;
}
.warning{border: 1px solid red !important;}

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
.closepop {
  background: transparent url("<?php bloginfo('template_url');?>/images-dashboard/close2.png") no-repeat scroll 0 0;

}
h2.heading{
  background: #f78e1e none repeat scroll 0 0;
  color: #fff;
  font-size: 44px;
  margin: 0;
  padding: 5px;
  text-align: center;
  text-decoration: none;
  font-family: alternate;
}
/***** Andon *****/



.wpcf7-validation-errors{
    display:none !important;
}

.qwer{

	width:100%;

}

.asadsfd

{

	margin-bottom:24px;

}

.imgexp{

	width:100%;

}

    .trial_text{

        width:100%;

        float:left;

        margin:17px auto;

    }

    .trial_text h1{

        font-size:28px;

        color:#9fcf67;

        text-align:center;

        text-transform:uppercase;

    }

    #table{ background:#fff !important; padding:0px !important;}

    .listing_bottum{

        width:58px;

        height:1px;

        background:#949ca1;

        text-align:center;

        margin:0 auto;

    }

    .block_1{

        width:100%;

        float:left;

        margin-bottom: 29px;

    }

    .search_left{

        width:22%;

        float:left;

    }

    .search_left img{

        width:100%;

    }

    .right_text{

        width:75%;

        float:right;

        position:relative;

    }

    h3{

        color: #949ca1;

        float: left;

        font-size: 26px;

        margin: 60px 0 0;

        text-align: left;

        font-family:Arial, Helvetica, sans-serif;

        font-weight:normal;

    }

    .search_line{

        float: right;

        left: 380px;

        position: absolute;

        top: 98px;

    }

    .search_line img{

        width:100%;

    }

    .search_line_2{

        float: right;

        left: 228px;

        position: absolute;

        top: 98px;

    }

    .search_line_2 img{

        width:100%;

    }

    .search_line_3{

        float: right;

        left: 225px;

        position: absolute;

        top: 98px;

    }

    .search_line_3 img{

        width:100%;

    }

    .search_line_4{

        float: right;

        left: 167px;

        position: absolute;

        top: 98px;

    }

    .search_line_4 img{

        width:100%;

    }

    .search_line_5{

        float: right;

        left: 100px;

        position: absolute;

        top: 98px;

    }

    .search_line_5 img{

        width:100%;

    }

    .search_line_6{

        float: right;

        left: 222px;

        position: absolute;

        top: 98px;

    }

    .search_line_6 img{

        width:100%;

    }

    .search_line_7{

        float: right;

        left: -14px;

        position: absolute;

        top: 98px;

    }

    .search_line_7 img{

        width:100%;

    }

    #horizontal_line{

        float:left;

        width:100%;

        height:1px;

        margin: 14px 0;

        background:#bbc0c3;

    }

    .media_channel{

        float: left;

        text-align: center;

        width: 100%;

    }

    .media_channel strong{

        font-size:26px;

        color:#fff;

        text-transform:uppercase;

    }

    .media_channel span{

        color:#F78E1E;

        font-size:40px;

    }

    .popular{

        width:100%;

        text-align:center;

        margin-bottom:30px;

    }

    .popular_area{

        margin:0 auto;

        background:#f78f1e;

        padding-bottom: 50px;

    }

    .popular_text{

        text-align:center;

        font-size:24px;

        color:#FFF;

        padding: 10px 0;

    }

    .Average{

        color: #fff;

        font-size: 18px;

        text-align: center;

    }

    tr,td{border:none !important;}

    td{

        color:#FFF;

        font-size:18px;

        padding:5px !important;

    }

    /* clinical css start*/

    .patients_banner{

        background: #9fcf67;

        float: left;

        width: 100%;

        padding: 20px 0 0;

    }

    .clinic_container{

        margin: 0 auto;

        width: 960px;

    }

    .studykik_heading{

        float: left;

        margin: 0;

        text-align: center;

        width: 100%;

    }

    .studykik_heading h4{

        font-size:26px;

        color:#FFF;

        margin: 20px 0 15px;

    }

    .studykik_heading p{

        color: #ffffff;

        float: left;

        font-size: 20px;

        line-height: 30px;

        margin: 10px 0 18px;

        text-align: left;

    }

    .trial_listed{

        background:#F78E1E;

        float:left;

        width:100%;

        margin-top:30px;

        padding: 20px 0;

    }

    .clinical_social{

        float:left;

    }

    .clinical_social ul{

        float:left;

        padding: 0;

        margin-bottom: 0;

    }

    .clinical_social ul li{

        display: inline;

        float: left;

        font-size: 20px;

        width: 50%;

        text-align:left;

        line-height:50px;

    }

    .clinical_social ul li span{

        margin: 0 0 0 14px;

        text-align: right;

        color:#fff;

    }

    td {

        font-size: 22px !important;

        padding: 10px !important;

    }

    .filtering{

        margin: 0 auto;

        text-align: center;

        width: 70%;

    }

    .filtering ul{

        float:left;

        padding: 0;

        margin-top: 0;

    }

    .filtering ul li{

        display: inline;

        float: left;

        font-size: 20px;

        text-align:left;

        line-height:50px;

    }

    .filtering ul li span{

        float: right;

        margin: 0 0 0 14px;

        text-align: right;

        color:#fff;

    }

    .price_div{ background:url('<?php bloginfo('template_url'); ?>/images/StudyKIK-Company-Information-v2-2.jpg'); background-repeat:repeat-x; height: 78px;}

    .price_div2 {

        background: url("<?php bloginfo('template_url'); ?>/images/inner-banner-bottom.png") repeat-x scroll 0 0 rgba(0, 0, 0, 0);

        float: left;

        height: 12px;

        width: 100%;

    }
.rowimp{
	width:105% important;
}

.asadsfd
{

	margin-bottom:0px !important;
}
    .table-block table, .table-block table tr, .table-block table td, .table-block table th{border-width: 0 !important;}
	.row.rowimp {
    width: 100% !important;
	margin:0;
}
.qwer {
    margin: 0;
}
@media only screen and (max-width: 1124px) {
    .inner-form {
        width: 100% !important;
    }
    
}
@media only screen and (max-width: 800px) {
/*    #contactform {
        float: right;
        margin: 0 0px 0 0;
        padding: 0;
        position: absolute;
        top: 100px;
        width: 70%;
    }
    #contactform input {
        background: #e8e8e8 none repeat scroll 0 0;
        border: medium none;
        box-shadow: 3px 3px 5px #bbbbbb inset;
        height: 46px;
        margin-bottom: 12px;
        padding: 0 10px;
        width: 100%;
        color: #f78f1e;
        font-size: 20px;
    }*/
.headingimg {
    width: 100%;
}
.row.rowimp {
    margin: 0;
    width: 100% !important;
}

}
@media only screen and (max-width: 480px) {
    #contactform input { font-size: 12px; }
	.listings {
    padding: 0 !important;
}
    /*#contactform{
        float: inherit;
        margin: 0 0 0 0;
        text-align: center;
        padding: 0;
        position: absolute;
        right: 0;
        top: auto;
        width: 100%;
    }
    #contactform input{
        background: #e8e8e8 none repeat scroll 0 0;
        border: medium none;
        box-shadow: 3px 3px 5px #bbbbbb inset;
        height: 46px;
        float: inherit;
        margin-bottom: 12px;
        padding: 0 10px;
        width: 100%;
    }*/
    #contactform .btn_proposal{
        background: none repeat scroll 0 0 #f78f1e !important;
        box-shadow: 3px 4px 5px #0087B8 !important;
        color: #FFFFFF;
        font: 28px Arial, Helvetica, sans-serif !important;
        padding-top: 3px !important;
        width: 100%;
    }
}
@media only screen and (max-width: 400px) {
.listings > h1 br {
    display: none !important;
}
.headingimg.asadsfd {
    width: 100% !important;
}
.listings {
    padding: 0 !important;
}
.wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required {
    margin-left: 23px !important;
    width: 100% !important;
}
.wpcf7-form-control.wpcf7-submit.submit.slide-btn4 {
    margin-left: 47px !important;
    width: 93% !important;
}
.headingimg {
    margin-left: 0 !important;
    margin-top: 0 !important;
    width: 100% !important;
}
.row.qwer {
    margin: 0;
}
.row > img {
    width: 100% !important;
}
.imgexp {
    width: 100% !important;
}
}
@media only screen and (max-width: 320px) {
	.wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required {
    margin-left: 12px !important;
    width: 100% !important;
}
.wpcf7-form-control.wpcf7-submit.submit.slide-btn4 {
    margin-left: 25px !important;
    width: 93% !important;
}
}



@media only screen 

and (min-device-width : 768px) 

and (max-device-width : 1024px)

{
	.qwer{

	width:102%;

}

	

}



</style>

<!-- End Pure Chat Snippet -->

<div id="innerbanner">

    <h1>LIST YOUR CLINICAL TRIALS <a href="<?php
        if( $ecommerce_enabled ){
            echo '/shopping-cart';
        }else{
            echo site_url() . '/cmd.php?gid=9154926fc42b2d018dd553ff0b8406c5&bn=1&clear=1';
        }
        ?>"><img  src="<?php bloginfo('template_url'); ?>/images/order_now_new.png" width="191" height="54" /></a>
        <a href="/getproposal/"><img src="<?php bloginfo('template_url'); ?>/images/get-proposal-button.png" ></a>
    </h1>

    

    <div class="listings" style="text-align: center; min-height: 508px; background:#24ade3;  float:left; width:100%; margin: 0px auto auto;">

                        <style>

                            .listings {
                                /*padding: 15px 100px 75px;*/
                            }

                            .headingimg { width: 100%;}

                            .inner-form {
                                background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
                                float: none !important;
                                margin: auto;
                                position: relative;
                                width: 1020px;
                                padding-bottom: 9%;
                            }
                            .inner-form input {

                                float: left;

                                font: 18px Arial, Helvetica, sans-serif;

                                height: 46px;

                                margin: 0 0 13px;

                                padding: 0 2%;

                                width: 100%;

                                background-color: #fff;

                                border: 0 none;

                                -moz-box-shadow: inset 3px 2px 5px #c5c5c5;

                                -webkit-box-shadow: inset 3px 2px 5px #c5c5c5;

                                box-shadow: inset 3px 2px 5px #c5c5c5;

                            }

                            .inner-form input.slide-btn4 {

                                background: url("<?php bloginfo('template_url'); ?>/images/get_report_blue.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);

                                font-size: 0;

                                height: 53px;

                                width: 242px;

                                box-shadow: none;

                            }

                            .table-list ul li {

                                font: 22px helvetica_neue_lt_com55_roman;

                            }

                            span.wpcf7-form-control-wrap {

                                position: relative;

                                float: left;

                                width: 100%;

                            }

                            span.wpcf7-not-valid-tip {

                                color: #f00;

                                font-size: 12px;

                                right: 10px;

                                display: block;

                                position: absolute;

                                top: 13px;

                            }

                            .wpcf7-response-output.wpcf7-display-none.wpcf7-mail-sent-ok, div.wpcf7-validation-errors{

                                display: block;

                                float: left;

                                top: 0

                            }

                            div.wpcf7 {

                                float: right;

                                margin: 0 60px 0 0;

                                padding: 0;

                                position: absolute;

                                right: 0;

                                top: 182px;

                                width: 670px;

                            }

                        </style>

                        <div class="inner-form" style="">

                            <h2 style="background: none repeat scroll 0% 0% transparent; text-align: center;"><img  class="headingimg" src="<?php bloginfo('template_url'); ?>/images/contact_img.png"></h2>

                            <?php //echo do_shortcode('[contact-form-7 id="2299" title="Find Out How Many"]'); ?>

                          <form action="" method="post" id="contactform">
                            <input class="required" type="text" placeholder="Enter Your First &amp; Last Name" name="fullname">
                            <br>
                            <input class="required" type="email" placeholder="Enter Your Email Address" name="email">
                            <br>
                            <input class="" type="text" placeholder="Enter Your Company" name="company">
                            <br>
                            <input class="required" type="text" placeholder="Enter Your Zip Code" name="zipcode">
                            <br>
                            <input class="required" type="text" placeholder="Indication" name="indication">
                            <br>
                            <input type="submit" value="Get Report!" name="btn_proposal" class="btn_proposal">
                          </form>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
  /***** andon *****/
  $(document).ready(function(){
    $('#contactform').submit(function() {
      var errors = 0;
      $("#contactform .required").map(function(){
        if( !$(this).val() ) {
          $(this).addClass('warning');
          errors++;
        } else if ($(this).val()) {
          $(this).removeClass('warning');
        }
    });

    if(errors > 0){ //alert()
      return false;
    }
  });
  });
</script>
                        </div>

                    </div>
  <?php

  /***** andon *****/
  if(isset($_REQUEST['btn_proposal']))
  {
    $fullname = $_REQUEST['fullname'];
    $email = $_REQUEST['email'];
    $company = $_REQUEST['company'];
    $zipcode = $_REQUEST['zipcode'];
    $indication = $_REQUEST['indication'];

    $subject = "Find Out How Many Patients are near your site";

    $message .= "<body>

                  <table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>

                    <tr>
                      <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'>
                      <strong>Find Out How Many Patients are near your site</strong>
                      </td>
                    </tr>

                    <tr>
                      <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
                    </tr>

                    <tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Full Name:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$fullname."</td>
                    </tr>
                    <tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Email:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$email."</td>
                    </tr>
                    <tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Company:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$company."</td>
                    </tr>
                    <tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Zip Code:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$zipcode."</td>
                    </tr>
                    <tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Indication:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$indication."</td>
                    </tr>
                    </table>
                  </body>
                  ";
    $headers[] = 'From: '.$fullname.' <'.$email.'>';
    $headers[] = "MIME-Version: 1.0\r\n";
    $headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $SendEmail = wp_mail('info@studyKIK.com',$subject,$message,$headers,$attachments);
    // $SendEmail = wp_mail('hondakichiro@gmail.com',$subject,$message,$headers,$attachments);

    if($SendEmail){
      echo "<script> document.location.href = 'http://studykik.com/find-many-patients/';</script>";
    }
  }

  ?>

    <div class="container">

        <div class="row">

            <div class="inner-banner-block">

                <div class="youtube-video">

                    <p>Want to have people find your clinical studies on StudyKIK.com? Scroll down to view our various patient enrollment listing options.</p>

                    <div class="video-block">

                        <?php echo do_shortcode('[youtube maxw=926 maxh=545 video=bF2YU7zWmH4]'); ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="patients_banner">

    <div class="clinic_container">

        <div class="studykik_heading">

            <h4><img src="<?php bloginfo('template_url'); ?>/images/what_is_studyKIK.png" /></h4>

            <p>StudyKIK is a website where patients can find and sign up for clinical trials with ease.

                These patients find StudyKIK through our robust social community pages on Facebook,

                Twitter, Instagram, Pinterest, and more! Patients also find your Clinical Research Recruitment through

                search engines like Google, Bing, & Yahoo. Every clinical trial listed on StudyKIK benefits

                from the millions of patients across social media and search engines in almost every

                therapeutic area in all phases including: Respiratory, Immunology, CNS, Cardiology,

                Endocrinology, Gastroenterology, Healthy Volunteer, Dermatology, Rheumatology,

                Urology, and much more! Patient traffic is filtered using our proprietary targeting

                software so that only patients in a geographic radius of your site that match your

                inclusion & exclusion criteria will find your clinical trial.</p>

        </div>

    </div>

    <?php /* ?><div class="trial_listed">

      <div class="clinic_container">

      <div class="studykik_heading">

      <h4>EVERY CLINICAL TRIAL LISTED ON STUDYKIK RECEIVES:</h4>

      <div class="clinical_social">

      <ul>

      <li><img src="<?php bloginfo('template_url');?>/images/search_clinical.png" alt="" /><span>Exposure to STUDYKIK Patient Search</span></li>

      <li><img src="<?php bloginfo('template_url');?>/images/notification_clinical.png" alt="" /><span>Instant SIGN-UP Notifications to Your Site</span></li>

      <li><img src="<?php bloginfo('template_url');?>/images/instant_clinical.png" alt="" /><span>Instant Patient Text Message w/ Site Phone</span></li>

      <li><img src="<?php bloginfo('template_url');?>/images/moblile_clinical.png" alt="" /><span>Mobile Friendly Study Page</span></li>

      <li><img src="<?php bloginfo('template_url');?>/images/message_clinical.png" alt="" /><span>Instant Patient Email w/ Site Phone</span></li>

      <li><img src="<?php bloginfo('template_url');?>/images/time_clinical.png" alt="" /><span>LIVE Listing within 24 hours</span></li>

      </ul>

      </div>

      <div class="filtering">

      <ul>

      <li><img src="<?php bloginfo('template_url');?>/images/lock_clinical.png" alt="" /><span>Proprietary Filtering System for Quality Patient Reach</span></li>

      </ul>

      </div>

      </div>

      </div>

      </div><?php */ ?>

</div>





<div id="table">

    <div class="container" style="margin: 0; width: 100% !important;">

        <div class="row">

            <div class="table-block" style="background:#f5f5f5;">

                <div class="listings" style="margin: 15px auto auto;text-align: center; width: 730px;">

                    <div class="trial_text">

                        <h1>Each Study Listing Includes:</h1>

                        <div class="listing_bottum">

                        </div>

                    </div>

                    <div class="block_1">

                        <div class="search_left">

                            <img src="<?php bloginfo('template_url'); ?>/images/search.png" alt="">

                        </div>

                        <div class="right_text">

                            <h3>Exposure to STUDYKIK Patient Enrollment Search</h3>

                            <div class="search_line">

                                <img src="<?php bloginfo('template_url'); ?>/images/search_line.png" alt="">

                            </div>

                        </div>

                    </div>

                    <div class="block_1">

                        <div class="search_left">

                            <img src="<?php bloginfo('template_url'); ?>/images/text_message.png" alt="">

                        </div>

                        <div class="right_text">

                            <h3>Instant Patient Text Message w/ Site Phone</h3>

                            <div class="search_line_2">

                                <img src="<?php bloginfo('template_url'); ?>/images/text_message_line.png" alt="">

                            </div>

                        </div>

                    </div>

                    <div class="block_1">

                        <div class="search_left">

                            <img src="<?php bloginfo('template_url'); ?>/images/message.png" alt="">

                        </div>

                        <div class="right_text">

                            <h3>Instant Patient Email w/ Site Phone</h3>

                            <div class="search_line_3">

                                <img src="<?php bloginfo('template_url'); ?>/images/email_line.png" alt="">

                            </div>

                        </div>

                    </div>

                    <div class="block_1">

                        <div class="search_left">

                            <img src="<?php bloginfo('template_url'); ?>/images/filtering.png" alt="">

                        </div>

                        <div class="right_text">

                            <h3>Proprietary Filtering System for Quality Patient Reach</h3>

                            <div class="search_line_4">

                                <img src="<?php bloginfo('template_url'); ?>/images/filtering_line.png" alt="">

                            </div>

                        </div>

                    </div>

                    <div class="block_1">

                        <div class="search_left">

                            <img src="<?php bloginfo('template_url'); ?>/images/notification.png" alt="">

                        </div>

                        <div class="right_text">

                            <h3>Instant SIGN-UP Notifications to Your Site</h3>

                            <div class="search_line_5">

                                <img src="<?php bloginfo('template_url'); ?>/images/notification_line.png" alt="">

                            </div>

                        </div>

                    </div>

                    <div class="block_1">

                        <div class="search_left">

                            <img src="<?php bloginfo('template_url'); ?>/images/study.png" alt="">

                        </div>

                        <div class="right_text">

                            <h3>Mobile Friendly Study Page</h3>

                            <div class="search_line_6">

                                <img src="<?php bloginfo('template_url'); ?>/images/study_line.png" alt="">

                            </div>

                        </div>

                    </div>

                    <div class="block_1">

                        <div class="search_left">

                            <img src="<?php bloginfo('template_url'); ?>/images/listing.png" alt="">

                        </div>

                        <div class="right_text">

                            <h3>LIVE Listing within 24 hours</h3>

                            <div class="search_line_7">

                                <img src="<?php bloginfo('template_url'); ?>/images/listing_line.png" alt="">

                            </div>

                        </div>

                    </div>

           <!-- <img class="mobimg"  style="margin-top: 38px; width: 100%;" src="<?php bloginfo('template_url'); ?>/images/Sales1.jpg">-->

                </div>

                <div class="table-list" style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0); float: left;  margin: 0;  width: 100%;">

                    <div class="price_div">.</div>

                    <div class="row rowimp" style="background:#60cdf6;width: 105%;">

                        <div class="listings" style="margin: 10px auto auto;text-align: center; width: 960px;">

                            <h1 style="margin: 15px 0px; text-transform: uppercase; color: rgb(255, 255, 255) ! important; font-family: sans-serif; font-weight: bold; font-size: 24px; line-height: 34px;">CHOOSE THE NUMBER OF POSTS ON STUDYKIK'S SOCIAL <br/>

                                COMMUNITIES YOU WOULD LIKE YOUR STUDY TO RECEIVE, <br/>

                                <span style="text-decoration:underline;">EACH POST RECEIVES 1 TO 2 PATIENT REFERRALS ON AVERAGE*</span>.</h1>

                        </div>

                    </div>

                    <div class="row qwer" style="background:#f5f5f5;">

                        <img style="width:100%;" src="<?php bloginfo('template_url'); ?>/images/Study-Kik-Website---Sales-Page-v3.jpg">

                    </div>

                    <div class="listings" style="margin: 10px auto auto;text-align: center; width: 100%; background:#f5f5f5;" >

                        <img style="width:100%; margin:20px 0;" src="<?php bloginfo('template_url'); ?>/images/updated_map.png">

                    </div>

                </div>

                <div class="table-list" style="float: left;  margin: 0;  width: 100%;">

                    <div class="listings" style="margin: 10px auto auto;text-align: center; width: 100%; background:#f78f1e;">

                        <div class="popular" style="margin:auto;">

                            <div class="popular_area">

                                <div class="popular_text"> POPULAR THERAPEUTIC AREAS: </div>

                                <div class="Average"> $ Amount = Average Cost Per Referral </div>

                                <table style="width:100%" border="0">

                                    <tr>

                                        <td>Diabetes: $22</td>

                                        <td >Osteoarthritis: $18</td>

                                    </tr>

                                    <tr bgcolor="#ffae55">

                                        <td>COPD: $25</td>

                                        <td>Migraine: $22</td>

                                    </tr>

                                    <tr>

                                        <td>Asthma: $34</td>

                                        <td>Depression: $24</td>

                                    </tr>

                                    <tr bgcolor="#ffae55">

                                        <td>Acne: $24</td>

                                        <td>IBS-D: $51</td>

                                    </tr>

                                    <tr>

                                        <td>Constipation: $42</td>

                                        <td>Multiple Sclerosis: $44</td>

                                    </tr>

                                    <tr bgcolor="#ffae55">

                                        <td>Post Menopausal: $15</td>

                                        <td>Neuropathy: $28</td>

                                    </tr>

                                </table>

                            </div>

                        </div>

                    </div>

                    

                    <div class="table-list" >

                        <h1 class="headingimg asadsfd" style="background: none repeat scroll 0% 0% transparent; text-align: center; "><img  class ="imgexp" style="margin-top: 30px;" src="<?php bloginfo('template_url'); ?>/images/heading_123.jpg"></h1>

                        <div class="listings sendtonext" style="margin: 10px auto auto; width: 860px;">

                            <ul>

                                <li><span style="margin-right: 10px;"><img src="<?php bloginfo('template_url'); ?>/images/number_1.png" /></span> Select the Number of Clinical Research Recruitment Trials & Exposure Levels.</li>

                                <li><span style="margin-right: 10px;"><img src="<?php bloginfo('template_url'); ?>/images/number_2.png" /></span> Select Checkout.</li>

                                <li><span style="margin-right: 10px;"><img src="<?php bloginfo('template_url'); ?>/images/number_3.png" /></span> Submit Study Information.</li>

                            </ul>

                        </div>

                    </div>

                    <div class="table-list">

                        <div class="listings" style="margin: 30px auto auto; width: 540px;">

                            <!--<a style="float:left;" target="_blank" href="<?php echo site_url();?>/cmd.php?gid=9154926fc42b2d018dd553ff0b8406c5&bn=1&clear=1"><img class="order_now" src="<?php bloginfo('template_url'); ?>/images/StudyKIK_Order_Now_Button.png" style="margin-bottom: 30px;" /></a>-->
                          <a style="float:left;" href="<?php 
        if( $ecommerce_enabled ){
            echo '/shopping-cart';
        }else{
            echo site_url() . '/cmd.php?gid=9154926fc42b2d018dd553ff0b8406c5&bn=1&clear=1';
        }
                          
                          ?>"><img class="order_now" src="<?php bloginfo('template_url'); ?>/images/StudyKIK_Order_Now_Button.png" style="margin-bottom: 30px;" /></a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>