<?php 

//[tourismpress-map address="679 Guiness Way, London, ON, N5X 0C6"]
function tourismpress_map($atts, $content = null){
	global $google_maps_api_key;

	$a = shortcode_atts(array(
   	'address' => '679 Guiness Way, London, ON, N5X 0C6'
	), $atts);

	ob_start();
	?>

	<div class="map">
		<iframe width="100%" height="400" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=<?php echo $google_maps_api_key; ?>&q=<?php echo $a['address'] ?>" allowfullscreen>
		</iframe>
	</div>
	
	<?php
	return ob_get_clean();
}
add_shortcode( 'tourismpress-map', 'tourismpress_map' );