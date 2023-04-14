<?php
	global $product;
	$product_url = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
?>
<a href="<?php echo esc_url( $product_url ); ?>" title="<?php the_title_attribute(); ?>" class="thb-product-image-link">
	<?php echo woocommerce_get_product_thumbnail(); ?>
</a>
