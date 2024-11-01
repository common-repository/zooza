<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://zooza.online
 * @since             1.0.0
 * @package           Zooza
 *
 * @wordpress-plugin
 * Plugin Name:       Zooza
 * Plugin URI:        https://zooza.online/wordpress-plugin
 * Description:       Plugin pre zákazníkov platformy Zooza pre jednoduché nastavenie registračných formulárov.
 * Version:           1.0.9
 * Author:            Zooza
 * Author URI:        https://zooza.online
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       zooza
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ZOOZA_VERSION', '1.0.9' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-zooza-activator.php
 */
function activate_zooza() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zooza-activator.php';
	Zooza_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-zooza-deactivator.php
 */
function deactivate_zooza() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zooza-deactivator.php';
	Zooza_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_zooza' );
register_deactivation_hook( __FILE__, 'deactivate_zooza' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-zooza.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_zooza() {

	$plugin = new Zooza();
	$plugin->run();

}
run_zooza();
