<?php

// Accommodations Post Type
function register_accommodations_post_type() {

	$labels = array(
		'name'                => __( 'Accommodations', 'text-domain' ),
		'singular_name'       => __( 'Accommodation', 'text-domain' ),
		'add_new'             => _x( 'Add New Accommodation', 'text-domain', 'text-domain' ),
		'add_new_item'        => __( 'Add New Accommodation', 'text-domain' ),
		'edit_item'           => __( 'Edit Accommodation', 'text-domain' ),
		'new_item'            => __( 'New Accommodation', 'text-domain' ),
		'view_item'           => __( 'View Accommodation', 'text-domain' ),
		'search_items'        => __( 'Search Accommodations', 'text-domain' ),
		'not_found'           => __( 'No Accommodations found', 'text-domain' ),
		'not_found_in_trash'  => __( 'No Accommodations found in Trash', 'text-domain' ),
		'parent_item_colon'   => __( 'Parent Accommodation:', 'text-domain' ),
		'menu_name'           => __( 'Accommodations', 'text-domain' ),
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
		'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','revisions', 'page-attributes', 'post-formats')
	);

	register_post_type( 'accommodations', $args );
}

add_action( 'init', 'register_accommodations_post_type' );