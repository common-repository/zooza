<?php
if( ! defined( 'ABSPATH' ) ) exit;
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://zooza.sk
 * @since      1.0.0
 *
 * @package    Zooza
 * @subpackage Zooza/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Zooza
 * @subpackage Zooza/public
 * @author     Zooza <hello@zooza.sk>
 */
class Zooza_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.9
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    public function the_content( $content ) {

        if ( ! is_main_query() ) {
            return $content;
        }

        $api_key = get_option( 'zooza_api_key', false );

        if( !$api_key ) {
            return $content;
        }

        $ID = get_the_ID();

        if( is_null( $ID ) )    {
            return $content;
        }

        $widgets = array(
            'registration_new' => get_option( 'zooza_registration_page_id' ),
            'profile'          => get_option( 'zooza_profile_page_id' ),
            'calendar'         => get_option( 'zooza_calendar_page_id' ),
            'video'            => get_option( 'zooza_video_page_id' ),
            'checkout'         => get_option( 'zooza_checkout_page_id' ),
        );

        foreach( $widgets as $widget => $page_id )  {

            if( $page_id == $ID )   {

                return $content . $this->get_code( $widget, $api_key );

            }

        }

        return $content;

    }

    private function get_code( $widget, $api_key )    {

        $version = 'v1';

        $v2 = array( 'calendar', 'video', 'checkout' );

        if( in_array( $widget, $v2 ) )  {
            $version = 'v2';
        }

        return sprintf( "<script data-embedded_by='zoozawp' data-version='%s' data-widget-id='zooza' id='%s' type='text/javascript'>
( function() {
function async_load(){
	var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
	var url = 'https://api.zooza.app/widgets/%s/';
	s.src = url + ( url.indexOf( '?' ) >= 0 ? '&' : '?' ) + 'ref=' + encodeURIComponent( window.location.href ) + '&type=%s';
	var embedder = document.getElementById( '%s' );
	embedder.parentNode.insertBefore( s, embedder );
}
if ( window.attachEvent ) {
	window.attachEvent( 'onload', async_load );
} else {
	window.addEventListener( 'load', async_load, false );
}
} )();
</script>", $version, $api_key, $version, $widget, $api_key );

    }

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Zooza_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zooza_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/zooza-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Zooza_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zooza_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/zooza-public.js', array( 'jquery' ), $this->version, false );

	}

}
