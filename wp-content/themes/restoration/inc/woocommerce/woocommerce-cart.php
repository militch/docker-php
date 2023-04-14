<?php
/**
 * WooCommerce Cart related functions
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

if ( ! thb_wc_supported() ) {
	return;
}
function thb_before_cart() {
	echo '<div class="row">';
	echo '<div class="small-12 medium-8 columns thb-cart-column">';
}
add_action( 'woocommerce_before_cart', 'thb_before_cart', 0 );

function thb_before_cart_table() {
	?>
	<h2 class="shop-general-title"><?php esc_html_e( 'Shopping Cart', 'restoration' ); ?></h2>
	<?php
}
add_action( 'woocommerce_before_cart_table', 'thb_before_cart_table', 0 );

function thb_before_collaterals() {
	echo '</div>';
	echo '<div class="small-12 medium-4 columns">';
}
add_action( 'woocommerce_before_cart_collaterals', 'thb_before_collaterals', 10 );

function thb_after_cart() {
	echo '</div>';
	echo '</div>';
}
add_action( 'woocommerce_after_cart', 'thb_after_cart', 0 );

// Move Crosssells.
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_before_cart_collaterals', 'woocommerce_cross_sell_display', 5 );

// Cart Fragments.
function thb_woocomerce_ajax_cart_update( $fragments ) {
	ob_start();
	if ( is_object( WC()->cart ) ) {
		?>
		<span class="count thb-cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
		<?php
	}
	$fragments['.thb-cart-count'] = ob_get_clean();

	ob_start();
	if ( is_object( WC()->cart ) ) {
		?>
		<span class="thb-item-text thb-cart-amount"><?php wc_cart_totals_subtotal_html(); ?></span>
		<?php
	}
	$fragments['.thb-cart-amount'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'thb_woocomerce_ajax_cart_update', 8 );
function thb_header_after_cart() {
	$header_cart_after_text = thb_customizer( 'header_cart_after_text' );
	if ( $header_cart_after_text && '' !== $header_cart_after_text ) {
		?>
		<div class="thb-header-after-cart">
			<?php echo do_shortcode( $header_cart_after_text ); ?>
		</div>
		<?php
	}
}
add_action( 'thb_header_after_cart', 'thb_header_after_cart' );
