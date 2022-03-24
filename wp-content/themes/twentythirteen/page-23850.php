<?php get_header(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/fonts/font2/font.css" type="text/css" rel="stylesheet">
<style>
/*proposal css start*/
.study_proposal{
	float: left;
    height: 800px;
    padding: 40px 0;
    width: 100%;
}
.proposal_left {
    left: 152px;
    position: relative;
    width: 50%;
}
.proposal_left img {
	width:100%;
}
.get_proposal{
	 position: absolute;
    right: 72px;
    top: 279px;
    width: 50%;
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
	background: #00afef;
    border: medium none;
    color: #fff;
    float: right;
    font-family: alternate;
    font-size: 33px;
    margin: 10px 34% 10px 0;
    padding: 0 26px;
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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


$( "#Indication_dropdown" ).change(function() {
  var dropd = this.value; 
  alert(dropd);
});

});

</script>


<div id="inner-page">
  <div class="container">
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
            <span class="drop-cus">
            <select class="required" name="indication" id="Indication_dropdown">
              <option value="">Select Indication</option>
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
                      <option value="Other Study Type">Other Study Type</option>
            </select>
            </span> <br>
            <input class="required" type="text" placeholder="Enter Your Indication Name" name="indication_name" style="display:none;" id="Enter_name">
            <select class="required" name="boost_type" id="Indication_dropdown">
              <option value="">Select Exposure Level</option>
            <option value="Diamond">Diamond: $3059</option>
            <option value="Platinum">Platinum: $1559</option>
            <option value="Gold">Gold: $559</option>
            <option value="Silver">Silver: $209</option>
            <option value="Bronze">Bronze: $59</option>
            
            </select>
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
			$indication = $_REQUEST['indication']; 
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
					
					$Package = "Platinum Package - $1,559";
					$cost= "$1,559";
					
                }elseif($boost_type == "Gold")
				{
				
				    if($goal == 1){ $patient_referred = '15-20';}
					if($goal == 2){ $patient_referred = '10-15';}
					if($goal == 3){ $patient_referred = '20-30';}
					if($goal == 4){ $patient_referred = '1-5';}	
					
					$Package = "Gold Package - $559";
					$cost= "$559";
					
                }elseif($boost_type == "Silver")
				{
					if($goal == 1){ $patient_referred = '5-10';}
					if($goal == 2){ $patient_referred = '2-4';}
					if($goal == 3){ $patient_referred = '1-2';}
					if($goal == 4){ $patient_referred = '1';}
					
					$Package = "Silver Package - $209";
					$cost= "$209";
					
                }elseif($boost_type == "Bronze")
				{
					
					if($goal == 1){ $patient_referred = '2-4';}
					if($goal == 2){ $patient_referred = '1-2';}
					if($goal == 3){ $patient_referred = '1';}
					if($goal == 4){ $patient_referred = '1';}
					
					$Package = "Bronze Package - $59";
					$cost= "$59";
					
                }elseif($boost_type == "Diamond")
				{
					if($goal == 1){ $patient_referred = '100-120';}
					if($goal == 2){ $patient_referred = '70-90';}
					if($goal == 3){ $patient_referred = '40-60';}
					if($goal == 4){ $patient_referred = '2-20';}
					
					$Package = "Diamond Package - $3,059";
					$cost= "$3,059";
					
                }
				else{}
			
			
			
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
  
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$websiteaddress."</td>

  </tr>
  
   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Organization:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$organization ."</td>

  </tr>
  
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type."</td>

  </tr>
  
   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Indication:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$indication."</td>

  </tr>
  <tr>

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
	margin-left:20px;
}

-->
</style>'; 
$today_date = date("d.m.Y");
$myArray = explode(' ', $websiteaddress);

$message_pdf .= '<table border="0" cellpadding="10" cellspacing="0" >
        <tr>
            <th colspan="2"></th>
        </tr>
        <tr>
          <td style="float:left; margin:0 0 0 0px; padding:0 0 0 0;" width="20%"><img src="http://studykik.com/wp-content/themes/twentythirteen/images/logo_pdf_.png"  width="370" height="62" /></td>
          <td valign="right" style="text-align:right; float:right;" width="40%"><span style="font-size:17px; font-weight:bold; color:#959ca2; float:right;  line-height: 22px;text-align:right; margin:17px 0 0 80px;">'.$organization.'<br /> PROPOSAL - '.$today_date.'</span></td>
        </tr>
		 <tr>
            <td colspan="2"></td>
        </tr>
		
		 <tr>
            <th colspan="2"><p style="font-size:17px; line-height: 22px; font-weight:bold; float:left; margin:25px 0 0;color:#959ca2;">INDICATION: <span style="font-weight:normal;font-size:16px; color:#bdbec1;">'.$indication_final.'</span></p></th>
        </tr>
		
		<tr>
            <td colspan="2"><p style="font-size:17px; line-height: 22px; font-weight:bold; float:left; margin:25px 0 0;color:#959ca2;">PACKAGE OPTIONS: <span style="font-weight:normal; font-size:16px; color:#abce68;">'.$Package.' </span> <span style="font-weight:normal;font-size:16px; color:#bdbec1;">- 30 day listing with 30 posts each month to our online social communities. Target radius is 25 miles from site address but may be modified based on patient outreach potential.</span></p></td>
        </tr>
		
		<tr>
            <td colspan="2"><p style="font-size:17px; line-height: 22px; font-weight:bold; float:left; margin:25px 0 0;color:#959ca2;">AVG. NUMBER OF PATIENTS REFERRED: <span style="font-weight:normal; font-size:16px; color:#abce68;">'.$patient_referred.'/month </span> <span style="font-weight:normal;font-size:16px; color:#bdbec1;">(numbers vary based on geography, indication,study criteria)</span></p></td>
        </tr>
		
		 <tr>
            <td colspan="2">&nbsp;&nbsp;</td>
        </tr>
		
		 <tr>
            <td colspan="2">&nbsp;&nbsp;</td>
        </tr>
		
		<tr  bgcolor="#00aeee" style="text-align:center; font-size:18px;color:#fff;">
          <th width="50%" style="border-right:2px solid #FFF; padding: 10px 0 10px 0; width:50%">PLATINUM PACKAGE</th>
          <th width="50%" style="padding: 10px 0 10px 0;">LISTING DETAILS</th>
        </tr>
		
		<tr  bgcolor="#f3f3f4" style="text-align:center; font-size:16px;color:#959ca2;">
          <td width="50%" style="border-right:2px solid #959ca2; padding: 10px 0 10px 0; width:50%">Timeline</td>
          <td width="50%" style="padding: 10px 0 10px 0;">30 Days</td>
        </tr>
		
		<tr  bgcolor="#e7e7e8" style="text-align:center; font-size:16px;color:#959ca2;">
          <td width="50%" style="border-right:2px solid #959ca2; padding: 10px 0 10px 0; width:50%">Community Posts</td>
          <td width="50%" style="padding: 10px 0 10px 0;">30</td>
        </tr>
		
		<tr  bgcolor="#f3f3f4" style="text-align:center; font-size:17px;color:#959ca2;">
          <th width="50%" style="border-right:2px solid #959ca2; padding: 10px 0 10px 0; width:50%">TOTAL COST</th>
          <th width="50%" style="padding: 10px 0 10px 0;">'.$cost.'</th>
        </tr>
		
		<tr>
            <td colspan="2">&nbsp;&nbsp;</td>
        </tr>
		
	  </table>
	  <table cellpadding="10" cellspacing="0">
	  <tr>
          <th><p style="font-size:17px; line-height: 22px; font-weight:bold; float:left; color:#959ca2;">SITE INFORMATION:</p></th>
          <th><p style="font-size:17px; line-height: 22px; font-weight:bold; margin:17px 0 0 20px; float:left; color:#959ca2;">OUTREACH STRATEGY:</p></th>
      </tr>
	  <tr>
          <td width="20%"><p style="font-size:16px;line-height: 22px;  float:left;"><span style="color:#f78f1e;">Contact Person:</span><br/><span style="color:#bdbec1;">'.$fullname.'</span></p></td>
          <td width="80%"><p style="color:#bdbec1;font-size:15px; line-height: 20px;  margin:17px 0 0 17px; float:left;"> - A unique and mobile-friendly landing page will be created for this study<br /> and hosted on our secure website under the searchable headings <br />"'.$indication_final.'"</p></td>
        </tr>
		
		<tr>
          <td width="20%"><p style="font-size:16px;line-height: 22px; float:left;"><span style="color:#f78f1e;">Address:</span><br/><span style="color:#bdbec1;">'.$myArray['0'].' '.$myArray['1'].' '.$myArray['2'].'<br/>'.$myArray['3'].' '.$myArray['4'].' '.$myArray['5'].'<br/>'.$myArray['6'].' '.$myArray['7'].' '.$myArray['8'].'</span></p></td>
          <td width="80%"><p style="color:#bdbec1;font-size:15px; line-height: 20px;  margin:10px 0 0 17px; float:left;"> - No mention of the Sponsor name, study name, or study specifics will be <br /> mentioned in any online post.</p>
		  <p style="color:#bdbec1;font-size:16px; line-height: 20px;  margin:10px 0 0 17px; float:left;"> - Traffic will be driven from our various online communities to our<br /> website and the unique study landing page.</p>
		  </td>
        </tr>
		
		<tr>
          <td width="20%"><p style="font-size:16px;line-height: 22px; float:left;"><span style="color:#f78f1e;">Phone Number:</span><br/><span style="color:#bdbec1;">'.$phoneno.'</span></p></td>
          <td width="80%"><p style="color:#bdbec1;font-size:15px; line-height: 20px;  margin:10px 0 0 17px; float:left;">- Patient information, once entered, is sent immediately to the site via email.</p>
		  
		  <p style="color:#bdbec1;font-size:15px; line-height: 20px;  margin:10px 0 0 17px; float:left;">- Patients receive a text message and email with the site contact phone <br />number and email address.</p> </td>
		  </tr>
		  
		  <tr>
          <td width="20%"></td>
          <td width="80%"> <p style="color:#bdbec1;font-size:15px; line-height: 20px;  margin:10px 0 0 17px; float:left;">- All social media icons on the dedicated landing page will be enabled to<br /> ensure larger patient reach and organic social traffic. </p>
		  </td>
        </tr>
		
		<tr>
          <td width="20%"><p style="color: #959ca2; float: left; font-weight:bold; font-size: 18px;"><br/>ALL QUESTIONS CAN<br/>BE DIRECTED TO<br/>STUDYKIK:</p></td>
          <td width="80%">  <p style="color:#bdbec1;font-size:15px; line-height: 20px;  margin:10px 0 0 17px; float:left;">- No adverse event reporting will be possible since all study information will<br /> be hosted directly on our website, with no mention of the study name,<br /> sponsor,or study specifics.</p>
		  
		   <p style="color:#959ca2;font-size:18px; line-height: 20px; font-weight:bold; margin:20px 0 0 17px; float:left;">START-UP:</p>
		  </td>
        </tr>
		
		 <tr>
          <td width="20%"><p style="font-size:16px;line-height: 22px; float:left;"><span style="color:#00aeef;">Phone:</span><br/><span style="color:#bdbec1;">877.627.2509</span></p></td>
          <td width="80%"><p style="color:#afd575;font-size:16px; line-height: 20px;  margin:10px 0 0 17px; float:left;">Study will go live 24 hours after receiving the following materials:</p> </td>
		  </tr>
		 
		   <tr>
          <td width="20%"><p style="font-size:16px;line-height: 22px; float:left;"><span style="color:#00aeef;">Email:</span><br/><span style="color:#bdbec1;">info@StudyKIK.com</span></p></td>
          <td width="80%"><p style="color:#bdbec1;font-size:16px; line-height: 20px;  margin:10px 0 0 17px; float:left;">- IRB approved ad or text </p>
		  <p style="color:#bdbec1;font-size:16px; line-height: 20px;  margin:10px 0 0 17px; float:left;">- Payment information</p>
		  <p style="color:#bdbec1;font-size:16px; line-height: 20px;  margin:10px 0 0 17px; float:left;">- Site address and contact information</p> </td>
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
info@studykik.com<br />
1-877-627-2509<br />
<img src='http://studykik.com/wp-content/themes/twentythirteen/images/logo.png' />
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
		wp_mail($email,$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);  
		wp_mail("sunny@elitenetsoft.com",$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path); 
		$pdf_email_text = "";
		$message_pdf = "";

$headers[] = 'From: '.$fullname.' <info@studykik.com>';;
$headers[] = 'Reply-To: '.$fullname.' <'.$email.'>';
$headers[] = "MIME-Version: 1.0\r\n";
$headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
wp_mail('info@studyKIK.com',$subject,$message,$headers,$attachments);
$SendEmail= wp_mail('sunny@elitenetsoft.com',$subject, $message,$headers,$attachments);

}
		  
		  ?>
        </div>               

      </div>
      
    </section>
   
  </div>
  <!-- #content --> 
   
</div>
<!-- #primary -->

<?php get_footer(); ?>
<?php if($SendEmail){?>
<div id="embed" class="white_content" style="display: block;">
    <h2 class="heading">Thank you</h2>
    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Thank you for Submitting Your Proposal! Please Check Your Email and We Look Forward to Listing Your Study Soon!</p>
      <input style="margin: 10px 42% 10px 0;"  onclick="document.getElementById('embed').style.display='none';document.getElementById('fade').style.display='none'" class="close_button" type="button" value="CLOSE"/>
      
    </div><div id="fade" class="black_overlay"></div>
    <?php } ?> 
