<?php
require_once('../../../wp-load.php');
if(!function_exists('wp_get_user_by')) {
    include(ABSPATH . "wp-includes/pluggable.php"); 
}
?>
<?php
    if(isset($_REQUEST["username"])){
        $username=$_REQUEST["username"];
        if($username !=""){
            $user = get_user_by('login',$username);
            if($user){
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

