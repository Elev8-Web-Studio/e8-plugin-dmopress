<?php

// Event Categories
function tourismpress_register_event_categories() {

    $labels = array(
        'name'                  => _x( 'Event Categories', 'Event Categories', 'tourismpress_textdomain' ),
        'singular_name'         => _x( 'Event Category', 'Event Category', 'tourismpress_textdomain' ),
        'search_items'          => __( 'Search Event Categories', 'tourismpress_textdomain' ),
        'popular_items'         => __( 'Popular Event Categories', 'tourismpress_textdomain' ),
        'all_items'             => __( 'All Event Categories', 'tourismpress_textdomain' ),
        'parent_item'           => __( 'Parent Event Category', 'tourismpress_textdomain' ),
        'parent_item_colon'     => __( 'Parent Event Category', 'tourismpress_textdomain' ),
        'edit_item'             => __( 'Edit Event Category', 'tourismpress_textdomain' ),
        'update_item'           => __( 'Update Event Category', 'tourismpress_textdomain' ),
        'add_new_item'          => __( 'Add New Event Category', 'tourismpress_textdomain' ),
        'new_item_name'         => __( 'New Event Category Name', 'tourismpress_textdomain' ),
        'add_or_remove_items'   => __( 'Add or remove Event Categories', 'tourismpress_textdomain' ),
        'choose_from_most_used' => __( 'Choose from most used categories', 'tourismpress_textdomain' ),
        'menu_name'             => __( 'Event Categories', 'tourismpress_textdomain' ),
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

    register_taxonomy( 'event-categories', 'events', $args );
    register_taxonomy_for_object_type( 'event-categories', 'events' );
}

add_action( 'init', 'tourismpress_register_event_categories' );

// Events Post Type
function register_events_post_type() {

    $labels = array(
        'name'                => __( 'Events', 'tourismpress_textdomain' ),
        'singular_name'       => __( 'Event', 'tourismpress_textdomain' ),
        'add_new'             => _x( 'Add New Event', 'tourismpress_textdomain', 'tourismpress_textdomain' ),
        'add_new_item'        => __( 'Add New Event', 'tourismpress_textdomain' ),
        'edit_item'           => __( 'Edit Event', 'tourismpress_textdomain' ),
        'new_item'            => __( 'New Event', 'tourismpress_textdomain' ),
        'view_item'           => __( 'View Event', 'tourismpress_textdomain' ),
        'search_items'        => __( 'Search Events', 'tourismpress_textdomain' ),
        'not_found'           => __( 'No Events found', 'tourismpress_textdomain' ),
        'not_found_in_trash'  => __( 'No Events found in Trash', 'tourismpress_textdomain' ),
        'parent_item_colon'   => __( 'Parent Event:', 'tourismpress_textdomain' ),
        'menu_name'           => __( 'Events', 'tourismpress_textdomain' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array('event-category','post_tag'),
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
        'supports'            => array('title', 'editor', 'thumbnail'),
    );

    register_post_type( 'events', $args );
}

add_action( 'init', 'register_events_post_type' );

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function tourismpress_event_add_meta_box() {
    add_meta_box(
        'event_details_section',
        __('Event Details', 'tourismpress_textdomain'),
        'tourismpress_event_meta_box_callback',
        'events',
        'location',
        'high'
    );
}
add_action( 'add_meta_boxes', 'tourismpress_event_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function tourismpress_event_meta_box_callback($post) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'tourismpress_event_save_meta_box_data', 'tourismpress_event_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    

   ?>

   <div class="row">
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
           
           <?php

           echo '<p><label for="place">';
           _e( 'Place:', 'tourismpress_textdomain' );
           echo '</label><br /> ';
           
           echo renderPlaceLookupField(get_post_meta($post->ID, 'place', true));

            if(get_post_meta($post->ID, 'place', true) == 'custom') {
                $address_block_visibility = 'display: block;';
            } else {
                $address_block_visibility = 'display: none;';
            }

           ?>

           <div class="tourismpress-custom-address-block" style="<?php echo $address_block_visibility ?>">

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

                </div>
            </div>

            </div>

            
            
       </div>
       
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">

            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <?php

                    $start_date_var = get_post_meta( $post->ID, 'start_date', true );

                    echo '<p><label for="start_date">';
                    _e( 'Start Date:', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input type="text" class="datepicker" placeholder="" style="width: 100%" id="start_date" name="start_date" value="' . esc_attr( $start_date_var ) . '" size="25" /></p>';

                    ?>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <?php

                    $start_time_var = get_post_meta( $post->ID, 'start_time', true );

                    echo '<p><label for="start_time">';
                    _e( 'Start Time:', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input type="text" placeholder="" style="width: 100%" id="start_time" name="start_time" value="' . esc_attr( $start_time_var ) . '" size="25" /></p>';

                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?php

                    $duration_var = get_post_meta( $post->ID, 'duration', true );

                    echo '<p><label for="duration">';
                    _e( 'Duration:', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input type="text" placeholder="" style="width: 100%" id="duration" name="duration" value="' . esc_attr( $duration_var ) . '" size="25" /></p>';

                    ?>
                </div>
            </div>

            <?php

            $website_url_var = get_post_meta( $post->ID, 'website_url', true );

            echo '<p><label for="website_url">';
            _e( 'Website URL:', 'tourismpress_textdomain' );
            echo '</label><br /> ';
            echo '<input type="text" placeholder="http://" style="width: 100%" id="website_url" name="website_url" value="' . esc_attr( $website_url_var ) . '" size="25" /></p>';

            ?>

            <?php

            $event_registration_url = get_post_meta( $post->ID, 'event_registration_url', true );

            echo '<p><label for="event_registration_url">';
            _e( 'Event Registration URL:', 'tourismpress_textdomain' );
            echo '</label><br /> ';
            echo '<input type="text" placeholder="http://" style="width: 100%" id="event_registration_url" name="event_registration_url" value="' . esc_attr( $event_registration_url ) . '" size="25" /></p>';

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
function tourismpress_event_save_meta_box_data($post_id) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['tourismpress_event_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['tourismpress_event_meta_box_nonce'], 'tourismpress_event_save_meta_box_data' ) ) {
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
    if (!isset( $_POST['place'])) {
        return;
    }
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
    if (!isset( $_POST['start_date'])) {
        return;
    }
    if (!isset( $_POST['start_time'])) {
        return;
    }
    if (!isset( $_POST['duration'])) {
        return;
    }
    if (!isset( $_POST['website_url'])) {
        return;
    }
    if (!isset( $_POST['event_registration_url'])) {
        return;
    }

    // Sanitize user input.
    $place = sanitize_text_field($_POST['place']);
    $address = sanitize_text_field($_POST['address']);
    $city = sanitize_text_field($_POST['city']);
    $stateprov = sanitize_text_field($_POST['stateprov']);
    $zip = sanitize_text_field($_POST['zip']);
    $start_date = sanitize_text_field($_POST['start_date']);
    $start_time = sanitize_text_field($_POST['start_time']);
    $start_datetime = new DateTime($start_date." ".$start_time);
    $duration = sanitize_text_field($_POST['duration']);
    $website_url = sanitize_text_field($_POST['website_url']);
    $event_registration_url = sanitize_text_field($_POST['event_registration_url']);

    // Update the meta field in the database.
    update_post_meta($post_id, 'place', $place);
    update_post_meta($post_id, 'address', $address);
    update_post_meta($post_id, 'city', $city);
    update_post_meta($post_id, 'stateprov', $stateprov);
    update_post_meta($post_id, 'zip', $zip);
    update_post_meta($post_id, 'start_date', $start_date);
    update_post_meta($post_id, 'start_time', $start_time);
    update_post_meta($post_id, 'start_datetime', $start_datetime->getTimestamp());
    update_post_meta($post_id, 'duration', $duration);
    update_post_meta($post_id, 'website_url', normalize_url($website_url));
    update_post_meta($post_id, 'event_registration_url', normalize_url($event_registration_url));
}

add_action('save_post', 'tourismpress_event_save_meta_box_data');

// Move all "location" metabox above the default editor
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'location', $post);
    unset($wp_meta_boxes[get_post_type($post)]['location']);
});