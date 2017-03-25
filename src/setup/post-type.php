<?php
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

// Places Post Type
function dmopress_register_places_post_type() {

	$labels = array(
		'name'                => __( 'Places', 'dmopress_textdomain' ),
		'singular_name'       => __( 'Place', 'dmopress_textdomain' ),
		'singular_name_lowercase' => __( 'place', 'dmopress_textdomain' ),
		'add_new'             => _x( 'Add New Place', 'dmopress_textdomain', 'dmopress_textdomain' ),
		'add_new_item'        => __( 'Add New Place', 'dmopress_textdomain' ),
		'edit_item'           => __( 'Edit Place', 'dmopress_textdomain' ),
		'new_item'            => __( 'New Place', 'dmopress_textdomain' ),
		'view_item'           => __( 'View Place', 'dmopress_textdomain' ),
		'search_items'        => __( 'Search Places', 'dmopress_textdomain' ),
		'not_found'           => __( 'No places found.', 'dmopress_textdomain' ),
		'not_found_in_trash'  => __( 'No places found in Trash.', 'dmopress_textdomain' ),
		'parent_item_colon'   => __( 'Parent Place:', 'dmopress_textdomain' ),
		'menu_name'           => __( 'Places', 'dmopress_textdomain' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array('features','types','post_tag'),
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
			'slug' => 'places'
			),
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'thumbnail'),
	);

	register_post_type( 'places', $args );
}

add_action( 'init', 'dmopress_register_places_post_type' );