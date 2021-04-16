<?php
/**
 * Provides topics for the TEC Kitchen Sink.
 *
 * @since 0.1.0
 * @package TEC\Sink\Topics
 */

namespace TEC\Sink\Topics;

/**
 * Class Topics_Provider
 *
 * @since 0.1.0
 * @package TEC\Sink\Topics
 */
class Topics_Provider extends \tad_DI52_ServiceProvider {
	/**
	 * @var array
	 */
	protected $topics;

	/**
	 * Binds and sets up implementation.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		$this->container->singleton( self::class, self::class );

		$this->topics = [
			Date_Pickers::class,
		];

		$this->init_topics();
	}

	/**
	 * Initializes the topics in the container.
	 *
	 * @since 0.1.0
	 */
	protected function init_topics() {
		foreach ( $this->topics as $topic ) {
			$this->container->singleton( $topic, $topic );
		}
	}

	/**
	 * Gets the topic class names.
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	public function get_topics() {
		static $topics = [];

		if ( empty( $topics ) ) {
			foreach ( $this->topics as $topic_class ) {
				$topics[] = tribe( $topic_class );
			}
		}

		return $topics;
	}
}
