<?php
/**
 * @link              https://github.com/imicra/
 * @since             1.0.0
 * @package           Imsc
 *
 * Plugin Name:       Imicra Shopping Cart
 * Plugin URI:        https://github.com/imicra/Imicra-Shopping-Cart
 * Description:       A Shopping Cart for WordPress
 * Version:           1.0.0
 * Author:            Imicra
 * Author URI:        https://github.com/imicra/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       imsc
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Currently plugin version.
define( 'IMSC_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-imsc-activator.php
 */
function activate_imsc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-imsc-activator.php';
	Imsc_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-imsc-deactivator.php
 */
function deactivate_imsc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-imsc-deactivator.php';
	Imsc_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_imsc' );
register_deactivation_hook( __FILE__, 'deactivate_imsc' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-imsc.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_imsc() {

	$plugin = new Imsc();
	$plugin->run();

}
run_imsc();
