<?php
$user_id = get_current_user_id();
$pstt_id = $_POST['post_id'];
$pid = $_POST['pid'];
$time_zone = get_post_meta($pid, 'callfire_time_zone', true);
$query  = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE id = '$pstt_id' ORDER BY id DESC", OBJECT);
$query_notes=$wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id= '$pstt_id'", OBJECT);

if ($query) {

  foreach ($query as $ki =>$rst){
    $results=$rst;
  }

  $item = explode(" ", $results->date);
  $item2 = explode(" ", $results->last_modify);
  if ($item[0] != "") {
    $sign_dt = date("m-d-Y", strtotime($item[0]));
  } else {
    $sign_dt = $item[0];
  }

  if ($item2[0] != "") {
    $act_dt = date("m-d-Y", strtotime($item2[0]));
  } else {
    $act_dt = $item2[0];
  }

  $redirect_num=$results->redirect_number;
  ?>

  <div class="col-xs-12 col-md-6 notes_left">
    <div class="row">
      <h2>NOTES</h2>
    </div>
    <a title="Edit Patient Information" class="updateopo" style="float: right; margin-right: -17px; margin-top: 10px;" href="javascript:void(0);" onclick="document.getElementById('note_data').style.display = 'block'"><img style="height:20px;width:20px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/notes_icon.png"  /></a>
    <div class="scrollNotes" id="pename_<?php echo $results->id;?>"><?php echo 'Name: ' . $results->name; ?></div>
    <div class="scrollNotes" id="peemail_<?php echo $results->id;?>"><?php echo 'Email: ' . $results->email; ?></div>
    <div class="scrollNotes" id="pephone_<?php echo $results->id;?>"><?php echo 'Phone: ' . format_telephone($results->phone); ?></div>
    <div class="scrollNotes"><?php echo 'Signed Up: ' . $sign_dt; ?></div>
    <div class="scrollNotes" id="peactaken_<?php echo $results->id;?>"><?php echo 'Action Taken: ' . $act_dt; ?></div>

    <?php
    if($time_zone !=""){
      ?>
      <div class="scrollNotes" id="peschedule_<?php echo $results->id;?>">
        <?php
        if($results->schedule_time !=""){
          $tm=date("m-d-Y, h:i A", strtotime($results->schedule_time));
        }
        else{
          $tm="";
        }

        if($tm != ""){
            echo '<span id="editspns_'.$results->id.'">Schedule Date:</span><a title="Edit Scheduled Date" id="linkid_'.$results->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results->id.'">'.$tm.'</a>'  ;
        }else{
            echo '<a title="Schedule Patient" id="linkid_'.$results->id.'" href="javascript://void(0);" class="link_schd" unq_lnk="'.$results->id.'"><span id="editspns_'.$results->id.'">Schedule Date</span></a>'  ;
        }

        if($results->schedule_time !=""){ ?>
          <a title="Delete Schedule" class="removeschedule" style="margin-left:10px;margin-top:-2px;position:absolute;" id="rmv_sch<?php echo $results->id;?>" href="javascript:void(0);" unq_lnk="<?php echo $results->id;?>">
            <img src="<?php bloginfo('template_url'); ?>/images-dashboard/delete.png">
          </a>
        <?php } ?>
      </div>
    <?php } ?>
    <form action="" method="post">
      <input type="hidden" value="<?php echo $results->id; ?>" class="add_p_id" name="add_p_id" />
      <textarea placeholder="Write your notes in here ..." type="text" value="" class="notes_text" required name="add_notes"></textarea>
      <br />
      <button style="float: left; margin: 10px 0px;" class="add_button" type="button" value="Save Notes" name="add_notes_db"></button>
    </form>
  </div>

  <div class="col-xs-12 col-md-6 notes_right">
    <div class="row">
      <h2>UPDATES</h2>
    </div>
    <?php
    $aaa_ID = $results->id;
    if (count($query_notes) > 3) {
      ?>
      <div id="scrollNotes">Scroll down to view all notes</div>
    <?php } ?>
    <div data-offset="0" data-target="#myNavbar"  data-spy="scroll" class="scroll-area">
      <?php
      if ($query_notes) {
        foreach ($query_notes as $results_notes) {
          ?>
          <dl class="clinical_trial" id="parent<?php echo $results_notes->id; ?>">
            <a title="Delete Note" href="javascript:void(0);"  id="<?php echo $results_notes->id; ?>" noteid="<?php echo $results_notes->note_id; ?>"  style="float:right; margin:0 10px;" class="removeNote"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/delete.png" /></a>
            <dt style=" color:#00afef;">
                <?php
                $date_here = str_replace("?", "", $results_notes->notes_date);
                $date = new DateTime($date_here, new DateTimeZone('EST'));

                if ($user_id == 1358) {
                    $date->setTimezone(new DateTimeZone('America/Los_Angeles'));
                    echo $date->format('m-d-Y h:i:s A')." (PST)";
                } else {
                    $date->setTimezone(new DateTimeZone('America/New_York'));
                    echo $date->format('m-d-Y h:i:s A')." (EST)";
                }

                ?>
            </dt>
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
  <a class="closepop" id="<?php echo $results->id; ?>" href="javascript:void(0);" onclick="document.getElementById('note_data').style.display = 'none'; document.getElementById('fade').style.display = 'none';">Close</a>
<?php }

function format_telephone($phone_number) {
  $phone_number = preg_replace('/[^0-9]+/', '', $phone_number); //Strip all non number characters
  return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone_number); //Re Format it
}
?>
<script>
  jQuery(document).ready(function () {
    jQuery(".add_button").click(function () {
      jQuery(this).closest('form').addClass("selected_form");
      jQuery('.selected_form .notes_text').css('border-color', 'rgb(169, 169, 169)');
      //var notes_text = jQuery('.selected_form .notes_text').val();
      //var add_p_id = jQuery('.selected_form .add_p_id').val();
      var notes_text = jQuery(this).siblings('.notes_text').val();
      var add_p_id = jQuery(this).siblings('.add_p_id').val();
      var d = new Date();
      var dateTime = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate() + ', ' + d.toLocaleTimeString();
      if (notes_text.length > 0) {
        jQuery.ajax({
          type: "GET",
          url: "<?php bloginfo('url'); ?>/jquery-notes/",
          data: "notes_text=" + encodeURIComponent(notes_text) + "&action=new_note&add_p_id=" + add_p_id + "&datetime=" + dateTime,
          success: function (data) {
            //jQuery('#embed' + add_p_id + ' .notes_right').html(data);
            jQuery('#note_data .notes_right').html(data)
            jQuery(".notes_text").val('');
            $("#peactaken_"+add_p_id).html("Action Taken: <?php echo date('m-d-Y',strtotime('-4 hours'));?>");
            $("#actaken_"+add_p_id).html("Action Taken: <?php echo date('m-d-Y',strtotime('-4 hours'));?>");
          }
        });
      }
    });
    jQuery(".removeNote").click(function () {
      var noteId = $(this).attr('id');
      var noteParentId = 'parent' + $(this).attr('id');
      console.log("To remove Note !");
      parent = $("#" + noteParentId);
      jQuery.ajax({
        type: "GET",
        url: "<?php bloginfo('url'); ?>/jquery-notes/",
        data: "notes_id=" + noteId + "&action=remove_note",
        success: function (data) {
          var ch=data.split("@@@@");
          $("#peactaken_"+ch[1]).html("Action Taken: "+ch[0]);
          $("#actaken_"+ch[1]).html("Action Taken: "+ch[0]);
          $("#parent" + noteId).remove();
        }
      });
      return false;
    });
  });

  jQuery(".savepat").on('click',function(){
    var unid=jQuery(this).attr('unq_id');
    var form=jQuery('#savepts');
    //jQuery("#fade").show();
    var post_id='<?php echo $pid;?>';
    //alert('#patem'+post_id);
    var id=unid;
    var name=jQuery('#patnm'+unid).val();
    var email=jQuery('#patem'+unid).val();
    var phone=jQuery('#patph'+unid).val();
    jQuery('#email_'+unid).html(email);
    jQuery('#name_'+unid).html(name);
    jQuery('#phone_'+unid).html(phone);
    jQuery('#peemail_'+unid).html("Email: "+email);
    jQuery('#pename_'+unid).html("Name: "+name);
    jQuery('#pephone_'+unid).html("Phone: "+phone);
    jQuery.ajax({
      async: true,
      url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
      type:'POST',
      data: "action=dashboard_save_patient&post_id="+post_id+"&id="+id+"&name="+name+"&email="+email+"&phone="+phone,
      success: function(html){
        //jQuery("#nts_div").html(html);
        jQuery('#savepatient'+unid).hide();
        jQuery('#note_data').show();
        $("#peactaken_"+id).html("Action Taken: <?php echo date('m-d-Y',strtotime('-4 hours'));?>");
        $("#actaken_"+id).html("Action Taken: <?php echo date('m-d-Y',strtotime('-4 hours'));?>");
      }
    });
  });
</script>