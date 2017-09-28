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
        return 'classic';
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

function dmo_get_openweathermap_city_id(){
   $option = get_option('dmopress');
	if($option['openweathermap_city_id'] != ''){
        return $option['openweathermap_city_id'];
    } else {
        return '5368361';
    }
	
}

//Flush rewrite rules
function dmopress_flush_rewrite_rules() {
	if ( get_option( 'myplugin_flush_rewrite_rules_flag' ) ) {
		flush_rewrite_rules();
		delete_option( 'myplugin_flush_rewrite_rules_flag' );
	}
}


//
function dmo_get_map_theme_defaults(){
	return array(
		'classic' => array(
			'marker-stroke-weight' => '2',
			'marker-stroke-color' => '#444444',
			'marker-stroke-opacity' => '1',
			'marker-fill-color' => '#f76458',
			'marker-fill-opacity' => '1',
			'marker-label-color' => '#ffffff',
			'marker-scale' => '1',
			'marker-svg-path' => 'M37.0237112,10 C27.1233267,10 19.0948448,18.11264 19,28.14528 C19.0474224,31.64992 20.0561094,34.96 21.8363714,37.69728 L35.6292367,56.94528 C36.0150242,57.66528 36.5430789,58 37.0237112,58 C37.5517659,58 38.0323982,57.66528 38.4181857,56.94528 L52.1636286,37.69728 C53.9406864,34.91264 55,31.64992 55,28.14528 C54.9525776,18.11264 46.9240957,10 37.0237112,10 Z'
 		),
		'gotham' => array(
			'marker-stroke-weight' => '2',
			'marker-stroke-color' => '#444444',
			'marker-stroke-opacity' => '1',
			'marker-fill-color' => '#CC6A35',
			'marker-fill-opacity' => '1',
			'marker-label-color' => '#ffffff',
			'marker-scale' => '1',
			'marker-svg-path' => 'M37.0237112,10 C27.1233267,10 19.0948448,18.11264 19,28.14528 C19.0474224,31.64992 20.0561094,34.96 21.8363714,37.69728 L35.6292367,56.94528 C36.0150242,57.66528 36.5430789,58 37.0237112,58 C37.5517659,58 38.0323982,57.66528 38.4181857,56.94528 L52.1636286,37.69728 C53.9406864,34.91264 55,31.64992 55,28.14528 C54.9525776,18.11264 46.9240957,10 37.0237112,10 Z'
 		),
		'nature' => array(
			'marker-stroke-weight' => '2',
			'marker-stroke-color' => '#50702C',
			'marker-stroke-opacity' => '1',
			'marker-fill-color' => '#679038',
			'marker-fill-opacity' => '1',
			'marker-label-color' => '#ffffff',
			'marker-scale' => '1',
			'marker-svg-path' => 'M37.0237112,10 C27.1233267,10 19.0948448,18.11264 19,28.14528 C19.0474224,31.64992 20.0561094,34.96 21.8363714,37.69728 L35.6292367,56.94528 C36.0150242,57.66528 36.5430789,58 37.0237112,58 C37.5517659,58 38.0323982,57.66528 38.4181857,56.94528 L52.1636286,37.69728 C53.9406864,34.91264 55,31.64992 55,28.14528 C54.9525776,18.11264 46.9240957,10 37.0237112,10 Z'
 		),
		'grayscale' => array(
			'marker-stroke-weight' => '2',
			'marker-stroke-color' => '#222222',
			'marker-stroke-opacity' => '1',
			'marker-fill-color' => '#4a4a4a',
			'marker-fill-opacity' => '1',
			'marker-label-color' => '#ffffff',
			'marker-scale' => '1',
			'marker-svg-path' => 'M37.0237112,10 C27.1233267,10 19.0948448,18.11264 19,28.14528 C19.0474224,31.64992 20.0561094,34.96 21.8363714,37.69728 L35.6292367,56.94528 C36.0150242,57.66528 36.5430789,58 37.0237112,58 C37.5517659,58 38.0323982,57.66528 38.4181857,56.94528 L52.1636286,37.69728 C53.9406864,34.91264 55,31.64992 55,28.14528 C54.9525776,18.11264 46.9240957,10 37.0237112,10 Z'
 		),
		'midnight' => array(
			'marker-stroke-weight' => '2',
			'marker-stroke-color' => '#666666',
			'marker-stroke-opacity' => '1',
			'marker-fill-color' => '#f3f3f3',
			'marker-fill-opacity' => '1',
			'marker-label-color' => '#444444',
			'marker-scale' => '1',
			'marker-svg-path' => 'M37.0237112,10 C27.1233267,10 19.0948448,18.11264 19,28.14528 C19.0474224,31.64992 20.0561094,34.96 21.8363714,37.69728 L35.6292367,56.94528 C36.0150242,57.66528 36.5430789,58 37.0237112,58 C37.5517659,58 38.0323982,57.66528 38.4181857,56.94528 L52.1636286,37.69728 C53.9406864,34.91264 55,31.64992 55,28.14528 C54.9525776,18.11264 46.9240957,10 37.0237112,10 Z'
 		),
		'pear' => array(
			'marker-stroke-weight' => '2',
			'marker-stroke-color' => '#333333',
			'marker-stroke-opacity' => '1',
			'marker-fill-color' => '#CC1F25',
			'marker-fill-opacity' => '1',
			'marker-label-color' => '#ffffff',
			'marker-scale' => '1',
			'marker-svg-path' => 'M37.0237112,10 C27.1233267,10 19.0948448,18.11264 19,28.14528 C19.0474224,31.64992 20.0561094,34.96 21.8363714,37.69728 L35.6292367,56.94528 C36.0150242,57.66528 36.5430789,58 37.0237112,58 C37.5517659,58 38.0323982,57.66528 38.4181857,56.94528 L52.1636286,37.69728 C53.9406864,34.91264 55,31.64992 55,28.14528 C54.9525776,18.11264 46.9240957,10 37.0237112,10 Z'
 		),
		'safari' => array(
			'marker-stroke-weight' => '2',
			'marker-stroke-color' => '#333333',
			'marker-stroke-opacity' => '1',
			'marker-fill-color' => '#D19E70',
			'marker-fill-opacity' => '1',
			'marker-label-color' => '#ffffff',
			'marker-scale' => '1',
			'marker-svg-path' => 'M37.0237112,10 C27.1233267,10 19.0948448,18.11264 19,28.14528 C19.0474224,31.64992 20.0561094,34.96 21.8363714,37.69728 L35.6292367,56.94528 C36.0150242,57.66528 36.5430789,58 37.0237112,58 C37.5517659,58 38.0323982,57.66528 38.4181857,56.94528 L52.1636286,37.69728 C53.9406864,34.91264 55,31.64992 55,28.14528 C54.9525776,18.11264 46.9240957,10 37.0237112,10 Z'
 		)
	);
}

//
function dmo_get_symbols_array(){
	return array(
		'map-icon-abseiling' => __('Abseiling', 'citylights'),
		'map-icon-accounting' => __('Accounting', 'citylights'),
		'map-icon-airport' => __('Airport', 'citylights'),
		'map-icon-amusement-park' => __('Amusement Park', 'citylights'),
		'map-icon-aquarium' => __('Aquarium', 'citylights'),
		'map-icon-archery' => __('Archery', 'citylights'),
		'map-icon-art-gallery' => __('Art Gallery', 'citylights'),
		'map-icon-assistive-listening-system' => __('Assistive Listening System', 'citylights'),
		'map-icon-atm' => __('ATM', 'citylights'),
		'map-icon-audio-description' => __('Audio Description', 'citylights'),
		'map-icon-bakery' => __('Bakery', 'citylights'),
		'map-icon-bank' => __('Bank', 'citylights'),
		'map-icon-bar' => __('Bar', 'citylights'),
		'map-icon-baseball' => __('Baseball', 'citylights'),
		'map-icon-beauty-salon' => __('Beauty Salon', 'citylights'),
		'map-icon-bicycle-store' => __('Bicycle Store', 'citylights'),
		'map-icon-bicycling' => __('Bicycling', 'citylights'),
		'map-icon-boat-ramp' => __('Boat Ramp', 'citylights'),
		'map-icon-boat-tour' => __('Boat Tour', 'citylights'),
		'map-icon-boating' => __('Boating', 'citylights'),
		'map-icon-book-store' => __('Book Store', 'citylights'),
		'map-icon-bowling-alley' => __('Bowling Alley', 'citylights'),
		'map-icon-braille' => __('Braille', 'citylights'),
		'map-icon-bus-station' => __('Bus Station', 'citylights'),
		'map-icon-cafe' => __('Cafe', 'citylights'),
		'map-icon-campground' => __('Campground', 'citylights'),
		'map-icon-canoe' => __('Canoe', 'citylights'),
		'map-icon-car-dealer' => __('Car Dealer', 'citylights'),
		'map-icon-car-rental' => __('Car Rental', 'citylights'),
		'map-icon-car-repair' => __('Car Repair', 'citylights'),
		'map-icon-car-wash' => __('Car Wash', 'citylights'),
		'map-icon-casino' => __('Casino', 'citylights'),
		'map-icon-cemetery' => __('Cemetery', 'citylights'),
		'map-icon-chairlift' => __('Chairlift', 'citylights'),
		'map-icon-church' => __('Church', 'citylights'),
		'map-icon-circle' => __('Circle', 'citylights'),
		'map-icon-city-hall' => __('City Hall', 'citylights'),
		'map-icon-climbing' => __('Climbing', 'citylights'),
		'map-icon-closed-captioning' => __('Closed Captioning', 'citylights'),
		'map-icon-clothing-store' => __('Clothing Store', 'citylights'),
		'map-icon-compass' => __('Compass', 'citylights'),
		'map-icon-convenience-store' => __('Convenience Store', 'citylights'),
		'map-icon-courthouse' => __('Courthouse', 'citylights'),
		'map-icon-cross-country-skiing' => __('Cross Country Skiing', 'citylights'),
		'map-icon-crosshairs' => __('Crosshairs', 'citylights'),
		'map-icon-dentist' => __('Dentist', 'citylights'),
		'map-icon-department-store' => __('Department Store', 'citylights'),
		'map-icon-diving' => __('Diving', 'citylights'),
		'map-icon-doctor' => __('Doctor', 'citylights'),
		'map-icon-electrician' => __('Electrician', 'citylights'),
		'map-icon-electronics-store' => __('Electronics Store', 'citylights'),
		'map-icon-embassy' => __('Embassy', 'citylights'),
		'map-icon-expand' => __('Expand', 'citylights'),
		'map-icon-female' => __('Female', 'citylights'),
		'map-icon-finance' => __('Finance', 'citylights'),
		'map-icon-fire-station' => __('Fire Station', 'citylights'),
		'map-icon-fish-cleaning' => __('Fish Cleaning', 'citylights'),
		'map-icon-fishing-pier' => __('Fishing Pier', 'citylights'),
		'map-icon-fishing' => __('Fishing', 'citylights'),
		'map-icon-florist' => __('Florist', 'citylights'),
		'map-icon-food' => __('Food', 'citylights'),
		'map-icon-fullscreen' => __('Fullscreen', 'citylights'),
		'map-icon-funeral-home' => __('Funeral Home', 'citylights'),
		'map-icon-furniture-store' => __('Furniture Store', 'citylights'),
		'map-icon-gas-station' => __('Gas Station', 'citylights'),
		'map-icon-general-contractor' => __('General Contractor', 'citylights'),
		'map-icon-golf' => __('Golf', 'citylights'),
		'map-icon-grocery-or-supermarket' => __('Grocery or Supermarket', 'citylights'),
		'map-icon-gym' => __('Gym', 'citylights'),
		'map-icon-hair-care' => __('Hair Care', 'citylights'),
		'map-icon-hang-gliding' => __('Hang Gliding', 'citylights'),
		'map-icon-hardware-store' => __('Hardware Store', 'citylights'),
		'map-icon-health' => __('Health', 'citylights'),
		'map-icon-hindu-temple' => __('Hindu Temple', 'citylights'),
		'map-icon-horse-riding' => __('Horse Riding', 'citylights'),
		'map-icon-hospital' => __('Hospital', 'citylights'),
		'map-icon-ice-fishing' => __('Ice Fishing', 'citylights'),
		'map-icon-ice-skating' => __('Ice Skating', 'citylights'),
		'map-icon-inline-skating' => __('Inline Skating', 'citylights'),
		'map-icon-insurance-agency' => __('Insurance Agency', 'citylights'),
		'map-icon-jet-skiing' => __('Jet Skiing', 'citylights'),
		'map-icon-jewelry-store' => __('Jewelry Store', 'citylights'),
		'map-icon-kayaking' => __('Kayaking', 'citylights'),
		'map-icon-laundry' => __('Laundry', 'citylights'),
		'map-icon-lawyer' => __('Lawyer', 'citylights'),
		'map-icon-library' => __('Library', 'citylights'),
		'map-icon-liquor-store' => __('Liquor Store', 'citylights'),
		'map-icon-local-government' => __('Local Government', 'citylights'),
		'map-icon-location-arrow' => __('Location Arrow', 'citylights'),
		'map-icon-locksmith' => __('Locksmith', 'citylights'),
		'map-icon-lodging' => __('Lodging', 'citylights'),
		'map-icon-low-vision-access' => __('Low Vision Access', 'citylights'),
		'map-icon-male' => __('Male', 'citylights'),
		'map-icon-map-pin' => __('Map Pin', 'citylights'),
		'map-icon-marina' => __('Marina', 'citylights'),
		'map-icon-mosque' => __('Mosque', 'citylights'),
		'map-icon-motobike-trail' => __('Motobike Trail', 'citylights'),
		'map-icon-movie-rental' => __('Movie Rental', 'citylights'),
		'map-icon-movie-theater' => __('Movie Theater', 'citylights'),
		'map-icon-moving-company' => __('Moving Company', 'citylights'),
		'map-icon-museum' => __('Museum', 'citylights'),
		'map-icon-natural-feature' => __('Natural Feature', 'citylights'),
		'map-icon-night-club' => __('Night Club', 'citylights'),
		'map-icon-open-captioning' => __('Open Captioning', 'citylights'),
		'map-icon-painter' => __('Painter', 'citylights'),
		'map-icon-park' => __('Park', 'citylights'),
		'map-icon-parking' => __('Parking', 'citylights'),
		'map-icon-pet-store' => __('Pet Store', 'citylights'),
		'map-icon-pharmacy' => __('Pharmacy', 'citylights'),
		'map-icon-physiotherapist' => __('Physiotherapist', 'citylights'),
		'map-icon-place-of-worship' => __('Place of Worship', 'citylights'),
		'map-icon-playground' => __('Playground', 'citylights'),
		'map-icon-plumber' => __('Plumber', 'citylights'),
		'map-icon-point-of-interest' => __('Point of Interest', 'citylights'),
		'map-icon-police' => __('Police', 'citylights'),
		'map-icon-political' => __('Political', 'citylights'),
		'map-icon-post-box' => __('Post Box', 'citylights'),
		'map-icon-post-office' => __('Post Office', 'citylights'),
		'map-icon-postal-code-prefix' => __('Postal Code Prefix', 'citylights'),
		'map-icon-postal-code' => __('Postal Code', 'citylights'),
		'map-icon-rafting' => __('Rafting', 'citylights'),
		'map-icon-real-estate-agency' => __('Real Estate Agency', 'citylights'),
		'map-icon-restaurant' => __('Restaurant', 'citylights'),
		'map-icon-roofing-contractor' => __('Roofing Contractor', 'citylights'),
		'map-icon-route-pin' => __('Route Pin', 'citylights'),
		'map-icon-route' => __('Route', 'citylights'),
		'map-icon-rv-park' => __('RV Park', 'citylights'),
		'map-icon-sailing' => __('Sailing', 'citylights'),
		'map-icon-school' => __('School', 'citylights'),
		'map-icon-scuba-diving' => __('Scuba Diving', 'citylights'),
		'map-icon-search' => __('Search', 'citylights'),
		'map-icon-shield' => __('Shield', 'citylights'),
		'map-icon-shopping-mall' => __('Shopping Mall', 'citylights'),
		'map-icon-sign-language' => __('Sign Language', 'citylights'),
		'map-icon-skateboarding' => __('Skateboarding', 'citylights'),
		'map-icon-ski-jumping' => __('Ski Jumping', 'citylights'),
		'map-icon-skiing' => __('Skiing', 'citylights'),
		'map-icon-sledding' => __('Sledding', 'citylights'),
		'map-icon-snow-shoeing' => __('Snow Shoeing', 'citylights'),
		'map-icon-snow' => __('Snow', 'citylights'),
		'map-icon-snowboarding' => __('Snowboarding', 'citylights'),
		'map-icon-snowmobile' => __('Snowmobile', 'citylights'),
		'map-icon-spa' => __('Spa', 'citylights'),
		'map-icon-square-pin' => __('Square Pin', 'citylights'),
		'map-icon-square-rounded' => __('Square Rounded', 'citylights'),
		'map-icon-square' => __('Square', 'citylights'),
		'map-icon-stadium' => __('Stadium', 'citylights'),
		'map-icon-storage' => __('Storage', 'citylights'),
		'map-icon-store' => __('Store', 'citylights'),
		'map-icon-subway-station' => __('Subway Station', 'citylights'),
		'map-icon-surfing' => __('Surfing', 'citylights'),
		'map-icon-swimming' => __('Swimming', 'citylights'),
		'map-icon-synagogue' => __('Synagogue', 'citylights'),
		'map-icon-taxi-stand' => __('Taxi Stand', 'citylights'),
		'map-icon-tennis' => __('Tennis', 'citylights'),
		'map-icon-toilet' => __('Toilet', 'citylights'),
		'map-icon-trail-walking' => __('Trail Walking', 'citylights'),
		'map-icon-train-station' => __('Train Station', 'citylights'),
		'map-icon-transit-station' => __('Transit Station', 'citylights'),
		'map-icon-travel-agency' => __('Travel Agency', 'citylights'),
		'map-icon-unisex' => __('Unisex', 'citylights'),
		'map-icon-university' => __('University', 'citylights'),
		'map-icon-veterinary-care' => __('Veterinary-care', 'citylights'),
		'map-icon-viewing' => __('Viewing', 'citylights'),
		'map-icon-volume-control-telephone' => __('Volume Control Telephone', 'citylights'),
		'map-icon-walking' => __('Walking', 'citylights'),
		'map-icon-waterskiing' => __('Waterskiing', 'citylights'),
		'map-icon-whale-watching' => __('Whale Watching', 'citylights'),
		'map-icon-wheelchair' => __('Wheelchair', 'citylights'),
		'map-icon-wind-surfing' => __('Wind Surfing', 'citylights'),
		'map-icon-zoo' => __('Zoo', 'citylights'),
		'map-icon-zoom-in' => __('Zoom In', 'citylights'),
		'map-icon-zoom-in-alt' => __('Zoom In Alt', 'citylights'),
		'map-icon-zoom-out' => __('Zoom Out', 'citylights'),
		'map-icon-zoom-out-alt' => __('Zoom Out Alt', 'citylights')
	);
}

function dmopress_get_option($option){
	if($option){
		$optionRef = get_option('dmopress');
		return $optionRef[$option];
	} else {
		return '';
	}
}