<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */

// Hook: Block assets.
function thb_woocommerce_category_grid_cgb_block_assets() { // phpcs:ignore
	$thb_theme_directory_uri = Thb_Theme_Admin::$thb_theme_directory_uri;
	$thb_theme_directory     = Thb_Theme_Admin::$thb_theme_directory;
	$thb_theme_version       = Thb_Theme_Admin::$thb_theme_version;

	$block_dependencies = array(
		'wp-compose',
		'wp-blocks',
		'wp-i18n',
		'wp-element',
		'wp-editor',
		'wp-api-fetch',
		'wp-components',
		'wp-data',
		'wp-url',
		'lodash',
	);

	// Register block editor script for backend.
	wp_register_script(
		'thb_block-editor-js', // Handle.
		esc_url( $thb_theme_directory_uri ) . 'inc/gutenberg/dist/blocks.build.js', // Block.build.js: We register the block here. Built with Webpack.
		$block_dependencies, // Dependencies, defined above.
		filemtime( $thb_theme_directory . 'inc/gutenberg/dist/blocks.build.js' ), // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// Register block editor styles for backend.
	wp_register_style(
		'thb_block-editor-css', // Handle.
		esc_url( $thb_theme_directory_uri ) . 'inc/gutenberg/dist/blocks.editor.build.css', // Block editor CSS.
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		filemtime( $thb_theme_directory . 'inc/gutenberg/dist/blocks.editor.build.css' ) // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
	register_block_type(
		'fuel-themes/thb-woocommerce-category-grid',
		array(
			'attributes'      => array(
				'uid'              => array(
					'type'    => 'string',
					'default' => '',
				),
				'is_count_visible' => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'alignment'        => array(
					'type'    => 'string',
					'default' => 'left',
				),
				'thbcolumns'       => array(
					'type'    => 'integer',
					'default' => 5,
				),
				'categories'       => array(
					'type'    => 'array',
					'default' => array(),
					'items'   => array(
						'type' => 'object',
					),
				),
			),
			'editor_script'   => 'thb_block-editor-js',
			'editor_style'    => 'thb_block-editor-css',
			'render_callback' => 'thb_woocommerce_category_grid_render',
		)
	);
	register_block_type(
		'fuel-themes/thb-iconbox',
		array(
			'attributes'      => array(
				'uid'       => array(
					'type'    => 'string',
					'default' => '',
				),
				'title'     => array(
					'type' => 'string',
				),
				'subtitle'  => array(
					'type' => 'string',
				),
				'alignment' => array(
					'type'    => 'string',
					'default' => 'left',
				),
				'image'     => array(
					'type' => 'object',
				),
			),
			'editor_script'   => 'thb_block-editor-js',
			'editor_style'    => 'thb_block-editor-css',
			'render_callback' => 'thb_iconbox_render',
		)
	);
}
add_action( 'init', 'thb_woocommerce_category_grid_cgb_block_assets' );

function thb_woocommerce_category_grid_render( $attributes ) {
	switch ( $attributes['thbcolumns'] ) {
		case '6':
			$col_class = 'small-6 medium-4 large-2';
			break;
		case '5':
			$col_class = 'small-6 medium-4 large-1/5';
			break;
		case '4':
			$col_class = 'small-6 medium-6 medium-3';
			break;
		case '3':
			$col_class = 'small-6 medium-4';
			break;
		case '2':
			$col_class = 'small-6';
			break;
		case '1':
			$col_class = 'small-12';
			break;
	}

	ob_start();

	if ( ! thb_wc_supported() ) {
		esc_html_e( 'Please install & activate WooCommerce', 'restoration' );
		return;
	}
	?>
	<div class="row products thb-product-category-grid">
		<?php
		if ( count( $attributes['categories'] ) < 1 ) {
			?>
				<div class="small-12 columns text-center">
				<?php esc_html_e( 'Please assign WooCommerce categories', 'restoration' ); ?>
				</div>
				<?php
		} else {
			foreach ( $attributes['categories'] as $category ) {
				$term = get_term( $category['term_id'] );
				?>
				<div class="<?php echo esc_attr( $col_class ); ?> columns product-category product">
						<a href="<?php echo esc_url( get_term_link( $term, 'product_cat' ) ); ?>" class="thb-category-link">	<div class="thb-product-category-image">
							<?php woocommerce_subcategory_thumbnail( $term ); ?>
						</div>
						<h2 class="woocommerce-loop-category__title">
						<?php echo esc_html( $category['name'] ); ?>
						<?php
						if ( $attributes['is_count_visible'] ) {
							echo wp_kses_post( apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html( $term->count ) . ')</mark>', $term ) );
						}
						?>
						</h2>
					</a>
				</div>
				<?php
			}
		}
		?>
	</div>
	<?php
	$out = ob_get_clean();
	return $out;
}

function thb_iconbox_render( $attributes ) {
	ob_start();
	?>
	<div class="thb-iconbox align-<?php echo esc_attr( $attributes['alignment'] ); ?>">
		<div class="thb-iconbox-image">
			<?php
			if ( $attributes['image'] ) {
				echo wp_get_attachment_image( $attributes['image']['id'] );
			}
			?>
		</div>
		<div class="thb-iconbox-inner">
			<h6><?php echo wp_kses_post( $attributes['title'] ); ?></h6>
			<p><?php echo wp_kses_post( $attributes['subtitle'] ); ?></p>
		</div>
	</div>
	<?php
	$out = ob_get_clean();
	return $out;
}

// Filter: Block category.
function thb_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'fuel-themes',
				'title' => esc_html__( 'Fuel Themes Blocks', 'restoration' ),
			),
		)
	);
}
add_filter( 'block_categories', 'thb_block_category', 10, 2 );
