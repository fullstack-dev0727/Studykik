<?php
$username=$_POST['username'];
$sql=mysql_query("SELECT user_login FROM `0gf1ba_users` WHERE `user_login`='$username'");
$count_uname=mysql_num_rows($sql);
echo $count_uname;
?>

