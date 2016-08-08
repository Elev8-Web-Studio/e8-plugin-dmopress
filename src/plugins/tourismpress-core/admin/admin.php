<?php 

function tourismpress_admin_enqueue_style() {
    $cssref = plugins_url('css/tourismpress-core.min.css', __FILE__);
    wp_enqueue_style('tourismpress-core', $cssref, false);

    $bootstrap = plugins_url('css/bootstrap.min.css', __FILE__);
    wp_enqueue_style('tourismpress-bootstrap', $bootstrap, false);

    $jsref = plugins_url('js/tourismpress-core.min.js', __FILE__);
    wp_enqueue_script('tourismpress-core-js', $jsref, false );

    // Date and Time Picker
    //wp_enqueue_script('tourismpress-picker-js', plugins_url('js/picker.js', __FILE__), false );
    //wp_enqueue_script('tourismpress-picker-date-js', plugins_url('js/picker.date.js', __FILE__), false );
    //wp_enqueue_script('tourismpress-picker-time-js', plugins_url('js/picker.time.js', __FILE__), false );
    wp_enqueue_style('tourismpress-picker-css', plugins_url('css/picker.css', __FILE__), false);
    //wp_enqueue_style('tourismpress-picker-date-css', plugins_url('css/picker.date.css', __FILE__), false);
    //wp_enqueue_style('tourismpress-picker-time-css', plugins_url('css/picker.time.css', __FILE__), false);

    //wp_enqueue_script('tourismpress-jquery-validate-js', plugins_url('js/jquery.validate.js', __FILE__), false);
}

if(is_admin()){
    add_action( 'admin_enqueue_scripts', 'tourismpress_admin_enqueue_style' );
}
