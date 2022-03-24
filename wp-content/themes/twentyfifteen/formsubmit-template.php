<?php

/**
Template Name: Form Submit Template

 */



get_header(); ?>


<div id="inner-page">

	<div class="container">

			<?php /* The loop */ ?>

			<?php while ( have_posts() ) : the_post(); ?>



				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">

						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>

						<div class="entry-thumbnail">

							<?php the_post_thumbnail(); ?>

						</div>

						<?php endif; ?>



						<h1 class="entry-title"><?php the_title(); ?></h1>

					</header><!-- .entry-header -->



					<div class="entry-content">

						<!-- AWeber Web Form Generator 3.0 -->

<div class="inner-form">

	<?php
    $name = $_REQUEST['uname'];
    $email = $_REQUEST['uemail'];
    $phone = $_REQUEST['uphone']; 
    
    ?>


<!-- AWeber Web Form Generator 3.0 -->
<form method="post" class="af-form-wrapper" action="http://www.aweber.com/scripts/addlead.pl"  >
<div style="display: none;">
<input type="hidden" name="meta_web_form_id" value="299512245" />
<input type="hidden" name="meta_split_id" value="" />
<input type="hidden" name="listname" value="healthy_volun" />
<input type="hidden" name="redirect" value="https://www.facebook.com/pages/Studykik/369909413146040?ref=hl" id="redirect_43afc32413382926f4ee9f54b26d5ee0" />

<input type="hidden" name="meta_adtracking" value="Healthy2" />
<input type="hidden" name="meta_message" value="1" />
<input type="hidden" name="meta_required" value="name,email" />

<input type="hidden" name="meta_tooltip" value="" />
</div>
<div id="af-form-299512245" class="af-form"><div id="af-header-299512245" class="af-header"><div class="bodyText"><p>&nbsp;</p></div></div>
<div id="af-body-299512245"  class="af-body af-standards">
<div class="af-element">
<label class="previewLabel" for="awf_field-58697491">Name: </label>
<div class="af-textWrap">
<input id="awf_field-58697491" type="text" name="name" class="text" value="<?php echo $name;?>"  tabindex="500" />
</div>
<div class="af-clear"></div></div>
<div class="af-element">
<label class="previewLabel" for="awf_field-58697492">Email: </label>
<div class="af-textWrap"><input class="text" id="awf_field-58697492" type="text" name="email" value="<?php echo $email;?>" tabindex="501"  />
</div><div class="af-clear"></div>
</div>
<div class="af-element">
<label class="previewLabel" for="awf_field-58697493">Phone Number:</label>
<div class="af-textWrap"><input type="text" id="awf_field-58697493" class="text" name="custom Phone Number" value="<?php echo $phone;?>"  tabindex="502" /></div>
<div class="af-clear"></div></div><div class="af-element buttonContainer">
<input name="submit" class="submit slide-btn" type="submit" value="Submit" tabindex="503" />
<div class="af-clear"></div>
</div>
</div>
</div>
<div style="display: none;"><img src="http://forms.aweber.com/form/displays.htm?id=TJycrIxMTCys" alt="" /></div>
</form>

<!-- /AWeber Web Form Generator 3.0 -->


  </div>

                        

						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

					</div><!-- .entry-content -->



					

				</article><!-- #post -->




			<?php endwhile; ?>



		</div><!-- #content -->

	</div><!-- #primary -->




<?php get_footer(); ?>