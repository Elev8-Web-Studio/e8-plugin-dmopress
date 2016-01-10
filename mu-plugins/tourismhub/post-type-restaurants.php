<?php

// Restaurant Categories
function restaurant_categories() {

	$labels = array(
		'name'					=> _x( 'Restaurant Categories', 'Restaurant categories', 'tourismhub_textdomain' ),
		'singular_name'			=> _x( 'Restaurant Category', 'Restaurant category', 'tourismhub_textdomain' ),
		'search_items'			=> __( 'Search Restaurant Categories', 'tourismhub_textdomain' ),
		'popular_items'			=> __( 'Popular Restaurant Categories', 'tourismhub_textdomain' ),
		'all_items'				=> __( 'All Restaurant Categories', 'tourismhub_textdomain' ),
		'parent_item'			=> __( 'Parent Restaurant Category', 'tourismhub_textdomain' ),
		'parent_item_colon'		=> __( 'Parent Restaurant Category', 'tourismhub_textdomain' ),
		'edit_item'				=> __( 'Edit Restaurant Category', 'tourismhub_textdomain' ),
		'update_item'			=> __( 'Update Restaurant Category', 'tourismhub_textdomain' ),
		'add_new_item'			=> __( 'Add New Restaurant Category', 'tourismhub_textdomain' ),
		'new_item_name'			=> __( 'New Restaurant Category Name', 'tourismhub_textdomain' ),
		'add_or_remove_items'	=> __( 'Add or remove Restaurant Categories', 'tourismhub_textdomain' ),
		'choose_from_most_used'	=> __( 'Choose from most used text-domain', 'tourismhub_textdomain' ),
		'menu_name'				=> __( 'Restaurant Categories', 'tourismhub_textdomain' ),
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
		'name'                => __( 'Restaurants', 'tourismhub_textdomain' ),
		'singular_name'       => __( 'Restaurant', 'tourismhub_textdomain' ),
		'add_new'             => _x( 'Add New Restaurant', 'tourismhub_textdomain', 'tourismhub_textdomain' ),
		'add_new_item'        => __( 'Add New Restaurant', 'tourismhub_textdomain' ),
		'edit_item'           => __( 'Edit Restaurant', 'tourismhub_textdomain' ),
		'new_item'            => __( 'New Restaurant', 'tourismhub_textdomain' ),
		'view_item'           => __( 'View Restaurant', 'tourismhub_textdomain' ),
		'search_items'        => __( 'Search Restaurants', 'tourismhub_textdomain' ),
		'not_found'           => __( 'No Restaurants found', 'tourismhub_textdomain' ),
		'not_found_in_trash'  => __( 'No Restaurants found in Trash', 'tourismhub_textdomain' ),
		'parent_item_colon'   => __( 'Parent Restaurant:', 'tourismhub_textdomain' ),
		'menu_name'           => __( 'Restaurants', 'tourismhub_textdomain' ),
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