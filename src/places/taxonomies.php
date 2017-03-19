<?php
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

// Place Categories
function tourismpress_register_place_categories_taxonomy() {

    $labels = array(
        'name'                  => _x( 'Place Categories', 'Place Categories', 'tourismpress_textdomain' ),
        'singular_name'         => _x( 'Place Category', 'Place Category', 'tourismpress_textdomain' ),
        'search_items'          => __( 'Search Place Categories', 'tourismpress_textdomain' ),
        'popular_items'         => __( 'Popular Place Categories', 'tourismpress_textdomain' ),
        'all_items'             => __( 'All Categories', 'tourismpress_textdomain' ),
        'parent_item'           => __( 'Parent Place Category', 'tourismpress_textdomain' ),
        'parent_item_colon'     => __( 'Parent Place Category', 'tourismpress_textdomain' ),
        'edit_item'             => __( 'Edit Place Category', 'tourismpress_textdomain' ),
        'update_item'           => __( 'Update Place Category', 'tourismpress_textdomain' ),
        'add_new_item'          => __( 'Add New Place Category', 'tourismpress_textdomain' ),
        'new_item_name'         => __( 'New Place Category Name', 'tourismpress_textdomain' ),
        'add_or_remove_items'   => __( 'Add or remove Place Categories', 'tourismpress_textdomain' ),
        'choose_from_most_used' => __( 'Choose from most used types', 'tourismpress_textdomain' ),
        'menu_name'             => __( 'Place Categories', 'tourismpress_textdomain' ),
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

add_action( 'init', 'tourismpress_register_place_categories_taxonomy' );

// Place Features
function tourismpress_register_place_features_taxonomy() {

	$labels = array(
		'name'					=> _x( 'Place Features', 'Place Features', 'tourismpress_textdomain' ),
		'singular_name'			=> _x( 'Place Feature', 'Place Feature', 'tourismpress_textdomain' ),
		'search_items'			=> __( 'Search Place Features', 'tourismpress_textdomain' ),
		'popular_items'			=> __( 'Popular Place Features', 'tourismpress_textdomain' ),
		'all_items'				=> __( 'All Features', 'tourismpress_textdomain' ),
		'parent_item'			=> __( 'Parent Place Feature', 'tourismpress_textdomain' ),
		'parent_item_colon'		=> __( 'Parent Place Feature', 'tourismpress_textdomain' ),
		'edit_item'				=> __( 'Edit Place Feature', 'tourismpress_textdomain' ),
		'update_item'			=> __( 'Update Place Feature', 'tourismpress_textdomain' ),
		'add_new_item'			=> __( 'Add New Place Feature', 'tourismpress_textdomain' ),
		'new_item_name'			=> __( 'New Place Feature Name', 'tourismpress_textdomain' ),
		'add_or_remove_items'	=> __( 'Add or remove Place Features', 'tourismpress_textdomain' ),
		'choose_from_most_used'	=> __( 'Choose from most used features', 'tourismpress_textdomain' ),
		'menu_name'				=> __( 'Place Features', 'tourismpress_textdomain' ),
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

add_action( 'init', 'tourismpress_register_place_features_taxonomy' );