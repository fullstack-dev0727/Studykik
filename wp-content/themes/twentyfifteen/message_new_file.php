<?php 


		$wsdl = 'https://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl';
		$client = new SoapClient($wsdl, array(
		'soap_version' => SOAP_1_2,
		'login'        => '41530ff4e2a8',
		'password'     => 'a44dd745a81cca3c'));
		$sendTextRequest = array(
		'BroadcastName' => 'Studykick Sms Broadcast',
		'ToNumber'      => 5629229002,
		'TextBroadcastConfig' => array('Message' => 'Thank you for signing up new test !'));
		//'TextBroadcastConfig' => array('Message' => $msg, 'FromNumber'=> $pur_num));
		echo $broadcastId = $client->sendText($sendTextRequest);
				
	
	?>
	
 