<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

// Link Places to Events
function tribe_link_places_to_events() {
	if( function_exists( 'tribe_register_linked_post_type' ) ) {
        tribe_register_linked_post_type('places');
    }
}
add_action( 'init', 'tribe_link_places_to_events' );

//Remove default Venue selections, since we are replacing it with Places
function tribe_remove_venues_from_events( $default_types ) {
	
    if ( ! is_array( $default_types ) || empty( $default_types ) ) {
		return $default_types;
	}

	if ( ( $key = array_search( 'tribe_venue', $default_types ) ) !== false ) {
		unset( $default_types[ $key ] );
	}

	return $default_types;
}

add_filter( 'tribe_events_register_default_linked_post_types', 'tribe_remove_venues_from_events' );