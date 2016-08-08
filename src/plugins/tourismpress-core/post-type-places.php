<?php

// Place Types
function tourismpress_register_place_categories_taxonomy() {

    $labels = array(
        'name'                  => _x( 'Place Types', 'Place Types', 'tourismpress_textdomain' ),
        'singular_name'         => _x( 'Place Type', 'Place Type', 'tourismpress_textdomain' ),
        'search_items'          => __( 'Search Place Types', 'tourismpress_textdomain' ),
        'popular_items'         => __( 'Popular Place Types', 'tourismpress_textdomain' ),
        'all_items'             => __( 'All Categories', 'tourismpress_textdomain' ),
        'parent_item'           => __( 'Parent Place Type', 'tourismpress_textdomain' ),
        'parent_item_colon'     => __( 'Parent Place Type', 'tourismpress_textdomain' ),
        'edit_item'             => __( 'Edit Place Type', 'tourismpress_textdomain' ),
        'update_item'           => __( 'Update Place Type', 'tourismpress_textdomain' ),
        'add_new_item'          => __( 'Add New Place Type', 'tourismpress_textdomain' ),
        'new_item_name'         => __( 'New Place Type Name', 'tourismpress_textdomain' ),
        'add_or_remove_items'   => __( 'Add or remove Place Types', 'tourismpress_textdomain' ),
        'choose_from_most_used' => __( 'Choose from most used types', 'tourismpress_textdomain' ),
        'menu_name'             => __( 'Place Types', 'tourismpress_textdomain' ),
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

    register_taxonomy( 'types', 'places', $args );
    register_taxonomy_for_object_type( 'types', 'places' );
}

add_action( 'init', 'tourismpress_register_place_categories_taxonomy' );

// Place Types
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

// Places Post Type
function tourismpress_register_places_post_type() {

	$labels = array(
		'name'                => __( 'Place', 'tourismpress_textdomain' ),
		'singular_name'       => __( 'Place', 'tourismpress_textdomain' ),
		'add_new'             => _x( 'Add New Place', 'tourismpress_textdomain', 'tourismpress_textdomain' ),
		'add_new_item'        => __( 'Add New Place', 'tourismpress_textdomain' ),
		'edit_item'           => __( 'Edit Place', 'tourismpress_textdomain' ),
		'new_item'            => __( 'New Place', 'tourismpress_textdomain' ),
		'view_item'           => __( 'View Place', 'tourismpress_textdomain' ),
		'search_items'        => __( 'Search Places', 'tourismpress_textdomain' ),
		'not_found'           => __( 'No Places found', 'tourismpress_textdomain' ),
		'not_found_in_trash'  => __( 'No Places found in Trash', 'tourismpress_textdomain' ),
		'parent_item_colon'   => __( 'Parent Place:', 'tourismpress_textdomain' ),
		'menu_name'           => __( 'Places', 'tourismpress_textdomain' ),
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

add_action( 'init', 'tourismpress_register_places_post_type' );

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function tourismpress_place_add_meta_box() {
    add_meta_box(
        'restaurant_details_section',
        __('Place Details', 'tourismpress_textdomain'),
        'tourismpress_place_meta_box_callback',
        'places',
        'location',
        'high'
    );
}
add_action( 'add_meta_boxes', 'tourismpress_place_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function tourismpress_place_meta_box_callback($post) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'tourismpress_place_save_meta_box_data', 'tourismpress_place_meta_box_nonce' );

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
            echo '<input type="text" placeholder="http://" style="width: 100%" id="website_url" name="website_url" value="' . esc_attr( $website_url_var ) . '" size="25" /></p>';

            ?>
            <?php

            $facebook_url_var = get_post_meta( $post->ID, 'facebook_url', true );

            echo '<p><label for="facebook_url">';
            _e( 'Facebook Page URL:', 'tourismpress_textdomain' );
            echo '</label><br /> ';
            echo '<input type="text" placeholder="http://" style="width: 100%" id="facebook_url" name="facebook_url" value="' . esc_attr( $facebook_url_var ) . '" size="25" /></p>';

            ?>

            <?php

            $twitter_url = get_post_meta( $post->ID, 'twitter_url', true );

            echo '<p><label for="twitter_url">';
            _e( 'Twitter Profile URL:', 'tourismpress_textdomain' );
            echo '</label><br /> ';
            echo '<input type="text" placeholder="http://" style="width: 100%" id="twitter_url" name="twitter_url" value="' . esc_attr( $twitter_url ) . '" size="25" /></p>';

            ?>
            <?php

            $instagram_url_var = get_post_meta( $post->ID, 'instagram_url', true );

            echo '<p><label for="instagram_url">';
            _e( 'Instagram URL:', 'tourismpress_textdomain' );
            echo '</label><br /> ';
            echo '<input type="text" placeholder="http://" style="width: 100%" id="instagram_url" name="instagram_url" value="' . esc_attr( $instagram_url_var ) . '" size="25" /></p>';

            ?>

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
function tourismpress_place_save_meta_box_data($post_id) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['tourismpress_place_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['tourismpress_place_meta_box_nonce'], 'tourismpress_place_save_meta_box_data' ) ) {
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
    if (!isset( $_POST['facebook_url'])) {
        return;
    }
    if (!isset( $_POST['twitter_url'])) {
        return;
    }
    if (!isset( $_POST['instagram_url'])) {
        return;
    }

    // Sanitize user input.
    $address = sanitize_text_field($_POST['address']);
    $city = sanitize_text_field($_POST['city']);
    $stateprov = sanitize_text_field($_POST['stateprov']);
    $zip = sanitize_text_field($_POST['zip']);
    $telephone = sanitize_text_field($_POST['telephone']);
    $website_url = sanitize_text_field($_POST['website_url']);
    $facebook_url = sanitize_text_field($_POST['facebook_url']);
    $twitter_url = sanitize_text_field($_POST['twitter_url']);
    $instagram_url = sanitize_text_field($_POST['instagram_url']);

    // Update the meta field in the database.
    update_post_meta($post_id, 'address', $address);
    update_post_meta($post_id, 'city', $city);
    update_post_meta($post_id, 'stateprov', $stateprov);
    update_post_meta($post_id, 'zip', $zip);
    update_post_meta($post_id, 'telephone', $telephone);
    update_post_meta($post_id, 'website_url', normalize_url($website_url));
    update_post_meta($post_id, 'facebook_url', normalize_url($facebook_url));
    update_post_meta($post_id, 'twitter_url', normalize_url($twitter_url));
    update_post_meta($post_id, 'instagram_url', normalize_url($instagram_url));
}

add_action('save_post', 'tourismpress_place_save_meta_box_data');

// Move all "location" metabox above the default editor
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'location', $post);
    unset($wp_meta_boxes[get_post_type($post)]['location']);
});