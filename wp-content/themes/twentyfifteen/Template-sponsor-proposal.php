<?php
/*
 * Template Name: Studykik Sponsor Proposal
 */
get_header(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/fonts/font2/font.css" type="text/css" rel="stylesheet">
<style>
    /*proposal css start*/
    .btn_invoice
    {
        background-color: orange;
        border: medium none;
        color: white;
        cursor: pointer;
        font-size: 35px;
        height: 54px;
        width: 244px;
    }
    .enter_css{
        background: #e8e8e8 none repeat scroll 0 0;
        border: medium none;
        box-shadow: 3px 3px 5px #bbbbbb inset;
        color: #f78f1e;
        font-size: 20px;
        height: 46px;
        margin-bottom: 12px;
        padding: 0 10px;
        width: 678px;
    }
    .study_proposal{
        float: left;
        min-height: 875px;
        padding: 40px 0;
        width: 100%;
    }
    .proposal_left {
        margin-left: 14.8%;
        position: relative;

    }
    .proposal_left img {
        width:100%;
    }
    .get_proposal{

        top: 30px;

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
    .repeat_month{
        background: #e8e8e8 none repeat scroll 0 0;
        border: medium none;
        box-shadow: 3px 3px 5px #bbbbbb inset;
        height: 46px;
        margin-bottom: 12px;
        padding: 0 10px;
        width:145px;
        color:#f78f1e;
        font-size: 20px;
    }
    input[type="checkbox"] {
        width: auto;
        transform: scale(1.5);
        box-shadow: none;
        height: 15px;
        margin-left:5px;
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
    .Indication_dropdown{
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
    
    
    
    .exposure_dropdown{
        border: medium none;
        box-shadow: 3px 3px 5px #bbbbbb inset;
        height: 46px;
        margin-bottom: 12px;
        padding: 0 10px;
        font-size: 20px;
        width: 172px;
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
    .drop-cus{ margin-bottom:0px;}
    #Enter_name1 {
    background: #e8e8e8 none repeat scroll 0 0;
    border: medium none;
    box-shadow: 3px 3px 5px #bbbbbb inset;
    color: #f78f1e;
    font-size: 20px;
    height: 46px;
    margin-bottom: 12px;
    padding: 0 10px;
    width: 678px;
}
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

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
<div id="inner-page">
<div class="container">
<section class="study_proposal">
<div class="proposal_left">
<div style="clear: both; margin-bottom: 25px; width: 85%;">
   <div href="" style="color: rgb(247, 143, 30); font-family: helveticaregular; font-size: 33px; text-align: center;"><span style="border-bottom:1px solid orange;">SPONSOR PROPOSAL</span></div></div>
<div class="get_proposal">
<form id="contactform_invoice" method="post" action="">
    <input class="required enter_css" id="datepicker1"  aria-required="true"  type="text" placeholder="Organization" name="organization">
    <br>
    <input class="required enter_css" id="datepicker2"  aria-required="true"  type="text" placeholder="Date" name="date">
    <br>
    <input class="required enter_css" id="datepicker3"  aria-required="true"  type="text" placeholder="Indication/Study" name="indication-study">
    <br>
    <input type="text" id="Enter_name" name="ruby-listing" placeholder="Ruby Listing" class="required">
    <br>
    <input type="text" id="Enter_name" name="diamond-listing" placeholder="Diamond Listing" class="required">
    <br>
    <input type="text" id="Enter_name" name="platinum-listing" placeholder="Platinum Listing" class="required">
    <br>
    <select id="no_months" name="no_months" class="required Indication_dropdown">
         <option value="">How many options</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>

    </select>
    
    <br>
        <select id="no_expose_level" name="no_expose_level" class="required Indication_dropdown">
         <option value="">How many exposure level</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>

    </select>
    <br>
    <div id="repeat_div">
    </div>
    
    <input type="text" id="Enter_name" name="indication" placeholder="Indication" class="required">
    
    <br>
    <select id="project_manager" name="project_manager" class="required Indication_dropdown">
         <option value="">Project Manager</option>
        <option value="Brian Kay (brian.kay@studykik.com 213.267.2027)">Brian Kay (brian.kay@studykik.com 213.267.2027)</option>
        <option value="Sam Haiden (sam.haiden@studykik.com 213.538.8215)">Sam Haiden (sam.haiden@studykik.com 213.538.8215)</option>
        <option value="Justin Shields (justin.shields@studykik.com 213.787.4881)">Justin Shields (justin.shields@studykik.com 213.787.4881)</option>
        <option value="Zack Metcalf (zack.metcalf@studykik.com 213.458.8993)">Zack Metcalf (zack.metcalf@studykik.com 213.458.8993)</option>
        <option value="Quinn Haskin (quinn.haskin@studykik.com)">Quinn Haskin (quinn.haskin@studykik.com)</option>
        <option value="Jessica Daniel (jessica.daniel@studykik.com)">Jessica Daniel (jessica.daniel@studykik.com)</option>

    </select>
            <span class="drop-cus">
           
            </span>

    <br>
    <input type="submit" class="btn_invoice" name="btn_proposal" value="Submit">
</form>
<?php
if(isset($_REQUEST['btn_proposal'])){
    //echo "<pre>";
    //print_r($_REQUEST);
    $organnization = stripslashes($_REQUEST["organization"]);
    $start_dt = stripslashes($_REQUEST["date"]);
    $indication_study = stripslashes($_REQUEST["indication-study"]);
    $websiteaddress = stripslashes($_REQUEST["websiteaddress"]);
    $ruby_listing = stripslashes($_REQUEST["ruby-listing"]);
    $diamond_listing = stripslashes($_REQUEST["diamond-listing"]);
    $platinum_listing = stripslashes($_REQUEST["platinum-listing"]);
    $n_months = stripslashes($_REQUEST["no_months"]);
    $no_expose_level = stripslashes($_REQUEST["no_expose_level"]);
    $repeat=$_REQUEST["repeat"];
    $indication = stripslashes($_REQUEST["indication"]);
    $project_manager = stripslashes($_REQUEST["project_manager"]);
    $man_details=explode(" (",$project_manager);
    $man_name=$man_details[0];
    $email_phone_details=explode(")",$man_details[1]);
    $email_phone=explode(" ",$email_phone_details[0]);
    $email=strtolower($email_phone[0]);
    $phone=$email_phone[1];
    $numbers=array();
    $numbers[1]='one';
    $numbers[2]='two';
    $numbers[3]='three';
    $numbers[4]='four';
    $numbers[5]='five';
    $numbers[6]='six';
    $numbers[7]='seven';
    $numbers[8]='eight';
    $numbers[9]='nine';
    $numbers[10]='ten';
    $numbers[11]='eleven';
    $numbers[12]='twelve';
    $numbers[13]='thirteen';
    $numbers[14]='fourteen';
    $numbers[15]='fifthteen';
    $numbers[16]='sixteen';
    $numbers[17]='seventeen';
    $numbers[18]='eighteen';
    $numbers[19]='nineteen';
    $numbers[20]='twenty';
    $pricess=array();
    $pricess['Bronze']=59;
    $pricess['Silver']=209;
    $pricess['Gold']=559;
    $pricess['Platinum']=1559;
    $pricess['Diamond']=3059;
    $pricess['Ruby']=5059;
    //
    $message .= "
<body>
        <table width='900' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>
                  <tr>
                    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>StudyKIK Sponsor Proposal</strong></td>
                  </tr>
                  <tr>
                    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
                  </tr>";
    if($organnization){
        $message .= "<tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Organization:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $organnization . "</td>
                    </tr>";
    }
    if($start_dt){
        $message .= "<tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Date:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $start_dt . "</td>
                    </tr>";
    }
    if($indication_study){
        $message .= "<tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Indication/study:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $indication_study . "</td>
                    </tr>";
    }
    if($ruby_listing){
        $message .= "<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Ruby Listing:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $ruby_listing . "</td>
                  </tr>";
    }
    if($diamond_listing){
        $message .= "<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Diamond Listing:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $diamond_listing . "</td>
                  </tr>";
    }
    if($platinum_listing){
        $message .= "<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Platinum Listing:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $platinum_listing . "</td>
                  </tr>";
    }

    if($n_months){
        $message .= " <tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> How Many Options?:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $n_months . "</td>
                  </tr>";
    }
    if($no_expose_level){
        $message .= " <tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> How Many Exposure Level?:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $no_expose_level . "</td>
                  </tr>";
    }

    if(($n_months && $no_expose_level)){
        $message .= " <tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Calculation:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>";
                    $cal_content="<div>";
                    foreach($repeat as $in => $rpt){
    if($in > 1){
        $cal_content.="<h5 style='font-weight: bold;margin-top:10px;margin-bottom:5px;'>Option ".$in."</h5>";
    }
    else{
        $cal_content.="<h5 style='font-weight: bold;margin-top:10px;margin-bottom:5px;'>Option ".$in."</h5>";
    }
    $cal_content.="<div>";
    foreach($rpt['exposure'] as $inn => $exp){
        $mnt=$exp['month'];
        $expr=$exp['exposure_level'];
        if(isset($numbers[$mnt])){
            $wrd=$numbers[$mnt];
        }
        else{
            $wrd=$mnt;
        }
        if($mnt >1){
            $nnn='months';
        }
        else{
            $nnn='month';
        }
        $amt=$pricess[$expr];
        $pms_txt = " with Patient Messaging Suite";
        if ($exp['pms']) {
            $amt_pms = 247;
            $cal_content.="<p style='margin:0px;'>".$exp["sites"]." sites @ ".$exp["exposure_level"].$pms_txt." for ".$wrd." ".$nnn." (($".$amt." + $".$amt_pms.") x ".$exp["sites"]." sites x ".$mnt." ".$nnn.")";
        } else {
            $amt_pms = 0;
            $cal_content.="<p style='margin:0px;'>".$exp["sites"]." sites @ ".$exp["exposure_level"]." for ".$wrd." ".$nnn." ($".$amt." x ".$exp["sites"]." sites x ".$mnt." ".$nnn.")";
        }


        $total_amt=($amt + $amt_pms) *$exp['sites']*$mnt;
        $rm_amount=$total_amt;
        if($exp['discount'] !=""){
            $disc_amt=(($total_amt*$exp['discount'])/100);
            $rm_amount=$total_amt-$disc_amt;
            $cal_content.="<span style='color:red;'> ".$exp["discount"]."% off ($".number_format($disc_amt,2,'.',',').")</span>";
        }
        $cal_content.=" = <span style='font-weight: bold;'>$".number_format($rm_amount,2,'.',',')."</span></p>";
    }
    $cal_content.="</div>";
}
$cal_content.="</div>";
                    $message .=$cal_content;
                    $message .="</td>
                  </tr>";
    }
    if($indication){
        $message .= "  <tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Indication:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $indication . "</td>
                  </tr>";
    }
    if($project_manager){
        $message .= " <tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Project Manager:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $project_manager . "</td>
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
$message_pdf=<<<EOF
  <head>
  <style>
	@font-face{font-family:"font-1"; src:url("http://testing.studykik.com/wp-content/themes/twentyfifteen/font_sponsor/calibril.ttf");}
	@font-face{font-family:"font-2"; src:url("http://testing.studykik.com/wp-content/themes/twentyfifteen/font_sponsor/calibri.ttf");}
	@font-face{font-family:"font-3"; src:url("http://testing.studykik.com/wp-content/themes/twentyfifteen/font_sponsor/calibrib.ttf");}
    </style>
  </head>
<body style="margin:0px;padding:0;">
<div>
    <table width="100%" background="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/bgbg.png" style=" background-position: center center;background-size: 100% 100%;">
        <tr><td style="height:23px;">&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
        <tr>
            <td style="padding-left:5%"><img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/logo.png" alt="" width="533" height="70"/><p style="font-weight:bold;margin: 0px; font-size: 25px; color: rgb(145, 151, 156);">INDICATION/STUDY: <span style="font-weight:normal;font-size: 22px; color: rgb(194, 194, 194);">
EOF;

             if($indication_study !=""){
        $message_pdf.=$indication_study;
    }
    $message_pdf.=<<<EOF
    <span></span></span></p></td>
            <td align="right" style="padding-right:5%">
                <p style="color:#9fcf68;
        font-family: font-3;
        font-size: 25px;
        line-height: 28px;
        margin: 0;
        text-transform: uppercase;">
EOF;
if($organnization !=""){
    $message_pdf.= $organnization;
}
$message_pdf.= <<<EOF
                </p>
                <p style="color:black;font-family: font-3;
        font-size: 25px;
        line-height: 28px;
        margin: 0;
        text-transform: uppercase;">CENTRAL CAMPAIGN PROPOSAL</p>
                <p style="color:black;font-family: font-3;
        font-size: 25px;
        line-height: 28px;
        margin: 0;
        text-transform: uppercase;">
EOF;
$message_pdf.= date('m.d.Y',strtotime($start_dt));
$message_pdf.= <<<EOF
</p>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2"><p style="color: #959ca1;font-family: font-3;font-size: 30px;margin: 0px;text-align: center;text-transform: uppercase;visibility:hidden;">Package option:</p></td>
        </tr>
        </table>
      </div>
<div style="background: rgba(0, 0, 0, 0) url('http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/triangle.png') repeat scroll 0 0;content: '';height: 27px;left: 0;position: absolute;top: 195px;width: 100%;"></div>
<div id="second_row" style="background: #a0cf68 none repeat scroll 0 0;float: left;width: 100%;position:relative;margin-top: 50px;">
	<div style="width: 1070px;margin: 0px;">
		<div style="float: left;width: 100%;">
			<table width="100%">
				<tr>
					<td width="74%"><p style=" color: #fff;
    font-family: font-2;
    font-size: 27px;
    font-weight: 600;
    margin: 0;
    padding-right: 130px;
    text-transform: uppercase;text-align:right;">Package options:</p></td>
					<td width="26%"><p style="color: #fff;
    font-family: font-2;
    font-size: 20px;
    margin: 18px 0 0px;
    text-align: center;">Estimated Patient Sign Ups<br/> Per 30 Day Listing, Per Site:</p></td>
				</tr>
			</table>
			 <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="100px" style="padding-left:40px;"><img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/d1.png" alt="" width="100" height="80"/></td>
            <td background="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/redbg.png" width="70%" style="background-size:100% 100%;background-position:center center;">
            <p style=" color: #fff;
    
    font-family: font-3;
    font-size: 30px;
    line-height: 45px;
    margin: 0;
    padding-left: 15px;
    text-shadow: 0 0 2px #a20020;
    text-transform: uppercase;
    width: 100%;">Ruby Listing ($5059 per site - 100 posts)</p>
            
            </td>
			<td width="30%" bgcolor="#F78F1E" style="padding: 0 70px;">
			<img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/man.png" alt="" style="float:left"/>
				<p style=" box-sizing: border-box;
    color: #fff;
   
    font-family: font-3;
    font-size: 34px;
    line-height: 43px;
    margin: 0;
    padding-left: 40px;
    text-align: center;
    text-transform: capitalize;
    width: 100%;">
 
EOF;
 
if($ruby_listing !=""){
    $message_pdf.=$ruby_listing;
}
$message_pdf.= <<<EOF
</p>
			</td>
        </tr>
		<tr><td><p style="margin-top:30px"></p></td></tr>
        <tr>
            <td width="100px" style="padding-left:40px;"><img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/d2.png" alt="" width="92" height="80"/></td>
            <td background="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/greybg.png" width="70%" style="background-size:100% 100%;background-position:center center;">
            <p style="color:#91979c;
    
    font-family: font-3;
    font-size: 30px;
    line-height: 45px;
    margin: 0;
    padding-left: 15px;
    text-shadow: 0 0 2px #91979c;
    text-transform: uppercase;
    width: 100%;">Diamond Listing ($3059 per site - 60 posts)</p>
	</td>
	<td width="30%" bgcolor="#F78F1E" style="padding: 0 70px;">
		<img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/man.png" alt="" style="float:left"/>
		<p style=" box-sizing: border-box;
    color: #fff;
    
    font-family: font-3;
    font-size: 34px;
    line-height: 43px;
    margin: 0;
    padding-left: 40px;
    text-align: center;
    text-transform: capitalize;
    width: 100%;">
EOF;
if($diamond_listing !=""){
    $message_pdf.=$diamond_listing;
}
$message_pdf.= <<<EOF
    </p>
	</td>
        </tr>
		<tr><td><p style="margin-top:40px"></p></td></tr>
        <tr>
            <td width="100px" style="padding-left:30px;"><img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/d3.png" alt="" width="100" height="80"/></td>
            <td background="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/ltbg.png" width="70%" style="background-size:100% 100%;background-position:center center;">
            <p style="color: #91979c;
  
    font-family: font-3;
    font-size: 30px;
    line-height: 45px;
    margin: 0;
    padding-left: 15px;
    text-shadow: 0 0 2px #91979c;
    text-transform: uppercase;
    width: 100%;">Platinum Listing ($1559 per site - 30 posts)</p></td>
	<td width="30%" bgcolor="#F78F1E" style="padding: 0 70px;">
	<img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/man.png" alt="" style="float:left"/>
		<p style=" box-sizing: border-box;
    color: #fff;
    
    font-family: font-3;
    font-size: 34px;
    line-height: 43px;
    margin: 0;
    padding-left: 40px;
    text-align: center;
    text-transform: capitalize;
    width: 100%;">
EOF;
if($platinum_listing !=""){
    $message_pdf.=$platinum_listing;
}
$message_pdf.= <<<EOF
    </p>
	</td>
            
        </tr>
        <tr>
        	<td colspan="3"><p style="color: #fff;
    font-family: font-1;
    font-size: 20px;
    text-align: center;height:20px;"></p></td>
        </tr>
        <tr>
        	<td colspan="3"><p style="color: #fff;
    font-family: font-1;
    font-size: 20px;
    text-align: center;">**Please keep in mind that all patient sign ups are organic and voluntary. We do not pull from any databases so the estimated number of sign ups will always vary based on location, indication, IRB ad, and study criteria**</p></td>
        </tr>
         <tr>
        	<td colspan="3"><p style="color: #fff;
    font-family: font-1;
    font-size: 20px;
    text-align: center;height:20px;"></p></td>
        </tr>
    </table>
		</div>
	</div>
</div>
<table width="100%" bgcolor="#00AFEF">
	<tr>
    	<td><p style="color: #fff;
        font-family: font-3;
    margin: 0;
    padding: 6px 0;
    text-align: center;
    text-transform: uppercase;
    width: 100%;font-size:30px;">Pricing Options:</p></td>
    </tr>
</table>
<div style="background:#f3f3f4;width:100%;">
<div style="width: 1070px;margin-left:5%;margin-right:5%;">
<table width="100%">
	<tr>
    	<td colspan="2">
        	<p style=" color: #f78407;
    font-family: font-2;
    font-size: 23px;
    line-height: 26px;
    margin: 20px 0;">Complimentary Analytic MyStudyKIK Portal is included for Central Listings (Normally $300/Site per Month)</p>
        </td>
    </tr>
	<tr>
    	<td>
        	<img src="" alt="" />
        </td>
		<td>
			<img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/study.png" alt="" style="float:left"/>
			<p style="color: #343436;
    font-family: font-1;
    font-size: 24px;
    line-height: 26px;
    margin: 20px 0;line-height;30px;"><b style="font-size:28px;font-weight:bold;color:black;">MyStudyKIK Sponsor Portal Benefits:</b> - Real Time Study Wide Enrollment Status  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 			- Individual Site Enrollment and Performance&nbsp;-&nbsp;Instant Randomization Notice</p>
		</td>
    </tr>
EOF;
foreach($repeat as $in => $rpt){ 
    $message_pdf.= <<<EOF
    <tr>
    	<td colspan="2"><p style="border-bottom:1px solid #d7d7d9"></p></td>
    </tr>
    <tr>
    <td colspan="2"><p style="  color: #00a6ee;
    font-family: font-2;
    font-size: 25px;
    font-weight: bold;
    line-height: 23px;
    margin: 0 0 0px;
    text-transform: uppercase;
    width: 100%;">
EOF;
if($in > 1){
    $message_pdf.='Option '.$in;
}
else{
    $message_pdf.='Option '.$in;
}
$message_pdf.= <<<EOF
</p></td>
    </tr>
EOF;
    foreach($rpt['exposure'] as $inn => $exp){
    $mnt=$exp['month'];
        $expr=$exp['exposure_level'];
        if(isset($numbers[$mnt])){
            $wrd=$numbers[$mnt];
        }
        else{
            $wrd=$mnt;
        }
        if($mnt >1){
            $nnn='months';
        }
        else{
            $nnn='month';
        }
        $amt=$pricess[$expr];
$message_pdf.= <<<EOF
    <tr>
    	<td colspan="2"><p style="color: #343436;
    font-size: 20px;
    line-height: 23px;
    margin: 0;
    width: 100%;font-family:font-2;">
EOF;
        $pms_txt = " with Patient Messaging Suite";
        if ($exp['pms']) {
            $amt_pms = 247;
            $message_pdf.=$exp['sites'].' sites @ '.$exp['exposure_level'].$pms_txt.' for '.$wrd.' '.$nnn.' (($'.$amt.' + $'.$amt_pms.') x '.$exp['sites'].' sites x '.$mnt.' '.$nnn.')';
        } else {
            $amt_pms = 0;
            $message_pdf.=$exp['sites'].' sites @ '.$exp['exposure_level'].' for '.$wrd.' '.$nnn.' ($'.$amt.' x '.$exp['sites'].' sites x '.$mnt.' '.$nnn.')';
        }
$total_amt=($amt + $amt_pms)*$exp['sites']*$mnt;
        $rm_amount=$total_amt;
        if($exp['discount'] !=""){
            $disc_amt=(($total_amt*$exp['discount'])/100);
            $rm_amount=$total_amt-$disc_amt;
            $message_pdf.='<span style="color:#00afef;margin-left: 6px;">'.$exp['discount'].'% off ($'.number_format($disc_amt,2,'.',',').')</span>';
        }
        $message_pdf.=' = $'.number_format($rm_amount,2,'.',',');
$message_pdf.= <<<EOF
</p></td>
    </tr>
EOF;
    }
}
$message_pdf.= <<<EOF
<tr>
    <td colspan="2"><p></p>&nbsp;</td>
</tr>
</table>
</div>
</div>
<div style="width: 1070px;margin: 0;">
        <div style="margin-left:5%;">
	<table width="40%" align="left">
    	<tr>
        	<td><p style="color: #000;
    font-family: font-3;
    font-size: 25px;
    margin-bottom: 25px;
    text-transform: uppercase;
    width: 100%;">Start-up:</p></td>
        </tr>    
        <tr>
        	<td><p style="color: #9fcf68;
    font-family: font-2;
    font-size: 22px;
    line-height: 25px;
    margin: 0;
    width: 100%;">Study will go live 24 hours after receiving the following materials: </p></td>
        </tr>
        <tr>
        	<td><p style=" color: #58585a;
    font-family: font-1;
    font-size: 21px;
    margin: 0;
    width: 100%;">- Site information & all study related materials</p></td>
        </tr>
        <tr>
        	<td><p style="color: #58585a;
    font-family: font-1;
    font-size: 21px;
    margin: 0;
    text-transform: capitalize;
    width: 100%;">- payment</p></td>
        </tr>
        <tr>
        	<td><p style="color: #000;
    font-family: font-1;
    font-size: 19px;
    margin: 10px 0;
    text-transform: capitalize;
    width: 100%;"><b style="font-family: font-2;
    font-size: 25px;
    line-height: 30px;
    text-transform: uppercase;">
    All questions can be directed to:</b></p></td>
        </tr>
        <tr>
        	<td><p style="color: #00afef;
    font-family: font-2;
    font-size: 22px;
    margin: 10px 0 0 0;
    text-transform: capitalize;
    width: 100%;">
EOF;
    if($man_name == "Brian Kay") {
        $message_pdf.=$man_name.", Director";
    } else if($man_name !="") {
        $message_pdf.=$man_name.", Project manager";
    }
    $message_pdf.= <<<EOF
    </p></td>
        </tr>
EOF;
    if($phone !=""){
        $message_pdf.= <<<EOF
        <tr>
        	<td><p style=" color: #58585a;
                font-family: font-2;
                font-size: 22px;
                margin: 0;
                text-transform: capitalize;
                width: 100%;"><span style="color:#000;">Phone: </span>
EOF;
    $message_pdf.=$phone;
        $message_pdf .= <<<EOF
            </p></td>
        </tr>
EOF;

}
    $message_pdf.= <<<EOF
        <tr>
        	<td><p style=" color: #58585a;
    font-family: font-2;
    font-size: 22px;
    margin: 0;
    width: 100%"><span style="color:#000;font-family:font-2;">Email: </span>
EOF;
    if($email !=""){
    $message_pdf.= $email;
}
    $message_pdf.= <<<EOF
    </p></td>
        </tr>                
    </table>
    <table width="58%%" align="right">
    	<tr>
        	<td><p style="color: #000;
    font-family: font-3;
    font-size: 25px;
    margin-bottom: 25px;
    width: 100%;padding: 0 0 0 15px;">Every Site will Receive:</p></td>
        </tr>
        <tr>
        	<td><img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/phone.png" alt="" style="float:left;"/><p style="color: #58585a;
    font-family: font-1;
    font-size: 25px;
    line-height: 50px;
    margin: 0;
    width: 100%;
    word-spacing: 2px;padding: 0 0 0 60px;">Mobile Friendly Study Listing Page on StudyKIK</p></td>
        </tr>
        <tr>
        	<td><img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/search.png" alt="" style="float:left;"/><p style="color: #58585a;
    font-family: font-1;
    font-size: 25px;
    line-height: 42px;
    margin: 0;
    width: 100%;
    word-spacing: 2px;padding: 0 0 0 60px;">Site's Study Listed on StudyKIK search</p></td>
        </tr>
        <tr>
        	<td><img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/comment.png" alt="" style="float:left;" /><p style="color: #58585a;
    font-family: font-1;
    font-size: 25px;
    line-height: 46px;
    margin: 0;
    width: 100%;
    word-spacing: 2px;padding: 0 0 0 60px;">Exposure to Social Media Communities</p></td>
        </tr>
        <tr>
        	<td><img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/alert.png" alt="" style="float:left;" /><p style="color: #58585a;
    font-family: font-1;
    font-size: 25px;
    line-height: 46px;
    margin: 0;
    width: 100%;
    word-spacing: 2px;padding: 0 0 0 60px;">Instant Patient Sign Up Notification</p></td>
        </tr>
        <tr>
        	<td><img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/MESSAGE.png" alt="" style="float:left;" /><p style="color: #58585a;
    font-family: font-1;
    font-size: 25px;
    line-height: 46px;
    margin: 0;
    width: 100%;
    word-spacing: 2px;padding: 0 0 0 60px;">Patient Text & Email Follow Up with Site Contact Info.</p></td>
        </tr>
        <tr>
        	<td><img src="http://testing.studykik.com/wp-content/themes/twentyfifteen/img_sponsor/Mystudy.png" alt="" style="float:left;" /><p style="color: #58585a;
    font-family: font-1;
    font-size: 25px;
    line-height: 46px;
    margin: 0;
    width: 100%;
    word-spacing: 2px;padding: 0 0 0 60px;">MyStudyKIK Portal for Easy Patient Enrollment Updates</p></td>
        </tr>
    </table>
    </div>
</div>
</body>
EOF;

    $rand= rand();
    require_once(dirname(__FILE__).'/pdfcrowd.php');
    $client = new Pdfcrowd("studykik", "317cad498ffdb54781d13cbc1f7112f4");
    $out_file = fopen($_SERVER['DOCUMENT_ROOT']."/pdf/".$rand."_StudyKIK_Sponsor_Proposal.pdf", "wb");
    $client->setPageMargins(0,0,0,0);
    $pdf = $client->convertHtml($message_pdf,$out_file);
    fclose($out_file);
    $subject_pdf_email = "StudyKIK Sponsor Proposal";
    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
    $headers_pdf[] = "MIME-Version: 1.0\r\n";
    $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $pdf_attachment_path = $_SERVER['DOCUMENT_ROOT']."/pdf/".$rand."_StudyKIK_Sponsor_Proposal.pdf";
    $pdf_attachment_path_db = '/pdf/'.$rand.'_StudyKIK_Sponsor_Proposal.pdf';
    $attachments[] = $_SERVER['DOCUMENT_ROOT']."/pdf/".$rand."_StudyKIK_Sponsor_Proposal.pdf";
//    $SendEmail=wp_mail('nadda21vikas@gmail.com',$subject_pdf_email, $message,$headers_pdf,$pdf_attachment_path);
    $SendEmail=wp_mail('info@studykik.com',$subject_pdf_email, $message,$headers_pdf,$pdf_attachment_path);
//    $SendEmail=wp_mail('utopia2050.kosta@gmail.com',$subject_pdf_email, $message,$headers_pdf,$pdf_attachment_path);
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
        <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Thank you for submitting a sponsor proposal.</p>
        <input onclick="document.getElementById('embed').style.display='none';document.getElementById('fade').style.display='none'" class="close_button" type="button" value="CLOSE"/>

    </div><div id="fade" class="black_overlay"></div>
<?php } ?>

<script type="text/javascript">
    $(function () {
        $("#datepicker2").datepicker();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#contactform_invoice').submit(function() {

            var errors = 0;

            $("#contactform_invoice .required").map(function(){

                if( !$(this).val() ) {

                    $(this).addClass('warning');

                    errors++;

                } else if ($(this).val()) {

                    $(this).removeClass('warning');

                }

            });
            
            $("#contactform_invoice .repeat_month").map(function(){
                if($(this).val() !=""){

                    if( !(/^[0-9]+$/.test($(this).val()) )) {
    
                        $(this).addClass('warning');
    
                        errors++;
    
                    }
                    else if ((/^[0-9]+$/.test($(this).val()) )) {
                        if($(this).val()==0){
                            $(this).addClass('warning');
                            errors++;
                        }
                        else{
                            $(this).removeClass('warning');
                        }
    
                    }
                }

            });

            if(errors > 0){ //alert()

                //$('#errorwarn').text("All fields are required");

                return false;

            }

            // do the ajax..

        });

    });

</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#no_months').change(function() {
            var n_months=$(this).val();
            var n_exposure=$("#no_expose_level").val();
            var str='';
            if(n_months !=""){
                if(n_exposure==""){
                    for(var i=1; i<=n_months;i++){
                        var mn="Option "+i;
                        str+='<p style="color:orange;font-weight:bold;font-size:16px;">'+mn+'</p>';
                    }
                }
                else{
                    for(var i=1; i<=n_months;i++){
                        var mn="Option "+i;
                        str+='<p style="color:orange;font-weight:bold;font-size:16px;">'+mn+'</p>';
                        for(var j=1; j<=n_exposure;j++){
                            var id_m="month_"+i+"_detail_"+j+"_exposure";
                            var id_s="sites_"+i+"_detail_"+j+"_exposure";
                            var id_e="exposure_level_"+i+"_detail_"+j+"_exposure";
                            var id_d="discount_"+i+"_detail_"+j+"_exposure";
                            var id_p="pms_"+i+"_detail_"+j+"_exposure";
                            var name_month="repeat["+i+"][exposure]["+j+"][month]";
                            var name_site="repeat["+i+"][exposure]["+j+"][sites]";
                            var name_exp="repeat["+i+"][exposure]["+j+"][exposure_level]";
                            var name_dis="repeat["+i+"][exposure]["+j+"][discount]";
                            var name_pms="repeat["+i+"][exposure]["+j+"][pms]";
                            str+='<input type="text" id="'+id_m+'" name="'+name_month+'" placeholder="Month" class="required repeat_month">&nbsp;' +
                                '<input type="text" id="'+id_s+'" name="'+name_site+'" placeholder="Sites" class="required repeat_month">&nbsp;' +
                                '<select id="'+id_e+'" name="'+name_exp+'" class="required exposure_dropdown"><option value="">Exposure</option><option value="Bronze">Bronze</option><option value="Silver">Silver</option><option value="Gold">Gold</option><option value="Platinum">Platinum</option><option value="Diamond">Diamond</option><option value="Ruby">Ruby</option></select>&nbsp;' +
                                '<input type="text" id="'+id_d+'" name="'+name_dis+'" placeholder="Discount" class="repeat_month">&nbsp' +
                                '<input type="checkbox" id="'+id_p+'" name="'+name_pms+'" class="pms"><span style="color: #00afef; line-height: 25px; margin-left: 10px; font-weight: bold;">PMS</span>&nbsp;';
                        }
                    }
                }
            }
            $("#repeat_div").html(str);
        });
        
        $('#no_expose_level').change(function() {
            var n_exposure=$(this).val();
            var n_months=$("#no_months").val();
            var str='';
            if(n_exposure !=""){
                if(n_months==""){
                    alert("Please select the months first.");
                }
                else{
                    for(var i=1; i<=n_months;i++){
                        var mn="Option "+i;
                        str+='<p style="color:orange;font-weight:bold;font-size:16px;">'+mn+'</p>';
                        for(var j=1; j<=n_exposure;j++){
                            var id_m="month_"+i+"_detail_"+j+"_exposure";
                            var id_s="sites_"+i+"_detail_"+j+"_exposure";
                            var id_e="exposure_level_"+i+"_detail_"+j+"_exposure";
                            var id_d="discount_"+i+"_detail_"+j+"_exposure";
                            var id_p="pms_"+i+"_detail_"+j+"_exposure";
                            var name_month="repeat["+i+"][exposure]["+j+"][month]";
                            var name_site="repeat["+i+"][exposure]["+j+"][sites]";
                            var name_exp="repeat["+i+"][exposure]["+j+"][exposure_level]";
                            var name_dis="repeat["+i+"][exposure]["+j+"][discount]";
                            var name_pms="repeat["+i+"][exposure]["+j+"][pms]";
                            str+='<input type="text" id="'+id_m+'" name="'+name_month+'" placeholder="Month" class="required repeat_month">&nbsp;' +
                                '<input type="text" id="'+id_s+'" name="'+name_site+'" placeholder="Sites" class="required repeat_month">&nbsp;' +
                                '<select id="'+id_e+'" name="'+name_exp+'" class="required exposure_dropdown"><option value="">Exposure</option><option value="Bronze">Bronze</option><option value="Silver">Silver</option><option value="Gold">Gold</option><option value="Platinum">Platinum</option><option value="Diamond">Diamond</option><option value="Ruby">Ruby</option></select>&nbsp;' +
                                '<input type="text" id="'+id_d+'" name="'+name_dis+'" placeholder="Discount" class="repeat_month">&nbsp;' +
                                '<input type="checkbox" id="'+id_p+'" name="'+name_pms+'" class="pms"><span style="color: #00afef; line-height: 25px; margin-left: 10px; font-weight: bold;">PMS</span>&nbsp;';
                        }
                    }
                }
            }
            $("#repeat_div").html(str);
        });
    });

</script>