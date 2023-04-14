<?php
/**
 * WooCommerce Shop Page related functions
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

// Remove Default Sidebar.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Before Shop page content.
function thb_woocommerce_before_main_content() {
	if ( is_product() ) {
		return;
	}
	?>
	<div class="row">
		<div class="small-12 columns">
			<div class="sidebar-container thb-shop-sidebar-layout sidebar-left">
				<?php if ( is_active_sidebar( 'thb-shop-filters' ) ) { ?>
					<div class="sidebar thb-shop-sidebar">
						<?php
							dynamic_sidebar( 'thb-shop-filters' );
						?>
					</div>
				<?php } ?>
				<div class="sidebar-content-main thb-shop-content">
	<?php
}
add_action( 'woocommerce_before_main_content', 'thb_woocommerce_before_main_content', 5 );

// After Shop page content.
function thb_woocommerce_after_main_content() {
	if ( is_product() ) {
		return;
	}
	?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_after_main_content', 'thb_woocommerce_after_main_content', 99 );
