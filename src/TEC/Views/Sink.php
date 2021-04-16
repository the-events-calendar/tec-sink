<?php
/**
 * Provides the sink view.
 *
 * @since 0.1.0
 * @package TEC\Sink\Views
 */

namespace TEC\Sink\Views;

use TEC\Sink\Assets;
use TEC\Sink\Plugin;
use TEC\Sink\Topics;

class Sink {

	/**
	 * Gets the template for the sink page.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	public function get_template() {
		// Suppress the admin bar.
		add_filter( 'show_admin_bar', '__return_false' );
		remove_action( 'wp_head', '_admin_bar_bump_cb' );

		tribe_asset_enqueue_group( Assets::$group_key );

		return tribe( Plugin::class )->plugin_path . '/src/views/dashboard.php';
	}

	/**
	 * Gets the Kitchen Sink sections.
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	public function get_sections() {
		$sections = [
			'components' => [
				'name'   => 'Components',
				'topics' => [
					tribe( Topics\Date_Pickers::class ),
				],
			],
			'dashboard' => [
				'name'   => 'Dashboard',
				'topics' => [],
			],
		];

		return $sections;
	}

	/**
	 * Returns whether or not the requested item is an admin dashboard item.
	 *
	 * @since 0.1.0
	 *
	 * @return bool
	 */
	public function is_dashboard_request() {
		return ! empty( $_GET['dashboard'] );
	}

	public function get_themes() {
		static $themes = [];

		if ( empty( $themes ) ) {
			$theme_data = wp_get_themes();

			foreach ( $theme_data as $key => $theme ) {
				$themes[ $key ] = $theme->name;
			}
		}

		return $themes;
	}

	public function get_selected_theme() {
		$themes        = $this->get_themes();
		$current_theme = wp_get_theme()->get_template();

		if ( empty( $_COOKIE['tec-sink-theme'] ) ) {
			return $current_theme;
		}

		$cookie_theme = $_COOKIE['tec-sink-theme'];

		if ( empty( $themes[ $cookie_theme ] ) ) {
			return $current_theme;
		}

		return $cookie_theme;
	}
}
