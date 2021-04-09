<?php
/**
 * The main TEC Sink plugin service provider: it bootstraps the plugin code.
 *
 * @since   0.1.0
 *
 * @package TEC\Sink
 */

namespace TEC\Sink;

use Tribe__Autoloader;

/**
 * Class Plugin
 *
 * @since   0.1.0
 *
 * @package TEC\Sink
 */
class Plugin extends \tad_DI52_ServiceProvider {
	/**
	 * Stores the version for the plugin.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	const VERSION = '0.1.0';

	/**
	 * Stores the base slug for the plugin.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	const SLUG = 'tec-sink';

	/**
	 * Stores the base slug for the extension.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	const FILE = TEC_SINK_FILE;

	/**
	 * @since 0.1.0
	 *
	 * @var string Plugin Directory.
	 */
	public $plugin_dir;

	/**
	 * @since 0.1.0
	 *
	 * @var string Plugin path.
	 */
	public $plugin_path;

	/**
	 * @since 0.1.0
	 *
	 * @var string Plugin URL.
	 */
	public $plugin_url;

	/**
	 * Setup the Extension's properties.
	 *
	 * This always executes even if the required plugins are not present.
	 */
	public function register() {
		// Set up the plugin provider properties.
		$this->plugin_path = trailingslashit( dirname( static::FILE ) );
		$this->plugin_dir  = trailingslashit( basename( $this->plugin_path ) );
		$this->plugin_url  = plugins_url( $this->plugin_dir, $this->plugin_path );

		$this->register_autoloader();

		// Register this provider as the main one and use a bunch of aliases.
		$this->container->singleton( static::class, $this );
		$this->container->singleton( 'tec-sink', $this );

		$this->load_template_tags();

		// Start binds.

		// End binds.

		// @todo: Fix all this madness. THIS IS ALL HACKY FOR TESTING PURPOSES
		$obj = $this;

		add_action( 'init', static function() use ( $obj ) {
			add_rewrite_endpoint( 'tec-sink', EP_PERMALINK );
			wp_enqueue_style( 'tec-sink', $obj->plugin_url . '/src/resources/css/tec-sink.css' );

			if ( ! empty( $_GET['suppress-topbar'] ) ) {
				add_filter( 'show_admin_bar', '__return_false' );
			}
		} );

		add_filter( 'request', static function( $vars ) {
			if ( isset( $vars['pagename'] ) && 'tec-sink' === $vars['pagename'] ) {
				$vars['tec-sink'] = true;
			}

			return $vars;
		} );

		add_filter( 'template_include', function( $template ) {
			if ( ! get_query_var( 'tec-sink' ) ) {
				return $template;
			}

			return $this->plugin_path . '/src/views/dashboard.php';
		} );
	}

	/**
	 * Register the Tribe Autoloader in Virtual Events.
	 *
	 * @since 0.1.0
	 */
	protected function register_autoloader() {
		$autoloader = Tribe__Autoloader::instance();

		// For namespaced classes.
		$autoloader->register_prefix(
			'\\TEC\\Sink\\',
			$this->plugin_path . '/src/TEC',
			'tec-sink'
		);
	}

	/**
	 * Adds template tags once the plugin has loaded.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	protected function load_template_tags() {
		require_once $this->plugin_path . 'src/functions/general.php';
	}
}
