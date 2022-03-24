<?php
if( is_user_logged_in() ) {
	$user_ID = get_current_user_id(); 
}
else {
	wp_redirect( 'https://studykik.com/login/', 301 ); exit;
}
?>
<?php
/*
* Template Name: Stats Dashboard
*/
?>
<?php get_header('dashboard');?>
<style>
.form_right {
    min-height: 443px;
}
div.wpcf7-mail-sent-ok{
  margin: 0;
  position: relative;
  right: 60px;
  top: 24px !important;
 }
</style>
<div id="banner_login">
	<div class="container">
		<div class="row">
			<div class="dashboard_banner">
				<header id="top">
				<h1><img src="<?php bloginfo('template_url');?>/images-dashboard/logout_logo.png" alt=""></h1>
				<nav class="navbar navbar-default">
					<div class="container-fluid"> 
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav sponsor" style="margin:0 10%;width:80%">
								<li style="border-right:none;margin-left:13%"><a href="<?php bloginfo('url');?>/study-patient-stats-dashboard/" style="margin-top: 12px; color:#00afef;">HOME </a></li>

							   <li style="margin-left:53%;padding-right:0px;">
									<a target="_blank" href="<?php bloginfo('url');?>/clinical-trial-patient-recruitment-patient-enrollment/" >LIST <br>ANOTHER STUDY</a>
								</li>
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
		<?php
			$featured = new WP_Query( array(
			'post_type' => 'post',
			'posts_per_page'  => -1,
			'post_status' => array('publish','private'),
			'ignore_sticky_posts' => 1,
			'fields'=>'id=>parent',
			'meta_query' => array(
			    'relation' => 'OR',
			    array(
					'key' => 'user_id_add_user_id_to_assign_this_post_to_stats',
					'value' => $user_ID,
					'compare' => '=',
				),
				array(
				'key' => 'subscriber',
				'value' => $user_ID,
				'compare' => '='
				),
			)
			
		) );
		$post_allids=array();					
		while ( $featured->have_posts() ) : $featured->the_post();
			$post_id = $post->ID;
			$post_allids[]=$post_id;
		endwhile; wp_reset_query(); 
		if(empty($post_allids)){
			$post_allids[]=-1;
		}
		$total_post=count($post_allids);
		$all_ids=implode(",",$post_allids);
		$referal_total = $wpdb->get_results("SELECT id,row_num FROM 0gf1ba_subscriber_list WHERE post_id IN ( $all_ids) AND is_deleted != 1", OBJECT);
		foreach($referal_total as $key => $row){
			$row_num = $row->row_num;
			$referal_totals += 1;
			if($row_num==1){
				$Patient_Referrals += 1;
			}
			if($row_num==2){
				$Calls_Attempted += 1;
			}
			if($row_num==3){
				$Not_Qualified += 1;
			}
			if($row_num==4){
				$Scheduled += 1;
			}
			if($row_num==5){
				$Consented += 1;
			}
			if($row_num==6){
				$Randomized += 1;
			}
			if($row_num==7){
				$Action_Needed += 1;
			}
		}
		?>
		<div class="row">
			<section class="container_current">
				<div class="col-xs-12 col-md-6">
					<div class="row">
						<div class="current_study">
							<h4>Current Study Patient Stats</h4>
							<div class="study_background">
								<p id="select_study"><?php echo get_the_author_meta('number_of_sites', $user_ID);?></p>
								<div class="number_site">
									<h5>NUMBER OF SITES:</h5>
									<span><?php echo $total_post; ?></span>
								</div>
								<div class="number_site">
									<h5>REFERRALS:</h5>
									<span><?php echo $referal_totals; ?></span>
								</div>
								<div class="number_site">
									<h5>CONTACTED:</h5>
									<span><?php echo $contacted = $referal_totals-$Patient_Referrals; ?></span>
								</div>
								<div class="number_site">
									<h5>NOT CONTACTED:</h5>
									<span><?php if($Patient_Referrals){echo $Patient_Referrals;}else{echo '0';} ?></span>
								</div>
								<div class="number_site">
									<h5>SCHEDULED:</h5>
									<span><?php if($Scheduled){echo $Scheduled;}else{echo '0';} ?></span>
								</div>
								<div class="number_site">
									<h5>CONSENTED:</h5>
									<span><?php if($Consented){echo $Consented;}else{echo '0';} ?></span>
								</div>
								<div class="number_site">
									<h5>RANDOMIZED:</h5>
									<span><?php if($Randomized){echo $Randomized;}else{echo '0';} ?></span>
								</div>
								<div class="number_site">
									<h5>DNQ:</h5>
									<span><?php if($Not_Qualified){echo $Not_Qualified;}else{echo '0';} ?></span>
								</div>
								<a  class="study_btn" href="<?php echo get_permalink(16673);?>"><img src="<?php bloginfo('template_url');?>/images-dashboard/study_btn.png" alt="" class="img-responsive center-block"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="find_out">
						<h4>Find out How Many PaTients<br>ARE Near Your site:</h4>
					</div>
					<div class="form_right">
						<?php echo do_shortcode( '[contact-form-7 id="7673" title="Find out How Many Patients ARE Near Your site"]' );?>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<script type="application/javascript">
    jQuery( document ).ready(function() {
		jQuery("#select_study").change(function () {
			var id = this.value;
			if(id){
				location.search = "post_id="+id;
			}
		});
	});
</script>
<?php get_footer('dashboard');?>