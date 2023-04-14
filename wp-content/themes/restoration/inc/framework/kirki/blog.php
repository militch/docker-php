<?php

Kirki::add_section(
	'restoration_blog',
	array(
		'title'       => esc_html__( 'Blog', 'restoration' ),
		'description' => esc_html__( 'Blog Settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);

thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_blog',
		'settings' => 'post_meta_date',
		'label'    => esc_html__( 'Post Date', 'restoration' ),
		'default'  => 1,
	)
);


thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_blog',
		'settings' => 'post_meta_excerpt',
		'label'    => esc_html__( 'Post Excerpt', 'restoration' ),
		'default'  => 1,
	)
);

thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_blog',
		'settings' => 'post_meta_cat',
		'label'    => esc_html__( 'Post Category', 'restoration' ),
		'default'  => 1,
	)
);
