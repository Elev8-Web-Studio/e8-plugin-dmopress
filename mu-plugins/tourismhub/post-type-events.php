<?php

// Events Post Type
function register_events_post_type() {

	$labels = array(
		'name'                => __( 'Events', 'text-domain' ),
		'singular_name'       => __( 'Event', 'text-domain' ),
		'add_new'             => _x( 'Add New Event', 'text-domain', 'text-domain' ),
		'add_new_item'        => __( 'Add New Event', 'text-domain' ),
		'edit_item'           => __( 'Edit Event', 'text-domain' ),
		'new_item'            => __( 'New Event', 'text-domain' ),
		'view_item'           => __( 'View Event', 'text-domain' ),
		'search_items'        => __( 'Search Events', 'text-domain' ),
		'not_found'           => __( 'No Events found', 'text-domain' ),
		'not_found_in_trash'  => __( 'No Events found in Trash', 'text-domain' ),
		'parent_item_colon'   => __( 'Parent Event:', 'text-domain' ),
		'menu_name'           => __( 'Events', 'text-domain' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array('category','post_tag'),
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