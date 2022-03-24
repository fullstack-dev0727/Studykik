<?php
/*
 * Template Name: Order Study Template 
 */
 
get_header();

if (is_user_logged_in()) {
  $user_ID    = get_current_user_id();
  $user_info  = get_userdata($user_ID);
  $user_roles = implode(', ', $user_info->roles);  
  $user_name  = $user_info->user_nicename;
}

?>
<link href="/wp-content/themes/twentyfifteen/css/style_seed.css" rel="stylesheet">
<div class="container">
  <div class="row">
    <div class="center-me page-title">
      <h1>ORDER</h1>
      <?php if (!is_user_logged_in()) { ?>
        <strong>Create your account</strong>
        create account form here
        <p>or <a href="/login/?redirect_to=/order?reauth=1">login</a></p>
      <?php }else{ ?>
       <!-- <em>Hi, <?php echo $user_name; ?></em> -->
      <?php } ?>
    </div>
    <div class="col-xs-2">&nbsp;</div>
    <div class="col-xs-8">
      
      
      <form method="post" id="order-form" action="/clinical-study-information-auth-net/">
        <div class="product-wrapper">
          <strong>SELECT LISTINGS</strong><br />
          <em>Enter the qty of each listing you want to order</em>
        <?php
          
          $args 	= array(
  					'orderby' => 'menu_order',
  					'post_status' => 'publish',
  					'post_type' => 'studykik-products',
  				);
  		
  				$products 	= get_posts( $args );
  				foreach($products AS $product){
    				$product_price = get_field('product_price', $product->ID);
    				setlocale(LC_MONETARY, 'en_US');
          ?>
          
          <div class="product-div">
            <input type="text" name="qty-<?php echo $product->ID; ?>" data-title="<?php echo $product->post_title; ?>" data-price="<?php echo $product_price; ?>" data-id="<?php echo $product->ID; ?>" value="0" class="product-qty" /> 
            <strong>
            <?php echo $product->post_title; ?> / 
            $<?php echo money_format('%i', $product_price); ?></strong><br /><br />
            <em><?php echo $product->post_content; ?></em>
          </div>
  				<?php  } // end products ?> 
          </div>
  				<div class="personal-info" style="display: none;">
    				<p>
      				First Name:<br />
      				<input type="text" name="first_name" />
    				</p>
    				<p>
      				Last Name:<br />
      				<input type="text" name="last_name" />
    				</p>
    				<p>
      				Email:<br />
      				<input type="text" name="first_name" />
    				</p>
    				<p>
      				Address:<br />
      				<input type="text" name="address" />
    				</p>
    				<p>
      				City:<br />
      				<input type="text" name="city" />
    				</p>
    				<p>
      				State:<br />
      				<input type="text" name="state" />
    				</p>
    				<p>
      				Zip:<br />
      				<input type="text" name="zip" />
    				</p>
    				
  				</div>
  				
  				<div class="cc-info product-wrapper">
    				
    				<strong>PAYMENT INFORMATION</strong><br />
            <em>Enter your credit card details</em><br /><br />
    				
    				<p>
      				Name on Card:<br />
      				<input type="text" name="cc_name" />
    				</p>
    				<p>
      				Card Number:<br />
      				<input type="text" name="cc_number" />
    				</p>
    				<p>
      				Exp Date:<br />
      				<input type="text" name="cc_exp_month" maxlength="2" size="3" /> / 
      				<input type="text" name="cc_exp_year" maxlength="4" size="5" /> ( MM / YYYY)
    				</p>
    				<p>
      				CVV2:<br />
      				<input type="text" name="cc_cvv2" />
    				</p>
    				<div>
      				<input type="checkbox" name="save_cc" value="1" /> Save Credit Card <br /><br />
      				<input type="hidden" name="amount" id="amount" />
      				<input type="hidden" name="action" value="go_order" />
      				<input type="hidden" name="transaction_id" id="transaction_id" />
              <button id="go_order" class="btn btn-primary">Submit</button>
  				</div>
  				</div>
  				
  				
        
        <div class="confirm-modal">
          <div class="confirm-modal-inner">
            <strong>CONFIRM ORDER</strong><br /><br />
            <div class="order-summary"></div>
            <a href="#" class="btn btn-primary go_payment">YES, Pay $<span class="order-total">5000</span></a><br />
            <a href="#" class="cancel-order">No, Adjust order</a>
            <div class="order_status"></div>
          </div>
        </div>
        
      </form>
    </div>
    <div class="col-xs-2">&nbsp;</div>
  </div>
</div>


<script>
  
  
  jQuery('#go_order').click(function(){
    $('.confirm-modal').show();
    var order_total   = 0;
    var order_summary = '';
    $('.product-qty').each(function(){
      
      if($(this).val() != '0'){
        
        var item_cost   = $(this).data('price') * $(this).val();
        order_total     = order_total + item_cost;
        order_summary   += $(this).val() +' / '+$(this).data('title') + ' / $'+item_cost+'<br />';
      }
      
    });
    $('.order-summary').html(order_summary);
    $('#amount').val(order_total);
    $('.order-total').html(order_total);
    return false;
    
  });
  jQuery('.cancel-order').on('click', function(){
    $('.confirm-modal').hide();
    return false;
  }); 
  jQuery('.go_payment').click(function(){
    jQuery('.go_payment').html('Processing...');
    post_ajax_get();
    return false;
  });
  function post_ajax_get(term_id,term_name) {
    var ajaxurl     = '/wp-admin/admin-ajax.php';
    //var order_total = get_order_total();
    //var cc_name     = $('#cc_name').val();
    var datastring  = $("#order-form").serialize();
    
    /*
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {"action": "go_order", order_total: order_total, term_name: term_name },
        success: function(response) {
            jQuery('.order_status').html(response);
            return false;
        }
    }); */
    
    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: datastring,
        //dataType: "json",
        success: function(data) {
            
            var status          = data;
            var statusArr       = data.split('|');
            var success_message = '';
            
            if(statusArr[0] == 'yes'){
              success_message = '<strong>Thank you</strong><br />Transaction ID: '+statusArr[1]+'<br /><br />You will be redirect in 5 seconds to fill out your survey....';
                jQuery('.confirm-modal-inner').html(success_message);
                setTimeout(function(){ 
                  // post form to another page
                  $('#transaction_id').val(statusArr[1]);
                  $('#order-form').submit();
                  
                }, 5000);

            }else{
              success_message = '<strong>Sorry</strong><br />There was an error: '+statusArr[1]+'<br /><br /><a href="#" class="cancel-order">Close Window</a>';
              jQuery('.confirm-modal-inner').html(success_message);
            }    
            
                    
        },
        error: function(data){
          console.log(data);
          jQuery('.order_status').html(data);
        }
    });
    
  }
  function get_order_total(){
    var order_total   = 0;
    $('.product-qty').each(function(){
      if($(this).val() != '0'){
        var item_cost   = $(this).data('price') * $(this).val();
        order_total     = order_total + item_cost;
      }
      
    });
    return order_total;
  }
  
</script>
<?php get_footer(); ?>