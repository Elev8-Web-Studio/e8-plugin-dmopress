<?php
/*
Plugin Name: DMOPress
Plugin URI: https://www.dmopress.com/products/dmopress/
Description: Built specifically for Destination Marketing Organizations, DMOPress helps you show, share and promote your places of interest.
Author: 2464420 Ontario Inc.
Version: 2.3.0
Author URI: https://www.dmopress.com
*/

// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

define("DMOPRESS_PLUGIN", __FILE__);
define('DMOPRESS_PLUGIN_BASENAME', plugin_basename(DMOPRESS_PLUGIN));
define('DMOPRESS_PLUGIN_NAME', trim(dirname(DMOPRESS_PLUGIN_BASENAME), '/' ));
define('DMOPRESS_PLUGIN_DIR', untrailingslashit(dirname( DMOPRESS_PLUGIN )));
define('DMOPRESS_PLUGIN_CORE_DIR', DMOPRESS_PLUGIN_DIR . '/core');
define('DMOPRESS_PLUGIN_MODULES_DIR', DMOPRESS_PLUGIN_DIR . '/modules');
define('DMOPRESS_PLUGIN_STYLESHEETS_DIR', DMOPRESS_PLUGIN_DIR . '/css');

// Core
require_once DMOPRESS_PLUGIN_CORE_DIR . '/activation.php';
require_once DMOPRESS_PLUGIN_CORE_DIR . '/admin.php';
require_once DMOPRESS_PLUGIN_CORE_DIR . '/api.php';
require_once DMOPRESS_PLUGIN_CORE_DIR . '/settings.php';
require_once DMOPRESS_PLUGIN_CORE_DIR . '/functions.php';
require_once DMOPRESS_PLUGIN_CORE_DIR . '/hooks.php';
require_once DMOPRESS_PLUGIN_CORE_DIR . '/meta-box.php';
require_once DMOPRESS_PLUGIN_CORE_DIR . '/post-type.php';
require_once DMOPRESS_PLUGIN_CORE_DIR . '/public.php';
require_once DMOPRESS_PLUGIN_CORE_DIR . '/taxonomies.php';
require_once DMOPRESS_PLUGIN_CORE_DIR . '/template-loader.php';

//Load Modules
foreach (dmopress_enabled_modules() as $enabled_module) {
    require_once DMOPRESS_PLUGIN_MODULES_DIR.'/'.$enabled_module.'/'.$enabled_module.'.php';
}
