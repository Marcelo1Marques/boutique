<?php
/**
 * Plugin Name:  IONOS Navigation
 * Plugin URI:   https://www.ionos.com
 * Description:  IONOS Navigation allows you to navigate quickly to customer-related control panel pages like invoices, contract data, support … and to swiftly switch between your Managed WordPress instances.
 * Version:      1.0.4
 * License:      GPLv2 or later
 * Author:       IONOS
 * Author URI:   https://www.ionos.com
 * Text Domain:  ionos-navigation
 */
namespace Ionos\Navigation;

use Ionos\Navigation\Singleton\Config;

/**
 * Init plugin.
 *
 * @return void
 */
function init() {
	require_once 'inc/lib/options.php';
	Options::set_tenant_and_plugin_name('ionos', 'navigation');
	require_once 'inc/lib/data-providers/cloud.php';
	require_once 'inc/lib/config.php';
	require_once 'inc/lib/updater.php';
	require_once 'inc/lib/features/disable-plugins/class-manager.php';

	if ( current_user_can('administrator') && is_admin() && \Ionos\Navigation\Config::get('features.enabled') === '1' ) {
		require_once 'inc/class-manager.php';
		require_once 'inc/class-helper.php';

		new \Ionos\Navigation\Manager();
		new \Ionos\Navigation\Updater();
		new \Ionos\Navigation\Warning( 'ionos-navigation' );
	}
}

\add_action( 'plugins_loaded', 'Ionos\Navigation\init' );

/**
 * Plugin translation.
 *
 * @return void
 */
function load_textdomain() {
	\load_plugin_textdomain(
		'ionos-navigation',
		false,
		\dirname( \plugin_basename( __FILE__ ) ) . '/languages/'
	);
}

\add_action( 'init', 'Ionos\Navigation\load_textdomain' );
