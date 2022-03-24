<?php
/**
Template Name: Home
 */
get_header();
?>
  <style>
    .gmw-form select{
      margin:0px !important;
    }
    .required.warning {
      border: 1px solid red;
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
    .black_overlay {
      background: #000000 none repeat scroll 0 0;
      display: block;
      height: 3400px;
      left: 0;
      opacity: 0.8;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1001;
    }
    .close_button{
      background: #00afef none repeat scroll 0 0;
      border: medium none;
      color: #fff;
      display: block;
      font-family: alternate;
      font-size: 33px;
      margin: auto auto 20px;
      padding: 0 26px;
      text-align: center;
    }

  </style>
  <div id="banner">
    <div class="container">
      <div class="row">
        <div class="banner-block">
          <div class="col-md-3 sform">
            <div class="slider-form"> <!-- AWeber Web Form Generator 3.0 -->
              <h1>Be Notified About Clinical Trials!</h1>
              <form method="post" class="af-form-wrapper" action="main_page_subscription"  >
                <div style="display: none;">
                  <input type="hidden" name="meta_web_form_id" value="39699699" />
                  <input type="hidden" name="meta_split_id" value="" />
                  <input type="hidden" name="listname" value="studykik_p_lead" />
                  <input type="hidden" name="redirect" value="https://www.studykik.com" id="redirect_9e46f04abc5b261bb337e0bb6829a344" />
                  <input type="hidden" name="meta_redirect_onlist" value="https://www.studykik.com/?registered=1" />
                  <input type="hidden" name="meta_adtracking" value="Studykik_mail" />
                  <input type="hidden" name="meta_message" value="1" />
                </div>
                <div id="af-form-39699699" class="af-form">
                  <div id="af-header-39699699" class="af-header"><div class="bodyText"></div></div>
                  <div id="af-body-39699699"  class="af-body af-standards">
                    <div class="af-element">
                      <div class="af-textWrap">
                        <input id="awf_field-78343778" type="text" name="name" class="text required" placeholder="Enter Your First & Last Name"  tabindex="500" onfocus="if (this.value == this.defaultValue)
                                                        this.value = ''"  onblur="if (this.value == '')
                                                                    this.value = this.defaultValue"  />
                      </div>
                      <div class="af-clear"></div></div>
                    <div class="af-element">
                      <div class="af-textWrap"><input class="text required" id="awf_field-78343779" type="text" name="email" placeholder="Enter Your Email Address" tabindex="501"  onfocus="if (this.value == this.defaultValue)
                                                    this.value = ''"  onblur="if (this.value == '')
                                                                this.value = this.defaultValue" />
                      </div><div class="af-clear"></div>
                    </div>
                    <div class="af-element">
                      <div class="af-textWrap"><input type="text" id="awf_field-78343780" class="text required" name="custom Mobile Phone Number" placeholder="Enter Your Phone Number"  onfocus="if (this.value == this.defaultValue)
                                                    this.value = ''"  onblur="if (this.value == '')
                                                                this.value = this.defaultValue"  tabindex="502" /></div>
                      <div class="af-clear"></div></div><div class="af-element buttonContainer">
                      <input name="submit" class="submit slide-btn" type="submit" value="Submit" tabindex="503"/>
                      <input style="display:none" name="submit" class="submit mobileversion" type="submit" value="Submit Information!" tabindex="503" />
                      <div class="af-clear"></div>
                    </div>
                  </div>
                  <div id="af-footer-39699699" class="af-footer"><div class="bodyText"></div></div>
                </div>
                <div style="display: none;"><img src="https://forms.aweber.com/form/displays.htm?id=zJxsnJxsnJw=" alt="" /></div>
              </form>
              <script type="text/javascript">
              </script>
            </div>
          </div>
          <div class="col-md-9 slider" style="position:relative">
            <div class="slider-block">
              <div id="carousel-wrapper">
                <div id="carousel">
                  <img src="/wp-content/uploads/2013/12/Studykik-logo-slider.png">
                </div>
              </div>
              <div id="thumbs-wrapper">
                <div id="thumbs">
                  <div id="pager"></div>
                </div>

              </div>
              <?php wp_reset_query(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="cntt-form">
    <div class="container">
      <div class="row">
        <div class="text-center">
          <h1 class="form-head">Instantly search for a clinical trial!</h1>
          <div class="center-block-form">
            <div class="center-form">
              <?php echo do_shortcode('[gmw form="1"]'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="application/javascript">
    jQuery(window).load(function(){
      var str=navigator.userAgent;
      n=str.indexOf("Safari");
      if(n!=-1){
        jQuery('.drop-cus').attr('style', 'margin-bottom: 25px !important');
      }
      jQuery('#selectwppl_distance').remove();
      jQuery('#selecttax_category').remove();
      jQuery('#gmw-distance-select-1').before('<span class="select" id="selectwppl_distance">Distance </span>');
      jQuery('#category-tax').before('<span id="selecttax_category" class="select">Any Type</span>');

    });
    jQuery(document).on('change','#gmw-distance-select-1',function(){
      var dt= jQuery('#gmw-distance-select-1 option:selected').text();
      jQuery('#gmw-distance-select-1').siblings('span').remove();
      //jQuery('#selectwppl_distance').remove();
      jQuery('#gmw-distance-select-1').before('<span class="select" id="selectwppl_distance">Distance </span>');
      jQuery('#selectwppl_distance').html(dt);
    });
    jQuery(document).on('change','#category-tax',function(){
      var dt= jQuery('#category-tax option:selected').text();
      jQuery('#category-tax').siblings('span').remove();
      //jQuery('#selecttax_category').remove();
      jQuery('#category-tax').before('<span id="selecttax_category" class="select">Any Type</span>');
      jQuery('#selecttax_category').html(dt);
    });

    function isValidEmailAddress(emailAddress) {
      var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
      return pattern.test(emailAddress);
    };

    jQuery(document).ready(function () {
      jQuery('.af-form-wrapper').submit(function (e) {
        var errors = 0;
        jQuery(".af-form-wrapper .required").map(function () {
          if (!jQuery(this).val()) {
            jQuery(this).addClass('warning');
            errors++;
          } else if (jQuery(this).val()) {
            jQuery(this).removeClass('warning');
          }
        });

        if( !isValidEmailAddress( jQuery("#awf_field-78343779").val() ) ) { jQuery("#awf_field-78343779").addClass('warning'); errors++; }
        if (errors > 0) {
          return false;
        }
      });
    });

  </script>
<?php if (isset($_REQUEST['find_search'])) { ?>
  <div id="trial">
    <div id="trail">
      <div class="container">
        <div class="row">
          <div class="trail-list">
            <?php echo do_shortcode('[gmw_results]'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<?php
get_footer();
?>
<?php
  $registered = isset($_REQUEST["registered"])?$_REQUEST["registered"]:0;
  if ($registered) {?>
  <div id="embed" class="white_content" style="display:block;">
    <h2 class="heading">Thank you!</h2>
    <p id="msg_box" style="color: #000; padding: 15px; font-size: 16px; text-align: center;">
      You have already signed up
    </p>
    <input onclick="document.getElementById('embed').style.display='none';document.getElementById('fade').style.display='none'" class="close_button" type="button" value="CLOSE"/>
  </div>
  <div id="fade" class="black_overlay" style="display:block;"></div>
<?php } ?>
<?php
$subscribe_success = isset($_REQUEST["subscribe_success"])?$_REQUEST["subscribe_success"]:0;
if ($subscribe_success) {?>
  <div id="embed" class="white_content" style="display:block;">
    <h2 class="heading">Thank you!</h2>
    <p id="msg_box" style="color: #000; padding: 15px; font-size: 16px; text-align: center;">
      We'll be informing you about clinical trials.
    </p>
    <input onclick="document.getElementById('embed').style.display='none';document.getElementById('fade').style.display='none'" class="close_button" type="button" value="CLOSE"/>
  </div>
  <div id="fade" class="black_overlay" style="display:block;"></div>
<?php } ?>
