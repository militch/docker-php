<?php
/**
 * Post Detail Page
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

?>
<div class="post-detail-row has-article-padding">
	<div class="row">
		<div class="small-12 columns">
			<div class="sidebar-container">
				<div class="sidebar-content-main
				<?php
				if ( ! is_active_sidebar( 'single' ) ) {
					?>
					no-sidebar<?php } ?>">
					<?php do_action( 'thb_before_article' ); ?>
					<article itemscope itemtype="http://schema.org/Article" <?php post_class( 'post post-detail post-detail-style1' ); ?> id="post-<?php the_ID(); ?>">
						<?php do_action( 'thb_article_start' ); ?>
						<div class="post-title-container">
							<header class="post-title entry-header">
								<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
							</header>
							<?php do_action( 'thb_article_after_h1' ); ?>
						</div>
						<?php
						if ( has_post_thumbnail() ) {
							?>
							<div class="thb-article-featured-image">
								<?php the_post_thumbnail( 'restoration-full' ); ?>
							</div>
							<?php
						}
						?>
						<div class="post-share-container">
							<?php do_action( 'thb_article_fixed' ); ?>
							<div class="post-content-container">
								<?php do_action( 'thb_before_content' ); ?>
								<div class="post-content entry-content" itemprop="articleBody">
									<?php the_content(); ?>
								</div>
								<?php do_action( 'thb_after_content' ); ?>
								<?php get_template_part( 'inc/templates/post-detail-bits/post-tags' ); ?>
							</div>
						</div>
						<?php do_action( 'thb_article_end' ); ?>
					</article>
					<?php
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</div>
				<?php if ( is_active_sidebar( 'single' ) ) { ?>
					<aside class="sidebar">
						<?php dynamic_sidebar( 'single' ); ?>
					</aside>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
