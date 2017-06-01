<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

//[dmo-inline-weather class=""]
function dmopress_inline_weather($atts, $content = null){
    
    //Set up attributes
	$atts = shortcode_atts(array(
        'unit' => '',
        'class' => ''
	), $atts);

    $unit = strtolower(esc_attr($atts['unit']));

    switch ($unit) {
        case 'cf':
            $unit = 'cf';
            break;
        case 'fc':
            $unit = 'fc';
            break;
        case 'c':
            $unit = 'c';
            break;
        case 'f':
            $unit = 'f';
            break;
        default:
            $unit = dmo_get_openweathermap_default_unit();
    }

    ob_start();
?>

<span class="weather-inline <?php echo esc_attr($atts['class']); ?>" data-unit="<?php echo $unit; ?>"></span>

<?php

    return ob_get_clean();
}
add_shortcode( 'dmo-inline-weather', 'dmopress_inline_weather' );
