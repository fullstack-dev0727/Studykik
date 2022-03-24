<?php
$ecommerce_enabled = get_option('ecommerce_enabled');
//$ecommerce_enabled = 1;
?>
<section class="container_current">
  <artical id="left_section" <?php if(!(bool) $ecommerce_enabled){echo 'class=\'single-section\'';}?>>
    <div class="col-md-12 col-xs-12 account_heading">
      <h2>MY ACCOUNT</h2>
    </div>
    <div class="col-md-12 col-xs-12 tml tml-profile" id="theme-my-login<?php $template->the_instance(); ?>">
      <?php $template->the_action_template_message( 'profile' ); ?>
      <?php $template->the_errors(); ?>
      <form id="your-profile" action="<?php $template->the_action_url( 'profile' ); ?>" method="post" class="form_payment">
        <?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>
        <p>
          <input type="hidden" name="from" value="profile" />
          <input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
        </p>

        <div>
          <input type="text" name="user_login" class="form-control" value="<?php echo esc_attr( $profileuser->user_login ); ?>" id="user_login" placeholder="Username" disabled="disabled" >
          <span class="description"><?php _e( 'Usernames cannot be changed.', 'theme-my-login' ); ?></span>
        </div>
        <div><input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="<?php echo esc_attr( $profileuser->first_name ); ?>"></div>
        <div><input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="<?php echo esc_attr( $profileuser->last_name ); ?>"></div>
        <div class="tml-user-email-wrap">
          <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo esc_attr( $profileuser->user_email ); ?>">
          <?php
          $new_email = get_option( $current_user->ID . '_new_email' );
          if ( $new_email && $new_email['newemail'] != $current_user->user_email ) : ?>
            <div class="updated inline">
              <p><?php
                printf(
                  __( 'There is a pending change of your e-mail to %1$s. <a href="%2$s">Cancel</a>', 'theme-my-login' ),
                  '<code>' . $new_email['newemail'] . '</code>',
                  esc_url( self_admin_url( 'profile.php?dismiss=' . $current_user->ID . '_new_email' ) )
                ); ?></p>
            </div>
          <?php endif; ?>
        </div>

        <div><input type="text" name="sitename" class="form-control" id="sitename" placeholder="Site Name" value="<?php echo esc_attr( $profileuser->sitename ); ?>"></div>
        <div><input type="text" name="address" class="form-control" id="address" placeholder="Address" value="<?php echo esc_attr( $profileuser->address ); ?>"></div>


        <?php
        $show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
        if ( $show_password_fields ) :
          ?>
          <table class="tml-form-table">
            <tr id="password" class="user-pass1-wrap">
              <th><label for="pass1"><?php _e( 'New Password', 'theme-my-login' ); ?></label></th>
              <td>
                <input class="hidden" value=" " /><!-- #24364 workaround -->
                <button type="button" class="button button-secondary wp-generate-pw hide-if-no-js"><?php _e( 'Generate Password', 'theme-my-login' ); ?></button>
                <div class="wp-pwd hide-if-js">
                <span class="password-input-wrapper">
                  <input type="password" name="pass1" id="pass1" class="regular-text" value="" autocomplete="off" data-pw="<?php echo esc_attr( wp_generate_password( 24 ) ); ?>" aria-describedby="pass-strength-result" />
                </span>
                  <div style="display:none" id="pass-strength-result" aria-live="polite"></div>
                  <button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password', 'theme-my-login' ); ?>">
                    <span class="dashicons dashicons-hidden"></span>
                    <span class="text"><?php _e( 'Hide', 'theme-my-login' ); ?></span>
                  </button>
                  <button type="button" class="button button-secondary wp-cancel-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Cancel password change', 'theme-my-login' ); ?>">
                    <span class="text"><?php _e( 'Cancel', 'theme-my-login' ); ?></span>
                  </button>
                </div>
              </td>
            </tr>
            <tr class="user-pass2-wrap hide-if-js">
              <th scope="row"><label for="pass2"><?php _e( 'Repeat New Password', 'theme-my-login' ); ?></label></th>
              <td>
                <input name="pass2" type="password" id="pass2" class="regular-text" value="" autocomplete="off" />
                <p class="description"><?php _e( 'Type your new password again.', 'theme-my-login' ); ?></p>
              </td>
            </tr>
            <tr class="pw-weak hide-if-js" style="display:none;">
              <th><?php _e( 'Confirm Password' ); ?></th>
              <td>
                  <label>
                      <input type="checkbox" name="pw_weak" class="pw-checkbox" />
                      <?php _e( 'Confirm use of weak password' ); ?>
                  </label>
              </td>
            </tr>
          </table>
        <?php endif; ?>

        <p class="tml-submit-wrap">
          <input type="hidden" name="action" value="profile" />
          <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
          <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
        </p>

        <div class="col-sm-12 col-xs-12 update_profile">
          <button class="btn_update" name="submit" id="submit"><img src="<?php bloginfo('template_url'); ?>/images/update_profile.png" alt="" class="img-responsive center-block"></button>
        </div>

      </form>
    </div>
  </artical>
  <?php if((bool) $ecommerce_enabled){ ?>
  <artical id="right_section">
    <div class="col-md-4 col-xs-4">
        </div>
    <div class="col-md-8 col-xs-8 account_heading" style="text-align: center;">
      <h2>PAYMENT INFO</h2>
    </div>
    <div class="col-sm-4 col-xs-12 center_info">
      <img src="<?php bloginfo('template_url'); ?>/images/center_client.png" alt="" class="img-responsive">
    </div>
      <div class="col-sm-8 col-xs-12">
    <?php
    $user_ID      = get_current_user_id();
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
    	'meta_key'			   => 'payment_user_id',
    	'orderby'			     => '',
    	'order'				     => 'ASC'
    );
    $cards = get_posts( $args );
//    print_r($cards);

    if(!empty($cards)){
        $loopCount              = 1;
      foreach($cards AS $card){
      
      $auth_profile_id        = get_post_meta($card->ID, 'auth_profile_id', true);
      $auth_payment_profile   = get_post_meta($card->ID, 'auth_payment_profile', true);
      $auth_shipping_profile  = get_post_meta($card->ID, 'auth_shipping_profile', true);
      $payment_user_id        = get_post_meta($card->ID, 'payment_user_id', true);
      $auth_credit_card       = get_post_meta($card->ID, 'auth_credit_card', true);
      $auth_card_code         = get_post_meta($card->ID, 'auth_card_code', true);
      $auth_card_name         = get_post_meta($card->ID, 'auth_card_name', true);
      $auth_card_expiration_month         = get_post_meta($card->ID, 'auth_card_expiration_month', true);
      $auth_card_expiration_year         = get_post_meta($card->ID, 'auth_card_expiration_year', true);
      $card_billing_first_name         = get_post_meta($card->ID, 'card_billing_first_name', true);
      $card_billing_last_name         = get_post_meta($card->ID, 'card_billing_last_name', true);
      $card_billing_address         = get_post_meta($card->ID, 'card_billing_address', true);
      $card_billing_address_2         = get_post_meta($card->ID, 'card_billing_address_2', true);
      $card_billing_city         = get_post_meta($card->ID, 'card_billing_city', true);
      $card_billing_zip         = get_post_meta($card->ID, 'card_billing_zip', true);
      $card_billing_state         = get_post_meta($card->ID, 'card_billing_state', true);
      $card_billing_country         = get_post_meta($card->ID, 'card_billing_country', true);
      $auth_card_type         = get_post_meta($card->ID, 'auth_card_type', true);
      $cart_img_class = 'empty_card';

      switch($auth_card_type){
          case 'Visa':
              $cart_img_class = 'visa';
              break;
          case 'MasterCard':
              $cart_img_class = 'master_card';
              break;
          case 'American Express':
              $cart_img_class = 'american_express';
              break;
          case 'JCB':
              $cart_img_class = 'jcb';
              break;
          case 'Diners Club':
              $cart_img_class = 'dinner_club';
              break;
          case 'Discover':
              $cart_img_class = 'discover';
              break;
      }

      if($auth_profile_id && $auth_payment_profile){
        
      
        
    ?>

    <div class="right_payment">
      <input type="hidden" value="<?php echo $loopCount; ?>">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading" style="vertical-align: middle; padding:10px 0px 10px 20px;">
            <h4 class="panel-title">

              <a href="javascript:void(0);" class="collapsed" style="cursor: default;"><span>
                      <div class="card_type <?php echo $cart_img_class; ?>"></div>
                        <div style="width: 168px; padding-left: 20px;">
                          <?php echo $auth_card_name; ?>
                        </div>
                      <div style="width: 160px; text-align: right; padding-right: 10px;">Card ending in <?php echo $auth_credit_card; ?><br/>
                          <?php echo $auth_card_expiration_month; ?>/<?php echo $auth_card_expiration_year; ?>
                      </div>
                        <div>
                            <button title="Delete Card" class="delete_btn" style="padding:0px;" data-card-id="<?=$card->ID?>"><img src="<?php bloginfo('template_url'); ?>/images-dashboard/close2.png" alt="" class="img-responsive"></button>
                        </div>
                </span></a>
            </h4>
          </div>

        </div>
      </div>
    </div>

    <?php
      $loopCount += 1;
      }
      }
      }

      // loop cards here  
    ?>
          <div class="">
              <button class="add_btn"><img src="<?php bloginfo('template_url'); ?>/images/add_btn.png" alt="" class="img-responsive"></button>
          </div>
      </div>



  </artical>
  <?php } ?>
</section>

<script type="text/javascript">
    jQuery(document).on('ready', function () {
        $('.delete_btn').on('click', function(e){
            if (confirm("Are you sure you want to delete this card?")) {
            if ($(this).prop("disabled") == false) {
                var delete_btn = $(this);
                var card_section = $(this).closest(".right_payment");
                e.preventDefault ? e.preventDefault() : (e.returnValue=false);
                $('.delete_btn').prop("disabled", true);
                jQuery.ajax({
                    type: 'POST',
                    url: location.origin + '/wp-admin/admin-ajax.php',
                    data: {
                        action: 'deletecard',
                        card_id: $(this).data('card-id')
                    },
                    success: function(response){
                        var result = JSON.parse(response);
                        if (result.status == "success") {
                            card_section.hide('slow', function() {
                                card_section.remove();
                                $('.delete_btn').prop("disabled", false);
                            });
                        } else {
                            if (result.message)
                                alert(result.message);
                            $('.delete_btn').prop("disabled", false);
                        }
                    }
                });
            }
            }

        });

    });
</script>
<style type="text/css">
    /*.delete_btn {*/
        /*margin-top:15px;*/
    /*}*/
</style>