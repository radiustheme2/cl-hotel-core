<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Hotel_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
// use Rtcl\Helpers\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Listing_Locations extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Listing Locations', 'cl-hotel-core' );
		$this->rt_base = 'rt-listing-locations';
		parent::__construct( $data, $args );

	}
    public function get_script_depends() {
		return [
			'swiper',
		];
	}
	protected function register_controls() {
        $this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Style', 'cl-hotel-core' ),
				'options' => array(
					'1' => esc_html__( 'Style 1', 'cl-hotel-core' ),
					'2' => esc_html__( 'Style 2', 'cl-hotel-core' ),
					'3' => esc_html__( 'Style 3', 'cl-hotel-core' ),
				),
				'default' => '1',
			]
		);
		$this->add_control(
			'layouts',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Layouts', 'cl-hotel-core' ),
				'options' => array(
					'grid' => esc_html__( 'Grid', 'cl-hotel-core' ),
					'slider' => esc_html__( 'Slider', 'cl-hotel-core' ),
				),
				'default' => 'grid',
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'location_name', [
				'type'    => \Elementor\Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Select Location', 'cl-hotel-core' ),
				'description' => esc_html__( 'Location background image', 'cl-hotel-core' ),
				'options' => $this->rt_get_categories_by_id('rtcl_location'),
				'multiple' => false,
				'label_block' => true,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'bgimg', [
				'type'    => Controls_Manager::MEDIA,
				'label'   => esc_html__( 'Background Image', 'cl-hotel-core' ),
				'default' => [
					'url' => $this->rt_placeholder_image(),
				],
				'description' => esc_html__( 'Select location background image', 'cl-hotel-core' ),
				'show_label' => false,
			]
		);
		$catname = get_the_category_by_ID( 'location_name' );
        $this->add_control(
			'locations',
			[
				'label'     => __( 'Add as many locations as you want', 'cl-hotel-core' ),
				'type'      => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Box Height', 'cl-hotel-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 500,
				),
				'selectors' => [
					'{{WRAPPER}} .el-location-box .rt-global-slider .location-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'display_count',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Show Listing Counts', 'cl-hotel-core' ),
				'label_on'    => esc_html__( 'On', 'cl-hotel-core' ),
				'label_off'   => esc_html__( 'Off', 'cl-hotel-core' ),
				'default'     => 'yes',
			]
		);
		$this->add_control(
			'enable_link',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Enable Link', 'cl-hotel-core' ),
				'label_on'    => esc_html__( 'On', 'cl-hotel-core' ),
				'label_off'   => esc_html__( 'Off', 'cl-hotel-core' ),
				'default'     => 'yes',
				'condition'   => array( 'style' => array( '2' ) ),
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Image Border Radius', 'cl-hotel-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .img-location .item-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .location-box-layout3.grid .item-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
        $this->end_controls_section();

		/* - Grid Settings
		======================================= */
		$this->start_controls_section(
			'sec_grid_options',
			[
				'label'     => esc_html__( 'Grid Options', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition'   => ['layouts' => ['grid' ]]
			]
		);
		$this->add_control(
			'columns_gap',
			[
				'label'   => esc_html__( 'Columns Gap', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'1' => esc_html__( 'Gap 1', 'cl-hotel-core' ),
					'2' => esc_html__( 'Gap 2', 'cl-hotel-core' ),
					'3' => esc_html__( 'Gap 3', 'cl-hotel-core' ),
					'4' => esc_html__( 'Gap 4', 'cl-hotel-core' ),
					'5' => esc_html__( 'Gap 5', 'cl-hotel-core' ),
				],
				'condition' => ['layouts' => ['grid' ]]
			]
		);
		$this->add_control(
			'desktop_grid_column',
			[
				'label'   => esc_html__( 'Desktop items', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),
				'condition' => ['layouts' => ['grid' ]]
			]
		);
		$this->add_control(
			'medium_desktop_grid_column',
			[
				'label'   => esc_html__( 'Medium Desktop items', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),
				'condition' => ['layouts' => ['grid' ]]
			]
		);
		$this->add_control(
			'tablet_grid_column',
			[
				'label'   => esc_html__( 'Tablet items', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),
				'condition' => ['layouts' => ['grid' ]]
			]
		);
		$this->add_control(
			'mobile_grid_column',
			[
				'label'   => esc_html__( 'Mobile items', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => $this->rt_grid_options(),
				'condition' => ['layouts' => ['grid' ]]
			]
		);
		$this->add_control(
			'samll_mobile_grid_column',
			[
				'label'   => esc_html__( 'Small Mobile items', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => $this->rt_grid_options(),
				'condition' => ['layouts' => ['grid' ]]
			]
		);
		$this->end_controls_section();

		/* - Carousel Settings
		======================================= */
		$this->start_controls_section(
			'sec_slider_options',
			[
				'label'     => esc_html__( 'Slider Options', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition'   => ['layouts' => ['slider' ]]
			]
		);
		
		$this->add_control(
			'slider_per_group',
			[
				'label'        => __( 'Slider Per Group', 'cl-hotel-core' ),
				'type'         => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'condition'   => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'arrows',
			[
				'label'        => __( 'Arrow', 'cl-hotel-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cl-hotel-core' ),
				'label_off'    => __( 'Hide', 'cl-hotel-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'   => ['layouts' => ['slider' ]]
			]
		);
		$this->add_responsive_control(
			'icon_position',
			[
				'label'     => __( 'Navigation Position', 'cl-hotel-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'cl-hotel-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'cl-hotel-core' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => __( 'Right', 'cl-hotel-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el-location-box.slider .section-heading' => 'justify-content:{{VALUE}}',
					
				],
				'condition' =>[
					'arrows'=>'yes'
				],
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'slider_dots',
			[
				'label'        => __( 'Dots', 'cl-hotel-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cl-hotel-core' ),
				'label_off'    => __( 'Hide', 'cl-hotel-core' ),
				'return_value' => 'yes',
				'default'      => false,
				'condition'   => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'slider_arrow',
			[
				'label'        => __( 'Arrow', 'cl-hotel-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cl-hotel-core' ),
				'label_off'    => __( 'Hide', 'cl-hotel-core' ),
				'return_value' => 'yes',
				'default'      => false,
				'condition'   => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'slider_loop',
			[
				'label'        => __( 'Infinite', 'cl-hotel-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'cl-hotel-core' ),
				'label_off'    => __( 'No', 'cl-hotel-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'slider_autoplay',
			[
				'label'        => __( 'Autoplay', 'cl-hotel-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'cl-hotel-core' ),
				'label_off'    => __( 'No', 'cl-hotel-core' ),
				'return_value' => 'yes',
				'default'      => false,
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'slider_autoplay_delay',
			[
				'label'     => __( 'Autoplay Speed', 'cl-hotel-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1000,
				'max'       => 5000,
				'step'      => 500,
				'default'   => 3000,
				'condition' => [
					'slider_autoplay' => 'yes',
				],
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'centeredSlides',
			[
				'label'        => __( 'Centered Slides', 'cl-hotel-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'cl-hotel-core' ),
				'label_off'    => __( 'No', 'cl-hotel-core' ),
				'return_value' => 'yes',
				'default'      => false,
				'description'  => __( 'If you use centered slider options then default column will not working.', 'cl-hotel-core' ),
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'cl-hotel-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 100,
				'max'     => 5000,
				'step'    => 100,
				'default' => 2000,
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'space',
			[
				'label'   => __( 'Space', 'cl-hotel-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 10,
				],
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'item',
			[
				'label'   => __( 'Desktop items', 'cl-hotel-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 3,
				],
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'medium_item',
			[
				'label'   => __( 'Medium Desktop items', 'cl-hotel-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 2,
				],
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'item_tablet',
			[
				'label'   => __( 'Tablet items', 'cl-hotel-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 2,
				],
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'item_mobile',
			[
				'label'   => __( 'Mobile items', 'cl-hotel-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 1,
				],
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->add_control(
			'item_sm_mobile',
			[
				'label'   => __( 'Small Mobile items', 'cl-hotel-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 3,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 1,
				],
				'condition' => ['layouts' => ['slider' ]]
			]
		);
		$this->end_controls_section();

		/* Box Style
		-------------------------------*/
		$this->start_controls_section(
			'locations_style',
			[
				'label' => __( 'Item Style', 'cl-hotel-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg',
				'label'    => esc_html__( 'Designation', 'cl-hotel-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Box Background', 'cl-hotel-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .location-box-layout-1, .location-box-layout-2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'cl-hotel-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .location-box-layout-1 .img-location .location-count h4.item-title a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .location-box-layout-2 .img-location .location-count h4.item-title a' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'title_h_color',
			[
				'label'     => __( 'Title Hover Color', 'cl-hotel-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .location-box-layout-1:hover .img-location .location-count h4.item-title a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .location-box-layout-2:hover .img-location .location-count h4.item-title a' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'cl-hotel-core' ),
				'selector' => '{{WRAPPER}} h4.item-title a',
				'fields_options' => [
					'typography' => [
						'label' => esc_html__('Title Typography', 'cl-hotel-core'),
					]
				],
			]
		);
		$this->add_control(
			'count_color',
			[
				'label'     => __( 'Count Color', 'cl-hotel-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .location-box-layout-1 .img-location .location-count .listing-number' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .location-box-layout-2 .img-location .location-count .listing-number' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'count_h_color',
			[
				'label'     => __( 'Count Hover Color', 'cl-hotel-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .location-box-layout-1:hover .img-location .location-count .listing-number' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .location-box-layout-2:hover .img-location .location-count .listing-number' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'cl-hotel-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .location-box-layout-1:hover .img-location .btn-box a' => 'color: {{VALUE}} !important',
				],
				'condition' => ['style' => ['2' ]]
			]
		);
		$this->add_control(
			'icon_h_color',
			[
				'label'     => __( 'Icon Hover Color', 'cl-hotel-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .location-box-layout-2:hover .img-location .btn-box a' => 'color: {{VALUE}} !important',
				],
				'condition' => ['style' => ['2' ]]
			]
		);

		$this->end_controls_section();
    }

    protected function rt_term_post_count( $term_id ) {
		$args = [
			'nopaging'            => true,
			'fields'              => 'ids',
			'post_type'           => 'rtcl_listing',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'suppress_filters'    => false,
			'tax_query'           => [
				[
					'taxonomy' => 'rtcl_location',
					'field'    => 'term_id',
					'terms'    => $term_id,
				],
			],
		];

		$posts = get_posts( $args );
		return count( $posts );
	}
	protected function render() {
		$data = $this->get_settings();


		if($data['slider_autoplay']=='yes'){
			$data['slider_autoplay']=true;
		}
		else{
			$data['slider_autoplay']=false;
		}
		$slider_data = array(
			'slidesPerView' 	=>1,
			'loop'				=>$data['slider_loop']=='yes' ? true:false,
			'centeredSlides'	=>$data['centeredSlides']=='yes' ? true:false ,
			'slideToClickedSlide' =>true,
			'spaceBetween'		=>$data['space']['size'],
			'slidesPerGroup'		=>$data['slider_per_group']['size'],
			'autoplay'				=>array(
				'delay'  => $data['slider_autoplay_delay'],
			),
			'speed'      =>$data['speed'],
			'auto'		=>$data['slider_autoplay'], 
			'breakpoints' =>array(
				'0'    =>array('slidesPerView' =>1),
				'480'    =>array('slidesPerView'  =>$data['item_mobile']['size']),
				'768'    =>array('slidesPerView'  =>$data['item_tablet']['size']),
				'992'    =>array('slidesPerView'  =>$data['medium_item']['size']),		
				'1600'    =>array('slidesPerView' =>$data['item']['size'])
			),
		);
		$data['slider_data'] = wp_json_encode( $slider_data );

		if ($data['layouts'] == 'slider' ) {
			$template = 'view-2';
		} else {
			$template = 'view-1';
		}

		$this->rt_template( $template, $data );
	}

}