<?php
if(isset($_POST['post_id'])){
    $post_id=$_POST['post_id'];
    $pr_num=get_post_meta($post_id, 'purchased_number', true);
    //$pr_num=5689451245;
    $nonotes=1;
    if($pr_num !=""){
        $query2 = mysql_query("SELECT from_number FROM 0gf1ba_calldata where to_number='$pr_num' and in_out=1 order by created DESC");
        $phone_arr=array();
        WHILE($rows = mysql_fetch_assoc($query2)):
            $fn=$rows['from_number'];
            $phone_arr[$fn]=$fn;
        endwhile;
	//echo "<pre>";
	//print_r($phone_arr);
        $strphone="";
        $strphone=implode(",",$phone_arr);
        $query = mysql_query("SELECT * FROM 0gf1ba_calldata where study_id = $post_id order by FIELD('from_number',$strphone),created DESC");
        $all_connects=array();
        $i=0;
        $phones=array();
        $calls=0;
        $rcalls=0;
        $mcalls=0;
        $sms=0;
        $total_duration=0;
        WHILE($rows = mysql_fetch_array($query)):
            $all_connects[$i]=$rows;
            $i=$i+1;
            $f_num=$rows['from_number'];
            $phones[$f_num]=$f_num;
            if($rows['type']==1){
                $sms=$sms+1;
            }
            if($rows['type']==2){
                $calls=$calls+1;
                if($rows['call_duration'] <=60){
                    $mcalls=$mcalls+1;
                }
                else{
                    $rcalls=$rcalls+1;
                }
                $total_duration=$total_duration+$rows['call_duration'];
            }
        endwhile;
        $sms_in = 0;
        $sms_out = 0;
        $query = $wpdb->get_results("SELECT * FROM 0gf1ba_calldata WHERE (study_id = $post_id) and NOT (type = 2)", OBJECT);
        foreach($query as $qry){
            if ($qry->in_out == 1){
                $sms_in++;
            }else{
                if(!$qry->is_first){
                    $sms_out++;
                }
                
            }
        }
        ?>
        <dl class="clinical_trial_connect" style="margin-top:15px;">

            <dt style="color:#9FCF67;">
            <p style="width: 50%; float: left; font-weight: bold; font-size: 18px;margin-bottom:10px !important;">Calls: <?php echo $calls;?></p>
            <p style="width: 50%; float: left; font-weight: bold; font-size: 18px;margin-bottom:10px !important;">Texts sent: <?php echo $sms_out;?></p>
            <p style="width: 50%; float: left; font-weight: bold; font-size: 18px;margin-bottom:10px !important;">Total Call Duration: <?php echo gmdate("i:s", $total_duration);?></p>
            <p style="width: 50%; float: left; font-weight: bold; font-size: 18px;margin-bottom:10px !important;">Texts received: <?php echo $sms_in;?></p>

           </dt>
        </dl>

        <!--<dl class="clinical_trial_connect" style="margin-top:15px;">
            
            <dt style="color:#9FCF67;">
                <p style="width: 33%; float: left; font-weight: bold; font-size: 18px;margin-bottom:10px !important;">Patients: <?php /*echo count($phones);*/?></p>
                <p style="width: 33%; float: left; font-weight: bold; font-size: 18px;margin-bottom:10px !important;">Calls: <?php /*echo $calls;*/?></p>
                <p style="width: 33%; float: left; font-weight: bold; font-size: 18px;margin-bottom:10px !important;">Texts: <?php /*echo $sms;*/?></p>
                
                <p style="width: 33%; float: left; font-weight: bold; font-size: 18px;">Received Calls: <?php /*echo $rcalls;*/?></p>
                <p style="width: 33%; float: left; font-weight: bold; font-size: 18px;">Missed Calls: <?php /*echo $mcalls;*/?></p>
                <p style="width: 33%; float: left; font-weight: bold; font-size: 18px;">Total Call Duration: <?php /*echo gmdate("i:s", $total_duration);*/?></p>
                
               
            </dt>
        </dl>-->
        <?php
        $pre_note_id=0;
        /*foreach($all_connects as $kn => $rows){
            $nonotes=0;
            $nkn=$kn+1;
            if(isset($all_connects[$nkn])){
                $nid=$all_connects[$nkn]['from_number'];
            }
            else{
                $nid=0;
            }
            $id = $rows['id'];
            $to_number = $rows['to_number'];
            $from_number = $rows['from_number'];
            $price = $rows['price'];
            $type = $rows['type'];
            $message = $rows['message'];
            $call_duration = $rows['call_duration'];
            $receive_date_time = $rows['receive_date_time'];
            $created = $rows['created'];
            $_custom_fields = get_post_custom($post_id);
            $created_date_obj = new DateTime(str_replace("?","",$created));
            if(isset($_custom_fields['callfire_time_zone'])){
                switch($_custom_fields['callfire_time_zone'][0]){
                    case 1:
                        $created_date_obj->add(new DateInterval('PT2H'));
                        break;
                    case 2:
                        $created_date_obj->add(new DateInterval('PT1H'));
                        break;
                    case 4:
                        $created_date_obj->sub(new DateInterval('PT1H'));
                        break;
                }
            }
            */?><!--
            <?php /*if($pre_note_id != $rows['from_number']){ */?>
                <dl class="clinical_trial_connect">
            <?php /*} */?>
                <dt style=" color:#00afef;">
                <?php /*if($pre_note_id != $rows['from_number']){ */?>
                <?php /*echo $from_number;*/?>
                <span style="color:#00afef;">Patient Number: <?php /*echo $from_number;*/?></span>
                <br>
                <?php /*}
                $pre_note_id=$rows['from_number'];
                */?>
                <span style="color:#bdbdbd;"> <?php /*echo $created_date_obj->format('m-d-Y, h:i:s A');*/?></span>
                </dt>
                <dd>
                    <p>
                        <?php
/*                        if($type ==1){*/?>
                            Text Message: <?php /*echo $rows['message'];*/?>
                        <?php
/*                        }
                        if($type ==2){ */?>
                            Call Duration: <?php /*echo gmdate("i:s", $rows['call_duration']);*/?>
                        <?php /*} */?>
                    </p>
                </dd>
            <?php
/*            if($nid != $rows['from_number']){ */?>
            </dl>
            <?php /*} */?>
        --><?php
/*        }*/
        
    }
}
?>