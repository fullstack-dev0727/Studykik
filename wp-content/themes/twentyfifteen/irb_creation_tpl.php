<?php
$ecommerce_enabled = get_option('ecommerce_enabled');
//$ecommerce_enabled = true;
$is_check_allowed = get_user_meta($user_ID, 'allow_check', true);
$card_html = "";
global $authors_ids;
global $user_roles;
?>
<style>

    .warning {
        border: 1px solid red !important;
    }
    .irb_creation_container{
    }

    .outer_p, .irb_creation_radio_container{
        padding-left:15px;
    }

    .irb_creation_container p, .irb_creation_radio_container{
        width: 100%;
        font: 18px Arial, Helvetica, sans-serif;
        font-weight: bold;
    }

    .irb_creation_container label{
        width: 100%;
        float: left;
        font: 18px Arial, Helvetica, sans-serif;
        font-weight: bold;
    }

    .irb_creation_container p select{
        float: left;
        font: 18px Arial, Helvetica, sans-serif;
        height: 46px;
        margin: 0 0 13px;
        padding-left: 10px;
        font-weight: bold;
        width: 100%;
        background-color: #fff;
        color: #88DD25;
        border: 0 none;
        -moz-box-shadow: inset 3px 2px 5px #c5c5c5;
        -webkit-box-shadow: inset 3px 2px 5px #c5c5c5;
        box-shadow: inset 3px 2px 5px #c5c5c5;
    }

    .irb_creation_container p input
    {
        float: left;
        font: 18px Arial, Helvetica, sans-serif;
        height: 46px;
        margin: 0 0 13px;
        padding: 0 2%;
        width: 100%;
        background-color: #fff;
        border: 0 none;
        -moz-box-shadow: inset 3px 2px 5px #c5c5c5;
        -webkit-box-shadow: inset 3px 2px 5px #c5c5c5;
        box-shadow: inset 3px 2px 5px #c5c5c5;
        color: #F78F1E;
        font-weight: bold !important;
    }

    .option_irb{
        display:none;
    }

    .irb_creation_controls_container{
        width:100%;
    }

    .irb_creation_purchase_bttn{
        background: none repeat scroll 0 0 orange;
        color: #fff;
        font-size: 15px;
        font-weight: bold;
        line-height: 30px;
        padding: 0 11px;
        margin-top:10px;
        margin-bottom:15px;
    }

    .irb_creation_error_text{
        display:none;
        font: 18px Arial, Helvetica, sans-serif;
        margin-top:15px;
        text-align:center;
    }

    .irb_creation_price_table{
        width:100%;
        font-size: 15px;
        font-weight: bold;
    }
    .irb_creation_price_table td{
        text-align: left;
        vertical-align: baseline;
    }

    .irb_creation_price_table input,
    .irb_creation_price_table textarea,
    .irb_creation_price_table select{
        font: 18px Arial, Helvetica, sans-serif;
        height: 46px;
        margin: 0 0 13px;
        padding: 0 2%;
        background-color: #fff;
        border: 0 none;
        -moz-box-shadow: inset 3px 2px 5px #c5c5c5;
        -webkit-box-shadow: inset 3px 2px 5px #c5c5c5;
        box-shadow: inset 3px 2px 5px #c5c5c5;
        color: #F78F1E;
        font-weight: bold !important;
        width:100%;
    }

    .irb_creation_price_table select
    .irb_creation_price_table textarea{
        width:400px;
    }
    .irb_creation_price_table textarea {
        padding: 5px 2%;
        height: auto;
    }

    .add_payment_popup_irb {
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
    #loop_irb .warning {
        border: 1px solid red;
    }
    #loop_irb .Add_cart {
        padding-bottom: 20px;
    }
    #loop_irb .add_new_cart {
        padding: 0;
    }
    #loop_irb .add_new_cart h2 {
        background: #f78e1e none repeat scroll 0 0;
        border-radius: 4px 4px 0 0;
        color: #fff;
        margin: 0;
        text-decoration: underline;
        padding: 10px 0;
        text-align: center;
    }
    .white_content {
        background-color: white;
        border-radius: 10px;
        cursor: auto;
        display: none;
        left: 30% !important;
        overflow: auto;
        position: fixed !important;
        top: 26.2% !important;
        width: 40% !important;
        z-index: 99999 !important;
        border: 1px solid #f78e1e;
    }
    #loop_irb .card_text p {
        border-bottom: 1px solid #e7e7e7;
        color: #959ca1;
        font: 14px/40px "helveticaregular";
        margin: 0;
        text-align: center;
    }
</style>
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }

        return true;
    }

    function changeIRBPriceValue(){
        var total_price = 177 * $("#irb_quantity").val();
        $("#irb_price").val("$" + total_price);
        jQuery(".irb_creation_error_text").html("You have successfully purchased " + $("#irb_quantity").val() + " IRB Ad Creation.");
    }

    $(document).ready(function () {

        $('.go-add-card-irb').click(function(){

            var ajaxurl     = '/wp-admin/admin-ajax.php';
            var datastring  = jQuery(".add-card-form-irb").serialize();
            var errors = 0;
            var data_form = $(this).closest('form');
            jQuery('.add-card-status-irb').html("");
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
                    data_form.find('.add-card-status-irb').html("Company field can't contain symbols.");
                    data_form.find('.add-card-status-irb').css('color','#ff0000');
                    errors ++;
                } else {
                    data_form.find("input[name=company]").removeClass("warning");
                    data_form.find('.add-card-status-irb').html("");
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
                data_form.find('.add-card-status-irb').html("The expiration date is invalid.");
                data_form.find('.add-card-status-irb').css('color','#ff0000');
                return false;
            }

            if (errors == 0) {
                $('.add-card-status-irb').html('Processing...');
                $.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: datastring,
                    success: function(data) {
                        var json = $.parseJSON(data);

                        //if(json[0] != 'Error adding card, please verify all information is correct.'){
                        if (!json.error){
                            $('.select-card-irb').append('<option value="'+json[0].card_id+'" data-shipping-id="'+json[0].shipping_id+'" data-credit-card-id="'+json[0].card_id+'" data-profile-id="'+json[0].profile_id+'" data-cvv="'+json[0].cvv+'" data-payment-id="'+json[0].payment_id+'">xxxx xxxx xxxx '+json[0].last_4+'</option>');
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
                            jQuery("#loop_irb").hide();
                        }else{
                            jQuery('.add-card-status-irb').html(json.messages[0]);
                            jQuery('.add-card-status-irb').css('color','#ff0000');
                            jQuery('input[name=cc_number]').addClass("warning");
                            jQuery('select[name=cc_exp_month]').addClass("warning");
                            jQuery('select[name=cc_exp_year]').addClass("warning");
//                        jQuery('input[name=cc_cvv2]').addClass("warning");
                            jQuery('input[name=zip]').addClass("warning");
                        }


                    },
                    error: function(data){
                        console.log(data);
                        jQuery('.add-card-status-irb').html(data);
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
        jQuery("#card_cancel_irb").on('click',function(){
            jQuery("#loop_irb").hide();
            var data_form = $('.add-card-form-irb');
            data_form.find("input").map(function () {
                $(this).val("");
                $(this).removeClass('warning');
            });
            data_form.find("select").map(function () {
                $(this).val("");
                $(this).removeClass('warning');
            });
        });
        jQuery(".select-card-irb").on('change',function(){

            var sel_val=jQuery(this).val();
            if(sel_val=='Add a Card'){
                jQuery("#loop_irb").show();
                $("#loop_irb input[type=text]").map(function(){
                    $(this).val("");
                });
                $("#loop_irb select").map(function(){
                    $(this).val("");
                });
            }
            else{

                jQuery("#loop_irb").hide();
                console.log(jQuery(this).find(':selected').attr('data-credit-card-id'));
                jQuery(this).closest('form').find('#payment_credit_card_id_credit').val(jQuery(this).find(':selected').attr('data-credit-card-id'));
                jQuery(this).closest('form').find('#payment_profile_id_credit').val(jQuery(this).find(':selected').attr('data-profile-id'));
                jQuery(this).closest('form').find('#payment_payment_id_credit').val(jQuery(this).find(':selected').attr('data-payment-id'));
                jQuery(this).closest('form').find('#payment_shipping_id_credit').val(jQuery(this).find(':selected').attr('data-shipping-id'));
                jQuery(this).closest('form').find('#payment_card_code_credit').val(jQuery(this).find(':selected').attr('data-cvv'));
            }
        });

        $("#irb_creation_purchase_bttn").on('click', function(){
            var errors = 0;
            $("#irb_creation_form .required").map(function(){
                if(!$(this).val() || $(this).val() == "0" || $(this).val() == "Add a Card") {
                    $(this).addClass('warning');
//                    $("#fullname").focus();
                    errors++;
                }
                else if ($(this).val()) {
                    $(this).removeClass('warning');
                }
            });
            console.log(errors);
            if(errors > 0){ //alert()
                //$('#errorwarn').text("All fields are required");
                return false;
            }
            $("#irb_creation_purchase_bttn").prop('disabled', true);
//            console.log("fff");
            jQuery.ajax({
                async: true,
                url: "<?=get_bloginfo('wpurl')?>/wp-admin/admin-ajax.php",
                type:'POST',
                data: "action=buy_irb_creation"+"&"+$( "#irb_creation_form" ).serialize(),
                success: function(data){
                    data = data.substr(0, (data.length-1));
                    data = JSON.parse(data);
                    if (data.success){
                        jQuery(".irb_creation_form_area").css("height","80px");
                        jQuery("#irb_creation_title").html("Thank you");
                        jQuery("#irb_creation_title").css("text-decoration", "none");
                        jQuery("#irb_creation_close_top_bar").css("display", "none");
                        jQuery("#irb_creation_close_bttn").show();
                        jQuery("#irb_creation_purchase_bttn").hide();
                        jQuery(".irb_creation_error_text").show();
                        jQuery(".irb_creation_main_content").hide();

                    }else{
                        alert("Error. Please try again later.");
                    }
                    $("#irb_creation_purchase_bttn").prop('disabled', false);
                }
            });
        });

        $("#irb_creation_close_bttn").on('click', function(){
            $(".irb_creation_wrapper_container a").click();
        });

        $("#irb_quantity").on( "change",function(){
            changeIRBPriceValue();
//            var total_price = 177 * $("#irb_quantity").val()
//            $("#irb_price").val("$" + total_price);
//            jQuery(".irb_creation_error_text").html("You have successfully purchased "+(100 * $("#irb_quantity").val())+" credits.");
        });
    });
</script>
<div id="irbCreation" class="white_content" style="width:cursor: auto; display: none;">
    <input type="hidden" id="irb_creation_post_id" />
    <div class="col-xs-12 col-md-12 notes_left irb_creation_wrapper_container">
        <div class="row">
            <h2 id="irb_creation_title">'.$post_id.'</h2>
        </div>
        <div data-offset="0" data-target="#myNavbar" data-spy="scroll" class="scroll-area_connect irb_creation_form_area irb_creation_container" id="nts_diva" style="height:320px;">
            <form id="irb_creation_form">
                <div class="irb_creation_error_text" >You have successfully purchased 1 IRB Ad Creation.</div>
                <div class="irb_creation_main_content">
                    <p class="outer_p" style="margin-top:10px;">
                            <span class="wpcf7-form-control-wrap">
                                <div class="irb_creation_price_container">
                                    <table class="irb_creation_price_table">
                                        <tr><td width="150">Quantity</td><td><input id="irb_quantity" type="number" min="1" value="1" name="quantity" onkeypress="return isNumber(event)" onkeyup="changeIRBPriceValue()" class="required"></td></tr>
                                        <tr><td>Price</td><td><input id="irb_price" type="text" value="$177" name="price" readonly="true" class="required"></td></tr>
                                        <?php
                                        if ($ecommerce_enabled) {
                                        ?>
                                        <tr>
                                            <td>Payment Method</td>
                                            <td>
                                                <select name='select_card' class='select-card-irb required'>
                                                    <option value=''>Select Card *</option>
                                                    <?php
                                                    $user_ID = get_current_user_id();

                                                    $searchARR_1  = array('key'=>'payment_user_id','value'=>$user_ID,'compare'=>'=');

                                                    $searchARR    = array(
                                                        $searchARR_1
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
                                                        'meta_key'	   => 'payment_user_id',
                                                        'orderby'	     => '',
                                                        'order'	     => 'ASC'
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
                                                    echo '<option value="Add a Card">Add Credit Card</option>';
                                                    if((bool) $is_check_allowed){
                                                        echo '<option value="Check">Pay by Check</option>';
                                                    }

                                                    echo '</select></td></tr>';
                                                    }

                                                    ?>
                                                    <!--                                        <tr>-->
                                                    <!--                                            <td colspan='3'>-->
                                                    <!--                                                <textarea value="" placeholder="Notes" id="select-card-irb" name="notes" class="select-card-irb" rows="3"/></textarea>-->
                                                    <!--                                            </td>-->
                                                    <!--                                        </tr>-->
                                        <?php
                                        if ($user_roles == "manager_username") {
                                        ?>
                                        <tr>
                                            <td>
                                                Select User
                                            </td>
                                            <td>
                                                <select name='select_user' class='select-user-irb required'>
                                                    <option value=''>Select User *</option>
                                                    <?php
                                                    foreach($authors_ids as $key => $val) {
                                                        echo "<option value='{$key}'>{$val}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </span>
                    </p>
                </div>
                <input  name="payment_credit_card_id" id="payment_credit_card_id_credit" type="hidden" value="" />
                <input  name="payment_profile_id" id="payment_profile_id_credit" type="hidden" value="" />
                <input  name="payment_payment_id" id="payment_payment_id_credit" type="hidden" value="" />
                <input  name="payment_shipping_id" id="payment_shipping_id_credit" type="hidden" value="" />
                <input  name="payment_card_code" id="payment_card_code_credit" type="hidden" value="" />
            </form>
        </div>
        <div class="irb_creation_controls_container">

            <input type="button" class="center-block irb_creation_purchase_bttn" value="Purchase" id="irb_creation_purchase_bttn">
            <input type="button" class="center-block close_button" value="Close" id="irb_creation_close_bttn" style="display:none; margin-bottom:15px;">
        </div>
    </div>

</div>

<div id="loop_irb" class="add_payment_popup_irb add_payment_popup">
    <form method="post" action="#" class="add-card-form-irb">
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
                        echo  '<option value="'.$year.'">'.$year.'</option>';
                        $year ++;
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 col-xs-12">
                <input type = "text" class = "form-control required" name="zip" id = "phone_number" placeholder = "Billing Zip *">
            </div>
            <!--                <div class="col-md-12 col-xs-12 horizontal_line">-->
            <!--                </div>-->
            <!--                <div class="col-md-12 col-xs-12">-->
            <!--                    <input type = "email" class = "form-control required" name="email" id = "email" placeholder = "Email *">-->
            <!--                </div>-->
            <!--                <div class="col-md-6 col-xs-12">-->
            <!--                    <input type = "text" class = "form-control required" name="address" id = "phone_number" placeholder = "Address *">-->
            <!--                </div>-->
            <!--                <div class="col-md-6 col-xs-12">-->
            <!--                    <input type = "text" class = "form-control" name="address2" id = "phone_number" placeholder = "Address 2">-->
            <!--                </div>-->
            <!--                <div class="col-md-3 col-xs-12">-->
            <!--                    <input type = "text" class = "form-control required" name="city" id = "phone_number" placeholder = "City *">-->
            <!--                </div>-->
            <!--                -->
            <!--                <div class="col-md-3 col-xs-12">-->
            <!--                    <input type = "text" class = "form-control required" name="state" id = "phone_number" placeholder = "State *">-->
            <!--                </div>-->
            <!--                <div class="col-md-3 col-xs-12">-->
            <!--                    <input type = "text" class = "form-control required" name="country" id = "phone_number" placeholder = "Country *">-->
            <!--                </div>-->
            <div class="col-sm-6 col-xs-12 add_cancel_btn">
                <a href="#"><img id="card_cancel_irb" src="<?= get_bloginfo('template_url')?>/images/cancel.png" alt="" class="img-responsivem pull-right"></a>
            </div>
            <div class="col-sm-6 col-xs-12 add_save_btn">
                <a href="#" class="go-add-card-irb"><img src="<?= get_bloginfo('template_url')?>/images/save.png" alt="" class="img-responsive pull-left"></a>
                <input type="hidden" name="action" value="addcard" />
                <input type="hidden" name="post_id" class="post_id" value="" />
                <input type="hidden" name="user_id" value="<?php echo get_current_user_id();?>" />
            </div>
            <div style="clear:both; font-weight: bold; padding: 20px 0; text-align: center;" class="add-card-status-irb"></div>
        </div>
    </form>
</div>