<?php
global $product;
$product_url      = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
$thumbnail_second = '';
$featured         = wp_get_attachment_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' );
$attachment_ids   = $product->get_gallery_image_ids();

if ( $attachment_ids ) {
	$loop = 0;
	foreach ( $attachment_ids as $attachment_id ) {
		$image_link = wp_get_attachment_url( $attachment_id );
		if ( ! $image_link ) {
			continue;
		}
		$loop++;
		$thumbnail_second = $attachment_id;
		if ( $image_link !== $featured ) {
			if ( 1 === $loop ) {
				break;
			}
		}
	}
}
?>
<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>" class="thb-product-image-link thb-second-image">
	<?php echo woocommerce_get_product_thumbnail(); ?>
	<?php if ( '' !== $thumbnail_second ) { ?>
	<span class="product_thumbnail_hover"><?php echo wp_get_attachment_image( $thumbnail_second, 'woocommerce_thumbnail' ); ?></span>
	<?php } ?>
</a>
