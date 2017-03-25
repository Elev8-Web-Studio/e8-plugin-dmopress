<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

// stylesheet used by all similar meta boxes
function dmo_enqueue_admin_css() {
  // Get the globals that tell us where we are in the admin.
  global $pagenow, $typenow;
  // Sometimes $typenow is not available, so let's check and get it if needed.
  if (empty($typenow) && !empty($_GET['post'])) {
    $post = get_post($_GET['post']);
    $typenow = $post->post_type;
  }
  // Only show our scripts on the admin pages they are used on to prevent possible conflicts with other scripts.
  if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'places') {
	 wp_enqueue_style('custom_meta_css', plugins_url() . '/tourismpress/css/tourismpress-admin.min.css');
   wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key='.get_theme_mod('google_maps_api_key'), false );
   wp_enqueue_script('app-js', plugins_url() . '/tourismpress/js/app.min.js', false);
   
  }
}
add_action('admin_init','dmo_enqueue_admin_css');