<?php 



//selectedItem is the post_id of the selected post
function renderPlaceLookupField($selectedItem){
	$html = '';
	$selected = '';
	$custom = '';
	$none = '';

	$args = array(
	  'post_type'   => 'places',
	  'post_status' => 'publish',
	  'orderby'     => 'title',
	  'order'		 => 'asc'
	);
	 
	$places = get_posts($args);

	$html .= '<select id="" name="place" class="place-lookup-field">';

	if($selectedItem == 'none'){
		$none = 'selected';
	}
	$html .= '<option value="none" '.$none.'>None</option>';

	if($selectedItem == 'custom'){
		$custom = 'selected';
	}
	$html .= '<option value="custom" '.$custom.'>Custom</option>';
	foreach ($places as $place) {
		if($place->ID == $selectedItem){
			$selected = 'selected';
		} else {
			$selected = '';
		}
		$html .= '<option value="'.$place->ID.'" '.$selected.'>';
		$html .= $place->post_title;;
		$html .= '</option>';
	}
	$html .= '</select>';

	return $html;
}

function normalize_url($url){
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
function isValidGoogleAnalyticsID($trackingIdString){
    return preg_match('/^ua-\d{4,9}-\d{1,4}$/i', strval($trackingIdString)) ? true : false;
}

function isValidInteger($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_INT) !== false){
		return true;
	} else {
		return false;
	}
}

function isValidURL($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_URL) !== false){
		return true;
	} else {
		return false;
	}
}

function isValidEmail($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_EMAIL) !== false){
		return true;
	} else {
		return false;
	}
}

function isValidFloat($testvalue){
	if(filter_var($testvalue, FILTER_VALIDATE_FLOAT) !== false){
		return true;
	} else {
		return false;
	}
}

function tourismpress_get_location_id_from_tripadvisor_url($tripadvisor_url){
	$pattern = '/-g\d{5,7}-d\d{5,7}/';
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