<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

// Place Categories
function dmopress_register_accepted_payment_types() {
	
	$labels = array(
		'name'                  => _x( 'Payment Types', 'Payment Types', 'dmopress_textdomain' ),
		'singular_name'         => _x( 'Payment Type', 'Payment Type', 'dmopress_textdomain' ),
		'search_items'          => __( 'Search Payment Types', 'dmopress_textdomain' ),
		'popular_items'         => __( 'Popular Payment Types', 'dmopress_textdomain' ),
		'all_items'             => __( 'All Categories', 'dmopress_textdomain' ),
		'parent_item'           => __( 'Parent Payment Type', 'dmopress_textdomain' ),
		'parent_item_colon'     => __( 'Parent Payment Type', 'dmopress_textdomain' ),
		'edit_item'             => __( 'Edit Payment Type', 'dmopress_textdomain' ),
		'update_item'           => __( 'Update Payment Type', 'dmopress_textdomain' ),
		'add_new_item'          => __( 'Add New Payment Type', 'dmopress_textdomain' ),
		'new_item_name'         => __( 'New Payment Type Name', 'dmopress_textdomain' ),
		'add_or_remove_items'   => __( 'Add or remove Payment Types', 'dmopress_textdomain' ),
		'choose_from_most_used' => __( 'Choose from most used types', 'dmopress_textdomain' ),
		'menu_name'             => __( 'Payment Types', 'dmopress_textdomain' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'show_tagcloud'     => false,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'payment-types', 'places', $args );
	register_taxonomy_for_object_type( 'payment-types', 'places' );

}

add_action( 'init', 'dmopress_register_accepted_payment_types' );