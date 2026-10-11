<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

class CL_Hotel_Core_Demo_User_Import {

	public $user_migration = [];

	public function __construct() {
		$this->import_users();
		$this->import_usermeta();
		$this->update_authors_in_post_and_postmeta();
	}

	public function import_users() {
		global $wpdb;

		$existing_users     = [];
		$existing_users_obj = get_users( [ 'number' => - 1, 'fields' => [ 'ID', 'user_login' ] ] );
		foreach ( $existing_users_obj as $existing_user ) {
			$existing_users[ $existing_user->user_login ] = $existing_user->ID;
		}

		$user_data = file_get_contents( CL_HOTEL_CORE_BASE_DIR . 'demo-users/users.json' );
		$user_data = json_decode( $user_data, true );

		$_user_migration = [];
		foreach ( $user_data as $user_value ) {
			if ( array_key_exists( $user_value['user_login'], $existing_users ) ) {
				//continue;
				require_once( ABSPATH . 'wp-admin/includes/user.php' );
				wp_delete_user( $existing_users[$user_value['user_login']] );
			}

			$old_id = $user_value['ID'];
			unset( $user_value['ID'] );
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
			if ( $wpdb->insert( $wpdb->users, $user_value ) ) {
				$_user_migration[ $old_id ] = $wpdb->insert_id;
			}
		}

		update_option( 'cl_hotel_users', $_user_migration );
	}

	public function import_usermeta() {
		global $wpdb;

		$user_meta_data = file_get_contents( CL_HOTEL_CORE_BASE_DIR . 'demo-users/usermeta.json' );
		$user_meta_data = json_decode( $user_meta_data, true );

		$_cl_hotel_users = get_option( 'cl_hotel_users' );
		foreach ( $user_meta_data as $user_meta_value ) {
			if ( ! array_key_exists( $user_meta_value['user_id'], $_cl_hotel_users ) ) {
				continue;
			}

			$user_meta_value['user_id']    = $_cl_hotel_users[ $user_meta_value['user_id'] ];
			$user_meta_value['meta_value'] = maybe_unserialize( $user_meta_value['meta_value'] );

			// run update
			update_user_meta( $user_meta_value['user_id'], $user_meta_value['meta_key'], $user_meta_value['meta_value'] );
		}
	}

	public function update_authors_in_post_and_postmeta() {
		$_cl_hotel_users = get_option( 'cl_hotel_users' );

		//Update Listing author : Listing_id => user_id
		$existing_post_authors = [
			// Alina Fraser
			3013 => 2,
			// Corey Burke
			2926 => 3,
			// Kian Bailey
			2961 => 4,
			2972 => 4,
			// Martin Eva
			3023 => 5, 
			//Kristin Watson
			3004 => 7,
			//Jenny Wilson
			3044 => 8,
			4769 => 8,
			//Annette Black
			3052 => 9,
			4781 => 9,
			4788 => 9,
			//Eleanor Pena
			2985 => 10,
			//Savannah Nguyen
			3073 => 11,
			// Robin Adams
			3094 => 12,
			4761 => 12,
		];

		foreach ( $existing_post_authors as $post_id => $user_id ) {
			if ( ! array_key_exists( $user_id, $_cl_hotel_users ) ) {
				continue;
			}
			@wp_update_post( [ 'ID' => $post_id, 'post_author' => $_cl_hotel_users[ $user_id ] ] );
			update_post_meta( $post_id, '_rtcl_manager_id', $_cl_hotel_users[ $user_id ] );
		}

		//Update Agent Listing : Listing_id => user_id
		$existing_listing_agent = [
			4761 => 11, //Savannah Nguyen
			4769 => 9,	//Annette Black
			4788 => 8,  //Jenny Wilson
			4781 => 8,  //Jenny Wilson
		];

		foreach ( $existing_listing_agent as $post_id => $agent_id ) {
			if ( ! array_key_exists( $agent_id, $_cl_hotel_users ) ) {
				continue;
			}
			update_post_meta( $post_id, '_rtcl_manager_id', $_cl_hotel_users[ $agent_id ] );
		}

		//Update Agent : agent_id => user_id
		$existing_agent_ids = [
			2880 => 3, //Corey Burke
			2955 => 4, //Kian Bailey
			3000 => 5, //Martin Eva
			3001 => 7, //Kristin Watson
			3038 => 8, //Jenny Wilson
			3040 => 9,  //Annette Black
			2959 => 10, //Eleanor Pena
			3071 => 11, //Savannah Nguyen
		];

		foreach ( $existing_agent_ids as $agent_id => $user_id ) {
			if ( ! array_key_exists( $user_id, $_cl_hotel_users ) ) {
				continue;
			}
			update_post_meta( $agent_id, '_rtcl_user_id', $_cl_hotel_users[ $user_id ] );
		}

		//Update Store Meta : store_id => user_id
		$existing_store_ids = [
			2860 => '2', //Marriott Bonvoy
			2874 => '3', //Luxurious Hotel
			2947 => '4', //Sleek Solutions
			2949 => '5', //Emoville Agency
			2943 => '7', //Reddy Agency
			2941 => '8', //Hexa Agency
			3035 => '9', //Executive Assistants
			2953 => '10', //Jackpot JobSolutions
			3067 => '12', //Nexus Marketing
		];

		foreach ( $existing_store_ids as $store_id => $user_id ) {
			if ( ! array_key_exists( $user_id, $_cl_hotel_users ) ) {
				continue;
			}
			update_post_meta( $store_id, '_rtcl_manager_ids', $_cl_hotel_users[ $user_id ] );
			update_post_meta( $store_id, 'store_owner_id', $_cl_hotel_users[ $user_id ] );
		}

	}

	public static function export_users() {
		global $wpdb;
		$users_id = [ 2, 3, 4, 5, 7, 8, 9, 10, 11, 12 ];

		$users_id_sql = implode( ',', $users_id );

		// user table
		$query = "SELECT * FROM $wpdb->users WHERE ID IN ($users_id_sql)";
	// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.PreparedSQL.NotPrepared
		$users = $wpdb->get_results( $query, ARRAY_A );

		// usermeta table
		$query     = "SELECT * FROM $wpdb->usermeta WHERE user_id IN ($users_id_sql)";
	// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.PreparedSQL.NotPrepared
		$usermetas = $wpdb->get_results( $query, ARRAY_A );

		// json
		$json1 = json_encode( $users );
		$json2 = json_encode( $usermetas );
		file_put_contents( CL_HOTEL_CORE_BASE_DIR . 'demo-users/users.json', $json1 );
		file_put_contents( CL_HOTEL_CORE_BASE_DIR . 'demo-users/usermeta.json', $json2 );
	}

}