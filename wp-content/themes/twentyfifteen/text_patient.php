 <?php
 if(!isset($_REQUEST['postid'])){ ?>
 
<form id="textpatfrm">
<input type="hidden" name="postid" id="hid" value="<?php echo $_POST['post_id']; ;?>">
<input type="hidden" name="action" id="aptient" value="text_aptient">
<input type="hidden" name="patient_file" id="text_patient" value="text_patient">
<div style="width:100%; margin-top:20px; margin-bottom:-15px;margin-left:11px;">
<label for="message" class="label_msg">Enter Message</label>
<textarea rows="4" cols="100" name="add_name" id="txtarea" maxlength="160">Hello, are you still interested in a research study for (INDICATION)? If so, please respond YES or NO</textarea>
<div style="color: #888888">Characters Remaining: <span id="remaining_chars">59</span></div>
</div>
<div style="width:100%; margin-top:20px; margin-bottom:20px">
	<input type="button" class="add_btn sentmsg sentmsg2" value="Send Message" id ="sentmsg" name="sent_txt">
</div>

<div style="margin-top:20px;">
<div class="col-xs-2 col-md-2">
<?php 
$pid = $_POST['post_id'];
$query = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num='1'  ORDER BY id DESC", OBJECT);
?>

<div style="height:20px;margin-bottom:15px;">
	<input type ='checkbox'  id='clickit' name='m_newpatient'  value='Check All' class="checkbox-class_header">
	<b style ="color: #19c1fe; font-size: 15px;">New Patient </b>
</div>
<?php 
foreach ($query as $results) { 

echo "<div>"; 
?>
<input type ='checkbox' <?php if($results->stop_sending_msgs){echo 'disabled=true;';}  ?>  class='checkbox-class checkbox-class_all' name='patient_name[<?php echo $results->id ;  ?>]' value='<?php echo $results->id ; ?>'>

<?php

echo $results->name;
echo "</div>"; 
}

?>
</div>
<div class="col-xs-2 col-md-2">
<?php 
$pid = $_POST['post_id'];
$query2 = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num='2'  ORDER BY id DESC", OBJECT);
 ?>
 <div style="height:20px;margin-bottom:15px;">
	<input type ='checkbox'  id='clickit1' name='m_call_att'  value='callchecked' class="checkbox-class_header">
	<b style ="color: #19c1fe; font-size: 15px;">Call Attempted </b>
 </div>
 <?php
foreach ($query2 as $results2) { 
echo "<div>"; 

?>
 <input type ='checkbox' <?php if($results2->stop_sending_msgs){echo 'disabled=true;';}  ?>  class='checkbox-call checkbox-class_all' name='patient_name[<?php echo $results2->id ;?>]' value='<?php echo $results2->id ;  ?>'>

<?php 
echo $results2->name;
echo "</div>"; 
}
?>
</div>
<div class="col-xs-2 col-md-2">
<?php 
$pid = $_POST['post_id'];
$query3 = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num='3'  ORDER BY id DESC", OBJECT);
?>
<div style="height:20px;margin-bottom:15px;">
	<input type ='checkbox'  id='clickit2' name='m_notqualified'  value='Check All' class="checkbox-class_header"> 
	<b style ="color: #19c1fe; font-size: 15px;"> Not Qualified</b>   
</div>
  
  <?php
foreach ($query3 as $results3) {
echo "<div>";
?>
<input type ='checkbox' <?php if($results3->stop_sending_msgs){echo 'disabled=true;';}  ?> class='checkbox_notqualified checkbox-class_all' name='patient_name[<?php echo $results3->id ;  ?>]' value="<?php echo $results3->id ;  ?>">

<?php 

echo $results3->name;
echo "</div>"; 
}
?>
</div>
<div class="col-xs-2 col-md-2">
<?php 
$pid = $_POST['post_id'];
$query7 = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num='7'  ORDER BY id DESC", OBJECT);
?>
<div style="height:20px;margin-bottom:15px;">
  <input type ='checkbox'  id='clickit3' name='m_action'  value='Check All' class="checkbox-class_header"> 
  <b style ="color: #19c1fe; font-size: 15px;"> Action Needed </b>
 </div>
 <?php 
foreach ($query7 as $results7) { 
echo "<div>"; 
?>
 <input type ='checkbox' <?php if($results7->stop_sending_msgs){echo 'disabled=true;';}  ?> class='checkbox_action checkbox-class_all' name='patient_name[<?php echo $results7->id ;  ?>]' value="<?php echo $results7->id ;  ?>">
<?php 
echo $results7->name;
echo "</div>"; 
}
?>
</div>
<div class="col-xs-2 col-md-2">
<?php 
$pid = $_POST['post_id'];
$query4 = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num='4'  ORDER BY id DESC", OBJECT);
?>

	<div style="height:20px;margin-bottom:15px;">
	<input type ='checkbox'  id='clickit4' name='m_Scheduled'  value='Check All' class="checkbox-class_header">
	<b style ="color: #19c1fe; font-size: 15px;"> Scheduled </b>
	</div>

<?php   
foreach ($query4 as $results4) { 
echo "<div>"; 
?>
 <input type ='checkbox' <?php if($results4->stop_sending_msgs){echo 'disabled=true;';}  ?> class='checkbox_Scheduled checkbox-class_all' name='patient_name[<?php echo $results4->id ;  ?>]' value='<?php echo $results4->id ;  ?>'>
<?php 
echo $results4->name;
echo "</div>"; 
}
?>
</div>
<div class="col-xs-2 col-md-2">
<?php 
$pid = $_POST['post_id'];
$query5 = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num='5'  ORDER BY id DESC", OBJECT);
?>
<div style="height:20px;margin-bottom:15px;">
 <input type ='checkbox'  id='clickit5' name='m_Consented'  value='Check All' class="checkbox-class_header">
 <b style ="color: #19c1fe; font-size: 15px;"> Consented </b>
 </div>
 <?php 
foreach ($query5 as $results5) { 
echo "<div>"; 
?>
 <input type ='checkbox' <?php if($results5->stop_sending_msgs){echo 'disabled=true;';}  ?> class='checkbox_Consented checkbox-class_all' name='patient_name[<?php echo $results5->id ;  ?>]' value="<?php echo $results5->id ;  ?>">
<?php 
echo $results5->name;
echo "</div>"; 
}
?>
</div>
<div class="col-xs-2 col-md-2">
<?php 
$pid = $_POST['post_id'];
$query6 = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num='6'  ORDER BY id DESC", OBJECT);
?>
<div style="height:20px;margin-bottom:15px;">
 <input type ='checkbox'  id='clickit6' name='m_randomized'  value='Check All' class="checkbox-class_header">
 <b style ="color: #19c1fe; font-size: 15px;">Randomized  </b>
 </div>
 <?php 
foreach ($query6 as $results6) { 
echo "<div>"; 
?>
 <input type ='checkbox' <?php if($results6->stop_sending_msgs){echo 'disabled=true;';}  ?> class='checkbox_randomized checkbox-class_all' name='patient_name[<?php echo $results6->id ;  ?>]' value="<?php echo $results6->id ;  ?>">
<?php 
echo $results6->name;
echo "</div>"; 
}
?>
</div>
</div>

 </form>
 <script>
 jQuery("#clickit").click(function() {
	 
	var ch=jQuery(this).prop('checked');
	if(ch==true){
		jQuery('.checkbox-class').prop('checked',true);
	}
	else{
		jQuery('.checkbox-class').prop('checked',false);
	}
});

 jQuery("#clickit1").click(function() {
	 
	var ch=jQuery(this).prop('checked');
	if(ch==true){
		jQuery('.checkbox-call').prop('checked',true);
	}
	else{
		jQuery('.checkbox-call').prop('checked',false);
	}
});


 jQuery("#clickit2").click(function() {
	 
	var ch=jQuery(this).prop('checked');
	if(ch==true){
		jQuery('.checkbox_notqualified').prop('checked',true);
	}
	else{
		jQuery('.checkbox_notqualified').prop('checked',false);
	}
});



 jQuery("#clickit3").click(function() {
	 
	var ch=jQuery(this).prop('checked');
	if(ch==true){
		jQuery('.checkbox_action').prop('checked',true);
	}
	else{
		jQuery('.checkbox_action').prop('checked',false);
	}
});


 jQuery("#clickit4").click(function() {
	 
	var ch=jQuery(this).prop('checked');
	if(ch==true){
		jQuery('.checkbox_Scheduled').prop('checked',true);
	}
	else{
		jQuery('.checkbox_Scheduled').prop('checked',false);
	}
});

 jQuery("#clickit5").click(function() {
	 
	var ch=jQuery(this).prop('checked');
	if(ch==true){
		jQuery('.checkbox_Consented').prop('checked',true);
	}
	else{
		jQuery('.checkbox_Consented').prop('checked',false);
	}
});

 jQuery("#clickit6").click(function() {
	 
	var ch=jQuery(this).prop('checked');
	if(ch==true){
		jQuery('.checkbox_randomized').prop('checked',true);
	}
	else{
		jQuery('.checkbox_randomized').prop('checked',false);
	}
});


 
jQuery('.checkbox_action').click(function(){
if($(this).is(":checked")){
jQuery('#clickit3').not(this).prop('checked', true); 
 }
else if($(this).is(":not(:checked)")){
 jQuery('#clickit3').removeAttr('checked');
}
});



jQuery('.checkbox-class').click(function(){
if ($('.checkbox-class:checked').length == $('.checkbox-class').length) {
jQuery('#clickit').not(this).prop('checked', true); 
 }
else if($(this).is(":not(:checked)")){
 jQuery('#clickit').removeAttr('checked');
}
});


jQuery('.checkbox-call').click(function(){
if ($('.checkbox-call:checked').length == $('.checkbox-call').length) {
jQuery('#clickit1').not(this).prop('checked', true); 
 }
else if($(this).is(":not(:checked)")){
 jQuery('#clickit1').removeAttr('checked');
}
});



jQuery('.checkbox_notqualified').click(function(){
if ($('.checkbox_notqualified:checked').length == $('.checkbox_notqualified').length) {
jQuery('#clickit2').not(this).prop('checked', true); 
 }
else if($(this).is(":not(:checked)")){
 jQuery('#clickit2').removeAttr('checked');
}
});

jQuery('.checkbox_Scheduled').click(function(){
if ($('.checkbox_Scheduled:checked').length == $('.checkbox_Scheduled').length) {
jQuery('#clickit4').not(this).prop('checked', true); 
 }
else if($(this).is(":not(:checked)")){
 jQuery('#clickit4').removeAttr('checked');
}
});

jQuery('.checkbox_Consented').click(function(){
if ($('.checkbox_Consented:checked').length == $('.checkbox_Consented').length) {
jQuery('#clickit5').not(this).prop('checked', true); 
 }
else if($(this).is(":not(:checked)")){
 jQuery('#clickit5').removeAttr('checked');
}
});

jQuery('.checkbox_randomized').click(function(){
if ($('.checkbox_randomized:checked').length == $('.checkbox_randomized').length) {
jQuery('#clickit6').not(this).prop('checked', true); 
 }
else if($(this).is(":not(:checked)")){
 jQuery('#clickit6').removeAttr('checked');
}
});

 
</script>

 <script>
            jQuery(function() {
               jQuery("#sentmsg").on("click", function(event) {
				if(jQuery.trim(jQuery('#txtarea').val()) ==''){
					jQuery("#txtarea").addClass("validation");
					//alert('Please enter the message to send message.');
				}
				else if(jQuery(".checkbox-class_all:checkbox:checked").length <= 0){
					alert('Please select at least one patient to send message.');
				}
				else{
						event.preventDefault();
	 
						jQuery.ajax({
						   url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
							type: "post",
							data: jQuery('#textpatfrm').serialize(),
							success: function(d) {
								var d=jQuery.trim(d);
                                if (d=='not enough credits'){
                                    jQuery("#buy_credits_title").html('You need to add more credits to send messages.');
                                    jQuery("#buy_credits_post_id").val($("#hid").val());
                                    $(".buy_credits_wrapper_container a").remove();
                                    $(".buy_credits_wrapper_container").append('<a class="closepop" id="buy_credits_close_top_bar" href="javascript:void(0);" onclick="document.getElementById(\'buyCredits\').style.display=\'none\'; jQuery(\'#textPatient\').show();">Close</a>');
                                    jQuery("#buy_credits_close_bttn").hide();
                                    jQuery("#buy_credits_purchase_bttn").show();
                                    jQuery(".buy_credits_error_text").hide();
                                    jQuery(".buy_credits_main_content").show();
                                    $("#buy_credits_paymentmethod").val('');
                                    jQuery(".loop_credit").hide();
                                    jQuery(".buy_credits_form_area").css("height","240px");
                                    jQuery("#buyCredits").show();
                                    jQuery("#textPatient").hide();
                                }else if(d=='ok'){
                                    jQuery("#textPatient").hide();
									$("#labelsts").html('Thank You');
									$("#cal_popup").html('Your message has been sent successfully.');
									$("#embedcal").show();
								}
								else{
                                    jQuery("#textPatient").hide();
									$("#labelsts").html('Error');
									if(d==""){
										$("#cal_popup").html('Some error has been occured to send message.');
									}
									else{
										$("#cal_popup").html(d);
									}
									$("#embedcal").show();
								}
							}
						});
					}
                });
			 
            });
			jQuery("#txtarea").keyup(function(){
                var currentLength = $(this).val().length;
                jQuery('#remaining_chars').html(160 - currentLength);
				if( jQuery.trim(jQuery('#txtarea').val())  ==''){
					jQuery("#txtarea").removeClass("validation");
					jQuery("#txtarea").addClass("validation");
				}
				else{
					jQuery("#txtarea").removeClass("validation");
				}
			});
        </script>

<style>
	.checkbox-class_all {
    margin-left: -14% !important;
    margin-top: 5px !important;
    position: absolute;
}


	.checkbox-class_header {
    margin-left: -14% !important;
    margin-top: 5px !important;
    position: absolute;
}



.col-xs-2.col-md-2 {
    margin-left: 1.5%;
}
#textpatfrm .col-md-2 {
    width: 12.5% !important;
}
.label_msg{
color: #19c1fe;
    font-size: 20px;
    width: 100%;
}
.sentmsg2 {
    float: none;
    font-size: 18px;
    margin-left: 10px !important;
    width: 150px;
}
.validation{
	border: 1px solid red !important;
}
.add_btn.sentmsg2{
	margin-left:10px !important;
}
 
</style>
 <?php } 
 else{
	$message='Some error has been occured to send message.';
	$pid = $_REQUEST['postid'];
	if(isset($_REQUEST['patient_name']) && isEnoughCredits($pid, count($_REQUEST['patient_name']))){
		if(!empty($_REQUEST['patient_name'])){
			$msgs=$_REQUEST['add_name'];
			$current = date('Y-m-d H:i:s',strtotime('-7 hours'));
			$campaign = get_post_meta($pid, 'renewed', true );
            $patient_ids=implode(",",$_REQUEST['patient_name']);
			$query = $wpdb->get_results("SELECT id,post_id,phone FROM 0gf1ba_subscriber_list WHERE id IN ($patient_ids) AND is_deleted != 1 AND phone != '' ", OBJECT);
			$phonenumber = array();
			$numbers="";
			if($query){

                foreach($query as $result){
                    $phonenumber[] = $result->phone;
                    $phc=$result->phone;
                }

				if(!empty($phonenumber)){
					$numbers=implode(', ',$phonenumber);
					$pur_num = (get_post_meta($pid, 'text_message_purchased_number', true )?get_post_meta($pid, 'text_message_purchased_number', true ):get_post_meta($pid, 'purchased_number', true ));
					if($pur_num !=""){
						$wsdl = 'https://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl';
						$client = new SoapClient($wsdl, array(
						'soap_version' => SOAP_1_2,
						'login'        => '41530ff4e2a8',
						'password'     => 'a44dd745a81cca3c'));
						$sendTextRequest = array(
						'BroadcastName' => 'Studykick Sms Broadcast',
						'ToNumber'      => $phonenumber,
						//'TextBroadcastConfig' => array('Message' => 'Thank you for signing up new !'));
						'TextBroadcastConfig' => array('Message' => ($_REQUEST['add_name']."\n".'Text STOP to stop'), 'FromNumber'=> $pur_num));
						$broadcastId = $client->sendText($sendTextRequest);
						if($broadcastId){
							$message='ok';
						}

                        updateCallfireCredits($result->post_id, count($query));
                        foreach($query as $result){
                            $sql = "INSERT INTO 0gf1ba_calldata (id,message,sent_number,in_out,campaign,created,is_read,study_id,patient_id, broadcast_id) VALUES ('','$msgs','$phc','2', '$campaign','$current','1', '$result->post_id', '$result->id', '$broadcastId')";
                            $wpdb->query($sql);
                            addToCallfireCreditsPayments('text', 1, $broadcastId, $result->post_id);
                        }
					}
					else{
						$message='Purchased number is not available for this study.';
					}
				}
				else{
					$message='Oops, something going wrong';
				}
			}
			else{
				$message='Oops, something going wrong';
			}
		}
		else{
			$message='Oops, something going wrong';
		}
	}
	elseif(isset($_REQUEST['patient_name']) && !isEnoughCredits($pid, count($_REQUEST['patient_name']))){
		$message='not enough credits';
	}
	echo $message;
 }