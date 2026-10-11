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

class Rt_Authors extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Top Authors', 'cl-hotel-core' );
		$this->rt_base = 'rt-authors';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		/* -- Settings Options -- */
		$this->__options_settings_controls();

		/* -- Styles Options -- */
		$this->__name_designation_style_settings_controls();
		$this->__listing_counting_style_settings_controls();
		$this->__socials_style_settings_controls();
	}

	protected function __options_settings_controls() {
		$this->start_controls_section(
			'rt_authors_grid',
			[
				'label' => esc_html__( 'Authors', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1', 'cl-hotel-core' ),
				],

			]
		);
		$this->add_control(
			'post_limit',
			[
				'label'       => __( 'Post Limit', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post Limit', 'cl-hotel-core' ),
				'description' => __( 'Enter number of post to show.', 'cl-hotel-core' ),
				'default'     => '3',
			]
		);
		$this->add_control(
			'post_source',
			[
				'label'       => __( 'Agent Source', 'cl-hotel-core' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'most_recent' => __( 'From all recent agent', 'cl-hotel-core' ),
					'by_agency'   => __( 'By Agency', 'cl-hotel-core' ),
					'by_id'       => __( 'By Agent ID', 'cl-hotel-core' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'cl-hotel-core' ),
			]
		);
		$this->add_control(
			'agencies',
			[
				'label'       => __( 'Choose Agency', 'cl-hotel-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_get_agency_list(),
				'condition'   => [
					'post_source' => 'by_agency',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'post_id',
			[
				'label'       => __( 'Enter Agent IDs', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Enter the agent IDs separated by comma', 'cl-hotel-core' ),
				'label_block' => 'true',
				'condition'   => [
					'post_source' => 'by_id',
				],
			]
		);
		$this->add_control(
			'offset',
			[
				'label'       => __( 'Agent offset', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post offset', 'cl-hotel-core' ),
				'description' => __( 'Number of post to displace or pass over. The offset parameter is ignored when post limit => -1 (show all posts) is used.', 'cl-hotel-core' ),
			]
		);
		$this->add_control(
			'exclude',
			[
				'label'       => __( 'Exclude agent', 'cl-hotel-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => 'true',
				'description' => __( 'Enter the post IDs separated by comma for exclude', 'cl-hotel-core' ),
			]
		);
		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'date'          => __( 'Date', 'cl-hotel-core' ),
					'ID'            => __( 'Order by post ID', 'cl-hotel-core' ),
					'author'        => __( 'Author', 'cl-hotel-core' ),
					'title'         => __( 'Title', 'cl-hotel-core' ),
					'modified'      => __( 'Last modified date', 'cl-hotel-core' ),
					'parent'        => __( 'Post parent ID', 'cl-hotel-core' ),
					'comment_count' => __( 'Number of comments', 'cl-hotel-core' ),
					'menu_order'    => __( 'Menu order', 'cl-hotel-core' ),
					'rand'          => __( 'Random order', 'cl-hotel-core' ),
				],
			]
		);
		$this->add_control(
			'order',
			[
				'label'   => __( 'Sort order', 'cl-hotel-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ASC'  => __( 'ASC', 'cl-hotel-core' ),
					'DESC' => __( 'DESC', 'cl-hotel-core' ),
				],
			]
		);

		/* -- Columns -- */
		$this->add_control(
			'gridcolumn-popover-toggle',
			[
				'label'        => __( 'Grid Column', 'cl-hotel-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'cl-hotel-core' ),
				'label_on'     => __( 'Custom', 'cl-hotel-core' ),
				'return_value' => 'yes',
			]
		);
		$this->start_popover();

		$this->add_control(
			'desktop',
			[
				'label'   => esc_html__( 'Grid Column for Desktop', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),

			]
		);

		$this->add_control(
			'medium_desktop',
			[
				'label'   => esc_html__( 'Grid Column for Medium Desktop', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),

			]
		);

		$this->add_control(
			'tablet',
			[
				'label'   => esc_html__( 'Grid Column for Tablet', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => $this->rt_grid_options(),

			]
		);

		$this->add_control(
			'mobile',
			[
				'label'   => esc_html__( 'Grid Column for Mobile', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => $this->rt_grid_options(),

			]
		);

		$this->add_control(
			'small',
			[
				'label'   => esc_html__( 'Grid Column for Small Mobile', 'cl-hotel-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => $this->rt_grid_options(),

			]
		);
		$this->end_popover();

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
		$this->end_controls_section();
	}

	protected function __name_designation_style_settings_controls() {
		$this->start_controls_section(
			'name_style',
			[
				'label' => __( 'Name/Agency Style', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'    => esc_html__( 'Name Typography', 'cl-hotel-core' ),
				'selector' => '{{WRAPPER}} .agent-holder .item-title .agent-name a',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_typography',
				'label'    => esc_html__( 'Agency Typography', 'cl-hotel-core' ),
				'selector' => '{{WRAPPER}} .agent-holder .item-title .agency-name a',
			]
		);

		$this->add_control(
			'name_spacing',
			[
				'label'              => __( 'Name Spacing', 'cl-hotel-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .agent-holder .item-title .agent-name a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);
		$this->add_control(
			'agency_spacing',
			[
				'label'              => __( 'Agency Spacing', 'cl-hotel-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .agent-holder .item-title .agency-name a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$this->start_controls_tabs( 'name_agency_style_tabs' );
			$this->start_controls_tab(
				'name_style_normal_tab',
				[
					'label' => __( 'Normal', 'cl-hotel-core' ),
				]
			);
			$this->add_control(
				'name_color',
				[
					'label'     => __( 'Name Color', 'cl-hotel-core' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .agent-holder .item-title .agent-name a' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'agency_color',
				[
					'label'     => __( 'Agency Color', 'cl-hotel-core' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .agent-holder .item-title .agency-name a' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'name_style_hover_tab',
				[
					'label' => __( 'Hover', 'cl-hotel-core' ),
				]
			);
			$this->add_control(
				'name_color_hover',
				[
					'label'     => __( 'Name Color - Hover', 'cl-hotel-core' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .agent-holder .item-title .agent-name a:hover' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'agency_color_hover',
				[
					'label'     => __( 'Agency Color - Hover', 'cl-hotel-core' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .agent-holder .item-title .agency-name a:hover' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}


	protected function __listing_counting_style_settings_controls() {
		/* -- Listing Counting -- */
		$this->start_controls_section(
			'listing_counting_style',
			[
				'label' => __( 'Listing Counting Style', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'listing_counting_color',
			[
				'label'     => __( 'Color', 'cl-hotel-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agent-holder .listing-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'listing_counting_typography',
				'selector' => '{{WRAPPER}} .agent-holder .listing-count',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'listing_counting_bg',
				'label'    => esc_html__( 'Background', 'cl-hotel-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background color', 'cl-hotel-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .agent-holder .listing-count',
			]
		);
		$this->add_control(
			'listing_counting_spacing',
			[
				'label'              => __( 'Counting Spacing', 'cl-hotel-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .agent-holder .listing-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);
		$this->end_controls_section();
	}

	protected function __socials_style_settings_controls(){

		/* -- Social Style -- */
		$this->start_controls_section(
			'social_icon_style',
			[
				'label' => __( 'Social Icon', 'cl-hotel-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'show_social_cion',
			[
				'label'        => __( 'Show Social Icon', 'cl-hotel-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cl-hotel-core' ),
				'label_off'    => __( 'Hide', 'cl-hotel-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->start_controls_tabs( 'socials_style_tabs' );
			$this->start_controls_tab(
				'socials_normal_tab',
				[
					'label' => __( 'Normal', 'cl-hotel-core' ),
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'social_bg',
					'label'    => esc_html__( 'Background', 'cl-hotel-core' ),
					'types' => [ 'classic', 'gradient' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background color', 'cl-hotel-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .agent-holder .item-socials ul li a',
				]
			);
			$this->add_control(
				'socials_color',
				[
					'label'     => __( 'Color', 'cl-hotel-core' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .agent-holder .item-socials ul li a' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'socials_hover_tab',
				[
					'label' => __( 'Hover', 'cl-hotel-core' ),
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'social_bg_hover',
					'label'    => esc_html__( 'Background', 'cl-hotel-core' ),
					'types' => [ 'classic', 'gradient' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background color', 'cl-hotel-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .agent-holder .item-socials ul li a:hover',
				]
			);
			$this->add_control(
				'socials_color_hover',
				[
					'label'     => __( 'Color', 'cl-hotel-core' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .agent-holder .item-socials ul li a:hover' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}
	

	/* -- Render content -- */
	protected function render() {
		$data               = $this->get_settings();
		$data['query_args'] = $this->query_args( $data );
		$template           = 'view';
		$this->rt_template( $template, $data );
	}

	/**
	 * Agent Query Args
	 *
	 * @param $data
	 *
	 * @return array
	 */
	protected function query_args( $data ) {
		$args = [
			'post_type'      => 'rtcl_agent',
			'posts_per_page' => $data['post_limit'],
			'post_status'    => 'publish',
		];
		if ( $data['orderby'] ) {
			$args['orderby'] = $data['orderby'];
		}
		if ( $data['order'] ) {
			$args['order'] = $data['order'];
		}

		if ( $data['post_source'] == 'by_id' && $data['post_id'] ) :
			$post_ids         = explode( ',', $data['post_id'] );
			$args['post__in'] = $post_ids;
		endif;

		if ( $data['post_source'] == 'by_agency' && ! empty( $data['agencies'] ) ) :
			$users     = get_users( [
				'meta_key'   => '_rtcl_store_id',
				'meta_value' => $data['agencies'],
				'fields'     => 'id',
			] );
			$agent_ids = [];
			foreach ( $users as $user_id ) {
				$agent_ids[] = get_user_meta( $user_id, '_rtcl_agent_id', true );
			}
			if ( $data['exclude'] ) {
				$excluded_ids = explode( ',', $data['exclude'] );
				$agent_ids    = array_diff( $agent_ids, $excluded_ids );
			}
			$args['post__in'] = $agent_ids;
		elseif ( $data['exclude'] ) :
			$excluded_ids         = explode( ',', $data['exclude'] );
			$args['post__not_in'] = $excluded_ids;
		endif;


		if ( $data['offset'] ) {
			$args['offset'] = $data['offset'];
		}

		return $args;
	}

}