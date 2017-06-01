<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

function dmopress_normalize_url($url){
	//Apply http:// prefix to URLs that don't already have http:// or https:// in the URL
	if($url != ''){
		if (strpos($url, 'http://') !== false || strpos($url, 'https://') !== false){
		    return $url;
		} else {
			return 'http://'.$url;
		}
	} else {
		return '';
	}
    
}

// Type Validation Functions
function dmopress_isValidGoogleAnalyticsID($trackingIdString){
    return preg_match('/^ua-\d{4,9}-\d{1,4}$/i', strval($trackingIdString)) ? true : false;
}

function dmopress_isValidInteger($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_INT) !== false){
		return true;
	} else {
		return false;
	}
}

function dmopress_isValidURL($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_URL) !== false){
		return true;
	} else {
		return false;
	}
}

function dmopress_isValidEmail($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_EMAIL) !== false){
		return true;
	} else {
		return false;
	}
}

function dmopress_isValidFloat($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_FLOAT) !== false){
		return true;
	} else {
		return false;
	}
}

function dmopress_get_location_id_from_tripadvisor_url($tripadvisor_url){
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

function dmopress_get_twitter_handle_from_url($twitter_url){
	$pattern = '/(?<=twitter\.com\/)(.*)/';
	preg_match($pattern, $twitter_url, $matches);
	if($matches){
		$chars = preg_split('/\//', $matches[0]);
		return $chars[0];
	} else {
		return '';
	}
}


function dmopress_get_instagram_handle_from_url($instagram_url){
	$pattern = '/(?<=instagram\.com\/)(.*)/';
	preg_match($pattern, $instagram_url, $matches);
	if($matches){
		$chars = preg_split('/\//', $matches[0]);
		return $chars[0];
	} else {
		return '';
	}
}

function dmo_get_google_maps_api_key(){
   $option = get_option('dmopress');
	if($option['google_maps_api_key'] != ''){
        return $option['google_maps_api_key'];
    } else {
        return null;
    }
	
}

function dmo_get_google_maps_theme(){
    $option = get_option('dmopress');
    if($option['google_maps_style'] != ''){
        return $option['google_maps_style'];
    } else {
        return '';
    }
}

function dmo_get_openweathermap_api_key(){
   $option = get_option('dmopress');
	if($option['openweathermap_api_key'] != ''){
        return $option['openweathermap_api_key'];
    } else {
        return null;
    }
	
}

function dmo_get_openweathermap_default_unit(){
   $option = get_option('dmopress');
	if($option['openweathermap_default_unit'] != ''){
        return $option['openweathermap_default_unit'];
    } else {
        return 'cf';
    }
	
}