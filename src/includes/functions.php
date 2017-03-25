<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

function tourismpress_normalize_url($url){
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
function tourismpress_isValidGoogleAnalyticsID($trackingIdString){
    return preg_match('/^ua-\d{4,9}-\d{1,4}$/i', strval($trackingIdString)) ? true : false;
}

function tourismpress_isValidInteger($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_INT) !== false){
		return true;
	} else {
		return false;
	}
}

function tourismpress_isValidURL($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_URL) !== false){
		return true;
	} else {
		return false;
	}
}

function tourismpress_isValidEmail($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_EMAIL) !== false){
		return true;
	} else {
		return false;
	}
}

function tourismpress_isValidFloat($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_FLOAT) !== false){
		return true;
	} else {
		return false;
	}
}

function tourismpress_get_location_id_from_tripadvisor_url($tripadvisor_url){
	$pattern = '/-g\d{5,8}-d\d{5,8}/';
	preg_match($pattern, $tripadvisor_url, $matches);
	if($matches){
		$tripadvisor_id_block = $matches[0];
		$pattern = '/(?<=-d).*/';
		preg_match($pattern, $tripadvisor_id_block, $matches);
		if($matches){
			return($matches[0]);
		}
	}
}

function tourismpress_get_twitter_handle_from_url($twitter_url){
	$pattern = '/(?<=https:\/\/twitter\.com\/)(.*)/';
	preg_match($pattern, $twitter_url, $matches);
	if($matches){
		return($matches[0]);
	}
}


function tourismpress_get_instagram_handle_from_url($instagram_url){
	$pattern = '/(?<=https:\/\/www\.instagram\.com\/)(.*)/';
	preg_match($pattern, $instagram_url, $matches);
	if($matches){
		return($matches[0]);
	}
}