<?php 
/**
 * TourismPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 *
 * @link https://codex.wordpress.org/Theme_Development
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link http://docs.tourismpress.net/designers/templatereference.html#functions-php}
 *
 * @package WordPress
 * @subpackage TourismPress
 * @since TourismPress 1.0
 */


//Load CSS
function tourismpress_theme_enqueue_css() {
	$stylesheet = get_template_directory_uri().'/css/app.min.css'; 
    wp_enqueue_style('app-css', $stylesheet, false);
    
    $fonts = 'https://fonts.googleapis.com/css?family=Roboto:400,500,300,700,400italic,300italic'; 
    wp_enqueue_style('app-fonts', $fonts, false);

    $fontawesome = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'; 
    wp_enqueue_style('app-fontawesome', $fontawesome, false);

}

add_action('wp_enqueue_scripts', 'tourismpress_theme_enqueue_css');

//Load Javascript
function tourismpress_theme_enqueue_js() {
    
    if(!is_page('social-wall')){
        $vendorjs = get_template_directory_uri().'/js/vendor.js'; 
        wp_enqueue_script('vendor-js', $vendorjs, false);
    }
    
    $appjs = get_template_directory_uri().'/js/app.min.js'; 
    if(!is_page('social-wall')){
        wp_enqueue_script('app-js', $appjs, false);
    }
}

add_action('wp_enqueue_scripts', 'tourismpress_theme_enqueue_js');


function render_google_map($post_id){
    // Fetch the TourismPress options array
    $option = get_option('tourismpress');
    
    // Check for the presence of a Google Maps API Key in Settings > TourismPress > Third Party Service Settings
    if($option['google_maps_api_key'] != ''){
        $mapsapikey = $option['google_maps_api_key'];
    	?>
    	<div class="map">
        <iframe width="100%" height="320" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=<?php echo $mapsapikey ?>&q=<?php echo get_post_meta($post_id, 'address', true).','.get_post_meta($post_id, 'city', true).','.get_post_meta($post_id, 'stateprov', true).','.get_post_meta($post_id, 'zip', true) ?>" allowfullscreen></iframe>
        </div>
    <?php
    }
}

// Change the default sort order on archive-accommodations.php
function skeletontheme_default_accommodations_sort_order($query) {
    // Check if the query is for an archive
    if($query->is_post_type_archive('accommodations')){
        // Query was for archive, then set order
        $query->set('orderby' , 'meta_value');
        $query->set('meta_key', 'star_rating');
        $query->set('order' , 'desc');
    }
    // Return the query (else there's no more query, oops!)
    return $query;
}
add_filter( 'pre_get_posts' , 'skeletontheme_default_accommodations_sort_order' );

function render_star_rating($post_id){

    $star_rating = get_post_meta($post_id, 'star_rating', true);

    if(($star_rating != '') && ($star_rating <= 5) && ($star_rating > 0)) {
        $star_rating = round($star_rating);
        for ($i=1; $i < 6; $i++) { 
            if($i <= $star_rating){
                echo '<img src="'.get_template_directory_uri().'/img/StarFilled.png" alt="'.$star_rating.' Star Rating" title="'.$star_rating.' Star Rating"> ';
            } else {
                echo '<img src="'.get_template_directory_uri().'/img/StarEmpty.png" alt="'.$star_rating.' Star Rating" title="'.$star_rating.' Star Rating"> ';
            }
        }
    }
}

function render_price_rating($post_id){
    $price_rating = get_post_meta($post_id, 'price_rating', true);

    if(($price_rating != '') && ($price_rating <= 5) && ($price_rating > 0)) {
        $price_rating = round($price_rating);
        for ($i=1; $i < 6; $i++) { 
            if($i <= $price_rating){
                echo '<img src="'.get_template_directory_uri().'/img/PriceFilled.png" alt="Price Rating '.$price_rating.' out of 5" title="Price Rating '.$price_rating.' out of 5"> ';
            } else {
                echo '<img src="'.get_template_directory_uri().'/img/PriceEmpty.png" alt="Price Rating '.$price_rating.' out of 5" title="Price Rating '.$price_rating.' out of 5"> ';
            }
        }
    }
}

function render_tags($post_id){
    $tags = get_the_tags();
    if (!empty($tags)) {
        foreach ( $tags as $tag ) {
            $tag_link = get_tag_link( $tag->term_id );
            echo "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>{$tag->name}</a>, ";
        }
    } else {
        echo "None";
    }
}

//Enable featured images  
add_theme_support('post-thumbnails');

//Sidebars

add_action( 'widgets_init', 'tourismpress_material_theme_sidebar_right_common_init' );
function tourismpress_material_theme_sidebar_right_common_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'tourismpress-textdomain' ),
        'id' => 'right-common',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'tourismpress-textdomain' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}

//Widgets 

function tourismpress_widget_test($args) {
   echo $args['before_widget'];
   echo $args['before_title'] . '<h4>Restaurant Categories</h4>' .  $args['after_title'];
   

   // print some HTML for the widget to display here
   $cat_args = array(
        'show_option_all'    => '',
        'orderby'            => 'name',
        'order'              => 'ASC',
        'style'              => 'list',
        'show_count'         => 0,
        'hide_empty'         => 1,
        'use_desc_for_title' => 1,
        'child_of'           => 0,
        'feed'               => '',
        'feed_type'          => '',
        'feed_image'         => '',
        'exclude'            => '',
        'exclude_tree'       => '',
        'include'            => '',
        'hierarchical'       => 1,
        'title_li'           => '',
        'show_option_none'   => __( '' ),
        'number'             => null,
        'echo'               => 1,
        'depth'              => 0,
        'current_category'   => 0,
        'pad_counts'         => 0,
        'taxonomy'           => 'restaurant-categories',
        'walker'             => null
    );
    wp_list_categories( $cat_args ); 

    echo $args['after_widget'];
}

wp_register_sidebar_widget(
    'restaurant_categories_widget',        // your unique widget id
    'Restaurant Categories',          // widget name
    'tourismpress_widget_test',  // callback function
    array(                  // options
        'description' => 'Outputs a list of Restaurant Categories in alphabetical order.'
    )
);