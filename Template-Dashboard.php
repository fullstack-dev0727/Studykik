<?php
/*
 * Template Name: Client Dashboard
 */
?>
<?php
if (is_user_logged_in()) {
    $user_ID = get_current_user_id();
    $user_info = get_userdata($user_ID);
    $user_roles = implode(', ', $user_info->roles);
    if ($user_roles == "author" || $user_ID == 45 || $user_ID == 53 || $user_ID == 51 || $user_ID == 52) {
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
if (is_user_logged_in()) {
    $user_ID = get_current_user_id();
    $user_info = get_userdata($user_ID);
    $user_roles = implode(', ', $user_info->roles);
    if ($user_roles == "manager_username") {?>
<?php get_header('responsive');?>
 
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
    padding: 10px 42px;
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
    background-image: url("http://getbootstrap.com/2.3.2/assets/img/glyphicons-halflings.png");
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
      background-image: url("http://getbootstrap.com/2.3.2/assets/img/glyphicons-halflings.png");
    background-position: -48px 0;
    content: "";
    display: block;
    height: 14px;
    left: 40px;
    opacity: 0.5;
    position: absolute;
    top: 80px;
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
.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input {
  border-radius: 0;
  height: 42px;
  width: 290px;
}
.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input {
  margin-top: 1px;
  padding: 0 0 4px 17px;
  top: 15px !important;
}
.ui-button.ui-widget.ui-state-default.ui-button-icon-only.custom-combobox-toggle.ui-corner-right {
    border: 1px solid gray;
    height: 42px;
    width: 19px;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
	background: #e6e6e6 url("images/ui-bg_glass_75_e6e6e6_1x4001.png") repeat-x scroll 50% 50%;
	background:white;
}
.ui-button.ui-widget.ui-state-default.ui-button-icon-only.custom-combobox-toggle.ui-corner-right {
  border: 1px solid black !important;
  border-radius: 0;
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
            var dInput = this.value;
            jQuery('#data').hide();
            jQuery.ajax({
                type: "GET",
                url: "<?php bloginfo('url'); ?>/find-listing-using-jquery/",
                data: "sticky=" + dInput+"&role=1&sel_val=<?php echo $sel_val;?>",
                success: function (data) {
                    jQuery('#data2').html(data);
                    jQuery('#data2').show();
                }
            });
        });
        jQuery("#search_btn2").keyup(function () {
            var dInput = this.value;
            jQuery('#data').hide();
            jQuery.ajax({
                type: "GET",
                url: "<?php bloginfo('url'); ?>/jquery-past-studies/",
                data: "sticky2=" + dInput+"&role=1&sel_val=<?php echo $sel_val;?>",
                success: function (data) {
                    jQuery('#data2').html(data);
                    jQuery('#data2').show();
                }
            });
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
	  location.search = "aid="+selected_idd;
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
        $first_name = explode(" ", $fullname);
        $fname = $first_name[0];
        $query_invoice_number = $wpdb->get_results("SELECT * FROM `0gf1ba_invoice_number` ORDER BY `id` DESC LIMIT 1");
        foreach ($query_invoice_number as $query_invoice_number_value) {
            $invoice_num = $query_invoice_number_value->invoice_number;
        }
        if (!empty($_REQUEST['postID']) || !empty($_REQUEST['boostStudy'])) {
            $post_id = $_REQUEST['postID'];
            $boostStudy = stripslashes($_REQUEST['upgrade_type']);
            $renew_type = $_REQUEST['renew_type'];
            $blast_501 = $_REQUEST['blast_501'];
            $condense_2_weeks1 = $_REQUEST['condense_2_weeks1'];

            $select_date = $_REQUEST['select_date'];

            if (isset($_REQUEST['blast_501'])) {
                $text_blast2 = '50';
                $text_blast_email = 'Yes';
            }
            if (isset($_REQUEST['condense_2_weeks1'])) {
                $condense_2_weeks1_email = 'Yes';
            }
            $final_num = $invoice_num + 1;
            $contactname = get_post_meta($post_id, 'email_adress_2', true);
            $contactemail = get_post_meta($post_id, 'email_adress_3', true);
            $contactemail2 = get_post_meta($post_id, 'email_adress_4', true);
            $contactemail3 = get_post_meta($post_id, 'email_adress_5', true);
            $contactemail4 = get_post_meta($post_id, 'email_adress_6', true);
            $contactphone = get_post_meta($post_id, 'phone_number', true);
            $protocolnumber = get_post_meta($post_id, 'protocol_no', true);
            $boost_type1 = get_post_meta($post_id, 'exposure_level', true);
            $sitename = get_post_meta($post_id, 'name_of_site', true);
            $studylocation = get_post_meta($post_id, 'study_full_address', true);
            $study_website = get_post_meta($post_id, 'website_url_thank_you_page', true);
            $studytype = get_post_meta($post_id, 'custom_title_(for_thank_you_page)', true);
            $attachments111 = get_post_meta($post_id, 'file_url', true);
            $study_no = get_post_meta($post_id, 'study_no', true);
            //echo $study_no;die;
            if ($boostStudy) {
                if (get_field('study_end_date', $post_id)) {
                    $date2 = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post_id));
                    $newDate = $date2->format('m/d/Y');
                } else {
                    $newDate = '30/12/2015';
                }
                $startdate = date("m/d/Y", strtotime($newDate . " -31 days"));
            } else {
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
                    $newDate = date("m/d/Y", strtotime($startdate . " +14 day"));
                } else {
                    $newDate = date("m/d/Y", strtotime($startdate . " +29 day"));
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
            } else {
//        if ($renew_type == "Diamond $3059") {
//            $price = '$3,059.00';
//            $price2 = '3059.00';
//            if($user_roles=='editor'){
//                $current_points=get_user_meta($user_ID, 'rewards', true);
//                if($current_points !=""){
//                    $current_points=$current_points+30;
//                }
//                else{
//                    $current_points=30;
//                }
//                update_user_meta( $user_ID, 'rewards', $current_points);
//            }
//            else{
//                $post_author_id = get_post_field( 'post_author', $post_id );
//                if($post_author_id){
//                    $current_points=get_user_meta($post_author_id, 'rewards', true);
//                    if($current_points !=""){
//                        $current_points=$current_points+30;
//                    }
//                    else{
//                        $current_points=30;
//                    }
//                    update_user_meta( $post_author_id, 'rewards', $current_points);
//                }
//                else{
//                    $susces=0;
//                }
//            }
//	}
//        if ($renew_type == "Platinum $1559") {
//            $price = '$1,559.00';
//            $price2 = '1559.00';
//            if($user_roles=='editor'){
//                $current_points=get_user_meta($user_ID, 'rewards', true);
//                if($current_points !=""){
//                    $current_points=$current_points+15;
//                }
//                else{
//                    $current_points=15;
//                }
//                update_user_meta( $user_ID, 'rewards', $current_points);
//            }
//            else{
//                $post_author_id = get_post_field( 'post_author', $post_id );
//                if($post_author_id){
//                    $current_points=get_user_meta($post_author_id, 'rewards', true);
//                    if($current_points !=""){
//                        $current_points=$current_points+15;
//                    }
//                    else{
//                        $current_points=15;
//                    }
//                    update_user_meta( $post_author_id, 'rewards', $current_points);
//                }
//                else{
//                    $susces=0;
//                }
//            }
//        }
//        if ($renew_type == "Gold $559") {
//            $price = '$559.00';
//            $price2 = '559.00';
//	     if($user_roles=='editor'){
//                $current_points=get_user_meta($user_ID, 'rewards', true);
//                if($current_points !=""){
//                    $current_points=$current_points+5;
//                }
//                else{
//                    $current_points=5;
//                }
//                update_user_meta( $user_ID, 'rewards', $current_points);
//            }
//            else{
//                $post_author_id = get_post_field( 'post_author', $post_id );
//                if($post_author_id){
//                    $current_points=get_user_meta($post_author_id, 'rewards', true);
//                    if($current_points !=""){
//                        $current_points=$current_points+5;
//                    }
//                    else{
//                        $current_points=5;
//                    }
//                    update_user_meta( $post_author_id, 'rewards', $current_points);
//                }
//                else{
//                    $susces=0;
//                }
//            }
//        }
                $point_transfer = 0;
                $transfer_id = $user_ID;
                $act_txt = "";
                if ($renew_type == "Diamond $3059") {
                    $price = '$3,059.00';
                    $price2 = '3059.00';
                    $point_transfer = 30;
                    $act_txt = 'Diamond';
                }
                if ($renew_type == "Platinum $1559") {
                    $price = '$1,559.00';
                    $price2 = '1559.00';
                    $point_transfer = 15;
                    $act_txt = 'Platinum';
                }
                if ($renew_type == "Gold $559") {
                    $price = '$559.00';
                    $price2 = '559.00';
                    $point_transfer = 5;
                    $act_txt = 'Gold';
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
                if ($renew_type == "Silver $209") {
                    $price = '$209.00';
                    $price2 = '209.00';
                }
                if ($renew_type == "Bronze $59") {
                    $price = '$59.00';
                    $price2 = '59.00';
                }
            }

            $sub_total = $price2 + $text_blast2;
            setlocale(LC_MONETARY, "en_US");
            $sub_price = money_format("%i", $sub_total);
            $total_price = str_ireplace("USD", "$", $sub_price);
            $total_price = str_ireplace(" ", "", $total_price);
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
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Start Date:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $startdate . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactname . "</td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #3:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail2 . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #4:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail3 . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #5:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail4 . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
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
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $boostStudy . "</td>
  </tr>";
            } else {
                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $renew_type . "</td>
  </tr>";
                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Add Additional Text Blast ($50):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $text_blast_email . "</td>
  </tr>";
                $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Condense to 2 Weeks (Free):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $condense_2_weeks1_email . "</td>
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

											th{padding:8px 0px;}
											td
											{
											padding:6px 0px;
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
				<col style='width: 57%'>
				<col style='width: 5%'>
				<col style='width: 20%'>

				      <tr>
					<th style='text-align:left; margin-left:20px;' colspan='2'><img style='width:295px; height:52px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/background_top.png'/><p style='font-size:14px; color:#959ca1;font-weight:normal; margin:2px 0px 0px 0px; line-height:18px;'><b>StudyKIK</b><br />1675 Scenic Ave #150<br />Costa Mesa, CA 92626</p></th>
					<th colspan='2' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px;'>
					<h1>INVOICE RECEIPT</h1>
					Invoice Number: " . $final_num . "<br />
                    Invoice Date: " . $startdate . "<br />
                    Term | Due on Receipt</th>
				    </tr>
				<tbody>
				<tr>
					<th style='text-align:left' colspan='4'><img style='width:100%;' src='".site_url()."/wp-content/themes/twentyfifteen/images/top_full.png'/></th></tr>
				    <tr style='text-align:center; font-size:18px;color:#000;'>
					<th align='left' style='border-bottom:1px solid #000;'>SERVICES:</th>
					<th align='left'style='border-bottom:1px solid #000;'>DESCRIPTION:</th>
					<th style='border-bottom:1px solid #000;'></th>
					<th  align='right' style='border-bottom:1px solid #000;'>AMOUNT:</th>
				    </tr>

				<tr align='center'>
				    <td align='left'>Listing</td>
				    <td align='left'><b>Site Name:</b> " . $sitename . "</td>
				    <td align='center'> </td>
				    <td align='right'>" . $price . " </td>
				</tr>";

            $message_pdf .= "<tr align='center'>
				    <td align='left'></td>
				    <td align='left'><b>Study Type:</b> " . $studytype . "</td>
                                    <td align='center'> </td>
				    <td align='center'></td>
				</tr>
				";
            if ($boostStudy) {
                $message_pdf .= "<tr align='left'>
        <td align='left'> </td>
        <td align='left'><b>Study Level:</b> " . $boostStudy . "</td>
	    <td align='center'> </td>
        <td align='center'> </td>
    </tr>";
            } else {
                $message_pdf .= "<tr align='left'>
        <td align='left'> </td>
        <td align='left'><b>Study Level:</b> " . $renew_type . "</td>
        <td align='center'> </td>
        <td align='center'> </td>
    </tr>";
            }

            if ($protocolnumber) {
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Protocol Number:</b> " . $protocolnumber . "</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }
            if ($contactphone) {
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Phone:</b> " . $contactphone . "</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }

            $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Recruitment Email 1:</b> " . $contactname . "</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";

            if ($contactemail) {
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email 2:</b> " . $contactemail . "</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }


            if ($contactemail2) {
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email 3:</b> " . $contactemail2 . "</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }

            if ($contactemail3) {
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email 4:</b> " . $contactemail3 . "</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }

            if ($contactemail4) {
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email 5:</b> " . $contactemail4 . "</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }
            $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Study Address:</b> " . $studylocation . "</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>
				<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Start Date:</b> " . $startdate . "</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>
				<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>End Date:</b> " . $newDate . "</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";

            if ($text_blast_email == "Yes") {
                $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>Text Blast</td>
				    <td bordercolor='#000' align='left'> </td>
				    <td bordercolor='#000' align='center'> </td>
				    <td bordercolor='#000' align='right'>$" . $text_blast2 . ".00</td>
				    </tr>";
            } else {

                $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";
            }
            if ($contactemail == "") {
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }
            if ($contactemail2 == "") {
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					";
            }
            if ($contactemail3 == "") {
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>

					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }
            if ($contactemail4 == "") {
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }

            $message_pdf .= "

				<tr class='sub_total' align='left'>
				<td align='center'  style='border-top:1px solid #000;'> </td>
				<td align='left'  style='border-top:1px solid #000;'> </td>
				<td align='right' colspan='2' style='border-top:1px solid #000;'>SUB TOTAL:&nbsp; " . $total_price . "</td>
				</tr>
				<tr class='total' align='left'>
				<td align='center'> </td>
				<td align='left'> </td>
				<td align='right' colspan='2'><b>TOTAL:&nbsp; " . $total_price . "</b></td>
				</tr>
				</tbody>
				<tr>";

            if ($contactemail4 == "") {

                $message_pdf .= "<th colspan='4' style='font-size: 14px;'><img style='width:100%;height:470px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";
            } else {

                $message_pdf .= "<th colspan='4' style='font-size: 14px;'><img style='width:100%;height:450px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";
            }
            $message_pdf .= "</tr>
				</table></page>";



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
            $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
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
            } else {
                $html2pdf->Output(dirname(__FILE__) . "/pdf/" . $studytype . ' ' . $renew_type . ' Renew Invoice' . ".pdf", "f");
                $html2pdf->Output($_SERVER['DOCUMENT_ROOT'] . "/pdf/" . $final_num . '_' . $studytype . '_Renew_Invoice' . ".pdf", "f");
                $pdf_attachment_path = dirname(__FILE__) . '/pdf/' . $studytype . ' ' . $renew_type . ' Renew Invoice.pdf';
                $pdf_attachment_path_db = '/pdf/' . $final_num . '_' . $studytype . '_Renew_Invoice.pdf';
                $attachments[] = dirname(__FILE__) . '/pdf/' . $studytype . ' ' . $renew_type . ' Renew Invoice.pdf';
            }
            $current_month = date('M');
            $current_year = date('Y');
            $full_date = date('m/d/y');
            $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`(`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES (NULL,'$user_id','$post_id','$pdf_attachment_path_db','$protocolnumber','$final_num','$total_price','$current_month','$current_year','Study Information','$full_date')"));

            if($user_ID == 70 || $user_ID == 532 || $user_ID == 534 ){
                wp_mail('mo.tan@studykik.com', $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);
                //wp_mail('arif.blissitsolutions@gmail.com', $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);
            }
            else
            {
                  wp_mail($current_user_email, $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);
            }

            //wp_mail("sanjujagpal@gmail.com", $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);
            $pdf_email_text = "";
            $message_pdf = "";
            //wp_mail('chandel.anku91@gmail.com', $subject, $message, $headers, $attachments);
            //wp_mail('keshvendersingh145@gmail.com', $subject, $message, $headers, $attachments);
              if($user_ID == 70 || $user_ID == 532 || $user_ID == 534 ){
                 $SendEmail = wp_mail('mo.tan@studykik.com', $subject, $message, $headers, $attachments);

            }
            else
            {
                  $SendEmail = wp_mail('info@studyKIK.com', $subject, $message, $headers, $attachments);
            }

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
                                        <h1><a href="index.html">Kitchy Food</a><img src="<?php echo get_template_directory_uri(); ?>/images-dashboard/logout_logo.png" alt=""></h1>
                                    </header>
                                      <ul class="nav navbar-nav">
                                        <li><a href="<?php echo site_url();?>/dashboard/"  style="color:#00afef; margin-top:12px">HOME
                                            </a></li>
                                            <li><a href="<?php echo site_url();?>/clinical-study-information-dashboard/">LIST A<br>
                                                NEW STUDY</a></li>
                                                <li><a  href="<?php echo site_url();?>/add-site/">ADD<br>
                                                SITE</a></li>
                                        <li style="border:none;"><a class="midsection" href="<?php echo site_url();?>/refer-listing/">REFER<br>
                                                A LISTING</a></li>
                                        <li ><a href="<?php echo site_url();?>/rewards/"  style="color:#00afef; margin-top:12px">REWARDS</a></li>
<!--                                        <li><a href="javascript:void:0();"> ADD<br> PREFERRED<br> IRBs</a></li>-->
                                       <li><a href="<?php echo site_url();?>/proposal/">CREATE <br/> PROPOSAL</a></li>
                                         <li><a href="<?php echo site_url();?>/invoice-receipts/">INVOICE <br />
                                         RECEIPTS</a></li>
                                        <li><a href="<?php echo site_url();?>/your-profile/?idp=Profile"  style="color:#00afef; margin-top:12px">MY ACCOUNT
                                                </a></li>
                                    </ul>
                                    <div class="studykik_contact">
                                        <p>Stud<span class="blue_text">y</span><span class="orange_text">KIK</span> Team Member: <span class="green_text"><?php echo get_the_author_meta('project_manager', $user_ID); ?></span> - <span class="blue_text"><?php echo get_the_author_meta('phone_number', $user_ID); ?></span></p>

                                    </div>
                                </div>
                                <!-- /.navbar-collapse -->
                            </div>
                            <!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <section class="container_current">
                        <?php
                        $authors_ids = array();
                        if ($user_roles == 'manager_username') {
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

                            if (have_posts()) {
                                while (have_posts()) : the_post();
                                    if ($user_roles == 'manager_username') {
                                        $post_author_id = get_post_field('post_author', $post->ID);
                                        if ($post_author_id) {
                                            if ($post_author_id > 0) {
                                                $user = get_user_by('id', $post_author_id);
                                                if ($user->user_login != "") {
                                                    $authors_ids[$post_author_id] = $user->user_login;
                                                }
                                            }
                                        }
                                    }
                                endwhile;
                            }
                            ?>
                            <div class="select_btn" style="margin-left:30px">
                            <?php
                            $sel_val='all';
                            if(isset($_REQUEST['aid'])){
                                $sel_val=$_REQUEST['aid'];
                            }
                        ?>
						  <div class="ui-widget">
			 <select id="combobox">
			<option <?php if($sel_val=='all'){echo 'selected="selected"';}?> value="all">All</option>
                        <?php
                        foreach($authors_ids as $auid => $qry){ ?>
                            <option <?php if($auid == $sel_val){echo 'selected="selected"';}?> value="<?php echo $auid;?>"><?php echo $qry;?></option>
                        <?php } ?>

                            </select>
							</div>
                        </div>
                        <a class="add_site" href="<?php echo site_url();?>/add-site/"><img style="width:135px;height:48px" src="<?php echo get_template_directory_uri(); ?>/images-dashboard/site_btn.png" alt="" class="img-responsive"></a>
                        <?php }
                        $_SESSION['authors_ids'] = $authors_ids;
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

                        <div class="col-12 col-md-6" style="padding-left:20px !important;">
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
    <p style="width:100%;"><b style=" <?php if ($i == 1) { echo 'color:#00afef;'; } if ($i == 2) { echo 'color:#f78e1e;';
                            } if ($i == 3) {  echo 'color:#9fcf67;'; } ?>">Sponsor:</b> <?php echo get_field('sponsor_name', $post->ID);?></p>
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
                                     document.getElementById('fade').style.display = 'block'" href="javascript:void(0);">Renew Study ></a>
                                                    <?php } else { ?>
                                              <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                     echo 'background:#00afef;';
                                      } if ($i == 2) {
                                      echo 'background:#f78e1e;';
                                       } if ($i == 3) {
                                       echo 'background:#9fcf67;';
                                      } ?>" class="patient" onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'block';
                                     document.getElementById('fade').style.display = 'block'" href="javascript:void(0);">Renew Study ></a>

                                                  <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                           echo 'background:#00afef;';
                                            } if ($i == 2) {
                                            echo 'background:#f78e1e;';
                                            } if ($i == 3) {
                                            echo 'background:#9fcf67;';
                                           } ?>" class="patient" onclick="document.getElementById('embed2<?php echo $post->ID; ?>').style.display = 'block';
                                     document.getElementById('fade').style.display = 'block'" href="javascript:void(0);">Upgrade Study ></a>

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
                        <div class="col-12 col-md-6"><a href="<?php echo site_url();?>/clinical-study-information-dashboard/"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/new_study.png" alt="" class="img-responsive"></a> <a href="<?php echo site_url();?>/rewards/"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/rewards.png" alt="" class="img-responsive"></a> <a href="<?php echo site_url();?>/refer-listing/ "><img src="<?php bloginfo('template_url'); ?>/images-dashboard/refer_listin.png" alt="" class="img-responsive irt"></a><a href="javascript:void:0();"><img src="<?php echo get_template_directory_uri(); ?>/images-dashboard/irb_selection.png" alt="" class="img-responsive asd"></a> </div>
                    </section>
                </div>
            </div>
        </div>
        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
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
                    <h2 class="heading">Renew Study Confirmation</h2>
                    <p style="color: #000; padding: 15px 15px 5px ; font-size: 16px; text-align: center;font-weight: bold;">What level would you like to renew this study for?</p>
                    <form action="" method="post" style="text-align: center;margin:0px;" onsubmit="return validate_renew_type('<?php echo $post->ID; ?>');">
                        <select name="renew_type" class="renew_type" style="padding: 6px; margin-bottom:5px;">
                            <option value="">Select Level</option>
                            <option value="Diamond $3059">Diamond $3059</option>
                            <option value="Platinum $1559">Platinum $1559</option>
                            <option value="Gold $559">Gold $559</option>
                            <option value="Silver $209">Silver $209</option>
                            <option value="Bronze $59">Bronze $59</option>
                        </select>
                        <input type="text" value="<?php echo date('m/d/Y'); ?>" placeholder="Select Start Date" id="datepicker<?php echo $post->ID; ?>" name="select_date" style="height: 32px;" />
                        <p style="margin: 0px;">
                            <label>Add Additional Text Blast ($50): </label>
                            <input type="checkbox" name="blast_501">
                            <span style="color: #00afef;margin-left: 10px;font-weight: bold;">Yes</span></p>
                        <p style="margin: 0px;">
                            <label>Condense to 2 Weeks (Free): </label>
                            <input type="checkbox" name="condense_2_weeks1">
                            <span style="color: #00afef;margin-left: 10px;font-weight: bold;">Yes</span></p>
        <?php //echo $day_left; ?>
                        <input type="hidden" name="postID" value="<?php echo $post->ID; ?>" />
                        <input class="done_button" type="submit"   value="Renew My Study" />
                    </form>
                    <a onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'none';
                            document.getElementById('fade').style.display = 'none';
                       " href="javascript:void(0);" class="closepop">Close</a> </div>
                <div id="embed2<?php echo $post->ID; ?>" class="white_content" style="display: none;">
                    <h2 class="heading">Upgrade Study Confirmation</h2>
                    <form action="" method="post" style="text-align: center;" onsubmit="return validate_upgrade_type('<?php echo $post->ID; ?>');" >
                        <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;font-weight: bold;">Upgrade this study to:</p>
                        <select name="upgrade_type" class="upgrade_type" style="padding: 6px; margin-bottom:20px;">
                            <option value="">Select</option>
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
                        <br />
                        <input type="hidden" name="postID" value="<?php echo $post->ID; ?>" />
                        <input  class="done_button" type="submit" value="Upgrade My Study" />
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

<?php if (is_user_logged_in()) {
    $user_ID = get_current_user_id();
    $user_info = get_userdata($user_ID);
    $user_roles = implode(', ', $user_info->roles);
    if ($user_roles == "editor") {?>
<?php
session_start();
$_SESSION['authors_ids']="";
$susces=1;

?>
<?php get_header('dashboard'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
            var dInput = this.value;
            jQuery('#data').hide();
            jQuery.ajax({
                type: "GET",
                url: "<?php bloginfo('url'); ?>/find-listing-using-jquery/",
                data: "sticky=" + dInput,
                success: function (data) {
                    jQuery('#data2').html(data);
                    jQuery('#data2').show();
                }
            });
        });
        jQuery("#search_btn2").keyup(function () {
            var dInput = this.value;
            jQuery('#data').hide();
            jQuery.ajax({
                type: "GET",
                url: "<?php bloginfo('url'); ?>/jquery-past-studies/",
                data: "sticky2=" + dInput,
                success: function (data) {
                    jQuery('#data2').html(data);
                    jQuery('#data2').show();
                }
            });
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
$first_name = explode(" ", $fullname);
$fname =  $first_name[0];
$query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` ORDER BY `id` DESC LIMIT 1");
foreach($query_invoice_number as $query_invoice_number_value){
 $invoice_num = $query_invoice_number_value->invoice_number;
}
if (!empty($_REQUEST['postID']) || !empty($_REQUEST['boostStudy'])) {
    $post_id = $_REQUEST['postID'];
    $boostStudy = stripslashes($_REQUEST['upgrade_type']);
    $renew_type = $_REQUEST['renew_type'];
    $blast_501 = $_REQUEST['blast_501'];
    $condense_2_weeks1 = $_REQUEST['condense_2_weeks1'];

	$select_date = $_REQUEST['select_date'];

    if (isset($_REQUEST['blast_501'])) {
        $text_blast2 = '50';
        $text_blast_email = 'Yes';
    }
    if (isset($_REQUEST['condense_2_weeks1'])) {
        $condense_2_weeks1_email = 'Yes';
    }
	$final_num =  $invoice_num+1;
    $contactname = get_post_meta($post_id, 'email_adress_2', true);
    $contactemail = get_post_meta($post_id, 'email_adress_3', true);
    $contactemail2 = get_post_meta($post_id, 'email_adress_4', true);
    $contactemail3 = get_post_meta($post_id, 'email_adress_5', true);
    $contactemail4 = get_post_meta($post_id, 'email_adress_6', true);
    $contactphone = get_post_meta($post_id, 'phone_number', true);
    $protocolnumber = get_post_meta($post_id, 'protocol_no', true);
    $boost_type1 = get_post_meta($post_id, 'exposure_level', true);
    $sitename = get_post_meta($post_id, 'name_of_site', true);
    $studylocation = get_post_meta($post_id, 'study_full_address', true);
    $study_website = get_post_meta($post_id, 'website_url_thank_you_page', true);
    $studytype = get_post_meta($post_id, 'custom_title_(for_thank_you_page)', true);
    $attachments111 = get_post_meta($post_id, 'file_url', true);
    $study_no = get_post_meta($post_id, 'study_no', true);
    //echo $study_no;die;
    if ($boostStudy) {
        if (get_field('study_end_date', $post_id)) {
            $date2 = DateTime::createFromFormat('Ymd', get_field('study_end_date', $post_id));
            $newDate = $date2->format('m/d/Y');
        } else {
            $newDate = '30/12/2015';
        }
        $startdate = date("m/d/Y", strtotime($newDate . " -31 days"));
    } else {
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
            $newDate = date("m/d/Y", strtotime($startdate . " +14 day"));
        } else{
            $newDate = date("m/d/Y", strtotime($startdate . " +29 day"));
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
    } else {
//        if ($renew_type == "Diamond $3059") {
//            $price = '$3,059.00';
//            $price2 = '3059.00';
//            if($user_roles=='editor'){
//                $current_points=get_user_meta($user_ID, 'rewards', true);
//                if($current_points !=""){
//                    $current_points=$current_points+30;
//                }
//                else{
//                    $current_points=30;
//                }
//                update_user_meta( $user_ID, 'rewards', $current_points);
//            }
//            else{
//                $post_author_id = get_post_field( 'post_author', $post_id );
//                if($post_author_id){
//                    $current_points=get_user_meta($post_author_id, 'rewards', true);
//                    if($current_points !=""){
//                        $current_points=$current_points+30;
//                    }
//                    else{
//                        $current_points=30;
//                    }
//                    update_user_meta( $post_author_id, 'rewards', $current_points);
//                }
//                else{
//                    $susces=0;
//                }
//            }
//	}
//        if ($renew_type == "Platinum $1559") {
//            $price = '$1,559.00';
//            $price2 = '1559.00';
//            if($user_roles=='editor'){
//                $current_points=get_user_meta($user_ID, 'rewards', true);
//                if($current_points !=""){
//                    $current_points=$current_points+15;
//                }
//                else{
//                    $current_points=15;
//                }
//                update_user_meta( $user_ID, 'rewards', $current_points);
//            }
//            else{
//                $post_author_id = get_post_field( 'post_author', $post_id );
//                if($post_author_id){
//                    $current_points=get_user_meta($post_author_id, 'rewards', true);
//                    if($current_points !=""){
//                        $current_points=$current_points+15;
//                    }
//                    else{
//                        $current_points=15;
//                    }
//                    update_user_meta( $post_author_id, 'rewards', $current_points);
//                }
//                else{
//                    $susces=0;
//                }
//            }
//        }
//        if ($renew_type == "Gold $559") {
//            $price = '$559.00';
//            $price2 = '559.00';
//	     if($user_roles=='editor'){
//                $current_points=get_user_meta($user_ID, 'rewards', true);
//                if($current_points !=""){
//                    $current_points=$current_points+5;
//                }
//                else{
//                    $current_points=5;
//                }
//                update_user_meta( $user_ID, 'rewards', $current_points);
//            }
//            else{
//                $post_author_id = get_post_field( 'post_author', $post_id );
//                if($post_author_id){
//                    $current_points=get_user_meta($post_author_id, 'rewards', true);
//                    if($current_points !=""){
//                        $current_points=$current_points+5;
//                    }
//                    else{
//                        $current_points=5;
//                    }
//                    update_user_meta( $post_author_id, 'rewards', $current_points);
//                }
//                else{
//                    $susces=0;
//                }
//            }
//        }
        $point_transfer=0;
        $transfer_id=$user_ID;
        $act_txt="";
        if ($renew_type == "Diamond $3059") {
            $price = '$3,059.00';
             $price2 = '3059.00';
            $point_transfer=30;
            $act_txt='Diamond';
        }
        if ($renew_type == "Platinum $1559") {
            $price = '$1,559.00';
            $price2 = '1559.00';
            $point_transfer=15;
            $act_txt='Platinum';
        }
         if ($renew_type == "Gold $559") {
             $price = '$559.00';
            $price2 = '559.00';
            $point_transfer=5;
            $act_txt='Gold';
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
        if ($renew_type == "Silver $209") {
            $price = '$209.00';
            $price2 = '209.00';
        }
        if ($renew_type == "Bronze $59") {
            $price = '$59.00';
            $price2 = '59.00';
        }
    }

    $sub_total = $price2 + $text_blast2;
    setlocale(LC_MONETARY, "en_US");
    $sub_price = money_format("%i", $sub_total);
    $total_price = str_ireplace("USD", "$", $sub_price);
    $total_price = str_ireplace(" ", "", $total_price);
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
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Start Date:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $startdate . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #1:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactname . "</td>
  </tr>
  <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #2:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #3:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail2 . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #4:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail3 . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #5:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail4 . "</td>
  </tr>
   <tr style='color:#000; font-size:12px;'>
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
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $boostStudy . "</td>
  </tr>";
    } else {
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $renew_type . "</td>
  </tr>";
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Add Additional Text Blast ($50):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $text_blast_email . "</td>
  </tr>";
        $message .= "<tr style='color:#000; font-size:12px;'>
    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Condense to 2 Weeks (Free):</strong></td>
    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $condense_2_weeks1_email . "</td>
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

											th{padding:8px 0px;}
											td
											{
											padding:6px 0px;
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
				<col style='width: 57%'>
				<col style='width: 5%'>
				<col style='width: 20%'>

				      <tr>
					<th style='text-align:left; margin-left:20px;' colspan='2'><img style='width:295px; height:52px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/background_top.png'/><p style='font-size:14px; color:#959ca1;font-weight:normal; margin:2px 0px 0px 0px; line-height:18px;'><b>StudyKIK</b><br />1675 Scenic Ave #150<br />Costa Mesa, CA 92626</p></th>
					<th colspan='2' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px;'>
					<h1>INVOICE RECEIPT</h1>
					Invoice Number: ".$final_num."<br />
                    Invoice Date: ".$startdate."<br />
                    Term | Due on Receipt</th>
				    </tr>
				<tbody>
				<tr>
					<th style='text-align:left' colspan='4'><img style='width:100%;' src='".site_url()."/wp-content/themes/twentyfifteen/images/top_full.png'/></th></tr>
				    <tr style='text-align:center; font-size:18px;color:#000;'>
					<th align='left' style='border-bottom:1px solid #000;'>SERVICES:</th>
					<th align='left'style='border-bottom:1px solid #000;'>DESCRIPTION:</th>
					<th style='border-bottom:1px solid #000;'></th>
					<th  align='right' style='border-bottom:1px solid #000;'>AMOUNT:</th>
				    </tr>

				<tr align='center'>
				    <td align='left'>Listing</td>
				    <td align='left'><b>Site Name:</b> ".$sitename."</td>
				    <td align='center'> </td>
				    <td align='right'>".$price." </td>
				</tr>";

				$message_pdf .= "<tr align='center'>
				    <td align='left'></td>
				    <td align='left'><b>Study Type:</b> ".$studytype."</td>
                                    <td align='center'> </td>
				    <td align='center'></td>
				</tr>
				";
				if ($boostStudy) {
        $message_pdf .= "<tr align='left'>
        <td align='left'> </td>
        <td align='left'><b>Study Level:</b> " . $boostStudy . "</td>
	    <td align='center'> </td>
        <td align='center'> </td>
    </tr>";
    } else {
        $message_pdf .= "<tr align='left'>
        <td align='left'> </td>
        <td align='left'><b>Study Level:</b> " . $renew_type . "</td>
        <td align='center'> </td>
        <td align='center'> </td>
    </tr>";
    }

				if($protocolnumber){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Protocol Number:</b> ".$protocolnumber."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
				}
				if($contactphone){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Phone:</b> ".$contactphone."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
				}

				$message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Recruitment Email 1:</b> ".$contactname."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";

				if($contactemail){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email 2:</b> ".$contactemail."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
				}


				if($contactemail2){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email 3:</b> ".$contactemail2."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
				}

				if($contactemail3){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email 4:</b> ".$contactemail3."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
				}

				if($contactemail4){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email 5:</b> ".$contactemail4."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
				}
				$message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Study Address:</b> ".$studylocation."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>
				<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Start Date:</b> ".$startdate."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>
				<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>End Date:</b> ".$newDate."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";

				if($text_blast_email == "Yes"){
				    $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>Text Blast</td>
				    <td bordercolor='#000' align='left'> </td>
				    <td bordercolor='#000' align='center'> </td>
				    <td bordercolor='#000' align='right'>$".$text_blast2.".00</td>
				    </tr>";
				}else{

				 $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

				}
				if($contactemail == ""){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
				}
				if($contactemail2 == ""){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					";
				}
				if($contactemail3 == ""){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>

					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";

				}
				if($contactemail4 == ""){
				    $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";

				}

				$message_pdf .= "

				<tr class='sub_total' align='left'>
				<td align='center'  style='border-top:1px solid #000;'> </td>
				<td align='left'  style='border-top:1px solid #000;'> </td>
				<td align='right' colspan='2' style='border-top:1px solid #000;'>SUB TOTAL:&nbsp; ".$total_price."</td>
				</tr>
				<tr class='total' align='left'>
				<td align='center'> </td>
				<td align='left'> </td>
				<td align='right' colspan='2'><b>TOTAL:&nbsp; ".$total_price."</b></td>
				</tr>
				</tbody>
				<tr>";

				if($contactemail4 == ""){

				$message_pdf .= "<th colspan='4' style='font-size: 14px;'><img style='width:100%;height:470px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

				}else{

					$message_pdf .= "<th colspan='4' style='font-size: 14px;'><img style='width:100%;height:450px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

				}
				$message_pdf .= "</tr>
				</table></page>";



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
    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
    $headers_pdf[] = "MIME-Version: 1.0\r\n";
    $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
    require_once(dirname(__FILE__) . '/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P', 'A4','en', true, 'UTF-8', array(0, 0, 0, 0));
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
    } else {
        $html2pdf->Output(dirname(__FILE__) . "/pdf/" . $studytype . ' ' . $renew_type . ' Renew Invoice' . ".pdf", "f");
		$html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_'.$studytype.'_Renew_Invoice'.".pdf", "f");
        $pdf_attachment_path = dirname(__FILE__) . '/pdf/' . $studytype . ' ' . $renew_type . ' Renew Invoice.pdf';
		$pdf_attachment_path_db = '/pdf/'.$final_num.'_'.$studytype.'_Renew_Invoice.pdf';
        $attachments[] = dirname(__FILE__) . '/pdf/' . $studytype . ' ' . $renew_type . ' Renew Invoice.pdf';
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

    //wp_mail("sanjujagpal@gmail.com", $subject_pdf_email, $pdf_email_text, $headers_pdf, $pdf_attachment_path);
    $pdf_email_text = "";
    $message_pdf = "";
    //wp_mail('chandel.anku91@gmail.com', $subject, $message, $headers, $attachments);
    //wp_mail('keshvendersingh145@gmail.com', $subject, $message, $headers, $attachments);

      if($user_ID == 70 || $user_ID == 532 || $user_ID == 534 ){
        $SendEmail = wp_mail('mo.tan@studykik.com', $subject, $message, $headers, $attachments);

    }
    else
    {
         $SendEmail = wp_mail('info@studyKIK.com', $subject, $message, $headers, $attachments);
    }
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
<div id="banner_login">
<div class="container">
<div class="row">
  <div class="dashboard_banner">
    <header id="top">
    <h1><a href="/">Kitchy Food</a><img src="<?php bloginfo('template_url'); ?>/images-dashboard/logout_logo.png" alt=""></h1>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
 <ul class="nav navbar-nav">
            <li ><a style="margin-top: 12px;color:#00afef;" href="<?php echo site_url();?>/dashboard/">HOME</a></li>
            <li><a href="<?php echo site_url();?>/clinical-study-information-dashboard/">LIST A <br>
              NEW STUDY</a></li>
                 <li ><a   href="<?php echo site_url();?>/refer-listing/">REFER <br>
              A LISTING</a></li>
            <li style="border:none;"><a  class="midsection" href="<?php echo site_url();?>/rewards/">REWARDS</a></li>

            <li><a style="margin-top: 12px;" href="<?php echo site_url();?>/proposal/">PROPOSAL</a></li>
            <li><a href="/invoice-receipts/">INVOICE <br />
              RECEIPTS</a></li>
            <li><a href="<?php echo site_url();?>/your-profile/?idp=Profile">MY <br/>
              ACCOUNT</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    <div class="project_manager">
      <h5>Stud<small>y</small><cite>KIK</cite> Project Manager: <span><?php echo get_the_author_meta('project_manager', $user_ID); ?></span> - <span><?php echo get_the_author_meta('phone_number', $user_ID); ?></span></h5>
    </div>
  </div>
</div>
<div class="row">
<section class="container_current">
<div class="col-12 col-md-6 col-sm-6" style="padding-left:20px !important;padding-top:20px !important">
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
    <p style="width:100%;"><b style=" <?php if ($i == 1) { echo 'color:#00afef;'; } if ($i == 2) { echo 'color:#f78e1e;';
                            } if ($i == 3) {  echo 'color:#9fcf67;'; } ?>">Sponsor:</b> <?php echo get_field('sponsor_name', $post->ID);?></p>
  </dt>
  <dd>
    <?php the_excerpt(); ?>
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
                                    document.getElementById('fade').style.display = 'block'" href="javascript:void(0);" >Renew Study ></a>
  <?php } else { ?>
  <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                     echo 'background:#00afef;';
                                      } if ($i == 2) {
                                      echo 'background:#f78e1e;';
                                       } if ($i == 3) {
                                       echo 'background:#9fcf67;';
                                      } ?>" class="patient" onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'block';
                                     document.getElementById('fade').style.display = 'block'" href="javascript:void(0);">Renew Study ></a>
  <a  style="float: right; margin-right: 10px; text-align: center; <?php if ($i == 1) {
                                           echo 'background:#00afef;';
                                            } if ($i == 2) {
                                            echo 'background:#f78e1e;';
                                            } if ($i == 3) {
                                            echo 'background:#9fcf67;';
                                           } ?>" class="patient" onclick="document.getElementById('embed2<?php echo $post->ID; ?>').style.display = 'block';
                                     document.getElementById('fade').style.display = 'block'" href="javascript:void(0);">Upgrade Study ></a>
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
<div class="col-12 col-md-6 col-sm-6" style="padding-top:20px !important"> <a href="<?php echo site_url();?>/clinical-study-information-dashboard/"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/new_study.png" alt="" class="img-responsive"></a> <a href="<?php echo site_url();?>/rewards/"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/rewards.png" alt="" class="img-responsive"></a> <a href="<?php echo site_url();?>/refer-listing/ "><img src="<?php bloginfo('template_url'); ?>/images-dashboard/refer_listin.png" alt="" class="img-responsive"></a> </div>
</section>
</div>
</div>
</div>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<?php
if($user_roles=='editor'){
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
  <form action="" method="post" style="text-align: center;" onsubmit="return validate_renew_type('<?php echo $post->ID; ?>');">
    <select name="renew_type" class="renew_type" style="padding: 6px; margin-bottom:5px;">
      <option value="">Select Level</option>
      <option value="Diamond $3059">Diamond $3059</option>
      <option value="Platinum $1559">Platinum $1559</option>
      <option value="Gold $559">Gold $559</option>
      <option value="Silver $209">Silver $209</option>
      <option value="Bronze $59">Bronze $59</option>
    </select>
    <input type="text" value="<?php echo date('m/d/Y');?>" placeholder="Select Start Date" id="datepicker<?php echo $post->ID; ?>" name="select_date" style="height: 32px;" />
    <p style="margin: 0px;">
      <label>Add Additional Text Blast ($50): </label>
      <input type="checkbox" name="blast_501">
      <span style="color: #00afef;margin-left: 10px;font-weight: bold;">Yes</span></p>
    <p style="margin: 0px;">
      <label>Condense to 2 Weeks (Free): </label>
      <input type="checkbox" name="condense_2_weeks1">
      <span style="color: #00afef;margin-left: 10px;font-weight: bold;">Yes</span></p>
    <?php //echo $day_left;?>
    <input type="hidden" name="postID" value="<?php echo $post->ID; ?>" />
    <input class="done_button" type="submit"   value="Renew My Study" />
  </form>
  <a onclick="document.getElementById('embed<?php echo $post->ID; ?>').style.display = 'none';
                       document.getElementById('fade').style.display = 'none';
                       " href="javascript:void(0);" class="closepop">Close</a> </div>
<div id="embed2<?php echo $post->ID; ?>" class="white_content" style="display: none;">
  <h2 class="heading">Upgrade Study Confirmation</h2>
  <form action="" method="post" style="text-align: center;" onsubmit="return validate_upgrade_type('<?php echo $post->ID; ?>');" >
    <p style="color: #000; padding: 15px; font-size: 16px; text-align: center;font-weight: bold;">Upgrade this study to:</p>
    <select name="upgrade_type" class="upgrade_type" style="padding: 6px; margin-bottom:20px;">
      <option value="">Select</option>
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
    <br />
    <input type="hidden" name="postID" value="<?php echo $post->ID; ?>" />
    <input  class="done_button" type="submit" value="Upgrade My Study" />
  </form>
  <a onclick="document.getElementById('embed2<?php echo $post->ID; ?>').style.display = 'none';document.getElementById('fade').style.display = 'none';" href="javascript:void(0);" class="closepop">Close</a> </div>
<?php endwhile;
    wp_reset_query();
} ?>
<div id="fade" class="black_overlay"></div>
<?php get_footer('dashboard'); ?>


<?php } }?>
