<?php
callfireTestLog('get call details start file');
global $wpdb;
$rawData = file_get_contents("php://input");
//$rawData ='{"CallFinished":{"SubscriptionId":480084003,"Call":{"@id":"589233785003","FromNumber":1305401004,"ToNumber":17142438767,"State":"FINISHED","ContactId":459051544003,"Inbound":true,"Created":"2015-09-12T13:04:14Z","Modified":"2015-09-12T13:05:12Z","FinalResult":"XFER_LEG","CallRecord":[{"@id":"329040470003","Result":"XFER_LEG","FinishTime":"2015-09-12T13:05:11Z","BilledAmount":0,"AnswerTime":"2015-09-12T13:04:24Z","Duration":47},{"@id":"329040469003","Result":"XFER","FinishTime":"2015-09-12T13:05:11Z","BilledAmount":1,"AnswerTime":"2015-09-12T13:04:15Z","Duration":56}],"AgentCall":false}}}';
if($rawData !=""){
    callfireTextTestLog('rawData'. $rawData);
    callfireTextTestLog('requestData'. json_encode($_REQUEST));
    $arr=json_decode($rawData,TRUE);
    if(isset($arr['CallFinished']['Call'])){
        $to_number=substr($arr['CallFinished']['Call']['ToNumber'],1,10);
        $from_number=substr($arr['CallFinished']['Call']['FromNumber'],1,10);
        $result2=mysql_query("select pm.post_id as post_id, s.id as patient_id from 0gf1ba_postmeta as pm LEFT JOIN 0gf1ba_subscriber_list as s ON (s.post_id = pm.post_id AND s.phone = $from_number) where pm.meta_key='purchased_number' and pm.meta_value=$to_number order by pm.meta_id desc");
        $numpostid=0;
        while($row = mysql_fetch_assoc($result2)){
            $stss=get_post_status( $row["post_id"] );
            if($stss !='inherit'){
                $numpostid=$row["post_id"];
                $patient_id=$row["patient_id"];
                $campaign = get_post_meta( $numpostid, 'renewed', true );
                $subs_id=$arr['CallFinished']['SubscriptionId'];
                $type=2;

                if(!isset($arr['CallFinished']['Call']['CallRecord'][0])){
                    $call_data=$arr['CallFinished']['Call']['CallRecord'];
                    $arr['CallFinished']['Call']['CallRecord']=array();
                    $arr['CallFinished']['Call']['CallRecord'][0]=$call_data;
                }
                if ( isset($arr['CallFinished']['Call']['CallRecord'][1]['Duration']) && ($arr['CallFinished']['Call']['CallRecord'][1]['Duration'] > $arr['CallFinished']['Call']['CallRecord'][0]['Duration'])){
                    $call_duration=$arr['CallFinished']['Call']['CallRecord'][1]['Duration'];
                }else{
                    $call_duration=$arr['CallFinished']['Call']['CallRecord'][0]['Duration'];
                }

                $ivr_enabled = get_post_meta($numpostid, 'ivr_enabled', true);

                if ($ivr_enabled && $ivr_enabled[0] == "yes" ) {
                    $pressed_1 = false;
                    if (isset($arr['CallFinished']['Call']['CallRecord'])){
//                        $sum = 0;
                        foreach($arr['CallFinished']['Call']['CallRecord'] as $call_record){
                            if (isset($call_record['QuestionResponse']) && $call_record['QuestionResponse']['Response'] == "pressed 1"){
//                                $sum += $call_record['BilledAmount'];
                                $pressed_1 = true;
                            }
                        }
                        //updateCallfireCredits($numpostid, $sum);
                    }

                    if (!$pressed_1) {
                        continue;
                    }
                }

                $received=date('Y-m-d H:i:s',strtotime($arr['CallFinished']['Call']['CallRecord'][0]['AnswerTime']));
                //$current=$date = date('Y-m-d H:i:s');
                $current = date('Y-m-d H:i:s',strtotime('-7 hours'));
                $status=$arr['CallFinished']['Call']['State'];
                $broadcast_id = (isset($arr['CallFinished']['Call']['BroadcastId'])?$arr['CallFinished']['Call']['BroadcastId']:NULL);
                //mysql_query("INSERT INTO `0gf1ba_calldata`(`id`, `subscription_id`, `to_number`, `from_number`, `type`, `status`, `call_duration`, `json_data`, `receive_date_time`, `created`,`campaign`, is_read, study_id, patient_id, in_out, broadcast_id) VALUES (NULL,'$subs_id','$to_number','$from_number','$type','$status','$call_duration','$rawData','$received','$current','$campaign', 1, '$numpostid', '$patient_id', 1, '$broadcast_id')");
                $wpdb->query("INSERT INTO `0gf1ba_calldata`(`id`, `subscription_id`, `to_number`, `from_number`, `type`, `status`, `call_duration`, `json_data`, `receive_date_time`, `created`,`campaign`, is_read, study_id, patient_id, in_out, broadcast_id) VALUES (NULL,'$subs_id','$to_number','$from_number','$type','$status','$call_duration','$rawData','$received','$current','$campaign', 1, '$numpostid', '$patient_id', 1, '$broadcast_id')");
                //$mess_id = mysql_insert_id();
                $mess_id = $wpdb->insert_id;

                if($numpostid !=0){
                    $result1=mysql_query("SELECT COUNT(phone) FROM 0gf1ba_subscriber_list WHERE phone=$from_number and post_id=$numpostid");
                    $row1=mysql_fetch_row($result1);
                    $count1=$row1[0];
                    if($count1 ==0){
                        $result=mysql_query("SELECT COUNT(id) AS automatic_count FROM 0gf1ba_subscriber_list WHERE is_automatic_callfire=1 AND post_id = $numpostid");
                        $row = mysql_fetch_row($result);
                        $count = $row[0];
                        $count=$count+1;
                        $name='Incoming Call #'.$count;
                        $email='No Email';
                        $phone=$from_number;
                        $campaign=0;
                        $campaign = get_post_meta( $numpostid, 'renewed', true );
                        $current_dt = date('Y-m-d H:i:s',strtotime('-4 hours'));
                        //mysql_query("INSERT INTO `0gf1ba_subscriber_list`(`id`, `name`, `email`, `phone`, `post_id`, `date`, `row_num`, `order_id`, `campaign`,`is_automatic_callfire`) VALUES (NULL,'$name','$email','$phone','$numpostid','$current_dt','1','0','$campaign','1')");
                        $wpdb->query("INSERT INTO `0gf1ba_subscriber_list`(`id`, `name`, `email`, `phone`, `post_id`, `date`, `row_num`, `order_id`, `campaign`,`is_automatic_callfire`) VALUES (NULL,'$name','$email','$phone','$numpostid','$current_dt','1','0','$campaign','1')");
                        //$id = mysql_insert_id();
                        $id = $wpdb->insert_id;
                        sendReferralEmails($numpostid, $from_number, $name, $email);
                        mysql_query("UPDATE 0gf1ba_calldata SET patient_id = '$id'  WHERE id = '$mess_id'");
                        callfireAddToContactList($numpostid, $from_number);
                    }
                }
            }
        }
    }
}

function sendReferralEmails($post_id, $from_number, $name, $email)
{
    $email_adress = get_post_meta($post_id, 'email_adress', true);
    $email_adress_2 = get_post_meta($post_id, 'email_adress_2', true);
    $email_adress_3 = get_post_meta($post_id, 'email_adress_3', true);
    $email_adress_4 = get_post_meta($post_id, 'email_adress_4', true);
    $email_adress_5 = get_post_meta($post_id, 'email_adress_5', true);
    $email_adress_6 = get_post_meta($post_id, 'email_adress_6', true);
    $email_adress_7 = get_post_meta($post_id, 'email_adress_7', true);
    $email_adress_8 = get_post_meta($post_id, 'email_adress_8', true);
    $slug = get_post_meta($post_id, 'study_no', true);
    $custom_title_for_thank_you_page = get_post_meta($post_id, 'custom_title_(for_thank_you_page)', true);
    $protocol_no = get_post_meta($post_id, 'protocol_no', true);
    $name_of_site = get_post_meta($post_id, 'name_of_site', true);
    $post_content = get_post($post_id);
    $title = $post_content->post_title;
    $guid = $post_content->guid;
    $guid = post_permalink($post_id);
    if ($custom_title_for_thank_you_page) {
        $title2 = $custom_title_for_thank_you_page;
    } else {
        $title2 = $post_content->post_title;
    }
    if ($protocol_no) {
        $title_final = $protocol_no;
    } else {
        $title_final = $title2;
    }
    $subject = "New Patient From StudyKIK (" . $slug . " " . $custom_title_for_thank_you_page . " " . $name_of_site . " " . $from_number . ")";
    $body = '<body style="background:#FFF;margin:0;font-family:Arial, Helvetica, sans-serif;">
		<div class="wrapper" style="margin:0 auto;width:960px;"><div class="banner" style="float:left; background:url(' . site_url() . '/oneclickup/images/email123.png) no-repeat;width:100%; height: 870px;">
		<div class="study_link" style="float:left;width:100%;">
		 <table cellpadding="12%" style="float: left; margin: 4% 0 0 16%; background:#9FCF67; width: 78%; text-align: left;font-size: 20px; color: #fff;border:none;">
		<caption style="font-size: 40px; margin-bottom: 24px; margin-left: 10px; text-align: left;font-weight: bold;">NEW STUDYKIK PATIENT REFERRAL!</caption>
		 <tbody>
		<tr>
		  <th><span style="font-size:18px;text-transform: uppercase;">Study Page:</span></th>
		  <td><span style="font-size:18px; color:#fff;"><a style="text-transform:uppercase;" href="' . $guid . '">' . $title_final . '</a></span></td>
		</tr>
		<tr>
		  <th><span style="font-size:18px;text-transform: uppercase;">Name:</span></th>
		  <td><span style="font-size:18px;">' . $name . ' (Phone Call)</span></td>
		</tr>
		<tr>
		  <th><span style="font-size:18px;text-transform: uppercase;">Email:</span></th>
		  <td><span style="font-size:18px; color:#fff;">' . $email . '</span></td>
		</tr>
		<tr>
		  <th><span style="font-size:18px; text-transform: uppercase;">Mobile Phone:</span></th>
		  <td><span style="font-size:18px;">' . $from_number . '</span></td>
		</tr>
	      </tbody>
	    </table>
	     <div class="tips" style="float:left; width:100%;">
		 <table cellpadding="10" style="float: left; margin:9% 0 0 23%; width: 45%; text-align: left; color: #fff;border:none; color:#949ca1;">
		<caption style="font-size: 18px; color:#00afef; margin-bottom: 35px; margin-left: 84px; margin-top: 10px;text-align: left;font-weight: bold;">Tips for High Scheduling Rates</caption>
		    <tbody>
		      <tr>
			<th><img src="' . site_url() . '/oneclickup/images/email12.png" alt="" /></th>
			<td><span style="font-size:18px;">Contact your patients via phone, email, and text ASAP</span></td>
		      </tr>
		      <tr>
			<th><img src="' . site_url() . '/oneclickup/images/email14.png" alt="" /></th>
			<td><span style="font-size:18px;">Save time by texting patients through the MyStudyKIK portal (<a href="https://www.youtube.com/watch?v=RUHCnmQy5Yk" target="_blank">Click here for information</a>)</span></td>
		      </tr>
		      <tr>
			<th><img src="' . site_url() . '/oneclickup/images/email13.png" alt="" /></th>
			<td><span style="font-size:18px;">Reach out at least 5 times - on average it takes 7-9 points of contact before a patient will trust joining a clinical trial</span></td>
		      </tr>
		    </tbody>
		  </table>
		</div>
		</div>
	      </div>
	      </div>
	    </body>';
    $email_arr = array();
    if ($email_adress) {
        $email_arr[$email_adress] = $email_adress;
    }
    if ($email_adress_2) {
        $email_arr[$email_adress_2] = $email_adress_2;
    }
    if ($email_adress_3) {
        $email_arr[$email_adress_3] = $email_adress_3;
    }
    if ($email_adress_4) {
        $email_arr[$email_adress_4] = $email_adress_4;
    }
    if ($email_adress_5) {
        $email_arr[$email_adress_5] = $email_adress_5;
    }
    if ($email_adress_6) {
        $email_arr[$email_adress_6] = $email_adress_6;
    }
    if ($email_adress_7) {
        $email_arr[$email_adress_7] = $email_adress_7;
    }
    if ($email_adress_8) {
        $email_arr[$email_adress_8] = $email_adress_8;
    }
    $email_arr['info@studykik.com'] = 'info@studykik.com';
    $toos = implode(",", $email_arr);

    $headers = "From: " . strip_tags('info@studykik.com') . "\r\n";
    $headers .= "Reply-To: " . strip_tags('info@studykik.com') . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
    $headers_pdf[] = "MIME-Version: 1.0\r\n";
    $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";

    wp_mail($toos, $subject, $body, $headers_pdf);
}

?>