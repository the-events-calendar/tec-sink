<?php
/**
 * Provides views for the TEC Kitchen Sink.
 *
 * @since 0.1.0
 * @package TEC\Sink\Views
 */

namespace TEC\Sink\Views;

/**
 * Class View_Provider
 *
 * @since 0.1.0
 * @package TEC\Sink\Views
 */
class Views_Provider extends \tad_DI52_ServiceProvider {
	/**
	 * @var bool
	 */
	protected $is_sink_page;

	/**
	 * Binds and sets up implementation.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		$this->container->singleton( self::class, self::class );
		$this->container->singleton( Sink::class, Sink::class );

		$this->add_filters();
	}

	/**
	 * Returns whether or not the current page is a sink page.
	 *
	 * @since 0.1.0
	 *
	 * @return bool
	 */
	protected function is_sink_page() {
		if ( null !== $this->is_sink_page ) {
			return $this->is_sink_page;
		}

		$this->is_sink_page = (bool) get_query_var( 'tec_sink_page' );

		return $this->is_sink_page;
	}

	/**
	 * Adds the required filters for endpoint support.
	 *
	 * @since 0.1.0
	 */
	protected function add_filters() {
		add_filter( 'template_include', [ $this, 'filter_template_include' ] );
		add_filter( 'wp_title', [ $this, 'filter_wp_title' ] );
	}

	/**
	 * Filter the template based on the request.
	 *
	 * @since 0.1.0
	 *
	 * @param string $template Template to load.
	 * @return string
	 */
	public function filter_template_include( $template ) {
		if ( ! $this->is_sink_page() ) {
			return $template;
		}

		if ( ! empty( $_GET['tec_sink_theme'] ) ) {
			$_COOKIE['tec-sink-theme'] = $_GET['tec_sink_theme'];
		}

		return $this->container->make( Sink::class )->get_template();
	}

	/**
	 * Filters the page title.
	 *
	 * @since 0.1.0
	 *
	 * @param string $title The page title.
	 * @return string
	 */
	public function filter_wp_title( $title ) {
		if ( ! $this->is_sink_page() ) {
			return $title;
		}

		return 'TEC Kitchen Sink';
	}
}
