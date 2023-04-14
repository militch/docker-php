<?php

Kirki::add_section(
	'restoration_background',
	array(
		'title'       => esc_html__( 'Backgrounds', 'restoration' ),
		'description' => esc_html__( 'Background settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);
thb_customizer_field(
	array(
		'type'      => 'background',
		'section'   => 'restoration_background',
		'settings'  => 'subheader_background',
		'label'     => esc_html__( 'Sub-Header Background', 'restoration' ),
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.subheader',
			),
		),
	)
);
thb_customizer_field(
	array(
		'type'      => 'background',
		'section'   => 'restoration_background',
		'settings'  => 'header_background',
		'label'     => esc_html__( 'Header Background', 'restoration' ),
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.header .header-logo-row',
			),
		),
	)
);
thb_customizer_field(
	array(
		'type'      => 'background',
		'section'   => 'restoration_background',
		'settings'  => 'footer_background',
		'label'     => esc_html__( 'Footer Background', 'restoration' ),
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '#footer',
			),
		),
	)
);
thb_customizer_field(
	array(
		'type'      => 'background',
		'section'   => 'restoration_background',
		'settings'  => 'subfooter_background',
		'label'     => esc_html__( 'Sub-Footer Background', 'restoration' ),
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.subfooter',
			),
		),
	)
);
