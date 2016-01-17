<?php

// Event Categories
function tourismpress_register_event_categories() {

	$labels = array(
		'name'					=> _x( 'Event Categories', 'Event Categories', 'tourismpress_textdomain' ),
		'singular_name'			=> _x( 'Event Category', 'Event Category', 'tourismpress_textdomain' ),
		'search_items'			=> __( 'Search Event Categories', 'tourismpress_textdomain' ),
		'popular_items'			=> __( 'Popular Event Categories', 'tourismpress_textdomain' ),
		'all_items'				=> __( 'All Event Categories', 'tourismpress_textdomain' ),
		'parent_item'			=> __( 'Parent Event Category', 'tourismpress_textdomain' ),
		'parent_item_colon'		=> __( 'Parent Event Category', 'tourismpress_textdomain' ),
		'edit_item'				=> __( 'Edit Event Category', 'tourismpress_textdomain' ),
		'update_item'			=> __( 'Update Event Category', 'tourismpress_textdomain' ),
		'add_new_item'			=> __( 'Add New Event Category', 'tourismpress_textdomain' ),
		'new_item_name'			=> __( 'New Event Category Name', 'tourismpress_textdomain' ),
		'add_or_remove_items'	=> __( 'Add or remove Event Categories', 'tourismpress_textdomain' ),
		'choose_from_most_used'	=> __( 'Choose from most used categories', 'tourismpress_textdomain' ),
		'menu_name'				=> __( 'Event Categories', 'tourismpress_textdomain' ),
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

add_action( 'init', 'tourismpress_register_event_categories' );

// Events Post Type
function register_events_post_type() {

	$labels = array(
		'name'                => __( 'Events', 'tourismpress_textdomain' ),
		'singular_name'       => __( 'Event', 'tourismpress_textdomain' ),
		'add_new'             => _x( 'Add New Event', 'tourismpress_textdomain', 'tourismpress_textdomain' ),
		'add_new_item'        => __( 'Add New Event', 'tourismpress_textdomain' ),
		'edit_item'           => __( 'Edit Event', 'tourismpress_textdomain' ),
		'new_item'            => __( 'New Event', 'tourismpress_textdomain' ),
		'view_item'           => __( 'View Event', 'tourismpress_textdomain' ),
		'search_items'        => __( 'Search Events', 'tourismpress_textdomain' ),
		'not_found'           => __( 'No Events found', 'tourismpress_textdomain' ),
		'not_found_in_trash'  => __( 'No Events found in Trash', 'tourismpress_textdomain' ),
		'parent_item_colon'   => __( 'Parent Event:', 'tourismpress_textdomain' ),
		'menu_name'           => __( 'Events', 'tourismpress_textdomain' ),
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