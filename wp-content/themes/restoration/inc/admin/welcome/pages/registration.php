<?php
/**
 * Fuel Themes Admin Registration
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

?>

<?php
	$success = filter_input( INPUT_GET, 'success', FILTER_VALIDATE_BOOLEAN );
?>
<div class="wrap about-wrap thb_welcome thb_product_registration">
	<?php get_template_part( '/inc/admin/welcome/pages/header' ); ?>
</div>
<div class="wrap about-wrap">
	<div class="thb-registration thb-content">
		<div class="postbox">
			<div class="thb-box thb-left">
				<?php if ( $success ) { ?>
					<figure><img src="<?php echo esc_url( Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/congratulations.png' ); ?>" width="282" height="336" alt="Congratulations" class="congrats" /></figure>
					<div>
						<h1><?php esc_html_e( 'Congratulations!', 'restoration' ); ?></h1>
						<p><?php esc_html_e( 'You have succesfully imported your Demo Content. You can now use the Gutenberg editor to start editing your homepage.', 'restoration' ); ?></p>
						<?php
						$home = get_page_by_title( 'Home' );

						if ( $home ) {
							$home_url = get_edit_post_link( $home->ID );
							?>
						<a href="<?php echo esc_url( $home_url ); ?>" class="button button-primary button-hero"><?php esc_html_e( 'Edit your homepage', 'restoration' ); ?></a>
						<?php } ?>
					</div>
				<?php } else { ?>
					<figure><img src="<?php echo esc_url( Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/welcome.jpg' ); ?>" width="330" height="351" alt="Welcome" /></figure>
					<div>
						<h1><?php esc_html_e( 'Thank you!', 'restoration' ); ?></h1>
						<p>Thank you for purchasing Restoration! To begin using your theme, please start by following the below steps:</p>
						<ul>
							<li>Install &amp; activate <a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a> &amp; <a href="https://wordpress.org/plugins/kirki/" target="_blank">Kirki Customizer Framework</a> plugin</li>
							<li><a href="<?php echo esc_url( admin_url( 'admin.php?page=thb-demo-import' ) ); ?>">Install the demo content</a> if you like.</li>
							<li>Customize your theme from <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=restoration' ) ); ?>">Appearance > Customize > Restoration</a></li>
						</ul>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
