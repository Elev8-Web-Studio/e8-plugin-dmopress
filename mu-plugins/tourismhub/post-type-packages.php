<?php

//Packages Post Type
function register_packages_post_type() {

	$labels = array(
		'name'                => __( 'Packages', 'text-domain' ),
		'singular_name'       => __( 'Package', 'text-domain' ),
		'add_new'             => _x( 'Add New Package', 'text-domain', 'text-domain' ),
		'add_new_item'        => __( 'Add New Package', 'text-domain' ),
		'edit_item'           => __( 'Edit Package', 'text-domain' ),
		'new_item'            => __( 'New Package', 'text-domain' ),
		'view_item'           => __( 'View Package', 'text-domain' ),
		'search_items'        => __( 'Search Packages', 'text-domain' ),
		'not_found'           => __( 'No Packages found', 'text-domain' ),
		'not_found_in_trash'  => __( 'No Packages found in Trash', 'text-domain' ),
		'parent_item_colon'   => __( 'Parent Package:', 'text-domain' ),
		'menu_name'           => __( 'Packages', 'text-domain' ),
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

add_action( 'init', 'register_packages_post_type' );