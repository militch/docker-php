<?php
/**
 * Blog Post Style
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

$classes[] = 'post';

$thb_date    = thb_customizer( 'post_meta_date', 1 );
$thb_excerpt = thb_customizer( 'post_meta_excerpt', 1 );
$thb_cat     = thb_customizer( 'post_meta_cat', 1 );

add_filter( 'excerpt_length', 'thb_short_excerpt_length' );
?>
<div class="small-12 medium-6 columns">
	<div <?php post_class( $classes ); ?>>
		<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( 'restoration-rectangle-x2' ); ?>
				</a>
				<?php if ( $thb_cat ) { ?>
					<?php do_action( 'thb_categories' ); ?>
				<?php } ?>
			</figure>
		<?php } ?>
		<?php if ( $thb_date ) { ?>
			<aside class="thb-post-bottom">
				<div class="post-date"><?php echo get_the_date(); ?></div>
			</aside>
		<?php } ?>
		<div class="post-title"><h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span><?php the_title(); ?></span></a></h3></div>
		<?php if ( $thb_excerpt ) { ?>
			<div class="post-excerpt">
				<?php the_excerpt(); ?>
			</div>
		<?php } ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="thb-read-more"><?php esc_html_e( 'Read More', 'restoration' ); ?> <?php get_template_part( 'assets/img/svg/next_arrow.svg' ); ?></a>
	</div>
</div>
