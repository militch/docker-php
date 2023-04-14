<?php
/**
 * Utility functions
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */
// Body Classes.
function thb_body_classes( $classes ) {
	$single_product_ajax = thb_customizer( 'single_product_ajax', 1 ) ? 'on' : 'off';
	$classes[]           = 'thb-quantity-style2';
	$classes[]           = 'thb-single-product-ajax-' . $single_product_ajax;
	return $classes;
}
add_filter( 'body_class', 'thb_body_classes' );

// Change max image size.
function thb_max_srcset_image_width( $max_width, $size_array ) {
	$width = $size_array[0];
	return $width;
}
add_filter( 'max_srcset_image_width', 'thb_max_srcset_image_width', 10, 2 );

// Loading Lazy.
function thb_modify_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	return str_replace( '<img', '<img loading="lazy"', $html );
}
// Load Template.
function thb_load_template_part( $template_name ) {
	ob_start();
	get_template_part( $template_name );
	$var = ob_get_clean();
	return $var;
}

// WooCommerce Check.
function thb_wc_supported() {
	return class_exists( 'WooCommerce' );
}
function thb_is_woocommerce() {
	if ( ! thb_wc_supported() ) {
		return false;
	}
	return ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() );
}

/* Excerpts */
function thb_strip_shortcode_from_excerpt( $content ) {
	$content = strip_shortcodes( $content );
	return $content;
}
add_filter( 'the_excerpt', 'thb_strip_shortcode_from_excerpt' );

add_filter( 'excerpt_length', 'thb_default_excerpt_length' );
add_filter( 'excerpt_more', 'thb_default_excerpt_more' );

function thb_default_excerpt_length() {
	return 55;
}
function thb_short_excerpt_length() {
	return 32;
}
function thb_default_excerpt_more() {
	return '&hellip;';
}

/* Archive Sidebar */
function thb_archive_sidebar() {
	if ( is_author() ) {
		dynamic_sidebar( 'author' );
	} elseif ( is_tag() ) {
		dynamic_sidebar( 'tag' );
	} elseif ( is_category() ) {
		$cat_id           = get_queried_object_id();
		$selected_sidebar = get_term_meta( $cat_id, 'thb_cat_sidebar', true );

		if ( '' === $selected_sidebar || ! $selected_sidebar ) {
			dynamic_sidebar( 'category' );
		} else {
			dynamic_sidebar( $selected_sidebar );
		}
	} elseif ( is_search() ) {
		dynamic_sidebar( 'search' );
	} else {
		dynamic_sidebar( 'archive' );
	}
}
add_action( 'thb_archive_sidebar', 'thb_archive_sidebar', 3 );

// Add Lightbox Class.
function thb_image_rel( $content ) {
	$pattern     = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3.$4$5 class="mfp-image"$6>$7</a>';
	$content     = preg_replace( $pattern, $replacement, $content );
	return $content;
}
add_filter( 'the_content', 'thb_image_rel' );

// Custom Password Protect Form.
function thb_password_form() {
	$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	<p class="password-text">' . esc_html__( 'This is a protected area. Please enter your password:', 'restoration' ) . '</p>
	<input name="post_password" type="password" class="box" placeholder="' . esc_html__( 'Password', 'restoration' ) . '"/><input type="submit" name="Submit" class="btn" value="' . esc_attr__( 'Submit', 'restoration' ) . '" /></form>
	';
	return $o;
}
add_filter( 'the_password_form', 'thb_password_form' );

// Add SVG to reply link.
function thb_add_svg_to_reply( $args, $comment, $post ) {
	$args['reply_text'] = thb_load_template_part( 'assets/img/svg/reply.svg' ) . $args['reply_text'];
	return $args;
}

add_filter( 'comment_reply_link_args', 'thb_add_svg_to_reply', 420, 4 );

// Get Breadcrumbs.
function thb_breadcrumbs() {
	?>
	<div class="row">
		<div class="small-12 columns">
			<div class="thb-breadcrumb-bar">
				<?php
				Thb_Breadcrumb_Trail(
					array(
						'show_on_front' => false,
						'show_title'    => true,
						'show_browse'   => false,
					)
				);
				?>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'thb_breadcrumbs', 'thb_breadcrumbs' );

// Archive Title.
function thb_archive_title() {
	if ( is_front_page() ) {
		return;
	}
	?>
	<div class="thb-page-title">
		<?php do_action( 'thb_breadcrumbs' ); ?>
		<div class="row">
			<div class="small-12 columns">
				<div class="page-title">
					<h1>
						<?php
						if ( is_category() ) {
							echo single_cat_title( '', false );

						} elseif ( is_tag() ) {
							echo single_tag_title( '', false );

						} elseif ( is_search() ) {
							/* translators: %s: search term */
							printf( esc_html__( 'Search Results for: %s', 'restoration' ), '<span>' . get_search_query() . '</span>' );

						} elseif ( is_author() ) {
							/* translators: %s: author name */
							printf( esc_html__( 'Author Archives: %s', 'restoration' ), '<span>' . get_the_author() . '</span>' );

						} elseif ( is_day() ) {
							/* translators: %s: day */
							printf( esc_html__( 'Daily Archives: %s', 'restoration' ), '<span>' . get_the_date() . '</span>' );

						} elseif ( is_month() ) {
							/* translators: %s: month */
							printf( esc_html__( 'Monthly Archives: %s', 'restoration' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

						} elseif ( is_year() ) {
							/* translators: %s: year */
							printf( esc_html__( 'Yearly Archives: %s', 'restoration' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

						} elseif ( is_home() ) {
							esc_html_e( 'Latest News', 'restoration' );
						}
						?>
					</h1>
					<?php

					if ( get_the_archive_description() ) {
						echo wp_kses_post( wpautop( get_the_archive_description() ) );
					} elseif ( is_page() ) {
						$thb_id = get_queried_object_id();
						echo wp_kses_post( wpautop( get_the_excerpt( $thb_id ) ) );
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'thb_archive_title', 'thb_archive_title' );

// Translate Columns
function thb_translate_columns( $size ) {
	if ( 6 === $size ) {
		return 'large-2';
	} elseif ( 5 === $size || 'thb-5' === $size ) {
		return 'thb-5';
	} elseif ( 4 === $size ) {
		return 'large-3';
	} elseif ( 3 === $size ) {
		return 'large-4';
	} elseif ( 2 === $size ) {
		return 'large-6';
	}
}

// Page Title.
function thb_page_title() {
	?>
	<div class="thb-page-title">
		<?php do_action( 'thb_breadcrumbs' ); ?>
		<div class="row">
			<div class="small-12 columns">
				<div class="page-title">
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'thb_page_title', 'thb_page_title' );
