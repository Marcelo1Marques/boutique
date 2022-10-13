<?php
/**
 * Plugin Name:  IONOS Help
 * Plugin URI:   https://www.ionos.com
 * Description:  This plugin links provides you with information and guidance to help you navigate through WordPress administration and find support available at IONOS. The complete set of information is available with activated IONOS login to fetch information form IONOS Help Center.
 * Version:      2.1.2
 * License:      GPLv2 or later
 * Author:       IONOS
 * Author URI:   https://www.ionos.com
 * Text Domain:  ionos-help-center
 */

namespace Ionos\Help_Center;

function init() {
	require_once 'inc/lib/options.php';
	Options::set_tenant_and_plugin_name('ionos', 'help-center');
	require_once 'inc/lib/data-providers/cloud.php';
	require_once 'inc/lib/config.php';
	require_once 'inc/lib/updater.php';
	require_once 'inc/lib/features/disable-plugins/class-manager.php';

	require_once 'inc/class-manager.php';
	require_once 'inc/class-settings.php';
	require_once 'inc/class-helper.php';

	new \Ionos\Help_Center\Manager();
	new \Ionos\Help_Center\Settings();
	new \Ionos\Help_Center\Updater();
	new \Ionos\Help_Center\Warning( 'ionos-help-center' );
}
add_action( 'plugins_loaded', 'Ionos\Help_Center\init' );

function load_textdomain() {
	if ( strpos( plugin_dir_path( __FILE__ ), 'mu-plugins' ) !== false ) {
		load_muplugin_textdomain(
			'ionos-help-center',
			basename( dirname( __FILE__ ) ) . '/languages'
		);
	} else {
		load_plugin_textdomain(
			'ionos-help-center',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages/'
		);
	}
}
add_action( 'init', 'Ionos\Help_Center\load_textdomain' );