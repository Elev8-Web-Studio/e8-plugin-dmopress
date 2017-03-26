<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

// Link Places to Events
function dmopress_link_places_to_tribe_events() {
	if( function_exists( 'tribe_register_linked_post_type' ) ) {
        tribe_register_linked_post_type('places');
    }
}
add_action( 'init', 'dmopress_link_places_to_tribe_events' );

//Remove default Venue selections, since we are replacing it with Places
function dmopress_remove_venues_from_tribe_events( $default_types ) {
	
    if ( ! is_array( $default_types ) || empty( $default_types ) ) {
		return $default_types;
	}

	if ( ( $key = array_search( 'tribe_venue', $default_types ) ) !== false ) {
		unset( $default_types[ $key ] );
	}

	return $default_types;
}

add_filter( 'tribe_events_register_default_linked_post_types', 'dmopress_remove_venues_from_tribe_events' );