<?php
/*
Single Post Template: No Image
*/
?>

<div id="inner-page">

	<div class="container">

			<?php /* The loop */ ?>

			<?php while ( have_posts() ) : the_post(); ?>



				<div class="row inn-block">

        	<div class="innerlist">

            	<h1><?php the_title();?></h1>
                
  				<div class="col-xs-6 list" style="width:100%">

                	<?php the_content(); ?>

                </div>

            </div>

            <div class="inner-form">

                <p>Fill out the information below to sign up for this specific study!</p>

                <h5><?php echo  $key_1_values = get_post_meta( $post->ID, 'phone_number',true ); ?></h5>

          
              <?php $get_response_code = get_post_meta( $post->ID, 'get_response_code',true );
			  
			  if($get_response_code)
			  {
				echo $get_response_code;  
			  }else{
			  
			   ?>


  <form method="post" id="contactform" class="af-form-wrapper" action="<?php echo get_permalink($post->ID);?>#contactform"  >

<input id="awf_field-56733468" required="required" type="text" name="name1" class="text" placeholder="Enter Your First & Last Name" value=""/>
<input class="text" required="required" id="awf_field-56733469" type="email" name="email1" placeholder="Enter Your Email Address" value=""/> 
<input type="text" required="required" id="awf_field-56733470"  class="text" placeholder="Enter Your Phone Number" name="Phone"/>
<input name="submit" class="submit slide-btn" type="submit" value="Submit" tabindex="503" />

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
?>

            </div>

        </div>

        <div class="row">

        	<a href="javascript:void;" onclick="history.back(-1)" >&lt; Back to Search Results</a>

        </div>



			<?php endwhile; ?>
		</div><!-- #content -->

	</div><!-- #primary -->



<?php get_footer(); ?>