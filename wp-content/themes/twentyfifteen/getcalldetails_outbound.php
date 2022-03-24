<?php
callfireTestLog('get outbound call details start file');
$rawData = file_get_contents("php://input");
//$rawData ='{"CallFinished":{"SubscriptionId":480084003,"Call":{"@id":"589233785003","FromNumber":1305401004,"ToNumber":17142438767,"State":"FINISHED","ContactId":459051544003,"Inbound":true,"Created":"2015-09-12T13:04:14Z","Modified":"2015-09-12T13:05:12Z","FinalResult":"XFER_LEG","CallRecord":[{"@id":"329040470003","Result":"XFER_LEG","FinishTime":"2015-09-12T13:05:11Z","BilledAmount":0,"AnswerTime":"2015-09-12T13:04:24Z","Duration":47},{"@id":"329040469003","Result":"XFER","FinishTime":"2015-09-12T13:05:11Z","BilledAmount":1,"AnswerTime":"2015-09-12T13:04:15Z","Duration":56}],"AgentCall":false}}}';
if($rawData !=""){
    callfireTestLog('rawData'. $rawData);
    $arr=json_decode($rawData,TRUE);
    if(isset($arr['CallFinished']['Call'])){
        $to_number=substr($arr['CallFinished']['Call']['ToNumber'],1,10);
        $from_number=substr($arr['CallFinished']['Call']['FromNumber'],1,10);
        $broadcast_id = $arr['CallFinished']['Call']['BroadcastId'];
        if ($broadcast_id) {
            $sql = 'SELECT * FROM 0gf1ba_calldata WHERE broadcast_id = '.mysql_real_escape_string($broadcast_id).';';
            //$result2=mysql_query("select pm.post_id as post_id, s.id as patient_id from 0gf1ba_postmeta as pm JOIN 0gf1ba_subscriber_list as s ON (s.post_id = pm.post_id AND s.phone = $to_number) where pm.meta_key='purchased_number' and pm.meta_value=$from_number order by pm.meta_id desc");
            $result2 = mysql_query($sql);
            $numpostid=0;
            while($row = mysql_fetch_assoc($result2)){
                $stss=get_post_status( $row["study_id"] );
                if($stss !='inherit'){
                    $numpostid=$row["study_id"];

                    $patient_id=$row["patient_id"];
                    $campaign = get_post_meta( $numpostid, 'renewed', true );
                    $subs_id=$arr['CallFinished']['SubscriptionId'];
                    $type=2;
                    if(!isset($arr['CallFinished']['Call']['CallRecord'][0])){
                        $call_data=$arr['CallFinished']['Call']['CallRecord'];
                        $arr['CallFinished']['Call']['CallRecord']=array();
                        $arr['CallFinished']['Call']['CallRecord'][0]=$call_data;
                    }

                    if ( isset($arr['CallFinished']['Call']['CallRecord'][1]['Duration']) && ($arr['CallFinished']['Call']['CallRecord'][1]['Duration'] > $arr['CallFinished']['Call']['CallRecord'][0]['Duration'])){
                        $call_duration=$arr['CallFinished']['Call']['CallRecord'][1]['Duration'];
                    }else{
                        $call_duration=$arr['CallFinished']['Call']['CallRecord'][0]['Duration'];
                    }

                    $received=date('Y-m-d H:i:s',strtotime($arr['CallFinished']['Call']['CallRecord'][0]['AnswerTime']));
                    //$current=$date = date('Y-m-d H:i:s');
                    $current = date('Y-m-d H:i:s',strtotime('-7 hours'));
                    $status=$arr['CallFinished']['Call']['State'];
                    $sql = 'UPDATE 0gf1ba_calldata SET subscription_id = \''.mysql_real_escape_string($subs_id).'\', to_number = \''.mysql_real_escape_string($to_number).'\', from_number = \''.mysql_real_escape_string($from_number).'\', status = \''.mysql_real_escape_string($status).'\', call_duration = \''.mysql_real_escape_string($call_duration).'\', json_data = \''.mysql_real_escape_string($rawData).'\', receive_date_time = \''.mysql_real_escape_string($received).'\', campaign = \''.mysql_real_escape_string($campaign).'\'  WHERE id = '.$row['id'].' ;';
                    mysql_query($sql);
                    //mysql_query("INSERT INTO `0gf1ba_calldata`(`id`, `subscription_id`, `to_number`, `from_number`, `type`, `status`, `call_duration`, `json_data`, `receive_date_time`, `created`,`campaign`, is_read, study_id, patient_id, in_out) VALUES (NULL,'$subs_id','$to_number','$from_number','$type','$status','$call_duration','$rawData','$received','$current','$campaign', 1, '$numpostid', '$patient_id', 2)");
                    $mess_id = mysql_insert_id();

                    if (isset($arr['CallFinished']['Call']['CallRecord'])){
                        $sum = 0;
                        foreach($arr['CallFinished']['Call']['CallRecord'] as $call_record){
                            if (isset($call_record['BilledAmount'])){
                                $sum += $call_record['BilledAmount'];
                            }
                        }
                        //updateCallfireCreditsPayments('call', $sum, $broadcast_id, false);
                    }
                }
            }
        }

    }
}
?>