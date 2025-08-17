<?php
if (!class_exists('Kirki')) {
    return;
}

/*Panel*/
new \Kirki\Panel(
	'panel_id',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Site Information Settings', 'phu_kien_xau' ),
		'description' => esc_html__( 'Website information all.', 'phu_kien_xau' ),
	]
);

/*Panel*/
new \Kirki\Panel(
	'panel_sale_badge',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Sale Badge Settings', 'phu_kien_xau' ),
		'description' => esc_html__( 'Badge khuyến mãi giảm giá.', 'phu_kien_xau' ),
	]
);


/*Section*/
new \Kirki\Section(
	'contact_section',
	[
		'title'       => esc_html__( 'Contact Info Section', 'phu_kien_xau' ),
		'description' => esc_html__( 'Contact info cellphone, email, social network...', 'phu_kien_xau' ),
		'panel'       => 'panel_id',
		'priority'    => 160,
	]
);

/*Section*/
new \Kirki\Section(
	'badge_icon_section',
	[
		'title'       => esc_html__( 'Contact Info Section', 'phu_kien_xau' ),
		'description' => esc_html__( 'Contact info cellphone, email, social network...', 'phu_kien_xau' ),
		'panel'       => 'panel_sale_badge',
		'priority'    => 160,
	]
);

/*Field*/
new \Kirki\Field\Text (
	[
		'settings'    => 'cellphone_number_setting',
		'label'       => esc_html__( 'Cellphone Number', 'phu_kien_xau' ),
		'description' => esc_html__( 'Leave blank if not need' , 'phu_kien_xau' ),
		'section'     => 'contact_section',
		'default'     => esc_html__( '0123.456789', 'phu_kien_xau' ),
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


/*Field*/
new \Kirki\Field\Text (
	[
		'settings'    => 'badge_icon_setting',
		'label'       => esc_html__( 'Cellphone Number', 'phu_kien_xau' ),
		'description' => esc_html__( 'Leave blank if not need' , 'phu_kien_xau' ),
		'section'     => 'badge_icon_section',
		'default'     => esc_html__( '0123.456789', 'phu_kien_xau' ),
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
		'label'       => esc_html__( 'Email Address', 'phu_kien_xau' ),
		'description' => esc_html__( 'Leave blank if not need', 'phu_kien_xau' ),
		'section'     => 'contact_section',
		'default'     => esc_html__( 'info@maytinhdian.com', 'phu_kien_xau' ),
		'priority'    => 10,
	]
);

/*Company Section*/
new \Kirki\Section(
	'company_section',
	[
		'title'       => esc_html__( 'Company Info Section', 'phu_kien_xau' ),
		'description' => esc_html__( 'Company info cellphone, email, tax code, address ', 'phu_kien_xau' ),
		'panel'       => 'panel_id',
		'priority'    => 160,
	]
);

/*Field*/
new \Kirki\Field\Text (
	[
		'settings'    => 'company_name_setting',
		'label'       => esc_html__( 'Company name', 'phu_kien_xau' ),
		'description' => esc_html__( 'Leave blank if not need' , 'phu_kien_xau' ),
		'section'     => 'company_section',
		'default'     => esc_html__( 'USA-VietNam', 'phu_kien_xau' ),
		'priority'    => 10,
	]
);
new \Kirki\Field\Text (
	[
		'settings'    => 'tax_code_setting',
		'label'       => esc_html__( 'Tax Code Number', 'phu_kien_xau' ),
		'description' => esc_html__( 'Leave blank if not need', 'phu_kien_xau' ),
		'section'     => 'company_section',
		'default'     => esc_html__( '3703.114422', 'phu_kien_xau' ),
		'priority'    => 10,
	]
);


/*Site Footer Section*/
new \Kirki\Section(
	'footer_section',
	[
		'title'       => esc_html__( 'Site Footer Section', 'phu_kien_xau' ),
		'description' => esc_html__( 'Website footer information... ', 'phu_kien_xau' ),
		'panel'       => 'panel_id',
		'priority'    => 160,
	]
);

/*Field*/
new \Kirki\Field\Text (
	[
		'settings'    => 'copyright_setting',
		'label'       => esc_html__( 'Copyrights info', 'phu_kien_xau' ),
		'description' => esc_html__( 'Leave blank if not need' , 'phu_kien_xau' ),
		'section'     => 'footer_section',
		'default'     => esc_html__(' Copyrights TMT Innovative Solutions Co., ltd', 'phu_kien_xau' ),
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