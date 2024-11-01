<?php
if( ! defined( 'ABSPATH' ) ) exit;
/**
 * Fired during plugin activation
 *
 * @link       https://zooza.sk
 * @since      1.0.0
 *
 * @package    Zooza
 * @subpackage Zooza/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Zooza
 * @subpackage Zooza/includes
 * @author     Zooza <hello@zooza.sk>
 */
class Zooza_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

        add_option( 'zooza_api_key', '' );
        add_option( 'zooza_client_secret', '' );
        add_option( 'zooza_registration_page_id', '' );
        add_option( 'zooza_calendar_page_id', '' );
        add_option( 'zooza_profile_page_id', '' );
        add_option( 'zooza_video_page_id', '' );
        add_option( 'zooza_checkout_page_id', '' );

	}

}
