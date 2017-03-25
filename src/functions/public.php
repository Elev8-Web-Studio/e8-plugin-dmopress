<?php

//See https://www.dmopress.com/guide/functions/dmo_get_address/
function dmo_get_address($post_id = false){
    if(!$post_id){
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, 'address', true);
}

function dmo_get_address_full($post_id = false, $separator = ", "){
    if(!$post_id){
        $post_id = get_the_ID();
    }
    $address_block = array();
    if(dmo_get_address($post_id) != ''){
        array_push($address_block, dmo_get_address());
    };
    if(dmo_get_city($post_id) != ''){
        array_push($address_block, dmo_get_city());
    };
    if(dmo_get_province($post_id) != ''){
        array_push($address_block, dmo_get_province());
    };
    if(dmo_get_postal_code($post_id) != ''){
        array_push($address_block, dmo_get_postal_code());
    };

    return implode($separator, $address_block);
}

//See https://www.dmopress.com/guide/functions/dmo_get_city/
function dmo_get_city($post_id = false){
     if(!$post_id) {
         $post_id = get_the_ID();
     }
     return get_post_meta($post_id, 'city', true);
}

//See https://www.dmopress.com/guide/functions/function-dmo_get_facebook_url/
function dmo_get_facebook_url($post_id = false){
     if(!$post_id) {
         $post_id = get_the_ID();
     }
     return get_post_meta($post_id, 'facebook_url', true);
}

//See https://www.dmopress.com/guide/functions/dmo_get_instagram_url/
function dmo_get_instagram_url($post_id = false){
     if(!$post_id) {
         $post_id = get_the_ID();
     }
     return get_post_meta($post_id, 'instagram_url', true);
}

//See https://www.dmopress.com/guide/functions/dmo_get_instagram_handle/
function dmo_get_instagram_handle($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    $instagram_url = get_post_meta($post_id, 'instagram_url', true);
    $instagram_handle = dmopress_get_instagram_handle_from_url($instagram_url);
    return $instagram_handle;
}

//See https://www.dmopress.com/guide/functions/dmo_get_latitude/
function dmo_get_latitude($post_id = false){
     if(!$post_id) {
         $post_id = get_the_ID();
     }
     return get_post_meta($post_id, 'latitude', true);
}

//See https://www.dmopress.com/guide/functions/dmo_get_longitude/
function dmo_get_longitude($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, 'longitude', true);
}

//See https://www.dmopress.com/guide/functions/dmo_get_postal_code/
function dmo_get_postal_code ($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, 'zip', true);
}

//See https://www.dmopress.com/guide/functions/dmo_get_province/
function dmo_get_province ($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, 'stateprov', true);
}

//See https://www.dmopress.com/guide/functions/dmo_get_state/
function dmo_get_state($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, 'stateprov', true);
}

//See https://www.dmopress.com/guide/functions/dmo_get_telephone/
function dmo_get_telephone($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, 'telephone', true);
}

//See https://www.dmopress.com/guide/functions/dmo_get_tripadvisor_location_id/
function dmo_get_tripadvisor_location_id($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    $tripadvisor_url = get_post_meta($post_id, 'tripadvisor_url', true);
    $tripadvisor_location_id = dmopress_get_location_id_from_tripadvisor_url($tripadvisor_url);
    return $tripadvisor_location_id;
}

//See https://www.dmopress.com/guide/functions/dmo_get_tripadvisor_url/
function dmo_get_tripadvisor_url($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, 'tripadvisor_url', true);
}

//See https://www.dmopress.com/guide/functions/dmo_get_twitter_handle/
function dmo_get_twitter_handle($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    $twitter_url = get_post_meta($post_id, 'twitter_url', true);
    $twitter_handle = dmopress_get_twitter_handle_from_url($twitter_url);
    return $twitter_handle;
}

//See https://www.dmopress.com/guide/functions/dmo_get_twitter_url/
function dmo_get_twitter_url($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, 'twitter_url', true);
}

//See https://www.dmopress.com/guide/functions/dmo_get_website_url/
function dmo_get_website_url($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, 'website_url', true);
}

//See https://www.dmopress.com/guide/functions/dmo_get_zip/
function dmo_get_zip($post_id = false){
    if(!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, 'zip', true);
}
