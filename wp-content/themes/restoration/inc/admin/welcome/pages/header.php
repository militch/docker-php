<?php
/**
 * Fuel Themes Admin Header
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

?>

<h1>Welcome to <strong><?php echo esc_html( Thb_Theme_Admin::$thb_theme_name ); ?></strong></h1>
<p class="about-text welcome-text">
	<?php echo esc_html( Thb_Theme_Admin::$thb_theme_name ); ?> is now installed and ready to use with your WordPress site. Please install required plugins before importing the demo content.
</p>
<p class="wp-badge wp-thb-badge">
	Version: <?php echo esc_html( Thb_Theme_Admin::$thb_theme_version ); ?></p>
<?php
get_template_part( '/inc/admin/welcome/pages/tabs' );
