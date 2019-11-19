<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

//[tripadvisor-rating-badge post_id="" is_wide="false" class=""]
function dmopress_tripadvisor_rating_badge($atts, $content = null){

	//Set up attributes
    $atts = shortcode_atts(array(
		'place_id' => '',
        'is_wide' => 'false',
        'class' => '',
	), $atts);

	//Resolve Place ID
	if(esc_attr($atts['place_id']) != ''){
		$post_id = esc_attr($atts['place_id']);
	} else {
		$post_id = get_the_ID();
	}

    //Resolve Width
    if(esc_attr($atts['is_wide']) == 'true' || esc_attr($atts['is_wide']) == 'false'){
        $is_wide = esc_attr($atts['is_wide']);
    } else {
        $is_wide = 'false';
    }

    if($is_wide == 'true'){
        $size = 'cdsratingsonlywide';
    } elseif($is_wide == 'false'){
        $size = 'cdsratingsonlynarrow';
    }

    //Resolve TripAdvisorLocationID
    $location_id = get_post_meta( $post_id, 'tripadvisor_location_id', true );
    if($location_id != ''){

        ob_start();
?>

<div id="TA_<?php echo $size ?>713" class="TA_<?php echo $size ?> <?php echo esc_attr($atts['class']); ?>">
    <ul>
        <li>
            <a target="_blank" href="https://www.tripadvisor.com/"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/tripadvisor_logo_transp_340x80-18034-2.png" alt="TripAdvisor"/></a>
        </li>
    </ul>
</div>
<script src="https://www.jscache.com/wejs?wtype=<?php echo $size ?>&amp;uniq=713&amp;locationId=<?php echo $location_id; ?>&amp;lang=en_US&amp;border=true&amp;display_version=2"></script>
<?php

        return ob_get_clean();
    } else {
        //echo "Error: Invalid TripAdvisor Location ID: ".$location_id;
    }
}
add_shortcode( 'dmo-tripadvisor-rating-badge', 'dmopress_tripadvisor_rating_badge' );
