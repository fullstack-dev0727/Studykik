<?php
$rawData = file_get_contents("php://input");
//$rawData ='{"CallFinished":{"SubscriptionId":480084003,"Call":{"@id":"589233785003","FromNumber":13054012258,"ToNumber":19542104438,"State":"FINISHED","ContactId":459051544003,"Inbound":true,"Created":"2015-09-12T13:04:14Z","Modified":"2015-09-12T13:05:12Z","FinalResult":"XFER_LEG","CallRecord":[{"@id":"329040470003","Result":"XFER_LEG","FinishTime":"2015-09-12T13:05:11Z","BilledAmount":0,"AnswerTime":"2015-09-12T13:04:24Z","Duration":47},{"@id":"329040469003","Result":"XFER","FinishTime":"2015-09-12T13:05:11Z","BilledAmount":1,"AnswerTime":"2015-09-12T13:04:15Z","Duration":56}],"AgentCall":false}}}';
if($rawData !=""){
    $arr=json_decode($rawData,TRUE);
    if(isset($arr['CallFinished']['Call'])){
        $subs_id=$arr['CallFinished']['SubscriptionId'];
        $to_number=substr($arr['CallFinished']['Call']['ToNumber'],1,10);
        $from_number=substr($arr['CallFinished']['Call']['FromNumber'],1,10);
        $type=2;
        if(!isset($arr['CallFinished']['Call']['CallRecord'][0])){
            $call_data=$arr['CallFinished']['Call']['CallRecord'];
            $arr['CallFinished']['Call']['CallRecord']=array();
            $arr['CallFinished']['Call']['CallRecord'][0]=$call_data;
        }
        $call_duration=$arr['CallFinished']['Call']['CallRecord'][0]['Duration'];
        $received=date('Y-m-d H:i:s',strtotime($arr['CallFinished']['Call']['CallRecord'][0]['AnswerTime']));
        //$current=$date = date('Y-m-d H:i:s');
        $current = date('Y-m-d H:i:s',strtotime('-7 hours'));
        $status=$arr['CallFinished']['Call']['State'];
        $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_calldata`(`id`, `subscription_id`, `to_number`, `from_number`, `type`, `status`, `call_duration`, `json_data`, `receive_date_time`, `created`) VALUES (NULL,'$subs_id','$to_number','$from_number','$type','$status','$call_duration','$rawData','$received','$current')",array()));
        $result2=mysql_query("select post_id from 0gf1ba_postmeta where meta_key='purchased_number' and meta_value=$to_number order by meta_id desc limit 1");
        $numpostid=0;
        while($row = mysql_fetch_assoc($result2)) {
           $numpostid=$row["post_id"];
        }
        if($numpostid !=0){
            $result1=mysql_query("SELECT COUNT(phone) FROM 0gf1ba_subscriber_list WHERE phone=$from_number and post_id=$numpostid");
            $row1=mysql_fetch_row($result1);
            $count1=$row1[0];
            if($count1 ==0){
                $result=mysql_query("SELECT COUNT(id) AS automatic_count FROM 0gf1ba_subscriber_list WHERE is_automatic_callfire=1");
                $row = mysql_fetch_row($result);
                $count = $row[0];
                $count=$count+1;
                $name='New Patient #'.$count;
                $email='No Email';
                $phone=$from_number;
                $campaign=0;
                $campaign = get_post_meta( $numpostid, 'renewed', true );
                $current_dt = date('Y-m-d H:i:s',strtotime('-4 hours'));
                mysql_query("INSERT INTO `0gf1ba_subscriber_list`(`id`, `name`, `email`, `phone`, `post_id`, `date`, `row_num`, `order_id`, `campaign`,`is_automatic_callfire`) VALUES (NULL,'$name','$email','$phone','$numpostid','$current_dt','1','0','$campaign','1')");
            }
        }
    }
}
?>