<?php
Kirki::add_section(
	'restoration_headersecondary',
	array(
		'title'       => esc_html__( 'Header - Secondary Area', 'restoration' ),
		'description' => esc_html__( 'Header - Secondary Area Settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);

thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_headersecondary',
		'settings' => 'header_search',
		'label'    => esc_html__( 'Display Search?', 'restoration' ),
		'default'  => 1,
	)
);

thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_headersecondary',
		'settings' => 'header_menu',
		'label'    => esc_html__( 'Display Secondary Menu?', 'restoration' ),
		'default'  => 1,
	)
);
thb_customizer_field(
	array(
		'type'        => 'editor',
		'section'     => 'restoration_headersecondary',
		'settings'    => 'header_cart_after_text',
		'label'       => esc_html__( 'After Cart Text', 'restoration' ),
		'description' => esc_html__( 'This content appears at the bottom of the cart. You can use your shortcodes here.', 'restoration' ),
	)
);
