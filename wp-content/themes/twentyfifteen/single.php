<?php   $cureenturl =  $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ;
global $__this_is_single_php;
global $__this_is_single_php_post_id;
$__this_is_single_php = true;
$__this_is_single_php_post_id = $post->ID;

$_custom_fields = get_post_custom();

function _studykik_func_1($_custom_fields, $_key, $default = null){
    if(isset($_custom_fields[$_key]) && isset($_custom_fields[$_key][0])){
        return $_custom_fields[$_key][0];
    }else{
        return $default;
    }
}

$is_ask_before_close = get_post_meta($post->ID, 'allow_exit_popup', true);
$is_ask_before_close = isset($is_ask_before_close[0]) ? $is_ask_before_close[0] : false;

$lv_sweepstakes = (($cureenturl == 'studykik.com/louisv/') || ($cureenturl == 'studykik.com/louisv12/') || ($cureenturl == 'studykik.com/lv/') || ($cureenturl == 'studykik.com/LV/') || ($cureenturl == 'studykik.com/lv2/') || ($cureenturl == 'studykik.com/LV2/')) ? true : false;

if ($is_ask_before_close) {
    wp_enqueue_script('custom_alert_js', get_site_url().'/wp-content/themes/twentyfifteen/js/page_close_alert.js', array(), '1', true);
}

if(($cureenturl == 'studykik.com/louisv/') || ($cureenturl == 'studykik.com/louisv12/') || ($cureenturl == 'studykik.com/lv/') || ($cureenturl == 'studykik.com/LV/') || ($cureenturl == 'studykik.com/lv2/') || ($cureenturl == 'studykik.com/LV2/'))
{

?>

<?php



/**



 * The template for displaying all single posts



 *



 * @package WordPress



 * @subpackage Twenty_Thirteen



 * @since Twenty Thirteen 1.0



 */






if(is_single(22216) || is_single(31667) || is_single(31841)|| is_single(31862)){get_template_part( 'single', '22216' ); die(); }


get_header(); ?>

<div id="inner-page">



	<div class="container">

<?php

if ( in_category('96') ) {?>



<style>

.asd {
    background-color: white !important;
}
.inner-form p {

    color: #959CA1;

    font: 17px helvetica_neue_lt_com55_roman;

}

.inner-form{padding:20px !important;}

.drop-cus select.styled {

    float: left;

    height: 50px;

    width: 100%;

	color:#88DD25;

}



.select {



    float: left;

    font: 26px/45px helvetica_neue_lt_com67MdCn;

    height: 61px;

    left: 0;

    margin-bottom: 15px;



}

.drop-cus {

    float: left;

    height: 76px;

    position: relative;

    width: 100%;

}

.mandatory.gmw-address.gmw-full-address.gmw-address-1 {

    background-color: #E8E8E8;

    border: 0 none;

    box-shadow: 3px 2px 5px #C5C5C5 inset;

    color: #88DD25;

    float: left;

    font: 26px/30px helvetica_neue_lt_com67MdCn;

    height: 50px;

    margin-bottom: 15px;

    padding: 0 3%;

    width: 100%;

	 height: 55px;

}

.inner-form ul { margin:0px !important; padding:0px !important;}

</style>



    <div class="blog-left">

	<?php while ( have_posts() ) : the_post(); ?>


<input type="hidden" value="<?php echo gapp_get_post_pageviews(); ?>" class="pageviews_no" />
<input type="hidden" value="<?php echo gapp_get_post_pageviews(54342); ?>" class="pageviews_no1" />



				<div class="row inn-block">



        	<div class="innerlist">



            	<h1><?php the_title();?>-<?php echo gapp_get_post_pageviews(); ?></h1>





           		<div style="padding:0 20px;" class="inner-form">

                <div class="img">

<?php

if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.

  the_post_thumbnail(array(250,250));

}

?>

</div>





                <?php the_content(); ?></div>





            </div>







        </div>









			<?php endwhile; ?>

            </div>



<div class="blog-right">

<?php get_sidebar(); ?>



</div>



<?php } else {?>

<style>
.col-xs-6.list img{ width:100% !important;}
.postid-32360 .col-xs-6 img, .postid-59629 .col-xs-6 img{ margin-left:auto; margin-right:auto; text-align:center; float:none;}
.postid-32360 .innerlist .col-xs-6, .postid-59629 .innerlist .col-xs-6{ width:100%; text-align:center;}
</style>



			<?php /* The loop */ ?>



			<?php while ( have_posts() ) : the_post(); ?>

<input type="hidden" value="<?php echo gapp_get_post_pageviews(); ?>" class="pageviews_no" />
<input type="hidden" value="<?php echo gapp_get_post_pageviews(54342); ?>" class="pageviews_no1" />





				<div class="row inn-block">



        	<div class="innerlist asd" style ="background-color:white">



            	<h1><?php the_title();?></h1>
                <?php



$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$post_ids2 = $post->ID;




if($feat_image){

?>


                 <?php if(in_array($post_ids2, array(32360,59629))){?>
					 <div class="col-xs-6">



                	<img src="<?php echo $feat_image; ?>" alt="">



                </div>
					 
				 <?php }else{?>
                 <div>



                	<img src="<?php echo $feat_image; ?>" alt="" class="col-sm-offset-3 col-sm-6" style="max-width: 100%;">



                </div>
                 <?php } ?>
           		

<?php }else{?>

<style>

.innerlist .col-xs-6.list p {



    width: 100%;

}

</style>

<?php } ?>

				<div class="inner-form">


                <?php $post_ids = $post->ID;
				if($post_ids == 3162){?>
<!-- Pure Chat Snippet -->
<script type='text/javascript'>
(function () {	var done = false;	var script = document.createElement('script'); script.async = true;	script.type = 'text/javascript';	script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) {	if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({ c: 'bab234e1-3a99-448d-b117-2bb29457f303', f: true }); done = true;	}	};	})();
</script>

<?php }
				if($post_ids == 3260 || $post_ids == 3229){?>
                <p>Entrez vos informations pour nous rejoindre!</p>
                <style>.submit.slide-btn{  background: none repeat scroll 0 0 #f78f1e !important;
    color: #fff !important;
    font-size: 23px !important;
    width: 375px !important;}</style>
                <?php }elseif($post_ids ==4084){?>
                 <p>Enter your information to be contacted to See if you May Qualify </p>
                <?php }elseif($post_ids ==5701){ ?>
                <p>Enter your contact details to recive more information!</p>
                <?php }else{?>
                 <?php if($post_ids == 5701){
					  echo '<p>Enter your information to receive more information</p>';
					  }elseif($post_ids == 30569){  echo '<p>Enter your information</p>'; } else{?>
                <p>Enter your information to join! </p>
                <?php } ?>
                <?php }?>
                <?php /*?><h5><?php echo  $key_1_values = get_post_meta( $post->ID, 'phone_number',true ); ?></h5><?php */?>





              <?php $get_response_code = get_post_meta( $post->ID, 'get_response_code',true );
              $is_pass_aweber = get_post_meta( $post->ID, 'pass_aweber', true );
              $is_pass_aweber = isset($is_pass_aweber[0]) ? $is_pass_aweber[0] : false;


			  if(false)

			  {

				echo $get_response_code;

				if($post_ids ==5701){
				echo '<p class="signing_up_txt2" style="font-size:13px; color:gray; float: left;font-weight:bold; margin:0px 0 20px 0;width: 45%;">By signing up you agree to receive text messages and emails about this and similar studies near you. You can unsubscribe at any time.</p>';
				}
			  }else{



			   ?>




<form method="post" id="contactform" class="af-form-wrapper" action="<?php echo site_url();?>/default_thankyou_page_redirect.php"  >



  <input id="awf_field-56733468" required="required" type="text" name="name" class="text" placeholder="<?php echo _studykik_func_1($_custom_fields,'trans_enter_your_first__last_name','Enter Your First & Last Name'); ?>" value=""/>

  <input type="text" required="required" id="awf_field-56733469" type="email" tabindex="501" name="email" placeholder="<?php echo _studykik_func_1($_custom_fields,'trans_enter_your_email_address','Enter Your Email Address'); ?>" value=""/>

  <input type="text" required="required" id="awf_field-56733470"  class="text" tabindex="502" placeholder="<?php echo _studykik_func_1($_custom_fields,'trans_enter_your_phone_number','Enter Your Phone Number'); ?>" name="custom Mobile Phone Number"/>
    <input type="hidden" name="redirect_url" value="<?php echo site_url().'/thank-you-for-subscribing-studykik' ; ?>" />
    <input type="hidden" name="post_id" value="<?php echo $post->ID; ?>" />
  <input name="submit" class="submit slide-btn-trans" type="submit" value="<?php echo _studykik_func_1($_custom_fields,'trans_sign_up_now','Sign Up Now!'); ?>" tabindex="503" />



</form>


<script type="text/javascript">

    <!--

    (function() {

        var IE = /*@cc_on!@*/false;

        if (!IE) { return; }

        if (document.compatMode && document.compatMode == 'BackCompat') {

            if (document.getElementById("af-form-39699699")) {

                document.getElementById("af-form-39699699").className = 'af-form af-quirksMode';

            }

            if (document.getElementById("af-body-39699699")) {

                document.getElementById("af-body-39699699").className = "af-body inline af-quirksMode";

            }

            if (document.getElementById("af-header-39699699")) {

                document.getElementById("af-header-39699699").className = "af-header af-quirksMode";

            }

            if (document.getElementById("af-footer-39699699")) {

                document.getElementById("af-footer-39699699").className = "af-footer af-quirksMode";

            }

        }

    })();

    -->

</script>



<?php

if(isset($_POST['submit'])) {



	    global $wpdb;

		$name = $_REQUEST['name1'];

		$email = $_REQUEST['email1'];

		$phone = $_REQUEST['Phone'];



		$email_adress = get_post_meta( $post->ID, 'email_adress',true );

		$email_adress2 = get_post_meta( $post->ID, 'email_adress_2',true );

		$email_adress3 = get_post_meta( $post->ID, 'email_adress_3',true );

		$awaber_url = get_post_meta( $post->ID, 'awaber_url',true );



		$to  = $email_adress; // note the comma







$from = $name;



$subject = " New sign up for ".$post->post_title;

$message = "<body>

<table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>

  <tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>New sign up for Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Name:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$name."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Email Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$email."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Phone Number:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$phone."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study URL :</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'><a href=".get_permalink($post->ID).">Click Here</a></td>

  </tr>



  <tr>

    <td height='5' colspan='3' align='right' valign='middle'></td>



  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

</table>

</body>";



// Always set content-type when sending HTML email

$headers = "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

$headers .= "From: StudyKIK <info@studykik.com>\n";

$headers .= "Reply-To: ".$name." < ".$email." >\n";



$send_emil = wp_mail($to, $subject, $message,$headers);

wp_mail($email_adress2, $subject, $message,$headers);



wp_mail($email_adress3, $subject, $message,$headers);







if($send_emil){



        $date = date_create();

        $final_date = date_format($date, 'U = Y-m-d H:i:s');



		$wpdb->query("INSERT INTO `wp_cf7dbplugin_submits`(`submit_time`, `form_name`, `field_name`, `field_value`, `field_order`, `file`) VALUES ('$final_date','Contact form homepage','text-11','$name','',NULL)");

		$wpdb->query("INSERT INTO `wp_cf7dbplugin_submits`(`submit_time`, `form_name`, `field_name`, `field_value`, `field_order`, `file`) VALUES ('$final_date','Contact form homepage','email-362','$email','',NULL)");

		$wpdb->query("INSERT INTO `wp_cf7dbplugin_submits`(`submit_time`, `form_name`, `field_name`, `field_value`, `field_order`, `file`) VALUES ('$final_date','Contact form homepage','tel-356','$phone','',NULL)");





		if($awaber_url == "")

		{

				echo '<p style="float:left; color:Green;"> Your Message has been send successfully. We will contact you soon.</p>';



		}else

		{?>



        <script type="application/javascript">

		// redirect to google after 5 seconds

window.setTimeout(function() {

   window.location.href = '<?php echo $awaber_url; ?>/?uname=<?php echo $name;?>&uemail=<?php echo $email;?>&uphone=<?php echo $phone;?>';

}, 500);



		//window.open('<?php echo $awaber_url; ?>/?name=<?php echo $name;?>&email=<?php echo $email;?>&phone=<?php echo $phone;?>', '_blank', 'toolbar=0,location=0,menubar=0');

		</script>

        <?php



			echo '<p style="float:left; color:Green;"> Your Message has been send successfully. We will contact you soon.</p>';







		}





}else

{

	echo '<p style="float:left; color:red"> ERROR: Message can not send</p>';

}



} }
$post_ids = $post->ID;

if($post_ids == 3260 || $post_ids == 3229){?>
                <div class="ssba"><div style="text-align:left"><span>Partager cette étude!</span><br><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo site_url();?>/constipation-omnispec-2834464/" class="ssba_facebook_share"><img alt="Share on Facebook" class="ssba" title="Facebook" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/facebook.png"></a><a target="_blank" href="http://twitter.com/share?url=<?php echo site_url();?>/constipation-omnispec-2834464/&amp;text=Faites-vous+partie+des+millions+de+personnes+limit%C3%A9es+par+la+CONSTIPATION%3F+Mirabel%2C+QC%2C+Canada+" class="ssba_twitter_share"><img alt="Tweet about this on Twitter" class="ssba" title="Twitter" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/twitter.png"></a><a target="_blank" href="http://www.tumblr.com/share/link?url=studykik.com/constipation-omnispec-2834464/&amp;name=Faites-vous partie des millions de personnes limitées par la CONSTIPATION? Mirabel, QC, Canada" class="ssba_tumblr_share"><img alt="Share on Tumblr" class="ssba" title="tumblr" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/tumblr.png"></a><a href="mailto:?Subject=Faites-vous partie des millions de personnes limitées par la CONSTIPATION? Mirabel, QC, Canada&amp;Body=%20<?php echo site_url();?>/constipation-omnispec-2834464/" class="ssba_email_share"><img alt="Email this to someone" class="ssba" title="Email" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/email.png"></a></div></div>


            <?php }elseif(in_array($post_ids2, array(32360,59629))){}else{?>
<?php if (!$lv_sweepstakes){echo do_shortcode("[ssba]");} } ?>


      </div>




  				<!--<div class="col-xs-6 list" style="width:<?php if($feat_image == ""){ echo '100%'; }?>">



                	<?php the_content(); ?>
                    <p class="signing_up_txt" style="font-size:13px; color:gray; font-weight:bold; margin:0px 0 20px 0;">By signing up you agree to receive text messages and emails about this and similar studies near you. You can unsubscribe at any time.</p>



                </div>-->



            </div>







        </div>



        <div class="row">



        	<a href="javascript:void;" onclick="history.back(-1)" >&lt; Back to Search Results</a>



        </div>







			<?php endwhile; ?>

<?php  } ?>





		</div><!-- #content -->



	</div><!-- #primary -->





<?php setAndViewPostViews($post->ID);?>

<?php get_footer(); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.af-form-wrapper').on('submit', function(e) {
			st=false;
			var eml="";
			var phone="";
			$(".af-form-wrapper input[type=text]").each(function() {
				var tabin=$(this).attr('tabindex');
				if(tabin==501){
					eml=$(this).val();
					return false;
				}

			});
			$(".af-form-wrapper input[type=text]").each(function() {
				var tabin=$(this).attr('tabindex');
				if(tabin==502){
					phone=$(this).val();
					return false;
				}

			});
			eml=$.trim(eml);
			phone=$.trim(phone);
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(regex.test(eml)){
				var regx = /^\d{10}$/;
				var form = this,
				$form = $(form)
				$.ajax({
					async: false,
					url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
					type: 'POST',
					data: "action=instant_sign_up&"+$form.serialize(),
					success: function(data) {
						var dt=$.trim(data);
						if(dt!='no'){
							if(dt=='noops'){
								alert('Please enter a valid phone number');
							}
							else{
								st=true;
							}
						}
						else{
							alert('You have already used this Email to sign up for this study.');
						}
					}
				});
			}
			else{
				alert('Please enter a valid email address');
				return false;
			}
            is_form_submitted = true;
			return st;
		});
	});
</script>
<?php  }
else{




/**



 * The template for displaying all single posts



 *



 * @package WordPress



 * @subpackage Twenty_Thirteen



 * @since Twenty Thirteen 1.0



 */




if(is_single(22216) || is_single(31667) || is_single(31841)|| is_single(31862)){get_template_part( 'single', '22216' ); die(); }
if(is_single(35477)){get_template_part( 'single', '35477' ); die(); }

get_header(); ?>

<div id="inner-page">



	<div class="container">

<?php

if ( in_category('96') ) {?>



<style>

.inner-form p {

    color: #959CA1;

    font: 17px helvetica_neue_lt_com55_roman;

}

.inner-form{padding:20px !important;}

.drop-cus select.styled {

    float: left;

    height: 50px;

    width: 100%;

	color:#88DD25;

}



.select {



    float: left;

    font: 26px/45px helvetica_neue_lt_com67MdCn;

    height: 61px;

    left: 0;

    margin-bottom: 15px;



}

.drop-cus {

    float: left;

    height: 76px;

    position: relative;

    width: 100%;

}

.mandatory.gmw-address.gmw-full-address.gmw-address-1 {

    background-color: #E8E8E8;

    border: 0 none;

    box-shadow: 3px 2px 5px #C5C5C5 inset;

    color: #88DD25;

    float: left;

    font: 26px/30px helvetica_neue_lt_com67MdCn;

    height: 50px;

    margin-bottom: 15px;

    padding: 0 3%;

    width: 100%;

	 height: 55px;

}

.inner-form ul { margin:0px !important; padding:0px !important;}

</style>



    <div class="blog-left">

	<?php while ( have_posts() ) : the_post(); ?>

<input type="hidden" value="<?php echo gapp_get_post_pageviews(); ?>" class="pageviews_no" />
<input type="hidden" value="<?php echo gapp_get_post_pageviews(54342); ?>" class="pageviews_no1" />





				<div class="row inn-block">



        	<div class="innerlist">



            	<h1><?php the_title();?></h1>





           		<div style="padding:0 20px;" class="inner-form">

                <div class="img">

<?php

if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.

  the_post_thumbnail(array(250,250));

}

?>

</div>





                <?php the_content(); ?></div>





            </div>







        </div>









			<?php endwhile; ?>

            </div>



<div class="blog-right">

<?php get_sidebar(); ?>



</div>



<?php } else {?>

<style>
.col-xs-6.list img{ width:100% !important;}
</style>



			<?php /* The loop */ ?>



			<?php while ( have_posts() ) : the_post(); ?>


<input type="hidden" value="<?php echo gapp_get_post_pageviews(); ?>" class="pageviews_no" />
<input type="hidden" value="<?php echo gapp_get_post_pageviews(54342); ?>" class="pageviews_no1" />




				<div class="row inn-block">



        	<div class="innerlist">



            	<h1><?php the_title();?></h1>



				<div class="inner-form">


                <?php $post_ids = $post->ID;
				if($post_ids == 3162){?>
<!-- Pure Chat Snippet -->
<script type='text/javascript'>
(function () {	var done = false;	var script = document.createElement('script'); script.async = true;	script.type = 'text/javascript';	script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) {	if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({ c: 'bab234e1-3a99-448d-b117-2bb29457f303', f: true }); done = true;	}	};	})();
</script>

<?php }
				if($post_ids == 3260 || $post_ids == 3229){?>
                <p>Entrez vos informations pour nous rejoindre!</p>
                <style>.submit.slide-btn{  background: none repeat scroll 0 0 #f78f1e !important;
    color: #fff !important;
    font-size: 23px !important;
    width: 375px !important;}</style>
                <?php }elseif($post_ids ==4084){?>
                 <p>Enter your information to be contacted to See if you May Qualify </p>
                <?php }elseif($post_ids ==5701){ ?>
                <p>Enter your contact details to receive more information!</p>
                <?php }else{?>
                 <?php if($post_ids == 5701){
					  echo '<p>Enter your information to receive more information</p>';
					  }elseif($post_ids == 30569){  echo '<p>Enter your information</p>'; } else{?>
                <p><?php echo _studykik_func_1($_custom_fields,'trans_enter_your_information_to_join','Enter your information to join!'); ?></p>
                <?php } ?>
                <?php }?>
                <?php /*?><h5><?php echo  $key_1_values = get_post_meta( $post->ID, 'phone_number',true ); ?></h5><?php */?>





              <?php $get_response_code = get_post_meta( $post->ID, 'get_response_code',true );
              $is_pass_aweber = get_post_meta( $post->ID, 'pass_aweber', true );
              $is_pass_aweber = isset($is_pass_aweber[0]) ? $is_pass_aweber[0] : false;

			  if(false)

			  {
				echo $get_response_code;

				if($post_ids ==5701){
				echo '<p class="signing_up_txt2" style="font-size:13px; color:gray; float: left;font-weight:bold; margin:0px 0 20px 0;width: 45%;">By signing up you agree to receive text messages and emails about this and similar studies near you. You can unsubscribe at any time.</p>';
				}
			  }else{



			   ?>





  <form method="post" id="contactform" class="af-form-wrapper" action="<?php echo site_url();?>/default_thankyou_page_redirect.php"  >



<input id="awf_field-56733468" required="required" type="text" name="name" class="text" placeholder="<?php echo _studykik_func_1($_custom_fields,'trans_enter_your_first__last_name','Enter Your First & Last Name'); ?>" value=""/>

<input type="text" required="required" id="awf_field-56733469" type="email" tabindex="501" name="email" placeholder="<?php echo _studykik_func_1($_custom_fields,'trans_enter_your_email_address','Enter Your Email Address'); ?>" value=""/>

<input type="text" required="required" id="awf_field-56733470"  class="text" tabindex="502" placeholder="<?php echo _studykik_func_1($_custom_fields,'trans_enter_your_phone_number','Enter Your Phone Number'); ?>" name="custom Mobile Phone Number"/>

<input type="hidden" name="redirect_url" value="<?php
if(isset($_custom_fields['v2_template_engine'][0]) && ($_custom_fields['v2_template_engine'][0]=='1')){
 echo site_url().'/thank-you-for-subscribing2' ; 
}else{
 echo site_url().'/thank-you-for-subscribing-studykik' ; 
}
 ?>" />
<input type="hidden" name="post_id" value="<?php echo $post->ID; ?>" />
<input name="submit" class="submit slide-btn-trans" type="submit" value="<?php echo _studykik_func_1($_custom_fields,'trans_sign_up_now','Sign Up Now!'); ?>" tabindex="503" />



</form>


<script type="text/javascript">

    <!--

    (function() {

        var IE = /*@cc_on!@*/false;

        if (!IE) { return; }

        if (document.compatMode && document.compatMode == 'BackCompat') {

            if (document.getElementById("af-form-39699699")) {

                document.getElementById("af-form-39699699").className = 'af-form af-quirksMode';

            }

            if (document.getElementById("af-body-39699699")) {

                document.getElementById("af-body-39699699").className = "af-body inline af-quirksMode";

            }

            if (document.getElementById("af-header-39699699")) {

                document.getElementById("af-header-39699699").className = "af-header af-quirksMode";

            }

            if (document.getElementById("af-footer-39699699")) {

                document.getElementById("af-footer-39699699").className = "af-footer af-quirksMode";

            }

        }

    })();

    -->

</script>



<?php

if(isset($_POST['submit'])) {



	    global $wpdb;

		$name = $_REQUEST['name1'];

		$email = $_REQUEST['email1'];

		$phone = $_REQUEST['Phone'];



		$email_adress = get_post_meta( $post->ID, 'email_adress',true );

		$email_adress2 = get_post_meta( $post->ID, 'email_adress_2',true );

		$email_adress3 = get_post_meta( $post->ID, 'email_adress_3',true );

		$awaber_url = get_post_meta( $post->ID, 'awaber_url',true );



		$to  = $email_adress; // note the comma







$from = $name;



$subject = " New sign up for ".$post->post_title;

$message = "<body>

<table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>

  <tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>New sign up for Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Name:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$name."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Email Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$email."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Phone Number:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$phone."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study URL :</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'><a href=".get_permalink($post->ID).">Click Here</a></td>

  </tr>



  <tr>

    <td height='5' colspan='3' align='right' valign='middle'></td>



  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

</table>

</body>";



// Always set content-type when sending HTML email

$headers = "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

$headers .= "From: StudyKIK <info@studykik.com>\n";

$headers .= "Reply-To: ".$name." < ".$email." >\n";



$send_emil = wp_mail($to, $subject, $message,$headers);

wp_mail($email_adress2, $subject, $message,$headers);



wp_mail($email_adress3, $subject, $message,$headers);







if($send_emil){



        $date = date_create();

        $final_date = date_format($date, 'U = Y-m-d H:i:s');



		$wpdb->query("INSERT INTO `wp_cf7dbplugin_submits`(`submit_time`, `form_name`, `field_name`, `field_value`, `field_order`, `file`) VALUES ('$final_date','Contact form homepage','text-11','$name','',NULL)");

		$wpdb->query("INSERT INTO `wp_cf7dbplugin_submits`(`submit_time`, `form_name`, `field_name`, `field_value`, `field_order`, `file`) VALUES ('$final_date','Contact form homepage','email-362','$email','',NULL)");

		$wpdb->query("INSERT INTO `wp_cf7dbplugin_submits`(`submit_time`, `form_name`, `field_name`, `field_value`, `field_order`, `file`) VALUES ('$final_date','Contact form homepage','tel-356','$phone','',NULL)");





		if($awaber_url == "")

		{

				echo '<p style="float:left; color:Green;"> Your Message has been send successfully. We will contact you soon.</p>';



		}else

		{?>



        <script type="application/javascript">

		// redirect to google after 5 seconds

window.setTimeout(function() {

   window.location.href = '<?php echo $awaber_url; ?>/?uname=<?php echo $name;?>&uemail=<?php echo $email;?>&uphone=<?php echo $phone;?>';

}, 500);



		//window.open('<?php echo $awaber_url; ?>/?name=<?php echo $name;?>&email=<?php echo $email;?>&phone=<?php echo $phone;?>', '_blank', 'toolbar=0,location=0,menubar=0');

		</script>

        <?php



			echo '<p style="float:left; color:Green;"> Your Message has been send successfully. We will contact you soon.</p>';







		}





}else

{

	echo '<p style="float:left; color:red"> ERROR: Message can not send</p>';

}



} }
$post_ids = $post->ID;


if($post_ids == 3260 || $post_ids == 3229){?>
                <div class="ssba"><div style="text-align:left"><span>Partager cette étude!</span><br><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo site_url();?>/constipation-omnispec-2834464/" class="ssba_facebook_share"><img alt="Share on Facebook" class="ssba" title="Facebook" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/facebook.png"></a><a target="_blank" href="http://twitter.com/share?url=<?php echo site_url();?>/constipation-omnispec-2834464/&amp;text=Faites-vous+partie+des+millions+de+personnes+limit%C3%A9es+par+la+CONSTIPATION%3F+Mirabel%2C+QC%2C+Canada+" class="ssba_twitter_share"><img alt="Tweet about this on Twitter" class="ssba" title="Twitter" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/twitter.png"></a><a target="_blank" href="http://www.tumblr.com/share/link?url=studykik.com/constipation-omnispec-2834464/&amp;name=Faites-vous partie des millions de personnes limitées par la CONSTIPATION? Mirabel, QC, Canada" class="ssba_tumblr_share"><img alt="Share on Tumblr" class="ssba" title="tumblr" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/tumblr.png"></a><a href="mailto:?Subject=Faites-vous partie des millions de personnes limitées par la CONSTIPATION? Mirabel, QC, Canada&amp;Body=%20<?php echo site_url();?>/constipation-omnispec-2834464/" class="ssba_email_share"><img alt="Email this to someone" class="ssba" title="Email" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/email.png"></a></div></div>


            <?php }else{ 
				
            if($post_ids == 10000 || $post_ids == 34577 || $post_ids == 8702 || $post_ids == 8658 || $post_ids == 26632 || $post_ids == 27874 || $post_ids == 27649){ }else{?>
<?php

if(!isset($_custom_fields['is_show_social_sharing_icons'])){
 // by default show social sharing icons
 $show_social_sharing = true;
}else{
 $show_social_sharing = isset($_custom_fields['is_show_social_sharing_icons'][0]) ? ($_custom_fields['is_show_social_sharing_icons'][0] != '') : true;
}

 ?>           
<?php if($show_social_sharing && !$lv_sweepstakes) {
          // if there's a translation available, translate "Share this Study!" into proper language
            $_share_this_study_html = do_shortcode("[ssba]");
            if($_share_this_study_txt = _studykik_func_1($_custom_fields,'trans_share_this_study','Share this Study!')){
                $_share_this_study_html = str_replace('<span>Share this Study!</span>','<span>' . $_share_this_study_txt . '</span>', $_share_this_study_html);
            }
            echo $_share_this_study_html;
      } } ?>

<?php } ?>


      </div>

<style type="text/css">
    .call-now-section {
        text-align: center;
        width: 100%;
        float: left;
        background-color: #F5F5F5;
    }

    .call-now-btn {
        background-image:url(<?=get_template_directory_uri()?>/images/call_now_btn.png);
        margin-top:10px;
        margin-bottom:10px;
        padding-left:60px;
        padding-top: 32px;
        width:303px;
        height:66px;
        vertical-align: bottom;
        display: inline-block;
        font-size:24px;
        color:#ffffff;
    }

    .col-xs-12.no-padding {
        padding-left: 0;
        padding-right: 0;
    }

    .col-xs-6.list{
        padding-top:20px;
        padding-bottom:20px;
    }
    /* Smartphones (portrait) ----------- */
    @media only screen
    and (max-width : 480px) {
        /* Styles */
        .call-now-btn {
            -ms-transform: scale(0.8,0.8); /* IE 9 */
            -webkit-transform: scale(0.8,0.8); /* Safari */
            transform: scale(0.8,0.8);
        }
    }
</style>
                <?php



$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$phone_number = get_post_meta($post->ID, "call_now_button_phone_number", true);
if ($phone_number){
    $phone_rand = rand(2, 9);
    $phone_number = substr($phone_number,$phone_rand).substr($phone_number,0,$phone_rand);
}

if($feat_image){

?>



           		<div class="col-xs-6" style="text-align:center;">



                	<img src="<?php echo $feat_image; ?>" alt="">

                    <?php if ($phone_number) { ?>
                    <br/>

                    <div class="call-now-section">
                        <a class="call-now-link" href="tel://<?=$phone_number?>">
                            <div class="call-now-btn">
                                <?=$phone_number?>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>

<?php }?>


  				<div class="col-xs-6 list" style="width:<?php if($feat_image == ""){ echo '100%'; }?>">
                    <?php the_content(); ?>
                    <p class="signing_up_txt" style="font-size:13px; color:gray; font-weight:bold; margin:0;"><?php echo _studykik_func_1($_custom_fields,'by_signing_up_you_agree','By signing up you agree to receive text messages and emails about this and similar studies near you. You can unsubscribe at any time.'); ?></p>
                </div>

                <?php if (!$feat_image) { ?>
                    <?php if ($phone_number) { ?>
                        <div class="col-xs-12 no-padding" style="text-align:center; width:100%;">
                            <div class="call-now-section">
                                <a class="call-now-link" href="tel://<?=$phone_number?>">
                                    <div class="call-now-btn">
                                        <?=$phone_number?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <style>

                            .innerlist .col-xs-6.list p {



                                width: 100%;

                            }


                        </style>
                    <?php }?>

                <?php } ?>




            </div>







        </div>



        <div class="row">



        	<a href="javascript:void;" onclick="history.back(-1)" >&lt; Back to Search Results</a>



        </div>







			<?php endwhile; ?>

<?php  } ?>





		</div><!-- #content -->



	</div><!-- #primary -->





<?php setAndViewPostViews($post->ID);?>

<?php get_footer(); ?>
<script type="text/javascript">
	$(document).ready(function(){
        var phone_rand = parseInt("<?php echo $phone_rand; ?>");
        if (phone_rand){
            var phone_len = $('.call-now-btn').html().trim().length;
            var true_phone = $('.call-now-btn').html().trim().substr((phone_len-phone_rand))+$('.call-now-btn').html().trim().substr(0, (phone_len-phone_rand));
            $('.call-now-btn').html(true_phone);
            $('.call-now-link').attr("href", "tel://"+true_phone);
        }
		$('.af-form-wrapper').on('submit', function(e) {
			st=false;
			var eml="";
			var phone="";
			$(".af-form-wrapper input[type=text]").each(function() {
				var tabin=$(this).attr('tabindex');
				if(tabin==501){
					eml=$(this).val();
					return false;
				}

			});
			$(".af-form-wrapper input[type=text]").each(function() {
				var tabin=$(this).attr('tabindex');
				if(tabin==502){
					phone=$(this).val();
					return false;
				}

			});
			eml=$.trim(eml);
			phone=$.trim(phone);
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(regex.test(eml)){
				var regx = /^\d{10}$/;
				var form = this,
				$form = $(form)
				$.ajax({
					async: false,
					url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
					type: 'POST',
					data: "action=instant_sign_up&"+$form.serialize(),
					success: function(data) {
						var dt=$.trim(data);
						if(dt!='no'){
							if(dt=='noops'){
								alert('Please enter a valid phone number');
							}
							else{
								st=true;
							}
						}
						else{
							alert('You have already used this Email to sign up for this study.');
						}
					}
				});
			}
			else{
				alert('Please enter a valid email address');
				return false;
			}
            is_form_submitted = true;
			return st;
		});
	});
</script>


	<?php
  }
?>