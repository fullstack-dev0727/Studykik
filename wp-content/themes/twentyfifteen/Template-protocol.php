<?php
/*
 * Template Name: Studykik Protocol
 */
get_header(); ?>
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
    left: 20px;
    position: relative;
}
.proposal_left img {
    width:100%;
}
.get_proposal{
    position: absolute;
    left: 27%;
    top: 43%;
    width: 70%;
}
#Enter_name{
    background: #e8e8e8 none repeat scroll 0 0;
    border: medium none;
    box-shadow: 3px 3px 5px #bbbbbb inset;
    height: 46px;
    margin-bottom: 12px;
    padding: 0 10px;
    width: 100%;
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
}
.btn_proposal{
    background: rgba(0, 0, 0, 0) url("<?php bloginfo('template_url');?>/images/get_report_blue.png") no-repeat scroll 0 0;
    border: medium none;
    font-size: 0;
    height: 54px;
    max-width: 244px;
    width: 100%;
    cursor: pointer;
    background-size: contain;
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
    display: none;
    height: 3400px;
    left: 0;
    opacity: 0.8;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 5;
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
    background: transparent url("<?php bloginfo('template_url');?>/images-dashboard/green_close.png") no-repeat scroll 0 0;
    width: 136px;
    height: 51px;
    bottom: 20px;    
    right: 20px;  
    top: auto;  
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
.drop-cus{ margin-bottom:0px;}
#email_confirmation {
    display: none;
    position: fixed;
    top: calc(50% - 215px);
    left: calc(50% - 310px);
    z-index: 9;
    padding: 20px 20px 74px 20px;
    background-color: white;
    border-radius: 5px;
    -webkit-border-radius: 5px;
}
.email_container {
    width:  600px;
    /*height: 410px;*/
    display: block;
    /*background-image: url("<?php bloginfo('template_url');?>/images-dashboard/email_confirmation.png");*/
    background-size: contain;
    background-repeat: no-repeat;
}
.email_container img { width: 100%;}
@media screen and (max-width: 767px) {
    .proposal_left { left: 0; }
    #email_confirmation {  top: 10%; width: 90%; left: 5%;}
    .email_container { width:100%;}
}
@media screen and (max-width: 500px) {
    #Enter_name { font-size: 12px;}
}
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#contactform').submit(function(e) {
    e.preventDefault();
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

    var contact = {
        fullname: jQuery('.fullname').val(),
        email: jQuery('.email').val(),
        company: jQuery('.company').val(),
        protocolnumber: jQuery('.protocolnumber').val()
    }

    jQuery.ajax({
        async: true,
        url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
        type:'POST',
        data: {
            action: "protocol_mail",
            contact: contact
        },
        dataType: "json",
        success: function(res){
            console.log(res);
            jQuery('#email_confirmation').css('display', 'block');
            jQuery('#fade').css('display', 'block');

            jQuery("#contactform").trigger("reset");
        }
    });

});
// $(".new_Cat").hide();
// $( "#Indication_dropdown" ).change(function() {
//   var dropd = this.value;
//  if(dropd =="Other Study Type")
//  {
//     $(".new_Cat").show();
//  }else{
//     $(".new_Cat").hide();
//  }
// });
});

</script>
<div id="inner-page">
  <div class="container">
    <div id="fade" class="black_overlay"></div>
    <div id="email_confirmation">   
        <div class="email_container">
            <img src="<?php bloginfo('template_url');?>/images-dashboard/email_confirmation.png" />
            <a href="javascript:void(0);" class="closepop" onclick="document.getElementById('email_confirmation').style.display = 'none'; document.getElementById('fade').style.display = 'none';"></a>
        </div>
    </div>  
    <section class="study_proposal">
      <div class="proposal_left"> <img alt="" src="<?php bloginfo('template_url');?>/images/protocol.png">
        <div class="get_proposal">
          <form action="" method="post" id="contactform">
            <input class="required fullname" type="text" placeholder="Enter Your First &amp; Last Name" name="fullname" id="Enter_name">
            <br>
            <input class="required email" type="email" placeholder="Enter Your Email Address" name="email" id="Enter_name">
            <br>
            <input class="company" type="text" placeholder="Enter Your Company Name" name="company" id="Enter_name">
            <br>
            <input class="protocolnumber" type="text" placeholder="Enter Your Protocol Number" name="protocolnumber" id="Enter_name">
            <br>
            <input type="submit" value="Submit" name="btn_proposal" class="btn_proposal">
          </form>
                    <?php

          if(isset($_REQUEST['btn_proposal']))
          {
            $fullname = $_REQUEST['fullname'];
            $email = $_REQUEST['email'];
            $phoneno = $_REQUEST['phoneno'];
            $websiteaddress = $_REQUEST['websiteaddress'];
            $organization = $_REQUEST['organization'];
            $camp_length = $_REQUEST['camp_length'];
            $sp_email = $_REQUEST['sponsoremail'];
            $cr_email = $_REQUEST['croemail'];

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

                         $cost= "$3,118";
                         $posts = "60";
                         $Package = "Platinum Package - $3,118";

                    }elseif($camp_length == "Three Month"){

                        $cost= "$4,677";
                        $posts = "90";
                        $Package = "Platinum Package - $4,677";

                    }else{

                        $cost= "$1,559";
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

                         $cost= "$1,118";
                         $posts = "20";
                         $Package = "Gold Package - $1,118";

                    }elseif($camp_length == "Three Month"){

                        $cost= "$1,677";
                        $posts = "30";
                        $Package = "Gold Package - $1,677";

                    }else{

                        $cost= "$559";
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

                         $cost= "$418";
                         $posts = "6";
                         $Package = "Silver Package - $418";

                    }elseif($camp_length == "Three Month"){

                        $cost= "$627";
                        $posts = "9";
                        $Package = "Silver Package - $627";

                    }else{

                        $cost= "$209";
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

                         $cost= "$118";
                         $posts = "2";
                         $Package = "Bronze Package - $118";

                    }elseif($camp_length == "Three Month"){

                        $cost= "$177";
                        $posts = "3";
                        $Package = "Bronze Package - $177";

                    }else{

                        $cost= "$59";
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

                         $cost= "$6,118";
                         $posts = "120";
                         $Package = "Diamond Package - $6,118";

                    }elseif($camp_length == "Three Month"){

                        $cost= "$9,177";
                        $posts = "180";
                        $Package = "Diamond Package - $9,177";

                    }else{

                        $cost= "$3,059";
                        $posts = "60";
                        $Package = "Diamond Package - $3,059";

                    }
                    $Package_2 = "DIAMOND PACKAGE";


                }
                else{}



$subject = "StudyKIK Protocol";

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
}
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
$today_date = date("m.d.Y");
$myArray = explode(' ', $websiteaddress);

$message_pdf .= '<table border="0" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th colspan="2"></th>
        </tr>
        <tr>
          <td style="float:left; margin:0 0 0 0px; padding:0 0 0 0;" width="20%"><img src="'.site_url().'/wp-content/themes/twentyfifteen/images/logo_pdf_.png"  width="370" height="62" /></td>
          <td valign="right" style="text-align:right; float:right;" width="40%"><span style="font-size:17px; font-weight:bold; color:#959ca2; float:right;  line-height: 22px;text-align:right; margin:0px 0 0 80px;">'.$organization.'<br /> PROPOSAL - '.$today_date.'<br />Protocol Number - '.$protocolnumber.'</span></td>
        </tr>
         <tr>
            <td colspan="2"></td>
        </tr>

         <tr>
            <th colspan="2"><p style="font-size:16px; line-height: 22px; font-weight:bold; float:left; margin:8px 0 0;color:#959ca2;">INDICATION: <span style="font-weight:normal;font-size:15px; color:#bdbec1;">'.$indication_final.'</span></p></th>
        </tr>

        <tr>
            <td colspan="2"><p style="font-size:16px; line-height: 22px; font-weight:bold; float:left; margin:8px 0 0;color:#959ca2;">PACKAGE OPTIONS: <span style="font-weight:normal; font-size:15px; color:#abce68;">'.$Package.' </span> <span style="font-weight:normal;font-size:16px; color:#bdbec1;">- '.$length_in_days.'  listing with '.$posts.' posts to our online social communities. Target radius is 25 miles from site address but may be modified based on patient outreach potential.</span></p></td>
        </tr>

        <tr>
            <td colspan="2"><p style="font-size:16px; line-height: 22px; font-weight:bold; float:left; margin:8px 0 0;color:#959ca2;">AVG. NUMBER OF PATIENTS REFERRED: <span style="font-weight:normal; font-size:15px; color:#abce68;">'.$patient_referred.'/month </span> <span style="font-weight:normal;font-size:15px; color:#bdbec1;">(numbers vary based on geography, indication,study criteria)</span></p></td>
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
          <th width="50%" style="border-right:2px solid #959ca2; padding: 5px 0 5px 0; width:50%">TOTAL COST</th>
          <th width="50%" style="padding: 5px 0 5px 0;">'.$cost.'</th>
        </tr>

      </table>
<table cellpadding="0" cellspacing="0">
      <tr>
          <th><p style="font-size:17px; line-height: 22px; font-weight:bold; float:left; color:#959ca2;">SITE INFORMATION:</p></th>
          <th><p style="font-size:17px; line-height: 22px; font-weight:bold; margin:17px 0 0 20px; float:left; color:#959ca2;">OUTREACH STRATEGY:</p></th>
      </tr>
      <tr>
          <td width="20%"><p style="font-size:16px;line-height: 22px;  float:left;"><span style="color:#f78f1e;">Contact Person:</span><br/><span style="color:#bdbec1;">'.$fullname.'</span></p></td>
          <td width="80%"><p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;"> - A unique and mobile-friendly landing page will be created for this study and hosted on<br /> our secure website under the searchable headings <span style="color:#abce68;">"'.$indication_final.'"</span></p></td>
        </tr>
        <tr>
          <td width="20%"><p style="font-size:16px;line-height: 22px; float:left;"><span style="color:#f78f1e;">Address:</span><br/><span style="color:#bdbec1;">'.$myArray['0'].' '.$myArray['1'].' '.$myArray['2'].'<br/>'.$myArray['3'].' '.$myArray['4'].' '.$myArray['5'].'<br/>'.$myArray['6'].' '.$myArray['7'].' '.$myArray['8'].'</span></p></td>
          <td width="80%"><p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;"> - No mention of the Sponsor name, study name, or study specifics will be mentioned<br /> in any online post.</p>
         
          <p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;"> - Traffic will be driven from our various online communities to our website and the<br /> unique study landing page.</p>
          <p style="color:#bdbec1;font-size:7px; line-height:10px !important;  margin:0px 0 0 17px !important; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          </td>
        </tr>
         
        <tr>
          <td width="20%"><p style="font-size:16px;line-height: 22px; float:left;"><span style="color:#f78f1e;">Phone Number:</span><br/><span style="color:#bdbec1;">'.$phoneno.'</span></p></td>
          <td width="80%"><p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;">- Patient information, once entered, is sent immediately to the site via email.</p>
          

          <p style="color:#bdbec1;font-size:14px; line-height: 20px;  margin:2px 0 0 17px; float:left;">- Patients receive a text message and email with the site contact phone number and<br /> email address.</p><p style="color:#bdbec1;font-size:7px; line-height:10px !important;  margin:0px 0 0 17px !important; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> </td>
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

        //wp_mail("chandel.anku91@gmail.com",$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
        $pdf_email_text = "";
        $message_pdf = "";

$headers[] = 'From: '.$fullname.' <info@studykik.com>';;
//$headers[] = 'Reply-To: '.$fullname.' <'.$email.'>';
$headers[] = "MIME-Version: 1.0\r\n";
$headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
$SendEmail = wp_mail('info@studyKIK.com',$subject,$message,$headers,$attachments);

}

          ?>
        </div>

      </div>
  </div>
</div>

<?php get_footer();?>
<?php if($SendEmail){?>
<div id="embed" class="white_content" style="display: block;">
    <h2 class="heading">Thank you</h2>
    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Thank you for your request! Your proposal will be emailed to you within the next few minutes.</p>
      <input onclick="document.getElementById('embed').style.display='none';document.getElementById('fade').style.display='none'" class="close_button" type="button" value="CLOSE"/>

    </div><div id="fade" class="black_overlay"></div>
<?php } ?>