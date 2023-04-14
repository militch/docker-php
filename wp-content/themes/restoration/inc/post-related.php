<?php
/**
 * Post related functions
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

// Post Categories.
function thb_categories( $article = false ) {
	if ( has_category() ) {
		$separator = $article ? ', ' : ' ';
		?>
		<div class="post-category">
			<?php if ( $article ) { ?>
				<em><?php esc_html_e( 'in', 'restoration' ); ?></em>
			<?php } ?>
			<?php the_category( $separator ); ?>
		</div>
		<?php
	}
}
add_action( 'thb_categories', 'thb_categories', 10, 1 );

// Article Title After.
function thb_article_after_h1() {
	?>
	<aside class="thb-article-meta">

		<?php if ( thb_customizer( 'article_author_name', 1 ) ) { ?>

			<div class="post-author">
				<em><?php esc_html_e( 'by', 'restoration' ); ?></em>
				<?php the_author_posts_link(); ?>
			</div>
		<?php } ?>
		<?php if ( thb_customizer( 'article_date', 1 ) ) { ?>
			<div class="thb-post-date">
				<em><?php esc_html_e( 'on', 'restoration' ); ?></em>
				<?php echo get_the_date(); ?>
			</div>
		<?php } ?>
		<?php if ( thb_customizer( 'article_cat', 1 ) ) { ?>
			<?php do_action( 'thb_categories', true ); ?>
		<?php } ?>
	</aside>
	<?php
}
add_action( 'thb_article_after_h1', 'thb_article_after_h1', 10 );

// Article End.
function thb_article_end() {
	get_template_part( 'inc/templates/post-detail-bits/post-nav' );
}
add_action( 'thb_article_end', 'thb_article_end' );
