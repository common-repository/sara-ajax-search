<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://khadkaravi.com.np/
 * @since             1.0.3
 * @package           Saraajaxsearch
 *
 * @wordpress-plugin
 * Plugin Name:       Sara Ajax Search
 * Plugin URI:        
 * Description:       Sara Ajax Search is a live search plugin for wordpress themes.It performs real time search as you enter anything.it supports group search like post,page and custom post type in your wordpress website.it's a fully responsive.
 * Version:           1.0.3
 * Author:            Sarala & Ravi
 * Author URI:        http://khadkaravi.com.np/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       saraajaxsearch
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
define( 'SARAAJAXSEARCH_VERSION', '1.0.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-saraajaxsearch-activator.php
 */
function activate_saraajaxsearch() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-saraajaxsearch-activator.php';
	Saraajaxsearch_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-saraajaxsearch-deactivator.php
 */
function deactivate_saraajaxsearch() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-saraajaxsearch-deactivator.php';
	Saraajaxsearch_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_saraajaxsearch' );
register_deactivation_hook( __FILE__, 'deactivate_saraajaxsearch' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-saraajaxsearch.php';
require plugin_dir_path( __FILE__ ) . 'admin/partials/saraajaxsearch-admin-display.php';

add_action ('init','sara_ajax_search1');
function sara_ajax_search1(){
	require plugin_dir_path( __FILE__ ) . 'admin/sarasearch.php';
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_saraajaxsearch() {

	$plugin = new Saraajaxsearch();
	$plugin->run();

}
run_saraajaxsearch();
// global $wp;
// echo add_query_arg(home_url(), $wp->query_vars ).'<br>';
// $current_url = home_url(add_query_arg(array($_GET),'hi'));

// $sasHomeUrl = get_site_url();
// $sasCurrentUrl = add_query_arg($wp->query_string);

// list of shortcode
add_shortcode('sara_search','sas_add_form');
