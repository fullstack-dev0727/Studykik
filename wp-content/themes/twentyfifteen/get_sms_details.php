<?php
callfireTestLog('get sms details start file');
$rawData = file_get_contents("php://input");
//$rawData ='{"TextNotification":{"SubscriptionId":480085003,"Text":{"@id":"589048310003","FromNumber":15629224678,"ToNumber":17142438767,"State":"FINISHED","ContactId":455032665003,"Inbound":true,"Created":"2015-09-11T22:25:50Z","Modified":"2015-09-11T22:25:50Z","FinalResult":"RECEIVED","Message":"Testttt","TextRecord":{"@id":"328887350003","Result":"RECEIVED","FinishTime":"2015-09-11T22:25:50Z","BilledAmount":1,"Message":"Testttt"}}}}';
//$fp = fopen('lidn.txt', 'a+');
//fwrite($fp, $rawData);
//fclose($fp);
//echo $rawData=file_get_contents('lidn.txt');
if($rawData !=""){
    callfireTextTestLog('rawData'. $rawData);
    $arr=json_decode($rawData,TRUE);
//    echo "<pre>";
//    print_r($arr);
    if(isset($arr['TextNotification']['Text'])){
        $subs_id = $arr['TextNotification']['SubscriptionId'];
        $to_number = substr($arr['TextNotification']['Text']['ToNumber'],1,10);
        $from_number = substr($arr['TextNotification']['Text']['FromNumber'],1,10);
        $broadcast_id = (isset($arr['TextNotification']['Text']['BroadcastId'])?$arr['TextNotification']['Text']['BroadcastId']:NULL);
        //$sql = "select pm.post_id as post_id, s.id as patient_id from 0gf1ba_postmeta as pm LEFT JOIN 0gf1ba_subscriber_list as s ON (s.post_id = pm.post_id AND s.phone = $from_number) where pm.meta_key='purchased_number' and pm.meta_value=$to_number order by pm.meta_id desc";
        $sql = "(select post_id as post_id, id as patient_id from 0gf1ba_subscriber_list WHERE phone = $from_number)";
        $sql .= " UNION ";
        $sql .= "(SELECT pm1.post_id as post_id, null as patient_id FROM 0gf1ba_postmeta as pm1"
            ." JOIN 0gf1ba_postmeta as pm2 ON (pm1.post_id = pm2.post_id AND pm2.meta_key = 'purchased_number')"
            ." WHERE (pm1.meta_key='text_message_purchased_number' and pm1.meta_value=$to_number) OR (pm1.meta_key='text_message_purchased_number' and pm1.meta_value='' and pm2.meta_value =$to_number) )";
        $result2 = mysql_query($sql);
        $numpostid = 0;

        $type = 1;
        $msg = htmlentities($arr['TextNotification']['Text']['TextRecord']['Message'],ENT_QUOTES);
        $received = date('Y-m-d H:i:s',strtotime($arr['TextNotification']['Text']['TextRecord']['FinishTime']));
        $current = date('Y-m-d H:i:s',strtotime('-7 hours'));
        $status = $arr['TextNotification']['Text']['FinalResult'];

        $patients_added_to_dnc = array();
        $wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
        $client = new SoapClient($wsdl, array(
            'soap_version' => SOAP_1_2,
            'login'        => '41530ff4e2a8',
            'password'     => 'a44dd745a81cca3c'));
        $memcache = new Memcache;
        $is_memcache_connected = $memcache->connect(MEMCACHE_HOST, MEMCACHE_PORT);

        callfireTestLog('first query = '.$sql);
        /*if (mysql_num_rows($result2) === 0){
            $sql = "SELECT pm1.post_id as post_id, null as patient_id FROM 0gf1ba_postmeta as pm1"
                   ." JOIN 0gf1ba_postmeta as pm2 ON (pm1.post_id = pm2.post_id AND pm2.meta_key = 'purchased_number')"
                   ." WHERE (pm1.meta_key='text_message_purchased_number' and pm1.meta_value=$to_number) OR (pm1.meta_key='text_message_purchased_number' and pm1.meta_value='' and pm2.meta_value =$to_number) ";
            $result2 = mysql_query($sql);
            callfireTestLog('second query = '.$sql);
        }*/
        while($row = mysql_fetch_assoc($result2)) {
            $stss=get_post_status( $row["post_id"] );
            if($stss !='inherit'){
                $numpostid = $row["post_id"];
                $patient_id = $row["patient_id"];
                $campaign = get_post_meta( $numpostid, 'renewed', true );

                if (!$patient_id || $patient_id == 0)
                    continue;
                $pur_num = (get_post_meta($numpostid, 'text_message_purchased_number', true )?get_post_meta($numpostid, 'text_message_purchased_number', true ):get_post_meta($numpostid, 'purchased_number', true ));
                callfireTestLog('pur_num = '.$pur_num);
                callfireTestLog('to_number = '.$to_number);
                if ($pur_num != $to_number){
                    continue;
                }

                if((strcasecmp($msg, 'STOP') == 0) && $patient_id && !in_array($patient_id, $patients_added_to_dnc)){
                    $patients_added_to_dnc[] = $patient_id;
                    mysql_query("UPDATE 0gf1ba_subscriber_list SET stop_sending_msgs='1' WHERE id='$patient_id'");

                    $request = new stdClass();
                    $request->Name = 'Studykick Sms Broadcast';
                    $request->CallDnc = false;
                    $request->TextDnc = true;
                    $request->Numbers = $from_number;
                    try{
                        $response = $client->CreateDncList($request);
                    }catch (Exception $e){

                    }
                }

                if ($patient_id && $patient_id > 0) {
                    $record = $wpdb->query($wpdb->prepare("SELECT * FROM `0gf1ba_calldata` where receive_date_time = '$received' and study_id='$numpostid' and patient_id='$patient_id'"));
                    if ($record) {
                        continue;
                    }
                }

                $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_calldata`(`id`, `subscription_id`, `to_number`, `from_number`, `type`, `status`, `receive_date_time`, `created`, `campaign`, study_id, patient_id, broadcast_id) VALUES (NULL,'$subs_id','$to_number','$from_number','$type','$status','$received','$current','$campaign', '$numpostid', '$patient_id', '$broadcast_id')",array()));
                callfireTestLog('add to call data');
                $return_id=$wpdb->insert_id;
                $arr['TextNotification']['Text']['TextRecord']['Message']=$msg;
                $msggg=htmlentities($arr['TextNotification']['Text']['Message'],ENT_QUOTES);
                $arr['TextNotification']['Text']['Message']=$msggg;
                $rawData=json_encode($arr);
                mysql_query("UPDATE 0gf1ba_calldata SET json_data='$rawData' WHERE id='$return_id'");
                mysql_query("UPDATE 0gf1ba_calldata SET message='$msg' WHERE id='$return_id'");
                callfireTestLog('post id  = '.$numpostid);
                if($numpostid !=0){
                    $result1=mysql_query("SELECT COUNT(phone) FROM 0gf1ba_subscriber_list WHERE phone=$from_number and post_id=$numpostid");
                    $row1=mysql_fetch_row($result1);
                    $count1=$row1[0];
                    if($count1 ==0){
                        $result=mysql_query("SELECT COUNT(id) AS automatic_count FROM 0gf1ba_subscriber_list WHERE is_automatic_callfire=1 AND post_id = $numpostid");
                        $row = mysql_fetch_row($result);
                        $count = $row[0];
                        $count=$count+1;
                        $name='New Patient #'.$count;
                        $email='No Email';
                        $phone=$from_number;
                        $campaign=0;
                        $campaign = get_post_meta( $numpostid, 'renewed', true );
                        $current_dt = date('Y-m-d H:i:s',strtotime('-4 hours'));
                        $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_subscriber_list`(`id`, `name`, `email`, `phone`, `post_id`, `date`, `row_num`, `order_id`, `campaign`,`is_automatic_callfire`) VALUES (NULL,'$name','$email','$phone','$numpostid','$current_dt','1','0','$campaign','1')",array()));
                        callfireTestLog('insert');
                        if (!$patient_id){
                            $patient_id=$wpdb->insert_id;
                            mysql_query("UPDATE 0gf1ba_calldata SET patient_id='$patient_id' WHERE id='$return_id'");
                        }
                        sendReferralEmails($numpostid, $from_number, $name, $email);
                    }else{
                        if ($patient_id > 0) {
                            $row=$wpdb->get_results($wpdb->prepare("SELECT * FROM 0gf1ba_subscriber_list WHERE id=$patient_id"));
                            $name = $row[0]->name;
                            $email = $row[0]->email;
                        }

                        if (isset($arr['TextNotification']['Text']['TextRecord']['BilledAmount'])){
                            updateCallfireCredits($numpostid, $arr['TextNotification']['Text']['TextRecord']['BilledAmount']);
                        }
                    }

                    $disable_text_email_notification = get_post_meta($numpostid, 'disable_text_email_notification', true);

                    if ($patient_id > 0 && (!$disable_text_email_notification || !$disable_text_email_notification[0] || $disable_text_email_notification[0] != "yes" ) && strtolower(trim($msg)) != "stop") {
                        sendTextNotificationEmails($numpostid, $from_number, $name, $email, $msg);
                    }
                    $unread_messages = $memcache->get('unread_messages_'.$numpostid);
                    if ($unread_messages){
                        $message_date = new DateTime($current);
                        $unread_messages[] = array('sub_id' => $patient_id, 'message_id'  => $return_id, 'message' => $msg, 'message_date' => $message_date->format('m-d-Y h:i A'), 'message_date_formated' => $message_date->format('Y-m-d H:i:s'));
                        $memcache->set('unread_messages_'.$numpostid, $unread_messages, false, 3600);
                    }
                }
            }
        }
    }
}

function sendTextNotificationEmails($post_id, $from_number, $name, $email, $message) {
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
    $subject = "Text Message From StudyKIK (" . $slug . " " . $custom_title_for_thank_you_page . " " . $name_of_site . " " . $from_number . ")";
    $body = '<body style="background:#FFF;margin:0;font-family:Arial, Helvetica, sans-serif;">
		<div class="wrapper" style="margin:0 auto;width:960px;"><div class="banner" style="float:left; background:url(' . site_url() . '/oneclickup/images/email124.png) no-repeat;width:100%; height: 990px;">
		<div class="study_link" style="float:left;width:100%;">
		 <table cellpadding="12%" style="float: left; margin: 4% 0 0 16%; background:#9FCF67; width: 78%; text-align: left;font-size: 20px; color: #fff;border:none;">
		<caption style="font-size: 40px; margin-bottom: 24px; margin-left: 10px; text-align: left;font-weight: bold;">NEW TEXT MESSAGE!</caption>
		 <tbody>
		<tr>
		  <th><span style="font-size:18px;text-transform: uppercase;">Study Page:</span></th>
		  <td><span style="font-size:18px; color:#fff;"><a style="text-transform:uppercase;" href="' . $guid . '">' . $title_final . '</a></span></td>
		</tr>
		<tr>
		  <th><span style="font-size:18px;text-transform: uppercase;">Name:</span></th>
		  <td><span style="font-size:18px;">' . $name . ' (Text)</span></td>
		</tr>
		<tr>
		  <th><span style="font-size:18px;text-transform: uppercase;">Email:</span></th>
		  <td><span style="font-size:18px; color:#fff;">' . $email . '</span></td>
		</tr>
		<tr>
		  <th><span style="font-size:18px; text-transform: uppercase;">Mobile Phone:</span></th>
		  <td><span style="font-size:18px;">' . $from_number . '</span></td>
		</tr>
		<tr>
		  <th><span style="font-size:18px; text-transform: uppercase;">Message:</span></th>
		  <td><span style="font-size:18px;">' . $message . '</span></td>
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
		  <td><span style="font-size:18px;">' . $name . ' (Text)</span></td>
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