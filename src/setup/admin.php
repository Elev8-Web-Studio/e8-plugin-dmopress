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
	  
    wp_register_script( 'js-public', plugins_url() . '/dmopress/js/dmopress-public.min.js', false, null, true);
    // Inject dynamic client-side data 
    $injected_content = array(
      'openWeatherMapAPIKey' => dmo_get_openweathermap_api_key(),
      'openWeatherMapDefaultUnit' => dmo_get_openweathermap_default_unit(),
      'openWeatherMapCityId' => dmo_get_openweathermap_city_id()
    );
    wp_localize_script( 'js-public', 'injectedContent', $injected_content );
    wp_enqueue_script('js-public');
    
    wp_enqueue_style('custom_meta_css', plugins_url() . '/dmopress/css/dmopress-admin.min.css');
    wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key='.dmo_get_google_maps_api_key());
    
    wp_register_script( 'app-js', plugins_url() . '/dmopress/js/dmopress-admin.min.js', false);
    // Localize the script with new data
    $translation_array = array(
      'invalid_url' => __( 'Invalid URL', 'dmopress' ),
      'invalid_phone' => __('Invalid phone', 'dmopress')
    );
    wp_localize_script( 'app-js', 'translated', $translation_array );
    wp_enqueue_script('app-js');

    
   
  }
}
add_action('admin_enqueue_scripts','dmo_enqueue_admin_css');