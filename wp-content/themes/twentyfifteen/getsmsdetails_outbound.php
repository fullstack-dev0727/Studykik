<?php
callfireTestLog('get sms details outbound start file');
$rawData = file_get_contents("php://input");
if($rawData !=""){
    callfireTestLog('rawData'. $rawData);
    $arr=json_decode($rawData,TRUE);
    if(isset($arr['TextNotification']['Text'])){
        $to_number = substr($arr['TextNotification']['Text']['ToNumber'],1,10);
        $from_number = substr($arr['TextNotification']['Text']['FromNumber'],1,10);
        $broadcast_id = $arr['TextNotification']['Text']['BroadcastId'];
        $sql = 'SELECT * FROM 0gf1ba_calldata WHERE broadcast_id = '.mysql_real_escape_string($broadcast_id).';';

        //$sql = "select pm.post_id as post_id, s.id as patient_id from 0gf1ba_postmeta as pm JOIN 0gf1ba_subscriber_list as s ON (s.post_id = pm.post_id AND s.phone = $to_number) where pm.meta_key='purchased_number' and pm.meta_value=$from_number order by pm.meta_id desc";
        $result2 = mysql_query($sql);
        $numpostid = 0;

        while($row = mysql_fetch_assoc($result2)) {
            $stss=get_post_status( $row["study_id"] );
            if($stss !='inherit'){
                $numpostid = $row["study_id"];

                if (isset($arr['TextNotification']['Text']['TextRecord']['BilledAmount']) && $row['is_first'] == 0){
                    updateCallfireCreditsPayments('text', $arr['TextNotification']['Text']['TextRecord']['BilledAmount'], $broadcast_id, false);
                }
            }
        }
    }
}
?>