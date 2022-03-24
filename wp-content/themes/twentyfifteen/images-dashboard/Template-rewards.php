<?php
session_start();
/*
 * Template Name: Rewards Temp
 */
?>
<?php
if (is_user_logged_in()) {
    $user_ID = get_current_user_id();
} else {
    wp_redirect(site_url().'/login/', 301);
    exit;
}
?>

<?php
if (is_user_logged_in()) {
    $user_ID = get_current_user_id();
    $user_info = get_userdata($user_ID);
    $user_roles = implode(', ', $user_info->roles);
    if ($user_roles == "manager_username") {?>
<?php get_header('responsive');?>
    <style>
        .white_content {
            background-color: white;
            border-radius: 10px;
            cursor: auto;
            display: none;
            left: 23% !important;
            overflow: auto;
            position: fixed !important;
            top: 25% !important;
            width: 55% !important;
            z-index: 99999 !important;
            border: 1px solid #f78e1e;
        }
        .black_overlay {
            background: #000000 none repeat scroll 0 0;
            display: none;
            height: 3400px;
            left: 0;
            opacity: 0.8;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 1001;
        }

        h2.heading {
            background: #f78e1e none repeat scroll 0 0;
            color: #fff;
            font-family: alternate;
            font-size: 44px;
            margin: 0;
            padding: 5px;
            text-align: center;
            text-decoration: none;
        }
        #embed  div {
            float: left;
            padding: 14px 20px 0;
            width: 100%;
        }
        #embed  div label {
            margin-left: 10px;
        }
        .closepop {
            background: rgba(0, 0, 0, 0) url("<?php bloginfo('template_url'); ?>/images-dashboard/close2.png") no-repeat scroll 0 0;

        }
        #embed input[type="submit"] {
            background: #00afef none repeat scroll 0 0;
            border: medium none;
            color: #fff;
            display: block;
            font-family: alternate;
            font-size: 33px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 26px;
        }
        .close_button2 {
            background: #00afef none repeat scroll 0 0;
            border: medium none;
            color: #fff;
            float: right;
            font-family: alternate;
            font-size: 33px;
            margin: 10px 34% 10px 0;
            padding: 0 26px;
        }

td:nth-child(1) {
background-color: orange;
}
table, th, td {
	color:white;
}
table {
	border-collapse:collapse;
	width:100%;
	font-family: "Helvetica Neue", Helvetica, sans-serif;
	font-size:14px;
}
td {
	height: 40px;
	padding: 10px 6px !important;
}
td:nth-child(1) {
background-color: #24ade3;
}
td:nth-child(2) {
background-color: #f5f5f5;
color:#959ca1;
width: 40%;
}
td:nth-child(3) {
background-color: #e8e8e8;
color:#959ca1;
}
.top_right {
    float: right;
    margin-top: 40px;
}
a {
    color: #428bca;
    text-decoration: none;
}
a:active ,a:hover {
 outline: 0 none;
}
.padtop, .navbar-nav.padtop {
    margin-top: 15px;
}
.project_manager {
    float: right;
    margin-top: 25px;
    padding: 0 12px;
}
.project_manager h5 {
    color: #9da2a6;
    font: 18px helveticaregular;

}
.project_manager small {
    color: #00aff0;
    font: 18px helveticaregular !important;
    margin: 0 !important;
}
.project_manager cite {
    color: #f68d20;
    font: 18px helveticaregular !important;
    margin: 0 !important;
}
.project_manager span {
    color: #9fce64;
    font: 18px helveticaregular;
}
/**/
   .platinum_list {
    float:left;
    width:100%;
    margin-top:55px;
        }
        .platinum_list h3 {
            font-size:33px;
            color:#959ca1;
            margin: 32px 0 38px;
            text-decoration: underline;
        }
        .screening_heading {
            float:none;
        }
        .screening_heading h4 {
            font-size:18px;
        }
        .screening_heading p {
            color:#959ca1;
            font-size:14px;
            height: 60px;
        }
        td:nth-child(1) {
            background-color: orange;
        }
        table, th, td {
            color:white;
        }
        table {
            border-collapse:collapse;
            width:100%;
        }
        .screening th {
            background-color: #0c8cbf;
        }
        td {
            font-family: helvetica_neueheavycond;
            font-size: 18px;
            height: 46px;
            letter-spacing: 1px;
            padding: 9px 13px !important;
        }
        td:nth-child(1) {
            background-color: #24ade3;
        }
        td:nth-child(2) {
            background-color: #f5f5f5;
            color:#959ca1;
            text-align:center;
        }
        td:nth-child(3) {
            background-color: #e8e8e8;
            color:#959ca1;
        }
        .platinum_first{
            width:100%;
            float:left;
        }
        .gold_study{
            width:100%;
            float:left;
        }
        .list_gold{
            float:left;
            background:#f78f1e;
            width:100%;
        }
          .reward_background{
            background:url(<?php bloginfo('template_url'); ?>/images-dashboard/background_peoplenew.png) no-repeat !important;
           }
    </style>

    <body>

<!------------------------------------->
<!-- Pure Chat Snippet -->
<script type='text/javascript'>
    (function () {
        var done = false;
        var script = document.createElement('script');
        script.async = true;
        script.type = 'text/javascript';
        script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript';
        document.getElementsByTagName('HEAD').item(0).appendChild(script);
        script.onreadystatechange = script.onload = function (e) {
            if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
                var w = new PCWidget({c: 'bab234e1-3a99-448d-b117-2bb29457f303', f: true});
                done = true;
            }
        };
    })();
</script>
<?php
$rewards2 = get_the_author_meta('rewards', $user_ID);
$rewards3 = get_the_author_meta('rewards', $user_ID);
$rewards=$rewards2;
$update_points=0;
$activity='';
if (isset($_REQUEST['select_reward'])) {
    $select_rewards = $_REQUEST['select_rewards'];
    if ($select_rewards == "75 KIKs = $25 Starbucks Gift Card") {
        if ($rewards2 >= 75) {
            $update_points=75;
            $activity='Redeem $25 Starbucks Gift Card';
        }
    }
    if ($select_rewards == "225 KIKs = $75 Amazon Gift Card") {
        if ($rewards2 >= 225) {
            $update_points=225;
            $activity='Redeem $75 Amazon Gift Card';
        }
    }
    if ($select_rewards == "1559 KIKs = $1559 StudyKIK Platinum Listing") {
        if ($rewards2 >= 1559) {
            $update_points=1559;
            $activity='Redeem $1559 Platinum Listing';
        }
    }
    if(($update_points >0) && ($activity !='') && ($rewards2 >= $update_points)){
        $rewards=$rewards2-$update_points;
        mysql_query("UPDATE 0gf1ba_rewards_details SET is_last=0 WHERE user_id='$user_ID'");
        $rewards_datetime = date('Y-m-d H:i:s',strtotime('-4 hours'));
        $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_rewards_details`(`id`, `user_id`, `activity_of_points`,`rewards_date_time`,`credit`,`debit`,`balance`,`is_last`) VALUES (NULL,'$user_ID','$activity','$rewards_datetime',0,'$update_points','$rewards',1)",array()));
	update_user_meta($user_ID, 'rewards', $rewards);
    }
}
?>


<div id="banner_login">
  <div class="container">
    <div class="row">
      <div class="dashboard_banner">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <header id="top">
        <h1><a href="index.html">Kitchy Food</a><img src="<?php bloginfo('template_url'); ?>/images-dashboard/logout_logo.png" alt=""></h1>
                                    </header>
                                        <ul class="nav navbar-nav">
                                        <li><a href="<?php echo site_url();?>/dashboard/">HOME
                                            </a></li>
                                            <li><a href="<?php echo site_url();?>/clinical-study-information-dashboard/">LIST A<br>
                                                NEW STUDY</a></li>
                                        <li><a href="<?php echo site_url();?>/refer-listing/">REFER<br>
                                                A LISTING</a></li>

                                        <li><a  href="javascript:void:0();">ADD<br>
                                                SITE</a></li>
                                        <li style="border:none;"><a  class="midsection" href="<?php echo site_url();?>/rewards/"  style="color:#00afef;">REWARDS</a></li>
                                        <li><a href="javascript:void:0();"> ADD<br> PREFERRED<br> IRBs</a></li>
                                       <li><a href="<?php echo site_url();?>/proposal/">PROPOSAL</a></li>
                                         <li><a href="<?php echo site_url();?>/invoice-receipts/">INVOICE <br />
                                         RECEIPTS</a></li>
                                        <li><a href="<?php echo site_url();?>/your-profile/?idp=Profile">MY ACCCOUNT
                                                </a></li>
                                    </ul>
            </div>
            <!-- /.navbar-collapse -->
          </div>
          <!-- /.container-fluid -->
        </nav>
   <div class="project_manager">
    <h5>Stud<small>y</small><cite>KIK</cite> Project Manager: <span><?php echo get_user_meta($user_ID, 'project_manager', true); ?></span> - <span><?php echo get_user_meta($user_ID, 'phone_number', true); ?></span></h5>
     </div>
      </div>
    </div>
    <div class="row">
         <?php
            $featured = new WP_Query(array(
                'post_status' => array('publish', 'draft', 'pending', 'private'),
                'author' => $user_ID,
                'meta_key' => 'rewards',
            ));
            while ($featured->have_posts()) : $featured->the_post();
                $post_id = $post->ID;
                $platinum += get_post_meta($post_id, 'rewards', true);
            endwhile;
            wp_reset_query();
            ?>
      <section class="container_rewards">
      <div class="total_point">
          <?php
          $authors_ids = array();
              if (have_posts()) {
                                while (have_posts()) : the_post();
                                    if ($user_roles == 'manager_username') {
                                         if(isset($_SESSION['authors_ids'])){
                                       $authors_ids=$_SESSION['authors_ids'];
                                       }
                                        $post_author_id = $_SESSION['authors_ids'];
                                        //echo $post_author_id;die;
                                        if ($post_author_id) {
                                            if ($post_author_id > 0) {
                                                $user = get_user_by('id', $post_author_id);
                                               // echo $user;die;
                                                if ($user->user_login != "") {
                                                    $authors_ids[$post_author_id] = $user->user_login;
                                                }
                                            }
                                        }
                                    }
                                endwhile;
                            }
          ?>
      <div class="site_select">
               <?php
                            //$sel_val='all';
                            if(isset($_REQUEST['aid'])){
                                $sel_val=$_REQUEST['aid'];
                            }
                        ?>
      <select class="select_reward">
<!--  		<option <?php if($sel_val=='all'){echo 'selected="selected"';}?> value="all">All</option>-->
                        <?php
                        $def_sel=0;
                        $km=1;
                        foreach($authors_ids as $auid => $qry){
                            if($km==1){
                                $def_sel=$auid;
                            }
                            $km=$km+1;
                            ?>
                            <option <?php if($auid == $sel_val){echo 'selected="selected"';}?> value="<?php echo $auid;?>"><?php echo $qry;?></option>
                        <?php } ?>
	</select>
      </div>

      <div class="reward_background">
      <div class="redeem_back">
                                  <h4 class="reward_kik">MY STUDYKIK REWARDS:<span class="total_poitn"><?php //echo $rewards //$rewards+$platinum;  ?>
                                      <?php
                                      if(isset($_REQUEST['aid'])){
                                        $auid=$_REQUEST['aid'];
                                      }
                                      else{
                                          $auid=$def_sel;
                                      }
                                  //echo $auid;
                                  echo get_the_author_meta('rewards', $auid);?> Total Points</span></h4>

      </div>
      </div>
          <script>
$(".select_reward").change(function () {

var user_id = this.value;
var url      = window.location.href;
if(user_id == "" || user_id == ""){}else{
location.search = "aid="+user_id;
}
});
    </script>
      <div class="gift_section">
      <div class="starb_card">
      <h4 class="gift_one"><strong class="kik_left">50 KIKs</strong> <b class="dolar_left">= $25</b><span class="logo_center"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/starbuck.png" alt="" class="img-responsive"></span><b class="dolar_left">Starbucks Gift Card</b></h4>
      </div>
      <div class="amozon_card">
      <h4 class="gift_one"><strong class="kik_left">150 KIKs</strong> <b class="dolar_left">= $75</b><span class="amozon_center"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/gift_card.png" alt="" class="img-responsive"></span><b class="dolar_left">Gift Card</b></h4>
      </div>
      <div class="platinum_card">
      <h4 class="gift_one"><strong class="kik_left">1559 KIKs</strong> <b class="dolar_left">= $1559</b><span class="platinum_center"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/listing_studykik.png" alt="" class="img-responsive"></span><b class="dolar_left">Platinum Listing</b></h4>
      </div>
      </div>
                  <div class="platinum_list">
                        <h3 class="text-center">3 WAYS TO EARN KIKS:</h3>
                    </div>
                    <div class=" col-xs-12 col-sm-4 listing_studies">
                        <img src="<?php bloginfo('template_url'); ?>/images-dashboard/one.png" alt="" class="img-responsive center-block">
                        <div class="screening_heading">
                            <h4 class="text-center" style="color:#24ade3;">Fill Out Enrollment Data!</h4>
                            <p class="text-center">For every study that you update your patient<br/>
                                notes and status on weekly, you earn points:</p>
                            <table class="screening">
                                <tr>
                                    <td>Diamond Listing</td>
                                    <td>300 KIKs</td>
                                </tr>
                                <tr>
                                    <td>Platinum Listing</td>
                                    <td>150 KIKs</td>
                                </tr>
                                <tr>
                                    <td>Gold Listing </td>
                                    <td>50 KIKs</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 listing_studies">
                        <img src="<?php bloginfo('template_url'); ?>/images-dashboard/two.png" alt="" class="img-responsive center-block">
                        <div class="screening_heading">
                            <h4 class="text-center" style="color:#f78f1e;">Listing Studies!</h4>
                            <p class="text-center">Every Time You List a Study You Earn Points Back:</p>
                            <table class="gold_study">
                                <tr>
                                    <td class="list_gold" style=" background:#f78f1e;">List a Diamond Study</td>
                                    <td style="background:#e8e8e8;">30 KIKs</td>
                                </tr>
                                <tr>
                                    <td class="list_gold" style=" background:#f78f1e;">List a Platinum Study</td>
                                    <td style="background:#e8e8e8;">15 KIKs</td>
                                </tr>
                                <tr>
                                    <td class="list_gold" style=" background:#f78f1e;">List a Gold Study</td>
                                    <td style="background:#e8e8e8;">5 KIKs</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 listing_studies">
                        <img src="<?php bloginfo('template_url'); ?>/images-dashboard/three.png" alt="" class="img-responsive center-block">
                        <div class="screening_heading">
                            <h4 class="text-center" style="color:#9ece67;">Referring Studies!</h4>
                            <p class="text-center">We Appreciate Your Referrals!  Earn Points for<br>
                                Every Site or Sponsor That Lists a Platinum Study<br>
                                with StudyKIK, <a href="<?php echo site_url();?>/refer-listing/">Click here</a>:</p>
                            <table class="gold_study">
                                <tr>
                                    <td class="list_gold" style=" background:#9fcf67;">Refer a Sponsor</td>
                                    <td style="background:#e8e8e8;">300 KIKs</td>
                                </tr>
                                <tr>
                                    <td class="list_gold" style=" background:#9fcf67;">Refer a Site</td>
                                    <td style="background:#e8e8e8;">100 KIKs</td>
                                </tr>
                            </table>
                        </div>
                    </div>
      </div>
      </section>
    </div>
</div>

<!---------------------------------------->
<div id="embed" class="white_content" style="display: none;">
        <h2 class="heading">Select Reward</h2>
        <form action="" method="post" style="float:left;">
            <div><input type="radio" value="75 KIKs = $25 Starbucks Gift Card" name="select_rewards" /><label>75 KIKs = $25 Starbucks Gift Card</label></div>
            <div><input type="radio" value="225 KIKs = $75 Amazon Gift Card" name="select_rewards" /><label>225 KIKs = $75 Amazon Gift Card</label></div>
            <div style="margin-bottom:20px;"><input type="radio" value="1559 KIKs = $1559 StudyKIK Platinum Listing" name="select_rewards" /><label>1559 KIKs = $1559 StudyKIK Platinum Listing</label></div>
            <input type="submit" value="REDEEM KIKS!" name="select_reward" /><br/><br/>
        </form>
        <a onclick="document.getElementById('embed').style.display = 'none';
                document.getElementById('fade').style.display = 'none';" href="javascript:void(0)" class="closepop">Close</a>
    </div>
    <div class="black_overlay" id="fade" style="display: none;"></div>
    <?php
    global $current_user;
    get_currentuserinfo();

    if (isset($_REQUEST['select_reward'])) {
        $select_rewards = $_REQUEST['select_rewards'];
        if ($select_rewards == "75 KIKs = $25 Starbucks Gift Card") {
            if ($rewards3 >= 75) {

            } else {
                ?>
                <div id="embed2" class="white_content" style="display: block;">
                    <h2 class="heading">Sorry</h2>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Sorry you do not have enough KIKs.</p>
                    <input style="margin: 10px 42% 10px 0;"  onclick="document.getElementById('embed2').style.display = 'none';
                            document.getElementById('fade2').style.display = 'none'" class="close_button2" type="button" value="CLOSE"/>
                </div>
                <div id="fade2" class="black_overlay" style="display: block;"></div>
                <?php
                die;
            }
        }
        if ($select_rewards == "225 KIKs = $75 Amazon Gift Card") {
            if ($rewards3 >= 225) {

            } else {
                ?>
                <div id="embed2" class="white_content" style="display: block;">
                    <h2 class="heading">Sorry</h2>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Sorry you do not have enough KIKs.</p>
                    <input style="margin: 10px 42% 10px 0;"  onclick="document.getElementById('embed2').style.display = 'none';
                            document.getElementById('fade2').style.display = 'none'" class="close_button2" type="button" value="CLOSE"/>
                </div>
                <div id="fade2" class="black_overlay" style="display: block;"></div>
                <?php
                die;
            }
        }
        if ($select_rewards == "1559 KIKs = $1559 StudyKIK Platinum Listing") {
            if ($rewards3 >= 1559) {
            } else {
                ?>
                <div id="embed2" class="white_content" style="display: block;">
                    <h2 class="heading">Sorry</h2>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Sorry you do not have enough KIKs.</p>
                    <input style="margin: 10px 42% 10px 0;"  onclick="document.getElementById('embed2').style.display = 'none';
                            document.getElementById('fade2').style.display = 'none'" class="close_button2" type="button" value="CLOSE"/>
                </div>
                <div id="fade2" class="black_overlay" style="display: block;"></div>
                <?php
                die;
            }
        }
        if(($update_points >0) && ($activity !='') && ($rewards2 >= $update_points)){
            $subject_user = "Your StudyKIK Rewards";
            $subject_admin = "Rewards Claim (" . $current_user->user_login . ")";
            $body_user = "Dear Valued Study Site:<br /><br />
                          Thank you for claiming your " . $select_rewards . " reward!<br /><br />
                          You will receive an email shortly with your redemption code or eGift Card.<br /><br />
                          Thank you,<br /><br />
                          StudyKIK<br />
                          info@studykik.com<br />
                          1-877-627-2509<br />";
            $body_admin = "Rewards Claim:<br /><br />
                           Username: " . $current_user->user_login . "<br /><br />
                           Email: " . $current_user->user_email . "<br /><br />
                           Rewards Claim " . $select_rewards . "<br /><br />
                           Thank you!";
            $headers_user[] = 'From: StudyKIK <info@studykik.com>';
            $headers_user[] = "MIME-Version: 1.0\r\n";
            $headers_user[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $headers_admin[] = 'From: Rewards Claim <' . $current_user->user_email . '>';
            $headers_admin[] = "MIME-Version: 1.0\r\n";
            $headers_admin[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
            wp_mail('info@studykik.com', $subject_admin, $body_admin, $headers_admin);
            //wp_mail('keshvendersingh145@gmail.com', $subject_admin, $body_admin, $headers_admin);
            $email_send = wp_mail($current_user->user_email, $subject_user, $body_user, $headers_user);
            if ($email_send) {
                ?>
                <div id="embed2" class="white_content" style="display: block;">
                    <h2 class="heading">Thank you</h2>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Thank You for Claiming Your StudyKIK Rewards!  An email will be sent to you shortly with your redemption information.</p>
                    <input style="margin: 10px 42% 10px 0;"  onclick="document.getElementById('embed2').style.display = 'none';
                            document.getElementById('fade2').style.display = 'none'" class="close_button2" type="button" value="CLOSE"/>
                </div>
                <div id="fade2" class="black_overlay" style="display: block;"></div>
                <?php
            }
        }
    }
    ?>
</div>

        <?php get_footer('responsive');?>
<?php }}?>
<?php
if (is_user_logged_in()) {
    $user_ID = get_current_user_id();
    $user_info = get_userdata($user_ID);
    $user_roles = implode(', ', $user_info->roles);
    if ($user_roles == "editor") {?>
<?php get_header('dashboard'); ?>
 <!---------------css added------------->
    <style>
        .team_member{
            background: none repeat scroll 0 0 #959ca1;
            border: 1px solid #848a8f;
            border-radius: 2px;
            float: right;
            margin-right: 22px;
            margin-top: 23px;
            padding: 0 10px;
            width: 40%;
        }
        .team_member h3{
            color: #fff;
            font-family: arial;
            font-size: 16px;
            margin: 0;
            padding: 6px;
        }
        .total_point{
            float:left;
            width:100%;
            background:#FFF;
            -moz-box-shadow: 1px 0px 5px #000000;
            -webkit-box-shadow: 1px 0px 5px #000000;
            box-shadow: 0px 0px 5px #000000;
            padding-bottom: 30px;
            border-radius: 4px;
        }
        .container_rewards {
            background:#f5f5f5;
            -moz-box-shadow: 1px 0px 5px -2px #000000;
            -webkit-box-shadow: 1px 0px 5px -2px #000000;
            box-shadow: 0px 0px 5px -2px #000000;
            float:left;
            width: 100%;
            padding: 30px 20px;
            position:relative;
        }
        .studykik_reward {
            width:100%;
            float:left;
            background:#f78f1e;
            border-radius:4px 4px 0 0;
            padding:5px 0 16px;
        }
        .studykik_reward h1 {
            color:#ffffff;
            font-size:40px;
            line-height:40px;
        }
        .right_arrow {
            position:absolute;
            top:41px;
            right:246px;
        }
        .platinum_list {
            float:left;
            width:100%;
            margin-top:55px;
        }
        .platinum_list h3 {
            font-size:33px;
            color:#959ca1;
            margin: 32px 0 38px;
            text-decoration: underline;
        }
        .screening_heading {
            float:none;
        }
        .screening_heading h4 {
            font-size:18px;
        }
        .screening_heading p {
            color:#959ca1;
            font-size:14px;
            height: 60px;
        }
        td:nth-child(1) {
            background-color: orange;
        }
        table, th, td {
            color:white;
        }
        table {
            border-collapse:collapse;
            width:100%;
        }
        .screening th {
            background-color: #0c8cbf;
        }
        td {
            font-family: helvetica_neueheavycond;
            font-size: 18px;
            height: 46px;
            letter-spacing: 1px;
            padding: 9px 13px !important;
        }
        td:nth-child(1) {
            background-color: #24ade3;
        }
        td:nth-child(2) {
            background-color: #f5f5f5;
            color:#959ca1;
            text-align:center;
        }
        td:nth-child(3) {
            background-color: #e8e8e8;
            color:#959ca1;
        }
        .platinum_first{
            width:100%;
            float:left;
        }
        .gold_study{
            width:100%;
            float:left;
        }
        .list_gold{
            float:left;
            background:#f78f1e;
            width:100%;
        }
        /**My reward css start**/
        .reward_background{
            background:url(<?php bloginfo('template_url'); ?>/images-dashboard/background_people.png) no-repeat;
            height: 303px;
            left: 0px;
            position: relative;
            top: 46px;
        }
        .redeem_back{
            position: absolute;
            width: 90%;
            top: 20px;
        }
        .reward_kik{
            color: #f78f1e;
            float: left;
            font-family: arial;
            font-size: 27px;
            font-weight: 600;
            line-height: 42px;
            margin: 2px 0 0 182px;
            text-transform: uppercase;
            width:874px;
        }
        .total_poitn {
            color: #9fcf67;
            font-family: arial;
            margin: 0 0 0 8px;
        }
        .gift_section{
            left: 260px;
            position: absolute;
            top: 207px;
            width: 59%;
        }
        .logo_center{
            float: left;
            margin: 4px 10px 0 11px;
        }
        .starb_card{
            background:#00afef;
            width:685px;
            height:50px;
            float:left;
        }
        .kik_left{
            color: #ffffff;
            float: left;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 24px;
            margin: 8px 0 0;
            text-decoration: underline;
        }
        .gift_one{
            color: #ffffff;
            float: right;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 24px;
            margin: 0;
            width: 93%;
        }
        .dolar_left{
            float: left;
            margin: 8px 0 0 5px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight:normal;
            font-size: 24px;
            color: #ffffff;
        }
        .amozon_card{
            background:#f78f1e;
            width:685px;
            height:50px;
            float:left;
        }
        .amozon_center{
            float: left;
            margin: 10px 10px 0 11px;
        }
        .platinum_center{
            float: left;
            margin: 10px 10px 0 11px;
        }
        .platinum_card{
            background:#9ecf67;
            width:685px;
            height:50px;
            float:left;
        }
        .white_content {
            background-color: white;
            border-radius: 10px;
            cursor: auto;
            display: none;
            left: 23% !important;
            overflow: auto;
            position: fixed !important;
            top: 25% !important;
            width: 55% !important;
            z-index: 99999 !important;
            border: 1px solid #f78e1e;
        }
        .black_overlay {
            background: #000000 none repeat scroll 0 0;
            display: none;
            height: 3400px;
            left: 0;
            opacity: 0.8;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 1001;
        }

        h2.heading {
            background: #f78e1e none repeat scroll 0 0;
            color: #fff;
            font-family: alternate;
            font-size: 44px;
            margin: 0;
            padding: 5px;
            text-align: center;
            text-decoration: none;
        }
        #embed  div {
            float: left;
            padding: 14px 20px 0;
            width: 100%;
        }
        #embed  div label {
            margin-left: 10px;
        }
        .closepop {
            background: rgba(0, 0, 0, 0) url("<?php bloginfo('template_url'); ?>/images-dashboard/close2.png") no-repeat scroll 0 0;

        }
        #embed input[type="submit"] {
            background: #00afef none repeat scroll 0 0;
            border: medium none;
            color: #fff;
            display: block;
            font-family: alternate;
            font-size: 33px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 26px;
        }
        .close_button2 {
            background: #00afef none repeat scroll 0 0;
            border: medium none;
            color: #fff;
            float: right;
            font-family: alternate;
            font-size: 33px;
            margin: 10px 34% 10px 0;
            padding: 0 26px;
        }
    </style>
<!------------------------------------->
<!-- Pure Chat Snippet -->
<script type='text/javascript'>
    (function () {
        var done = false;
        var script = document.createElement('script');
        script.async = true;
        script.type = 'text/javascript';
        script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript';
        document.getElementsByTagName('HEAD').item(0).appendChild(script);
        script.onreadystatechange = script.onload = function (e) {
            if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
                var w = new PCWidget({c: 'bab234e1-3a99-448d-b117-2bb29457f303', f: true});
                done = true;
            }
        };
    })();
</script>
<?php
$rewards2 = get_the_author_meta('rewards', $user_ID);
$rewards3 = get_the_author_meta('rewards', $user_ID);
$rewards=$rewards2;
$update_points=0;
$activity='';
if (isset($_REQUEST['select_reward'])) {
    $select_rewards = $_REQUEST['select_rewards'];
    if ($select_rewards == "75 KIKs = $25 Starbucks Gift Card") {
        if ($rewards2 >= 75) {
            $update_points=75;
            $activity='Redeem $25 Starbucks Gift Card';
        }
    }
    if ($select_rewards == "225 KIKs = $75 Amazon Gift Card") {
        if ($rewards2 >= 225) {
            $update_points=225;
            $activity='Redeem $75 Amazon Gift Card';
        }
    }
    if ($select_rewards == "1559 KIKs = $1559 StudyKIK Platinum Listing") {
        if ($rewards2 >= 1559) {
            $update_points=1559;
            $activity='Redeem $1559 Platinum Listing';
        }
    }
    if(($update_points >0) && ($activity !='') && ($rewards2 >= $update_points)){
        $rewards=$rewards2-$update_points;
        mysql_query("UPDATE 0gf1ba_rewards_details SET is_last=0 WHERE user_id='$user_ID'");
        $rewards_datetime = date('Y-m-d H:i:s',strtotime('-4 hours'));
        $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_rewards_details`(`id`, `user_id`, `activity_of_points`,`rewards_date_time`,`credit`,`debit`,`balance`,`is_last`) VALUES (NULL,'$user_ID','$activity','$rewards_datetime',0,'$update_points','$rewards',1)",array()));
	update_user_meta($user_ID, 'rewards', $rewards);
    }
}
?>
<div id="banner_login">
    <div class="container">
        <div class="row">
            <div class="dashboard_banner">
                <header id="top">
                    <h1><a href="index.html">Kitchy Food</a><img src="<?php bloginfo('template_url'); ?>/images-dashboard/logout_logo.png" alt=""></h1>
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                           <ul class="nav navbar-nav">
            <li ><a style="margin-top: 12px;" href="<?php echo site_url();?>/dashboard/">HOME</a></li>
            <li><a href="<?php echo site_url();?>/clinical-study-information-dashboard/">LIST A <br>
              NEW STUDY</a></li>
                 <li ><a   href="<?php echo site_url();?>/refer-listing/">REFER <br>
              A LISTING</a></li>
            <li style="border:none;"><a  class="midsection" href="<?php echo site_url();?>/rewards/"  style="color:#00afef;">REWARDS</a></li>
            <li><a style="margin-top: 12px;" href="<?php echo site_url();?>/proposal/">PROPOSAL</a></li>
            <li><a href="/invoice-receipts/">INVOICE <br />
              RECEIPTS</a></li>
            <li><a href="<?php echo site_url();?>/your-profile/?idp=Profile">MY <br/>
              ACCCOUNT</a></li>
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
        <div class="row">
            <?php
            $featured = new WP_Query(array(
                'post_status' => array('publish', 'draft', 'pending', 'private'),
                'author' => $user_ID,
                'meta_key' => 'rewards',
            ));
            while ($featured->have_posts()) : $featured->the_post();
                $post_id = $post->ID;
                $platinum += get_post_meta($post_id, 'rewards', true);
            endwhile;
            wp_reset_query();
            ?>
            <section class="container_rewards">
                <div class="total_point">
                    <div class="reward_background">
                        <div class="redeem_back">
                            <h4 class="reward_kik">MY STUDYKIK REWARDS:<span class="total_poitn"><?php echo $rewards //$rewards+$platinum;  ?> Total Points</span><a href="javascript:void();" onclick="document.getElementById('embed').style.display = 'block';
                                    document.getElementById('fade').style.display = 'block'"><img style="margin-left: 10px;" src="<?php bloginfo('template_url'); ?>/images-dashboard/points_buttonkik.png" alt="" class="img-responsive pull-right"></a></h4>
                        </div>
                    </div>
                    <div class="gift_section">
                        <div class="starb_card">
                            <h4 class="gift_one"><strong class="kik_left">75 KIKs </strong> <b class="dolar_left"> = $25</b><span class="logo_center"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/starbuck.png" alt="" class="img-responsive"></span><b class="dolar_left">Starbucks Gift Card</b></h4>
                        </div>
                        <div class="amozon_card">
                            <h4 class="gift_one"><strong class="kik_left">225 KIKs </strong> <b class="dolar_left"> = $75</b><span class="amozon_center"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/gift_card.png" alt="" class="img-responsive"></span><b class="dolar_left">Gift Card</b></h4>
                        </div>
                        <div class="platinum_card">
                            <h4 class="gift_one"><strong class="kik_left">1559 KIKs </strong> <b class="dolar_left"> = $1559</b><span class="platinum_center"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/listing_studykik.png" alt="" class="img-responsive"></span><b class="dolar_left">Platinum Listing</b></h4>
                        </div>
                    </div>
                    <div class="platinum_list">
                        <h3 class="text-center">3 WAYS TO EARN KIKS:</h3>
                    </div>
                    <div class=" col-xs-12 col-sm-4 listing_studies">
                        <img src="<?php bloginfo('template_url'); ?>/images-dashboard/one.png" alt="" class="img-responsive center-block">
                        <div class="screening_heading">
                            <h4 class="text-center" style="color:#24ade3;">Fill Out Enrollment Data!</h4>
                            <p class="text-center">For every study that you update your patient<br/>
                                notes and status on weekly, you earn points:</p>
                            <table class="screening">
                                <tr>
                                    <td>Diamond Listing</td>
                                    <td>300 KIKs</td>
                                </tr>
                                <tr>
                                    <td>Platinum Listing</td>
                                    <td>150 KIKs</td>
                                </tr>
                                <tr>
                                    <td>Gold Listing </td>
                                    <td>50 KIKs</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 listing_studies">
                        <img src="<?php bloginfo('template_url'); ?>/images-dashboard/two.png" alt="" class="img-responsive center-block">
                        <div class="screening_heading">
                            <h4 class="text-center" style="color:#f78f1e;">Listing Studies!</h4>
                            <p class="text-center">Every Time You List a Study You Earn Points Back:</p>
                            <table class="gold_study">
                                <tr>
                                    <td class="list_gold" style=" background:#f78f1e;">List a Diamond Study</td>
                                    <td style="background:#e8e8e8;">30 KIKs</td>
                                </tr>
                                <tr>
                                    <td class="list_gold" style=" background:#f78f1e;">List a Platinum Study</td>
                                    <td style="background:#e8e8e8;">15 KIKs</td>
                                </tr>
                                <tr>
                                    <td class="list_gold" style=" background:#f78f1e;">List a Gold Study</td>
                                    <td style="background:#e8e8e8;">5 KIKs</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 listing_studies">
                        <img src="<?php bloginfo('template_url'); ?>/images-dashboard/three.png" alt="" class="img-responsive center-block">
                        <div class="screening_heading">
                            <h4 class="text-center" style="color:#9ece67;">Referring Studies!</h4>
                            <p class="text-center">We Appreciate Your Referrals!  Earn Points for<br>
                                Every Site or Sponsor That Lists a Platinum Study<br>
                                with StudyKIK, <a href="<?php echo site_url();?>/refer-listing/">Click here</a>:</p>
                            <table class="gold_study">
                                <tr>
                                    <td class="list_gold" style=" background:#9fcf67;">Refer a Sponsor</td>
                                    <td style="background:#e8e8e8;">300 KIKs</td>
                                </tr>
                                <tr>
                                    <td class="list_gold" style=" background:#9fcf67;">Refer a Site</td>
                                    <td style="background:#e8e8e8;">100 KIKs</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>  </div>
    <div id="embed" class="white_content" style="display: none;">
        <h2 class="heading">Select Reward</h2>
        <form action="" method="post" style="float:left;">
            <div><input type="radio" value="75 KIKs = $25 Starbucks Gift Card" name="select_rewards" /><label>75 KIKs = $25 Starbucks Gift Card</label></div>
            <div><input type="radio" value="225 KIKs = $75 Amazon Gift Card" name="select_rewards" /><label>225 KIKs = $75 Amazon Gift Card</label></div>
            <div style="margin-bottom:20px;"><input type="radio" value="1559 KIKs = $1559 StudyKIK Platinum Listing" name="select_rewards" /><label>1559 KIKs = $1559 StudyKIK Platinum Listing</label></div>
            <input type="submit" value="REDEEM KIKS!" name="select_reward" /><br/><br/>
        </form>
        <a onclick="document.getElementById('embed').style.display = 'none';
                document.getElementById('fade').style.display = 'none';" href="javascript:void(0)" class="closepop">Close</a>
    </div>
    <div class="black_overlay" id="fade" style="display: none;"></div>
    <?php
    global $current_user;
    get_currentuserinfo();

    if (isset($_REQUEST['select_reward'])) {
        $select_rewards = $_REQUEST['select_rewards'];
        if ($select_rewards == "75 KIKs = $25 Starbucks Gift Card") {
            if ($rewards3 >= 75) {

            } else {
                ?>
                <div id="embed2" class="white_content" style="display: block;">
                    <h2 class="heading">Sorry</h2>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Sorry you do not have enough KIKs.</p>
                    <input style="margin: 10px 42% 10px 0;"  onclick="document.getElementById('embed2').style.display = 'none';
                            document.getElementById('fade2').style.display = 'none'" class="close_button2" type="button" value="CLOSE"/>
                </div>
                <div id="fade2" class="black_overlay" style="display: block;"></div>
                <?php
                die;
            }
        }
        if ($select_rewards == "225 KIKs = $75 Amazon Gift Card") {
            if ($rewards3 >= 225) {

            } else {
                ?>
                <div id="embed2" class="white_content" style="display: block;">
                    <h2 class="heading">Sorry</h2>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Sorry you do not have enough KIKs.</p>
                    <input style="margin: 10px 42% 10px 0;"  onclick="document.getElementById('embed2').style.display = 'none';
                            document.getElementById('fade2').style.display = 'none'" class="close_button2" type="button" value="CLOSE"/>
                </div>
                <div id="fade2" class="black_overlay" style="display: block;"></div>
                <?php
                die;
            }
        }
        if ($select_rewards == "1559 KIKs = $1559 StudyKIK Platinum Listing") {
            if ($rewards3 >= 1559) {
            } else {
                ?>
                <div id="embed2" class="white_content" style="display: block;">
                    <h2 class="heading">Sorry</h2>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Sorry you do not have enough KIKs.</p>
                    <input style="margin: 10px 42% 10px 0;"  onclick="document.getElementById('embed2').style.display = 'none';
                            document.getElementById('fade2').style.display = 'none'" class="close_button2" type="button" value="CLOSE"/>
                </div>
                <div id="fade2" class="black_overlay" style="display: block;"></div>
                <?php
                die;
            }
        }
        if(($update_points >0) && ($activity !='') && ($rewards2 >= $update_points)){
            $subject_user = "Your StudyKIK Rewards";
            $subject_admin = "Rewards Claim (" . $current_user->user_login . ")";
            $body_user = "Dear Valued Study Site:<br /><br />
                          Thank you for claiming your " . $select_rewards . " reward!<br /><br />
                          You will receive an email shortly with your redemption code or eGift Card.<br /><br />
                          Thank you,<br /><br />
                          StudyKIK<br />
                          info@studykik.com<br />
                          1-877-627-2509<br />";
            $body_admin = "Rewards Claim:<br /><br />
                           Username: " . $current_user->user_login . "<br /><br />
                           Email: " . $current_user->user_email . "<br /><br />
                           Rewards Claim " . $select_rewards . "<br /><br />
                           Thank you!";
            $headers_user[] = 'From: StudyKIK <info@studykik.com>';
            $headers_user[] = "MIME-Version: 1.0\r\n";
            $headers_user[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $headers_admin[] = 'From: Rewards Claim <' . $current_user->user_email . '>';
            $headers_admin[] = "MIME-Version: 1.0\r\n";
            $headers_admin[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
            wp_mail('info@studykik.com', $subject_admin, $body_admin, $headers_admin);
            //wp_mail('keshvendersingh145@gmail.com', $subject_admin, $body_admin, $headers_admin);
            $email_send = wp_mail($current_user->user_email, $subject_user, $body_user, $headers_user);
            if ($email_send) {
                ?>
                <div id="embed2" class="white_content" style="display: block;">
                    <h2 class="heading">Thank you</h2>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Thank You for Claiming Your StudyKIK Rewards!  An email will be sent to you shortly with your redemption information.</p>
                    <input style="margin: 10px 42% 10px 0;"  onclick="document.getElementById('embed2').style.display = 'none';
                            document.getElementById('fade2').style.display = 'none'" class="close_button2" type="button" value="CLOSE"/>
                </div>
                <div id="fade2" class="black_overlay" style="display: block;"></div>
                <?php
            }
        }
    }
    ?>
<?php get_footer('dashboard'); ?>

<?php }}?>

