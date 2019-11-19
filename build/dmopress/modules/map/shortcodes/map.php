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
		'maptype' => 'roadmap',
		'match' => 'OR',
		'places' => '',
		'theme' => '',
		'tags' => '',
		'width' => '100%',
		'zoom' => 14,
		'scrollwheel' => 'false',
		'show-directions' => 'false',
		'show-google-link' => 'true',
		'show-post-thumbnail' => 'true',
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

	//Resolve Map Type
	$maptype = 'roadmap';
	if(in_array(esc_attr($atts['maptype']), ['roadmap','satellite','hybrid','terrain'])){
		$maptype = esc_attr($atts['maptype']);
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
	if(esc_attr($atts['scrollwheel']) == 'true'){
		$scrollwheel = 'true';
	} else {
		$scrollwheel = 'false';
	}

	//Resolve show-directions
	if(esc_attr($atts['show-directions']) == 'true'){
		$show_directions = 'true';
	} else {
		$show_directions = 'false';
	}

	//Resolve show-google-link
	if(esc_attr($atts['show-google-link']) == 'false'){
		$show_google_link = 'false';
	} else {
		$show_google_link = 'true';
	}

	//Resolve show-post-thumbnail
	if(esc_attr($atts['show-post-thumbnail']) == 'false'){
		$show_post_thumbnail = 'false';
	} else {
		$show_post_thumbnail = 'true';
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

	//Translation Strings
	$label_user_location = __('Your Location', 'dmopress');
	$label_location_fetching = __('Getting your location...', 'dmopress');
	$label_directions_unavailable = __('Directions unavailable from your location.', 'dmopress');
	$label_directions_failed = __('Directions service failed. Status Code:', 'dmopress');
	$label_geolocation_failed = __('Geolocation service failed.', 'dmopress');
	$label_geolocation_unsupported = __('Your browser does not support geolocation services.', 'dmopress');
	$label_get_directions = __('Directions', 'dmopress');
	$label_google_maps = __('Open in Google Maps', 'dmopress');

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
			$address1 = dmo_get_address_full();
			$symbol = get_post_meta( get_the_ID(), 'symbol', true );
			$thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
			if($lat != '' && $long != ''){
				$places_jsarray .= '[';
				$places_jsarray .= '\''.$label.'\',';
				$places_jsarray .= $lat.',';
				$places_jsarray .= $long.',';
				$places_jsarray .= '\''.$slug.'\',';
				$places_jsarray .= '\''.$address1.'\',';
				$places_jsarray .= '\''.$symbol.'\',';
				$places_jsarray .= '\''.$thumbnail.'\',';
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
	
	<div class="dmopress-map-container">
		<div id="<?php echo $map_id; ?>" class="dmopress-map <?php echo $theme; ?> <?php echo esc_attr($atts['class']); ?>" style="width: <?php echo esc_attr( $atts['width'] ) ?>; height: <?php echo esc_attr( $atts['height'] ) ?>; min-height: 50px;">
		</div>
		<div class="dmopress-map-overlay">
			<div class="map-overlay-inner">
				<div class="dmopress-map-overlay-spinner"><i class="map-icon map-icon-walking"></i> <?php echo $label_location_fetching; ?></div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var mapID = '<?php echo $map_id; ?>';

		var mapOptions = {
			zoom: <?php echo $zoom; ?>,
			scrollwheel: <?php echo $scrollwheel; ?>,
			styles: <?php echo $theme_json; ?>,
			clickableIcons: false,
			mapTypeId: '<?php echo $maptype; ?>'
		};

		var markerOptions = {
			markerIconBase: {
				path: '<?php echo $marker_svg_path; ?>',
				fillColor: '<?php echo $marker_fill_color; ?>',
				fillOpacity: <?php echo $marker_fill_opacity; ?>,
				strokeWeight: <?php echo $marker_stroke_weight; ?>,
				strokeColor: '<?php echo $marker_stroke_color; ?>',
				strokeOpacity: <?php echo $marker_stroke_opacity; ?>,
				anchor: new google.maps.Point(36, 48),
				scale: <?php echo $marker_scale; ?>,
				labelOrigin: new google.maps.Point(37, 28)
			},
			markerLabelBase: {
				color: '<?php echo $marker_label_color; ?>',
				fontFamily: 'map-icons',
				fontSize: '19px',
				fontWeight: 'normal'
			},
			markerUserIcon: {
				path: '<?php echo $marker_svg_path; ?>',
				fillColor: '<?php echo $marker_fill_color; ?>',
				fillOpacity: <?php echo $marker_fill_opacity; ?>,
				strokeWeight: <?php echo $marker_stroke_weight; ?>,
				strokeColor: '<?php echo $marker_stroke_color; ?>',
				strokeOpacity: <?php echo $marker_stroke_opacity; ?>,
				anchor: new google.maps.Point(36,48),
				scale: <?php echo $marker_scale; ?>,
				labelOrigin: new google.maps.Point(37, 28)
			},
			markerUserLabel: {
				color: '<?php echo $marker_label_color; ?>',
				fontFamily: 'map-icons',
				fontSize: '19px',
				fontWeight: 'normal',
				text: String.fromCharCode(parseInt('e8a5', 16))
			},
			markerUserCalloutText: '<?php echo $label_user_location; ?>'
		}

		var calloutOptions = {
			showDirections: '<?php echo $show_directions; ?>',
			showGoogleLink: '<?php echo $show_google_link; ?>',
			showPostThumbnail: '<?php echo $show_post_thumbnail; ?>'
		}

		var locations = <?php echo $places_jsarray ?>;

		var translationStrings = {
			labelUserLocation: '<?php echo $label_user_location; ?>',
			labelLocationFetching: '<?php echo $label_location_fetching; ?>',
			labelDirectionsUnavailable: '<?php echo $label_directions_unavailable; ?>',
			labelDirectionsFailed: '<?php echo $label_directions_failed; ?>',
			labelGeolocationFailed: '<?php echo $label_geolocation_failed; ?>',
			labelGeolocationUnsupported: '<?php echo $label_geolocation_unsupported; ?>',
			labelGetDirections: '<?php echo $label_get_directions; ?>',
			labelGoogleMaps: '<?php echo $label_google_maps; ?>'
		}

		jQuery(document).ready(function($) {
			initMap(mapID, locations, mapOptions, markerOptions, calloutOptions, translationStrings);
		});
		
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
	$raw_json = file_get_contents(DMOPRESS_PLUGIN_MODULES_DIR . '/map/themes/'.$theme_string.'/'.$theme_string.'.json');
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