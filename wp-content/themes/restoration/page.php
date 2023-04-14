<?php
/**
 * Static Page
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		if ( post_password_required() ) {
			get_template_part( 'inc/templates/misc/password-protected' );
		} elseif ( thb_is_woocommerce() ) {
			?>
			<div <?php post_class(); ?>>
				<div class="row">
					<div class="small-12 columns">
						<div class="no-vc">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<div <?php post_class(); ?>>
				<div class="row">
					<div class="small-12 columns">
						<?php the_content(); ?>
						<?php wp_link_pages(); ?>
						<?php
						if ( comments_open() || get_comments_number() ) {
							comments_template( '', true );
						}
						?>
					</div>
				</div>
			</div>
		<?php } ?>
			<?php
	endwhile;
endif;

get_footer();
