<?php
/**
 * Template Name: Page with Title & Sidebar
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
		} else { ?>
			<div <?php post_class(); ?>>
			<?php do_action( 'thb_page_title' ); ?>
				<div class="row">
					<div class="small-12 columns">
							<div class="sidebar-container sidebar-right">
								<div class="sidebar">
									<?php dynamic_sidebar( 'page' ); ?>
								</div>
								<div class="sidebar-content-main">
									<?php the_content(); ?>
									<?php wp_link_pages(); ?>
								</div>
							</div>
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
