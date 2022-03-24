<?php
/*
 * Template Name: Checkout Page
 */
get_header();
?>
<link href="<?php bloginfo('template_url'); ?>/css/checkout.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/fonts/font.css" rel="stylesheet" type="text/css">

<section class="full_background"> </section>
<div class="container">
  <div class="left_section">
    <div class="col-md-12 col-xs-12 heading_clinical">
      <h3>CLINICAL STUDY INFORMATION</h3>
      <p><span>You are almost finished!</span> To complete the study listing process:</p>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 purchased"> <img src="<?php bloginfo('template_url'); ?>/images/one.png" alt="" class="img-responsive center-block">
      <h4>Select the number<br>
        of studies you<br>
        purchased.</h4>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 purchased_two"> <img src="<?php bloginfo('template_url'); ?>/images/two.png" alt="" class="img-responsive center-block">
      <h4>Enter all<br>
        study<br>
        information.</h4>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 purchased_three"> <img src="<?php bloginfo('template_url'); ?>/images/three.png" alt="" class="img-responsive center-block">
      <h4>Click<br>
        "List My<br>
        Studies"</h4>
    </div>
    <div class="col-md-12 col-xs-12 completed_text">
      <p>Once completed, your studies will be live in 24 hours. We look forward to helping you<br>
        enroll your clinical trials!</p>
    </div>
  </div>
  <div class="right_section">
    <div class="side-bar">
      <div class="order-summary">
        <table>
          <caption>
            Order Summary:
          </caption>
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
          <tr>
            <td><span class="coupon_discount">Coupon Discount</span></td>
            <td><span class="coupon_discount">- $100.00</span></td>
          </tr>
          <tr>
            <td><b class="total_bold">Total</b></td>
            <td><b class="total_bold">$5,236.00</b></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
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
<!--shopping cart html end -->
<article class="billing_payment">
  <div class="container">
    <div class="left_section">
      <aside id="name_section">
        <div class="col-md-4 col-sm-4 col-xs-12 name_first">
          <form class = "form-horizontal" role = "form">
            <input type = "text" class = "form-control" id = "firstname" placeholder = "First Name">
          </form>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 name_first">
          <form class = "form-horizontal" role = "form">
            <input type = "text" class = "form-control" id = "" placeholder = "Last Name">
          </form>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 name_first">
          <form class = "form-horizontal" role = "form">
            <input type = "text" class = "form-control" id = "" placeholder = "Company">
          </form>
        </div>
      </aside>
      <div class="col-md-12 col-xs-12 horizontal_line">
      </div>
      <div class="col-md-6 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "phone_number" placeholder = "Phone Number">
        </form>
      </div>
      <div class="col-md-6 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "phone_number" placeholder = "Secondary Phone Number">
        </form>
      </div>
      <div class="col-md-6 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "firstname" placeholder = "Fax Number">
        </form>
      </div>
      <div class="col-md-12 col-xs-12 horizontal_line">
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "" placeholder = "Email">
        </form>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "" placeholder = "Confirm Email">
        </form>
      </div>
      <div class="col-md-12 col-xs-12 horizontal_line">
      </div>
      <div class="col-md-12 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "phone_number" placeholder = "Address">
        </form>
      </div>
      <div class="col-md-12 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "phone_number" placeholder = "Address 2">
        </form>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "phone_number" placeholder = "City">
        </form>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "phone_number" placeholder = "Zip">
        </form>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "phone_number" placeholder = "State">
        </form>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "phone_number" placeholder = "Country">
        </form>
      </div>
      <div class="col-md-4 col-sm-6 col-xs-12 name_first">
        <div class ="checkbox" id="check_information">
          <label><input type = "checkbox">Remember My Information</label>
        </div>
      </div>
      <div class="col-md-12 col-xs-12 horizontal_line">
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 name_first">
        <select class="drop_btn">
          <option value="Card Type">Card Type</option>
          <option value="Card Type">Card Type</option>
          <option value="Card Type">Card Type</option>
          <option value="Card Type">Card Type</option>
        </select>
      </div>
      <div class="col-md-8 col-sm-8 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "phone_number" placeholder = "Name on Card">
        </form>
      </div>
      <div class="col-md-12 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "phone_number" placeholder = "Card Number">
        </form>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 name_first">
        <select class="drop_btn">
          <option value="Expiration Month">Expiration Month</option>
          <option value="Expiration Month">Expiration Month</option>
          <option value="Expiration Month">Expiration Month</option>
          <option value="Expiration Month">Expiration Month</option>
        </select>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 name_first">
        <select class="drop_btn">
          <option value="Expiration Year">Expiration Year</option>
          <option value="Expiration Year">Expiration Year</option>
          <option value="Expiration Year">Expiration Year</option>
          <option value="Expiration Year">Expiration Year</option>
        </select>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 name_first">
        <form class = "form-horizontal" role = "form">
          <input type = "text" class = "form-control" id = "" placeholder = "CVC">
        </form>
      </div>
      <div class="col-md-12 col-xs-12 horizontal_line">
      </div>
      <div class="col-md-12 col-xs-12 name_first">
        <textarea class="form-control" style="min-width: 100%">Comments/Special Instructions</textarea>
      </div>
      <div class="col-md-12 col-xs-12 center_number">
        <h4>Total:  $5,236.00</h4>
      </div>
      <div class="col-md-12 col-xs-12">
        <button class="submit_btn"><img src="<?php bloginfo('template_url'); ?>/images/submit_order.png" alt="" class="img-responsive center-block"></button>
      </div>
    </div>
  </div>
</article>

<?php get_footer(); ?>

<script src="https://code.jquery.com/jquery.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.js"></script>
</body>
</html>