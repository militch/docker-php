<?php

Kirki::add_section(
	'restoration_mobilemenu',
	array(
		'title'       => esc_html__( 'Mobile Menu', 'restoration' ),
		'description' => esc_html__( 'Mobile Menu Settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);
thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_mobilemenu',
		'settings' => 'mobile_menu_search',
		'label'    => esc_html__( 'Display Search?', 'restoration' ),
		'default'  => 1,
	)
);
thb_customizer_field(
	array(
		'type'     => 'editor',
		'section'  => 'restoration_mobilemenu',
		'settings' => 'mobile_menu_footer',
		'label'    => esc_html__( 'Mobile Menu Footer Content', 'restoration' ),
	)
);
