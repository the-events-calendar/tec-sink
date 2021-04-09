<?php
/**
 * Register and load the service provider for loading the plugin.
 *
 * The function will detect the presence of Common and TEC and decline to load if not found.
 *
 * @since 0.1.0
 *
 * @return bool Whether the plugin did load successfully or not.
 */
function tec_sink_preload() {
	if ( ! (
		function_exists( 'tribe_register_provider' )
		&& class_exists( 'Tribe__Abstract_Plugin_Register' )
	) ) {
		// Loaded in single site or not network-activated in a multisite installation.
		add_action( 'admin_notices', 'tribe_events_virtual_show_fail_message' );
		// Network-activated in a multisite installation.
		add_action( 'network_admin_notices', 'tribe_events_virtual_show_fail_message' );
		// Prevent loading of the plugin if common is loaded (better safe than sorry).
		remove_action( 'tribe_common_loaded', 'tec_sink_load' );

		return false;
	}

	return true;
}

/**
 * Register and load the service provider for loading the plugin.
 *
 * @since 0.1.0
 */
function tec_sink_load() {
	tribe_register_provider( \TEC\Sink\Plugin::class );
}

/**
 * Shows a message to indicate the plugin cannot be loaded due to missing requirements.
 *
 * @since 0.1.0
 */
function tec_sink_show_fail_message() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$url = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';

	$message = sprintf(
		'%1s <a href="%2s" class="thickbox" title="%3s">%3$s</a>.',
		esc_html__(
			'To begin using the TEC Plugin Kitchen Sink, please install the latest version of',
			'tec-sink'
		),
		esc_url( $url ),
		esc_html__( 'The Events Calendar', 'tec-sink' )
	);

	// The message HTML is escaped in the line above.
	// phpcs:ignore
	echo '<div class="error"><p>' . $message . '</p></div>';
}
