<?php 

function tpress_get_google_maps_api_key(){
    $option = get_theme_mod('tourismpress_google_maps_api_key');
    if($option['google_maps_api_key'] != ''){
        return $option['google_maps_api_key'];
    } else {
        return null;
    }
}
