<?php
/**
 * Handles registering all Assets for the TEC Kitchen Sink plugin.
 *
 * To remove an Asset, you can use the global assets handler:
 *
 * ```php
 *  tribe( 'assets' )->remove( 'asset-name' );
 * ```
 *
 * @since 0.1.0
 *
 * @package TEC\Sink
 */

namespace TEC\Sink;

class Assets extends \tad_DI52_ServiceProvider {
	/**
	 * Key for this group of assets.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	public static $group_key = 'tec-sink';

	/**
	 * Caches the result of the `should_enqueue_frontend` check.
	 *
	 * @since 0.1.0
	 *
	 * @var bool
	 */
	protected $should_enqueue_frontend;

	/**
	 * Binds and sets up implementations.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		$this->container->singleton( static::class, $this );
		$plugin = tribe( Plugin::class );

		tribe_asset(
			$plugin,
			Plugin::SLUG,
			'tec-sink.css',
			[],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);

		tribe_asset(
			$plugin,
			Plugin::SLUG . '-js',
			'tec-sink.js',
			[],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);
	}

	/**
	 * Determines if the assets should enqueue.
	 */
	public function should_enqueue_frontend() {
		if ( null !== $this->should_enqueue_frontend ) {
			return $this->should_enqueue_frontend;
		}

		$this->should_enqueue_frontend = (bool) get_query_var( Plugin::SLUG );

		return $this->should_enqueue_frontend;
	}
}
