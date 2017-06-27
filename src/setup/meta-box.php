<?php
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function dmopress_place_add_meta_box() {
    add_meta_box(
        'place-details-section',
        __('Place Details', 'dmopress_textdomain'),
        'dmopress_place_meta_box_callback',
        'places',
        'location',
        'high'
    );
}
add_action( 'add_meta_boxes', 'dmopress_place_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function dmopress_place_meta_box_callback($post) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'dmopress_place_save_meta_box_data', 'dmopress_place_meta_box_nonce' );

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
                _e( 'Address', 'dmopress_textdomain' );
                echo ': ';
                echo '</label><br />';
                echo '<input type="text" style="width: 100%" id="address" name="address" value="' . esc_attr( $address_var ) . '" size="25" /></p>';

                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            $city_var = get_post_meta( $post->ID, 'city', true );

                            echo '<p><label for="city">';
                            _e( 'City', 'dmopress_textdomain' );
                            echo ': ';
                            echo '</label><br /> ';
                            echo '<input type="text" style="width: 100%" id="city" name="city" value="' . esc_attr( $city_var ) . '" size="25" /></p>';
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <?php

                            $stateprov_var = get_post_meta( $post->ID, 'stateprov', true );

                            echo '<p><label for="stateprov">';
                            _e( 'Province / State', 'dmopress_textdomain' );
                            echo ': ';
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
                            _e( 'Postal Code / ZIP', 'dmopress_textdomain' );
                            echo ': ';
                            echo '</label><br /> ';
                            echo '<input type="text" style="width: 100%" id="zip" name="zip" value="' . esc_attr( $zip_var ) . '" size="25" /></p>';

                            ?>
                        </div>
                        <div class="col-lg-6">
                            <?php

                            $telephone_var = get_post_meta( $post->ID, 'telephone', true );

                            echo '<p><label for="telephone">';
                            _e( 'Telephone', 'dmopress_textdomain' );
                            echo ': ';
                            echo '</label><br> ';
                            echo '<input type="text" style="width: 100%" id="telephone" name="telephone" value="' . esc_attr( $telephone_var ) . '" size="25" /></p>';

                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <?php 

                            $symbol_var = get_post_meta( $post->ID, 'symbol', true );

                            ?>
                            <p><label for="symbol">
                                <?php _e('Symbol', 'citylights'); ?>:<br>
                                <select id="symbol" name="symbol" class="icon-select select2" style="width: 100%">
                                    <option value="none" <?php if($symbol_var == 'none'){ echo 'selected';} ?>><?php _e('None','citylights'); ?></option>
                                    <option value="map-icon-art-gallery" <?php if($symbol_var == 'map-icon-art-gallery'){ echo 'selected';} ?>><?php _e('Art Gallery','citylights'); ?></option>
                                    <?php 
                                    $symbols = dmo_get_symbols_array();
                                    foreach ($symbols as $class => $label) {
                                        echo '<option value="'.$class.'"';
                                        if($symbol_var == $class) {
                                            echo ' selected';
                                        }
                                        echo '>'.$label.'</option>';
                                    }
                                    ?>
                                </select>
                            </label></p>
                            
                        </div>
                    </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php

                                    $latitude_var = get_post_meta( $post->ID, 'latitude', true );

                                    echo '<p><label for="latitude">';
                                    _e( 'Latitude', 'dmopress_textdomain' );
                                    echo ': ';
                                    echo '</label><br /> ';
                                    echo '<input class="input-faded" type="text" placeholder="" style="width: 100%" id="latitude" name="latitude" value="' . esc_attr( $latitude_var ) . '" size="15" /></p>';

                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php

                                    $longitude_var = get_post_meta( $post->ID, 'longitude', true );

                                    echo '<p><label for="longitude">';
                                    _e( 'Longitude', 'dmopress_textdomain' );
                                    echo ': ';
                                    echo '</label><br /> ';
                                    echo '<input class="input-faded" type="text" placeholder="" style="width: 100%" id="longitude" name="longitude" value="' . esc_attr( $longitude_var ) . '" size="15" /></p>';

                                    ?>
                                    
                                </div>
                            </div>
                       
                    
                </div>

                <p>
                <?php _e( 'Automatically fill latitude / longitude', 'dmopress_textdomain' ); ?>:
                <br>
                <button id="geocode" class="button"><span class="dashicons dashicons-location" style="line-height: 26px"></span> <?php _e( 'Geocode Address', 'dmopress_textdomain' ); ?></button><span id="geocode-error" class="error"><br>▲ <?php _e( 'Google could not locate this address.', 'dmopress_textdomain' ); ?></span>
                </p>
                
                
           </div>
           
           <div class="col-lg-4">
                <?php

                $website_url_var = get_post_meta( $post->ID, 'website_url', true );

                echo '<p><label for="website_url">';
                _e( 'Website URL', 'dmopress_textdomain' );
                echo ': ';
                echo '</label><br /> ';
                echo '<input type="text" placeholder="http://" style="width: 100%" id="website_url" name="website_url" value="' . esc_attr( $website_url_var ) . '" size="25" /></p>';

                ?>
                <?php

                $facebook_url_var = get_post_meta( $post->ID, 'facebook_url', true );

                echo '<p><label for="facebook_url">';
                _e( 'Facebook Page URL', 'dmopress_textdomain' );
                echo ': ';
                echo '</label><br /> ';
                echo '<input type="text" placeholder="http://" style="width: 100%" id="facebook_url" name="facebook_url" value="' . esc_attr( $facebook_url_var ) . '" size="25" /></p>';

                ?>

                <?php

                $twitter_url_var = get_post_meta( $post->ID, 'twitter_url', true );

                echo '<p><label for="twitter_url">';
                _e( 'Twitter Profile URL', 'dmopress_textdomain' );
                echo ': ';

                $twitter_handle_var = dmopress_get_twitter_handle_from_url($twitter_url_var);
                if($twitter_handle_var != ''){
                    echo '<span class="label-info">'.__('Handle','dmopress_textdomain').': ' . $twitter_handle_var . '<span class="dashicons dashicons-yes success"></span></span>';
                }

                echo '</label><br /> ';
                echo '<input type="text" placeholder="http://" style="width: 100%" id="twitter_url" name="twitter_url" value="' . esc_attr( $twitter_url_var ) . '" size="25" />';
                echo '<input type="hidden" name="twitter_handle" value="'.esc_attr($twitter_handle_var).'">';
                echo '</p>';

                ?>
                <?php

                $instagram_url_var = get_post_meta( $post->ID, 'instagram_url', true );

                echo '<p><label for="instagram_url">';
                _e( 'Instagram URL', 'dmopress_textdomain' );
                echo ': ';

                $instagram_handle = dmopress_get_instagram_handle_from_url($instagram_url_var);
                if($instagram_handle != ''){
                    
                    echo '<span class="label-info">'.__('Handle','dmopress_textdomain').': ' . $instagram_handle . '<span class="dashicons dashicons-yes success"></span></span>';
                }

                echo '</label><br /> ';
                echo '<input type="text" placeholder="http://" style="width: 100%" id="instagram_url" name="instagram_url" value="' . esc_attr( $instagram_url_var ) . '" size="25" /></p>';

                ?>

                <?php

                $tripadvisor_url_var = get_post_meta( $post->ID, 'tripadvisor_url', true );
                $tripadvisor_location_id_var = get_post_meta( $post->ID, 'tripadvisor_location_id', true );

                echo '<p><label for="tripadvisor_url">';
                _e( 'TripAdvisor URL', 'dmopress_textdomain' );
                echo ': ';
                $tripadvisor_location_id_var = dmopress_get_location_id_from_tripadvisor_url($tripadvisor_url_var);
                if($tripadvisor_location_id_var != ''){
                    echo '<span class="label-info">'.__('Location ID','dmopress_textdomain').': ' . $tripadvisor_location_id_var . '<span class="dashicons dashicons-yes success"></span></span>';
                }
                echo '</label><br /> ';
                echo '<input type="text" placeholder="http://" style="width: 100%" id="tripadvisor_url" name="tripadvisor_url" value="' . esc_attr( $tripadvisor_url_var ) . '" size="25" />';
                echo '<input type="hidden" name="tripadvisor_location_id" value="'.esc_attr( $tripadvisor_location_id_var ).'">';
                echo '</p>';


                ?>

           </div>
            <div class="col-lg-4">
            <?php _e('Map','dmopress_textdomain') ?>:<br>
                <?php echo do_shortcode('[dmo-map places="'.get_the_ID().'"]'); ?>                
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
function dmopress_place_save_meta_box_data($post_id) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['dmopress_place_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['dmopress_place_meta_box_nonce'], 'dmopress_place_save_meta_box_data' ) ) {
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
    if (!isset( $_POST['symbol'])) {
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
    if (!isset( $_POST['twitter_handle'])) {
        return;
    }
    if (!isset( $_POST['instagram_url'])) {
        return;
    }
    if (!isset( $_POST['tripadvisor_location_id'])) {
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
    $symbol = sanitize_text_field($_POST['symbol']);
    $telephone = sanitize_text_field($_POST['telephone']);
    $website_url = sanitize_text_field($_POST['website_url']);
    $facebook_url = sanitize_text_field($_POST['facebook_url']);
    $twitter_url = sanitize_text_field($_POST['twitter_url']);
    $twitter_handle = sanitize_text_field(dmopress_get_twitter_handle_from_url($twitter_url));
    $instagram_url = sanitize_text_field($_POST['instagram_url']);
    $tripadvisor_url = sanitize_text_field($_POST['tripadvisor_url']);
    $tripadvisor_location_id = sanitize_text_field(dmopress_get_location_id_from_tripadvisor_url($tripadvisor_url));
    $latitude = sanitize_text_field($_POST['latitude']);
    $longitude = sanitize_text_field($_POST['longitude']);

    // Update the meta field in the database.
    update_post_meta($post_id, 'address', $address);
    update_post_meta($post_id, 'city', $city);
    update_post_meta($post_id, 'stateprov', $stateprov);
    update_post_meta($post_id, 'zip', $zip);
    update_post_meta($post_id, 'symbol', $symbol);
    update_post_meta($post_id, 'telephone', $telephone);
    update_post_meta($post_id, 'website_url', dmopress_normalize_url($website_url));
    update_post_meta($post_id, 'facebook_url', dmopress_normalize_url($facebook_url));
    update_post_meta($post_id, 'twitter_url', dmopress_normalize_url($twitter_url));
    update_post_meta($post_id, 'twitter_handle', dmopress_normalize_url($twitter_handle));
    update_post_meta($post_id, 'instagram_url', dmopress_normalize_url($instagram_url));
    update_post_meta($post_id, 'tripadvisor_url', dmopress_normalize_url($tripadvisor_url));
    update_post_meta($post_id, 'tripadvisor_location_id', $tripadvisor_location_id);
    update_post_meta($post_id, 'latitude', $latitude);
    update_post_meta($post_id, 'longitude', $longitude);
}

add_action('save_post', 'dmopress_place_save_meta_box_data');

// Move all "location" metabox above the default editor
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'location', $post);
    unset($wp_meta_boxes[get_post_type($post)]['location']);
});