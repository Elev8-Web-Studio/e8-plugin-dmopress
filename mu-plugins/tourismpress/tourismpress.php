<?php
/**
 * @package TourismPress
 * @version 1.0.0
 */
/*
Plugin Name: TourismPress
Plugin URI: http://tourismpress.net
Description: This plugin powers the TourismPress platform. Do not deactivate or remove it.
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
require_once tourismpress_PLUGIN_DIR . '/functions-global.php';

// Actions
require_once tourismpress_PLUGIN_DIR . '/actions-global.php';

// Custom Post Types
require_once tourismpress_PLUGIN_DIR . '/post-type-blog.php';
require_once tourismpress_PLUGIN_DIR . '/post-type-news.php';
require_once tourismpress_PLUGIN_DIR . '/post-type-events.php';
require_once tourismpress_PLUGIN_DIR . '/post-type-attractions.php';
require_once tourismpress_PLUGIN_DIR . '/post-type-accommodations.php';
require_once tourismpress_PLUGIN_DIR . '/post-type-restaurants.php';
require_once tourismpress_PLUGIN_DIR . '/post-type-packages.php';

// Administration Customizations
require_once tourismpress_PLUGIN_DIR . '/admin-login.php';
require_once tourismpress_PLUGIN_DIR . '/admin-customizations.php';
require_once tourismpress_PLUGIN_DIR . '/admin-settings.php';
require_once tourismpress_PLUGIN_DIR . '/admin-dashboard.php';
require_once tourismpress_PLUGIN_DIR . '/admin-menu.php';
require_once tourismpress_PLUGIN_DIR . '/admin-bar.php';
require_once tourismpress_PLUGIN_DIR . '/admin-footer.php';

// Integration Modules
require_once tourismpress_PLUGIN_DIR . '/integration-google-analytics.php';

