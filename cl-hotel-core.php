<?php
/*
Plugin Name: CL Hotel Core
Plugin URI: https://www.radiustheme.com
Description: CL Hotel Core Plugin for Listing Hotel Theme
Version: 2.2.1
Author: RadiusTheme
Text Domain: cl-hotel-core
Domain Path: /languages
Author URI: https://www.radiustheme.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'CL_HOTEL_CORE' ) ) {
	define( 'CL_HOTEL_CORE', '2.2.1' );
	define( 'CL_HOTEL_CORE_SCRIPT_VER', ( WP_DEBUG ) ? time() : CL_HOTEL_CORE );
	define( 'CL_HOTEL_CORE_THEME_PREFIX', 'cl_hotel' );
	define( 'CL_HOTEL_CORE_CPT', 'cl_hotel' );
	define( 'CL_HOTEL_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'CL_HOTEL_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
	define( 'CL_HOTEL_CORE_DEMO_CONTENT', plugin_dir_path( __FILE__ ) . 'demo-content/' );
}

require_once CL_HOTEL_CORE_BASE_DIR . 'demo-users/user-importer.php';

class CL_Hotel_Core {

	public $plugin = 'cl-hotel-core';
	public $action = 'cl_hotel_theme_init';
	protected static $instance;

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'demo_importer' ), 17 );
		add_action( 'after_setup_theme', array( $this, 'after_theme_loaded' ), 15 );
		add_action( 'rdtheme_social_share', array( $this, 'social_share' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'cl_hotel_core_enqueue_scripts' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'cl_hotel_core_enqueue_scripts' ), 20 );
		add_action( 'plugins_loaded', array( $this, 'php_version_check' ) );
		if ( isset( $_GET['export_user'] ) && $_GET['export_user'] == 1 ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			CL_Hotel_Core_Demo_User_Import::export_users();
		}
		add_filter( 'upload_mimes', array( $this, 'cc_mime_types' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function cc_mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	public function cl_hotel_core_enqueue_scripts() {
		wp_enqueue_style( 'cl-hotel-core', CL_HOTEL_CORE_BASE_URL . 'assets/css/hotel-core.css', '', CL_HOTEL_CORE_SCRIPT_VER );
		wp_enqueue_script( 'headroom', CL_HOTEL_CORE_BASE_URL . 'assets/js/headroom.js', array( 'jquery' ), CL_HOTEL_CORE_SCRIPT_VER, true );
		wp_enqueue_script( 'cl-hotel-core', CL_HOTEL_CORE_BASE_URL . 'assets/js/hotel-core.js', array( 'jquery', 'headroom' ), CL_HOTEL_CORE_SCRIPT_VER, true );
	}

	public function after_theme_loaded() {
		if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			require_once CL_HOTEL_CORE_BASE_DIR . 'inc/post-types.php'; // Post Types
			require_once CL_HOTEL_CORE_BASE_DIR . 'inc/rt-posts.php'; // Post Fields
			require_once CL_HOTEL_CORE_BASE_DIR . 'inc/post-meta.php'; // Post Meta
			require_once CL_HOTEL_CORE_BASE_DIR . 'widgets/init.php'; // Widgets
		}

		if ( class_exists( 'CLR_Hotel_Main' ) && did_action( 'elementor/loaded' ) ) {
			require_once CL_HOTEL_CORE_BASE_DIR . 'elementor/hooks.php'; // Hooks
			require_once CL_HOTEL_CORE_BASE_DIR . 'elementor/init.php'; // Elementor
		}
	}

	public function social_share( $sharer ) {
		include CL_HOTEL_CORE_BASE_DIR . 'inc/social-share.php';
	}

	public function demo_importer() {
		require_once CL_HOTEL_CORE_BASE_DIR . 'demo-importer/init.php';
	}

	public function php_version_check() {
		if ( version_compare( phpversion(), '7.2', '<' ) ) {
			add_action( 'admin_notices', [ $this, 'php_version_message' ] );
		}
		if ( version_compare( phpversion(), '7.2', '>' ) ) {
			require_once CL_HOTEL_CORE_BASE_DIR . 'optimization/__init__.php';
		}
	}

	public function php_version_message() {
		$class = 'notice notice-error settings-error';
		/* translators: %s: html tags */
		$message = sprintf( __( 'The %1$sCL Hotel Optimization%2$s requires %1$sphp 7.2+%2$s. Please consider updating php version and know more about it <a href="https://wordpress.org/about/requirements/" target="_blank">here</a>.', 'cl-hotel-core' ), '<strong>', '</strong>' );
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses_post( $message ) );
	}

}

CL_Hotel_Core::instance();
