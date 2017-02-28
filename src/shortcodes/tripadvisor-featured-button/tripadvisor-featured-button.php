
<?php 

//[tripadvisor-rating-badge post_id="" is_wide="false"]
function tourismpress_tripadvisor_featured_buton($atts, $content = null){
	global $google_maps_api_key;

	$atts = shortcode_atts(array(
		'place_id' => '',
	), $atts);


	//Resolve Place ID
	if(esc_attr($atts['place_id']) != ''){
		$post_id = esc_attr($atts['place_id']);
	} else {
		$post_id = get_the_ID();
	}

    //Resolve TripAdvisorLocationID
    $location_id = get_post_meta( $post_id, 'tripadvisor_location_id', true );
    if($location_id != ''){

        ob_start();
?>

<div id="TA_rated679" class="TA_rated">
    <ul id="cZmfO2GZ98" class="TA_links QkHrlDsm">
        <li id="u6rDofwGzJz7" class="4DbsGJnC">
            <a target="_blank" href="https://www.tripadvisor.com/"><img src="https://www.tripadvisor.com/img/cdsi/img2/badges/ollie-11424-2.gif" alt="TripAdvisor"/></a>
        </li>
    </ul>
</div>
<script src="https://www.jscache.com/wejs?wtype=rated&amp;uniq=679&amp;locationId=<?php echo $location_id; ?>&amp;lang=en_US&amp;display_version=2"></script>


<?php

        return ob_get_clean();
    } else {
        echo "Error: Invalid TripAdvisor Location ID: ".$location_id;
    }
}
add_shortcode( 'tripadvisor-featured-button', 'tourismpress_tripadvisor_featured_buton' );
