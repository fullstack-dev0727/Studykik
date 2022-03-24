<?php
/*
* Template Name: CRO NEW Auth
*/
wp_logout();
get_header();

//print_r($_POST);

?>
<?php
$currdate =date('m/d/Y',strtotime('-4 hours'));
$croname=$_REQUEST['fullname'];
$croname=strtolower($croname);
//$user_id = get_current_user_id();
?>
<!-- Google Code for StudyKIK Conversion Page -->
<script type="text/javascript">// <![CDATA[
    var google_conversion_id = 979334053; var google_conversion_language = "en"; var google_conversion_format = "3"; var google_conversion_color = "ffffff"; var google_conversion_label = "dwNTCMebj1kQpef90gM"; var google_remarketing_only = false;
// ]]>
</script>
<script src="//www.googleadservices.com/pagead/conversion.js" type="text/javascript">// <![CDATA[

// ]]>
</script>
<noscript>
    <div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/979334053/?label=dwNTCMebj1kQpef90gM&guid=ON&script=0"/>
    </div>
</noscript>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
	$('#contactform').submit(function() {
	    var errors = 0;
	    $("#contactform .required").map(function(){
		if( !$(this).val() ) {
		    $(this).addClass('warning');
		    $("#fullname").focus();
		    errors++;
		}
		else if ($(this).val()) {
		    $(this).removeClass('warning');
		}
	    });
	    if(errors > 0){ //alert()
		//$('#errorwarn').text("All fields are required");
		return false;
	    }
	    // do the ajax..
	});
<!--      jQuery('#site_name').blur(function(e) {-->
<!-- var value = jQuery("#site_name").val(); // value = 9.61 use $("#text").text() if you are not on select box...-->
<!--  value = value.replace(/ /g, "_"); // value = 9:61-->
<!--// can then use it as-->
<!--jQuery("#u_name").val(value);-->
<!--var site_name=jQuery('#u_name').val();-->
<!--jQuery.ajax({-->
<!--    url: "--><?php //bloginfo('wpurl') ?><!--/wp-admin/admin-ajax.php",-->
<!--    type: 'POST',-->
<!--    data: "action=dashboard_cro_new&cro="+site_name,-->
<!--    success: function(html){-->
<!---->
<!--			jQuery('#u_name').val(html);-->
<!---->
<!---->
<!--                    }-->
<!---->
<!---->
<!--    })-->
<!---->
<!--});-->
    });
</script>
<script type="text/javascript">
    function checkPasswordMatch(){
        var password = $("#txtNewPassword").val();
        var confirmPassword = $("#txtConfirmPassword").val();
        var uname = $("#u_name").val();
        uname=$.trim(uname);
        var chk=false;
        if(uname !=""){
            jQuery.ajax({
            async: false,
            url: "<?php echo get_template_directory_uri(); ?>/check_username.php",
            type:'POST',
            data: "username="+uname,
            success: function(html){
                html=$.trim(html);
                if(html=='yes'){
                if (password != confirmPassword){
                    $("#divCheckPasswordMatch").html("Passwords do not match!");
                    $("#divCheckPasswordMatch").css("color", "red");
                    chk=false;
                }
                else{
                    $("#divCheckPasswordMatch").html("Passwords match.");
                    $("#divCheckPasswordMatch").css("color", "green");
                    chk=true;
                }
                }
                else{

                chk=false;
                }
            }
            });
        }
        else{

            chk=false;
        }
	return chk;
    }
    function keyupcheckPasswordMatch() {
	var password = $("#txtNewPassword").val();
	var confirmPassword = $("#txtConfirmPassword").val();
	if (password != confirmPassword){
	    $("#divCheckPasswordMatch").html("Passwords do not match!");
	    $("#divCheckPasswordMatch").css("color", "red");
	    return false;
	}
	else{
	    $("#divCheckPasswordMatch").html("Passwords match.");
	    $("#divCheckPasswordMatch").css("color", "green");
	    return true;
	}
    }
</script>
<style>
    #wpcf7-f74-p6-o123 .wpcf7-form-control-wrap {
	    float: left;
	    width: 628px;
    }
    #wpcf7-f74-p6-o123 .wpcf7-form-control-wrap a {
	    font-weight:bold;
    }
    input[type=checkbox] {
	    /* Double-sized Checkboxes */
      -ms-transform: scale(1.5); /* IE */
	    -moz-transform: scale(1.5); /* FF */
	    -webkit-transform: scale(1.5); /* Safari and Chrome */
	    -o-transform: scale(1.5); /* Opera */
    }
    .fisrt_step {
	    background: #fff none repeat scroll 0 0;
	    border: 1px solid #f78f1e;
	    float: left;
	    width: 100%;
	    margin-bottom:20px;
    }
    .inner_cont {
	    float: left;
	    padding: 30px;
	    width: 100%;
    }
    .show_hide_input {
	    width: auto !important;
    }
    .study label {
	    float: left;
	    font-size: 18px;
	    line-height: 43px;
	    width: 30%;
    }
    .study input[type="text"], .study input[type="email"], .study input[type="file"], .study select, .study textarea {
	    width:70%;
	    float:right;
    }
    .study  p {
	    float: left;
	    width: 100%;
    }
    .warning {
	border: 1px solid red !important;
    }
    .study input[type="checkbox"] {
      box-shadow: none;
      height: 25px;
    }
</style>
<div id="inner-page">
    <div class="container">
    <div id="dialog-confirm" style="padding: 0px; text-align: center;"></div>
	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
	    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
		    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		    <div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		    </div>
		    <?php endif; ?>
		    <h1 class="entry-title">
            <?php echo "Clinical Study Information";//the_title(); ?>
		    </h1>
		</header>
		<!-- .entry-header -->
		<div class="entry-content">
		    <div class="inner-form">
			<?php the_content(); ?>
			<?php
			if(isset($_POST['action']) && $_POST['action'] == "go_order"){
  			  //print_r($_POST);
  			  
  			  //SEEDCMS
          $studyARR     = array();
          $productARR     = array();
          $study_count  = 0;
          $product_count  = 0;
          $qtyCount     = 1;
          $last_4       = substr($_POST['cc_number'], -4);
          $first_name   = $_POST['first_name'];
          $last_name    = $_POST['last_name'];
          $full_name    = $first_name.' '.$last_name;
          $address      = $_POST['address'];
          $city         = $_POST['city'];
          $state        = $_POST['state'];
          $zip          = $_POST['zip'];
          $email        = $_POST['email'];
          $card_id        = $_POST['card_id'];
          $user_id        = $_POST['user_id'];
          $price_arr = array();
            $total_amount = 0;
//                print_r($_POST);
          foreach($_POST as $key => $value){
            if (stripos($key, "qty-") !== false && $value > 0) {

                $product_id = str_replace('qty-', '', $key);
                $product_title = get_the_title($product_id);
                $product_price = (float)get_post_meta($product_id, "product_price", true);
//                print_r($product_price);
                $total_amount += $product_price * $value;
                if (strpos($product_title, "Listing") == false) {
                    $product_price = $product_price;
                    $productARR[] = array("id" => $product_id, "title" => $product_title , "price" => $product_price, "qty" => $value);
                    $product_count ++;
                } else {
//                    continue;

                    $study_count  = $study_count + $value;
                    $loopCount    = 1;
                    while($loopCount <= $value){
                      $price_arr[] = $product_price;
                      $arrayID                    = $qtyCount - 1;
                      $studyARR[$arrayID]['id']   = str_replace('qty-', '', $key);
                      $studyARR[$arrayID]['qty']  = $value;
                      $qtyCount                   = $qtyCount + 1;
                      $loopCount                  = $loopCount + 1;


                    } // end while */
                }
            } // end if

          } // end foreach
//                print_r($productARR);
			    $number_of_studies = $study_count;

			    ?>
			    <form id="contactform" enctype="multipart/form-data" method="post">
				<div class="fisrt_step" id="third_step">
				    <h2 style="background:#f78f1e;color: #fff; text-transform: uppercase; margin: 0px; padding: 5px;">Enter Study Details</h2>
				    <div class="inner_cont" id="third_step_cont">
					<input type="hidden" name="total_entries" value="<?php echo $number_of_studies; ?>" />
					<?php
					for ($x=1; $x<=$number_of_studies; $x++){?>
					    <script type="text/javascript">
						$(function(){
						    $( "#datepicker<?php echo $x; ?>" ).datepicker();
						});
						function addNew<?php echo $x; ?>(asa){
						    var addDiv<?php echo $x; ?> = $('#addinput<?php echo $x; ?>');
						    var i = $('#addinput<?php echo $x; ?> p').size() + 1;
						    if(i == 5){ $(".addd_new<?php echo $x; ?>").hide(); }else{ $(".addd_new<?php echo $x; ?>").show(); }
						    $('<p><label>Recruitment Email #' + i +': </label><span class="wpcf7-form-control-wrap email-577"><input style="margin-bottom:0px;" type="email"  aria-required="true" size="40" value="" name="contactemail' + i + '<?php echo $x; ?>"><a style="position: absolute; top: 26px; right: -579px;" href="javascript:void();" onClick="return aaaaa<?php echo $x; ?>(this);" id="remNew"><img style="width: 12px;"  src="<?php bloginfo('template_url');?>/images-dashboard/delete_icon.png" /></a></span></p>').appendTo(addDiv<?php echo $x; ?>);
						    i++;
						    return false;
						}
						function aaaaa<?php echo $x; ?>(el){
						    $(el).parents('p').remove();
						    var i = $('#addinput<?php echo $x; ?> p').size()-1;
						    if(i == 5){ $(".addd_new<?php echo $x; ?>").hide(); }else{ $(".addd_new<?php echo $x; ?>").show(); }
						    $('#addinput<?php echo $x; ?> p:nth-child(1) label').html("Recruitment Email #1:");
						    $('#addinput<?php echo $x; ?> p:nth-child(2) label').html("Recruitment Email #2:");
						    $('#addinput<?php echo $x; ?> p:nth-child(3) label').html("Recruitment Email #3:");
						    $('#addinput<?php echo $x; ?> p:nth-child(4) label').html("Recruitment Email #4:");
						    $('#addinput<?php echo $x; ?> p:nth-child(5) label').html("Recruitment Email #5:");
						    return false;
						}
					    </script>
					    <div class="study<?php echo $x; ?> study" >
						<h2 style="background: #00afef; float:left; width:100%; color: #fff; font-size: 20px;margin: 0 0 10px;padding: 9px; text-transform: uppercase;">Study #<?php echo $x; ?></h2>
                            <p>
                                <?php // SEEDCMS - INJECT PAID ID's ?>
                                <?php
                                $array_id = $x -1;
                                $post_idx = $studyARR[$array_id]['id'];
                                $postx = get_post( $post_idx );
                                ?>

                                <label style="color: #00afef;">Exposure Level </label>
						    <span class="wpcf7-form-control-wrap" style="color: #00afef;">
						    <input type="hidden" name="boost_type<?php echo $x; ?>" value="<?php echo $postx->ID;?>" />
                                <?php echo $postx->post_title;?>
						    </span>
                            </p>

                            <div style="float:left;">
                            <p>
                                <label style="line-height: 24px;color: #00afef; width:241px;">Add Patient Messaging<br />
                                    Suite ($247) </label>
                                <span class="wpcf7-form-control-wrap textarea-350">
                                    <input style="width:auto;" type="checkbox" data-id="<?php echo $postx->id;?>" data-title="<?php echo $postx->post_title;?>" class="go_message_suite" name="message_suite_247<?php echo $x; ?>" />
                                    <span style="color: #00afef;line-height: 25px;margin-left: 10px;font-weight: bold;">Yes</span>
                                </span>
                            </p>
                            </div>
                            <div class="play_video_bttn_wrap"><div class="play_video_bttn" onclick="showVideo()"></div></div>
                            <p>
                                <label style="line-height: 24px;color: #00afef;">Condense to 2 <br />
                                    Weeks (Free) </label>
						    <span class="wpcf7-form-control-wrap">
						    <input style="width:auto;" type="checkbox" name="condense_2_weeks<?php echo $x; ?>" />
						    <span style="color: #00afef;line-height: 25px;margin-left: 10px;font-weight: bold;">Yes</span> </span>
                            </p>
                            <p>
						    <label>Study Type *<br></label>
						    <span class="wpcf7-form-control-wrap">
							<select class="required" aria-required="true" name="studytype<?php echo $x; ?>">
							    <option value="">Make a Selection</option>
							    <?php
							    $args = array(
								'orderby' => 'name',
								'parent'  => 6,
								'hide_empty' => 0,
								'order' => 'ASC'
							    );
							    $categories = get_categories($args);
							    foreach($categories as $category) { ?>
								<option value="<?php echo $category->name;?>"><?php echo $category->name;?></option>
							    <?php } ?>
							    <option value="Other Study Type">Other Study Type</option>
							</select>
						    </span>
						</p>
						<p>
						    <label>Site Name * </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input class="required" aria-required="true"  type="text" size="40" value="" name="sitename<?php echo $x; ?>" >
						    </span>
						</p>
						<p>
						    <label>Study Address * </label>
						    <span class="wpcf7-form-control-wrap text-848">
						    <input class="required" aria-required="true"  type="text" size="40" value="<?php echo $address; ?>" name="studylocation<?php echo $x; ?>" >
						    </span>
						</p>
						<p>
						    <label>Study Details </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <textarea aria-required="true"  rows="6" cols="50" name="studydetails<?php echo $x; ?>"></textarea>
						    </span>
						</p>
						<p>
						    <label>Protocol Number * </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input class="required" aria-required="true"  type="text" size="40" value="" name="protocolnumber<?php echo $x; ?>" >
						    </span>
						</p>
						<p>
						    <label>Sponsor Name * </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input class="required" aria-required="true"  type="text" size="40" value="" name="sponsorname<?php echo $x; ?>" >
						    </span>
						</p>
						<p>
						    <label>Sponsor Email </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input aria-required="true"  type="text" size="40" value="" name="sponsoremail<?php echo $x; ?>" >
						    </span>
						</p>
                        <p>
                                <label>CRO Name </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input class="form-control " type="text" size="40" value="" name="croname<?php echo $x; ?>" >
                        </span>
                            </p>
                            <p>
                                <label>CRO Email </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input  type="text" size="40" value="" name="croemail<?php echo $x; ?>" >
                        </span>
                            </p>
                        <p>
                                <label>IRB Name </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input class="form-control " type="text" size="40" value="" name="irbname<?php echo $x; ?>" >
                        </span>
                            </p>
                            <p>
                                <label>IRB Email </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input  type="text" size="40" value="" name="irbemail<?php echo $x; ?>" >
                        </span>
                            </p>
						<div id="addpicker<?php echo $x; ?>">
						    <p>
							<label>Start Date * </label>
							<span class="wpcf7-form-control-wrap textarea-350">
							<input class="required" id="datepicker<?php echo $x; ?>"  aria-required="true"  type="text" size="40" value="<?php echo date('m/d/Y');?>" name="startdate<?php echo $x; ?>" >
							</span>
						    </p>
						</div>
						<p class="addd_new<?php echo $x; ?>"><label></label>  <span class="wpcf7-form-control-wrap text-426"><a class="determine_start" unique_id="<?php echo $x; ?>" style="float: left; display: block; font-size: 16px; font-weight: bold; margin-bottom: 6px;margin-top: -6px;" href="javascript:void(0);">To be determined</a></span></p>
						<p>
						    <label>Recruitment Phone * </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input class="required" aria-required="true"  type="text" size="40" value="" name="contactphone<?php echo $x; ?>" >
						    </span>
						</p>
						<div id="addinput<?php echo $x; ?>">
						    <p>
							<label>Recruitment Email #1 * </label>
							<span class="wpcf7-form-control-wrap text-426">
							<input class="required" style="margin-bottom:0px;" type="email"  aria-required="true"  size="40" value="" name="contactname<?php echo $x; ?>">
							</span>
						    </p>
						</div>
						<p class="addd_new<?php echo $x; ?>"><label></label>  <span class="wpcf7-form-control-wrap text-426"><a style="float: left; display: block; font-size: 16px; font-weight: bold; margin: 7px 0px;" onclick="return addNew<?php echo $x; ?>(this);" href="javascript:void();">Add another recruitment email</a></span></p>
						<p>
						    <label>Study Website </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input aria-required="true"  type="text" size="40" value="" name="study_website<?php echo $x; ?>" >
						    </span>
						</p>

						<p>
						    <label style="line-height: 24px;">Upload Study Ad <br />
						      (not required)</label>
						    <span class="wpcf7-form-control-wrap your-file">
						    <input type="file" class="attachment" size="40" name="attachment<?php echo $x; ?>">
						    </span>
						</p>

						<p>
						    <label>Notes </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <textarea aria-required="true"  rows="6" cols="50" name="notes<?php echo $x; ?>"></textarea>
						    </span>
						</p>
					    </div>
					    <input type="hidden" value="<?php echo $last_4; ?>" name="creditcard<?php echo $x; ?>" />
					    <input type="hidden" value="total_studies<?php echo $x; ?>" name="total_studies<?php echo $x; ?>" />
					    <input type="hidden" value="<?= $price_arr[$x - 1]?>" name="study_product_price<?php echo $x; ?>" />
					<?php
					}
                    for ($x=1; $x<=$product_count; $x++){
                        $array_id = $x-1;
                    ?>
                        <input type="hidden" value="<?php echo $productARR[$array_id]['id']; ?>" name="product_id<?php echo $x; ?>" />
                        <input type="hidden" value="<?php echo $productARR[$array_id]['title']; ?>" name="product_title<?php echo $x; ?>" />
                        <input type="hidden" value="<?php echo $productARR[$array_id]['price']; ?>" name="product_price<?php echo $x; ?>" />
                        <input type="hidden" value="<?php echo $productARR[$array_id]['qty']; ?>" name="product_qty<?php echo $x; ?>" />
                        <?php
                    }?>
					<p>
					    <label></label>

                        <input type="hidden" name="total_products" value="<?= $product_count?>"/>
                        <input type="hidden" name="action" value="newstudylist"/>
					    <input type="submit" class="show_hide_input" name="show_hide_input" id="go_contact_form" value="List My Studies">
					</p>
				    </div>
				</div>


				    <input type="hidden" name="transaction_id" id="transaction_id" value="<?= $_POST['transaction_id']?>"/>
				    <input type="hidden" name="order_id" id="order_id" value="<?= $_POST['order_id']?>"/>
				    <input type="hidden" name="invoice_number" id="invoice_number" value="<?= $_POST['invoice_number']?>"/>
				    <input type="hidden" name="user_id" id="user_id" value="<?= $user_id?>"/>
				    <input type="hidden" name="card_id" id="card_id" value="<?= $_POST['card_id']?>"/>
				    <input type="hidden" name="coupon" id="coupon" value="<?= $_POST['coupon']?>"/>
				    <input type="hidden" name="last_4" id="last_4" value="<?= $last_4?>"/>
                    <input name="total_amount" class="total_amount" type="hidden" value="<?= $total_amount;?>" />

			    </form>
			    <div class="fisrt_step payment_details" style="display: none;">
				    <h2 style="background:#f78f1e;color: #fff; text-transform: uppercase; margin: 0px; padding: 5px;">Payment Details</h2>
            <div class="inner_cont">

                    <form action="" method="post" class="form-confirm-text-charges" style="text-align: center;">
                        <?php
                            // seedcms
                            $ecommerce_enabled = get_option('ecommerce_enabled');
//                            $ecommerce_enabled = 1;
                            if((bool) $ecommerce_enabled){
                                $card = get_post($card_id);
                                $auth_profile_id        = get_post_meta($card->ID, 'auth_profile_id', true);
                                $auth_payment_profile   = get_post_meta($card->ID, 'auth_payment_profile', true);
                                $auth_shipping_profile  = get_post_meta($card->ID, 'auth_shipping_profile', true);
                                $payment_user_id        = get_post_meta($card->ID, 'payment_user_id', true);
                                $auth_credit_card       = get_post_meta($card->ID, 'auth_credit_card', true);
                                $auth_card_code         = get_post_meta($card->ID, 'auth_card_code', true);
                        ?>

                            <div style="font-size:21px;">
                                <div class="message-suite-charges"></div>
                                <div>Card Ending in <?=$auth_credit_card?></div>
                            </div>

                        <?php } ?>

                        <div style="margin-top:10px;"><button class="go_charges done_button go-upgrade-button">Confirm Order</button></div>
                        <?php
                        if ($auth_profile_id) {
                        ?>
                        <input  name="payment_credit_card_id" id="payment_credit_card_id" type="hidden" value="<?=$card->ID?>" />
                        <input  name="payment_profile_id" id="payment_profile_id" type="hidden" value="<?=$auth_profile_id?>" />
                        <input  name="payment_payment_id" id="payment_payment_id" type="hidden" value="<?=$auth_payment_profile?>" />
                        <input  name="payment_shipping_id" id="payment_shipping_id" type="hidden" value="<?=$auth_shipping_profile?>" />
                        <input  name="payment_card_code" id="payment_card_code" type="hidden" value="<?=$auth_card_code?>" />
                        <?php
                        } else {
                        ?>
                            <input  name="cc_number" id="cc_number" type="hidden" value="<?=$_POST['cc_number']?>" />
                            <input  name="cc_cvv2" id="cc_cvv2" type="hidden" value="<?=$_POST['cc_cvv2']?>" />
                            <input  name="cc_exp_month" id="cc_exp_month" type="hidden" value="<?=$_POST['cc_exp_month']?>" />
                            <input  name="cc_exp_year" id="cc_exp_year" type="hidden" value="<?=$_POST['cc_exp_year']?>" />
                            <input  name="zip" id="zip" type="hidden" value="<?=$_POST['zip']?>" />
                        <?php
                        }
                        ?>
                        <input  name="invoice_number" id="invoice_number" type="hidden" value="<?=$_POST['invoice_number']?>" />
                        <input  name="action" type="hidden" value="newstudymessagesuite" />
                        <input name="transaction_id" type="hidden" value="<?php echo $_POST['transaction_id'];?>" />
                        <input name="message_suites" class="message_suites" type="hidden" value="" />
                        <input name="user_id" class="user_id" type="hidden" value="<?php echo $user_id; ?>" />
                        <input name="amount" class="amount" type="hidden" value="" />
                        <div class="messagesuite-processing" style="display:none; text-align: center;">
                            <img src="/wp-content/themes/twentyfifteen/images/loading.gif" />
                            Processing Payment...
                        </div>
                    </form>


                    <script>
                        function showVideo(){
                            $( "#dialog-confirm").html('<iframe width="600" height="460" src="https://www.youtube.com/embed/RUHCnmQy5Yk?autoplay=1"></iframe>');
                            $( "#dialog-confirm" ).dialog();

                            $( "#dialog-confirm" ).dialog({
                                resizable: false,
                                width:610,
                                draggable: false,
                                modal: true,
                                close: function(event, ui) { $('#wrap').show(); $( "#dialog-confirm").html('');},
                                open: function(event, ui) { $('.ui-widget-overlay').bind('click', function(){ $("#dialog-confirm").dialog('close'); $( "#dialog-confirm").html(''); }); }
                            });
                            //$(".ui-dialog-titlebar").hide();
                            $(".ui-dialog-titlebar-close span").css('margin', '-8px');
                        }
          				    jQuery(document).ready(function(){

            				      $('.go-card').change(function(){
                            $('#payment_profile_id').val($(this).find(':selected').attr('data-profile-id'));
                            $('#payment_payment_id').val($(this).find(':selected').attr('data-payment-id'));
                            $('#payment_shipping_id').val($(this).find(':selected').attr('data-shipping-id'));
                            $('#payment_card_code').val($(this).find(':selected').attr('data-cvv'));

                            return false;
                          });
                     jQuery('.go_message_suite').change(function(){
                         check_message_suite_text();
                     });
                     //go_charges
                     jQuery('.go_charges').click(function(){
                         var errors = 0;
                         $("#contactform .required").map(function(){
                             if( !$(this).val() ) {
                                 $(this).addClass('warning');
                                 $("#fullname").focus();
                                 errors++;
                             }
                             else if ($(this).val()) {
                                 $(this).removeClass('warning');
                             }
                         });
                         if(errors > 0){ //alert()
                             //$('#errorwarn').text("All fields are required");
                             return false;
                         } else {
                             var ajaxurl     = '/wp-admin/admin-ajax.php';
                             var datastring  = $('.form-confirm-text-charges').serialize();
//                             $('.messagesuite-processing').html("Processing...");
                             $('.messagesuite-processing').show();
//                             $('.go_charges').prop("disabled", true);
                             $.ajax({
                                 type: "POST",
                                 url: ajaxurl,
                                 data: datastring,
                                 //dataType: "json",
                                 success: function(data) {
                                     var response = JSON.parse(data);
                                     console.log(response[0]);
                                     if (response[0].approved != "no") {
                                         $('.go_charges').html("Approved!");
                                         $('.messagesuite-processing').hide();
                                        if ($("#invoice_number").val() == "0" || $("#invoice_number").val() == "") {
                                            $("#invoice_number").val(response[0].invoice_number)
                                        }
                                        $('#contactform').submit();
                                     } else {
                                         $('.go_charges').prop("disabled", false);
                                         $('.messagesuite-processing').html("Sorry! We are unable to process the payment.");

                                     }

                                 },
                                 error: function(data){
                                     console.log(data);
                                     alert('Error');
                                     $('.go_charges').prop("disabled", false);
                                     $('.messagesuite-processing').html("Sorry! We are unable to process the payment.");

                                 }
                             });


                             return false;
                         }


                      });

          				    // seedcms ajax call
                        jQuery('#go_contact_form').click(function(){
                            var errors = 0;
                            $("#contactform .required").map(function(){
                                if( !$(this).val() ) {
                                    $(this).addClass('warning');
                                    $("#fullname").focus();
                                    errors++;
                                }
                                else if ($(this).val()) {
                                    $(this).removeClass('warning');
                                }
                            });
                            if(errors > 0){ //alert()
                                //$('#errorwarn').text("All fields are required");
                                return false;
                            } else {
                                // check for extra charges...

                              $('#contactform').submit();
                            // #contactform submit
                            return false;
                            }
                        }); // end click
                    }); // end document
                            function check_message_suite_text() {
                                var messageSuiteCount    = 0;
                                var messageSuiteCharges  = 0;
                                var showModal     = 'no';
                                var messageSuiteTotal    = $('.go_message_suite').size();
                                var messageSuiteInfo     = '';
                                var messageSuiteAuth     = '';
                                var isChecked     = 'no';
                                //alert(messageSuiteTotal);
                                $('.go_message_suite').each(function(){

                                    //console.log('go message suite');

                                    if( $(this).is(':checked') ){
                                        console.log($(this).val()+messageSuiteCount);
                                        messageSuiteInfo     = messageSuiteInfo + 'ID:'+$(this).data('id')+'Title:'+$(this).data('title')+'|';
                                        messageSuiteCharges  = messageSuiteCharges + 247;
                                        showModal     = 'yes';
                                        isChecked     = 'yes';
                                        //var item_cost   = $(this).data('price') * $(this).val();
                                        //order_total     = order_total + item_cost;
                                        //order_summary   += $(this).val() +' / '+$(this).data('title') + ' / $'+item_cost+'<br />';
                                        messageSuiteCount = messageSuiteCount + 1;
                                    }



                                });

                                // SHOW MODAL
                                if(isChecked == 'yes'){
                                    $('.message-suite-charges').html(messageSuiteCount + ' Patient Messaging Suite: $'+parseFloat(Math.round(messageSuiteCharges * 100) / 100).toFixed(2));
                                    $('.payment_details').slideDown(1000);
                                    $('#go_contact_form').hide();
                                    $('.message_suites').val(messageSuiteInfo);
                                    $('.amount').val(messageSuiteCharges);
                                } else {
                                    $('#go_contact_form').show();
                                    $('.payment_details').slideUp(1000);

                                }
                            }
          				  //========================
            </script>


            </div>
			    </div>
			<?php
			} else if(isset($_POST['action']) && $_POST['action'] == "newstudylist") {
                $query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` ORDER BY `id` DESC LIMIT 1");
                foreach($query_invoice_number as $query_invoice_number_value){
                    $invoice_num = $query_invoice_number_value->invoice_number;
                }

                global $wpdb;

                $study_arr = array();
                $user_id                    = $_REQUEST['user_id'];
                $userData                   = get_userdata($user_id);
				$first_name                 = get_user_meta($user_id, "first_name", true);
				$last_name                  = get_user_meta($user_id, "last_name", true);
                $fullname                   = $first_name." ".$last_name;
			    $username                   = $userData->data->user_email;
                $username2                  = $userData->data->user_login;
                $transaction_id             = $_REQUEST['transaction_id'];
                $coupon                     = $_REQUEST['coupon'];
                $total_amount               = $_REQUEST['total_amount'];

                $card_id                    = $_REQUEST['card_id'];

                $auth_card_type             = get_post_meta($card_id, 'auth_card_type', true);
                $auth_credit_card           = get_post_meta($card_id, 'auth_credit_card', true);
                $card_billing_first_name    = get_post_meta($card_id, 'card_billing_first_name', true);
                $card_billing_last_name     = get_post_meta($card_id, 'card_billing_last_name', true);
                $card_billing_zip           = get_post_meta($card_id, 'card_billing_zip', true);
                $card_billing_company       = get_post_meta($card_id, 'card_billing_company', true);
                if (!$card_billing_company) {
                    $card_billing_company = $company;
                }

                $product_arr = array();

                $c_discount = 0;
                if($coupon){
                    $coupon_data = get_coupon($coupon);
                    $discount         = get_coupon($coupon);

                    if ($discount['type'] == "percent") {
                        $percent  = (float) $discount['value'];
                        $c_discount   = ($total_amount / 100) * $percent;
                    } else if ($discount['type'] == "fixed") {
                        $old_price        = (float) $amount;
                        $c_discount   = (float) $discount['value'];
                    }
                }

//            print_r($c_discount);
                $total_entries      = $_REQUEST['total_entries'];
                $total_products     = $_REQUEST['total_products'];
                $avg_discount       = $c_discount / ($total_entries + $total_products);
                $discount_price_arr = array();
                $price_arr          = array();
                $discount_arr       = array();

                for ($i = 1; $i <= $total_entries; $i ++) {
                    $price_arr[$i - 1] = $_REQUEST['study_product_price'.$i];
                    $discount_price_arr[$i - 1] = $price_arr[$i - 1] - $avg_discount;

                    $study_price = 0;
//                    $boost_type = $_REQUEST['boost_type'.$i];
                    $product = get_post($_REQUEST['boost_type'.$i]);
                    $product_title = $product->post_title;
                    $product_title_parts = explode(" ", $product_title);
                    $product_price    = (float)get_field('product_price', $product->ID);
                    $points    = get_field('points', $product->ID);

                    $study_price = $product_price;
                    $boost_type = $product_title;

                    if ($product_arr[$product_title]) {
                        $product_arr[$product_title]['qty'] = $product_arr[$product_title]['qty'] + 1;
                    } else {
                        $product_arr[$product_title] = array("title" => $product_title , "price" => (int)$study_price, "qty" => 1);
                    }
                }
//            print_r($discount_price_arr);


            for ($y=1; $y<=$total_products; $y++){

                $product_id = $_REQUEST['product_id'.$y];
                $product_title = $_REQUEST['product_title'.$y];
                $product_qty = $_REQUEST['product_qty'.$y];
                $product_price = $_REQUEST['product_price'.$y];
                $price_arr[$y - 1 + $total_entries] = $product_price * $product_qty;
                $discount_price_arr[$y - 1 + $total_entries] = $price_arr[$y - 1 + $total_entries] - $avg_discount;
                if ($product_arr[$product_title]) {
                    $product_arr[$product_title]['qty'] = $product_arr[$product_title]['qty'] + 1;
                } else {
                    $product_arr[$product_title] = array("title" => $product_title , "price" => (int)$product_price, "qty" => $product_qty);
                }
            }

            $should_continue = true;
            $is_possible = false;
            $minus_value = 0;
            while($should_continue) {
                $should_continue = false;
                $is_possible = false;
                for ($i = 0; $i < $total_entries + $total_products; $i ++) {
                    if ($discount_price_arr[$i] < 0) {
                        $minus_value += $discount_price_arr[$i];
                        $discount_price_arr[$i] = 0;
                        $should_continue = true;
                    } else if($discount_price_arr[$i] > 0) {
                        $discount_price_arr[$i] = $discount_price_arr[$i] + $minus_value;
                        $minus_value = 0;
                        if ($discount_price_arr[$i] < 0) {
                            $minus_value += $discount_price_arr[$i];
                            $discount_price_arr[$i] = 0;
                            $should_continue = true;
                        }
                    }
                }
                if ($is_possible) {
                    $should_continue = true;
                }
            }
            for ($i = 0; $i < $total_entries + $total_products; $i ++) {
                $discount_arr[$i] = $price_arr[$i] - $discount_price_arr[$i];

            }
//print_r($discount_price_arr);
//print_r($discount_arr);
//            exit;

                $order_id = $_REQUEST['order_id'];
                $last_4 = $_REQUEST['last_4'];
                $siteaddress=stripslashes($_REQUEST['site_addr']);
                $sitename=stripslashes($_REQUEST['site_name']);


			    for ($y=1; $y<=$total_entries; $y++){
					//echo "<pre>";
					//print_r($_FILES);
					//$nmm=$_FILES['attachment'.$y]['name'];
					//$upnm=str_replace(" ","_",$nmm);
					//$_FILES['attachment'.$y]['name']=$upnm;
					//print_r($_FILES);
					//echo "</pre>";
					//die;
				$final_num =  $invoice_num+1;
                    $invoice_num = $invoice_num + 1;
				$studytype = stripslashes($_REQUEST['studytype'.$y]);
				$sitename = stripslashes($_REQUEST['sitename'.$y]);
				$studylocation = stripslashes($_REQUEST['studylocation'.$y]);
				$studydetails = stripslashes($_REQUEST['studydetails'.$y]);
				$protocolnumber = stripslashes($_REQUEST['protocolnumber'.$y]);
				$croname = stripslashes($_REQUEST['croname'.$y]);
                $croemail = stripslashes($_REQUEST['croemail'.$y]);
				$irbname = stripslashes($_REQUEST['irbname'.$y]);
                $irbemail = stripslashes($_REQUEST['irbemail'.$y]);
				$startdate = stripslashes($_REQUEST['startdate'.$y]);
				$notes = stripslashes($_REQUEST['notes'.$y]);
				$contactname = stripslashes($_REQUEST['contactname'.$y]);
				$contactemail = stripslashes($_REQUEST['contactemail2'.$y]);
				$contactemail2 = stripslashes($_REQUEST['contactemail3'.$y]);
				$contactemail3 = stripslashes($_REQUEST['contactemail4'.$y]);
				$contactemail4 = stripslashes($_REQUEST['contactemail5'.$y]);
				$contactphone = stripslashes($_REQUEST['contactphone'.$y]);
				$study_website = stripslashes($_REQUEST['study_website'.$y]);

                $product = get_post($_REQUEST['boost_type'.$y]);
                $product_title = $product->post_title;
                $product_title_parts = explode(" ", $product_title);
                $product_price    = (float)get_field('product_price', $product->ID);
                $points    = get_field('points', $product->ID);
                $boost_type1 = $product_title;
                $boost_type_pr1 = "";
                $boost_type_pr2 = "";

                    $price = '$'.str_replace('USD ','',money_format('%i', $product_price));
                    $price2 = $product_price;
                    $boost_type_pr1 = $product_title_parts[0] . " $". $product_price;
                    $boost_type_pr2 = $boost_type_pr1;
                    $point_transfer = $points;
                    $act_txt = $product_title_parts[0];

				$sponsorname = stripslashes($_REQUEST['sponsorname'.$y]);
				$sponsoremail = stripslashes($_REQUEST['sponsoremail'.$y]);
				$creditcard = stripslashes($_REQUEST['creditcard'.$y]);
                $coupon_discount = $discount_arr[$y - 1];




				$transfer_id=$user_id;

				if($point_transfer > 0 && $transfer_id !=0 ){
				$rewards_datetime = date('Y-m-d H:i:s',strtotime('-4 hours'));
				$result1=mysql_query("SELECT `balance` FROM `0gf1ba_rewards_details` WHERE user_id='$transfer_id' and is_last=1  ORDER BY `id` DESC LIMIT 1");
				$balance = 0;
				while($row = mysql_fetch_assoc($result1)) {
				//print_r($row);
				    $balance=$row["balance"];
				}

				if($balance == 0)
				{
				    $new_balance=$point_transfer;
				}
				   else{
				       $new_balance=$point_transfer+$balance;
				   }
				   //echo $balance.'ccccccccccccc';

				   $activity='List a new study'.' ('.$act_txt .')';
				mysql_query("UPDATE 0gf1ba_rewards_details SET is_last=0 WHERE user_id='$transfer_id'");
				$wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_rewards_details`(`id`, `user_id`, `activity_of_points`,`rewards_date_time`,`credit`,`debit`,`balance`,`is_last`) VALUES (NULL,'$transfer_id','$activity','$rewards_datetime','$point_transfer',0,'$new_balance',1)",array()));
				update_user_meta($transfer_id, 'rewards', $new_balance);
				}
				$message_suite_247 = $_REQUEST['message_suite_247'.$y];
				if($message_suite_247 == true){
				    $message_suite_247 = "Yes";
				    $message_suite = "$247.00";
				    $message_suite2 = "247.00";
                    if ($product_arr["Messaging Suite"]) {
                        $product_arr["Messaging Suite"]["qty"] = $product_arr["Messaging Suite"]["qty"] + 1;
                    } else {
                        $product_arr["Messaging Suite"] = array("title" => "Messaging Suite" , "price" => 247, "qty" => 1);
                    }
				}
				else{
				    $message_suite_247 = "No";
				    $message_suite = " ";
				    $message_suite2 = " ";
				}
				$condense_2_weeks = $_REQUEST['condense_2_weeks'.$y];
				if($condense_2_weeks == true){
				    $condense_2_weeks = "Yes";
				    $end_date = "15 days";
				    $newDate = date("m/d/Y", strtotime($startdate ." +14 day") );
				}
				else{
				    $condense_2_weeks = "No";
				    $end_date = "30 days";
				    $newDate = date("m/d/Y", strtotime($startdate ." +29 day") );
				}

//                    print_r($product_arr);

                    $sub_total = $price2 + $message_suite2;
                $sub_price = $sub_total - $coupon_discount;

				//setlocale(LC_MONETARY,"en_US");
				$sub_price =  number_format( $sub_price ,  2 ,  '.' ,  ',' );
				$sub_price="$".$sub_price;
				//$total_price = str_ireplace("USD","$",$sub_price);
                $total_price = str_ireplace(" ", "", $sub_price);
                    if ($point_transfer > 0) {
                        $rewards = get_the_author_meta('rewards', $user_id);
                        $boost_value = $rewards + $point_transfer;
                        update_user_meta($user_id, 'rewards', $boost_value);
                    }

				$subject = "cro/sponsors focus (".$final_num.")";
				$message .= "<body><table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>
				<tr>
				    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>CRO/SPONSORS FOCUS STUDY #".$y."</strong></td>
				</tr>
				<tr>
				    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Site Name:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sitename."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Protocol Number:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$protocolnumber."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Name:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sponsorname."</td>
				</tr>";
				 if (strpos(strtolower($sponsoremail),'@studykik.com') == false) {
				 $message .= " <tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Email:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sponsoremail."</td>
				</tr>";
				 }
                $message .= "<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> CRO Name:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$croname."</td>
                </tr>
                <tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> CRO Email:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$croemail."</td>
                </tr>";
                $message .= "<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> IRB Name:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$irbname."</td>
                </tr>
                <tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> IRB Email:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$irbemail."</td>
                </tr>";
				 $message .= " <tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Start Date:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$startdate."</td>
				</tr>";
				 $l2=0;
	             if (strpos(strtolower($contactname),'@studykik.com') == false) { $l2++;

				 $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname."</td>
				</tr>";
				 }
				if (strpos(strtolower($contactemail),'@studykik.com') == false) { $l2++;
				 $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail."</td>
				</tr>";
				}
				if (strpos(strtolower($contactemail2),'@studykik.com') == false) { $l2++;
				$message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail2."</td>
				</tr>";
				}
				if (strpos(strtolower($contactemail3),'@studykik.com') == false) { $l2++;
				$message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail3."</td>
				</tr>";
				}
				if (strpos(strtolower($contactemail4),'@studykik.com') == false) { $l2++;
				$message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail4."</td>
				</tr>";
				}
				$message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Website:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$study_website."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type_pr1."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Add Patient Messaging Suite $247:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$message_suite_247."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Condense to 2 Weeks: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$condense_2_weeks."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Coupon: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$coupon."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Credit Card (Last 4 Digits): </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$last_4."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Paid by Check: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:noe; border-top:none; border-right:none;'>".($last_4 ? "No" : "Yes")."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Notes: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$notes."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Invoice Number: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$final_num."</td>
				</tr>
				<tr>
				    <td height='5' colspan='3' align='right' valign='middle'></td>
				</tr>
				<tr>
				    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
				</tr>
				</table>
				</body>";
				$category_id = get_cat_ID($studytype);
				$final_titile= $sitename.' '.$studytype.' Study - Location: '.$studylocation;
                    $my_post = array(
                        'post_title' => $final_titile,
                        'post_content' => $studydetails,
                        'post_status' => 'pending',
                        'post_author' => $user_id,
                        'post_category' => array($category_id)
                    );
//                    print_r($my_post);exit;
				$post_id = wp_insert_post( $my_post );
                    $study_arr[] = $post_id;
				update_post_meta($post_id, 'email_adress', 'info@studyKIK.com');
				update_post_meta($post_id, 'email_adress_2', $contactname);
				update_post_meta($post_id, 'email_adress_3', $contactemail);
				update_post_meta($post_id, 'email_adress_4', $contactemail2);
				update_post_meta($post_id, 'email_adress_5', $contactemail3);
				update_post_meta($post_id, 'email_adress_6', $contactemail4);
				update_post_meta($post_id, 'phone_number', $contactphone);
				update_post_meta($post_id, 'exposure_level', $boost_type_pr2);
				update_post_meta($post_id, 'name_of_site', $sitename);
				update_post_meta($post_id, 'study_full_address', $studylocation);
				update_post_meta($post_id, 'website_url_thank_you_page', $study_website);
				update_post_meta($post_id, 'custom_title_(for_thank_you_page)', $studytype);
				update_post_meta($post_id, 'study_end_date_new_study', $newDate);
				update_post_meta($post_id, 'protocol_no', $protocolnumber);
				update_post_meta($post_id, 'notes_cro', $notes);
				update_post_meta($post_id, 'sponsor_name', $sponsorname);
				update_post_meta($post_id, 'sponsor_email', $sponsoremail);
                update_post_meta($post_id, 'cro_name', $croname);
                update_post_meta($post_id, 'cro_email', $croemail);
                update_post_meta($post_id, 'irb_name', $irbname);
                update_post_meta($post_id, 'irb_email', $irbemail);
				update_post_meta($post_id, 'creadit_card', $creditcard);
				update_post_meta($post_id, 'coupon', $coupon);
                update_post_meta($post_id, 'condence', $condense);
                    if($newDate != 'To be determined'){
                        update_post_meta($post_id, 'study_start_date', date("Ymd", strtotime($startdate)));
                        update_post_meta($post_id, 'study_end_date', $wpFormatNewDate);
                    }else{
                        update_post_meta($post_id, 'study_start_date', $newDate);
                    }

                    if ($order_id) {
                        $study_list = get_post_meta($order_id, 'post_id', true);
                        if ($study_list == 0 || $study_list == "0") {
                            $study_list = $post_id;
                        } else if ($study_list) {
                            $study_list = $post_id;
                        } else {
                            $study_list .= ", $post_id";
                        }
                        update_post_meta($order_id, 'post_id', $study_list);
                        update_post_meta($order_id, '_post_id', "field_post_id");
                    }

				$f_attchment1 =$_FILES["attachment".$y]["tmp_name"];
				move_uploaded_file($_FILES["attachment".$y]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment'.$y]['name']));
				$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment".$y]["name"];
				$attachments111 = site_url()."/wp-content/uploads/".$_FILES["attachment".$y]["name"];
				$wp_filetype = wp_check_filetype(basename($attachments111), null );
				$attachment = array(
				    'post_mime_type' => $wp_filetype['type'],
				    'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
				    'post_content' => '',
                    'post_author' => $user_id,
				    'post_status' => 'inherit'
				);
				$attach_id = wp_insert_attachment( $attachment, $attachments111, $post_id );
				set_post_thumbnail( $post_id, $attach_id );
				update_post_meta($post_id, 'file_url', $attachments111);
				$message_pdf .= '<style type="text/css">
				<!--
				table
				{
				    width:  100%;
					margin:0px 0px 0px 0px;
					padding: 0px 0px 0px 0px;
				}

				th{padding:2px 0px;}
				td
				{
				padding:5px 0px;
				}
				tbody{
				margin:0px 20px 0px 20px;
				padding: 0px 20px 0px 20px;

				}

				h1{ font-size:21px; margin:-15px 0px 10px 0px; padding:0px 0px 0px 0px;}
				tbody tr{ font-size:14px;}
				body{margin:0px 0px 0px 0px;
					padding: 0px 0px 0px 0px;}

				-->
				</style>';

				$message_pdf .= "
				  <page backtop='2mm' backbottom='0mm' backleft='5mm' backright='5mm'>
				 <table cellpadding='0' cellspacing='0'>
				<col style='width: 18%'>
				<col style='width: 37%'>
				<col style='width: 20%'>
				<col style='width: 5%'>
				<col style='width: 20%'>

				      <tr>
					<th style='text-align:left; margin-left:20px;' colspan='2'><img style='width:295px; height:52px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/background_top.png'/><p style='font-size:14px; color:#959ca1;font-weight:normal; margin:2px 0px 0px 0px; line-height:18px;'><b>StudyKIK</b><br />1675 Scenic Ave #150<br />Costa Mesa, CA 92626</p></th>
					<th colspan='3' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px; padding: 20px 0 4px 0;'>
					<h1>INVOICE RECEIPT</h1>
					Invoice Number: ".$final_num."<br />
                    Date: ".$currdate."<br />
                    Payment Type: ".($last_4 ? $auth_card_type." xxxx".$auth_credit_card : "Check")."<br />";
                    if ($last_4) {
                        $message_pdf .= "
                    Name on Card: ".$card_billing_first_name." ".$card_billing_last_name."<br/>
                    Account: ".$first_name. " " .$last_name."</th>";
                    } else {
                        $message_pdf .= "
                    Account: ".$first_name. " " .$last_name."<br/>
                    &nbsp;</th>";
                    }
                    $message_pdf .= "
				    </tr>
				<tbody>
				<tr>
					<th style='text-align:left' colspan='5'><img style='width:100%;' src='".site_url()."/wp-content/themes/twentyfifteen/images/top_full.png'/></th></tr>
				    <tr style='text-align:center; font-size:18px;color:#000;'>
					<th align='left' style='border-bottom:1px solid #000;'>SERVICES:</th>
					<th align='left' colspan='2' style='border-bottom:1px solid #000;'>DESCRIPTION:</th>
					<th style='border-bottom:1px solid #000;'></th>
					<th  align='right' style='border-bottom:1px solid #000;'>AMOUNT:</th>
				    </tr>

				<tr align='center'>
				    <td align='left'>Listing</td>
				    <td align='left' colspan='2'><b>Site Name:</b> ".$sitename."</td>
				    <td align='center'> </td>
				    <td align='right'>".$price." </td>
				</tr>
				<tr align='center'>
				    <td align='left'></td>
				    <td align='left' colspan='2'><b>Study Type:</b> ".$studytype."</td>
				    <td align='center'> </td>
				    <td align='center'></td>
				</tr>
				<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Study Level:</b> ".$boost_type_pr1."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				</tr>
				<tr align='left'>
                    <td align='left'> </td>
                    <td align='left' colspan='2'><b>Sponsor Name:</b> " . $sponsorname . "</td>
                    <td align='center'> </td>
                    <td align='center'> </td>
                </tr>";
				if($protocolnumber){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left' colspan='2'><b>Protocol Number:</b> ".$protocolnumber."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
				}
				if($contactphone){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left' colspan='2'><b>Recruitment Phone:</b> ".$contactphone."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
				}

                    if($startdate !="To be determined"){
                        $message_pdf .= "<tr align='left'>
                        <td align='left'> </td>
                        <td align='left' colspan='2'><b>Start Date:</b> ".$startdate."</td>
                        <td align='center'> </td>
                        <td align='center'> </td>
                        </tr>";
                    }
                    else{
                        $message_pdf .= "<tr align='left'>
                        <td align='left'> </td>
                        <td align='left' colspan='2'><b>Start Date:</b>&nbsp;To be determined</td>
                        <td align='center'> </td>
                        <td align='center'> </td>
					    </tr>";
                    }
                    if($startdate !="To be determined"){
                        $message_pdf .= "<tr align='left'>
                        <td align='left'> </td>
                        <td align='left' colspan='2'><b>End Date:</b> ".$newDate."</td>
                        <td align='center'> </td>
                        <td align='center'> </td>
                        </tr>";
                    }
                    else{
                        $message_pdf .= "<tr align='left'>
                        <td align='left'> </td>
                        <td align='left' colspan='2'><b>End Date:</b>&nbsp;To be determined</td>
                        <td align='center'> </td>
                        <td align='center'> </td>
                        </tr>";
                    }
                    if ($studylocation) {
                        $message_pdf .= "<tr align='left'>
                            <td align='left'></td>
                            <td align='left' colspan='4'><b>Study Address:</b> ".$studylocation."</td>
                            </tr> ";
                    }
                    if ($notes) {
                        $message_pdf .= "<tr align='left'>
                                <td align='left'> </td>
                                <td align='left' colspan='2' style='height:40px; vertical-align:top;'><b>Notes:</b> ".$notes." </td>
                                <td align='center'> </td>
                                <td align='center'> </td>
                                </tr>";
                    } else {
                        $message_pdf .= "<tr align='left'>
                            <td align='left'>&nbsp; </td>
                            <td align='left' colspan='2' style='height:40px; vertical-align:top;'>&nbsp;</td>
                            <td align='center'>&nbsp; </td>
                            <td align='center'>&nbsp; </td>
                            </tr>";
                    }
                    if (!$studylocation) {
                        $message_pdf .= "<tr align='left'>
                            <td align='left'>&nbsp;</td>
                            <td align='left' colspan='4'>&nbsp;</td>
                            </tr> ";
                    }
                    $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
                    $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
                    $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
                    if($message_suite_247 == "Yes"){
                        $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>Patient Messaging Suite</td>
				    <td bordercolor='#000' align='left' colspan='2'> </td>
				    <td bordercolor='#000' align='center'> </td>
				    <td bordercolor='#000' align='right'>".$message_suite."</td>
				    </tr>";
                    }else{

                        $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left' colspan='2'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

                    }
                    if($coupon){
                        $message_pdf .= "<tr align='center'>
                            <td align='left'>Coupon</td>
                            <td align='left' colspan='2'>".$coupon."</td>
                            <td align='center'> </td>
                            <td align='right'>-$".number_format( $coupon_discount ,  2 ,  '.' ,  ',' )." </td>
				        </tr>";

                    } else {

                        $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left' colspan='2'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

                    }

				$message_pdf .= "

				<tr class='sub_total' align='left'>
				<td align='center'  style='border-top:1px solid #000;'> </td>
				<td align='left'  colspan='2' style='border-top:1px solid #000;'> </td>
				<td align='right' colspan='2' style='border-top:1px solid #000;'>SUB TOTAL:&nbsp; ".$total_price."</td>
				</tr>
				<tr class='total' align='left'>
				<td align='center'> </td>
				<td align='left' colspan='2'> </td>
				<td align='right' colspan='2'><b>TOTAL:&nbsp; ".$total_price."</b></td>
				</tr>
				</tbody>
				<tr>";

				if($contactemail4 == ""){

				$message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:460px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

				}else{

					$message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:440px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

				}
				$message_pdf .= "</tr>
				</table></page>";

//                    print_r($product_arr);
//                    print_r($message);
//                    print_r($message_pdf);
				$subject_pdf_email = "Thank You for Listing ".$studytype." ".$protocolnumber."";
				$pdf_email_text .= "
				Hi ".$first_name.",<br /><br />
				Thank you for listing your ".$studytype." ".$protocolnumber." study with StudyKIK.<br /><br />
				Please see invoice attached with detailed information.<br /><br />
				If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
				Thank you!<br /><br />
				StudyKIK<br />
				1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
				info@studykik.com<br />
				1-877-627-2509<br /><br /><br />
				<img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png' />
				";
				$headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
                if ($croemail && filter_var($croemail, FILTER_VALIDATE_EMAIL)) {
                    $headers_pdf[] = 'Cc: '.$croemail;
                }
				$headers_pdf[] = "MIME-Version: 1.0\r\n";
				$headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
				require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
				$html2pdf = new HTML2PDF('P', 'A4','en', true, 'UTF-8', array(0, 0, 0, 0));
				$html2pdf->setDefaultFont('Arial');
				$html2pdf->writeHTML($message_pdf);
				//ob_end_clean();
				$study_cat_name1 = str_replace(' ', '_', $studytype);
				$study_cat_name2 = str_replace("'", "", $study_cat_name1);
				$study_cat_name = stripslashes($study_cat_name2);

				$rand= rand();
				$html2pdf->Output( dirname(__FILE__)."/pdf/".$final_num.' '.$studytype.' '.$boost_type_pr2.' Invoice'.".pdf", "f");
				$html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_'.$study_cat_name.'_'.$boost_type_pr2.'_Invoice'.".pdf", "f");
				$pdf_attachment_path = dirname(__FILE__).'/pdf/'.$final_num.' '.$studytype.' '.$boost_type_pr2.' Invoice.pdf';
				$pdf_attachment_path_db = '/pdf/'.$final_num.'_'.$study_cat_name.'_'.$boost_type_pr2.'_Invoice.pdf';
				$attachments[] = dirname(__FILE__).'/pdf/'.$final_num.' '.$studytype.' '.$boost_type_pr2.' Invoice.pdf';
                $attachments_pdf[] = $pdf_attachment_path_db;
				update_post_meta($post_id, 'pdfpath', $pdf_attachment_path);
                                  if($croname == 'testing'){
                                     $user_info = get_userdata(70);
                                    $cromail=$user_info->user_email ;
                               wp_mail($cromail,$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
							   //wp_mail('keshvendersingh145@gmail.com',$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
                            }
                            else{
                                 wp_mail($username,$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);


                            }

				$pdf_email_text = "";
				$message_pdf = "";
				$current_month = date('M');
				$current_year = date('Y');
				$full_date = date('m/d/y');
				$wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`(`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES (NULL,'$user_id','$post_id','$pdf_attachment_path_db','$protocolnumber','$final_num','$total_price','$current_month','$current_year','Study Information','$full_date')"));
			    }

            if ($total_products && $total_products > 0) {
                if (!$ubject) {
                    $subject = "Other Products";
                }
                for ($y=1; $y<=$total_products; $y++){
                    $final_num =  $invoice_num+1;
                    $invoice_num = $invoice_num + 1;

                    $product_id = $_REQUEST['product_id'.$y];
                    $product_title = $_REQUEST['product_title'.$y];
                    $product_qty = $_REQUEST['product_qty'.$y];
                    $product_price = $_REQUEST['product_price'.$y];
                    $product_total = $product_price * $product_qty;
                    $coupon_discount = $discount_arr[$y - 1 + $total_entries];
                    $product_amount = number_format( $product_total ,  2 ,  '.' ,  ',' );

                    $total_price = number_format( $product_total - $coupon_discount ,  2 ,  '.' ,  ',' );
                    $message_pdf .= '<style type="text/css">
                  <!--
                  table
                  {
                      width:  100%;
                      margin:0px 0px 0px 0px;
                      padding: 0px 0px 0px 0px;
                  }

                  th{padding:2px 0px;}
                  td
                  {
                  padding:6px 0px;
                  }
                  tbody{
                  margin:0px 20px 0px 20px;
                  padding: 0px 20px 0px 20px;

                  }

                  h1{ font-size:21px; margin:-15px 0px 6px 0px; padding:0px 0px 0px 0px;}
                  tbody tr{ font-size:14px;}
                  body{margin:0px 0px 0px 0px;
                      padding: 0px 0px 0px 0px;}

                  -->
                  </style>';

                    $message_pdf .= "
                    <page backtop='2mm' backbottom='0mm' backleft='5mm' backright='5mm'>
                   <table cellpadding='0' cellspacing='0'>
                  <col style='width: 20%'>
                  <col style='width: 37%'>
                  <col style='width: 18%'>
                  <col style='width: 5%'>
                  <col style='width: 20%'>

                        <tr>
                      <th style='text-align:left; margin-left:20px;' colspan='2'><img style='width:295px; height:52px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/background_top.png'/><p style='font-size:14px; color:#959ca1;font-weight:normal; margin:2px 0px 0px 0px; line-height:18px;'><b>StudyKIK</b><br />1675 Scenic Ave #150<br />Costa Mesa, CA 92626</p></th>
                      <th colspan='3' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px; padding: 20px 0 4px 0;'>
                      <h1>INVOICE RECEIPT</h1>
                      Invoice Number: ".$final_num."<br />
                      Date: ".$currdate."<br />
                      Payment Type: ".($last_4 ? $auth_card_type." xxxx".$auth_credit_card : "Check")."<br />";
                    if ($last_4) {
                        $message_pdf .= "
                  Name on Card: ".$card_billing_first_name." ".$card_billing_last_name."<br/>
                  Account: ".$first_name. " " .$last_name."</th>";
                    } else {
                        $message_pdf .= "
                  Account: ".$first_name. " " .$last_name."<br/>
                  &nbsp;</th>";
                    }
                    $message_pdf .= "
                      </tr>
                  <tbody>
                  <tr>
                      <th style='text-align:left' colspan='5'><img style='width:100%;' src='".site_url()."/wp-content/themes/twentyfifteen/images/top_full.png'/></th></tr>
                      <tr style='text-align:center; font-size:18px;color:#000;'>
                      <th align='left' colspan='3' style='border-bottom:1px solid #000;'>SERVICES:</th>
                      <th style='border-bottom:1px solid #000;'></th>
                      <th  align='right' style='border-bottom:1px solid #000;'>AMOUNT:</th>
                      </tr>

                  ";

                    $message_pdf .= "<tr align='center'>
                      <td align='left' colspan='3'>".($product_qty == 1 ? "" : $product_qty." ").$product_title."</td>
                      <td align='center'> </td>
                      <td align='right'>$".$product_amount." </td>
                  </tr>";

                    for ($x=1; $x<=5; $x++){
                        $message_pdf .= "<tr align='left'>
                      <td bordercolor='#000' align='left'>&nbsp; </td>
                      <td bordercolor='#000' align='left'> &nbsp; </td>
                      <td bordercolor='#000' align='left'> &nbsp; </td>
                      <td bordercolor='#000' align='center'> &nbsp;</td>
                      <td bordercolor='#000' align='center'> &nbsp;</td>
                      </tr>";
                    }
                    for ($x=1; $x<=14; $x++){
                        $message_pdf .= "<tr align='left'>
                          <td align='left'> </td>
                          <td align='left'> </td>
                          <td align='left'> </td>
                          <td align='center'> </td>
                          <td align='center'> </td>
                          </tr>";
                    }
                    if($coupon){
                        $message_pdf .= "<tr align='center'>
                            <td align='left'>Coupon</td>
                            <td align='left' colspan='2'>".$coupon."</td>
                            <td align='center'> </td>
                            <td align='right'>-$".number_format( $coupon_discount ,  2 ,  '.' ,  ',' )." </td>
				        </tr>";

                    } else {

                        $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left' colspan='2'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

                    }

                    $message_pdf .= "

                  <tr class='sub_total' align='left'>
                  <td align='center'  style='border-top:1px solid #000;'> </td>
                  <td align='left' colspan='2'  style='border-top:1px solid #000;'> </td>
                  <td align='right' colspan='2' style='border-top:1px solid #000;'>SUB TOTAL:&nbsp; $".$total_price."</td>
                  </tr>
                  <tr class='total' align='left'>
                  <td align='center'> </td>
                  <td align='left' colspan='2'> </td>
                  <td align='right' colspan='2'><b>TOTAL:&nbsp; $".$total_price."</b></td>
                  </tr>
                  </tbody>
                  <tr>";

                    $message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:470px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

                    $message_pdf .= "</tr>
                  </table></page>";

                    $subject_pdf_email = "Thank You for Purchasing ".$product_title."";
                    $pdf_email_text .= "
                      Hi ".$first_name.",<br /><br />
                      Thank you for purchasing ".$product_title." with StudyKIK.<br /><br />
                      Please see invoice attached with detailed information.<br /><br />
                      If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
                      Thank you!<br /><br />
                      StudyKIK<br />
                      1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
                      info@studykik.com<br />
                      1-877-627-2509<br /><br /><br />
                      <img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png' />
                      ";
                    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
                    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
                    $headers_pdf[] = "MIME-Version: 1.0\r\n";
                    $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";

                    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
                    $html2pdf = new HTML2PDF('P', 'A4','en', true, 'UTF-8', array(0, 0, 0, 0));
                    $html2pdf->setDefaultFont('Arial');
                    $html2pdf->writeHTML($message_pdf);
                    //ob_end_clean();

                    $rand= rand();
                    $html2pdf->Output( dirname(__FILE__)."/pdf/".$final_num.' '.$product_title.' Invoice'.".pdf", "f");
                    $html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_'.$product_title.'_Invoice'.".pdf", "f");
                    $pdf_attachment_path = dirname(__FILE__).'/pdf/'.$final_num.' '.$product_title.' Invoice.pdf';
                    $pdf_attachment_path_db = '/pdf/'.$final_num.'_'.$product_title.'_Invoice.pdf';
                    $attachments[] = dirname(__FILE__).'/pdf/'.$final_num.' '.$product_title.' Invoice.pdf';
                    $attachments_pdf[] = $pdf_attachment_path_db;

//                    if($croname == 'testing'){
//                        $user_info = get_userdata(70);
//                        $cromail=$user_info->user_email ;
//                        wp_mail($cromail,$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
//                        //wp_mail('keshvendersingh145@gmail.com',$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
//                    }
//                    else{
//                        wp_mail($username,$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
//
//
//                    }

                    $pdf_email_text = "";
                    $message_pdf = "";
                    $current_month = date('M');
                    $current_year = date('Y');
                    $full_date = date('m/d/y');
                    $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`
                    (`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES
                    (NULL,'$user_id','','$pdf_attachment_path_db','','$final_num','$product_amount','$current_month','$current_year','Non-Study Information','$full_date')"));
                    //                print_r($message_pdf);
                    //                exit;
                }
            }

			    $headers[] = 'From: '.$fullname.' <info@studykik.com>';
			    $headers[] = 'Reply-To: '.$fullname.' <'.$username.'>';
			    $headers[] = "MIME-Version: 1.0\r\n";
			    $headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
            
            $SendEmail = true;

                send_order_email($product_arr, array(
                    "user_id" => $user_id,
                    "first_name" => $card_billing_first_name ? $card_billing_first_name : $first_name,
                    "last_name" => $card_billing_last_name ? $card_billing_last_name : $last_name,
                    "company" => $card_billing_company,
                    "zip" => $card_billing_zip,
                    "transaction_id" => $_REQUEST['transaction_id'],
                    "payment_type" => $auth_card_type,
                    "coupon" => $coupon,
                    "coupon_amount" => array_sum($discount_arr),
                    "invoice_number" => $_REQUEST['invoice_number'],
                    "pdfs" => $attachments_pdf,
                    "study_arr" => $study_arr
                ), $attachments, $message);

			    if($SendEmail){?>
				<script type="text/javascript">
				    setTimeout(function () {
				    window.location = "<?php echo site_url();?>/thank-listing/";}, 10);
				</script>
			    <?php
			    }
			    else{
				//echo '<h3 style="color: red; float: left; margin-top: 51px; text-align: center; width: 100%;">ERROR: TRY AGAIN</h3>';
			    }
			} else {
                ?>
                <h3>You haven't paid for study list. You will be redirected to shopping cart page.</h3>
                <script type="text/javascript">
                    setTimeout(function () {
                        window.location = "<?php echo site_url();?>/shopping-cart/";}, 0);
				</script>
                <?php
            }
			?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		    </div>
		    <!-- .entry-content -->
		</div>
	    </article>
	    <!-- #post -->
	<?php endwhile; ?>
    </div>
    <script>
	$('.determine_start').on('click',function() {
	    var un_id=$(this).attr('unique_id');
	    $("#datepicker"+un_id).val('To be determined');
	});
    </script>
</div>
<div id="fade" class="black_overlay"></div>
<style>
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
        display: none;
        height: 3400px;
        left: 0;
        opacity: 0.8;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 1001;
    }
    h2.heading{
        background: #f78e1e none repeat scroll 0 0;
        color: #fff;
        font-family: alternate;
        font-size: 44px;
        margin: 0;
        padding: 5px;
        text-align: center;
        text-decoration: none;
    }

    .close_button{
        background: #00afef;
        border: medium none;
        color: #fff;
        font-family: alternate;
        font-size: 33px;
        padding: 0 26px;
    }
    .closepop {
        background: transparent url("<?php bloginfo('template_url'); ?>/images-dashboard/close2.png") no-repeat scroll 0 0;

    }
    .done_button{
        background: #9fce64;
        border: medium none;
        color: #fff;
        font-family: alternate;
        font-size: 33px;
        /*margin: 10px 0 10px 34%;*/
        padding: 0 26px;
        margin-bottom:20px;
    }
    .patient{width:150px;}
    dd { min-height: 25px;  }
    .col-md-6.col-sm-6.col-xs-12.name_first.spac {
        padding-left: 0;
    }
    .col-md-6.col-sm-6.col-xs-12.name_first.spacright {
        padding-right: 1px;
    }
</style>
<!-- #primary -->
<?php get_footer(); ?>
<script src="<?php bloginfo('template_url');?>/combobox/jquery-1.10.2.js"></script>
<script src="<?php bloginfo('template_url');?>/combobox/jquery-ui.js"></script>
<script>
    jQuery(document).ready(function(){

        jQuery('#email_user').blur(function(e) {
            var emailok = false;
            var site_email=jQuery('#email_user').val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(regex.test(site_email)){
                jQuery.ajax({
                    url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                    type: 'POST',
                    data: "action=dashboard_add_email&email="+site_email,
                    beforeSend: function(){
                        jQuery('#emailInfo').html("<span style='float:right;margin-right:5px;margin-top:-10px;'>Checking Email</span>"); //show checking or loading image
                    },
                    success: function(html){
                        if(html != 0)
                        {
                            emailok = false;
                            if (jQuery('#site_email').val() !='' ){
                                jQuery('#emailInfo').html("<span style='color:red;float:right;margin-right:5px;margin-top:-10px;'>Email Already Exist</span>");
                                jQuery('#site_email').addClass('warning');
                                jQuery('#site_email').val("");
                            }
                        }
                        if(html == 0)
                        {
                            emailok = true;
                            if (jQuery('#site_email').val() !='' ){
                                jQuery('#emailInfo').html("<span style='color:green;margin-right:5px;float:right;margin-top:-10px;'>Email OK</span>");
                                jQuery('#site_email').removeClass('warning');
                            }
                        }
                    }

                })
            }
            else{
                jQuery('#emailInfo').html("<span style='color:red;float:right;margin-right:5px;margin-top:-10px;'>Invalid Email</span>");
                jQuery('#site_email').addClass('warning');

            }
        });

        jQuery('#u_name').blur(function(e) {
            var username_check = false;
            var username = jQuery('#u_name').val();

            if(username != ""){
                jQuery.ajax({
                    url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                    type: 'POST',
                    data: "action=check_username&username="+username,
                    beforeSend: function(){
                        jQuery('#userinfo').html("<span style='float:right;margin-right:5px;margin-top:-10px;'>Checking Username</span>"); //show checking or loading image
                    },
                    success: function(html){
                        if(html != 0){
                            username_check = false;
                            if (jQuery('#u_name').val() !='' ){
                                jQuery('#userinfo').html("<span style='color:red;float:right;margin-right:5px;margin-top:-10px;'>Username Already Exist</span>");
                                jQuery('#u_name').addClass('warning');
                            }
                        }
                        if(html == 0){
                            username_check = true;
                            if (jQuery('#u_name').val() !='' ){
                                jQuery('#userinfo').html("<span style='color:green;margin-right:5px;float:right;margin-top:-10px;'>Username OK</span>");
                                jQuery('#u_name').removeClass('warning');
                            }
                        }
                    }
                });
            } else {
                jQuery('#u_name').addClass('warning');
                jQuery('#userinfo').html("");
            }
        });

    });
</script>

</body>
</html>