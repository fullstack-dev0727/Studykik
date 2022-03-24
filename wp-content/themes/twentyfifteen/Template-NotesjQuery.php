<?php
/*
Template Name: Jquery Notes
*/
?>

<?php

/*------------- To add New Note --------------*/	
if($_REQUEST['notes_text'] && isset($_REQUEST['action']) && $_REQUEST['action'] == 'new_note')
{

	$add_p_id = rawurldecode($_REQUEST['add_p_id']);
	$add_notes = rawurldecode($_REQUEST['notes_text']);
	//$date_123 =rawurldecode($_REQUEST['datetime']);
	$date_123 = date('Y-m-d H:i:s',strtotime('-5 hours'));
	$date_modify = date('Y-m-d H:i:s',strtotime('-5 hours'));
	//$query = $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_client_notes`(`id`, `note_id`, `notes`, `notes_date`) VALUES (NULL,'$add_p_id','$add_notes','$date_123')"));



$query = $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_client_notes`(`id`, `note_id`, `notes`, `notes_date`) VALUES (NULL,'$add_p_id',%s,'$date_123')", $add_notes));
 $query_notes = $wpdb->get_results( "SELECT * FROM `0gf1ba_client_notes` WHERE `notes` = '$add_notes' AND `note_id` ='$add_p_id' ");
 $wpdb->query($wpdb->prepare("UPDATE 0gf1ba_subscriber_list SET last_modify=%s WHERE id=%d", $date_modify, $add_p_id));


/* if($query_notes[1]){ 
  $note_Id = $query_notes[1]->id;
    $query = $wpdb->query($wpdb->prepare("DELETE FROM `0gf1ba_client_notes` WHERE `id`='$note_Id'"));
} */
          

?>

<div class="row">
  <h2>UPDATES</h2>
</div>
<div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area">
<?php 
		$query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$add_p_id' ORDER BY id DESC", OBJECT );
				if($query_notes){
					foreach($query_notes as $results_notes){ ?>
						<dl class="clinical_trial" id="parent<?php echo $results_notes->id;?>">
                        <a href="javascript:void(0);" id="<?php echo $results_notes->id;?>"  title="Delete Note" style="float:right; margin:0 10px;" class="removeNote">
                        <img src="<?php bloginfo('template_url');?>/images-dashboard/delete.png" /></a>

                        <dt style=" color:#00afef;">
                            <?php
                            $date_here = str_replace("?", "", $results_notes->notes_date);
                            $date = new DateTime($date_here, new DateTimeZone('EST'));

                            if (get_current_user_id() == 1358) {
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


<?php					}
				}
?>


</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	//Remove the notes functionalit from the popup
jQuery( ".removeNote" ).click(function() { 
  
  var noteId = $(this).attr('id');
  var noteParentId = 'parent'+$(this).attr('id');
  var note_id = $(this).attr('noteid');
  console.log("To remove Note !");
  parent =  $("#"+noteParentId);
      jQuery.ajax({
              type: "GET",
              url: "<?php bloginfo('url');?>/jquery-notes/",
              data: "notes_id=" + noteId +"&action=remove_note"+"&note_id="+note_id,
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
</script>
<?php exit(0); }  ?>

<?php
/*-- To remove the Notes  --*/
 if($_REQUEST['notes_id'] && isset($_REQUEST['action']) && $_REQUEST['action'] == "remove_note"){
	$noteId = $_REQUEST['notes_id'];
	$subs_id="";
	$query_not = $wpdb->get_results( "SELECT * FROM `0gf1ba_client_notes` WHERE `id` = '$noteId'");
	if(!empty($query_not)){
		foreach($query_not as $res ) {
			$subs_id=$res->note_id;
		}
	}
	 $query = $wpdb->query($wpdb->prepare("DELETE FROM `0gf1ba_client_notes` WHERE `id`='$noteId'"));
	  $date_modify = date('Y-m-d H:i:s',strtotime('-4 hours'));
	$dt_modify = date('m-d-Y',strtotime('-4 hours'));
	$wpdb->query($wpdb->prepare("UPDATE 0gf1ba_subscriber_list SET last_modify='$date_modify' WHERE id=$subs_id"));
	 echo $dt_modify."@@@@".$subs_id;
	
	exit(0); 
} ?>

<?php
/*-- To remove the Notes  --*/
 if(isset($_REQUEST['remove_schedule'])){
	if($_REQUEST['remove_schedule'] !=""){
		$subs_id = $_REQUEST['remove_schedule'];
		$date_modify = date('Y-m-d H:i:s',strtotime('-4 hours'));
		echo "UPDATE 0gf1ba_subscriber_list SET last_modify='$date_modify' and schedule_time=NULL WHERE id=$subs_id";
		$wpdb->query($wpdb->prepare("UPDATE 0gf1ba_subscriber_list SET last_modify='$date_modify',schedule_time=NULL WHERE id=$subs_id"));
		//echo "done";
		exit(0);
	}
} ?>


<?php
/*-- To remove the Notes  --*/
 if($_REQUEST['notes_refresh1']){
	 $noteId = $_REQUEST['notes_refresh1'];
     $query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$noteId' ORDER BY id DESC LIMIT 1", OBJECT );
	 foreach($query_notes as $results_notes);
	 if($results_notes->notes){
	 echo $results_notes->notes;
	 }else
	 {
		 echo "Add Notes";
	 }
	 
	 
	exit(0); 
} ?>