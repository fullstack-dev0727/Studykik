<?php session_start();
    if(isset($_POST['user_id'])){
        $nonotes=1;
        if(isset($_POST['post_id'])){
            $post_id = $_POST['post_id'];
            if($post_id > 0){  echo '<span style="display:none;">.</span>';
                $site_name=get_post_meta( $post_id, 'name_of_site', true );
                if(isset($_POST['stats'])){
                    $all_results=$wpdb->get_results("SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post_id'");
                }
                else{
                    $all_results=$wpdb->get_results("SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post_id' and row_num = '3'");
                }
                if($wpdb->num_rows){
                    $notes_ids=array();
                    $k=1;
                    foreach($all_results as $subs){
                        $notes_ids[$k]=$subs->id;
                        $k++;
                    }
                    if(!empty($notes_ids)){
                        $im_notes_ids=implode(",",$notes_ids);
                        $query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id IN (".$im_notes_ids.") order by note_id ASC, id DESC", OBJECT );
                        if($wpdb->num_rows){
                            $nonotes=0;
                            $pre_note_id=0;
                            if($_POST['user_id']=='123'){
                                if(isset($_SESSION['all_dnq_count'])){
                                    $cnt=$_SESSION['all_dnq_count'];
                                }
                                else{
                                    $cnt=1;
                                }
                            }
                            else{
                                if(isset($_SESSION['chanhe_all_dnq_count'])){
                                    $ch_cnt=$_SESSION['chanhe_all_dnq_count'];
                                }
                                else{
                                    $ch_cnt=1;
                                }
                            }
                            foreach($query_notes as $kn => $results_notes){
                                $nkn=$kn+1;
                                if(isset($query_notes[$nkn])){
                                    $nid=$query_notes[$nkn]->note_id;
                                }
                                else{
                                    $nid=0;
                                }
                                ?>
                                <?php if($pre_note_id != $results_notes->note_id){ ?>
                                <dl class="clinical_trial">
                                <?php } ?>
                                    <dt style=" color:#00afef;">
                                        <?php
                                        if($pre_note_id != $results_notes->note_id){ ?>
                                        <?php
                                        if($_POST['user_id']=='123'){
                                            echo 'Patient # '; echo $cnt;
                                        }
                                        else{
                                            echo 'Patient # '; echo $ch_cnt;
                                        }
                                        ?>
                                        (<?php echo $site_name; ?>)<br>
                                        <?php
                                        if($_POST['user_id']=='123'){
                                            $cnt=$cnt+1;
                                        }
                                        else{
                                            $ch_cnt=$ch_cnt+1;
                                        }
                                        } ?>
                                        <?php
                                        $pre_note_id=$results_notes->note_id;
                                        echo date('m-d-Y, h:i:s A',strtotime(str_replace("?","",$results_notes->notes_date))); ?> <br>
                                    </dt>
                                    <dd>
                                        <p><?php echo $results_notes->notes; ?></p>
                                    </dd>
                                <?php
                                if($nid != $results_notes->note_id){ ?>
                                </dl>
                                <?php } ?>
                            <?php
                            }
                            if($_POST['user_id']=='123'){
                                $_SESSION['all_dnq_count']=$cnt;
                            }
                            else{
                                $_SESSION['chanhe_all_dnq_count']=$ch_cnt;
                            }
                           ?>
                        <?php
                        }
                    }
                }
            }
        }
    }
    else{ ?>
        <style>
        dl{
            margin-bottom:2px !important;
        }
        </style>
        <?php 
        $nonotes=1;
        if(isset($_POST['post_id'])){
            $post_id = $_POST['post_id'];
            if($post_id > 0){
                $site_name=get_post_meta( $post_id, 'name_of_site', true );
                if(isset($_POST['stats'])){
                    $all_results=$wpdb->get_results("SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post_id'");
                }
                if(isset($_POST['nt_type'])){
                    $all_results=$wpdb->get_results("SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post_id' and row_num = '7'");
                }
                else{
                    $all_results=$wpdb->get_results("SELECT id FROM 0gf1ba_subscriber_list WHERE post_id = '$post_id' and row_num = '3'");
                }
                if($wpdb->num_rows){
                    $notes_ids=array();
                    $k=1;
                    foreach($all_results as $subs){
                        $notes_ids[$k]=$subs->id;
                        $k++;
                    }
                    if(!empty($notes_ids)){
                        $im_notes_ids=implode(",",$notes_ids);
                        $query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_client_notes WHERE note_id IN (".$im_notes_ids.") order by note_id ASC, id DESC", OBJECT );
                        if($wpdb->num_rows){
                            $nonotes=0;
                            $pre_note_id=0;
                            $cnt=1;
                            foreach($query_notes as $kn => $results_notes){
                                $nkn=$kn+1;
                                if(isset($query_notes[$nkn])){
                                    $nid=$query_notes[$nkn]->note_id;
                                }
                                else{
                                    $nid=0;
                                }
                                ?>
                                <?php if($pre_note_id != $results_notes->note_id){ ?>
                                <dl class="clinical_trial">
                                <?php } ?>
                                    <dt style=" color:#00afef;">
                                        <?php
                                        if($pre_note_id != $results_notes->note_id){ ?>
                                        <?php echo 'Patient # '; echo $cnt; ?>
                                        (<?php echo $site_name; ?>)<br>
                                        <?php
                                        $cnt=$cnt+1;
                                        } ?>
                                        <?php
                                        $pre_note_id=$results_notes->note_id;
                                        echo date('m-d-Y, h:i:s A',strtotime(str_replace("?","",$results_notes->notes_date))); ?> <br>
                                    </dt>
                                    <dd>
                                        <p><?php echo $results_notes->notes; ?></p>
                                    </dd>
                                <?php
                                if($nid != $results_notes->note_id){ ?>
                                </dl>
                                <?php } ?>
                            <?php
                           } 
                        }
                    }
                }
            }
        }
        if($nonotes == 1){ ?>
                <dl class="clinical_trial">
                        <dt style=" color:#00afef; margin-top:10px;">No Notes Yet!</dt>
                </dl>
        <?php }
    }
?>