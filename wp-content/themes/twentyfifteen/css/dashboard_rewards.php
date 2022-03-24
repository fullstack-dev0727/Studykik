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
                $all_results=$wpdb->get_results("SELECT * FROM 0gf1ba_rewards_details WHERE user_id = '$post_id'");
//            echo "<pre>";
//            print_r($all_results);
                //echo $post_id.'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
            if($wpdb->num_rows){
                $notes_ids=array();
                $k=1;
                foreach($all_results as $subs){
                    $notes_ids[$k]=$subs->id;
                    $k++;
                }
                if(!empty($notes_ids)){
                   // $im_notes_ids=implode(",",$notes_ids);
                    $query_notes = $wpdb->get_results( "SELECT * FROM 0gf1ba_rewards_details WHERE user_id = '$post_id '  order by id DESC", OBJECT );
                    if($wpdb->num_rows){
                        $nonotes=0;
                        $pre_note_id=0;
                        foreach($query_notes as $kn => $results_notes){
                            $nkn=$kn+1;
                            if(isset($query_notes[$nkn])){
                                $nid=$query_notes[$nkn]->id;
                            }
                            else{
                                $nid=0;
                            }
                            ?>
                            <?php if($pre_note_id != $results_notes->id){ ?>
                            <dl class="clinical_trial">
                            <?php } ?>
                                <dt style=" color:#00afef;">
                                    <?php
                                    if($pre_note_id != $results_notes->id){ ?>
                                    <?php //$key = array_search ($results_notes->id, $notes); echo 'Rewards # '; echo $key;?>
                                    <?php echo $results_notes->activity_of_points; ?>
                                    <?php } ?>
                                    <?php
                                    $pre_note_id=$results_notes->id;
                                    ?>
                                    <p style="font-size:14px;"><?php echo date('m-d-Y, h:i:s A',strtotime(str_replace("?","",$results_notes->rewards_date_time))); ?></p>
                                </dt>
                                 <dt>
                                    <div>
                                        <div style="color:#f78e1e">
                                            <?php if($results_notes->balance!=0){?><?php echo $results_notes->balance; ?><?php }else{echo 0;}?>
                                             <?php if($results_notes->credit!=0){?>
                                            <span style="text-align:right;color:#00CC00;margin-right:50%;float:right;">+<?php echo $results_notes->credit; ?> </span>
                                              <?php }else{}?>
                                              <?php if($results_notes->debit!=0){?>
                                            <span style="text-align:right;color:#CC3300;margin-right:50%;float:right;">-<?php echo $results_notes->debit; ?> </span>
                                              <?php }else{}?>


                                        </div>

                                    </div>
                                </dt>
                            <?php
                            if($nid != $results_notes->id){ ?>
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
                    <dt style=" color:#00afef; margin-top:10px;">No Records Available Yet!</dt>
            </dl>
    <?php }
?>