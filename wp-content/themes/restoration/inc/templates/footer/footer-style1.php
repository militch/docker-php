<?php
/**
 * Footer template
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

?>

<footer id="footer" class="footer">
	<div class="row footer-row">
		<?php
		if ( ! class_exists( 'Kirki' ) ) {
			?>
			<div class="small-12 text-center"><a href="https://wordpress.org/plugins/kirki/" target="_blank"><?php esc_html_e( 'Please Install Kirki Customizer Framework to access Footer Options inside Appearance > Customize', 'restoration' ); ?></a></div>
			<?php
		} else {
			do_action( 'thb_footer_columns' );
		}
		?>
	</div>
</footer>
