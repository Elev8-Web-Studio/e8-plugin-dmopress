<?php
/*
Plugin Name: TourismPress
Plugin URI: http://tourismpress.net
Description: A WordPress plugin for people who promote places.
Author: Jason Pomerleau
Version: 1.0.0
Author URI: http://tourismpress.net
*/

// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

define("tourismpress_PLUGIN", __FILE__);
define('tourismpress_PLUGIN_BASENAME', plugin_basename(tourismpress_PLUGIN));
define('tourismpress_PLUGIN_NAME', trim(dirname(tourismpress_PLUGIN_BASENAME), '/' ));
define('tourismpress_PLUGIN_DIR', untrailingslashit(dirname( tourismpress_PLUGIN )));
define('tourismpress_PLUGIN_MODULES_DIR', tourismpress_PLUGIN_DIR . '/modules');
define('tourismpress_PLUGIN_STYLESHEETS_DIR', tourismpress_PLUGIN_DIR . '/css');

// Functions Library
require_once tourismpress_PLUGIN_DIR . '/functions/general.php';

// Custom Post Types
require_once tourismpress_PLUGIN_DIR . '/places/post-type.php';
require_once tourismpress_PLUGIN_DIR . '/places/taxonomies.php';
require_once tourismpress_PLUGIN_DIR . '/places/meta-box.php';

// Shortcodes
require_once tourismpress_PLUGIN_DIR . '/shortcodes/map/map.php';
require_once tourismpress_PLUGIN_DIR . '/shortcodes/tripadvisor-featured-button/tripadvisor-featured-button.php';
require_once tourismpress_PLUGIN_DIR . '/shortcodes/tripadvisor-rating-badge/tripadvisor-rating-badge.php';
require_once tourismpress_PLUGIN_DIR . '/shortcodes/tripadvisor-rating-inline/tripadvisor-rating-inline.php';
require_once tourismpress_PLUGIN_DIR . '/shortcodes/tripadvisor-reviews-button/tripadvisor-reviews-button.php';
require_once tourismpress_PLUGIN_DIR . '/shortcodes/tripadvisor-review-snippets/tripadvisor-review-snippets.php';
require_once tourismpress_PLUGIN_DIR . '/shortcodes/tripadvisor-review-starter/tripadvisor-review-starter.php';
require_once tourismpress_PLUGIN_DIR . '/shortcodes/twitter-timeline/twitter-timeline.php';

// Setup
require_once tourismpress_PLUGIN_DIR . '/setup/admin.php';
require_once tourismpress_PLUGIN_DIR . '/setup/customizer.php';
require_once tourismpress_PLUGIN_DIR . '/setup/hooks.php';
require_once tourismpress_PLUGIN_DIR . '/setup/public.php';

//3rd Party Integration
require_once tourismpress_PLUGIN_DIR . '/functions/3rdparty/tribe-events-calendar.php';
require_once tourismpress_PLUGIN_DIR . '/classes/class-tourismpress-template-loader.php';

