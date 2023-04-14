<?php
/**
 * Fuel Themes Admin Demo Import
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */
?>

<div class="wrap about-wrap thb_welcome thb_product_registration">
	<?php get_template_part( '/inc/admin/welcome/pages/header' ); ?>
</div>
<main id="thb-adm-popup">
	<div class="thb-popup-box">
		<span class="thb-popup-close">
			<span class="dashicons dashicons-no"></span>
		</span>
		<figure>
			<img src="" alt="Fuel Themes">
			<div class="thb-import-loading">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
					<path fill="#fff" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z" transform="rotate(219.617 25 25)">
						<animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"></animateTransform>
					</path>
				</svg>
				<div class="thb-loading-text"><?php esc_html_e( 'Page will refresh after the import is done.', 'restoration' ); ?></div>
			</div>
		</figure>
		<h3><?php esc_html_e( 'Import Content', 'restoration' ); ?></h3>
		<p><?php esc_html_e( 'You can select import data type you want.', 'restoration' ); ?></p>
		<form action="" method="post">
			<div class="thb-check-line">
				<div>
					<div>
						<input type="checkbox" name="ty-contents" id="ty-contents" class="child-opened thb-checked" checked>
						<label for="ty-contents"><?php esc_html_e( 'Contents', 'restoration' ); ?></label>
					</div>
					<div class="child-check done">
						<input type="checkbox" name="ty-contents-media" id="ty-contents-media" class="thb-checked" checked>
						<label for="ty-contents-media"><?php esc_html_e( 'Media Files (Thumbnail images, etc.)', 'restoration' ); ?></label>
					</div>
				</div>
				<div>
					<input type="checkbox" name="ty-customizer" id="ty-customizer" class="thb-checked" checked>
					<label for="ty-customizer"><?php esc_html_e( 'Theme Options', 'restoration' ); ?></label>
				</div>
				<div>
					<input type="checkbox" name="ty-widgets" id="ty-widgets" class="thb-checked" checked>
					<label for="ty-widgets"><?php esc_html_e( 'Widgets', 'restoration' ); ?></label>
				</div>
			</div>
			<button type="submit" class="button button-primary"><?php esc_html_e( 'Import Selected', 'restoration' ); ?></button>
		</form>
	</div>
</main>
<div class="wrap about-wrap">
	<div class="theme-browser thb-demo-import thb-content">
		<?php
		do_action( 'thb_demo_import_page' );

		$demos = thb_theme_admin()->thb_demos();
		$i     = 0;
		foreach ( $demos as $demo ) {
			?>
				<div class="theme
				<?php
				if ( ( $i + 1 ) % 3 === 0 ) {
					?>
					last<?php } ?>">
					<div class="theme-screenshot"><img src="<?php echo esc_attr( $demo['import_image'] ); ?>" /></div>
					<h2 class="theme-name" id=""><?php echo esc_attr( $demo['import_file_name'] ); ?></h2>
					<div class="theme-actions">
						<span class="button button-primary import-opts-btn" data-demo="<?php echo esc_attr( $i++ ); ?>">Import Options</span>
						<a class="button" href="<?php echo esc_attr( $demo['import_demo_url'] ); ?>" target="_blank"><i class="dashicons-before dashicons-share-alt2"></i></a>
					</div>
				</div>
			<?php
		}
		?>
	</div>
</div>
