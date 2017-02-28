<?php 

function tpress_get_google_maps_api_key(){
    $option = get_option('tourismpress');
    if($option['google_maps_api_key'] != ''){
        return $option['google_maps_api_key'];
    } else {
        return null;
    }
}

function tpress_get_google_maps_style(){
    $option = get_option('tourismpress');
    if($option['google_maps_style'] != ''){
        return $option['google_maps_style'];
    } else {
        return '';
    }
}
