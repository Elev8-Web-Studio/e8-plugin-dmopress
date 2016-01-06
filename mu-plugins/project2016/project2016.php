<?php
/**
 * @package Project2016
 * @version 0.1
 */
/*
Plugin Name: Project 2016
Plugin URI: http://jasonpomerleau.com
Description: This plugin powers the Project2016 platform. Do not deactivate or remove it.
Author: Jason Pomerleau
Version: 0.1
Author URI: http://jasonpomerleau.com
*/

defined('ABSPATH') or die('Script access not permitted.');

/* Change the default post type to News */
function change_default_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News';
    $submenu['edit.php'][16][0] = 'Tags';
    echo '';
}
function change_default_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add News';
    $labels->add_new_item = 'Add News';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
    $labels->all_items = 'All News';
    $labels->menu_name = 'News';
    $labels->name_admin_bar = 'News';

    //$menuicon = &$wp_post_types['post']->menu_icon;
    //$menuicon = 'dashicons-location';
}
 
add_action( 'admin_menu', 'change_default_post_label' );
add_action( 'init', 'change_default_post_object' );


/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function register_events_post_type() {

	$labels = array(
		'name'                => __( 'Events', 'text-domain' ),
		'singular_name'       => __( 'Event', 'text-domain' ),
		'add_new'             => _x( 'Add New Event', 'text-domain', 'text-domain' ),
		'add_new_item'        => __( 'Add New Event', 'text-domain' ),
		'edit_item'           => __( 'Edit Event', 'text-domain' ),
		'new_item'            => __( 'New Event', 'text-domain' ),
		'view_item'           => __( 'View Event', 'text-domain' ),
		'search_items'        => __( 'Search Events', 'text-domain' ),
		'not_found'           => __( 'No Events found', 'text-domain' ),
		'not_found_in_trash'  => __( 'No Events found in Trash', 'text-domain' ),
		'parent_item_colon'   => __( 'Parent Event:', 'text-domain' ),
		'menu_name'           => __( 'Events', 'text-domain' ),
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
		'menu_icon'           => 'dashicons-calendar-alt',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes', 'post-formats')
	);

	register_post_type( 'events', $args );
}

add_action( 'init', 'register_events_post_type' );

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function register_attractions_post_type() {

	$labels = array(
		'name'                => __( 'Attractions', 'text-domain' ),
		'singular_name'       => __( 'Attraction', 'text-domain' ),
		'add_new'             => _x( 'Add New Attraction', 'text-domain', 'text-domain' ),
		'add_new_item'        => __( 'Add New Attraction', 'text-domain' ),
		'edit_item'           => __( 'Edit Attraction', 'text-domain' ),
		'new_item'            => __( 'New Attraction', 'text-domain' ),
		'view_item'           => __( 'View Attraction', 'text-domain' ),
		'search_items'        => __( 'Search Attractions', 'text-domain' ),
		'not_found'           => __( 'No Attractions found', 'text-domain' ),
		'not_found_in_trash'  => __( 'No Attractions found in Trash', 'text-domain' ),
		'parent_item_colon'   => __( 'Parent Attraction:', 'text-domain' ),
		'menu_name'           => __( 'Attractions', 'text-domain' ),
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
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes', 'post-formats')
	);

	register_post_type( 'attractions', $args );
}

add_action( 'init', 'register_attractions_post_type' );

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
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
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','revisions', 'page-attributes', 'post-formats')
	);

	register_post_type( 'accommodations', $args );
}

add_action( 'init', 'register_accommodations_post_type' );

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
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
		'taxonomies'          => array('category','post_tag'),
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
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes', 'post-formats')
	);

	register_post_type( 'restaurants', $args );
}

add_action( 'init', 'register_restaurants_post_type' );

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
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
		'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes', 'post-formats')
	);

	register_post_type( 'packages', $args );
}

add_action( 'init', 'register_packages_post_type' );

//Customize Admin Menu
function customize_admin_menu() {
	// Remove Media link
	remove_menu_page('upload.php');

	// Remove Updates link
	global $submenu;  
	unset($submenu['index.php'][10]);
	return $submenu;
}
add_action('admin_menu', 'customize_admin_menu');

// Flush rewrite rules after switching theme.
function my_rewrite_flush() {
    my_cpt_init();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );

// Dashboard Widget: Latest News
function custom_dashboard_widget() {
	echo "<p>Contents</p>";
}
function add_custom_dashboard_widget() {
	wp_add_dashboard_widget('custom_dashboard_widget', 'Project 2016 News', 'custom_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');

?>