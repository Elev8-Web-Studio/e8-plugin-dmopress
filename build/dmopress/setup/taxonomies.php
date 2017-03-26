<?php
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

// Place Categories
function dmopress_register_place_categories_taxonomy() {

    $labels = array(
        'name'                  => _x( 'Place Categories', 'Place Categories', 'dmopress_textdomain' ),
        'singular_name'         => _x( 'Place Category', 'Place Category', 'dmopress_textdomain' ),
        'search_items'          => __( 'Search Place Categories', 'dmopress_textdomain' ),
        'popular_items'         => __( 'Popular Place Categories', 'dmopress_textdomain' ),
        'all_items'             => __( 'All Categories', 'dmopress_textdomain' ),
        'parent_item'           => __( 'Parent Place Category', 'dmopress_textdomain' ),
        'parent_item_colon'     => __( 'Parent Place Category', 'dmopress_textdomain' ),
        'edit_item'             => __( 'Edit Place Category', 'dmopress_textdomain' ),
        'update_item'           => __( 'Update Place Category', 'dmopress_textdomain' ),
        'add_new_item'          => __( 'Add New Place Category', 'dmopress_textdomain' ),
        'new_item_name'         => __( 'New Place Category Name', 'dmopress_textdomain' ),
        'add_or_remove_items'   => __( 'Add or remove Place Categories', 'dmopress_textdomain' ),
        'choose_from_most_used' => __( 'Choose from most used types', 'dmopress_textdomain' ),
        'menu_name'             => __( 'Place Categories', 'dmopress_textdomain' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => false,
        'hierarchical'      => true,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
    );

    register_taxonomy( 'categories', 'places', $args );
    register_taxonomy( 'categories', 'post', $args );
    register_taxonomy_for_object_type( 'categories', 'post' );
    register_taxonomy_for_object_type( 'categories', 'places' );
}

add_action( 'init', 'dmopress_register_place_categories_taxonomy' );

// Place Features
function dmopress_register_place_features_taxonomy() {

	$labels = array(
		'name'					=> _x( 'Place Features', 'Place Features', 'dmopress_textdomain' ),
		'singular_name'			=> _x( 'Place Feature', 'Place Feature', 'dmopress_textdomain' ),
		'search_items'			=> __( 'Search Place Features', 'dmopress_textdomain' ),
		'popular_items'			=> __( 'Popular Place Features', 'dmopress_textdomain' ),
		'all_items'				=> __( 'All Features', 'dmopress_textdomain' ),
		'parent_item'			=> __( 'Parent Place Feature', 'dmopress_textdomain' ),
		'parent_item_colon'		=> __( 'Parent Place Feature', 'dmopress_textdomain' ),
		'edit_item'				=> __( 'Edit Place Feature', 'dmopress_textdomain' ),
		'update_item'			=> __( 'Update Place Feature', 'dmopress_textdomain' ),
		'add_new_item'			=> __( 'Add New Place Feature', 'dmopress_textdomain' ),
		'new_item_name'			=> __( 'New Place Feature Name', 'dmopress_textdomain' ),
		'add_or_remove_items'	=> __( 'Add or remove Place Features', 'dmopress_textdomain' ),
		'choose_from_most_used'	=> __( 'Choose from most used features', 'dmopress_textdomain' ),
		'menu_name'				=> __( 'Place Features', 'dmopress_textdomain' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => true,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'features', 'places', $args );
    register_taxonomy_for_object_type( 'features', 'places' );
}

add_action( 'init', 'dmopress_register_place_features_taxonomy' );