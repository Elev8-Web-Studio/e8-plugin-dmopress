<?php 

//returnType is 'echo' or 'return' - defaults to 'echo'
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

