<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/title/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Hotel_Core;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit;

class Rt_Infobox extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Info Box', 'cl-hotel-core' );
		$this->rt_base = 'rt-infobox';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		/* -- Settings Options -- */
		$this->__options_settings_controls();

		/* -- Styles Options -- */
		$this->__infobox_style_settings_controls();
		$this->__infobox_icon_style_settings_controls();
		$this->__infobox_title_style_settings_controls();
		$this->__infobox_description_style_settings_controls();
		$this->__infobox_button_style_settings_controls();

	}

	protected function __options_settings_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'icon',
			[
				'type'        => Controls_Manager::ICONS,
				'label'   => esc_html__( 'Icon', 'cl-hotel-core' ),
				'default' => array(
					'value' => 'fas fa-smile-wink',
					'library' => 'fa-solid',
				),
			]
		);
		$this->add_control(
			'title',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'cl-hotel-core' ),
				'default' => 'Infobox Title',
				'label_block' => true,
			]
		);
		$this->add_responsive_control(
			'heading_tag',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'HTML Tag', 'cl-hotel-core' ),
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h3',
			]
		);
		$this->add_control(
			'desc',
			[
				'type'    => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Description', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'btntext',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Text', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'url',
			[
				'type'  => Controls_Manager::URL,
				'label' => esc_html__( 'Link', 'cl-hotel-core' ),
				'placeholder' => 'https://your-link.com',
				'label_block' => true,
			]
		);
		
		$this->add_responsive_control(
			'icon_position',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Icon Position', 'cl-hotel-core' ),
				'options' => [
					'left'    => array(
						'title' => __( 'Left', 'cl-hotel-core' ),
						'icon' => 'eicon-arrow-left',
					),
					'top' => array(
						'title' => __( 'Top', 'cl-hotel-core' ),
						'icon' => 'eicon-arrow-up',
					),
					'right' => array(
						'title' => __( 'Right', 'cl-hotel-core' ),
						'icon' => 'eicon-arrow-right',
					),
				],
				'default' => 'top',
			]
		);

		$this->add_responsive_control(
			'alignment1',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Icon Alignment left/right', 'cl-hotel-core' ),
				'options' => [
					'flex-start'    => array(
						'title' => __( 'Left', 'cl-hotel-core' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'cl-hotel-core' ),
						'icon' => 'eicon-text-align-center',
					),
					'flex-end' => array(
						'title' => __( 'Right', 'cl-hotel-core' ),
						'icon' => 'eicon-text-align-right',
					),
				],
				'prefix_class' => 'elementor-align-',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .info-box' => 'align-items: {{VALUE}};',
				],
				'condition'   => [
					'icon_position' => 'top',
				],
			]
		);
		$this->add_responsive_control(
			'textalign2',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Text Alignment left/right', 'cl-hotel-core' ),
				'options' => [
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
				],
				'prefix_class' => 'elementor-align-',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .info-box' => 'text-align: {{VALUE}};',
				],
				'condition'   => [
					'icon_position' => 'top',
				],
			]
		);

		$this->add_responsive_control(
			'alignment3',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Text Alignment top/bottom', 'cl-hotel-core' ),
				'options' => [
					'flex-start'    => array(
						'title' => __( 'Top', 'cl-hotel-core' ),
						'icon' => 'eicon-v-align-top',
					),
					'center' => array(
						'title' => __( 'Middle', 'cl-hotel-core' ),
						'icon' => 'eicon-v-align-middle',
					),
					'flex-end' => array(
						'title' => __( 'Bottom', 'cl-hotel-core' ),
						'icon' => 'eicon-v-align-bottom',
					),
				],
				'prefix_class' => 'elementor-align-',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .info-box' => 'align-items: {{VALUE}};',
				],
				'condition'   => [
					'icon_position' => ['left', 'right'],
				],
			]
		);
		$this->add_responsive_control(
			'textalign4',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Text Alignment left/right', 'cl-hotel-core' ),
				'options' => [
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
				],
				'prefix_class' => 'elementor-align-',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .info-box' => 'text-align: {{VALUE}};',
				],
				'condition'   => [
					'icon_position' => ['left', 'right'],
				],
			]
		);

		$this->add_control(
			'css_classes',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'CSS Clasess', 'cl-hotel-core' ),
				'label_block' => true,
			]
		);
		$this->end_controls_section();
	}

	protected function __infobox_style_settings_controls() {
		// Box Style
		$this->start_controls_section(
			'box_settings',
			[
				'label'     => esc_html__( 'Info Box', 'cl-hotel-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'infobox_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .info-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_responsive_control(
			'infobox_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'infobox_border',
				'label'     => __( 'Border', 'cl-hotel-core' ),
				'selector'  => '{{WRAPPER}} .info-box',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'infobox_bg',
				'label'    => esc_html__( 'Background', 'cl-hotel-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Infobox Background', 'cl-hotel-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .info-box',
			]
		);
		$this->add_responsive_control(
			'infobox_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __infobox_icon_style_settings_controls() {
		// Icon Box
		$this->start_controls_section(
			'iconbox_settings',
			[
				'label'     => esc_html__( 'Icon Box', 'cl-hotel-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
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
					'size' => 36,
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'iconbox_width',
			[
				'label' => esc_html__( 'Width', 'cl-hotel-core' ),
				'type' => Controls_Manager::SLIDER,
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
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'iconbox_height',
			[
				'label' => esc_html__( 'Height', 'cl-hotel-core' ),
				'type' => Controls_Manager::SLIDER,
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
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'iconbox_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_responsive_control(
			'iconbox_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border',
				'label'     => __( 'Border', 'cl-hotel-core' ),
				'selector'  => '{{WRAPPER}} .icon-box',
			]
		);

		$this->start_controls_tabs( 'iconbox_tab_style' );
			// Normal tab.
			$this->start_controls_tab(
				'iconbox_style_normal',
				[
					'label' => __( 'Normal', 'cl-hotel-core' ),
				]
			);
			$this->add_control(
				'icon_color',
				[
					'type'    => Controls_Manager::COLOR,
					'label'   => esc_html__( 'Color', 'cl-hotel-core' ),
					'selectors' => array( 
						'{{WRAPPER}} .info-box .icon-box' => 'color: {{VALUE}}'
					),
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'icon_box_bg',
					'label'    => esc_html__( 'Background', 'cl-hotel-core' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Infobox Background', 'cl-hotel-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .icon-box',
				]
			);
			$this->add_responsive_control(
				'iconbox_radius',
				[
					'type'    => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'label'   => esc_html__( 'Radius', 'cl-hotel-core' ),                 
					'selectors' => array(
						'{{WRAPPER}} .icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
					),
				]
			);
			$this->end_controls_tab();

			// Hover tab.
			$this->start_controls_tab(
				'iconbox_style_hover',
				[
					'label' => __( 'Hover', 'cl-hotel-core' ),
				]
			);
			$this->add_control(
				'icon_h_color',
				[
					'type'    => Controls_Manager::COLOR,
					'label'   => esc_html__( 'Color', 'cl-hotel-core' ),
					'selectors' => array( 
						'{{WRAPPER}} .info-box:hover .item-title' => 'color: {{VALUE}}'
					),
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'icon_h_box_bg',
					'label'    => esc_html__( 'Background', 'cl-hotel-core' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Infobox Background', 'cl-hotel-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .info-box:hover .icon-box',
				]
			);
			$this->add_responsive_control(
				'iconbox_h_radius',
				[
					'type'    => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'label'   => esc_html__( 'Radius', 'cl-hotel-core' ),                 
					'selectors' => array(
						'{{WRAPPER}} .info-box:hover .icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
					),
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function __infobox_title_style_settings_controls() {
		// Title Style
		$this->start_controls_section(
			'title_settings',
			[
				'label'     => esc_html__( 'Title', 'cl-hotel-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
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
				'label'   => esc_html__( 'Color', 'cl-hotel-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .item-title' => 'color: {{VALUE}}'
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'cl-hotel-core' ),
				'selector' => '{{WRAPPER}} .item-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __infobox_description_style_settings_controls() {
		// Description Style
		$this->start_controls_section(
			'desc_settings',
			[
				'label'     => esc_html__( 'Description', 'cl-hotel-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
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
				'label'   => esc_html__( 'Color', 'cl-hotel-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .info-box p' => 'color: {{VALUE}}'
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typo',
				'label'    => esc_html__( 'Typography', 'cl-hotel-core' ),
				'selector' => '{{WRAPPER}} .info-box p',
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .info-box p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __infobox_button_style_settings_controls() {
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

		$this->start_controls_tabs( 'btn_tab_style' );
		// Normal tab.
		$this->start_controls_tab(
			'btn_style_normal',
			[
				'label' => __( 'Normal', 'cl-hotel-core' ),
			]
		);

		$this->add_control(
			'btn_color',
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
				'name'     => 'btn_typo',
				'label'    => esc_html__( 'Typography', 'cl-hotel-core' ),
				'selector' => '{{WRAPPER}} .item-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_bg_color',
				'label'     => __( 'Background', 'cl-hotel-core' ),
				'selector'  => '{{WRAPPER}} .item-btn',
			]
		);
		$this->add_responsive_control(
			'btn_padding',
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
				'name'     => 'btn_border',
				'label'     => __( 'Border', 'cl-hotel-core' ),
				'selector'  => '{{WRAPPER}} .item-btn',
			]
		);
		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'btn_style_hover',
			[
				'label' => __( 'Hover', 'cl-hotel-core' ),
			]
		);
		$this->add_control(
			'btn_h_color',
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
				'name'     => 'btn_hbg_color',
				'label'     => __( 'Background', 'cl-hotel-core' ),
				'selector'  => '{{WRAPPER}} .item-btn:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_hover_border',
				'label'     => __( 'Border', 'cl-hotel-core' ),
				'selector'  => '{{WRAPPER}} .item-btn:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view';

		return $this->rt_template( $template, $data );
	}
}