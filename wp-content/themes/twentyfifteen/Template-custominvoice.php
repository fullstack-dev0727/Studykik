<?php
/*
 * Template Name: Studykik Custom Invoice Page
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
        min-height: 1300px;
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

    #Enter_notes{
        background: #e8e8e8 none repeat scroll 0 0;
        border: medium none;
        box-shadow: 3px 3px 5px #bbbbbb inset;
        height: auto;
        margin-bottom: 12px;
        padding: 5px 10px;
        width: 678px;
        color:#f78f1e;
        font-size: 20px;
    }
    .dropdown{
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
        $("select[name=paymenttype]").change(function() {
            var payment_type = this.value;
            console.log(payment_type);
            if (payment_type == "New Card") {
                $('.card_form').show();
            } else {
                $('.card_form').hide();
            }
        })
    });

</script>
<div id="inner-page">
<div class="container">
<section class="study_proposal">
<div class="proposal_left">
<div style="clear: both; margin-bottom: 25px; width: 85%;">
    <!--<img src="http://52.21.191.60/wp-content/themes/twentyfifteen/images-dashboard/invoice.png" style="margin-bottom: 15px;" alt="" class="img-responsive center-block">-->
    <div href="" style="color: rgb(247, 143, 30); font-family: helveticaregular; font-size: 33px; text-align: center;"><span style="border-bottom:1px solid orange;">CUSTOM INVOICE</span></div></div>
<div class="get_proposal">
<form id="contactform_invoice" method="post" action="">
    <input class="required enter_css" id="datepicker1"  aria-required="true"  type="text" placeholder="Invoice Date *" name="invoice_date">
    <br>
    <input class="required enter_css" id="datepicker2"  aria-required="true"  type="text" placeholder="Start Date *" name="start_date">
    <a class="determine_start" id="start_determine" style="float: left; display: block; font-size: 16px; font-weight: bold; margin-bottom: 6px;margin-top: -6px;" href="javascript:void(0);">To be determined</a>
    <br>
    <input class="required enter_css" id="datepicker3"  aria-required="true"  type="text" placeholder="End Date *" name="end_date">
    <a class="determine_end" id="end_determine" style="float: left; display: block; font-size: 16px; font-weight: bold; margin-bottom: 6px;margin-top: -6px;" href="javascript:void(0);">To be determined</a>
    <br>
    <input type="text" id="Enter_name" name="websiteaddress" placeholder="Site Name *" class="required">
    <br>
    <input type="text" id="Enter_name" name="organization" placeholder="Study Type *" class="required">
    <br>
    <input type="text" id="Enter_name" name="Study_Level" placeholder="Study Level *" class="required">
    <br>
    <input type="text" id="Enter_name" name="protocolnumber" placeholder="Protocol Number *" class="required">
    <br>
    <input type="text" id="Enter_name" name="sponsorname" placeholder="Sponsor Name *" class="required">
    <br>
    <input type="text" id="Enter_name" name="sponsoremail" placeholder="Sponsor Email" class="">
    <br>
    <input type="text" id="Enter_name" name="croname" placeholder="CRO Name" class="">
    <br>
    <input type="text" id="Enter_name" name="croemail" placeholder="CRO Email" class="">
    <br>
    <input type="text" id="Enter_name" name="studylocation" placeholder="Study Address" class="">
    <br>
    <p>
        <label style="line-height: 24px;">Add Patient Messaging Suite ($247.00): </label>
                           <span class="wpcf7-form-control-wrap textarea-350"></br>
                               <input type="checkbox" name="message_suite_2471" style="width:auto;" value="1">
                          <span style="color: #00afef;line-height: 25px;margin-left: 10px;font-weight: bold;">Yes</span> </span>
    </p>
    <input type="text" id="Enter_name" name="Amount" placeholder="Amount *" class="required">
    <br>
    <select id="paymenttype" name="paymenttype" placeholder="Payment Type" class="dropdown required">
        <option value="">Choose Payment Type *</option>
        <option value="Check">Pay by Check</option>
        <option value="New Card">New Card</option>
    </select>
    <br>
    <div class="card_form" id="card_form" style="display: none;">
        <input type="text" id="Enter_name" name="cardtype" placeholder="Card Type * (Eg: Visa, American Express)" class=" new-card-field required">
        <br>
        <input type="text" id="Enter_name" name="creditcard" placeholder="Last 4 Digits *" class=" new-card-field required">
        <br>
        <input type="text" id="Enter_name" name="cardname" placeholder="Name on Card *" class=" new-card-field required">

    </div>

    <input type="text" id="Enter_name" name="account" placeholder="Account *" class=" new-card-field required">
    <br>
    <input type="text" id="Enter_name" name="coupon" placeholder="Coupon Code" class="">
    <br>
    <input type="text" id="Enter_name" name="c_discount" placeholder="Coupon Discount" class="">
    <br>
    <textarea type="text" id="Enter_notes" name="notes" placeholder="Notes" rows="3"></textarea>
    <br>
    <select id="Indication_dropdown" name="user_name" class="dropdown required">
        <?php
        $optsss='<option value="">Select User *</option>';
        $blogusers4 = get_users(array('fields' => array('ID', 'user_login')));
        foreach ($blogusers4 as $user) {
            $optsss.='<option value="'.$user->ID.'">'.$user->user_login.'</option>';
        }
        echo $optsss;
        ?>

    </select>
            <span class="drop-cus">
           
            </span>

    <br>
    <input type="submit" class="btn_invoice" name="btn_proposal" value="Submit">
</form>
<?php
if(isset($_REQUEST['btn_proposal']))
{
$is_message_suite="";
$invoice_dt = stripslashes($_REQUEST["invoice_date"]);
$start_dt = stripslashes($_REQUEST["start_date"]);
$end_dt = stripslashes($_REQUEST["end_date"]);
$websiteaddress = stripslashes($_REQUEST["websiteaddress"]);
$organization = stripslashes($_REQUEST["organization"]);
$std_level = stripslashes($_REQUEST["Study_Level"]);
$protocolnumber = stripslashes($_REQUEST["protocolnumber"]);
$sponsorname = stripslashes($_REQUEST["sponsorname"]);
$sponsoremail = stripslashes($_REQUEST["sponsoremail"]);
$croname = stripslashes($_REQUEST["croname"]);
$croemail = stripslashes($_REQUEST["croemail"]);
$studylocation = stripslashes($_REQUEST["studylocation"]);
$Amount = str_replace(",", "", stripslashes($_REQUEST["Amount"]));
$notes = stripslashes($_REQUEST["notes"]);
$payment_type = stripslashes($_REQUEST["paymenttype"]);
if ($payment_type == "New Card") {
    $cardtype = stripslashes($_REQUEST["cardtype"]);
    $creditcard = stripslashes($_REQUEST["creditcard"]);
    $cardname = stripslashes($_REQUEST["cardname"]);

}
$account = stripslashes($_REQUEST["account"]);
$coupon = stripslashes($_REQUEST["coupon"]);
$c_discount = str_replace(",", "", stripslashes($_REQUEST["c_discount"]));

if(isset($_REQUEST["message_suite_2471"])){
    $is_message_suite=1;
}
    $amount_total = $Amount + ($is_message_suite ? 247 : 0) - $c_discount;
$user_name = $_REQUEST["user_name"];

    $query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` ORDER BY `id` DESC LIMIT 1");
    foreach($query_invoice_number as $query_invoice_number_value){
        $invoice_num = $query_invoice_number_value->invoice_number;
    }
    $inc_nummm=$invoice_num;
    $final_num =  $inc_nummm+1;

    $subject = "cro/sponsors focus (".$final_num.")";
    $message .= "
<body>
        <table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>
                  <tr>
                    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>CRO/SPONSORS CUSTOM INVOICE</strong></td>
                  </tr>
                  <tr>
                    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
                  </tr>";
    if($invoice_dt){
        $message .= "<tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Invoice Date:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $invoice_dt . "</td>
                    </tr>";
    }
    if($organization){
        $message .= "<tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $organization . "</td>
                    </tr>";
    }
    if($std_level){
        $message .= "<tr style='color:#000; font-size:12px;'>
                      <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Level:</strong></td>
                      <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $std_level . "</td>
                    </tr>";
    }
    if($websiteaddress){
        $message .= "<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Site Name:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $websiteaddress . "</td>
                  </tr>";
    }
    if($studylocation){
        $message .= "<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $studylocation . "</td>
                  </tr>";
    }
    if($protocolnumber){
        $message .= "<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Protocol Number:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $protocolnumber . "</td>
                  </tr>";
    }

    if($sponsorname){
        $message .= "<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Name:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $sponsorname . "</td>
                  </tr>";
    }

    if($sponsoremail){
        $message .= "<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Email:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $sponsoremail . "</td>
                  </tr>";
    }


    $message .= "<tr style='color:#000; font-size:12px;'>
        <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> CRO Name:</strong></td>
        <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$croname."</td>
    </tr>
    <tr style='color:#000; font-size:12px;'>
        <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> CRO Email:</strong></td>
        <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$croemail."</td>
    </tr>";

    if($start_dt){
        $message .= " <tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Start Date:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $start_dt . "</td>
                  </tr>";
    }
    if($end_dt){
        $message .= " <tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> End Date:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $end_dt . "</td>
                  </tr>";
    }
    if($is_message_suite == 1){
        $message .= "    <tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Add Patient Messaging Suite $247:</strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>$247</td>
                  </tr>";
    }
    if($coupon){
        $message .= "<tr style='color:#000; font-size:12px;'>
              <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Coupon: </strong></td>
              <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$coupon."</td>
          </tr>";
    }
    if($creditcard){
        $message .= "<tr style='color:#000; font-size:12px;'>
            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Credit Card (Last 4 Digits): </strong></td>
            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $creditcard . "</td>
          </tr>";
    }
    if($payment_type == "Check"){
        $message .= "<tr style='color:#000; font-size:12px;'>
            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Paid by Check: </strong></td>
            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>Yes</td>
          </tr>";
    }
    if($final_num){
        $message .= "    <tr style='color:#000; font-size:12px;'>
<td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Invoice Number: </strong></td>
<td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$final_num."</td>
</tr>";
    }
    if($Amount){
        $message .= "    <tr style='color:#000; font-size:12px;'>
<td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Amount: </strong></td>
<td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>$".$Amount."</td>
</tr>";
    }
    if($notes){
        $message .= "    <tr style='color:#000; font-size:12px;'>
<td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Notes: </strong></td>
<td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$notes."</td>
</tr>";
    }
    if($amount_total){
        $message .= "    <tr style='color:#000; font-size:12px;'>
<td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Total: </strong></td>
<td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>$".$amount_total."</td>
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
					margin:0px 0px 0px 0px;
					padding: 0px 0px 0px 0px;
				}

				th{padding:2px 0px;}
				td
				{
				padding:5px 0px;
				}
				tbody{
				margin:0px 20px 0px 20px;
				padding: 0px 20px 0px 20px;

				}

				h1{ font-size:21px; margin:-15px 0px 10px 0px; padding:0px 0px 0px 0px;}
				tbody tr{ font-size:14px;}
				body{margin:0px 0px 0px 0px;
					padding: 0px 0px 0px 0px;}

				-->
				</style>';

    $message_pdf .= "
				  <page backtop='2mm' backbottom='0mm' backleft='5mm' backright='5mm'>
				 <table cellpadding='0' cellspacing='0'>
				<col style='width: 18%'>
				<col style='width: 37%'>
				<col style='width: 20%'>
				<col style='width: 5%'>
				<col style='width: 20%'>

				      <tr>
					<th style='text-align:left; margin-left:20px;' colspan='2'><img style='width:295px; height:52px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/background_top.png'/><p style='font-size:14px; color:#959ca1;font-weight:normal; margin:2px 0px 0px 0px; line-height:18px;'><b>StudyKIK</b><br />1675 Scenic Ave #150<br />Costa Mesa, CA 92626</p></th>
					<th colspan='3' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px; padding: 20px 0 4px 0;'>
					<h1>INVOICE RECEIPT</h1>
					Invoice Number: ".$final_num."<br />
                    Date: ".$invoice_dt."<br />
                    Payment Type: ".($payment_type != "Check" ? $cardtype." xxxx".$creditcard : "Check")."<br />";
    if ($payment_type != "Check") {
        $message_pdf .= "
                    Name on Card: ".$cardname."<br/>
                    Account: ".$account."</th>";
    } else {
        $message_pdf .= "
                    Account: ".$account."<br/>
                    &nbsp;</th>";
    }
    $message_pdf .= "
				    </tr>
				<tbody>
				<tr>
					<th style='text-align:left' colspan='5'><img style='width:100%;' src='".site_url()."/wp-content/themes/twentyfifteen/images/top_full.png'/></th></tr>
				    <tr style='text-align:center; font-size:18px;color:#000;'>
					<th align='left' style='border-bottom:1px solid #000;'>SERVICES:</th>
					<th align='left' colspan='2' style='border-bottom:1px solid #000;'>DESCRIPTION:</th>
					<th style='border-bottom:1px solid #000;'></th>
					<th  align='right' style='border-bottom:1px solid #000;'>AMOUNT:</th>
				    </tr>

				<tr align='center'>
				    <td align='left'>Listing</td>
				    <td align='left' colspan='2'><b>Site Name:</b> ".$websiteaddress."</td>
				    <td align='center'> </td>
				    <td align='right'>$".number_format( $Amount ,  2 ,  '.' ,  ',' )." </td>
				</tr>
				<tr align='center'>
				    <td align='left'></td>
				    <td align='left' colspan='2'><b>Study Type:</b> ".$organization."</td>
				    <td align='center'> </td>
				    <td align='center'></td>
				</tr>
				<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Study Level:</b> ".$std_level."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				</tr>";
    if($protocolnumber){
        $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left' colspan='2'><b>Protocol Number:</b> ".$protocolnumber."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
    }
    if($sponsorname){
        $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left' colspan='2'><b>Sponsor Name:</b> ".$sponsorname."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
    }
    if($recruitment_phone){
        $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left' colspan='2'><b>Recruitment Phone:</b> ".$recruitment_phone."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
    }

    if($start_dt !="To be determined"){
        $message_pdf .= "<tr align='left'>
                        <td align='left'> </td>
                        <td align='left' colspan='2'><b>Start Date:</b> ".$start_dt."</td>
                        <td align='center'> </td>
                        <td align='center'> </td>
                        </tr>";
    }
    else{
        $message_pdf .= "<tr align='left'>
                        <td align='left'> </td>
                        <td align='left' colspan='2'><b>Start Date:</b>&nbsp;To be determined</td>
                        <td align='center'> </td>
                        <td align='center'> </td>
					    </tr>";
    }
    if($end_dt !="To be determined"){
        $message_pdf .= "<tr align='left'>
                        <td align='left'> </td>
                        <td align='left' colspan='2'><b>End Date:</b> ".$end_dt."</td>
                        <td align='center'> </td>
                        <td align='center'> </td>
                        </tr>";
    }
    else{
        $message_pdf .= "<tr align='left'>
                        <td align='left'> </td>
                        <td align='left' colspan='2'><b>End Date:</b>&nbsp;To be determined</td>
                        <td align='center'> </td>
                        <td align='center'> </td>
                        </tr>";
    }
    $message_pdf .= "<tr align='left'>
                    <td align='left'> </td>
                    <td align='left' colspan='4'><b>Study Address:</b> ".$studylocation."</td>
                    </tr>";

    if ($notes) {
        $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left' colspan='2' style='height:40px; vertical-align:top;'><b>Notes:</b> ".$notes." </td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
    } else {
        $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left' colspan='2' style='height:40px; vertical-align:top;'></td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
    }
    $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
    $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
    $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
    $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
    $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
    $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
    if($is_message_suite == 1){
        $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>Patient Messaging Suite</td>
				    <td bordercolor='#000' align='left' colspan='2'> </td>
				    <td bordercolor='#000' align='center'> </td>
				    <td bordercolor='#000' align='right'>$247.00</td>
				    </tr>";
    }else{

        $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left' colspan='2'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

    }
    if($coupon){
        $message_pdf .= "<tr align='center'>
                            <td align='left'>Coupon</td>
                            <td align='left' colspan='2'>".$coupon."</td>
                            <td align='center'> </td>
                            <td align='right'>-$".number_format( $c_discount ,  2 ,  '.' ,  ',' )." </td>
				        </tr>";

    } else {

        $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left' colspan='2'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

    }

    $message_pdf .= "

				<tr class='sub_total' align='left'>
				<td align='center'  style='border-top:1px solid #000;'> </td>
				<td align='left'  colspan='2' style='border-top:1px solid #000;'> </td>
				<td align='right' colspan='2' style='border-top:1px solid #000;'>SUB TOTAL:&nbsp;$".number_format( $amount_total ,  2 ,  '.' ,  ',' )."</td>
				</tr>
				<tr class='total' align='left'>
				<td align='center'> </td>
				<td align='left' colspan='2'> </td>
				<td align='right' colspan='2'><b>TOTAL:&nbsp;$".number_format( $amount_total ,  2 ,  '.' ,  ',' )."</b></td>
				</tr>
				</tbody>
				<tr>";

    if($contactemail4 == ""){

        $message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:460px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

    }else{

        $message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:440px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

    }
    $message_pdf .= "</tr>
				</table></page>";

    $subject_pdf_email = "cro/sponsors custom invoice";

    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
    $headers_pdf[] = "MIME-Version: 1.0\r\n";
    $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";

    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($message_pdf);
    //ob_end_clean();
    $rand= rand();
    $html2pdf->Output(dirname(__FILE__)."/pdf/".$final_num." StudyKIK Invoice.pdf", "f");
    $html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num."_StudyKIK_Invoice.pdf", "f");
    $pdf_attachment_path = dirname(__FILE__).'/pdf/'.$final_num.' StudyKIK Invoice.pdf';
    $pdf_attachment_path_db = '/pdf/'.$final_num.'_'.'StudyKIK_Invoice.pdf';
    $attachments[] = dirname(__FILE__).'/pdf/'.$final_num.' StudyKIK Invoice.pdf';




    $email_recipients = array();
    $email_recipients[] = $email;

    if($sp_email){
        $email_recipients[] = $sp_email;
    }
    if($cr_email){
        $email_recipients[] = $cr_email;
    }
    //wp_mail($email_recipients,$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
//    $SendEmail=wp_mail('nadda21vikas@gmail.com',$subject_pdf_email, $message,$headers_pdf,$pdf_attachment_path);
    $SendEmail=wp_mail("info@studykik.com",$subject_pdf_email, $message,$headers_pdf,$pdf_attachment_path);
    $prc="$".$amount_total;
    $current_month = date('M');
    $current_year = date('Y');
    $full_date = date('m/d/y');
    $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`(`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES (NULL,'$user_name','0','$pdf_attachment_path_db','$protocolnumber','$final_num','$prc','$current_month','$current_year','Studykik Invoice','$full_date')"));

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
        <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Thank you for submitting a custom invoice.</p>
        <input onclick="document.getElementById('embed').style.display='none';document.getElementById('fade').style.display='none'" class="close_button" type="button" value="CLOSE"/>

    </div><div id="fade" class="black_overlay"></div>
<?php } ?>

<script type="text/javascript">
    $(function () {
        $("#datepicker1").datepicker();
    });
</script>

<script type="text/javascript">
    $(function () {
        $("#datepicker2").datepicker();
    });
</script>

<script type="text/javascript">
    $(function () {
        $("#datepicker3").datepicker();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#contactform_invoice').submit(function() {
            var payment_type = $("select[name=paymenttype]").find(':selected').val();

            var errors = 0;
            console.log(payment_type);
            $("#contactform_invoice .required").map(function(){

                if( !$(this).val() ) {


                    if (payment_type != 'New Card' && $(this).hasClass("new-card-field")) {
                        $(this).removeClass('warning');
                    } else {
                        $(this).addClass('warning');
                        errors++;
                        if (errors == 1)
                        {
                            //alert("Please fill required fields.");
                            //$("#err_msgg").show();
                            //$("#fade").show();
                        }
                    }
//                    $(this).addClass('warning');
//
//                    errors++;

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

    });

</script>
<script>
    $('#start_determine').on('click',function() {
        $("#datepicker2").val('To be determined');
    });
    $('#end_determine').on('click',function() {
        $("#datepicker3").val('To be determined');
    });
</script>
