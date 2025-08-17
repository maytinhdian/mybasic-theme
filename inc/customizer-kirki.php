<?php
if (!class_exists('Kirki')) {
	return;
}

/*Panel*/
new \Kirki\Panel(
	'panel_id',
	[
		'priority'    => 10,
		'title'       => esc_html__('Site Information Settings', 'phu_kien_xau'),
		'description' => esc_html__('Website information all.', 'phu_kien_xau'),
	]
);

/*Panel Woo Sale Badge*/
new \Kirki\Panel(
	'panel_sale_badge',
	[
		'priority'    => 10,
		'title'       => esc_html__('Woocommerce Badge Settings', 'phu_kien_xau'),
		'description' => esc_html__('Thiết lập cho sale badge.', 'phu_kien_xau'),
	]
);


/*Section*/
new \Kirki\Section(
	'contact_section',
	[
		'title'       => esc_html__('Contact Info Section', 'phu_kien_xau'),
		'description' => esc_html__('Contact info cellphone, email, social network...', 'phu_kien_xau'),
		'panel'       => 'panel_id',
		'priority'    => 160,
	]
);

/*Section Sale Badge*/
new \Kirki\Section(
	'badge_icon_section',
	[
		'title'       => esc_html__('Layout - Position', 'phu_kien_xau'),
		'description' => esc_html__('Kiểu hiện thị và vị trí', 'phu_kien_xau'),
		'panel'       => 'panel_sale_badge',
		'priority'    => 160,
	]
);

/*Field*/
new \Kirki\Field\Text(
	[
		'settings'    => 'cellphone_number_setting',
		'label'       => esc_html__('Cellphone Number', 'phu_kien_xau'),
		'description' => esc_html__('Leave blank if not need', 'phu_kien_xau'),
		'section'     => 'contact_section',
		'default'     => esc_html__('0123.456789', 'phu_kien_xau'),
		'priority'    => 10,
		'partial_refresh' => array(
			'cellphone_number_setting' => array(
				'selector' => '.header-top ul li a',
				'render_callback' => function () {
					return  get_theme_mod('cellphone_number_setting');
				},
			)
		),
	]
);

/*Field - Sale Badge -*/
new \Kirki\Field\Radio_Buttonset([
	'settings' => 'sale_badge_style',
	'label'    => esc_html__('Kiểu Sale Badge', 'phu_kien_xau'),
	'section'  => 'badge_icon_section', // đảm bảo section này đã tạo
	'default'  => 'pill',               // 'pill' | 'flag'
	'priority' => 10,
	'choices'  => [
		'pill' => esc_html__('Pill', 'phu_kien_xau'),
		'flag' => esc_html__('Flag', 'phu_kien_xau'),
		'ribbon' => esc_html__('Ribbon', 'phu_kien_xau'),
		'circle' => esc_html__('Circle', 'phu_kien_xau'),
	],
	'transport' => 'refresh', // hoặc 'postMessage' nếu bạn tự handle JS
	'partial_refresh' => [
		'sale_badge_style_partial' => [
			// Nên trỏ tới chỗ có badge trong preview
			'selector'        => '.product-card__badges',
			'render_callback' => function () {
				// Trả về 1 mẩu HTML badge demo để thấy đổi kiểu ngay trong Customizer
				$style = get_theme_mod('sale_badge_style', 'pill');
				ob_start(); ?>
	<span class="sale-badge sale-badge--<?php echo esc_attr($style); ?> sale-badge--tl">
		<em class="sale-badge__label">Sale</em>
		<strong class="sale-badge__pct">-15%</strong>
	</span>
<?php
				return ob_get_clean();
			},
		],
	],
]);

/*Field - Sale Badge -*/
// new \Kirki\Field\Radio_Image( [
//     'settings'    => 'sale_badge_position',
//     'label'       => esc_html__( 'Vị trí Sale Badge', 'phu_kien_xau' ),
//     'section'     => 'badge_icon_section',
//     'default'     => 'tl', // top-left
//     'priority'    => 10,
//     'choices'     => [
//         'tl' => get_template_directory_uri() . '/assets/img/badge-tl.png',
//         'tr' => get_template_directory_uri() . '/assets/img/badge-tr.png',
//         'bl' => get_template_directory_uri() . '/assets/img/badge-bl.png',
//         'br' => get_template_directory_uri() . '/assets/img/badge-br.png',
//     ],
// ] );

new \Kirki\Field\Radio_Buttonset( [
    'settings'    => 'sale_badge_position',
    'label'       => esc_html__( 'Vị trí Sale Badge', 'phu_kien_xau' ),
    'section'     => 'badge_icon_section',
    'default'     => 'tl',
    'priority'    => 10,
    'choices'     => [
        'tl' => esc_html__( 'Top Left', 'phu_kien_xau' ),
        'tr' => esc_html__( 'Top Right', 'phu_kien_xau' ),
        'bl' => esc_html__( 'Bottom Left', 'phu_kien_xau' ),
        'br' => esc_html__( 'Bottom Right', 'phu_kien_xau' ),
    ],
] );

/*******************SALE BADGE***************** */

new \Kirki\Field\Text(
	[
		'settings'    => 'email_address_setting',
		'label'       => esc_html__('Email Address', 'phu_kien_xau'),
		'description' => esc_html__('Leave blank if not need', 'phu_kien_xau'),
		'section'     => 'contact_section',
		'default'     => esc_html__('info@maytinhdian.com', 'phu_kien_xau'),
		'priority'    => 10,
	]
);

/*Company Section*/
new \Kirki\Section(
	'company_section',
	[
		'title'       => esc_html__('Company Info Section', 'phu_kien_xau'),
		'description' => esc_html__('Company info cellphone, email, tax code, address ', 'phu_kien_xau'),
		'panel'       => 'panel_id',
		'priority'    => 160,
	]
);

/*Field*/
new \Kirki\Field\Text(
	[
		'settings'    => 'company_name_setting',
		'label'       => esc_html__('Company name', 'phu_kien_xau'),
		'description' => esc_html__('Leave blank if not need', 'phu_kien_xau'),
		'section'     => 'company_section',
		'default'     => esc_html__('USA-VietNam', 'phu_kien_xau'),
		'priority'    => 10,
	]
);
new \Kirki\Field\Text(
	[
		'settings'    => 'tax_code_setting',
		'label'       => esc_html__('Tax Code Number', 'phu_kien_xau'),
		'description' => esc_html__('Leave blank if not need', 'phu_kien_xau'),
		'section'     => 'company_section',
		'default'     => esc_html__('3703.114422', 'phu_kien_xau'),
		'priority'    => 10,
	]
);


/*Site Footer Section*/
new \Kirki\Section(
	'footer_section',
	[
		'title'       => esc_html__('Site Footer Section', 'phu_kien_xau'),
		'description' => esc_html__('Website footer information... ', 'phu_kien_xau'),
		'panel'       => 'panel_id',
		'priority'    => 160,
	]
);

/*Field*/
new \Kirki\Field\Text(
	[
		'settings'    => 'copyright_setting',
		'label'       => esc_html__('Copyrights info', 'phu_kien_xau'),
		'description' => esc_html__('Leave blank if not need', 'phu_kien_xau'),
		'section'     => 'footer_section',
		'default'     => esc_html__(' Copyrights TMT Innovative Solutions Co., ltd', 'phu_kien_xau'),
		'priority'    => 10,
		'partial_refresh' => array(
			'copyright_setting' => array(
				'selector' => 'footer .footer-copyright p',
				'render_callback' => function () {
					return  get_theme_mod('copyright_setting');
				},
			)
		),
	]
);
