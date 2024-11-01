<?php
if( ! defined( 'ABSPATH' ) ) exit;
/**
 * Fired during plugin deactivation
 *
 * @link       https://zooza.sk
 * @since      1.0.0
 *
 * @package    Zooza
 * @subpackage Zooza/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Zooza
 * @subpackage Zooza/includes
 * @author     Zooza <hello@zooza.sk>
 */
class Zooza_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

        delete_option( 'zooza_api_key' );
        delete_option( 'zooza_client_secret' );
        delete_option( 'zooza_registration_page_id' );
        delete_option( 'zooza_calendar_page_id' );
        delete_option( 'zooza_profile_page_id' );
        delete_option( 'zooza_video_page_id' );
        delete_option( 'zooza_checkout_page_id' );

	}

}
