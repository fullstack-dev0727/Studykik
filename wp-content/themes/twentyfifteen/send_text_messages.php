<?php
    if(isset($_REQUEST['tz'])){
        $tz=$_REQUEST['tz'];
        $msss="cron working for send sms from live server---".$tz;
        $wpdb->query($wpdb->prepare("INSERT INTO `cron_testing`(`id`, `name`) VALUES (NULL,'$msss')",array()));
        if($tz !=""){
            echo $tz;
            $wsdl = 'https://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl';
            $client = new SoapClient($wsdl, array(
            'soap_version' => SOAP_1_2,
            'login'        => '41530ff4e2a8',
            'password'     => 'a44dd745a81cca3c'));
            $tm_date=date("Y-m-d", time()+86400);
	    $current = date('Y-m-d H:i:s',strtotime('-7 hours'));
	    $sub_results=$wpdb->get_results("SELECT id, post_id, phone,schedule_time FROM 0gf1ba_subscriber_list where schedule_time LIKE '%$tm_date%'");
            if(!empty($sub_results)){
                foreach($sub_results as $res ) {
                    $pid=$res->post_id;
                    $patient_id=$res->id;
                    $timezone = get_post_meta($pid, 'callfire_time_zone', true );
                    if($timezone==$tz /*&& isEnoughCredits($pid)*/){
			$phone_number12=$res->phone;
			$campaign = get_post_meta($pid, 'renewed', true );


                        $site_name = get_post_meta($pid, 'name_of_site', true);
                        $dt1=date("m-d-Y", strtotime($res->schedule_time));
                        $tm1=date("h:i A", strtotime($res->schedule_time));
                        $message="Hi, This is a friendly reminder for your appointment at ".$site_name." on ".$dt1." at ".$tm1.". See you soon!";

                        $pur_num = (get_post_meta($pid, 'text_message_purchased_number', true )?get_post_meta($pid, 'text_message_purchased_number', true ):get_post_meta($pid, 'purchased_number', true ));
                        if ($pur_num){
                            $sendTextRequest = array(
                                'BroadcastName' => 'Studykick Sms Broadcast',
                                'ToNumber'      => $phone_number12,
                                //'TextBroadcastConfig' => array('Message' => 'Thank you for signing up new !'));
                                'TextBroadcastConfig' => array('Message' => $message, 'FromNumber'=> $pur_num));
                            $broadcastId = $client->sendText($sendTextRequest);
                            $sql = "INSERT INTO 0gf1ba_calldata (id,message,sent_number,in_out,campaign,created,is_read,study_id,patient_id, broadcastId) VALUES ('','$message','$phone_number12','2', '$campaign','$current','1', '$pid', '$patient_id', '$broadcastId')";
                            $wpdb->query($sql);
                        }
                    }
		}
	    }
        }
    }
?>