<?php
    $wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
    $client = new SoapClient($wsdl, array(
    'soap_version' => SOAP_1_2,
    'login'        => '41530ff4e2a8',
    'password'     => 'a44dd745a81cca3c'));
    $request = new stdclass();
    $request->Subscription = new stdclass(); // required
    $request->Subscription->Endpoint = site_url().'/getcalldetails'; // required
    $request->Subscription->NotificationFormat = 'JSON'; // required  [XML, JSON, SOAP, EMAIL]
    $request->Subscription->TriggerEvent = 'INBOUND_CALL_FINISHED';
    $subscriptionId = $client->CreateSubscription($request);
    echo "subscriptionId: $subscriptionId";
?>