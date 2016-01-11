<?php

/* Change the default post type to News */
function change_default_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Blog';
    $submenu['edit.php'][5][0] = 'Blog Posts';
    $submenu['edit.php'][10][0] = 'Add New Blog Post';
    $submenu['edit.php'][16][0] = 'Tags';
    echo '';
}
function change_default_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Blog Posts';
    $labels->singular_name = 'Blog Post';
    $labels->add_new = 'Add New Blog Post';
    $labels->add_new_item = 'Add New Blog Post';
    $labels->edit_item = 'Edit Blog Post';
    $labels->new_item = 'Blog Post';
    $labels->view_item = 'View Blog Post';
    $labels->search_items = 'Search Blog Posts';
    $labels->not_found = 'No Blog Posts found';
    $labels->not_found_in_trash = 'No Blog Posts found in Trash';
    $labels->all_items = 'All Blog Posts';
    $labels->menu_name = 'Blog';
    $labels->name_admin_bar = 'Blog Post';

    //$menuicon = &$wp_post_types['post']->menu_icon;
    //$menuicon = 'dashicons-location';
}
 
add_action( 'admin_menu', 'change_default_post_label' );
add_action( 'init', 'change_default_post_object' );

