<?php
$fullname = $_REQUEST['contact']['fullname'];
$email = $_REQUEST['contact']['email'];
$company = $_REQUEST['contact']['company'];

$protocolnumber = $_REQUEST['contact']['protocolnumber'];

$subject = "StudyKIK Protocol ";


$message .= '
<table style="font-family:Arial,Helvetica,sans-serif" align="center" border="0" cellpadding="10" cellspacing="0" width="600">
<tbody><tr>
  <td colspan="3" style="color:#fd1631;font-size:20px;border-bottom:1px solid #d4d4d4;font-style:italic" align="center" valign="middle">
  <b>StudyKIK Protocol </b>
  </td>
</tr>

<tr>
  <td colspan="3" height="5" align="right" bgcolor="#1A0806" valign="middle"></td>
</tr>

<tr style="color:#000;font-size:12px">
  <td style="color:#000;border:1px solid #d4d4d4;border-top:none;border-left:none" align="left" valign="middle"><b>Full Name:</b></td>
  <td style="border:1px solid #d4d4d4;border-left:none;border-top:none;border-right:none" align="left" valign="middle">'.$fullname.'</td>
</tr>
<tr style="color:#000;font-size:12px">
  <td style="color:#000;border:1px solid #d4d4d4;border-top:none;border-left:none" align="left" valign="middle"><b>Email:</b></td>
  <td style="border:1px solid #d4d4d4;border-left:none;border-top:none;border-right:none" align="left" valign="middle"><a href="mailto:'.$email.'" target="_blank">'.$email.'</a></td>
</tr>
<tr style="color:#000;font-size:12px">
  <td style="color:#000;border:1px solid #d4d4d4;border-top:none;border-left:none" align="left" valign="middle"><b>Company:</b></td>
  <td style="border:1px solid #d4d4d4;border-left:none;border-top:none;border-right:none" align="left" valign="middle">'.$company.'</td>
</tr>
<tr style="color:#000;font-size:12px">
  <td style="color:#000;border:1px solid #d4d4d4;border-top:none;border-left:none" align="left" valign="middle"><b>Protocol:</b></td>
  <td style="border:1px solid #d4d4d4;border-left:none;border-top:none;border-right:none" align="left" valign="middle">'.$protocolnumber.'</td>
</tr>
</tbody>
</table>
';

$headers[] = 'From: '.$fullname.' <info@studykik.com>';;
//$headers[] = 'Reply-To: '.$fullname.' <'.$email.'>';
$headers[] = "MIME-Version: 1.0\r\n";
$headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
$SendEmail = wp_mail('info@studyKIK.com',$subject,$message,$headers);


echo json_encode($SendEmail);
?>