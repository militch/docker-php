<?php
/**
 * WooCommerce Category related functions
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

if ( ! thb_wc_supported() ) {
	return;
}
/* Change Category Thumbnail Size */
function thb_template_loop_category_link_open( $category ) {
	echo '<a href="' . esc_url( get_term_link( $category, 'product_cat' ) ) . '" class="thb-category-link">';
}
remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
add_action( 'woocommerce_before_subcategory', 'thb_template_loop_category_link_open', 10 );
