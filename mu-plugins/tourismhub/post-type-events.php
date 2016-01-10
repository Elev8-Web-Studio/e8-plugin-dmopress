<?php

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