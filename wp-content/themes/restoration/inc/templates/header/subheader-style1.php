<?php
/**
 * Global Notification
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

$global_notification = thb_customizer( 'subheader' );

if ( ! $global_notification ) {
	return;
}
?>
<aside class="subheader dark">
	<div class="row">
		<div class="small-12 columns">
			<?php echo do_shortcode( thb_customizer( 'subheader_content' ) ); ?>
		</div>
	</div>
</aside>
