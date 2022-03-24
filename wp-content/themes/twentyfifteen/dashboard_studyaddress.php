<?php
$sitename=$_POST['uname'];
$sqlsite=mysql_query("SELECT * FROM 0gf1ba_users INNER JOIN 0gf1ba_usermeta ON 0gf1ba_users.ID=0gf1ba_usermeta.user_id WHERE 0gf1ba_users.ID='$sitename' and 0gf1ba_usermeta.meta_key='address';");
 while($row = mysql_fetch_assoc($sqlsite)) {
             //print_r($row);
                $metavalue=$row["meta_value"];

            }
            echo $metavalue;
?>

