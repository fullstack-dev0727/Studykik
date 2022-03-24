
<?php
if ( is_user_logged_in() ) {
	  $user_ID = get_current_user_id();
          $user_info = get_userdata($user_ID);
          $user_roles = implode(', ', $user_info->roles);
} else {
	 wp_redirect( site_url().'/login/', 301 ); exit;
}
//print_r("dashboard");
?>
<?php //get_header('dashboard');?>
 <?php if ($user_roles == "manager_username"){

        get_header('responsive');?>
<link href="<?php bloginfo('template_url');?>/css/dashboard.css" rel="stylesheet">
<style>
    .nav li a {
   margin-right: 13px !important;
    padding: 9px 5px !important;
    font-size: 15px !important;

}
.navbar-nav > li > a{text-transform: none !important;}
.nav > li {

    padding: 0 !important;

}
.nav li a.midsection {
    margin-right: 250px !important;
}

.dashboard_banner {
    background: #fff none repeat scroll 0 0;
    border-radius: 5px 5px 0 0;
    box-shadow: 0 -4px 9px #4a4e45;
    float: left;
    margin: 40px 0 0;
    padding: 30px 0 !important;
    width: 100%;
}
#top {
    display: block;
    margin-bottom: 0;
    position: relative;
}
h1 {
    color: #7e8766;
    font-family: "Helvetica Neue",Helvetica,sans-serif;
    font-size: 4.34em;
    font-weight: 700;
    line-height: 1.6em;
}
#top h1 a {
    display: block;
    height: 110px;
    left: 500px;
    margin: 0;
    padding: 0;
    position: absolute;
    text-indent: -9999px;
    top: -22px;
    width: 140px;
    z-index: 9999;
}
#top h1 img {
    display: block;
    left: 500px;
    margin: 0;
    padding: 0;
    position: absolute;
    text-indent: -9999px;
    top: -22px;
    width: 140px;
    z-index: 9999;
}
.nav > li {
    padding: 8px !important;
 }
 #top h1 img {
    left: 480px !important;
 }
</style>
  <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
<!--    <link href="<?php echo get_template_directory_uri(); ?>/css/slider.css" rel="stylesheet">-->

<!--<link href="<?php bloginfo('template_url');?>/css/dashboard_media.css" rel="stylesheet">-->
         <?php }?>
  <?php if ($user_roles == "editor"){
        get_header('dashboard');?>
        <?php }?>
<link href="<?php echo get_template_directory_uri(); ?>/fonts/font2/font.css" type="text/css" rel="stylesheet">
<style>
/*proposal css start*/
.study_proposal{
	float: left;
    min-height: 1100px;
    padding: 40px 0;
    width: 100%;
}
.proposal_left {
    left: 115px;
    position: relative;
    width: 50%;
}
.proposal_left img {
	width:100%;
}
.get_proposal{
	 position: absolute;
    right: -28px;
    top: 279px;
    width: 60%;
}
#Enter_name{
	background: #e8e8e8 none repeat scroll 0 0;
    border: medium none;
    box-shadow: 3px 3px 5px #bbbbbb inset;
    height: 46px;
    margin-bottom: 12px;
    padding: 0 10px;
    width: 678px;
	color:#f78f1e;
	font-size: 20px;
}
#Indication_dropdown{
    border: medium none;
    box-shadow: 3px 3px 5px #bbbbbb inset;
    height: 46px;
    margin-bottom: 12px;
    padding: 0 10px;
	font-size: 20px;
    width: 679px;
	color: #88dd25;
	background:url(<?php bloginfo('template_url');?>/images/drop_down.png) no-repeat scroll right top #e8e8e8;
	 -moz-appearance: none;
   -webkit-appearance: none;
   appearance: none;
}
.drop-cus{
	 float: left;
    position: relative;
	margin-bottom:0px;
}
.btn_proposal{
	background: rgba(0, 0, 0, 0) url("<?php bloginfo('template_url');?>/images/btn_proposal.png") no-repeat scroll 0 0;
    border: medium none;
    font-size: 0;
    height: 54px;
    width: 244px;
	cursor: pointer;
}
.warning{border: 1px solid red !important;}

.white_content {
    background-color: white;
    border-radius: 10px;
    cursor: auto;
    display: none;
    left: 23% !important;
    overflow: auto;
    position: fixed !important;
    top: 25% !important;
    width: 55% !important;
    z-index: 99999 !important;
	border: 1px solid #f78e1e;
}
.black_overlay {
    background: #000000 none repeat scroll 0 0;
    display: block;
    height: 3400px;
    left: 0;
    opacity: 0.8;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}
.close_button{
	background: #00afef none repeat scroll 0 0;
    border: medium none;
    color: #fff;
    display: block;
    font-family: alternate;
    font-size: 33px;
    margin: auto auto 20px;
    padding: 0 26px;
    text-align: center;
}
.closepop {
    background: transparent url("<?php bloginfo('template_url');?>/images-dashboard/close2.png") no-repeat scroll 0 0;

}
h2.heading{
    background: #f78e1e none repeat scroll 0 0;
    color: #fff;
    font-size: 44px;
    margin: 0;
    padding: 5px;
    text-align: center;
    text-decoration: none;
	font-family: alternate;
}
.done_button{
background: #9fce64;
    border: medium none;
    color: #fff;
    font-family: alternate;
    font-size: 33px;
    /*margin: 10px 0 10px 34%;*/
    padding: 0 26px;
    margin-bottom:20px;
}
</style>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $('input[name=organization]').on("keydown", function(evt){
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && this.value.length >= 32) {
                return false;
            }
        });
        $('input[name=organization]').on("keyup", function(evt){
            if (this.value.length >= 32) {
                this.value = this.value.substring(0, 32);
            }

        });

        $('input[name=protocolnumber]').on("keydown", function(evt){
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && this.value.length >= 20) {
                return false;
            }
        });
        $('input[name=protocolnumber]').on("keyup", function(evt){
            if (this.value.length >= 20) {
                this.value = this.value.substring(0, 20);
            }

        });

        $('input[name=phoneno]').on("keydown", function(evt){
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && this.value.length >= 20) {
                return false;
            }
        });
        $('input[name=phoneno]').on("keyup", function(evt){
            if (this.value.length >= 20) {
                this.value = this.value.substring(0, 20);
            }

        });

        $('input[name=websiteaddress]').on("keydown", function(evt){
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && this.value.length >= 40) {
                return false;
            }
        });
        $('input[name=websiteaddress]').on("keyup", function(evt){
            if (this.value.length >= 40) {
                this.value = this.value.substring(0, 40);
            }

        });

        $('input[name=fullname]').on("keydown", function(evt){
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && this.value.length >= 40) {
                return false;
            }
        });
        $('input[name=fullname]').on("keyup", function(evt){
            if (this.value.length >= 40) {
                this.value = this.value.substring(0, 40);
            }

        });
    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<div id="banner_login">
  <div class="container">
         <?php if ($user_roles == "editor"){?>
         <div class="row">
             <?php get_header("client-submenu")?>
         </div>
      <?php }?>
                 <?php if ($user_roles == "manager_username"){?>
                 <div class="row">
                     <?php get_header("manager-submenu")?>
                 </div>
                 <?php }?>
   <div class="row">
     <section class="container_current">
    <section class="study_proposal">
      <div class="proposal_left"> <img alt="" src="<?php bloginfo('template_url');?>/images/proposal.png">
        <div class="get_proposal">
          <form action="" method="post" id="contactform">
            <input class="required" type="text" placeholder="Enter Your First &amp; Last Name" name="fullname" id="Enter_name">
            <br>
            <input class="required" type="email" placeholder="Enter Your Email Address" name="email" id="Enter_name">
            <br>
            <input class="required" type="text" placeholder="Enter Your Phone Number" name="phoneno" id="Enter_name">
            <br>
            <input class="required" type="text" placeholder="Enter Your Site Address" name="websiteaddress" id="Enter_name">
            <br>
            <input class="required" type="text" placeholder="Enter Your Organization Name" name="organization" id="Enter_name">
            <br>
            <input class="required" type="text" placeholder="Enter Your Protocol Number" name="protocolnumber" id="Enter_name">
            <br>
		    <input class="" type="email" placeholder="Enter Sponsor Email Address" name="sponsoremail" id="Enter_name">
            <br>
		    <input class="" type="email" placeholder="Enter CRO Email Address" name="croemail" id="Enter_name">
            <br>
            <span class="drop-cus">
            <select class="required" name="indication" id="Indication_dropdown">
              <option value="">Select Indication</option>
              <option value="Other Study Type">Other Study Type</option>
             <?php
$args = array(
  'orderby' => 'name',
  'parent'  => 6,
  'hide_empty' => 0,
  'order' => 'ASC'
  );

$categories = get_categories($args);
  foreach($categories as $category) { ?>
                      <option value="<?php echo $category->name;?>"><?php echo $category->name;?></option>
                      <?php } ?>

            </select>
            </span> <br>
             <input class="new_Cat" type="text" placeholder="Enter Your Indication Name" name="indication_name" id="Enter_name">

            <select class="required" name="boost_type" id="Indication_dropdown">
              <option value="">Select Exposure Level</option>
            <option value="Diamond">Diamond: $3059</option>
            <option value="Platinum">Platinum: $1559</option>
            <option value="Gold">Gold: $559</option>
            <option value="Silver">Silver: $209</option>
            <option value="Bronze">Bronze: $59</option>

            </select>
            <br>
             <select class="required" name="camp_length" id="Indication_dropdown">
              <option value="">Select Campaign Length</option>
            <option value="One Week">One Week</option>
            <option value="Two Week">Two Week</option>
            <option value="One Month">One Month</option>
            <option value="Two Month">Two Month</option>
            <option value="Three Month">Three Month</option>

            </select><br />
            <p>
                <input class="form-control message_suite_247" style="width:auto;transform: scale(1.5); box-shadow: none; height: 25px;" type="checkbox" name="message_suite_247">
                <span style="line-height: 34px;margin-left: 10px;font-weight: bold; font-size:18px;color: #959CA1;">Add Patient Messaging Suite ($247)</span>
            </p>
            <input type="submit" value="Submit" name="btn_proposal" class="btn_proposal">
          </form>
                    <?php

		  if(isset($_REQUEST['btn_proposal']))
		  {
			$fullname = $_REQUEST['fullname'];
            $fullname1 = substr($fullname, 0, 20);
            $fullname2 = substr($fullname, 20);
			$email = $_REQUEST['email'];
			$phoneno = $_REQUEST['phoneno'];
            $phoneno1 = substr($phoneno, 0, 20);
            $phoneno2 = substr($phoneno, 20);
			$websiteaddress = $_REQUEST['websiteaddress'];
            $websiteaddress1 = substr($websiteaddress, 0, 20);
            $websiteaddress2 = substr($websiteaddress, 20);
			$organization = $_REQUEST['organization'];
			$camp_length = $_REQUEST['camp_length'];
			$sp_email = $_REQUEST['sponsoremail'];
			$cr_email = $_REQUEST['croemail'];
              $message_suite_247 = "";

			$protocolnumber = $_REQUEST['protocolnumber'];

			if($camp_length == "One Week"){$length_in_days = "7 Days";}
			if($camp_length == "Two Week"){$length_in_days = "14 Days";}
			if($camp_length == "One Month"){$length_in_days = "30 Days";}
			if($camp_length == "Two Month"){$length_in_days = "60 Days";}
			if($camp_length == "Three Month"){$length_in_days = "90 Days";}


			$indication_name = $_REQUEST['indication_name'];
			if($indication_name != "")
			{
				$indication = stripslashes($indication_name);

			}else{

				$indication = stripslashes($_REQUEST['indication']);
			}

			$indication_final =str_replace( ',', '', $indication );

			$boost_type = $_REQUEST['boost_type'];

			$category_id = get_cat_ID($indication);
			$goal =  get_option('category_'.$category_id.'_tier');

				if($boost_type == "Platinum")
				{
					if($goal == 1){ $patient_referred = '50-60';}
					if($goal == 2){ $patient_referred = '35-45';}
					if($goal == 3){ $patient_referred = '20-30';}
					if($goal == 4){ $patient_referred = '1-10';}
					if($goal == ""){ $patient_referred = '40-50';}



					if($camp_length == "Two Month"){

						 $cost= "3118";
						 $posts = "60";
						 $Package = "Platinum Package - $3,118";

					}elseif($camp_length == "Three Month"){

						$cost= "4677";
						$posts = "90";
						$Package = "Platinum Package - $4,677";

					}else{

						$cost= "1559";
						$posts = "30";
						$Package = "Platinum Package - $1,559";

					}

					$Package_2 = "PLATINUM PACKAGE";


                }elseif($boost_type == "Gold")
				{

				    if($goal == 1){ $patient_referred = '15-20';}
					if($goal == 2){ $patient_referred = '10-15';}
					if($goal == 3){ $patient_referred = '20-30';}
					if($goal == 4){ $patient_referred = '1-5';}
					if($goal == ""){ $patient_referred = '10-14';}


					if($camp_length == "Two Month"){

						 $cost= "1118";
						 $posts = "20";
						 $Package = "Gold Package - $1,118";

					}elseif($camp_length == "Three Month"){

						$cost= "1677";
						$posts = "30";
						$Package = "Gold Package - $1,677";

					}else{

						$cost= "559";
						$posts = "10";
						$Package = "Gold Package - $559";

					}
					$Package_2 = "GOLD PACKAGE";


                }elseif($boost_type == "Silver")
				{
					if($goal == 1){ $patient_referred = '5-10';}
					if($goal == 2){ $patient_referred = '2-4';}
					if($goal == 3){ $patient_referred = '1-2';}
					if($goal == 4){ $patient_referred = '1';}
					if($goal == ""){ $patient_referred = '2-3';}


					if($camp_length == "Two Month"){

						 $cost= "418";
						 $posts = "6";
						 $Package = "Silver Package - $418";

					}elseif($camp_length == "Three Month"){

						$cost= "627";
						$posts = "9";
						$Package = "Silver Package - $627";

					}else{

						$cost= "209";
						$posts = "3";
						$Package = "Silver Package - $209";

					}
					$Package_2 = "SILVER PACKAGE";


                }elseif($boost_type == "Bronze")
				{

					if($goal == 1){ $patient_referred = '2-4';}
					if($goal == 2){ $patient_referred = '1-2';}
					if($goal == 3){ $patient_referred = '1';}
					if($goal == 4){ $patient_referred = '1';}
					if($goal == ""){ $patient_referred = '1';}


					if($camp_length == "Two Month"){

						 $cost= "118";
						 $posts = "2";
						 $Package = "Bronze Package - $118";

					}elseif($camp_length == "Three Month"){

						$cost= "177";
						$posts = "3";
						$Package = "Bronze Package - $177";

					}else{

						$cost= "59";
						$posts = "1";
						$Package = "Bronze Package - $59";

					}
					$Package_2 = "BRONZE PACKAGE";


                }elseif($boost_type == "Diamond")
				{
					if($goal == 1){ $patient_referred = '100-120';}
					if($goal == 2){ $patient_referred = '70-90';}
					if($goal == 3){ $patient_referred = '40-60';}
					if($goal == 4){ $patient_referred = '2-20';}
					if($goal == ""){ $patient_referred = '50-60';}


					if($camp_length == "Two Month"){

						 $cost= "6118";
						 $posts = "120";
						 $Package = "Diamond Package - $6,118";

					}elseif($camp_length == "Three Month"){

						$cost= "9177";
						$posts = "180";
						$Package = "Diamond Package - $9,177";

					}else{

						$cost= "3059";
						$posts = "60";
						$Package = "Diamond Package - $3,059";

					}
					$Package_2 = "DIAMOND PACKAGE";


                }
				else{}

              if ($_REQUEST['message_suite_247']) {
                  $message_suite_247 = "Enabled";
                  $cost = intval($cost) + 247;
              } else {
                  $message_suite_247 = "Disabled";
              }


$subject = "StudyKIK Proposal ".$Package;

$message .= "
<body>

<table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>

  <tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>StudyKIK Proposal</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Full Name:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$fullname."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Email:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$email."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$phoneno."</td>

  </tr>
<tr></tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$websiteaddress."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Organization:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$organization ."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Protocol Number:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$protocolnumber ."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Indication:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$indication."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Campaign Length:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$camp_length."</td>

  </tr>";
  /*if($sp_email !=""){
	  $message .= "<tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Sponsor Email:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sp_email."</td>

  </tr>";
	  }
	  if($cr_email !=""){
	  $message .= "<tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>CRO Email:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$cr_email."</td>

  </tr>";
	  }*/
        if($sp_email !=""){
          $message .= "<tr style='color:#000; font-size:12px;'>
   <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Sponsor Email:</strong></td>
   <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sp_email."</td>
   </tr>";
        }else{
          $message .= "<tr style='color:#000; font-size:12px;'>
   <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Sponsor Email:</strong></td>
   <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'></td>
   </tr>";
        }

        if($cr_email !=""){
          $message .= "<tr style='color:#000; font-size:12px;'>
      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>CRO Email:</strong></td>
      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$cr_email."</td>
    </tr>";
        }else{
          $message .= "<tr style='color:#000; font-size:12px;'>
      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>CRO Email:</strong></td>
      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'></td>
    </tr>";
        }
              $message .= "<tr style='color:#000; font-size:12px;'>
   <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Patient Messaging Suite ($247):</strong></td>
   <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".($message_suite_247 == "Enabled" ? "Yes" : "No")."</td>
   </tr>";

  $message .= "<tr>

    <td height='5' colspan='3' align='right' valign='middle'></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

</table>

</body>";




$message_pdf .= '<style type="text/css">
<!--
table
{
    width:  100%;
	margin-left:7px;
	margin-right:7px;
}
td {
    padding-top: .5em;
    padding-bottom: .5em;
}
-->
</style>';
$today_date = date('m.d.Y',strtotime('-4 hours'));
$myArray = explode(' ', $websiteaddress);

$message_pdf .= '<table border="0" cellpadding="10" cellspacing="0" >
        <tr>
            <th colspan="2"></th>
        </tr>
        <tr>
          <td style="float:left; margin:0 0 0 0px; padding:0 0 0 0;" width="20%"><img src="'.site_url().'/wp-content/themes/twentyfifteen/images/logo_pdf_.png"  width="370" height="62" /></td>
          <td valign="right" style="text-align:right; float:right;" width="40%"><span style="font-size:17px; font-weight:bold; color:#959ca2; float:right;  line-height: 19px;text-align:right; margin:0px 0 0 80px;">'.$organization.'<br /> PROPOSAL - '.$today_date.'<br />Protocol Number - '.$protocolnumber.'</span></td>
        </tr>
		 <tr>
            <td colspan="2"></td>
        </tr>

		 <tr>
            <th colspan="2"><p style="font-size:16px; line-height: 19px; font-weight:bold; float:left; margin:8px 0 0;color:#959ca2;">INDICATION: <span style="font-weight:normal;font-size:15px; color:#bdbec1;">'.$indication_final.'</span></p></th>
        </tr>

		<tr>
            <td colspan="2"><p style="font-size:16px; line-height: 19px; font-weight:bold; float:left; margin:8px 0 0;color:#959ca2;">PACKAGE OPTIONS: <span style="font-weight:normal; font-size:15px; color:#abce68;">'.$Package.' </span> <span style="font-weight:normal;font-size:16px; color:#bdbec1;">- '.$length_in_days.'  listing with '.$posts.' posts to our online social communities. Target radius is 25 miles from site address but may be modified based on patient outreach potential.</span></p></td>
        </tr>

		<tr>
            <td colspan="2"><p style="font-size:16px; line-height: 19px; font-weight:bold; float:left; margin:8px 0 0;color:#959ca2;">AVG. NUMBER OF PATIENTS REFERRED: <span style="font-weight:normal; font-size:15px; color:#abce68;">'.$patient_referred.'/month </span> <span style="font-weight:normal;font-size:15px; color:#bdbec1;">(numbers vary based on geography, indication,study criteria)</span></p></td>
        </tr>

		 <tr>
            <td colspan="2">&nbsp;&nbsp;</td>
        </tr>

		<tr  bgcolor="#00aeee" style="text-align:center; font-size:17px;color:#fff;">
          <th width="50%" style="border-right:2px solid #FFF; padding: 5px 0 5px 0; width:50%">'.$Package_2.'</th>
          <th width="50%" style="padding: 5px 0 5px 0;">LISTING DETAILS</th>
        </tr>

		<tr  bgcolor="#f3f3f4" style="text-align:center; font-size:16px;color:#959ca2;">
          <td width="50%" style="border-right:2px solid #959ca2; padding: 5px 0 5px 0; width:50%">Timeline</td>
          <td width="50%" style="padding: 5px 0 5px 0;">'.$length_in_days.'</td>
        </tr>

		<tr  bgcolor="#e7e7e8" style="text-align:center; font-size:16px;color:#959ca2;">
          <td width="50%" style="border-right:2px solid #959ca2; padding: 5px 0 5px 0; width:50%">Community Posts</td>
          <td width="50%" style="padding: 5px 0 5px 0;">'.$posts.'</td>
        </tr>
        <tr  bgcolor="#f3f3f4" style="text-align:center; font-size:16px;color:#959ca2;">
          <td width="50%" style="border-right:2px solid #959ca2; padding: 5px 0 5px 0; width:50%">Patient Messaging Suite ($247)</td>
          <td width="50%" style="padding: 5px 0 5px 0;">'.$message_suite_247.'</td>
        </tr>
        <tr  bgcolor="#e7e7e8" style="text-align:center; font-size:16px;color:#959ca2;">
          <th width="50%" style="border-right:2px solid #959ca2; padding: 5px 0 5px 0; width:50%">TOTAL COST</th>
          <th width="50%" style="padding: 5px 0 5px 0;">$'.number_format( $cost ,  2 ,  '.' ,  ',' ).'</th>
        </tr>

	  </table>
	  <table cellpadding="0" cellspacing="0">
	  <tr>
          <th><p style="font-size:17px; line-height: 19px; font-weight:bold; float:left; color:#959ca2;">SITE INFORMATION:</p></th>
          <th><p style="font-size:17px; line-height: 19px; font-weight:bold; margin:17px 0 0 20px; float:left; color:#959ca2;">OUTREACH STRATEGY:</p></th>
      </tr>
	  <tr>
          <td width="20%"><p style="font-size:16px;line-height: 19px;  float:left; word-break: break-all;"><span style="color:#f78f1e;">Contact Person:</span><br/><span style="color:#bdbec1;">'.$fullname1.'</span><br/><span style="color:#bdbec1;">'.$fullname2.'</span></p></td>
          <td width="80%"><p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;"> - A unique and mobile-friendly landing page will be created for this study and hosted on<br />our secure website under the searchable headings <span style="color:#abce68;">"'.$indication_final.'"</span></p>
          <p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;"> - No mention of the Sponsor name, study name, or study specifics will be mentioned<br /> in any online post.</p></td>
        </tr>
		<tr>
          <td width="20%"><p style="font-size:16px;line-height: 19px; float:left; word-break: break-all;"><span style="color:#f78f1e;">Address:</span><br/><span style="color:#bdbec1;">'.$websiteaddress1.'</span><br/><span style="color:#bdbec1;">'.$websiteaddress2.'</span></p></td>
          <td width="80%">
		 
		  <p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;"> - Traffic will be driven from our various online communities to our website and the<br /> unique study landing page.</p>
		  <p style="color:#bdbec1;font-size:7px; line-height:10px !important;  margin:0px 0 0 17px !important; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
		  </td>
        </tr>
		 
		<tr>
          <td width="20%"><p style="font-size:16px;line-height: 19px; float:left;"><span style="color:#f78f1e;">Phone Number:</span><br/><span style="color:#bdbec1;">'.$phoneno1.'</span><br/><span style="color:#bdbec1;">'.$phoneno2.'</span></p></td>
          <td width="80%"><p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;">- Patient information, once entered, is sent immediately to the site via email.</p>

		  <p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;">- Patients receive a text message and email with the site contact phone number and<br /> email address.</p> <p style="color:#bdbec1;font-size:7px; line-height:10px !important;  margin:0px 0 0 17px !important; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
		  </tr>

		  <tr>
          <td width="20%"></td>
          <td width="80%"> <p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;">- All social media icons on the dedicated landing page will be enabled to ensure <br />larger patient reach and organic social traffic. </p>
		  <p style="color:#bdbec1;font-size:7px; line-height:10px !important;  margin:0px 0 0 17px !important; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
		  </td>
        </tr>

		<tr>
          <td width="20%"><p style="color: #959ca2; float: left; font-weight:bold; font-size: 14px;"><br/>ALL QUESTIONS CAN<br/>BE DIRECTED TO<br/>STUDYKIK:</p></td>
          <td width="80%">  <p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;">- No adverse event reporting will be possible since all study information will be <br /> hosted directly on our website, with no mention of the study name,<br /> sponsor,or study specifics.</p>

		   <p style="color:#959ca2;font-size:16px; line-height: 20px; font-weight:bold; margin:5px 0 0 17px; float:left;">START-UP:</p>
		   <p style="color:#bdbec1;font-size:7px; line-height:10px !important;  margin:0px 0 0 17px !important; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
		  </td>
        </tr>

		 <tr>
             <td colspan="2"><img src="'.site_url().'/wp-content/themes/twentyfifteen/images/Proposal_bottom.png" style="width:99.8%;margin-left:-8px; height:325px;"  /></td>
		  </tr>

		</table> ';

$subject_pdf_email = "Your ".$indication." Study Proposal from StudyKIK";
$pdf_email_text .= "
Hi ".$fullname.",<br /><br />

Thank you for your request.<br /><br />

Please see the attached document for your ".$indication." study proposal.<br /><br />

If you have any questions please contact your Project Manager or call us at 1-877-627-2509.<br /><br />

We look forward to working with you on this trial!<br /><br />

Thank you!<br /><br />

StudyKIK<br />
1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
info@studykik.com<br />
1-877-627-2509<br /><br /><br />
<img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png' />
";

$headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
$headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
$headers_pdf[] = "MIME-Version: 1.0\r\n";
$headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";

        require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
	    $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($message_pdf);
		//ob_end_clean();
		$rand= rand();
        $html2pdf->Output( dirname(__FILE__)."/pdf/".$rand.' StudyKIK Proposal'.".pdf", "f");
		$pdf_attachment_path = dirname(__FILE__)."/pdf/".$rand.' StudyKIK Proposal'.".pdf";
		$attachments[] = dirname(__FILE__)."/pdf/".$rand.' StudyKIK Proposal'.".pdf";

        $email_recipients = array();
        $email_recipients[] = $email;

        if($sp_email){
          $email_recipients[] = $sp_email;
        }
        if($cr_email){
          $email_recipients[] = $cr_email;
        }
        wp_mail($email_recipients,$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);

		$pdf_email_text = "";
		$message_pdf = "";

$headers[] = 'From: '.$fullname.' <info@studykik.com>';;
//$headers[] = 'Reply-To: '.$fullname.' <'.$email.'>';
$headers[] = "MIME-Version: 1.0\r\n";
$headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
$SendEmail=wp_mail('info@studyKIK.com',$subject,$message,$headers,$attachments);
//$SendEmail= wp_mail('keshvendersingh145@gmail.com',$subject, $message,$headers,$attachments);


}

		  ?>
        </div>

      </div>

    </section>

  </div>

  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#contactform').submit(function() {

    var errors = 0;

    $("#contactform .required").map(function(){

         if( !$(this).val() ) {

              $(this).addClass('warning');

              errors++;

        } else if ($(this).val()) {

              $(this).removeClass('warning');

        }

    });

    if(errors > 0){ //alert()

       //$('#errorwarn').text("All fields are required");

        return false;

    }

    // do the ajax..

});
$(".new_Cat").hide();
$( "#Indication_dropdown" ).change(function() {
  var dropd = this.value;
 if(dropd =="Other Study Type")
 {
	$(".new_Cat").show();
 }else{
	$(".new_Cat").hide();
 }
});
});

</script>
<?php get_footer('dashboard');?>
<?php if($SendEmail){?>
<div id="embed" class="white_content" style="display: block;">
    <h2 class="heading">Thank you</h2>
    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Thank you for your request! Your proposal will be emailed to you within the next few minutes.</p>
      <input onclick="document.getElementById('embed').style.display='none';document.getElementById('fade').style.display='none'" class="close_button" type="button" value="CLOSE"/>

    </div><div id="fade" class="black_overlay"></div>
<?php } ?>