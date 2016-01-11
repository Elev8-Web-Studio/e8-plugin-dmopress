<?php

// Package Categories
function tourismhub_register_package_categories() {

	$labels = array(
		'name'					=> _x( 'Package Categories', 'Package Categories', 'tourismhub_textdomain' ),
		'singular_name'			=> _x( 'Package Category', 'Package Category', 'tourismhub_textdomain' ),
		'search_items'			=> __( 'Search Package Categories', 'tourismhub_textdomain' ),
		'popular_items'			=> __( 'Popular Package Categories', 'tourismhub_textdomain' ),
		'all_items'				=> __( 'All Package Categories', 'tourismhub_textdomain' ),
		'parent_item'			=> __( 'Parent Package Category', 'tourismhub_textdomain' ),
		'parent_item_colon'		=> __( 'Parent Package Category', 'tourismhub_textdomain' ),
		'edit_item'				=> __( 'Edit Package Category', 'tourismhub_textdomain' ),
		'update_item'			=> __( 'Update Package Category', 'tourismhub_textdomain' ),
		'add_new_item'			=> __( 'Add New Package Category', 'tourismhub_textdomain' ),
		'new_item_name'			=> __( 'New Package Category Name', 'tourismhub_textdomain' ),
		'add_or_remove_items'	=> __( 'Add or remove Package Categories', 'tourismhub_textdomain' ),
		'choose_from_most_used'	=> __( 'Choose from most used categories', 'tourismhub_textdomain' ),
		'menu_name'				=> __( 'Package Categories', 'tourismhub_textdomain' ),
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

add_action( 'init', 'tourismhub_register_package_categories' );

//Packages Post Type
function tourismhub_register_packages_post_type() {

	$labels = array(
		'name'                => __( 'Packages', 'tourismhub_textdomain' ),
		'singular_name'       => __( 'Package', 'tourismhub_textdomain' ),
		'add_new'             => _x( 'Add New Package', 'tourismhub_textdomain', 'tourismhub_textdomain' ),
		'add_new_item'        => __( 'Add New Package', 'tourismhub_textdomain' ),
		'edit_item'           => __( 'Edit Package', 'tourismhub_textdomain' ),
		'new_item'            => __( 'New Package', 'tourismhub_textdomain' ),
		'view_item'           => __( 'View Package', 'tourismhub_textdomain' ),
		'search_items'        => __( 'Search Packages', 'tourismhub_textdomain' ),
		'not_found'           => __( 'No Packages found', 'tourismhub_textdomain' ),
		'not_found_in_trash'  => __( 'No Packages found in Trash', 'tourismhub_textdomain' ),
		'parent_item_colon'   => __( 'Parent Package:', 'tourismhub_textdomain' ),
		'menu_name'           => __( 'Packages', 'tourismhub_textdomain' ),
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

add_action( 'init', 'tourismhub_register_packages_post_type' );
