 <?php  
	$id = $_POST['post_id'];
	$query = $wpdb->get_results("SELECT name,phone,post_id, stop_sending_msgs FROM 0gf1ba_subscriber_list WHERE id = '$id'", OBJECT);
	$phone="";
	$pst_id="";
    $patient_name = "";
	foreach($query as $qry){
		$phone = $qry->phone;
		$pst_id=$qry->post_id;
        $patient_name = $qry->name;
        $stop_sending_msgs = $qry->stop_sending_msgs;
	}
    $real_post_id = $pst_id;
	if(isset($_POST['msgarea']) && isEnoughCredits($pst_id)){
		if($phone !=""){	
			$campaign = get_post_meta( $pst_id, 'renewed', true );
			$msg = stripslashes($_POST['msgarea']);
			$current = date('Y-m-d H:i:s',strtotime('-7 hours'));
            $pur_num = (get_post_meta($pst_id, 'text_message_purchased_number', true )?get_post_meta($pst_id, 'text_message_purchased_number', true ):get_post_meta($pst_id, 'purchased_number', true ));
			if($pur_num !=""){
                $wsdl = 'https://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl';
                $client = new SoapClient($wsdl, array(
                'soap_version' => SOAP_1_2,
                'login'        => '41530ff4e2a8',
                'password'     => 'a44dd745a81cca3c'));
                $sendTextRequest = array(
                'BroadcastName' => 'Studykick Sms Broadcast',
                'ToNumber'      => $phone,
                //'TextBroadcastConfig' => array('Message' => 'Thank you for signing up new !'));
                'TextBroadcastConfig' => array('Message' => $msg, 'FromNumber'=> $pur_num));
                $broadcastId = $client->sendText($sendTextRequest);
                $sql = "INSERT INTO 0gf1ba_calldata (message,sent_number,in_out,campaign,created,is_read, study_id, patient_id, broadcast_id) VALUES ('$msg','$phone','2', '$campaign','$current','1', '$pst_id', '$id', '$broadcastId')";
                mysql_query($sql);
                addToCallfireCreditsPayments('text', 1, $broadcastId, $real_post_id);
                updateCallfireCredits($real_post_id, 1);

                $user_id = get_current_user_id();
                $user_data = get_userdata($user_id);
                $username = $user_data->data->user_login;
                $study_no = get_post_meta($real_post_id, "study_no", true);
                $study_link = "<a href='".site_url()."/?p=".$real_post_id."' target='_blank'>$study_no</a>";
                $company = get_post_meta($real_post_id, "name_of_site", true);
                $indication = get_post_meta($real_post_id, "custom_title_(for_thank_you_page)", true);

                $subject = "Text Message ($study_no $company $phone)";

                $message .= "<body>

                  <table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>

                    <tr>
                      <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'>
                      <strong>Text Message</strong>
                      </td>
                    </tr>

                    <tr>
                      <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
                    </tr>

                    <tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Username:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$username."</td>
                    </tr>
                    <tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Company:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$company."</td>
                    </tr>
                    <tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Number:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$study_link."</td>
                    </tr>
                    <tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Indication:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$indication."</td>
                    </tr>
                    <tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Patient:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$patient_name."</td>
                    </tr>
                    <tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Text Message:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$msg."</td>
                    </tr>
                    </table>
                  </body>
                  ";
                $headers[] = 'From: Studykik <info@studykik.com>';
                $headers[] = "MIME-Version: 1.0\r\n";
                $headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $SendEmail = wp_mail('info@studyKIK.com',$subject,$message,$headers);

            }
		}
	}elseif(!isEnoughCredits($pst_id) && isset($_POST['msgarea'])){
        echo 'not enough credits';die;
    }
 ?>
 <style>
	.add_btn.sentmsg {
		margin-right: 35px;
	}
	.lft_mssg{
		display: table; padding: 5px; border: 1px solid black; border-radius: 4px; background-color: orange;word-break:break-all;margin-left:1px;
		 min-width: 175px !important;
	}
	.lft_mssg_err{
		padding: 18px 6px; border: 1px solid black; border-radius: 4px; background-color: salmon;word-break:break-all;font-size:17px;
	}
	.rght_msgg{
	 display: table; padding: 6px; border: 1px solid black; border-radius: 4px; float: right; text-align: left; background-color: #00afef;word-break:break-all;
	  min-width: 175px !important;margin-right:10px;
	}
	.clinical_trial_msggggg {
		float: left;
		font-size: 15px;
		margin-bottom: 2px !important;
		padding: 2px;
		width: 94%;
	}
	.lft_msg_dt{
	 width:80% !important;
	}
	.lft_msg_dt_err{
		width:100% !important;
	}
	.rght_msg_dt{
	 float: right; width: 80% !important; text-align: right;
	}
	.lft_dll{
		color: white;
	}
	.rght_dll{
		float: right; color: white;
	}
	.validation{
	border: 1px solid red !important;
}
.mydiv.black_overlay > img {
    margin-left: 165px;
    margin-top: 100px;
}
.add_btn.sentmsg {
    margin-left: -10px;
}
#textmsgfrm textarea {
    margin-left: -8px;
}

</style>

<div style="height: 288px; overflow: auto; padding-top: 10px;" class="wapper">

	<?php
	if($phone !=""){
		mysql_query("UPDATE 0gf1ba_calldata SET is_read='1' WHERE from_number='$phone'");
        $memcache = new Memcache;
        $is_memcache_connected = $memcache->connect(MEMCACHE_HOST, MEMCACHE_PORT);

        $unread_messages = $memcache->get('unread_messages_'.$real_post_id);
        $new_unread_messages = array();
        if ($unread_messages){
            foreach($unread_messages as $key => $message){
                if ($message->sub_id != $id){
                    $new_unread_messages[] = $message;
                }
            }
            $memcache->set('unread_messages_'.$real_post_id, $new_unread_messages, false, 3600);
        }
		//$query = $wpdb->get_results("SELECT * FROM 0gf1ba_calldata WHERE (from_number = '$phone' or sent_number = '$phone') and NOT (type = 2)", OBJECT);
        $query = $wpdb->get_results("SELECT * FROM 0gf1ba_calldata WHERE (study_id = '$pst_id' AND patient_id = '$id' AND is_first != 1) and NOT (type = 2)", OBJECT);
		if (count($query)> 0){
            $_custom_fields = get_post_custom($pst_id);
			foreach($query as $qry){
				$in_out = $qry->in_out;
				$pst_id=$qry->post_id;
                $created_date_obj = new DateTime(str_replace("?","",$qry->created));
                if(isset($_custom_fields['callfire_time_zone'])){
                    switch($_custom_fields['callfire_time_zone'][0]){
                        case 1:
                            $created_date_obj->add(new DateInterval('PT2H'));
                            break;
                        case 2:
                            $created_date_obj->add(new DateInterval('PT1H'));
                            break;
                        case 4:
                            $created_date_obj->sub(new DateInterval('PT1H'));
                            break;
                    }
                }
				if($in_out==1){
				?>
				<dl class="lft_dll clinical_trial_msggggg">
					<dt class="lft_msg_dt">
						<div class="lft_mssg">
							<?php echo $qry->message ;?>
							<br>
							<span style="font-size:11px;">
								<i><?php echo $created_date_obj->format('m-d-Y h:i A');?></i>
							</span>
						</div>
					</dt>
				</dl>
				<?php
				}
				else{ ?>
					<dl class="rght_dll clinical_trial_msggggg"> 
						<dt class="rght_msg_dt">
							<div class="rght_msgg">
								<?php echo $qry->message ;?>
								<br>
								<span style="font-size:11px;">
									<i><?php echo $created_date_obj->format('m-d-Y h:i A');?></i>
								</span>
							</div>
						</dt>
					</dl>
				<?php 
				} 
			}
            if ($stop_sending_msgs) {
                ?>
                <dl class="lft_dll clinical_trial_msggggg">
                    <dt class="lft_msg_dt_err">
                    <div class="lft_mssg_err">
                        This patient no longer wants to receive text messages. The ability to text him/her through your portal has been removed.
                        You may still call or email to see if he/she qualifies for the study.
                    </div>
                    </dt>
                </dl>
                <?php
            }
		}
		else{ ?>
			<dl class="lft_dll clinical_trial_msggggg">
				<dt class="lft_msg_dt_err">
					<div class="lft_mssg_err">
						There are no messages for you..
					</div>
				</dt>
			</dl>
		<?php
		}
	}
	else{ ?>
		<dl class="lft_dll clinical_trial_msggggg">
			<dt class="lft_msg_dt_err">
				<div class="lft_mssg_err">
					This Patient doesn't have a Phone Number!<br/> Please add a Phone Number to text them.
				</div>
			</dt>
		</dl>
	<?php
	}
	?>
 </div>
<div class="Msgform">
	<form id="textmsgfrm">
		<input type="hidden" name="post_id" id="hid" value="<?php echo $_POST['post_id']; ;?>">
        <input type="hidden" id="real_post_id" value="<?php echo $real_post_id; ?>">
		<input type="hidden" name="action"   value="text_amsg" id="text_amsg">
		<input type="hidden" name="msg_file"   value="mess_system" id="mess_system">
		<div style="margin-top:20px; margin-bottom:-15px;margin-left:11px;">
		<!--<label for="message" class="label_msg">Enter Message</label> -->
		<textarea rows="4" cols="59" name="msgarea" id="msgarea" placeholder="Enter Message" maxlength="160" style="width:95%;height:105px"></textarea>
        <div style="color: #888888; margin-left:-8px;">Characters Remaining: <span id="remaining_chars">160</span></div>
		<div style="width:100%; margin-top:10px; margin-bottom:20px">
			<input type="button" <?php echo (($stop_sending_msgs) ? 'disabled="true"': ''); ?> class="add_btn sentmsg <?php echo (($stop_sending_msgs) ? 'disabled': ''); ?>" value="Send Message" id ="sentmsg1" name="sent_txt1" style="float:none !important;width:35%;">
			<img id="ld_img" style="margin-top:-2px;display:none;" src="<?php bloginfo('template_url'); ?>/images-dashboard/img/loadingg.gif" />
		</div>
	</form>
</div>
<script>
	jQuery(function() {
	   jQuery("#sentmsg1").on("click", function(event) {
		   if(jQuery.trim(jQuery('#msgarea').val()) ==''){
			jQuery("#msgarea").addClass("validation");
		   }
		   else{
			   
			// alert('alert');
			event.preventDefault();
			jQuery.ajax({ 
			   url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
				type: "post",
				data: jQuery('#textmsgfrm').serialize(),
				 beforeSend: function() {
                jQuery("#ld_img").show();
            },
				success: function(d){
                    if (d.trim() == 'not enough credits'){
                        jQuery("#buy_credits_title").html('You need to add credits to send messages.');
                        jQuery("#buy_credits_post_id").val($("#real_post_id").val());
                        $(".buy_credits_wrapper_container a").remove();
                        $(".buy_credits_wrapper_container").append('<a class="closepop" id="buy_credits_close_top_bar" href="javascript:void(0);" onclick="document.getElementById(\'buyCredits\').style.display=\'none\'; jQuery(\'#sentmsggs\').show();">Close</a>');
                        jQuery("#buy_credits_close_bttn").hide();
                        jQuery("#buy_credits_purchase_bttn").show();
                        jQuery(".buy_credits_error_text").hide();
                        jQuery(".buy_credits_main_content").show();
                        $("#buy_credits_paymentmethod").val('');
                        jQuery(".loop_credit").hide();
                        jQuery(".buy_credits_form_area").css("height","240px");
                        jQuery("#buyCredits").show();
                        jQuery("#sentmsggs").hide();
                    }else{
                        jQuery("#nts_diva1").html(d);
                    }
                    jQuery("#ld_img").hide();
				}
				 
			});
		   }
		});
	   
	});
	$(".wapper").animate({ scrollTop: $(document).height() * 500 }, "fast");
 jQuery("#msgarea").keyup(function(){
     var currentLength = $(this).val().length;
     jQuery('#remaining_chars').html(160 - currentLength);
				if(jQuery.trim(jQuery('#msgarea').val()) ==''){
					jQuery("#msgarea").removeClass("validation");
					jQuery("#msgarea").addClass("validation");
				}
				else{
					jQuery("#msgarea").removeClass("validation");
				}
			});
    var phone_number = '<?php echo $phone; ?>';
    if (jQuery.trim(phone_number) == ''){
        jQuery('.sentmsg').css('background-color', '#bababa');
        jQuery('.sentmsg').prop('disabled', true);
    }
 </script>
 