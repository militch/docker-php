<?php

Kirki::add_section(
	'restoration_footer',
	array(
		'title'       => esc_html__( 'Footer', 'restoration' ),
		'description' => esc_html__( 'Footer Settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);

thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_footer',
		'settings' => 'footer',
		'label'    => esc_html__( 'Display Footer?', 'restoration' ),
		'default'  => 1,
	)
);

thb_customizer_field(
	array(
		'type'     => 'radio-image',
		'settings' => 'footer_columns',
		'label'    => esc_html__( 'Footer Columns', 'restoration' ),
		'section'  => 'restoration_footer',
		'default'  => 'fivelargeleftcolumns',
		'priority' => 10,
		'choices'  => array(
			'onecolumns'               => get_template_directory_uri() . '/assets/img/admin/columns/one-columns.png',
			'twocolumns'               => get_template_directory_uri() . '/assets/img/admin/columns/two-columns.png',
			'threecolumns'             => get_template_directory_uri() . '/assets/img/admin/columns/three-columns.png',
			'fourcolumns'              => get_template_directory_uri() . '/assets/img/admin/columns/four-columns.png',
			'doubleleft'               => get_template_directory_uri() . '/assets/img/admin/columns/doubleleft-columns.png',
			'doubleright'              => get_template_directory_uri() . '/assets/img/admin/columns/doubleright-columns.png',
			'fivecolumns'              => get_template_directory_uri() . '/assets/img/admin/columns/five-columns.png',
			'sixcolumns'               => get_template_directory_uri() . '/assets/img/admin/columns/six-columns.png',
			'fivelargerightcolumns'    => get_template_directory_uri() . '/assets/img/admin/columns/five-columns-large-right.png',
			'fivelargeleftcolumns'     => get_template_directory_uri() . '/assets/img/admin/columns/five-columns-large-left.png',
			'fivelargerightcolumnsalt' => get_template_directory_uri() . '/assets/img/admin/columns/five-columns-large-right2.png',
			'fivelargeleftcolumnsalt'  => get_template_directory_uri() . '/assets/img/admin/columns/five-columns-large-left2.png',
		),
	)
);
