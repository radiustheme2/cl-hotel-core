<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Hotel_Core;

if ( ! defined( 'ABSPATH' ) ) exit;

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals

if ( !class_exists( 'RT_Postmeta' ) ) {
	return;
}

use Rtcl\Services\FormBuilder\FBHelper;

$Postmeta = \RT_Postmeta::getInstance();

$prefix = CL_HOTEL_CORE_THEME_PREFIX;

$ctp_socials = array(
	'facebook' => array(
		'label' => esc_html__( 'Facebook', 'cl-hotel-core' ),
		'type'  => 'text',
		'icon'  => 'flaticon-facebook',
		'color' => '#3b5998',
	),
	'twitter' => array(
		'label' => esc_html__( 'Twitter', 'cl-hotel-core' ),
		'type'  => 'text',
		'icon'  => 'flaticon-twitter',
		'color' => '#1da1f2',
	),
	'instagram' => array(
		'label' => esc_html__( 'Instagram', 'cl-hotel-core' ),
		'type'  => 'text',
		'icon'  => 'flaticon-instagram',
		'color' => '#AA3DB2',
	),
);
$cl_hotel_ctp_socials = apply_filters( 'ctp_socials', $ctp_socials );

/*---------------------------------------------------------------------
#. = Layout Settings
-----------------------------------------------------------------------*/
$nav_menus = wp_get_nav_menus( array( 'fields' => 'id=>name' ) );
$nav_menus = array( 'default' => esc_html__( 'Default', 'cl-hotel-core' ) ) + $nav_menus;

$Postmeta->add_meta_box( "{$prefix}_page_settings", esc_html__( 'Layout Settings', 'cl-hotel-core' ), array( 'page', 'post', 'cl_hotel_team', 'rtcl_builder' ), '', '', 'high', array(
	'fields' => array(
	
		"{$prefix}_layout_settings" => array(
			'label'   => esc_html__( 'Layouts', 'cl-hotel-core' ),
			'type'    => 'group',
			'value'  => array(	
			
				"{$prefix}_layout" => array(
					'label'   => esc_html__( 'Layout', 'cl-hotel-core' ),
					'type'    => 'select',
					'options' => array(
						'default'       => esc_html__( 'Default', 'cl-hotel-core' ),
						'full-width'    => esc_html__( 'Full Width', 'cl-hotel-core' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'cl-hotel-core' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'cl-hotel-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_header_top" => array(
					'label'    	  => esc_html__( 'Header top', 'cl-hotel-core' ),
					'type'     	  => 'select',
					'options'  	  => array(
						'default' => esc_html__( 'Default', 'cl-hotel-core' ),
						'on'      => esc_html__( 'Enabled', 'cl-hotel-core' ),
						'off'     => esc_html__( 'Disabled', 'cl-hotel-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_header_top_layout" => array(
					'label'   => esc_html__( 'Header Top Layout', 'cl-hotel-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => esc_html__( 'Default', 'cl-hotel-core' ),
						'1'       => esc_html__( 'Layout 1', 'cl-hotel-core' ),
						'2'       => esc_html__( 'Layout 2', 'cl-hotel-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_tr_header" => array(
					'label'    	  => esc_html__( 'Transparent Header', 'cl-hotel-core' ),
					'type'     	  => 'select',
					'options'  	  => array(
						'default' => esc_html__( 'Default', 'cl-hotel-core' ),
						'on'      => esc_html__( 'Enabled', 'cl-hotel-core' ),
						'off'     => esc_html__( 'Disabled', 'cl-hotel-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_header_area" => array(
					'label' 	  => esc_html__( 'Header Area On/Off', 'cl-hotel-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => esc_html__( 'Default', 'cl-hotel-core' ),
						'on'      => esc_html__( 'Enabled', 'cl-hotel-core' ),
						'off'     => esc_html__( 'Disabled', 'cl-hotel-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_header_menu" => array(
					'label'   => esc_html__( 'Menu Layout', 'cl-hotel-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => esc_html__( 'Default', 'cl-hotel-core' ),
						'container-fluid custom-padding' => esc_html__( 'Full width layout', 'cl-hotel-core' ),
						'container'       => esc_html__( 'Box layout', 'cl-hotel-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_footer_newsletter" => array(
					'label' 	  => esc_html__( 'Footer Newsletter', 'cl-hotel-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => esc_html__( 'Default', 'cl-hotel-core' ),
						'on'      => esc_html__( 'Enabled', 'cl-hotel-core' ),
						'off'     => esc_html__( 'Disabled', 'cl-hotel-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_footer_area" => array(
					'label' 	  => esc_html__( 'Footer Area', 'cl-hotel-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => esc_html__( 'Default', 'cl-hotel-core' ),
						'on'      => esc_html__( 'Enabled', 'cl-hotel-core' ),
						'off'     => esc_html__( 'Disabled', 'cl-hotel-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_footer" => array(
					'label'   => esc_html__( 'Footer Layout', 'cl-hotel-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => esc_html__( 'Default', 'cl-hotel-core' ),
						'1'       => esc_html__( 'Layout 1', 'cl-hotel-core' ),
						'2'       => esc_html__( 'Layout 2', 'cl-hotel-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_copyright_area" => array(
					'label' 	  => esc_html__( 'Copyright Area', 'cl-hotel-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => esc_html__( 'Default', 'cl-hotel-core' ),
						'on'      => esc_html__( 'Enabled', 'cl-hotel-core' ),
						'off'     => esc_html__( 'Disabled', 'cl-hotel-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_banner" => array(
					'label'   => esc_html__( 'Breadcrumb Area', 'cl-hotel-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => esc_html__( 'Default', 'cl-hotel-core' ),
						'on'	  => esc_html__( 'Enable', 'cl-hotel-core' ),
						'off'	  => esc_html__( 'Disable', 'cl-hotel-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_banner_bgimg" => array(
					'label' => esc_html__( 'Breadcrumb Background Image', 'cl-hotel-core' ),
					'type'  => 'image',
					'desc'  => esc_html__( 'If not selected, default will be used', 'cl-hotel-core' ),
				),
				"{$prefix}_banner_bgcolor" => array(
					'label' => esc_html__( 'Breadcrumb Background Color', 'cl-hotel-core' ),
					'type'  => 'color_picker',
					'desc'  => esc_html__( 'If not selected, default will be used', 'cl-hotel-core' ),
				),
				"{$prefix}_banner_bgopacity" => array(
					'label' => esc_html__( 'Breadcrumb Background Opacity', 'cl-hotel-core' ),
					'type'  => 'number',
					'desc'  => esc_html__( 'Max input number will be 100', 'cl-hotel-core' ),
				),
				"{$prefix}_padding_top" => array(
					'label' => esc_html__( 'Padding Top', 'cl-hotel-core' ),
					'type'  => 'text',
					'desc'  => esc_html__( 'default banner padding top will be used 100 "px"', 'cl-hotel-core' ),
				),
				"{$prefix}_padding_bottom" => array(
					'label' => esc_html__( 'Padding Bottom', 'cl-hotel-core' ),
					'type'  => 'text',
					'desc'  => esc_html__( 'default banner padding bottom will be used 100 "px"', 'cl-hotel-core' ),
				),
				"{$prefix}_page_bgimg" => array(
					'label' => esc_html__( 'Page/Post Background Image', 'cl-hotel-core' ),
					'type'  => 'image',
					'desc'  => esc_html__( 'If not selected, default will be used', 'cl-hotel-core' ),
				),
				"{$prefix}_page_bgcolor" => array(
					'label' => esc_html__( 'Page/Post Background Color', 'cl-hotel-core' ),
					'type'  => 'color_picker',
					'desc'  => esc_html__( 'If not selected, default will be used', 'cl-hotel-core' ),
				),
			)
		)
	),
) );

if ( class_exists( 'Rtcl' ) && ! FBHelper::isEnabled() ) {
	$Postmeta->add_meta_box( 'clhotel_listing_feature_list', esc_html__( 'Faq List', 'cl-hotel-core' ), [ "rtcl_listing" ], '', '', 'default', [
		'fields' => [
			"listing_feature_list" => [
				'type'   => 'repeater',
				'button' => esc_html__( 'Add Faq', 'cl-hotel-core' ),
				'value'  => [
					"faqtitle"       => [
						'label'   => esc_html__( 'Faq Title', 'cl-hotel-core' ),
						'type'    => 'text',
						'default' => '',
					],
					"faqdesc" => [
						'label' => esc_html__( 'Description', 'cl-hotel-core' ),
						'type'  => 'textarea_html',
					],
				],
			],
		],
	] );
}


// if ( class_exists('Rtcl')) {
//     $Postmeta->add_meta_box('listing_extra_fields', esc_html__('Listing Custom Information', 'cl-hotel-core'), array("rtcl_listing"), '', '', 'high', array(
//         'fields' => array(
// 			"listing_discount" => array(
// 				'label'   => esc_html__( 'Listing Discount', 'cl-hotel-core' ),
// 				'type'    => 'text',
// 				'default' => '',
// 			),
//         )
//     ));
// }