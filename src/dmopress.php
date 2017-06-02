<?php
/*
Plugin Name: DMOPress
Plugin URI: https://www.dmopress.com/products/dmopress/
Description: Built specifically for Destination Marketing Organizations, DMOPress helps you show, share and promote your places of interest.
Author: 2464420 Ontario Inc.
Version: 2.0.0
Author URI: https://www.dmopress.com
*/

// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

define("DMOPRESS_PLUGIN", __FILE__);
define('DMOPRESS_PLUGIN_BASENAME', plugin_basename(DMOPRESS_PLUGIN));
define('DMOPRESS_PLUGIN_NAME', trim(dirname(DMOPRESS_PLUGIN_BASENAME), '/' ));
define('DMOPRESS_PLUGIN_DIR', untrailingslashit(dirname( DMOPRESS_PLUGIN )));
define('DMOPRESS_PLUGIN_MODULES_DIR', DMOPRESS_PLUGIN_DIR . '/modules');
define('DMOPRESS_PLUGIN_STYLESHEETS_DIR', DMOPRESS_PLUGIN_DIR . '/css');

// Functions Library
require_once DMOPRESS_PLUGIN_DIR . '/functions/private.php';
require_once DMOPRESS_PLUGIN_DIR . '/functions/public.php';

// Setup
require_once DMOPRESS_PLUGIN_DIR . '/setup/admin.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/settings.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/hooks.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/meta-box.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/post-type.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/public.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/taxonomies.php';
require_once DMOPRESS_PLUGIN_DIR . '/includes/classes/dmopress-template-loader.php';

// Shortcodes
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/map/map.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-featured-button/tripadvisor-featured-button.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-rating-badge/tripadvisor-rating-badge.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-rating-inline/tripadvisor-rating-inline.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-reviews-button/tripadvisor-reviews-button.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-review-snippets/tripadvisor-review-snippets.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-review-starter/tripadvisor-review-starter.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/twitter-timeline/twitter-timeline.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/weather-current-inline/weather-current-inline.php';

// Widgets
require_once DMOPRESS_PLUGIN_DIR . '/widgets/weather-current-inline/weather-current-inline.php';

//3rd Party Integration
require_once DMOPRESS_PLUGIN_DIR . '/integration/tribe-events-calendar/tribe-events-calendar.php';
require_once DMOPRESS_PLUGIN_DIR . '/integration/visual-composer/visual-composer.php';

//Plugin Activation Tasks
function dmopress_activate() {
    if ( ! get_option( 'myplugin_flush_rewrite_rules_flag' ) ) {
        add_option( 'myplugin_flush_rewrite_rules_flag', true );
    }
}
register_activation_hook( __FILE__, 'dmopress_activate' );

//Plugin Deactivation Tasks
function dmopress_deactivate() {
    dmopress_flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'dmopress_deactivate' );