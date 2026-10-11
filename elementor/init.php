<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Hotel_Core;

use Elementor\Plugin;

use RadiusTheme\CLHotel\Helper;
use RadiusTheme\CLHotel_Core\ElementorIconTrait;
use RadiusTheme\CLHotel\Listing_Functions;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once CL_HOTEL_CORE_BASE_DIR . 'elementor/controls/traits-icons.php';

// Elementor default widget control
require_once __DIR__ . '/el-extend.php';

class Custom_Widget_Init {

	public function __construct() {
		add_action( 'elementor/widgets/register', array( $this, 'init' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'widget_categoty' ) );
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_style' ) );
		add_action( 'elementor/icons_manager/additional_tabs', array( $this, 'RT_custom_icon_tab' ) );
		add_action( 'after_switch_theme', [$this, 'cl_hotel_add_cpt_support'] );
	}

	function cl_hotel_add_cpt_support() {
	    //if exists, assign to $cpt_support var
		$cpt_support = get_option( 'elementor_cpt_support' );
		
		//check if option DOESN'T exist in db
		if( ! $cpt_support ) {
		    $cpt_support = [ 'page', 'post' ]; //create array of our default supported post types
		    update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
		}
	}

	/**
	 * Adding custom icon to icon control in Elementor
	 */
	public function RT_custom_icon_tab( $tabs = array() ) {
		// Append new icons
		$fontello = ElementorIconTrait::fontello_icons();
		$tabs['cl-hotel-fontello-icons'] = array(
			'name'          => 'rt-fontello-icons',
			'label'         => esc_html__( 'Fontello Icons', 'cl-hotel-core' ),
			'labelIcon'     => 'demo-icon rt-icon-home-icon',
			'prefix'        => '',
			'displayPrefix' => '',
			'url'           => Helper::get_css( 'fontello' ),
			'icons'         => $fontello,
			'ver'           => '1.0',
		);

		// array_merge();
		return $tabs;
	}
	public function editor_style() {
		$img = plugins_url( 'icon.svg', __FILE__ );
		wp_add_inline_style( 'elementor-editor', '.elementor-element .icon .rdtheme-el-custom {content: url( '.$img.');width: 28px;}' );
		wp_add_inline_style( 'elementor-editor', '.select2-container--default .select2-selection--single {min-width: 126px !important; min-height: 30px !important;}' );
	}

	public function init() {
		require_once __DIR__ . '/base.php';
		$widgets = '';
		//General Addons
		$widgets1 = array(
			'title'       	=> 'Rt_Title',
			'infobox'       => 'Rt_Infobox',
			'posts'  	  	=> 'Rt_Post',
			'testimonial'  	=> 'Rt_Testimonial',
			'authors'  		=> 'Rt_Authors',
			'pricing'  		=> 'Rt_Pricing',
		);
		//Listing Addons
		$widgets2 = array(
			'search-form'          => 'Rt_Search_Form',
			'listing-locations'    => 'Listing_Locations',
		);

		$widgets = $widgets1;

		if ( class_exists('Rtcl') && class_exists( 'RtclPro' ) ) {
			$widgets = array_merge($widgets, $widgets2);
		}
		foreach ( $widgets as $dirname => $class ) {
			$template_name = '/elementor-custom/' . $dirname . '/class.php';
			if ( file_exists( get_stylesheet_directory() . $template_name ) ) {
				$file = get_stylesheet_directory() . $template_name;
			}
			elseif ( file_exists( get_template_directory() . $template_name ) ) {
				$file = get_template_directory() . $template_name;
			}
			else {
				$file = __DIR__ . '/' . $dirname . '/class.php';
			}

			require_once $file;
			
			$classname = __NAMESPACE__ . '\\' . $class;
			Plugin::instance()->widgets_manager->register( new $classname );
		}
	}

	public function widget_categoty( $elements_manager ) {
		$id         = CL_HOTEL_CORE_THEME_PREFIX . '-widgets';
		$categories[$id] = array(
			'title' => __('CL Hotel Elements', 'cl-hotel-core'),
			'icon'  => 'fa fa-plug',
		);
		$old_categories = $elements_manager->get_categories();
		$categories = array_merge($categories, $old_categories);
		$set_categories = function ($categories) {
			$this->categories = $categories;
		};
		$set_categories->call( $elements_manager, $categories );
	}

}

new Custom_Widget_Init();