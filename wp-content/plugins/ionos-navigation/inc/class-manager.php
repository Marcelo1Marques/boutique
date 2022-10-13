<?php

namespace Ionos\Navigation;

// Do not allow direct access!

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Manager class
 */
class Manager {
	public function __construct() {
		\add_action( 'admin_init', array( $this, 'init' ) );
	}

	public function init() {
		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_navigation_resources' ) );
		\add_action( 'admin_head', array( $this, 'add_external_libraries' ) );
		\add_action( 'admin_bar_menu', array( $this, 'add_ionos_menu' ), 999 );
	}

	public function add_ionos_menu( $wp_admin_bar ) {
		$config_array = \json_decode( \file_get_contents( Helper::get_config_json_path() ), true );

		if ( \is_array( $config_array ) && isset( $config_array['menu'] ) && isset( $config_array['chat'] ) ) {
			$child_count = 0;

			//specify background color
			//the background color changes between two shades of gray.
			foreach ( $wp_admin_bar->get_nodes() as $object ) {
				if ( $object->parent === 'my-account' ) {
					$child_count ++;
				}
			}

			//create container basic structure with color specification
			$args = array(
				'id'     => 'ionos-global-navigation-group',
				'parent' => 'my-account',
				'meta'   => array(
					'class' => ( $child_count % 2 == 0 ) ?: 'ab-sub-secondary',
				),
			);
			$wp_admin_bar->add_group( $args );

			//Add submenu
			$args = array(
				'id'     => 'ionos-global-navigation',
				'title'  => '<span class="ab-sub-menu menupop">'
					. \__( 'IONOS Navigation', 'ionos-navigation' )
					. '</span>',
				'parent' => 'ionos-global-navigation-group',
			);
			$wp_admin_bar->add_node( $args );

			//add submenu items
			foreach ( $config_array['menu'] as $key => $value ) {
				if ( ! isset( $value['name'] )
					|| ! isset( $value['domain'] )
					|| ! isset( $value['path'] )
					|| ! isset( $value['parent'] )
				) {
					continue;
				}
				$args = array(
					'id'     => 'ionos-global-navigation-' . $key,
					'title'  => \__( $value['name'], 'ionos-navigation' ),
					'parent' => $value['parent'],
					'href'   => 'https://' . \__( $value['domain'], 'ionos-navigation' ) . $value['path'],
					'meta'   => array(
						'target' => '_blank',
					),
				);
				$wp_admin_bar->add_node( $args );
			}

			//add ionos chat
			if ( \is_plugin_active( 'ionos-sso/ionos-sso.php' )
				&& $this->get_access_token() !== false
				&& $config_array['chat']['enabled'] === true
			) {
				$args = array(
					'id'     => 'ionos-global-navigation-chat',
					'title'  => '<a class="oao-navi-flyout-item oao-pi-open-in-overlay" href="https://'
						. \__( 'ionos.com', 'ionos-navigation' )
						. '/contact?linkid=nav.top.support.Overlay&skipIntcpts=true">'
						. \__( 'IONOS Chat', 'ionos-navigation' )
						. '</a>',
					'parent' => 'ionos-global-navigation-group',
				);
				$wp_admin_bar->add_node( $args );
			}
		}
	}

	/**
	 * Load internal resources
	 */
	public function enqueue_navigation_resources() {
		// Load styles
		\wp_enqueue_style(
			'ionos-navigation-css',
			\Ionos\Navigation\Helper::get_css_url( 'ionos-navigation.css' ),
			array(),
			filemtime( \Ionos\Navigation\Helper::get_css_path( 'ionos-navigation.css' ) )
		);
	}

	/**
	 * Add IONOS JS scripts
	 */
	public function add_external_libraries() {
		echo '<script src="https://ce1.uicdn.net/exos/framework/1.1/ionos.min.js" async="async" id="exos_frontend_services" type="text/javascript"></script>';
		echo '<script src="https://frontend-services.ionos.com/t/tag/IONOS/wp-admin.js" async="async" defer="defer" id="oaotag" type="text/javascript"></script>';

	}

	/**
	 * Check for existing access token
	 *
	 * @return false|string
	 */
	private function get_access_token() {
		$result = false;
		if ( $token = \get_transient( 'ionos_sso_access_token' ) ) {
			$result = \base64_decode( $token );
		}

		return $result;
	}
}