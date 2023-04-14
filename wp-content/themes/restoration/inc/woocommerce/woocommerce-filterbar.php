<?php
/**
 * WooCommerce Filter bar functions
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */


if ( ! thb_wc_supported() ) {
	return;
}
// Off-Canvas Filters.
function thb_shop_filters() {
	if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
		?>
		<div id="side-filters" class="side-panel thb-side-filters">
			<header class="side-panel-header">
				<span><?php esc_html_e( 'Filter', 'restoration' ); ?></span>
				<div class="thb-close" title="<?php esc_attr_e( 'Close', 'restoration' ); ?>"><?php get_template_part( 'assets/img/svg/close.svg' ); ?></div>
			</header>
			<div class="side-panel-content custom_scroll">
				<?php
				if ( is_active_sidebar( 'thb-shop-filters' ) ) {
					dynamic_sidebar( 'thb-shop-filters' );
				}
				?>
			</div>
		</div>
		<?php
	}
}
add_action( 'thb_shop_filters', 'thb_shop_filters' );

// Remove/Add Breadcrumbs.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

function thb_wc_breadcrumbs() {
	$classes[] = 'thb-woocommerce-header';
	if ( ! is_product() ) {
		$classes[] = 'style1';
		$classes[] = 'light';
	}
	?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="row">
			<div class="small-12 columns">
				<div class="thb-breadcrumb-bar">
					<?php woocommerce_breadcrumb(); ?>
					<?php if ( is_product() ) { ?>
						<?php do_action( 'thb_product_navigation' ); ?>
					<?php } ?>
				</div>
				<?php if ( ! is_product() ) { ?>
					<div class="thb-woocommerce-header-title">
						<h1 class="thb-shop-title"><?php woocommerce_page_title(); ?></h1>
						<?php
						/**
						 * Hook: woocommerce_archive_description.
						 *
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );

						?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_before_main_content', 'thb_wc_breadcrumbs', 0 );

function thb_shop_description() {
	if ( ! is_product_category() && ! is_product_tag() ) {
		if ( thb_customizer( 'shop_description' ) ) {
			echo '<div class="term-description"><p>' . wp_kses_post( thb_customizer( 'shop_description' ) ) . '</p></div>';
		}
	}
}
add_action( 'woocommerce_archive_description', 'thb_shop_description', 10 );

function thb_filter_bar() {
	if ( is_product() ) {
		return;
	}

	$classes[] = 'thb-filter-bar';
	$classes[] = 'style1';
	?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="row align-middle">
			<div class="small-6 medium-3 large-6 columns">
				<a href="#" id="thb-shop-filters"><?php get_template_part( 'assets/img/svg/filter.svg' ); ?> <?php esc_html_e( 'Filter', 'restoration' ); ?></a>
			</div>
			<div class="small-6 medium-9 large-6 columns text-right">
				<?php do_action( 'thb_filter_bar_right' ); ?>
				<?php woocommerce_catalog_ordering(); ?>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_before_shop_loop', 'thb_filter_bar', 10 );
