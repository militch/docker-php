<?php
/**
 * WooCommerce misc functions
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

if ( ! thb_wc_supported() ) {
	return;
}

// Wishlist.
function thb_wishlist_button( $singular = false ) {
	if ( class_exists( 'YITH_WCWL' ) ) {

		global $product;
		$url               = YITH_WCWL()->get_wishlist_url();
		$product_type      = $product->get_type();
		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

		if ( ! empty( $default_wishlists ) ) {
			$default_wishlist = $default_wishlists[0]['ID'];
		} else {
			$default_wishlist = false;
		}

		$exists  = YITH_WCWL()->is_product_in_wishlist( $product->get_id(), $default_wishlist );
		$classes = 'yes' === get_option( 'yith_wcwl_use_button' ) ? 'add_to_wishlist single_add_to_wishlist button alt' : 'add_to_wishlist';

		?>
		<div class="
		<?php
		if ( ! $singular ) {
			?>
			thb-product-icon<?php } ?> yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr( $product->get_id() ); ?> <?php echo esc_attr( $exists ? 'exists' : '' ); ?>">
			<div class="yith-wcwl-add-button" style="display: <?php echo esc_attr( $exists ? 'none' : 'block' ); ?>">
				<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product->get_id() ) ); ?>"
					data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"
					data-product-type="<?php echo esc_attr( $product_type ); ?>"
					class="<?php echo esc_attr( $classes ); ?>">
					<span class="
					<?php
					if ( ! $singular ) {
						?>
						thb-icon-<?php } ?>text"><?php echo esc_html__( 'Add To Wishlist', 'restoration' ); ?></span><i class="thb-icon-favorite"></i>
				</a>
			</div>
			<div class="yith-wcwl-wishlistexistsbrowse">
				<a href="<?php echo esc_url( $url ); ?>">
					<span class="
					<?php
					if ( ! $singular ) {
						?>
						thb-icon-<?php } ?>text"><?php echo esc_html__( 'View Wishlist', 'restoration' ); ?></span><i class="thb-icon-heart"></i>
				</a>
			</div>
		</div>
		<?php
	}
}
add_action( 'thb_loop_after_product_image', 'thb_wishlist_button', 38, 1 );

// Wishlist Counts.
function thb_update_wishlist_count() {
	if ( class_exists( 'YITH_WCWL' ) ) {
		wp_send_json( YITH_WCWL()->count_products() );
	}
}
add_action( 'wp_ajax_thb_update_wishlist_count', 'thb_update_wishlist_count' );
add_action( 'wp_ajax_nopriv_thb_update_wishlist_count', 'thb_update_wishlist_count' );

// Mini Cart Buttons.
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );

add_action( 'woocommerce_widget_shopping_cart_buttons', 'thb_woocommerce_widget_shopping_cart_button_view_cart', 10 );
function thb_woocommerce_widget_shopping_cart_button_view_cart() {
	echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button style2">' . esc_html__( 'View cart', 'restoration' ) . '</a>';
}
