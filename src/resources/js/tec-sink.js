var tec_sink = tec_sink || {};

( function( $, _, obj ) {
	'use strict';
	var $window = $( window );

	obj.selectors = {
		iframe: '#tec-sink-iframe',
		themes: '#tec-sink-theme',
	};

	/**
	 * Changes the currently selected theme within the cookie.
	 *
	 * @since 0.1.0
	 *
	 * @param {String} theme The theme to switch to.
	 */
	obj.changeTheme = function( theme ) {
		document.cookie = 'tec-sink-theme=' + theme + '; path=/';
		obj.reloadFrame();
	};

	/**
	 * Event bound to the theme select.
	 *
	 * @since 0.1.0
	 */
	obj.eventChangeTheme = function() {
		var $el = $( this );
		var value = $el.val();

		if ( ! value ) {
			return;
		}

		obj.changeTheme( value );
	};

	/**
	 * Reloads the sink iframe.
	 *
	 * @since 0.1.0
	 */
	obj.reloadFrame = function() {
		var $frame = $( obj.selectors.iframe );

		$frame[0].contentDocument.location.reload( true );
	};

	/**
	 * Handles the initialization of the tec_sink object when the Document is ready.
	 *
	 * @since 0.1.0
	 *
	 * @return {void}
	 */
	obj.ready = function() {
		$( document ).on( 'change', obj.selectors.themes, obj.eventChangeTheme );
	};

	$( obj.ready );
} )( jQuery, window.underscore || window._, tec_sink );