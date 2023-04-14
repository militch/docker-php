<?php
/**
 * Index
 *
 * Main index file for the theme.
 *
 * @package WordPress
 * @subpackage restoration
 */

?>
<?php get_header(); ?>
<?php do_action( 'thb_archive_title' ); ?>
<div class="row">
	<div class="small-12 columns">
		<div class="sidebar-container">
			<div class="sidebar-content-main">
				<div class="row">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							get_template_part( 'inc/templates/post-styles/post-style1' );
						endwhile;
					endif;
					?>
				</div>
				<?php
				the_posts_pagination(
					array(
						'prev_text' => esc_html__( 'Prev', 'restoration' ),
						'next_text' => esc_html__( 'Next', 'restoration' ),
						'mid_size'  => 2,
					)
				);
				?>
			</div>
			<aside class="sidebar">
				<?php dynamic_sidebar( 'blog' ); ?>
			</aside>
		</div>
	</div>
</div>
<?php
get_footer();
