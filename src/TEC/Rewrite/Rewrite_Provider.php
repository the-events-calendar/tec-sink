<?php
/**
 * Provides endpoints for the TEC Kitchen Sink.
 *
 * @since 0.1.0
 * @package TEC\Sink\Rewrite
 */

namespace TEC\Sink\Rewrite;

use TEC\Sink\Plugin;

/**
 * Class Rewrite_Provider
 *
 * @since 0.1.0
 * @package TEC\Sink\Rewrite
 */
class Rewrite_Provider extends \tad_DI52_ServiceProvider {
	/**
	 * Endpoint.
	 *
	 * @var string
	 */
	public $endpoint = 'tec-sink';

	/**
	 * Binds and sets up implementation.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		$this->add_actions();
		$this->add_filters();
	}

	/**
	 * Adds the required actions for endpoint support.
	 *
	 * @since 0.1.0
	 */
	protected function add_actions() {
		add_action( 'init', [ $this, 'action_add_endpoints' ] );
	}

	/**
	 * Adds the required filters for endpoint support.
	 *
	 * @since 0.1.0
	 */
	protected function add_filters() {
		add_filter( 'query_vars', [ $this, 'filter_add_custom_query_vars' ] );
	}

	/**
	 * Adds rewrite endpoints.
	 *
	 * @since 0.1.0
	 */
	public function action_add_endpoints() {
		add_rewrite_rule( '^' . $this->endpoint . '/?', 'index.php?tec_sink_page=tec-sink', 'top' );
		add_rewrite_endpoint( $this->endpoint, EP_PERMALINK );
	}

	/**
	 * Adds custom query vars for the tec sink.
	 *
	 * @param array $vars Query vars.
	 *
	 * @return array|mixed
	 */
	public function filter_add_custom_query_vars( $vars = [] ) {
		$vars[] = 'tec_sink_page';
		return $vars;
	}
}