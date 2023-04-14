<?php
/**
 * Fuel Themes Admin Class
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

class Thb_Theme_Admin {
	/**
	 * Main instance
	 */
	private static $thb_instance;

	/**
	 * Theme Name
	 */
	public static $thb_theme_name;

	/**
	 * Theme Version
	 */
	public static $thb_theme_version;

	/**
	 * Theme Slug
	 */
	public static $thb_theme_slug;

	/**
	 * Theme Directory
	 */
	public static $thb_theme_directory;

	/**
	 * Theme Directory URL
	 */
	public static $thb_theme_directory_uri;

	/**
	 * Theme Constructor executed only once per request
	 */
	public function __construct() {
		if ( self::$thb_instance ) {
			_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
		}
	}

	/**
	 * You cannot clone this class
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
	}

	/**
	 * You cannot unserialize instances of this class
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
	}

	public static function instance() {
		global $thb_theme_admin;
		if ( ! self::$thb_instance ) {
			self::$thb_instance = new self();
			$thb_theme_admin    = self::$thb_instance;

			// Theme Variables.
			$theme                         = wp_get_theme();
			self::$thb_theme_name          = $theme->get( 'Name' );
			self::$thb_theme_version       = $theme->parent() ? $theme->parent()->get( 'Version' ) : $theme->get( 'Version' );
			self::$thb_theme_slug          = $theme->template;
			self::$thb_theme_directory     = get_template_directory() . '/';
			self::$thb_theme_directory_uri = get_template_directory_uri() . '/';

			// After Setup Theme.
			add_action( 'after_setup_theme', array( self::$thb_instance, 'thb_after_setup_theme' ) );

			// Setup Admin Menus.
			if ( is_admin() ) {
				self::$thb_instance->thb_init_admin_pages();
			}
		}

		return self::$thb_instance;
	}
	/**
	 * After Theme Setup
	 */
	public function thb_after_setup_theme() {

		// WooCommerce Support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );

		// Custom Logo.
		add_theme_support( 'custom-logo' );

		// Gutenberg.
		add_theme_support( 'align-wide' );
		add_theme_support( 'align-full' );

		// Post Formats.
		add_theme_support( 'post-formats', array( 'gallery', 'video' ) );

		// Text Domain.
		load_theme_textdomain( 'restoration', get_stylesheet_directory() . '/inc/languages' );

		// Background Support.
		add_theme_support( 'custom-background' );

		// Title Support.
		add_theme_support( 'title-tag' );

		// Required Settings.
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1170;
		}
		add_theme_support( 'automatic-feed-links' );

		// Editor Styling.
		add_theme_support( 'editor-styles' );
		add_editor_style( array( 'assets/css/editor-style.css' ) );

		// Image Settings.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 80, 100, true );

		$thb_image_sizes = self::$thb_instance->thb_image_sizes();

		// Register image size
		foreach ( $thb_image_sizes as $image_size ) {
			add_image_size( $image_size['slug'], $image_size['width'], $image_size['height'], $image_size['crop'] );
		}

		// HTML5 Galleries.
		add_theme_support( 'html5', array( 'comment-list', 'gallery', 'caption' ) );

		// Register Menus.
		add_theme_support( 'nav-menus' );
		register_nav_menus(
			array(
				'nav-menu'     => esc_html__( 'Navigation Menu', 'restoration' ),
				'acc-menu-out' => esc_html__( 'Secondary Menu (Not Logged-in)', 'restoration' ),
				'acc-menu-in'  => esc_html__( 'Secondary Menu (Logged-in)', 'restoration' ),
			)
		);

		// Sidebars.
		$thb_sidebar_defaults = array(
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="thb-widget-title">',
			'after_title'   => '</div>',
		);

		$thb_sidebars = array(
			array(
				'name'        => esc_html__( 'Article Sidebar', 'restoration' ),
				'id'          => 'single',
				'description' => esc_html__( 'The sidebar next to articles', 'restoration' ),
			),
			array(
				'name'        => esc_html__( 'Blog Sidebar', 'restoration' ),
				'id'          => 'blog',
				'description' => esc_html__( 'The sidebar on blog pages', 'restoration' ),
			),
			array(
				'name'        => esc_html__( 'Page Sidebar', 'restoration' ),
				'id'          => 'page',
				'description' => esc_html__( 'The sidebar on regular pages.', 'restoration' ),
			),
			array(
				'name'        => esc_html__( 'Mobile Menu Sidebar', 'restoration' ),
				'id'          => 'mobile-menu',
				'description' => esc_html__( 'You can also add widgets inside your mobile menu.', 'restoration' ),
			),
		);
		for ( $x = 1; $x <= 6; $x++ ) {
			$thb_sidebars[] = array(
				'name'        => esc_html__( 'Footer Column - ', 'restoration' ) . $x,
				'id'          => 'footer' . $x,
				'description' => esc_html__( 'Contents of the column #', 'restoration' ) . $x,
			);
		}

		// Shop Sidebar.
		if ( thb_wc_supported() ) {
			array_unshift(
				$thb_sidebars,
				array(
					'name'        => esc_html__( 'Shop Sidebar', 'restoration' ),
					'id'          => 'thb-shop-filters',
					'description' => esc_html__( 'Sidebar used for filters on the Shop page', 'restoration' ),
				)
			);
		}
		// Register Sidebars.
		foreach ( $thb_sidebars as $sidebar ) {
			register_sidebar( array_merge( $sidebar, $thb_sidebar_defaults ) );
		}

		/* Add a pingback url auto-discovery header for single posts, pages, or attachments. */
		function thb_pingback_header() {
			if ( is_singular() && pings_open() ) {
				echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';
			}
		}
		add_action( 'wp_head', 'thb_pingback_header' );
	}
	public function thb_image_sizes() {
		$thb_image_sizes = apply_filters(
			'thb_image_sizes_filter',
			array(
				array(
					'slug'   => 'restoration-rectangle',
					'width'  => 370,
					'height' => 240,
					'crop'   => true,
				),
				array(
					'slug'   => 'restoration-single',
					'width'  => 800,
					'height' => 400,
					'crop'   => true,
				),
			)
		);

		function thb_calculate_image_orientation( $thb_image_sizes ) {
			if ( ! is_array( $thb_image_sizes ) ) {
				return;
			}
			$new_sizes = array();
			foreach ( $thb_image_sizes as $image_size ) {
				$new_sizes[] = array(
					'slug'   => $image_size['slug'] . '-mini',
					'width'  => 20,
					'height' => 9999 === $image_size['height'] ? 9999 : absint( ( $image_size['height'] * 20 ) / $image_size['width'] ),
					'crop'   => $image_size['crop'],
				);
				$new_sizes[] = array(
					'slug'   => $image_size['slug'] . '-mobile',
					'width'  => 290,
					'height' => 9999 === $image_size['height'] ? 9999 : absint( ( $image_size['height'] * 290 ) / $image_size['width'] ),
					'crop'   => $image_size['crop'],
				);
				$new_sizes[] = array(
					'slug'   => $image_size['slug'] . '-x2',
					'width'  => $image_size['width'] * 2,
					'height' => 9999 === $image_size['height'] ? 9999 : $image_size['height'] * 2,
					'crop'   => $image_size['crop'],
				);
			}
			return $new_sizes;
		}
		$new_sizes = thb_calculate_image_orientation( $thb_image_sizes );
		foreach ( $new_sizes as $new_size ) {
			$thb_image_sizes[] = $new_size;
		}
		return $thb_image_sizes;
	}
	public function thb_demos() {
		return array(
			array(
				'import_file_name'           => 'Restoration',
				'import_file_url'            => 'https://themes.fuelthemes.net/theme-demo-files/restoration/democontent.xml',
				'import_widget_file_url'     => 'https://themes.fuelthemes.net/theme-demo-files/restoration/widget_data.json',
				'import_customizer_file_url' => 'https://themes.fuelthemes.net/theme-demo-files/restoration/customizer.dat',
				'import_image'               => self::$thb_theme_directory_uri . 'screenshot.jpg',
				'import_demo_url'            => 'https://restoration.fuelthemes.net/',
			),
		);
	}
	/**
	 * Inintialize Admin Pages
	 */
	public function thb_init_admin_pages() {
		global $pagenow;
		$page_name = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
		// Script and styles.
		add_action( 'admin_enqueue_scripts', array( & $this, 'thb_admin_page_enqueue' ) );

		// Menu Pages.
		add_action( 'admin_menu', array( & $this, 'thb_admin_setup_menu' ), 1 );

		// Theme Options Redirect.
		if ( $pagenow ) {
			if ( 'admin.php' === $pagenow && isset( $page_name ) && 'thb-theme-options' === wp_unslash( $page_name ) ) {
				if ( ! ( defined( 'WP_CLI' ) && WP_CLI ) ) {
					wp_safe_redirect( admin_url( 'themes.php?page=ot-theme-options' ) );
					die();
				}
			}
		}
		// Import Page.
		if ( $pagenow ) {
			if ( 'admin.php' === $pagenow && isset( $page_name ) && 'thb-demo-import' === wp_unslash( $page_name ) ) {

				add_action(
					'thb_demo_import_page',
					function() {
						get_template_part( '/inc/admin/welcome/pages/requirements' );
					}
				);
			}
		}
	}
	public function thb_admin_page_enqueue( $hook_suffix ) {
		wp_enqueue_script( 'thb-admin-meta', self::$thb_theme_directory_uri . 'assets/js/admin-meta.min.js', array( 'jquery' ), esc_attr( self::$thb_theme_version ), false );

		wp_enqueue_style( 'thb-admin-css', self::$thb_theme_directory_uri . 'assets/css/admin.css', null, esc_attr( self::$thb_theme_version ) );

		wp_add_inline_style( 'thb-admin-css', self::thb_editor_styles() );
	}
	public function thb_editor_styles() {
		$primary_font   = thb_customizer( 'primary_typography' );
		$secondary_font = thb_customizer( 'secondary_typography' );

		ob_start();
		?>
		<?php
		if ( $primary_font ) {
			?>
		.editor-styles-wrapper h1,
		.editor-styles-wrapper h2,
		.editor-styles-wrapper h3,
		.editor-styles-wrapper h4,
		.editor-styles-wrapper h5,
		.editor-styles-wrapper h6,
		.editor-styles-wrapper .h1,
		.editor-styles-wrapper .h2,
		.editor-styles-wrapper .h3,
		.editor-styles-wrapper .h4,
		.editor-styles-wrapper .h5,
		.editor-styles-wrapper .h6 {
			<?php
			if ( isset( $primary_font['font-family'] ) ) {
				echo 'font-family:' . esc_html( $primary_font['font-family'] ) . ' !important;';
			}
			if ( isset( $primary_font['variant'] ) ) {
				echo 'font-weight:' . esc_html( $primary_font['variant'] ) . ';';
			}
			?>
		}
		<?php } ?>
		<?php if ( $secondary_font ) { ?>
		.editor-styles-wrapper {
			<?php
			if ( isset( $secondary_font['font-family'] ) ) {
				echo 'font-family:' . esc_attr( $secondary_font['font-family'] ) . ' !important;';
			}
			if ( isset( $secondary_font['variant'] ) ) {
				echo 'font-weight:' . esc_attr( $secondary_font['variant'] ) . ';';
			}
			?>
		}
		<?php } ?>
		<?php
		// Return the results.
		return ob_get_clean();
	}
	public function thb_admin_setup_menu() {
		// Welcome.
		add_theme_page( self::$thb_theme_name, self::$thb_theme_name, 'edit_theme_options', 'thb-product-registration', array( & $this, 'thb_product_registration' ), 10 );

		// Welcome.
		add_submenu_page( 'thb-product-registration', 'Welcome', 'Welcome', 'edit_theme_options', 'thb-product-registration', array( & $this, 'thb_product_registration' ) );

		// Demo Import.
		add_submenu_page( 'thb-product-registration', 'Demo Import', 'Demo Import', 'edit_theme_options', 'thb-demo-import', array( & $this, 'thb_demo_import' ) );

		// Theme Options.
		add_submenu_page( 'thb-product-registration', 'Theme Options', 'Theme Options', 'edit_theme_options', 'thb-theme-options', '__return_false' );

	}
	public function thb_product_registration() {
		get_template_part( 'inc/admin/welcome/pages/registration' );
	}
	public function thb_demo_import() {
		get_template_part( 'inc/admin/welcome/pages/demo-import' );
	}
}
// Main instance shortcut.
function thb_theme_admin() {
	global $thb_theme_admin;
	return $thb_theme_admin;
}
Thb_Theme_Admin::instance();
