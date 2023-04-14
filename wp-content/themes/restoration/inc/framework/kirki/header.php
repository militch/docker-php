<?php
Kirki::add_section(
	'restoration_header',
	array(
		'title'       => esc_html__( 'Header', 'restoration' ),
		'description' => esc_html__( 'Header Section Settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);
thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_header',
		'settings' => 'header_fullwidth',
		'label'    => esc_html__( 'Full Width Header?', 'restoration' ),
		'default'  => 0,
	)
);
thb_customizer_field(
	array(
		'type'     => 'dimension',
		'section'  => 'restoration_header',
		'settings' => 'logo_height',
		'label'    => esc_html__( 'Logo Height', 'restoration' ),
		'default'  => '16px',
	)
);

thb_customizer_field(
	array(
		'type'     => 'dimension',
		'section'  => 'restoration_header',
		'settings' => 'logo_height_mobile',
		'label'    => esc_html__( 'Logo Height - Mobile', 'restoration' ),
		'default'  => '16px',
	)
);

thb_customizer_field(
	array(
		'type'     => 'select',
		'section'  => 'restoration_header',
		'settings' => 'fixed_header_shadow',
		'label'    => esc_html__( 'Fixed Header - Shadow', 'restoration' ),
		'default'  => 'thb-fixed-shadow-style1',
		'multiple' => 0,
		'choices'  => array(
			'thb-fixed-noshadow'      => 'None',
			'thb-fixed-shadow-style1' => 'Small',
			'thb-fixed-shadow-style2' => 'Medium',
			'thb-fixed-shadow-style3' => 'Large',
		),
	)
);
