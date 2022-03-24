<?php
if ( is_user_logged_in() ) {
   $user_ID = get_current_user_ID(); 
} else {
   wp_redirect( 'http://studykik.com/login/', 301 ); exit;
}
?>
<?php
/*
* Template Name: Patients Details
*/
?>
<?php get_header('dashboard');?>
<script type="application/javascript">
jQuery(document).ready(function( $ ) {
jQuery(".clear_all").hide();
jQuery(".loading_imag").hide();
jQuery( ".search_for_patient" ).keypress(function() {
var dInput = jQuery('.search_for_patient').val();
var pidsds = jQuery('#pidsds').val();
jQuery(".clear_all").show();
jQuery(".loading_imag").show();
jQuery('.dhe-example-section-content').hide();

   jQuery.ajax({
        type: "GET",
        url: "<?php bloginfo('url');?>/search-patients/",
        data: "search123=" + dInput + "&pidsds="+pidsds,
        success: function (data) {
    jQuery(".loading_imag").hide();
        jQuery('.dhe-example-section-content').html(data);
    jQuery('.dhe-example-section-content').show();
       
        }
    });

});
jQuery( ".clear_all" ).click(function() {
 window.location.href = window.location.href;
});

});
</script>

<script>
jQuery(document).ready(function() {
jQuery( ".add_button" ).click(function() {
  jQuery(this).closest('form').addClass("selected_form");
  var notes_text = jQuery('.selected_form .notes_text').val();
  var add_p_id = jQuery('.selected_form .add_p_id').val();
   jQuery.ajax({
        type: "GET",
        url: "<?php bloginfo('url');?>/jquery-notes/",
        data: "notes_text=" + notes_text + "&add_p_id="+add_p_id,
        success: function (data) { 
         jQuery('#embed'+ add_p_id + ' .notes_right').html(data);
     jQuery(".notes_text").val('');
    //jQuery('.dhe-example-section-content').show();
       
        }
    });
  
}); 
});

</script>

<script type="application/javascript">
jQuery( document ).ready(function() {
var aaa= jQuery( ".dhe-example-section-content" ).outerHeight();
jQuery('.sortable-list').css({ 'min-height': aaa }); 
jQuery(window).scroll(function() {    
    var scroll = jQuery(window).scrollTop();

    if (scroll >= 420) {
        jQuery(".aaaaaaaaaaa").addClass("navbar-fixed-top");
    $( "body" ).addClass( "scroll_added" );
    } else {
        jQuery(".aaaaaaaaaaa").removeClass("navbar-fixed-top");
    $( "body" ).removeClass( "scroll_added" )
    }
});

jQuery(window).on('resize', function(){
      var win = jQuery(this);
      if (win.width() < 600) {jQuery(".aaaaaaaaaaa").addClass("navbar-fixed-top");}

});
});
</script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/dragdrop/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/dragdrop/devheart-examples.css" media="screen" />
<div id="banner_login">
<div class="container">
  <div class="row">
    <div class="dashboard_banner">
      <header id="top">
      <h1><a href="index.html">Kitchy Food</a><img src="<?php bloginfo('template_url');?>/images-dashboard/logout_logo.png" alt=""></h1>
      <nav class="navbar navbar-default">
        <div class="container-fluid"> 
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li ><a style="margin-top:12px;" href="http://studykik.com/dashboard/">Home</a></li>
              <li><a href="http://studykik.com/refer-listing/">REFER <br>
                A LISTING</a></li>
              <li  style="border:none;"><a   class="midsection" href="http://studykik.com/clinical-study-information-dashboard/">LIST A <br>
                NEW STUDY</a></li>
              <li><a style="margin: 12px 0 0 66px;font-size:0px;" href="">.</a></li>
              <li><a style="margin-top: 12px" href="/rewards/">REWARDS</a></li>
              <li><a href="http://studykik.com/your-profile/?idp=Profile">MY ACCCOUNT <br>
                INFORMATION</a></li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
          <div class="project_manager">
            <h5>Stud<small>y</small><cite>KIK</cite> Project Manager: <span><?php echo get_user_meta($user_ID, 'project_manager', true); ?></span> - <span><?php echo get_user_meta($user_ID, 'phone_number', true); ?></span></h5>
          </div>
        </div>
        <!-- /.container-fluid --> 
      </nav>
    </div>
  </div>
  <?php
    $pid = $_REQUEST['pid'];
     global $wpdb;
      ?>
  <div class="row">
    <section class="container_current">
    <div class="col-xs-4 search_right_patient">
      <div class="form-search form-inline">
        <input type="text" placeholder="Search For a Patient" class="search_for_patient" id="search_btn">
        <a href="javascript:void();" class="clear_all">Clear Search</a>
        <input type="hidden" value="<?php echo $pid;?>" id="pidsds" />
      </div>
    </div>
    <div class="col-xs-12">
      <div class="clinical_trial">
        <h2><a class="back_button" href="/dashboard/"><<-- Return to Current Studies</a>
          <?php
$post_pid = get_post($pid); 
echo $post_pid->post_title;
?>
          <a class="add_button" href="javascript:void();" onclick="document.getElementById('embed').style.display='block';document.getElementById('fade').style.display='block'">Add Patient</a></h2>
      </div>
    </div>
    <div id="center-wrapper">
      <h1 id="updated" style="display: block; font-size: 20px; text-align: center; margin: 0px; padding: 0px; color: rgb(159, 207, 103);"></h1>
      <div class="dhe-example-section" id="ex-2-3">
        <div class="loading_imag" style="text-align:center;"><img src="<?php bloginfo('template_url');?>/images-dashboard/ajax-loader.gif" /></div>
    <?php
		$query = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and row_num = '1' ORDER BY order_id ASC", OBJECT );
		$r1 = $wpdb->num_rows;
		$query2 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and row_num = '2' ORDER BY order_id ASC", OBJECT );
		$r2 = $wpdb->num_rows;
		$query3 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and row_num = '3' ORDER BY order_id ASC", OBJECT );
		$r3 =  $wpdb->num_rows;
		$query4 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and row_num = '4' ORDER BY order_id ASC", OBJECT );
		$r4 = $wpdb->num_rows;
		$query5 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and row_num = '5' ORDER BY order_id ASC", OBJECT );
		$r5 = $wpdb->num_rows;
		$query6 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and row_num = '6' ORDER BY order_id ASC", OBJECT );
		$r6 = $wpdb->num_rows;
		$query7 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' and row_num = '7' ORDER BY order_id ASC", OBJECT );
		$r7 = $wpdb->num_rows;

		?>
        <div class="dhe-example-section-content"> 
        <table class="table table-bordered aaaaaaaaaaa">
            <thead>
              <tr bgcolor="#959ca1">
                <th><button class="contact" type="button">
                  <p><span id="newPatients"><?php echo $r1; ?></span> New Patients</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p><span id="callAttempted"><?php echo $r2; ?></span> Call Attempted</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th class="pad_class"><button class="contact" type="button">
                  <p><span id="notQualified"><?php echo $r3; ?></span>  Not Qualified /<br  />
                    Not Interested</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                  <th><button class="contact" type="button">
                  <p><span id="scheduled"><?php echo $r4; ?></span> Action Needed</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p><span id="scheduled"><?php echo $r4; ?></span> Scheduled</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p><span id="consented"><?php echo $r5; ?></span> Consented</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p><span id="randomized"><?php echo $r6; ?></span> Randomized</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
              </tr>
            </thead>
          </table>
          <!-- BEGIN: XHTML for example 2.3 -->
          <?php
      
      ?>
          <div id="example-2-3">
            <div class="column left first">
              <table class="table table-bordered">
                <thead>
                  <tr bgcolor="#959ca1">
                    <th><button class="contact" type="button">
                      <p>New Patients</p>
                      </button>
                      <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                  </tr>
                </thead>
              </table>
              <ul spanid="newPatients" class="sortable-list">
                <?php
    
    if($query){
      
    foreach($query as $results)
    { 
      $aaa_ID = $results->id;
      $query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID' ORDER BY id DESC", OBJECT );
      
      $item = explode(" ", $results->date);
      $item2 = explode(" ", $results->last_modify);
      echo '<li class="sortable-item" id="'.$results->id.'">';
      echo '<strong>'.$results->name; echo '</strong><br />';
      echo '<span>'.$results->email; echo '</span><br />';
      echo '<span>'.$results->phone; echo '</span><br />';
      echo '<span>Signed Up: '.$item[0];  echo '</span><br />';
      echo '<span>Action Taken: '.$item2[0]; echo '</span><br />';
    
      ?>
                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a> <a title="<?php echo isset($query_notes[0]->notes) ? $query_notes[0]->notes : 'Add notes'; ?>" onclick="document.getElementById('embed<?php echo $results->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                <!-- </li> -->
                <div id="embed<?php echo $results->id;?>" class="white_content" style="display: none;">
                  <div class="col-xs-12 col-md-6 notes_left">
                    <div class="row">
                      <h2>NOTES</h2>
                    </div>
                    <form action="" method="post">
                      <input type="hidden" value="<?php echo $results->id;?>" class="add_p_id" name="add_p_id" />
                      <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                      <br />
                      <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                    </form>
                  </div>
                  <div class="col-xs-12 col-md-6 notes_right">
                    <div class="row">
                      <h2>UPDATES</h2>
                    </div>
                    <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                      <?php
           $aaa_ID = $results->id;
           $query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID' ORDER BY id DESC", OBJECT );
    if($query_notes){
    foreach($query_notes as $results_notes)
    {?>
                      <dl class="clinical_trial">
                        <dt style=" color:#00afef;"><?php echo $results_notes->notes_date; ?> </dt>
                        <dd>
                          <p><?php echo $results_notes->notes; ?></p>
                        </dd>
                      </dl>
                      <?php
      
    }
    
    }
    ?>
                    </div>
                  </div>
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
                  
                   </div>
                   </li>
                <?php
      
    }
      
      }
    ?>
              </ul>
            </div>
            <div class="column left">
              <table class="table table-bordered">
                <thead>
                  <tr bgcolor="#959ca1">
                    <th><button class="contact" type="button">
                      <p>Call Attempted</p>
                      </button>
                      <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                  </tr>
                </thead>
              </table>
              <ul spanid="callAttempted" class="sortable-list">
                <?php
    if($query2){
      
    foreach($query2 as $results2)
    {
      $aaa_ID2 = $results2->id;
      $query_notes2 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID2' ORDER BY id DESC", OBJECT );
     
      $item2 = explode(" ", $results2->date);
      $item22 = explode(" ", $results2->last_modify);
      echo '<li class="sortable-item" id="'.$results2->id.'">';
      echo '<strong>'.$results2->name; echo '</strong><br />';
      echo '<span>'.$results2->email; echo '</span><br />';
      echo '<span>'.$results2->phone; echo '</span><br />';
      echo '<span>Signed Up: '.$item2[0];  echo '</span><br />';
      echo '<span>Action Taken: '.$item22[0]; echo '</span><br />';
      ?>
                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results2->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a> <a  title="<?php echo isset($query_notes2[0]->notes) ? $query_notes2[0]->notes : 'Add notes'; ?>" onclick="document.getElementById('embed<?php echo $results2->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                <!-- </li> -->
                <div id="embed<?php echo $results2->id;?>" class="white_content" style="display: none;">
                  <div class="col-xs-12 col-md-6 notes_left">
                    <div class="row">
                      <h2>NOTES</h2>
                    </div>
                    <form action="" method="post">
                      <input type="hidden" value="<?php echo $results2->id;?>" class="add_p_id" name="add_p_id" />
                      <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                      <br />
                      <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                    </form>
                  </div>
                  <div class="col-xs-12 col-md-6 notes_right">
                    <div class="row">
                      <h2>UPDATES</h2>
                    </div>
                    <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                      <?php
           $aaa_ID2 = $results2->id;
           $query_notes2 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID2' ORDER BY id DESC", OBJECT );
    if($query_notes2){
    foreach($query_notes2 as $results_notes2)
    {?>
                      <dl class="clinical_trial">
                        <dt style=" color:#00afef;"><?php echo $results_notes2->notes_date; ?> </dt>
                        <dd>
                          <p><?php echo $results_notes2->notes; ?></p>
                        </dd>
                      </dl>
                      <?php
      
    }
    
    }
    ?>
                    </div>
                  </div>
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results2->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
                  
                   </div>
                   </li>
                <?php
    }
      
      }
    ?>
              </ul>
            </div>
            <div class="column left">
              <table class="table table-bordered">
                <thead>
                  <tr bgcolor="#959ca1">
                    <th><button class="contact" type="button">
                      <p>Not Qualified/<br  />
                        Not Interested</p>
                      </button>
                      <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                  </tr>
                </thead>
              </table>
              <ul spanid="notQualified" class="sortable-list">
                <?php
    if($query3){
      
    foreach($query3 as $results3)
    {


      $aaa_ID3 = $results3->id;
      $query_notes3 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID3' ORDER BY id DESC", OBJECT );

      $item3 = explode(" ", $results3->date);
      $item23 = explode(" ", $results3->last_modify);
      echo '<li class="sortable-item" id="'.$results3->id.'">';
      echo '<strong>'.$results3->name; echo '</strong><br />';
      echo '<span>'.$results3->email; echo '</span><br />';
      echo '<span>'.$results3->phone; echo '</span><br />';
      echo '<span>Signed Up: '.$item3[0];  echo '</span><br />';
      echo '<span>Action Taken: '.$item23[0]; echo '</span><br />';
      ?>
                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results3->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a> <a  title="<?php echo isset($query_notes3[0]->notes) ? $query_notes3[0]->notes : 'Add notes'; ?>" onclick="document.getElementById('embed<?php echo $results3->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                <!-- </li> -->
                <div id="embed<?php echo $results3->id;?>" class="white_content" style="display: none;">
                  <div class="col-xs-12 col-md-6 notes_left">
                    <div class="row">
                      <h2>NOTES</h2>
                    </div>
                    <form action="" method="post">
                      <input type="hidden" value="<?php echo $results3->id;?>" class="add_p_id" name="add_p_id" />
                      <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                      <br />
                      <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                    </form>
                  </div>
                  <div class="col-xs-12 col-md-6 notes_right">
                    <div class="row">
                      <h2>UPDATES</h2>
                    </div>
                    <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                      <?php
           $aaa_ID3 = $results3->id;
           $query_notes3 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID3' ORDER BY id DESC", OBJECT );
    if($query_notes3){
    foreach($query_notes3 as $results_notes3)
    {?>
                      <dl class="clinical_trial">
                        <dt style=" color:#00afef;"><?php echo $results_notes3->notes_date; ?> </dt>
                        <dd>
                          <p><?php echo $results_notes3->notes; ?></p>
                        </dd>
                      </dl>
                      <?php
      
    }
    
    }
    ?>
                    </div>
                  </div>
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results3->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
                  
                   </div>
                   </li>
                <?php
    }
      
      }
    ?>
              </ul>
            </div>
            
            <div class="column left">
              <table class="table table-bordered">
                <thead>
                  <tr bgcolor="#959ca1">
                    <th><button class="contact" type="button">
                      <p> Action Needed</p>
                      </button>
                      <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                  </tr>
                </thead>
              </table>
              <ul spanid="notQualified" class="sortable-list">
                <?php
    if($query7){
      
    foreach($query7 as $results7)
    {


      $aaa_ID7 = $results7->id;
      $query_notes7 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID7' ORDER BY id DESC", OBJECT );

      $item7 = explode(" ", $results7->date);
      $item27 = explode(" ", $results7->last_modify);
      echo '<li class="sortable-item" id="'.$results7->id.'">';
      echo '<strong>'.$results7->name; echo '</strong><br />';
      echo '<span>'.$results7->email; echo '</span><br />';
      echo '<span>'.$results7->phone; echo '</span><br />';
      echo '<span>Signed Up: '.$item7[0];  echo '</span><br />';
      echo '<span>Action Taken: '.$item27[0]; echo '</span><br />';
      ?>
                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results7->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a> <a  title="<?php echo isset($query_notes7[0]->notes) ? $query_notes7[0]->notes : 'Add notes'; ?>" onclick="document.getElementById('embed<?php echo $results7->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                <!-- </li> -->
                <div id="embed<?php echo $results7->id;?>" class="white_content" style="display: none;">
                  <div class="col-xs-12 col-md-6 notes_left">
                    <div class="row">
                      <h2>NOTES</h2>
                    </div>
                    <form action="" method="post">
                      <input type="hidden" value="<?php echo $results7->id;?>" class="add_p_id" name="add_p_id" />
                      <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                      <br />
                      <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                    </form>
                  </div>
                  <div class="col-xs-12 col-md-6 notes_right">
                    <div class="row">
                      <h2>UPDATES</h2>
                    </div>
                    <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                      <?php
           $aaa_ID7 = $results7->id;
           $query_notes7 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID7' ORDER BY id DESC", OBJECT );
    if($query_notes7){
    foreach($query_notes7 as $results_notes7)
    {?>
                      <dl class="clinical_trial">
                        <dt style=" color:#00afef;"><?php echo $results_notes7->notes_date; ?> </dt>
                        <dd>
                          <p><?php echo $results_notes7->notes; ?></p>
                        </dd>
                      </dl>
                      <?php
      
    }
    
    }
    ?>
                    </div>
                  </div>
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results7->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
                  
                   </div>
                   </li>
                <?php
    }
      
      }
    ?>
              </ul>
            </div>
            <div class="column left">
              <table class="table table-bordered">
                <thead>
                
                  <th><button class="contact" type="button">
                    <p>Scheduled</p>
                    </button>
                    <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                </tr>
                  </thead>
                
              </table>
              <ul spanid="scheduled" class="sortable-list">
                <?php
    if($query4){
      
    foreach($query4 as $results4)
    {  
      $aaa_ID4 = $results4->id;
      $query_notes4 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID4' ORDER BY id DESC", OBJECT );

      $item4 = explode(" ", $results4->date);
      $item24 = explode(" ", $results4->last_modify);
      echo '<li class="sortable-item" id="'.$results4->id.'">';
      echo '<strong>'.$results4->name; echo '</strong><br />';
      echo '<span>'.$results4->email; echo '</span><br />';
      echo '<span>'.$results4->phone; echo '</span><br />';
      echo '<span>Signed Up: '.$item4[0];  echo '</span><br />';
      echo '<span>Action Taken: '.$item24[0]; echo '</span><br />';
      ?>
                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results4->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a> <a  title="<?php echo isset($query_notes4[0]->notes) ? $query_notes4[0]->notes : 'Add notes'; ?>" onclick="document.getElementById('embed<?php echo $results4->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                <!-- </li> -->
                <div id="embed<?php echo $results4->id;?>" class="white_content" style="display: none;">
                  <div class="col-xs-12 col-md-6 notes_left">
                    <div class="row">
                      <h2>NOTES</h2>
                    </div>
                    <form action="" method="post">
                      <input type="hidden" value="<?php echo $results4->id;?>" class="add_p_id" name="add_p_id" />
                      <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                      <br />
                      <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                    </form>
                  </div>
                  <div class="col-xs-12 col-md-6 notes_right">
                    <div class="row">
                      <h2>UPDATES</h2>
                    </div>
                    <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                      <?php
           $aaa_ID4 = $results4->id;
           $query_notes4 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID4' ORDER BY id DESC", OBJECT );
    if($query_notes4){
    foreach($query_notes4 as $results_notes4)
    {?>
                      <dl class="clinical_trial">
                        <dt style=" color:#00afef;"><?php echo $results_notes4->notes_date; ?> </dt>
                        <dd>
                          <p><?php echo $results_notes4->notes; ?></p>
                        </dd>
                      </dl>
                      <?php
      
    }
    
    }
    ?>
                    </div>
                  </div>
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results4->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
                  
                   </div>
                   <li>
                <?php
    }
      
      }
    ?>
              </ul>
            </div>
            <div class="column left">
              <table class="table table-bordered">
                <thead>
                  <tr bgcolor="#959ca1">
                    <th><button class="contact" type="button">
                      <p>Consented</p>
                      </button>
                      <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                  </tr>
                </thead>
              </table>
              <ul spanid="consented" class="sortable-list">
                <?php
     
    if($query5){
      
    foreach($query5 as $results5)
    { 

      $aaa_ID5 = $results5->id;
      $query_notes5 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID5' ORDER BY id DESC", OBJECT );
      
      $item5 = explode(" ", $results5->date);
      $item25 = explode(" ", $results5->last_modify);
      echo '<li class="sortable-item" id="'.$results5->id.'">';
      echo '<strong>'.$results5->name; echo '</strong><br />';
      echo '<span>'.$results5->email; echo '</span><br />';
      echo '<span>'.$results5->phone; echo '</span><br />';
      echo '<span>Signed Up: '.$item5[0];  echo '</span><br />';
      echo '<span>Action Taken: '.$item25[0]; echo '</span><br />';
      ?>
                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results5->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a> <a  title="<?php echo isset($query_notes5[0]->notes) ? $query_notes5[0]->notes : 'Add notes'; ?>" onclick="document.getElementById('embed<?php echo $results5->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                <!-- </li> -->
                <div id="embed<?php echo $results5->id;?>" class="white_content" style="display: none;">
                  <div class="col-xs-12 col-md-6 notes_left">
                    <div class="row">
                      <h2>NOTES</h2>
                    </div>
                    <form action="" method="post">
                      <input type="hidden" value="<?php echo $results5->id;?>" class="add_p_id" name="add_p_id" />
                      <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                      <br />
                      <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                    </form>
                  </div>
                  <div class="col-xs-12 col-md-6 notes_right">
                    <div class="row">
                      <h2>UPDATES</h2>
                    </div>
                    <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                      <?php
           $aaa_ID5 = $results5->id;
           $query_notes5 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID5' ORDER BY id DESC", OBJECT );
    if($query_notes5){
    foreach($query_notes5 as $results_notes5)
    {?>
                      <dl class="clinical_trial">
                        <dt style=" color:#00afef;"><?php echo $results_notes5->notes_date; ?> </dt>
                        <dd>
                          <p><?php echo $results_notes5->notes; ?></p>
                        </dd>
                      </dl>
                      <?php
      
    }
    
    }
    ?>
                    </div>
                  </div>
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results5->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
                  
                   </div>
                   </li>
                <?php
    }
      
      }
    ?>
              </ul>
            </div>
            <div class="column left">
              <table class="table table-bordered">
                <thead>
                
                  <th><button class="contact" type="button">
                    <p>Randomized</p>
                    </button>
                    <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                </tr>
                  </thead>
                
              </table>
              <ul spanid="randomized" class="sortable-list">
                <?php
    if($query6){

          

    foreach($query6 as $results6)
    {  

      $aaa_ID6 = $results6->id;
      $query_notes6 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID6' ORDER BY id DESC", OBJECT );
            
      $item6 = explode(" ", $results6->date);
      $item26 = explode(" ", $results6->last_modify);
      echo '<li class="sortable-item" id="'.$results6->id.'">';
      echo '<strong>'.$results6->name; echo '</strong><br />';
      echo '<span>'.$results6->email; echo '</span><br />';
      echo '<span>'.$results6->phone; echo '</span><br />';
      echo '<span>Signed Up: '.$item6[0];  echo '</span><br />';
      echo '<span>Action Taken: '.$item26[0]; echo '</span><br />';
      ?>
                <a href="http://studykik.com/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results6->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a> <a  title="<?php echo isset($query_notes6[0]->notes) ? $query_notes6[0]->notes : 'Add notes'; ?>" onclick="document.getElementById('embed<?php echo $results6->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                <!-- </li> -->
                <div id="embed<?php echo $results6->id;?>" class="white_content" style="display: none;">
                  <div class="col-xs-12 col-md-6 notes_left">
                    <div class="row">
                      <h2>NOTES</h2>
                    </div>
                    <form action="" method="post">
                      <input type="hidden" value="<?php echo $results6->id;?>" class="add_p_id" name="add_p_id" />
                      <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
                      <br />
                      <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db" />
                    </form>
                  </div>
                  <div class="col-xs-12 col-md-6 notes_right">
                    <div class="row">
                      <h2>UPDATES</h2>
                    </div>
                    <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
  <?php
           $aaa_ID6 = $results6->id;
           $query_notes6 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID6' ORDER BY id DESC", OBJECT );
    if($query_notes6){
    foreach($query_notes6 as $results_notes6)
    {?>
                      <dl class="clinical_trial">
                        <dt style=" color:#00afef;"><?php echo $results_notes6->notes_date; ?> </dt>
                        <dd>
                          <p><?php echo $results_notes6->notes; ?></p>
                        </dd>
                      </dl>
                      <?php
      
    }
    
    }
    ?>
                    </div>
                  </div>
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results6->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
                  
                   </div>
                   </li>
                <?php
    }
      
      }
    ?>
              </ul>
            </div>
          </div>
          <div class="clearer">&nbsp;</div>
          
          <!-- END: XHTML for example 2.3 --> 
          
        </div>
      </div>
      
      <!-- Example JavaScript files --> 
      <script type="text/javascript" src="<?php bloginfo('template_url');?>/dragdrop/jquery-1.4.2.min.js"></script> 
      <script type="text/javascript" src="<?php bloginfo('template_url');?>/dragdrop/jquery-ui-1.8.custom.min.js"></script> 
      <script type="text/javascript" src="<?php bloginfo('template_url');?>/dragdrop/jquery.cookie.js"></script> 
      
      <!-- Example jQuery code (JavaScript)  --> 
      <script type="text/javascript">

$(document).ready(function(){
  
  var aaa= jQuery( ".dhe-example-section-content" ).outerHeight();
 jQuery('.sortable-list').css({ 'min-height': aaa }); 
 
  // Get items
  function getItems(exampleNr)
  { 

    var columns = [];

    $(exampleNr + ' ul.sortable-list').each(function(){ 
      columns.push($(this).sortable('toArray').filter(function(e){return e}).join(','));
    });

      console.log('columns: '+columns);
    return columns.join('|');
  }


  // Example 1.3: Sortable and connectable lists with visual helper
  /*$('#example-1-3 .sortable-list').sortable({
    connectWith: '#example-1-3 .sortable-list'
    , placeholder: 'placeholder',
  });*/


  // Example 2.3: Save items automaticly
  $('#example-2-3 .sortable-list').sortable({
    connectWith: '#example-2-3 .sortable-list',
    update: function(){
      //alert(getItems('#example-2-3'));
      
    jQuery.ajax({
        type: "GET",
        url: "<?php bloginfo('url');?>/find-listing-using-jquery/",
        data: "data_sending=" + getItems('#example-2-3') + "&pid="+<?php echo $pid; ?>,
        success: function (data) {
          //Update the Table Count
            updateTableCount();
    
       
        }
      });
          //Update the Table Count
          updateTableCount();
    }
  });
  

  $( ".navbar-toggle" ).click(function() {// alert('vbbvbv');
    $( "#bs-example-navbar-collapse-1" ).toggle( "slow", function() {
    // Animation complete.
    });
  });
});


function updateTableCount(){ 
  
  debugger;

  var ulArray = $("ul.sortable-list");
  for (var i = ulArray.length - 1; i >= 0; i--) {
      var ul = ulArray[i];
      var ulId = ul.getAttribute("spanid");
      
      //Removing the Empty li from ul
      for (var j = ul.children.length - 1; j >= 0; j--) {
          if(ul.children[j].innerHTML.trim() == ""){
              ul.children[j].remove();
          }
      }

      var length = ul.children.length;

      var span = document.getElementById(ulId);
      span.innerHTML = length;
  }
}

</script>
      </section>
    </div>
  </div>
  <div id="embed" class="white_content2" style="display: none;">
    <form action="" method="post">
      <input type="hidden" value="<?php echo $pid;?>" name="add_p_id" />
      <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Name :</h4>
      <input  style="width: 100%;" type="text" value="" required name="add_name" />
      <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Email :</h4>
      <input  style="width: 100%;" type="text" value="" required name="add_email" />
      <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Phone Number :</h4>
      <input style="width: 100%;" type="text" value="" required name="add_phone" />
      <br />
      <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Add Patient" name="add_patient_db" />
    </form>
    <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>
</div>
<div id="fade" class="black_overlay"></div>
<?php 

if($_REQUEST['add_patient_db'])
{
  $add_p_id = $_REQUEST['add_p_id'];
  $add_name = $_REQUEST['add_name'];
  $add_email = $_REQUEST['add_email'];
  $add_phone = $_REQUEST['add_phone'];
  
  if($add_p_id  != "" || $add_name  != "" || $add_email  != "" )
  {
  global $wpdb;

    $query = mysql_query("INSERT INTO `0gf1ba_subscriber_list`(`id`, `name`, `email`, `phone`, `post_id`, `date`, `row_num`, `order_id`) VALUES (NULL,'$add_name','$add_email','$add_phone','$add_p_id',NOW(),'1','0')");
  if( $query){?>
<script>
    window.location.href = window.location.href;
</script>
<?php } } } ?>

<?php 

if($_REQUEST['delete'])
{
  
  $delete = $_REQUEST['delete'];
  
  
  global $wpdb;
    $query_delete = $wpdb->query($wpdb->prepare("DELETE FROM 0gf1ba_subscriber_list WHERE id=$delete"));
  
  if( $query_delete){?>
<script>
   window.location.href = window.location.href;
   </script>
<?php } } ?>
<?php get_footer('dashboard');?>
