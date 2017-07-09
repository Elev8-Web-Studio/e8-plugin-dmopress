<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

//[dmo-map]
function dmopress_map($atts, $content = null){

	$atts = shortcode_atts(array(
		'categories' => '',
		'class' => '',
		'features' => '',
		'height' => '400px',
		'match' => 'OR',
		'places' => '',
		'theme' => '',
		'tags' => '',
		'width' => '100%',
		'zoom' => 14,
		'scrollwheel' => 'true',
		'marker-stroke-weight' => '',
		'marker-stroke-color' => '',
		'marker-stroke-opacity' => '1',
		'marker-fill-color' => '',
		'marker-fill-opacity' => '1',
		'marker-label-color' => '',
		'marker-scale' => '1',
		'marker-svg-path' => '',
	), $atts);

	//Generates a random string for use in map id attribute (which must be unique)
	$map_id = 'map-'.substr(str_shuffle(md5(time())),0,8);

	//Resolve Categories
	if(esc_attr($atts['categories']) != ''){
		$categories = explode(',', esc_attr($atts['categories']));
	} else {
		$categories = array();
	}

	//Resolve Features
	if(esc_attr($atts['features']) != ''){
		$features = explode(',', esc_attr( $atts['features'] ));
	} else {
		$features = array();
	}

	//Resolve Match 
	if(strtolower(esc_attr($atts['match'])) == 'or'){
		$match = 'OR';
	} elseif(strtolower(esc_attr($atts['match'])) == 'and') {
		$match = 'AND';
	} else {
		$match = 'OR';
	}

	//Resolve Place ID
	if(esc_attr($atts['places']) != ''){
		$places = explode(',', esc_attr( $atts['places'] ));
	} else {
		$places = array();
	}

	//Resolve Tags
	if(esc_attr($atts['tags']) != ''){
		$tags_array = explode(',', esc_attr( $atts['tags'] ));
		$tags = '';
		foreach ($tags_array as &$tag) {
			$tags .= $tag.',';
		}
	} else {
		$tags = '';
	}
	
	//Resolve Theme
	if(dmo_is_valid_theme(esc_attr($atts['theme']))){
		$theme = esc_attr($atts['theme']);
	} else {
		$theme = dmo_get_google_maps_theme();
	}
	$theme_json = dmo_get_map_theme_json(esc_attr($atts['theme']));

	//Resolve zoom
	if(esc_attr($atts['zoom'])<=20 && esc_attr($atts['zoom'])>=0){
		$zoom = esc_attr($atts['zoom']);
	} else {
		$zoom = 14;
	}

	//Resolve scrollwheel
	if(esc_attr($atts['zoom']) == 'true'){
		$scrollwheel = 'true';
	} else {
		$scrollwheel = 'false';
	}

	//Resolve Marker 
	$theme_defaults = dmo_get_map_theme_defaults();

	$marker_stroke_weight = esc_attr($atts['marker-stroke-weight']);
	if($marker_stroke_weight == ''){
		$marker_stroke_weight = $theme_defaults[$theme]['marker-stroke-weight'];
	}

	$marker_stroke_color = esc_attr($atts['marker-stroke-color']);
	if($marker_stroke_color == ''){
		if(get_theme_mod('dmopress_color_map_marker_stroke') != ''){
			$marker_stroke_color = get_theme_mod('dmopress_color_map_marker_stroke');
		} else {
			$marker_stroke_color = $theme_defaults[$theme]['marker-stroke-color'];
		}
	}

	$marker_stroke_opacity = esc_attr($atts['marker-stroke-opacity']);
	if($marker_stroke_opacity == ''){
		$marker_stroke_opacity = $theme_defaults[$theme]['marker-stroke-opacity'];
	}

	$marker_fill_color = esc_attr($atts['marker-fill-color']);
	if($marker_fill_color == ''){
		if(get_theme_mod('dmopress_color_map_marker_fill') != ''){
			$marker_fill_color = get_theme_mod('dmopress_color_map_marker_fill');
		} else {
			$marker_fill_color = $theme_defaults[$theme]['marker-fill-color'];
		}
	}

	$marker_fill_opacity = esc_attr($atts['marker-fill-opacity']);
	if($marker_fill_opacity == ''){
		$marker_fill_opacity = $theme_defaults[$theme]['marker-fill-opacity'];
	}

	$marker_label_color = esc_attr($atts['marker-label-color']);
	if($marker_label_color == ''){
		if(get_theme_mod('dmopress_color_map_marker_label') != ''){
			$marker_label_color = get_theme_mod('dmopress_color_map_marker_label');
		} else {
			$marker_label_color = $theme_defaults[$theme]['marker-label-color'];
		}
	}

	$marker_scale = esc_attr($atts['marker-scale']);
	if($marker_scale == ''){
		$marker_scale = $theme_defaults[$theme]['marker-scale'];
	}

	$marker_svg_path = esc_attr($atts['marker-svg-path']);
	if($marker_svg_path == ''){
		$marker_svg_path = $theme_defaults[$theme]['marker-svg-path'];
	}
	

	//Build query
	$query_args = array(
		'post_type' => 'places',
		'post_status' => 'publish',
		'posts_per_page'=> -1,
		'post__in' => $places,
		'tag_slug__in' => $tags,
	);

	if(count($categories)>0 || count($features)>0){
		$query_args['tax_query'] = array();
	}

	if(count($categories)>0){
		array_push($query_args['tax_query'], array(
			'taxonomy' => 'categories',
			'field'    => 'slug',
			'terms'    => $categories,
		));
		//echo $query_args['tax_query'];
	}

	if(count($features)>0){
		array_push($query_args['tax_query'], array(
			'taxonomy' => 'features',
			'field'    => 'slug',
			'terms'    => $features,
		));
	}

	if(count($categories)>0 && count($features)>0){
		$query_args['tax_query']['relation'] = $match;
	}
	
	$places_query = new WP_Query($query_args);

	//Build JS objects
	if ( $places_query->have_posts() ) {
		$places_jsarray = '[';
		while ( $places_query->have_posts() ) {
			$places_query->the_post();
			$label = get_the_title();
			$lat = get_post_meta( get_the_ID(), 'latitude', true );
			$long = get_post_meta( get_the_ID(), 'longitude', true );
			$slug = get_permalink( get_the_ID() );
			$address1 = get_post_meta( get_the_ID(), 'address', true );
			$symbol = get_post_meta( get_the_ID(), 'symbol', true );
			if($lat != '' && $long != ''){
				$places_jsarray .= '[';
				$places_jsarray .= '\''.$label.'\',';
				$places_jsarray .= $lat.',';
				$places_jsarray .= $long.',';
				$places_jsarray .= '\''.$slug.'\',';
				$places_jsarray .= '\''.$address1.'\',';
				$places_jsarray .= '\''.$symbol.'\',';
				$places_jsarray .= '],';
			}
		}
		$places_jsarray .= ']';

		// Restore original Post Data
		wp_reset_postdata();
	} else {
		$places_jsarray = '[]';
	}

	ob_start();

	if(dmo_get_google_maps_api_key() != ''){
?>


	<div id="<?php echo $map_id; ?>" class="dmopress-map <?php echo $theme; ?> <?php echo esc_attr($atts['class']); ?>" style="width: <?php echo esc_attr( $atts['width'] ) ?>; height: <?php echo esc_attr( $atts['height'] ) ?>; min-height: 50px;"></div>

	<script type="text/javascript">
		google.maps.event.addDomListener(window, 'load', init);


		var mapchars = {'map-icon-abseiling': 'e800','map-icon-accounting': 'e801','map-icon-airport': 'e802','map-icon-amusement-park': 'e803','map-icon-aquarium': 'e804','map-icon-archery': 'e805','map-icon-art-gallery': 'e806','map-icon-assistive-listening-system': 'e807','map-icon-atm': 'e808','map-icon-audio-description': 'e809','map-icon-bakery': 'e80a','map-icon-bank': 'e80b','map-icon-bar': 'e80c','map-icon-baseball': 'e80d','map-icon-beauty-salon': 'e80e','map-icon-bicycle-store': 'e80f','map-icon-bicycling': 'e810','map-icon-boat-ramp': 'e811','map-icon-boat-tour': 'e812','map-icon-boating': 'e813','map-icon-book-store': 'e814','map-icon-bowling-alley': 'e815','map-icon-braille': 'e816','map-icon-bus-station': 'e817','map-icon-cafe': 'e818','map-icon-campground': 'e819','map-icon-canoe': 'e81a','map-icon-car-dealer': 'e81b','map-icon-car-rental': 'e81c','map-icon-car-repair': 'e81d','map-icon-car-wash': 'e81e','map-icon-casino': 'e81f','map-icon-cemetery': 'e820','map-icon-chairlift': 'e821','map-icon-church': 'e822','map-icon-circle': 'e823','map-icon-city-hall': 'e824','map-icon-climbing': 'e825','map-icon-closed-captioning': 'e826','map-icon-clothing-store': 'e827','map-icon-compass': 'e828','map-icon-convenience-store': 'e829','map-icon-courthouse': 'e82a','map-icon-cross-country-skiing': 'e82b','map-icon-crosshairs': 'e82c','map-icon-dentist': 'e82d','map-icon-department-store': 'e82e','map-icon-diving': 'e82f','map-icon-doctor': 'e830','map-icon-electrician': 'e831','map-icon-electronics-store': 'e832','map-icon-embassy': 'e833','map-icon-expand': 'e834','map-icon-female': 'e835','map-icon-finance': 'e836','map-icon-fire-station': 'e837','map-icon-fish-cleaning': 'e838','map-icon-fishing-pier': 'e839','map-icon-fishing': 'e83a','map-icon-florist': 'e83b','map-icon-food': 'e83c','map-icon-fullscreen': 'e83d','map-icon-funeral-home': 'e83e','map-icon-furniture-store': 'e83f','map-icon-gas-station': 'e840','map-icon-general-contractor': 'e841','map-icon-golf': 'e842','map-icon-grocery-or-supermarket': 'e843','map-icon-gym': 'e844','map-icon-hair-care': 'e845','map-icon-hang-gliding': 'e846','map-icon-hardware-store': 'e847','map-icon-health': 'e848','map-icon-hindu-temple': 'e849','map-icon-horse-riding': 'e84a','map-icon-hospital': 'e84b','map-icon-ice-fishing': 'e84c','map-icon-ice-skating': 'e84d','map-icon-inline-skating': 'e84e','map-icon-insurance-agency': 'e84f','map-icon-jet-skiing': 'e850','map-icon-jewelry-store': 'e851','map-icon-kayaking': 'e852','map-icon-laundry': 'e853','map-icon-lawyer': 'e854','map-icon-library': 'e855','map-icon-liquor-store': 'e856','map-icon-local-government': 'e857','map-icon-location-arrow': 'e858','map-icon-locksmith': 'e859','map-icon-lodging': 'e85a','map-icon-low-vision-access': 'e85b','map-icon-male': 'e85c','map-icon-map-pin': 'e85d','map-icon-marina': 'e85e','map-icon-mosque': 'e85f','map-icon-motobike-trail': 'e860','map-icon-movie-rental': 'e861','map-icon-movie-theater': 'e862','map-icon-moving-company': 'e863','map-icon-museum': 'e864','map-icon-natural-feature': 'e865','map-icon-night-club': 'e866','map-icon-open-captioning': 'e867','map-icon-painter': 'e868','map-icon-park': 'e869','map-icon-parking': 'e86a','map-icon-pet-store': 'e86b','map-icon-pharmacy': 'e86c','map-icon-physiotherapist': 'e86d','map-icon-place-of-worship': 'e86e','map-icon-playground': 'e86f','map-icon-plumber': 'e870','map-icon-point-of-interest': 'e871','map-icon-police': 'e872','map-icon-political': 'e873','map-icon-post-box': 'e874','map-icon-post-office': 'e875','map-icon-postal-code-prefix': 'e876','map-icon-postal-code': 'e877','map-icon-rafting': 'e878','map-icon-real-estate-agency': 'e879','map-icon-restaurant': 'e87a','map-icon-roofing-contractor': 'e87b','map-icon-route-pin': 'e87c','map-icon-route': 'e87d','map-icon-rv-park': 'e87e','map-icon-sailing': 'e87f','map-icon-school': 'e880','map-icon-scuba-diving': 'e881','map-icon-search': 'e882','map-icon-shield': 'e883','map-icon-shopping-mall': 'e884','map-icon-sign-language': 'e885','map-icon-skateboarding': 'e886','map-icon-ski-jumping': 'e887','map-icon-skiing': 'e888','map-icon-sledding': 'e889','map-icon-snow-shoeing': 'e88a','map-icon-snow': 'e88b','map-icon-snowboarding': 'e88c','map-icon-snowmobile': 'e88d','map-icon-spa': 'e88e','map-icon-square-pin': 'e88f','map-icon-square-rounded': 'e890','map-icon-square': 'e891','map-icon-stadium': 'e892','map-icon-storage': 'e893','map-icon-store': 'e894','map-icon-subway-station': 'e895','map-icon-surfing': 'e896','map-icon-swimming': 'e897','map-icon-synagogue': 'e898','map-icon-taxi-stand': 'e899','map-icon-tennis': 'e89a','map-icon-toilet': 'e89b','map-icon-trail-walking': 'e89c','map-icon-train-station': 'e89d','map-icon-transit-station': 'e89e','map-icon-travel-agency': 'e89f','map-icon-unisex': 'e8a0','map-icon-university': 'e8a1','map-icon-veterinary-care': 'e8a2','map-icon-viewing': 'e8a3','map-icon-volume-control-telephone': 'e8a4','map-icon-walking': 'e8a5','map-icon-waterskiing': 'e8a6','map-icon-whale-watching': 'e8a7','map-icon-wheelchair': 'e8a8','map-icon-wind-surfing': 'e8a9','map-icon-zoo': 'e8aa','map-icon-zoom-in-alt': 'e8ab','map-icon-zoom-in': 'e8ac','map-icon-zoom-out-alt': 'e8ad','map-icon-zoom-out': 'e8ae'}

		function init() {
			var locations = <?php echo $places_jsarray ?>;
			
			var mapOptions = {
				zoom: <?php echo $zoom; ?>,
				scrollwheel: <?php echo $scrollwheel; ?>,
				styles: <?php echo $theme_json; ?>,
				mapTypeId: 'roadmap',
				clickableIcons: false
			};

			var mapElement = document.getElementById('<?php echo $map_id; ?>');
			var map = new google.maps.Map(mapElement, mapOptions);

			var infowindow = new google.maps.InfoWindow();

			var bounds = new google.maps.LatLngBounds();

			var icon = {
				path: '<?php echo $marker_svg_path; ?>',
				fillColor: '<?php echo $marker_fill_color; ?>',
				fillOpacity: <?php echo $marker_fill_opacity; ?>,
				strokeWeight: <?php echo $marker_stroke_weight; ?>,
				strokeColor: '<?php echo $marker_stroke_color; ?>',
				strokeOpacity: <?php echo $marker_stroke_opacity; ?>,
				anchor: new google.maps.Point(36,48),
				scale: <?php echo $marker_scale; ?>,
				labelOrigin: new google.maps.Point(37, 28)
			}

			function CenterControl(controlDiv, map) {
				
				// Set CSS for the control border.
				var controlUI = document.createElement('div');
				controlUI.style.backgroundColor = '#fff';
				controlUI.style.border = '2px solid #fff';
				controlUI.style.borderRadius = '2px';
				controlUI.style.boxShadow = 'rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px';
				controlUI.style.cursor = 'pointer';
				controlUI.style.marginRight = '10px';
				controlUI.style.textAlign = 'center';
				controlUI.title = 'My Location';
				controlDiv.appendChild(controlUI);

				// Set CSS for the control interior.
				var controlText = document.createElement('div');
				controlText.style.paddingTop = '6px';
				controlText.style.paddingRight = '7px';
				controlText.style.paddingBottom = '6px';
				controlText.style.paddingLeft = '7px';
				controlText.innerHTML = '<img src="<?php echo plugins_url(); ?>/dmopress/shortcodes/map/img/location.png" style="width: 10px; height: 11px;">';
				controlUI.appendChild(controlText);

				// Setup the click event listeners: simply set the map to Chicago.
				controlUI.addEventListener('click', function() {

					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(function(position) {
							var pos = {
								lat: position.coords.latitude,
								lng: position.coords.longitude
							};
							map.setCenter(pos);
						}, function() {
							handleLocationError(true, map.getCenter());
						});
					} else {
						// Browser doesn't support Geolocation
						handleLocationError(false, map.getCenter());
					}

				});

				function handleLocationError(browserHasGeolocation, pos) {
					if(browserHasGeolocation){
						alert('Error: The Geolocation service failed.');
					} else {
						alert('Error: Your browser doesn\'t support geolocation.');
					}
				}
			}

			// Create the DIV to hold the control and call the CenterControl()
			// constructor passing in this DIV.
			if(location.protocol == 'https:'){
				var centerControlDiv = document.createElement('div');
				var centerControl = new CenterControl(centerControlDiv, map);
				centerControlDiv.index = 1;
				map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(centerControlDiv);
			}

			for (i = 0; i < locations.length; i++) {  

				if(locations[i][5] != 'none' && locations[i][5] != ''){
					var labelContent = String.fromCharCode(parseInt(mapchars[locations[i][5]], 16));
					label = {
						color: '<?php echo $marker_label_color; ?>',
						fontFamily: 'map-icons',
						fontSize: '19px',
						fontWeight: 'normal',
						text: labelContent
					}
				} else {
					label = '';
				}

				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map,
					draggable: false,
					icon: icon,
					label: label
				});

				bounds.extend(marker.position);

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						infowindow.setContent('<strong><a class="map-callout-title" href="' + locations[i][3] + '">' + locations[i][0] + '</a></strong><br>' + locations[i][4]);
						infowindow.open(map, marker);
					}
				})(marker, i));
			}
			map.fitBounds(bounds);

			var listener = google.maps.event.addListener(map, "idle", function () {
				if(locations.length == 1){
					map.setZoom(<?php echo $zoom ?>);
				}
				
				google.maps.event.removeListener(listener);
			});

		}
	</script>
	
<?php } else { ?>
	<p><span style="color: #cc0000;"><?php _e('Error:', 'dmopress_textdomain');  ?></span>
	<?php _e('A map could not be created because a valid Google Maps API key was not found. Add your Google Maps API key in','dmopress_textdomain') ?> <a href="<?php echo admin_url('options-general.php?page=dmopress-settings'); ?>">DMOPress Settings</a>.</p>
	
<?php
	}
	return ob_get_clean();
}
add_shortcode( 'dmo-map', 'dmopress_map' );

function dmo_get_map_theme_json($theme){
	if($theme != ''){
		if(dmo_is_valid_theme($theme)){
			$theme_string = $theme;
		} else {
			if(dmo_get_google_maps_theme() != ''){
				$theme_string = dmo_get_google_maps_theme();
			} else {
				$theme_string = 'classic';
			}
		}
	} else {
		if(dmo_get_google_maps_theme() != ''){
			$theme_string = dmo_get_google_maps_theme();
		} else {
			$theme_string = 'classic';
		}
	}
	$raw_json = file_get_contents(DMOPRESS_PLUGIN_DIR . '/shortcodes/map/themes/'.$theme_string.'/'.$theme_string.'.json');
	return $raw_json;
}

function dmo_is_valid_theme($theme) {
	$valid_themes = array('gotham','nature','classic','grayscale','midnight','pear','safari');
	if(in_array($theme,$valid_themes)){
		return true;
	} else {
		return false;
	}
}