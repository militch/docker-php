<?php
/**
 * Enqueue / dequeue assets
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

// De-register Contact Form 7 styles.
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Main Styles.
function thb_main_styles() {
	global $post;
	$thb_theme_directory_uri = Thb_Theme_Admin::$thb_theme_directory_uri;
	$thb_theme_version       = Thb_Theme_Admin::$thb_theme_version;

	// Enqueue.
	wp_enqueue_style( 'thb-app', esc_url( get_theme_file_uri( 'assets/css/app.css' ) ), null, esc_attr( $thb_theme_version ) );

	if ( ! defined( 'THB_DEMO_SITE' ) ) {
		wp_enqueue_style( 'thb-style', get_stylesheet_uri(), null, esc_attr( $thb_theme_version ) );
	}
	wp_add_inline_style( 'thb-app', thb_selection() );

	if ( $post ) {
		if ( has_shortcode( $post->post_content, 'contact-form-7' ) && function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}
	}

}
add_action( 'wp_enqueue_scripts', 'thb_main_styles' );

// Main Scripts.
function thb_register_js() {
	if ( ! is_admin() ) {
		global $post;
		$thb_dependency          = array( 'jquery', 'underscore' );
		$thb_theme_directory_uri = Thb_Theme_Admin::$thb_theme_directory_uri;
		$thb_theme_version       = Thb_Theme_Admin::$thb_theme_version;
		// Register.
		if ( ! defined( 'SCRIPT_DEBUG' ) ) {
			wp_enqueue_script( 'thb-vendor', esc_url( get_theme_file_uri( 'assets/js/vendor.min.js' ) ), array( 'jquery' ), esc_attr( $thb_theme_version ), true );
			$thb_dependency[] = 'thb-vendor';
		} else {
			$thb_js_libraries = array(
				'GSAP'                => '_0gsap.min.js',
				'GSAP-ScrollToPlugin' => '_1ScrollToPlugin.min.js',
				'headroom'            => 'headroom.min.js',
				'jquery-headroom'     => 'jquery.headroom.js',
				'jquery-hoverIntent'  => 'jquery.hoverIntent.js',
				'magnific-popup'      => 'jquery.magnific-popup.min.js',
				'slick'               => 'slick.min.js',
			);
			foreach ( $thb_js_libraries as $handle => $value ) {
				wp_enqueue_script( $handle, esc_url( get_theme_file_uri( 'assets/js/vendor/' . esc_attr( $value ) ) ), array( 'jquery' ), esc_attr( $thb_theme_version ), true );
			}
		}

		wp_enqueue_script( 'thb-app', esc_url( get_theme_file_uri( 'assets/js/app.min.js' ) ), $thb_dependency, esc_attr( $thb_theme_version ), true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( $post ) {
			if ( has_shortcode( $post->post_content, 'contact-form-7' ) && function_exists( 'wpcf7_enqueue_scripts' ) ) {
				wpcf7_enqueue_scripts();
			}
		}

		wp_localize_script(
			'thb-app',
			'themeajax',
			array(
				'url'      => admin_url( 'admin-ajax.php' ),
				'l10n'     => array(
					/* translators: %curr%: current index */
					'of'               => esc_html__( '%curr% of %total%', 'restoration' ),
					'just_of'          => esc_html__( 'of', 'restoration' ),
					'loading'          => esc_html__( 'Loading', 'restoration' ),
					'lightbox_loading' => esc_html__( 'Loading...', 'restoration' ),
					'nomore'           => esc_html__( 'No More Posts', 'restoration' ),
					'nomore_products'  => esc_html__( 'All Products Loaded', 'restoration' ),
					'loadmore'         => esc_html__( 'Load More', 'restoration' ),
					'adding_to_cart'   => esc_html__( 'Adding to Cart', 'restoration' ),
					'added_to_cart'    => esc_html__( 'Added To Cart', 'restoration' ),
					'has_been_added'   => esc_html__( 'has been added to your cart.', 'restoration' ),
					'prev'             => esc_html__( 'Prev', 'restoration' ),
					'next'             => esc_html__( 'Next', 'restoration' ),
				),
				'svg'      => array(
					'prev_arrow'  => thb_load_template_part( 'assets/img/svg/prev_arrow.svg' ),
					'next_arrow'  => thb_load_template_part( 'assets/img/svg/next_arrow.svg' ),
					'close_arrow' => thb_load_template_part( 'assets/svg/arrows_remove.svg' ),
				),
				'settings' => array(
					'site_url'    => get_home_url(),
					'current_url' => get_permalink(),
					'cart_url'    => thb_wc_supported() ? wc_get_cart_url() : false,
					'is_cart'     => thb_wc_supported() ? is_cart() : false,
					'is_checkout' => thb_wc_supported() ? is_checkout() : false,
				),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'thb_register_js' );

// WooCommerce Remove Unnecessary Files.
add_action(
	'init',
	function() {
		remove_action( 'wp_head', 'wc_gallery_noscript' );
	}
);
function thb_woocommerce_scripts_styles() {
	if ( ! is_admin() ) {
		if ( thb_wc_supported() ) {
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_deregister_style( 'woocommerce_prettyPhoto_css' );

			wp_dequeue_style( 'yith-wcwl-font-awesome' );
			wp_deregister_style( 'yith-wcwl-font-awesome' );

			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );

			wp_dequeue_style( 'jquery-selectBox' );
			wp_dequeue_script( 'jquery-selectBox' );

			if ( ! class_exists( 'WC_Checkout_Add_Ons_Loader' ) ) {
				wp_dequeue_style( 'selectWoo' );
				wp_deregister_style( 'selectWoo' );
				wp_dequeue_script( 'selectWoo' );
				wp_deregister_script( 'selectWoo' );
			}

			if ( ! is_checkout() ) {
				wp_dequeue_script( 'jquery-selectBox' );
				wp_dequeue_style( 'selectWoo' );
				wp_dequeue_script( 'selectWoo' );
			}
		}
	}
}

add_action( 'wp_enqueue_scripts', 'thb_woocommerce_scripts_styles', 10001 );
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

function thb_yith_wcwl_main_script_deps() {
	return array( 'jquery' );
}
add_filter( 'yith_wcwl_main_script_deps', 'thb_yith_wcwl_main_script_deps' );
