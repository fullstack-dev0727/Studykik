<?php
/*
 * Template Name: Order Page
 */
get_header();
?>
<style>
  .summary-coupon {

  }
  .warning {
      border: 1px solid red !important;
  }
</style>
<form id="order-form" method="post" action="/clinical-study-information-auth-net/">
<link href="<?php bloginfo('template_url'); ?>/css/shopping.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/checkout.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/fonts/font.css" rel="stylesheet" type="text/css">
<div class="container">
  <div class="row">

  </div>
</div>
<section class="full_background"> </section>
<div class="container">
  <div class="left_section">
    <div class="col-md-12 col-xs-12 heading_clinical">
      <h3>CLINICAL STUDY INFORMATION</h3>
      <p><span>You are almost finished!</span> To complete the study listing process:</p>
    </div>
      <div class="col-md-2 col-sm-2 col-xs-12 purchased"></div>
    <div class="col-md-4 col-sm-4 col-xs-12 purchased"> <img src="<?php bloginfo('template_url'); ?>/images/one.png" alt="" class="img-responsive center-block">
        <h4>Enter all<br>
            study<br>
            information.</h4>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 purchased_two"> <img src="<?php bloginfo('template_url'); ?>/images/two.png" alt="" class="img-responsive center-block">
        <h4>Click<br>
            "List My<br>
            Studies"</h4>
    </div>
      <div class="col-md-2 col-sm-2 col-xs-12 purchased"></div>
    <div class="col-md-12 col-xs-12 completed_text">
      <p>Once completed, your studies will be live in 24 hours. We look forward to helping you<br>
        enroll your clinical trials!</p>
    </div>
  </div>
  <div class="right_section">
    <div class="side-bar" style="min-width: 300px;">
      <div class="order-summary">
        <table class="order-summary-table">
          <caption>
            Order Summary:
          </caption>
          <!--
          <tr>
            <td><span class="diamond_listing">1</span> Diamond Listing</td>
            <td> $3,059.00</td>
          </tr>
          <tr>
            <td><span class="diamond_listing">3</span> Gold Listings</td>
            <td>$1,677.00</td>
          </tr>
          <tr>
            <td><span class="diamond_listing">4</span> IRB Ad Creations</td>
            <td>$600.00</td>
          </tr>
          -->

          <tr class="summary-coupon">
            <td><span class="coupon_discount discount-label">Coupon Discount <br/>
                <a href="javascript:void(0)" class="remove_coupon" style="display: none;">Remove Coupon</a></span></td>
            <td><span class="coupon_discount discount-amount"></span></td>
          </tr>
          

          <tr>
            <td><b class="total_bold">Total</b></td>
            <td><b class="total_bold total-value"></b></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<section id="shoping_section" class=" step-one"> </section>
<article class="shoping_background step-one">
  <div class="container">
    <div class="left_section">
      <div class="col-md-6 col-sm-6 col-xs-6 shoping_text">
        <h4>Shopping Cart</h4>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-6 billing_text">
        <h4>Billing & Payment</h4>
      </div>
      <div class="table-responsive" class="shopping-cart-wrapper">
        <table id="table_background" class="table">
          <thead>
          <tr class="table_top">
            <th>Quantity</th>
            <th style="min-width: 200px;">Product</th>
            <th>Price</th>
            <th>Total</th>
            <!-- <th>Remove</th> -->
          </tr>
          </thead>

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
  				//print_r($products);
  				foreach($products AS $product){
    				$product_price    = get_field('product_price', $product->ID);
    				$product_image    = get_field('product_icon', $product->ID);
    				$product_position = get_field('product_position', $product->ID);
    				setlocale(LC_MONETARY, 'en_US');
          ?>
         <tbody>
          <tr>
            <td>
              <span class="quantity">
                <input type="text" placeholder="0" name="qty-<?php echo $product->ID; ?>" data-title="<?php echo $product->post_title; ?>" data-price="<?php echo $product_price; ?>" data-id="<?php echo $product->ID; ?>" class="product-qty" style="border: 0px; width: 25px; background: none; color: #959ca1;" onkeydown="return isNumber(event)"/>
              </span>
            </td>
            <td><span class="diamond"><img src="<?php echo $product_image; ?>" alt="" class="img-responsive"></span><?php echo $product->post_title; ?></td>
            <td>$<?php echo str_replace('USD ','',money_format('%i', $product_price)); ?></td>
            <td class="item-price-<?php echo $product->ID;?>">$0.00</td>
            <!-- <td><span class="delete_btn">Delete</span></td> -->
          </tr>
          </tbody>
  				<?php  } // end products ?>


          <tbody>
          <tr  class="table_bottum">
            <td colspan="3" class="total_left_border ">
                <div class="col-md-12 col-xs-12">
                    <span class="code_search">Coupon Code (Optional):</span>
                </div>
                <div class="col-md-9 col-xs-12">
                    <input type="text" class="coupon-code-input" name="coupon-1" placeholder="" value="">
                    <input type="hidden" class="coupon-code-value" name="coupon" placeholder="" value="">
                </div>
                <div class="col-md-3 col-xs-12">
                    <button id="go-coupon" style="margin-top: 5px;">Apply</button>
                </div>
              </td>
            <td><span class="total">Total:  <span class="total-value"></span></span></td>
          </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-12 col-xs-12" class="shopping-cart-button">
        <a href="/checkout" class="go_check_btn"><button class="check_btn"><img src="<?php bloginfo('template_url'); ?>/images/check_btn.png" alt="" class="img-responsive center-block"></button></a>
      </div>
      <!-- end shopping cart -->
      <!-- start checkout -->

      <!-- end checkout -->
    </div>
  </div>
</article>
<section id="post_background" class=" step-one"> </section>
<aside class="choose_number step-one">
  <div class="container">
    <div class="left_section">
      <div class="col-md-12 col-xs-12 choose_heading">
        <h2>CHOOSE THE NUMBER OF POSTS ON STUDYKIK'S SOCIAL
          COMMUNITIES YOU WOULD LIKE YOUR STUDY TO RECEIVE,
          EACH POST RECEIVES 1 TO 2 PATIENT REFERRALS on average*.</h2>
      </div>
    </div>
  </div>
</aside>
<div class="background_color step-one">
  <section id="diamond_post"> <img src="<?php bloginfo('template_url'); ?>/images/posts_background.png" alt="" class="img-responsive center-block"> </section>
</div>
<!--post_background html end -->
<div class="container step-one">
  <div class="left_section">
    <div class="trial_text">
      <h1>Each Study Listing Includes:</h1>
      <div class="listing_bottum"> </div>
    </div>
    <div class="block_1">
      <div class="search_left"> <img src="<?php bloginfo('template_url'); ?>/images/search.png" alt=""> </div>
      <div class="right_text">
        <h3>Exposure to STUDYKIK Patient Enrollment
          Search</h3>
        <div class="search_line"> <img src="<?php bloginfo('template_url'); ?>/images/search_line.png" alt=""> </div>
      </div>
    </div>
    <div class="block_1">
      <div class="search_left"> <img src="<?php bloginfo('template_url'); ?>/images/text_message.png" alt=""> </div>
      <div class="right_text">
        <h3>Instant Patient Text Message w/ Site Phone</h3>
        <div class="search_line_2"> <img src="<?php bloginfo('template_url'); ?>/images/text_message_line.png" alt=""> </div>
      </div>
    </div>
    <div class="block_1">
      <div class="search_left"> <img src="<?php bloginfo('template_url'); ?>/images/message.png" alt=""> </div>
      <div class="right_text">
        <h3>Instant Patient Email w/ Site Phone</h3>
        <div class="search_line_3"> <img src="<?php bloginfo('template_url'); ?>/images/email_line.png" alt=""> </div>
      </div>
    </div>
    <div class="block_1">
      <div class="search_left"> <img src="<?php bloginfo('template_url'); ?>/images/filtering.png" alt=""> </div>
      <div class="right_text">
        <h3>Proprietary Filtering System for Quality Patient
          Reach</h3>
        <div class="search_line_4"> <img src="<?php bloginfo('template_url'); ?>/images/filtering_line.png" alt=""> </div>
      </div>
    </div>
    <div class="block_1">
      <div class="search_left"> <img src="<?php bloginfo('template_url'); ?>/images/notification.png" alt=""> </div>
      <div class="right_text">
        <h3>Instant SIGN-UP Notifications to Your Site</h3>
        <div class="search_line_5"> <img src="<?php bloginfo('template_url'); ?>/images/notification_line.png" alt=""> </div>
      </div>
    </div>
    <div class="block_1">
      <div class="search_left"> <img src="<?php bloginfo('template_url'); ?>/images/study.png" alt=""> </div>
      <div class="right_text">
        <h3>Mobile Friendly Study Page</h3>
        <div class="search_line_6"> <img src="<?php bloginfo('template_url'); ?>/images/study_line.png" alt=""> </div>
      </div>
    </div>
    <div class="block_1">
      <div class="search_left"> <img src="<?php bloginfo('template_url'); ?>/images/listing.png" alt=""> </div>
      <div class="right_text">
        <h3>LIVE Listing within 24 hours</h3>
        <div class="search_line_7"> <img src="<?php bloginfo('template_url'); ?>/images/listing_line.png" alt=""> </div>
      </div>
    </div>
  </div>
</div>
<!--shopping cart html end -->
<article class="billing_payment" style="display: none;">
<section id="shoping_section"> </section>
<article class="shoping_background">
  <div class="container">
    <div class="left_section">
      <div class="col-md-6 col-sm-6 col-xs-6 shoping_text">
        <h4 style="color:#959ca1; border-bottom:2px solid #d1d1d1;">Shopping Cart</h4>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-6 billing_text">
        <h4 style="color:#a0cf68; border-bottom:2px solid #a0cf68;">Billing & Payment</h4>
      </div>
    </div>
  </div>
</article>
  <div class="container">
    <div class="left_section">

        <aside id="name_section">
          <div class="col-md-4 col-sm-4 col-xs-12 name_first">
              <input type = "text" class = "form-control required" name="firstname" id="firstname" placeholder="First Name *">
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12 name_first">

              <input type = "text" class = "form-control required" name="lastname" id="" placeholder="Last Name *">

          </div>
            <div class="col-md-4 col-sm-4 col-xs-12 name_first">

                <input type = "text" class="form-control required" id="" name="company" placeholder="Company *">

            </div>
            <div class="col-md-8 col-xs-12 name_first">

                <input type = "text" class = "form-control required" name="cc_number" autocomplete="false" placeholder = "Card Number *">

            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 name_first">

                <input type = "text" class = "form-control" name="cc_cvv2" autocomplete="false" placeholder = "CVC">

            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 name_first">
                <select class="drop_btn required" name="cc_exp_month">
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
            <div class="col-md-4 col-sm-4 col-xs-12 name_first">
                <select class="drop_btn required" name="cc_exp_year">
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

            <div class="col-md-4 col-sm-4 col-xs-12 name_first">

                <input type = "text" class = "form-control required" name="zip" id = "phone_number" placeholder = "Billing Zip *">

            </div>

        </aside>
<!--        <div class="col-md-12 col-xs-12 horizontal_line">-->
<!--        </div>-->
<!--        <div class="col-md-4 col-xs-12 name_first">-->
<!---->
<!--            <input type = "text" class = "form-control required" name="phonenumber" id="phone_number" placeholder="Phone Number *">-->
<!---->
<!--        </div>-->
<!--        <div class="col-md-4 col-xs-12 name_first">-->
<!---->
<!--            <input type = "text" class = "form-control" name="phonenumber2" id = "phone_number" placeholder = "Secondary Phone Number">-->
<!---->
<!--        </div>-->
<!--        <div class="col-md-4 col-xs-12 name_first">-->
<!---->
<!--            <input type = "text" class = "form-control" name="faxnumber" id = "firstname" placeholder = "Fax Number">-->
<!---->
<!--        </div>-->
<!--        <div class="col-md-12 col-xs-12 horizontal_line">-->
<!--        </div>-->
<!--        -->
<!---->
<!--        <div class="col-md-12 col-xs-12 horizontal_line">-->
<!--        </div>-->
<!--        <div class="col-md-12 col-xs-12 name_first">-->
<!---->
<!--            <input type = "text" class = "form-control required" name="address" id = "phone_number" placeholder = "Address *">-->
<!---->
<!--        </div>-->
<!--        <div class="col-md-12 col-xs-12 name_first">-->
<!---->
<!--            <input type = "text" class = "form-control" name="address2" id = "phone_number" placeholder = "Address 2">-->
<!---->
<!--        </div>-->
<!--        <div class="col-md-6 col-sm-4 col-xs-12 name_first">-->
<!---->
<!--            <input type = "text" class = "form-control required" name="city" id = "phone_number" placeholder = "City *">-->
<!---->
<!--        </div>-->
<!---->
<!--        <div class="col-md-6 col-sm-4 col-xs-12 name_first">-->
<!---->
<!--            <input type = "text" class = "form-control required" name="state" id = "phone_number" placeholder = "State *">-->
<!---->
<!--        </div>-->
<!--        <div class="col-md-6 col-sm-4 col-xs-12 name_first">-->
<!---->
<!--            <input type = "text" class = "form-control required" name="country" id = "phone_number" placeholder = "Country *">-->
<!---->
<!--        </div>-->
<!--        <div class="col-md-4 col-sm-6 col-xs-12 name_first">-->
<!--          <div class ="checkbox" id="check_information">-->
<!--            <label><input name="save" value="1" type = "checkbox">Remember My Information</label>-->
<!--          </div>-->
<!--        </div>-->
        <div class="email-section">
            <div class="col-md-12 col-xs-12 name_first">
                <input type = "text" class = "form-control required" name="email" id = "notif_email" placeholder = "Email *">
            </div>
        </div>
        <div class="user-section">

            <div class="col-md-12 col-xs-12 horizontal_line">
            </div>

            <div class="col-md-12 col-xs-12 name_first">
                <input type = "text" class = "form-control required" name="username" id = "username" placeholder = "Username *">
            </div>

            <div class="col-md-12 col-xs-12 name_first" id="userinfo" style="text-align: right;">
                <span style="display:none;"></span>
                </div>

            <div class="col-md-6 col-sm-6 col-xs-12 name_first">

                <input type = "text" class = "form-control required" name="email" id = "email" placeholder = "Email *"  onchange="keyupcheckEmailMatch();" onkeyup="keyupcheckEmailMatch();">

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 name_first">

                <input type = "text" class = "form-control required" name="email2" id = "email2" placeholder = "Confirm Email *"  onchange="keyupcheckEmailMatch();" onkeyup="keyupcheckEmailMatch();">

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 name_first" id="divCheckEmailExist" style="text-align: right;">
                <span style="display:none;"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 name_first" id="divCheckEmailMatch" style="text-align: right;">
                <span style="display:none;"></span>
            </div>

            <div class="clear"></div>

            <div class="col-md-6 col-sm-6 col-+0xs-12 name_first">

                <input type = "password" class = "form-control required" name="password" id = "password" placeholder = "Password *"  onchange="keyupcheckPasswordMatch();"  onkeyup="keyupcheckPasswordMatch();">

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 name_first">

                <input type = "password" class = "form-control required" name="confirm_password" id = "confirm_password" placeholder = "Confirm Password *"   onchange="keyupcheckPasswordMatch();"  onkeyup="keyupcheckPasswordMatch();">

            </div>

            <div class="col-md-12 col-xs-12 name_first" id="passwordInfo" style="text-align: right;">
            </div>

        </div>

        <div class="col-md-12 col-xs-12 center_number">
          <h4>Total:  <span class="total-value">$5,236.00</span></h4>
        </div>

        <div class="col-md-12 col-xs-12 payment-button">
          <button class="submit_btn go_payment"><img src="<?php bloginfo('template_url'); ?>/images/submit_order.png" alt="" class="img-responsive center-block"></button>
        </div>

        <div class="col-md-12 col-xs-12 payment-processing" style="display:none; text-align: center;">
            <img src="/wp-content/themes/twentyfifteen/images/loading.gif" />
            Processing Payment...
        </div>

        <input type="hidden" name="amount" id="amount" />
				<input type="hidden" name="action" value="go_order" />
				<input type="hidden" name="transaction_id" id="transaction_id" />
				<input type="hidden" name="invoice_number" id="invoice_number" />
				<input type="hidden" name="card_id" id="card_id" />
				<input type="hidden" name="order_id" id="order_id" />
				<input type="hidden" name="user_id" id="user_id" />

    </div>
  </div>
</article>
<!-- end billing page -->
</form>
<?php get_footer(); ?>


<script src="https://code.jquery.com/jquery.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.js"></script>

<script>
  var coupon_discount = '';
  var coupon_obj = {};
  var email_validate = false;
  var username_validate = false;
  var is_study_order = false;

  function updateTotal(){

    var order_total   = 0;
    var order_summary = '';
      is_study_order = false;
    jQuery('.product-qty').each(function(){

      if(jQuery(this).val() > 0){
        var item_cost   = jQuery(this).data('price') * jQuery(this).val();
        order_total     = order_total + item_cost;
          if (jQuery(this).data('title').indexOf("Listing") > -1) {
              is_study_order = true;
          }
      }
    });

      if (is_study_order) {
          jQuery('.email-section').hide();
          jQuery(".email-section .required").map(function () {
              jQuery(this).removeClass("required");
          });

          jQuery(".email-section input").map(function () {
              jQuery(this).prop("disabled", true);
          });

          jQuery('.user-section').show();
          jQuery(".user-section .required").map(function () {
              jQuery(this).addClass("required");
              jQuery(this).prop("disabled", false);
          });

          jQuery(".user-section input").map(function () {
              jQuery(this).prop("disabled", false);
          });
      } else {
          jQuery('.email-section').show();
          jQuery(".email-section .required").map(function () {
              jQuery(this).addClass("required");
          });

          jQuery(".email-section input").map(function () {
              jQuery(this).prop("disabled", false);
          });

          jQuery('.user-section').hide();
          jQuery(".user-section .required").map(function () {
              jQuery(this).removeClass("required");
              jQuery(this).prop("disabled", true);
          });

          jQuery(".user-section input").map(function () {
              jQuery(this).prop("disabled", true);
          });
      }

    if( coupon_obj['type'] == "percent" ){
      var discount_amount = (order_total * parseFloat(coupon_obj['value']) / 100.0);
      order_total     = order_total - discount_amount;
      //summary-coupon
        console.log(discount_amount);
      jQuery('summary-coupon').show();
      jQuery('.discount-amount').html('-$'+discount_amount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') );
    } else if ( coupon_obj['type'] == "fixed" ) {
        var discount_amount = parseFloat(coupon_obj['value']);
        order_total     = Math.max(order_total - discount_amount, 0);
        console.log(discount_amount);
        //summary-coupon
        jQuery('summary-coupon').show();
        jQuery('.discount-amount').html('-$'+discount_amount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') );
    } else {
        jQuery('.discount-amount').html("");
        jQuery('.coupon-code-input').val("");
        jQuery('.coupon-code-value').val("");
    }

    jQuery('.total-value').html( '$'+order_total.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') );
    jQuery('#amount').val(order_total);
  }


  jQuery('#go-coupon').click(function(){
    code = jQuery('.coupon-code-input').val();

      if (code) {
    var ajaxurl     = '/wp-admin/admin-ajax.php';
    var datastring  = {coupon:code, action:'couponcode'};

    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: datastring,
        //dataType: "json",
        success: function(data) {


            coupon_obj = JSON.parse(data);
            console.log(coupon_obj);
            if (coupon_obj.type != "invalid") {
                jQuery('.coupon-code-value').val(jQuery('.coupon-code-input').val());
                jQuery('.remove_coupon').show();
            } else {
                alert("This coupon code is invalid or has expired.");
                jQuery('.coupon-code-input').val("");
                jQuery('.coupon-code-value').val("");
                jQuery('.remove_coupon').hide();
            }
//            coupon_discount = '0.'+data;
            updateTotal();

        },
        error: function(data){
          console.log(data);
          jQuery('.order_status').html("This coupon code is invalid or has expired.");
        }
    });
      }

    return false;
  });


  jQuery('.go_check_btn').click(function(){
    var cart_total = 0;
    var product_qty_arr = jQuery('.product-qty');

    for (var i = 0; i < product_qty_arr.length ; i ++ ){
        cart_total += parseInt(product_qty_arr[i].value ? product_qty_arr[i].value : "0");
    }

    if (cart_total == 0) {
        alert("Your shopping cart is empty.");
    } else {
        jQuery('.step-one').slideUp();
        jQuery('.billing_payment').show();
        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
    }
    return false;
  });


  function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && !((charCode >= 48 && charCode <= 57) || (charCode >= 96 && charCode <= 105))) {
          return false;
      }
      return true;
  }

  jQuery('.product-qty').keyup(function(){
    var quantity      =  jQuery(this).val();

    switch(quantity){
      case '01':
        jQuery(this).val('1');
      break;
      case '02':
        jQuery(this).val('2');
      break;
      case '03':
        jQuery(this).val('3');
      break;
      case '04':
        jQuery(this).val('4');
      break;
      case '05':
        jQuery(this).val('5');
      break;
      case '06':
        jQuery(this).val('6');
      break;
      case '07':
        jQuery(this).val('7');
      break;
      case '08':
        jQuery(this).val('8');
      break;
      case '09':
        jQuery(this).val('9');
      break;
    }


     var item_cost    = jQuery(this).data('price') * jQuery(this).val();
     var item_id      = jQuery(this).data('id');
     //item-price-

     jQuery('#item-summary-'+item_id).remove();
     if( (jQuery(this).val() != '0') && (jQuery(this).val() != '') ){
      jQuery('.item-price-'+item_id).html( '$'+item_cost.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') );

      var tableHTML = '<tr id="item-summary-'+item_id+'">';
      tableHTML += '<td><span class="diamond_listing">'+jQuery(this).val()+'</span> '+jQuery(this).data('title')+'</td>';
      tableHTML += '<td> '+jQuery('.item-price-'+item_id).html()+'</td>';
      tableHTML += '</tr>';

      jQuery('.order-summary-table').append(tableHTML);
     }else{
         jQuery('.item-price-'+item_id).html( '$'+item_cost.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')     );
       jQuery(this).val('');
     }

     updateTotal();

  });

  jQuery('.go_payment').click(function(){
    var errors = 0;
      var email = $("#email").val();
      var email2 = $("#email2").val();
      var password = $("#password").val();
      var confirmPassword = $("#confirm_password").val();
      var data_form = $("#order-form");
      if (is_study_order) {
          if (email != email2) {
              $("#email").addClass("warning");
              $("#email2").addClass("warning");
              errors ++;
          }
          if (!email_validate) {
              $("#email").addClass("warning");
              errors ++;
          }
          if (!username_validate) {
              errors ++;
          }
          if (password != confirmPassword) {
              $("#password").addClass("warning");
              $("#confirm_password").addClass("warning");
              errors ++;
          }
      }


    jQuery("#order-form .required").map(function () {
//        console.log($(this).val());
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

      if (someday < today && errors == 0) {
          errors ++;
          exMonth.addClass('warning');
          exYear.addClass('warning');
          jQuery('.payment-processing').show();
          jQuery('.payment-processing').html("The expiration date is invalid.");
          return false;
      }
    if (errors == 0) {
        jQuery('.payment-processing').show();
        jQuery('.payment-processing').html('<img src="/wp-content/themes/twentyfifteen/images/loading.gif" /> Processing Payment...');
        jQuery('.payment-button').hide();

        post_ajax_get();
    }
      console.log(errors);
    return false;
  });
  jQuery('.remove_coupon').click(function(){
    if (confirm("Are you sure to remove coupon?")) {
      coupon_obj = [];
      coupon_discount = 0;
      updateTotal();
        jQuery('.remove_coupon').hide();
    }
  });
  function post_ajax_get(term_id,term_name) {
    var ajaxurl     = '/wp-admin/admin-ajax.php';
    var datastring  = jQuery("#order-form").serialize();

    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: datastring,
        //dataType: "json",
        success: function(data) {

            var status          = data;
            var statusArr       = data.split('|');
            var success_message = '';
            console.log(statusArr);
            if(statusArr[0] == 'yes'){
              success_message = '<strong>Thank you</strong><br />Transaction ID: '+statusArr[1]+'<br /><br />';
                jQuery('.payment-processing').html(success_message);
                //setTimeout(function(){
                  // post form to another page
                  jQuery('#transaction_id').val(statusArr[1]);
                  jQuery('#card_id').val(statusArr[4]);
                  jQuery('#invoice_number').val(statusArr[3]);
                  jQuery('#order_id').val(statusArr[2]);
                  jQuery('#user_id').val(statusArr[5]);
                  jQuery('.payment-processing').val('<p>Transaction ID: '+ statusArr[1]+'</p>');
                if (is_study_order) {
                  jQuery('#order-form').submit();
                } else {
                    window.location = "<?php echo site_url();?>/thank-listing/";
                }

                //}, 5000);

            }else{
              success_message = '<strong>Sorry</strong><br />There was an error. The card information is invalid. <br /><br />';
                jQuery('input[name=cc_number]').addClass("warning");
                jQuery('select[name=cc_exp_month]').addClass("warning");
                jQuery('select[name=cc_exp_year]').addClass("warning");
//                jQuery('input[name=cc_cvv2]').addClass("warning");
                jQuery('input[name=zip]').addClass("warning");
              jQuery('.payment-button').show();
              jQuery('.payment-processing').html(success_message);
            }


        },
        error: function(data){
          console.log(data);
            jQuery('.payment-button').show();
            jQuery('.payment-processing').html("<strong>Sorry</strong><br />There was an error.<br /><br />");
        }
    });

  }
  function get_order_total(){
    var order_total   = 0;
    jQuery('.product-qty').each(function(){
      if(jQuery(this).val() != '0'){
        var item_cost   = jQuery(this).data('price') * jQuery(this).val();
        order_total     = order_total + item_cost;
      }

    });
    return order_total;
  }

  function keyupcheckEmailMatch() {
      var email = $("#email").val();
      var email2 = $("#email2").val();
      if (email == "" && email2 == "") {
          $("#divCheckEmailMatch").html("&nbsp;");
      } else {
          if (email != email2){
              $("#divCheckEmailMatch").html("<span style='color:red;margin-right:5px;float:right;margin-top:-10px;'>Emails Do Not Match</span>");
    //          $("#divCheckEmailMatch").css("color", "red");
              return false;
          }
          else{
              $("#divCheckEmailMatch").html("<span style='color:green;margin-right:5px;float:right;margin-top:-10px;'>Emails Match</span>");
    //          $("#divCheckEmailMatch").css("color", "green");
              return true;
          }
      }
  }
  function keyupcheckPasswordMatch() {
      console.log("sss");
      var password = $("#password").val();
      var confirmPassword = $("#confirm_password").val();
      if (password == "" && confirmPassword == "") {
          $("#passwordInfo").html("&nbsp;");
      } else {
          if (password != confirmPassword){
              $("#passwordInfo").html("<span style='color:red;float:right;margin-right:5px;margin-top:-10px;'>Passwords Do Not Match</span>");
    //          $("#divCheckPasswordMatch").css("color", "red");
              return false;
          }
          else{
              $("#passwordInfo").html("<span style='color:green;float:right;margin-right:5px;margin-top:-10px;'>Passwords Match</span>");
    //          $("#divCheckPasswordMatch").css("color", "green");
              return true;
          }
      }
  }
  jQuery('#email').blur(function(e) {
      var emailok = false;
      var site_email=jQuery('#email').val();
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(regex.test(site_email)){
          jQuery.ajax({
              url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
              type: 'POST',
              data: "action=dashboard_add_email&email="+site_email,
              beforeSend: function(){
                  jQuery('#divCheckEmailExist').html("<span style='float:right;margin-right:5px;margin-top:-10px;'>Checking Email</span>"); //show checking or loading image
              },
              success: function(html){
                  if(html != 0)
                  {
                      email_validate = false;
                      emailok = false;
                      if (jQuery('#email').val() !='' ){
                          jQuery('#divCheckEmailExist').html("<span style='color:red;float:right;margin-right:5px;margin-top:-10px;'>Email Already Exist</span>");
                          jQuery('#email').addClass('warning');
//                          jQuery('#email').val("");
                      }
                  }
                  if(html == 0)
                  {
                      email_validate = true;
                      emailok = true;
                      if (jQuery('#site_email').val() !='' ){
                          jQuery('#divCheckEmailExist').html("<span style='color:green;margin-right:5px;float:right;margin-top:-10px;'>Email OK</span>");
                          jQuery('#email').removeClass('warning');
                      }
                  }
              }

          })
      }
      else{
          jQuery('#divCheckEmailExist').html("<span style='color:red;float:right;margin-right:5px;margin-top:-10px;'>Invalid Email</span>");
          jQuery('#email').addClass('warning');

      }
  });

  jQuery('#username').blur(function(e) {
      var username_check = false;
      var username = jQuery('#username').val();

      if(username != ""){
          jQuery.ajax({
              url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
              type: 'POST',
              data: "action=check_username&username="+username,
              beforeSend: function(){
                  jQuery('#userinfo').html("<span style='float:right;margin-right:5px;margin-top:-10px;'>Checking Username</span>"); //show checking or loading image
              },
              success: function(html){
                  if(html != 0){
                      username_validate = false;
                      username_check = false;
                      if (jQuery('#username').val() !='' ){
                          jQuery('#userinfo').html("<span style='color:red;float:right;margin-right:5px;margin-top:-10px;'>Username Already Exist</span>");
                          jQuery('#username').addClass('warning');
                      }
                  }
                  if(html == 0){
                      username_validate = true;
                      username_check = true;
                      if (jQuery('#username').val() !='' ){
                          jQuery('#userinfo').html("<span style='color:green;margin-right:5px;float:right;margin-top:-10px;'>Username OK</span>");
                          jQuery('#username').removeClass('warning');
                      }
                  }
              }
          });
      } else {
          jQuery('#username').addClass('warning');
          jQuery('#userinfo').html("&nbsp;");
      }
  });

</script>

</body>
</html>
