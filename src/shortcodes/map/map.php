<?php 
//[tourismpress-map]
function tourismpress_map($atts, $content = null){

	$atts = shortcode_atts(array(
		'categories' => '',
		'class' => '',
		'features' => '',
		'height' => '400px',
		'match' => 'OR',
		'places' => '',
		'style' => '',
		'tags' => '',
		'width' => '100%',
		'zoom' => 14,
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
	
	//Resolve Style
	if(tourismpress_is_valid_style(esc_attr($atts['style']))){
		$style = esc_attr($atts['style']);
	} else {
		$style = get_theme_mod('google_maps_style');;
	}
	$style_json = tourismpress_get_map_style_json(esc_attr($atts['style']));

	//Resolve zoom
	if(esc_attr($atts['zoom'])<=20 && esc_attr($atts['zoom'])>=0){
		$zoom = esc_attr($atts['zoom']);
	} else {
		$zoom = 14;
	}

	//Build query
	$query_args = array(
		'post_type' => 'places',
		'post_status' => 'publish',
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
			if($lat != '' && $long != ''){
				$places_jsarray .= '[';
				$places_jsarray .= '\''.$label.'\',';
				$places_jsarray .= $lat.',';
				$places_jsarray .= $long.',';
				$places_jsarray .= '\''.$slug.'\',';
				$places_jsarray .= '\''.$address1.'\',';
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

	if(get_theme_mod('google_maps_api_key') != ''){
?>

	<div id="<?php echo $map_id; ?>" class="tourismpress-map <?php echo $style; ?> <?php echo esc_attr($atts['class']); ?>" style="width: <?php echo esc_attr( $atts['width'] ) ?>; height: <?php echo esc_attr( $atts['height'] ) ?>; min-height: 50px;"></div>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_theme_mod('google_maps_api_key'); ?>"></script>

	<script type="text/javascript">
		google.maps.event.addDomListener(window, 'load', init);

		function init() {
			var locations = <?php echo $places_jsarray ?>;
			
			var mapOptions = {
				zoom: <?php echo esc_attr($atts['zoom']) ?>,
				styles: <?php echo $style_json; ?>,
				mapTypeId: 'terrain'
			};

			var mapElement = document.getElementById('<?php echo $map_id; ?>');
			var map = new google.maps.Map(mapElement, mapOptions);

			var infowindow = new google.maps.InfoWindow();

			var bounds = new google.maps.LatLngBounds();

			var marker, i;
			var image = new google.maps.MarkerImage('<?php echo plugins_url() ?>/tourismpress/shortcodes/map/styles/<?php echo $style ?>/marker.png', null, null, null, new google.maps.Size(30,40));

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
				controlText.innerHTML = '<img src="<?php echo plugins_url(); ?>/tourismpress/shortcodes/map/img/location.png" style="width: 10px; height: 11px;">';
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
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map,
					icon: image
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
	<p><span style="color: #cc0000;">Map Error:</span> A map could not be created because a valid Google Maps API key was not found. Add your Google Maps API key to the <a href="<?php echo admin_url('options-general.php?page=tourismpress-settings'); ?>">TourismPress Settings</a> page.</p>
	
<?php
	}
	return ob_get_clean();
}
add_shortcode( 'tourismpress-map', 'tourismpress_map' );

function tourismpress_get_map_style_json($style){
	if($style != ''){
		if(tourismpress_is_valid_style($style)){
			$style_string = $style;
		} else {
			if(get_theme_mod('google_maps_style') != ''){
				$style_string = get_theme_mod('google_maps_style');
			} else {
				$style_string = 'classic';
			}
		}
	} else {
		if(get_theme_mod('google_maps_style') != ''){
			$style_string = get_theme_mod('google_maps_style');
		} else {
			$style_string = 'classic';
		}
	}
	$raw_json = file_get_contents(tourismpress_PLUGIN_DIR . '/shortcodes/map/styles/'.$style_string.'/'.$style_string.'.json');
	return $raw_json;
}

function tourismpress_is_valid_style($style) {
	$valid_styles = array('gotham','nature','classic','grayscale');
	if(in_array($style,$valid_styles)){
		return true;
	} else {
		return false;
	}
}