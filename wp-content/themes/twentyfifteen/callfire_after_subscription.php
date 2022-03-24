<?php
global $wpdb;
callfireTestLog('in callfire_after_subscription.php');
$email = $_REQUEST['email'];
$post_id = $_REQUEST['post_id'];
$message = $_REQUEST['message'];
$phone_number12 = $_REQUEST['phone_number12'];
$patient_id = $_REQUEST['patient_id'];
$numb = $phone_number12;
callfireTestLog($message);
callfireTestLog($phone_number12);
callfireTestLog($post_id);
callfireTestLog($email);



$wsdl = 'https://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl';
$client = new SoapClient($wsdl, array(
    'soap_version' => SOAP_1_2,
    'login'        => '41530ff4e2a8',
    'password'     => 'a44dd745a81cca3c'));


////////////////////////////voice//////////////////////////////////

$final_phone_number ="";
$post_content = get_post($post_id);
$title = $post_content->post_title;
$guid = $post_content->guid;
$slug = $post_content->post_name;
$phone_number = get_post_meta( $post_id, 'phone_number', true );
$name_of_site = get_post_meta( $post_id, 'name_of_site', true );
$custom_title_for_thank_you_page = get_post_meta( $post_id, 'custom_title_(for_thank_you_page)', true );
$website_url_thank_you_page = get_post_meta( $post_id, 'website_url_thank_you_page', true );
$study_full_address = get_post_meta( $post_id, 'study_full_address', true );


$post_ids = $post_id;
$callfire_time_zone= get_post_meta($post_ids, 'callfire_time_zone',true );
$study_no=get_post_meta($post_ids, 'study_no',true );
$callfire_category=get_post_meta($post_ids, 'callfire_category',true );
$callfire_cat=$callfire_category;

$category_real_name = '';
if ($callfire_cat !=""){
    $category_real_name = get_the_category_by_ID($callfire_cat);
}

if (!$category_real_name || !$study_no){
    $callfire_category = get_post_field('post_name', $post_ids);
}else{
    $callfire_category=$category_real_name.' '.'('.$study_no.')';
}
$callfire_contact=$numb;
//$callfire_name=$_REQUEST['name'];
/*category addition code*/

$allow_call = true;
switch($callfire_time_zone){
    case 1;
        $callfire_tz = 'EST';
        break;
    case 2;
        $callfire_tz = 'CST';
        break;
    case 3;
        $callfire_tz = 'MST';
        break;
    case 4;
        $callfire_tz = 'PST';
        break;
    default:
        $allow_call = false;
        break;
}
if ($allow_call){
    $from_date_tz = new DateTime('09:00:00', new DateTimeZone($callfire_tz));
    $to_date_tz = new DateTime('17:00:00', new DateTimeZone($callfire_tz));
    $cur_date_tz = new DateTime('now', new DateTimeZone($callfire_tz));
    if ($cur_date_tz > $from_date_tz && $cur_date_tz < $to_date_tz){
        $allow_call = true;
    }else{
        $allow_call = false;
    }
}

if ($phone_number12 == '6313335338' || $phone_number12 == '9174361610'){ //test numbers
    $allow_call = true;
}
//

callfireAddToContactList($post_ids, $numb);

callfireTestLog('CF after callfireAddToContactList' . $email);

/*category addition code*/
$greeting= get_post_meta($post_ids, 'greeting',true );
$closing_qualified= get_post_meta($post_ids, 'closing_qualified',true );
$closing_not_qualified= get_post_meta($post_ids, 'closing_not_qualified',true );
$from_number= get_post_meta($post_ids, 'from_number',true );
$question1= get_post_meta($post_ids, 'question_#1',true );
$question2= get_post_meta($post_ids, 'question_#2',true );
$question3= get_post_meta($post_ids, 'question_#3',true );
$question4= get_post_meta($post_ids, 'question_#4',true );
$question5= get_post_meta($post_ids, 'question_#5',true );
$question6= get_post_meta($post_ids, 'question_#6',true );
$question7= get_post_meta($post_ids, 'question_#7',true );
$question8= get_post_meta($post_ids, 'question_#8',true );
$question9= get_post_meta($post_ids, 'question_#9',true );
$question10= get_post_meta($post_ids, 'question_#10',true );
$question11= get_post_meta($post_ids, 'question_#11',true );
$question12= get_post_meta($post_ids, 'question_#12',true );
$question13= get_post_meta($post_ids, 'question_#13',true );
$question14= get_post_meta($post_ids, 'question_#14',true );
$question15= get_post_meta($post_ids, 'question_#15',true );
$question16= get_post_meta($post_ids, 'question_#16',true );
$question17= get_post_meta($post_ids, 'question_#17',true );
$question18= get_post_meta($post_ids, 'question_#18',true );
$question19= get_post_meta($post_ids, 'question_#19',true );
$question20= get_post_meta($post_ids, 'question_#20',true );
$question21= get_post_meta($post_ids, 'question_#21',true );
$question22= get_post_meta($post_ids, 'question_#22',true );
$question23= get_post_meta($post_ids, 'question_#23',true );
$question24= get_post_meta($post_ids, 'question_#24',true );
$question25= get_post_meta($post_ids, 'question_#25',true );
$question26= get_post_meta($post_ids, 'question_#26',true );
$question27= get_post_meta($post_ids, 'question_#27',true );
$question28= get_post_meta($post_ids, 'question_#28',true );
$question29= get_post_meta($post_ids, 'question_#29',true );
$question30= get_post_meta($post_ids, 'question_#30',true );
$number = get_post_meta($post_ids, 'redirect_number',true );
$q_no=1;
$questions_arr=array();
if($question1!="0" && $question1!="" ){
    $questions_arr[$q_no]=$question1;
    $q_no=$q_no+1;
}
if($question2!="0" && $question2!=""){
    $questions_arr[$q_no]=$question2;
    $q_no=$q_no+1;
}
if($question3!="0" && $question3!=""){
    $questions_arr[$q_no]=$question3;
    $q_no=$q_no+1;
}
if($question4!="0" && $question4!=""){
    $questions_arr[$q_no]=$question4;
    $q_no=$q_no+1;
}
if($question5!="0" && $question5!=""){
    $questions_arr[$q_no]=$question5;
    $q_no=$q_no+1;
}

if($question6!="0" && $question6!=""){
    $questions_arr[$q_no]=$question6;
    $q_no=$q_no+1;
}
if($question7!="0" && $question7!=""){
    $questions_arr[$q_no]=$question7;
    $q_no=$q_no+1;
}
if($question8!="0" && $question8!=""){
    $questions_arr[$q_no]=$question8;
    $q_no=$q_no+1;
}
if($question9!="0" && $question9!=""){
    $questions_arr[$q_no]=$question9;
    $q_no=$q_no+1;
}
if($question10!="0" && $question10!=""){
    $questions_arr[$q_no]=$question10;
    $q_no=$q_no+1;
}

if($question11!="0" && $question11!="" ){
    $questions_arr[$q_no]=$question11;
    $q_no=$q_no+1;
}
if($question12!="0" && $question12!=""){
    $questions_arr[$q_no]=$question12;
    $q_no=$q_no+1;
}
if($question13!="0" && $question13!=""){
    $questions_arr[$q_no]=$question13;
    $q_no=$q_no+1;
}
if($question14!="0" && $question14!=""){
    $questions_arr[$q_no]=$question14;
    $q_no=$q_no+1;
}
if($question15!="0" && $question15!=""){
    $questions_arr[$q_no]=$question15;
    $q_no=$q_no+1;
}

if($question16!="0" && $question16!=""){
    $questions_arr[$q_no]=$question16;
    $q_no=$q_no+1;
}
if($question17!="0" && $question17!=""){
    $questions_arr[$q_no]=$question17;
    $q_no=$q_no+1;
}
if($question18!="0" && $question18!=""){
    $questions_arr[$q_no]=$question18;
    $q_no=$q_no+1;
}
if($question19!="0" && $question19!=""){
    $questions_arr[$q_no]=$question19;
    $q_no=$q_no+1;
}
if($question20!="0" && $question20!=""){
    $questions_arr[$q_no]=$question20;
    $q_no=$q_no+1;
}

if($question21!="0" && $question21!=""){
    $questions_arr[$q_no]=$question21;
    $q_no=$q_no+1;
}
if($question22!="0" && $question22!=""){
    $questions_arr[$q_no]=$question22;
    $q_no=$q_no+1;
}
if($question23!="0" && $question23!=""){
    $questions_arr[$q_no]=$question23;
    $q_no=$q_no+1;
}
if($question24!="0" && $question24!=""){
    $questions_arr[$q_no]=$question24;
    $q_no=$q_no+1;
}
if($question25!="0" && $question25!=""){
    $questions_arr[$q_no]=$question25;
    $q_no=$q_no+1;
}
if($question26!="0" && $question26!=""){
    $questions_arr[$q_no]=$question26;
    $q_no=$q_no+1;
}
if($question27!="0" && $question27!=""){
    $questions_arr[$q_no]=$question27;
    $q_no=$q_no+1;
}
if($question28!="0" && $question28!=""){
    $questions_arr[$q_no]=$question28;
    $q_no=$q_no+1;
}
if($question29!="0" && $question29!=""){
    $questions_arr[$q_no]=$question29;
    $q_no=$q_no+1;
}
if($question30!="0" && $question30!=""){
    $questions_arr[$q_no]=$question30;
    $q_no=$q_no+1;
}

//echo '<pre>';
//print_r($questions_arr);

callfireTestLog('CF Gona call maybe ' . $email);
if($number!='' && $number!='0' && $from_number!='' && $from_number!='0'  && !empty($questions_arr)  && $allow_call /*&& isEnoughCredits($post_ids)*/){

callfireTestLog('CF Gona call surely1 ' . $email);

//if($number!='' && $number!='0' && !empty($questions_arr)){
    /*$wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
    $client = new SoapClient($wsdl, array(
        'soap_version' => SOAP_1_2,
        'login' => '41530ff4e2a8',
        'password' => 'a44dd745a81cca3c'));*/

// create IVR broadcast with questions
    $request = new stdclass();
    $request->Broadcast = new stdclass();
    $request->Broadcast->Name = 'IVR with Questions Broadcast';
    $request->Broadcast->Type = 'IVR';
    $request->Broadcast->IvrBroadcastConfig = new stdclass();
//$request->Broadcast->IvrBroadcastConfig->FromNumber = '7143884361';
    $request->Broadcast->IvrBroadcastConfig->FromNumber = $from_number;

    /*$request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction = new stdclass();
    $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '09:00:00';
    $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '17:00:00';*/

    /*$request->Broadcast->IvrBroadcastConfig->RetryConfig = new stdclass();
    $request->Broadcast->IvrBroadcastConfig->RetryConfig->MaxAttempts = 1;
    $request->Broadcast->IvrBroadcastConfig->RetryConfig->MinutesBetweenAttempts = 10;
    $request->Broadcast->IvrBroadcastConfig->RetryConfig->RetryResults = 'AM BUSY NO_ANS';*/

    if(true || !empty($questions_arr)){
        $cn_ques=count($questions_arr);
        $variable='<dialplan name="Root1">';
        /*$variable.='<amd>';
        $variable.='<live>';
        $variable.='<goto name="goto_Live">greetings</goto>';
        $variable.='</live>';
        $variable.='<machine>';
        $variable.='<hangup/>';
        $variable.='</machine>';
        $variable.='</amd>';*/
        if($greeting ==""){

            $variable.='<play type="callfireid" name="greetings">1715421003</play>';
            $greeting='1715421003';
        }
        else{

            $variable.='<play name="greetings" type="tts" voice="female2">
                 '.$greeting.'
                 </play>';
        }

        foreach($questions_arr as $in=> $qes){
            $next_key=$in+1;
            $nextqin="0".$next_key;
            $com_ques=$qes." Press 1 for Yes. Press 2 for No.";
            $qin="0".$in;
            $qname="Question_".$qin;
            $playqname="play_Question_".$qin;
            $key1_name="Q".$in."_KP1";
            $key2_name="Q".$in."_KP2";
            $stashkey1_name="stash_Q_".$qin."_1";
            $stashkey2_name="stash_Q_".$qin."_2";
            $stash_var="Q_".$qin;
            $gotonext_key1="goto_Question_".$nextqin."_1";
            $gotonext_key2="goto_Question_".$nextqin."_2";
            $gotonext_question="Question_".$nextqin;
            $bad_selection="bad_Selection_Question_".$qin;
            $play_bad_selection="play_bad_Selection_Question_".$qin;
            $replay_selection="replay_Question_".$qin;
            $timeout="Timeout_Question_".$qin;
            $play_timeout="play_timeout_Question_".$qin;

            $variable.='<menu maxDigits="1" name="'.$qname.'" timeout="5500">
      		<play name="'.$playqname.'" type="tts" voice="female2">
                 '.$com_ques.'
                 </play>
		<keypress name="'.$key1_name.'" pressed="1">
			<stash name="'.$stashkey1_name.'" varname="'.$stash_var.'">yes</stash>
                        <setvar varname="iscorrect">2</setvar>';
            if(isset($questions_arr[$next_key])){
                $variable.='<goto name="'.$gotonext_key1.'">'.$gotonext_question.'</goto>';
            }
            $variable.='</keypress>';
            $variable.='<keypress name="'.$key2_name.'" pressed="2">
			<stash name="'.$stashkey2_name.'" varname="'.$stash_var.'">no</stash>
			<setvar varname="incorrect">1</setvar>';
            if(isset($questions_arr[$next_key])){
                $variable.='<goto name="'.$gotonext_key2.'">'.$gotonext_question.'</goto>';
            }
            $variable.='</keypress>';
            $variable.='<keypress name="'.$bad_selection.'" pressed="default">
			<play name="'.$play_bad_selection.'" type="tts" voice="female2">That is not a valid selection. Please try again.</play>
			<goto name="'.$replay_selection.'">'.$qname.'</goto>
		</keypress>';
            $variable.='<keypress name="'.$timeout.'" pressed="timeout">
			<play name="'.$play_timeout.'" type="tts" voice="female2">Sorry you are having trouble Goodbye.</play>
			<hangup/>
		</keypress>';
            $variable.='</menu>';
        }

        $variable.='<if expr="${incorrect} ==1" name="checkWrong">';
        if($closing_not_qualified ==""){
            $variable.='<play type="callfireid">1715426003</play>';
            $closing_not_qualified='1715426003';
        }
        else{
            $variable.='<play name="feedback_msg" type="tts" voice="female2">'.$closing_not_qualified.'</play>';
        }
        if($from_number == $number){
            //$variable.='<transfer callerid="$'.$from_number.'" name="transferwrong">'.$number.'</transfer>';
            $variable.='<transfer callerid="${call.phonenumber}" name="transferwrong" whisper-tts="Hello, a patient is calling you from Study Kick, please say hello.">'.$number.'</transfer>';
        }
        else
        {
            $variable.='<transfer name="transferwrong" whisper-tts="Hello, a patient is calling you from Study Kick, please say hello.">'.$number.'</transfer>';
        }
        $variable.='</if>';
        $variable.='<if expr="${iscorrect} ==2" name="checkRight">';
        if($closing_qualified ==""){
            $variable.='<play type="callfireid">1715423003</play>';
            $closing_qualified='1715423003';
        }
        else{
            $variable.='<play name="success_msg" type="tts" voice="female2">'.$closing_qualified.'</play>';
        }
        if($from_number == $number){
            $variable.='<transfer callerid="${call.phonenumber}" name="transferright" whisper-tts="Hello, a patient is calling you from Study Kick, please say hello.">'.$number.'</transfer>';
        }
        else {
            $variable.='<transfer name="transferright" whisper-tts="Hello, a patient is calling you from Study Kick, please say hello.">'.$number.'</transfer>';
        }
        $variable.='</if></dialplan>';
//$request->Broadcast->IvrBroadcastConfig->DialplanXml = file_get_contents('ivr.xml');

        $request->Broadcast->IvrBroadcastConfig->DialplanXml = $variable;
//echo '<pre>';
//echo $variable;die;
        try{
            callfireTestLog('try CreateBroadcast');
            $broadcastId = $client->CreateBroadcast($request);
            mysql_query("INSERT INTO `0gf1ba_calldata`(`type`, is_read, study_id, patient_id, in_out, broadcast_id) VALUES ('2', 1, '$post_id', '$patient_id', 2, '$broadcastId')");
            /*addToCallfireCreditsPayments('call', 1, $broadcastId, $post_id);
            updateCallfireCredits($post_id, 1);*/
        }catch (Exception $e){
            callfireTestLog('error CreateBroadcast');
            callfireTestLog(serialize($e));
            sendErrorEmails($e->getMessage());
            createPostponedTask($_REQUEST);die;
        }
//echo "broadcast created, id: $broadcastId\n";

// add contacts to broadcast
        $request = new stdclass();
        $request->BroadcastId = $broadcastId; // required
        $request->Name = 'My Test API ContactBatch Numbers List';
        $request->ToNumber = array($numb); // required choice
        $request->ScrubBroadcastDuplicates = false;

        try{
            callfireTestLog('try CreateContactBatch');
            $contactBatchId = $client->CreateContactBatch($request);
        }catch (Exception $e){
            callfireTestLog('error CreateContactBatch');
            callfireTestLog(serialize($e));
            sendErrorEmails($e->getMessage());
            createPostponedTask($_REQUEST);die;
        }
//echo "contactBatch created, id: $contactBatchId\n";

// start broadcast
        $request = new stdclass();
        $request->Id = $broadcastId; // required
        $request->Command = 'START'; //   [START, STOP, ARCHIVE]
        $request->MaxActive = 1;
        try{
            callfireTestLog('try ControlBroadcast');
            $client->ControlBroadcast($request);
        }catch (Exception $e){
            callfireTestLog('error ControlBroadcast');
            callfireTestLog(serialize($e));
            sendErrorEmails($e->getMessage());
            createPostponedTask($_REQUEST);die;
        }
        global $wpdb;
//mysql_query("INSERT INTO `0gf1ba_subscriber_list`(`question_1`, `question_2`, `question_3`, `question_4`, `question_5`, `redirect_number`, `broadcast_id`,`answers_get`) VALUES ('$question1','$question2','$question3','$question4','$question5','$number','$broadcastId','2')");

        $result=mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$phone_number12' and email='$email' order by id desc limit 1");

        while($row = mysql_fetch_assoc($result)) {
            //print_r($row);
            $id=$row["id"];
        }
//echo "select id from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$phone_number12' and email='$email' and name='$name'";
//echo $question1,$question2,$question3,$question4,$question4,$question5,$number,$broadcastId;
//echo $id;
        $qry_str="";
        $qry_arr=array();
        foreach($questions_arr as $in=> $qest){
            $com_ques=$qest;
            $qry_str.="question_".$in."="."'.$qest.',";
        }

        mysql_query("UPDATE 0gf1ba_subscriber_list SET ".$qry_str."redirect_number='$number',broadcast_id='$broadcastId',answers_get='2',no_of_question='$cn_ques',from_number='$from_number',greeting='$greeting',closing_qualified='$closing_qualified',closing_not_qualified='$closing_not_qualified' WHERE id='$id'");
//echo "UPDATE 0gf1ba_subscriber_list SET question_1='$question1',question_2='$question2',question_3='$question3',question_4='$question4',question_5='$question5',redirect_number='$number',broadcast_id='$broadcastId',answers_get='2' WHERE id='$id'";

    }
}
else{
    if($number!='' && $number!='0' && $from_number!='' && $from_number!='0' && empty($questions_arr) && $allow_call /*&& isEnoughCredits($post_ids)*/){
        /*$wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
        $client = new SoapClient($wsdl, array(
            'soap_version' => SOAP_1_2,
            'login' => '41530ff4e2a8',
            'password' => 'a44dd745a81cca3c'));*/

        // create IVR broadcast with questions
        $request = new stdclass();
        $request->Broadcast = new stdclass();
        $request->Broadcast->Name = 'IVR with Questions Broadcast';
        $request->Broadcast->Type = 'IVR';

        $request->Broadcast->IvrBroadcastConfig = new stdclass();
        //$request->Broadcast->IvrBroadcastConfig->FromNumber = '7143884361';
        $request->Broadcast->IvrBroadcastConfig->FromNumber = $from_number;

        /*$request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction = new stdclass();
        $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '09:00:00';
        $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '17:00:00';*/

        /*$request->Broadcast->IvrBroadcastConfig->RetryConfig = new stdclass();
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->MaxAttempts = 1;
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->MinutesBetweenAttempts = 10;
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->RetryResults = 'AM BUSY NO_ANS';*/
        $variable='<dialplan name="Root">';
       /* $variable.='<amd>';
        $variable.='<live>';
        $variable.='<goto name="goto_Live">greetings</goto>';
        $variable.='</live>';
        $variable.='<machine>';
        $variable.='<hangup/>';
        $variable.='</machine>';
        $variable.='</amd>';*/
        $variable.='<play type="callfireid" name="greetings">1715427003</play>';
        if($from_number == $number){
            $variable.='<transfer callerid="${call.phonenumber}" name="transferdefault" whisper-tts="Hello, a patient is calling you from Study Kick, please say hello.">'.$number.'</transfer></dialplan>';
        }
        else{
            $variable.='<transfer name="transferdefault" whisper-tts="Hello, a patient is calling you from Study Kick, please say hello.">'.$number.'</transfer></dialplan>';
        }

        $request->Broadcast->IvrBroadcastConfig->DialplanXml = $variable;
//         echo '<pre>';
//         echo $variable;die;
        try{
            $broadcastId = $client->CreateBroadcast($request);
            mysql_query("INSERT INTO `0gf1ba_calldata`(`type`, is_read, study_id, patient_id, in_out, broadcast_id) VALUES ('2', 1, '$post_id', '$patient_id', 2, '$broadcastId')");
            /*addToCallfireCreditsPayments('call', 1, $broadcastId, $post_id);
            updateCallfireCredits($post_id, 1);*/
        }catch (Exception $e){
            callfireTestLog('error CreateBroadcast');
            callfireTestLog(serialize($e));
            sendErrorEmails($e->getMessage());
            createPostponedTask($_REQUEST);die;
        }
        //echo "broadcast created, id: $broadcastId\n";

        // add contacts to broadcast
        $request = new stdclass();
        $request->BroadcastId = $broadcastId; // required
        $request->Name = 'My Test API ContactBatch Numbers List';
        $request->ToNumber = array($numb); // required choice
        $request->ScrubBroadcastDuplicates = false;

        try{
            $contactBatchId = $client->CreateContactBatch($request);
        }catch (Exception $e){
            callfireTestLog('error CreateContactBatch');
            callfireTestLog(serialize($e));
            sendErrorEmails($e->getMessage());
            createPostponedTask($_REQUEST);die;
        }


        // start broadcast
        $request = new stdclass();
        $request->Id = $broadcastId; // required
        $request->Command = 'START'; //   [START, STOP, ARCHIVE]
        $request->MaxActive = 1;
        try{
            $client->ControlBroadcast($request);
        }catch (Exception $e){
            callfireTestLog('error ControlBroadcast');
            callfireTestLog(serialize($e));
            sendErrorEmails($e->getMessage());
            createPostponedTask($_REQUEST);die;
        }

        global $wpdb;
        //mysql_query("INSERT INTO `0gf1ba_subscriber_list`(`question_1`, `question_2`, `question_3`, `question_4`, `question_5`, `redirect_number`, `broadcast_id`,`answers_get`) VALUES ('$question1','$question2','$question3','$question4','$question5','$number','$broadcastId','2')");
        $result=mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$phone_number12' and email='$email' order by id desc limit 1");

        while($row = mysql_fetch_assoc($result)) {
            //print_r($row);
            $id=$row["id"];
        }
        mysql_query("UPDATE 0gf1ba_subscriber_list SET redirect_number='$number',broadcast_id='$broadcastId',answers_get='2',from_number='$from_number',is_default_callfire='1' WHERE id='$id'");
    }
}

////////////////////////////text//////////////////////////////////

$pur_num = get_post_meta($post_id, 'text_message_purchased_number', true );
if (!$pur_num){
    $pur_num = '67076';
}
if ($pur_num){
    $sendTextRequest = array(
        'BroadcastName' => 'Studykick Sms Broadcast',
        'ToNumber'      => $phone_number12,
        //'TextBroadcastConfig' => array('Message' => 'Thank you for signing up new !'));
        'TextBroadcastConfig' => array('Message' => $message, 'FromNumber'=> $pur_num));
    try {
        callfireTestLog('before send');
        $broadcastId = $client->sendText($sendTextRequest);
        $campaign = get_post_meta( $post_id, 'renewed', true );
        $current = date('Y-m-d H:i:s',strtotime('-7 hours'));
        $sql = "INSERT INTO 0gf1ba_calldata (id,message,sent_number,in_out,campaign,created,is_read,study_id,patient_id, broadcast_id, is_first) VALUES ('','$message','$phone_number12','2', '$campaign','$current','1', '$post_id', '$patient_id', '$broadcastId', 1)";
        $wpdb->query($sql);
        callfireTestLog('broadcast id = '.$broadcastId);
    }
    catch (Exception $e) {
        callfireTestLog('error sendText');
        $outmsg='problem to send the message.';
        callfireTestLog(serialize($e));
        sendErrorEmails($e->getMessage());
        createPostponedTask($_REQUEST);die;

    }
}


function createPostponedTask($request){
    $date = new DateTime('now', new DateTimeZone('UTC'));
    $start_date = new DateTime('now', new DateTimeZone('UTC'));
    $start_date->add(new DateInterval('PT10M'));
    $sql = 'INSERT INTO 0gf1ba_callfire_postponed_requests'
        .'(date, start_date, request, status) VALUES ('
        .' \''.mysql_real_escape_string($date->format('Y-m-d H:i:s')).'\', '
        .' \''.mysql_real_escape_string($start_date->format('Y-m-d H:i:s')).'\', '
        .' \''.mysql_real_escape_string(serialize($request)).'\', '
        .' \'created\' '
        .')';
    mysql_query($sql);
}

function sendErrorEmails($text){
    $emails = ['alexmanager1991@gmail.com', 'mo.tan@studykik.com', 'dnessonov@gmail.com'];
    $subject = 'Callfire error.';
    wp_mail( $emails, $subject, $text );
}