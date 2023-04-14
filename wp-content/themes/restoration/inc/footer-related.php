<?php
/**
 * Footer related functions
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

// Footer Columns.
function thb_footer_columns() {
	$footer_columns = thb_customizer( 'footer_columns', 'fivelargeleftcolumns' );
	?>
		<?php if ( 'fourcolumns' === $footer_columns ) { ?>
			<div class="small-12 medium-6 large-3 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="small-12 medium-6 large-3 columns">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
			<div class="small-12 medium-6 large-3 columns">
				<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
			<div class="small-12 medium-6 large-3 columns">
				<?php dynamic_sidebar( 'footer4' ); ?>
			</div>
		<?php } elseif ( 'threecolumns' === $footer_columns ) { ?>
			<div class="small-12 medium-6 large-4 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="small-12 medium-6 large-4 columns">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
			<div class="small-12 large-4 columns">
					<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
		<?php } elseif ( 'twocolumns' === $footer_columns ) { ?>
			<div class="small-12 medium-6 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="small-12 medium-6 columns">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
		<?php } elseif ( 'doubleleft' === $footer_columns ) { ?>
			<div class="small-12 medium-6 large-3 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="small-12 medium-6 large-3 columns">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
			<div class="small-12 medium-6 large-6 columns">
				<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
		<?php } elseif ( 'doubleright' === $footer_columns ) { ?>
			<div class="small-12 medium-6 large-6 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="small-12 medium-6 large-3 columns">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
			<div class="small-12 medium-6 large-3 columns">
					<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
		<?php } elseif ( 'fivecolumns' === $footer_columns ) { ?>
			<div class="small-12 medium-6 thb-5 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="small-12 medium-6 thb-5 columns">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
			<div class="small-12 medium-6 thb-5 columns">
				<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
			<div class="small-12 medium-6 thb-5 columns">
				<?php dynamic_sidebar( 'footer4' ); ?>
			</div>
			<div class="small-12 thb-5 columns">
				<?php dynamic_sidebar( 'footer5' ); ?>
			</div>
		<?php } elseif ( 'onecolumns' === $footer_columns ) { ?>
			<div class="small-12 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
		<?php } elseif ( 'sixcolumns' === $footer_columns ) { ?>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer4' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer5' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer6' ); ?>
			</div>
		<?php } elseif ( 'fivelargerightcolumns' === $footer_columns ) { ?>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer4' ); ?>
			</div>
			<div class="small-6 medium-8 large-4 columns">
				<?php dynamic_sidebar( 'footer5' ); ?>
			</div>
		<?php } elseif ( 'fivelargeleftcolumns' === $footer_columns ) { ?>
			<div class="small-6 medium-8 large-4 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer4' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer5' ); ?>
			</div>
		<?php } elseif ( 'fivelargerightcolumnsalt' === $footer_columns ) { ?>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
			<div class="small-6 medium-4 large-3 columns">
				<?php dynamic_sidebar( 'footer4' ); ?>
			</div>
			<div class="small-6 medium-8 large-3 columns">
				<?php dynamic_sidebar( 'footer5' ); ?>
			</div>
		<?php } elseif ( 'fivelargeleftcolumnsalt' === $footer_columns ) { ?>
			<div class="small-6 medium-8 large-3 columns">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="small-6 medium-4 large-3 columns">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer4' ); ?>
			</div>
			<div class="small-6 medium-4 large-2 columns">
				<?php dynamic_sidebar( 'footer5' ); ?>
			</div>
		<?php } ?>
	<?php
}
add_action( 'thb_footer_columns', 'thb_footer_columns' );

// Payment Icons.
function thb_payment_icons() {
	$footer_payment_icons = thb_customizer( 'payment_type' );

	if ( ! $footer_payment_icons || ! count( $footer_payment_icons ) ) {
		return;
	}
	?>
	<ul class="thb-payment-icons footer-payment-icons">
		<?php
		foreach ( $footer_payment_icons as $payment ) {
			?>
			<li><i class="pf pf-<?php echo esc_attr( $payment['link_icon'] ); ?>"></i></li>
			<?php
		}
		?>
	</ul>
	<?php
}
add_action( 'thb_payment_icons', 'thb_payment_icons' );

// Footer Templates.
function thb_footer_templates() {
	if ( thb_customizer( 'footer', 1 ) || ! class_exists( 'Kirki' ) ) {
		get_template_part( 'inc/templates/footer/footer-style1' );
	}
	if ( thb_customizer( 'subfooter', 1 ) ) {
		get_template_part( 'inc/templates/subfooter/subfooter-style1' );
	}
}
add_action( 'thb_after_main', 'thb_footer_templates' );

// Footer Items.
function thb_footer_items() {
	// Scroll To Top.
	?>
	<a id="scroll_to_top">
		<i class="thb-icon-up-open-mini"></i>
	</a>
	<div class="click-capture"></div>
	<!-- End Content Click Capture -->
	<?php
	// Off Canvas Filters.
	do_action( 'thb_shop_filters' );

}
add_action( 'wp_footer', 'thb_footer_items', 3 );
