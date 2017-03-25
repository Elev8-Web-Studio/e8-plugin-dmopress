<?php
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

function tourismpress_customize_register($wp_customize) {
   $wp_customize->add_section('tourismpress', array(
       'title' => 'TourismPress',
       'description' => ''
   ));

   //Google Maps API Key
   $wp_customize->add_setting('google_maps_api_key' , array(
       'default'     => ''
   ));

   $wp_customize->add_control( new WP_Customize_Control( 
       $wp_customize, 
       'google_maps_api_key', 
       array(
            'label'      => __( 'Google Maps API Key:', 'tourismpress' ),
            'section'    => 'tourismpress',
            'settings'   => 'google_maps_api_key',
            'type' => 'text'
       )
   ));
   
   //Google Maps Theme
   $wp_customize->add_setting('google_maps_theme' , array(
       'default'     => 'classic'
   ));

   $wp_customize->add_control( new WP_Customize_Control( 
       $wp_customize, 
       'google_maps_theme', 
       array(
            'label'      => __( 'Google Maps Default Theme:', 'tourismpress' ),
            'section'    => 'tourismpress',
            'settings'   => 'google_maps_theme',
            'type' => 'select',
            'choices' => array(
                'classic' => 'Classic',
                'gotham' => 'Gotham',
                'grayscale' => 'Grayscale',
                'nature' => 'Nature'
            )
       )
   ));

}
add_action( 'customize_register', 'tourismpress_customize_register' );