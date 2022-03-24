<?php

  include('../../_authorize/anet_php_sdk/AuthorizeNet.php');
	define("AUTHORIZENET_API_LOGIN_ID", "8zLA4Bs3qC");
	define("AUTHORIZENET_TRANSACTION_KEY", "3tZM8S49gaE76AE6");
	define("AUTHORIZENET_SANDBOX", true);
	$sale = new AuthorizeNetAIM;
	
	$sale->amount     			= $total2;
	$sale->card_num   			= $cc_number;
	$sale->exp_date   			= $expiration;
	$sale->first_name 			= $_SESSION['b_fname'];
	$sale->last_name  			= $_SESSION['b_lname'];
	$sale->address   		    = $_SESSION['b_address'];
	$sale->city      		    = $_SESSION['b_city'];
	$sale->state     		    = $_SESSION['b_state'];
	$sale->zip       		    = $_SESSION['b_zip'];
	$sale->email      			= $_SESSION['b_email'];
	$sale->card_code  			= $cvv;
	$sale->ship_to_first_name	= $_SESSION['s_fname'];
	$sale->ship_to_last_name	= $_SESSION['s_lname'];
	$sale->ship_to_address		= $_SESSION['s_address'].' '.$_SESSION['s_address2'];
	$sale->ship_to_city			= $_SESSION['s_city'];
	$sale->ship_to_state		= $_SESSION['s_state'];
	$sale->ship_to_zip			= $_SESSION['s_zip'];
	$sale->VERIFY_PEER      = false;

	
	
		//$response = $sale->authorizeOnly();
		$response = $sale->authorizeAndCapture();
		//print_r($response);
		//echo $response;
		if ($response->approved) {
			$transId = $response->transaction_id;
			$success = 'yes';
			$id      = 'credit';
			$message  = $transId;
		}else{
			$message = $response->response_reason_text;
		} 
  
?>