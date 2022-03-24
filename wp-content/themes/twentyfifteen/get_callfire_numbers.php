<?php
    $wpdb->query($wpdb->prepare("INSERT INTO `cron_testing`(`id`, `name`) VALUES (NULL,'cron working for get numbers from live server')",array()));
    $wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
    $client = new SoapClient($wsdl, array(
    'soap_version' => SOAP_1_2,
    'login'        => '41530ff4e2a8',
    'password'     => 'a44dd745a81cca3c'));

    /**
	* SendCall. Asynchronous operation that starts a call campaign to
	* specified numbers.
    */

    $request = new stdclass();
    $request->MaxResults =5000;
    $request->FirstResult =0;
    $response=$client->GetCallerIds($request);
    $response = json_decode(json_encode($response), true);
    if(isset($response['TotalResults'])){
	if($response['TotalResults'] > 0){
	    if(!isset($response['CallerId'][0])){
		$call_ids=array();
		$call_ids=$response['CallerId'];
		$response['CallerId']=array();
		$response['CallerId'][0]=$call_ids;
	    }
	    //echo "oopss";
	    foreach($response['CallerId'] as $call_id){
		$numm=$call_id;
		$from_number=substr($numm,1,10);
		$wpdb->get_results( "SELECT * FROM 0gf1ba_callfire_numbers WHERE phone_number = '$from_number' and number_type = '1'");
		$np = $wpdb->num_rows;
		$current=date('Y-m-d H:i:s');
		if($np==0){
		    $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_callfire_numbers`(`id`, `phone_number`, `number_type`, `created`) VALUES (NULL,'$from_number','1','$current')",array()));
		}
	    }
	}
    }


    //echo "<pre>";
    //print_r($response) ;

    $query = new stdclass();
    $query->MaxResults = 5000;
    $query->FirstResult =0;
    $query->Region = new stdclass(); // required
    $response = $client->QueryNumbers($query);
    $response = json_decode(json_encode($response), true);
    //echo "<pre>";
    //print_r($response) ;
    if(isset($response['TotalResults'])){
	if($response['TotalResults'] > 0){
	    if(!isset($response['Number'][0])){
		$call_ids=array();
		$call_ids=$response['Number'];
		$response['Number']=array();
		$response['Number'][0]=$call_ids;
	    }
	    foreach($response['Number'] as $call_id){
		$numm=$call_id['Number'];
		$purchased_number=substr($numm,1,10);
		$wpdb->get_results( "SELECT * FROM 0gf1ba_callfire_numbers WHERE phone_number = '$purchased_number' and number_type = '2'");
		$np = $wpdb->num_rows;
		$current=date('Y-m-d H:i:s');
		if($np==0){
		    $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_callfire_numbers`(`id`, `phone_number`, `number_type`, `created`) VALUES (NULL,'$purchased_number','2','$current')",array()));
		}
	    }
	}
    }
    $wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
    $client = new SoapClient($wsdl, array(
    'soap_version' => SOAP_1_2,
    'login'        => '41530ff4e2a8',
    'password'     => 'a44dd745a81cca3c'));
    if(isset($response['TotalResults'])){
	if($response['TotalResults'] > 0){
	    if(!isset($response['Number'][0])){
		$call_ids=array();
		$call_ids=$response['Number'];
		$response['Number']=array();
		$response['Number'][0]=$call_ids;
	    }
	    foreach($response['Number'] as $call_id){
		if($call_id['NumberConfiguration']['CallFeature']=='ENABLED'){
		    if(!isset($call_id['NumberConfiguration']['InboundCallConfiguration']['CallTrackingConfig']['WhisperSoundId'])){
			$numm=$call_id['Number'];
			$requestt = new stdclass();
			$requestt->Number = $numm; // required
			$requestt->NumberConfiguration = new stdclass(); // required
			$requestt->NumberConfiguration->CallFeature = 'ENABLED';
			$requestt->NumberConfiguration->InboundCallConfigurationType = 'TRACKING';
			$requestt->NumberConfiguration->InboundCallConfiguration->CallTrackingConfig = new stdclass(); // required choice
			$requestt->NumberConfiguration->InboundCallConfiguration->CallTrackingConfig->WhisperSoundId = 1993749003; // boolean
			$client->ConfigureNumber($requestt);
		    }
		}
	    }
	}
    }
?>
