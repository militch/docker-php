<?php
/**
 * 404 page
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

get_header();
?>
<div class="row">
	<div class="small-12 columns">
		<section class="content404">
			<div class="row align-center">
				<div class="small-12 medium-8 large-6 columns">
					<h1><?php esc_html_e( 'Page not found', 'restoration' ); ?></h1>
					<p>
						<?php esc_html_e( 'The page you were looking for doesnt exist. You may have mistyped the address or the page may have moved.', 'restoration' ); ?>
					</p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn black"><?php esc_html_e( 'Back to Home', 'restoration' ); ?></a>
				</div>
			</div>
		</section>
	</div>
</div>
<?php
get_footer();
