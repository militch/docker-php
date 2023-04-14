<?php
/**
 * Blog Post
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

get_header();
?>
<?php do_action( 'thb_breadcrumbs' ); ?>
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		if ( post_password_required() ) {
			get_template_part( 'inc/templates/misc/password-protected' );
		} else {
			get_template_part( 'inc/templates/post-detail-styles/post-detail-style1' );
		}
	endwhile;
endif;

get_footer();
