<?php 
	
		  $pstt_id = $_POST['post_id'];
		   $results_call  = $wpdb->get_results("SELECT * FROM 0gf1ba_subscriber_list WHERE id = ' $pstt_id' ORDER BY id DESC", OBJECT);
		   
		   //echo "<pre>";
		   //print_r($results_call);
?>
 
                                           <?php
					   foreach ($results_call as $ki =>$rst){
						$results=$rst;      
					   }
					   $redirect_num=$results->redirect_number;
					   if ($redirect_num != '' && $results->is_front == 1) {
						      
						      
						      ?>
                                       
                                            <div class="col-xs-12  notes_right">
                                                <div class="row">
                                                    <h2 style="text-decoration: underline">Call Connect</h2>
                                                </div>
                                                        <?php if ($results->no_of_question == 0 && $results->broadcast_id !="" ) { ?>
                                                    <div style="padding:20px;padding-left:20px;font-size:20px;font-weight:bold;height:90px;">

							<?php
							    echo '<h5>';
							    if ($results->ivr_time != "") {
								echo '<div style="font-size: 20px; float: left; width: 32%;"><span style="font-weight:bold;">Date:</span> <span style="color:#00afef;font-weight: bold;">'.date("m-d-Y", strtotime($results->ivr_time)).'</span></div>';
								echo '<div style="font-size: 20px; float: left; width: 32%;"><span style="font-weight:bold;">Time:</span> <span style="color:#00afef;font-weight: bold;">'.date("h:i:s A", strtotime($results->ivr_time)).'</span></div>';
                                                            }
                                                            else {
                                                                echo '<div style="font-size: 20px; float: left; width: 32%;"><span style="font-weight:bold;">Date:</span> <span style="color:#00afef;font-weight: bold;">Not Connected</span></div>';
								echo '<div style="font-size: 20px; float: left; width: 32%;"><span style="font-weight:bold;">Time:</span> <span style="color:#00afef;font-weight: bold;">Not Connected</span></div>';
                                                            }
                                                            ?>
                                                           <?php if ($results->call_duration != 0) {
                                                                echo '<div style="font-size: 20px; float: left; width: 36%;"><span style="font-weight:bold;">Call Duration:</span> <span style="color:#00afef;font-weight: bold;">'.gmdate("i:s", $results->call_duration).'</span></div>';
                                                            }
                                                            else {
                                                                echo '<div style="font-size: 20px; float: left; width: 36%;"><span style="font-weight:bold;">Call Duration:</span> <span style="color:#00afef;font-weight: bold;">Not Connected</span></div>';
                                                            }
							    echo "</h5>";
							?>

						    </div>
                                                        <?php
                                                        } else {
                                                            $num_qust = $results->no_of_question;
                                                            ?>
                                                    <div style="font-size: 12px;margin-top: 0px;margin-bottom: 5px;">
                                                        <div class="scrollNotes" style="margin-top: -10px;margin-bottom:5px;">
                                                            <?php
                                                            if ($results->is_callfire_qualified == 1) {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Qualified</span> for this Study.</h3>';
                                                            } else {
                                                                echo '<h3>Patient is <span style="color:#00afef;font-weight: bold;">Not Qualified</span> for this Study.</h3>';
                                                            }
                                                            ?>
							    <?php if ($results->ivr_time != "") {
                                                                echo '<h5><span style="font-weight:bold;">Date:</span> <span style="color:#00afef;font-weight: bold;">'.date("m-d-Y", strtotime($results->ivr_time)).'</span></h5>';
								echo '<h5><span style="font-weight:bold;">Time:</span> <span style="color:#00afef;font-weight: bold;">'.date("h:i:s", strtotime($results->ivr_time)).'</span></h5>';
                                                            }
                                                            else {
                                                                echo '<h5><span style="font-weight:bold;">Date:</span> <span style="color:#00afef;font-weight: bold;">Not Available</span></h5>';
								echo '<h5><span style="font-weight:bold;">Time:</span> <span style="color:#00afef;font-weight: bold;">Not Available</span></h5>';
                                                            }
                                                            ?>
                                                           <?php if ($results->call_duration != 0) {
                                                                echo '<h5><span style="font-weight:bold;">Call Duration:</span> <span style="color:#00afef;font-weight: bold;">'.gmdate("i:s", $results->call_duration).'</span></h5>';
                                                            }
                                                            else {
                                                                echo '<h5><span style="font-weight:bold;">Call Duration:</span> <span style="color:#00afef;font-weight: bold;">Not Available</span></h5>';
                                                            }
                                                            ?>
							</div>
                                                <div style="height: 350px; overflow-y: auto;margin-top:20px;">
                                                <?php for ($k = 1; $k <= $num_qust; $k++) { ?>
                                                    <?php if ($k == 1) {
                                                        ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_1; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_1 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_1 == 2) {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                 } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 2) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_2; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_2 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_2 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 3) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_3; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_3 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_3 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 4) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_4; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_4 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_4 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 5) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_5; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_5 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_5 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 6) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_6; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_6 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_6 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 7) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_7; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_7 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_7 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                    <?php }
                                            ?>
                                                    <?php if ($k == 8) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_8; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_8 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_8 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 9) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_9; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_9 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_9 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 10) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_10; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_10 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_10 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                               <?php }
                                            ?>
                                                <?php if ($k == 11) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_11; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_11 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_11 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 12) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_12; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_12 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_12 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 13) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_13; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_13 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_13 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 14) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_14; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_14 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_14 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 15) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_15; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_15 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results->answer_15 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                              } else {
                                                 echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 16) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_16; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_16 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_16 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 17) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_17; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_17 == 1) {
                                             echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                             } else if ($results->answer_17 == 2) {
                                             echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                               <?php }
                                             ?>
                                                <?php if ($k == 18) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_18; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_18 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_18 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                               <?php }
                                              ?>
                                               <?php if ($k == 19) {
                                                      ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_19; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_19 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_19 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                             } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 20) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_20; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_20 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_20 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                             } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                              <?php }
                                            ?>
                                                <?php if ($k == 21) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_21; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_21 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_21 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                           } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 22) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_22; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_22 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_22 == 2) {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                            echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                              } ?></div>
                                                    <?php }
                                                ?>
                                                    <?php if ($k == 23) {
                                                        ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_23; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_23 == 1) {
                                            echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                           } else if ($results->answer_23 == 2) {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                          } else {
                                           echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                           } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 24) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_24; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_24 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_24 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php if ($k == 25) {
                                                    ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_25; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_25 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_25 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 26) {
                                                ?>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_26; ?></div>
                                            <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_26 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_26 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 27) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_27; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_27 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_27 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 28) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_28; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_28 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_28 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 29) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_29; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_29 == 1) {
                                                    echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                                } else if ($results->answer_29 == 2) {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                                } else {
                                                    echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                                } ?></div>
                                                <?php }
                                            ?>
                                            <?php if ($k == 30) {
                                                ?>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:5px;"><?php echo '<span style="font-size:13px;font-weight:bold;">Question ' . $k . ' :</span> ' . $results->question_30; ?></div>
                                                <div class="scrollNotes" style="font-size: 12px;margin-bottom:10px;"><?php if ($results->answer_30 == 1) {
                                                echo '<span style="font-size:13px;font-weight:bold;"><span style="font-size:13px;font-weight:bold;">Answer :</span></span> Yes';
                                            } else if ($results->answer_30 == 2) {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> No';
                                            } else {
                                                echo '<span style="font-size:13px;font-weight:bold;">Answer :</span> Not Available Now';
                                            } ?></div>
                                                <?php }
                                            ?>
                                                <?php } ?>
                                                        </div>
                                                        <?php } ?>
                                                </div>
                                               <a class="closepop" id="closepopdata" href="javascript:void(0);" onclick="document.getElementById('callpop_data').style.display = 'none';
                                                        document.getElementById('fade').style.display = 'none';">Close</a>
                                            </div>

                                       
                                              <?php }?>

                                      
