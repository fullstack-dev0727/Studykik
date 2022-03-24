<?php 

/**

 * Default search form for Post, post types and pages.

 * @version 1.0

 * @author Eyal Fitoussi

 */

?>

<div id="gmw-form-wrapper-<?php echo $gmw['form_id']; ?>" class="gmw-form-wrapper gmw-form-wrapper-<?php echo $gmw['form_id']; ?> gmw-pt-form-wrapper">

	<form id="gmw-form-<?php echo $gmw['form_id']; ?>" class="standard-form gmw-form gmw-form-<?php echo $gmw['form_id']; ?> gmw-pt-form " name="wppl_form" action="<?php echo $gmw['results_page']; ?>#trial" method="post" onsubmit="showHide();">

			

		<div class="gmw-post-types-wrapper">

			<!-- post types dropdown -->

			<?php gmw_pt_form_post_types_dropdown($gmw, $title='', $class='', $all= __(' -- Search Site -- ','GMW')); ?>

		</div>

        

        <div class="gmw-address-field-wrapper">

			<!-- Address Field -->

			<?php //gmw_search_form_address_field($gmw, $class=''); ?>
            
            <input type="text" size="35" value="Postal Code"  onfocus="if (this.value==this.defaultValue) this.value = ''"  onblur="if (this.value=='') this.value = this.defaultValue" class="mandatory gmw-address gmw-full-address gmw-address-1 " id="gmw-address" name="wppl_address[]">

		</div>	

		

		

		

		

		

		<!--  locator icon -->

		<?php gmw_search_form_locator_icon($gmw, $class=''); ?>

			

		<div class="clear"></div>

		

		<div class="gmw-unit-distance-wrapper">

			<!--distance values -->

			<?php gmw_search_form_radius_values($gmw, $class='', $btitle='', $stitle=''); ?>

			<!--distance units-->

			<?php gmw_search_form_units($gmw, $class='' ); ?>	

		</div><!-- distance unit wrapper -->

        

        <div class="gmw-taxonomies-wrapper">

			<!-- Display taxonomies/categories --> 

			<?php gmw_pt_form_taxonomies($gmw); ?>

		</div>

		<?php gmw_form_submit_fields($gmw, $subValue=__('Find Studies!','GMW')); ?>

	</form>

</div><!--form wrapper -->	