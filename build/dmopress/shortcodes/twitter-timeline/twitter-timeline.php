<?php 

//[dmo-twitter-timeline handle="" class=""]
function dmopress_twitter_timeline($atts, $content = null){

	$atts = shortcode_atts(array(
		'place_id' => '',
        'theme' => '',
        'class' => '',
        'color' => '',
	), $atts);

	//Resolve Place ID
	if(esc_attr($atts['place_id']) != ''){
		$post_id = esc_attr($atts['place_id']);
	} else {
		$post_id = get_the_ID();
	}

    //Resolve Class
    if(esc_attr($atts['class']) != ''){
        $css_class = esc_attr($atts['class']);
    } else {
        $css_class = '';
    }

    //Resolve Color
    if(esc_attr($atts['color']) != ''){
        $color = esc_attr($atts['color']);
    } else {
        $color = '#2B7BB9';
    }

    //Resolve Theme
    if(esc_attr($atts['theme']) == 'dark'){
        $theme = ' data-theme="dark" ';
    } else {
        $theme = ' data-theme="light" ';
    }

    //Resolve Twitter Handle
    $twitter_handle = get_post_meta( $post_id, 'twitter_handle', true );
    if($twitter_handle != ''){

    ob_start();
?>
<div class="<?php echo $css_class; ?>">
    <a class="twitter-timeline" <?php echo $theme; ?> data-link-color="<?php echo $color ?>" href="https://twitter.com/<?php echo $twitter_handle ?>">Tweets by <?php echo $twitter_handle ?></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>
<?php

        return ob_get_clean();
    } else {
        echo "Error: Invalid Twitter Handle: ".$twitter_handle;
    }
}
add_shortcode( 'dmo-twitter-timeline', 'dmopress_twitter_timeline' );
