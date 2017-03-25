<?php

//See https://www.dmopress.com/guide/functions/dmo_get_address/
function dmo_get_address($post_id = false){
    if(!$post_id)
    {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, 'address', true);
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
    $pattern = '/(?<=https:\/\/www\.instagram\.com\/)(.*)/';
    preg_match($pattern, $instagram_url, $matches);
    if($matches){
        return($matches[0]);
    } else {
        return '';
    }
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
    $pattern = '/-g\d{5,8}-d\d{5,8}/';
    preg_match($pattern, $tripadvisor_url, $matches);
    if($matches){
        $tripadvisor_id_block = $matches[0];
        $pattern = '/(?<=-d).*/';
        preg_match($pattern, $tripadvisor_id_block, $matches);
        if($matches){
            return($matches[0]);
        } else {
            return '';
        }
    } else {
        return '';
    }
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
    
    $pattern = '/(?<=https:\/\/twitter\.com\/)(.*)/';
    preg_match($pattern, $twitter_url, $matches);
    if($matches){
        return($matches[0]);
    } else {
        return '';
    }
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
