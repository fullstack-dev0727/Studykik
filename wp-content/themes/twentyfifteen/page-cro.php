<?php



/**



Template Name: CRO Template



 */






$user_ID = get_current_user_id();
$is_rewards_allowed = get_user_meta($user_ID, 'rewards_allowed', true);
get_header(); ?>
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



});

</script>

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

		if(isset($_REQUEST['show_hide_input2']))

		{

			$number_of_studies = $_REQUEST['number_of_studies'];

	  ?>
        <div id="wpcf7-f74-p6-o123" >
          <div id="errorwarn"></div>
          <form id="contactform" enctype="multipart/form-data" method="post" >
            <?php
for ($x=1; $x<=$number_of_studies; $x++)
  {?>
            <?php if($x == 5555){?>
            <h2 style="background:orange;">Create Your My StudyKIK Portal Login</h2>
            <p>
              <label>Username: </label>
              <span class="wpcf7-form-control-wrap textarea-350">
              <input  type="text" class="required" aria-required="true"  value="" name="username" />
              </span></p>
            <p>
              <label>Password: </label>
              <span class="wpcf7-form-control-wrap textarea-350">
              <input style="width:600px;" class="required" aria-required="true"  type="password" value="" name="pwd1" />
              </span></p>
            <p>
              <label>Confirm Password: </label>
              <span class="wpcf7-form-control-wrap textarea-350">
              <input style="width:600px;" class="required" aria-required="true"  type="password" value="" name="pwd2" />
              </span></p>
            <?php } ?>
            <div class="study<?php echo $x; ?>">
              <h2>Study #<?php echo $x; ?></h2>
              <p>
                <label>Study Type:<br>
                </label>
                <span class="wpcf7-form-control-wrap">
                <select aria-required="true" name="studytype<?php echo $x; ?>">
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
                </span> </p>
              <p>
                <label>Study Address: </label>
                <span class="wpcf7-form-control-wrap text-848">
                <input class="required" aria-required="true"  type="text" size="40" value="" name="studylocation<?php echo $x; ?>" >
                </span></p>
              <p>
                <label>Study Details: </label>
                <span class="wpcf7-form-control-wrap textarea-350">
                <textarea  class="required" aria-required="true"  rows="6" cols="50" name="studydetails<?php echo $x; ?>"></textarea>
                </span></p>
              <p>
                <label>Recruitment Email #1: </label>
                <span class="wpcf7-form-control-wrap text-426">
                <input type="text" class="required" aria-required="true"  size="40" value="" name="contactname<?php echo $x; ?>">
                </span></p>
              <p>
                <label>Recruitment Email #2: </label>
                <span class="wpcf7-form-control-wrap email-577">
                <input type="text" class="required" aria-required="true" size="40" value="" name="contactemail<?php echo $x; ?>">
                </span></p>
              <p>
                <label>Recruitment  Phone: </label>
                <span class="wpcf7-form-control-wrap text-744">
                <input type="text" class="required" aria-required="true"  size="40" value="" name="contactphone<?php echo $x; ?>">
                </span></p>
              <p>
                <label>Exposure Level: </label>
                <span class="wpcf7-form-control-wrap">
                <select aria-required="true" name="boost_type<?php echo $x; ?>">
                  <option value="">Make a Selection</option>
                 <option value="Platinum">Platinum</option>
                  <option value="Gold">Gold</option>
                   <option value="Silver">Silver</option>
                    <option value="Bronze">Bronze</option>
                </select>
                </span> </p>
              <p>
                <label>Upload Study Ad <br />
                  (not required) :</label>
                <span class="wpcf7-form-control-wrap your-file">
                <input type="file" class="attachment" size="40" name="attachment<?php echo $x; ?>">
                </span></p>
            </div>
            <input type="hidden" value="total_studies<?php echo $x; ?>" name="total_studies<?php echo $x; ?>" />
            <?php } ?>
            <p>
              <label></label>
              <input type="submit" class="show_hide_input" name="show_hide_input" value="List My Studies">
            </p>
            <div class="wpcf7-response-output wpcf7-display-none"></div>
          </form>
        </div>
        <?php }else{?>
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
        <?php } ?>
        <?php

		if(isset($_REQUEST['show_hide_input']))

		{

		$username = $_REQUEST['username'];
		$pwd1 = $_REQUEST['pwd1'];
		$pwd2 = $_REQUEST['pwd2'];

		if($pwd1 == $pwd2)	{
			$userdata = array(
			'user_login'  =>  $username,
			'user_pass'   =>  $pwd1,
			'role' =>  'editor'
		);

      $user_id = wp_insert_user( $userdata ) ;

/*//On success
if( !is_wp_error($user_id) ) {
 echo "User created : ". $user_id;
} */


			$studytype = $_REQUEST['studytype1'];

			$studylocation = $_REQUEST['studylocation1'];

			$studydetails = $_REQUEST['studydetails1'];

			$contactname = $_REQUEST['contactname1'];

			$contactemail = $_REQUEST['contactemail1'];

			$contactphone = $_REQUEST['contactphone1'];

			$boost_type1 = $_REQUEST['boost_type1'];



			$studytype2 = $_REQUEST['studytype2'];

			$studylocation2 = $_REQUEST['studylocation2'];

			$studydetails2 = $_REQUEST['studydetails2'];

			$contactname2 = $_REQUEST['contactname2'];

			$contactemail2 = $_REQUEST['contactemail2'];

			$contactphone2 = $_REQUEST['contactphone2'];

			$boost_type2 = $_REQUEST['boost_type2'];

			$total_studies2 = $_REQUEST['total_studies2'];





			$studytype3 = $_REQUEST['studytype3'];

			$studylocation3 = $_REQUEST['studylocation3'];

			$studydetails3 = $_REQUEST['studydetails3'];

			$contactname3 = $_REQUEST['contactname3'];

			$contactemail3 = $_REQUEST['contactemail3'];

			$contactphone3 = $_REQUEST['contactphone3'];

			$boost_type3 = $_REQUEST['boost_type3'];

			$total_studies3 = $_REQUEST['total_studies3'];





			$studytype4 = $_REQUEST['studytype4'];

			$studylocation4 = $_REQUEST['studylocation4'];

			$studydetails4 = $_REQUEST['studydetails4'];

			$contactname4 = $_REQUEST['contactname4'];

			$contactemail4 = $_REQUEST['contactemail4'];

			$contactphone4 = $_REQUEST['contactphone4'];

			$boost_type4 = $_REQUEST['boost_type4'];

			$total_studies4 = $_REQUEST['total_studies4'];



			$studytype5 = $_REQUEST['studytype5'];

			$studylocation5 = $_REQUEST['studylocation5'];

			$studydetails5 = $_REQUEST['studydetails5'];

			$contactname5 = $_REQUEST['contactname5'];

			$contactemail5 = $_REQUEST['contactemail5'];

			$contactphone5 = $_REQUEST['contactphone5'];

			$boost_type5 = $_REQUEST['boost_type5'];

			$total_studies5 = $_REQUEST['total_studies5'];


			$studytype6 = $_REQUEST['studytype6'];

			$studylocation6 = $_REQUEST['studylocation6'];

			$studydetails6 = $_REQUEST['studydetails6'];

			$contactname6 = $_REQUEST['contactname6'];

			$contactemail6 = $_REQUEST['contactemail6'];

			$contactphone6 = $_REQUEST['contactphone6'];

			$boost_type6 = $_REQUEST['boost_type6'];

			$total_studies6 = $_REQUEST['total_studies6'];


			$studytype7 = $_REQUEST['studytype7'];

			$studylocation7 = $_REQUEST['studylocation7'];

			$studydetails7 = $_REQUEST['studydetails7'];

			$contactname7 = $_REQUEST['contactname7'];

			$contactemail7 = $_REQUEST['contactemail7'];

			$contactphone7 = $_REQUEST['contactphone7'];

			$boost_type7 = $_REQUEST['boost_type7'];

			$total_studies7 = $_REQUEST['total_studies7'];


			$studytype8 = $_REQUEST['studytype8'];

			$studylocation8 = $_REQUEST['studylocation8'];

			$studydetails8 = $_REQUEST['studydetails8'];

			$contactname8 = $_REQUEST['contactname8'];

			$contactemail8 = $_REQUEST['contactemail8'];

			$contactphone8 = $_REQUEST['contactphone8'];

			$boost_type8 = $_REQUEST['boost_type8'];

			$total_studies8 = $_REQUEST['total_studies8'];


			$studytype9 = $_REQUEST['studytype9'];

			$studylocation9 = $_REQUEST['studylocation9'];

			$studydetails9 = $_REQUEST['studydetails9'];

			$contactname9 = $_REQUEST['contactname9'];

			$contactemail9 = $_REQUEST['contactemail9'];

			$contactphone9 = $_REQUEST['contactphone9'];

			$boost_type9 = $_REQUEST['boost_type9'];

			$total_studies9 = $_REQUEST['total_studies9'];


			$studytype10 = $_REQUEST['studytype10'];

			$studylocation10 = $_REQUEST['studylocation10'];

			$studydetails10 = $_REQUEST['studydetails10'];

			$contactname10 = $_REQUEST['contactname10'];

			$contactemail10 = $_REQUEST['contactemail10'];

			$contactphone10 = $_REQUEST['contactphone10'];

			$boost_type10 = $_REQUEST['boost_type5'];

			$total_studies10 = $_REQUEST['total_studies10'];


			$studytype11 = $_REQUEST['studytype11'];

			$studylocation11 = $_REQUEST['studylocation11'];

			$studydetails11 = $_REQUEST['studydetails11'];

			$contactname11 = $_REQUEST['contactname11'];

			$contactemail11 = $_REQUEST['contactemail11'];

			$contactphone11 = $_REQUEST['contactphone11'];

			$boost_type11 = $_REQUEST['boost_type11'];

			$total_studies11 = $_REQUEST['total_studies11'];


			$studytype12 = $_REQUEST['studytype12'];

			$studylocation12 = $_REQUEST['studylocation12'];

			$studydetails12 = $_REQUEST['studydetails12'];

			$contactname12 = $_REQUEST['contactname12'];

			$contactemail12 = $_REQUEST['contactemail12'];

			$contactphone12 = $_REQUEST['contactphone12'];

			$boost_type12 = $_REQUEST['boost_type12'];

			$total_studies12 = $_REQUEST['total_studies12'];


			$studytype13 = $_REQUEST['studytype13'];

			$studylocation13 = $_REQUEST['studylocation13'];

			$studydetails13 = $_REQUEST['studydetails13'];

			$contactname13 = $_REQUEST['contactname13'];

			$contactemail13 = $_REQUEST['contactemail13'];

			$contactphone13 = $_REQUEST['contactphone13'];

			$boost_type13 = $_REQUEST['boost_type13'];

			$total_studies13 = $_REQUEST['total_studies13'];


			$studytype14 = $_REQUEST['studytype14'];

			$studylocation14 = $_REQUEST['studylocation14'];

			$studydetails14 = $_REQUEST['studydetails14'];

			$contactname14 = $_REQUEST['contactname14'];

			$contactemail14 = $_REQUEST['contactemail14'];

			$contactphone14 = $_REQUEST['contactphone14'];

			$boost_type14 = $_REQUEST['boost_type14'];

			$total_studies14 = $_REQUEST['total_studies14'];


			$studytype15 = $_REQUEST['studytype15'];

			$studylocation15 = $_REQUEST['studylocation15'];

			$studydetails15 = $_REQUEST['studydetails15'];

			$contactname15 = $_REQUEST['contactname15'];

			$contactemail15 = $_REQUEST['contactemail15'];

			$contactphone15 = $_REQUEST['contactphone15'];

			$boost_type15 = $_REQUEST['boost_type15'];

			$total_studies15 = $_REQUEST['total_studies15'];


			$studytype16 = $_REQUEST['studytype16'];

			$studylocation16 = $_REQUEST['studylocation16'];

			$studydetails16 = $_REQUEST['studydetails16'];

			$contactname16 = $_REQUEST['contactname16'];

			$contactemail16 = $_REQUEST['contactemail16'];

			$contactphone16 = $_REQUEST['contactphone16'];

			$boost_type16 = $_REQUEST['boost_type16'];

			$total_studies16 = $_REQUEST['total_studies16'];


			$studytype17 = $_REQUEST['studytype17'];

			$studylocation17 = $_REQUEST['studylocation17'];

			$studydetails17 = $_REQUEST['studydetails17'];

			$contactname17 = $_REQUEST['contactname17'];

			$contactemail17 = $_REQUEST['contactemail17'];

			$contactphone17 = $_REQUEST['contactphone17'];

			$boost_type17 = $_REQUEST['boost_type17'];

			$total_studies17 = $_REQUEST['total_studies17'];


			$studytype18 = $_REQUEST['studytype18'];

			$studylocation18 = $_REQUEST['studylocation18'];

			$studydetails18 = $_REQUEST['studydetails18'];

			$contactname18 = $_REQUEST['contactname18'];

			$contactemail18 = $_REQUEST['contactemail18'];

			$contactphone18 = $_REQUEST['contactphone18'];

			$boost_type18 = $_REQUEST['boost_type18'];

			$total_studies18 = $_REQUEST['total_studies18'];


			$studytype19 = $_REQUEST['studytype19'];

			$studylocation19 = $_REQUEST['studylocation19'];

			$studydetails19 = $_REQUEST['studydetails19'];

			$contactname19 = $_REQUEST['contactname19'];

			$contactemail19 = $_REQUEST['contactemail19'];

			$contactphone19 = $_REQUEST['contactphone19'];

			$boost_type19 = $_REQUEST['boost_type19'];

			$total_studies19 = $_REQUEST['total_studies19'];


			$studytype20 = $_REQUEST['studytype20'];

			$studylocation20 = $_REQUEST['studylocation20'];

			$studydetails20 = $_REQUEST['studydetails20'];

			$contactname20 = $_REQUEST['contactname20'];

			$contactemail20 = $_REQUEST['contactemail20'];

			$contactphone20 = $_REQUEST['contactphone20'];

			$boost_type20 = $_REQUEST['boost_type20'];

			$total_studies20 = $_REQUEST['total_studies20'];


	/*############################## 1st #################################*/
			 if($boost_type1 == "Gold")
			 {
				 $rewards = get_the_author_meta('rewards', $user_id);
				 $boost_value = $rewards+10;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value);
                 }
			 }

			 if($boost_type1 == "Platinum")
			 {
				 $rewards = get_the_author_meta('rewards', $user_id);
				 $boost_value = $rewards+30;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value);
                 }
			 }

	/*############################## END ##########################*/


	/*############################## 2st #################################*/
			 if($boost_type2 == "Gold")
			 {
				 $rewards2_Gold = get_the_author_meta('rewards', $user_id);
				 $boost_value2_Gold = $rewards2_Gold+10;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value2_Gold);
                 }
			 }

			 if($boost_type2 == "Platinum")
			 {
				 $rewards2_Platinum = get_the_author_meta('rewards', $user_id);
				 $boost_value2_Platinum = $rewards2_Platinum+30;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value2_Platinum);
                 }
			 }

	/*############################## END ##########################*/


	/*############################## 3 #################################*/
			 if($boost_type3 == "Gold")
			 {
				 $rewards3_Gold = get_the_author_meta('rewards', $user_id);
				 $boost_value3_Gold = $rewards3_Gold+10;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value3_Gold);
                 }
			 }

			 if($boost_type3 == "Platinum")
			 {
				 $rewards3_Platinum = get_the_author_meta('rewards', $user_id);
				 $boost_value3_Platinum = $rewards3_Platinum+30;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value3_Platinum);
                 }
			 }

	/*############################## END ##########################*/


	/*############################## 4 #################################*/
			 if($boost_type4 == "Gold")
			 {
				 $rewards4_Gold  = get_the_author_meta('rewards', $user_id);
				 $boost_value4_Gold = $rewards4_Gold+10;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value4_Gold);
                 }
			 }

			 if($boost_type4 == "Platinum")
			 {
				 $rewards4_Platinum  = get_the_author_meta('rewards', $user_id);
				 $boost_value4_Platinum  = $rewards4_Platinum+30;
                 if((bool) $is_rewards_allowed){
                     if((bool) $is_rewards_allowed){
                         update_user_meta($user_id, 'rewards', $boost_value4_Platinum);
                     }
                 }
			 }

	/*############################## END ##########################*/


	/*############################## 5 #################################*/
			 if($boost_type5 == "Gold")
			 {
				 $rewards5_gold = get_the_author_meta('rewards', $user_id);
				 $boost_value5_gold = $rewards5_gold+10;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value5_gold);
                 }
			 }

			 if($boost_type5 == "Platinum")
			 {
				 $rewards_5Platinum = get_the_author_meta('rewards', $user_id);
				 $boost_value_5Platinum = $rewards_5Platinum+30;
                 if((bool) $is_rewards_allowed){
                     if((bool) $is_rewards_allowed){
                         update_user_meta($user_id, 'rewards', $boost_value_5Platinum);
                     }
                 }
			 }

	/*############################## END ##########################*/


	/*############################## 6 #################################*/
			 if($boost_type6 == "Gold")
			 {
				 $rewards6_gold = get_the_author_meta('rewards', $user_id);
				 $boost_value6_gold = $rewards6_gold+10;
                 if((bool) $is_rewards_allowed){
                     if((bool) $is_rewards_allowed){
                         update_user_meta($user_id, 'rewards', $boost_value6_gold);
                     }
                 }
			 }

			 if($boost_type6 == "Platinum")
			 {
				 $rewards_6Platinum = get_the_author_meta('rewards', $user_id);
				 $boost_value_6Platinum = $rewards_6Platinum+30;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value_6Platinum);
                 }
			 }

	/*############################## END ##########################*/


	/*############################## 7 #################################*/
			 if($boost_type7 == "Gold")
			 {
				 $rewards7_gold = get_the_author_meta('rewards', $user_id);
				 $boost_value7_gold = $rewards7_gold+10;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value7_gold);
                 }
			 }

			 if($boost_type7 == "Platinum")
			 {
				 $rewards_7Platinum = get_the_author_meta('rewards', $user_id);
				 $boost_value_7Platinum = $rewards_7Platinum+30;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value_7Platinum);
                 }
			 }

	/*############################## END ##########################*/

	/*############################## 8 #################################*/
			 if($boost_type8 == "Gold")
			 {
				 $rewards8_gold = get_the_author_meta('rewards', $user_id);
				 $boost_value8_gold = $rewards8_gold+10;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value8_gold);
                 }
			 }

			 if($boost_type8 == "Platinum")
			 {
				 $rewards_8Platinum = get_the_author_meta('rewards', $user_id);
				 $boost_value_8Platinum = $rewards_8Platinum+30;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value_8Platinum);
                 }
			 }

	/*############################## END ##########################*/

	/*############################## 9 #################################*/
			 if($boost_type9 == "Gold")
			 {
				 $rewards9_gold = get_the_author_meta('rewards', $user_id);
				 $boost_value9_gold = $rewards9_gold+10;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value9_gold);
                 }
			 }

			 if($boost_type9 == "Platinum")
			 {
				 $rewards_9Platinum = get_the_author_meta('rewards', $user_id);
				 $boost_value_9Platinum = $rewards_9Platinum+30;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value_9Platinum);
                 }
			 }

	/*############################## END ##########################*/

	/*############################## 10 #################################*/
			 if($boost_type10 == "Gold")
			 {
				 $rewards10_gold = get_the_author_meta('rewards', $user_id);
				 $boost_value10_gold = $rewards10_gold+10;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value10_gold);
                 }
			 }

			 if($boost_type10 == "Platinum")
			 {
				 $rewards_10Platinum = get_the_author_meta('rewards', $user_id);
				 $boost_value_10Platinum = $rewards_10Platinum+30;
                 if((bool) $is_rewards_allowed){
                     update_user_meta($user_id, 'rewards', $boost_value_10Platinum);
                 }
			 }

	/*############################## END ##########################*/



$subject = "cro/sponsors focus";

$message = "<body>

<table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>

  <tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>CRO/SPONSORS FOCUS</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype."</td>

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

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type1."</td>

  </tr>";

$category_id = get_cat_ID($studytype);
$final_titile= $studytype.' Study - Location: '.$studylocation;
$my_post = array(
  'post_title'    => $final_titile,
  'post_content'  => $studydetails,
  'post_status'   => 'pending',
  'post_author'   => $user_id,
  'post_category' => array($category_id)
);
$post_id = wp_insert_post( $my_post );

update_post_meta($post_id, 'email_adress', $contactemail);
update_post_meta($post_id, 'phone_number', $contactphone);
update_post_meta($post_id, 'exposure_level', $boost_type1);

  if($total_studies2)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>2nd Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype2."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation2."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails2."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname2."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail2."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone2."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type2."</td>

  </tr>";


$category_id2 = get_cat_ID($studytype2);
$final_titile2= $studytype2.' Study - Location: '.$studylocation2;

$my_post2 = array(
  'post_title'    => $final_titile2,
  'post_content'  => $studydetails2,
  'post_status'   => 'pending',
  'post_author'   => $user_id,
  'post_category' => array($category_id2)
);
$post_id2 = wp_insert_post( $my_post2 );

update_post_meta($post_id2, 'email_adress', $contactemail2);
update_post_meta($post_id2, 'phone_number', $contactphone2);
update_post_meta($post_id2, 'exposure_level', $boost_type2);



  }



    if($total_studies3)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong> 3rd Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype3."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation3."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails3."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname3."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail3."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone3."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type3."</td>

  </tr>";


$category_id3 = get_cat_ID($studytype3);
$final_titile3= $studytype3.' Study - Location: '.$studylocation3;
$my_post3 = array(
  'post_title'    => $final_titile3,
  'post_content'  => $studydetails3,
  'post_status'   => 'pending',
  'post_author'   => $user_id,
  'post_category' => array($category_id3)
);
$post_id3 = wp_insert_post( $my_post3 );

update_post_meta($post_id3, 'email_adress', $contactemail3);
update_post_meta($post_id3, 'phone_number', $contactphone3);
update_post_meta($post_id3, 'exposure_level', $boost_type3);


  }



    if($total_studies4)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>4th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype4."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation4."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails4."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname4."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail4."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone4."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type4."</td>

  </tr>";



$category_id4 = get_cat_ID($studytype4);
$final_titile4= $studytype4.' Study - Location: '.$studylocation4;

$my_post4 = array(
  'post_title'    => $final_titile4,
  'post_content'  => $studydetails4,
  'post_status'   => 'pending',
  'post_author'   => $user_id,
  'post_category' => array($category_id4)
);
$post_id4 = wp_insert_post( $my_post4 );

update_post_meta($post_id4, 'email_adress', $contactemail4);
update_post_meta($post_id4, 'phone_number', $contactphone4);
update_post_meta($post_id4, 'exposure_level', $boost_type4);



  }

    if($total_studies5)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>5th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype5."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation5."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails5."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname5."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail5."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone5."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type5."</td>

  </tr>";

  $category_id5 = get_cat_ID($studytype5);
  $final_titile5= $studytype5.' Study - Location: '.$studylocation5;

$my_post5 = array(
  'post_title'    => $final_titile5,
  'post_content'  => $studydetails5,
  'post_status'   => 'pending',
  'post_author'   => $user_id,
  'post_category' => array($category_id5)
);
$post_id5 = wp_insert_post( $my_post5 );

update_post_meta($post_id5, 'email_adress', $contactemail5);
update_post_meta($post_id5, 'phone_number', $contactphone5);
update_post_meta($post_id5, 'exposure_level', $boost_type5);


  }


   if($total_studies6)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>6th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype6."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation6."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails6."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname6."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail6."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone6."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type6."</td>

  </tr>";


  $category_id6 = get_cat_ID($studytype6);
  $final_titile6= $studytype6.' Study - Location: '.$studylocation6;

$my_post6 = array(
  'post_title'    => $final_titile6,
  'post_content'  => $studydetails6,
  'post_status'   => 'pending',
  'post_author'   => $user_id,
  'post_category' => array($category_id6)
);
$post_id6 = wp_insert_post( $my_post6 );

update_post_meta($post_id6, 'email_adress', $contactemail6);
update_post_meta($post_id6, 'phone_number', $contactphone6);
update_post_meta($post_id6, 'exposure_level', $boost_type6);


  }

   if($total_studies7)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>7th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype7."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation7."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails7."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname7."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail7."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone7."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type7."</td>

  </tr>";


  $category_id7 = get_cat_ID($studytype7);
  $final_titile7= $studytype7.' Study - Location: '.$studylocation7;

$my_post7 = array(
  'post_title'    => $final_titile7,
  'post_content'  => $studydetails7,
  'post_status'   => 'pending',
  'post_author'   => $user_id,
  'post_category' => array($category_id7)
);
$post_id7 = wp_insert_post( $my_post7 );

update_post_meta($post_id7, 'email_adress', $contactemail7);
update_post_meta($post_id7, 'phone_number', $contactphone7);
update_post_meta($post_id7, 'exposure_level', $boost_type7);


  }


   if($total_studies8)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>8th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype8."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation8."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails8."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname8."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail8."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone8."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type8."</td>

  </tr>";


  $category_id8 = get_cat_ID($studytype8);
  $final_titile8= $studytype8.' Study - Location: '.$studylocation8;

$my_post8 = array(
  'post_title'    => $final_titile8,
  'post_content'  => $studydetails8,
  'post_status'   => 'pending',
  'post_author'   => $user_id,
  'post_category' => array($category_id8)
);
$post_id8 = wp_insert_post( $my_post8 );

update_post_meta($post_id8, 'email_adress', $contactemail8);
update_post_meta($post_id8, 'phone_number', $contactphone8);
 update_post_meta($post_id8, 'exposure_level', $boost_type8);


  }

   if($total_studies9)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>9th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype9."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation9."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails9."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname9."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail9."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone9."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type9."</td>

  </tr>";

   $category_id9 = get_cat_ID($studytype9);
  $final_titile9= $studytype9.' Study - Location: '.$studylocation9;

$my_post9 = array(
  'post_title'    => $final_titile9,
  'post_content'  => $studydetails9,
  'post_status'   => 'pending',
  'post_author'   => $user_id,
  'post_category' => array($category_id9)
);
$post_id9 = wp_insert_post( $my_post9 );

update_post_meta($post_id9, 'email_adress', $contactemail9);
update_post_meta($post_id9, 'phone_number', $contactphone9);
 update_post_meta($post_id9, 'exposure_level', $boost_type9);


  }

   if($total_studies10)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>10th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype10."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation10."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails10."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname10."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail10."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone10."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type10."</td>

  </tr>";

   $category_id10 = get_cat_ID($studytype10);
  $final_titile10= $studytype10.' Study - Location: '.$studylocation10;

$my_post10 = array(
  'post_title'    => $final_titile10,
  'post_content'  => $studydetails10,
  'post_status'   => 'pending',
  'post_author'   => $user_id,
  'post_category' => array($category_id10)
);
$post_id10 = wp_insert_post( $my_post10 );

update_post_meta($post_id10, 'email_adress', $contactemail10);
update_post_meta($post_id10, 'phone_number', $contactphone10);
update_post_meta($post_id10, 'exposure_level', $boost_type10);

  }

   if($total_studies11)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>11th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype11."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation11."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails11."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname11."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail11."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone11."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type11."</td>

  </tr>";



  }

   if($total_studies12)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>12th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype12."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation12."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails12."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname12."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail12."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone12."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type12."</td>

  </tr>";



  }

   if($total_studies13)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>13th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype13."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation13."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails13."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname13."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail13."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone13."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type13."</td>

  </tr>";



  }

   if($total_studies14)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>14th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype14."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation14."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails14."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname14."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail14."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone14."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type14."</td>

  </tr>";



  }

   if($total_studies15)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>15th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype15."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation15."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails15."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname15."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail15."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone15."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type15."</td>

  </tr>";



  }


   if($total_studies16)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>16th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype16."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation16."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails16."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname16."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail16."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone16."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type16."</td>

  </tr>";



  }

     if($total_studies17)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>17th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype17."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation17."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails17."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname17."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail17."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone15."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type17."</td>

  </tr>";



  }

     if($total_studies18)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>18th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype18."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation18."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails18."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname18."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail18."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone18."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type18."</td>

  </tr>";



  }

     if($total_studies19)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>19th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype19."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation19."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails19."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname19."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail19."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone19."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type19."</td>

  </tr>";



  }

     if($total_studies20)

  {

$message .= "<tr>

    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>20th Study</strong></td>

  </tr>

  <tr>

    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studytype20."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studylocation20."</td>

  </tr>

  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$studydetails20."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactname20."</td>

  </tr>



  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactemail20."</td>

  </tr>

   <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$contactphone20."</td>

  </tr>
  <tr style='color:#000; font-size:12px;'>

    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>

    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$boost_type20."</td>

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



global $wpdb;

//$headers[] = 'To: <'.$author_email.'>';

$headers[] = 'From: '.$contactname.' <'.$contactemail.'>';

$headers[] = "MIME-Version: 1.0\r\n";

$headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";





$f_attchment1 =$_FILES["attachment1"]["tmp_name"];

$s_attchment2 =$_FILES["attachment2"]["tmp_name"];

$t_attchment3 =$_FILES["attachment3"]["tmp_name"];

$fo_attchment4 =$_FILES["attachment4"]["tmp_name"];

$fi_attchment5 =$_FILES["attachment5"]["tmp_name"];

$fi_attchment6 =$_FILES["attachment6"]["tmp_name"];

$fi_attchment7 =$_FILES["attachment7"]["tmp_name"];

$fi_attchment8 =$_FILES["attachment8"]["tmp_name"];

$fi_attchment9 =$_FILES["attachment9"]["tmp_name"];

$fi_attchment10 =$_FILES["attachment10"]["tmp_name"];

$fi_attchment11 =$_FILES["attachment11"]["tmp_name"];

$fi_attchment12 =$_FILES["attachment12"]["tmp_name"];

$fi_attchment13 =$_FILES["attachment13"]["tmp_name"];

$fi_attchment14 =$_FILES["attachment14"]["tmp_name"];

$fi_attchment15 =$_FILES["attachment15"]["tmp_name"];

$fi_attchment16 =$_FILES["attachment16"]["tmp_name"];

$fi_attchment17 =$_FILES["attachment17"]["tmp_name"];

$fi_attchment18 =$_FILES["attachment18"]["tmp_name"];

$fi_attchment19 =$_FILES["attachment19"]["tmp_name"];

$fi_attchment12 =$_FILES["attachment20"]["tmp_name"];

if($f_attchment1)

{

move_uploaded_file($_FILES["attachment1"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment1']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment1"]["name"];
$attachments111 = site_url()."/wp-content/uploads/".$_FILES["attachment1"]["name"];

 $wp_filetype = wp_check_filetype(basename($attachments111), null );
  $attachment = array(
     'post_mime_type' => $wp_filetype['type'],
     'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
     'post_content' => '',
     'post_status' => 'inherit'
  );

 $attach_id = wp_insert_attachment( $attachment, $attachments111, $post_id );

  set_post_thumbnail( $post_id, $attach_id );

}

if($s_attchment2)

{

move_uploaded_file($_FILES["attachment2"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment2']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment2"]["name"];

}

if($t_attchment3)

{

move_uploaded_file($_FILES["attachment3"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment3']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment3"]["name"];

}

if($fo_attchment4)

{

move_uploaded_file($_FILES["attachment4"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment4']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment4"]["name"];

}

if($fi_attchment5)

{

move_uploaded_file($_FILES["attachment5"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment5']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment5"]["name"];

}

if($fi_attchment6)

{

move_uploaded_file($_FILES["attachment6"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment6']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment6"]["name"];

}

if($fi_attchment7)

{

move_uploaded_file($_FILES["attachment7"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment7']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment7"]["name"];

}

if($fi_attchment8)

{

move_uploaded_file($_FILES["attachment8"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment8']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment8"]["name"];

}

if($fi_attchment9)

{

move_uploaded_file($_FILES["attachment9"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment9']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment9"]["name"];

}

if($fi_attchment10)

{

move_uploaded_file($_FILES["attachment10"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment10']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment10"]["name"];

}

if($fi_attchment11)

{

move_uploaded_file($_FILES["attachment11"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment11']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment11"]["name"];

}

if($fi_attchment12)

{

move_uploaded_file($_FILES["attachment12"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment12']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment12"]["name"];

}

if($fi_attchment13)

{

move_uploaded_file($_FILES["attachment13"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment13']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment13"]["name"];

}

if($fi_attchment14)

{

move_uploaded_file($_FILES["attachment14"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment14']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment14"]["name"];

}

if($fi_attchment15)

{

move_uploaded_file($_FILES["attachment15"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment15']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment15"]["name"];

}

if($fi_attchment16)

{

move_uploaded_file($_FILES["attachment16"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment16']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment16"]["name"];

}

if($fi_attchment17)

{

move_uploaded_file($_FILES["attachment17"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment17']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment17"]["name"];

}

if($fi_attchment18)

{

move_uploaded_file($_FILES["attachment18"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment18']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment18"]["name"];

}

if($fi_attchment19)

{

move_uploaded_file($_FILES["attachment19"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment19']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment19"]["name"];

}

if($fi_attchment20)

{

move_uploaded_file($_FILES["attachment20"]["tmp_name"],WP_CONTENT_DIR .'/uploads/'.basename($_FILES['attachment20']['name']));

$attachments[] = WP_CONTENT_DIR ."/uploads/".$_FILES["attachment20"]["name"];

}
$headers[] = 'From: '.$contactname.' <'.$contactemail.'>';
$headers[] = 'Reply-To: '.$contactname.' <'.$contactemail.'>';

$SendEmail=wp_mail("info@studykik.com",$subject, $message,$headers,$attachments);

if($SendEmail){

//echo '<h3 style="color: rgb(0, 128, 0); float: left; margin-top: 51px; text-align: center; width: 100%;">Thank You, Your Studies Have Been Sent Successfully and Will Be Live in 24 Hours!</h3>';
?>
        <script type="text/javascript">

//alert("Thank You, Your Studies Have Been Sent Successfully and Will Be Live in 24 Hours!");

setTimeout(function () {

  window.location = "<?php echo site_url();?>/thank-listing/";}, 100);

  </script>
        <?php }else{echo '<h3 style="color: red; float: left; margin-top: 51px; text-align: center; width: 100%;">ERROR: TRY AGAIN</h3>'; }

}else{?>
        <script type="application/javascript">
	alert('Password not matched!');
	</script>
        <?php } }?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
      </div>

      <!-- .entry-content -->

      </article>

      <!-- #post -->

      <?php endwhile; ?>
    </div>
  </div>

  <!-- #content -->

</div>

<!-- #primary -->

<?php get_footer(); ?>
