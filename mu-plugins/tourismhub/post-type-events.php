<?php

// Event Categories
function tourismhub_register_event_categories() {

	$labels = array(
		'name'					=> _x( 'Event Categories', 'Event Categories', 'tourismhub_textdomain' ),
		'singular_name'			=> _x( 'Event Category', 'Event Category', 'tourismhub_textdomain' ),
		'search_items'			=> __( 'Search Event Categories', 'tourismhub_textdomain' ),
		'popular_items'			=> __( 'Popular Event Categories', 'tourismhub_textdomain' ),
		'all_items'				=> __( 'All Event Categories', 'tourismhub_textdomain' ),
		'parent_item'			=> __( 'Parent Event Category', 'tourismhub_textdomain' ),
		'parent_item_colon'		=> __( 'Parent Event Category', 'tourismhub_textdomain' ),
		'edit_item'				=> __( 'Edit Event Category', 'tourismhub_textdomain' ),
		'update_item'			=> __( 'Update Event Category', 'tourismhub_textdomain' ),
		'add_new_item'			=> __( 'Add New Event Category', 'tourismhub_textdomain' ),
		'new_item_name'			=> __( 'New Event Category Name', 'tourismhub_textdomain' ),
		'add_or_remove_items'	=> __( 'Add or remove Event Categories', 'tourismhub_textdomain' ),
		'choose_from_most_used'	=> __( 'Choose from most used categories', 'tourismhub_textdomain' ),
		'menu_name'				=> __( 'Event Categories', 'tourismhub_textdomain' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => false,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'event-category', array( 'events' ), $args );
}

add_action( 'init', 'tourismhub_register_event_categories' );

// Events Post Type
function register_events_post_type() {

	$labels = array(
		'name'                => __( 'Events', 'tourismhub_textdomain' ),
		'singular_name'       => __( 'Event', 'tourismhub_textdomain' ),
		'add_new'             => _x( 'Add New Event', 'tourismhub_textdomain', 'tourismhub_textdomain' ),
		'add_new_item'        => __( 'Add New Event', 'tourismhub_textdomain' ),
		'edit_item'           => __( 'Edit Event', 'tourismhub_textdomain' ),
		'new_item'            => __( 'New Event', 'tourismhub_textdomain' ),
		'view_item'           => __( 'View Event', 'tourismhub_textdomain' ),
		'search_items'        => __( 'Search Events', 'tourismhub_textdomain' ),
		'not_found'           => __( 'No Events found', 'tourismhub_textdomain' ),
		'not_found_in_trash'  => __( 'No Events found in Trash', 'tourismhub_textdomain' ),
		'parent_item_colon'   => __( 'Parent Event:', 'tourismhub_textdomain' ),
		'menu_name'           => __( 'Events', 'tourismhub_textdomain' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array('event-category','post_tag'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-calendar-alt',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'thumbnail'),
	);

	register_post_type( 'events', $args );
}

add_action( 'init', 'register_events_post_type' );