<?php

// News Categories
function tourismpress_register_news_categories() {

    $labels = array(
        'name'                  => _x( 'News Categories', 'News Categories', 'tourismpress_textdomain' ),
        'singular_name'         => _x( 'News Category', 'News category', 'tourismpress_textdomain' ),
        'search_items'          => __( 'Search News Categories', 'tourismpress_textdomain' ),
        'popular_items'         => __( 'Popular News Categories', 'tourismpress_textdomain' ),
        'all_items'             => __( 'All News Categories', 'tourismpress_textdomain' ),
        'parent_item'           => __( 'Parent News Category', 'tourismpress_textdomain' ),
        'parent_item_colon'     => __( 'Parent News Category', 'tourismpress_textdomain' ),
        'edit_item'             => __( 'Edit News Category', 'tourismpress_textdomain' ),
        'update_item'           => __( 'Update News Category', 'tourismpress_textdomain' ),
        'add_new_item'          => __( 'Add New News Category', 'tourismpress_textdomain' ),
        'new_item_name'         => __( 'New News Category Name', 'tourismpress_textdomain' ),
        'add_or_remove_items'   => __( 'Add or remove News Categories', 'tourismpress_textdomain' ),
        'choose_from_most_used' => __( 'Choose from most used categories', 'tourismpress_textdomain' ),
        'menu_name'             => __( 'News Categories', 'tourismpress_textdomain' ),
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

    register_taxonomy( 'news-category', array( 'news' ), $args );
}

add_action( 'init', 'tourismpress_register_news_categories' );

// Newss Post Type
function tourismpress_register_news_post_type() {

    $labels = array(
        'name'                => __( 'News', 'tourismpress_textdomain' ),
        'singular_name'       => __( 'News', 'tourismpress_textdomain' ),
        'add_new'             => _x( 'Add New News', 'tourismpress_textdomain', 'tourismpress_textdomain' ),
        'add_new_item'        => __( 'Add New News', 'tourismpress_textdomain' ),
        'edit_item'           => __( 'Edit News', 'tourismpress_textdomain' ),
        'new_item'            => __( 'New News', 'tourismpress_textdomain' ),
        'view_item'           => __( 'View News', 'tourismpress_textdomain' ),
        'search_items'        => __( 'Search News', 'tourismpress_textdomain' ),
        'not_found'           => __( 'No News found', 'tourismpress_textdomain' ),
        'not_found_in_trash'  => __( 'No News found in Trash', 'tourismpress_textdomain' ),
        'parent_item_colon'   => __( 'Parent News:', 'tourismpress_textdomain' ),
        'menu_name'           => __( 'News', 'tourismpress_textdomain' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array('news-category','post_tag'),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-megaphone',
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
        'supports'            => array('title', 'editor', 'thumbnail'),
    );

    register_post_type( 'news', $args );
}

add_action( 'init', 'tourismpress_register_news_post_type' );

