<?php
/**
 * Sharing Functions
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

function thb_remove_share() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
	if ( class_exists( 'Jetpack_Likes' ) ) {
			remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}
add_action( 'loop_start', 'thb_remove_share' );


/* Article Sharing Buttons - Top */
function thb_article_share_top() {
	?>
	<div class="thb-fixed-shares-container">
		<div class="thb-social-top thb-fixed">
			<?php
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
			?>
		</div>
	</div>
	<?php
}
add_action( 'thb_article_fixed', 'thb_article_share_top' );
