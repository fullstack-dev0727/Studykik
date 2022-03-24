<?php
$email=$_POST['email'];
$sql=mysql_query("SELECT user_email FROM `0gf1ba_users` WHERE `user_email`='$email'");
        $count_uname=mysql_num_rows($sql);
        echo $count_uname;
?>

