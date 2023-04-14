<?php
Kirki::add_section(
	'restoration_subheader',
	array(
		'title'       => esc_html__( 'Sub-Header', 'restoration' ),
		'description' => esc_html__( 'Sub-Header Settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);

thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_subheader',
		'settings' => 'subheader',
		'label'    => esc_html__( 'Display Sub-Header?', 'restoration' ),
		'default'  => 1,
	)
);

thb_customizer_field(
	array(
		'type'              => 'text',
		'section'           => 'restoration_subheader',
		'settings'          => 'subheader_content',
		'label'             => esc_html__( 'Sub-Header Text', 'restoration' ),
		'default'           => wp_kses_post( 'Free Tracked Shipping Worldwide On Orders Over $30' ),
		'sanitize_callback' => 'wp_kses_post',
	)
);
