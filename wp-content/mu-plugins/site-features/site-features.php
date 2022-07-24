<?php
namespace SJZ;
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://samirjoza.com
 * @since             1.0.0
 * @package           Site_Features
 *
 * @wordpress-plugin
 * Plugin Name:       Site Features
 * Plugin URI:        https://yourdomain.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Samir Joza
 * Author URI:        https://samirjoza.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       site-features
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
define( 'SITE_FEATURES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-site-features-activator.php
 */
function activate_site_features() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-site-features-activator.php';
	Site_Features_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-site-features-deactivator.php
 */
function deactivate_site_features() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-site-features-deactivator.php';
	Site_Features_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_site_features' );
register_deactivation_hook( __FILE__, 'deactivate_site_features' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-site-features.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_site_features() {

	$plugin = new Site_Features();
	$plugin->run();

}
run_site_features();
