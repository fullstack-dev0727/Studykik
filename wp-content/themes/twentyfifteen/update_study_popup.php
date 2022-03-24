 
    <?php 
	
	 
	$pstt_id = $_POST['post_id'];
	   
	$query  = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE id = '$pstt_id' ORDER BY id DESC", OBJECT);
	$query_notes=$wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id= '$pstt_id'", OBJECT);
	 // echo"<pre>";
	  //print_r($query);
	  //echo"</pre>";
	   
	?>
	        <?php
		 
                      //   New Patients  li Notes
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


                                              <form action="" method="post" id="savepts">
                                        <input type="hidden" value="<?php echo $pid; ?>" name="spatient_postid" />
                                        <input type="hidden" value="<?php echo $results->id;?>" name="spatient_id" id="patis<?php echo $results->id; ?>" />
                                        <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Name :</h4>
                                        <input  style="width: 100%;" type="text" value="<?php echo $results->name;?>" required name="spatient_name" id="patnm<?php echo $results->id; ?>" />
                                        <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Email :</h4>
                                        <input  style="width: 100%;" type="text" value="<?php echo $results->email; ?>" required name="spatient_email" id="patem<?php echo $results->id; ?>" />
                                        <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Patient Phone Number :</h4>
                                        <input style="width: 100%;" type="text" value="<?php echo format_telephone($results->phone); ?>" required name="spatient_phone" id="patph<?php echo $results->id; ?>" />
                                        <br />
                                        <input unq_id="<?php echo $results->id;?>" style="float: left; margin: 10px 0px;" class="add_btn savepat" id="spatient_db" type="button" value="Update" name="spatient_db" />
                                    </form>
                                    <a note_idd="<?php echo $pstt_id;?>" id="close_update_popup" class="closepop" href="javascript:void(0);" onclick="document.getElementById('update_sub_details').style.display = 'none';
                                            document.getElementById('note_data').style.display = 'block'">Close</a> 
											
											<?php 
											 
							}
							function format_telephone($phone_number) {
    $phone_number = preg_replace('/[^0-9]+/', '', $phone_number); //Strip all non number characters
    return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone_number); //Re Format it
}
?>