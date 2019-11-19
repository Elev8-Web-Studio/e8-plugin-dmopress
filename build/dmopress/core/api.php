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

//See https://www.dmopress.com/guide/functions/function-dmo_get_facebook_link/
function dmo_get_facebook_link($post_id = false, $label = false, $class = false, $target = false){
     if(!$post_id) {
         $post_id = get_the_ID();
     }
     $facebook_url = get_post_meta($post_id, 'facebook_url', true);
     if($facebook_url != ''){
        
        if($class){
            $classes = esc_html($class);
        } else {
            $classes = '';
        }
        $target_val = '_blank';
        if($target){
            switch ($target) {
               case '_blank':
                   $target_val = '_blank';
                   break;
               case '_parent':
                   $target_val = '_parent';
                   break;
               case '_self':
                   $target_val = '_self';
                   break;
               case '_top':
                   $target_val = '_top';
                   break;
               default:
                   $target_val = '_blank';
            }
        }

        if($label != ''){
            $label = $label;
        } else {
            $label = 'Facebook';
        }
        $link = '<a href="'.$facebook_url.'" class=" '.$classes.'" target="'.$target_val.'">'.$label.'</a>';
        return $link;
     } else {
         return '';
     }
}

//See https://www.dmopress.com/guide/functions/function-dmo_get_facebook_url/
function dmo_get_facebook_url($post_id = false){
     if(!$post_id) {
         $post_id = get_the_ID();
     }
     return get_post_meta($post_id, 'facebook_url', true);
}

//See https://www.dmopress.com/guide/functions/function-dmo_get_instagram_link/
function dmo_get_instagram_link($post_id = false, $label = false, $class = false, $target = false){
     if(!$post_id) {
         $post_id = get_the_ID();
     }
     $instagram_url = get_post_meta($post_id, 'instagram_url', true);
     if($instagram_url != ''){
        
        if($class){
            $classes = esc_html($class);
        } else {
            $classes = '';
        }
        $target_val = '_blank';
        if($target){
            switch ($target) {
               case '_blank':
                   $target_val = '_blank';
                   break;
               case '_parent':
                   $target_val = '_parent';
                   break;
               case '_self':
                   $target_val = '_self';
                   break;
               case '_top':
                   $target_val = '_top';
                   break;
               default:
                   $target_val = '_blank';
            }
        }

        if($label != ''){
            $label = $label;
        } else {
            $label = 'Instagram';
        }
        $link = '<a href="'.$instagram_url.'" class=" '.$classes.'" target="'.$target_val.'">'.$label.'</a>';
        return $link;
     } else {
         return '';
     }
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

//See https://www.dmopress.com/guide/functions/function-dmo_get_twitter_link/
function dmo_get_twitter_link($post_id = false, $label = false, $class = false, $target = false){
     if(!$post_id) {
         $post_id = get_the_ID();
     }
     $twitter_url = get_post_meta($post_id, 'twitter_url', true);
     if($twitter_url != ''){
        
        if($class){
            $classes = esc_html($class);
        } else {
            $classes = '';
        }
        $target_val = '_blank';
        if($target){
            switch ($target) {
               case '_blank':
                   $target_val = '_blank';
                   break;
               case '_parent':
                   $target_val = '_parent';
                   break;
               case '_self':
                   $target_val = '_self';
                   break;
               case '_top':
                   $target_val = '_top';
                   break;
               default:
                   $target_val = '_blank';
            }
        }

        if($label != ''){
            $label = $label;
        } else {
            $label = 'Twitter';
        }
        $link = '<a href="'.$twitter_url.'" class=" '.$classes.'" target="'.$target_val.'">'.$label.'</a>';
        return $link;
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

//See https://www.dmopress.com/guide/functions/function-dmo_get_website_link/
function dmo_get_website_link($post_id = false, $label = false, $class = false, $target = false){
     if(!$post_id) {
         $post_id = get_the_ID();
     }
     $website_url = get_post_meta($post_id, 'website_url', true);
     if($website_url != ''){
        
        if($class){
            $classes = esc_html($class);
        } else {
            $classes = '';
        }
        $target_val = '_blank';
        if($target){
            switch ($target) {
               case '_blank':
                   $target_val = '_blank';
                   break;
               case '_parent':
                   $target_val = '_parent';
                   break;
               case '_self':
                   $target_val = '_self';
                   break;
               case '_top':
                   $target_val = '_top';
                   break;
               default:
                   $target_val = '_blank';
            }
        }

        if($label != ''){
            $label = $label;
        } else {
            $label = 'Website';
        }
        $link = '<a href="'.$website_url.'" class=" '.$classes.'" target="'.$target_val.'">'.$label.'</a>';
        return $link;
     } else {
         return '';
     }
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


function dmo_is_module_enabled($module = ''){
    $options = get_option('dmopress');
    if($options[$module]=='enabled'){
        return true;
    } else {
        return false;
    }
}