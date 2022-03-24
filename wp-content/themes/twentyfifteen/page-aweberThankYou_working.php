<?php
/**
Template Name: Thank You Aweber
 */
get_header(); ?>
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
$str=$_REQUEST['custom_mobile_phone_number'];
$noDigits=0;
$numb="";
	for ($i=0;$i<strlen($str);$i++){
	    if (is_numeric($str{$i})){
                if($noDigits==0){
                    if($str{$i}==0 || $str{$i}==1){

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
$phone_number123=  $_REQUEST['custom_phone_number'];
$final_phone_number ="";
$email =$_REQUEST['email'];
$name = $_REQUEST['uname'];
$post_id = $_REQUEST['post_id'];
$post_content = get_post($post_id);
$title = $post_content->post_title;
$guid = $post_content->guid;
$slug = $post_content->post_name;
$phone_number = get_post_meta( $post_id, 'phone_number', true );
$name_of_site = get_post_meta( $post_id, 'name_of_site', true );
$custom_title_for_thank_you_page = get_post_meta( $post_id, 'custom_title_(for_thank_you_page)', true );
$website_url_thank_you_page = get_post_meta( $post_id, 'website_url_thank_you_page', true );
$study_full_address = get_post_meta( $post_id, 'study_full_address', true );
?>
<?php
?>
<div id="inner-page">
  <div class="container">
    <div class="sign_up">
      <?php //echo $body; ?>
      
      <?php if($post_id == 32360){?>
		 <h3>Thank you for Entering</h3>
      <h5>You will be notified at the end of the contest if you won</h5>
      <h3>&nbsp;</h3>
	 <?php }else{?>
      <h3>Thank you for signing up for our research study!</h3>
      <h5>Please call us to schedule your appointment at:</h5>
      <h2><?php echo $name_of_site; ?></h2>
      <span><?php echo $phone_number; ?></span> <br/>
      <h5>Here is the study location:</h5>
      <h2><?php echo $study_full_address; ?></h2>
      <br/>
      <?php if($website_url_thank_you_page){ ?>
      <h5>For more information about this study: <a href="<?php echo $website_url_thank_you_page; ?>">CLICK HERE</a></h5>
      <?php } ?>
      <h5>Looking forward to having you join.</h5>
      <?php } ?>
      <div class="ssba" style="margin:0 0 -40px 0">
        <div style="text-align:left"><span>Share this</span><br>
          <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="ssba_facebook_share"><img alt="Share on Facebook" class="ssba" title="Facebook" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/facebook.png"></a>

          <a target="_blank" href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php the_title();?>" class="ssba_twitter_share"><img alt="Tweet about this on Twitter" class="ssba" title="Twitter" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/twitter.png"></a>

          <a target="_blank" href="http://www.tumblr.com/share/link?url=<?php echo site_url();?>/constipation-omnispec-2834464/&amp;name=<?php the_title();?>"><img alt="Share on Tumblr" class="ssba" title="tumblr" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/tumblr.png"></a>

          <a href="mailto:?Subject=<?php the_title();?>&amp;Body=%20<?php the_permalink(); ?>" class="ssba_email_share"><img alt="Email this to someone" class="ssba" title="Email" src="<?php echo site_url();?>/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/email.png"></a></div>
      </div>
      <br/>
      <img style="margin-top: 20px; width: 100%;" src="<?php bloginfo('template_url');?>/images/sign_up.png" alt="" /> </div>
  </div>
  <!-- #content -->

</div>
<!-- #primary -->

<?php $post_ids = $post_id;
$study_no=get_post_meta($post_ids, 'study_no',true );
$callfire_category=get_post_meta($post_ids, 'callfire_category',true );
$callfire_cat=$callfire_category;
$callfire_category=$callfire_category.' '.'('.$study_no.')';
$callfire_contact=$numb;
$callfire_name=$_REQUEST['uname'];
/*category addition code*/
if($callfire_category !='' && $callfire_contact !='' && $callfire_cat !="" && $callfire_cat !="0" && $study_no!=''){
$wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
$client = new SoapClient($wsdl, array(
'soap_version' => SOAP_1_2,
'login'        => '41530ff4e2a8',
'password'     => 'a44dd745a81cca3c'));
$contact_no=$callfire_contact;
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
$category_name=$callfire_category;
$list_arr=array();
if(isset($response['ContactList'][0])){
    foreach($response['ContactList'] as $cnt){
        if($cnt['Name']==$category_name){
            $list_arr=$cnt;
            break;
        }
    }
}
else{
    if(isset($response['ContactList']['id'])){
        $ct_data=$response['ContactList'];
        $response['ContactList']=array();
        $response['ContactList'][0]=$ct_data;
        foreach($response['ContactList'] as $cnt){
            if($cnt['Name']==$category_name){
                $list_arr=$cnt;
                break;
            }
        }
    }
}
if(empty($list_arr)){
     $result_cat=mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$phone_number12' and email='$email' order by id desc limit 1");

         while($row = mysql_fetch_assoc($result_cat)) {
             //print_r($row);
                $id=$row["id"];
                $fname=$row["name"];
            }
    $request = new stdClass();
    $request->Name =$category_name; // string required
    $request->Validate=false;
    $request->ContactSource = new stdclass(); //  required
    $request->ContactSource->Contact = array(); //required choice
    $request->ContactSource->Contact[0] = new stdClass(); // object
    //$request->ContactSource->Contact[0]->firstName = 'kamala1'; // string
    $request->ContactSource->Contact[0]->firstName = $fname; // string
    $request->ContactSource->Contact[0]->lastName = ''; // string
    $request->ContactSource->Contact[0]->mobilePhone = $callfire_contact; // PhoneNumber
    $response = $client->CreateContactList($request);

}
else{
    //print_r($list_arr);
    $list_id=$list_arr['id'];
    $query = new stdclass();
    $query->MaxResults = 1000; // long
    $query->FirstResult = 0; // long
    $query->Field = 'mobilePhone'; // long
    $query->ContactListId = $list_id; // long
    $query->String = $contact_no; // long
    $response = $client->QueryContacts($query);
    $response = json_decode(json_encode($response), true);
   // print_r($response);
    $is_exist=0;
    if(isset($response['TotalResults'])){
        if($response['TotalResults'] > 0 ){
            $is_exist=1;
        }
    }
    if($is_exist==0){
    //    echo "hii";
        $result_cat=mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$phone_number12' and email='$email' order by id desc limit 1");

         while($row = mysql_fetch_assoc($result_cat)) {
             //print_r($row);
                $id=$row["id"];
                $fname=$row["name"];
            }
        $request = new stdClass();
        $request->ContactListId = $list_id; // long required
        $request->ContactSource = new stdClass(); // required
        $request->ContactSource->Contact = array();
        //$request->ContactSource->Contact[0]['firstName'] = "roshan";
        $request->ContactSource->Contact[0]['firstName'] =$fname;
        $request->ContactSource->Contact[0]['lastName'] = "";
        $request->ContactSource->Contact[0]['mobilePhone'] = $contact_no;
        $client->AddContactsToList($request);

    }
}

            mysql_query("UPDATE 0gf1ba_subscriber_list SET callfire_category='$callfire_category' WHERE id='$id'");
}
/*category addition code*/
$callfire_time_zone= get_post_meta($post_ids, 'callfire_time_zone',true );
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
if($number!='' && $number!='0' && $from_number!='' && $from_number!='0' && !empty($questions_arr)){
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
         if($callfire_time_zone == 1){
           $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '07:00:00';
            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '15:00:00';
        }
        if($callfire_time_zone == 2){

            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '08:00:00';
            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '16:00:00';
        }
        if($callfire_time_zone == 3){

             $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '09:00:00';
             $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '17:00:00';
        }
        if($callfire_time_zone == 4){

          $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '10:00:00';
             $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '18:00:00';
        }
        $request->Broadcast->IvrBroadcastConfig->RetryConfig = new stdclass();
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->MaxAttempts = 500;
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->MinutesBetweenAttempts = 10;
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->RetryResults = 'AM BUSY NO_ANS';

if(!empty($questions_arr)){
	$cn_ques=count($questions_arr);
	$variable='<dialplan name="Root1">';
        if($greeting ==""){
            $variable.='<play type="callfireid">1715421003</play>';
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
              $variable.='<transfer callerid="${call.phonenumber}" name="transferwrong" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">'.$number.'</transfer>';
              }
              else
              {
            $variable.='<transfer name="transferwrong" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">'.$number.'</transfer>';
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
            $variable.='<transfer callerid="${call.phonenumber}" name="transferright" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">'.$number.'</transfer>';
            }
          else {
           $variable.='<transfer name="transferright" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">'.$number.'</transfer>';
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
    if($number!='' && $number!='0' && $from_number!='' && $from_number!='0' && empty($questions_arr)){
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
        if($callfire_time_zone == 1){
           $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '07:00:00';
            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '15:00:00';
        }
        if($callfire_time_zone == 2){

            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '08:00:00';
            $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '16:00:00';
        }
        if($callfire_time_zone == 3){

             $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '09:00:00';
             $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '17:00:00';
        }
        if($callfire_time_zone == 4){

          $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->BeginTime = '10:00:00';
             $request->Broadcast->IvrBroadcastConfig->LocalTimeZoneRestriction->EndTime = '18:00:00';
        }
        $request->Broadcast->IvrBroadcastConfig->RetryConfig = new stdclass();
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->MaxAttempts = 500;
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->MinutesBetweenAttempts = 10;
        $request->Broadcast->IvrBroadcastConfig->RetryConfig->RetryResults = 'AM BUSY NO_ANS';
         $variable='<dialplan name="Root">';
         $variable.='<play type="callfireid">1715427003</play>';
           if($from_number == $number){
           $variable.='<transfer callerid="${call.phonenumber}" name="transferdefault" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">'.$number.'</transfer></dialplan>';
            }
            else{
               $variable.='<transfer name="transferdefault" whisper-tts="Hello, a patient is calling you from Study Kick, please hold.">'.$number.'</transfer></dialplan>';
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
        $result=mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$phone_number12' and email='$email' order by id desc limit 1");

         while($row = mysql_fetch_assoc($result)) {
             //print_r($row);
                $id=$row["id"];
            }
         mysql_query("UPDATE 0gf1ba_subscriber_list SET redirect_number='$number',broadcast_id='$broadcastId',answers_get='2',from_number='$from_number',is_default_callfire='1' WHERE id='$id'");
    }
}

?>
<?php get_footer(); ?>