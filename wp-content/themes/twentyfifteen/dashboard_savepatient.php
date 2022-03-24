<?php
//echo "Hello";
$postid=$_POST['post_id'];
$id=$_POST['id'];
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$clear_phone=editPhoneNumber($_POST['phone']);
$date_modify = date('Y-m-d H:i:s',strtotime('-4 hours'));

$mysql_result = mysql_query('SELECT * FROM 0gf1ba_subscriber_list ' . "WHERE id='$id' and post_id=$postid LIMIT 1");
$row = mysql_fetch_assoc($mysql_result);
mysql_free_result($mysql_result);
if($row){
    if($row['clear_phone']!=$clear_phone){ // log phone number has been changed
        $sql = 'INSERT INTO 0gf1ba_subscriber_list_phone_old (subscriber_id, post_id, phone, when_changed) VALUES (\'' . mysql_real_escape_string($id) . '\',\'' . mysql_real_escape_string($postid) . '\', \'' . mysql_real_escape_string(editPhoneNumber($row['phone'])) . '\', NOW());';
        mysql_query($sql);
    }
}

 mysql_query("UPDATE 0gf1ba_subscriber_list SET name='$name',email='$email',phone='$phone',clear_phone='$clear_phone',last_modify='$date_modify' WHERE id='$id' and post_id=$postid");
// echo "UPDATE 0gf1ba_subscriber_list SET name='$name',email='$email',phone='$phone' WHERE id='$id' and post_id=$postid";
//echo $_POST['spatient_id'];


function editPhoneNumber($phone){
    return preg_replace("/[^0-9]+/", '', $phone);
}