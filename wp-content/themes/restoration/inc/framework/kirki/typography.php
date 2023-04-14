<?php
Kirki::add_section(
	'restoration_typography',
	array(
		'title'       => esc_html__( 'Typography', 'restoration' ),
		'description' => esc_html__( 'Typography Settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);

thb_customizer_field(
	array(
		'type'        => 'typography',
		'section'     => 'restoration_typography',
		'settings'    => 'primary_typography',
		'label'       => esc_html__( 'Primary Font', 'restoration' ),
		'description' => esc_html__( 'Changes primarily heading tags', 'restoration' ),
		'default'     => array(
			'font-family' => 'Archivo',
			'variant'     => '500',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h1,h2,h3,h4,h5,h6',
			),
			array(
				'context' => array( 'editor' ),
			),
		),
	)
);
thb_customizer_field(
	array(
		'type'        => 'typography',
		'section'     => 'restoration_typography',
		'settings'    => 'secondary_typography',
		'label'       => esc_html__( 'Secondary Font', 'restoration' ),
		'description' => esc_html__( 'Changes primarily body text', 'restoration' ),
		'default'     => array(
			'font-family' => 'Archivo',
			'variant'     => 'regular',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'body',
			),
			array(
				'context' => array( 'editor' ),
			),
		),
	)
);
