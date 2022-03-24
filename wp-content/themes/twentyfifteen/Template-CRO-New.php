<?php
/*
* Template Name: CRO NEW TEMP
*/
//error_reporting(E_ALL);
get_header();
?>
<?php
$currdate =date('m/d/Y',strtotime('-4 hours'));
$croname=$_REQUEST['fullname'];
$croname=strtolower($croname);
$user_ID = get_current_user_id();
?>
<!-- Google Code for StudyKIK Conversion Page -->
<script type="text/javascript">// <![CDATA[
  var google_conversion_id = 979334053; var google_conversion_language = "en"; var google_conversion_format = "3"; var google_conversion_color = "ffffff"; var google_conversion_label = "dwNTCMebj1kQpef90gM"; var google_remarketing_only = false;
  // ]]>
</script>
<script src="//www.googleadservices.com/pagead/conversion.js" type="text/javascript">// <![CDATA[

  // ]]>
</script>
<noscript>
  <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/979334053/?label=dwNTCMebj1kQpef90gM&guid=ON&script=0"/>
  </div>
</noscript>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#contactform').submit(function(){
      var errors = 0;
      var email_message = $('#emailInfo span').html();
      var user_check = $('#userinfo span').html();

      $("#contactform .required").map(function(){
        if( !$(this).val() ){
          $(this).addClass('warning');
          $("#fullname").focus();
          errors++;
        }
        else if ($(this).val()) {
          $(this).removeClass('warning');
        }
      });

      if(email_message != "Email OK"){
        errors++;
      }else if(user_check != "Username OK"){
        errors++;
      }

      if(errors > 0){
        return false;
      }
    });

  });
</script>

<script type="text/javascript">
  function keyupcheckPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();
    if (password != confirmPassword){
      $("#divCheckPasswordMatch").html("Passwords do not match!");
      $("#divCheckPasswordMatch").css("color", "red");
      return false;
    }else{
      $("#divCheckPasswordMatch").html("Passwords match.");
      $("#divCheckPasswordMatch").css("color", "green");
      return true;
    }
  }
</script>

<style>
  #wpcf7-f74-p6-o123 .wpcf7-form-control-wrap {
    float: left;
    width: 628px;
  }
  #wpcf7-f74-p6-o123 .wpcf7-form-control-wrap a {
    font-weight:bold;
  }
  input[type=checkbox] {
    /* Double-sized Checkboxes */
    -ms-transform: scale(1.5); /* IE */
    -moz-transform: scale(1.5); /* FF */
    -webkit-transform: scale(1.5); /* Safari and Chrome */
    -o-transform: scale(1.5); /* Opera */
  }
  .fisrt_step {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #f78f1e;
    float: left;
    width: 100%;
    margin-bottom:20px;
  }
  .inner_cont {
    float: left;
    padding: 30px;
    width: 100%;
  }
  .show_hide_input {
    width: auto !important;
  }
  .study label {
    float: left;
    font-size: 18px;
    line-height: 43px;
    width: 30%;
  }
  .study input[type="text"], .study input[type="email"], .study input[type="file"], .study select, .study textarea {
    width:70%;
    float:right;
  }
  .study  p {
    float: left;
    width: 100%;
  }
  .warning {
    border: 1px solid red !important;
  }
  .study input[type="checkbox"] {
    box-shadow: none;
    height: 25px;
  }
</style>
<div id="err_msgg" class="white_content" style="display: none;">
  <h2 class="heading">Oops</h2>
  <p id="msg_box" style="color: #000; padding: 15px; font-size: 16px; text-align: center;font-weight: bold;">This username has already been created.</p>
  <a onclick="document.getElementById('err_msgg').style.display = 'none';document.getElementById('fade').style.display = 'none';" href="javascript:void(0)" class="closepop">Close</a>
</div>
<div id="inner-page">
<div class="container">
<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
      <div class="entry-thumbnail">
        <?php the_post_thumbnail(); ?>
      </div>
    <?php endif; ?>
    <h1 class="entry-title">
      <?php the_title(); ?>
    </h1>
  </header>
  <!-- .entry-header -->
  <div class="entry-content">
  <div class="inner-form">
  <?php the_content(); ?>
  <?php
  if(isset($_REQUEST['show_hide_input2'])){
    $number_of_studies = $_REQUEST['number_of_studies'];
    $siteemailErr="";
    ?>
    <form id="contactform" enctype="multipart/form-data" method="post" onsubmit="">
    <div class="fisrt_step" id="second_step">
      <h2 style="background:#f78f1e;color: #fff; text-transform: uppercase; margin: 0px; padding: 5px;">Create Your My StudyKIK Portal Login</h2>
      <div class="inner_cont" id="second_step_cont">
        <p>
          <label>Full Name: </label>
					    <span class="wpcf7-form-control-wrap textarea-350">
					    <input  type="text" class="required" id="fullname" aria-required="true"  value="" name="fullname" />
					    </span>
        </p>
        <p>
          <label>Email: </label>
					    <span class="wpcf7-form-control-wrap textarea-350">
					    <input  id="email_user" type="email" class="required" aria-required="true"  value="" name="username" />
					    </span>
        </p>
        <div id="emailInfo" style="margin-left:391px;margin:0px !important;"></div>
        <div style="color:red;margin-left:350px;"> <?php echo $siteemailErr;?></div>
        <p>
          <label>Site Name: </label>
					    <span class="wpcf7-form-control-wrap textarea-350">
					    <input id="site_name" type="text" class="required" aria-required="true"  value="" name="site_name" />
					    </span>
        </p>
        <p>
          <label>Username: </label>
					    <span class="wpcf7-form-control-wrap textarea-350">
					    <input id="u_name" type="text" class="required" aria-required="true"  value="" name="username2" />
					    </span>
        <div id="userinfo" style="margin:0px !important;"></div>
        </p>
        <p>
          <label>Site Address: </label>
					    <span class="wpcf7-form-control-wrap textarea-350">
					    <input id="site_addr" type="text" class="required" aria-required="true"  value="" name="site_addr" />
					    </span>
        </p>
        <p>
          <label>Password: </label>
					    <span class="wpcf7-form-control-wrap textarea-350">
					    <input style="width:100%;" class="required" aria-required="true" id="txtNewPassword"  type="password" value="" name="pwd1" />
					    </span>
        </p>
        <p>
          <label>Confirm Password: </label>
					    <span class="wpcf7-form-control-wrap textarea-350">
					    <input style="width:100%;" class="required" aria-required="true" id="txtConfirmPassword"  onkeyup="keyupcheckPasswordMatch();"   type="password" value="" name="pwd2" />
					    </span>
        </p>
        <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
      </div>
    </div>
    <div class="fisrt_step" id="third_step">
      <h2 style="background:#f78f1e;color: #fff; text-transform: uppercase; margin: 0px; padding: 5px;">Enter Study Details</h2>
      <div class="inner_cont" id="third_step_cont">
        <input type="hidden" name="total_entries" value="<?php echo $number_of_studies; ?>" />
        <?php
        for ($x=1; $x<=$number_of_studies; $x++){?>
          <script type="text/javascript">
            $(function(){
              $( "#datepicker<?php echo $x; ?>" ).datepicker();
            });
            function addNew<?php echo $x; ?>(asa){
              var addDiv<?php echo $x; ?> = $('#addinput<?php echo $x; ?>');
              var i = $('#addinput<?php echo $x; ?> p').size() + 1;
              if(i == 5){ $(".addd_new<?php echo $x; ?>").hide(); }else{ $(".addd_new<?php echo $x; ?>").show(); }
              $('<p><label>Recruitment Email #' + i +': </label><span class="wpcf7-form-control-wrap email-577"><input style="margin-bottom:0px;" type="email"  aria-required="true" size="40" value="" name="contactemail' + i + '<?php echo $x; ?>"><a style="position: absolute; top: 26px; right: -579px;" href="javascript:void();" onClick="return aaaaa<?php echo $x; ?>(this);" id="remNew"><img style="width: 12px;"  src="<?php bloginfo('template_url');?>/images-dashboard/delete_icon.png" /></a></span></p>').appendTo(addDiv<?php echo $x; ?>);
              i++;
              return false;
            }
            function aaaaa<?php echo $x; ?>(el){
              $(el).parents('p').remove();
              var i = $('#addinput<?php echo $x; ?> p').size()-1;
              if(i == 5){ $(".addd_new<?php echo $x; ?>").hide(); }else{ $(".addd_new<?php echo $x; ?>").show(); }
              $('#addinput<?php echo $x; ?> p:nth-child(1) label').html("Recruitment Email #1:");
              $('#addinput<?php echo $x; ?> p:nth-child(2) label').html("Recruitment Email #2:");
              $('#addinput<?php echo $x; ?> p:nth-child(3) label').html("Recruitment Email #3:");
              $('#addinput<?php echo $x; ?> p:nth-child(4) label').html("Recruitment Email #4:");
              $('#addinput<?php echo $x; ?> p:nth-child(5) label').html("Recruitment Email #5:");
              return false;
            }
          </script>
          <div class="study<?php echo $x; ?> study" >
            <h2 style="background: #00afef; float:left; width:100%; color: #fff; font-size: 20px;margin: 0 0 10px;padding: 9px; text-transform: uppercase;">Study #<?php echo $x; ?></h2>
            <p>
              <label>Study Type:<br></label>
						    <span class="wpcf7-form-control-wrap">
							<select class="required" aria-required="true" name="studytype<?php echo $x; ?>">
                <option value="">Make a Selection</option>
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
						    </span>
            </p>
            <p>
              <label>Site Name: </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input class="required" aria-required="true"  type="text" size="40" value="" name="sitename<?php echo $x; ?>" >
						    </span>
            </p>
            <p>
              <label>Study Address: </label>
						    <span class="wpcf7-form-control-wrap text-848">
						    <input class="required" aria-required="true"  type="text" size="40" value="" name="studylocation<?php echo $x; ?>" >
						    </span>
            </p>
            <p>
              <label>Study Details: </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <textarea aria-required="true"  rows="6" cols="50" name="studydetails<?php echo $x; ?>"></textarea>
						    </span>
            </p>
            <p>
              <label>Protocol Number: </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input aria-required="true" class="required" type="text" size="40" value="" name="protocolnumber<?php echo $x; ?>" >
						    </span>
            </p>
            <p>
              <label>Sponsor Name: </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input class="required" aria-required="true"  type="text" size="40" value="" name="sponsorname<?php echo $x; ?>" >
						    </span>
            </p>
            <p>
              <label>Sponsor Email: </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input aria-required="true"  type="text" size="40" value="" name="sponsoremail<?php echo $x; ?>" >
						    </span>
            </p>
            <p>
              <label>CRO Name: </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input type="text" size="40" value="" name="croname<?php echo $x; ?>" >
                        </span>
            </p>
            <p>
              <label>CRO Email: </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input  type="text" size="40" value="" name="croemail<?php echo $x; ?>" >
                        </span>
            </p>
            <div id="addpicker<?php echo $x; ?>">
              <p>
                <label>Start Date: </label>
							<span class="wpcf7-form-control-wrap textarea-350">
							<input class="required" id="datepicker<?php echo $x; ?>"  aria-required="true"  type="text" size="40" value="<?php echo date('m/d/Y');?>" name="startdate<?php echo $x; ?>" >
							</span>
              </p>
            </div>
            <p class="addd_new<?php echo $x; ?>"><label></label>  <span class="wpcf7-form-control-wrap text-426"><a class="determine_start" unique_id="<?php echo $x; ?>" style="float: left; display: block; font-size: 16px; font-weight: bold; margin-bottom: 6px;margin-top: -6px;" href="javascript:void(0);">To be determined</a></span></p>
            <p>
              <label>Recruitment Phone: </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input class="required" aria-required="true"  type="text" size="40" value="" name="contactphone<?php echo $x; ?>" >
						    </span>
            </p>
            <div id="addinput<?php echo $x; ?>">
              <p>
                <label>Recruitment Email #1: </label>
							<span class="wpcf7-form-control-wrap text-426">
							<input class="required" style="margin-bottom:0px;" type="email"  aria-required="true"  size="40" value="" name="contactname<?php echo $x; ?>">
							</span>
              </p>
            </div>
            <p class="addd_new<?php echo $x; ?>"><label></label>  <span class="wpcf7-form-control-wrap text-426"><a style="float: left; display: block; font-size: 16px; font-weight: bold; margin: 7px 0px;" onclick="return addNew<?php echo $x; ?>(this);" href="javascript:void();">Add another recruitment email</a></span></p>
            <p>
              <label>Study Website: </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input aria-required="true"  type="text" size="40" value="" name="study_website<?php echo $x; ?>" >
						    </span>
            </p>
            <p>
              <label>Exposure Level: </label>
						    <span class="wpcf7-form-control-wrap">
							<select class="required" aria-required="true" name="boost_type<?php echo $x; ?>">
                <option value="">Make a Selection</option>
                <option value="Diamond">Diamond: $3059</option>
                <option value="Platinum">Platinum: $1559</option>
                <option value="Gold">Gold: $559</option>
                <option value="Silver">Silver: $209</option>
                <option value="Bronze">Bronze: $59</option>
              </select>
						    </span>
            </p>
            <p>
              <label style="line-height: 24px;">Add Patient Messaging<br />
                Suite ($247): </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
							<input style="width:auto;" type="checkbox" name="message_suite_247<?php echo $x; ?>" />
							<span style="color: #00afef;line-height: 25px;margin-left: 10px;font-weight: bold;">Yes</span>
						    </span>
            </p>
            <p>
              <label style="line-height: 24px;">Condense to 2 <br />
                Weeks (Free): </label>
						    <span class="wpcf7-form-control-wrap">
						    <input style="width:auto;" type="checkbox" name="condense_2_weeks<?php echo $x; ?>" />
						    <span style="color: #00afef;line-height: 25px;margin-left: 10px;font-weight: bold;">Yes</span> </span>
            </p>
            <p>
              <label style="line-height: 24px;">Upload Study Ad <br />
                (not required) :</label>
						    <span class="wpcf7-form-control-wrap your-file">
						    <input type="file" class="attachment" size="40" name="attachment<?php echo $x; ?>">
						    </span>
            </p>
            <p>
              <label>Credit Card (Last 4 Digits): </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <input class="required" aria-required="true"  type="text" size="40" value="" name="creditcard<?php echo $x; ?>" >
						    </span>
            </p>
            <p>
              <label>Notes: </label>
						    <span class="wpcf7-form-control-wrap textarea-350">
						    <textarea aria-required="true"  rows="6" cols="50" name="notes<?php echo $x; ?>"></textarea>
						    </span>
            </p>
          </div>
          <input type="hidden" value="total_studies<?php echo $x; ?>" name="total_studies<?php echo $x; ?>" />
        <?php
        } ?>
        <p>
          <label></label>
          <input type="submit" class="show_hide_input" name="show_hide_input" value="List My Studies">
        </p>
      </div>
    </div>
    </form>
  <?php
  }
  else{?>
    <form class="add_Study" action="" method="post">
      <p>
        <label>Number of studies: </label>
        <select name="number_of_studies">
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
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
        </select>
        <input type="submit" class="show_hide_input" name="show_hide_input2" value="Add">
      </p>
    </form>
  <?php
  } ?>
  <?php
  $query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` ORDER BY `id` DESC LIMIT 1");
  foreach($query_invoice_number as $query_invoice_number_value){
    $invoice_num = $query_invoice_number_value->invoice_number;
  }
  if(isset($_REQUEST['show_hide_input'])){
    $fullname = $_REQUEST['fullname'];
    $first_name = explode(" ", $fullname);
    $fname =  $first_name[0];
    $username = $_REQUEST['username'];
    $username2 = str_replace(' ', '_', $_REQUEST['username2']);
    $pwd1 = $_REQUEST['pwd1'];
    $pwd2 = $_REQUEST['pwd2'];
    $siteaddress=$_REQUEST['site_addr'];
    $sitename=$_REQUEST['site_name'];

    if (username_exists($username2)){
      $user = get_user_by('login', $username2 );
      $user_id = $user->ID;
      $updateduserdata = array(
        'ID' => $user_id,
        'user_pass'   =>  $pwd1,
        'nickname' => $fullname,
        'user_email' => $username,
        'first_name' => $fullname,
        'user_nicename' => $fullname,
      );
      //echo($user_id."->exist"); exit;
      $updated_user_id = wp_update_user($updateduserdata) ;
      $meta_key='add_manager_id';
      $meta_value=get_current_user_id();
      add_user_meta( $user_id, $meta_key, $meta_value, false );
      $meta_key='address';
      $meta_value=$siteaddress;
      $prev_value='';
      update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );
      $meta_key='sitename';
      $meta_value=$sitename;
      update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );
    } else {
      $userdata = array(
        'user_login'  =>  $username2,
        'user_pass'   =>  $pwd1,
        'role' =>  'editor',
        'nickname' => $fullname,
        'user_email' => $username,
        'first_name' => $fullname,
        'user_nicename' => $fullname,
      );
      //echo "aaaaa";
      $user_id = wp_insert_user( $userdata );
      //var_dump($user_id); exit;
      $meta_key='add_manager_id';
      $meta_value=get_current_user_id();
      add_user_meta( $user_id, $meta_key, $meta_value, false );
      $meta_key='address';
      $meta_value=$siteaddress;
      $prev_value='';
      update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );
      $meta_key='sitename';
      $meta_value=$sitename;
      update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );
    }
    $subject_user = "My StudyKIK Portal Login";
    $subject_admin = "StudyKIK Portal Login for".$fullname;
    $body_user = "Hi ".$fname.":<br /><br />
			    Thank you for signing up with StudyKIK.com!<br /><br />
			    Please see the login information for your MyStudyKIK Portal below:<br /><br />
			    Login to see your current study stats, patients' contact information in real time, rewards your site can earn, and much more!<br /><br />
			    Link to My StudyKIK Portal: <a href='".site_url()."/login/'>CLICK HERE</a><br />
			    Username: ".$username2."<br />
			    Email: ".$username."<br />
			    Password: ".$pwd1."<br /><br />
			    We look forward to referring quality patients to your site and helping enroll your studies!<br /><br />
			    Thank you,<br /><br />
			    StudyKIK<br />
			    info@studykik.com<br />
			    1-877-627-2509<br />";
    $headers_user[] = 'From: StudyKIK <info@studykik.com>';
    $headers_user[] = 'From: StudyKIK <info@studykik.com>';
    $headers_user[] = "MIME-Version: 1.0\r\n";
    $headers_user[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $headers_admin[] = 'From: Login Details <'.$username.'>';
    $headers_admin[] = "MIME-Version: 1.0\r\n";
    $headers_admin[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if($croname == 'testing'){
      //$user_ID = get_current_user_id();
      //echo get_option( 'admin_email').'aaaaaaaaaaaaa';
      $user_info = get_userdata(70);
      $cromail=$user_info->user_email ;
      wp_mail($cromail,$subject_user, $body_user,$headers_admin);
    }
    else{
      wp_mail($username,$subject_user, $body_user, $headers_admin);
    }

    $inc_nummm=$invoice_num;
    $total_entries = $_REQUEST['total_entries'];
    for ($y=1; $y<=$total_entries; $y++){
      if(isset($_FILES['attachment'.$y]['name'])){
        $nmm=$_FILES['attachment'.$y]['name'];
        $upnm=str_replace(" ","_",$nmm);
        $_FILES['attachment'.$y]['name']=$upnm;
      }
      $final_num =  $inc_nummm+1;
      $inc_nummm=$inc_nummm+1;
      $studytype = stripslashes($_REQUEST['studytype'.$y]);
      $sitename = $_REQUEST['sitename'.$y];
      $studylocation = $_REQUEST['studylocation'.$y];
      $studydetails = $_REQUEST['studydetails'.$y];
      $protocolnumber = $_REQUEST['protocolnumber'.$y];
      $startdate = $_REQUEST['startdate'.$y];
      $notes = $_REQUEST['notes'.$y];
      $contactname = $_REQUEST['contactname'.$y];
      $contactemail = $_REQUEST['contactemail2'.$y];
      $contactemail2 = $_REQUEST['contactemail3'.$y];
      $contactemail3 = $_REQUEST['contactemail4'.$y];
      $contactemail4 = $_REQUEST['contactemail5'.$y];
      $contactphone = $_REQUEST['contactphone'.$y];
      $study_website = $_REQUEST['study_website'.$y];
      $boost_type1 = $_REQUEST['boost_type'.$y];
      $sponsorname = $_REQUEST['sponsorname'.$y];
      $sponsoremail = $_REQUEST['sponsoremail'.$y];
      $croname = $_REQUEST['croname'.$y];
      $croemail = $_REQUEST['croemail'.$y];
      $creditcard = $_REQUEST['creditcard'.$y];
      if($boost_type1 == "Diamond"){
        $price = '$3,059.00';
        $price2 = '3059.00';
      }
      if($boost_type1 == "Platinum"){
        $price = '$1,559.00';
        $price2 = '1559.00';
      }
      if($boost_type1 == "Gold"){
        $price = '$559.00';
        $price2 = '559.00';
      }
      if($boost_type1 == "Silver"){
        $price = '$209.00';
        $price2 = '209.00';
      }
      if($boost_type1 == "Bronze"){
        $price = '$59.00';
        $price2 = '59.00';
      }
      $point_transfer=0;
      $transfer_id=$user_id;
      $act_txt='';
      if ($boost_type1 == "Gold"){
        $point_transfer=5;
        $act_txt='Gold';
      }
      if ($boost_type1 == "Platinum") {
        $point_transfer=15;
        $act_txt='Platinum';
      }
      if ($boost_type1 == "Diamond") {
        $point_transfer=30;
        $act_txt='Diamond';
      }
      if($point_transfer > 0 && $transfer_id !=0 ){
        $rewards_datetime = date('Y-m-d H:i:s',strtotime('-4 hours'));
        $result1=mysql_query("SELECT `balance` FROM `0gf1ba_rewards_details` WHERE user_id='$transfer_id' and is_last=1  ORDER BY `id` DESC LIMIT 1");
        $balance = 0;
        while($row = mysql_fetch_assoc($result1)) {
          //print_r($row);
          $balance=$row["balance"];
        }

        if($balance == 0)
        {
          $new_balance=$point_transfer;
        }
        else{
          $new_balance=$point_transfer+$balance;
        }
        //echo $balance.'ccccccccccccc';

        $activity='List a new study'.' ('.$act_txt .')';
        mysql_query("UPDATE 0gf1ba_rewards_details SET is_last=0 WHERE user_id='$transfer_id'");
        $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_rewards_details`(`id`, `user_id`, `activity_of_points`,`rewards_date_time`,`credit`,`debit`,`balance`,`is_last`) VALUES (NULL,'$transfer_id','$activity','$rewards_datetime','$point_transfer',0,'$new_balance',1)",array()));
        update_user_meta($transfer_id, 'rewards', $new_balance);
      }
      $message_suite_247 = $_REQUEST['message_suite_247'.$y];
      if($message_suite_247 == true){
        $message_suite_247 = "Yes";
        $message_suite = "$247.00";
        $message_suite2 = "247.00";

      }
      else{
        $message_suite_247 = "No";
        $message_suite = " ";
        $message_suite2 = " ";
      }
      $condense_2_weeks = $_REQUEST['condense_2_weeks'.$y];
      if($condense_2_weeks == true){
        $condense_2_weeks = "Yes";
        $end_date = "15 days";
        $newDate = date("m/d/Y", strtotime($startdate ." +14 day") );
      }
      else{
        $condense_2_weeks = "No";
        $end_date = "30 days";
        $newDate = date("m/d/Y", strtotime($startdate ." +29 day") );
      }
      $sub_total = $price2 + $message_suite2;
      //setlocale(LC_MONETARY,"en_US");
      $sub_price =  money_format("%i", $sub_total);
      $sub_price="$".$sub_price;
      //$total_price = str_ireplace("USD","$",$sub_price);
      $total_price = str_ireplace(" ", "", $sub_price);
      if($boost_type1 == "Gold"){
        $rewards = get_the_author_meta('rewards', $user_id);
        $boost_value = $rewards+5;
        update_user_meta($user_id, 'rewards', $boost_value);
      }
      if($boost_type1 == "Platinum"){
        $rewards = get_the_author_meta('rewards', $user_id);
        $boost_value = $rewards+15;
        update_user_meta($user_id, 'rewards', $boost_value);
      }
      if($boost_type1 == "Diamond"){
        $rewards = get_the_author_meta('rewards', $user_id);
        $boost_value = $rewards+30;
        update_user_meta($user_id, 'rewards', $boost_value);
      }
      $subject = "cro/sponsors focus (".$final_num.")";
      $message .= "<body><table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>
				<tr>
				    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>CRO/SPONSORS FOCUS STUDY #".$y."</strong></td>
				</tr>
				<tr>
				    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Site Name:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sitename."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Protocol Number:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$protocolnumber."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Name:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sponsorname."</td>
				</tr>";
      if (strpos(strtolower($sponsoremail),'@studykik.com') == false) {
        $message .= " <tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Email:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sponsoremail."</td>
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
      $message .= " <tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Start Date:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$startdate."</td>
				</tr>";
      $l2=0;
      if (strpos(strtolower($contactname),'@studykik.com') == false) { $l2++;

        $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname."</td>
				</tr>";
      }
      if (strpos(strtolower($contactemail),'@studykik.com') == false) { $l2++;
        $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail."</td>
				</tr>";
      }
      if (strpos(strtolower($contactemail2),'@studykik.com') == false) { $l2++;
        $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail2."</td>
				</tr>";
      }
      if (strpos(strtolower($contactemail3),'@studykik.com') == false) { $l2++;
        $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail3."</td>
				</tr>";
      }
      if (strpos(strtolower($contactemail4),'@studykik.com') == false) { $l2++;
        $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail4."</td>
				</tr>";
      }
      $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Website:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$study_website."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type1."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Add Patient Messaging Suite $247:</strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$message_suite_247."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Condense to 2 Weeks: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$condense_2_weeks."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Credit Card (Last 4 Digits): </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$creditcard."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Notes: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$notes."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Invoice Number: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$final_num."</td>
				</tr>
				<tr>
				    <td height='5' colspan='3' align='right' valign='middle'></td>
				</tr>
				<tr>
				    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
				</tr>
				</table>
				</body>";
      $category_id = get_cat_ID($studytype);
      $final_titile= $sitename.' '.$studytype.' Study - Location: '.$studylocation;
      $my_post = array(
        'post_title'    => $final_titile,
        'post_content'  => $studydetails,
        'post_status'   => 'pending',
        'post_author'   => $user_id,
        'post_category' => array($category_id)
      );
      $post_id = wp_insert_post( $my_post );
      update_post_meta($post_id, 'email_adress', 'info@studyKIK.com');
      update_post_meta($post_id, 'email_adress_2', $contactname);
      update_post_meta($post_id, 'email_adress_3', $contactemail);
      update_post_meta($post_id, 'email_adress_4', $contactemail2);
      update_post_meta($post_id, 'email_adress_5', $contactemail3);
      update_post_meta($post_id, 'email_adress_6', $contactemail4);
      update_post_meta($post_id, 'phone_number', $contactphone);
      update_post_meta($post_id, 'exposure_level', $boost_type1);
      update_post_meta($post_id, 'name_of_site', $sitename);
      update_post_meta($post_id, 'study_full_address', $studylocation);
      update_post_meta($post_id, 'website_url_thank_you_page', $study_website);
      update_post_meta($post_id, 'custom_title_(for_thank_you_page)', $studytype);
      update_post_meta($post_id, 'study_end_date_new_study', $newDate);
      update_post_meta($post_id, 'protocol_no', $protocolnumber);
      update_post_meta($post_id, 'notes_cro', $notes);
      update_post_meta($post_id, 'sponsor_name', $sponsorname);
      update_post_meta($post_id, 'sponsor_email', $sponsoremail);
      update_post_meta($post_id, 'cro_name', $croname);
      update_post_meta($post_id, 'cro_email', $croemail);
      update_post_meta($post_id, 'creadit_card', $creditcard);
      global $wpdb;
      $f_attchment1 =$_FILES["attachment".$y]["tmp_name"];
      move_uploaded_file($_FILES["attachment".$y]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment'.$y]['name']));
      $attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment".$y]["name"];
      $attachments111 = site_url()."/wp-content/uploads/".$_FILES["attachment".$y]["name"];
      $wp_filetype = wp_check_filetype(basename($attachments111), null );
      $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content' => '',
        'post_status' => 'inherit'
      );
      $attach_id = wp_insert_attachment( $attachment, $attachments111, $post_id );
      set_post_thumbnail( $post_id, $attach_id );
      update_post_meta($post_id, 'file_url', $attachments111);
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
				padding:6px 0px;
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
				<col style='width: 57%'>
				<col style='width: 5%'>
				<col style='width: 20%'>

				      <tr>
					<th style='text-align:left; margin-left:20px;' colspan='2'><img style='width:295px; height:52px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/background_top.png'/><p style='font-size:14px; color:#959ca1;font-weight:normal; margin:2px 0px 0px 0px; line-height:18px;'><b>StudyKIK</b><br />1675 Scenic Ave #150<br />Costa Mesa, CA 92626</p></th>
					<th colspan='2' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px;'>
					<h1>INVOICE RECEIPT</h1>
					Invoice Number: ".$final_num."<br />
                    Invoice Date: ".$currdate."<br />
                    Term | Due on Receipt</th>
				    </tr>
				<tbody>
				<tr>
					<th style='text-align:left' colspan='4'><img style='width:100%;' src='".site_url()."/wp-content/themes/twentyfifteen/images/top_full.png'/></th></tr>
				    <tr style='text-align:center; font-size:18px;color:#000;'>
					<th align='left' style='border-bottom:1px solid #000;'>SERVICES:</th>
					<th align='left'style='border-bottom:1px solid #000;'>DESCRIPTION:</th>
					<th style='border-bottom:1px solid #000;'></th>
					<th  align='right' style='border-bottom:1px solid #000;'>AMOUNT:</th>
				    </tr>

				<tr align='center'>
				    <td align='left'>Listing</td>
				    <td align='left'><b>Site Name:</b> ".$sitename."</td>
				    <td align='center'> </td>
				    <td align='right'>".$price." </td>
				</tr>
				<tr align='center'>
				    <td align='left'></td>
				    <td align='left'><b>Study Type:</b> ".$studytype."</td>
				    <td align='center'> </td>
				    <td align='center'></td>
				</tr>
				<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Study Level:</b> ".$boost_type1."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				</tr>";
      if($protocolnumber){
        $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Protocol Number:</b> ".$protocolnumber."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
      }
      if($contactphone){
        $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Phone:</b> ".$contactphone."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
      }
      $l1=0;
      if (strpos(strtolower($contactname),'@studykik.com') == false) {
        $l1++;
        $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Recruitment Email ".$l1.":</b> ".$contactname."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
      }
      if($contactemail){
        if (strpos(strtolower($contactemail),'@studykik.com') == false) { $l1++;
          $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email ".$l1.":</b> ".$contactemail."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
        }
      }


      if($contactemail2){
        if (strpos(strtolower($contactemail2),'@studykik.com') == false) { $l1++;
          $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email ".$l1.":</b> ".$contactemail2."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
        }
      }

      if($contactemail3){
        if (strpos(strtolower($contactemail3),'@studykik.com') == false) { $l1++;
          $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email ".$l1.":</b> ".$contactemail3."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
        }
      }

      if($contactemail4){
        if (strpos(strtolower($contactemail4),'@studykik.com') == false) { $l1++;
          $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email ".$l1.":</b> ".$contactemail4."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
        }
      }
      $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Study Address:</b> ".$studylocation."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>
				<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Start Date:</b> ".$startdate."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
      if($startdate !="To be determined"){
        $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>End Date:</b> ".$newDate."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
      }
      else{
        $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>End Date:</b>&nbsp;To be determined</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
      }

      if($message_suite_247 == "Yes"){
        $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>Patient Messaging Suite</td>
				    <td bordercolor='#000' align='left'> </td>
				    <td bordercolor='#000' align='center'> </td>
				    <td bordercolor='#000' align='right'>".$message_suite."</td>
				    </tr>";
      }else{

        $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

      }
      if($contactemail == ""){
        $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
      }
      if($contactemail2 == ""){
        $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					";
      }
      if($contactemail3 == ""){
        $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";

      }
      if($contactemail4 == ""){
        $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";

      }

      $message_pdf .= "

				<tr class='sub_total' align='left'>
				<td align='center'  style='border-top:1px solid #000;'> </td>
				<td align='left'  style='border-top:1px solid #000;'> </td>
				<td align='right' colspan='2' style='border-top:1px solid #000;'>SUB TOTAL:&nbsp; ".$total_price."</td>
				</tr>
				<tr class='total' align='left'>
				<td align='center'> </td>
				<td align='left'> </td>
				<td align='right' colspan='2'><b>TOTAL:&nbsp; ".$total_price."</b></td>
				</tr>
				</tbody>
				<tr>";

      if($contactemail4 == ""){

        $message_pdf .= "<th colspan='4' style='font-size: 14px;'><img style='width:100%;height:470px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

      }else{

        $message_pdf .= "<th colspan='4' style='font-size: 14px;'><img style='width:100%;height:440px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

      }
      $message_pdf .= "</tr>
				</table></page>";


      $subject_pdf_email = "Thank You for Listing ".$studytype." ".$protocolnumber."";
      $pdf_email_text .= "
				Hi ".$fname.",<br /><br />
				Thank you for listing your ".$studytype." ".$protocolnumber." study with StudyKIK.<br /><br />
				Please see invoice attached with detailed information.<br /><br />
				If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
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
      $html2pdf = new HTML2PDF('P', 'A4','en', true, 'UTF-8', array(0, 0, 0, 0));
      $html2pdf->setDefaultFont('Arial');
      $html2pdf->writeHTML($message_pdf);
      //ob_end_clean();
      $study_cat_name1 = str_replace(' ', '_', $studytype);
      $study_cat_name2 = str_replace("'", "", $study_cat_name1);
      $study_cat_name = stripslashes($study_cat_name2);

      $rand= rand();
      $html2pdf->Output( dirname(__FILE__)."/pdf/".$final_num.' '.$studytype.' '.$boost_type1.' Invoice'.".pdf", "f");
      $html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_'.$study_cat_name.'_'.$boost_type1.'_Invoice'.".pdf", "f");
      $pdf_attachment_path = dirname(__FILE__).'/pdf/'.$final_num.' '.$studytype.' '.$boost_type1.' Invoice.pdf';
      $pdf_attachment_path_db = '/pdf/'.$final_num.'_'.$study_cat_name.'_'.$boost_type1.'_Invoice.pdf';
      $attachments[] = dirname(__FILE__).'/pdf/'.$final_num.' '.$studytype.' '.$boost_type1.' Invoice.pdf';
      update_post_meta($post_id, 'pdfpath', $pdf_attachment_path);
      if($croname == 'testing'){
        $user_info = get_userdata(70);
        $cromail=$user_info->user_email ;
        wp_mail($cromail,$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
      }
      else{
//$username=$username.',mo.tan@studykik.com';
        wp_mail($username,$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
      }

      $pdf_email_text = "";
      $message_pdf = "";
      $current_month = date('M');
      $current_year = date('Y');
      $full_date = date('m/d/y');
      $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`(`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES (NULL,'$user_id','$post_id','$pdf_attachment_path_db','$protocolnumber','$final_num','$total_price','$current_month','$current_year','Study Information','$full_date')"));
    }
    $headers[] = 'From: '.$fullname.' <info@studykik.com>';;
    //$headers[] = 'Reply-To: '.$fullname.' <'.$username.'>';
    $headers[] = "MIME-Version: 1.0\r\n";
    $headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if($croname == 'testing'){
      $user_info = get_userdata(70);
      $cromail=$user_info->user_email ;
      $SendEmail=wp_mail($cromail,$subject, $message,$headers,$attachments);
    }
    else{
      $SendEmail=wp_mail("info@studykik.com",$subject, $message,$headers,$attachments);
    }

    ?>
    <script type="text/javascript">
      window.location = "<?php echo site_url();?>/thank-listing/";
      //setTimeout(function () {
      //window.location = "<?php echo site_url();?>/thank-listing/";}, 10);
    </script>

    <?php
    header('Location: '.site_url().'/thank-listing/');
    if($SendEmail){?>

    <?php
    }
    else{
      //echo '<h3 style="color: red; float: left; margin-top: 51px; text-align: center; width: 100%;">ERROR: TRY AGAIN</h3>';
    }
  }
  ?>
  <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
  </div>
  <!-- .entry-content -->
  </div>
  </article>
  <!-- #post -->
<?php endwhile; ?>
</div>
<script>
  $('.determine_start').on('click',function() {
    var un_id=$(this).attr('unique_id');
    $("#datepicker"+un_id).val('To be determined');
  });
</script>
</div>
<div id="fade" class="black_overlay"></div>
<style>
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
    z-index: 1001;
  }
  h2.heading{
    background: #f78e1e none repeat scroll 0 0;
    color: #fff;
    font-family: alternate;
    font-size: 44px;
    margin: 0;
    padding: 5px;
    text-align: center;
    text-decoration: none;
  }

  .close_button{
    background: #00afef;
    border: medium none;
    color: #fff;
    font-family: alternate;
    font-size: 33px;
    padding: 0 26px;
  }
  .closepop {
    background: transparent url("<?php bloginfo('template_url'); ?>/images-dashboard/close2.png") no-repeat scroll 0 0;

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
  .patient{width:150px;}
  dd { min-height: 25px;  }
</style>
<!-- #primary -->
<?php get_footer(); ?>
<script>
  jQuery(document).ready(function(){

    jQuery('#email_user').blur(function(e) {
      var emailok = false;
      var site_email=jQuery('#email_user').val();
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(regex.test(site_email)){
        jQuery.ajax({
          url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
          type: 'POST',
          data: "action=dashboard_add_email&email="+site_email,
          beforeSend: function(){
            jQuery('#emailInfo').html("<span style='float:right;margin-right:5px;margin-top:-10px;'>Checking Email</span>"); //show checking or loading image
          },
          success: function(html){
            if(html != 0)
            {
              emailok = false;
              if (jQuery('#site_email').val() !='' ){
                jQuery('#emailInfo').html("<span style='color:red;float:right;margin-right:5px;margin-top:-10px;'>Email Already Exist</span>");
                jQuery('#site_email').addClass('warning');
                jQuery('#site_email').val("");
              }
            }
            if(html == 0)
            {
              emailok = true;
              if (jQuery('#site_email').val() !='' ){
                jQuery('#emailInfo').html("<span style='color:green;margin-right:5px;float:right;margin-top:-10px;'>Email OK</span>");
                jQuery('#site_email').removeClass('warning');
              }
            }
          }

        })
      }
      else{
        jQuery('#emailInfo').html("<span style='color:red;float:right;margin-right:5px;margin-top:-10px;'>Invalid Email</span>");
        jQuery('#site_email').addClass('warning');

      }
    });

    jQuery('#u_name').blur(function(e) {
      var username_check = false;
      var username = jQuery('#u_name').val();

      if(username != ""){
        jQuery.ajax({
          url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
          type: 'POST',
          data: "action=check_username&username="+username,
          beforeSend: function(){
            jQuery('#userinfo').html("<span style='float:right;margin-right:5px;margin-top:-10px;'>Checking Username</span>"); //show checking or loading image
          },
          success: function(html){
            if(html != 0){
              username_check = false;
              if (jQuery('#u_name').val() !='' ){
                jQuery('#userinfo').html("<span style='color:red;float:right;margin-right:5px;margin-top:-10px;'>Username Already Exist</span>");
                jQuery('#u_name').addClass('warning');
              }
            }
            if(html == 0){
              username_check = true;
              if (jQuery('#u_name').val() !='' ){
                jQuery('#userinfo').html("<span style='color:green;margin-right:5px;float:right;margin-top:-10px;'>Username OK</span>");
                jQuery('#u_name').removeClass('warning');
              }
            }
          }
        });
      } else {
        jQuery('#u_name').addClass('warning');
        jQuery('#userinfo').html("");
      }
    });

  });
</script>