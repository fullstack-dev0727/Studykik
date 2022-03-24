<?php
/*
 * Template Name: Leads Hook
 */
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once ("vendor/autoload.php");

use FacebookAds\Api;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
// use FacebookAds\Object\Ad;
$honda_email = ["hondakichiro@gmail.com"];
$info_email = ["info@studykik.com", "dnessonov@gmail.com"];
// wp_mail($honda_email, "start", "start");

$app_id = "1754948814742578";
$app_secret = "2d715170b0615ed1eb28c5c0c9d9adc0";

$access_token = get_option('facebook-token', 'EAAY8HdyzpDIBAGRzrN18FLaJr1zFZB8GN6iZBX3urfYE1uy3GeXphvQRhkIH7JRrgZC0A0qAja7L4zNZAzBX0MpQW7022FaXDWHkRXlZCxp9A8W0BqEcozZBfMC5G7ZAtlarUuMi3Rk00LbI3ZBaWLKXdUt4wJU7R2nmCv977AZAqiQZDZD');
// $access_token = 'EAAY8HdyzpDIBAIKTMVOolyDGFVvZBCpBuXkia5XavyLdXZCoKEkxB5JT5qRZBzqkZCKhKZAPdPoZBqM8AbQVrZBbbm4Hmoexlo0egJh9RPZBWNoPsyARRPzZCNgXZCvJzULavZC0ktKAOiY0HeiZAgZAg2l7swaxfYL0tK0pRBW0YvjkZAdwZDZD';
// update_option('facebook-token', 'EAAY8HdyzpDIBAFFQlHSTr2PIAQh4drJsOomjzHy4qjnRd4A6tlDzMvK2zKdyC4fU0BwiR81WotfX2ZBwDcz6ZBkKCO1ZCFRrFPLcA6mMD6LhLHCxjEjkWGEZBoRsZAvZALPdYEbEHYFOo2ENDmI1RQGFelXlfokgQqjhIZBkdfxpAZDZD');


$input = json_decode(file_get_contents('php://input'), true);

callfireTestLog('facebook subscription');
callfireTestLog(serialize($input));

$leadgen_id = $input['entry'][0]['changes'][0]['value']['leadgen_id'];
$form_id = $input['entry'][0]['changes'][0]['value']['form_id'];
// $leadgen_id = 1682852168636324;
// $form_id = 1682832145304993;
// wp_mail($temails, "step1", $leadgen_id.":".$form_id);

$fb = new Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
]);
callfireTestLog('facebook subscription 1');
callfireTestLog('facebook subscription access token = '.$access_token);
$fb->setDefaultAccessToken($access_token);
callfireTestLog('facebook subscription 2');
try {
	$fb_long_live_token_url = "/oauth/access_token?grant_type=fb_exchange_token&client_id=".$app_id."&client_secret=".$app_secret."&fb_exchange_token=".$access_token;
    callfireTestLog('facebook subscription 3');
	$long_live_token = $fb->get($fb_long_live_token_url);
    callfireTestLog('facebook subscription 4');


  	$leadsgen_response = $fb->get('/'.$leadgen_id);
    callfireTestLog('facebook subscription 5');
  	$form_response = $fb->get('/'.$form_id);
    callfireTestLog('facebook subscription 6');
  	$long_live_token = $long_live_token->getDecodedBody()["access_token"];
	$leadsgen_obj = $leadsgen_response->getDecodedBody()['field_data'];
    
    if ($leadsgen_obj[0][name] == 'email') {
        $email = $leadsgen_obj[0][values][0];    
    } else if ($leadsgen_obj[1][name] == 'email') {
        $email = $leadsgen_obj[1][values][0];    
    } else if ($leadsgen_obj[2][name] == 'email') {
        $email = $leadsgen_obj[2][values][0];    
    }

    if ($leadsgen_obj[0][name] == 'phone_number') {
        $phone_no = $leadsgen_obj[0][values][0];    
    } else if ($leadsgen_obj[1][name] == 'phone_number') {
        $phone_no = $leadsgen_obj[1][values][0];    
    } else if ($leadsgen_obj[2][name] == 'phone_number') {
        $phone_no = $leadsgen_obj[2][values][0];    
    }

    if ($leadsgen_obj[0][name] == 'full_name') {
        $name = $leadsgen_obj[0][values][0];    
    } else if ($leadsgen_obj[1][name] == 'full_name') {
        $name = $leadsgen_obj[1][values][0];    
    } else if ($leadsgen_obj[2][name] == 'full_name') {
        $name = $leadsgen_obj[2][values][0];    
    }
	
	// $phone_no = $leadsgen_obj[1][values][0];
	// $name = $leadsgen_obj[2][values][0];

	$form_id = trim($form_response->getDecodedBody()["name"]);
    callfireTestLog('facebook subscription form_id ='.$form_id);
    // wp_mail($honda_email, "form_id", json_encode(intval($form_id)));

    if ($long_live_token != ''){
        if (get_option('facebook-token') == undefined || get_option('facebook-token') == '') {
            add_option('facebook-token', $long_live_token);
        } else {
            update_option('facebook-token', $long_live_token);
        }
    }else{
        $emails = ['info@studykik.com'];
        $subject = 'FB token error (empty)';
        $message = 'FB token error (empty)';
        wp_mail( $emails, $subject, $message, 'Content-Type: text/html' );
    }

    if (strpos($form_id, ' ') !== false){
        $form_id = substr($form_id, 0, strpos($form_id, ' '));
    }
	$queryArgs = array(
        'post_status' => array( 'publish', 'private' ),
        'post_type'=>  'post',
        'meta_key'          => 'study_no',
        'meta_value'        => $form_id,
    );
	$custom_posts= query_posts($queryArgs);
    // wp_mail($honda_email, "custom_posts message", "custom_posts #: ".json_encode($custom_posts));
    if (count($custom_posts) == 0) {
        $headers = "From: " . strip_tags('info@studykik.com') . "\r\n";
        $headers .= "Reply-To: ". strip_tags('info@studykik.com') . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $err_body = '<body><p><strong>Study #:</strong>'. $form_id. '</p>';
        $err_body .= '<p><strong>Email: </strong>'. $email. '</p>';
        $err_body .= '<p><strong>Phone no: </strong>'. $phone_no. '</p>';
        $err_body .= '<p><strong>Name: </strong>'. $name. '</p></body>';

        //callfireTestLog("Lead Gen No Post Found ".json_encode($err_body));
        wp_mail($info_email, "Lead Gen No Post Found", $err_body, $headers);
    }
	while ( have_posts() ) : the_post();
		$post_id = $post->ID;
	endwhile;
    callfireTestLog('facebook subscription post_id ='.$post_id);
	
	// wp_mail($honda_email, "step2", json_encode($leadsgen_obj));

} catch(Facebook\Exceptions\FacebookSDKException $e) {
    $headers = "From: " . strip_tags('info@studykik.com') . "\r\n";
    $headers .= "Reply-To: ". strip_tags('info@studykik.com') . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    callfireTestLog("Lead Gen Facebook Exception Error ".serialize($e));
	wp_mail( $info_email, "Lead Gen Facebook Exception Error", json_encode($e), $headers);
	exit(0);
}

 // wp_mail($honda_email,"check", $name."-".$email."-".$phone_no."-".$post_id);

$_REQUEST['custom_Mobile_Phone_Number'] = $phone_no;
$_REQUEST['email'] = $email;
$_REQUEST['name'] = $name;
$_REQUEST['post_id'] = $post_id;


function editPhoneNumber($phone){
    return preg_replace("/[^0-9]+/", '', $phone);
}
callfireTestLog('start file');
$outmsg="ok";
if(isset($_REQUEST['custom_Mobile_Phone_Number'])){
    $str=$_REQUEST['custom_Mobile_Phone_Number'];
    $phone_number_unchanged = preg_replace('/\D/', '', $str); // keep only digits and do not trim international phone number
    $noDigits=0;
    $numb="";
    for ($i=0;$i<strlen($str);$i++){
        if (is_numeric($str{$i})){
            if($noDigits==0){
//                    if($str{$i}==0 || $str{$i}==1){
                if($str{$i}==1){

                }
                else{
                    $noDigits++;
                    $numb.=$str{$i};
                }
            }
            else{
                $noDigits++;
                $numb.=$str{$i};
                if($noDigits==10){
                    break;
                }
            }
        }
    }
        $phone_number12 =  $numb;
        $final_phone_number = $phone_number12;
        $email =$_REQUEST['email'];
        $name = $_REQUEST['name'];
        $post_id = $_REQUEST['post_id'];

        //get post custom fileds
        $_custom_fields = get_post_custom($_REQUEST['post_id']);
        if(!isset($_custom_fields['allow_international_phone_numbers'])){
            // by default use USA number format
            $allow_international_phone_numbers = false;
        }else{
            $allow_international_phone_numbers = isset($_custom_fields['allow_international_phone_numbers'][0]) ? ($_custom_fields['allow_international_phone_numbers'][0] != '') : true;
        }

        if ($allow_international_phone_numbers){
            $final_phone_number = $_REQUEST['custom_Mobile_Phone_Number'];
            $phone_number12 = $_REQUEST['custom_Mobile_Phone_Number'];

        }
        $clear_phone_number = editPhoneNumber($_REQUEST['custom_Mobile_Phone_Number']);


        $post_content = get_post($post_id);
        $title = $post_content->post_title;
        $guid = $post_content->guid;
        $guid=post_permalink($post_id);
        $slug = get_post_meta( $post_id, 'study_no', true );
        $phone_number = get_post_meta( $post_id, 'phone_number', true );
        $email_adress = get_post_meta( $post_id, 'email_adress', true );
        $email_adress_2 = get_post_meta( $post_id, 'email_adress_2', true );
        $email_adress_3 = get_post_meta( $post_id, 'email_adress_3', true );
        $email_adress_4 = get_post_meta( $post_id, 'email_adress_4', true );
        $email_adress_5 = get_post_meta( $post_id, 'email_adress_5', true );
        $email_adress_6 = get_post_meta( $post_id, 'email_adress_6', true );
        $email_adress_7 = get_post_meta( $post_id, 'email_adress_7', true );
        $email_adress_8 = get_post_meta( $post_id, 'email_adress_8', true );
        $protocol_no = get_post_meta( $post_id, 'protocol_no', true );
        $name_of_site = get_post_meta( $post_id, 'name_of_site', true );
        $custom_title_for_thank_you_page = get_post_meta( $post_id, 'custom_title_(for_thank_you_page)', true );
        $website_url_thank_you_page = get_post_meta( $post_id, 'website_url_thank_you_page', true );
        $study_full_address = get_post_meta( $post_id, 'study_full_address', true );
        $campaign = get_post_meta( $post_id, 'renewed', true );
        if($custom_title_for_thank_you_page){
            $title2 = $custom_title_for_thank_you_page;
        }
        else{
            $title2 = $post_content->post_title;
        }
        if($protocol_no){
            $title_final = $protocol_no;
        }
        else{
            $title_final = $title2;
        }
        ?>
        <?php
        $subject = "New Patient From StudyKIK (".$slug." ".$custom_title_for_thank_you_page." ".$name_of_site." ".$phone_number12.")";
        
        //$subject = "New Patient From StudyKIK (".$form_id.")";
        $body ='<body style="background:#FFF;margin:0;font-family:Arial, Helvetica, sans-serif;">
		<div class="wrapper" style="margin:0 auto;width:960px;"><div class="banner" style="float:left; background:url('.site_url().'/oneclickup/images/email123.png) no-repeat;width:100%; height: 870px;">
		<div class="study_link" style="float:left;width:100%;">
		 <table cellpadding="12%" style="float: left; margin: 4% 0 0 16%; background:#9FCF67; width: 78%; text-align: left;font-size: 20px; color: #fff;border:none;">
		<caption style="font-size: 40px; margin-bottom: 24px; margin-left: 10px; text-align: left;font-weight: bold;">NEW STUDYKIK PATIENT REFERRAL!</caption>
		 <tbody>
		<tr>
		  <th><span style="font-size:18px;text-transform: uppercase;">Study Page:</span></th>
		  <td><span style="font-size:18px; color:#fff;"><a style="text-transform:uppercase;" href="'.$guid.'">'.$title_final.'</a></span></td>
		</tr>
		<tr>
		  <th><span style="font-size:18px;text-transform: uppercase;">Name:</span></th>
		  <td><span style="font-size:18px;">'.$name.'</span></td>
		</tr>
		<tr>
		  <th><span style="font-size:18px;text-transform: uppercase;">Email:</span></th>
		  <td><span style="font-size:18px; color:#fff;">'.$email.'</span></td>
		</tr>
		<tr>
		  <th><span style="font-size:18px; text-transform: uppercase;">Mobile Phone:</span></th>
		  <td><span style="font-size:18px;">'.$phone_number12.''.$phone_number123.'</span></td>
		</tr>
	      </tbody>
	    </table>
	     <div class="tips" style="float:left; width:100%;">
		 <table cellpadding="10" style="float: left; margin:9% 0 0 23%; width: 45%; text-align: left; color: #fff;border:none; color:#949ca1;">
		<caption style="font-size: 18px; color:#00afef; margin-bottom: 35px; margin-left: 84px; margin-top: 10px;text-align: left;font-weight: bold;">Tips for High Scheduling Rates</caption>
		    <tbody>
		      <tr>
			<th><img src="'.site_url().'/oneclickup/images/email12.png" alt="" /></th>
			<td><span style="font-size:18px;">Contact your patients via phone, email, and text ASAP</span></td>
		      </tr>
		      <tr>
			<th><img src="'.site_url().'/oneclickup/images/email14.png" alt="" /></th>
			<td><span style="font-size:18px;">Save time by texting patients through the MyStudyKIK portal (<a href="https://www.youtube.com/watch?v=RUHCnmQy5Yk" target="_blank">Click here for information</a>)</span></td>
		      </tr>
		      <tr>
			<th><img src="'.site_url().'/oneclickup/images/email13.png" alt="" /></th>
			<td><span style="font-size:18px;">Reach out at least 5 times - on average it takes 7-9 points of contact before a patient will trust joining a clinical trial</span></td>
		      </tr>
		    </tbody>
		  </table>
		</div>
		</div>
	      </div>
	      </div>
	    </body>';
        if($name == "test" || $name == "testing" || $name == "Test" || $name == "Testing"){
        }
        else{
            $current = date('Y-m-d H:i:s',strtotime('-7 hours'));
            $campaign = get_post_meta($post_id, 'renewed', true );
            $query_1234 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post_id' and email = '$email'");
            if($query_1234){
                $outmsg='no';
            }
            else{
                $headers = "From: " . strip_tags('info@studykik.com') . "\r\n";
                $headers .= "Reply-To: ". strip_tags('info@studykik.com') . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
                $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
                $headers_pdf[] = "MIME-Version: 1.0\r\n";
                $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                if($email!= ""  || $name!= "" ){
                    $email_arr=array();
                    if($email_adress){
                        $email_arr[$email_adress]=$email_adress;
                    }
                    if($email_adress_2){
                        $email_arr[$email_adress_2]=$email_adress_2;
                    }
                    if($email_adress_3){
                        $email_arr[$email_adress_3]=$email_adress_3;
                    }
                    if($email_adress_4){
                        $email_arr[$email_adress_4]=$email_adress_4;
                    }
                    if($email_adress_5){
                        $email_arr[$email_adress_5]=$email_adress_5;
                    }
                    if($email_adress_6){
                        $email_arr[$email_adress_6]=$email_adress_6;
                    }
                    if($email_adress_7){
                        $email_arr[$email_adress_7]=$email_adress_7;
                    }
                    if($email_adress_8){
                        $email_arr[$email_adress_8]=$email_adress_8;
                    }
                    $email_arr['info@studykik.com']='info@studykik.com';

                    $toos=implode(",",$email_arr);
                    //$tooss="'".$toos."'";
                    // wp_mail($honda_email,"toss",json_encode34reqewrqz($toos));
                    // wp_mail($honda_email,$subject,$body,$headers_pdf);
                    wp_mail($toos,$subject,$body,$headers_pdf);
                    global $wpdb;
                    $date = date('Y-m-d H:i:s',strtotime('-4 hours'));



                    callfireTestLog('FPN Check ' .$final_phone_number );

                    $res = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post_id' and phone = '$final_phone_number'");

                    callfireTestLog('FPN Check ' .$final_phone_number . ' - Performed.');

                    if ($res){
                        $sql = "UPDATE 0gf1ba_subscriber_list SET email = '".mysql_real_escape_string($email)."', name = '".mysql_real_escape_string($name)."' WHERE id = ".$res[0]->id.";";
                        $query = mysql_query($sql);
                        $patient_id = $res[0]->id;
                        callfireTestLog('FPN Check ' .$final_phone_number . ' - Performed. Result 1, ID=' . $res[0]->id);

                    }else{
                        $sql = "INSERT INTO `0gf1ba_subscriber_list`(`id`, `name`, `email`, `phone`, `clear_phone`, `post_id`, `date`, `row_num`, `order_id`, `notes`, `last_modify`, `campaign`,`is_front`) VALUES (NULL,'".mysql_real_escape_string($name)."','".mysql_real_escape_string($email)."','".mysql_real_escape_string($final_phone_number)."','".mysql_real_escape_string($clear_phone_number)."','".mysql_real_escape_string($post_id)."','".mysql_real_escape_string($date)."','1','0','','','".mysql_real_escape_string($campaign)."','1')";
                        $query = $wpdb->query("INSERT INTO `0gf1ba_subscriber_list`(`id`, `name`, `email`, `phone`, `clear_phone`, `post_id`, `date`, `row_num`, `order_id`, `notes`, `last_modify`, `campaign`,`is_front`) VALUES (NULL,'".mysql_real_escape_string($name)."','".mysql_real_escape_string($email)."','".mysql_real_escape_string($final_phone_number)."','".mysql_real_escape_string($clear_phone_number)."','".mysql_real_escape_string($post_id)."','".mysql_real_escape_string($date)."','1','0','','','".mysql_real_escape_string($campaign)."','1')");
                        $patient_id = $wpdb->insert_id;
                        callfireTestLog('FPN Check ' .$final_phone_number . ' - Performed. Result 2');
                    }
                    if($query === FALSE) {
                        $headers = "From: " . strip_tags('info@studykik.com') . "\r\n";
                        $headers .= "Reply-To: ". strip_tags('info@studykik.com') . "\r\n";
                        $headers .= "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                        $err_body = '<body>';
                        $err_body .= '<p><strong>Email: </strong>'. $email. '</p>';
                        $err_body .= '<p><strong>Phone no: </strong>'. $phone_no. '</p>';
                        $err_body .= '<p><strong>Name: </strong>'. $name. '</p>';
                        $err_body .= '<p><strong>SQL Failed: </strong>'. $sql. '</p></body>';
                        wp_mail($info_email, "Lead Gen Leads Error", $err_body, $headers); // TODO: better error handling
                    }
                    //$patient_id = mysql_insert_id();

                    $message= get_post_meta($post_id, 'text_message',true );
                    add_to_update_log($post_id);



                    if($allow_international_phone_numbers){
                        $message_firetext = get_post_meta($post_id, 'firetext_msg',true );
                        if ($message_firetext) {

                            $message_firetext_from = get_post_meta($post_id, 'firetext_from',true );


                            /*$fh = fopen('/var/www/html/wp-content/1.txt','w');
                            fputs($fh, $message_firetext . ' to ' . $phone_number_unchanged . ' from ' . $message_firetext_from);
                            fclose($fh);*/

                            $fields = array(
                                'apiKey' => urlencode('bYbxg6nuWOTb87s9Y4AvGA7Tlia7gA'),
                                'message' => urlencode($message_firetext),
                                'from' => urlencode($message_firetext_from),
                                'to' => urlencode($phone_number_unchanged)
                            );

                            //url-ify the data for the POST
                            $fields_string = '';
                            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                            rtrim($fields_string, '&');

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_URL, 'https://www.firetext.co.uk/api/sendsms');
                            curl_setopt($ch,CURLOPT_POST, count($fields));
                            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

                            $result = curl_exec($ch);
                            curl_close($ch);

                        }
                    }

                    if($message){
                        callfireTestLog('callfire init');
                        $_REQUEST['message'] = $message;
                        $_REQUEST['phone_number12'] = $phone_number12;
                        $_REQUEST['patient_id'] = $patient_id;

                        //curl
                        $post_params = array(
                            'message' => $_REQUEST['message'],
                            'phone_number12' => $_REQUEST['phone_number12'],
                            'patient_id' => $_REQUEST['patient_id'],
                            'email' => $_REQUEST['email'],
                            'post_id' => $_REQUEST['post_id']
                        );
                        $url = site_url().'/callfire_after_subscription';

                        $ch = curl_init($url);
                        curl_setopt ($ch, CURLOPT_POST, true);
                        curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_params);

                        curl_setopt ($ch, CURLOPT_TIMEOUT, 1);
                        curl_setopt ($ch, CURLOPT_NOSIGNAL, 1);
                        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
                        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);

                        curl_exec ($ch) ;
                        curl_close ($ch);
                    }
                }
            }
        }
}
else{
    $outmsg='no';
}
echo $outmsg;


