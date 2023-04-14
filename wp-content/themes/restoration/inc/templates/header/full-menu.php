<?php
/**
 * Full Menu
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

?>
<nav class="full-menu">
	<?php
	if ( has_nav_menu( 'nav-menu' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'nav-menu',
				'depth'          => 4,
				'container'      => false,
				'menu_class'     => 'thb-full-menu',
			)
		);
	}
	?>
</nav>
