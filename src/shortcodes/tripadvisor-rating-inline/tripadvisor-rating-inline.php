<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

//[tripadvisor-rating-inline post_id="" class=""]
function dmo_tripadvisor_rating_inline($atts, $content = null){

	//Set up attributes
    $atts = shortcode_atts(array(
		'place_id' => '',
        'class' => '',
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

<div id="TA_socialButtonBubbles874" class="TA_socialButtonBubbles <?php echo esc_attr($atts['class']); ?>">
    <ul id="ez8xYi" class="TA_links 57wc9o5">
        <li id="4rhuc21t6" class="v3BeaDwNosu">
            <a target="_blank" href="https://www.tripadvisor.com/Hotel_Review-g1015730-d10781824-Reviews-Limberlost_Lodge-Thessalon_Northeastern_Ontario_Ontario.html"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/socialWidget/20x28_green-21693-2.png"/></a>
        </li>
    </ul>
</div>
<script src="https://www.jscache.com/wejs?wtype=socialButtonBubbles&amp;uniq=874&amp;locationId=<?php echo $location_id; ?>&amp;color=green&amp;size=rect&amp;lang=en_US&amp;display_version=2"></script>

<?php

        return ob_get_clean();
    } else {
        echo "Error: Invalid TripAdvisor Location ID: ".$location_id;
    }
}
add_shortcode( 'dmo-tripadvisor-rating-inline', 'dmo_tripadvisor_rating_inline' );
