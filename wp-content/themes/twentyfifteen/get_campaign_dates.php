<?php
$cam_dates=array();
$cam_dates['sdate']=null;
$cam_dates['edate']=null;
$post_id=$_POST['post_id'];
$cam_id=$_POST['cam_id'];
$result1=mysql_query("SELECT * FROM `0gf1ba_campaigns` WHERE campaign='$cam_id' and post_id='$post_id'");
while($row = mysql_fetch_assoc($result1)) {
    $st_dt=$row["start_date"];
    $en_dt=$row["end_date"]; 
    if($st_dt !=NULL){
        $date = date('m/d/Y',strtotime($st_dt));
        $cam_dates['sdate']=$date;
    }
    if($en_dt !=NULL){
        $date = date('m/d/Y',strtotime($en_dt));
        $cam_dates['edate']=$date;
    }
}
echo json_encode($cam_dates);
?>