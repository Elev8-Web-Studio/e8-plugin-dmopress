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

// Administration Customizations
require_once tourismpress_PLUGIN_DIR . '/setup/customizer.php';

//3rd Party Integration
require_once tourismpress_PLUGIN_DIR . '/functions/3rdparty/tribe-events-calendar.php';

// stylesheet used by all similar meta boxes
add_action('admin_init','tourismpress_enqueue_admin_css');
function tourismpress_enqueue_admin_css() {
  // Get the globals that tell us where we are in the admin.
  global $pagenow, $typenow;
  // Sometimes $typenow is not available, so let's check and get it if needed.
  if (empty($typenow) && !empty($_GET['post'])) {
    $post = get_post($_GET['post']);
    $typenow = $post->post_type;
  }
  // Only show our scripts on the admin pages they are used on to prevent possible conflicts with other scripts.
  if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'places') {
	 // WP Alchemy Stylesheet
	 wp_enqueue_style('custom_meta_css', plugins_url() . '/tourismpress/css/tourismpress-admin.min.css');
   wp_enqueue_script('app-js', plugins_url() . '/tourismpress/js/app.min.js', false);
  }
}

add_action('init','tourismpress_enqueue_css');
function tourismpress_enqueue_css() {
  wp_enqueue_style('tourismpress_css', plugins_url() . '/tourismpress/css/tourismpress.min.css');
}

