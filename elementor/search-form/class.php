<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/contact-box/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Hotel_Core;

if (!class_exists( 'RtclPro' )) return;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Rt_Search_Form extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Search Form', 'cl-hotel-core' );
		$this->rt_base = 'rt-search-form';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'Search Form', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Style', 'cl-hotel-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1', 'cl-hotel-core' ),
					'style2' => esc_html__( 'Style 2', 'cl-hotel-core' ),
				),
				'default' => 'style1',
			]
		);
		$this->add_control(
			'listing_banner_search_style',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Listing Search Type', 'cl-hotel-core' ),
				'default' => 'standard',
				'options' => array(
					'popup'      => esc_html__( 'Popup', 'cl-hotel-core' ),
					'standard'   => esc_html__( 'Standard', 'cl-hotel-core' ),
					'suggestion' => esc_html__( 'Auto Suggestion', 'cl-hotel-core' ),
					'dependency' => esc_html__( 'Dependency Selection', 'cl-hotel-core' ),
				),
			]
		);
		$this->add_control(
			'search_keyword',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Search by Keyword', 'cl-hotel-core' ),
				'label_on'    => esc_html__( 'On', 'cl-hotel-core' ),
				'label_off'   => esc_html__( 'Off', 'cl-hotel-core' ),
				'return_value' => 'on',
				'default' 	   => 'on',
				'description' => esc_html__( 'Enable or disable search by keyword. Default: On', 'cl-hotel-core' ),
			]
		);
		$this->add_control(
			'search_location',
			[
				'type'        => Controls_Manager::SWITCHER,
				'id'          => '',
				'label'       => esc_html__( 'Search by Location', 'cl-hotel-core' ),
				'label_on'    => esc_html__( 'On', 'cl-hotel-core' ),
				'label_off'   => esc_html__( 'Off', 'cl-hotel-core' ),
				'return_value' => 'on',
				'default' 	   => 'on',
				'description' => esc_html__( 'Enable or disable search by location. Default: On', 'cl-hotel-core' ),
			]
		);
		$this->add_control(
			'search_category',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Search by Category', 'cl-hotel-core' ),
				'label_on'    => esc_html__( 'On', 'cl-hotel-core' ),
				'label_off'   => esc_html__( 'Off', 'cl-hotel-core' ),
				'return_value' => 'on',
				'default' 	   => 'on',
				'description' => esc_html__( 'Enable or disable search by category. Default: On', 'cl-hotel-core' ),
			]
		);
		$this->add_control(
			'css_class',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Css class', 'cl-hotel-core' ),
				'description' => esc_html__( 'Extra class for css, if need', 'cl-hotel-core' ),
			]
		);
	}

	public function custom_fonts(){
		wp_enqueue_style( 'custom-fonts' );
	}

	protected function render() {
		$data = $this->get_settings();
		$this->custom_fonts();
		switch ($data['style']) {
			case 'style2':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
				break;
		}
		return $this->rt_template( $template, $data );
	}
}