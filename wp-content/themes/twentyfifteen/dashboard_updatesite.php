<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
if(isset($_POST['add_p_id'])){
$pid=$_POST['add_p_id'];
$study_no = get_post_meta($pid, 'study_no', true);
$i=1;
$siteemail1=get_post_meta($pid, 'email_adress', true);
$siteemail2=get_post_meta($pid, 'email_adress_2', true);
$siteemail3=get_post_meta($pid, 'email_adress_3', true);
$siteemail4=get_post_meta($pid, 'email_adress_4', true);
$siteemail5=get_post_meta($pid, 'email_adress_5', true);
$siteemail6=get_post_meta($pid, 'email_adress_6', true);
$siteemail7=get_post_meta($pid, 'email_adress_7', true);
$siteemail8=get_post_meta($pid, 'email_adress_8', true);
$siteemail9=get_post_meta($pid, 'email_adress_9', true);
$siteemail10=get_post_meta($pid, 'email_adress_10', true);

$site=get_post_meta($pid, 'name_of_site', true);
$sitephone=get_post_meta($pid, 'phone_number', true);
$siteaddress=get_post_meta($pid, 'study_full_address', true);

//update_post_meta($pid, 'name_of_site', $_POST['site']);
//update_post_meta($pid, 'phone_number', $_POST['sitephone']);
//update_post_meta($pid, 'study_full_address', $_POST['siteaddress']);
if(isset($_POST['site'])){
update_post_meta($pid, 'name_of_site', $_POST['site']);
}
if(isset($_POST['sitephone'])){
update_post_meta($pid, 'phone_number', $_POST['sitephone']);
}
if(isset($_POST['siteaddress'])){
update_post_meta($pid, 'study_full_address', $_POST['siteaddress']);
}


if(isset($_POST['siteemail1'])){
update_post_meta($pid, 'email_adress', $_POST['siteemail1']);
}
if(isset($_POST['siteemail2'])){
update_post_meta($pid, 'email_adress_2', $_POST['siteemail2']);
}
if(isset($_POST['siteemail3'])){
update_post_meta($pid, 'email_adress_3', $_POST['siteemail3']);
}
if(isset($_POST['siteemail4'])){
update_post_meta($pid, 'email_adress_4', $_POST['siteemail4']);
}
if(isset($_POST['siteemail5'])){
update_post_meta($pid, 'email_adress_5', $_POST['siteemail5']);
}
if(isset($_POST['siteemail6'])){
update_post_meta($pid, 'email_adress_6', $_POST['siteemail6']);
}
if(isset($_POST['siteemail7'])){
update_post_meta($pid, 'email_adress_7', $_POST['siteemail7']);
}
if(isset($_POST['siteemail8'])){
update_post_meta($pid, 'email_adress_8', $_POST['siteemail8']);
}
if(isset($_POST['siteemail9'])){
update_post_meta($pid, 'email_adress_9', $_POST['siteemail9']);
}
if(isset($_POST['siteemail10'])){
update_post_meta($pid, 'email_adress_10', $_POST['siteemail10']);
}
$headers[] = 'From: Edit Site Infirmation <info@studykik.com>';
$headers[] = "MIME-Version: 1.0\r\n";
$headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
$subject = "Edit Site Information "."(".$study_no.")";
    $message .= "
<body>
<table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>";
$message .= "<tr>
    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>Site Information</strong></td>
  </tr>";
if(isset($_POST['site'])){
 
if($site !=$_POST['site']){
$message .= "<tr>
    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Site:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $_POST['site']  . " ".'(Updated)'."</td>

  </tr>";
}
else{
	
	$message .= "<tr>
    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Site:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $_POST['site'] . "</td>

  </tr>";
}
}
if(isset($_POST['sitephone'])){
 
if($sitephone !=$_POST['sitephone']){

  $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Site Phone Number:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $_POST['sitephone']  . " ".'(Updated)'."</td>
  </tr>";
  
}
else{
	
  $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Site Phone Number:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $_POST['sitephone']  . "</td>
  </tr>";
  
	
}
}
  if(isset($_POST['siteaddress'])){
 
	if($siteaddress !=$_POST['siteaddress']){
  
  $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong>Site Address:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $_POST['siteaddress']  . " ".'(Updated)'."</td>
  </tr> ";
	}
	else{
		  $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong>Site Address:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $_POST['siteaddress'] . "</td>
  </tr> ";
		
	}
  }
if(isset($_POST['siteemail1'])){
 
if($siteemail1 !=$_POST['siteemail1']){

$message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail1'] . " ".'(Updated)'."</td>
  </tr>";
}
else{
    $message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail1'] . "</td>
  </tr>";

}

}
if(isset($_POST['siteemail2'])){

if($siteemail2 !=$_POST['siteemail2']){
$message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail2'] . " ".'(Updated)'."</td>
  </tr>";
}
else{
    $message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail2'] . "</td>
  </tr>";

}

}
if(isset($_POST['siteemail3'])){

if($siteemail3 !=$_POST['siteemail3']){
$message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail3'] . " ".'(Updated)'."</td>
  </tr>";
}
else{
    $message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail3'] . "</td>
  </tr>";

}

}
if(isset($_POST['siteemail4'])){

if($siteemail4 !=$_POST['siteemail4']){
$message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail4'] . " ".'(Updated)'."</td>
  </tr>";
}
else{
    $message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail4'] . "</td>
  </tr>";

}

}
if(isset($_POST['siteemail5'])){

if($siteemail5 !=$_POST['siteemail5']){
$message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail5'] . " ".'(Updated)'."</td>
  </tr>";
}
else{
    $message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail5'] . "</td>
  </tr>";

}

}
if(isset($_POST['siteemail6'])){

if($siteemail6 !=$_POST['siteemail6']){
$message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail6'] . " ".'(Updated)'."</td>
  </tr>";
}
else{
    $message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail6'] . "</td>
  </tr>";

}

}
if(isset($_POST['siteemail7'])){

if($siteemail7 !=$_POST['siteemail7']){
$message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail7'] . " ".'(Updated)'."</td>
  </tr>";
}
else{
    $message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail7'] . "</td>
  </tr>";

}

}
if(isset($_POST['siteemail8'])){

if($siteemail8 !=$_POST['siteemail8']){
$message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail8'] . " ".'(Updated)'."</td>
  </tr>";
}
else{
    $message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail8'] . "</td>
  </tr>";

}

}
if(isset($_POST['siteemail9'])){

if($siteemail9 !=$_POST['siteemail9']){
$message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail9'] . " ".'(Updated)'."</td>
  </tr>";
}
else{
    $message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail9'] . "</td>
  </tr>";

}

}
if(isset($_POST['siteemail10'])){

if($siteemail10 !=$_POST['siteemail10']){
$message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail10'] . " ".'(Updated)'."</td>
  </tr>";
}
else{
    $message .="
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$i++.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" .$_POST['siteemail10'] . "</td>
  </tr>";

}

}
  $message .= "<tr>
    <td height='5' colspan='3' align='right' valign='middle'></td>
  </tr>
  <tr>
    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
  </tr>
</table>
</body>";

wp_mail("info@studykik.com", $subject, $message, $headers);
//wp_mail('anuj.blissit@gmail.com', $subject, $message, $headers);
}