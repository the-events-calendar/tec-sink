<?php
/**
 * An abstract base class for topics.
 *
 * @since 0.1.0
 * @package TEC\Sink\Views\Topics
 */

namespace TEC\Sink\Topics;

/**
 * Class Abstract_Topic
 *
 * @since 0.1.0
 * @package TEC\Sink\Views\Topics
 */
class Abstract_Topic {
	/**
	 * Topic name.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Topic section.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $section;

	/**
	 * Topic slug.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $slug;

	/**
	 * URL arguments for the topic.
	 *
	 * @since 0.1.0
	 *
	 * @var array
	 */
	protected $url_args = [];

	/**
	 * Abstract_Topic constructor.
	 */
	public function __construct() {
		$this->url_args['topic'] = $this->slug;
	}

	/**
	 * Gets the name of the topic.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Gets the section of the topic.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	public function get_section() {
		return $this->section;
	}

	/**
	 * Gets the slug of the topic.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	public function get_slug() {
		return $this->slug;
	}

	/**
	 * Gets the URL arguments of the topic.
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	public function get_url_args() {
		return $this->url_args;
	}
}