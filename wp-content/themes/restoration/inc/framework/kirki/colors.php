<?php

Kirki::add_section(
	'restoration_colors',
	array(
		'title'       => esc_html__( 'Color', 'restoration' ),
		'description' => esc_html__( 'Color Settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);

thb_customizer_field(
	array(
		'type'     => 'color',
		'section'  => 'restoration_colors',
		'settings' => 'accent_color',
		'label'    => esc_html__( 'Accent Color', 'restoration' ),
		'output'   => array(
			array(
				'element'  => '.thb-full-menu > .menu-item > a:hover, .thb-full-menu .menu-item.current-menu-item>a, .products .product .woocommerce-loop-product__title a:hover, .wc-block-grid__products .product .woocommerce-loop-product__title a:hover',
				'property' => 'color',
			),
		),
		'choices'  => array(
			'alpha' => true,
		),
	)
);

thb_customizer_field(
	array(
		'type'     => 'color',
		'section'  => 'restoration_colors',
		'settings' => 'accent_color2',
		'label'    => esc_html__( 'Accent Color - 2', 'restoration' ),
		'output'   => array(
			array(
				'element'  => 'a:hover, .star-rating, .star-rating:before, .star-rating>span:before, .comment-form-rating p.stars:hover a, .comment-form-rating p.stars.selected a',
				'property' => 'color',
			),
		),
		'choices'  => array(
			'alpha' => true,
		),
	)
);
