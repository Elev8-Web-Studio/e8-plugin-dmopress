<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

//[tripadvisor-reviews-button post_id="" class=""]
function dmopress_tripadvisor_reviews_button($atts, $content = null){

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


<div id="TA_linkingWidgetRedesign237" class="TA_linkingWidgetRedesign <?php echo esc_attr($atts['class']); ?>">
    <ul id="GTpQWliPz9s" class="TA_links Uda7wuHu">
        <li id="iX1uh9DS0RKB" class="gt1WZM">
            <a target="_blank" href="https://www.tripadvisor.com/"><img src="https://www.tripadvisor.com/img/cdsi/partner/tripadvisor_logo_115x18-15079-2.gif" alt="TripAdvisor"/></a>
        </li>
    </ul>
</div>
<script src="https://www.jscache.com/wejs?wtype=linkingWidgetRedesign&amp;uniq=237&amp;locationId=<?php echo $location_id; ?>&amp;lang=en_US&amp;border=true&amp;display_version=2"></script>

<?php

        return ob_get_clean();
    } else {
        echo "Error: Invalid TripAdvisor Location ID: ".$location_id;
    }
}
add_shortcode( 'dmo-tripadvisor-reviews-button', 'dmopress_tripadvisor_reviews_button' );
