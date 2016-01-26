<?php

// Accommodations Features
function tourismpress_register_accommodations_features() {

    $labels = array(
        'name'                  => _x( 'Accommodations Features', 'Accommodations Features', 'tourismpress_textdomain' ),
        'singular_name'         => _x( 'Accommodations Feature', 'Accommodations Feature', 'tourismpress_textdomain' ),
        'search_items'          => __( 'Search Accommodations Features', 'tourismpress_textdomain' ),
        'popular_items'         => __( 'Popular Accommodations Features', 'tourismpress_textdomain' ),
        'all_items'             => __( 'All Features', 'tourismpress_textdomain' ),
        'parent_item'           => __( 'Parent Accommodations Feature', 'tourismpress_textdomain' ),
        'parent_item_colon'     => __( 'Parent Accommodations Feature', 'tourismpress_textdomain' ),
        'edit_item'             => __( 'Edit Accommodations Feature', 'tourismpress_textdomain' ),
        'update_item'           => __( 'Update Accommodations Feature', 'tourismpress_textdomain' ),
        'add_new_item'          => __( 'Add New Accommodations Feature', 'tourismpress_textdomain' ),
        'new_item_name'         => __( 'New Accommodations Feature Name', 'tourismpress_textdomain' ),
        'add_or_remove_items'   => __( 'Add or remove Accommodations Features', 'tourismpress_textdomain' ),
        'choose_from_most_used' => __( 'Choose from most used features', 'tourismpress_textdomain' ),
        'menu_name'             => __( 'Accommodations Features', 'tourismpress_textdomain' ),
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

    register_taxonomy( 'accommodations-features', 'accommodations', $args );
    register_taxonomy_for_object_type( 'accommodations-features', 'accommodations' );
}

add_action( 'init', 'tourismpress_register_accommodations_features' );


// Accommodations Categories
function tourismpress_register_accommodations_categories() {

	$labels = array(
		'name'					=> _x( 'Accommodations Categories', 'Accommodations Categories', 'tourismpress_textdomain' ),
		'singular_name'			=> _x( 'Accommodations Category', 'Accommodations Category', 'tourismpress_textdomain' ),
		'search_items'			=> __( 'Search Accommodations Categories', 'tourismpress_textdomain' ),
		'popular_items'			=> __( 'Popular Accommodations Categories', 'tourismpress_textdomain' ),
		'all_items'				=> __( 'All Categories', 'tourismpress_textdomain' ),
		'parent_item'			=> __( 'Parent Accommodations Category', 'tourismpress_textdomain' ),
		'parent_item_colon'		=> __( 'Parent Accommodations Category', 'tourismpress_textdomain' ),
		'edit_item'				=> __( 'Edit Accommodations Category', 'tourismpress_textdomain' ),
		'update_item'			=> __( 'Update Accommodations Category', 'tourismpress_textdomain' ),
		'add_new_item'			=> __( 'Add New Accommodations Category', 'tourismpress_textdomain' ),
		'new_item_name'			=> __( 'New Accommodations Category Name', 'tourismpress_textdomain' ),
		'add_or_remove_items'	=> __( 'Add or remove Accommodations Categories', 'tourismpress_textdomain' ),
		'choose_from_most_used'	=> __( 'Choose from most used categories', 'tourismpress_textdomain' ),
		'menu_name'				=> __( 'Accommodations Categories', 'tourismpress_textdomain' ),
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

	register_taxonomy( 'accommodations-categories', 'accommodations', $args );
    register_taxonomy_for_object_type( 'accommodations-categories', 'accommodations' );
}

add_action( 'init', 'tourismpress_register_accommodations_categories' );



// Accommodations Post Type
function register_accommodations_post_type() {

	$labels = array(
		'name'                => __( 'Accommodations', 'tourismpress_textdomain' ),
		'singular_name'       => __( 'Accommodation', 'tourismpress_textdomain' ),
		'add_new'             => _x( 'Add New Accommodation', 'tourismpress_textdomain', 'tourismpress_textdomain' ),
		'add_new_item'        => __( 'Add New Accommodation', 'tourismpress_textdomain' ),
		'edit_item'           => __( 'Edit Accommodation', 'tourismpress_textdomain' ),
		'new_item'            => __( 'New Accommodation', 'tourismpress_textdomain' ),
		'view_item'           => __( 'View Accommodation', 'tourismpress_textdomain' ),
		'search_items'        => __( 'Search Accommodations', 'tourismpress_textdomain' ),
		'not_found'           => __( 'No Accommodations found', 'tourismpress_textdomain' ),
		'not_found_in_trash'  => __( 'No Accommodations found in Trash', 'tourismpress_textdomain' ),
		'parent_item_colon'   => __( 'Parent Accommodations:', 'tourismpress_textdomain' ),
		'menu_name'           => __( 'Accommodations', 'tourismpress_textdomain' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array('accommodations-category','post_tag'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-building',
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
		'supports'            => array('title', 'editor', 'thumbnail'),
	);

	register_post_type( 'accommodations', $args );
}

add_action( 'init', 'register_accommodations_post_type' );

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function tourismpress_accommodation_add_meta_box() {
    add_meta_box(
        'accommodation_details_section',
        __('Accommodation Details', 'tourismpress_textdomain'),
        'tourismpress_accommodation_meta_box_callback',
        'accommodations',
        'location',
        'high'
    );
}
add_action( 'add_meta_boxes', 'tourismpress_accommodation_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function tourismpress_accommodation_meta_box_callback($post) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'tourismpress_accommodation_save_meta_box_data', 'tourismpress_accommodation_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    

   ?>

   <div class="row">
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
           <?php

           $address_var = get_post_meta( $post->ID, 'address', true );

            echo '<p><label for="address">';
            _e( 'Address: ', 'tourismpress_textdomain' );
            echo '</label><br />';
            echo '<input type="text" style="width: 100%" id="address" name="address" value="' . esc_attr( $address_var ) . '" size="25" /></p>';

            ?>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <?php
                    $city_var = get_post_meta( $post->ID, 'city', true );

                    echo '<p><label for="city">';
                    _e( 'City:', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input type="text" style="width: 100%" id="city" name="city" value="' . esc_attr( $city_var ) . '" size="25" /></p>';
                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <?php

                    $stateprov_var = get_post_meta( $post->ID, 'stateprov', true );

                    echo '<p><label for="stateprov">';
                    _e( 'Province / State:', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input type="text" style="width: 100%" id="stateprov" name="stateprov" value="' . esc_attr( $stateprov_var ) . '" size="25" /></p>';

                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <?php

                    $zip_var = get_post_meta( $post->ID, 'zip', true );

                    echo '<p><label for="zip">';
                    _e( 'Postal Code / ZIP:', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input type="text" style="width: 100%" id="zip" name="zip" value="' . esc_attr( $zip_var ) . '" size="25" /></p>';

                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <?php

                    $telephone_var = get_post_meta( $post->ID, 'telephone', true );

                    echo '<p><label for="telephone">';
                    _e( 'Telephone:', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input type="text" style="width: 100%" id="telephone" name="telephone" value="' . esc_attr( $telephone_var ) . '" size="25" /></p>';

                    ?>
                </div>
            </div>
            
       </div>
       
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">

           <?php

           $website_url_var = get_post_meta( $post->ID, 'website_url', true );

           echo '<p><label for="website_url">';
           _e( 'Website URL:', 'tourismpress_textdomain' );
           echo '</label><br /> ';
           echo '<input class="validate_url" type="text" placeholder="http://" style="width: 100%" id="website_url" name="website_url" value="' . esc_attr( $website_url_var ) . '" size="25" /></p>';

           ?>
            

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    
                    <?php

                    $rooms_var = get_post_meta( $post->ID, 'rooms', true );

                    echo '<p><label for="rooms">';
                    _e( '# of Rooms:', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input class="" type="text" placeholder="" style="width: 100%" id="rooms" name="rooms" value="' . esc_attr( $rooms_var ) . '" size="25" /></p>';

                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <?php

                    $star_rating_var = get_post_meta( $post->ID, 'star_rating', true );

                    echo '<p><label for="star_rating">';
                    _e( 'Star Rating (1-5):', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input class="" type="text" placeholder="" style="width: 100%" id="star_rating" name="star_rating" value="' . esc_attr( $star_rating_var ) . '" size="25" /></p>';

                    ?>
                </div>
            </div>

            <?php 
                $option = get_option('tourismpress');
                if($option['google_maps_api_key'] != ''){
                    $mapsapikey = $option['google_maps_api_key'];
                } else {
                    $mapsapikey = 'EMPTY API KEY';
                }
            ?>
       </div>

       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
           <label>Map:</label>
           <div class="tourismpress-map">
               <iframe
                 width="100%"
                 height="220"
                 frameborder="0" style="border:0"
                 src="https://www.google.com/maps/embed/v1/place?key=<?php echo $mapsapikey ?>&q=<?php echo $address_var.','.$city_var.','.$stateprov_var.','.$zip_var ?>" allowfullscreen>
               </iframe>
           </div>
       </div>
       
   </div>


    <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function tourismpress_accommodation_save_meta_box_data($post_id) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['tourismpress_accommodation_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['tourismpress_accommodation_meta_box_nonce'], 'tourismpress_accommodation_save_meta_box_data' ) ) {
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
    if (!isset( $_POST['address'])) {
        return;
    }
    if (!isset( $_POST['city'])) {
        return;
    }
    if (!isset( $_POST['stateprov'])) {
        return;
    }
    if (!isset( $_POST['zip'])) {
        return;
    }
    if (!isset( $_POST['telephone'])) {
        return;
    }
    if (!isset( $_POST['website_url'])) {
        return;
    }
    if (!isset( $_POST['rooms'])) {
        return;
    }
    if (!isset( $_POST['star_rating'])) {
        return;
    }

    // Sanitize user input.
    $address = sanitize_text_field($_POST['address']);
    $city = sanitize_text_field($_POST['city']);
    $stateprov = sanitize_text_field($_POST['stateprov']);
    $zip = sanitize_text_field($_POST['zip']);
    $telephone = sanitize_text_field($_POST['telephone']);
    $website_url = sanitize_text_field($_POST['website_url']);
    $rooms = sanitize_text_field($_POST['rooms']);
    $star_rating = sanitize_text_field($_POST['star_rating']);

    // Update the meta field in the database.
    update_post_meta($post_id, 'address', $address);
    update_post_meta($post_id, 'city', $city);
    update_post_meta($post_id, 'stateprov', $stateprov);
    update_post_meta($post_id, 'zip', $zip);
    update_post_meta($post_id, 'telephone', $telephone);
    update_post_meta($post_id, 'website_url', normalize_url($website_url));
    update_post_meta($post_id, 'rooms', $rooms);
    update_post_meta($post_id, 'star_rating', $star_rating);
}

add_action('save_post', 'tourismpress_accommodation_save_meta_box_data');

// Move all "location" metabox above the default editor
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'location', $post);
    unset($wp_meta_boxes[get_post_type($post)]['location']);
});