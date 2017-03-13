<?php 

//[tripadvisor-review-snippets place_id="" is_wide="false"]
function tourismpress_tripadvisor_review_snippets($atts, $content = null){

    //Set up attributes
	$atts = shortcode_atts(array(
		'place_id' => '',
        'is_wide' => 'false',
        'class' => '',
	), $atts);

	//Resolve Post ID
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

    //Resolve TripAdvisorLocationID
    $location_id = get_post_meta( $post_id, 'tripadvisor_location_id', true );
    if($location_id != ''){

        ob_start();
?>

<div id="TA_selfserveprop427" class="TA_selfserveprop tripadvisor-review-snippets <?php echo esc_attr($atts['class']); ?>">
    <ul>
        <li>
            <a target="_blank" href="https://www.tripadvisor.com/"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a>
        </li>
    </ul>
</div>
<script src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=427&amp;locationId=<?php echo $location_id; ?>&amp;lang=en_US&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=<?php echo $is_wide; ?>&amp;border=true&amp;display_version=2"></script>

<?php if($is_wide == 'true') { ?>
<style>
    #CDSWIDSSP {
        width: 100% !important;
    }
</style>
<?php } ?>

<?php

        return ob_get_clean();
    } else {
        echo "Error: Invalid TripAdvisor Location ID: ".$location_id;
    }
}
add_shortcode( 'tripadvisor-review-snippets', 'tourismpress_tripadvisor_review_snippets' );
