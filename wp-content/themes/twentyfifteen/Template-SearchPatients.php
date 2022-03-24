<?php

/*
Template Name: Jquery Search Patients
*/
?>
<?php
global $wpdb;
$search123 = $_REQUEST['search123'];
$pid = $_REQUEST['pidsds'];
if ( is_user_logged_in() ) {
    $user_ID = get_current_user_ID();
    $user_info = get_userdata($user_ID);
    if (!$user_info->has_cap( 'administrator' )){
        wp_redirect( 'http://studykik.com/login/', 301 ); exit;
    }
} else {
    wp_redirect( 'http://studykik.com/login/', 301 ); exit;
}
?>
<head>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<?php
if($search123 == "")
{ ?>
<table class="table table-bordered aaaaaaaaaaa">
            <thead>
              <tr bgcolor="#959ca1">
                <th><button class="contact" type="button">
                  <p>New Patients</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p>Call Attempted</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th class="pad_class"><button class="contact" type="button">
                  <p>Not Qualified /<br  />
                    Not Interested</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                  <th><button class="contact" type="button">
                  <p>Action Needed</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p>Scheduled</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p>Consented</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p>Randomized</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
              </tr>
            </thead>
          </table>
<div id="example-2-3">
            <div class="column left first">
             <table class="table table-bordered">
            <thead>
              <tr bgcolor="#959ca1">
                <th><button class="contact" type="button">
                  <p>New Patient</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
              </tr>
            </thead>
          </table>


              <ul class="sortable-list">
                <?php
		$query = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '1' ORDER BY order_id ASC", OBJECT );
		if($query){

		foreach($query as $results)
		{

			$item = explode(" ", $results->date);
			$item2 = explode(" ", $results->last_modify);
			echo '<li class="sortable-item" id="'.$results->id.'">';
			echo '<strong>'.$results->name; echo '</strong><br />';
			echo '<span>'.$results->email; echo '</span><br />';
			echo '<span>'.$results->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item2[0]; echo '</span><br />';

			?>
            <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>

                <a onclick="document.getElementById('embed<?php echo $results->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>

                <div id="embed<?php echo $results->id;?>" class="white_content" style="display: none;">
                <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID = $results->id;
				   $query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>


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
              <ul class="sortable-list">
                <?php
		$query2 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '2' ORDER BY order_id ASC", OBJECT );
		if($query2){

		foreach($query2 as $results2)
		{
			$item2 = explode(" ", $results2->date);
			$item22 = explode(" ", $results2->last_modify);
			echo '<li class="sortable-item" id="'.$results2->id.'">';
			echo '<strong>'.$results2->name; echo '</strong><br />';
			echo '<span>'.$results2->email; echo '</span><br />';
			echo '<span>'.$results2->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item2[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item22[0]; echo '</span><br />';
			?>
             <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results2->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>
                <a  title="<?php echo $results2->notes;?>" onclick="document.getElementById('embed<?php echo $results2->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>

                <div id="embed<?php echo $results2->id;?>" class="white_content" style="display: none;">
               <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results2->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID2 = $results2->id;
				   $query_notes2 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID2'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results2->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>
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
              <ul class="sortable-list">
                <?php
		$query3 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '3' ORDER BY order_id ASC", OBJECT );
		if($query3){

		foreach($query3 as $results3)
		{
			$item3 = explode(" ", $results3->date);
			$item23 = explode(" ", $results3->last_modify);
			echo '<li class="sortable-item" id="'.$results3->id.'">';
			echo '<strong>'.$results3->name; echo '</strong><br />';
			echo '<span>'.$results3->email; echo '</span><br />';
			echo '<span>'.$results3->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item3[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item23[0]; echo '</span><br />';
			?>
             <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results3->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>

                <a  title="<?php echo $results3->notes;?>" onclick="document.getElementById('embed<?php echo $results3->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>

                <div id="embed<?php echo $results3->id;?>" class="white_content" style="display: none;">
                   <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results3->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID3 = $results->id;
				   $query_notes3 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID3'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results3->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>
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
		$query7 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '7' ORDER BY order_id ASC", OBJECT );
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
                <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results7->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a> <a  title="<?php echo isset($query_notes7[0]->notes) ? $query_notes7[0]->notes : 'Add notes'; ?>" onclick="document.getElementById('embed<?php echo $results7->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
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
              <ul class="sortable-list">
                <?php
		$query4 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '4' ORDER BY order_id ASC", OBJECT );
		if($query4){

		foreach($query4 as $results4)
		{
			$item4 = explode(" ", $results4->date);
			$item24 = explode(" ", $results4->last_modify);
			echo '<li class="sortable-item" id="'.$results4->id.'">';
			echo '<strong>'.$results4->name; echo '</strong><br />';
			echo '<span>'.$results4->email; echo '</span><br />';
			echo '<span>'.$results4->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item4[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item24[0]; echo '</span><br />';
			?>
             <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results4->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>

                <a  title="<?php echo $results4->notes;?>" onclick="document.getElementById('embed<?php echo $results4->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>
                <div id="embed<?php echo $results4->id;?>" class="white_content" style="display: none;">
                  <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results4->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID4 = $results4->id;
				   $query_notes4 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID4'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results4->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>
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
              <ul class="sortable-list">
                <?php
		$query5 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '5' ORDER BY order_id ASC", OBJECT );

		if($query5){

		foreach($query5 as $results5)
		{
			$item5 = explode(" ", $results5->date);
			$item25 = explode(" ", $results5->last_modify);
			echo '<li class="sortable-item" id="'.$results5->id.'">';
			echo '<strong>'.$results5->name; echo '</strong><br />';
			echo '<span>'.$results5->email; echo '</span><br />';
			echo '<span>'.$results5->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item5[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item25[0]; echo '</span><br />';
			?>
             <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results5->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>

                <a  title="<?php echo $results5->notes;?>" onclick="document.getElementById('embed<?php echo $results5->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>
                <div id="embed<?php echo $results5->id;?>" class="white_content" style="display: none;">
                   <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results5->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID5 = $results5->id;
				   $query_notes5 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID5'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results5->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>
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
              <ul class="sortable-list">
                <?php
		$query6 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '6' ORDER BY order_id ASC", OBJECT );
		if($query6){

		foreach($query6 as $results6)
		{
			$item6 = explode(" ", $results6->date);
			$item26 = explode(" ", $results6->last_modify);
			echo '<li class="sortable-item" id="'.$results6->id.'">';
			echo '<strong>'.$results6->name; echo '</strong><br />';
			echo '<span>'.$results6->email; echo '</span><br />';
			echo '<span>'.$results6->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item6[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item26[0]; echo '</span><br />';
			?>

             <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results6->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>

                <a  title="<?php echo $results6->notes;?>" onclick="document.getElementById('embed<?php echo $results6->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>
                <div id="embed<?php echo $results6->id;?>" class="white_content" style="display: none;">
                  <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results6->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID6 = $results6->id;
				   $query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID6'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results6->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>
                <?php
		}

	    }
		?>
              </ul>
            </div>
          </div>
<div class="clearer">&nbsp;</div>
<?php }else{?>

<table class="table table-bordered aaaaaaaaaaa">
            <thead>
              <tr bgcolor="#959ca1">
                <th><button class="contact" type="button">
                  <p>New Patients</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p>Call Attempted</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th class="pad_class"><button class="contact" type="button">
                  <p>Not Qualified /<br  />
                    Not Interested</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                  <th><button class="contact" type="button">
                  <p>Action Needed</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p>Scheduled</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p>Consented</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
                <th><button class="contact" type="button">
                  <p>Randomized</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
              </tr>
            </thead>
          </table>

<div id="example-2-3">
            <div class="column left first">
             <table class="table table-bordered">
            <thead>
              <tr bgcolor="#959ca1">
                <th><button class="contact" type="button">
                  <p>New Patient</p>
                  </button>
                  <i class="fa fa-caret-right arrow"><img src="<?php bloginfo('template_url');?>/images-dashboard/arrow_img.png" /></i></th>
              </tr>
            </thead>
          </table>


              <ul class="sortable-list">
                <?php
		$query = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '1' and (email LIKE '%$search123%' OR name LIKE '%$search123%' OR phone LIKE '%$search123%') ORDER BY order_id ASC", OBJECT );
		if($query){

		foreach($query as $results)
		{

			$item = explode(" ", $results->date);
			$item2 = explode(" ", $results->last_modify);
			echo '<li class="sortable-item" id="'.$results->id.'">';
			echo '<strong>'.$results->name; echo '</strong><br />';
			echo '<span>'.$results->email; echo '</span><br />';
			echo '<span>'.$results->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item2[0]; echo '</span><br />';

			?>
            <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>

                <a onclick="document.getElementById('embed<?php echo $results->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>

                <div id="embed<?php echo $results->id;?>" class="white_content" style="display: none;">
                <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID = $results->id;
				   $query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>


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
              <ul class="sortable-list">
                <?php
		$query2 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '2' and (email LIKE '%$search123%' OR name LIKE '%$search123%' OR phone LIKE '%$search123%') ORDER BY order_id ASC", OBJECT );
		if($query2){

		foreach($query2 as $results2)
		{
			$item2 = explode(" ", $results2->date);
			$item22 = explode(" ", $results2->last_modify);
			echo '<li class="sortable-item" id="'.$results2->id.'">';
			echo '<strong>'.$results2->name; echo '</strong><br />';
			echo '<span>'.$results2->email; echo '</span><br />';
			echo '<span>'.$results2->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item2[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item22[0]; echo '</span><br />';
			?>
             <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results2->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>
                <a  title="<?php echo $results2->notes;?>" onclick="document.getElementById('embed<?php echo $results2->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>

                <div id="embed<?php echo $results2->id;?>" class="white_content" style="display: none;">
               <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results2->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID2 = $results2->id;
				   $query_notes2 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID2'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results2->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>
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
              <ul class="sortable-list">
                <?php
		$query3 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '3' and (email LIKE '%$search123%' OR name LIKE '%$search123%' OR phone LIKE '%$search123%') ORDER BY order_id ASC", OBJECT );
		if($query3){

		foreach($query3 as $results3)
		{
			$item3 = explode(" ", $results3->date);
			$item23 = explode(" ", $results3->last_modify);
			echo '<li class="sortable-item" id="'.$results3->id.'">';
			echo '<strong>'.$results3->name; echo '</strong><br />';
			echo '<span>'.$results3->email; echo '</span><br />';
			echo '<span>'.$results3->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item3[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item23[0]; echo '</span><br />';
			?>
             <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results3->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>

                <a  title="<?php echo $results3->notes;?>" onclick="document.getElementById('embed<?php echo $results3->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>

                <div id="embed<?php echo $results3->id;?>" class="white_content" style="display: none;">
                   <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results3->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID3 = $results->id;
				   $query_notes3 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID3'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results3->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>
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
		$query7 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '7' and (email LIKE '%$search123%' OR name LIKE '%$search123%' OR phone LIKE '%$search123%') ORDER BY order_id ASC", OBJECT );

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
                <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results7->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a> <a  title="<?php echo isset($query_notes7[0]->notes) ? $query_notes7[0]->notes : 'Add notes'; ?>" onclick="document.getElementById('embed<?php echo $results7->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
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
              <ul class="sortable-list">
                <?php
		$query4 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '4' and (email LIKE '%$search123%' OR name LIKE '%$search123%' OR phone LIKE '%$search123%') ORDER BY order_id ASC", OBJECT );
		if($query4){

		foreach($query4 as $results4)
		{
			$item4 = explode(" ", $results4->date);
			$item24 = explode(" ", $results4->last_modify);
			echo '<li class="sortable-item" id="'.$results4->id.'">';
			echo '<strong>'.$results4->name; echo '</strong><br />';
			echo '<span>'.$results4->email; echo '</span><br />';
			echo '<span>'.$results4->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item4[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item24[0]; echo '</span><br />';
			?>
             <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results4->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>

                <a  title="<?php echo $results4->notes;?>" onclick="document.getElementById('embed<?php echo $results4->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>
                <div id="embed<?php echo $results4->id;?>" class="white_content" style="display: none;">
                  <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results4->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID4 = $results4->id;
				   $query_notes4 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID4'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results4->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>
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
              <ul class="sortable-list">
                <?php
		$query5 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '5' and (email LIKE '%$search123%' OR name LIKE '%$search123%' OR phone LIKE '%$search123%') ORDER BY order_id ASC", OBJECT );

		if($query5){

		foreach($query5 as $results5)
		{
			$item5 = explode(" ", $results5->date);
			$item25 = explode(" ", $results5->last_modify);
			echo '<li class="sortable-item" id="'.$results5->id.'">';
			echo '<strong>'.$results5->name; echo '</strong><br />';
			echo '<span>'.$results5->email; echo '</span><br />';
			echo '<span>'.$results5->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item5[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item25[0]; echo '</span><br />';
			?>
             <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results5->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>

                <a  title="<?php echo $results5->notes;?>" onclick="document.getElementById('embed<?php echo $results5->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>
                <div id="embed<?php echo $results5->id;?>" class="white_content" style="display: none;">
                   <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results5->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID5 = $results5->id;
				   $query_notes5 = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID5'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results5->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>
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
              <ul class="sortable-list">
                <?php
		$query6 = $wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$pid' AND is_deleted != 1 and row_num = '6' and (email LIKE '%$search123%' OR name LIKE '%$search123%' OR phone LIKE '%$search123%') ORDER BY order_id ASC", OBJECT );
		if($query6){

		foreach($query6 as $results6)
		{
			$item6 = explode(" ", $results6->date);
			$item26 = explode(" ", $results6->last_modify);
			echo '<li class="sortable-item" id="'.$results6->id.'">';
			echo '<strong>'.$results6->name; echo '</strong><br />';
			echo '<span>'.$results6->email; echo '</span><br />';
			echo '<span>'.$results6->phone; echo '</span><br />';
			echo '<span>Signed Up: '.$item6[0];  echo '</span><br />';
			echo '<span>Action Taken: '.$item26[0]; echo '</span><br />';
			?>

             <a href="<?php echo site_url();?>/patients-details/?pid=<?php echo $pid;?>&delete=<?php echo $results6->id;?>" onclick="return confirm('Are you sure you would like to delete contact?')" style="float:right; margin:0 10px;" id="add_not"><img src="<?php bloginfo('template_url');?>/images-dashboard/close2.png" /></a>

                <a  title="<?php echo $results6->notes;?>" onclick="document.getElementById('embed<?php echo $results6->id;?>').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void();" style="float:right;" id="add_not"><img style="width: 22px;" src="<?php bloginfo('template_url');?>/images-dashboard/notes_icon.png" /></a>
                </li>
                <div id="embed<?php echo $results6->id;?>" class="white_content" style="display: none;">
                  <div class="col-xs-12 col-md-6 notes_left">
                <div class="row">
                 <h2>NOTES</h2></div>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $results6->id;?>" name="add_p_id" />
                    <textarea placeholder="Write your notes in here ..." type="text" value="" required name="add_notes"></textarea>
                    <br />
                    <input style="float: left; margin: 10px 0px;" class="add_button" type="submit" value="Save Notes" name="add_notes_db" />
                  </form>
                  </div>
                   <div class="col-xs-12 col-md-6 notes_right">
                   <div class="row">
                   <h2>UPDATES</h2>
                   </div>
                   <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
                   <?php
				   $aaa_ID6 = $results6->id;
				   $query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$aaa_ID6'", OBJECT );
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
                  <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed<?php echo $results6->id;?>').style.display='none';document.getElementById('fade').style.display='none'">Close</a> </div>
                <?php
		}

	    }
		?>
              </ul>
            </div>
          </div>

<?php }?>

<style>
.sortable-list{min-height:650px;}
</style>