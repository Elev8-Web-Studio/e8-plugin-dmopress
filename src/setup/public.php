<?php 

function dmopress_enqueue_css() {
  wp_enqueue_style('dmopress_css', plugins_url() . '/dmopress/css/dmopress.min.css');
}
add_action('init','dmopress_enqueue_css');

function dmopress_enqueue_script() {
	if(dmo_get_google_maps_api_key() != ''){
    wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key='.dmo_get_google_maps_api_key());
  }
}

add_action( 'wp_enqueue_scripts', 'dmopress_enqueue_script' );