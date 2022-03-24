<?php
  $post_id=$_POST['post_id'];
    $site=get_post_meta($post_id, 'name_of_site', true);
    $sitephone=get_post_meta($post_id, 'phone_number', true);
    $siteaddress=get_post_meta($post_id, 'study_full_address', true);
    $siteemail1=get_post_meta($post_id, 'email_adress', true);
    $siteemail2=get_post_meta($post_id, 'email_adress_2', true);
    $siteemail3=get_post_meta($post_id, 'email_adress_3', true);
    $siteemail4=get_post_meta($post_id, 'email_adress_4', true);
     $siteemail5=get_post_meta($post_id, 'email_adress_5', true);
      $siteemail6=get_post_meta($post_id, 'email_adress_6', true);
       $siteemail7=get_post_meta($post_id, 'email_adress_7', true);
       $siteemail8=get_post_meta($post_id, 'email_adress_8', true);
       $siteemail9=get_post_meta($post_id, 'email_adress_9', true);
       $siteemail10=get_post_meta($post_id, 'email_adress_10', true);
       $i=0;
       ?>
 <form method="post" action="" id="edt_form">
            <input type="hidden" name="add_p_id" value="<?php echo $post_id;?>">
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Site NAME :</h4>
            <input type="hidden" name="action" required="" value="dashboard_update_site" style="width: 96%;">
            <input type="text" name="site" required="" value="<?php echo $site;?>" style="width: 96%;">
              <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Site Phone Number:</h4>
            <input type="text" name="sitephone" required="" value="<?php echo $sitephone;?>" style="width: 96%;">
              <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Site Address:</h4>
            <input type="text" name="siteaddress" required="" value="<?php echo $siteaddress;?>" style="width: 96%;">
            <?php if (strpos(strtolower($siteemail1),'@studykik.com') == false) {$i++;?>
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Recruitment Email #<?php echo $i;?>:</h4>
            <input type="email" name="siteemail1" required="" value="<?php echo $siteemail1;?>" style="width: 96%;">
            <?php }?>
                    <?php if (strpos(strtolower($siteemail2),'@studykik.com') == false) {$i++;?>
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Recruitment Email #<?php echo $i;?>:</h4>
            <input type="email" name="siteemail2" required="" value="<?php echo $siteemail2;?>" style="width: 96%;">
            <?php }?>
                    <?php if (strpos(strtolower($siteemail3),'@studykik.com') == false) {$i++;?>
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Recruitment Email #<?php echo $i;?>:</h4>
            <input type="email" name="siteemail3" required="" value="<?php echo $siteemail3;?>" style="width: 96%;">
            <?php }?>
                    <?php if (strpos(strtolower($siteemail4),'@studykik.com') == false) {$i++;?>
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Recruitment Email #<?php echo $i;?>:</h4>
            <input type="email" name="siteemail4" required="" value="<?php echo $siteemail4;?>" style="width: 96%;">
            <?php }?>
                    <?php if (strpos(strtolower($siteemail5),'@studykik.com') == false) {$i++;?>
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Recruitment Email #<?php echo $i;?>:</h4>
            <input type="email" name="siteemail5" required="" value="<?php echo $siteemail5;?>" style="width: 96%;">
            <?php }?>
                    <?php if (strpos(strtolower($siteemail6),'@studykik.com') == false) {$i++;?>
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Recruitment Email #<?php echo $i;?>:</h4>
            <input type="email" name="siteemail6" required="" value="<?php echo $siteemail6;?>" style="width: 96%;">
            <?php }?>
                      <?php if (strpos(strtolower($siteemail7),'@studykik.com') == false) {$i++;?>
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Recruitment Email #<?php echo $i;?>:</h4>
            <input type="email" name="siteemail7" required="" value="<?php echo $siteemail7;?>" style="width: 96%;">
            <?php }?>
                      <?php if (strpos(strtolower($siteemail8),'@studykik.com') == false) {$i++;?>
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Recruitment Email #<?php echo $i;?>:</h4>
            <input type="email" name="siteemail8" required="" value="<?php echo $siteemail8;?>" style="width: 96%;">
            <?php }?>
                      <?php if (strpos(strtolower($siteemail9),'@studykik.com') == false) {$i++;?>
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Recruitment Email #<?php echo $i;?>:</h4>
            <input type="email" name="siteemail9" required="" value="<?php echo $siteemail9;?>" style="width: 96%;">
            <?php }?>
                      <?php if (strpos(strtolower($siteemail10),'@studykik.com') == false) {$i++;?>
            <h4 style="color: rgb(25, 193, 254); text-transform: uppercase;">Recruitment Email #<?php echo $i;?>:</h4>
            <input type="email" name="siteemail10" required="" value="<?php echo $siteemail10;?>" style="width: 96%;">
            <?php }?>
            <br>
          <input type="button" name="edit_site" value="Update Site" class="add_btn" style="float: left; margin: 10px 0px;" id="edit_site">
        </form>
