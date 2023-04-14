<?php

Kirki::add_section(
	'restoration_subfooter',
	array(
		'title'       => esc_html__( 'Sub-Footer', 'restoration' ),
		'description' => esc_html__( 'Sub-Footer Settings', 'restoration' ),
		'panel'       => 'restoration',
	)
);
thb_customizer_field(
	array(
		'type'     => 'switch',
		'section'  => 'restoration_subfooter',
		'settings' => 'subfooter',
		'label'    => esc_html__( 'Display Sub-Footer?', 'restoration' ),
		'default'  => 1,
	)
);
thb_customizer_field(
	array(
		'type'              => 'text',
		'section'           => 'restoration_subfooter',
		'settings'          => 'copyright_text',
		'label'             => esc_html__( 'Copyright Text', 'restoration' ),
		'default'           => wp_kses_post( '© 2020 <a href="https://fuelthemes.net" target="_blank" title="Premium WordPress Themes">Premium WordPress Themes</a>' ),
		'sanitize_callback' => 'wp_kses_post',
	)
);
thb_customizer_field(
	array(
		'type'         => 'repeater',
		'section'      => 'restoration_subfooter',
		'label'        => esc_html__( 'Payment Icons', 'restoration' ),
		'row_label'    => array(
			'type'  => 'text',
			'value' => esc_html__( 'Payment Icon', 'restoration' ),
		),
		'button_label' => esc_html__( 'Add New Payment Icon', 'restoration' ),
		'settings'     => 'payment_type',
		'fields'       => array(
			'link_icon' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Payment Icon', 'restoration' ),
				'default'     => '',
				'placeholder' => esc_html__( 'Select an option...', 'restoration' ),
				'priority'    => 10,
				'choices'     => thb_payment_icons_array(),
			),
		),
		'default'      => array(),
	)
);
