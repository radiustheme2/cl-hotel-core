<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

 namespace RadiusTheme\CL_Hotel_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rt_Pricing extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Pricing', 'cl-hotel-core' );
		$this->rt_base = 'rt-pricing-table';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		/* -- Settings Options -- */
		$this->__options_settings_controls();

		/* -- Styles Options -- */
		$this->__price_box_style_settings_controls();
		$this->__price_box_header_style_settings_controls();
		$this->__price_box_button_style_settings_controls();
		$this->__price_features_style_settings_controls();
		$this->__price_badge_style_settings_controls();
	}


	protected function __options_settings_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Title Alignment', 'cl-hotel-core' ),
				'options' => $this->rt_alignment_options(),
				'prefix_class' => 'elementor-align-',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .testimonial-block' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'pricing_tabs_controls' );
			$this->__monthly_pricing_table_settings_tab();
			$this->__yearly_pricing_table_settings_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __monthly_pricing_table_settings_tab() {
		/* - Monthly tab -*/
		$this->start_controls_tab(
			'monthly_pricing_tab',
			[
				'label' => __( 'Monthly', 'cl-hotel-core' ),
			]
		);
		$monthlyRepeater = new \Elementor\Repeater();
		$monthlyRepeater->add_control(
			'm_title',
			[
				'label'       => __( 'Title', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Enter Title', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$monthlyRepeater->add_control(
			'm_desc',
			[
				'label'       => __( 'Description', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Enter Description', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$monthlyRepeater->add_control(
			'm_price',
			[
				'label'       => __( 'Price', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '$19.00', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$monthlyRepeater->add_control(
			'm_btn',
			[
				'label'       => __( 'Button Text', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Get It Now', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$monthlyRepeater->add_control(
			'm_link', [
				'label' => __('Link', 'cl-hotel-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'cl-hotel-core'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$monthlyRepeater->add_control(
			'm_list', [
				'type' => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Price List', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$monthlyRepeater->add_control(
			'badge_text',
			[
				'label'       => __( 'Badge Text', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'm_tab_name',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Tab Name', 'cl-hotel-core' ),
				'default' => 'Monthly',
				'label_block' => true,
			]
		);
		$this->add_control(
			'monthly_items',
			[
				'label'       => __( 'Monthly Items', 'cl-hotel-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $monthlyRepeater->get_controls(),
				'default'     => [
					[
						'm_title'        => __( 'Basic', 'cl-hotel-core' ),
						'm_desc' => __( 'Hahean anunknown printer took galley of type and scrambled', 'cl-hotel-core' ),
						'm_price'     => __( '$19.00','cl-hotel-core' ),
					],
					[
						'm_title'        => __( 'Standard', 'cl-hotel-core' ),
						'm_desc' => __( 'Hahean anunknown printer took galley of type and scrambled', 'cl-hotel-core' ),
						'm_price'     => __( '$39.00','cl-hotel-core' ),
					],
					[
						'm_title'        => __( 'Enterprise', 'cl-hotel-core' ),
						'm_desc' => __( 'Hahean anunknown printer took galley of type and scrambled', 'cl-hotel-core' ),
						'm_price'     => __( '$199.00','cl-hotel-core' ),
					],
				],
				'title_field' => '{{{ m_title }}}',
			]
		);
		$this->end_controls_tab();
	}

	protected function __yearly_pricing_table_settings_tab() {
		/* - Monthly tab -*/
		$this->start_controls_tab(
			'yearly_pricing_tab',
			[
				'label' => __( 'Yearly', 'cl-hotel-core' ),
			]
		);
		$yearlyRepeater = new \Elementor\Repeater();
		$yearlyRepeater->add_control(
			'y_title',
			[
				'label'       => __( 'Title', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Enter Title', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$yearlyRepeater->add_control(
			'y_desc',
			[
				'label'       => __( 'Description', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Enter Description', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$yearlyRepeater->add_control(
			'y_price',
			[
				'label'       => __( 'Price', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '$19.00', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$yearlyRepeater->add_control(
			'y_btn',
			[
				'label'       => __( 'Button Text', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Get It Now', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$yearlyRepeater->add_control(
			'y_link', [
				'label' => __('Link', 'cl-hotel-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'cl-hotel-core'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$yearlyRepeater->add_control(
			'y_list', [
				'type' => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Price List', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'y_tab_name',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Tab Name', 'cl-hotel-core' ),
				'default' => 'Yearly',
				'label_block' => true,
			]
		);
		$this->add_control(
			'yearly_items',
			[
				'label'       => __( 'Yearly Items', 'cl-hotel-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $yearlyRepeater->get_controls(),
				'default'     => [
					[
						'y_title'        => __( 'Basic', 'cl-hotel-core' ),
						'y_desc' => __( 'Hahean anunknown printer took galley of type and scrambled', 'cl-hotel-core' ),
						'y_price'     => __( '$39.00','cl-hotel-core' ),
					],
					[
						'y_title'        => __( 'Standard', 'cl-hotel-core' ),
						'y_desc' => __( 'Hahean anunknown printer took galley of type and scrambled', 'cl-hotel-core' ),
						'y_price'     => __( '$99.00','cl-hotel-core' ),
					],
					[
						'y_title'        => __( 'Enterprise', 'cl-hotel-core' ),
						'y_desc' => __( 'Hahean anunknown printer took galley of type and scrambled', 'cl-hotel-core' ),
						'y_price'     => __( '$499.00','cl-hotel-core' ),
					],
				],
				'title_field' => '{{{ y_title }}}',
			]
		);
		$this->end_controls_tab();
	}

	protected function __price_box_style_settings_controls() {
		$this->start_controls_section(
			'price_box_style',
			[
				'label' => __( 'Box Style', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'price_box_bg',
				'label'    => esc_html__( 'Background', 'cl-hotel-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Box Background', 'cl-hotel-core'),
					]
				],
				'selector' => '{{WRAPPER}} .rt-price-tab-box',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'price_box_border',
				'label'     => __( 'Border', 'cl-hotel-core' ),
				'selector'  => '{{WRAPPER}} .rt-price-tab-box',
			]
		);
		$this->add_responsive_control(
			'price_box_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .rt-price-tab-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_responsive_control(
			'price_box_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .rt-price-tab-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __price_box_header_style_settings_controls() {
		$this->start_controls_section(
			'price_header_style',
			[
				'label' => __( 'Header Style', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'price_header_line',
				'label'    => esc_html__( 'Background', 'cl-hotel-core' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Line Color', 'cl-hotel-core'),
					]
				],
				'selector' => '{{WRAPPER}} .rt-title:before',
			]
		);
		//Title
		$this->add_control(
			'title_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Title Style', 'cl-hotel-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Title Color', 'cl-hotel-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .rt-title' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Title Typography', 'cl-hotel-core' ),
				'selector' => '{{WRAPPER}} .rt-title',
			]
		);
		$this->add_responsive_control(
			'title_gapping',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Title Gap', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .rt-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		//Description
		$this->add_control(
			'desc_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Description Style', 'cl-hotel-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'desc_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Description Color', 'cl-hotel-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .rt-desc' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typo',
				'label'    => esc_html__( 'Description Typography', 'cl-hotel-core' ),
				'selector' => '{{WRAPPER}} .rt-desc',
			]
		);
		$this->add_responsive_control(
			'desc_gapping',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Description Gap', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .rt-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		//Price
		$this->add_control(
			'price_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Price Style', 'cl-hotel-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'price_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Price Color', 'cl-hotel-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .rt-price' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'price_typo',
				'label'    => esc_html__( 'Price Typography', 'cl-hotel-core' ),
				'selector' => '{{WRAPPER}} .rt-price',
			]
		);
		$this->add_responsive_control(
			'price_gapping',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Price Gap', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .rt-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __price_box_button_style_settings_controls() {
		// Button Style
		$this->start_controls_section(
			'btn_style',
			[
				'label'     => esc_html__( 'Button', 'cl-hotel-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'btn_heading',
				[
					'type' => Controls_Manager::HEADING,
					'label'   => esc_html__( 'Button Style', 'cl-hotel-core' ),
					'separator' => 'before',
				]
			);

			$this->start_controls_tabs( 'price_btn_tab_style' );
				// Normal tab.
				$this->start_controls_tab(
					'price_btn_style_normal',
					[
						'label' => __( 'Normal', 'cl-hotel-core' ),
					]
				);

				$this->add_control(
					'price_btn_color',
					[
						'type'    => Controls_Manager::COLOR,
						'label'   => esc_html__( 'Color', 'cl-hotel-core' ),
						'selectors' => array( 
							'{{WRAPPER}} .item-btn' => 'color: {{VALUE}}',
						),
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'     => 'price_btn_typo',
						'label'    => esc_html__( 'Typography', 'cl-hotel-core' ),
						'selector' => '{{WRAPPER}} .item-btn',
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'     => 'price_btn_bg_color',
						'label'    => esc_html__( 'Background', 'cl-hotel-core' ),
						'types' => [ 'classic', 'gradient' ],
						'fields_options' => [
							'background' => [
								'label' => esc_html__('Background Color', 'cl-hotel-core'),
							]
						],
						'selector' => '{{WRAPPER}} .item-btn',
					]
				);
				$this->add_responsive_control(
					'price_btn_padding',
					[
						'type'    => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'label'   => esc_html__( 'Padding', 'cl-hotel-core' ),                 
						'selectors' => array(
							'{{WRAPPER}} .item-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
						),
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'price_btn_border',
						'label'     => __( 'Border', 'cl-hotel-core' ),
						'selector'  => '{{WRAPPER}} .item-btn',
					]
				);
				$this->end_controls_tab();

				// Hover tab.
				$this->start_controls_tab(
					'price_btn_style_hover',
					[
						'label' => __( 'Hover', 'cl-hotel-core' ),
					]
				);
				$this->add_control(
					'price_btn_h_color',
					[
						'type'    => Controls_Manager::COLOR,
						'label'   => esc_html__( 'Color', 'cl-hotel-core' ),
						'selectors' => array( 
							'{{WRAPPER}} .item-btn:hover' => 'color: {{VALUE}}',
						),
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'     => 'price_btn_hbg_color',
						'label'     => __( 'Background', 'cl-hotel-core' ),
						'selector'  => '{{WRAPPER}} .item-btn:hover',
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'price_btn_hover_border',
						'label'     => __( 'Border', 'cl-hotel-core' ),
						'selector'  => '{{WRAPPER}} .item-btn:hover',
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function __price_features_style_settings_controls() {
		$this->start_controls_section(
			'price_features_style',
			[
				'label' => __( 'Features Style', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		//Text
		$this->add_control(
			'text_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Text Style', 'cl-hotel-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'text_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Text Color', 'cl-hotel-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .rt-features-list ul li' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typo',
				'label'    => esc_html__( 'Typography', 'cl-hotel-core' ),
				'selector' => '{{WRAPPER}} .rt-features-list ul li',
			]
		);
		$this->add_control(
			'gap',
			[
				'label' => esc_html__( 'Gap between icon and text', 'cl-hotel-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 7,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-features-list ul li' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-features-list ul li del' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		//Icon
		$this->add_control(
			'icon_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Icon Style', 'cl-hotel-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon Color', 'cl-hotel-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .rt-features-list ul li i' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'cl-hotel-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-features-list ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		//Inactive
		$this->add_control(
			'inactive_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Inactive items', 'cl-hotel-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'inactive_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Inactive Color', 'cl-hotel-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .rt-features-list ul li del' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-features-list ul li del i' => 'color: {{VALUE}}',
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __price_badge_style_settings_controls() {
		$this->start_controls_section(
			'price_badge_style',
			[
				'label' => __( 'Badge Style', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'badge_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Text Color', 'cl-hotel-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .rt-price-tab-box .badge' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'badge_typo',
				'label'    => esc_html__( 'Typography', 'cl-hotel-core' ),
				'selector' => '{{WRAPPER}} .rt-price-tab-box .badge',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'badge_bg_color',
				'label'    => esc_html__( 'Background', 'cl-hotel-core' ),
				// 'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background Color', 'cl-hotel-core'),
					]
				],
				'selector' => '{{WRAPPER}} .rt-price-tab-box .badge',
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view';

		$this->rt_template( $template, $data );
	}

}