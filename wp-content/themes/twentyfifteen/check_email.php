<?php
require_once('../../../wp-load.php');
if(!function_exists('wp_get_user_by')) {
    include(ABSPATH . "wp-includes/pluggable.php"); 
}
?>
<?php
    if((isset($_REQUEST["emailid"])) && (isset($_REQUEST["postid"]))){
        $email=$_REQUEST["emailid"];
        $post_id=$_REQUEST["postid"];
        if(($email !="") && ($post_id !="")){
            $query_1234 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post_id' and email = '$email'");
            if($query_1234){
                echo "no";
            }
            else{
                echo "yes";
            }
        }
        else{
            echo "no";
        }
    }
    else{
        echo "no";
    }
?>
