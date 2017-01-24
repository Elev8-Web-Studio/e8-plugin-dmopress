<?php

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function tourismpress_place_add_meta_box() {
    add_meta_box(
        'place-details-section',
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

   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-4">
               <?php

               $address_var = get_post_meta( $post->ID, 'address', true );

                echo '<p><label for="address">';
                _e( 'Address: ', 'tourismpress_textdomain' );
                echo '</label><br />';
                echo '<input type="text" style="width: 100%" id="address" name="address" value="' . esc_attr( $address_var ) . '" size="25" /></p>';

                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            $city_var = get_post_meta( $post->ID, 'city', true );

                            echo '<p><label for="city">';
                            _e( 'City:', 'tourismpress_textdomain' );
                            echo '</label><br /> ';
                            echo '<input type="text" style="width: 100%" id="city" name="city" value="' . esc_attr( $city_var ) . '" size="25" /></p>';
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <?php

                            $stateprov_var = get_post_meta( $post->ID, 'stateprov', true );

                            echo '<p><label for="stateprov">';
                            _e( 'Province / State:', 'tourismpress_textdomain' );
                            echo '</label><br /> ';
                            echo '<input type="text" style="width: 100%" id="stateprov" name="stateprov" value="' . esc_attr( $stateprov_var ) . '" size="25" /></p>';

                            ?>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php

                            $zip_var = get_post_meta( $post->ID, 'zip', true );

                            echo '<p><label for="zip">';
                            _e( 'Postal Code / ZIP:', 'tourismpress_textdomain' );
                            echo '</label><br /> ';
                            echo '<input type="text" style="width: 100%" id="zip" name="zip" value="' . esc_attr( $zip_var ) . '" size="25" /></p>';

                            ?>
                        </div>
                        <div class="col-lg-6">
                            <?php

                            $telephone_var = get_post_meta( $post->ID, 'telephone', true );

                            echo '<p><label for="telephone">';
                            _e( 'Telephone:', 'tourismpress_textdomain' );
                            echo '</label><br /> ';
                            echo '<input type="text" style="width: 100%" id="telephone" name="telephone" value="' . esc_attr( $telephone_var ) . '" size="25" /></p>';

                            ?>
                        </div>
                    </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php

                                    $latitude_var = get_post_meta( $post->ID, 'latitude', true );

                                    echo '<p><label for="latitude">';
                                    _e( 'Latitude:', 'tourismpress' );
                                    echo '</label><br /> ';
                                    echo '<input class="input-faded" type="text" placeholder="" style="width: 100%" id="latitude" name="latitude" value="' . esc_attr( $latitude_var ) . '" size="15" /></p>';

                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php

                                    $longitude_var = get_post_meta( $post->ID, 'longitude', true );

                                    echo '<p><label for="longitude">';
                                    _e( 'Longitude:', 'tourismpress' );
                                    echo '</label><br /> ';
                                    echo '<input class="input-faded" type="text" placeholder="" style="width: 100%" id="longitude" name="longitude" value="' . esc_attr( $longitude_var ) . '" size="15" /></p>';

                                    ?>
                                    
                                </div>
                            </div>
                       
                    
                </div>

                <p>
                Automatically fill latitude / longitude:<br>
                <button id="geocode" class="button"><span class="dashicons dashicons-location" style="line-height: 26px"></span> Geocode Address</button></p>
                
           </div>
           
           <div class="col-lg-4">
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

                $twitter_url_var = get_post_meta( $post->ID, 'twitter_url', true );

                echo '<p><label for="twitter_url">';
                _e( 'Twitter Profile URL:', 'tourismpress_textdomain' );

                $twitter_handle = tourismpress_get_twitter_handle_from_url($twitter_url_var);
                if($twitter_handle != ''){
                    echo '<span class="label-info">Handle: ' . $twitter_handle . '<span class="dashicons dashicons-yes success"></span></span>';
                }

                echo '</label><br /> ';
                echo '<input type="text" placeholder="http://" style="width: 100%" id="twitter_url" name="twitter_url" value="' . esc_attr( $twitter_url_var ) . '" size="25" /></p>';

                ?>
                <?php

                $instagram_url_var = get_post_meta( $post->ID, 'instagram_url', true );

                echo '<p><label for="instagram_url">';
                _e( 'Instagram URL:', 'tourismpress_textdomain' );

                $instagram_handle = tourismpress_get_instagram_handle_from_url($instagram_url_var);
                if($instagram_handle != ''){
                    echo '<span class="label-info">Handle: ' . $instagram_handle . '<span class="dashicons dashicons-yes success"></span></span>';
                }

                echo '</label><br /> ';
                echo '<input type="text" placeholder="http://" style="width: 100%" id="instagram_url" name="instagram_url" value="' . esc_attr( $instagram_url_var ) . '" size="25" /></p>';

                ?>

                <?php

                $tripadvisor_url_var = get_post_meta( $post->ID, 'tripadvisor_url', true );

                echo '<p><label for="tripadvisor_url">';
                _e( 'TripAdvisor URL:', 'tourismpress_textdomain' );
                $location_id = tourismpress_get_location_id_from_tripadvisor_url($tripadvisor_url_var);
                if($location_id != ''){
                    echo '<span class="label-info">Location ID: ' . $location_id . '<span class="dashicons dashicons-yes success"></span></span>';
                }
                echo '</label><br /> ';
                echo '<input type="text" placeholder="http://" style="width: 100%" id="tripadvisor_url" name="tripadvisor_url" value="' . esc_attr( $tripadvisor_url_var ) . '" size="25" /></p>';

                //echo tourismpress_get_location_id_from_tripadvisor_url($tripadvisor_url_var);

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
            <div class="col-lg-4">

                <?php if($latitude_var != '' && $longitude_var != ''){  ?>
                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $mapsapikey ?>"></script>
                
                <script type="text/javascript">
                    // When the window has finished loading create our google map below
                    google.maps.event.addDomListener(window, 'load', init);
                
                    function init() {
                        // Basic options for a simple Google Map
                        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                        var mapOptions = {
                            // How zoomed in you want the map to start at (always required)
                            zoom: 14,

                            // The latitude and longitude to center the map (always required)
                            center: new google.maps.LatLng(<?php echo esc_attr( $latitude_var ) ?>, <?php echo esc_attr( $longitude_var ) ?>), // New York

                            // How you would like to style the map. 
                            // This is where you would paste any style found on Snazzy Maps.
                            styles: [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":"50"},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"30"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"40"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}]
                        };

                        // Get the HTML DOM element that will contain your map 
                        // We are using a div with id="map" seen below in the <body>
                        var mapElement = document.getElementById('map');

                        // Create the Google Map using our element and options defined above
                        var map = new google.maps.Map(mapElement, mapOptions);

                        // Let's also add a marker while we're at it
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(<?php echo esc_attr( $latitude_var ) ?>, <?php echo esc_attr( $longitude_var ) ?>),
                            map: map,
                            title: 'Snazzy!'
                        });
                    }
                </script>
                <?php } ?>

                Map:<br>
                <div id="map" class="tourismpress-map"></div>
                
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
    if (!isset( $_POST['tripadvisor_url'])) {
        return;
    }
    if (!isset( $_POST['latitude'])) {
        return;
    }
    if (!isset( $_POST['longitude'])) {
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
    $tripadvisor_url = sanitize_text_field($_POST['tripadvisor_url']);
    $latitude = sanitize_text_field($_POST['latitude']);
    $longitude = sanitize_text_field($_POST['longitude']);

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
    update_post_meta($post_id, 'tripadvisor_url', normalize_url($tripadvisor_url));
    update_post_meta($post_id, 'latitude', $latitude);
    update_post_meta($post_id, 'longitude', $longitude);
}

add_action('save_post', 'tourismpress_place_save_meta_box_data');

// Move all "location" metabox above the default editor
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'location', $post);
    unset($wp_meta_boxes[get_post_type($post)]['location']);
});