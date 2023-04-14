<?php
/**
 * Post Navigation
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

if ( ! thb_customizer( 'article_nav', 1 ) ) {
	return;
}

$prev_post = get_adjacent_post( false, '', true );
$next_post = get_adjacent_post( false, '', false );
if ( empty( $prev_post ) && empty( $next_post ) ) {
	return;
}
?>
<aside class="thb-article-nav">
	<?php if ( ! empty( $prev_post ) ) { ?>
		<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="thb-article-nav-post previous">
			<span class="thb-article-nav-text"><?php esc_html_e( 'Previous', 'restoration' ); ?></span>
			<strong><?php echo esc_html( $prev_post->post_title ); ?></strong>
		</a>
	<?php } ?>
	<?php if ( ! empty( $next_post ) ) { ?>
		<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="thb-article-nav-post next">
			<span class="thb-article-nav-text"><?php esc_html_e( 'Next', 'restoration' ); ?></span>
			<strong><?php echo esc_html( $next_post->post_title ); ?></strong>
		</a>
	<?php } ?>
</aside>
