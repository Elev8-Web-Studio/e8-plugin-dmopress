<?php

// Restaurant Categories
function restaurant_categories() {

	$labels = array(
		'name'					=> _x( 'Restaurant Categories', 'Restaurant categories', 'text-domain' ),
		'singular_name'			=> _x( 'Restaurant Category', 'Restaurant category', 'text-domain' ),
		'search_items'			=> __( 'Search Restaurant Categories', 'text-domain' ),
		'popular_items'			=> __( 'Popular Restaurant Categories', 'text-domain' ),
		'all_items'				=> __( 'All Restaurant Categories', 'text-domain' ),
		'parent_item'			=> __( 'Parent Restaurant Category', 'text-domain' ),
		'parent_item_colon'		=> __( 'Parent Restaurant Category', 'text-domain' ),
		'edit_item'				=> __( 'Edit Restaurant Category', 'text-domain' ),
		'update_item'			=> __( 'Update Restaurant Category', 'text-domain' ),
		'add_new_item'			=> __( 'Add New Restaurant Category', 'text-domain' ),
		'new_item_name'			=> __( 'New Restaurant Category Name', 'text-domain' ),
		'add_or_remove_items'	=> __( 'Add or remove Restaurant Categories', 'text-domain' ),
		'choose_from_most_used'	=> __( 'Choose from most used text-domain', 'text-domain' ),
		'menu_name'				=> __( 'Restaurant Categories', 'text-domain' ),
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
		'name'                => __( 'Restaurants', 'text-domain' ),
		'singular_name'       => __( 'Restaurant', 'text-domain' ),
		'add_new'             => _x( 'Add New Restaurant', 'text-domain', 'text-domain' ),
		'add_new_item'        => __( 'Add New Restaurant', 'text-domain' ),
		'edit_item'           => __( 'Edit Restaurant', 'text-domain' ),
		'new_item'            => __( 'New Restaurant', 'text-domain' ),
		'view_item'           => __( 'View Restaurant', 'text-domain' ),
		'search_items'        => __( 'Search Restaurants', 'text-domain' ),
		'not_found'           => __( 'No Restaurants found', 'text-domain' ),
		'not_found_in_trash'  => __( 'No Restaurants found in Trash', 'text-domain' ),
		'parent_item_colon'   => __( 'Parent Restaurant:', 'text-domain' ),
		'menu_name'           => __( 'Restaurants', 'text-domain' ),
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
		'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes', 'post-formats')
	);

	register_post_type( 'restaurants', $args );
}

add_action( 'init', 'register_restaurants_post_type' );