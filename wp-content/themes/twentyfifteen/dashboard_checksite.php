<?php
$keyword=$_POST['keyword'];
if(!empty($keyword)) {
session_start();
    $authors_ids=array();
         if(isset($_SESSION['authors_ids'])){
            $authors_ids=$_SESSION['authors_ids'];
         }
         $meta_value= $_SESSION['manager_meta'];
        $sqladd=mysql_query("SELECT 0gf1ba_users.user_login,0gf1ba_users.ID FROM 0gf1ba_usermeta INNER JOIN 0gf1ba_users ON 0gf1ba_usermeta.user_id=0gf1ba_users.ID WHERE 0gf1ba_usermeta.meta_value=$meta_value and 0gf1ba_usermeta.meta_key='add_manager_id'");
        //echo "SELECT 0gf1ba_users.user_login,0gf1ba_users.ID FROM 0gf1ba_usermeta INNER JOIN 0gf1ba_users ON 0gf1ba_usermeta.user_id=0gf1ba_users.ID WHERE 0gf1ba_usermeta.meta_value=$meta_value and 0gf1ba_usermeta.meta_key='add_manager_id'";die;
        $num_add_row=mysql_num_rows($sqladd);
        if($num_add_row > 0)
        {
           while($row = mysql_fetch_assoc($sqladd)) {
            $uidds=$row['ID'];
            $uns=$row['user_login'];
            $authors_ids[$uidds]=$uns;
        }
        }
         ?>

<ul id="country-list">
<?php
 $options="";
foreach($authors_ids as $in=>$auth){
?>
<li onClick="selectCountry('<?php echo $auth; ?>');"><?php echo $auth; ?></li>
<?php } ?>
</ul>

<?php }?>

