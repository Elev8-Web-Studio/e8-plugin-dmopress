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

// Show the Place on the event detail page, instead of the default Venue
add_filter( 'tribe_events_single_event_before_the_content', 'dmopress_inject_place_link_into_events' );
function dmopress_inject_place_link_into_events() {
    $dmopress_template_loader = new DMOPress_Template_Loader;
    $dmopress_template_loader->get_template_part('tribe','eventdetail');
}


// Show the map on the event detail page after the event meta
add_filter( 'tribe_events_single_event_after_the_meta', 'dmopress_inject_place_map_after_meta' );
function dmopress_inject_place_map_after_meta() {
    $dmopress_template_loader = new DMOPress_Template_Loader;
    $dmopress_template_loader->get_template_part('tribe','aftereventmeta');
}
