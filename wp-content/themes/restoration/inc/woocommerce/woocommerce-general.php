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

// Product Layout Sizes.
function thb_get_product_size( $style = 'style2', $i = 0 ) {
	$size = '';
	if ( 'style2' === $style ) {
		$i = in_array( $i, array( '3', '4', '5', '6', '10', '11', '12', '13', '17', '18', '19', '20', '24', '25', '26', '27', '31', '32', '33', '34' ), true ) ? 1 : 2;
		switch ( $i ) {
			case 1:
				$size = 'large-3';
				break;
			case 2:
				$size = 'large-4';
				break;
		}
	} elseif ( 'style3' === $style ) {
		$i = in_array( $i, array( '4', '5', '6', '7', '8', '13', '14', '15', '16', '17', '22', '23', '24', '25', '26', '31', '32', '33', '34', '35' ), true ) ? 1 : 2;
		switch ( $i ) {
			case 1:
				$size = 'thb-5';
				break;
			case 2:
				$size = 'large-3';
				break;
		}
	} elseif ( 'style4' === $style ) {
		$i = in_array( $i, array( '5', '6', '7', '8', '9', '10', '16', '17', '18', '19', '20', '21', '27', '28', '29', '30', '31', '32' ), true ) ? 1 : 2;
		switch ( $i ) {
			case 1:
				$size = 'large-2';
				break;
			case 2:
				$size = 'thb-5';
				break;
		}
	} elseif ( 'style5' === $style ) {
		$i = in_array( $i, array( '0', '1', '2', '3', '7', '8', '9', '10', '14', '15', '16', '17', '21', '22', '23', '24', '28', '29', '30', '31' ), true ) ? 1 : 2;
		switch ( $i ) {
			case 2:
				$size = 'large-4';
				break;
			case 1:
				$size = 'large-3';
				break;
		}
	} elseif ( 'style6' === $style ) {
		$i = in_array( $i, array( '5', '6', '7', '8', '14', '15', '16', '17', '23', '24', '25', '26', '32', '33', '34', '35' ), true ) ? 1 : 2;
		switch ( $i ) {
			case 2:
				$size = 'thb-5';
				break;
			case 1:
				$size = 'large-3';
				break;
		}
	} elseif ( 'style7' === $style ) {
		$i = in_array( $i, array( '6', '7', '8', '9', '10', '17', '18', '19', '20', '21', '28', '29', '30', '31', '32', '39', '40', '41', '42', '43' ), true ) ? 1 : 2;
		switch ( $i ) {
			case 2:
				$size = 'large-2';
				break;
			case 1:
				$size = 'thb-5';
				break;
		}
	} elseif ( 'style8' === $style ) {
		$i = in_array( $i, array( '8', '9', '10', '19', '20', '21', '30', '31', '32' ), true ) ? 1 : 2;
		switch ( $i ) {
			case 1:
				$size = 'large-4';
				break;
			case 2:
				$size = 'large-3';
				break;
		}
	}
	return $size;
}
// Pagination.
function thb_woocommerce_pagination_args( $defaults ) {
	$defaults['type']      = 'plain';
	$defaults['prev_text'] = esc_html__( 'Prev', 'restoration' );
	$defaults['next_text'] = esc_html__( 'Next', 'restoration' );

	return $defaults;
}
add_filter( 'woocommerce_pagination_args', 'thb_woocommerce_pagination_args' );

// Remove Hooks.
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

// Add Custom Notice wrapper.
add_action( 'thb_after_main', 'thb_custom_notice', 10 );
function thb_custom_notice() {
	?>
	<div class="thb-woocommerce-notices-wrapper"></div>
	<?php
}

// Add Title with Link.
function thb_template_loop_product_title() {
	global $product;
	$product_url = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
	?>
	<h2 class="<?php echo esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ); ?>"><a href="<?php echo esc_url( $product_url ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	<?php
}
add_action( 'woocommerce_shop_loop_item_title', 'thb_template_loop_product_title', 10 );

// Remove Rating Text
function thb_template_loop_product_rating( $html, $rating, $count ) {
	$html = '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"></span>';
	return $html;
}
add_filter( 'woocommerce_get_star_rating_html', 'thb_template_loop_product_rating', 5, 3 );


// Add to Cart Styles
add_action( 'before_woocommerce_init', 'thb_different_add_to_cart', 15 );

function thb_different_add_to_cart() {
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

		add_action( 'thb_template_loop_price', 'woocommerce_template_loop_price' );
		add_action( 'thb_template_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart' );
		add_action(
			'woocommerce_after_shop_loop_item_title',
			function() {
				?>
			<div class="thb_transform_price">
				<div class="thb_transform_loop_price">
					<?php do_action( 'thb_template_loop_price' ); ?>
				</div>
				<div class="thb_transform_loop_buttons">
					<?php do_action( 'thb_template_loop_add_to_cart' ); ?>
				</div>
			</div>
				<?php
			},
			4
		);
};

// Breadcrumb Delimiter.
function thb_change_breadcrumb_delimiter( $defaults ) {
	$defaults['delimiter'] = ' <i>/</i> ';
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'thb_change_breadcrumb_delimiter' );
