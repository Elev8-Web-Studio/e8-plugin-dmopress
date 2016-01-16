<?php

// Accommodations Categories
function tourismpress_register_accommodations_categories() {

	$labels = array(
		'name'					=> _x( 'Accommodations Categories', 'Accommodations Categories', 'tourismpress_textdomain' ),
		'singular_name'			=> _x( 'Accommodations Category', 'Accommodations Category', 'tourismpress_textdomain' ),
		'search_items'			=> __( 'Search Accommodations Categories', 'tourismpress_textdomain' ),
		'popular_items'			=> __( 'Popular Accommodations Categories', 'tourismpress_textdomain' ),
		'all_items'				=> __( 'All Accommodations Categories', 'tourismpress_textdomain' ),
		'parent_item'			=> __( 'Parent Accommodations Category', 'tourismpress_textdomain' ),
		'parent_item_colon'		=> __( 'Parent Accommodations Category', 'tourismpress_textdomain' ),
		'edit_item'				=> __( 'Edit Accommodations Category', 'tourismpress_textdomain' ),
		'update_item'			=> __( 'Update Accommodations Category', 'tourismpress_textdomain' ),
		'add_new_item'			=> __( 'Add New Accommodations Category', 'tourismpress_textdomain' ),
		'new_item_name'			=> __( 'New Accommodations Category Name', 'tourismpress_textdomain' ),
		'add_or_remove_items'	=> __( 'Add or remove Accommodations Categories', 'tourismpress_textdomain' ),
		'choose_from_most_used'	=> __( 'Choose from most used categories', 'tourismpress_textdomain' ),
		'menu_name'				=> __( 'Accommodations Categories', 'tourismpress_textdomain' ),
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

	register_taxonomy( 'accommodations-category', array( 'accommodations' ), $args );
}

add_action( 'init', 'tourismpress_register_accommodations_categories' );

// Accommodations Post Type
function register_accommodations_post_type() {

	$labels = array(
		'name'                => __( 'Accommodations', 'tourismpress_textdomain' ),
		'singular_name'       => __( 'Accommodations', 'tourismpress_textdomain' ),
		'add_new'             => _x( 'Add New Accommodation', 'tourismpress_textdomain', 'tourismpress_textdomain' ),
		'add_new_item'        => __( 'Add New Accommodation', 'tourismpress_textdomain' ),
		'edit_item'           => __( 'Edit Accommodations', 'tourismpress_textdomain' ),
		'new_item'            => __( 'New Accommodations', 'tourismpress_textdomain' ),
		'view_item'           => __( 'View Accommodations', 'tourismpress_textdomain' ),
		'search_items'        => __( 'Search Accommodations', 'tourismpress_textdomain' ),
		'not_found'           => __( 'No Accommodations found', 'tourismpress_textdomain' ),
		'not_found_in_trash'  => __( 'No Accommodations found in Trash', 'tourismpress_textdomain' ),
		'parent_item_colon'   => __( 'Parent Accommodations:', 'tourismpress_textdomain' ),
		'menu_name'           => __( 'Accommodations', 'tourismpress_textdomain' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array('accommodations-category','post_tag'),
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