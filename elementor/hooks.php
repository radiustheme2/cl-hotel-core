<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Hotel_Core;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;

class Plugins_Hooks {

	protected static $instance = null;

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

    public function __construct() {
		add_filter( 'rtcl_el_category_box_style', [ $this, 'cl_hotel_listing_category_box_style' ], 10 );
        add_filter('rtcl_el_listing_category_widget_general_field', [ $this, 'category_settings_new_fields'], 10, 2 );
        add_filter('rtcl_el_listing_category_widget_general_field', [ $this, 'category_settings_cols_modity'], 10, 2 );
        add_filter('rtcl_el_listing_category_widget_style_field', [ $this, 'category_settings_style_modity'], 10, 2 );
        add_filter('rtcl_el_listing_category_widget_style_field', [ $this, 'category_settings_add_new_style'], 10, 2 );

        add_filter('el_listing_widget_content_visibility_fields', [ $this, 'listing_slider_settings_field_new_control'], 10, 2 );
        add_filter('rtcl_el_listing_slider_widget_general_field', [ $this, 'listing_slider_settings_field_modifications'], 11, 2 );	
		add_filter('el_listing_widget_content_visibility_fields', [ $this, 'listing_grid_settings_field_new_control'], 10, 2 );	

		//change content visibility fields
		add_filter('el_listing_widget_content_visibility_fields', function( $fields , $obj ){
			if( 'rtcl-listing-items' == $obj->rtcl_base ){
				$fields = $obj->remove_controls(
					array(
						'rtcl_show_details_button'
					),
					$fields
				);
			}
			return $fields;
		}, 10, 2 );
    }

	
	/**
	 * Undocumented function
	 *
	 * @param [array] $data array for list style.
	 *
	 * @return array
	 */
	public static function cl_hotel_listing_category_box_style( $data ) {
		$data['style-3'] = esc_html__( 'Style 3', 'cl-hotel-core' );
		return $data;
	}

	public function rt_alignment_options(){
		return array(
			'left'    => array(
				'title' => __( 'Left', 'cl-hotel-core' ),
				'icon' => 'eicon-text-align-left',
			),
			'center' => array(
				'title' => __( 'Center', 'cl-hotel-core' ),
				'icon' => 'eicon-text-align-center',
			),
			'right' => array(
				'title' => __( 'Right', 'cl-hotel-core' ),
				'icon' => 'eicon-text-align-right',
			),
			'justify' => array(
				'title' => __( 'Justified', 'cl-hotel-core' ),
				'icon' => 'eicon-text-align-justify',
			),
		);
	}

	public function category_settings_new_fields( $fields, $obj ){

		if( 'rtcl-listing-cat-box' == $obj->rtcl_base ){

			$cat_label = array(
				array(
					'id'      => 'cat_label',
					'type'    => Controls_Manager::TEXT,
					'label'   => esc_html__( ' Category Label', 'cl-hotel-core' ),
					'condition'   => [ 'rtcl_cats_style' => 'style-3'],	
					'description' => esc_html__( 'Keyword field position', 'cl-hotel-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_cats', $cat_label, $fields );
		}

		return $fields;
	}

	public function category_settings_cols_modity( $fields, $obj ){
		$modify_array = array(
			array(
				'id'        => 'rtcl_sec_responsive',
				'condition'   => [ 'rtcl_cats_style' => ['style-1', 'style-2']],	
			),			
			array(
				'id'        => 'rtcl_col_xl',
				'condition'   => [ 'rtcl_cats_style' => ['style-1', 'style-2']],	
			),			
		);
		$fields = $obj->modify_controls( $modify_array, $fields );

		return $fields;
	}

	public function category_settings_style_modity( $fields, $obj ){
		$modify_array = array(
			array(
				'id'        => 'rtcl_background_body',
				'condition'   => [ 'rtcl_cats_style' => ['style-2', 'style-3']],	
			),			
		);
		$fields = $obj->modify_controls( $modify_array, $fields );

		return $fields;
	}

	public function category_settings_add_new_style( $fields, $obj ){
		if( 'rtcl-listing-cat-box' == $obj->rtcl_base ){
			$label_color = array(
				array(
					'id'      => 'label_color',
					'mode'    => 'responsive',
					'type'    => Controls_Manager::COLOR,
					'label'   => esc_html__( 'label Color', 'cl-hotel-core' ),
					'selectors' => array( 
						'{{WRAPPER}} .cat-items-label' => 'color: {{VALUE}}'
					),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_title_color', $label_color, $fields );
		}

		return $fields;
	}

	public function listing_slider_settings_field_new_control( $fields, $obj ){

		if( 'rtcl-listing-slider' == $obj->rtcl_base ){

			$rtcl_show_gallery = array(
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_gallery',
					'label'       => __( 'Show Gallery Button', 'cl-hotel-core' ),
					'label_on'    => __( 'On', 'cl-hotel-core' ),
					'label_off'   => __( 'Off', 'cl-hotel-core' ),
					'default'     => 'yes',
					'description' => __( 'Show or Hide Listing On/Off. Default: On', 'cl-hotel-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_show_image', $rtcl_show_gallery, $fields, true );

			$rtcl_show_review = array(
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_review',
					'label'       => __( 'Show Reviews', 'cl-hotel-core' ),
					'label_on'    => __( 'On', 'cl-hotel-core' ),
					'label_off'   => __( 'Off', 'cl-hotel-core' ),
					'default'     => 'yes',
					'description' => __( 'Show or Hide Listing Reviews Button. Default: On', 'cl-hotel-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_show_favourites', $rtcl_show_review, $fields, true );
		}
		return $fields;
	}

	public function listing_slider_settings_field_modifications( $fields, $obj ){
		if( 'rtcl-listing-slider' == $obj->rtcl_base ){
			
			$modify_fields = array(
				array(
					'id'        => 'rtcl_show_phone',
					'unset'     => array(
						'conditions',
						'condition',
					),
					
				),
			);
			$fields = $obj->modify_controls( $modify_fields, $fields );
		}

		return $fields;
	}

	public function listing_grid_settings_field_new_control( $fields, $obj ){

		if( 'rtcl-listing-items' == $obj->rtcl_base ){

			$rtcl_show_gallery = array(
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_gallery',
					'label'       => __( 'Show Gallery Button', 'cl-hotel-core' ),
					'label_on'    => __( 'On', 'cl-hotel-core' ),
					'label_off'   => __( 'Off', 'cl-hotel-core' ),
					'default'     => 'yes',
					'description' => __( 'Show or Hide Listing On/Off. Default: On', 'cl-hotel-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_show_image', $rtcl_show_gallery, $fields, true );

			$rtcl_show_review = array(
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_review',
					'label'       => __( 'Show Reviews', 'cl-hotel-core' ),
					'label_on'    => __( 'On', 'cl-hotel-core' ),
					'label_off'   => __( 'Off', 'cl-hotel-core' ),
					'default'     => 'yes',
					'description' => __( 'Show or Hide Listing Reviews Button. Default: On', 'cl-hotel-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_show_favourites', $rtcl_show_review, $fields, true );
		}
		return $fields;
	}

}

Plugins_Hooks::instance();