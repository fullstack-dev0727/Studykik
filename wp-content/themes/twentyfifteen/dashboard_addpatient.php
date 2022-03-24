<?php
$uname=$_POST['uname'];
$final_name=$uname;
for($i=0;$i<100000;$i++){
    if($i==0){
        $sql=mysql_query("SELECT id FROM `0gf1ba_users` WHERE `user_login`='$uname'");
        $count_uname=mysql_num_rows($sql);
        if($count_uname == 0){
            $final_name= $uname;
            break;
        }
    }
    else{
        $chk_name=$uname."_".$i;
        $sql=mysql_query("SELECT id FROM `0gf1ba_users` WHERE `user_login`='$chk_name'");
        $count_uname=mysql_num_rows($sql);
        if($count_uname == 0){
            $final_name= $chk_name;
            break;
        }
    }
}
echo $final_name;
?>

