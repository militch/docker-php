<?php
/**
 * WooCommerce Product detail functions
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

if ( ! thb_wc_supported() ) {
	return;
}
// Move Badges.
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'thb_product_images', 'woocommerce_show_product_sale_flash', 10 );

// Zoom Icon.
function thb_product_zoom() {
	?>
	<a class="woocommerce-product-gallery__trigger thb-product-zoom" title="<?php esc_attr_e( 'Zoom', 'restoration' ); ?>"><span></span></a>
	<?php
}
add_action( 'thb_product_images', 'thb_product_zoom', 10 );

// Video Icon.
function thb_product_video() {
	$thb_product_video = get_post_meta( get_the_ID(), 'thb_product_video', true );

	if ( ! $thb_product_video || '' === $thb_product_video ) {
		return;
	}
	?>
	<a class="thb-product-icon thb-product-video mfp-video" href="<?php echo esc_url( $thb_product_video ); ?>">
		<span class="thb-icon-text on-left"><?php echo esc_html__( 'View Video', 'restoration' ); ?></span>
		<?php get_template_part( 'assets/img/svg/video.svg' ); ?>
	</a>
	<?php
}
add_action( 'thb_product_images', 'thb_product_video', 30 );

// Tab Styles.
add_action(
	'woocommerce_before_single_product',
	function() {
		// Move Rating.
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 8 );

		// Move Tabs.
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 35 );
	},
	15
);

// Product Nav.
function thb_product_navigation() {
	global $post;
	$next_post = get_next_post( true, '', 'product_cat' );
	$prev_post = get_previous_post( true, '', 'product_cat' );
	?>
	<ul class="thb-product-nav">
		<?php if ( $prev_post ) { ?>
			<li class="thb-product-nav-button product-nav-prev">
				<a href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>" rel="prev" class="product-nav-link">
					<i class="thb-icon-left-open-mini"></i>
					<div class="thb-product-nav-text">
						<?php esc_attr_e( 'Previous Product', 'restoration' ); ?>
					</div>
				</a>
			</li>
		<?php } ?>
		<?php if ( $next_post ) { ?>
			<li class="thb-product-nav-button product-nav-next">
				<a href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>" rel="next" class="product-nav-link">
					<div class="thb-product-nav-text">
						<?php esc_attr_e( 'Next Product', 'restoration' ); ?>
					</div>
					<i class="thb-icon-right-open-mini"></i>
				</a>
			</li>
		<?php } ?>
	</ul>
	<?php
}
add_action( 'thb_product_navigation', 'thb_product_navigation' );

// Remove Product Description Heading.
function thb_remove_product_description_heading() {
	return '';
}
add_filter( 'woocommerce_product_description_heading', 'thb_remove_product_description_heading' );


// Remove Additional Product Information Heading.
function thb_remove_product_information_heading() {
	return '';
}
add_filter( 'woocommerce_product_additional_information_heading', 'thb_remove_product_information_heading' );

// Remove Sidebar.
function thb_disable_woo_commerce_sidebar() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}
add_action( 'init', 'thb_disable_woo_commerce_sidebar' );

// Add Wishlist & Sharing.
function thb_product_sharing() {
	if ( wp_doing_ajax() ) {
		return;
	}
	if ( function_exists( 'sharing_display' ) ) {
		?>
		<div class="thb-product-meta-before">
			<div class="thb-share-product">
				<?php sharing_display( '', true ); ?>
			</div>
		</div>
		<?php
	}
}
add_action( 'woocommerce_single_product_summary', 'thb_product_sharing', 38 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// Product Page Ajax Add to Cart.
function thb_woocommerce_single_product() {
	if ( ! thb_customizer( 'single_product_ajax', 1 ) ) {
		return;
	}

	function thb_ajax_add_to_cart_redirect_template() {
		$thb_ajax = filter_input( INPUT_GET, 'thb-ajax-add-to-cart', FILTER_VALIDATE_BOOLEAN );

		if ( $thb_ajax ) {
			wc_get_template( 'ajax/add-to-cart-fragments.php' );
			exit;
		}
	}
	add_action( 'wp', 'thb_ajax_add_to_cart_redirect_template', 1000 );
	function thb_woocommerce_after_add_to_cart_button() {
		global $product;
		?>
			<input type="hidden" name="action" value="wc_prod_ajax_to_cart" />
		<?php
		// Make sure we have the add-to-cart avaiable as button name doesn't submit via ajax.
		if ( $product->is_type( 'simple' ) ) {
			?>
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"/>
			<?php
		}
	}
	add_action( 'woocommerce_after_add_to_cart_button', 'thb_woocommerce_after_add_to_cart_button' );
	function thb_woocommerce_display_site_notice() {
		?>
		<div class="thb_prod_ajax_to_cart_notices"></div>
		<?php
	}
	add_action( 'woocommerce_before_main_content', 'thb_woocommerce_display_site_notice', 10 );
}
add_action( 'before_woocommerce_init', 'thb_woocommerce_single_product' );

function thb_product_gallery_thumbnail_size( $size ) {
	return array(
		'width'  => 160,
		'height' => 192,
		'crop'   => 1,
	);
}
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'thb_product_gallery_thumbnail_size' );
