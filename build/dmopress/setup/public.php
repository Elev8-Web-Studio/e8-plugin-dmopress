<?php 

function dmopress_enqueue_public_css() {
	if(dmo_get_google_maps_api_key() != ''){
    wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key='.dmo_get_google_maps_api_key());
  }
  wp_enqueue_style('dmopress_css', plugins_url() . '/dmopress/css/dmopress.min.css');
}

add_action( 'wp_enqueue_scripts', 'dmopress_enqueue_public_css' );

//Enqueue JS
function dmopress_enqueue_public_script() {
	
    wp_register_script( 'js-public', plugins_url() . '/dmopress/js/dmopress-public.min.js', false);
    // Inject dynamic client-side data 
    $injected_content = array(
      'openWeatherMapAPIKey' => dmo_get_openweathermap_api_key(),
      'openWeatherMapDefaultUnit' => dmo_get_openweathermap_default_unit(),
      'openWeatherMapCityId' => dmo_get_openweathermap_city_id()
    );
    wp_localize_script( 'js-public', 'injectedContent', $injected_content );
    wp_enqueue_script('js-public');
    
    //wp_enqueue_script( 'js-public', plugins_url() . '/dmopress/js/dmopress-public.min.js', false );
}

add_action( 'wp_enqueue_scripts', 'dmopress_enqueue_public_script' );