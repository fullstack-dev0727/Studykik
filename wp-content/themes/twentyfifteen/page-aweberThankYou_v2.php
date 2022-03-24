<?php
/**
  Template Name: Thank You Aweber WP Engine 2
 */
get_header();
?>
<?php //echo $newurl=get_permalink('32360');                 ?>
<?php //if($newurl=='studykik.com/louisv/'){                 ?>
<?php
//echo $_GET['post_id'];die;

if (!function_exists('_studykik_func_1')) {

    function _studykik_func_1($_custom_fields, $_key, $default = null) {
        if (isset($_custom_fields[$_key]) && isset($_custom_fields[$_key][0])) {
            return $_custom_fields[$_key][0];
        } else {
            return $default;
        }
    }

}

$_custom_fields = get_post_custom(isset($_GET['post_id']) ? $_GET['post_id'] : 0);
?>
<?php
if ($_GET['post_id'] == 32360) {
    ?>
    <style>
        #inner-page {
            border-top: 35px solid #9FCF67;
            float: left;
            padding: 20px 0;
            width: 100%;
        }
        /* Thank you css start*/
        .sign_up {
            float:left;
            width:100%;
            text-align: center;
        }
        .sign_up h3 {
            color:#28ade4;
            font-size:30px;
            text-align:center;
            margin: 5px 3px;
        }
        .sign_up h5 {
            color:#949ca1;
            font-size:24px;
            text-align:center;
            margin: 5px 3px;
        }
        .sign_up span {
            color:#f78e1e;
            font-size:28px;
            text-align:center;
        }
        .sign_up h2 {
            color: #9fcf67;
            font-size: 22px;
            margin: 5px 3px;
            text-align: center;
            text-transform: uppercase;
        }
    </style>
    <?php
    $str = $_REQUEST['custom_mobile_phone_number'];
    $noDigits = 0;
    $numb = "";
    for ($i = 0; $i < strlen($str); $i++) {
        if (is_numeric($str{$i})) {
            if ($noDigits == 0) {
                //if($str{$i}==0 || $str{$i}==1){
                if ($str{$i} == 1) {
                    
                } else {
                    $noDigits++;
                    $numb.=$str{$i};
                }
            } else {
                $noDigits++;
                $numb.=$str{$i};
                if ($noDigits == 10) {
                    break;
                }
            }
        }
    }
    $phone_number12 = $numb;
    $phone_number123 = $_REQUEST['custom_phone_number'];
    $final_phone_number = "";
    $email = $_REQUEST['email'];
//$name = $_REQUEST['uname'];
    $post_id = $_REQUEST['post_id'];
    $post_content = get_post($post_id);
    $title = $post_content->post_title;
    $guid = $post_content->guid;
    $slug = $post_content->post_name;
    $phone_number = get_post_meta($post_id, 'phone_number', true);
    $name_of_site = get_post_meta($post_id, 'name_of_site', true);
    $custom_title_for_thank_you_page = get_post_meta($post_id, 'custom_title_(for_thank_you_page)', true);
    $website_url_thank_you_page = get_post_meta($post_id, 'website_url_thank_you_page', true);
    $study_full_address = get_post_meta($post_id, 'study_full_address', true);
    ?>

    <div id="inner-page">
        <div class="container">
            <div class="sign_up">
                <?php //echo $body;  ?>
                <!--      <h3></h3>-->
                <h5>Thank you for entering the StudyKIK "Site Solutions Summit Sweepstakes"!<br/> One more step, check your email and share the link!</h5>

                                                                    <!--      <h2><?php //echo $name_of_site;                  ?></h2>-->
                                                                    <!--      <span><?php //echo $phone_number;                  ?></span> <br/>-->
                <!--      <h5>Here is the study location:</h5>-->
                <!--      <h2><?php //echo $study_full_address;                  ?></h2>-->
                <br/>
                <?php if ($website_url_thank_you_page) { ?>
                                                                              <!--      <h5>For more information about this study: <a href="<?php echo $website_url_thank_you_page; ?>">CLICK HERE</a></h5>-->
                <?php } ?>
                <!--      <h5>Looking forward to having you join.</h5>-->

                <br/>
                <img style="margin-top: 20px; width: 100%;" src="<?php bloginfo('template_url'); ?>/images/sign_up.png" alt="" /> </div>
        </div>
        <!-- #content -->

    </div>
    <!-- #primary -->

    <?php
    $post_ids = $post_id;
    $study_no = get_post_meta($post_ids, 'study_no', true);
    $callfire_category = get_post_meta($post_ids, 'callfire_category', true);
    $callfire_cat = $callfire_category;
    $callfire_category = $callfire_category . ' ' . '(' . $study_no . ')';
    $callfire_contact = $numb;
//$callfire_name=$_REQUEST['uname'];
    /* category addition code */
    if ($callfire_category != '' && $callfire_contact != '' && $callfire_cat != "" && $callfire_cat != "0" && $study_no != '') {
        $wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
        $client = new SoapClient($wsdl, array(
            'soap_version' => SOAP_1_2,
            'login' => '41530ff4e2a8',
            'password' => 'a44dd745a81cca3c'));
        $contact_no = $callfire_contact;
        $query = new stdclass();
        $query->MaxResults = 10000; // long
        $query->FirstResult = 0; // long
        $response = $client->QueryContactLists($query);
//echo "<pre>";
        $response = json_decode(json_encode($response), true);
//echo "<pre>";
//print_r($response);
//echo "</pre>";
//$category_name="keshuuu";
        $category_name = $callfire_category;
        $list_arr = array();
        if (isset($response['ContactList'][0])) {
            foreach ($response['ContactList'] as $cnt) {
                if ($cnt['Name'] == $category_name) {
                    $list_arr = $cnt;
                    break;
                }
            }
        } else {
            if (isset($response['ContactList']['id'])) {
                $ct_data = $response['ContactList'];
                $response['ContactList'] = array();
                $response['ContactList'][0] = $ct_data;
                foreach ($response['ContactList'] as $cnt) {
                    if ($cnt['Name'] == $category_name) {
                        $list_arr = $cnt;
                        break;
                    }
                }
            }
        }
        if (empty($list_arr)) {
            $result_cat = mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$phone_number12' and email='$email' order by id desc limit 1");

            while ($row = mysql_fetch_assoc($result_cat)) {
                //print_r($row);
                $id = $row["id"];
                $fname = $row["name"];
            }
            $request = new stdClass();
            $request->Name = $category_name; // string required
            $request->Validate = false;
            $request->ContactSource = new stdclass(); //  required
            $request->ContactSource->Contact = array(); //required choice
            $request->ContactSource->Contact[0] = new stdClass(); // object
            //$request->ContactSource->Contact[0]->firstName = 'kamala1'; // string
            $request->ContactSource->Contact[0]->firstName = $fname; // string
            $request->ContactSource->Contact[0]->lastName = ''; // string
            $request->ContactSource->Contact[0]->mobilePhone = $callfire_contact; // PhoneNumber
            $response = $client->CreateContactList($request);
        } else {
            //print_r($list_arr);
            $list_id = $list_arr['id'];
            $query = new stdclass();
            $query->MaxResults = 1000; // long
            $query->FirstResult = 0; // long
            $query->Field = 'mobilePhone'; // long
            $query->ContactListId = $list_id; // long
            $query->String = $contact_no; // long
            $response = $client->QueryContacts($query);
            $response = json_decode(json_encode($response), true);
            // print_r($response);
            $is_exist = 0;
            if (isset($response['TotalResults'])) {
                if ($response['TotalResults'] > 0) {
                    $is_exist = 1;
                }
            }
            if ($is_exist == 0) {
                //    echo "hii";
                $result_cat = mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$phone_number12' and email='$email' order by id desc limit 1");

                while ($row = mysql_fetch_assoc($result_cat)) {
                    //print_r($row);
                    $id = $row["id"];
                    $fname = $row["name"];
                }
                $request = new stdClass();
                $request->ContactListId = $list_id; // long required
                $request->ContactSource = new stdClass(); // required
                $request->ContactSource->Contact = array();
                //$request->ContactSource->Contact[0]['firstName'] = "roshan";
                $request->ContactSource->Contact[0]['firstName'] = $fname;
                $request->ContactSource->Contact[0]['lastName'] = "";
                $request->ContactSource->Contact[0]['mobilePhone'] = $contact_no;
                $client->AddContactsToList($request);
            }
        }

        mysql_query("UPDATE 0gf1ba_subscriber_list SET callfire_category='$callfire_category' WHERE id='$id'");
    }
    /* category addition code */
    $callfire_time_zone = get_post_meta($post_ids, 'callfire_time_zone', true);
    $greeting = get_post_meta($post_ids, 'greeting', true);
    $closing_qualified = get_post_meta($post_ids, 'closing_qualified', true);
    $closing_not_qualified = get_post_meta($post_ids, 'closing_not_qualified', true);
    $from_number = get_post_meta($post_ids, 'from_number', true);
    $question1 = get_post_meta($post_ids, 'question_#1', true);
    $question2 = get_post_meta($post_ids, 'question_#2', true);
    $question3 = get_post_meta($post_ids, 'question_#3', true);
    $question4 = get_post_meta($post_ids, 'question_#4', true);
    $question5 = get_post_meta($post_ids, 'question_#5', true);
    $question6 = get_post_meta($post_ids, 'question_#6', true);
    $question7 = get_post_meta($post_ids, 'question_#7', true);
    $question8 = get_post_meta($post_ids, 'question_#8', true);
    $question9 = get_post_meta($post_ids, 'question_#9', true);
    $question10 = get_post_meta($post_ids, 'question_#10', true);
    $question11 = get_post_meta($post_ids, 'question_#11', true);
    $question12 = get_post_meta($post_ids, 'question_#12', true);
    $question13 = get_post_meta($post_ids, 'question_#13', true);
    $question14 = get_post_meta($post_ids, 'question_#14', true);
    $question15 = get_post_meta($post_ids, 'question_#15', true);
    $question16 = get_post_meta($post_ids, 'question_#16', true);
    $question17 = get_post_meta($post_ids, 'question_#17', true);
    $question18 = get_post_meta($post_ids, 'question_#18', true);
    $question19 = get_post_meta($post_ids, 'question_#19', true);
    $question20 = get_post_meta($post_ids, 'question_#20', true);
    $question21 = get_post_meta($post_ids, 'question_#21', true);
    $question22 = get_post_meta($post_ids, 'question_#22', true);
    $question23 = get_post_meta($post_ids, 'question_#23', true);
    $question24 = get_post_meta($post_ids, 'question_#24', true);
    $question25 = get_post_meta($post_ids, 'question_#25', true);
    $question26 = get_post_meta($post_ids, 'question_#26', true);
    $question27 = get_post_meta($post_ids, 'question_#27', true);
    $question28 = get_post_meta($post_ids, 'question_#28', true);
    $question29 = get_post_meta($post_ids, 'question_#29', true);
    $question30 = get_post_meta($post_ids, 'question_#30', true);
    $number = get_post_meta($post_ids, 'redirect_number', true);
    $q_no = 1;
    $questions_arr = array();
    if ($question1 != "0" && $question1 != "") {
        $questions_arr[$q_no] = $question1;
        $q_no = $q_no + 1;
    }
    if ($question2 != "0" && $question2 != "") {
        $questions_arr[$q_no] = $question2;
        $q_no = $q_no + 1;
    }
    if ($question3 != "0" && $question3 != "") {
        $questions_arr[$q_no] = $question3;
        $q_no = $q_no + 1;
    }
    if ($question4 != "0" && $question4 != "") {
        $questions_arr[$q_no] = $question4;
        $q_no = $q_no + 1;
    }
    if ($question5 != "0" && $question5 != "") {
        $questions_arr[$q_no] = $question5;
        $q_no = $q_no + 1;
    }

    if ($question6 != "0" && $question6 != "") {
        $questions_arr[$q_no] = $question6;
        $q_no = $q_no + 1;
    }
    if ($question7 != "0" && $question7 != "") {
        $questions_arr[$q_no] = $question7;
        $q_no = $q_no + 1;
    }
    if ($question8 != "0" && $question8 != "") {
        $questions_arr[$q_no] = $question8;
        $q_no = $q_no + 1;
    }
    if ($question9 != "0" && $question9 != "") {
        $questions_arr[$q_no] = $question9;
        $q_no = $q_no + 1;
    }
    if ($question10 != "0" && $question10 != "") {
        $questions_arr[$q_no] = $question10;
        $q_no = $q_no + 1;
    }

    if ($question11 != "0" && $question11 != "") {
        $questions_arr[$q_no] = $question11;
        $q_no = $q_no + 1;
    }
    if ($question12 != "0" && $question12 != "") {
        $questions_arr[$q_no] = $question12;
        $q_no = $q_no + 1;
    }
    if ($question13 != "0" && $question13 != "") {
        $questions_arr[$q_no] = $question13;
        $q_no = $q_no + 1;
    }
    if ($question14 != "0" && $question14 != "") {
        $questions_arr[$q_no] = $question14;
        $q_no = $q_no + 1;
    }
    if ($question15 != "0" && $question15 != "") {
        $questions_arr[$q_no] = $question15;
        $q_no = $q_no + 1;
    }

    if ($question16 != "0" && $question16 != "") {
        $questions_arr[$q_no] = $question16;
        $q_no = $q_no + 1;
    }
    if ($question17 != "0" && $question17 != "") {
        $questions_arr[$q_no] = $question17;
        $q_no = $q_no + 1;
    }
    if ($question18 != "0" && $question18 != "") {
        $questions_arr[$q_no] = $question18;
        $q_no = $q_no + 1;
    }
    if ($question19 != "0" && $question19 != "") {
        $questions_arr[$q_no] = $question19;
        $q_no = $q_no + 1;
    }
    if ($question20 != "0" && $question20 != "") {
        $questions_arr[$q_no] = $question20;
        $q_no = $q_no + 1;
    }

    if ($question21 != "0" && $question21 != "") {
        $questions_arr[$q_no] = $question21;
        $q_no = $q_no + 1;
    }
    if ($question22 != "0" && $question22 != "") {
        $questions_arr[$q_no] = $question22;
        $q_no = $q_no + 1;
    }
    if ($question23 != "0" && $question23 != "") {
        $questions_arr[$q_no] = $question23;
        $q_no = $q_no + 1;
    }
    if ($question24 != "0" && $question24 != "") {
        $questions_arr[$q_no] = $question24;
        $q_no = $q_no + 1;
    }
    if ($question25 != "0" && $question25 != "") {
        $questions_arr[$q_no] = $question25;
        $q_no = $q_no + 1;
    }
    if ($question26 != "0" && $question26 != "") {
        $questions_arr[$q_no] = $question26;
        $q_no = $q_no + 1;
    }
    if ($question27 != "0" && $question27 != "") {
        $questions_arr[$q_no] = $question27;
        $q_no = $q_no + 1;
    }
    if ($question28 != "0" && $question28 != "") {
        $questions_arr[$q_no] = $question28;
        $q_no = $q_no + 1;
    }
    if ($question29 != "0" && $question29 != "") {
        $questions_arr[$q_no] = $question29;
        $q_no = $q_no + 1;
    }
    if ($question30 != "0" && $question30 != "") {
        $questions_arr[$q_no] = $question30;
        $q_no = $q_no + 1;
    }
//echo '<pre>';
//print_r($questions_arr);
    if ($number != '' && $number != '0' && $from_number != '' && $from_number != '0' && !empty($questions_arr)) {
//if($number!='' && $number!='0' && !empty($questions_arr)){
        $wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
        $client = new SoapClient($wsdl, array(
            'soap_version' => SOAP_1_2,
            'login' => '41530ff4e2a8',
            'password' => 'a44dd745a81cca3c'));

// create IVR broadcast with questions
        $request = new stdclass();
        $request->Broadcast = new stdclass();
        $request->Broadcast->Name = 'IVR with Questions Broadcast';
        $request->Broadcast->Type = 'IVR';
        $request->Broadcast->IvrBroadcastConfig = new stdclass();
//$request->Broadcast->IvrBroadcastConfig->FromNumber = '7143884361';
        $request->Broadcast->IvrBroadcastConfig->FromNumber = $from_number;
        $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction = new stdclass();
        if ($callfire_time_zone == 1) {
            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '07:00:00';
            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '15:00:00';
        }
        if ($callfire_time_zone == 2) {

            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '08:00:00';
            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '16:00:00';
        }
        if ($callfire_time_zone == 3) {

            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '09:00:00';
            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '17:00:00';
        }
        if ($callfire_time_zone == 4) {

            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '10:00:00';
            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '18:00:00';
        }
        $request->Broadcast->IvrBroadcastConfig->RetryConfig = new stdclass();
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->MaxAttempts = 2;
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->MinutesBetweenAttempts = 10;
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->RetryResults = 'AM BUSY NO_ANS';

        if (!empty($questions_arr)) {
            $cn_ques = count($questions_arr);
            $variable = '<dialplan name="Root1">';
            $variable.='<amd>';
            $variable.='<live>';
            $variable.='<goto name="goto_Live">greetings</goto>';
            $variable.='</live>';
            $variable.='<machine>';
            $variable.='<hangup/>';
            $variable.='</machine>';
            $variable.='</amd>';
            if ($greeting == "") {

                $variable.='<play type="callfireid" name="greetings">1715421003</play>';
                $greeting = '1715421003';
            } else {

                $variable.='<play name="greetings" type="tts" voice="female2">
                 ' . $greeting . '
                 </play>';
            }

            foreach ($questions_arr as $in => $qes) {
                $next_key = $in + 1;
                $nextqin = "0" . $next_key;
                $com_ques = $qes . " Press 1 for Yes. Press 2 for No.";
                $qin = "0" . $in;
                $qname = "Question_" . $qin;
                $playqname = "play_Question_" . $qin;
                $key1_name = "Q" . $in . "_KP1";
                $key2_name = "Q" . $in . "_KP2";
                $stashkey1_name = "stash_Q_" . $qin . "_1";
                $stashkey2_name = "stash_Q_" . $qin . "_2";
                $stash_var = "Q_" . $qin;
                $gotonext_key1 = "goto_Question_" . $nextqin . "_1";
                $gotonext_key2 = "goto_Question_" . $nextqin . "_2";
                $gotonext_question = "Question_" . $nextqin;
                $bad_selection = "bad_Selection_Question_" . $qin;
                $play_bad_selection = "play_bad_Selection_Question_" . $qin;
                $replay_selection = "replay_Question_" . $qin;
                $timeout = "Timeout_Question_" . $qin;
                $play_timeout = "play_timeout_Question_" . $qin;

                $variable.='<menu maxDigits="1" name="' . $qname . '" timeout="5500">
      		<play name="' . $playqname . '" type="tts" voice="female2">
                 ' . $com_ques . '
                 </play>
		<keypress name="' . $key1_name . '" pressed="1">
			<stash name="' . $stashkey1_name . '" varname="' . $stash_var . '">yes</stash>
                        <setvar varname="iscorrect">2</setvar>';
                if (isset($questions_arr[$next_key])) {
                    $variable.='<goto name="' . $gotonext_key1 . '">' . $gotonext_question . '</goto>';
                }
                $variable.='</keypress>';
                $variable.='<keypress name="' . $key2_name . '" pressed="2">
			<stash name="' . $stashkey2_name . '" varname="' . $stash_var . '">no</stash>
			<setvar varname="incorrect">1</setvar>';
                if (isset($questions_arr[$next_key])) {
                    $variable.='<goto name="' . $gotonext_key2 . '">' . $gotonext_question . '</goto>';
                }
                $variable.='</keypress>';
                $variable.='<keypress name="' . $bad_selection . '" pressed="default">
			<play name="' . $play_bad_selection . '" type="tts" voice="female2">That is not a valid selection. Please try again.</play>
			<goto name="' . $replay_selection . '">' . $qname . '</goto>
		</keypress>';
                $variable.='<keypress name="' . $timeout . '" pressed="timeout">
			<play name="' . $play_timeout . '" type="tts" voice="female2">Sorry you are having trouble Goodbye.</play>
			<hangup/>
		</keypress>';
                $variable.='</menu>';
            }

            $variable.='<if expr="${incorrect} ==1" name="checkWrong">';
            if ($closing_not_qualified == "") {
                $variable.='<play type="callfireid">1715426003</play>';
                $closing_not_qualified = '1715426003';
            } else {
                $variable.='<play name="feedback_msg" type="tts" voice="female2">' . $closing_not_qualified . '</play>';
            }
            if ($from_number == $number) {
                //$variable.='<transfer callerid="$'.$from_number.'" name="transferwrong">'.$number.'</transfer>';
                $variable.='<transfer callerid="${call.phonenumber}" name="transferwrong" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">' . $number . '</transfer>';
            } else {
                $variable.='<transfer name="transferwrong" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">' . $number . '</transfer>';
            }
            $variable.='</if>';
            $variable.='<if expr="${iscorrect} ==2" name="checkRight">';
            if ($closing_qualified == "") {
                $variable.='<play type="callfireid">1715423003</play>';
                $closing_qualified = '1715423003';
            } else {
                $variable.='<play name="success_msg" type="tts" voice="female2">' . $closing_qualified . '</play>';
            }
            if ($from_number == $number) {
                $variable.='<transfer callerid="${call.phonenumber}" name="transferright" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">' . $number . '</transfer>';
            } else {
                $variable.='<transfer name="transferright" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">' . $number . '</transfer>';
            }
            $variable.='</if></dialplan>';
//$request->Broadcast->IvrBroadcastConfig->DialplanXml = file_get_contents('ivr.xml');

            $request->Broadcast->IvrBroadcastConfig->DialplanXml = $variable;
//echo '<pre>';
//echo $variable;die;
            $broadcastId = $client->CreateBroadcast($request);
//echo "broadcast created, id: $broadcastId\n";
// add contacts to broadcast
            $request = new stdclass();
            $request->BroadcastId = $broadcastId; // required
            $request->Name = 'My Test API ContactBatch Numbers List';
            $request->ToNumber = array($numb); // required choice
            $request->ScrubBroadcastDuplicates = false;

            $contactBatchId = $client->CreateContactBatch($request);
//echo "contactBatch created, id: $contactBatchId\n";
// start broadcast
            $request = new stdclass();
            $request->Id = $broadcastId; // required
            $request->Command = 'START'; //   [START, STOP, ARCHIVE]
            $request->MaxActive = 10;
            $client->ControlBroadcast($request);
            global $wpdb;
//mysql_query("INSERT INTO `0gf1ba_subscriber_list`(`question_1`, `question_2`, `question_3`, `question_4`, `question_5`, `redirect_number`, `broadcast_id`,`answers_get`) VALUES ('$question1','$question2','$question3','$question4','$question5','$number','$broadcastId','2')");

            $result = mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$phone_number12' and email='$email' order by id desc limit 1");

            while ($row = mysql_fetch_assoc($result)) {
                //print_r($row);
                $id = $row["id"];
            }
//echo "select id from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$phone_number12' and email='$email' and name='$name'";
//echo $question1,$question2,$question3,$question4,$question4,$question5,$number,$broadcastId;
//echo $id;
            $qry_str = "";
            $qry_arr = array();
            foreach ($questions_arr as $in => $qest) {
                $com_ques = $qest;
                $qry_str.="question_" . $in . "=" . "'.$qest.',";
            }

            mysql_query("UPDATE 0gf1ba_subscriber_list SET " . $qry_str . "redirect_number='$number',broadcast_id='$broadcastId',answers_get='2',no_of_question='$cn_ques',from_number='$from_number',greeting='$greeting',closing_qualified='$closing_qualified',closing_not_qualified='$closing_not_qualified' WHERE id='$id'");
//echo "UPDATE 0gf1ba_subscriber_list SET question_1='$question1',question_2='$question2',question_3='$question3',question_4='$question4',question_5='$question5',redirect_number='$number',broadcast_id='$broadcastId',answers_get='2' WHERE id='$id'";
        }
    } else {
        if ($number != '' && $number != '0' && $from_number != '' && $from_number != '0' && empty($questions_arr)) {
            $wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
            $client = new SoapClient($wsdl, array(
                'soap_version' => SOAP_1_2,
                'login' => '41530ff4e2a8',
                'password' => 'a44dd745a81cca3c'));

            // create IVR broadcast with questions
            $request = new stdclass();
            $request->Broadcast = new stdclass();
            $request->Broadcast->Name = 'IVR with Questions Broadcast';
            $request->Broadcast->Type = 'IVR';

            $request->Broadcast->IvrBroadcastConfig = new stdclass();
            //$request->Broadcast->IvrBroadcastConfig->FromNumber = '7143884361';
            $request->Broadcast->IvrBroadcastConfig->FromNumber = $from_number;
            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction = new stdclass();
            if ($callfire_time_zone == 1) {
                $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '07:00:00';
                $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '15:00:00';
            }
            if ($callfire_time_zone == 2) {

                $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '08:00:00';
                $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '16:00:00';
            }
            if ($callfire_time_zone == 3) {

                $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '09:00:00';
                $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '17:00:00';
            }
            if ($callfire_time_zone == 4) {

                $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '10:00:00';
                $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '18:00:00';
            }
            $request->Broadcast->IvrBroadcastConfig->RetryConfig = new stdclass();
            $request->Broadcast->IvrBroadcastConfig->RetryConfig->MaxAttempts = 2;
            $request->Broadcast->IvrBroadcastConfig->RetryConfig->MinutesBetweenAttempts = 10;
            $request->Broadcast->IvrBroadcastConfig->RetryConfig->RetryResults = 'AM BUSY NO_ANS';
            $variable = '<dialplan name="Root">';
            $variable.='<amd>';
            $variable.='<live>';
            $variable.='<goto name="goto_Live">greetings</goto>';
            $variable.='</live>';
            $variable.='<machine>';
            $variable.='<hangup/>';
            $variable.='</machine>';
            $variable.='</amd>';

            $variable.='<play type="callfireid" name="greetings">1715427003</play>';
            if ($from_number == $number) {
                $variable.='<transfer callerid="${call.phonenumber}" name="transferdefault" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">' . $number . '</transfer></dialplan>';
            } else {
                $variable.='<transfer name="transferdefault" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">' . $number . '</transfer></dialplan>';
            }

            $request->Broadcast->IvrBroadcastConfig->DialplanXml = $variable;
//         echo '<pre>';
//         echo $variable;die;
            $broadcastId = $client->CreateBroadcast($request);
            //echo "broadcast created, id: $broadcastId\n";
            // add contacts to broadcast
            $request = new stdclass();
            $request->BroadcastId = $broadcastId; // required
            $request->Name = 'My Test API ContactBatch Numbers List';
            $request->ToNumber = array($numb); // required choice
            $request->ScrubBroadcastDuplicates = false;

            $contactBatchId = $client->CreateContactBatch($request);

            // start broadcast
            $request = new stdclass();
            $request->Id = $broadcastId; // required
            $request->Command = 'START'; //   [START, STOP, ARCHIVE]
            $request->MaxActive = 10;
            $client->ControlBroadcast($request);
            global $wpdb;
            //mysql_query("INSERT INTO `0gf1ba_subscriber_list`(`question_1`, `question_2`, `question_3`, `question_4`, `question_5`, `redirect_number`, `broadcast_id`,`answers_get`) VALUES ('$question1','$question2','$question3','$question4','$question5','$number','$broadcastId','2')");
            $result = mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$phone_number12' and email='$email' order by id desc limit 1");

            while ($row = mysql_fetch_assoc($result)) {
                //print_r($row);
                $id = $row["id"];
            }
            mysql_query("UPDATE 0gf1ba_subscriber_list SET redirect_number='$number',broadcast_id='$broadcastId',answers_get='2',from_number='$from_number',is_default_callfire='1' WHERE id='$id'");
        }
    }
    ?>
    <?php get_footer(); ?>
    <?php
} else {
    ?>
    <style>
        #inner-page {
            border-top: 35px solid #9FCF67;
            float: left;
            padding: 20px 0;
            width: 100%;
            height: 950px;
            font-size: 24px;
        }
        /* Thank you css start*/

        .apptform {
            visibility: visible;
            position: absolute;
            top: 155px;
            width: 800px;
        }

        .thankyou {
            visibility: hidden;
            background-color: white;
            position: absolute;
            top: 120px;
            width: 800px;
        }

        .sign_up {
            float:left;
            width:100%;
            text-align: center;
        }
        .sign_up h3 {
            color:#28ade4;
            font-size:30px;
            text-align:center;
            margin: 5px 3px;
        }
        .sign_up h5 {
            color:#949ca1;
            font-size:24px;
            text-align:center;
            margin: 5px 3px;
        }
        .sign_up span {
            color:#f78e1e;
            font-size:28px;
            text-align:center;
        }
        .sign_up h2 {
            color: #9fcf67;
            font-size: 22px;
            margin: 5px 3px;
            text-align: center;
            text-transform: uppercase;
        }
    </style>
    <?php
    $str = $_REQUEST['custom_mobile_phone_number'];
    $noDigits = 0;
    $numb = "";
    for ($i = 0; $i < strlen($str); $i++) {
        if (is_numeric($str{$i})) {
            if ($noDigits == 0) {
                //if($str{$i}==0 || $str{$i}==1){
                if ($str{$i} == 1) {
                    
                } else {
                    $noDigits++;
                    $numb.=$str{$i};
                }
            } else {
                $noDigits++;
                $numb.=$str{$i};
                if ($noDigits == 10) {
                    break;
                }
            }
        }
    }
    $phone_number12 = $numb;
    $phone_number_pat = $_REQUEST['custom_mobile_phone_number'];
    $final_phone_number = "";
    $email = $_REQUEST['email'];
    $name = explode(" ", $_REQUEST['uname']);
    $first_name = $name[0];
    $last_name = $name[1];


    $post_id = $_REQUEST['post_id'];
    $post_content = get_post($post_id);
    $title = $post_content->post_title;
    $guid = $post_content->guid;
    $slug = $post_content->post_name;

    $phone_number = get_post_meta($post_id, 'phone_number', true);
    $name_of_site = get_post_meta($post_id, 'name_of_site', true);
    $custom_title_for_thank_you_page = get_post_meta($post_id, 'custom_title_(for_thank_you_page)', true);
    $website_url_thank_you_page = get_post_meta($post_id, 'website_url_thank_you_page', true);
    $study_full_address = get_post_meta($post_id, 'study_full_address', true);
    ?>
    <?php
    ?>
    <div id="inner-page">
        <div class="container">
            <div class="sign_up">
                <?php //echo $body;   ?>

                <?php if ($post_id == 35477) {
                    ?>

                <?php } else { ?>
                    <!--CNS HEALTHCARE CODE-->


                    <?php
                    $src_id = get_post_meta($post_id, '4_digit_code', true); // digit code for advertising tracking. This will link up the appointment with the media event on our systems


                    $url = 'http://www.cnshealthcare.com/API/index.php?rreq=ad_info-' . $src_id;
                    $xml = simplexml_load_file($url) or die("error loading");
                    $location = $xml->site_wid;
                    $site_id = $xml->site_id;

                    $subdomain = "http://www.studykik.com"; // digit code for advertising tracking. This will link up the appointment with the media event on our systems
                    $version = "A"; //for A/B testing. Specify which version did this appointment come from.
                    $interest = $xml->indication; //diagnosis information.

                    $url = 'http://www.cnshealthcare.com/API/index.php?rreq=days_off_array-' . $site_id;
                    $xml = simplexml_load_file($url) or die("error loading");

                    $holidays = array();


                    foreach ($xml->DayOff as $item) {
                        $device = array();
                        foreach ($item as $key => $value) {
                            $date_raw = explode("-", (string) $value);
                            $date_stripped = $date_raw[1] . "-" . $date_raw[2];
                            $holidays[] = $date_stripped;
                        }
                    }

                    /**
                     * DO NOT MESS WITH ANYTHING BELOW THIS LINE!
                     */
                    ?> 
                    <script type="text/javascript">
                        function init() {
                            document.getElementById("appt_time").style.visibility = 'hidden';
                        }

                        function submitform() {
                            var fail = 0;
                            var src_id = escape(document.getElementById("src_id").value);
                            var ref_domain = escape(document.getElementById("ref_domain").value);
                            var interest = escape(document.getElementById("interest").value);
                            var site = escape(document.getElementById("site_id").value);
                            var version = escape(document.getElementById("version").value);
                            var application_auth = escape(document.getElementById("application_auth").value);
                            var first_name = escape(document.getElementById("firstName").value);
                            var last_name = escape(document.getElementById("lastName").value);
                            var email = escape(document.getElementById("email").value);
                            var phone = escape(document.getElementById("phone").value);
                            var appt_date = escape(document.getElementById("appt_date").value);
                            var appt_time = escape(document.getElementById("appt_time").value);

                            if (appt_date === "") {
                                document.getElementById("appt_date").style.backgroundcolor = "pink";
                                fail = 1;
                            }

                            if (appt_time === "") {
                                document.getElementById("appt_time").style.backgroundcolor = "pink";
                                fail = 1;
                            }

                            if (fail < 1) {
                                var params = "src_id=" + src_id + "&ref_domain=" + ref_domain + "&interest=" + interest + "&version=" + version + "&application_auth=" + application_auth + "&first_name=" + first_name + "&last_name=" + last_name + "&email=" + email + "&phone=" + phone + "&appt_date=" + appt_date + "&appt_time=" + appt_time + "&site=" + site;

                                var http = new XMLHttpRequest();
                                var url = "https://www.cnshealthcare.com/API/process.php";
                                http.open("POST", url, true);

                                //Send the proper header information along with the request
                                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                http.setRequestHeader("Content-length", params.length);
                                http.setRequestHeader("Connection", "close");

                                http.onreadystatechange = function () {//Call a function when the state changes.

                                    if (http.readyState === 4) {

                                        //GOOD RESPONSE                           
                                        // window.location = "thank_you.php";

                                        document.getElementById("apptform").style.visibility = 'hidden';
                                        document.getElementById("appt_date").style.visibility = 'hidden';
                                        document.getElementById("thankyou").style.visibility = 'visible';


                                    } else {
                                        //BAD RESPONSE       
                                        //  alert(http.responseText);
                                    }

                                };
                                http.send(params);
                            } else {
                                alert("Sorry, some of your information couldn't be verified. Please check the information entered.");
                            }
                            ;
                        }
                        ;

                        function removeOptions(selectbox)
                        {
                            var i;
                            for (i = selectbox.options.length - 1; i >= 0; i--)
                            {
                                selectbox.remove(i);
                            }
                        }


                        function setTime() {
                            removeOptions(document.getElementById("appt_time"));
                            var week_times = ["8:00 AM", "8:15 AM", "8:30 AM", "8:45 AM", "9:00 AM", "9:15 AM", "9:30 AM", "9:45 AM", "10:00 AM", "10:15 AM", "10:30 AM", "10:45 AM", "11:00 AM", "11:15 AM", "11:30 AM", "1:00 PM", "1:15 PM", "1:30 PM", "1:45 PM", "2:00 PM", "2:15 PM", "2:30 PM", "2:45 PM", "3:00 PM", "3:15 PM", "3:30 PM", "3:45 PM", "4:00 PM", "4:15 PM"];
                            var fri_times = ["8:00 AM", "8:15 AM", "8:30 AM", "8:45 AM", "9:00 AM", "9:15 AM", "9:30 AM", "9:45 AM", "10:00 AM", "10:15 AM", "10:30 AM", "10:45 AM", "11:00 AM", "11:15 AM", "11:30 AM"];

                            var select = document.getElementById("appt_time");
                            var length = select.options.length;
                            for (i = 0; i < length; i++) {
                                select.options[i] = null;
                            }
                            var appt_date_raw = document.getElementById("appt_date").value;
                            var apptraw = appt_date_raw.split("|");
                            var appt_day = apptraw[0];
                            var r = 0;
                            if (appt_day === "Friday") {
                                //appt times for regular weekdays
                                for (x = 0; x <= 10; x++) {
                                    var rand = Math.floor((Math.random() * 5) + 1);
                                    var r = r + rand;
                                    if (r > 12) {
                                        r = 12;
                                        x = 99;
                                    }
                                    var opt = document.createElement('option');
                                    opt.value = fri_times[r];
                                    opt.innerHTML = fri_times[r];
                                    select.appendChild(opt);
                                }
                            } else {
                                //appt times for Week days
                                for (x = 0; x <= 10; x++) {
                                    var rand = Math.floor((Math.random() * 5) + 1);

                                    var r = r + rand;
                                    if (r > 28) {
                                        r = 28;
                                        x = 99;
                                    }
                                    var opt = document.createElement('option');
                                    opt.value = week_times[r];
                                    opt.innerHTML = week_times[r];
                                    select.appendChild(opt);
                                }
                            }
                            document.getElementById("appt_time").style.visibility = 'visible';
                        }
                    </script>
                    <?php
                    $application_authorization = time() + 29381;
                    $weekend = array('Sun', 'Sat');
                    $date = new DateTime(date('Y-m-d'));
                    $nextDay = clone $date;
                    $nextDayNames = array();
                    $i = 0; // We have 0 future dates to start with
                    $nextDates = array(); // Empty array to hold the next dates
                    $nextDates_human = array(); // Empty array to hold the date in US format
                    while ($i < 5) {
                        $nextDay->modify('+1 day'); // Add 1 day
                        if (in_array($nextDay->format('m-d'), $holidays))
                            continue; // Don't include year to ensure the check is year independent
                        if (in_array($nextDay->format('D'), $weekend))
                            continue;
                        // These next lines will only execute if continue isn't called for this iteration
                        $nextDates[] = $nextDay->format('Y-m-d');
                        $nextDates_human[] = $nextDay->format('m/d/Y');
                        $nextDayNames[] = $nextDay->format('l');
                        $i++;
                    }
                    ?> 


                    <div onload="init();">          
                        <?php
                        $url = 'http://www.cnshealthcare.com/API/index.php?rreq=site_info-' . $site_id;
                        $xml = simplexml_load_file($url) or die("error loading");
                        $phone_number = $xml->phone;
                        $site_address = $xml->site_address;
                        $site_address2 = $xml->site_address2;
                        $city = $xml->city;
                        $state = $xml->state;
                        $zip = $xml->zip;
                        ?>

                        <div class="container">
                            <div id="apptform" class="apptform">


                                <h3><span style="color:red;font-size: 43px;">Just one more step, <?php echo $first_name; ?>!</span></h3>
                                <h5>Pick a date and time for your free consultation at CNS Healthcare:</h5>
                                <h2></h2>
                                <span></span> <br/>

                                <input type="hidden" name="src_id" id="src_id" value="<?php echo $src_id; ?>"/>
                                <input type="hidden" name="ref_domain" id="ref_domain" value="<?php echo $subdomain; ?>"/>
                                <input type="hidden" name="interest" id="interest" value="<?php echo $interest; ?>"/>
                                <input type="hidden" name="site_id" id="site_id" value="<?php echo $location; ?>"/>
                                <input type="hidden" name="version" id="version" value="<?php echo $version; ?>"/>
                                <input type="hidden" name="application_auth" id="application_auth" value="<?php echo $application_authorization; ?>"/>
                                <input type="hidden" name="firstName" id="firstName"  value="<?php echo $first_name; ?>"/>
                                <input type="hidden" name="lastName" id="lastName"value="<?php echo $last_name; ?>"/>
                                <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
                                <input type="hidden" name="phone" id="phone" placeholder="Phone Number"  value="<?php echo $phone_number_pat; ?>"/>

                                <select name="appt_date" id="appt_date" onchange="setTime();">
                                    <option value="">Select Date</option>
                                    <?php
                                    for ($x = 0; $nextDates[$x] != ""; $x++) {
                                        print "<option value=\"$nextDayNames[$x]|$nextDates[$x]\">$nextDayNames[$x] $nextDates_human[$x]</option>";
                                    }
                                    ?>
                                </select>


                                <select name="appt_time" id="appt_time"><option disabled="disabled" value="">&leftarrow;Select date first</option></select>  <br/><br/>
                                <button onclick="submitform()">Finish Appointment</button>
                                <br/><br/>
                                <h3>We are located at: </h3>
                                <h2><?php print "$site_address $site_address2"; ?><br/>
                                    <?php print "$city, $state $zip"; ?>
                                </h2>



                            </div>


                            <div id="thankyou" class="thankyou">

                                <?php if ($website_url_thank_you_page) { ?>
                                    <h5>For more information about this study: <a href="<?php echo $website_url_thank_you_page; ?>">CLICK HERE</a></h5>
                                <?php } ?>
                                <h5>All set,  <?php echo $first_name; ?>! Looking forward to seeing you.</h5>
                            <?php } ?>

                            <h5>Your appointment is set at: </h5>
                            <h2>CNS Healthcare</h2>
                            <h2><?php print "$site_address $site_address2"; ?><br/>
                                <?php print "$city, $state $zip"; ?>
                            </h2>

                            <span><?php echo $phone_number; ?></span>

                            <?php /* ?><div class="ssba" style="margin:0 0 -40px 0">
                              <div style="text-align:left"><span>Share this</span><br>
                              <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="ssba_facebook_share"><img alt="Share on Facebook" class="ssba" title="Facebook" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/facebook.png"></a>

                              <a target="_blank" href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php the_title();?>" class="ssba_twitter_share"><img alt="Tweet about this on Twitter" class="ssba" title="Twitter" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/twitter.png"></a>

                              <a target="_blank" href="http://www.tumblr.com/share/link?url=<?php echo site_url();?>/constipation-omnispec-2834464/&amp;name=<?php the_title();?>"><img alt="Share on Tumblr" class="ssba" title="tumblr" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/tumblr.png"></a>

                              <a href="mailto:?Subject=<?php the_title();?>&amp;Body=%20<?php the_permalink(); ?>" class="ssba_email_share"><img alt="Email this to someone" class="ssba" title="Email" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/email.png"></a></div>
                              </div><?php */ ?>
                            <br/>
                            <img style="margin-top: 20px; width: 100%;" src="<?php bloginfo('template_url'); ?>/images/sign_up.png" alt="" /> 

                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!-- #content -->
    </div>
    </div>
    <!-- #primary -->
    <?php get_footer(); ?>
    <?php
}
       
