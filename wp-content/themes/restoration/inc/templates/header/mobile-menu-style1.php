<?php
/**
 * Mobile Menu Template
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

$class[] = 'style1';
$class[] = 'side-panel';
?>
<!-- Start Mobile Menu -->
<nav id="mobile-menu" class="<?php echo esc_attr( implode( ' ', $class ) ); ?>" data-behaviour="thb-default">
	<header class="side-panel-header">
		<span><?php esc_html_e( 'Menu', 'restoration' ); ?></span>
		<div class="thb-mobile-close thb-close" title="<?php esc_attr_e( 'Close', 'restoration' ); ?>"><?php get_template_part( 'assets/img/svg/close.svg' ); ?></div>
	</header>
	<div class="side-panel-inner">

		<div class="mobile-menu-top">
			<?php
			$mobile_menu_search = thb_customizer( 'mobile_menu_search', 1 );
			if ( $mobile_menu_search ) {
				if ( ! thb_wc_supported() ) {
					get_search_form();
				} else {
					wc_get_template(
						'product-searchform.php',
						array(
							'thb_categories' => false,
							'index'          => 999,
						)
					);
				}
			}
			?>
			<?php
			if ( has_nav_menu( 'nav-menu' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'nav-menu',
						'depth'          => 4,
						'container'      => false,
						'menu_class'     => 'thb-mobile-menu',
						'walker'         => new Thb_MobileDropdown(),
					)
				);
			}
			do_action( 'thb_secondary_menu', true );
			?>
			<?php dynamic_sidebar( 'mobile-menu' ); ?>
		</div>
		<div class="mobile-menu-bottom">
			<?php
			$mobile_menu_footer = thb_customizer( 'mobile_menu_footer' );
			if ( $mobile_menu_footer ) {
				?>
				<div class="menu-footer">
					<?php echo do_shortcode( $mobile_menu_footer ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</nav>
<!-- End Mobile Menu -->
