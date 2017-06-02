<?php

function dmopress_register_visual_composer_shortcodes() {
   
   //[dmo-inline-weather]
   vc_map( array(
      "name" => __( "DMOPress Inline Weather", "dmopress_textdomain" ),
      "base" => "dmo-inline-weather",
      "class" => "",
      "category" => __( "Content", "dmopress_textdomain"),
      "icon" => plugins_url() . "/dmopress/integration/visual-composer/icon-weather-inline.png",
      "params" => array(
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Display Units", "dmopress_textdomain" ),
            "param_name" => "unit",
            "value" => array(
                __( "Celsius", "dmopress_textdomain" ) => 'c',
                __( "Fahrenheit", "dmopress_textdomain" ) => 'f',
                __( "Celsius / Fahrenheit", "dmopress_textdomain" ) => 'cf',
                __( "Fahrenheit / Celsius", "dmopress_textdomain" ) => 'fc'
            )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "CSS Class", "dmopress_textdomain" ),
            "param_name" => "class",
            "description" => __( "Apply one or more space-seprarated CSS class names to this element.", "dmopress_textdomain" )
         ),
      )
   ) );

   //[dmo-map]
   vc_map( array(
      "name" => __( "DMOPress Map", "dmopress_textdomain" ),
      "base" => "dmo-map",
      "class" => "",
      "category" => __( "Content", "dmopress_textdomain"),
      "icon" => plugins_url() . "/dmopress/integration/visual-composer/icon-tripadvisor.png",
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "ID (Optional)", "dmopress_textdomain" ),
            "param_name" => "id",
            "description" => __( "Sets the HTML id attribute of the map container element to the value specified.", "dmopress_textdomain" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Place IDs (Optional)", "dmopress_textdomain" ),
            "param_name" => "places",
            "description" => __( "Comma-separated integers representing one or more WordPress Post IDs that correspond to Place post types. When used within the loop, this value defaults to the current Post ID.", "dmopress_textdomain" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Categories", "dmopress_textdomain" ),
            "param_name" => "categories",
            "description" => __( 'One or more comma-separated strings representing slugs for <a href="https://www.dmopress.com/guide/place-categories-place-features-and-tags/" target="_blank">Place Categories</a>.', 'dmopress_textdomain' )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Features", "dmopress_textdomain" ),
            "param_name" => "Features",
            "description" => __( 'One or more comma-separated strings representing slugs for <a href="https://www.dmopress.com/guide/place-categories-place-features-and-tags/" target="_blank">Place Features</a>.', 'dmopress_textdomain' )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Tags", "dmopress_textdomain" ),
            "param_name" => "Tags",
            "description" => __( 'One or more comma-separated strings representing slugs for <a href="https://www.dmopress.com/guide/place-categories-place-features-and-tags/" target="_blank">WordPress Tags</a>.', 'dmopress_textdomain' )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "CSS Class", "dmopress_textdomain" ),
            "param_name" => "class",
            "description" => __( "Apply one or more space-seprarated CSS class names to this element.", "dmopress_textdomain" )
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Map Theme", "dmopress_textdomain" ),
            "param_name" => "theme",
            "description" => __( 'Sets the <a href="https://www.dmopress.com/guide/maps/map-themes/" target="_blank">style and color scheme</a> of the map. It’s only necessary to set this parameter if you want to override the default map theme you’ve chosen in Settings > DMOPress > Google Maps.', "dmopress_textdomain" ),
            "value" => array(
                __( "Default", "dmopress_textdomain" ) => 'default',
                __( "Classic", "dmopress_textdomain" ) => 'classic',
                __( "Grayscale", "dmopress_textdomain" ) => 'grayscale',
                __( "Gotham", "dmopress_textdomain" ) => 'gotham',
                __( "Nature", "dmopress_textdomain" ) => 'nature',
                __( "Pear", "dmopress_textdomain" ) => 'pear',
                __( "Safari", "dmopress_textdomain" ) => 'safari'
            )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Width", "dmopress_textdomain" ),
            "param_name" => "width",
            "description" => __( "Any string that is compatible with the CSS width property.", "dmopress_textdomain" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Height", "dmopress_textdomain" ),
            "param_name" => "height",
            "description" => __( "Any string that is compatible with the CSS height property.", "dmopress_textdomain" )
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Zoom", "dmopress_textdomain" ),
            "param_name" => "zoom",
            "description" => __( "For single Places only: sets the initial zoom level of the map when it is loaded. When loading a map with multiple Places, the zoom level of the map is determined automatically by the boundaries of all matching Places, and this parameter is ignored.", "dmopress_textdomain" ),
            "value" => array(
                __( "Default", "dmopress_textdomain" ) => '14',
                "1" => '1',
                "2" => '2',
                "3" => '3',
                "4" => '4',
                "5" => '5',
                "6" => '6',
                "7" => '7',
                "8" => '8',
                "9" => '9',
                "10" => '10',
                "11" => '11',
                "12" => '12',
                "13" => '13',
                "14" => '14',
                "15" => '15',
                "16" => '16',
                "17" => '17',
                "18" => '18',
                "19" => '19',
                "20" => '20'
            )
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Match", "dmopress_textdomain" ),
            "param_name" => "match",
            "description" => __( "When deciding which of the supplied Place Categories, Place Features and Tags to include on a map, determines whether narrow matching or broad matching is used.", "dmopress_textdomain" ),
            "value" => array(
                __( "AND", "dmopress_textdomain" ) => 'AND',
                __( "OR", "dmopress_textdomain" ) => 'OR',
            )
         ),
      )
   ) );

   //[dmo-tripadvisor-featured-button]
   vc_map( array(
      "name" => __( "TripAdvisor Featured Button", "dmopress_textdomain" ),
      "base" => "dmo-tripadvisor-featured-button",
      "class" => "",
      "category" => __( "Content", "dmopress_textdomain"),
      "icon" => plugins_url() . "/dmopress/integration/visual-composer/icon-tripadvisor.png",
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Place ID (Optional)", "dmopress_textdomain" ),
            "param_name" => "place_id",
            "description" => __( "When used within the loop, this value defaults to the current Post ID. When used outside the loop, this value must be supplied.", "dmopress_textdomain" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "CSS Class", "dmopress_textdomain" ),
            "param_name" => "class",
            "description" => __( "Apply one or more space-seprarated CSS class names to this element.", "dmopress_textdomain" )
         ),
      )
   ) );

   //[dmo-tripadvisor-rating-badge]
   vc_map( array(
      "name" => __( "TripAdvisor Rating Badge", "dmopress_textdomain" ),
      "base" => "dmo-tripadvisor-rating-badge",
      "class" => "",
      "category" => __( "Content", "dmopress_textdomain"),
      "icon" => plugins_url() . "/dmopress/integration/visual-composer/icon-tripadvisor.png",
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Place ID (Optional)", "dmopress_textdomain" ),
            "param_name" => "place_id",
            "description" => __( "When used within the loop, this value defaults to the current Post ID. When used outside the loop, this value must be supplied.", "dmopress_textdomain" )
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Is Wide?", "dmopress_textdomain" ),
            "param_name" => "is_wide",
            "description" => __( "By default, this shortcode displays a button/thumbnail size widget (max-width: 160px). Setting this to True renders a wider (max-width: 468px) widget.", "dmopress_textdomain" ),
            "value" => array(
                __( "False", "dmopress_textdomain" ) => 'false',
                __( "True", "dmopress_textdomain" ) => 'true'
            )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "CSS Class", "dmopress_textdomain" ),
            "param_name" => "class",
            "description" => __( "Apply one or more space-seprarated CSS class names to this element.", "dmopress_textdomain" )
         ),
      )
   ) );

   //[dmo-tripadvisor-rating-inline]
   vc_map( array(
      "name" => __( "TripAdvisor Rating Inline", "dmopress_textdomain" ),
      "base" => "dmo-tripadvisor-rating-inline",
      "class" => "",
      "category" => __( "Content", "dmopress_textdomain"),
      "icon" => plugins_url() . "/dmopress/integration/visual-composer/icon-tripadvisor.png",
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Place ID (Optional)", "dmopress_textdomain" ),
            "param_name" => "place_id",
            "description" => __( "When used within the loop, this value defaults to the current Post ID. When used outside the loop, this value must be supplied.", "dmopress_textdomain" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "CSS Class", "dmopress_textdomain" ),
            "param_name" => "class",
            "description" => __( "Apply one or more space-seprarated CSS class names to this element.", "dmopress_textdomain" )
         ),
      )
   ) );

   //[dmo-tripadvisor-review-snippets]
   vc_map( array(
      "name" => __( "TripAdvisor Review Snippets", "dmopress_textdomain" ),
      "base" => "dmo-tripadvisor-review-snippets",
      "class" => "",
      "category" => __( "Content", "dmopress_textdomain"),
      "icon" => plugins_url() . "/dmopress/integration/visual-composer/icon-tripadvisor.png",
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Place ID (Optional)", "dmopress_textdomain" ),
            "param_name" => "place_id",
            "description" => __( "When used within the loop, this value defaults to the current Post ID. When used outside the loop, this value must be supplied.", "dmopress_textdomain" )
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Is Wide?", "dmopress_textdomain" ),
            "param_name" => "is_wide",
            "description" => __( "By default, this shortcode displays a button/thumbnail size widget. Setting this to True renders a widget that takes the width of its container.", "dmopress_textdomain" ),
            "value" => array(
                __( "False", "dmopress_textdomain" ) => 'false',
                __( "True", "dmopress_textdomain" ) => 'true'
            )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "CSS Class", "dmopress_textdomain" ),
            "param_name" => "class",
            "description" => __( "Apply one or more space-seprarated CSS class names to this element.", "dmopress_textdomain" )
         ),
      )
   ) );

   //[dmo-tripadvisor-review-starter]
   vc_map( array(
      "name" => __( "TripAdvisor Review Starter", "dmopress_textdomain" ),
      "base" => "dmo-tripadvisor-review-starter",
      "class" => "",
      "category" => __( "Content", "dmopress_textdomain"),
      "icon" => plugins_url() . "/dmopress/integration/visual-composer/icon-tripadvisor.png",
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Place ID (Optional)", "dmopress_textdomain" ),
            "param_name" => "place_id",
            "description" => __( "When used within the loop, this value defaults to the current Post ID. When used outside the loop, this value must be supplied.", "dmopress_textdomain" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "CSS Class", "dmopress_textdomain" ),
            "param_name" => "class",
            "description" => __( "Apply one or more space-seprarated CSS class names to this element.", "dmopress_textdomain" )
         ),
      )
   ) );

   //[dmo-tripadvisor-reviews-button]
   vc_map( array(
      "name" => __( "TripAdvisor Reviews Button", "dmopress_textdomain" ),
      "base" => "dmo-tripadvisor-reviews-button",
      "class" => "",
      "category" => __( "Content", "dmopress_textdomain"),
      "icon" => plugins_url() . "/dmopress/integration/visual-composer/icon-tripadvisor.png",
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Place ID (Optional)", "dmopress_textdomain" ),
            "param_name" => "place_id",
            "description" => __( "When used within the loop, this value defaults to the current Post ID. When used outside the loop, this value must be supplied.", "dmopress_textdomain" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "CSS Class", "dmopress_textdomain" ),
            "param_name" => "class",
            "description" => __( "Apply one or more space-seprarated CSS class names to this element.", "dmopress_textdomain" )
         ),
      )
   ) );

}
add_action( 'vc_before_init', 'dmopress_register_visual_composer_shortcodes' );