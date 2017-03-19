<?php 

function tourismpress_enqueue_css() {
  wp_enqueue_style('tourismpress_css', plugins_url() . '/tourismpress/css/tourismpress.min.css');
}
add_action('init','tourismpress_enqueue_css');