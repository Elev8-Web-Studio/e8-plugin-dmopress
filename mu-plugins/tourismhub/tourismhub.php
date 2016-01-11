<?php
/**
 * @package TourismHub
 * @version 0.1
 */
/*
Plugin Name: TourismHub
Plugin URI: http://tourismhub.io
Description: This plugin powers the TourismHub platform. Do not deactivate or remove it.
Author: Jason Pomerleau
Version: 0.1
Author URI: http://tourismhub.io
*/

// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

define("TOURISMHUB_PLUGIN", __FILE__);
define('TOURISMHUB_PLUGIN_BASENAME', plugin_basename(TOURISMHUB_PLUGIN));
define('TOURISMHUB_PLUGIN_NAME', trim(dirname(TOURISMHUB_PLUGIN_BASENAME), '/' ));
define('TOURISMHUB_PLUGIN_DIR', untrailingslashit(dirname( TOURISMHUB_PLUGIN )));
define('TOURISMHUB_PLUGIN_MODULES_DIR', TOURISMHUB_PLUGIN_DIR . '/modules');
define('TOURISMHUB_PLUGIN_STYLESHEETS_DIR', TOURISMHUB_PLUGIN_DIR . '/css');

// Functions Library
require_once TOURISMHUB_PLUGIN_DIR . '/functions-global.php';

// Actions
require_once TOURISMHUB_PLUGIN_DIR . '/actions-global.php';

// Custom Post Types
require_once TOURISMHUB_PLUGIN_DIR . '/post-type-blog.php';
require_once TOURISMHUB_PLUGIN_DIR . '/post-type-news.php';
require_once TOURISMHUB_PLUGIN_DIR . '/post-type-events.php';
require_once TOURISMHUB_PLUGIN_DIR . '/post-type-attractions.php';
require_once TOURISMHUB_PLUGIN_DIR . '/post-type-accommodations.php';
require_once TOURISMHUB_PLUGIN_DIR . '/post-type-restaurants.php';
require_once TOURISMHUB_PLUGIN_DIR . '/post-type-packages.php';

// Administration Customizations
require_once TOURISMHUB_PLUGIN_DIR . '/admin-login.php';
require_once TOURISMHUB_PLUGIN_DIR . '/admin-customizations.php';
require_once TOURISMHUB_PLUGIN_DIR . '/admin-settings.php';
require_once TOURISMHUB_PLUGIN_DIR . '/admin-dashboard.php';
require_once TOURISMHUB_PLUGIN_DIR . '/admin-menu.php';
require_once TOURISMHUB_PLUGIN_DIR . '/admin-bar.php';
require_once TOURISMHUB_PLUGIN_DIR . '/admin-footer.php';

// Integration Modules
require_once TOURISMHUB_PLUGIN_DIR . '/integration-google-analytics.php';