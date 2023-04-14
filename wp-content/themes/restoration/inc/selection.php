<?php
/**
 * Theme Options Output
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

/**
 * Outputs theme options css
 */
function thb_selection() {
	$logo_height        = thb_customizer( 'logo_height' );
	$logo_height_mobile = thb_customizer( 'logo_height_mobile' );

	ob_start();
	?>
	<?php if ( $logo_height ) { ?>
		.logo-holder .logolink .logoimg {
			max-height: <?php echo esc_html( $logo_height ); ?>;
		}
		.logo-holder .logolink .logoimg[src$=".svg"] {
			max-height: 100%;
			height: <?php echo esc_html( $logo_height ); ?>;
		}
	<?php } ?>
	<?php if ( $logo_height_mobile ) { ?>
		@media screen and (max-width: 1023px) {
			.header .logo-holder .logolink .logoimg {
				max-height: <?php echo esc_html( $logo_height_mobile ); ?>;
			}
			.header .logo-holder .logolink .logoimg[src$=".svg"] {
				max-height: 100%;
				height: <?php echo esc_html( $logo_height_mobile ); ?>;
			}
		}
	<?php } ?>

	<?php
	$out = ob_get_clean();
	// Remove comments.
	$out = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out );
	// Remove space after colons.
	$out = str_replace( ': ', ':', $out );
	// Remove whitespace.
	$out = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $out );

	return $out;
}
