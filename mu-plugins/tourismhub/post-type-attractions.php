<?php

// Attractions Post Type
function register_attractions_post_type() {

	$labels = array(
		'name'                => __( 'Attractions', 'tourismhub_textdomain' ),
		'singular_name'       => __( 'Attraction', 'tourismhub_textdomain' ),
		'add_new'             => __( 'Add New Attraction', 'tourismhub_textdomain', 'tourismhub_textdomain' ),
		'add_new_item'        => __( 'Add New Attraction', 'tourismhub_textdomain' ),
		'edit_item'           => __( 'Edit Attraction', 'tourismhub_textdomain' ),
		'new_item'            => __( 'New Attraction', 'tourismhub_textdomain' ),
		'view_item'           => __( 'View Attraction', 'tourismhub_textdomain' ),
		'search_items'        => __( 'Search Attractions', 'tourismhub_textdomain' ),
		'not_found'           => __( 'No Attractions found', 'tourismhub_textdomain' ),
		'not_found_in_trash'  => __( 'No Attractions found in Trash', 'tourismhub_textdomain' ),
		'parent_item_colon'   => __( 'Parent Attraction:', 'tourismhub_textdomain' ),
		'menu_name'           => __( 'Attractions', 'tourismhub_textdomain' ),
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
			'slug' => 'do'
			),
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'thumbnail'),
	);

	register_post_type( 'attractions', $args );
}

add_action( 'init', 'register_attractions_post_type' );



/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_meta_box() {
    add_meta_box(
        'attraction_location_section',
        __('Location', 'tourismhub_textdomain'),
        'attraction_meta_box_callback',
        'attractions',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes_attractions', 'myplugin_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function attraction_meta_box_callback($post) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'myplugin_save_meta_box_data', 'myplugin_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, '_my_meta_value_key', true );

    echo '<label for="attraction_address">';
    _e( 'Address: ', 'tourismhub_textdomain' );
    echo '</label> ';
    echo '<input type="text" id="attraction_address" name="attraction_address" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data($post_id) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_save_meta_box_data' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if (isset( $_POST['post_type'] ) && 'page' == $_POST['post_type']) {
        if (!current_user_can( 'edit_page', $post_id )) {
            return;
        }
    } else {
        if (!current_user_can( 'edit_post', $post_id )) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */
    
    // Make sure that it is set.
    if ( ! isset( $_POST['attraction_address'] ) ) {
        return;
    }

    // Sanitize user input.
    $my_data = sanitize_text_field($_POST['attraction_address']);

    // Update the meta field in the database.
    update_post_meta($post_id, '_my_meta_value_key', $my_data);
}
add_action('save_post', 'myplugin_save_meta_box_data');