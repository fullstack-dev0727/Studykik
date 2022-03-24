<?php
$wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
$client = new SoapClient($wsdl, array(
'soap_version' => SOAP_1_2,
'login'        => '41530ff4e2a8',    
'password'     => 'a44dd745a81cca3c'));

/**

 * QueryCalls. Determine status of calls filtered by BroadcastId, BatchId, etc...

 */

$query = new stdclass();
$query->MaxResults = 100; // long   
$query->FirstResult = 0; // long   
$servername = "localhost";
$username = "studykik_study";
$password = ",!y@E;zZZ+UJ";
$dbname = "studykik_studykik";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "select * from `0gf1ba_subscriber_list` where answers_get='2'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      
	   $subcid=$row["id"];
            $query->BroadcastId = $row["broadcast_id"]; // long   
        $response = $client->QueryCalls($query);
        $response = json_decode(json_encode($response), true);
		if(isset($response['Call'])){
			if($response['Call']['State']=='FINISHED'){
				if(isset($response['Call']['CallRecord'])){
					if(isset($response['Call']['CallRecord']['1'])){
						if(isset($response['Call']['CallRecord']['1']['QuestionResponse'])){
							if(isset($response['Call']['CallRecord']['1']['QuestionResponse']['Question'])){
								$record=$response['Call']['CallRecord']['1']['QuestionResponse'];
								$response['Call']['CallRecord']['1']['QuestionResponse']=array();
								$response['Call']['CallRecord']['1']['QuestionResponse'][0]=$record;
							}
							$ans_1=0;
							$ans_2=0;
							$ans_3=0;
							$ans_4=0;
							$ans_5=0;
							$ans_6=0;
							$ans_7=0;
							$ans_8=0;
							$ans_9=0;
							$ans_10=0;
							$answers_arr=array();
							$nm=1;
							foreach($response['Call']['CallRecord'][1]['QuestionResponse'] as $in => $res){
								if($res['Question']=='Q_01'){
									if($res['Response']=='yes'){
										$ans_1=1;
									}
									else{
										$ans_1=2;
									}
									$answers_arr[$nm]=$ans_1;
									$nm=$nm+1;
									
								}
								if($res['Question']=='Q_02'){
									if($res['Response']=='yes'){
										$ans_2=1;
									}
									else{
										$ans_2=2;
									}
									$answers_arr[$nm]=$ans_2;
									$nm=$nm+1;
								}
								if($res['Question']=='Q_03'){
									if($res['Response']=='yes'){
										$ans_3=1;
									}
									else{
										$ans_3=2;
									}
									$answers_arr[$nm]=$ans_3;
									$nm=$nm+1;
									
								}
								if($res['Question']=='Q_04'){
									if($res['Response']=='yes'){
										$ans_4=1;
									}
									else{
										$ans_4=2;
									}
									$answers_arr[$nm]=$ans_4;
									$nm=$nm+1;
								}
								if($res['Question']=='Q_05'){
									if($res['Response']=='yes'){
										$ans_5=1;
									}
									else{
										$ans_5=2;
									}
									$answers_arr[$nm]=$ans_5;
									$nm=$nm+1;
								}
								if($res['Question']=='Q_06'){
									if($res['Response']=='yes'){
										$ans_6=1;
									}
									else{
										$ans_6=2;
									}
									$answers_arr[$nm]=$ans_6;
									$nm=$nm+1;
									
								}
								if($res['Question']=='Q_07'){
									if($res['Response']=='yes'){
										$ans_7=1;
									}
									else{
										$ans_7=2;
									}
									$answers_arr[$nm]=$ans_7;
									$nm=$nm+1;
								}
								if($res['Question']=='Q_08'){
									if($res['Response']=='yes'){
										$ans_8=1;
									}
									else{
										$ans_8=2;
									}
									$answers_arr[$nm]=$ans_8;
									$nm=$nm+1;
									
								}
								if($res['Question']=='Q_09'){
									if($res['Response']=='yes'){
										$ans_9=1;
									}
									else{
										$ans_9=2;
									}
									$answers_arr[$nm]=$ans_9;
									$nm=$nm+1;
								}
								if($res['Question']=='Q_010'){
									if($res['Response']=='yes'){
										$ans_10=1;
									}
									else{
										$ans_10=2;
									}
									$answers_arr[$nm]=$ans_10;
									$nm=$nm+1;
								}
							}
							if(!empty($answers_arr)){
								$ch=1;
								foreach($answers_arr as $ans){
									if($ans==2){
										$ch=0;
										break;
									}
								}
								if($ch==1){
									$qualified=1;
								}
								else{
									$qualified=2;
								}
								$qry_str="";
								foreach($answers_arr as $in=>$answ){
									$qry_str.="answer_".$in."=".$answ.",";
								}
								mysqli_query($conn,"UPDATE 0gf1ba_subscriber_list SET ".$qry_str."answers_get=1,is_callfire_qualified=$qualified WHERE id=$subcid");
							}
						}
					}
					else{
						if(isset($response['Call']['CallRecord']['QuestionResponse'])){
							if(isset($response['Call']['CallRecord']['QuestionResponse']['Question'])){
								$record=$response['Call']['CallRecord']['QuestionResponse'];
								$response['Call']['CallRecord']['QuestionResponse']=array();
								$response['Call']['CallRecord']['QuestionResponse'][0]=$record;
							}
							$ans_1=0;
							$ans_2=0;
							$ans_3=0;
							$ans_4=0;
							$ans_5=0;
							$ans_6=0;
							$ans_7=0;
							$ans_8=0;
							$ans_9=0;
							$ans_10=0;
							$answers_arr=array();
							$nm=1;
							foreach($response['Call']['CallRecord']['QuestionResponse'] as $in => $res){
								if($res['Question']=='Q_01'){
									if($res['Response']=='yes'){
										$ans_1=1;
									}
									else{
										$ans_1=2;
									}
									$answers_arr[$nm]=$ans_1;
									$nm=$nm+1;
									
								}
								if($res['Question']=='Q_02'){
									if($res['Response']=='yes'){
										$ans_2=1;
									}
									else{
										$ans_2=2;
									}
									$answers_arr[$nm]=$ans_2;
									$nm=$nm+1;
								}
								if($res['Question']=='Q_03'){
									if($res['Response']=='yes'){
										$ans_3=1;
									}
									else{
										$ans_3=2;
									}
									$answers_arr[$nm]=$ans_3;
									$nm=$nm+1;
									
								}
								if($res['Question']=='Q_04'){
									if($res['Response']=='yes'){
										$ans_4=1;
									}
									else{
										$ans_4=2;
									}
									$answers_arr[$nm]=$ans_4;
									$nm=$nm+1;
								}
								if($res['Question']=='Q_05'){
									if($res['Response']=='yes'){
										$ans_5=1;
									}
									else{
										$ans_5=2;
									}
									$answers_arr[$nm]=$ans_5;
									$nm=$nm+1;
								}
								if($res['Question']=='Q_06'){
									if($res['Response']=='yes'){
										$ans_6=1;
									}
									else{
										$ans_6=2;
									}
									$answers_arr[$nm]=$ans_6;
									$nm=$nm+1;
									
								}
								if($res['Question']=='Q_07'){
									if($res['Response']=='yes'){
										$ans_7=1;
									}
									else{
										$ans_7=2;
									}
									$answers_arr[$nm]=$ans_7;
									$nm=$nm+1;
								}
								if($res['Question']=='Q_08'){
									if($res['Response']=='yes'){
										$ans_8=1;
									}
									else{
										$ans_8=2;
									}
									$answers_arr[$nm]=$ans_8;
									$nm=$nm+1;
									
								}
								if($res['Question']=='Q_09'){
									if($res['Response']=='yes'){
										$ans_9=1;
									}
									else{
										$ans_9=2;
									}
									$answers_arr[$nm]=$ans_9;
									$nm=$nm+1;
								}
								if($res['Question']=='Q_010'){
									if($res['Response']=='yes'){
										$ans_10=1;
									}
									else{
										$ans_10=2;
									}
									$answers_arr[$nm]=$ans_10;
									$nm=$nm+1;
								}
							}
							if(!empty($answers_arr)){
								$ch=1;
								foreach($answers_arr as $ans){
									if($ans==2){
										$ch=0;
										break;
									}
								}
								if($ch==1){
									$qualified=1;
								}
								else{
									$qualified=2;
								}
								$qry_str="";
								foreach($answers_arr as $in=>$answ){
									$qry_str.="answer_".$in."=".$answ.",";
								}
								mysqli_query($conn,"UPDATE 0gf1ba_subscriber_list SET ".$qry_str."answers_get=1,is_callfire_qualified=$qualified WHERE id=$subcid");
							}
						}
					}
				}
			}
		}
        
		
    }

} else {
    echo "0 results";
}

mysqli_close($conn);
?>