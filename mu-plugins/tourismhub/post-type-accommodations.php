<?php

// Accommodations Post Type
function register_accommodations_post_type() {

	$labels = array(
		'name'                => __( 'Accommodations', 'tourismhub_textdomain' ),
		'singular_name'       => __( 'Accommodation', 'tourismhub_textdomain' ),
		'add_new'             => _x( 'Add New Accommodation', 'tourismhub_textdomain', 'tourismhub_textdomain' ),
		'add_new_item'        => __( 'Add New Accommodation', 'tourismhub_textdomain' ),
		'edit_item'           => __( 'Edit Accommodation', 'tourismhub_textdomain' ),
		'new_item'            => __( 'New Accommodation', 'tourismhub_textdomain' ),
		'view_item'           => __( 'View Accommodation', 'tourismhub_textdomain' ),
		'search_items'        => __( 'Search Accommodations', 'tourismhub_textdomain' ),
		'not_found'           => __( 'No Accommodations found', 'tourismhub_textdomain' ),
		'not_found_in_trash'  => __( 'No Accommodations found in Trash', 'tourismhub_textdomain' ),
		'parent_item_colon'   => __( 'Parent Accommodation:', 'tourismhub_textdomain' ),
		'menu_name'           => __( 'Accommodations', 'tourismhub_textdomain' ),
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
		'menu_icon'           => 'dashicons-location',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array(
			'slug' => 'stay'
			),
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'thumbnail'),
	);

	register_post_type( 'accommodations', $args );
}

add_action( 'init', 'register_accommodations_post_type' );