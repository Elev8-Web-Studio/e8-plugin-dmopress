<?php

// Restaurant Categories
function restaurant_categories() {

	$labels = array(
		'name'					=> _x( 'Restaurant Categories', 'Restaurant categories', 'tourismpress_textdomain' ),
		'singular_name'			=> _x( 'Restaurant Category', 'Restaurant category', 'tourismpress_textdomain' ),
		'search_items'			=> __( 'Search Restaurant Categories', 'tourismpress_textdomain' ),
		'popular_items'			=> __( 'Popular Restaurant Categories', 'tourismpress_textdomain' ),
		'all_items'				=> __( 'All Restaurant Categories', 'tourismpress_textdomain' ),
		'parent_item'			=> __( 'Parent Restaurant Category', 'tourismpress_textdomain' ),
		'parent_item_colon'		=> __( 'Parent Restaurant Category', 'tourismpress_textdomain' ),
		'edit_item'				=> __( 'Edit Restaurant Category', 'tourismpress_textdomain' ),
		'update_item'			=> __( 'Update Restaurant Category', 'tourismpress_textdomain' ),
		'add_new_item'			=> __( 'Add New Restaurant Category', 'tourismpress_textdomain' ),
		'new_item_name'			=> __( 'New Restaurant Category Name', 'tourismpress_textdomain' ),
		'add_or_remove_items'	=> __( 'Add or remove Restaurant Categories', 'tourismpress_textdomain' ),
		'choose_from_most_used'	=> __( 'Choose from most used categories', 'tourismpress_textdomain' ),
		'menu_name'				=> __( 'Restaurant Categories', 'tourismpress_textdomain' ),
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

	register_taxonomy( 'restaurant-category', array( 'restaurant' ), $args );
}

add_action( 'init', 'restaurant_categories' );

// Restaurants Post Type
function register_restaurants_post_type() {

	$labels = array(
		'name'                => __( 'Restaurants', 'tourismpress_textdomain' ),
		'singular_name'       => __( 'Restaurant', 'tourismpress_textdomain' ),
		'add_new'             => _x( 'Add New Restaurant', 'tourismpress_textdomain', 'tourismpress_textdomain' ),
		'add_new_item'        => __( 'Add New Restaurant', 'tourismpress_textdomain' ),
		'edit_item'           => __( 'Edit Restaurant', 'tourismpress_textdomain' ),
		'new_item'            => __( 'New Restaurant', 'tourismpress_textdomain' ),
		'view_item'           => __( 'View Restaurant', 'tourismpress_textdomain' ),
		'search_items'        => __( 'Search Restaurants', 'tourismpress_textdomain' ),
		'not_found'           => __( 'No Restaurants found', 'tourismpress_textdomain' ),
		'not_found_in_trash'  => __( 'No Restaurants found in Trash', 'tourismpress_textdomain' ),
		'parent_item_colon'   => __( 'Parent Restaurant:', 'tourismpress_textdomain' ),
		'menu_name'           => __( 'Restaurants', 'tourismpress_textdomain' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array('restaurant-category','post_tag'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-location',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array(
			'slug' => 'eat'
			),
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'thumbnail'),
	);

	register_post_type( 'restaurants', $args );
}

add_action( 'init', 'register_restaurants_post_type' );