<?php
if (!class_exists('Kirki')) {
    return;
}

/*Panel*/
new \Kirki\Panel(
	'panel_id',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Site Information Settings', 'phukiendep' ),
		'description' => esc_html__( 'Website information all.', 'phukiendep' ),
	]
);

/*Section*/
new \Kirki\Section(
	'contact_section',
	[
		'title'       => esc_html__( 'Contact Info Section', 'phukiendep' ),
		'description' => esc_html__( 'Contact info cellphone, email, social network...', 'phukiendep' ),
		'panel'       => 'panel_id',
		'priority'    => 160,
	]
);

/*Field*/
new \Kirki\Field\Text (
	[
		'settings'    => 'cellphone_number_setting',
		'label'       => esc_html__( 'Cellphone Number', 'phukiendep' ),
		'description' => esc_html__( 'Leave blank if not need' , 'phukiendep' ),
		'section'     => 'contact_section',
		'default'     => esc_html__( '0123.456789', 'phukiendep' ),
		'priority'    => 10,
		'partial_refresh' => array(
			'cellphone_number_setting'=>array(
				'selector' => '.header-top ul li a',
				'render_callback' => function() {
					return  get_theme_mod( 'cellphone_number_setting' );
				},
			)
		),
	]
);
new \Kirki\Field\Text (
	[
		'settings'    => 'email_address_setting',
		'label'       => esc_html__( 'Email Address', 'phukiendep' ),
		'description' => esc_html__( 'Leave blank if not need', 'phukiendep' ),
		'section'     => 'contact_section',
		'default'     => esc_html__( 'info@maytinhdian.com', 'phukiendep' ),
		'priority'    => 10,
	]
);

/*Company Section*/
new \Kirki\Section(
	'company_section',
	[
		'title'       => esc_html__( 'Company Info Section', 'phukiendep' ),
		'description' => esc_html__( 'Company info cellphone, email, tax code, address ', 'phukiendep' ),
		'panel'       => 'panel_id',
		'priority'    => 160,
	]
);

/*Field*/
new \Kirki\Field\Text (
	[
		'settings'    => 'company_name_setting',
		'label'       => esc_html__( 'Company name', 'phukiendep' ),
		'description' => esc_html__( 'Leave blank if not need' , 'phukiendep' ),
		'section'     => 'company_section',
		'default'     => esc_html__( 'USA-VietNam', 'phukiendep' ),
		'priority'    => 10,
	]
);
new \Kirki\Field\Text (
	[
		'settings'    => 'tax_code_setting',
		'label'       => esc_html__( 'Tax Code Number', 'phukiendep' ),
		'description' => esc_html__( 'Leave blank if not need', 'phukiendep' ),
		'section'     => 'company_section',
		'default'     => esc_html__( '3703.114422', 'phukiendep' ),
		'priority'    => 10,
	]
);


/*Site Footer Section*/
new \Kirki\Section(
	'footer_section',
	[
		'title'       => esc_html__( 'Site Footer Section', 'phukiendep' ),
		'description' => esc_html__( 'Website footer information... ', 'phukiendep' ),
		'panel'       => 'panel_id',
		'priority'    => 160,
	]
);

/*Field*/
new \Kirki\Field\Text (
	[
		'settings'    => 'copyright_setting',
		'label'       => esc_html__( 'Copyrights info', 'phukiendep' ),
		'description' => esc_html__( 'Leave blank if not need' , 'phukiendep' ),
		'section'     => 'footer_section',
		'default'     => esc_html__(' Copyrights TMT Innovative Solutions Co., ltd', 'phukiendep' ),
		'priority'    => 10,
		'partial_refresh' => array(
			'copyright_setting'=>array(
				'selector' => 'footer .footer-copyright p',
				'render_callback' => function() {
					return  get_theme_mod( 'copyright_setting' );
				},
			)
		),
	]
);