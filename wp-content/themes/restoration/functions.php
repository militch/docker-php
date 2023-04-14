<?php
/**
 * Theme functions and definitions
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

// Theme Admin.
require get_theme_file_path( '/inc/admin/welcome/class-thb-theme-admin.php' );

// Imports.
require get_theme_file_path( '/inc/admin/imports/import.php' );

// Kirki Customizer.
require get_theme_file_path( '/inc/framework/kirki/init.php' );

// Script Calls.
require get_theme_file_path( '/inc/script-calls.php' );

// Misc.
require get_theme_file_path( '/inc/misc.php' );

// Header Related.
require get_theme_file_path( '/inc/header-related.php' );

// Breadcrumbs.
require get_theme_file_path( '/inc/framework/thb-breadcrumbs.php' );

// Sharing.
require get_theme_file_path( '/inc/framework/thb-post-social.php' );

// Sharing.
require get_theme_file_path( '/inc/post-related.php' );

// Add Menu Support.
require get_theme_file_path( '/inc/class-thb-mobiledropdown.php' );

// Gutenberg Blocks.
require get_theme_file_path( '/inc/gutenberg/classes/class-api.php' );
require get_theme_file_path( '/inc/gutenberg/classes/class-products.php' );
require get_theme_file_path( '/inc/gutenberg/classes/class-categories.php' );
require get_theme_file_path( '/inc/gutenberg/classes/class-category-list.php' );
require get_theme_file_path( '/inc/gutenberg/classes/class-product-list.php' );
new Asquared\Api();
require get_theme_file_path( '/inc/gutenberg/src/init.php' );
require get_theme_file_path( '/inc/gutenberg-patterns.php' );

// CSS Output of Theme Options.
require get_theme_file_path( '/inc/selection.php' );

// WooCommerce.
require get_theme_file_path( '/inc/woocommerce/woocommerce-misc.php' );
require get_theme_file_path( '/inc/woocommerce/woocommerce-general.php' );
require get_theme_file_path( '/inc/woocommerce/woocommerce-filterbar.php' );
require get_theme_file_path( '/inc/woocommerce/woocommerce-single.php' );
require get_theme_file_path( '/inc/woocommerce/woocommerce-single-category.php' );
require get_theme_file_path( '/inc/woocommerce/woocommerce-cart.php' );
require get_theme_file_path( '/inc/woocommerce/woocommerce-checkout.php' );
require get_theme_file_path( '/inc/woocommerce/woocommerce-product-data-tabs.php' );
require get_theme_file_path( '/inc/woocommerce/woocommerce-gutenberg.php' );
require get_theme_file_path( '/inc/woocommerce/woocommerce-shop.php' );

// Footer Related.
require get_theme_file_path( '/inc/footer-related.php' );
