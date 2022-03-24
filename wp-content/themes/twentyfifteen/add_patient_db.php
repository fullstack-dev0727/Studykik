<?php
/**
 * Created by PhpStorm.
 * User: kp
 * Date: 8/4/16
 * Time: 2:57 PM
 */

if (isset($_REQUEST['add_patient_db'])) {
  $post_id = $_REQUEST['post_id'];
  $name = $_REQUEST['name'];
  $email = $_REQUEST['email'];
  $phone = $_REQUEST['phone'];
  $str=$phone;
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
  $phone=$numb;
    $_custom_fields = get_post_custom($_REQUEST['post_id']);
    if(!isset($_custom_fields['allow_international_phone_numbers'])){
        // by default use USA number format
        $allow_international_phone_numbers = false;
    }else{
        $allow_international_phone_numbers = isset($_custom_fields['allow_international_phone_numbers'][0]) ? ($_custom_fields['allow_international_phone_numbers'][0] != '') : true;
    }

  if ($allow_international_phone_numbers){
      $phone = $_REQUEST['phone'];
  }
  if ($post_id != "" || $name != "" || $email != "") {
    global $wpdb;
    $date_sub = date('Y-m-d H:i:s', strtotime('-5 hours'));
    $campaign = get_post_meta( $post_id, 'renewed', true );
    $query = mysql_query("INSERT INTO `0gf1ba_subscriber_list`(`id`, `name`, `email`, `phone`, `post_id`, `date`, `row_num`, `order_id`, `campaign`) VALUES (NULL,'$name','$email','$phone','$post_id','$date_sub','1','0','$campaign')");

    if ($query) {
        callfireAddToContactList($post_id, $phone);
//        $study_no=get_post_meta($pid, 'study_no',true );
//        $callfire_category=get_post_meta($pid, 'callfire_category',true );
//        $callfire_cat=$callfire_category;
//        $callfire_category=$callfire_category.' '.'('.$study_no.')';
//        $callfire_contact=$phone;
////$callfire_name=$_REQUEST['name'];
//        /*category addition code*/
//        if($callfire_category !='' && $callfire_contact !=''){
//            $wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
//            $client = new SoapClient($wsdl, array(
//                'soap_version' => SOAP_1_2,
//                'login'        => '41530ff4e2a8',
//                'password'     => 'a44dd745a81cca3c'));
//            $contact_no=$callfire_contact;
//            $query = new stdclass();
//            $query->MaxResults = 10000; // long
//            $query->FirstResult = 0; // long
//            $response = $client->QueryContactLists($query);
////echo "<pre>";
//            $response = json_decode(json_encode($response), true);
////echo "<pre>";
////print_r($response);
////echo "</pre>";
////$category_name="keshuuu";
//            $category_name=$callfire_category;
//            $list_arr=array();
//            if(isset($response['ContactList'][0])){
//                foreach($response['ContactList'] as $cnt){
//                    if($cnt['Name']==$category_name){
//                        $list_arr=$cnt;
//                        break;
//                    }
//                }
//            }
//            else{
//                if(isset($response['ContactList']['id'])){
//                    $ct_data=$response['ContactList'];
//                    $response['ContactList']=array();
//                    $response['ContactList'][0]=$ct_data;
//                    foreach($response['ContactList'] as $cnt){
//                        if($cnt['Name']==$category_name){
//                            $list_arr=$cnt;
//                            break;
//                        }
//                    }
//                }
//            }
//            if(empty($list_arr)){
//                $result_cat=mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$pid' and phone='$phone' and email='$email' AND is_deleted != 1 order by id desc limit 1");
//
//                while($row = mysql_fetch_assoc($result_cat)) {
//                    //print_r($row);
//                    $id=$row["id"];
//                    $fname=$row["name"];
//                }
//
//                $request = new stdClass();
//                $request->Name =$category_name; // string required
//                $request->Validate=false;
//                $request->ContactSource = new stdclass(); //  required
//                $request->ContactSource->Contact = array(); //required choice
//                $request->ContactSource->Contact[0] = new stdClass(); // object
//                //$request->ContactSource->Contact[0]->firstName = 'kamala1'; // string
//                $request->ContactSource->Contact[0]->firstName = $fname; // string
//                $request->ContactSource->Contact[0]->lastName = ''; // string
//                $request->ContactSource->Contact[0]->mobilePhone = $callfire_contact; // PhoneNumber
//                $response = $client->CreateContactList($request);
//
//            }
//            else{
//                //print_r($list_arr);
//                $list_id=$list_arr['id'];
//                $query = new stdclass();
//                $query->MaxResults = 1000; // long
//                $query->FirstResult = 0; // long
//                $query->Field = 'mobilePhone'; // long
//                $query->ContactListId = $list_id; // long
//                $query->String = $contact_no; // long
//                $response = $client->QueryContacts($query);
//                $response = json_decode(json_encode($response), true);
//                // print_r($response);
//                $is_exist=0;
//                if(isset($response['TotalResults'])){
//                    if($response['TotalResults'] > 0 ){
//                        $is_exist=1;
//                    }
//                }
//                if($is_exist==0){
//                    //    echo "hii";
//                    $result_cat=mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$pid' and phone='$phone' and email='$email' AND is_deleted != 1 order by id desc limit 1");
//
//                    while($row = mysql_fetch_assoc($result_cat)) {
//                        //print_r($row);
//                        $id=$row["id"];
//                        $fname=$row["name"];
//                    }
//                    $request = new stdClass();
//                    $request->ContactListId = $list_id; // long required
//                    $request->ContactSource = new stdClass(); // required
//                    $request->ContactSource->Contact = array();
//                    //$request->ContactSource->Contact[0]['firstName'] = "roshan";
//                    $request->ContactSource->Contact[0]['firstName'] =$fname;
//                    $request->ContactSource->Contact[0]['lastName'] = "";
//                    $request->ContactSource->Contact[0]['mobilePhone'] = $contact_no;
//                    $client->AddContactsToList($request);
//
//                }
//            }
//
//            mysql_query("UPDATE 0gf1ba_subscriber_list SET callfire_category='$callfire_category' WHERE id='$id'");
//        }
//        header('Location: '.$return_url);
//        die();
//        //echo '
//        //       <script>
//        //
//        //       window.location.href ="'.$return_url.'"
//        //
//        //       </script>';
    }
  }
    echo "ok";
} else {
    echo "no";
}