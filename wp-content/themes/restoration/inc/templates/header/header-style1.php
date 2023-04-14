<?php
/**
 * Header Template
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

$header_fullwidth = thb_customizer( 'header_fullwidth' );
$header_class[]   = 'header';
$header_class[]   = 'thb-main-header';
$header_class[]   = thb_customizer( 'fixed_header_shadow' );

if ( $header_fullwidth ) {
	$header_class[] = 'header-full-width';
}
?>
<div class="header-wrapper">
	<header class="<?php echo esc_attr( implode( ' ', $header_class ) ); ?>">
		<div class="header-logo-row">
			<div class="row align-middle">
				<div class="small-3 large-4 columns">
					<?php do_action( 'thb_mobile_toggle' ); ?>
					<div class="thb-navbar">
						<?php get_template_part( 'inc/templates/header/full-menu' ); ?>
					</div>
				</div>
				<div class="small-6 large-4 columns">
					<?php do_action( 'thb_logo' ); ?>
				</div>
				<div class="small-3 large-4 columns">
					<?php do_action( 'thb_secondary_area' ); ?>
				</div>
			</div>
		</div>
		<div class="thb-header-inline-search">
			<div class="thb-header-inline-search-inner">
				<?php
				if ( ! thb_wc_supported() ) {
					get_search_form();
				} else {
					wc_get_template( 'product-searchform.php' );
				}
				?>
			</div>
		</div>
	</header>
</div>
