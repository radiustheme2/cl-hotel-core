<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Hotel_Core;

use \ReflectionClass;
use Elementor\Widget_Base;
use Rtcl\Helpers\Functions;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

abstract class Custom_Widget_Base extends Widget_Base {
	public $rt_name;
	public $rt_base;
	public $rt_category;
	public $rt_icon;
	public $rt_translate;
	public $rt_dir;

	public function __construct( $data = [], $args = null ) {
		$this->rt_category = CL_HOTEL_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$this->rt_icon     = 'rdtheme-el-custom';
		$this->rt_dir      = dirname( ( new ReflectionClass( $this ) )->getFileName() );
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return $this->rt_base;
	}

	public function get_title() {
		return $this->rt_name;
	}

	public function get_icon() {
		return $this->rt_icon;
	}

	public function get_categories() {
		return array( $this->rt_category );
	}

	public function rt_template( $template, $data ) {
		$template_name = '/elementor-custom/' . basename( $this->rt_dir ) . '/' . $template . '.php';
		if ( file_exists( get_stylesheet_directory() . $template_name ) ) {
			$file = get_stylesheet_directory() . $template_name;
		}
		elseif ( file_exists( get_template_directory() . $template_name ) ) {
			$file = get_template_directory() . $template_name;
		}
		else {
			$file = $this->rt_dir . '/' . $template . '.php';
		}

		ob_start();
		include $file;
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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

	public function rt_grid_options(){
		return [
			'1'  => esc_html__( '1 Columns', 'cl-hotel-core' ),
			'2'  => esc_html__( '2 Columns', 'cl-hotel-core' ),
			'3'  => esc_html__( '3 Columns', 'cl-hotel-core' ),
			'4'  => esc_html__( '4 Columns', 'cl-hotel-core' ),
			'5'  => esc_html__( '5 Columns', 'cl-hotel-core' ),
			'6'  => esc_html__( '6 Columns', 'cl-hotel-core' ),
		];
	}

	public function rt_number_options(){
		return [
			'1'  => esc_html__( '1', 'cl-hotel-core' ),
			'2'  => esc_html__( '2', 'cl-hotel-core' ),
			'3'  => esc_html__( '3', 'cl-hotel-core' ),
			'4'  => esc_html__( '4', 'cl-hotel-core' ),				
			'5'  => esc_html__( '5', 'cl-hotel-core' ),
			'6'  => esc_html__( '6', 'cl-hotel-core' ),
			'7'  => esc_html__( '7', 'cl-hotel-core' ),
			'8'  => esc_html__( '8', 'cl-hotel-core' ),
		];
	}

	public function rt_autoplay_speed(){
		return [
			'500'  => esc_html__( '500', 'cl-hotel-core' ),
			'1000' => esc_html__( '1000', 'cl-hotel-core' ),
			'1500' => esc_html__( '1500', 'cl-hotel-core' ),
			'2000' => esc_html__( '2000', 'cl-hotel-core' ),
			'2500' => esc_html__( '2500', 'cl-hotel-core' ),
			'3000' => esc_html__( '3000', 'cl-hotel-core' ),
		];
	}

	public function rt_anim_delay(){
		return [
			'200' => esc_html__( '200', 'cl-hotel-core' ),
			'300' => esc_html__( '300', 'cl-hotel-core' ),
			'400' => esc_html__( '400', 'cl-hotel-core' ),
			'500' => esc_html__( '500', 'cl-hotel-core' ),
			'600' => esc_html__( '600', 'cl-hotel-core' ),
			'700' => esc_html__( '700', 'cl-hotel-core' ),
			'800' => esc_html__( '800', 'cl-hotel-core' ),
			'900' => esc_html__( '900', 'cl-hotel-core' ),
		];
	}

	public function rt_placeholder_image(){
		$placeholder_image = CL_HOTEL_CORE_BASE_URL.'assets/imgs/placeholder.png';

		/**
		 * Get placeholder image source.
		 *
		 * Filters the source of the default placeholder image used by Elementor.
		 *
		 * @since 1.0.0
		 *
		 * @param string $placeholder_image The source of the default placeholder image.
		 */
		$placeholder_image = apply_filters( 'elementor/utils/get_placeholder_image_src', $placeholder_image ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound

		return $placeholder_image;
	}

	public function rt_post_orderby(){
		return [
			'ID'  => esc_html__( 'Post Id', 'cl-hotel-core' ),
			'author' => esc_html__( 'Post Author', 'cl-hotel-core' ),
			'title' => esc_html__( 'Title', 'cl-hotel-core' ),
			'date' => esc_html__( 'Date', 'cl-hotel-core' ),
			'modified' => esc_html__( 'Modified', 'cl-hotel-core' ),
			'parent' => esc_html__( 'Parent', 'cl-hotel-core' ),
			'rand' => esc_html__( 'Random', 'cl-hotel-core' ),
			'comment_count' => esc_html__( 'Comment Count', 'cl-hotel-core' ),
			'menu_order' => esc_html__( 'Menu Order', 'cl-hotel-core' ),
		];
	}
	public function rt_blog_categories() {
		$categories = get_categories( array(
			'orderby' => 'name',
			'parent'  => 0
		) );
		if(!empty( $categories )){
			$category_links = array();
			foreach ($categories as $key => $value) {
				$category_links[$value->term_id] = $value->name;  
			}
			return $category_links;
		}
	}

	// post tags lists
	public function rt_blog_tags() {
		$tags     = get_tags( [ 'hide_empty' => false ] );
		$tag_list = [];
		foreach ( $tags as $tag ) {
			$tag_list[ $tag->slug ] = $tag->name;
		}

		return $tag_list;
	}
	public function rt_blog_posts_title() {
		$args = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'taxonomy'       => 'category'
		);
		$post_title = array();
		$grid_query = new \WP_Query( $args );
		if ( $grid_query->have_posts() ) : 
			while ( $grid_query->have_posts() ) : $grid_query->the_post();
			$post_title[get_the_ID()] = get_the_title();
			endwhile; wp_reset_postdata();
		endif;
		return $post_title;
	}
	//Get all thumbnail size
	public function rt_get_all_image_sizes() {
		global $_wp_additional_image_sizes;
		$image_sizes = [ '0' => __( 'Default Image Size', 'cl-hotel-core' ) ];
		foreach ( $_wp_additional_image_sizes as $index => $item ) {
			$image_sizes[ $index ] = ucwords( $index . ' - ' . $item['width'] . 'x' . $item['height'] ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
		}
		$image_sizes['full'] = __( "Full Size", 'cl-hotel-core' );

		return $image_sizes;
	}
	public function rt_posts_title($post) {
		$prefix = CL_HOTEL_CORE_THEME_PREFIX;
		$args = array(
			'post_type'    => $post,
			'post_status'  => 'publish',
			'posts_per_page' => -1,
		);
		$post_title = array();
		$grid_query = new \WP_Query( $args );
		if ( $grid_query->have_posts() ) : 
			while ( $grid_query->have_posts() ) : $grid_query->the_post();
			$post_title[get_the_ID()] = get_the_title();
			endwhile; wp_reset_postdata();
		endif;
		return $post_title;
	}

	//Get Custom post category:
	protected function rt_get_categories_by_id( $cat ) {
		$terms   = get_terms( [
			'taxonomy'   => $cat,
			'hide_empty' => true,
		] );
		$options = [ '0' => __( 'All Categories', 'cl-hotel-core' ) ];
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->term_id ] = $term->name;
			}
			return $options;
		}
	}

	//Get Custom post category:
	protected function rt_get_listing_types() {

		$listing_types = Functions::get_listing_types();
        $listing_types = empty( $listing_types ) ? [] : $listing_types;

		if ( ! empty( $listing_types ) ) {
			foreach ( $listing_types as $key => $listing_type ) {
				$options[ $key ] = $listing_type;
			}
			return $options;
		}
	}

	//Store Agent List
	function rt_get_agency_list() {
		$get_agency = get_posts( [
			'post_type'   => 'store',
			'numberposts' => - 1,
			'post_status' => 'publish',
		] );
		$lists      = [];
		foreach ( $get_agency as $post ) {
			$lists[ $post->ID ] = $post->post_title;
		}

		return $lists;
	}

}