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
						
							if(isset($response['Call']['CallRecord']['1']['QuestionResponse']['0'])){
								
								
								$ans_1=0;
								$ans_2=0;
								$ans_3=0;
								$ans_4=0;
								$ans_5=0;
								foreach($response['Call']['CallRecord'][1]['QuestionResponse'] as $in => $res){
									if($res['Question']=='Q_01'){
										if($res['Response']=='yes'){
											$ans_1=1;
										}
										else{
											$ans_1=2;
										}
										
									}
									if($res['Question']=='Q_02'){
										if($res['Response']=='yes'){
											$ans_2=1;
										}
										else{
											$ans_2=2;
										}
										
									}
									if($res['Question']=='Q_03'){
										if($res['Response']=='yes'){
											$ans_3=1;
										}
										else{
											$ans_3=2;
										}
										
									}
									if($res['Question']=='Q_04'){
										if($res['Response']=='yes'){
											$ans_4=1;
										}
										else{
											$ans_4=2;
										}
										
									}
									if($res['Question']=='Q_05'){
										if($res['Response']=='yes'){
											$ans_5=1;
										}
										else{
											$ans_5=2;
										}
										
									}
									if($ans_1==1 && $ans_2==1 && $ans_3==1 && $ans_4==1 && $ans_5==1){
										$qualified=1;
									}
									else{
										$qualified=2;
									}
									mysqli_query($conn,"UPDATE 0gf1ba_subscriber_list SET answer_1=$ans_1,answer_2=$ans_2,answer_3=$ans_3,answer_4=$ans_4,answer_5=$ans_5,answers_get=1,is_callfire_qualified=$qualified WHERE id=$subcid");
									
								
								}
								
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