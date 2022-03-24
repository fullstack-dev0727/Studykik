<?php
/*
 * Template Name: Add Site
 */
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Site -StudyKIK </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo get_template_directory_uri(); ?>/css/addsite/bootstrap.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/css/addsite/admin.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/css/addsite/media.css" type="text/css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<style>
    .warning{border: 1px solid red !important;}
    .nav > li {
    padding:6px !important;
 }
 #top h1 img {
    left: 480px !important;
 }
 .padtop, .navbar-nav.padtop {
    margin-top: 15px !important;
}
.top_right {
    margin-top: 40px !important;
}
</style>
</head>
<body>
<div role="navigation" class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header padtop"> <a href="<?php echo site_url();?>" class="navbar-brand"><img src="<?php bloginfo('template_url'); ?>/siteimg/logo.png" alt=""></a> </div>
                     <div class="top_right">
    <?php
	if ( is_user_logged_in() ) {?>
	<a href="<?php echo wp_logout_url(); ?>" title="Logout">Logout</a>
<?php } else {?>
	<a href="<?php echo site_url();?>/login/" title="Login">Login</a>
<?php } ?>

    </div>
    <!--/.nav-collapse -->
  </div>
</div>
<div id="banner_login">
  <div class="container">
   
        <div class="row">
                    <div class="dashboard_banner">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                </div>
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <header id="top">
                                        <h1><a href="index.html">Kitchy Food</a><img src="<?php echo get_template_directory_uri(); ?>/images-dashboard/logout_logo.png" alt=""></h1>
                                    </header>
                                      <ul class="nav navbar-nav">
                                        <li><a href="<?php echo site_url();?>/dashboard/"  style="margin-top:12px">HOME
                                            </a></li>
                                            <li><a href="<?php echo site_url();?>/clinical-study-information-dashboard/">LIST A<br>
                                                NEW STUDY</a></li>
                                                <li><a  style="color:#00afef;" href="<?php echo site_url();?>/add-site/">ADD<br>
                                                SITE</a></li>
                                        <li style="border:none;"><a class="midsection" href="<?php echo site_url();?>/refer-listing/">REFER<br>
                                                A LISTING</a></li>
                                        <li ><a href="<?php echo site_url();?>/rewards/"  style=" margin-top:12px">REWARDS</a></li>
<!--                                        <li><a href="javascript:void:0();"> ADD<br> PREFERRED<br> IRBs</a></li>-->
                                       <li><a href="<?php echo site_url();?>/proposal/">CREATE <br/> PROPOSAL</a></li>
                                         <li><a href="<?php echo site_url();?>/invoice-receipts/">INVOICE <br />
                                         RECEIPTS</a></li>
                                        <li><a href="<?php echo site_url();?>/your-profile/?idp=Profile"  style=" margin-top:12px">MY ACCOUNT
                                                </a></li>
                                    </ul>
                                    <div class="studykik_contact">
                                        <p>Stud<span class="blue_text">y</span><span class="orange_text">KIK</span> Team Member: <span class="green_text"><?php echo get_user_meta($user_ID, 'project_manager', true); ?></span> - <span class="blue_text"><?php echo get_user_meta($user_ID, 'phone_number', true); ?></span></p>

                                    </div>
                                </div>
                                <!-- /.navbar-collapse -->
                            </div>
                            <!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>

      <script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('#site_email').blur(function(e) {
  var emailok = false;
var site_email=jQuery('#site_email').val();
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(regex.test(site_email)){
				jQuery.ajax({
				url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
				type: 'POST',
				data: "action=dashboard_add_email&email="+site_email,
				beforeSend: function(){
				jQuery('#emailInfo').html("<span style='float:right;margin-right:59px;margin-top:-10px;'>Checking Email</span>"); //show checking or loading image
				},
				success: function(html){
									if(html != 0)
									{
									   emailok = false;
									   if (jQuery('#site_email').val() !='' ){
									   jQuery('#emailInfo').html("<span style='color:red;float:right;margin-right:59px;margin-top:-10px;'>Email Already Exist</span>");
									   jQuery('#site_email').addClass('warning');
									   jQuery('#site_email').val("");
								   }
									}
									if(html == 0)
									{
									emailok = true;
									if (jQuery('#site_email').val() !='' ){
									jQuery('#emailInfo').html("<span style='color:green;margin-right:59px;float:right;margin-top:-10px;'>Email OK</span>");
									 jQuery('#site_email').removeClass('warning');
									}
									}
								}


				})
			}
			else{
				jQuery('#emailInfo').html("<span style='color:red;float:right;margin-right:59px;margin-top:-10px;'>Invalid Email</span>");
			   jQuery('#site_email').addClass('warning');
			   
			}

});
        jQuery('#form_add').submit(function() {
    var errors = 0;

   jQuery("#form_add .required").map(function(){
         if( !jQuery(this).val() ) {
              jQuery(this).addClass('warning');
              errors++;
        } else if (jQuery(this).val()) {
              jQuery(this).removeClass('warning');
        }
    });
    if(errors > 0){ //alert()
       //$('#errorwarn').text("All fields are required");
        return false;
    }

        if (jQuery('#site_password').val() == jQuery('#site_cpassword').val()) {
        if (jQuery('#site_password').val() !='' && jQuery('#site_cpassword').val() !=''){
       //  jQuery('#message').html('Password Match.').css('color', 'green');}
	    jQuery('#message').html("<span style='color:green;margin-left:408px'>Password Match.</span>"); }
        return true;
    } else
         //jQuery('#message').html('Passwords do not match!').css('color', 'red');
	 jQuery('#message').html("<span style='color:red;margin-left:353px'>Passwords do not match!</span>");
        return false;


});
  jQuery('#site_cpassword').on('keyup', function () {
    if (jQuery('#site_password').val() == jQuery('#site_cpassword').val()) {
        //jQuery('#message').html('Password Match.').css('color', 'green');
		jQuery('#message').html("<span style='color:green;margin-left:408px'>Password Match.</span>");
        return true;
    } else
		 jQuery('#message').html("<span style='color:red;margin-left:353px'>Passwords do not match!</span>");
        //jQuery('#message').html('Passwords do not match!').css('color', 'red');
        return false;
});

  jQuery('#site_name').blur(function(e) {
 var value = jQuery("#site_name").val();
  value = value.replace(/ /g, "_");

jQuery("#site_uname").val(value);

var site_name=jQuery('#site_uname').val();
jQuery.ajax({
    url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
    type: 'POST',
    data: "action=dashboard_add_patient&uname="+site_name,
    success: function(html){

			jQuery('#site_uname').val(html);


                    }


    })
});



 });
       </script>

    <div class="row">
      <section class="container_current">
        <div class="full_section">
          <div class="col-lg-12 col-md-12 col-xs-12"> <img src="<?php bloginfo('template_url'); ?>/siteimg/center_logo.png" alt="" class="img-responsive center-block"> </div>
        <div class="row clearfix">
          <div class="col-md-6 col-md-offset-3 column">
                  <?php
              if(isset($_POST['submit'])){

                  $sitenameErr = $siteunameErr = $sitecpersonErr = $siteemailErr = $passwordErr = $cpasswordErr = $siteaddressErr ="";
                  $sitename = $siteuname = $sitecperson = $siteemail = $password = $cpassword = $siteaddress = "";

                   function test_input($data) {
                   $data = trim($data);
                   $data = stripslashes($data);
                   $data = htmlspecialchars($data);
                   return $data;
                }
                  if (empty($_POST["site_name"])) {
                     $sitenameErr = "Site Name is required";
                   } else {
                    $sitename = test_input($_POST["site_name"]);
                   }
                    if (empty($_POST["site_uname"])) {
                     $siteunameErr = "Username is required";
                   } else {
                    $siteuname = test_input($_POST["site_uname"]);
                   }
                   if (empty($_POST["site_cperson"])) {
                     $sitecpersonErr= "Site contact person is required";
                   } else {
                    $sitecperson = test_input($_POST["site_cperson"]);
                   }
                   if (empty($_POST["site_email"])) {
                     $siteemailErr= "Site email is required";
                   } else {
                    $siteemail = test_input($_POST["site_email"]);
                   }
                    if (empty($_POST["site_address"])) {
                     $siteaddressErr= "Site address is required";
                   } else {
                    $siteaddress = test_input($_POST["site_address"]);
                   }
                   if (empty($_POST["site_password"])) {
                     $passwordErr= "Password is required";
                   } else {
                    $password = test_input($_POST["site_password"]);
                   }
                    if (empty($_POST["site_cpassword"])) {
                     $cpasswordErr= "Confirm Password is required";
                   } else {
                    $cpassword = test_input($_POST["site_cpassword"]);
                   }

                $sitename=$_POST['site_name'];
                $siteuname=$_POST['site_uname'];
                $sitecperson=$_POST['site_cperson'];
                $siteemail=$_POST['site_email'];
                $password=$_POST['site_password'];
                $cpassword=$_POST['site_cpassword'];
                $siteaddress=$_POST['site_address'];
                $url=site_url().'/add-site/';

                //echo "<pre>";
                // print_r($_POST);
                $userdata = array(
                   'user_login'  =>  $siteuname,
                    'nickname'    =>  $sitecperson,
                   'user_pass'   =>  $password,
                   'user_email' =>   $siteemail,
                    'role'       =>   'editor',
                   'user_url'   =>    $url
               );
//print_r($userdata);
                $user_id = wp_insert_user( $userdata ) ;
                $meta_key='add_manager_id';
                $meta_value=get_current_user_id();
                add_user_meta( $user_id, $meta_key, $meta_value, $unique );
                $meta_key='address';
                $meta_value=$siteaddress;
                $prev_value='';
                update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );
                $meta_key='sitename';
                $meta_value=$sitename;
                update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );
                //On success
//                if ( ! is_wp_error( $user_id ) ) {
//                   echo "User created : ". $user_id;
//                }

              }
              ?>
            <form class="form_section" method="post" action="" id="form_add">
            <h6>ADD A SITE TO YOUR PORTAL</h6>
            <input type="text" class="form-control center-block site_form required" placeholder="Site Name" id="site_name" name="site_name"/> <div style="color:red;margin-left:350px;"> <?php echo $sitenameErr;?></div>
               <input type="text" class="form-control center-block site_form required" placeholder="Username" id="site_uname" name="site_uname" readonly/><div style="color:red;margin-left:350px;"> <?php echo $siteunameErr;?></div>
              <input type="text" class="form-control center-block site_form required" placeholder="Site Contact Person (Full Name)" id="site_cperson" name="site_cperson"/><div style="color:red;margin-left:295px;"> <?php echo $sitecpersonErr;?></div>
              <input type="email" class="form-control center-block site_form required" placeholder="Site Email" id="site_email" name="site_email"/><div id="emailInfo" style="margin-left:391px;margin:0px !important;"></div><div style="color:red;margin-left:350px;"> <?php echo $siteemailErr;?></div>
             <input type="text" class="form-control center-block site_form required" placeholder="Site Address" id="site_address" name="site_address"/><div style="color:red;margin-left:350px;"> <?php echo $siteaddressErr;?></div>
              <input type="password" class="form-control center-block site_form required" placeholder="Password" id="site_password" name="site_password"/><div style="color:red;margin-left:350px;"> <?php echo $passwordErr;?></div>
              <input type="password" class="form-control center-block site_form required" placeholder="Confirm Password" id="site_cpassword"  name="site_cpassword"/><span id='message'></span><div style="color:red;margin-left:350px;"> <?php echo $cpasswordErr;?></div>
           <button type="submit" class="submit_site" name="submit" id="submit"><img src="<?php bloginfo('template_url'); ?>/siteimg/submit_site.png" alt="" class="img-responsive center-block"></button>

            </form>


          </div>
        </div>
        <div class="left_girl">
        <img src="<?php bloginfo('template_url'); ?>/siteimg/left_girl.png" alt="" class="img-responsive">
        </div>
        </div>
      </section>
    </div>
  </div>
</div>

<footer>
  <div class="container">
    <div class="col-xs-12 col-sm-12 clo-lg-6">
      <ul>
        <li><a href="<?php echo site_url();?>">HOME PAGE</a></li>
        <li><a href="<?php echo site_url();?>/contact/">CONTACT US</a></li>
        <li><a href="<?php echo site_url();?>/clinical-trial-patient-recruitment-patient-enrollment/">LIST YOUR TRIAL</a></li>
      </ul>
    </div>
  </div>
</footer>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/addsite/bootstrap.js"></script>
</body>
</html>