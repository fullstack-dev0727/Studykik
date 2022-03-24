<?php
/*
 * Template Name: Client Dashboard
 */
//print_r($_POST);
?>
<?php
if (is_user_logged_in()) {
    $user_ID = get_current_user_id();
    $is_check_allowed = get_user_meta($user_ID, 'allow_check', true);
    $user_info = get_userdata($user_ID);
    $user_roles = implode(', ', $user_info->roles);
    if ($user_roles == "author" || $user_ID == 45 || $user_ID == 53 || $user_ID == 51 || $user_ID == 52  /* || $user_ID == 1381 */ || !$user_roles) {
        wp_redirect(site_url().'/project-manager-dashboard/?listing=current', 301);
        exit;
    } elseif ($user_roles == "subscriber") {
        wp_redirect(site_url().'/study-patient-stats-dashboard/', 301);
        exit;
    }

} else {
    wp_redirect(site_url().'/login/', 301);
    exit;
}?>

<?php
$currdate =date('m/d/Y',strtotime('-4 hours'));
if (is_user_logged_in()) {
    $user_ID = get_current_user_id();
    $user_info = get_userdata($user_ID);
    $user_roles = implode(', ', $user_info->roles);
    if ($user_roles == "manager_username") {?>
<?php get_header('responsive');?>


<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/jquery-ui.css"
      xmlns="http://www.w3.org/1999/html">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/dashboard-card.css">
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->
<script src="<?php bloginfo('template_url');?>/combobox/jquery-1.10.2.js"></script>
<script src="<?php bloginfo('template_url');?>/combobox/jquery-ui.js"></script>

<?php
session_start();
$_SESSION['authors_ids'] = "";
$susces = 1;
?>
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
            if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete'))
            {
                var w = new PCWidget({c: 'bab234e1-3a99-448d-b117-2bb29457f303', f: true});
                done = true;
            }
        };
    })();
</script>

<style>
    .white_content {
        background-color: white;
        border-radius: 10px;
        cursor: auto;
        display: none;
        left: 23% !important;
        overflow: auto;
        position: fixed !important;
        top: 26.2% !important;
        width: 54% !important;
        z-index: 99999 !important;
        border: 1px solid #f78e1e;
    }
    .upgrade_white_content {
        background-color: white;
        border-radius: 10px;
        cursor: auto;
        display: none;
        left: 23% !important;
        overflow: auto;
        position: fixed !important;
        top: 29.9% !important;
        width: 54% !important;
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
    .close_button {
        background: #00afef;
        border: medium none;
        color: #fff;
        font-family: alternate;
        font-size: 33px;
        padding: 0 26px;

    }
    .closepop {
        background: transparent url("<?php bloginfo('template_url'); ?>/images-dashboard/close2.png") no-repeat scroll 0 0 !important;
         font-size: 0 !important;
    height: 16px;
    position: absolute;
    right: 2px;
    top: 2px;
    width: 16px;
/*        margin-left: 701px;
        padding-top: 256px;*/
    }
    .done_button {
        background: #9fce64;
        border: medium none;
        color: #fff;
        font-family: alternate;
        font-size: 33px;
        /*margin: 10px 0 10px 34%;*/
        padding: 0 26px;
        margin-bottom:20px;
    }

#search_btn2 {
    background: #f5f5f5 none repeat scroll 0 0;
    border: medium none;
    border-radius: 4px;
    box-shadow: 0 3px 3px #c7c7c7 inset;
    float: left;
    margin-left: 17px;
    padding: 5px 28px;
    width: 94%;
}
.li_active.lll1, .li_active.lll2, .lll1:hover, .lll2:hover {
    background: #00afef none repeat scroll 0 0;
    color: #fff;
    text-decoration: none;
}
.current_heading h4 {
    color: #9fcf67;
    font-size: 32px;
    margin: 0;
    text-align: center;
}
.lll2 {
    background: #fff none repeat scroll 0 0;
    border-radius: 11px 9px 0 0;
    color: #00afef;
    float: right;
    font-family: alternate;
    font-size: 32px;
    padding: 10px 46px;
    text-transform: uppercase;
}
.lll1 {
    background: #fff none repeat scroll 0 0;
    border-radius: 11px 9px 0 0;
    color: #00afef;
    float: left;
    font-family: alternate;
    font-size: 32px;
    font-weight: 400;
    padding: 10px 34px;
    text-transform: uppercase;
}
form.form-search::before {
    background-image: url("https://getbootstrap.com/2.3.2/assets/img/glyphicons-halflings.png");
    background-position: -48px 0;
    content: "";
    display: block;
    height: 14px;
    left: 26px;
    opacity: 0.5;
    position: absolute;
    top: 8px;
    width: 14px;
    z-index: 1000;
}
.form-search::before {
      background-image: url("https://getbootstrap.com/2.3.2/assets/img/glyphicons-halflings.png");
    background-position: -48px 0;
    content: "";
    display: block;
    height: 14px;
    left: 44px;
    opacity: 0.5;
    position: absolute;
    top: 78px;
    width: 14px;
    z-index: 1000;
}
.upgrade_type {
    -moz-appearance: number-input !important;
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
b, strong {
    font-weight: bold;
}
.patient {
    border: medium none;
    color: #fff;
    float: left;
    font-size: 16px;
    font-weight: bold;
    padding: 2px 8px;
    width: 150px;
}
.navbar-nav-res li{
border-right: 1px solid #cdd0d3;
    display: block;
    height: 70px;
    padding: 0 13px;
    position: relative;
    width: 120px;
    float: left;
}
.current_heading {
    background:  #f5f5f5 none repeat scroll 0 0;
    border-radius: 4px 4px 0 0;
    box-shadow: 0 0 0 !important;
    float: left;
    width: 100%;
}
.nav > li {
    padding: 8px !important;
 }
 #top h1 img {
    left: 480px !important;
 }
.asd {
    margin-left: 5px;
    width: 99%;
}

.ui-button-text {
  height: 48px !important;
  margin-bottom: 0;
  margin-top: 2px;
  width: 31px;
}
.ui-button-text {
  height: 44px !important;
  margin-bottom: 0;
  margin-top: 2px;
  width: 31px;
}

.custom-combobox{
    height: 42px;
    display: inline-block;
    overflow: hidden
}

.custom-combobox .custom-combobox-input{
    height: 100%;
    margin: 0;
    padding: 0 0 0 17px;
    border: 1px solid #bababa !important;
    box-sizing: border-box;
    border-radius: 0;
    border-right: none !important;
    line-height: initial;
    width: 310px;
    background:white;
}

.custom-combobox .ui-button {
    background: rgba(0, 0, 0, 0) linear-gradient(to top, #dadada 0%, #ededed 100%) repeat scroll 0 0 !important;
    border: 1px solid grey !important;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    float: right;
    border-radius: 0;
    height: 100%;
    width: 19px;

}

/*.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input {
  line-height: initial;
  border-radius: 0;
  height: 42px;
  width: 310px;
}
.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input {
  padding: 0 0 1px 17px;
  border: 1px solid #bababa !important;
  border-right: none !important;
}*/
/*.ui-button.ui-widget.ui-state-default.ui-button-icon-only.custom-combobox-toggle.ui-corner-right {
    border: 1px solid gray;
    height: 42px;
    width: 19px;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
	background: #e6e6e6 url("images/ui-bg_glass_75_e6e6e6_1x4001.png") repeat-x scroll 50% 50%;
	background:white;
}
.ui-button.ui-widget.ui-state-default.ui-button-icon-only.custom-combobox-toggle.ui-corner-right {
  border: 1px solid #d3d3d3 !important;
  border-radius: 0;
}
.ui-button.ui-widget.ui-state-default.ui-button-icon-only.custom-combobox-toggle.ui-corner-right {
    background: rgba(0, 0, 0, 0) linear-gradient(to top, #dadada 0%, #ededed 100%) repeat scroll 0 0 !important;
    border: 1px solid grey !important;
}*/
 .ui-autocomplete{
            overflow-x: auto;
            max-height: 300px;
        }
/*.navbar-nav-res li rewardsli{
    border:none;
    margin-left:-59px;
}*/

</style>
<?php
$sel_val='all';
if(isset($_REQUEST['aid'])){
    $sel_val=$_REQUEST['aid'];
}
?>
        <!--<script src="<?php //echo get_template_directory_uri(); ?>/js/jquery-1.10.2.js"></script>-->
        <script type="text/javascript">
    jQuery(document).ready(function ($) {
        jQuery('#data2').hide();
        jQuery("#search_btn").keyup(function () {
            var that = this;
            var search_string = this.value;

            jQuery('#data').hide();
            setTimeout( function() {
                var dInput = that.value;
                if (dInput == search_string) {
                    if (search_string == "") {
                        jQuery('#data2').hide();
                        jQuery('#data').show();
                    } else {
                        jQuery('.search-form').addLoadingIndicator();
                        jQuery('#search_btn').prop('disabled', true);
                        jQuery.ajax({
                            type: "GET",
                            url: "<?php bloginfo('url'); ?>/find-listing-using-jquery/",
                            data: "sticky=" + dInput+"&role=1&sel_val=<?php echo $sel_val;?>",
                            success: function (data) {
                                jQuery('#data2').html(data);
                                jQuery('#data2').show();
                                jQuery('.search-form').removeLoadingIndicator();
                                jQuery('#search_btn').prop('disabled', false);
                            }
                        });
                    }
                }
            }, 500);
        });
        jQuery("#search_btn2").keyup(function () {
            var that = this;
            var search_string = this.value;

            jQuery('#data').hide();

            setTimeout( function() {
                var dInput = that.value;
                jQuery('#data').hide();
                if (dInput == search_string) {
                    if (search_string == "") {
                        jQuery('#data2').hide();
                        jQuery('#data').show();
                    } else {
                        jQuery('.search-form').addLoadingIndicator();
                        jQuery('#search_btn2').prop('disabled', true);
                        jQuery.ajax({
                            type: "GET",
                            url: "<?php bloginfo('url'); ?>/jquery-past-studies/",
                            data: "sticky2=" + dInput+"&role=1&sel_val=<?php echo $sel_val;?>",
                            success: function (data) {
                                jQuery('#data2').html(data);
                                jQuery('#data2').show();
                                jQuery('.search-form').removeLoadingIndicator();
                                jQuery('#search_btn2').prop('disabled', false);
                            }
                        });
                    }

                }
            }, 500 );

        });
    });
        </script>
        <script language="javascript">
<?php
$study = $_REQUEST['study'];
if (!empty($_REQUEST['study'])) {
    ?>
                function renewStudy(post_id) {
                    jQuery("#embed" + post_id).hide('slow');
                    location.search = "?study=pasts&postID=" + post_id;
                    return true;
                }
                function boostStudy(post_id, boostpack) {
                    jQuery("#embed2" + post_id).hide('slow');
                    location.search = "?study=pasts&postID=" + post_id + "&boostStudy=" + boostpack;
                    return true;
                }
<?php } else { ?>
                function validate_renew_type(post_id) {
                    var selected_value = jQuery('#embed' + post_id + ' .renew_type').val();
                    var datepicker = jQuery('#embed' + post_id + ' #datepicker').val();
                    if (selected_value == "") {
                        jQuery('#embed' + post_id + ' .renew_type').css('border', '1px solid red');
                        return false;
                    }
                    if (datepicker == "") {
                        jQuery('#embed' + post_id + ' #datepicker').css('border', '1px solid red');
                        return false;
                    }
                }
                function validate_upgrade_type(post_id) {
                    var selected_value = jQuery('#embed2' + post_id + ' .upgrade_type').val();
                    if (selected_value == "") {
                        jQuery('#embed2' + post_id + ' .upgrade_type').css('border', '1px solid red');
                        return false;
                    }
                }
<?php } ?>
        </script>
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
					.addClass( "custom-combobox-toggle ui-corner-right" )
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

	    $(function() {
				$( "#combobox" ).combobox({

				select: function( event, ui ) {
				var selected_idd=ui.item.value;

		var url      = window.location.href;

	  if(selected_idd == "" ||selected_idd == ""){}else{
	    <?php
	    if($study !=""){ ?>

		location.search = "study=pasts&aid="+selected_idd;
	    <?php
	    }
	    else{ ?>
		location.search = "aid="+selected_idd;
	    <?php } ?>

	 }

					}
				});
						});

	</script>


        <?php
        $study = $_REQUEST['study'];
//print_r($study);die;
        $user_id = $user_ID;
        $current_user = wp_get_current_user();
        $current_user_email = $current_user->user_email;
        $fullname = $current_user->user_firstname;
        $first_name                  = get_user_meta($user_id, "first_name", true);
        $last_name                   = get_user_meta($user_id, "last_name", true);
        $first_name1 = explode(" ", $fullname);
        $fname = $first_name1[0];

        $query_invoice_number = $wpdb->get_results("SELECT * FROM `0gf1ba_invoice_number` ORDER BY `id` DESC LIMIT 1");
        foreach ($query_invoice_number as $query_invoice_number_value) {
            $invoice_num = $query_invoice_number_value->invoice_number;
        }
        if (!empty($_REQUEST['postID']) || !empty($_REQUEST['boostStudy'])) {
            $post_id = $_REQUEST['postID'];
            $study_arr = array();
            $study_arr[] = $post_id;
            $boostStudy = stripslashes($_REQUEST['upgrade_type']);
            if (!$boostStudy && isset($_REQUEST['upgrade_type_suite']) && $_REQUEST['upgrade_type_suite']){
                $boostStudy = $_REQUEST['upgrade_type_suite'];
            }
            $renew_product_id = $_REQUEST['renew_type'];
            $renew_product_title = get_the_title($renew_product_id);
            $renew_product_title_parts = explode(" ", $renew_product_title);
            $renew_product_price = (float)get_post_meta($renew_product_id, "product_price", true);
            $renew_product_points = get_post_meta($renew_product_id, "points", true);
            $renew_type = $renew_product_title_parts[0] . " $" . $renew_product_price;
            $date = date('Y-m-d H:i:s');
            $coupon = stripslashes($_REQUEST['coupon']);
            $notes = stripslashes($_REQUEST['notes']);
            $card_id = $_REQUEST['select_card'];

            $auth_card_type              = get_post_meta($card_id, 'auth_card_type', true);
            $auth_credit_card            = get_post_meta($card_id, 'auth_credit_card', true);
            $card_billing_first_name     = get_post_meta($card_id, 'card_billing_first_name', true);
            $card_billing_last_name      = get_post_meta($card_id, 'card_billing_last_name', true);
            $card_billing_zip            = get_post_meta($card_id, 'card_billing_zip', true);

            $creditcard =  get_post_meta($card_id, 'auth_credit_card', true);

            $product_arr = array();

            $c_discount = 0;
            $discount_amount = 0;

            $message_suite_2471 = $_REQUEST['message_suite_2471'];
            $condense_2_weeks1 = $_REQUEST['condense_2_weeks1'];

            $select_date = $_REQUEST['select_date'];

            if (isset($_REQUEST['message_suite_2471'])) {
                $message_suite2 = '247';
                $message_suite_email = 'Yes';
            }
            if (isset($_REQUEST['condense_2_weeks1'])) {
                $condense_2_weeks1_email = 'Yes';
            }
            $final_num = $invoice_num + 1;
            $sponsorname = get_post_meta($post_id, 'sponsor_name', true);
            $sponsoremail = get_post_meta($post_id, 'sponsor_email', true);
            $contactname = get_post_meta($post_id, 'email_adress', true);
			$contactname2 = get_post_meta($post_id, 'email_adress_2', true);
            $contactemail3 = get_post_meta($post_id, 'email_adress_3', true);
            $contactemail4 = get_post_meta($post_id, 'email_adress_4', true);
            $contactemail5 = get_post_meta($post_id, 'email_adress_5', true);
            $contactemail6 = get_post_meta($post_id, 'email_adress_6', true);
			$contactemail7 = get_post_meta($post_id, 'email_adress_7', true);
            $contactphone = get_post_meta($post_id, 'phone_number', true);
            $protocolnumber = get_post_meta($post_id, 'protocol_no', true);
            $boost_type1 = get_exposure_level_string($post_id);
            $sitename = get_post_meta($post_id, 'name_of_site', true);
            $studylocation = get_post_meta($post_id, 'study_full_address', true);
            $croname = get_post_meta($post_id, 'cro_name', true);
            $croemail = get_post_meta($post_id, 'cro_email', true);
            $irbname = get_post_meta($post_id, 'irb_name', true);
            $irbemail = get_post_meta($post_id, 'irb_email', true);
            $study_website = get_post_meta($post_id, 'website_url_thank_you_page', true);
            $studytype = get_post_meta($post_id, 'custom_title_(for_thank_you_page)', true);
            $attachments111 = get_post_meta($post_id, 'file_url', true);
            $study_no = get_post_meta($post_id, 'study_no', true);
            //echo $study_no;die;
            if ($boostStudy) {
                $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_coupons` (`user_id`,`post_id`,`date`,`action`,`coupon_code`) VALUES ('$user_ID','$post_id','$date','upgrade_study','$coupon')",array()));
                update_post_meta($post_id, 'coupon', $coupon);
                if (get_field('study_end_date', $post_id)) {
                    $date2 = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post_id));
                    $newDate = $date2->format('m/d/Y');
                } else {
                    $newDate = '12/30/2015';
                }
                $startdate = date("m/d/Y", strtotime($newDate . " -31 days"));
            } else {
                $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_coupons` (`user_id`,`post_id`,`date`,`action`,`coupon_code`) VALUES ('$user_ID','$post_id','$date','renew_study','$coupon')",array()));
                update_post_meta($post_id, 'coupon', $coupon);
                $study_publish_date = get_the_date('m/d/Y', $post_id);
                if (get_field('study_end_date', $post_id)) {
                    $date2 = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post_id));
                    $study_end_date = $date2->format('Y-m-d');
                } else {
                    $study_end_date = '2015-12-30';
                }
                $datetime1 = date_create($study_publish_date);
                $datetime2 = date_create($study_end_date);
                $interval = date_diff($datetime1, $datetime2);
                $total_number_of_days = str_replace("+", "", $interval->format('%R%a'));
                if ($study == "pasts") {
                    //$startdate = date("m/d/Y");
                    $startdate = $select_date;
                } else {
                    $startdate = $select_date;
                }

                if ($condense_2_weeks1_email) {
                    $newDate = date("m/d/Y", strtotime($startdate . " +15 day"));
                } else {
                    $newDate = date("m/d/Y", strtotime($startdate . " +30 day"));
                }
            }
            if ($boostStudy) {
                $pr=explode("$",$boostStudy);
		        $prc=$pr[1];
                $pric=number_format($prc,2,'.',',');
                $price='$' .$pric;
                $price2=(int)$prc;

                if ($boostStudy == "Patient Messaging Suite $247") {
                    $price = "";
                    $price2 = 247;
                    $message_suite2 = '247';
                    $message_suite_email = 'Yes';
                } else {
                    if ($product_arr[$pr[0].'Listing']) {
                        $product_arr[$pr[0].'Listing']['qty'] = $product_arr[$pr[0].'Listing']['qty'] + 1;
                    } else {
                        $product_arr[$pr[0].'Listing'] = array("title" => $pr[0].'Listing' , "price" => $price2, "qty" => 1);
                    }
                }
            } else {
                $point_transfer = 0;
                $transfer_id = $user_ID;
                $act_txt = "";

                $price = '$'.str_replace('USD ','',money_format('%i', $renew_product_price));
                $price2 = $renew_product_price;
                $point_transfer = $renew_product_points;
                $act_txt = $renew_product_title_parts[0];

                if ($product_arr[$renew_product_title]) {
                    $product_arr[$renew_product_title]['qty'] = $product_arr[$renew_product_title]['qty'] + 1;
                } else {
                    $product_arr[$renew_product_title] = array("title" => $renew_product_title , "price" => $renew_product_price, "qty" => 1);
                }
                if ($user_roles != 'editor') {
                    $post_author_id = get_post_field('post_author', $post_id);
                    $transfer_id = $post_author_id;
                }
                if ($point_transfer > 0 && $transfer_id != 0) {
                    $rewards_datetime = date('Y-m-d H:i:s', strtotime('-4 hours'));
                    $result1 = mysql_query("SELECT `balance` FROM `0gf1ba_rewards_details` WHERE user_id='$transfer_id' and is_last=1  ORDER BY `id` DESC LIMIT 1");
                    $balance = 0;
                    while ($row = mysql_fetch_assoc($result1)) {
                        //print_r($row);
                        $balance = $row["balance"];
                    }

                    if ($balance == 0) {
                        $new_balance = $point_transfer;
                    } else {
                        $new_balance = $point_transfer + $balance;
                    }
                    //echo $balance.'ccccccccccccc';
                    $renew_type1 = 'Renew Study' . '(' . $renew_type . ')';
                    $activity = 'Renew Study' . ' (' . $act_txt . ')';
                    mysql_query("UPDATE 0gf1ba_rewards_details SET is_last=0 WHERE user_id='$transfer_id'");
                    $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_rewards_details`(`id`, `user_id`, `activity_of_points`,`rewards_date_time`,`credit`,`debit`,`balance`,`is_last`) VALUES (NULL,'$transfer_id','$activity','$rewards_datetime','$point_transfer',0,'$new_balance',1)", array()));
                    update_user_meta($transfer_id, 'rewards', $new_balance);
                }

            }
            if($coupon){
                $coupon_data = get_coupon($coupon);
                $discount         = get_coupon($coupon);

                $old_price        = (float) $price2;
                if ($discount['type'] == "percent") {
                    $percent  = (float) $discount['value'];
                    $c_discount   = ($old_price / 100) * $percent;
                } else if ($discount['type'] == "fixed") {
                    $c_discount   = (float) $discount['value'];
                }
            }
            if ($price2 > $c_discount) {
                $price2 = $price2 - $c_discount;
                $discount_amount = $c_discount;
            } else {
                $discount_amount = $price2;
                $price2 = 0;
            }

            if (isset($_REQUEST['upgrade_type_suite']) && $_REQUEST['upgrade_type_suite'] == "Patient Messaging Suite $247"){
                $message_suite2 = 247;
                $message_suite_email = 'Yes';
            }
            if ($message_suite2 && $message_suite2 > 0) {
                $product_arr["Messaging Suite"] = array("title" => "Messaging Suite" , "price" => 247, "qty" => 1);
            }
            if ($boostStudy == "Patient Messaging Suite $247") {
                $sub_total = $price2;
            } else {
                $sub_total = $price2 + $message_suite2;
            }
			//setlocale(LC_MONETARY, "en_US");
            $sub_price = number_format( $sub_total ,  2 ,  '.' ,  ',' );
			$sub_price="$".$sub_price;
			//$total_price = str_ireplace("USD", "$", $sub_price);
            $total_price = str_ireplace(" ", "", $sub_price);
            if ($boostStudy) {
                $subject = "cro/sponsors focus " . $studytype . " (" . $study_no . ") Upgrade Request";
            } else {
                $subject = "cro/sponsors focus " . $studytype . " (" . $study_no . ") Renew Request";
            }
            $message .= "
<body>
<table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>";
            if ($boostStudy) {
                $message .= "<tr>
    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>CRO/SPONSORS FOCUS STUDY BOOST</strong></td>
  </tr>";
            } else {
                $message .= "<tr>
    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>CRO/SPONSORS FOCUS STUDY RENEW</strong></td>
  </tr>";
            }
            $message .= "<tr>
    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Number:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $study_no . "</td>
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
        <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$protocolnumber."</td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
        <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Name:</strong></td>
        <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sponsorname."</td>
  </tr>";
    if (strpos(strtolower($sponsoremail),'@studykik.com') == false) {
        $message .= " <tr style='color:#000; font-size:12px;'>
            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Email:</strong></td>
            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sponsoremail."</td>
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
  if ($boostStudy) {
	$message .="<tr style='color:#000; font-size:12px;'>
		<td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Start Date:</strong></td>
		<td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $currdate . "</td>
	  </tr>";
  }
  else{
	  $message .="<tr style='color:#000; font-size:12px;'>
			<td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Start Date:</strong></td>
			<td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $startdate . "</td>
		  </tr>";
  }
  $l1=0;
  if($contactname !=''){
	 if (strpos(strtolower($contactname),'@studykik.com') == false) {
	  $l1++;
   $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l1.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactname . "</td>
  </tr>";

  }
  }
   if($contactname2 !=''){
	  if (strpos(strtolower($contactname2),'@studykik.com') == false) {
	 $l1++;
  $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l1.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactname2 . "</td>

  </tr>";
	  }
   }
   if($contactemail3 !=''){
	  if (strpos(strtolower($contactemail3),'@studykik.com') == false) {
	 $l1++;
  $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l1.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail3 . "</td>
  </tr>";
	  }
   }
   if($contactemail4 !=''){
	  if (strpos(strtolower($contactemail4),'@studykik.com') == false) {
	 $l1++;
  $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l1.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail4 . "</td>
  </tr>";
	  }
   }
   if($contactemail5 !=''){
	  if (strpos(strtolower($contactemail5),'@studykik.com') == false) {
	 $l1++;
  $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l1.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail5 . "</td>
  </tr>";
	  }
   }
    if($contactemail6 !=''){
	   if (strpos(strtolower($contactemail6),'@studykik.com') == false) {
	 $l1++;
  $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l1.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail6 . "</td>
  </tr>";
	  }
	}
	 if($contactemail7 !=''){
	    if (strpos(strtolower($contactemail7),'@studykik.com') == false) {
	 $l1++;
  $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l1.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail7 . "</td>
  </tr>";
	  }
	 }
   $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactphone . "</td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Website:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $study_website . "</td>
  </tr>";
            if ($boostStudy) {
                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . ($boostStudy == "Patient Messaging Suite $247" ? $boost_type1 : $boostStudy) . "</td>
  </tr>";
                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Add Patient Messaging Suite ($247):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $message_suite_email . "</td>
  </tr>";
                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Coupon:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $coupon . "</td>
  </tr>";

                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Credit Card (Last 4 Digits):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $creditcard . "</td>
  </tr>";

                $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Paid by Check: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".($creditcard ? "No" : "Yes")."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Notes: </strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $notes . "</td>
                  </tr>";

            } else {
                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $renew_type . "</td>
  </tr>";
                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Add Patient Messaging Suite ($247):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $message_suite_email . "</td>
  </tr>";
                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Condense to 2 Weeks (Free):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $condense_2_weeks1_email . "</td>
  </tr>";
                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Coupon:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $coupon . "</td>
  </tr>";
                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Credit Card (Last 4 Digits):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $creditcard . "</td>
  </tr>";
                $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Paid by Check: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".($creditcard ? "No" : "Yes")."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Notes: </strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $notes . "</td>
                  </tr>";

            }
            $message .= "<tr>
    <td height='5' colspan='3' align='right' valign='middle'></td>
  </tr>
  <tr>
    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
  </tr>
</table>
</body>";



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
					<th colspan='3' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px; padding: 20px 0 4px 0;''>
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
				</tr>";

				$message_pdf .= "<tr align='center'>
				    <td align='left'></td>
				    <td align='left' colspan='2'><b>Study Type:</b> ".$studytype."</td>
                    <td align='center'> </td>
				    <td align='center'></td>
				</tr>
				";
				if ($boostStudy) {
        $message_pdf .= "<tr align='left'>
        <td align='left'> </td>
        <td align='left' colspan='2'><b>Study Level:</b> " . ($boostStudy == "Patient Messaging Suite $247" ? $boost_type1 : $boostStudy) . "</td>
	    <td align='center'> </td>
        <td align='center'> </td>
    </tr>";
    } else {
        $message_pdf .= "<tr align='left'>
        <td align='left'> </td>
        <td align='left' colspan='2'><b>Study Level:</b> " . $renew_type . "</td>
        <td align='center'> </td>
        <td align='center'> </td>
    </tr>";
    }
            $message_pdf .= "<tr align='left'>
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

            if ($boostStudy) {
                $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left' colspan='2'><b>Start Date:</b> ".$currdate."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
            }
            else{
                $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left' colspan='2'><b>Start Date:</b> ".$startdate."</td>
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
				<td align='left'></td>
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

            $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
            $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
            $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";

				if($message_suite_email == "Yes"){
				    $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>Patient Messaging Suite</td>
				    <td bordercolor='#000' align='left' colspan='2'> </td>
				    <td bordercolor='#000' align='center'> </td>
				    <td bordercolor='#000' align='right'>$".$message_suite2.".00</td>
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
                    $message_pdf .= "<tr align='left'>
                                    <td bordercolor='#000' align='left'>Coupon</td>
                                    <td bordercolor='#000' align='left' colspan='2'>".$coupon."</td>
                                    <td bordercolor='#000' align='center'> </td>
                                    <td bordercolor='#000' align='right'>-$".number_format( $discount_amount ,  2 ,  '.' ,  ',' )."</td>
                                    </tr>";
                } else {

                    $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left' colspan='2'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

                }
				$ht=380;

				$kl=7-$kn;
				if($kn<7){
				$tl=23*$kl;
				$ht=$ht+$tl;

				}
				$message_pdf .= "<tr class='sub_total' align='left'>
				<td align='center'  style='border-top:1px solid #000;'> </td>
				<td align='left' colspan='2' style='border-top:1px solid #000;'> </td>
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

				$message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:460px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

				}else{

					$message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:440px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

				}
				$message_pdf .= "</tr>
				</table></page>";
//            print_r($message);
//            print_r($message_pdf);

            if ($boostStudy) {
                $subject_pdf_email = "Thank You for Upgrading Your " . $studytype;
                $pdf_email_text .= "
Hi " . $fname . ",<br /><br />
Thank You for Upgrading Your " . $studytype . " with StudyKIK.<br /><br />
Please see invoice attached with detailed information.<br /><br />
If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
Thank you!<br /><br />
StudyKIK<br />
1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
info@studykik.com<br />
1-877-627-2509<br /><br /><br />
<img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png'/>";
                $headers[] = 'From: Listing Upgrade <info@studykik.com>';
                $headers[] = "MIME-Version: 1.0\r\n";
                $headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
            } else {
                $subject_pdf_email = "Thank You for Renewing your " . $studytype;
                $pdf_email_text .= "
Hi " . $fname . ",<br /><br />
Thank you for Renewing your " . $studytype . " with StudyKIK.<br /><br />
Please see invoice attached with detailed information.<br /><br />
If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
Thank you!<br /><br />
StudyKIK<br />
1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
info@studykik.com<br />
1-877-627-2509<br /><br /><br />
<img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png' />";
                $headers[] = 'From: Listing Renew <info@studykik.com>';
                $headers[] = "MIME-Version: 1.0\r\n";
                $headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
            }
            $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
            if ($croemail && filter_var($croemail, FILTER_VALIDATE_EMAIL)) {
                $headers_pdf[] = 'Cc: '.$croemail;
            }
            $headers_pdf[] = "MIME-Version: 1.0\r\n";
            $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
            require_once(dirname(__FILE__) . '/html2pdf/html2pdf.class.php');
            $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($message_pdf);
            $study_cat_name = str_replace(' ', '_', $studytype);
            $rand = rand();
            if ($boostStudy) {
                $html2pdf->Output(dirname(__FILE__) . "/pdf/" . $studytype . ' Upgrade Invoice' . ".pdf", "f");
                $html2pdf->Output($_SERVER['DOCUMENT_ROOT'] . "/pdf/" . $final_num . '_' . $studytype . '_Upgrade_Invoice' . ".pdf", "f");
                $pdf_attachment_path = dirname(__FILE__) . '/pdf/' . $studytype . ' Upgrade Invoice.pdf';
                $pdf_attachment_path_db = '/pdf/' . $final_num . '_' . $studytype . '_Upgrade_Invoice.pdf';
                $attachments[] = dirname(__FILE__) . '/pdf/' . $studytype . ' Upgrade Invoice.pdf';
                $attachments_pdf[] = $pdf_attachment_path_db;

            } else {
                $html2pdf->Output(dirname(__FILE__) . "/pdf/" . $studytype . ' ' . $renew_type . ' Renew Invoice' . ".pdf", "f");
                $html2pdf->Output($_SERVER['DOCUMENT_ROOT'] . "/pdf/" . $final_num . '_' . $studytype . '_Renew_Invoice' . ".pdf", "f");
                $pdf_attachment_path = dirname(__FILE__) . '/pdf/' . $studytype . ' ' . $renew_type . ' Renew Invoice.pdf';
                $pdf_attachment_path_db = '/pdf/' . $final_num . '_' . $studytype . '_Renew_Invoice.pdf';
                $attachments[] = dirname(__FILE__) . '/pdf/' . $studytype . ' ' . $renew_type . ' Renew Invoice.pdf';
                $attachments_pdf[] = $pdf_attachment_path_db;
            }
            $current_month = date('M');
            $current_year = date('Y');
            $full_date = date('m/d/y');
			$authh_id=get_post_field( 'post_author', $post_id);
            $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`(`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES (NULL,'$authh_id','$post_id','$pdf_attachment_path_db','$protocolnumber','$final_num','$total_price','$current_month','$current_year','Study Information','$full_date')"));

            if($user_ID == 70 || $user_ID == 532 || $user_ID == 534 ){
                wp_mail('mo.tan@studykik.com', $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);
                //wp_mail('arif.blissitsolutions@gmail.com', $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);
            }
            else
            {
                  wp_mail($current_user_email, $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);
            }

            //wp_mail("keshvendersingh145@gmail.com", $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);
            $pdf_email_text = "";
            $message_pdf = "";
            //wp_mail('chandel.anku91@gmail.com', $subject, $message, $headers, $attachments);
           //wp_mail('keshvendersingh145@gmail.com', $subject, $message, $headers, $attachments);
            $SendEmail = true;
            send_order_email($product_arr, array(
                "user_id" => $user_ID,
                "first_name" => ($card_id == "Check" ? $first_name : $card_billing_first_name),
                "last_name" => ($card_id == "Check" ? $last_name : $card_billing_last_name),
                "company" => $card_billing_company,
                "zip" => $card_billing_zip,
                "transaction_id" => "",
                "payment_type" => ($card_id == "Check" ? "Check" : $auth_card_type),
                "coupon" => $coupon,
                "coupon_amount" => $discount_amount,
                "invoice_number" => $_REQUEST['invoice_number'],
                "pdfs" => $attachments_pdf,
                "study_arr" => $study_arr
            ), $attachments, $message);

            if ($SendEmail && $boostStudy) {
                ?>
                <div id="embed" class="white_content" style="display: block;">
                    <h2 class="heading">Thank you</h2>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Thank you for Upgrading Your Study.  Additional Posts will be added within 24 hours!</p>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">
                        <input style=""  onclick="document.getElementById('embed').style.display = 'none';
                                document.getElementById('fade').style.display = 'none'" class="close_button" type="button" value="CLOSE"/>
                    </p>
                </div>
                <div id="fade" class="black_overlay"></div>
    <?php } else { ?>
                <div id="embed" class="white_content" style="display: block;">
                    <h2 class="heading">
                               <?php if ($susces == 1) { ?>
                            Thank you
        <?php } else {
            ?>
                            OOPS
        <?php }
        ?>
                    </h2>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">
                        <?php if ($susces == 1) { ?>
                            Thank you for relisting this study!  It will be live in 24 hours!
                        <?php } else {
                            ?>
                            There is some error occured, Please try after some time.
        <?php }
        ?>
                    </p>
                    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">
                        <input style=""  onclick="document.getElementById('embed').style.display = 'none';
                                document.getElementById('fade').style.display = 'none'" class="close_button" type="button" value="CLOSE"/>
                    </p>
                </div>
                <div id="fade" class="black_overlay"></div>
    <?php }
}
?>
        <div id="dialog-confirm" style="display:none; padding: 0px; text-align: center;"></div>
        <div id="banner_login">
            <div class="container">
                <div class="row">
                    <?php get_header("manager-submenu");?>
                </div>
                <div class="row">
                    <section class="container_current">
                        <?php



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


			    if ($user_roles == 'manager_username'){


				$meta_value=get_current_user_id();
				$_SESSION['manager_meta']=$meta_value;
				$sqladd=mysql_query("SELECT 0gf1ba_users.user_login,0gf1ba_users.ID FROM 0gf1ba_usermeta INNER JOIN 0gf1ba_users ON 0gf1ba_usermeta.user_id=0gf1ba_users.ID WHERE 0gf1ba_usermeta.meta_value=$meta_value and 0gf1ba_usermeta.meta_key='add_manager_id'");
				$num_add_row=mysql_num_rows($sqladd);
				if($num_add_row > 0){
				    while($row = mysql_fetch_assoc($sqladd)) {
					$uidds=$row['ID'];
					$is_site_used=get_user_meta($uidds, 'is_site_used', true);
					if($is_site_used !='yes'){
					    $uns=$row['user_login'];
					    $authors_ids[$uidds]=$uns;
					}
				    }
				}
				if(empty($authors_ids)){
//				    var_dump($_SERVER['REQUEST_URI']);die;
				    if(($_SERVER['REQUEST_URI']!='/dashboard/') && ($_SERVER['REQUEST_URI']!='/dashboard')){
					wp_redirect(site_url().'/dashboard', 301);
				    }
				}
				?>
				<div class="select_btn" style="margin-left:30px">
				    <?php
				    $sel_val='all';
				    if(isset($_REQUEST['aid'])){
					$sel_val=$_REQUEST['aid'];
				    }//point 1
				    ?>
				    <div class="ui-widget">
					<select id="combobox">
					    <option <?php if($sel_val=='all'){echo 'selected="selected"';}?> value="all">All</option>
					    <?php
					    natcasesort($authors_ids);
					    foreach($authors_ids as $auid => $qry){ ?>
						<option <?php if($auid == $sel_val){echo 'selected="selected"';}?> value="<?php echo $auid;?>"><?php echo $qry;?></option>
					    <?php
					    } ?>
					</select>
				    </div>
				</div>
				<a class="add_site" href="<?php echo site_url();?>/add-site/"><img style="width:135px;height:48px" src="<?php echo get_template_directory_uri(); ?>/images-dashboard/site_btn.png" alt="" class="img-responsive"></a>
				<?php
				$_SESSION['authors_ids'] = $authors_ids;
			    }
			?>
                        <?php
                        if ($user_roles == 'editor') { ?>
                        <div class="select_btn" style="visibility:hidden;">
                            <select class="drop_menu">
                              <option value="SELECT SITE">SELECT SITE</option>
                              <option value="SELECT SITE">SELECT SITE</option>
                              <option value="SELECT SITE">SELECT SITE</option>
                              <option value="SELECT SITE">SELECT SITE</option>
                            </select>
                         </div>

                        <?php } ?>

                        <div class="search-form col-12 col-md-6" style="padding-left:20px !important;">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header"> </div>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <div class="row">
                                    <div class="current_heading">
  <h4> <a class="<?php if ($study == "") {
                                        echo 'li_active';
                                         } ?> lll1" href="<?php echo site_url();?>/dashboard/">Current Study Listings</a> <a class="<?php if ($study) {
                                       echo 'li_active';
                                         } ?> lll2" href="<?php echo site_url();?>/dashboard/?study=pasts">PAST STUDIES</a>
        <?php //if($study){ echo 'Past Study Listings';}else{ echo 'Current Study Listings'; }  ?>
      </h4>
                                           <?php //if($study){ echo 'Past Study Listings';}else{ echo 'Current Study Listings'; }  ?>

                                        <div class="background_btn">
                                            <div  class="form-search form-inline">
<?php if ($study) { ?>
                                                    <input id="search_btn2" type="text" class="search-query-past" placeholder="Search a Study Listing" />
                                                <?php } else { ?>
                                                    <input id="search_btn" type="text" class="search-query" placeholder="Search a Study Listing" />
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--          </nav>
                                      </nav>-->
                            <div id="data2"></div>
                            <div id="data">
                                <div class="scroll-area" data-spy="scroll" data-target="#myNavbar" data-offset="0">
<?php

if ($user_roles == 'editor') {
    if ($study) {
        query_posts('author=' . $user_ID . '&posts_per_page=500&post_status=private');
    } else {
        $queryArgs = array(
            'post_status' => array('publish', 'draft', 'pending'),
            'author' => $user_ID,
            'post__not_in' => array(108),
            'posts_per_page' => 500
        );
        query_posts($queryArgs);
    }
} else {
    if($sel_val=='all'){
        if ($study) {
            $queryArgs = array(
                'post_status' => 'private',
                'posts_per_page' => 500,
                'post__not_in' => array(108),
                'meta_query' => array(
                    array(
                        'key' => 'manager_username',
                        'value' => $user_ID,
                        'type' => 'NUMERIC',
                        'compare' => '=',
                    )
                )
            );
            $post_results = query_posts($queryArgs);
        } else {
            $queryArgs = array(
                'post_status' => array('publish', 'draft', 'pending'),
                'posts_per_page' => 500,
                'post__not_in' => array(108),
                'meta_query' => array(
                    array(
                        'key' => 'manager_username',
                        'value' => $user_ID,
                        'type' => 'NUMERIC',
                        'compare' => '=',
                    )
                )
            );
            $post_results = query_posts($queryArgs);
        }
    }
    else{
        if ($study) {
            $queryArgs = array(
                'post_status' => 'private',
                'posts_per_page' => 500,
                'post__not_in' => array(108),
                'author' => $sel_val,
                'meta_query' => array(
                    array(
                        'key' => 'manager_username',
                        'value' => $user_ID,
                        'type' => 'NUMERIC',
                        'compare' => '=',
                    )
                )
            );
            $post_results = query_posts($queryArgs);
        }
        else {
            $queryArgs = array(
                'post_status' => array('publish', 'draft', 'pending'),
                'posts_per_page' => 500,
                'post__not_in' => array(108),
                'author' => $sel_val,
                'meta_query' => array(
                    array(
                        'key' => 'manager_username',
                        'value' => $user_ID,
                        'type' => 'NUMERIC',
                        'compare' => '=',
                    )
                )
            );
            $post_results = query_posts($queryArgs);
        }

    }
}
$i = 0;

if (have_posts()) {
    while (have_posts()) : the_post();

        $i++;
        ?>
                                            <dl class="clinical_trial">
              <dt style=" <?php if ($i == 1) {
                                echo 'color:#00afef;';
                            } if ($i == 2) {
                                echo 'color:#f78e1e;';
                            } if ($i == 3) {
                                echo 'color:#9fcf67;';
                            } ?>"> <a href="<?php the_permalink() ?>" style=" <?php if ($i == 1) {
                                echo 'color:#00afef;';
                            } if ($i == 2) {
                                echo 'color:#f78e1e;';
                            } if ($i == 3) {
                                echo 'color:#9fcf67;';
                            } ?>" target="_blank">
    <?php
                             $wppl_city=get_post_meta($post->ID, '_wppl_city', true);
                             $wppl_state=get_post_meta($post->ID, '_wppl_state', true);
                             $cat_name=get_post_meta($post->ID, 'custom_title_(for_thank_you_page)', true);
                             if (get_post_status($post->ID) == 'pending' || get_post_status($post->ID) == 'draft') { ?>
    <?php
//                                                $categories = get_the_category($post->ID);
//                                                $separator = ' ';
//                                                $output = '';
//                                                if ($categories) {
//                                                    foreach ($categories as $category) {
//                                                        $output .= $category->cat_name . $separator;
//                                                    }
//                                                    echo trim($output, $separator);
//                                                }
                                                echo $cat_name;
                                                ?>
    - <?php echo $wppl_city; ?>, <?php echo $wppl_state; ?>
    <?php } else { ?>
    <?php
//                                                $categories = get_the_category($post->ID);
//                                                $separator = ' ';
//                                                $output = '';
//                                                if ($categories) {
//                                                    foreach ($categories as $category) {
//                                                        $output .= $category->cat_name . $separator;
//                                                    }
//                                                    echo trim($output, $separator);
//                                                }
                                                echo $cat_name;
                                                ?>
    - <?php echo $wppl_city; ?>, <?php echo $wppl_state; ?>
    <?php } ?>
    </a>
    <p style="width:33%;text-align:left;float:right;margin-right:10px;margin-top:5px;"><?php echo 'Study End Date: '; ?>
      <?php
                                            $e_dt = get_field('study_end_date', $post->ID);
                                            if ($e_dt) {
                                                $dtend = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post->ID));
                                                echo $study_endt = $dtend->format('m/d/y');
                                            }
                                            ?>
    </p>
    <p style="width:100%; margin:0;"><b style=" <?php if ($i == 1) { echo 'color:#00afef;'; } if ($i == 2) { echo 'color:#f78e1e;';
                            } if ($i == 3) {  echo 'color:#9fcf67;'; } ?>">Sponsor:</b> <?php echo get_field('sponsor_name', $post->ID);?></p>
    <p style="width:100%;"><b style=" <?php if ($i == 1) { echo 'color:#00afef;'; } if ($i == 2) { echo 'color:#f78e1e;';
        } if ($i == 3) {  echo 'color:#9fcf67;'; } ?>">Protocol:</b> <?php echo get_field('protocol_no', $post->ID);?></p>
  </dt>



                                                <dd>
                                                <?php the_excerpt();
                                                echo "&nbsp;"?>


                                                </dd>
                                                 <a  style=" <?php if ($i == 1) {
                                                echo 'background:#00afef;';
                                            } if ($i == 2) {
                                                echo 'background:#f78e1e;';
                                            } if ($i == 3) {
                                                echo 'background:#9fcf67;';
                                            } ?>" class="patient" href="<?php echo site_url();?>/patients-details/?pid=<?php echo $post->ID; ?>">View Patients ></a>
                                                    <?php
                                                    $exposure_level = get_post_meta($post->ID, 'exposure_level', true);
                                                    if ($exposure_level == "Platinum") {
                                                        $goal_total = "Boost this study with an additional 10 posts for $559?";
                                                        $boost_pack = 'Platinum';
                                                    }
                                                    if ($exposure_level == "Gold") {
                                                        $goal_total = "Boost this study to Platinum with an additional 20 posts for $1000?";
                                                        $boost_pack = 'Gold';
                                                    }
                                                    $study_publish_date = get_the_date('m/d/Y');
                                                    if (get_field('study_end_date', $post->ID)) {
                                                        $date2 = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post->ID));
                                                        $study_end_date = $date2->format('Y-m-d');
                                                    } else {
                                                        $study_end_date = '2015-12-30';
                                                    }
                                                    $datetime1 = date_create($study_publish_date);
                                                    $datetime2 = date_create($study_end_date);
                                                    $interval = date_diff($datetime1, $datetime2);
                                                    $total_number_of_days = str_replace("+", "", $interval->format('%R%a'));
                                                    if ($total_number_of_days < 16) {
                                                        $day_left = "Are you sure you want to renew this study for another 15 Day period?";
                                                    }
                                                    if ($total_number_of_days > 16) {
                                                        $day_left = "Are you sure you want to renew this study for another 30 Day period?";
                                                    }
                                                    if (get_post_status($post->ID) == 'private') {
                                                        ?>
                                                 <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                     echo 'background:#00afef;';
                                      } if ($i == 2) {
                                      echo 'background:#f78e1e;';
                                       } if ($i == 3) {
                                       echo 'background:#9fcf67;';
                                      } ?>" class="patient" onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'block';
                                     document.getElementById('fade').style.display = 'block';alignRenewStudyText(<?php echo $post->ID; ?>)" href="javascript:void(0);">Renew Study ></a>

                                                        <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                                            echo 'background:#00afef;';
                                                        } if ($i == 2) {
                                                            echo 'background:#f78e1e;';
                                                        } if ($i == 3) {
                                                            echo 'background:#9fcf67;';
                                                        } ?>" class="patient" onclick="document.getElementById('embed2<?php echo $post->ID; ?>').style.display = 'block';
                                                            document.getElementById('fade').style.display = 'block';alignUpdateStudyText(<?php echo $post->ID; ?>);" href="javascript:void(0);">Upgrade Study ></a>
                                                    <?php } else { ?>
                                              <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                     echo 'background:#00afef;';
                                      } if ($i == 2) {
                                      echo 'background:#f78e1e;';
                                       } if ($i == 3) {
                                       echo 'background:#9fcf67;';
                                      } ?>" class="patient" onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'block';
                                     document.getElementById('fade').style.display = 'block';alignRenewStudyText(<?php echo $post->ID; ?>)" href="javascript:void(0);">Renew Study ></a>

                                                  <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                           echo 'background:#00afef;';
                                            } if ($i == 2) {
                                            echo 'background:#f78e1e;';
                                            } if ($i == 3) {
                                            echo 'background:#9fcf67;';
                                           } ?>" class="patient" onclick="document.getElementById('embed2<?php echo $post->ID; ?>').style.display = 'block';
                                     document.getElementById('fade').style.display = 'block';alignUpdateStudyText(<?php echo $post->ID; ?>);" href="javascript:void(0);">Upgrade Study ></a>

                                                <?php } ?>
                                            </dl>
                                                <?php
                                                if ($i == 3) {
                                                    $i = 0;
                                                }
                                                ?>
    <?php
    endwhile;

    wp_reset_query();
} else {
    ?>
                                        <dl class="clinical_trial">
                                            <dt style=" <?php
    if ($i == 1) {
        echo 'color:#00afef;';
    } if ($i == 2) {
        echo 'color:#f78e1e;';
    } if ($i == 3) {
        echo 'color:#9fcf67;';
    }
    ?>"> No Listings Found! </dt>
        <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="<?php echo site_url();?>/clinical-study-information-dashboard/">
                                <img src="<?php bloginfo('template_url'); ?>/images-dashboard/new_study.png" alt="" class="img-responsive">
                            </a>
                            <a href="<?php echo site_url();?>/rewards/">
                                <img src="<?php bloginfo('template_url'); ?>/images-dashboard/rewards.png" alt="" class="img-responsive">
                            </a>
                            <a href="<?php echo site_url();?>/refer-listing/ ">
                                <img src="<?php bloginfo('template_url'); ?>/images-dashboard/refer_listin.png" alt="" class="img-responsive irt">
                            </a>
                            <a href="javascript:void(0);" class="irbCreation">
                                <img src="<?php bloginfo('template_url'); ?>/images-dashboard/irb_ad_creation.png" alt="" class="img-responsive">
                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
        <?php
        if ($user_roles == 'editor') {

                global $wp_query;

                $_query_base_args = array(
                    'post_status' => $study ? array('private') : array('publish', 'draft', 'pending'/*, 'private'*/),
                    'post__not_in' => array(108),
                    'posts_per_page' => 500,
                );

                query_posts( array_merge($_query_base_args, array('author' => $user_ID)));
                $_tmp_results1 = $wp_query->posts;


                // add studies, where user is specified in one of UsernameX fields
                $_qry_arr = array('relation' => 'OR');
                for($i=1;$i<6;$i++){
                    $_qry_arr[] = array('key' => 'author_' . $i, 'value' => $user_ID);
                }
                query_posts( array_merge($_query_base_args, array('meta_query' => $_qry_arr)));
                $_tmp_results2 = $wp_query->posts;

                // run through $_tmp_results2 to exclude posts from $_tmp_results1
                foreach($_tmp_results2 as $_tmp_results2_key => $_tmp_results2_value){
                    foreach($_tmp_results1 as $_tmp_results1_value){
                        if($_tmp_results2_value->ID == $_tmp_results1_value->ID){
                            unset($_tmp_results2[$_tmp_results2_key]);
                            break;
                        }
                    }
                }


                $wp_query->posts = array_merge($_tmp_results1, $_tmp_results2);
                $wp_query->post_count = count($wp_query->posts);
        } else {
            if($sel_val=='all'){
                if ($study) {
                    $queryArgs = array(
                        'post_status' => array('private'),
                        'posts_per_page' => 500,
                        'post__not_in' => array(108),
                        'meta_query' => array(
                            array(
                                'key' => 'manager_username',
                                'value' => $user_ID,
                                'type' => 'NUMERIC',
                                'compare' => '=',
                            )
                        )
                    );
                    query_posts($queryArgs);
                } else {
                    $queryArgs = array(
                        'post_status' => array('publish', 'draft', 'pending'),
                        'posts_per_page' => 500,
                        'post__not_in' => array(108),
                        'meta_query' => array(
                            array(
                                'key' => 'manager_username',
                                'value' => $user_ID,
                                'type' => 'NUMERIC',
                                'compare' => '=',
                            )
                        )
                    );
                    query_posts($queryArgs);
                }
            }
            else{
                if ($study) {
                    $queryArgs = array(
                        'post_status' => array('private'),
                        'posts_per_page' => 500,
                        'post__not_in' => array(108),
                        'author' => $sel_val,
                        'meta_query' => array(
                            array(
                                'key' => 'manager_username',
                                'value' => $user_ID,
                                'type' => 'NUMERIC',
                                'compare' => '=',
                            )
                        )
                    );
                    query_posts($queryArgs);
                } else {
                    $queryArgs = array(
                        'post_status' => array('publish', 'draft', 'pending'),
                        'posts_per_page' => 500,
                        'post__not_in' => array(108),
                        'author' => $sel_val,
                        'meta_query' => array(
                            array(
                                'key' => 'manager_username',
                                'value' => $user_ID,
                                'type' => 'NUMERIC',
                                'compare' => '=',
                            )
                        )
                    );
                    query_posts($queryArgs);
                }
            }
        }
        $i = 0;
        if (have_posts()) {
            while (have_posts()) : the_post();
                $i++;
                ?>
        <?php
        $exposure_level = get_post_meta($post->ID, 'exposure_level', true);
        if ($exposure_level == "Platinum") {
            $boost_pack = 'Platinum';
        }
        if ($exposure_level == "Gold") {
            $boost_pack = 'Gold';
        }
        ?>
                <script type="text/javascript">
                                                       jQuery(function () {
                                                           jQuery("#datepicker<?php echo $post->ID; ?>").datepicker();
                                                       });

                </script>
                <div id="embed<?php echo $post->ID; ?>" class="white_content" style="display: none;">
                    <!-- client renewal -->
                    <h2 class="heading">Renew Study Confirmation</h2>
                    <p style="color: #000; padding: 15px 15px 5px ; font-size: 16px; text-align: center;font-weight: bold;">What level would you like to renew this study for?</p>
                    <form action="" method="post" class="form-renew-client-study-<?php echo $post->ID; ?>" style="text-align: center;" >
                        <div class="renew-study-align-block-<?php echo $post->ID; ?>">
                        <select name="renew_type" class="renew_type required" style="width:230px; padding: 6px; margin-bottom:5px;">
                            <option value="">Select Level *</option>
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
                        </select>
                        </div>
                        <div class="renew-study-align-block-<?php echo $post->ID; ?>">
                            <input type="text" class="required" value="<?php echo date('m/d/Y', strtotime('-5 hours')); ?>" placeholder="Select Start Date *" id="datepicker<?php echo $post->ID; ?>" name="select_date" style="width:230px; height: 32px;" />
                            <a href="#" style="color: #00afef;font-weight: bold;" id="<?php echo $post->ID; ?>" class="tbd-checkbox">To be determined</a>
                        </div>
                        <div class="renew-study-align-block-<?php echo $post->ID; ?>" style="float:left; margin-left:307px; margin-top:4px;"><p style="margin: 0px;">
                                <label>Add Patient Messaging Suite ($247): </label>
                                <input type="checkbox" name="message_suite_2471">
                                <span style="color: #00afef;margin-left: 10px;font-weight: bold;">Yes</span></p></div>
                        <div class="play_video_bttn_wrap"><div style="margin-bottom: -5px;" class="play_video_bttn" onclick="showVideo()"></div></div>
                        <div style="clear: both;"></div>
                        <div class="renew-study-align-block-<?php echo $post->ID; ?>">
                        <p style="margin: 0px;">
                            <label>Condense to 2 Weeks (Free): </label>
                            <input type="checkbox" name="condense_2_weeks1">
                            <span style="color: #00afef;margin-left: 10px;font-weight: bold;">Yes</span></p>
                        </div>
                            <?php //echo $day_left; ?>
                        <input type="hidden" name="postID" value="<?php echo $post->ID; ?>" />
                        <?php
                            // seedcms
                            $ecommerce_enabled = get_option('ecommerce_enabled');
//                            $ecommerce_enabled = 1;

                            if((bool) $ecommerce_enabled){
                        ?>
                            <select name="select_card" data-id="<?php echo $post->ID;?>" class="go-card-client-renew required cards-<?php echo $post->ID;?> renew_type select_card_cls" style="padding: 6px; margin-bottom:5px;width:230px" un_id="<?php echo $post->ID; ?>">
                                <option value="">Select Card *</option>
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
                                        echo '<option value="'.$card->ID.'" data-cvv="'.$auth_card_code.'" data-shipping-id="'.$auth_shipping_profile.'" data-profile-id="'.$auth_profile_id.'" data-payment-id="'.$auth_payment_profile.'">xxxx xxxx xxxx '.$auth_credit_card.'</option>';
                                      }
                                      
                                    }
                                  }
                                  // loop cards here  
                                ?>
                                <option value="Add a card">Add a card</option>
                                <?php if((bool) $is_check_allowed){ ?><option value="Check">Pay by Check</option><?php } ?>
                            </select>
                            </br>
                            <input type="text" value="" placeholder="Coupon" id="coupon-input-renew-client" name="coupon" class="coupon-input" style="height: 32px;" />
                                </br>
                                <textarea value="" placeholder="Notes" id="notes-input-renew-client" name="notes" class="coupon-input" rows="3"/></textarea>
                            </br>
                                <div class="warning-message"></div>
                                <br/>
                        <?php } ?>
                        <input class="done_button go-renew-button-client renew-button-<?php echo $post->ID; ?>" data-id="<?php echo $post->ID; ?>" type="submit" value="Renew My Study" />
                        <input  name="payment_credit_card_id" id="payment_credit_card_id_2" type="hidden" value="" />
                        <input  name="payment_profile_id" id="payment_profile_id_2" type="hidden" value="" />
                        <input  name="payment_payment_id" id="payment_payment_id_2" type="hidden" value="" />
                        <input  name="payment_shipping_id" id="payment_shipping_id_2" type="hidden" value="" />
                        <input  name="payment_card_code" id="payment_card_code_2" type="hidden" value="" />
                        <input  name="invoice_number" id="invoice_number_<?php echo $post->ID; ?>" type="hidden" value="" />
                        <input  name="action" type="hidden" value="renew_study" />
                        <input  name="study_id" type="hidden" value="<?php echo $post->ID; ?>" />
                    </form>
                    <a onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'none';
                            document.getElementById('fade').style.display = 'none';
                       " href="javascript:void(0);" class="closepop">Close</a> </div>
                <div id="embed2<?php echo $post->ID; ?>" class="upgrade_white_content" style="display: none;">
                    <!-- seedcms upgrade study confirmation client-->
                    <h2 class="heading">Upgrade Study Confirmation</h2>
                    <form action="" method="post" class="form-upgrade-study-<?php echo $post->ID; ?>" style="text-align: center;" >
                        <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;font-weight: bold;">Upgrade this study to:</p>
                        <input type="hidden" name="upgrade_type_suite" id="upgrade_type_suite-<?php echo $post->ID; ?>" value=""/>
                        <select name="upgrade_type" class="upgrade_type" id="upgrade_type-<?php echo $post->ID; ?>" style="padding: 6px; margin-bottom:6px; width:230px; margin-top: -5px;">
                            <option value="">Select Upgrade*</option>
                            <?php if ($exposure_level == "Bronze") { ?>
                                <option value="Silver $150">Silver $150</option>
                                <option value="Gold $500">Gold $500</option>
                                <option value="Platinum $1500">Platinum $1500</option>
                                <option value="Diamond $3000">Diamond $3000</option>
                            <?php } ?>
                            <?php if ($exposure_level == "Silver") { ?>
                                <option value="Gold $340">Gold $340</option>
                                <option value="Platinum $1340">Platinum $1340</option>
                                <option value="Diamond $2840">Diamond $2840</option>
                            <?php } ?>
                            <?php if ($exposure_level == "Gold") { ?>
                                <option value="Platinum $1000">Platinum $1000</option>
                                <option value="Diamond $2500">Diamond $2500</option>
                            <?php } ?>
                            <?php if ($exposure_level == "Platinum") { ?>
                                <option value="Diamond $1500">Diamond $1500</option>
                            <?php } ?>
                            <?php if ($exposure_level == "Diamond") { ?>
                                <option value="Diamond $1500">Diamond $1500</option>
                            <?php } ?>
                        </select>
                        <div style="clear: both;"></div>
                        <div class="patient_messaging_suite_wrap-<?php echo $post->ID; ?>" style="float: left; text-align: left;">
                            <div style="margin-top:4px;">
                                <label> Patient MessagingSuite ($247)</label>
                                <span style="margin-left: 15px; padding: 4px 4px 0px 5px;"><input style="" type="checkbox" name="patient_messaging_suit_update" id="patient_messaging_suit_checkbox_id-<?php echo $post->ID; ?>"/></span>
                                <label style="color:#00afef;" for="patient_messaging_suit_checkbox_id-<?php echo $post->ID; ?>"> Yes </label>
                            </div>
                        </div>
                        <div class="play_video_bttn_wrap"><div style="margin-bottom: -5px;" class="play_video_bttn" onclick="showVideo()"></div></div>
                        <input type="hidden" name="postID" value="<?php echo $post->ID; ?>" />
                    <?php
                        // seedcms
                        $ecommerce_enabled = get_option('ecommerce_enabled');
                        if((bool) $ecommerce_enabled){
                    ?>
                            <br/>
                        <select name="select_card" data-id="<?php echo $post->ID;?>" class="go-card-client required cards-<?php echo $post->ID;?> renew_type select_card_cls" style="padding: 6px; margin-bottom:5px;width:230px" un_id="<?php echo $post->ID; ?>">
                        
                            <option value="">Select Card *</option>
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
                                    echo '<option value="'.$card->ID.'" data-cvv="'.$auth_card_code.'" data-shipping-id="'.$auth_shipping_profile.'" data-profile-id="'.$auth_profile_id.'" data-payment-id="'.$auth_payment_profile.'">xxxx xxxx xxxx '.$auth_credit_card.'</option>';
                                  }
                                  
                                }
                              }
                              // loop cards here  
                            ?>
                            <option value="Add a card">Add a card</option>
                            <?php if((bool) $is_check_allowed){ ?><option value="Check">Pay by Check</option><?php } ?>
                        </select>
                        <br/>
                            <input type="text" value="" placeholder="Coupon" id="coupon-input-upgrade" name="coupon" class="coupon-input" style="height: 32px;" />
                            </br>
                            <textarea value="" placeholder="Notes" id="notes-input-upgrade" name="notes" class="coupon-input" rows="3"/></textarea>
                            <br/>
                            <div class="warning-message"></div>
                            <br/>
                    <?php } ?>
                        <!-- <input  class="done_button" type="submit" value="Upgrade My Study" /> -->
                        <input class="done_button go-upgrade-button upgrade-button-<?php echo $post->ID; ?>" data-id="<?php echo $post->ID; ?>" type="submit" value="Upgrade My Study" />
                        <input  name="payment_credit_card_id" id="payment_credit_card_id_x2" type="hidden" value="" />
                        <input  name="payment_profile_id" id="payment_profile_id_x2" type="hidden" value="" />
                        <input  name="payment_payment_id" id="payment_payment_id_x2" type="hidden" value="" />
                        <input  name="payment_shipping_id" id="payment_shipping_id_x2" type="hidden" value="" />
                        <input  name="payment_card_code" id="payment_card_code_x2" type="hidden" value="" />
                        <input  name="invoice_number" id="invoice_number_<?php echo $post->ID; ?>" type="hidden" value="" />
                        <input  name="action" type="hidden" value="upgrade_study" />
                        <input  name="study_id" type="hidden" value="<?php echo $post->ID; ?>" />
                    </form>
                    <a onclick="document.getElementById('embed2<?php echo $post->ID; ?>').style.display = 'none';
                            document.getElementById('fade').style.display = 'none';" href="javascript:void(0);" class="closepop">Close</a> </div>
    <?php
    endwhile;
    wp_reset_query();
}
?>
<script>
    		$(".custom-combobox").change(function () {

        var user_id = this.value;
		var url      = window.location.href;
	  if(user_id == "" || user_id == ""){}else{
	  location.search = "aid="+user_id;
	 }
    });
    </script>
        <div id="fade" class="black_overlay"></div>
        <?php get_footer('responsive'); ?>
    <?php }    }
?>
<script type='text/javascript'>
    var last_update_opened_id = '';
    var last_renew_opened_id = '';
    function alignUpdateStudyText(id){
        last_update_opened_id = id;
        $('.patient_messaging_suite_wrap-'+id).css('margin-left', $('#upgrade_type-'+id).position().left);
    }
    function alignRenewStudyText(id){
        last_renew_opened_id = id;
        $('.renew-study-align-block-'+id).css('margin-left', $('.cards-'+id).position().left).css('text-align', 'left');
    }
    jQuery(document).ready(function ($) {
        jQuery( window ).resize(function() {
            if (last_update_opened_id){
                alignUpdateStudyText(last_update_opened_id);
            }
            if (last_renew_opened_id){
                alignRenewStudyText(last_renew_opened_id);
            }
        });
    });
</script>
<style>
.play_video_bttn_wrap{
    display: table-cell;
}

.play_video_bttn{
    background: url("<?php bloginfo('template_url'); ?>/images/play_bttn.png") no-repeat scroll 0 0;
    width:104px;
    height:36px;
    margin-left: 22px;
    margin-bottom: 4px;
}

.play_video_bttn:hover{
    cursor: pointer;
}
</style>
<?php if (is_user_logged_in()) {
    $user_ID = get_current_user_id();
    $user_info = get_userdata($user_ID);
    $user_roles = implode(', ', $user_info->roles);
    if (($user_roles == "editor")) {?>
<?php
session_start();
$_SESSION['authors_ids']="";
$susces=1;

?>
<?php get_header('dashboard'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/dashboard-card.css">
<script src="<?php bloginfo('template_url');?>/combobox/jquery-1.10.2.js"></script>
	<script src="<?php bloginfo('template_url');?>/combobox/jquery-ui.js"></script>
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
            if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete'))
            {
                var w = new PCWidget({c: 'bab234e1-3a99-448d-b117-2bb29457f303', f: true});
                done = true;
            }
        };
    })();
</script>
<style>
.white_content {
    background-color: white;
    border-radius: 10px;
    cursor: auto;
    display: none;
    left: 23% !important;
    overflow: auto;
    position: fixed !important;
    top: 26.2% !important;
    width: 54% !important;
    z-index: 99999 !important;
    border: 1px solid #f78e1e;
}
.upgrade_white_content {
    background-color: white;
    border-radius: 10px;
    cursor: auto;
    display: none;
    left: 23% !important;
    overflow: auto;
    position: fixed !important;
    top: 29.9% !important;
    width: 54% !important;
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
.close_button {
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
.done_button {
	background: #9fce64;
	border: medium none;
	color: #fff;
	font-family: alternate;
	font-size: 33px;
	/*margin: 10px 0 10px 34%;*/
        padding: 0 26px;
	margin-bottom:20px;
}
.patient {
	width:150px;
}
dd {
	min-height: 25px;
}
</style>
<!--<script src="<?php //echo get_template_directory_uri(); ?>/js/jquery-1.10.2.js"></script>-->
<script type="text/javascript">
    jQuery(document).ready(function ($) {

        jQuery('#data2').hide();
        jQuery("#search_btn").keyup(function () {
            var that = this;
            var search_string = this.value;

            jQuery('#data').hide();

            setTimeout( function() {
                var dInput = that.value;
                if (dInput == search_string) {
                    if (search_string == "") {
                        jQuery('#data2').hide();
                        jQuery('#data').show();
                    } else {
                        jQuery('.search-form').addLoadingIndicator();
                        jQuery('#search_btn').prop('disabled', true);
                        jQuery.ajax({
                            type: "GET",
                            url: "<?php bloginfo('url'); ?>/find-listing-using-jquery/",
                            data: "sticky=" + dInput,
                            success: function (data) {
                                jQuery('#data2').html(data);
                                jQuery('#data2').show();
                                jQuery('.search-form').removeLoadingIndicator();
                                jQuery('#search_btn').prop('disabled', false);
                            }
                        });
                    }
                }
            }, 500);

        });
        jQuery("#search_btn2").keyup(function () {
            var that = this;
            var search_string = this.value;

            jQuery('#data').hide();
            setTimeout( function() {
                var dInput = that.value;
                jQuery('#data').hide();
                if (dInput == search_string) {
                    if (search_string == "") {
                        jQuery('#data2').hide();
                        jQuery('#data').show();
                    } else {
                        jQuery('.search-form').addLoadingIndicator();
                        jQuery('#search_btn2').prop('disabled', true);
                        jQuery.ajax({
                            type: "GET",
                            url: "<?php bloginfo('url'); ?>/jquery-past-studies/",
                            data: "sticky2=" + dInput,
                            success: function (data) {
                                jQuery('#data2').html(data);
                                jQuery('#data2').show();
                                jQuery('.search-form').removeLoadingIndicator();
                                jQuery('#search_btn2').prop('disabled', false);
                            }
                        });
                    }

                }
            }, 500 );
        });
    });
</script>
<script language="javascript">
<?php if (!empty($_REQUEST['study'])) {
    ?>
        function renewStudy(post_id) {
            jQuery("#embed" + post_id).hide('slow');
            location.search = "?study=pasts&postID=" + post_id;
            return true;
        }
        function boostStudy(post_id, boostpack) {
            jQuery("#embed2" + post_id).hide('slow');
            location.search = "?study=pasts&postID=" + post_id + "&boostStudy=" + boostpack;
            return true;
        }
<?php } else { ?>
        function validate_renew_type(post_id) {
            var selected_value = jQuery('#embed' + post_id + ' .renew_type').val();
			var datepicker = jQuery('#embed' + post_id + ' #datepicker').val();
            if (selected_value == "") {
                jQuery('#embed' + post_id + ' .renew_type').css('border', '1px solid red');
                return false;
            }
			if (datepicker == "") {
                jQuery('#embed' + post_id + ' #datepicker').css('border', '1px solid red');
                return false;
            }
        }
        function validate_upgrade_type(post_id) {
            var selected_value = jQuery('#embed2' + post_id + ' .upgrade_type').val();
            if (selected_value == "") {
                jQuery('#embed2' + post_id + ' .upgrade_type').css('border', '1px solid red');
                return false;
            }
        }
<?php } ?>
</script>
<?php
$study = $_REQUEST['study'];
//print_r($study);die;
$user_id = $user_ID;
$current_user = wp_get_current_user();
$current_user_email = $current_user->user_email;
$fullname = $current_user->user_firstname;
$first_name                  = get_user_meta($user_id, "first_name", true);
$last_name                   = get_user_meta($user_id, "last_name", true);
$first_name_arr = explode(" ", $fullname);
$fname =  $first_name_arr[0];
$query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` ORDER BY `id` DESC LIMIT 1");
foreach($query_invoice_number as $query_invoice_number_value){
 $invoice_num = $query_invoice_number_value->invoice_number;
}
if (!empty($_REQUEST['postID']) || !empty($_REQUEST['boostStudy'])) {//point 1
    $post_id = $_REQUEST['postID'];
    $study_arr = array();
    $study_arr[] = $post_id;
    $boostStudy = stripslashes($_REQUEST['upgrade_type']);
    if (!$boostStudy && isset($_REQUEST['upgrade_type_suite']) && $_REQUEST['upgrade_type_suite']){
        $boostStudy = $_REQUEST['upgrade_type_suite'];
    }
    $renew_product_id = $_REQUEST['renew_type'];
    $renew_product_title = get_the_title($renew_product_id);
    $renew_product_title_parts = explode(" ", $renew_product_title);
    $renew_product_price = (float)get_post_meta($renew_product_id, "product_price", true);
    $renew_product_points = get_post_meta($renew_product_id, "points", true);
    $renew_type = $renew_product_title_parts[0] . " $" . $renew_product_price;
    $coupon = $_REQUEST['coupon'];
    $notes = stripslashes($_REQUEST['notes']);

    $card_id = $_REQUEST['select_card'];
    $creditcard =  get_post_meta($card_id, 'auth_credit_card', true);

    $auth_card_type              = get_post_meta($card_id, 'auth_card_type', true);
    $auth_credit_card            = get_post_meta($card_id, 'auth_credit_card', true);
    $card_billing_first_name     = get_post_meta($card_id, 'card_billing_first_name', true);
    $card_billing_last_name      = get_post_meta($card_id, 'card_billing_last_name', true);
    $card_billing_zip            = get_post_meta($card_id, 'card_billing_zip', true);
    $card_billing_company        = get_post_meta($card_id, 'card_billing_company', true);
    if (!$card_billing_company) {
        $card_billing_company = $company;
    }

    $c_discount = 0;
    $discount_amount = 0;

    $product_arr = array();

    $date = date('Y-m-d H:i:s');
    $message_suite_2471 = $_REQUEST['message_suite_2471'];
    $condense_2_weeks1 = $_REQUEST['condense_2_weeks1'];

	$select_date = $_REQUEST['select_date'];

    if (isset($_REQUEST['message_suite_2471'])) {
        $message_suite2 = '247';
        $message_suite_email = 'Yes';
    }
    if (isset($_REQUEST['condense_2_weeks1'])) {
        $condense_2_weeks1_email = 'Yes';
    }
	$final_num =  $invoice_num+1;

    $sponsorname = get_post_meta($post_id, 'sponsor_name', true);
    $sponsoremail = get_post_meta($post_id, 'sponsor_email', true);
    $contactname = get_post_meta($post_id, 'email_adress', true);
    $contactname2 = get_post_meta($post_id, 'email_adress_2', true);
    $contactemail3 = get_post_meta($post_id, 'email_adress_3', true);
    $contactemail4 = get_post_meta($post_id, 'email_adress_4', true);
    $contactemail5 = get_post_meta($post_id, 'email_adress_5', true);
    $contactemail6 = get_post_meta($post_id, 'email_adress_6', true);
    $contactemail7 = get_post_meta($post_id, 'email_adress_7', true);
    $contactphone = get_post_meta($post_id, 'phone_number', true);
    $protocolnumber = get_post_meta($post_id, 'protocol_no', true);
    $boost_type1 = get_exposure_level_string($post_id);
//    print_r($boost_type1);
    $sitename = get_post_meta($post_id, 'name_of_site', true);
    $studylocation = get_post_meta($post_id, 'study_full_address', true);
    $croname = get_post_meta($post_id, 'cro_name', true);
    $croemail = get_post_meta($post_id, 'cro_email', true);
    $irbname = get_post_meta($post_id, 'irb_name', true);
    $irbemail = get_post_meta($post_id, 'irb_email', true);
    $study_website = get_post_meta($post_id, 'website_url_thank_you_page', true);
    $studytype = get_post_meta($post_id, 'custom_title_(for_thank_you_page)', true);
    $attachments111 = get_post_meta($post_id, 'file_url', true);
    $study_no = get_post_meta($post_id, 'study_no', true);

    //echo $study_no;die;
    if ($boostStudy) {
        $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_coupons` (`user_id`,`post_id`,`date`,`action`,`coupon_code`) VALUES ('$user_ID','$post_id','$date','upgrade_study','$coupon')",array()));
        update_post_meta($post_id, 'coupon', $coupon);
        if (get_field('study_end_date', $post_id)) {
            $date2 = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post_id));
            $newDate = $date2->format('m/d/Y');
        } else {
            $newDate = '';
        }
        $startdate = date("m/d/Y", strtotime($newDate . " -31 days"));
    } else {
        $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_coupons` (`user_id`,`post_id`,`date`,`action`,`coupon_code`) VALUES ('$user_ID','$post_id','$date','renew_study','$coupon')",array()));
        update_post_meta($post_id, 'coupon', $coupon);
        $study_publish_date = get_the_date('m/d/Y', $post_id);
        if (get_field('study_end_date', $post_id)) {
            $date2 = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post_id));
            $study_end_date = $date2->format('Y-m-d');
        } else {
            $study_end_date = '2015-12-30';
        }
        $datetime1 = date_create($study_publish_date);
        $datetime2 = date_create($study_end_date);
        $interval = date_diff($datetime1, $datetime2);
        $total_number_of_days = str_replace("+", "", $interval->format('%R%a'));
        if ($study == "pasts") {
            //$startdate = date("m/d/Y");
			 $startdate = $select_date;
        } else {
            $startdate = $select_date;
        }

		if($condense_2_weeks1_email){
            $newDate = date("m/d/Y", strtotime($startdate . " +15 day"));
            $wpFormatNewDate = date("Ymd", strtotime($startdate . " +30 day"));
            update_post_meta($post_id, 'condence', true);
        } else{
            $newDate = date("m/d/Y", strtotime($startdate . " +30 day"));
            $wpFormatNewDate = date("Ymd", strtotime($startdate . " +30 day"));
            update_post_meta($post_id, 'condence', false);
        }
    }
    if ($boostStudy) {
        $pr=explode("$",$boostStudy);
	$prc=$pr[1];
	$pric=number_format($prc,2,'.',',');
	$price='$' .$pric;
        //$price = '$' . $boostStudy . '.00';
        //$price2 = $boostStudy . '.00';
	$price2=(int)$prc;
        if ($boostStudy == "Patient Messaging Suite $247") {
            $price = "";
            $price2 = 247;
            $message_suite2 = '247';
            $message_suite_email = 'Yes';
        } else {
            if ($product_arr[$pr[0].'Listing']) {
                $product_arr[$pr[0].'Listing']['qty'] = $product_arr[$pr[0].'Listing']['qty'] + 1;
            } else {
                $product_arr[$pr[0].'Listing'] = array("title" => $pr[0].'Listing' , "price" => $price2, "qty" => 1);
            }
        }

    } else {
        $point_transfer=0;
        $transfer_id=$user_ID;
        $act_txt="";

        $price = '$'.str_replace('USD ','',money_format('%i', $renew_product_price));
        $price2 = $renew_product_price;
        $point_transfer = $renew_product_points;
        $act_txt = $renew_product_title_parts[0];

        if ($product_arr[$renew_product_title]) {
            $product_arr[$renew_product_title]['qty'] = $product_arr[$renew_product_title]['qty'] + 1;
        } else {
            $product_arr[$renew_product_title] = array("title" => $renew_product_title , "price" => $renew_product_price, "qty" => 1);
        }

         if($user_roles!='editor'){
          $post_author_id = get_post_field( 'post_author', $post_id );
           $transfer_id=$post_author_id;
          }
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
               $renew_type1='Renew Study'.'('.$renew_type.')';
               $activity='Renew Study'.' ('.$act_txt.')';
            mysql_query("UPDATE 0gf1ba_rewards_details SET is_last=0 WHERE user_id='$transfer_id'");
            $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_rewards_details`(`id`, `user_id`, `activity_of_points`,`rewards_date_time`,`credit`,`debit`,`balance`,`is_last`) VALUES (NULL,'$transfer_id','$activity','$rewards_datetime','$point_transfer',0,'$new_balance',1)",array()));
            update_user_meta($transfer_id, 'rewards', $new_balance);
        }
    }
    if($coupon){
        $coupon_data = get_coupon($coupon);
        $discount         = get_coupon($coupon);

        $old_price        = (float) $price2;
        if ($discount['type'] == "percent") {
            $percent  = (float) $discount['value'];
            $c_discount   = ($old_price / 100) * $percent;
        } else if ($discount['type'] == "fixed") {
            $c_discount   = (float) $discount['value'];
        }
    }

    if ($price2 > $c_discount) {
        $price2 = $price2 - $c_discount;
        $discount_amount = $c_discount;
    } else {
        $discount_amount = $price2;
        $price2 = 0;
    }
//    print_r($price2);
//    print_r($c_discount);
//    print_r($_REQUEST);
    if (isset($_REQUEST['upgrade_type_suite']) && $_REQUEST['upgrade_type_suite'] == "Patient Messaging Suite $247"){
        $message_suite2 = 247;
        $message_suite_email = 'Yes';
    }
    if ($message_suite2 && $message_suite2 > 0) {
        $product_arr["Messaging Suite"] = array("title" => "Messaging Suite" , "price" => 247, "qty" => 1);
    }
    if ($boostStudy == "Patient Messaging Suite $247") {
        $sub_total = $price2;
    } else {
        $sub_total = $price2 + $message_suite2;
    }

    //setlocale(LC_MONETARY, "en_US");
    $sub_price = number_format( $sub_total ,  2 ,  '.' ,  ',' );
    //$total_price = str_ireplace("USD", "$", $sub_price);
	$sub_price="$".$sub_price;
    $total_price = str_ireplace(" ", "", $sub_price);
    if ($boostStudy) {
        $subject = "cro/sponsors focus " . $studytype . " (" . $study_no . ") Upgrade Request";
    } else {
        $subject = "cro/sponsors focus " . $studytype . " (" . $study_no . ") Renew Request";
    }
    $message .= "
<body>
<table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>";
    if ($boostStudy) {
        $message .= "<tr>
    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>CRO/SPONSORS FOCUS STUDY BOOST</strong></td>
  </tr>";
    } else {
        $message .= "<tr>
    <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>CRO/SPONSORS FOCUS STUDY RENEW</strong></td>
  </tr>";
    }
    $message .= "<tr>
    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Number:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $study_no . "</td>
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
        <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$protocolnumber."</td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
        <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Name:</strong></td>
        <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sponsorname."</td>
  </tr>";
    if (strpos(strtolower($sponsoremail),'@studykik.com') == false) {
        $message .= " <tr style='color:#000; font-size:12px;'>
            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Email:</strong></td>
            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$sponsoremail."</td>
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
  if ($boostStudy) {
		$message .= "
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Start Date:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $currdate . "</td>
  </tr>";
  }
  else{
  $message .= "
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Start Date:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $startdate . "</td>
  </tr>";
	  }
  $l3=0;
      if($contactname !=''){
			 if (strpos(strtolower($contactname),'@studykik.com') == false) {
			 $l3++;
   $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l3.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactname . "</td>
  </tr>";
			 }
	  }
	   if($contactname2 !=''){
			 if (strpos(strtolower($contactname2),'@studykik.com') == false) {
			 $l3++;
   $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l3.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactname2 . "</td>
  </tr>";
			 }
	   }
	    if($contactemail3 !=''){
   if (strpos(strtolower($contactemail3),'@studykik.com') == false) {
			 $l3++;
   $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l3.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail3 . "</td>
  </tr>";
   }
		}
		 if($contactemail4 !=''){
   if (strpos(strtolower($contactemail4),'@studykik.com') == false) {
			 $l3++;
   $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l3.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail4 . "</td>
  </tr>";
   }
		 }
		  if($contactemail5 !=''){
   if (strpos(strtolower($contactemail5),'@studykik.com') == false) {
			 $l3++;
   $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l3.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail5 . "</td>
  </tr>";
   }
		  }
		   if($contactemail6 !=''){
    if (strpos(strtolower($contactemail6),'@studykik.com') == false) {
			 $l3++;
   $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l3.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail6 . "</td>
  </tr>";
   }
		   }
		    if($contactemail7 !=''){
    if (strpos(strtolower($contactemail7),'@studykik.com') == false) {
			 $l3++;
   $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l3.":</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail7 . "</td>
  </tr>";
   }
			}
   $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactphone . "</td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Website:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $study_website . "</td>
  </tr>";
    if ($boostStudy) {
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . ($boostStudy == "Patient Messaging Suite $247" ? $boost_type1 : $boostStudy) . "</td>
  </tr>";
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Add Patient Messaging Suite ($247):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $message_suite_email . "</td>
  </tr>";
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Coupon:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $coupon . "</td>
  </tr>";
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Credit Card (Last 4 Digits):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $creditcard . "</td>
  </tr>";

        $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Paid by Check: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".($creditcard ? "No" : "Yes")."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Notes: </strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $notes . "</td>
                  </tr>";
    } else {
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $renew_type . "</td>
  </tr>";
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Add Patient Messaging Suite ($247):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $message_suite_email . "</td>
  </tr>";
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Condense to 2 Weeks (Free):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $condense_2_weeks1_email . "</td>
  </tr>";
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Coupon:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $coupon . "</td>
  </tr>";
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Credit Card (Last 4 Digits):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $creditcard . "</td>
  </tr>";

        $message .= "<tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Paid by Check: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".($creditcard ? "No" : "Yes")."</td>
				</tr>
				<tr style='color:#000; font-size:12px;'>
                    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Notes: </strong></td>
                    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $notes . "</td>
                  </tr>";
    }
    $message .= "<tr>
    <td height='5' colspan='3' align='right' valign='middle'></td>
  </tr>
  <tr>
    <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
  </tr>
</table>
</body>";



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
                    <th colspan='3' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px; padding: 20px 0 4px 0;''>
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
				</tr>";

				$message_pdf .= "<tr align='center'>
				    <td align='left'></td>
				    <td align='left' colspan='2'><b>Study Type:</b> ".$studytype."</td>
                    <td align='center'> </td>
				    <td align='center'></td>
				</tr>
				";
				if ($boostStudy) {
        $message_pdf .= "<tr align='left'>
        <td align='left'> </td>
        <td align='left' colspan='2'><b>Study Level:</b> " . ($boostStudy == "Patient Messaging Suite $247" ? $boost_type1 : $boostStudy) . "</td>
	    <td align='center'> </td>
        <td align='center'> </td>
    </tr>";
    } else {
        $message_pdf .= "<tr align='left'>
        <td align='left'> </td>
        <td align='left' colspan='2'><b>Study Level:</b> " . $renew_type . "</td>
        <td align='center'> </td>
        <td align='center'> </td>
    </tr>";
    }
            $message_pdf .= "<tr align='left'>
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
                if ($boostStudy) {
                    $message_pdf .="<tr align='left'>
                                <td align='left'> </td>
                                <td align='left' colspan='2'><b>Start Date:</b> ".$currdate."</td>
                                <td align='center'> </td>
                                <td align='center'> </td>
                                </tr>";
                }
                else{
                    $message_pdf .="<tr align='left'>
                                <td align='left'> </td>
                                <td align='left' colspan='2'><b>Start Date:</b> ".$startdate."</td>
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
                            <td align='left'></td>
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

                $message_pdf .= "<tr align='left'>
                                        <td align='left'> </td>
                                        <td align='left'> </td>
                                        <td align='left'> </td>
                                        <td align='center'> </td>
                                        <td align='center'> </td>
                                        </tr>";
                /*$message_pdf .= "<tr align='left'>
                                        <td align='left'> </td>
                                        <td align='left'> </td>
                                        <td align='left'> </td>
                                        <td align='center'> </td>
                                        <td align='center'> </td>
                                        </tr>";
                $message_pdf .= "<tr align='left'>
                                        <td align='left'> </td>
                                        <td align='left'> </td>
                                        <td align='left'> </td>
                                        <td align='center'> </td>
                                        <td align='center'> </td>
                                        </tr>";*/
//                $message_pdf .= "<tr align='left'>
//						<td align='left'>&nbsp;</td>
//						<td align='left' colspan='2'> &nbsp;</td>
//						<td align='center'>&nbsp; </td>
//						<td align='center'> &nbsp;</td>
//						</tr>";
//                $message_pdf .= "<tr align='left'>
//						<td align='left'>&nbsp;</td>
//						<td align='left' colspan='2'> &nbsp;</td>
//						<td align='center'>&nbsp; </td>
//						<td align='center'> &nbsp;</td>
//						</tr>";
//                $message_pdf .= "<tr align='left'>
//						<td align='left'>&nbsp;</td>
//						<td align='left' colspan='2'> &nbsp;</td>
//						<td align='center'>&nbsp; </td>
//						<td align='center'> &nbsp;</td>
//						</tr>";
				if($message_suite_email == "Yes"){
				    $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>Patient Messaging Suite</td>
				    <td bordercolor='#000' align='left' colspan='2'> </td>
				    <td bordercolor='#000' align='center'> </td>
				    <td bordercolor='#000' align='right'>$".$message_suite2.".00</td>
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
                    $message_pdf .= "<tr align='left'>
                                <td bordercolor='#000' align='left'>Coupon</td>
                                <td bordercolor='#000' align='left' colspan='2'>".$coupon."</td>
                                <td bordercolor='#000' align='center'> </td>
                                <td bordercolor='#000' align='right'>-$".number_format( $discount_amount ,  2 ,  '.' ,  ',' )."</td>
                                </tr>";
                } else {

                    $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left' colspan='2'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

                }
				$ht=380;

				$kl=7-$kn;
				if($kn<7){
				$tl=23*$kl;
				$ht=$ht+$tl;

				}


				$message_pdf .= "<tr class='sub_total' align='left'>
				<td align='center'  style='border-top:1px solid #000;'> </td>
				<td align='left'  style='border-top:1px solid #000;' colspan='2'> </td>
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

//    print_r($message);
//    print_r($message_pdf);
    if ($boostStudy) {
        $subject_pdf_email = "Thank You for Upgrading Your " . $studytype;
        $pdf_email_text .= "
Hi " . $fname . ",<br /><br />
Thank You for Upgrading Your " . $studytype . " with StudyKIK.<br /><br />
Please see invoice attached with detailed information.<br /><br />
If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
Thank you!<br /><br />
StudyKIK<br />
1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
info@studykik.com<br />
1-877-627-2509<br /><br /><br />
<img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png'/>";
        $headers[] = 'From: Listing Upgrade <info@studykik.com>';
        $headers[] = "MIME-Version: 1.0\r\n";
        $headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
    } else {
        $subject_pdf_email = "Thank You for Renewing your " . $studytype;
        $pdf_email_text .= "
Hi " . $fname . ",<br /><br />
Thank you for Renewing your " . $studytype . " with StudyKIK.<br /><br />
Please see invoice attached with detailed information.<br /><br />
If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
Thank you!<br /><br />
StudyKIK<br />
1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
info@studykik.com<br />
1-877-627-2509<br /><br /><br />
<img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png' />";
        $headers[] = 'From: Listing Renew <info@studykik.com>';
        $headers[] = "MIME-Version: 1.0\r\n";
        $headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
    }
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
    $study_cat_name = str_replace(' ', '_', $studytype);
    $rand = rand();
    if ($boostStudy) {
        $html2pdf->Output(dirname(__FILE__) . "/pdf/" . $studytype . ' Upgrade Invoice' . ".pdf", "f");
		$html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_'.$studytype.'_Upgrade_Invoice'.".pdf", "f");
        $pdf_attachment_path = dirname(__FILE__) . '/pdf/' . $studytype . ' Upgrade Invoice.pdf';
		$pdf_attachment_path_db = '/pdf/'.$final_num.'_'.$studytype.'_Upgrade_Invoice.pdf';
        $attachments[] = dirname(__FILE__) . '/pdf/' . $studytype . ' Upgrade Invoice.pdf';
        $attachments_pdf[] = $pdf_attachment_path_db;
    } else {
	$studytype = str_replace('/', '-', $studytype);
	$studytype = str_replace(' ', '_', $studytype);
        $html2pdf->Output(dirname(__FILE__) . "/pdf/" . $studytype . ' ' . $renew_type . ' Renew Invoice' . ".pdf", "f");
		$html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_'.$studytype.'_Renew_Invoice'.".pdf", "f");
        $pdf_attachment_path = dirname(__FILE__) . '/pdf/' . $studytype . ' ' . $renew_type . ' Renew Invoice.pdf';
		$pdf_attachment_path_db = '/pdf/'.$final_num.'_'.$studytype.'_Renew_Invoice.pdf';
        $attachments[] = dirname(__FILE__) . '/pdf/' . $studytype . ' ' . $renew_type . ' Renew Invoice.pdf';
        $attachments_pdf[] = $pdf_attachment_path_db;
    }
		$current_month = date('M');
		$current_year = date('Y');
		$full_date = date('m/d/y');
		$wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`(`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES (NULL,'$user_id','$post_id','$pdf_attachment_path_db','$protocolnumber','$final_num','$total_price','$current_month','$current_year','Study Information','$full_date')"));

    if($user_ID == 70 || $user_ID == 532 || $user_ID == 534 ){
        wp_mail('mo.tan@studykik.com', $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);

    }
    else
    {
         wp_mail($current_user_email, $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);
    }

   //wp_mail("keshvendersingh145@gmail.com", $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);
    $pdf_email_text = "";
    $message_pdf = "";
    //wp_mail('chandel.anku91@gmail.com', $subject, $message, $headers, $attachments);
   //wp_mail('keshvendersingh145@gmail.com', $subject, $message, $headers, $attachments);

    $SendEmail = true;
    send_order_email($product_arr, array(
        "user_id" => $user_ID,
        "first_name" => ($card_id == "Check" ? $first_name : $card_billing_first_name),
        "last_name" => ($card_id == "Check" ? $last_name : $card_billing_last_name),
        "company" => $card_billing_company,
        "zip" => $card_billing_zip,
        "transaction_id" => "",
        "payment_type" => ($card_id == "Check" ? "Check" : $auth_card_type),
        "coupon" => $coupon,
        "coupon_amount" => $discount_amount,
        "invoice_number" => $_REQUEST['invoice_number'],
        "pdfs" => $attachments_pdf,
        "study_arr" => $study_arr
    ), $attachments, $message);
    if ($SendEmail && $boostStudy) {
        ?>
<div id="embed" class="white_content" style="display: block;">
  <h2 class="heading">Thank you</h2>
  <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">Thank you for Upgrading Your Study.  Additional Posts will be added within 24 hours!</p>
  <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">
    <input style=""  onclick="document.getElementById('embed').style.display = 'none';
               document.getElementById('fade').style.display = 'none'" class="close_button" type="button" value="CLOSE"/>
  </p>
</div>
<div id="fade" class="black_overlay"></div>
<?php } else { ?>
<div id="embed" class="white_content" style="display: block;">
  <h2 class="heading">
    <?php if($susces==1){ ?>
    Thank you
    <?php }
                else{ ?>
    OOPS
    <?php }
                ?>
  </h2>
  <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">
    <?php if($susces==1){ ?>
    Thank you for relisting this study!  It will be live in 24 hours!
    <?php }
                else{ ?>
    There is some error occured, Please try after some time.
    <?php }
                ?>
  </p>
  <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;">
    <input style=""  onclick="document.getElementById('embed').style.display = 'none';
             document.getElementById('fade').style.display = 'none'" class="close_button" type="button" value="CLOSE"/>
  </p>
</div>
<div id="fade" class="black_overlay"></div>
<?php }
} ?>
<div id="dialog-confirm" style="display:none; padding: 0px; text-align: center;"></div>
<div id="banner_login">
<div class="container">
<div class="row">
<?php get_header("client-submenu"); ?>
</div>
<div class="row">
<section class="container_current">
<div class="search-form col-12 col-md-6 col-sm-6" style="padding-left:20px !important;padding-top:20px !important">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header"> </div>
<div class=" navbar-collapse" id="navbarCollapse">
  <div class="row">
    <div class="current_heading">
      <h4 style="margin-top:4px;"> <a class="<?php if ($study == "") {
                                        echo 'li_active';
                                         } ?> lll1" href="<?php echo site_url();?>/dashboard/">Current Study Listings</a> <a class="<?php if ($study) {
                                       echo 'li_active';
                                         } ?> lll2" href="<?php echo site_url();?>/dashboard/?study=pasts">PAST STUDIES</a>
        <?php //if($study){ echo 'Past Study Listings';}else{ echo 'Current Study Listings'; }  ?>
      </h4>
      <div class="background_btn">
        <div  class="form-search form-inline">
          <?php if ($study) { ?>
          <input id="search_btn2" type="text" class="search-query-past" placeholder="Search a Study Listing" />
          <?php } else { ?>
          <input id="search_btn" type="text" class="search-query" placeholder="Search a Study Listing" />
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="data2"></div>
<div id="data">
<div class="scroll-area" data-spy="scroll" data-target="#myNavbar" data-offset="0">
<?php
                                        if($user_roles=='editor'){

                                                global $wp_query;

                                                $_query_base_args = array(
                                                    'post_status' => $study ? array('private') : array('publish', 'draft', 'pending'/*, 'private'*/),
                                                    'post__not_in' => array(108),
                                                    'posts_per_page' => 500,
                                                );

                                                query_posts( array_merge($_query_base_args, array('author' => $user_ID)));
                                                $_tmp_results1 = $wp_query->posts;


                                                // add studies, where user is specified in one of UsernameX fields
                                                $_qry_arr = array('relation' => 'OR');
                                                for($i=1;$i<6;$i++){
                                                    $_qry_arr[] = array('key' => 'author_' . $i, 'value' => $user_ID);
                                                }
                                                query_posts( array_merge($_query_base_args, array('meta_query' => $_qry_arr)));
                                                $_tmp_results2 = $wp_query->posts;

                                                // run through $_tmp_results2 to exclude posts from $_tmp_results1
                                                foreach($_tmp_results2 as $_tmp_results2_key => $_tmp_results2_value){
                                                    foreach($_tmp_results1 as $_tmp_results1_value){
                                                        if($_tmp_results2_value->ID == $_tmp_results1_value->ID){
                                                            unset($_tmp_results2[$_tmp_results2_key]);
                                                            break;
                                                        }
                                                    }
                                                }


                                                $wp_query->posts = array_merge($_tmp_results1, $_tmp_results2);
                                                $wp_query->post_count = count($wp_query->posts);

                                        }
                                        else{

                                            if ($study) {
                                                $queryArgs = array(
                                                    'post_status' =>'private',
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


                                                 } else {
                                                $queryArgs = array(
                                                    'post_status' => array('publish', 'draft', 'pending'),
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

                                            }

                                        }
                                        $i = 0;
                                        $authors_ids=array();
                                        if (have_posts()) {
                                            while (have_posts()) : the_post();
                                                /* if($user_roles=='manager_username'){
                                                       $post_author_id = get_post_field( 'post_author', $post->ID );
                                                        if($post_author_id){
                                                            if($post_author_id > 0){
                                                                $user = get_user_by('id', $post_author_id  );
                                                                if($user->user_login !=""){
                                                                    $authors_ids[$post_author_id]=$user->user_login;
                                                                }
                                                            }
                                                        }
                                                } */
                                                $i++;
                                                ?>
<dl class="clinical_trial">
  <dt style=" <?php if ($i == 1) {
                                echo 'color:#00afef;';
                            } if ($i == 2) {
                                echo 'color:#f78e1e;';
                            } if ($i == 3) {
                                echo 'color:#9fcf67;';
                            } ?>"> <a href="<?php the_permalink() ?>" style=" <?php if ($i == 1) {
                                echo 'color:#00afef;';
                            } if ($i == 2) {
                                echo 'color:#f78e1e;';
                            } if ($i == 3) {
                                echo 'color:#9fcf67;';
                            } ?>" target="_blank">
    <?php
                             $wppl_city=get_post_meta($post->ID, '_wppl_city', true);
                             $wppl_state=get_post_meta($post->ID, '_wppl_state', true);
                             $cat_name=get_post_meta($post->ID, 'custom_title_(for_thank_you_page)', true);
                             if (get_post_status($post->ID) == 'pending' || get_post_status($post->ID) == 'draft') { ?>
    <?php
//                                                $categories = get_the_category($post->ID);
//                                                $separator = ' ';
//                                                $output = '';
//                                                if ($categories) {
//                                                    foreach ($categories as $category) {
//                                                        $output .= $category->cat_name . $separator;
//                                                    }
//                                                    echo trim($output, $separator);
//                                                }
                                                echo $cat_name;
                                                ?>
    - <?php echo $wppl_city; ?>, <?php echo $wppl_state; ?>
    <?php } else { ?>
    <?php
//                                                $categories = get_the_category($post->ID);
//                                                $separator = ' ';
//                                                $output = '';
//                                                if ($categories) {
//                                                    foreach ($categories as $category) {
//                                                        $output .= $category->cat_name . $separator;
//                                                    }
//                                                    echo trim($output, $separator);
//                                                }
                                                echo $cat_name;
                                                ?>
    - <?php echo $wppl_city; ?>, <?php echo $wppl_state; ?>
    <?php } ?>
    </a>
    <p style="width:33%;text-align:left;float:right;margin-right:10px;margin-top:5px;"><?php echo 'Study End Date: '; ?>
      <?php
                                            $e_dt = get_field('study_end_date', $post->ID);
                                            if ($e_dt) {
                                                $dtend = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post->ID));
                                                echo $study_endt = $dtend->format('m/d/y');
                                            }
                                            ?>
    </p>
    <p style="width:100%; margin:0;"><b style=" <?php if ($i == 1) { echo 'color:#00afef;'; } if ($i == 2) { echo 'color:#f78e1e;';
                            } if ($i == 3) {  echo 'color:#9fcf67;'; } ?>">Sponsor:</b> <?php echo get_field('sponsor_name', $post->ID);?></p>
    <p style="width:100%;"><b style=" <?php if ($i == 1) { echo 'color:#00afef;'; } if ($i == 2) { echo 'color:#f78e1e;';
        } if ($i == 3) {  echo 'color:#9fcf67;'; } ?>">Protocol:</b> <?php echo get_field('protocol_no', $post->ID);?></p>
  </dt>
  <dd>
    <?php
    the_excerpt(); ?>
  </dd>
  <a  style=" <?php if ($i == 1) {
                                                echo 'background:#00afef;';
                                            } if ($i == 2) {
                                                echo 'background:#f78e1e;';
                                            } if ($i == 3) {
                                                echo 'background:#9fcf67;';
                                            } ?>" class="patient" href="<?php echo site_url();?>/patients-details/?pid=<?php echo $post->ID; ?>">View Patients ></a>
  <?php
                                        $exposure_level = get_post_meta($post->ID, 'exposure_level', true);
                                        if ($exposure_level == "Platinum") {
                                            $goal_total = "Boost this study with an additional 10 posts for $559?";
                                            $boost_pack = 'Platinum';
                                        }
                                        if ($exposure_level == "Gold") {
                                            $goal_total = "Boost this study to Platinum with an additional 20 posts for $1000?";
                                            $boost_pack = 'Gold';
                                        }
                                        $study_publish_date = get_the_date('m/d/Y');
                                        if (get_field('study_end_date', $post->ID)) {
                                            $date2 = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post->ID));
                                            $study_end_date = $date2->format('Y-m-d');
                                        } else {
                                            $study_end_date = '2015-12-30';
                                        }
                                        $datetime1 = date_create($study_publish_date);
                                        $datetime2 = date_create($study_end_date);
                                        $interval = date_diff($datetime1, $datetime2);
                                        $total_number_of_days = str_replace("+", "", $interval->format('%R%a'));
                                        if ($total_number_of_days < 16) {
                                            $day_left = "Are you sure you want to renew this study for another 15 Day period?";
                                        }
                                        if ($total_number_of_days > 16) {
                                            $day_left = "Are you sure you want to renew this study for another 30 Day period?";
                                        }
                                        if (get_post_status($post->ID) == 'private') {
                                            ?>
  <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                    echo 'background:#00afef;';
                                } if ($i == 2) {
                                    echo 'background:#f78e1e;';
                                } if ($i == 3) {
                                    echo 'background:#9fcf67;';
                                } ?>" class="patient" onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'block';
                                    document.getElementById('fade').style.display = 'block';alignRenewStudyText(<?php echo $post->ID; ?>)" href="javascript:void(0);" >Renew Study ></a>
                                            <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                                echo 'background:#00afef;';
                                            } if ($i == 2) {
                                                echo 'background:#f78e1e;';
                                            } if ($i == 3) {
                                                echo 'background:#9fcf67;';
                                            } ?>" class="patient" onclick="document.getElementById('embed2<?php echo $post->ID; ?>').style.display = 'block';
                                                document.getElementById('fade').style.display = 'block';alignUpdateStudyText(<?php echo $post->ID; ?>);" href="javascript:void(0);">Upgrade Study ></a>
  <?php } else { ?>
  <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                     echo 'background:#00afef;';
                                      } if ($i == 2) {
                                      echo 'background:#f78e1e;';
                                       } if ($i == 3) {
                                       echo 'background:#9fcf67;';
                                      } ?>" class="patient" onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'block';
                                     document.getElementById('fade').style.display = 'block';alignRenewStudyText(<?php echo $post->ID; ?>)" href="javascript:void(0);">Renew Study ></a>
  <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                           echo 'background:#00afef;';
                                            } if ($i == 2) {
                                            echo 'background:#f78e1e;';
                                            } if ($i == 3) {
                                            echo 'background:#9fcf67;';
                                           } ?>" class="patient" onclick="document.getElementById('embed2<?php echo $post->ID; ?>').style.display = 'block';
                                     document.getElementById('fade').style.display = 'block';alignUpdateStudyText(<?php echo $post->ID; ?>);" href="javascript:void(0);">Upgrade Study ></a>
  <?php } ?>
</dl>
<?php if ($i == 3) {
                                   $i = 0;
                                      } ?>
<?php endwhile;
                  $_SESSION['authors_ids']=$authors_ids;
          wp_reset_query();
                    } else { ?>
<dl class="clinical_trial">
<dt style=" <?php if ($i == 1) {
                                 echo 'color:#00afef;';
                                 } if ($i == 2) {
                                 echo 'color:#f78e1e;';
                                 } if ($i == 3) {
                                 echo 'color:#9fcf67;';
                                  } ?>"> No Listings Found! </dt>
<?php } ?>
</div>
</div>
</div>
<div class="col-12 col-md-6 col-sm-6" style="padding-top:20px !important">
    <a href="<?php echo site_url();?>/clinical-study-information-dashboard/">
        <img src="<?php bloginfo('template_url'); ?>/images-dashboard/new_study.png" alt="" class="img-responsive">
    </a>
    <a href="<?php echo site_url();?>/rewards/">
        <img src="<?php bloginfo('template_url'); ?>/images-dashboard/rewards.png" alt="" class="img-responsive">
    </a>
    <a href="<?php echo site_url();?>/refer-listing/ ">
        <img src="<?php bloginfo('template_url'); ?>/images-dashboard/refer_listin.png" alt="" class="img-responsive">
    </a>
    <a href="javascript:void(0);" class="irbCreation">
        <img src="<?php bloginfo('template_url'); ?>/images-dashboard/irb_ad_creation.png" alt="" class="img-responsive">
    </a>
</div>
</section>
</div>
</div>
</div>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<?php
if($user_roles=='editor'){

            global $wp_query;

            $_query_base_args = array(
                'post_status' => $study ? array('private') : array('publish', 'draft', 'pending'/*, 'private'*/),
                'post__not_in' => array(108),
                'posts_per_page' => 500,
            );

            query_posts( array_merge($_query_base_args, array('author' => $user_ID)));
            $_tmp_results1 = $wp_query->posts;


            // add studies, where user is specified in one of UsernameX fields
            $_qry_arr = array('relation' => 'OR');
            for($i=1;$i<6;$i++){
                $_qry_arr[] = array('key' => 'author_' . $i, 'value' => $user_ID);
            }
            query_posts( array_merge($_query_base_args, array('meta_query' => $_qry_arr)));
            $_tmp_results2 = $wp_query->posts;

            // run through $_tmp_results2 to exclude posts from $_tmp_results1
            foreach($_tmp_results2 as $_tmp_results2_key => $_tmp_results2_value){
                foreach($_tmp_results1 as $_tmp_results1_value){
                    if($_tmp_results2_value->ID == $_tmp_results1_value->ID){
                        unset($_tmp_results2[$_tmp_results2_key]);
                        break;
                    }
                }
            }


            $wp_query->posts = array_merge($_tmp_results1, $_tmp_results2);
            $wp_query->post_count = count($wp_query->posts);

    }
    else{
        if ($study) {
            $queryArgs = array(
                'post_status' => array('private'),
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
            query_posts($queryArgs);

             } else {
            $queryArgs = array(
                'post_status' => array('publish', 'draft', 'pending'),
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
            query_posts($queryArgs);
        }
    }
$i = 0;
if (have_posts()) {
    while (have_posts()) : the_post();
        $i++;
        ?>
<?php
        // seedcms
        $ecommerce_enabled = get_option('ecommerce_enabled');
        $is_check_allowed = get_user_meta($user_ID, 'allow_check', true);
//        print_r($user_ID);
        $exposure_level = get_post_meta($post->ID, 'exposure_level', true);
        if ($exposure_level == "Platinum") {
            $boost_pack = 'Platinum';
        }
        if ($exposure_level == "Gold") {
            $boost_pack = 'Gold';
        }
        ?>
<script type="text/javascript">
jQuery(function(){
	jQuery( "#datepicker<?php echo $post->ID; ?>" ).datepicker();
});

</script>
<div id="embed<?php echo $post->ID; ?>" class="white_content" style="display: none;">
  <h2 class="heading">Renew Study Confirmation</h2>
  <p style="color: #000; padding: 15px 15px 5px ; font-size: 16px; text-align: center;font-weight: bold;">What level would you like to renew this study for?</p>
  <form action="" method="post" class="form-renew-study-<?php echo $post->ID; ?>" style="text-align: center;">
    <div class="renew-study-align-block-<?php echo $post->ID; ?>">
    <select name="renew_type" class="renew_type required" style="width:230px; padding: 6px; margin-bottom:5px;">
      <option value="">Select Level *</option>
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
    </select>
    </div>
    <div class="renew-study-align-block-<?php echo $post->ID; ?>">
        <input type="text" class="input-date required" value="<?php echo date('m/d/Y', strtotime('-5 hours')); ?>" placeholder="Select Start Date *" id="datepicker<?php echo $post->ID; ?>" name="select_date" style="width:230px; height: 32px;" />
        <a href="#" style="color: #00afef;font-weight: bold;" id="<?php echo $post->ID; ?>" class="tbd-checkbox">To be determined</a>
    </div>
    <div class="renew-study-align-block-<?php echo $post->ID; ?>" style="float:left; margin-left:307px; margin-top:4px;"><p style="margin: 0px;">
      <label>Add Patient Messaging Suite ($247): </label>
      <input type="checkbox" name="message_suite_2471">
      <span style="color: #00afef;margin-left: 10px;font-weight: bold;">Yes</span></p></div>
    <div class="play_video_bttn_wrap"><div style="margin-bottom: -5px;" class="play_video_bttn" onclick="showVideo()"></div></div>
    <div style="clear: both;"></div>
    <div class="renew-study-align-block-<?php echo $post->ID; ?>">
    <p style="margin: 0px;">
      <label>Condense to 2 Weeks (Free): </label>
      <input type="checkbox" name="condense_2_weeks1">
      <span style="color: #00afef;margin-left: 10px;font-weight: bold;">Yes</span></p>
    </div>
    <?php //echo $day_left;?>
    <input type="hidden" name="postID" value="<?php echo $post->ID; ?>" />
      <?php
          if((bool) $ecommerce_enabled){
      ?>
        <select name="select_card" class="renew_type required select_card_cls_rn go-card-x cards-<?php echo $post->ID;?>" data-id="<?php echo $post->ID;?>" style="padding: 6px; margin-bottom:5px;width:230px" un_id="<?php echo $post->ID; ?>">
            <option value="">Select Credit Card *</option>
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
                    echo '<option value="'.$card->ID.'" data-credit-card-id="'.$card->ID.'" data-cvv="'.$auth_card_code.'" data-shipping-id="'.$auth_shipping_profile.'" data-profile-id="'.$auth_profile_id.'" data-payment-id="'.$auth_payment_profile.'">xxxx xxxx xxxx '.$auth_credit_card.'</option>';
                  }
                  
                }
              }
              // loop cards here  
            ?>
            
            <option value="Add a card">Add Credit card</option>
            <?php if((bool) $is_check_allowed){ ?><option value="Check">Pay by Check</option><?php } ?>
        </select>
        </br>
        <input type="text" value="" placeholder="Coupon" id="coupon-input-renew" name="coupon" class="coupon-input" style="height: 32px;" />
              </br>
              <textarea value="" placeholder="Notes" id="notes-input-renew" name="notes" class="coupon-input" rows="3"/></textarea>
        </br>
              <div class="warning-message"></div>
              <br/>
      <?php } ?>

      <input class="done_button go-renew-button renew-button-<?php echo $post->ID; ?>" data-id="<?php echo $post->ID; ?>" type="submit" value="Renew My Study" />
      <input  name="payment_credit_card_id" id="payment_credit_card_id_x" type="hidden" value="" />
      <input  name="payment_profile_id" id="payment_profile_id_x" type="hidden" value="" />
      <input  name="payment_payment_id" id="payment_payment_id_x" type="hidden" value="" />
      <input  name="payment_shipping_id" id="payment_shipping_id_x" type="hidden" value="" />
      <input  name="payment_card_code" id="payment_card_code_x" type="hidden" value="" />
      <input  name="invoice_number" id="invoice_number_<?php echo $post->ID; ?>" type="hidden" value="" />
      <input  name="action" type="hidden" value="renew_study" />
      <input  name="study_id" type="hidden" value="<?php echo $post->ID; ?>" />
      
  </form>
  <a onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'none';
                       document.getElementById('fade').style.display = 'none';
                       " href="javascript:void(0);" class="closepop">Close</a> </div>
<div id="embed2<?php echo $post->ID; ?>" class="upgrade_white_content" style="display: none;">
  <!-- seedcms Upgrade Study Confirmation Project manager -->
  <h2 class="heading">Upgrade Study Confirmation</h2>
  <form action="" method="post" class="form-upgrade-study-<?php echo $post->ID; ?>" style="text-align: center;">
    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;font-weight: bold;">Upgrade this study to:</p>
    <input type="hidden" name="upgrade_type_suite" id="upgrade_type_suite-<?php echo $post->ID; ?>" value=""/>
    <select name="upgrade_type" class="upgrade_type" id="upgrade_type-<?php echo $post->ID; ?>" style="padding: 6px; margin-bottom:6px;width:230px; margin-top: -5px;">
      <option value="">Select Upgrade</option>
      <?php if ($exposure_level == "Bronze") { ?>
      <option value="Silver $150">Silver $150</option>
      <option value="Gold $500">Gold $500</option>
      <option value="Platinum $1500">Platinum $1500</option>
      <option value="Diamond $3000">Diamond $3000</option>
      <?php } ?>
      <?php if ($exposure_level == "Silver") { ?>
      <option value="Gold $340">Gold $340</option>
      <option value="Platinum $1340">Platinum $1340</option>
      <option value="Diamond $2840">Diamond $2840</option>
      <?php } ?>
      <?php if ($exposure_level == "Gold") { ?>
      <option value="Platinum $1000">Platinum $1000</option>
      <option value="Diamond $2500">Diamond $2500</option>
      <?php } ?>
      <?php if ($exposure_level == "Platinum") { ?>
      <option value="Diamond $1500">Diamond $1500</option>
      <?php } ?>
      <?php if ($exposure_level == "Diamond") { ?>
      <option value="Diamond $1500">Diamond $1500</option>
      <?php } ?>
    </select>
      <div style="clear: both;"></div>
    <div class="patient_messaging_suite_wrap-<?php echo $post->ID; ?>" style="float: left; text-align: left;">
        <div style="margin-top:4px;">
            <label> Patient MessagingSuite ($247)</label>
            <span style="margin-left: 15px; padding: 4px 4px 0px 5px;"><input style="" type="checkbox" name="patient_messaging_suit_update" id="patient_messaging_suit_checkbox_id-<?php echo $post->ID; ?>"/></span>
            <label style="color:#00afef;" for="patient_messaging_suit_checkbox_id-<?php echo $post->ID; ?>"> Yes </label>
        </div>
    </div>
    <div class="play_video_bttn_wrap"><div style="margin-bottom: -5px;" class="play_video_bttn" onclick="showVideo()"></div></div>
    <input type="hidden" name="postID" value="<?php echo $post->ID; ?>" />
      <?php
          if((bool) $ecommerce_enabled){
      ?>
              <br/>
        <select name="select_card" data-id="<?php echo $post->ID;?>" class="go-card required cards-<?php echo $post->ID;?> renew_type select_card_cls" style="padding: 6px; margin-bottom:5px;width:230px" un_id="<?php echo $post->ID; ?>">
            <option value="">Select Credit Card *</option>
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
                    echo '<option value="'.$card->ID.'" data-credit-card-id="'.$card->ID.'" data-cvv="'.$auth_card_code.'" data-shipping-id="'.$auth_shipping_profile.'" data-profile-id="'.$auth_profile_id.'" data-payment-id="'.$auth_payment_profile.'">xxxx xxxx xxxx '.$auth_credit_card.'</option>';
                  }
                  
                }
              }
              // loop cards here  
            ?>
            <option value="Add a card">Add Credit card</option>
            <?php if((bool) $is_check_allowed){ ?><option value="Check">Pay by Check</option><?php } ?>
        </select>
        </br>
        <input type="text" value="" placeholder="Coupon" id="coupon-input-upgrade" name="coupon" class="coupon-input" style="height: 32px;" />
              </br>
              <textarea value="" placeholder="Notes" id="notes-input-upgrade" name="notes" class="coupon-input" rows="3"/></textarea>
        </br>
              <div class="warning-message"></div>
              <br/>
      <?php } ?>
      <input  class="done_button go-upgrade-button upgrade-button-<?php echo $post->ID; ?>" type="submit" data-id="<?php echo $post->ID; ?>" value="Upgrade My Study" />
      <input  name="payment_credit_card_id" id="payment_credit_card_id" type="hidden" value="" />
      <input  name="payment_profile_id" id="payment_profile_id" type="hidden" value="" />
      <input  name="payment_payment_id" id="payment_payment_id" type="hidden" value="" />
      <input  name="payment_shipping_id" id="payment_shipping_id" type="hidden" value="" />
      <input  name="payment_card_code" id="payment_card_code" type="hidden" value="" />
      <input  name="invoice_number" id="invoice_number_<?php echo $post->ID; ?>" type="hidden" value="" />
      <input  name="action" type="hidden" value="upgrade_study" />
      <input  name="study_id" type="hidden" value="<?php echo $post->ID; ?>" />
  </form>

  <a onclick="document.getElementById('embed2<?php echo $post->ID; ?>').style.display = 'none';document.getElementById('fade').style.display = 'none';" href="javascript:void(0);" class="closepop">Close</a> </div>
<?php endwhile;
    wp_reset_query();
} ?>




<div id="fade" class="black_overlay"></div>
<?php get_footer('dashboard'); ?>


<?php } }?>
<div id="embed_credit" class="add_payment_popup">
    <form method="post" action="#" class="add-card-form">
    <div class="Add_cart">
      <div class="col-md-12 col-xs-12 add_new_cart">
        <!-- seedcms -->
        <h2>Add New Card</h2>
      </div>
      <div class="col-md-12 col-xs-12 card_text">
        <p>Please note that any changes made here will affect future orders.</p>
      </div>
        <div class="col-md-4 col-xs-12">
            <input type="text" class="form-control required" name="firstname" placeholder="First Name *">
        </div>
        <div class="col-md-4 col-xs-12">
            <input type="text" class="form-control required" name="lastname" placeholder="Last Name *">
        </div>
        <div class="col-md-4 col-xs-12">
            <input type="text" class="form-control required" name="company" placeholder="Company *">
        </div>
      <div class="col-md-8 col-xs-12">
        <input type = "text" class = "form-control required" name="cc_number" autocomplete="false" placeholder = "Card Number *">
      </div>
        <div class="col-sm-4 col-xs-12">

            <input type = "text" class = "form-control" name="cc_cvv2" autocomplete="false" placeholder = "CVC">

        </div>
      <div class="col-sm-4 col-xs-12">
        <select class="form-control required" name="cc_exp_month">
          <option value="">Expiration Month *</option>
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
      </div>
      <div class="col-sm-4 col-xs-12">
       <select class="form-control required" name="cc_exp_year">
          <option value="">Expiration Year *</option>
          <?php
            $year = date('Y');
            $year_end = $year + 10;

            while($year <= $year_end){
              echo '<option value="'.$year.'">'.$year.'</option>';
              $year ++;
            }
          ?>
        </select>
      </div>
        <div class="col-md-4 col-xs-12">
            <input type = "text" class = "form-control required" name="zip" id = "phone_number" placeholder = "Billing Zip *">
        </div>

<!--      <div class="col-md-12 col-xs-12 horizontal_line">-->
<!--      </div>-->
<!--        <div class="col-md-12 col-xs-12">-->
<!--            <input type = "email" class = "form-control required" name="email" id = "email" placeholder = "Email *">-->
<!--        </div>-->
<!--      <div class="col-md-6 col-xs-12">-->
<!--        <input type = "text" class = "form-control required" name="address" id = "phone_number" placeholder = "Address *">-->
<!--      </div>-->
<!--      <div class="col-md-6 col-xs-12">-->
<!--        <input type = "text" class = "form-control" name="address2" id = "phone_number" placeholder = "Address 2">-->
<!--      </div>-->
<!--      <div class="col-md-3 col-xs-12">-->
<!--        <input type = "text" class = "form-control required" name="city" id = "phone_number" placeholder = "City *">-->
<!--      </div>-->
<!--      -->
<!--      <div class="col-md-3 col-xs-12">-->
<!--        <input type = "text" class = "form-control required" name="state" id = "phone_number" placeholder = "State *">-->
<!--      </div>-->
<!--      <div class="col-md-3 col-xs-12">-->
<!--        <input type = "text" class = "form-control required" name="country" id = "phone_number" placeholder = "Country *">-->
<!--      </div>-->
      <div class="col-sm-6 col-xs-12 add_cancel_btn">
          <a href="#"><img id="card_cancel" src="<?php bloginfo('template_url');?>/images/cancel.png" alt="" class="img-responsivem pull-right"></a>
      </div>
      <div class="col-sm-6 col-xs-12 add_save_btn">
        <a href="#" class="go-add-card"><img src="<?php bloginfo('template_url');?>/images/save.png" alt="" class="img-responsive pull-left"></a>
        <input type="hidden" name="action" value="addcard" />
        <input type="hidden" name="post_id" class="post_id" value="" />
        <input type="hidden" name="user_id" value="<?php echo get_current_user_id();?>" />

      </div>
        <div style="clear:both; font-weight: bold; padding: 20px 0; text-align: center;" class="add-card-status"></div>
    </div>
    </form>
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
            $(".ui-dialog").css('z-index', '99999');
            $(".ui-widget-overlay").css('z-index', '99998');
        }
      $('.go-add-card').click(function(){

        var ajaxurl     = '/wp-admin/admin-ajax.php';
        var datastring  = jQuery(".add-card-form").serialize();
          var errors = 0;
          var data_form = $(this).closest('form');
          jQuery('.add-card-status').html("");
          data_form.find(".required").map(function () {
              if (!$(this).val()) {
                  $(this).addClass('warning');
                  errors++;
              } else if ($(this).val()) {
                  $(this).removeClass('warning');
              }
          });

          if (errors == 0) {
              var str = data_form.find("input[name=company]").val();
              if(/^[a-zA-Z0-9-_ ]*$/.test(str) == false) {
                  data_form.find("input[name=company]").addClass("warning");
                  data_form.find('.add-card-status').html("Company field can't contain symbols.");
                  data_form.find('.add-card-status').css('color','#ff0000');
                  errors ++;
              } else {
                  data_form.find("input[name=company]").removeClass("warning");
                  data_form.find('.add-card-status').html("");
              }
          }

          var today, someday;
          var exMonth=data_form.find("select[name=cc_exp_month]");
          var exYear=data_form.find("select[name=cc_exp_year]");
          today = new Date();
          someday = new Date();
          someday.setFullYear(exYear.val(), exMonth.val(), 1);

          if (someday < today && errors == 0) {
              errors ++;
              exMonth.addClass('warning');
              exYear.addClass('warning');
              data_form.find('.add-card-status').html("The expiration date is invalid.");
              data_form.find('.add-card-status').css('color','#ff0000');
              return false;
          }
          if (errors == 0) {
              $('.add-card-status').html('Processing...');
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: datastring,
                success: function(data) {
                   var json = $.parseJSON(data);

                   //if(json[0] != 'Error adding card, please verify all information is correct.'){
                   if (!json.error){
                    $('.cards-'+json[0].post_id).append('<option value="'+json[0].card_id+'" data-shipping-id="'+json[0].shipping_id+'" data-credit-card-id="'+json[0].card_id+'" data-profile-id="'+json[0].profile_id+'" data-cvv="'+json[0].cvv+'" data-payment-id="'+json[0].payment_id+'">xxxx xxxx xxxx '+json[0].last_4+'</option>');
                     console.log(json);
                     console.log(json[0].payment_id);
                       data_form.find(".required").map(function () {
                           $(this).removeClass('warning');
                       });
                       data_form.find("input").map(function () {
                           $(this).val("");
                           $(this).removeClass('warning');
                       });
                       data_form.find("select").map(function () {
                           $(this).val("");
                           $(this).removeClass('warning');
                       });
                     jQuery("#embed_credit").hide();
                   }else{
                     jQuery('.add-card-status').html(json.messages[0]);
                     jQuery('.add-card-status').css('color','#ff0000');
                       jQuery('input[name=cc_number]').addClass("warning");
                       jQuery('select[name=cc_exp_month]').addClass("warning");
                       jQuery('select[name=cc_exp_year]').addClass("warning");
//                       jQuery('input[name=cc_cvv2]').addClass("warning");
                       jQuery('input[name=zip]').addClass("warning");
                   }


                },
                error: function(data){
                  console.log(data);
                  jQuery('.add-card-status').html(data);
                    jQuery('input[name=cc_number]').addClass("warning");
                    jQuery('select[name=cc_exp_month]').addClass("warning");
                    jQuery('select[name=cc_exp_year]').addClass("warning");
//                    jQuery('input[name=cc_cvv2]').addClass("warning");
                    jQuery('input[name=zip]').addClass("warning");
                }
            });
          } else {
              return false;
          }
      });  
    </script>
    
</div>
<?php get_template_part('buy_credits_tpl');?>
<?php get_template_part('irb_creation_tpl');?>
<style>
.lll2{
    float: left;
}
.list-new-button{
    float: right;
}
.list-new-button img{
    height: 55px;
    margin-top: -20px;
}
.add_payment_popup, .update_payment_popup, .update_address, .new_address_popup {
    background-color: white;
    border: 1px solid #f78e1e;
    border-radius: 5px;
    cursor: auto;
    display: none;
    left: 16%;
    overflow: auto;
    position: fixed !important;
    top: calc(50% - 350px);
    z-index: 999999 !important;
    width:68%;
    min-height:35%
}

.Add_cart {
    padding-bottom: 20px;
}
.add_new_cart {
    padding: 0;
}
.notes_left .row > h2 {
    background: #f78e1e none repeat scroll 0 0;
    color: #fff;
    font-family: alternate;
    font-size: 44px;
    margin: 0;
    padding: 5px;
    text-align: center;
    text-decoration: underline;
}
.warning-message {
    color: #FF0000;
}


.add_payment_popup .form-control {
    float: left;
    font: 18px Arial, Helvetica, sans-serif;
    height: 46px;
    margin: 0 0 13px;
    padding: 0 15px;
    width: 100%;
    background-color: #fff;
    border: 0 none;
    -moz-box-shadow: inset 3px 2px 5px #c5c5c5;
    -webkit-box-shadow: inset 3px 2px 5px #c5c5c5;
    box-shadow: inset 3px 2px 5px #c5c5c5;
    border-radius: 0px;
    color: #F78F1E;
    font-weight: bold !important;
}

.warning {
    border: 1px solid red;
}
.warning_checkbox_container {
    border: 1px solid red;
}

.add_payment_popup .warning {
    border: 1px solid red;
}
</style>

<script>

jQuery("#card_cancel").on('click',function(){
  jQuery("#embed_credit").hide();
    var data_form = $('.add-card-form');
    data_form.find("input").map(function () {
        $(this).val("");
        $(this).removeClass('warning');
    });
    data_form.find("select").map(function () {
        $(this).val("");
        $(this).removeClass('warning');
    });
});
$('.tbd-checkbox').on('click',function(e) {
    e.preventDefault ? e.preventDefault() : (e.returnValue=false);
    if($('.input-date').val() !== 'To be determined'){
        $('#datepicker' + $(e.currentTarget).attr('id')).val('To be determined');
    }else{
        $('#datepicker' + $(e.currentTarget).attr('id')).val('').focus();
    }
});

jQuery(document).on('click',".buycredits",function(){
    jQuery("#fade").show();
    var post_id='<?php
    // pick any post id belonging to this user
    
     $qry = 'SELECT ID FROM 0gf1ba_posts WHERE post_author = ' . get_current_user_id() . ' LIMIT 1;';
     $_row_with_pid = $wpdb->get_row($qry);
     echo($_row_with_pid->ID);
     
     ?>';
    jQuery("#buy_credits_title").html('Add Credits');
    jQuery("#buy_credits_post_id").val(post_id);
    $(".buy_credits_wrapper_container a").remove();
    $(".buy_credits_wrapper_container").append('<a class="closepop" id="buy_credits_close_top_bar" href="javascript:void(0);" onclick="document.getElementById(\'buyCredits\').style.display=\'none\';document.getElementById(\'fade\').style.display=\'none\';">Close</a>');
    jQuery("#buy_credits_close_bttn").hide();
    jQuery("#buy_credits_purchase_bttn").show();
    jQuery(".buy_credits_error_text").hide();
    jQuery(".buy_credits_main_content").show();
    $("#buy_credits_paymentmethod").val('');
    jQuery(".loop_credit").hide();
    jQuery(".buy_credits_form_area").css("height","240px");

    jQuery("#buyCredits").show();
});

jQuery(document).on('click',".irbCreation",function(){
    jQuery("#fade").show();
    var post_id='<?php
    // pick any post id belonging to this user

     $qry = 'SELECT ID FROM 0gf1ba_posts WHERE post_author = ' . get_current_user_id() . ' LIMIT 1;';
     $_row_with_pid = $wpdb->get_row($qry);
     echo($_row_with_pid->ID);

     ?>';
    jQuery("#irb_creation_title").html('IRB Ad Creation');
    jQuery("#irb_creation_post_id").val(post_id);
    $(".irb_creation_wrapper_container a").remove();
    $(".irb_creation_wrapper_container").append('<a class="closepop" id="irb_creation_close_top_bar" href="javascript:void(0);" onclick="document.getElementById(\'irbCreation\').style.display=\'none\';document.getElementById(\'fade\').style.display=\'none\';">Close</a>');
    jQuery("#irb_creation_close_bttn").hide();
    jQuery("#irb_creation_purchase_bttn").show();
    jQuery(".irb_creation_error_text").hide();
    jQuery(".irb_creation_main_content").show();
    $("#irb_creation_paymentmethod").val('');
    jQuery(".loop_irb").hide();
    jQuery(".irb_creation_form_area").css("height","240px");

    jQuery("#irbCreation").show();
});

// update callfire credits each 10 minutes
      var ih = setInterval(function(){
          var post_id='<?php echo $pid;?>';
          jQuery.ajax({
              async: true,
              url: "<?php bloginfo('wpurl') ?>/get_unread_messages.php?action=get_unread_messages&post_id=<?php echo($_row_with_pid->ID); ?>&author_id=<?php echo(get_post_field( 'post_author', $_row_with_pid->ID)); ?>&curl_url=<?php bloginfo('wpurl') ?>",
              type:'GET',
              success: function(response_data){
//                  response_data = response_data.substr(0, (response_data.length-1));
                  var data_parsed = JSON.parse(response_data);
                  var data = data_parsed.messages;
                  var questions_data = data_parsed.questions;
                  var user_creditscount_view = $(".user_creditscount_view");

                  var callfir_credits = data_parsed.callfir_credits;
                
                  if (callfir_credits != null ){
                      user_creditscount_view.find('.credits-count').html(callfir_credits);
                      if(callfir_credits < 100 && callfir_credits > 0){
                          user_creditscount_view.find('.credits-count').removeAttr('class').addClass('credits-count fix-textsize');
                      }else if(callfir_credits >= 1000 && callfir_credits < 10000){
                          user_creditscount_view.find('.credits-count').removeAttr('class').addClass('credits-count fix-textsize-16');
                      }else if(callfir_credits >= 10000 && callfir_credits < 100000){
                          user_creditscount_view.find('.credits-count').removeAttr('class').addClass('credits-count fix-textsize-12');
                      }else if(callfir_credits >= 100000){
                          user_creditscount_view.find('.credits-count').removeAttr('class').addClass('credits-count fix-textsize-10');
                      }else{
                          user_creditscount_view.find('.credits-count').removeAttr('class').addClass('credits-count fix-textsize');
                      }
                  }
              }
          });
      }, 30000);


</script>

<script>
  //
  
  $('.go-card').change(function(){
      $(this).parent('form').find('#payment_credit_card_id').val($(this).find(':selected').attr('data-credit-card-id'));
      $(this).parent('form').find('#payment_profile_id').val($(this).find(':selected').attr('data-profile-id'));
      $(this).parent('form').find('#payment_payment_id').val($(this).find(':selected').attr('data-payment-id'));
      $(this).parent('form').find('#payment_shipping_id').val($(this).find(':selected').attr('data-shipping-id'));
      $(this).parent('form').find('#payment_card_code').val($(this).find(':selected').attr('data-cvv'));
    return true;
          
  });
  
  $('.go-card-x').change(function(){
      $(this).parent('form').find('#payment_credit_card_id_x').val($(this).find(':selected').attr('data-credit-card-id'));
      $(this).parent('form').find('#payment_profile_id_x').val($(this).find(':selected').attr('data-profile-id'));
      $(this).parent('form').find('#payment_payment_id_x').val($(this).find(':selected').attr('data-payment-id'));
      $(this).parent('form').find('#payment_shipping_id_x').val($(this).find(':selected').attr('data-shipping-id'));
      $(this).parent('form').find('#payment_card_code_x').val($(this).find(':selected').attr('data-cvv'));
    return true;
          
  });
  
  $('.go-card-client').change(function(){
      $(this).parent('form').find('#payment_credit_card_id_x2').val($(this).find(':selected').attr('data-credit-card-id'));
      $(this).parent('form').find('#payment_profile_id_x2').val($(this).find(':selected').attr('data-profile-id'));
      $(this).parent('form').find('#payment_payment_id_x2').val($(this).find(':selected').attr('data-payment-id'));
      $(this).parent('form').find('#payment_shipping_id_x2').val($(this).find(':selected').attr('data-shipping-id'));
      $(this).parent('form').find('#payment_card_code_x2').val($(this).find(':selected').attr('data-cvv'));
    return true;
          
  });
  
  $('.go-card-client-renew').change(function(){

      $(this).parent('form').find('#payment_credit_card_id_2').val($(this).find(':selected').attr('data-credit-card-id'));
      $(this).parent('form').find('#payment_profile_id_2').val($(this).find(':selected').attr('data-profile-id'));
      $(this).parent('form').find('#payment_payment_id_2').val($(this).find(':selected').attr('data-payment-id'));
      $(this).parent('form').find('#payment_shipping_id_2').val($(this).find(':selected').attr('data-shipping-id'));
      $(this).parent('form').find('#payment_card_code_2').val($(this).find(':selected').attr('data-cvv'));
    return true;
          
  });

  jQuery(".select_card_cls").on('change',function(){
      //alert("hiiiii");
      var un_id=jQuery(this).attr('un_id');

      var sel_val=jQuery(this).val();
      var post_id=jQuery(this).data('id');
      if(sel_val=='Add a card'){
          jQuery("#embed_credit").show();
          $("#embed_credit input[type=text]").map(function(){
              $(this).val("");
          });
          $("#embed_credit select").map(function(){
              $(this).val("");
          });
          jQuery('.post_id').val(post_id);

      }
      else{
          jQuery("#embed_credit").hide();
      }
  });
  jQuery(".select_card_cls_rn").on('change',function(){
      //alert("hiiiii");
      var un_id=jQuery(this).attr('un_id');

      var sel_val=jQuery(this).val();
      var post_id=jQuery(this).data('id');
      if(sel_val=='Add a card'){
          jQuery("#embed_credit").show();
          jQuery('.post_id').val(post_id);
      }
      else{
          jQuery("#embed_credit").hide();
      }
  });
  
  $('.go-upgrade-button').click(function(){
    var ajaxurl     = '/wp-admin/admin-ajax.php';
    var form_id     = '.form-upgrade-study-'+$(this).data('id');
    var id          = $(this).data('id');
    var datastring  = $(form_id).serialize();

    var errors = 0;
    var data_form = $(this).parent('form');
      $('.warning-message').html("");
      data_form.find(".required").map(function () {
        if (!$(this).val() || $(this).val() == "Add a card") {
                $(this).addClass('warning');
                errors++;
        } else if ($(this).val()) {
            $(this).removeClass('warning');
        }
    });
    if (!$("#patient_messaging_suit_checkbox_id-"+id).is(':checked') && !$("#upgrade_type-"+id).val()){
        $("#upgrade_type-"+id).addClass('warning');
        $("#patient_messaging_suit_checkbox_id-"+id).parent().addClass('warning_checkbox_container');
        errors++;
    }else {
        $("#upgrade_type-"+id).removeClass('warning');
        $("#patient_messaging_suit_checkbox_id-"+id).parent().removeClass('warning_checkbox_container');
    }
    //.upgrade_type
      //patient_messaging_suit_checkbox_id
      
    if (errors == 0) {
        $('.upgrade-button-'+id).val('Processing...');
        $('.upgrade-button-'+id).prop('disabled', true);
        var code = data_form.find('#coupon-input-upgrade').val();
        console.log("====coupon code====");
        console.log(code);
        var coupon_ajaxurl     = '/wp-admin/admin-ajax.php';
        var coupon_datastring  = {coupon:code, action:'couponcode'};

        if (code) {
            $.ajax({
                type: "POST",
                url: coupon_ajaxurl,
                data: coupon_datastring,
                //dataType: "json",
                success: function(coupon_data) {
                    var coupon_obj = $.parseJSON(coupon_data);
                    if (coupon_obj['type'] == "invalid") {
                        $('.upgrade-button-'+id).prop('disabled', false);
                        $('.upgrade-button-'+id).val('Upgrade My Study');
                        $(form_id + " .warning-message").html("This coupon code is invalid or has expired.");
                    } else {
                        $.ajax({
                            type: "POST",
                            url: ajaxurl,
                            data: datastring,
                            success: function(data) {
                                var json = $.parseJSON(data);
                                console.log(json  );
                                if(json[0].approved != 'no'){
                                    $('.upgrade-button-'+id).val('Approved!');
                                    $(form_id + " .warning-message").html("");
                                    if ($("#patient_messaging_suit_checkbox_id-"+id).is(':checked')){
                                        $("#upgrade_type_suite-"+id).val("Patient Messaging Suite $247");
                                    }
                                    $(form_id).find("#invoice_number_" + id).val(json[0].invoice_number);
                                    $(form_id).submit();
                                    data_form.find(".required").map(function () {
                                        $(this).removeClass('warning');
                                    });
                                }else{
                                    $('.upgrade-button-'+id).prop('disabled', false);
                                    $('.upgrade-button-'+id).val('Upgrade My Study');
                                    $(form_id + " .warning-message").html("We are sorry! We are unable to process your payment");
                                }
                            },
                            error: function(data){
                                $('.upgrade-button-'+id).prop('disabled', false);
                                $('.upgrade-button-'+id).val('Upgrade My Study');
                                $(form_id + " .warning-message").html("We are sorry! We are unable to process your payment");
                                console.log(data);
                                jQuery('.order_status').html(data);
                            }
                        });
                    }
                },
                error: function(data){
                    $('.upgrade-button-'+id).prop('disabled', false);
                    $('.upgrade-button-'+id).val('Upgrade My Study');
                    $(form_id + " .warning-message").html("This coupon code is invalid or has expired.");
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: datastring,
                success: function(data) {
                    var json = $.parseJSON(data);
                    console.log(json  );
                    if(json[0].approved != 'no'){
                        $('.upgrade-button-'+id).val('Approved!');
                        $(form_id + " .warning-message").html("");
                        if ($("#patient_messaging_suit_checkbox_id-"+id).is(':checked')){
                            $("#upgrade_type_suite-"+id).val("Patient Messaging Suite $247");
                        }
                        $(form_id).find("#invoice_number_" + id).val(json[0].invoice_number);
                        $(form_id).submit();
                        data_form.find(".required").map(function () {
                            $(this).removeClass('warning');
                        });
                    }else{
                        $('.upgrade-button-'+id).prop('disabled', false);
                        $('.upgrade-button-'+id).val('Upgrade My Study');
                        $(form_id + " .warning-message").html("We are sorry! We are unable to process your payment");
                    }
                },
                error: function(data){
                    $('.upgrade-button-'+id).prop('disabled', false);
                    $('.upgrade-button-'+id).val('Upgrade My Study');
                    $(form_id + " .warning-message").html("We are sorry! We are unable to process your payment");
                    console.log(data);
                    jQuery('.order_status').html(data);
                }
            });
        }
    }

    
    return false;
  });
  
  $('.go-renew-button').click(function(){
    var ajaxurl     = '/wp-admin/admin-ajax.php';
    var form_id     = '.form-renew-study-'+$(this).data('id');
    var id          = $(this).data('id');
    var datastring  = $(form_id).serialize();

      var errors = 0;
      var data_form = $(this).parent('form');

      $('.warning-message').html("");
      data_form.find(".required").map(function () {
          if (!$(this).val() || $(this).val() == "Add a card") {
              $(this).addClass('warning');
              errors++;
          } else if ($(this).val()) {
              $(this).removeClass('warning');
          }
      });
      if (errors == 0) {
//          var confirm_password = $(this).closest('form').find('#confirm_password-renew').val();
//          console.log(confirm_password);
          $('.renew-button-'+id).prop('disabled', true);
          $('.renew-button-'+id).val('Processing...');
//          $.ajax({
//              type: "POST",
//              url: ajaxurl,
//              data: {confirm_password:confirm_password, action:'confirm_password'},
//              //dataType: "json",
//              success: function(response) {
//                  if (response == "success") {
                      $('.renew-button-'+id).val('Processing...');
                      $('.renew-button-'+id).prop('disabled', true);
                      var code = data_form.find('#coupon-input-renew').val();
                      console.log("====coupon code====");
                      console.log(code);
                      var coupon_ajaxurl     = '/wp-admin/admin-ajax.php';
                      var coupon_datastring  = {coupon:code, action:'couponcode'};

                      if (code) {
                          $.ajax({
                              type: "POST",
                              url: coupon_ajaxurl,
                              data: coupon_datastring,
                              //dataType: "json",
                              success: function(coupon_data) {
                                  var coupon_obj = $.parseJSON(coupon_data);
                                  if (coupon_obj['type'] == "invalid") {
                                      $('.renew-button-'+id).prop('disabled', false);
                                      $('.renew-button-'+id).val('Renew My Study');
                                      $(form_id + " .warning-message").html("This coupon code is invalid or has expired.");
                                  } else {
                                      $.ajax({
                                          type: "POST",
                                          url: ajaxurl,
                                          data: datastring,
                                          success: function(data) {
                                              var json = $.parseJSON(data);
                                              if(json[0].approved != 'no'){
                                                  $('.renew-button-'+id).val('Approved!');
                                                  $(form_id).find("#invoice_number_" + id).val(json[0].invoice_number);
                                                  $(form_id).submit();
                                                  data_form.find(".required").map(function () {
                                                      $(this).removeClass('warning');
                                                  });
                                                  $(form_id + " .warning-message").html("");
                                              }else{
                                                  $('.renew-button-'+id).prop('disabled', false);
                                                  $('.renew-button-'+id).val('Renew My Study');
                                                  $(form_id + " .warning-message").html("We are sorry! We are unable to process your payment");
                                              }
                                          },
                                          error: function(data){
                                              $('.renew-button-'+id).prop('disabled', false);
                                              $('.renew-button-'+id).val('Renew My Study');
                                              $(form_id + " .warning-message").html("We are sorry! We are unable to process your payment");
                                              console.log(data);
                                              jQuery('.order_status').html(data);
                                          }
                                      });
                                  }
                              },
                              error: function(data){
                                  $('.renew-button-'+id).prop('disabled', false);
                                  $('.renew-button-'+id).val('Renew My Study');
                                  $(form_id + " .warning-message").html("This coupon code is invalid or has expired.");
                              }
                          });
                      } else {
                          $.ajax({
                              type: "POST",
                              url: ajaxurl,
                              data: datastring,
                              success: function(data) {
                                  var json = $.parseJSON(data);
                                  if(json[0].approved != 'no'){
                                      $('.renew-button-'+id).val('Approved!');
                                      $(form_id).find("#invoice_number_" + id).val(json[0].invoice_number);
                                      $(form_id).submit();
                                      data_form.find(".required").map(function () {
                                          $(this).removeClass('warning');
                                      });
                                      $(form_id + " .warning-message").html("");
                                  }else{
                                      $('.renew-button-'+id).prop('disabled', false);
                                      $('.renew-button-'+id).val('Renew My Study');
                                      $(form_id + " .warning-message").html("We are sorry! We are unable to process your payment");
                                  }
                              },
                              error: function(data){
                                  $('.renew-button-'+id).prop('disabled', false);
                                  $('.renew-button-'+id).val('Renew My Study');
                                  $(form_id + " .warning-message").html("We are sorry! We are unable to process your payment");
                                  console.log(data);
                                  jQuery('.order_status').html(data);
                              }
                          });
                      }
//                  } else {
//                      $('.renew-button-'+id).prop('disabled', false);
//                      $('.renew-button-'+id).val('Renew My Study');
//                      $(form_id + " .warning-message").html("Password is incorrect.");
//                  }
//              },
//              error: function(data){
//                  $('.renew-button-'+id).prop('disabled', false);
//                  $('.renew-button-'+id).val('Renew My Study');
//                  $(form_id + " .warning-message").html("Password is incorrect.");
//              }
//          });

      }
    return false;
  });
  
  $('.go-renew-button-client').click(function(){
    var ajaxurl     = '/wp-admin/admin-ajax.php';
    var form_id     = '.form-renew-client-study-'+$(this).data('id');
    var id          = $(this).data('id');
    var datastring  = $(form_id).serialize();

      var errors = 0;
      var data_form = $(this).parent('form');

      $('.warning-message').html("");
      data_form.find(".required").map(function () {
          if (!$(this).val() || $(this).val() == "Add a card") {
              $(this).addClass('warning');
              errors++;
          } else if ($(this).val()) {
              $(this).removeClass('warning');
          }
      });
      if (errors == 0) {
//          var confirm_password = $(this).closest('form').find('#confirm_password-client').val();
//          console.log(confirm_password);
          $('.renew-button-'+id).prop('disabled', true);
          $('.renew-button-'+id).val('Processing...');
//          $.ajax({
//              type: "POST",
//              url: ajaxurl,
//              data: {confirm_password:confirm_password, action:'confirm_password'},
//              //dataType: "json",
//              success: function(response) {
//                  if (response == "success") {
                      $('.renew-button-'+id).prop('disabled', true);
                      $('.renew-button-'+id).val('Processing...');
                      var code = data_form.find('#coupon-input-renew-client').val();
                      console.log("====coupon code====");
                      console.log(code);
                      var coupon_ajaxurl     = '/wp-admin/admin-ajax.php';
                      var coupon_datastring  = {coupon:code, action:'couponcode'};

                      if (code) {
                          $.ajax({
                              type: "POST",
                              url: coupon_ajaxurl,
                              data: coupon_datastring,
                              //dataType: "json",
                              success: function(coupon_data) {
                                  var coupon_obj = $.parseJSON(coupon_data);
                                  if (coupon_obj['type'] == "invalid") {
                                      $('.renew-button-'+id).prop('disabled', false);
                                      $('.renew-button-'+id).val('Renew My Study');
                                      $(form_id + " .warning-message").html("This coupon code is invalid or has expired.");
                                  } else {
                                      $.ajax({
                                          type: "POST",
                                          url: ajaxurl,
                                          data: datastring,
                                          success: function(data) {
                                              var json = $.parseJSON(data);
                                              if(json[0].approved != 'no'){
                                                  $('.renew-button-'+id).val('Approved!');
                                                  $(form_id + " .warning-message").html("");
                                                  $(form_id).find("#invoice_number_" + id).val(json[0].invoice_number);
                                                  $(form_id).submit();
                                                  data_form.find(".required").map(function () {
                                                      $(this).removeClass('warning');
                                                  });

                                              }else{
                                                  $('.renew-button-'+id).prop('disabled', false);
                                                  $('.renew-button-'+id).val('Renew My Study');
                                                  $(form_id + " .warning-message").html("We are sorry! We are unable to process your payment");
                                              }
                                          },
                                          error: function(data){
                                              console.log(data);
                                              jQuery('.order_status').html(data);
                                          }
                                      });
                                  }
                              },
                              error: function(data){
                                  $('.renew-button-'+id).prop('disabled', false);
                                  $('.renew-button-'+id).val('Renew My Study');
                                  $(form_id + " .warning-message").html("This coupon code is invalid or has expired.");
                              }
                          });
                      } else {
                          $.ajax({
                              type: "POST",
                              url: ajaxurl,
                              data: datastring,
                              success: function(data) {
                                  var json = $.parseJSON(data);
                                  if(json[0].approved != 'no'){
                                      $('.renew-button-'+id).val('Approved!');
                                      $(form_id + " .warning-message").html("");
                                      $(form_id).find("#invoice_number_" + id).val(json[0].invoice_number);
                                      $(form_id).submit();
                                      data_form.find(".required").map(function () {
                                          $(this).removeClass('warning');
                                      });

                                  }else{
                                      $('.renew-button-'+id).prop('disabled', false);
                                      $('.renew-button-'+id).val('Renew My Study');
                                      $(form_id + " .warning-message").html("We are sorry! We are unable to process your payment");
                                  }
                              },
                              error: function(data){
                                  console.log(data);
                                  jQuery('.order_status').html(data);
                              }
                          });
                      }
//                  } else {
//                      $('.renew-button-'+id).prop('disabled', false);
//                      $('.renew-button-'+id).val('Renew My Study');
//                      $(form_id + " .warning-message").html("Password is incorrect.");
//                  }
//              },
//              error: function(data){
//                  $('.renew-button-'+id).prop('disabled', false);
//                  $('.renew-button-'+id).val('Renew My Study');
//                  $(form_id + " .warning-message").html("Password is incorrect.");
//              }
//          });
      }
    
    return false;
  });
</script>


<script src="<?php bloginfo('template_url');?>/js/ajax-loader.js"></script>

