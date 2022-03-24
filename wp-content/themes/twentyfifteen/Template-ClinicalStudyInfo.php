<?php
/*
 * Template Name: Clinical Study Information Dasboard
 */
?>
<?php
//print_r($_POST);
if (is_user_logged_in()) {
$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);
    $user_roles = implode(', ', $user_info->roles);
} else {
wp_redirect(site_url().'/login/', 301);
exit;
}
?>
<?php
$currdate =date('m/d/Y',strtotime('-4 hours'));
if (is_user_logged_in()) {
    $user_ID = get_current_user_id();
    $user_info = get_userdata($user_ID);
    $user_roles = implode(', ', $user_info->roles);
    session_start();
    $num=$_SESSION['numberstudy'];


    if ($user_roles == "manager_username"){




						$queryArgs = array(
							'post_status' => array('publish', 'draft', 'pending','private'),
							'posts_per_page' => 500,
							'post__not_in' => array(108),
							'meta_query'	=> array(
									array(
											'key'	 	=> 'manager_username',
											'value'	  	=> $user_ID,
											'type'      =>  'NUMERIC',
											'compare' 	=> '=',
									)
							)
						);
						$post_results=query_posts($queryArgs);



				$authors_ids = array();
				if (have_posts()) {
					while (have_posts()) : the_post();
						if($user_roles=='manager_username'){
							   $post_author_id = get_post_field( 'post_author', $post->ID );
								if($post_author_id){
									if($post_author_id > 0){
										$user = get_user_by('id', $post_author_id  );
										if($user->user_login !=""){
											$authors_ids[$post_author_id]=$user->user_login;
										}
									}
								}
						}
						$i++;
						endwhile;
				}
        $meta_value=get_current_user_id();
	$sitename1 = get_user_meta($user_ID , 'name_of_site', true);

		//echo get_the_author_meta('sitename', $meta_value);
		//die;
        $_SESSION['manager_meta']=$meta_value;
        $sqladd=mysql_query("SELECT 0gf1ba_users.user_login,0gf1ba_users.ID FROM 0gf1ba_usermeta INNER JOIN 0gf1ba_users ON 0gf1ba_usermeta.user_id=0gf1ba_users.ID WHERE 0gf1ba_usermeta.meta_value=$meta_value and 0gf1ba_usermeta.meta_key='add_manager_id'");
        //echo "SELECT 0gf1ba_users.user_login,0gf1ba_users.ID FROM 0gf1ba_usermeta INNER JOIN 0gf1ba_users ON 0gf1ba_usermeta.user_id=0gf1ba_users.ID WHERE 0gf1ba_usermeta.meta_value=$meta_value and 0gf1ba_usermeta.meta_key='add_manager_id'";die;

        $num_add_row=mysql_num_rows($sqladd);
        if($num_add_row > 0)
        {
           while($row = mysql_fetch_assoc($sqladd)) {
            $uidds=$row['ID'];
	    $is_site_used=get_user_meta($uidds, 'is_site_used', true);
	    if($is_site_used !='yes'){
		$uns=$row['user_login'];
		$authors_ids[$uidds]=$uns;
	    }


        }

        }

//        echo "<pre>";
//        print_r($_SESSION['authors_ids']);
//         die;
         if(empty($authors_ids)){
             if(($_SERVER['REQUEST_URI']!='/clinical-study-information-dashboard/')&&($_SERVER['REQUEST_URI']!='/clinical-study-information-dashboard')){
                 wp_redirect(site_url().'/dashboard', 301);
             }
         }

         }
}
?>
<?php //echo $user_ID;die;?>
<?php //get_header('dashboard'); ?>
  <?php if ($user_roles == "manager_username"){

        get_header('responsive');?>
      <!--<link rel="stylesheet" href="<?php bloginfo('template_url');?>/combobox/jquery-ui.css">-->
	<script src="<?php bloginfo('template_url');?>/combobox/jquery-1.10.2.js"></script>
	<script src="<?php bloginfo('template_url');?>/combobox/jquery-ui.js"></script>
	<!--<link rel="stylesheet" href="<?php bloginfo('template_url');?>/combobox/style.css">-->
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

<link href="<?php bloginfo('template_url');?>/css/dashboard.css" rel="stylesheet">
<style>
.option_credit{
    display:none;
}
.h2_vid_pop{
    background: #f78e1e none repeat scroll 0 0;
    color: #fff;
    font-family: alternate;
    font-size: 44px;
    margin: 0;
    padding: 5px;
    text-align: center;
    text-decoration: underline;
}
.nav li a {
   margin-right: 13px !important;
    padding: 9px 5px !important;
    font-size: 15px !important;

}
.navbar-nav > li > a{text-transform: none !important;}
.nav > li {

    padding: 0 !important;

}
.nav li a.midsection {
    margin-right: 250px !important;
}

.dashboard_banner {
    background: #fff none repeat scroll 0 0;
    border-radius: 5px 5px 0 0;
    box-shadow: 0 -4px 9px #4a4e45;
    float: left;
    margin: 40px 0 0;
    padding: 30px 0 !important;
    width: 100%;
}
#top {
    display: block;
    margin-bottom: 0;
    position: relative;
}
h1 {
    color: #7e8766;
    font-family: "Helvetica Neue",Helvetica,sans-serif;
    font-size: 4.34em;
    font-weight: 700;
    line-height: 1.6em;
}
#top h1 a {
    display: block;
    height: 110px;
    left: 500px;
    margin: 0;
    padding: 0;
    position: absolute;
    text-indent: -9999px;
    top: -22px;
    width: 140px;
    z-index: 9999;
}
#top h1 img {
    display: block;
    left: 500px;
    margin: 0;
    padding: 0;
    position: absolute;
    text-indent: -9999px;
    top: -22px;
    width: 140px;
    z-index: 9999;
}
.current_heading {
    box-shadow: 0 0 0 !important;
 }
 .ui-button.ui-widget.ui-state-default.ui-button-icon-only.custom-combobox-toggle.ui-corner-right {
    border: 1px solid #d3d3d3;
    border-radius: 0;
    resize: unset;
    width: 17px;
	}

</style>
  <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
<!--    <link href="<?php echo get_template_directory_uri(); ?>/css/slider.css" rel="stylesheet">-->

<!--<link href="<?php bloginfo('template_url');?>/css/dashboard_media.css" rel="stylesheet">-->
         <?php }?>
  <?php if ($user_roles == "editor"){
        get_header('dashboard');

        ?>
		<style>
		.option_credit{
		    display:none;
		}
		.h2_vid_pop{
    background: #f78e1e none repeat scroll 0 0;
    color: #fff;
    font-family: alternate;
    font-size: 44px;
    margin: 0;
    padding: 5px;
    text-align: center;
    text-decoration: underline;
}
		</style>
	<script src="<?php bloginfo('template_url');?>/combobox/jquery-1.10.2.js"></script>
	<script src="<?php bloginfo('template_url');?>/combobox/jquery-ui.js"></script>
        <?php }?>

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


<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/jquery-ui.css">
<!--<script src="<?php //echo get_template_directory_uri();?>/js/jquery-ui.js"></script>
<script src="<?php //echo get_template_directory_uri();?>/js/jquery-1.10.2.js"></script>-->
<style>
	.custom-combobox {
		position: relative;
		display: inline-block;
	}
	.custom-combobox-toggle {
		position: absolute;
		top: 0;
		bottom: 0;
		margin-left: -1px;
		padding: 0;
	}
	.custom-combobox-input {
		margin: 0;
		padding: 5px 10px;
	}
        input.ui-autocomplete-input{
        background-color: #fff;
        border: 0 none;
        box-shadow: 3px 2px 5px #c5c5c5 inset;
        color: #88dd25;
        float: left;
        font: bold 18px Arial,Helvetica,sans-serif !important;
        height: 46px;
        margin: 0px;
        padding-left: 15px;
        width: 473px;
        }
        .ui-autocomplete{
            overflow-x: auto;
            max-height: 300px;
        }
		.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{

			 background:#e6e6e6 url("images/ui-bg_glass_75_e6e6e6_1x4001.png") repeat-x scroll 50% 50% !important;
			 background:white !important;
		}
		.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input {
    border-radius: 0;
}
.ui-button.ui-widget.ui-state-default.ui-button-icon-only.custom-combobox-toggle.ui-corner-right {
    background: rgba(0, 0, 0, 0) linear-gradient(to top, #dadada 0%, #ededed 100%) repeat scroll 0 0 !important;
    border: 1px solid #717171  !important;
}


	</style>
	<script>
	(function( $ ) {
		$.widget( "custom.combobox", {
			_create: function() {
				this.wrapper = $( "<span>" )
					.addClass( "custom-combobox" )
					.insertAfter( this.element );

				this.element.hide();
				this._createAutocomplete();
				this._createShowAllButton();
			},

			_createAutocomplete: function() {
				var selected = this.element.children( ":selected" ),
					value = selected.val() ? selected.text() : "";

				this.input = $( "<input>" )
					.appendTo( this.wrapper )
					.val( value )
					.attr( "title", "" )
					.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: $.proxy( this, "_source" )
					})
					.tooltip({
						tooltipClass: "ui-state-highlight"
					});

				this._on( this.input, {
					autocompleteselect: function( event, ui ) {
						ui.item.option.selected = true;
						this._trigger( "select", event, {
							item: ui.item.option
						});
					},

					autocompletechange: "_removeIfInvalid"
				});
			},

			_createShowAllButton: function() {
				var input = this.input,
					wasOpen = false;

				$( "<a>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "" )
					.tooltip()
					.appendTo( this.wrapper )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "custom-combobox-toggle ui-corner-right " )
					.mousedown(function() {
						wasOpen = input.autocomplete( "widget" ).is( ":visible" );
					})
					.click(function() {
						input.focus();

						// Close if already visible
						if ( wasOpen ) {
							return;
						}

						// Pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
					});
			},

			_source: function( request, response ) {
				var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
				response( this.element.children( "option" ).map(function() {
					var text = $( this ).text();
					if ( this.value && ( !request.term || matcher.test(text) ) )
						return {
							label: text,
							value: text,
							option: this
						};
				}) );
			},

			_removeIfInvalid: function( event, ui ) {

				// Selected an item, nothing to do
				if ( ui.item ) {
					return;
				}

				// Search for a match (case-insensitive)
				var value = this.input.val(),
					valueLowerCase = value.toLowerCase(),
					valid = false;
				this.element.children( "option" ).each(function() {
					if ( $( this ).text().toLowerCase() === valueLowerCase ) {
						this.selected = valid = true;
						return false;
					}
				});

				// Found a match, nothing to do
				if ( valid ) {
					return;
				}

				// Remove invalid value
				this.input
					.val( "" )
					.attr( "title", value + " didn't match any item" )
					.tooltip( "open" );
				this.element.val( "" );
				this._delay(function() {
					this.input.tooltip( "close" ).attr( "title", "" );
				}, 2500 );
				this.input.autocomplete( "instance" ).term = "";
			},

			_destroy: function() {
				this.wrapper.remove();
				this.element.show();
			}
		});
	})( jQuery );

	</script>
<div id="banner_login">
  <div class="container">
       <div id="dialog-confirm" style="display:none; padding: 0px; text-align: center;"></div>
       <?php if ($user_roles == "editor"){?>
           <div class="row">
            <?php get_header("client-submenu");?>
           </div>
      <?php }?>
                 <?php if ($user_roles == "manager_username"){?>
                     <div class="row">
                         <?php get_header("manager-submenu");?>
                     </div>
                 <?php }?>
    <div class="row">
      <section class="container_current">
        <div class="col-12 col-md-12" style="padding-left:10px !important;padding-top:10px !important;">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header"> </div>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="row">

			<div style="width: 100%; text-align: left; margin-left: 31px;margin-top: 6px;"><a href="javascript:void(0);" onclick="document.getElementById('embed16').style.display='block';document.getElementById('fade').style.display='block'" class="questionchange_view" style="color: red;"><img src="<?php echo get_template_directory_uri(); ?>/images/watch-tutorial-button.png"></a></div>
              <div class="current_heading">
                <h4>Clinical Study Information </h4>
              </div>
            </div>
          </div>
          </nav>
          </nav>
          <div id="data2"></div>
          <div id="data">
            <div class="scroll-area" data-spy="scroll" data-target="#myNavbar" data-offset="0">
              <div class="inner-form">
                <?php the_content(); ?>
                <?php
                                    if (isset($_REQUEST['show_hide_input2'])) {
                                    $number_of_studies = $_REQUEST['number_of_studies'];
                                    ?>
                <form id="contactform" enctype="multipart/form-data" method="post">
                  <div class="fisrt_step" id="third_step">
                    <h2 style="background:#f78f1e;color: #fff; text-transform: uppercase; margin: 15px 0; padding: 5px; float:left; width:100%;">Enter Study Details</h2>
                    <div class="inner_cont" id="third_step_cont">
                      <input type="hidden" name="total_entries" value="<?php echo $number_of_studies; ?>" />
                      <?php
                                                    for ($x = 1; $x <= $number_of_studies; $x++) {
                                                        ?>
                      <script type="text/javascript">
                                                        $(function () {
                                                            $("#datepicker<?php echo $x; ?>").datepicker();
                                                        });
                                                        $(function() {
                                                                $( "#combobox<?php echo $x; ?>" ).combobox({

                                                                    select: function( event, ui ) {
                                                                        var selected_idd=ui.item.value;
                                                                          var site_name=jQuery('#combobox<?php echo $x; ?>').val();
                                                        jQuery.ajax({
                                                        url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                                                        type: 'POST',
                                                        data: "action=dashboard_site_name&uname="+selected_idd,
                                                        success: function(html){
                                                                            jQuery('#sitenamemeta_<?php echo $x; ?>').val(html);
                                                                        }
                                                        })
                                                        jQuery.ajax({
                                                        url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                                                        type: 'POST',
                                                        data: "action=dashboard_study_address&uname="+selected_idd,
                                                        success: function(html){
                                                                            jQuery('#addressmeta_<?php echo $x; ?>').val(html);
                                                                        }
                                                        })

                                                                    }
                                                                }
                                                                        );

                                                        });
                                                        function addNew<?php echo $x; ?>(asa) {
                                                            var addDiv<?php echo $x; ?> = $('#addinput<?php echo $x; ?>');
                                                            var i = $('#addinput<?php echo $x; ?> p').size() + 1;
                                                            if (i == 5) {
                                                                $(".addd_new<?php echo $x; ?>").hide();
                                                            } else {
                                                                $(".addd_new<?php echo $x; ?>").show();
                                                            }
                                                            $('<p><label>Recruitment Email #' + i + ': </label><span class="wpcf7-form-control-wrap email-577"><input style="margin-bottom:0px;" type="email"  aria-required="true" size="40" value="" name="contactemail' + i + '<?php echo $x; ?>"><a style="position: absolute; top: 52px; right: -20px;" href="javascript:void();" onClick="return aaaaa<?php echo $x; ?>(this);" id="remNew"><img style="width: 12px;"  src="<?php bloginfo('template_url'); ?>/images-dashboard/delete_icon.png" /></a></span></p>').appendTo(addDiv<?php echo $x; ?>);
                                                            i++;
                                                            return false;
                                                        }
                                                        function aaaaa<?php echo $x; ?>(el) {
                                                            $(el).parents('p').remove();
                                                            var i = $('#addinput<?php echo $x; ?> p').size() - 1;
                                                            if (i == 5) {
                                                                $(".addd_new<?php echo $x; ?>").hide();
                                                            } else {
                                                                $(".addd_new<?php echo $x; ?>").show();
                                                            }
                                                            $('#addinput<?php echo $x; ?> p:nth-child(1) label').html("Recruitment Email #1:");
                                                            $('#addinput<?php echo $x; ?> p:nth-child(2) label').html("Recruitment Email #2:");
                                                            $('#addinput<?php echo $x; ?> p:nth-child(3) label').html("Recruitment Email #3:");
                                                            $('#addinput<?php echo $x; ?> p:nth-child(4) label').html("Recruitment Email #4:");
                                                            $('#addinput<?php echo $x; ?> p:nth-child(5) label').html("Recruitment Email #5:");
                                                            return false;
                                                        }


                                                    </script>
                      <div class="study<?php echo $x; ?> study" >
                        <h2 style="background: #00afef; float:left; width:100%; color: #fff; font-size: 20px;margin: 0 0 10px;padding: 9px; text-transform: uppercase;">Study #<?php echo $x; ?></h2>
                                  <?php
                                   if ($user_roles == "manager_username"){ ?>
                        <p>
                          <label>Select Site *<br>
                          </label>
                          <span class="wpcf7-form-control-wrap">
                              <div class="ui-widget">
                          <select class="required" aria-required="true" name="client_user<?php echo $x; ?>" id="combobox<?php echo $x; ?>">

                            <?php
                            $options="";

							natcasesort($authors_ids);
							 $fr_user_id=0;
							 $cnu=1;
                            foreach($authors_ids as $in=>$auth){
								if($cnu==1){
									$fr_user_id=$in;
								}
                                echo '<option value="'.$in.'">'.$auth.'</option>';
								$cnu++;
                            }

                            ?>

                          </select>
                                  </div>
<!--                              <input class="required" aria-required="true"  type="text" size="40"  name="client_user<?php echo $x; ?>" id="clientmeta" placeholder="Make a Selection">-->
                                   </span>
                        <div id="suggesstion-box"></div>
                        </p> <?php } ?>
                          <p>
                              <label>Exposure Level * </label>
                          <span class="wpcf7-form-control-wrap">
                          <select class="form-control exposure-level-select required" aria-required="true" name="boost_type<?php echo $x; ?>">
                              <option value="">Make a Selection</option>
                              <?php
                              $args 	= array(
                                  'orderby' => 'product_position',
                                  'order' => 'ASC',
                                  'post_status' => 'publish',
                                  'post_type' => 'studykik-products',
                                  'posts_per_page'   => -1
                              );

                              $products 	= get_posts( $args );
                              for($i = 0; $i < count($products) - 1; $i ++) {
                                  for ($j = $i + 1; $j < count($products); $j ++) {
                                      $product_position_i = get_field('product_position', $products[$i]->ID);
                                      $product_position_j = get_field('product_position', $products[$j]->ID);
                                      if ($product_position_i > $product_position_j) {
                                          $temp = $products[$i];
                                          $products[$i] = $products[$j];
                                          $products[$j] = $temp;

                                      }
                                  }
                              }
                              foreach($products AS $product){
                                  if (stripos($product->post_title, " Listing") !== false) {
                                      $product_price    = (float)get_field('product_price', $product->ID);
                                      $product_image    = get_field('product_icon', $product->ID);
                                      $product_position = get_field('product_position', $product->ID);
                                      $product_title_parts = explode(" ", $product->post_title);
                                      setlocale(LC_MONETARY, 'en_US');

                              ?>
                                      <option value="<?= $product->ID?>" data-price="<?= $product_price?>"><?= $product_title_parts[0]?>: $<?php echo $product_price ?></option>
                              <?php
                                  }
                              }
                              ?>
<!--                              <option value="Platinum">Platinum: $1559</option>-->
<!--                              <option value="Gold">Gold: $559</option>-->
<!--                              <option value="Silver">Silver: $209</option>-->
<!--                              <option value="Bronze">Bronze: $59</option>-->
                          </select>
                          </span> </p>

                          <div style="line-height: 24px; display: table-cell;"><p><label >Add Patient Messaging<br />
                              Suite ($247)</label></p></div>
                          <div class="play_video_bttn_wrap"><div class="play_video_bttn" onclick="showVideo()"></div></div>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input class="form-control message_suite_247" style="width:auto;" type="checkbox" name="message_suite_247<?php echo $x; ?>"/>
                          <span style="color: #00afef;line-height: 25px;margin-left: 10px;font-weight: bold;">Yes</span> </span></p>
                          <p>
                              <label style="line-height: 24px;">Condense to 2 <br />
                                  Weeks (Free)</label>
                          <span class="wpcf7-form-control-wrap">
                          <input class="form-control " style="width:auto;" type="checkbox" name="condense_2_weeks<?php echo $x; ?>" />
                          <span style="color: #00afef;line-height: 25px;margin-left: 10px;font-weight: bold;">Yes</span> </span> </p>
                        <p>
                          <label>Study Type *<br>
                          </label>
                          <span class="wpcf7-form-control-wrap">
                          <select class="form-control required" aria-required="true" name="studytype<?php echo $x; ?>" id="studymeta">
                            <option value="">Make a Selection</option>
                            <?php
                                                                             $args = array(
                                                                            'orderby' => 'name',
                                                                            'parent' => 6,
                                                                            'hide_empty' => 0,
                                                                            'order' => 'ASC'
                                                                        );
                                                                        $categories = get_categories($args);
                                                                        foreach ($categories as $category) {
                                                                         ?>
                            <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                            <?php } ?>
                            <option value="Other Study Type">Other Study Type</option>
                          </select>
                          </span> </p>

                        <p>
                          <label>Site Name * </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
			<?php
			$sitename=$fr_user_id;

			$sqlsite=mysql_query("SELECT * FROM 0gf1ba_users INNER JOIN 0gf1ba_usermeta ON 0gf1ba_users.ID=0gf1ba_usermeta.user_id WHERE 0gf1ba_users.ID='$sitename' and 0gf1ba_usermeta.meta_key='sitename';");
 while($row = mysql_fetch_assoc($sqlsite)) {
             //print_r($row);
                $metavalue=$row["meta_value"];

            }?>
                          <input class="form-control required" aria-required="true"  type="text" size="40" value="<?php echo $metavalue;?>" name="sitename<?php echo $x; ?>" id="sitenamemeta_<?php echo $x; ?>">
                          </span></p>
                        <p>
						<?php
						$sqlsite=mysql_query("SELECT * FROM 0gf1ba_users INNER JOIN 0gf1ba_usermeta ON 0gf1ba_users.ID=0gf1ba_usermeta.user_id WHERE 0gf1ba_users.ID='$sitename' and 0gf1ba_usermeta.meta_key='address';");
 while($row = mysql_fetch_assoc($sqlsite)) {
             //print_r($row);
                $metavalue=$row["meta_value"];

            }
						?>
                          <label>Study Address * </label>
                          <span class="wpcf7-form-control-wrap text-848">
                          <input class="form-control required" aria-required="true"  type="text" size="40" value="<?php echo $metavalue ; ?>" name="studylocation<?php echo $x; ?>" id="addressmeta_<?php echo $x; ?>">
                          </span></p>
                        <p>
                          <label>Study Details </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <textarea  class="form-control " aria-required="true"  rows="6" cols="50" name="studydetails<?php echo $x; ?>"></textarea>
                          </span></p>
                        <p>
                          <label>Protocol Number * </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input aria-required="true" class="form-control required" type="text" size="40" value="" name="protocolnumber<?php echo $x; ?>" >
                          </span></p>
                        <p>
                        <p>
                          <label>Sponsor Name * </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input class="form-control required"  aria-required="true"  type="text" size="40" value="" name="sponsorname<?php echo $x; ?>" >
                          </span></p>
                        <p>
                        <p>
                          <label>Sponsor Email </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input class="form-control " aria-required="true"  type="text" size="40" value="" name="sponsoremail<?php echo $x; ?>" >
                          </span></p>
                        <p>
                            <label>CRO Name </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input class="form-control " type="text" size="40" value="" name="croname<?php echo $x; ?>" >
                        </span>
                        </p>
                        <p>
                            <label>CRO Email </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input  type="text" size="40" value="" name="croemail<?php echo $x; ?>" >
                        </span>
                        </p>
                     	<div id="addpicker<?php echo $x; ?>">
                            <p>
                            <p>
                                <label>IRB Name </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input class="form-control " type="text" size="40" value="" name="irbname<?php echo $x; ?>" >
                        </span>
                            </p>
                            <p>
                                <label>IRB Email </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input  type="text" size="40" value="" name="irbemail<?php echo $x; ?>" >
                        </span>
                            </p>
                            <div id="addpicker<?php echo $x; ?>">
                                <p>
                                <label>Start Date * </label>
                                <span class="wpcf7-form-control-wrap textarea-350">
                                <input class="form-control required" id="datepicker<?php echo $x; ?>"  aria-required="true"  type="text" size="40" value="<?php echo date('m/d/Y');?>" name="startdate<?php echo $x; ?>" >
                                </span>
                            </p>
                        </div>
                          <p class="addd_new<?php echo $x; ?>"><label></label>  <span class="wpcf7-form-control-wrap text-426"><a class="determine_start" unique_id="<?php echo $x; ?>" style="float: left; display: block; font-size: 16px; font-weight: bold; margin-bottom: 6px;margin-top: -6px;" href="javascript:void(0);">To be determined</a></span></p>
                        <p>
                          <label>Recruitment Phone * </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input class="form-control required" aria-required="true"  type="text" size="40" value="" name="contactphone<?php echo $x; ?>" >
                          </span></p>
                        <div id="addinput<?php echo $x; ?>">
                          <p>
                            <label>Recruitment Email #1 * </label>
                            <span class="wpcf7-form-control-wrap text-426">
                            <input class="required" style="margin-bottom:0px;" type="email"  aria-required="true"  size="40" value="" name="contactname<?php echo $x; ?>">
                            </span> </p>
                        </div>
                        <p class="addd_new<?php echo $x; ?>">
                          <label></label>
                          <span class="wpcf7-form-control-wrap text-426"><a style="float: left; display: block; font-size: 16px; font-weight: bold; margin: 7px 0px;" onclick="return addNew<?php echo $x; ?>(this);" href="javascript:void();">Add another recruitment email</a></span></p>
                        <p>
                          <label>Study Website </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input aria-required="true"  type="text" size="40" value="" name="study_website<?php echo $x; ?>" >
                          </span></p>


                        <p>
                          <label style="line-height: 24px;">Upload Study Ad <br />
                            (not required)</label>
                          <span class="wpcf7-form-control-wrap your-file">
                          <input type="file" class="form-control attachment" size="40" name="attachment<?php echo $x; ?>">
                          </span></p>


			<div style="clear:both;"></div>

                        <p>
                          <label>Notes </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <textarea class="form-control " aria-required="true"  rows="6" cols="50" name="notes<?php echo $x; ?>"></textarea>
                          </span></p>
                      </div>
                      <input type="hidden" value="total_studies<?php echo $x; ?>" name="total_studies<?php echo $x; ?>" />
                      <?php } ?>
                      <div>
                          <p>
                              <label>Coupon </label>
                                <span class="wpcf7-form-control-wrap textarea-350">
                                    <input class="form-control " id="study_coupon" aria-required="true"  type="text" size="40" value="" name="coupon" >
                                </span>
                          </p>
                          <div id="couponInfo" style="color: red; padding-bottom: 10px; text-align: right;"></div>
                      </div>

                      <?php
                      $ecommerce_enabled = get_option('ecommerce_enabled');
                      $is_check_allowed = get_user_meta($user_ID, 'allow_check', true);
                      if((bool) $ecommerce_enabled){
                          ?>
                          <p>
                              <label>Select Credit Card * </label>
                                <span class="wpcf7-form-control-wrap">
                                    <select class="form-control required choose_credit" aria-required="true" name="creditcard" unique_credit="">
                                        <option value="">Select Credit Card</option>
                                        <?php
                                        $user_ID = get_current_user_id();
                                        // seedcms
                                        // find payment profiles
                                        $searchARR_1  = array('key'=>'payment_user_id','value'=>$user_ID,'compare'=>'=');
                                        //$searchARR_2  = array('key'=>'schedule_date','value'=>strftime('%Y%m%d', $date_unix),'compare'=>'=');

                                        $searchARR    = array(
                                            $searchARR_1
                                            //$searchARR_2
                                        );

                                        $args = array(
                                            'posts_per_page'   => -1,
                                            'offset'           => 0,
                                            'category'         => '',
                                            'category_name'    => '',
                                            'include'          => '',
                                            'exclude'          => '',
                                            'meta_value'       => '',
                                            'meta_query'       => array($searchARR),
                                            'post_type'        => 'studykik-payments',
                                            'post_mime_type'   => '',
                                            'post_parent'      => '',
                                            'post_status'      => 'publish',
                                            'suppress_filters' => true,
                                            'meta_key'			   => 'payment_user_id',
                                            'orderby'			     => '',
                                            'order'				     => 'ASC'
                                        );
                                        $cards = get_posts( $args );
                                        if(!empty($cards)){
                                            foreach($cards AS $card){

                                                $auth_profile_id        = get_post_meta($card->ID, 'auth_profile_id', true);
                                                $auth_payment_profile   = get_post_meta($card->ID, 'auth_payment_profile', true);
                                                $auth_shipping_profile  = get_post_meta($card->ID, 'auth_shipping_profile', true);
                                                $payment_user_id        = get_post_meta($card->ID, 'payment_user_id', true);
                                                $auth_credit_card       = get_post_meta($card->ID, 'auth_credit_card', true);
                                                $auth_card_code         = get_post_meta($card->ID, 'auth_card_code', true);


                                                if($auth_profile_id && $auth_payment_profile){
                                                    echo '<option value="'.$auth_credit_card.'" data-credit-card-id="'.$card->ID.'" data-cvv="'.$auth_card_code.'" data-shipping-id="'.$auth_shipping_profile.'" data-profile-id="'.$auth_profile_id.'" data-payment-id="'.$auth_payment_profile.'">xxxx xxxx xxxx '.$auth_credit_card.'</option>';
                                                }

                                            }
                                        }
                                        // loop cards here
                                        ?>
                                        <option value="Add new Card">Add Credit card</option>
                                        <?php if((bool) $is_check_allowed){ ?><option value="Check">Pay by Check</option><?php } ?>
                                    </select>
                                </span>
                          </p>
                      <?php }else{ ?>
                          <p>
                              <label>Credit Card (Last 4 Digits) * </label>
                                <span class="wpcf7-form-control-wrap textarea-350">
                                    <input class="form-control required" aria-required="true"  type="text" size="40" value="" name="creditcard" >
                                </span>
                          </p>
                      <?php } ?>
                      <?php if((bool) $ecommerce_enabled){ ?>

                          <div class="col-md-4 col-sm-4 col-xs-12 name_first spac">
                              <p class="option_credit loop_credit_">
                                  <label>First Name * </label>
			<span class="wpcf7-form-control-wrap text-426">
			<input type="text" class="form-control new-card-field required" aria-required="true" value="" name="firstname">
			</span></p>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12 name_first">
                              <p class="option_credit loop_credit_">
                                  <label>Last Name * </label>
			<span class="wpcf7-form-control-wrap text-426">
			<input type="text" class="form-control new-card-field required" aria-required="true" value="" name="lastname">
			</span></p>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12 name_first spacright">
                              <p class="option_credit loop_credit_">
                                  <label>Company * </label>
			<span class="wpcf7-form-control-wrap text-426">
			<input type="text" class="form-control new-card-field required" aria-required="true" value="" name="company">
			</span></p>
                          </div>
                      <div class="col-md-8 col-sm-8 col-xs-12 name_first spac spacright">
                          <p class="option_credit loop_credit_">
                              <label>Card Number * </label>
			<span class="wpcf7-form-control-wrap text-426">
			<input class="form-control new-card-field required" type="text" value="" name="cc_number" autocomplete="false">
			</span></p>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12 name_first spaccvc">
                              <p class="option_credit loop_credit_">
                                  <label>CVC </label>
			<span class="wpcf7-form-control-wrap text-426">
			<input type="text" class="form-control new-card-field" value="" name="cc_cvv2" autocomplete="false">
			</span></p>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12 name_first spac">
                              <p class="option_credit loop_credit_">
                                  <label>Expiration Month * </label>
			<span class="wpcf7-form-control-wrap text-426">
			<select class="form-control drop_btn new-card-field required" name="cc_exp_month">
                <option value="">Choose Month</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
			</span></p>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12 name_first spacright">
                              <p class="option_credit loop_credit_">
                                  <label>Expiration Year * </label>
			<span class="wpcf7-form-control-wrap text-426">
			<select class="form-control drop_btn new-card-field required" name="cc_exp_year">
                <option value="">Choose Year</option>
                <?php
                $year = date('Y');
                $year_end = $year + 10;

                while($year <= $year_end){
                    echo '<option value="'.$year.'">'.$year.'</option>';
                    $year ++;
                }
                ?>
            </select>
			</span></p>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12 name_first spacright ">
                              <p class="option_credit loop_credit_">
                                  <label>Billing Zip * </label>
			<span class="wpcf7-form-control-wrap text-426">
			<input type="text" class="form-control new-card-field required" value="" name="zip">
			</span></p>
                          </div>

                      <?php } ?>
                      <p>

                        <label></label>
                          <input type="hidden" name="amount" id="amount" />
                          <input type="hidden" name="action" value="go_order">
                          <input type="hidden" name="transaction_id" id="transaction_id" />
                          <input type="hidden" name="order_id" id="order_id" />
                          <input type="hidden" name="invoice_number" id="invoice_number" />
                          <input type="hidden" name="user_id" value="<?php echo get_current_user_id();?>" />
                          <input  name="payment_credit_card_id" id="payment_credit_card_id" type="hidden" value="" />
                          <input  name="payment_by_check" id="payment_by_check" type="hidden" value="" />
                          <input  name="payment_profile_id" id="payment_profile_id" type="hidden" value="" />
                          <input  name="payment_payment_id" id="payment_payment_id" type="hidden" value="" />
                          <input  name="payment_shipping_id" id="payment_shipping_id" type="hidden" value="" />
                          <input  name="payment_card_code" id="payment_card_code" type="hidden" value="" />
                        <input type="submit" class="show_hide_input" id="show_hide_input" name="show_hide_input" value="List My Studies">

                      </p>
                    </div>

                  </div>

                  <div class="col-md-12 col-xs-12 payment-processing" style="text-align: center;">
                  </div>
                </form>
                <?php } else { ?>
                <form class="add_Study" action="" method="post">
                  <p>
                    <label>Number of studies </label>
                    <select name="number_of_studies">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                    </select>
                    <input type="submit" class="show_hide_input" name="show_hide_input2" value="Add">
                  </p>
                </form>
                <?php } ?>
                <?php
                                //$query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` ORDER BY `id` DESC LIMIT 1");

//			foreach($query_invoice_number as $query_invoice_number_value){
//			  $invoice_num = $query_invoice_number_value->invoice_number;
//			}
                $invoice_num = $wpdb->get_var( "SELECT max(invoice_number) FROM `0gf1ba_invoice_number`");
			$inc_nummm=$invoice_num;

			           if (isset($_REQUEST['action']) && $_REQUEST['action'] == "go_order") {
                           addToPaymentLog('form submit. request = '.serialize($_REQUEST), $user_ID);
                           if (!($_REQUEST['payment_by_check'])){
                               if (isset($_REQUEST['transaction_id']) && $_REQUEST['transaction_id']){
                                   addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 1', $user_ID);
                                   include(ABSPATH.'_authorize/anet_php_sdk/AuthorizeNet.php');
                                   addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) lib path = '.ABSPATH.'_authorize/anet_php_sdk/AuthorizeNet.php', $user_ID);
                                   $ecommerce_user_production = get_option("ecommerce_user_production");
                                   addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) ecommerce_user_production = '.$ecommerce_user_production, $user_ID);
                                   if ((bool)$ecommerce_user_production) {
                                       $auth_login = '5R38Kya2Sq';
                                       $auth_key = '4FRp7YUb4Fq836zQ';
                                       define("AUTHORIZENET_SANDBOX", false);
                                   } else {
                                       $auth_login = '75sFujS9F4u6';
                                       $auth_key = '9gzzEV895FY8q6cm';
                                       define("AUTHORIZENET_SANDBOX", true);
                                   }
                                   define("AUTHORIZENET_API_LOGIN_ID", $auth_login);
                                   define("AUTHORIZENET_TRANSACTION_KEY", $auth_key);
                                   $request = new AuthorizeNetTD;
                                   addToPaymentLog('transaction id = '.$_REQUEST['transaction_id'], $user_ID);

                                   $response = null;
                                   $attempt = 0;
                                   while ($attempt <= 3 && (!$response || !$response->xml ||  !$response->isOk())){
                                       if ($attempt > 0){
                                           sleep(5);
                                       }
                                       $attempt++;
                                       $response = $request->getTransactionDetails($_REQUEST['transaction_id']);

                                       ob_start();
                                       var_dump($response);
                                       $response_for_log = ob_get_clean();
                                       addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) response = '.($response_for_log).' attempt = '.$attempt, $user_ID);
                                   }

                                   addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 2', $user_ID);
                                   addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) response is OK = '.($response->isOk()).' attempt = '.$attempt, $user_ID);
                                   if (($response != null) && ($response->isOk()))
                                   {
                                       addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 3', $user_ID);
                                       addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) transaction amount = '.floatval($response->xml->transaction->settleAmount), $user_ID);
                                       addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) request amount = '.floatval($_REQUEST['amount']), $user_ID);
                                       /*if (floatval($response->xml->transaction->settleAmount) != floatval($_REQUEST['amount'])){
                                           addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 4', $user_ID);
                                           echo 'Transaction amount differs from settled amount';die;
                                       }*/
                                   }
                                   else
                                   {
                                       addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 5', $user_ID);
                                       echo $response->getErrorMessage();die;
                                   }
                               }else if (!$_REQUEST['coupon']){
                                   addToPaymentLog('submit progress 6', $user_ID);
                                   echo 'Transaction ID value is invalid';die;
                               }
                           }
                           addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 7', $user_ID);
                           $user_id                     = $user_ID;
                           $current_user                = wp_get_current_user();
                           $current_user_email          = $current_user->user_email;
                           $fullname                    = $current_user->user_firstname;
                           $first_name                  = get_user_meta($user_id, "first_name", true);
                           $last_name                   = get_user_meta($user_id, "last_name", true);
                           $company                     = $_REQUEST['company'] ? $_REQUEST['company'] : get_user_meta($user_id, "sitename", true);
                           $total_entries               = $_REQUEST['total_entries'];
                           $order_id                    = $_REQUEST['order_id'];
                           $coupon                      = $_REQUEST['coupon'];

                           $card_id                     = $_REQUEST['payment_credit_card_id'];
                           $auth_card_type              = get_post_meta($card_id, 'auth_card_type', true);
                           $auth_credit_card            = get_post_meta($card_id, 'auth_credit_card', true);
                           $card_billing_first_name     = get_post_meta($card_id, 'card_billing_first_name', true);
                           $card_billing_last_name      = get_post_meta($card_id, 'card_billing_last_name', true);
                           $card_billing_zip            = get_post_meta($card_id, 'card_billing_zip', true);
                           $card_billing_company        = get_post_meta($card_id, 'card_billing_company', true);
                           $study_arr = array();
                           if (!$card_billing_company) {
                               $card_billing_company = $company;
                           }

                           $product_arr = array();

                                   $coupon = $_REQUEST['coupon'];
                                   $c_discount = 0;
                                    if ( $_REQUEST['creditcard'] == "Add new Card" ) {
                                        $creditcard = substr($_REQUEST['cc_number'], -4);
                                    } else if ($_REQUEST['creditcard'] == "Check"){
                                        $creditcard = "";
                                    } else {
                                        $creditcard = $_REQUEST['creditcard'];
                                    }
                                   $total_entries = $_REQUEST['total_entries'];

                                   //            print_r($avg_discount);
                                   $discount_price_arr = array();
                                   $price_arr = array();
                                   $discount_arr = array();

                                   $total_amount = 0;
                           $boost_type_arr = array();
                           addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 8', $user_ID);
                                   for ($i = 1; $i <= $total_entries; $i ++) {
                                       $product = get_post($_REQUEST['boost_type'.$i]);
                                       $product_title = $product->post_title;
                                       $product_title_parts = explode(" ", $product_title);
                                       $product_price    = get_field('product_price', $product->ID);
                                       $points    = get_field('points', $product->ID);
                                       $boost_type_arr[] = array(
                                           "type" => $product_title_parts[0],
                                           "price" => (float)$product_price,
                                           "points" => $points
                                       );


                                       $price_arr[$i - 1] = $product_price;
                                       if ($product_arr[$product_title]) {
                                           $product_arr[$product_title]['qty'] = $product_arr[$product_title]['qty'] + 1;
                                       } else {
                                           $product_arr[$product_title] = array("title" => $product_title , "price" => $product_price, "qty" => 1);
                                       }



                                       if ($_REQUEST['message_suite_247' . $i] == true) {
                                           if ($product_arr["Messaging Suite"]) {
                                               $product_arr["Messaging Suite"]["qty"] = $product_arr["Messaging Suite"]["qty"] + 1;
                                           } else {
                                               $product_arr["Messaging Suite"] = array("title" => "Messaging Suite" , "price" => 247, "qty" => 1);
                                           }
                                       }
                                       $total_amount += $price_arr[$i - 1];

                                   }

                           addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 9', $user_ID);
                                   if($coupon){
                                       $coupon_data = get_coupon($coupon);
                                       $discount         = get_coupon($coupon);

                                       if ($discount['type'] == "percent") {
                                           $percent  = (float) $discount['value'];
                                           $c_discount   = ($total_amount / 100) * $percent;
                                       } else if ($discount['type'] == "fixed") {
                                           $old_price        = (float) $amount;
                                           $c_discount   = (float) $discount['value'];
                                       }

                                   }
                                    $avg_discount = $c_discount / $total_entries;

                                   for ($i = 1; $i <= $total_entries; $i ++) {

                                       $discount_price_arr[$i - 1] = $price_arr[$i - 1] - $avg_discount;
                                   }
        //            print_r($discount_price_arr);
                                   $should_continue = true;
                                   $is_possible = false;
                                   $minus_value = 0;
                                   while($should_continue) {
                                       $should_continue = false;
                                       $is_possible = false;
                                       for ($i = 0; $i < $total_entries; $i ++) {
                                           if ($discount_price_arr[$i] < 0) {
                                               $minus_value += $discount_price_arr[$i];
                                               $discount_price_arr[$i] = 0;
                                               $should_continue = true;
                                           } else if($discount_price_arr[$i] > 0) {
                                               $discount_price_arr[$i] = $discount_price_arr[$i] + $minus_value;
                                               $minus_value = 0;
                                               if ($discount_price_arr[$i] < 0) {
                                                   $minus_value += $discount_price_arr[$i];
                                                   $discount_price_arr[$i] = 0;
                                                   $should_continue = true;
                                               }
                                           }
                                       }
                                       if ($is_possible) {
                                           $should_continue = true;
                                       }
                                   }
                           addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 10', $user_ID);
                                   for ($i = 0; $i < $total_entries; $i ++) {
                                       $discount_arr[$i] = $price_arr[$i] - $discount_price_arr[$i];
                                   }

//                           print_r($product_arr);
//                           print_r($discount_arr);
//                           print_r($discount_price_arr);
//                           exit;
                                    for ($y = 1; $y <= $total_entries; $y++) {

										$final_num =  $inc_nummm+1;
										$inc_nummm=$inc_nummm+1;
                                        $studytype = stripslashes($_REQUEST['studytype' . $y]);
                                        $sitename = stripslashes($_REQUEST['sitename' . $y]);
                                        $studylocation = stripslashes($_REQUEST['studylocation' . $y]);
                                        $studynote = stripslashes($_REQUEST['studynote' . $y]);
                                        $studydetails = stripslashes($_REQUEST['studydetails' . $y]);
                                        $protocolnumber = stripslashes($_REQUEST['protocolnumber' . $y]);
                                        $startdate = stripslashes($_REQUEST['startdate' . $y]);
                                        $notes = stripslashes($_REQUEST['notes' . $y]);
                                        $contactname = stripslashes($_REQUEST['contactname' . $y]);
                                        $contactemail = stripslashes($_REQUEST['contactemail2' . $y]);
                                        $contactemail2 = stripslashes($_REQUEST['contactemail3' . $y]);
                                        $contactemail3 = stripslashes($_REQUEST['contactemail4' . $y]);
                                        $contactemail4 = stripslashes($_REQUEST['contactemail5' . $y]);
                                        $contactphone = stripslashes($_REQUEST['contactphone' . $y]);
                                        $study_website = stripslashes($_REQUEST['study_website' . $y]);
                                        $boost_type1 = $boost_type_arr[$y - 1]['type'];
                                        $sponsorname = stripslashes($_REQUEST['sponsorname' . $y]);
                                        $sponsoremail = stripslashes($_REQUEST['sponsoremail' . $y]);
                                        $croname = stripslashes($_REQUEST['croname'.$y]);
                                        $croemail = stripslashes($_REQUEST['croemail'.$y]);
                                        $irbname = stripslashes($_REQUEST['irbname'.$y]);
                                        $irbemail = stripslashes($_REQUEST['irbemail'.$y]);


                                        $coupon_discount = $discount_arr[$y - 1];

                                        $price2 = $boost_type_arr[$y - 1]['price'];
                                        $boost_type_pr1 = $boost_type1 . " $" . $price2;
                                        $price = '$'.str_replace('USD ','',money_format('%i', $price2));

                                        $message_suite_247 = $_REQUEST['message_suite_247' . $y];
                                        if ($message_suite_247 == true) {
                                            $message_suite_247 = "Yes";
                                            $message_suite = "$247.00";
                                            $message_suite2 = "247.00";
                                        } else {
                                            $message_suite_247 = "No";
                                            $message_suite = " ";
                                            $message_suite2 = " ";
                                        }
                                        $condense_2_weeks = $_REQUEST['condense_2_weeks' . $y];
                                        if ($condense_2_weeks == true) {
                                            $condense_2_weeks = "Yes";
                                            $end_date = "15 days";
                                            if($startdate != 'To be determined'){
                                                $newDate = date("m/d/Y", strtotime($startdate . " +15 day"));
                                                $wpFormatNewDate = date("Ymd", strtotime($startdate . " +15 day"));
                                                $condense = true;
                                            }else{
                                                $newDate = 'To be determined';
                                            }
                                        } else {
                                            $condense_2_weeks = "No";
                                            $end_date = "30 days";
                                            if($startdate != 'To be determined'){
                                                $newDate = date("m/d/Y", strtotime($startdate . " +30 day"));
                                                $wpFormatNewDate = date("Ymd", strtotime($startdate . " +30 day"));
                                                $condense = false;
                                            }else{
                                                $newDate = 'To be determined';
                                            }
                                        }
                                        $sub_total = $price2 + $message_suite2;
                                        $sub_price = $sub_total - $coupon_discount;
                                        //setlocale(LC_MONETARY, "en_US");
                                        $sub_price = number_format( $sub_price ,  2 ,  '.' ,  ',' );
                                        //$total_price = str_ireplace("USD", "$", $sub_price);
					$sub_price="$".$sub_price;
                                        $total_price = str_ireplace(" ", "", $sub_price);
                                        $point_transfer=$boost_type_arr[$y - 1]['points'];
                                        $transfer_id=$user_id;
					$act_txt='';

                                        if($user_roles!='editor'){
                                            $client_username = $_REQUEST['client_user' . $y];
					    $transfer_id=$client_username;
                                        }
                                        addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 11', $user_ID);
                                        if($point_transfer > 0 && $transfer_id !=0 ){
                                        $rewards_datetime = date('Y-m-d H:i:s',strtotime('-4 hours'));
                                                $result1=mysql_query("SELECT `balance` FROM `0gf1ba_rewards_details` WHERE user_id='$transfer_id' and is_last=1  ORDER BY `id` DESC LIMIT 1");
                                                $balance = 0;
                                                while($row = mysql_fetch_assoc($result1)) {
                                                     //print_r($row);
                                                        $balance=$row["balance"];
                                                    }

                                               if($balance == 0)
                                               {
                                                   $new_balance=$point_transfer;
                                               }
                                               else{
                                                   $new_balance=$point_transfer+$balance;
                                               }
                                               //echo $balance.'ccccccccccccc';
                                               $boost_type2='List of Study'.'('.$boost_type1 .')';
					       $activity='List a new study'.' ('.$act_txt .')';
                                            $is_rewards_allowed = get_user_meta($transfer_id, 'rewards_allowed', true);
                                            if ((bool) $is_rewards_allowed){
                                                mysql_query("UPDATE 0gf1ba_rewards_details SET is_last=0 WHERE user_id='$transfer_id'");
                                                $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_rewards_details`(`id`, `user_id`, `activity_of_points`,`rewards_date_time`,`credit`,`debit`,`balance`,`is_last`) VALUES (NULL,'$transfer_id','$activity','$rewards_datetime','$point_transfer',0,'$new_balance',1)",array()));
                                                update_user_meta($transfer_id, 'rewards', $new_balance);
                                            }
                                        }
                                        addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 12', $user_ID);
                                        $subject = "cro/sponsors focus (".$final_num.")";
                                        $message .= "
                                        <body>
                                                <table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>
                                                          <tr>
                                                            <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>CRO/SPONSORS FOCUS STUDY #" . $y . "</strong></td>
                                                          </tr>
                                                          <tr>
                                                            <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $studytype . "</td>
                                                          </tr>
                                                           <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Site Name:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $sitename . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $studylocation . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $studydetails . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Protocol Number:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $protocolnumber . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Name:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $sponsorname . "</td>
                                                          </tr>";
														  if (strpos(strtolower($sponsoremail),'@studykik.com') == false) {
                                                          $message .= "  <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Email:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $sponsoremail . "</td>
                                                          </tr>";
														  }
                                                            $message .= "<tr style='color:#000; font-size:12px;'>
                                                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> CRO Name:</strong></td>
                                                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$croname."</td>
                                                            </tr>
                                                            <tr style='color:#000; font-size:12px;'>
                                                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> CRO Email:</strong></td>
                                                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$croemail."</td>
                                                            </tr>";
                                                            $message .= "<tr style='color:#000; font-size:12px;'>
                                                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> IRB Name:</strong></td>
                                                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$irbname."</td>
                                                            </tr>
                                                            <tr style='color:#000; font-size:12px;'>
                                                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> IRB Email:</strong></td>
                                                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$irbemail."</td>
                                                            </tr>";

                                                         $message .= " <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Start Date:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $startdate . "</td>
                                                          </tr>";
														  $l2=0;
														  if (strpos(strtolower($contactname),'@studykik.com') == false) { $l2++;
                                                          $message .= " <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactname . "</td>
                                                          </tr>";
														  }
														   if (strpos(strtolower($contactemail),'@studykik.com') == false) { $l2++;
                                                         $message .= "  <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail . "</td>
                                                          </tr>";
														   }
														   if (strpos(strtolower($contactemail2),'@studykik.com') == false) { $l2++;
                                                          $message .= " <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail2 . "</td>
                                                          </tr>";
														   }
														    if (strpos(strtolower($contactemail2),'@studykik.com') == false) { $l2++;
                                                          $message .= "   <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail3 . "</td>
                                                          </tr>";
															}
														if (strpos(strtolower($contactemail4),'@studykik.com') == false) { $l2++;
                                                         $message .= "    <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail4 . "</td>
                                                          </tr>";
														}
                                                         $message .= "    <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactphone . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Website:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $study_website . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $boost_type_pr1 . "</td>
                                                          </tr>
                                                           <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Add Patient Messaging Suite $247:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $message_suite_247 . "</td>
                                                          </tr>
                                                           <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Condense to 2 Weeks: </strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $condense_2_weeks . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                              <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Coupon: </strong></td>
                                                              <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$coupon."</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Credit Card (Last 4 Digits): </strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $creditcard . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Paid by Check: </strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".($creditcard ? "No" : "Yes")."</td>
                                                          </tr>
                                                           <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Notes: </strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $notes . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Invoice Number: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$final_num."</td>
				</tr>
                                                          <tr>
                                                            <td height='5' colspan='3' align='right' valign='middle'></td>
                                                          </tr>
                                                          <tr>
                                                            <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
                                                          </tr>
                                                        </table>
                                                        </body>";
                                        $category_id = get_cat_ID($studytype);
                                        $final_titile = $sitename . ' ' . $studytype . ' Study - Location: ' . $studylocation;

                                        if($user_roles=='editor'){
                                            $my_post = array(
                                                'post_title' => $final_titile,
                                                'post_content' => $studydetails,
                                                'post_status' => 'pending',
                                                'post_author' => $user_id,
                                                'post_category' => array($category_id)
                                            );

                                           $post_id=wp_insert_post($my_post);
                                        }
                                        else{
                                        $client_username = $_REQUEST['client_user' . $y];
					    $add_by_site=get_user_meta($client_username, 'add_manager_id', true);
					    if($add_by_site !=""){
						add_user_meta($client_username, 'is_site_used', 'yes');
					    }
					    $my_post = array(
                                                'post_title' => $final_titile,
                                                'post_content' => $studydetails,
                                                'post_status' => 'pending',
                                                'post_author' => $client_username,
                                                'post_category' => array($category_id)
                                            );
                                             $post_id=wp_insert_post($my_post);

                                        }
                                        addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 13', $user_ID);
                                        if ($order_id) {
                                            $study_list = get_post_meta($order_id, 'post_id', true);
                                            if ($study_list == 0 || $study_list == "0") {
                                                $study_list = $post_id;
                                            } else if ($study_list) {
                                                $study_list = $post_id;
                                            } else {
                                                $study_list .= ", $post_id";
                                            }
                                            update_post_meta($order_id, 'post_id', $study_list);
                                            update_post_meta($order_id, '_post_id', "field_post_id");
                                        }

                                        $study_arr[] = $post_id;

                                        if($user_roles=='manager_username'){

                                            update_post_meta($post_id, 'manager_username', $user_id);
                                        } else {
                                            $manager_id = get_user_meta($user_id, "manager", true);
                                            update_post_meta($post_id, 'manager_username', $manager_id);
                                        }
                                        update_post_meta($post_id, 'email_adress', 'info@studyKIK.com');
                                        update_post_meta($post_id, 'email_adress_2', $contactname);
                                        update_post_meta($post_id, 'email_adress_3', $contactemail);
                                        update_post_meta($post_id, 'email_adress_4', $contactemail2);
                                        update_post_meta($post_id, 'email_adress_5', $contactemail3);
                                        update_post_meta($post_id, 'email_adress_6', $contactemail4);
                                        update_post_meta($post_id, 'phone_number', $contactphone);
                                        update_post_meta($post_id, 'exposure_level', $boost_type1);
                                        update_post_meta($post_id, 'name_of_site', $sitename);
                                        update_post_meta($post_id, 'study_full_address', $studylocation);
                                        update_post_meta($post_id, 'website_url_thank_you_page', $study_website);
                                        update_post_meta($post_id, 'custom_title_(for_thank_you_page)', $studytype);
                                        update_post_meta($post_id, 'study_end_date_new_study', $newDate);
                                        update_post_meta($post_id, 'protocol_no', $protocolnumber);
                                        update_post_meta($post_id, 'notes_cro', $notes);
                                        update_post_meta($post_id, 'sponsor_name', $sponsorname);
                                        update_post_meta($post_id, 'sponsor_email', $sponsoremail);
                                        update_post_meta($post_id, 'cro_name', $croname);
                                        update_post_meta($post_id, 'cro_email', $croemail);
                                        update_post_meta($post_id, 'irb_name', $irbname);
                                        update_post_meta($post_id, 'irb_email', $irbemail);
                                        update_post_meta($post_id, 'creadit_card', $creditcard);
                                        update_post_meta($post_id, 'coupon', $coupon);
                                        update_post_meta($post_id, 'condence', $condense);
                                        if($newDate != 'To be determined'){
                                            update_post_meta($post_id, 'study_start_date', date("Ymd", strtotime($startdate)));
                                            update_post_meta($post_id, 'study_end_date', $wpFormatNewDate);
                                        }else{
                                            update_post_meta($post_id, 'study_start_date', $newDate);
                                        }
                                        addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 14', $user_ID);
                                        global $wpdb;
                                        $date = date('Y-m-d H:i:s');
                                        $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_coupons` (`user_id`,`post_id`,`date`,`action`,`coupon_code`) VALUES ('$user_ID','$post_id','$date','list_study','$coupon')",array()));
                                        $f_attchment1 = $_FILES["attachment" . $y]["tmp_name"];
                                        move_uploaded_file($_FILES["attachment" . $y]["tmp_name"], WP_CONTENT_DIR . '/uploads/' . basename($_FILES['attachment' . $y]['name']));
                                        $attachments[] = WP_CONTENT_DIR . "/uploads/" . $_FILES["attachment" . $y]["name"];
                                        $attachments111 = site_url()."/wp-content/uploads/" . $_FILES["attachment" . $y]["name"];
                                        $wp_filetype = wp_check_filetype(basename($attachments111), null);
                                        addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 15', $user_ID);
                                        if($user_roles=='editor'){
                                        $attachment = array(
                                            'post_mime_type' => $wp_filetype['type'],
                                            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                            'post_content' => '',
                                            'post_status' => 'inherit',
                                            'post_author' => $user_id
                                        );
                                        }
                                        else {
                                              $attachment = array(
                                            'post_mime_type' => $wp_filetype['type'],
                                            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                            'post_content' => '',
                                            'post_status' => 'inherit',
                                             'post_author' => $client_username
                                        );

                                        }
                                        addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 16', $user_ID);
                                        $attach_id = wp_insert_attachment($attachment, $attachments111, $post_id);
                                        set_post_thumbnail($post_id, $attach_id);
                                         update_post_meta($post_id, 'file_url', $attachments111);
                                       $message_pdf .= '<style type="text/css">
											<!--
											table
											{
												width:  100%;
												margin:0px 0px 0px 0px;
												padding: 0px 0px 0px 0px;
											}

											th{padding:2px 0px;}
											td
											{
											padding:5px 0px;
											}
											tbody{
											margin:0px 20px 0px 20px;
											padding: 0px 20px 0px 20px;

											}

											h1{ font-size:21px; margin:-15px 0px 10px 0px; padding:0px 0px 0px 0px;}
											tbody tr{ font-size:14px;}
											body{margin:0px 0px 0px 0px;
												padding: 0px 0px 0px 0px;}

											-->
											</style>';

				$message_pdf .= "
				  <page backtop='2mm' backbottom='0mm' backleft='5mm' backright='5mm'>
				 <table cellpadding='0' cellspacing='0'>
				<col style='width: 18%'>
				<col style='width: 37%'>
				<col style='width: 20%'>
				<col style='width: 5%'>
				<col style='width: 20%'>

				      <tr>
					<th style='text-align:left; margin-left:20px;' colspan='2'><img style='width:295px; height:52px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/background_top.png'/><p style='font-size:14px; color:#959ca1;font-weight:normal; margin:2px 0px 0px 0px; line-height:18px;'><b>StudyKIK</b><br />1675 Scenic Ave #150<br />Costa Mesa, CA 92626</p></th>
					<th colspan='3' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px; padding: 20px 0 4px 0;'>
					<h1>INVOICE RECEIPT</h1>
					Invoice Number: ".$final_num."<br />
                    Date: ".$currdate."<br />
                    Payment Type: ".($creditcard ? $auth_card_type." xxxx".$auth_credit_card : "Check")."<br />";
                if ($creditcard) {
                    $message_pdf .= "
                    Name on Card: ".$card_billing_first_name." ".$card_billing_last_name."<br/>
                    Account: ".$first_name. " " .$last_name."</th>";
                } else {
                    $message_pdf .= "
                    Account: ".$first_name. " " .$last_name."<br/>
                    &nbsp;</th>";
                }
                $message_pdf .= "
				    </tr>
				<tbody>
				<tr>
					<th style='text-align:left' colspan='5'><img style='width:100%;' src='".site_url()."/wp-content/themes/twentyfifteen/images/top_full.png'/></th></tr>
				    <tr style='text-align:center; font-size:18px;color:#000;'>
					<th align='left' style='border-bottom:1px solid #000;'>SERVICES:</th>
					<th align='left' colspan='2' style='border-bottom:1px solid #000;'>DESCRIPTION:</th>
					<th style='border-bottom:1px solid #000;'></th>
					<th  align='right' style='border-bottom:1px solid #000;'>AMOUNT:</th>
				    </tr>

				<tr align='center'>
				    <td align='left'>Listing</td>
				    <td align='left' colspan='2'><b>Site Name:</b> ".$sitename."</td>
				    <td align='center'> </td>
				    <td align='right'>".$price." </td>
				</tr>
				<tr align='center'>
				    <td align='left'></td>
				    <td align='left' colspan='2'><b>Study Type:</b> ".$studytype."</td>
				    <td align='center'> </td>
				    <td align='center'></td>
				</tr>
				<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Study Level:</b> ".$boost_type_pr1."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				</tr>
				<tr align='left'>
                    <td align='left'> </td>
                    <td align='left' colspan='2'><b>Sponsor Name:</b> " . $sponsorname . "</td>
                    <td align='center'> </td>
                    <td align='center'> </td>
                </tr>";
				if($protocolnumber){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left' colspan='2'><b>Protocol Number:</b> ".$protocolnumber."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
				}
				if($contactphone){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left' colspan='2'><b>Recruitment Phone:</b> ".$contactphone."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
				}
				$l1=0;

                                        if($startdate !="To be determined"){
                                            $message_pdf .= "<tr align='left'>
					<td align='left'> </td>
					<td align='left' colspan='2'><b>Start Date:</b> ".$startdate."</td>
					<td align='center'> </td>
					<td align='center'> </td>
					</tr>";
                                        }
                                        else{
                                            $message_pdf .= "<tr align='left'>
					<td align='left'> </td>
					<td align='left' colspan='2'><b>Start Date:</b>&nbsp;To be determined</td>
					<td align='center'> </td>
					<td align='center'> </td>
					</tr>";
                                        }
                                        if($startdate !="To be determined"){
                                            $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left' colspan='2'><b>End Date:</b> ".$newDate."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
                                        }
                                        else{
                                            $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left' colspan='2'><b>End Date:</b>&nbsp;To be determined</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
                                        }
                                        if ($studylocation) {
                                            $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left' colspan='4'><b>Study Address:</b> ".$studylocation."</td>
                            </tr> ";
                                        }
                                        if ($notes) {
                                            $message_pdf .= "<tr align='left'>
                                <td align='left'> </td>
                                <td align='left' colspan='2' style='height:40px; vertical-align:top;'><b>Notes:</b> ".$notes." </td>
                                <td align='center'> </td>
                                <td align='center'> </td>
                                </tr>";
                                        } else {
                                            $message_pdf .= "<tr align='left'>
                            <td align='left'>&nbsp; </td>
                            <td align='left' colspan='2' style='height:40px; vertical-align:top;'>&nbsp;</td>
                            <td align='center'>&nbsp; </td>
                            <td align='center'>&nbsp; </td>
                            </tr>";
                                        }

                                        if (!$studylocation) {
                                            $message_pdf .= "<tr align='left'>
                            <td align='left'>&nbsp;</td>
                            <td align='left' colspan='4'>&nbsp;</td>
                            </tr> ";
                                        }

                                        if($message_suite_247 == "Yes"){
                                            $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>Patient Messaging Suite</td>
				    <td bordercolor='#000' align='left' colspan='2'> </td>
				    <td bordercolor='#000' align='center'> </td>
				    <td bordercolor='#000' align='right'>".$message_suite."</td>
				    </tr>";
                                        }else{

                                            $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left' colspan='2'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

                                        }
                if($coupon){
                    $message_pdf .= "<tr align='center'>
                            <td align='left'>Coupon</td>
                            <td align='left' colspan='2'>".$coupon."</td>
                            <td align='center'> </td>
                            <td align='right'>-$".number_format( $coupon_discount ,  2 ,  '.' ,  ',' )." </td>
				        </tr>";

                } else {

                    $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left' colspan='2'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

                }

				$message_pdf .= "

				<tr class='sub_total' align='left'>
				<td align='center'  style='border-top:1px solid #000;'> </td>
				<td align='left' colspan='2'  style='border-top:1px solid #000;'> </td>
				<td align='right' colspan='2' style='border-top:1px solid #000;'>SUB TOTAL:&nbsp; ".$total_price."</td>
				</tr>
				<tr class='total' align='left'>
				<td align='center'> </td>
				<td align='left' colspan='2'> </td>
				<td align='right' colspan='2'><b>TOTAL:&nbsp; ".$total_price."</b></td>
				</tr>
				</tbody>
				<tr>";

				if($contactemail4 == ""){

				$message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:440px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

				}else{

					$message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:440px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

				}
				$message_pdf .= "</tr>
				</table></page>";
//                                        print_r($message);
//                                        print_r($message_pdf);

                                                    $subject_pdf_email = "Thank You for Listing " . $studytype . " " . $protocolnumber . "";
                                                    $pdf_email_text .= "
                                                    Hi " . $fullname . ",<br /><br />
                                                    Thank you for listing your " . $studytype . " " . $protocolnumber . " study with StudyKIK.<br /><br />
                                                    Please see invoice attached with detailed information.<br /><br />
                                                    If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
                                                    Thank you!<br /><br />
                                                    StudyKIK<br />
                                                    1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
                                                    info@studykik.com<br />
                                                    1-877-627-2509<br /><br /><br />
                                                    <img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png'>";
                                                    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
                                                    if ($croemail && filter_var($croemail, FILTER_VALIDATE_EMAIL)) {
                                                        $headers_pdf[] = 'Cc: '.$croemail;
                                                    }
                                                    $headers_pdf[] = "MIME-Version: 1.0\r\n";
                                                    $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                    require_once(dirname(__FILE__) . '/html2pdf/html2pdf.class.php');
                                                    $html2pdf = new HTML2PDF('P', 'Letter','en', true, 'UTF-8', array(0, 0, 0, 0));
                                                    $html2pdf->setDefaultFont('Arial');
                                                    $html2pdf->writeHTML($message_pdf);
                                                    //ob_end_clean();
													$study_cat_name1 = str_replace(' ', '_', $studytype);
													$study_cat_name2 = str_replace("'", "", $study_cat_name1);
													$study_cat_name = stripslashes($study_cat_name2);
                                                    $rand = rand();
                                                    $html2pdf->Output( dirname(__FILE__)."/pdf/".$final_num.' '.$studytype.' '.$boost_type1.' Invoice'.".pdf", "f");
				$html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_'.str_replace("'","",$study_cat_name).'_'.$boost_type1.'_Invoice'.".pdf", "f");
				$pdf_attachment_path = dirname(__FILE__).'/pdf/'.$final_num.' '.$studytype.' '.$boost_type1.' Invoice.pdf';
				$pdf_attachment_path_db = '/pdf/'.$final_num.'_'.str_replace("'","",$study_cat_name).'_'.$boost_type1.'_Invoice.pdf';
				$attachments[] = dirname(__FILE__).'/pdf/'.$final_num.' '.$studytype.' '.$boost_type1.' Invoice.pdf';
				$attachments_pdf[] = $pdf_attachment_path_db;
				update_post_meta($post_id, 'pdfpath', $pdf_attachment_path);
                                 if($user_ID == 70 || $user_ID == 532 || $user_ID == 534 ){
//                                $user_info = get_userdata(70);
//                                $cromail=$user_info->user_email ;
                                wp_mail('mo.tan@studykik.com',$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
                            }
                            else{
                                wp_mail($current_user_email,$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
                            }
                                        addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 17', $user_ID);
				$pdf_email_text = "";
				$message_pdf = "";
				$current_month = date('M');
				$current_year = date('Y');
				$full_date = date('m/d/y');

//                                if($user_roles=='editor'){
//                                    $rewardpoints=get_the_author_meta('rewards', $user_id);
//                                }
//                                else
//                                {
//                                     $client_username = $_REQUEST['client_user' . $y];
//                                      $rewardpoints = get_the_author_meta('rewards', $client_username);
//                                }
if ($user_roles == "manager_username"){
	$authh_id=get_post_field( 'post_author', $post_id);
	$wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`(`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES (NULL,'$authh_id','$post_id','$pdf_attachment_path_db','$protocolnumber','$final_num','$total_price','$current_month','$current_year','Study Information','$full_date')"));
}
else{
	$wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`(`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES (NULL,'$user_id','$post_id','$pdf_attachment_path_db','$protocolnumber','$final_num','$total_price','$current_month','$current_year','Study Information','$full_date')"));
}
                                        addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 18', $user_ID);

                 }
                           addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 19', $user_ID);
                           if($card_id) {
                               addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 20', $user_ID);
                               send_order_email($product_arr, array(
                                   "user_id" => $user_id,
                                   "first_name" => $card_billing_first_name,
                                   "last_name" => $card_billing_last_name,
                                   "company" => $card_billing_company,
                                   "email" => $current_user_email,
                                   "zip" => $card_billing_zip,
                                   "transaction_id" => $_REQUEST['transaction_id'],
                                   "payment_type" => $auth_card_type,
                                   "coupon" => $coupon,
                                   "coupon_amount" => array_sum($discount_arr),
                                   "invoice_number" => $_REQUEST['invoice_number'],
                                   "pdfs" => $attachments_pdf,
                                   "study_arr" => $study_arr
                               ), $attachments, $message);
                           } else {
                               addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 21', $user_ID);
                               send_order_email($product_arr, array(
                                   "user_id" => $user_id,
                                   "first_name" => $first_name,
                                   "last_name" => $last_name,
                                   "company" => $company,
                                   "email" => $current_user_email,
                                   "zip" => $_REQUEST['zip'],
                                   "transaction_id" => $_REQUEST['transaction_id'],
                                   "payment_type" => $creditcard == "" ? "Check" : $auth_card_type,
                                   "coupon" => $coupon,
                                   "coupon_amount" => array_sum($discount_arr),
                                   "invoice_number" => $_REQUEST['invoice_number'],
                                   "pdfs" => $attachments_pdf,
                                   "study_arr" => $study_arr
                               ), $attachments, $message);

                           }



                                                    $headers[] = 'From: New Study <info@studykik.com>';
                                                    $headers[] = "MIME-Version: 1.0\r\n";
                                                    $headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                           $SendEmail = true;
                           addToPaymentLog('( '.$_REQUEST['transaction_id'].' ) submit progress 22', $user_ID);
                                            } ?>
              </div>
            </div>
          </div>
        </div>
        <!--<div class="col-12 col-md-6" style="margin-top: 10px !important;"> <a href="<?php echo site_url();?>/clinical-study-information-dashboard/"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/new_study.png" alt="" class="img-responsive"></a> <a href="<?php echo site_url();?>/rewards/"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/rewards.png" alt="" class="img-responsive"></a> <a href="<?php echo site_url();?>/refer-listing/ "><img src="<?php bloginfo('template_url'); ?>/images-dashboard/refer_listin.png" alt="" class="img-responsive"></a> </div>-->
      </section>
    </div>
  </div>
</div>
<script>
$('.determine_start').on('click',function() {
    var un_id=$(this).attr('unique_id');
    $("#datepicker"+un_id).val('To be determined');
});
</script>
<?php
 if ($SendEmail) {?>
<div id="err_msgg" class="white_content" style="display:block;">
  <h2 class="heading">Thank you!</h2>
  <p id="msg_box" style="color: #000; padding: 15px; font-size: 16px; text-align: center;font-weight: bold;">Thank You, Your Studies Have Been Sent Successfully and Will Be Live in 24 Hours!</p>
  <a onclick="document.getElementById('err_msgg').style.display = 'none';document.getElementById('fade').style.display = 'none';" href="javascript:void(0)" class="closepop">Close</a> </div>
<div id="fade" class="black_overlay" style="display:block;"></div>
<?php } ?>
<div id="err_msgg" class="white_content" style="display: none;">
  <h2 class="heading">Oops</h2>
  <p id="msg_box" style="color: #000; padding: 15px; font-size: 16px; text-align: center;font-weight: bold;">Please fill required fields.</p>
  <a onclick="document.getElementById('err_msgg').style.display = 'none';document.getElementById('fade').style.display = 'none';" href="javascript:void(0)" class="closepop">Close</a> </div>
<div id="fade" class="black_overlay" style="display: none;"></div> <div id="embed16" class="white_content" style="cursor: auto; display: none;width:65% !important;left:17.5% !important;top:11.5% !important;;" >
    <div class="col-xs-12 col-md-12 notes_left">
        <div class="row">
          <h2 class="h2_vid_pop">MyStudyKIK Portal</h2>
        </div>
        <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area" id="nts_div_vdo" style="text-align:center;height:425px!important;margin-bottom:15px;">

         <iframe style="padding-top: 25px;" width="800" height="415" src="https://www.youtube.com/embed/E_VbqeGrL90" frameborder="0" allowfullscreen></iframe>

        </div>
    </div>
    <a class="closepopvideopat" href="javascript:void(0);">Close</a>
</div>
    <script>
    jQuery(document).on('click','.closepopvideopat',function (){
	jQuery("#fade").hide();
	jQuery("#embed16").hide();
	jQuery("#nts_div_vdo").html('<iframe style="padding-top: 25px;" width="800" height="415" src="https://www.youtube.com/embed/E_VbqeGrL90" frameborder="0" allowfullscreen></iframe>');
});

</script>
<!--<script src="<?php //echo get_template_directory_uri(); ?>/js/jquery.js"></script>-->
<?php get_footer('dashboard'); ?>
<!------------css added------------------->
<style>
    #wpcf7-f74-p6-o123 select,#wpcf7-f74-p6-o123 input[type="text"], #wpcf7-f74-p6-o123 input[type="email"], #wpcf7-f74-p6-o123 textarea{width:500px;}
    .inner-form{min-height: 490px !important;}
    .study label br{ display:none;}
    .study label,.inner-form p {width:100%; float:left;font: 18px Arial, Helvetica, sans-serif; font-weight:bold; }
    .study input[type="checkbox"]{box-shadow:none;height: 25px;}
    .fisrt_step{width:96%;}
    .required.warning {
        border: 1px solid red;
    }
    .warning {
        border: 1px solid red !important;
    }
    input[type="checkbox"] {
        transform: scale(1.5);
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
    h2.heading{
        background: #f78e1e none repeat scroll 0 0;
        color: #fff;
        font-family: alternate;
        font-size: 44px;
        margin: 0;
        padding: 5px;
        text-align: center;
        text-decoration: none;
    }

    .close_button{
        background: #00afef;
        border: medium none;
        color: #fff;
        font-family: alternate;
        font-size: 33px;
        padding: 0 26px;
    }
    .closepop {
        background: transparent url("<?php bloginfo('template_url'); ?>/images-dashboard/close2.png") no-repeat scroll 0 0;

    }
/***** andon ******/
    .scroll-area{
      height: auto;
    }
  .fisrt_step{
    width: 100%;
  }
</style>
<script type="application/javascript">
    $(window).load(function(){
	var str=navigator.userAgent;
	n=str.indexOf("Safari");
	if(n!=-1){
	    $('.input.ui-autocomplete-input').attr('style', 'width: 550px !important');
	}

    });
</script>

<script>
jQuery(".closepop6").live('click',function(){
 jQuery("#fade").hide();
 jQuery("#embed16").hide();
 jQuery("#nts_div_video4").html('<iframe style="padding-top:20px;"  width="800" height="415" src="https://www.youtube.com/embed/E_VbqeGrL90" frameborder="0" allowfullscreen> </iframe>');
});
</script>
<script>
function showVideo(){
    $( "#dialog-confirm").html('<iframe width="600" height="460" src="https://www.youtube.com/embed/RUHCnmQy5Yk?autoplay=1"></iframe>');
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        width:610,
        draggable: false,
        modal: true,
        close: function(event, ui) { $('#wrap').show(); $( "#dialog-confirm").html('');},
        open: function(event, ui) { $('.ui-widget-overlay').bind('click', function(){ $("#dialog-confirm").dialog('close'); $( "#dialog-confirm").html(''); }); }
    });
    //$(".ui-dialog-titlebar").hide();
    $(".ui-dialog-titlebar-close span").css('margin', '-8px');
}
jQuery(".choose_credit").on('change',function(){
    //alert("hiiiii");

 var un_id=jQuery(this).attr('unique_credit');

 var sel_val=jQuery(this).val();
 if(sel_val=='Add new Card'){
    jQuery(".loop_credit_"+un_id).show();
     $(this).closest('form').find('#payment_credit_card_id').val("");
     $(this).closest('form').find('#payment_profile_id').val("");
     $(this).closest('form').find('#payment_payment_id').val("");
     $(this).closest('form').find('#payment_shipping_id').val("");
     $(this).closest('form').find('#payment_card_code').val("");
 } else if (sel_val) {
     jQuery(".loop_credit_"+un_id).hide();
     $(this).closest('form').find('#payment_credit_card_id').val($(this).find(':selected').attr('data-credit-card-id'));
     $(this).closest('form').find('#payment_profile_id').val($(this).find(':selected').attr('data-profile-id'));
     $(this).closest('form').find('#payment_payment_id').val($(this).find(':selected').attr('data-payment-id'));
     $(this).closest('form').find('#payment_shipping_id').val($(this).find(':selected').attr('data-shipping-id'));
     $(this).closest('form').find('#payment_card_code').val($(this).find(':selected').attr('data-cvv'));
 }
 else{
     $(this).closest('form').find('#payment_credit_card_id').val("");
     $(this).closest('form').find('#payment_profile_id').val("");
     $(this).closest('form').find('#payment_payment_id').val("");
     $(this).closest('form').find('#payment_shipping_id').val("");
     $(this).closest('form').find('#payment_card_code').val("");
    jQuery(".loop_credit_"+un_id).hide();
 }
});
$(document).ready(function () {
    $('#show_hide_input').on("click", function () {
        var errors = 0;
        var total_amount = 0;
        var choose_credit_value = $(".choose_credit").find(':selected').val();
        console.log(choose_credit_value);

        var data_form = $("#contactform");

        $("#contactform .required").map(function () {
            if (!$(this).val()) {
                if (choose_credit_value != 'Add new Card' && $(this).hasClass("new-card-field")) {
                    $(this).removeClass('warning');
                } else {
                    $(this).addClass('warning');
                    errors++;
                    if (errors == 1)
                    {
                        //alert("Please fill required fields.");
                        //$("#err_msgg").show();
                        //$("#fade").show();
                    }
                }
            } else if ($(this).val()) {
                $(this).removeClass('warning');
            }
        });

        if (errors == 0) {
            var str = data_form.find("input[name=company]").val();
            if(/^[a-zA-Z0-9-_ ]*$/.test(str) == false) {
                data_form.find("input[name=company]").addClass("warning");
                data_form.find('.payment-processing').html("Company field can't contain symbols.");
                data_form.find('.payment-processing').css('color','#ff0000');
                errors ++;
            } else {
                data_form.find("input[name=company]").removeClass("warning");
                data_form.find('.payment-processing').html("");
            }
        }

        var today, someday;
        var exMonth=data_form.find("select[name=cc_exp_month]");
        var exYear=data_form.find("select[name=cc_exp_year]");
        today = new Date();
        someday = new Date();
        someday.setFullYear(exYear.val(), exMonth.val(), 1);

        if (someday < today && errors == 0 && choose_credit_value == 'Add new Card') {
            errors ++;
            exMonth.addClass('warning');
            exYear.addClass('warning');
            jQuery('.payment-processing').html("The expiration date is invalid.");
            return false;
        }

        $(".exposure-level-select").map(function () {
            total_amount += $(this).find(":selected").data("price");
        });


        $('input[name=amount]').val(total_amount);
        if (errors > 0) { //alert()


            return false;
        } else {

            $('.show_hide_input').prop("disabled", true);
            var ajaxurl     = '/wp-admin/admin-ajax.php';
            var code = jQuery('#study_coupon').val();

            if (code) {

                var datastring  = {coupon:code, action:'couponcode'};

                $('.show_hide_input').prop("disabled", true);
                jQuery('.payment-processing').html("Processing...");
//                            $('.show_hide_input').val("Processing...");
                $.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: datastring,
                    //dataType: "json",
                    success: function(data) {

                        coupon_obj = JSON.parse(data);
                        if (coupon_obj.type == "invalid") {
                            $('.show_hide_input').prop("disabled", false);
//                                        $('.show_hide_input').val("List My Studies");
                            $('#study_coupon').addClass("warning");
                            jQuery('.payment-processing').html("This coupon code is invalid or has expired.");
                            return false;
                        } else {
                            if (coupon_obj.type == "fixed") {
                                total_amount = Math.max(total_amount - parseFloat(coupon_obj.value), 0);
                            } else if (coupon_obj.type == "percent") {
                                total_amount = total_amount * parseFloat(100 - coupon_obj.value) / 100;
                            }

                            $('#couponInfo').html("");
                            $('#study_coupon').removeClass("warning");
                            $('.show_hide_input').prop("disabled", true);
                            jQuery('.payment-processing').html("Processing...");
                            post_ajax_get();
                            return false;
                        }

                    },
                    error: function(data){
                        $('.show_hide_input').prop("disabled", false);
                        jQuery('.payment-processing').html("This coupon code is invalid or has expired.");
                        console.log(data);
                    }
                });
            } else {
                $('#study_coupon').removeClass("warning");
                $('.show_hide_input').prop("disabled", true);
                jQuery('.payment-processing').html("Processing...");
                post_ajax_get();
            }

            return false;
        }
        return false;
        // do the ajax..
    });
    function post_ajax_get(term_id,term_name) {
        var total_amount = parseFloat($('input[name=amount]').val());
        var ajaxurl     = '/wp-admin/admin-ajax.php';

        $(".message_suite_247").map(function () {
            if ($(this).prop("checked")) {
                total_amount = total_amount + 247;
            }
        });
        $('input[name=amount]').val(total_amount);
        var datastring  = jQuery("#contactform").serialize();
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: datastring,
            success: function(data) {

                var status          = data;
                var statusArr       = data.split('|');
                var success_message = '';
                console.log(statusArr);
                if(statusArr[0] == 'yes'){

                    success_message = '<strong>Thank you</strong><br />Transaction ID: '+statusArr[1]+'<br /><br />';
                    jQuery('.payment-processing').html(success_message);
                    // post form to another page
                    jQuery('#transaction_id').val(statusArr[1]);
                    if (statusArr[4]) {
                        jQuery('#payment_credit_card_id').val(statusArr[4]);
                    }
                    jQuery('#order_id').val(statusArr[2]);
                    if (statusArr[6]) {
                        jQuery('#payment_by_check').val(statusArr[6]);
                    }
                    jQuery('#invoice_number').val(statusArr[3]);
                    jQuery('#user_id').val(statusArr[5]);
                    jQuery('.payment-processing').val('<p>Transaction ID: '+statusArr[1]+'</p>');
                    $('.show_hide_input').prop("disabled", false);
                    jQuery('#contactform').submit();


                }else{
                    $('.show_hide_input').prop("disabled", false);
//                    $('.show_hide_input').val("List My Studies");
                    success_message = '<strong>Sorry</strong><br />There was an error: The credit card information is invalid.<br /><br />';
                    jQuery('.payment-processing').html(success_message);
                    $('input[name=cc_number]').addClass("warning");
                    $('select[name=cc_exp_month]').addClass("warning");
                    $('select[name=cc_exp_year]').addClass("warning");
//                    $('input[name=cc_cvv2]').addClass("warning");
                    $('input[name=zip]').addClass("warning");
                }


            },
            error: function(data){
                jQuery('.order_status').html(data);
                $('.show_hide_input').prop("disabled", false);
                $('input[name=cc_number]').addClass("warning");
                $('select[name=cc_exp_month]').addClass("warning");
                $('select[name=cc_exp_year]').addClass("warning");
                $('input[name=zip]').addClass("warning");
            }
        });

    }
    function updateTotal(){

        var order_total   = 0;
        var order_summary = '';
        jQuery('.product-qty').each(function(){

            if(jQuery(this).val() != '0'){

                var item_cost   = jQuery(this).data('price') * jQuery(this).val();
                order_total     = order_total + item_cost;

            }

        });

        if(coupon_discount){
            discount_amount = (order_total * parseFloat(coupon_discount));
            order_total     = order_total - discount_amount;
            console.log(''+discount_amount);
            //summary-coupon
            jQuery('summary-coupon').show();
            jQuery('.discount-amount').html('-$'+discount_amount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') );
        }

        jQuery('.total-value').html( '$'+order_total.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') );
        jQuery('#amount').val(order_total);
    }
});
</script>
<style>
.closepop6
{
	background: transparent url("<?php bloginfo('template_url'); ?>/images-dashboard/close2.png") no-repeat scroll 0 0;
	font-size: 0 !important;
    height: 16px;
    position: absolute;
    right: 4px;
    top: 2px;
    width: 16px;
}
/*********************css added on 8-12-2015 ********************/
.col-md-4.col-sm-4.col-xs-12.name_first.spac {
    padding-left: 0;
}
.col-md-6.col-sm-6.col-xs-12.name_first.spac {
    padding-left: 0;
}
.col-md-8.col-sm-8.col-xs-12.name_first.spac {
    padding-left: 0px;
}
.col-md-8.col-sm-8.col-xs-12.name_first.spacright {
    padding-right: 1px;
}
.col-md-4.col-sm-4.col-xs-12.name_first.spacright {
    padding-right: 1px;
}
.col-md-4.col-sm-4.col-xs-12.name_first.spaccvc {
    padding-right: 0;
}
.col-md-6.col-sm-6.col-xs-12.name_first.spacright {
    padding-right: 1px;
}
.col-md-3.col-sm-3.col-xs-12.name_first.spac4 {
    padding-left: 2px;
}
.col-md-3.col-sm-3.col-xs-12.name_first.spec4last {
    padding-right: 2px;
}

</style>
<!---------------------------------------->