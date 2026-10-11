<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals

if( !class_exists( 'RT_Posts' ) ){

	class RT_Posts {
		
		protected static $instance = null;
		private $post_types = array();
		private $taxonomies = array();

		private function __construct() {
			add_action( 'init', array( $this, 'initialize' ) );
		}

		public static function getInstance() {
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function initialize() {
			$this->register_taxonomies();
			$this->register_custom_post_types();
		}

		public function add_post_types( $post_types ) {

			foreach ( $post_types as $post_type => $args ) {

				$title = $args['title'];
				$plural_title = empty( $args['plural_title'] ) ? $title : $args['plural_title'];
				
				if ( ! empty( $args['rewrite'] ) ) {
					$args['rewrite'] = array( 'slug' => $args['rewrite'] );
				}

				$labels      = array(
					'name'                     => $plural_title,
					'singular_name'            => $title,
					'add_new'                  => esc_html__( 'Add New', 'cl-hotel-core' ),
					/* translators: %s: post type name */
					'add_new_item'             => sprintf( esc_html__( 'Add New %s', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type name */
					'edit_item'                => sprintf( esc_html__( 'Edit %s', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type name */
					'new_item'                 => sprintf( esc_html__( 'New %s', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type name */
					'view_item'                => sprintf( esc_html__( 'View %s', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type plural name */
					'view_items'               => sprintf( esc_html__( 'View %s', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: post type plural name */
					'search_items'             => sprintf( esc_html__( 'Search %s', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: post type plural name */
					'not_found'                => sprintf( esc_html__( '%s not found', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: post type plural name */
					'not_found_in_trash'       => sprintf( esc_html__( '%s found in Trash', 'cl-hotel-core' ), $plural_title ),
					'parent_item_colon'        => '',
					/* translators: %s: post type plural name */
					'all_items'                => sprintf( esc_html__( 'All %s', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: post type name */
					'archives'                 => sprintf( esc_html__( '%s Archives', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type name */
					'attributes'               => sprintf( esc_html__( '%s Attributes', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type name */
					'insert_into_item'         => sprintf( esc_html__( 'Insert into %s', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type name */
					'uploaded_to_this_item'    => sprintf( esc_html__( 'Uploaded to this %s', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type plural name */
					'filter_items_list'        => sprintf( esc_html__( 'Filter %s list', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: post type plural name */
					'items_list_navigation'    => sprintf( esc_html__( '%s list navigation', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: post type plural name */
					'items_list'               => sprintf( esc_html__( '%s list', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: post type name */
					'item_published'           => sprintf( esc_html__( '%s published.', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type name */
					'item_published_privately' => sprintf( esc_html__( '%s published privately.', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type name */
					'item_reverted_to_draft'   => sprintf( esc_html__( '%s reverted to draft.', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type name */
					'item_scheduled'           => sprintf( esc_html__( '%s scheduled.', 'cl-hotel-core' ), $title ),
					/* translators: %s: post type name */
					'item_updated'             => sprintf( esc_html__( '%s  updated.', 'cl-hotel-core' ), $title ),
					'menu_name'                => $plural_title
				);

				if ( !empty( $args['labels_override'] ) ) {
					$labels = wp_parse_args( $args['labels_override'], $labels );
				}

				$defaults = array(
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'show_in_nav_menus'  => true,
					'query_var'          => true,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => null,
					'menu_icon'          => null,
					'supports'           => array( 'title', 'thumbnail', 'editor' )
				);

				$args = wp_parse_args( $args, $defaults );
				$this->post_types[ $post_type ] = $args;
			}
		}

		public function add_taxonomies( $taxonomies ) {

			foreach ($taxonomies as $taxonomy => $args ) {

				$title = $args['title'];
				$plural_title = empty( $args['plural_title'] ) ? $title : $args['plural_title'];

				$labels     = array(
					'name'                       => $title,
					'singular_name'              => $title,
					/* translators: %s: taxonomy plural name */
					'search_items'               => sprintf( esc_html__( 'Search %s', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: taxonomy plural name */
					'popular_items'              => sprintf( esc_html__( 'Popular %s', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: taxonomy plural name */
					'all_items'                  => sprintf( esc_html__( 'All %s', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: taxonomy name */
					'parent_item'                => sprintf( esc_html__( 'Parent %s', 'cl-hotel-core' ), $title ),
					/* translators: %s: taxonomy name */
					'parent_item_colon'          => sprintf( esc_html__( 'Parent %s:', 'cl-hotel-core' ), $title ),
					/* translators: %s: taxonomy name */
					'edit_item'                  => sprintf( esc_html__( 'Edit %s', 'cl-hotel-core' ), $title ),
					/* translators: %s: taxonomy name */
					'view_item'                  => sprintf( esc_html__( 'View %s', 'cl-hotel-core' ), $title ),
					/* translators: %s: taxonomy name */
					'update_item'                => sprintf( esc_html__( 'Update %s', 'cl-hotel-core' ), $title ),
					/* translators: %s: taxonomy name */
					'add_new_item'               => sprintf( esc_html__( 'Add New %s', 'cl-hotel-core' ), $title ),
					/* translators: %s: taxonomy name */
					'new_item_name'              => sprintf( esc_html__( 'New %s Name', 'cl-hotel-core' ), $title ),
					/* translators: %s: taxonomy plural name */
					'separate_items_with_commas' => sprintf( esc_html__( 'Separate %s with commas', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: taxonomy plural name */
					'add_or_remove_items'        => sprintf( esc_html__( 'Add or remove %s', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: taxonomy plural name */
					'choose_from_most_used'      => sprintf( esc_html__( 'Choose from the most used %s', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: taxonomy plural name */
					'not_found'                  => sprintf( esc_html__( 'No %s found.', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: taxonomy plural name */
					'no_terms'                   => sprintf( esc_html__( 'No %s', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: taxonomy plural name */
					'items_list_navigation'      => sprintf( esc_html__( '%s list navigation', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: taxonomy plural name */
					'items_list'                 => sprintf( esc_html__( '%s list', 'cl-hotel-core' ), $plural_title ),
					/* translators: %s: taxonomy plural name */
					'back_to_items'              => sprintf( esc_html__( '&larr; Back to %s', 'cl-hotel-core' ), $plural_title ),
					'menu_name'                  => $plural_title,
				);

				if ( !empty( $args['labels_override'] ) ) {
					$labels = wp_parse_args( $args['labels_override'], $labels );
				}

				$defaults = array(
					'hierarchical'      => true,
					'labels'            => $labels,
					'show_in_nav_menus' => true,
					'show_ui'           => null,
					'show_admin_column' => true,
					'query_var'         => true,
					'rewrite'           => array( 'slug' => $taxonomy )
				);

				$args = wp_parse_args( $args, $defaults );
				$this->taxonomies[ $taxonomy ] = $args;
			}
		}

		private function register_custom_post_types() {
			$post_types = apply_filters( 'rt_framework_post_types', $this->post_types );
			foreach ( $post_types as $post_type => $args ) {
				register_post_type( $post_type, $args );
			}
		}

		private function register_taxonomies() {
			$taxonomies = apply_filters( 'rt_framework_taxonomies', $this->taxonomies );
			foreach ( $taxonomies as $taxonomy => $args ) {
				register_taxonomy( $taxonomy, $args['post_types'], $args );
			}
		}
	}
}

RT_Posts::getInstance();