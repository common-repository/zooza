<?php
if( ! defined( 'ABSPATH' ) ) exit;
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://zooza.sk
 * @since      1.0.0
 *
 * @package    Zooza
 * @subpackage Zooza/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Zooza
 * @subpackage Zooza/admin
 * @author     Zooza <hello@zooza.sk>
 */
class Zooza_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    public function admin_init()    {

        register_setting( 'zooza', 'zooza_api_key' );
        register_setting( 'zooza', 'zooza_client_secret' );
        register_setting( 'zooza', 'zooza_registration_page_id' );
        register_setting( 'zooza', 'zooza_profile_page_id' );
        register_setting( 'zooza', 'zooza_calendar_page_id' );
        register_setting( 'zooza', 'zooza_video_page_id' );
        register_setting( 'zooza', 'zooza_checkout_page_id' );

        add_settings_section(
            'zooza_section_general',
            __( 'Všeobecné nastavenia', 'zooza' ),
            array( $this, 'section_general' ),
            'zooza'
        );

        add_settings_section(
            'zooza_section_general',
            __( 'General settings', 'zooza' ),
            array( $this, 'section_general' ),
            'zooza'
        );

        add_settings_section(
            'zooza_section_widgets',
            __( 'Registračné formuláre', 'zooza' ),
            array( $this, 'section_widgets' ),
            'zooza'
        );

        add_settings_field(
                'zooza_api_key_field',
                __( 'API kľúč', 'zooza' ),
                array( $this, 'field_api_key' ),
                'zooza',
                'zooza_section_general'
        );

        add_settings_field(
            'zooza_client_secret_field',
            __( 'Tajný kľúč', 'zooza' ),
            array( $this, 'field_client_secret' ),
            'zooza',
            'zooza_section_general'
        );

        add_settings_field(
            'zooza_registration_page_id',
            __( 'Registračný formulár', 'zooza' ),
            array( $this, 'field_zooza_registration_page_id' ),
            'zooza',
            'zooza_section_widgets'
        );

        add_settings_field(
            'zooza_calendar_page_id',
            __( 'Kalendár', 'zooza' ),
            array( $this, 'field_zooza_calendar_page_id' ),
            'zooza',
            'zooza_section_widgets'
        );

        add_settings_field(
            'zooza_profile_page_id',
            __( 'Zákaznícky profil', 'zooza' ),
            array( $this, 'field_zooza_profile_page_id' ),
            'zooza',
            'zooza_section_widgets'
        );

        add_settings_field(
            'zooza_video_page_id',
            __( 'Videá', 'zooza' ),
            array( $this, 'field_zooza_video_page_id' ),
            'zooza',
            'zooza_section_widgets'
        );

        add_settings_field(
            'zooza_checkout_page_id',
            __( 'Objednávkový formulár', 'zooza' ),
            array( $this, 'field_zooza_checkout_page_id' ),
            'zooza',
            'zooza_section_widgets'
        );

    }

    function section_general()  {
        var_dump(get_locale());
        ?>
        <p><?=__( 'Postup ako získať API kľúč a tajný kľúč:', 'zooza' );?></p>
        <?=__( '<ol><li><a href="https://app.zooza.app/" target="_blank">Prihláste sa</a> do aplikácie Zooza.</li><li>Navštívte stránku nastavení - <a href="https://app.zooza.app/#settings/widgets">Registračné formuláre</a></li><li>Skopírujte si váš API kľúč a tajný kľúč.</li></ol>', 'zooza' );?>
        <?php

    }

    function section_widgets()  {

        $this->update_zooza();

        ?>
        <p><?=__( 'Vyberte stránky, na ktorých chcete mať umiestnené registračné formuláre. Samotný formulár bude automaticky vložený na koniec stránky.', 'zooza' );?></p>
        <?php

    }

    function update_zooza() {

        $api_key = get_option( 'zooza_api_key' );
        $data = array(
            'client_secret' => get_option( 'zooza_client_secret' ),
            'registration' => get_permalink( get_option( 'zooza_registration_page_id' ) ),
            'calendar' => get_permalink( get_option( 'zooza_calendar_page_id' ) ),
            'profile' => get_permalink( get_option( 'zooza_profile_page_id' ) ),
            'video' => get_permalink( get_option( 'zooza_video_page_id' ) ),
            'checkout' => get_permalink( get_option( 'zooza_checkout_page_id' ) ),
        );

        $args = array(
            'headers' => array(
                'X-ZOOZA-API-KEY' => $api_key,
            ),
            'body'    => $data,
        );

        $prefix = '';
        $endpoint = sprintf( 'https://api%s.zooza.app/v1%s/applications', $prefix, $prefix );
        $response = wp_remote_post( $endpoint, $args );

    }

    public function field_zooza_registration_page_id() {

        $setting = get_option( 'zooza_registration_page_id' );
        wp_dropdown_pages(array(
                'id'       => 'zooza_registration_page_id',
                'name'     => 'zooza_registration_page_id',
                'selected' => $setting,
        ));

    }
    
    public function field_zooza_profile_page_id() {

        $setting = get_option( 'zooza_profile_page_id' );
        wp_dropdown_pages(array(
            'id'       => 'zooza_profile_page_id',
            'name'     => 'zooza_profile_page_id',
            'selected' => $setting,
        ));

    }

    public function field_zooza_calendar_page_id() {

        $setting = get_option( 'zooza_calendar_page_id' );
        wp_dropdown_pages(array(
            'id'       => 'zooza_calendar_page_id',
            'name'     => 'zooza_calendar_page_id',
            'selected' => $setting,
        ));

    }

    public function field_zooza_video_page_id() {

        $setting = get_option( 'zooza_video_page_id' );
        wp_dropdown_pages(array(
            'id'       => 'zooza_video_page_id',
            'name'     => 'zooza_video_page_id',
            'selected' => $setting,
        ));

    }
    
    public function field_zooza_checkout_page_id() {

        $setting = get_option( 'zooza_checkout_page_id' );
        wp_dropdown_pages(array(
            'id'       => 'zooza_checkout_page_id',
            'name'     => 'zooza_checkout_page_id',
            'selected' => $setting,
        ));

    }

    public function field_api_key() {

        $setting = get_option( 'zooza_api_key' );
        ?>
        <input type="text" name="zooza_api_key" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : '';?>">
        <?php

    }

    public function field_client_secret() {

        $setting = get_option( 'zooza_client_secret' );
        ?>
        <input type="text" name="zooza_client_secret" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : '';?>">
        <?php

    }

    public function admin_menu()    {

        add_options_page( ucfirst( $this->plugin_name ), ucfirst( $this->plugin_name ), 'manage_options', 'zooza', array( $this, 'render_settings_page_content' ) );

    }

    public function render_settings_page_content()  {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/zooza-admin-display.php';

    }

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/zooza-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/zooza-admin.js', array( 'jquery' ), $this->version, false );

	}

}
