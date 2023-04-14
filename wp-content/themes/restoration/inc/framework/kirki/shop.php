<?php

Kirki::add_section(
	'restoration_shop',
	array(
		'title'       => esc_html__( 'Shop', 'restoration' ),
		'description' => esc_html__( 'Shop Settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);
thb_customizer_field(
	array(
		'type'        => 'switch',
		'section'     => 'restoration_shop',
		'settings'    => 'shop_product_hover',
		'label'       => esc_html__( 'Show Hover Image?', 'restoration' ),
		'description' => esc_html__( 'When enabled, products will show a second image on hover. Does not work on Gutenberg elements.', 'restoration' ),
		'default'     => 1,
	)
);
thb_customizer_field(
	array(
		'type'              => 'textarea',
		'section'           => 'restoration_shop',
		'settings'          => 'shop_description',
		'label'             => esc_html__( 'Shop Description', 'restoration' ),
		'description'       => esc_html__( 'Displays on main shop page, similar to product category descriptions.', 'restoration' ),
		'sanitize_callback' => 'wp_kses_post',
	)
);

thb_customizer_field(
	array(
		'type'        => 'switch',
		'section'     => 'restoration_shop',
		'settings'    => 'single_product_ajax',
		'label'       => esc_html__( 'Single Product Ajax', 'restoration' ),
		'description' => esc_html__( 'When enabled, add to cart functionality will use AJAX on single product pages.', 'restoration' ),
		'default'     => 1,
	)
);
