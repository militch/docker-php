<?php

Kirki::add_section(
	'restoration_article',
	array(
		'title'       => esc_html__( 'Article', 'restoration' ),
		'description' => esc_html__( 'Article Settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);

thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_article',
		'settings' => 'article_author_name',
		'label'    => esc_html__( 'Author Name', 'restoration' ),
		'default'  => 1,
	)
);


thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_article',
		'settings' => 'article_date',
		'label'    => esc_html__( 'Article Date', 'restoration' ),
		'default'  => 1,
	)
);

thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_article',
		'settings' => 'article_cat',
		'label'    => esc_html__( 'Article Category', 'restoration' ),
		'default'  => 1,
	)
);

thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_article',
		'settings' => 'article_nav',
		'label'    => esc_html__( 'Article Navigation', 'restoration' ),
		'default'  => 1,
	)
);

thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_article',
		'settings' => 'article_tags',
		'label'    => esc_html__( 'Article Tags', 'restoration' ),
		'default'  => 1,
	)
);
