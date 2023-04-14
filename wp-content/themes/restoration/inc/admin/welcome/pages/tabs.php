<?php
/**
 * Fuel Themes Admin Tabs
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

$thb_links = array(
	'thb-product-registration' => 'Welcome',
	'thb-demo-import'          => 'Demo Content Import',
	'customizer'               => 'Theme Options',
);

?>
<h2 class="nav-tab-wrapper wp-clearfix">
<?php
$get_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
foreach ( $thb_links as $thb_link_id => $thb_title ) {
	$tab_url = admin_url( 'admin.php?page=' . $thb_link_id );

	if ( 'customizer' === $thb_link_id ) {
		$tab_url = admin_url( 'customize.php?autofocus[panel]=restoration' );
	}
	?>
	<a href="<?php echo esc_url( $tab_url ); ?>" class="nav-tab
						<?php
						if ( $thb_link_id === $get_page ) {
							echo ' nav-tab-active'; }
						?>
	">
		<?php echo esc_attr( $thb_title ); ?>
	</a>
	<?php
}
?>
</h2>
