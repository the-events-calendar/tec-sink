<?php
/*
Plugin Name: The Events Calendar: Kitchen Sink
Description: Utility plugin for viewing the TEC design system.
Version: 0.1.0
Author: The Events Calendar
Author URI: http://evnt.is/20
Text Domain: tec-sink
License: GPLv2 or later
*/

/*
Copyright 2010-2012 by Modern Tribe Inc and the contributors

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


define( 'TEC_SINK_FILE', __FILE__ );

// Load Composer autoload file only if we've not included this file already.
require_once dirname( TEC_SINK_FILE ) . '/vendor/autoload.php';

// Include the file that defines the functions handling the plugin load operations.
require_once __DIR__ . '/src/functions/load.php';

// Add a second action to handle the case where Common is not loaded, we still want to let the user know what is happening.
add_action( 'plugins_loaded', 'tec_sink_preload', 50 );

// Loads after common is already properly loaded.
add_action( 'tribe_common_loaded', 'tec_sink_load' );
