<?php
/*
Plugin Name: DMOPress
Plugin URI: https://www.dmopress.com/products/dmopress/
Description: Built specifically for Destination Marketing Organizations, DMOPress helps you show, share and promote your places of interest.
Author: 2464420 Ontario Inc.
Version: 1.0.0
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
require_once DMOPRESS_PLUGIN_DIR . '/includes/functions.php';

// Setup
require_once DMOPRESS_PLUGIN_DIR . '/setup/admin.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/settings.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/hooks.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/meta-box.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/post-type.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/public.php';
require_once DMOPRESS_PLUGIN_DIR . '/setup/taxonomies.php';
require_once DMOPRESS_PLUGIN_DIR . '/includes/classes/class-tourismpress-template-loader.php';

// Shortcodes
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/map/map.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-featured-button/tripadvisor-featured-button.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-rating-badge/tripadvisor-rating-badge.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-rating-inline/tripadvisor-rating-inline.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-reviews-button/tripadvisor-reviews-button.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-review-snippets/tripadvisor-review-snippets.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/tripadvisor-review-starter/tripadvisor-review-starter.php';
require_once DMOPRESS_PLUGIN_DIR . '/shortcodes/twitter-timeline/twitter-timeline.php';

//3rd Party Integration
require_once DMOPRESS_PLUGIN_DIR . '/integration/tribe-events-calendar/tribe-events-calendar.php';

/**
 * Add a Settings link to plugin on Plugins page
 */
function dmo_add_settings_link($links, $file) {
    static $this_plugin;
    if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

    if ($file == $this_plugin){
        $guide_link = '<a href="https://www.dmopress.com/guide/" target="_blank">'.__("Documentation", "tourismpress").'</a>';
        array_unshift($links, $guide_link);
        
        $settings_link = '<a href="options-general.php?page=tourismpress-settings">'.__("Settings", "tourismpress").'</a>';
        array_unshift($links, $settings_link);
        
    }
    return $links;
}
add_filter('plugin_action_links', 'dmo_add_settings_link', 10, 2 );



function dmopress_plugin_row_meta( $links, $file ) {

	if ( strpos( $file, 'dmopress.php' ) !== false ) {
		$new_links = array(
				'support' => '<a href="https://www.dmopress.com/support/" target="_blank">Support</a>'
				);
		
		$links = array_merge( $links, $new_links );
	}
	
	return $links;
}
add_filter( 'plugin_row_meta', 'dmopress_plugin_row_meta', 10, 2 );