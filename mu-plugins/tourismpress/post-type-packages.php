<?php

// Package Categories
function tourismpress_register_package_categories() {

	$labels = array(
		'name'					=> _x( 'Package Categories', 'Package Categories', 'tourismpress_textdomain' ),
		'singular_name'			=> _x( 'Package Category', 'Package Category', 'tourismpress_textdomain' ),
		'search_items'			=> __( 'Search Package Categories', 'tourismpress_textdomain' ),
		'popular_items'			=> __( 'Popular Package Categories', 'tourismpress_textdomain' ),
		'all_items'				=> __( 'All Package Categories', 'tourismpress_textdomain' ),
		'parent_item'			=> __( 'Parent Package Category', 'tourismpress_textdomain' ),
		'parent_item_colon'		=> __( 'Parent Package Category', 'tourismpress_textdomain' ),
		'edit_item'				=> __( 'Edit Package Category', 'tourismpress_textdomain' ),
		'update_item'			=> __( 'Update Package Category', 'tourismpress_textdomain' ),
		'add_new_item'			=> __( 'Add New Package Category', 'tourismpress_textdomain' ),
		'new_item_name'			=> __( 'New Package Category Name', 'tourismpress_textdomain' ),
		'add_or_remove_items'	=> __( 'Add or remove Package Categories', 'tourismpress_textdomain' ),
		'choose_from_most_used'	=> __( 'Choose from most used categories', 'tourismpress_textdomain' ),
		'menu_name'				=> __( 'Package Categories', 'tourismpress_textdomain' ),
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

	register_taxonomy( 'package-category', array( 'package' ), $args );
}

add_action( 'init', 'tourismpress_register_package_categories' );

//Packages Post Type
function tourismpress_register_packages_post_type() {

	$labels = array(
		'name'                => __( 'Packages', 'tourismpress_textdomain' ),
		'singular_name'       => __( 'Package', 'tourismpress_textdomain' ),
		'add_new'             => _x( 'Add New Package', 'tourismpress_textdomain', 'tourismpress_textdomain' ),
		'add_new_item'        => __( 'Add New Package', 'tourismpress_textdomain' ),
		'edit_item'           => __( 'Edit Package', 'tourismpress_textdomain' ),
		'new_item'            => __( 'New Package', 'tourismpress_textdomain' ),
		'view_item'           => __( 'View Package', 'tourismpress_textdomain' ),
		'search_items'        => __( 'Search Packages', 'tourismpress_textdomain' ),
		'not_found'           => __( 'No Packages found', 'tourismpress_textdomain' ),
		'not_found_in_trash'  => __( 'No Packages found in Trash', 'tourismpress_textdomain' ),
		'parent_item_colon'   => __( 'Parent Package:', 'tourismpress_textdomain' ),
		'menu_name'           => __( 'Packages', 'tourismpress_textdomain' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array('package-category','post_tag'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-star-filled',
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

	register_post_type( 'packages', $args );
}

add_action( 'init', 'tourismpress_register_packages_post_type' );
