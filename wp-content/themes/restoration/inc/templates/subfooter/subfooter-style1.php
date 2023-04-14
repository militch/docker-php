<?php
/**
 * Sub-Footer
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

	$subfooter_classes[] = 'subfooter';
	$subfooter_classes[] = 'style1';
?>
<!-- Start subfooter -->
<div class="<?php echo esc_attr( implode( ' ', $subfooter_classes ) ); ?>">
	<div class="row subfooter-row align-middle">
		<div class="small-12 medium-6 columns text-center medium-text-left">
			<?php
				echo wp_kses_post( thb_customizer( 'copyright_text' ) );
			?>
		</div>
		<div class="small-12 medium-6 columns text-center medium-text-right">
			<?php do_action( 'thb_payment_icons' ); ?>
		</div>
	</div>
</div>
<!-- End Subfooter -->
